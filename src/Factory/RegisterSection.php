<?php
namespace Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Factory;

use Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Artefact\ApiSettingsSection;
use Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Artefact\GeneralSection;
use Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Interfaces\Section;

/**
 * Factory - Instantiate RegisterSection classes
 *
 * @license https://opensource.org/licenses/MIT MIT
 */
class RegisterSection
{
    /**
     * Create a RegisterSection object
     *
     * @param string $type Type of Section to create
     *
     * @return Section interface
     */
    public static function get($type)
    {
        $instance = null;

        switch ($type) {

            case 'ApiSettingsSection':
                $instance = new ApiSettingsSection();
                break;

            case 'GeneralSection':
                $instance = new GeneralSection();
                break;

            default:
                throw new \Exception("Bad Section definition.", 1);
        }

        return $instance;
    }
}
