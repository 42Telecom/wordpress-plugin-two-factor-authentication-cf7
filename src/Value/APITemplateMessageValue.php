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
class APITemplateMessageValue extends AbstractValue implements ValueInterface
{

    /**
     * @var string
     */
    protected $value = '';

    /**
     * @inheritDoc
     */
    protected $fieldName = 'API Template Message';

    /**
     * @inheritDoc
     */
    protected $fieldId = 'apiTemplateMessage';

    /**
     * @inheritDoc
     */
    public function __construct($value = false)
    {
        if ($value === '') {
            $this->value = null;
        } elseif ($value != '') {
            if (strpos($value, '{#TFA_CODE}')) {
                $this->value = $value;
            } else {
                add_settings_error(
                    Configuration::SETTINGS_DOMAIN,
                    esc_attr($this->fieldId),
                    'The placeholder {#TFA_CODE} is mandatory in ' . $this->fieldName . '.',
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
