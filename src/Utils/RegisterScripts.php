<?php
namespace Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Utils;

class RegisterScripts
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'loadCss'), 10);
        // Enqueue javascript
        add_action('wp_enqueue_scripts', array($this, 'loadJavascript'), 1);
    }

    /**
     * Register the needed css files for the plugin on register
     */
    public function loadCss()
    {
        wp_register_style(
            'fortytwo_two_factor_style_intl',
            plugin_dir_url(__FILE__) . '../Css/intlTelInput.css',
            false,
            '1.0.0'
        );
        wp_register_style(
            'fortytwo_two_factor_style_plugin',
            plugin_dir_url(__FILE__) . '../Css/plugin.css',
            false,
            '1.0.0'
        );
        wp_enqueue_style('fortytwo_two_factor_style_intl');
        wp_enqueue_style('fortytwo_two_factor_style_plugin');
    }

    /**
     * Register the needed javascripts files for the plugin on register
     */
    public function loadJavascript()
    {
        wp_enqueue_script(
            'fortytwo_two_factor_javascript_intlTelInput',
            plugin_dir_url(__FILE__) . '../Javascript/intlTelInput.min.js',
            array('jquery')
        );
        wp_enqueue_script(
            'fortytwo_two_factor_javascript_plugin',
            plugin_dir_url(__FILE__) . '../Javascript/plugin.js'
        );
    }
}
