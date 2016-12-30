<?php
namespace Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Controller;
use Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Utils\Configuration;

/**
 * Abstract all function to managing authentication with the 2FA SDK.
 *
 * @license https://opensource.org/licenses/MIT MIT
 */
class AbstractAuth
{
    /**
     * Build the parameter array for the SDK API call from the paramaters saved
     * in the database.
     */
    protected function buildRequestCodeOption()
    {
        $options = get_option(Configuration::SETTINGS_DOMAIN);

        $args = array();
        if (isset($options['apiCodeLength'])) {
            $args['codeLength'] = $options['apiCodeLength'];
        }
        if (isset($options['apiCodeType'])) {
            $args['codeType'] = $options['apiCodeType'];
        }
        if (isset($options['apiCaseSensitive'])) {
            if ($options['apiCaseSensitive'] == 'true') {
                $args['caseSensitive'] = true;
            } else {
                $args['caseSensitive'] = false;
            }
        }
        if (isset($options['apiCallBackUrl'])) {
            $args['callbackUrl'] = $options['apiCallBackUrl'];
        }
        if (isset($options['apiSenderId']) && ($options['apiSenderId'] != '')) {
            $args['senderId'] = $options['apiSenderId'];
        }
        if (isset($options['apiTemplateMessage']) && ($options['apiTemplateMessage'] != '')) {
            $args['messageTemplate'] = $options['apiTemplateMessage'];
        }
        return $args;
    }

    /**
     * sanitize the phone number in a format compatible with the API
     *
     * @param string $phoneNumber Phone number to sanitizw
     * @return string Sanitized phone number
     */
    protected function sanitizePhoneNumber($phoneNumber)
    {
        return str_replace(array('+','-'), '', filter_var($phoneNumber, FILTER_SANITIZE_NUMBER_INT));
    }

    public function isTwoFactorAvailableOn($action)
    {
        $options = get_option(Configuration::SETTINGS_DOMAIN);

        // Check if the Token is present
        if (isset($options['tokenNumber']) && ($options['tokenNumber'] != '')) {
            // Check the spe
            if ($action == 'login') {
                // Check the spe
                if (!isset($options['twoFactorOnLogin']) || ($options['twoFactorOnLogin'] == 'activated')) {
                    return true;
                }
            } elseif ($action == 'register') {
                if (!isset($options['twoFactorOnRegister']) || ($options['twoFactorOnRegister'] == 'activated')) {
                    return true;
                }
            }
        }
        return false;
    }
}
