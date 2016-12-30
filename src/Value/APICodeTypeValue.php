<?php
namespace Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Value;

use Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Interfaces\ValueInterface;
use Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Value\AbstractCollectionValue;

/**
 * Class for API Code type value.
 *
 * @license https://opensource.org/licenses/MIT MIT
 */
class APICodeTypeValue extends AbstractCollectionValue implements ValueInterface
{

    /**
     * @inheritDoc
     */
    protected $collection = array(
            'numeric' => 'numeric',
            'alpha' => 'alpha',
            'alphanumeric' => 'alphanumeric'
        );

    /**
     * @inheritDoc
     */
    protected $value = 'numeric';

    /**
     * @inheritDoc
     */
    protected $fieldName = 'API Code type';

    /**
     * @inheritDoc
     */
    protected $fieldId = 'apiCodeType';
}
