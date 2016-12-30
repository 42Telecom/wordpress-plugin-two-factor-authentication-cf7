<?php
namespace Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Value;

use Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Interfaces\ValueInterface;
use Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Utils\Configuration;
use Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Value\AbstractValue;

/**
 * Class for the API Callback url Value.
 *
 * @license https://opensource.org/licenses/MIT MIT
 */
class APICallBackUrlValue extends AbstractValue implements ValueInterface
{

    /**
     * @var string
     */
    protected $value = '';

    /**
     * @inheritDoc
     */
    protected $fieldName = 'API Callback url';

    /**
     * @inheritDoc
     */
    protected $fieldId = 'apiCallbackUrl';

    /**
     * @inheritDoc
     */
    public function __construct($value = false)
    {
        if ($value === '') {
            $this->value = '';
        } elseif ($value != '') {
            if (filter_var($value, FILTER_VALIDATE_URL)) {
                $this->value = $value;
            } else {
                add_settings_error(
                    Configuration::SETTINGS_DOMAIN,
                    esc_attr($this->fieldId),
                    'Wrong ' . $this->fieldName . ' format. The expected format is like http://www.mydomain.com/mycallbackpage',
                    'error'
                );
            }
        } else {
            $options = get_option(Configuration::SETTINGS_DOMAIN);

            if (isset($options[$this->fieldId])) {
                $this->value = $options[$this->fieldId];
            }
        }
    }
}
