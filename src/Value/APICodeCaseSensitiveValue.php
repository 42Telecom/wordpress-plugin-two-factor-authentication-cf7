<?php
namespace Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Value;

use Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Interfaces\ValueInterface;
use Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Value\AbstractCollectionValue;

/**
 * Class for API Code case sensitive value.
 *
 * @license https://opensource.org/licenses/MIT MIT
 */
class APICodeCaseSensitiveValue extends AbstractCollectionValue implements ValueInterface
{

    /**
     * @inheritDoc
     */
    protected $collection = array('false' => 'False', 'true' => 'True');

    /**
     * @inheritDoc
     */
    protected $value = 'false';

    /**
     * @inheritDoc
     */
    protected $fieldName = 'API Code case sensitive';

    /**
     * @inheritDoc
     */
    protected $fieldId = 'apiCaseSensitive';
}
