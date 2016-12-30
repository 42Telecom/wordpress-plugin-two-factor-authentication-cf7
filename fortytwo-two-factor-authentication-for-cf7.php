<?php
/*
Plugin Name: Fortytwo - Two-Factor Authentication plugin for Contact Form 7.
Plugin URI: https://www.fortytwo.com
Description: Implement the fortytwo Two Factor Authentication service for Contact Form 7.
Version: 1.0.0
Author: Fortytwo <devs@fortytwo.com>
Author URI: https://www.fortytwo.com
License: MIT
*/

// Load the composer autoload
require dirname(__FILE__) . '/vendor/autoload.php';

// Workaround for the Doctrine annotation
Doctrine\Common\Annotations\AnnotationRegistry::registerAutoloadNamespace(
    'JMS\Serializer\Annotation',
    dirname(__FILE__) . "/vendor/jms/serializer/src"
);

new Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Utils\RegisterScripts();
new Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Controller\Admin();
new Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Hooks\ValidateHook();
