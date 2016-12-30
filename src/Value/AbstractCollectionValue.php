<?php
namespace Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Value;

use Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Interfaces\ValueInterface;
use Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Utils\Configuration;
use Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Value\AbstractValue;

/**
 * Abstract class for the Collection values.
 *
 * @license https://opensource.org/licenses/MIT MIT
 */
abstract class AbstractCollectionValue extends AbstractValue implements ValueInterface
{
    /**
     * @var array
     */
    protected $collection = array();

    /**
     * @inheritDoc
     */
    public function __construct($value = false)
    {
        if ($value) {
            if (in_array($value, array_flip($this->collection))) {
                $this->value = $value;
            } else {
                add_settings_error(
                    Configuration::SETTINGS_DOMAIN,
                    esc_attr($this->fieldId),
                    'Wrong ' . $this->fieldName . ' option: ' . $value,
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

    /**
     * @inheritDoc
     */
    public function getOptions()
    {
        return $this->collection;
    }
}
