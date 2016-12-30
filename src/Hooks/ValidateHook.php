<?php
namespace Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Hooks;

use Fortytwo\SDK\TwoFactorAuthentication\TwoFactorAuthentication;
use Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Utils\Configuration;
use Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Controller\AbstractAuth;

class ValidateHook extends AbstractAuth
{
    public function __construct()
    {
        add_filter('wpcf7_validate', array($this, 'validate'), 10, 2);
        add_action( 'wp_ajax_send_tfa_code', array($this,'sendCode'), 10, 2);
    }

    /**
     * Validate the phone number adding a step with 2FA.
     */
    public function validate($result, $tags)
    {
        $tfaFieldName = false;

        foreach ($tags as $id => $tag) {
            // In case of a department option, we get the ID of the derpatment
            if (($tag['type'] == "tel" ) || ($tag['type'] == "tel*" )) {
                foreach($tag['options'] as $value) {
                    if ($value == 'class:2fa-phone') {
                        $tfaFieldName = $tag['name'];
                    }
                }
            }
        }

        if ($tfaFieldName) {
            $options = get_option(Configuration::SETTINGS_DOMAIN);

            if (!empty($_POST['code'])) {
                // Create and submit the request to API
                $ApiRequest = new TwoFactorAuthentication($options['tokenNumber']);
                $response = $ApiRequest->validateCode($_POST['ref-id'], $_POST['code']);

                // Manage the response
                if ($response->getResultInfo()->getStatusCode() != 0) {
                    $result->invalidate($tfaFieldName, "Wrong authentication code.");
                }
            } else {
                $result->invalidate($tfaFieldName, "Authentication code empty.");
            }
        }

        return $result;
    }

    public function sendCode(){
        $options = get_option(Configuration::SETTINGS_DOMAIN);

        $ApiRequest = new TwoFactorAuthentication(trim($options['tokenNumber']));
        $response = $ApiRequest->requestCode($_POST['ref-id'], self::sanitizePhoneNumber($_POST['mobile-number']), self::buildRequestCodeOption());
    }
}
