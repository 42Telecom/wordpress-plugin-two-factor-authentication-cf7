<?php
namespace Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Controller;

use Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Factory\RegisterSection;
use Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Utils\Configuration;
/**
 * Manage Admin settings for the plugin
 *
 * @license https://opensource.org/licenses/MIT MIT
 */
class Admin
{

    private $options;

    /**
     * Contructor - Call action to add the setting page.
     */
    public function __construct()
    {
        add_action('admin_menu', array($this, 'addPluginPage'));
        add_action('admin_init', array($this, 'pageInitSection'));
    }

    /**
     * Add options page
     */
    public function addPluginPage()
    {

        add_submenu_page(
            'wpcf7',
            'Two Factor Authentication',
            'Two Factor Authentication',
            'wpcf7_read_contact_forms',
            'fortytwo-2fa-cf7-admin',
            array($this, 'createAdminPage')
        );
    }

    /**
     * Options page callback
     */
    public function createAdminPage()
    {
        // Set class property
        $this->options = get_option(Configuration::SETTINGS_DOMAIN);
        ?>
        <div class="wrap">
            <h2>Two Factor Authentication Settings</h2>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields('fortytwo2faforcf7Setting');
                do_settings_sections('fortytwo-2fa-cf7-admin');
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Add section and fields
     */
    public function pageInitSection()
    {
        // Add Group
        register_setting(
            'fortytwo2faforcf7Setting',
            'fortytwo2faforcf7',
            array($this, 'sanitize')
        );

        RegisterSection::get("GeneralSection")->add();
        RegisterSection::get("ApiSettingsSection")->add();
    }

    /**
     * Map the list of fields used in the admin.
     *
     * @return array Name of value oject used as fields.
     */
    public function fieldMapping()
    {
        $fieldMap = array(
            '\Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Value\TokenValue',
            '\Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Value\APICodeLengthValue',
            '\Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Value\APICodeTypeValue',
            '\Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Value\APICodeCaseSensitiveValue',
            '\Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Value\APICallBackUrlValue',
            '\Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Value\APICustomSenderIDValue',
            '\Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Value\APITemplateMessageValue'
        );

        return $fieldMap;
    }

    public function sanitize($input)
    {
        $newInput = array();

        foreach ($this->fieldMapping() as $field) {
            $obj = new $field();
            $fieldId = (string)$obj->getFieldId();

            if (isset($input[$fieldId])) {
                $valueObj = new $field($input[$fieldId]);
                $newInput[$fieldId] = $valueObj->getValue();
            }
        }
        return $newInput;
    }

}
