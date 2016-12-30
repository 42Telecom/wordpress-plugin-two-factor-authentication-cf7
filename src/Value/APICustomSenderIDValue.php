<?php
namespace Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Value;

use Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Interfaces\ValueInterface;
use Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Utils\Configuration;
use Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Value\AbstractValue;

/**
 * Class for the API Custome sender ID Value.
 *
 * @license https://opensource.org/licenses/MIT MIT
 */
class APICustomSenderIDValue extends AbstractValue implements ValueInterface
{
    /**
     * @var int
     */
    private $numericLimit = 15;

    /**
     * @var int
     */
    private $alphanumericLimit = 11;

    /**
     * @var string
     */
    protected $value = '';

    /**
     * @inheritDoc
     */
    protected $fieldName = 'API Custom Sender ID';

    /**
     * @inheritDoc
     */
    protected $fieldId = 'apiSenderId';

    /**
     * @inheritDoc
     */
    public function __construct($value = false)
    {
        if ($value === '') {
            $this->value = '';
        } elseif ($value != '') {
            if (is_numeric($value)) {
                //numeric
                if (strlen($value) <=$this->numericLimit) {
                    $this->value = $value;
                } else {
                    add_settings_error(
                        Configuration::SETTINGS_DOMAIN,
                        esc_attr($this->fieldId),
                        'Wrong numeric ' . $this->fieldName . ' length: max ' . $this->numericLimit . ' characters',
                        'error'
                    );
                }
            } elseif (preg_match('/[a-z0-9]/i', $value)) {
                // alphanumeric
                if (strlen($value) <=$this->alphanumericLimit) {
                    $this->value = $value;
                } else {
                    add_settings_error(
                        Configuration::SETTINGS_DOMAIN,
                        esc_attr($this->fieldId),
                        'Wrong alphanumeric ' . $this->fieldName . ' length: max ' . $this->alphanumericLimit . ' characters',
                        'error'
                    );
                }
            } else {
                add_settings_error(
                    Configuration::SETTINGS_DOMAIN,
                    esc_attr($this->fieldId),
                    'Wrong ' . $this->fieldName . ' format, only numeric and alphanumeric are accepted (no special characters)',
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
