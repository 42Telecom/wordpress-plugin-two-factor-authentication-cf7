<?php
namespace Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Utils;

/**
 * Manage Wordpress Nonce for the login
 * See https://codex.wordpress.org/WordPress_Nonces
 */
class Configuration
{
    /**
     * @var string SETTINGS_DOMAIN Define the domain for storing the configurations in wordpress.
     */
    const SETTINGS_DOMAIN = 'fortytwo2faforcf7';

    /**
     * @var string CLIENT_REFERENCE_PREFIX Define the prefix used for the client reference used for API call
     */
    const CLIENT_REFERENCE_PREFIX = 'wordpress_contact_form7';

    /**
     * Return a Client reference for the 2FA API.
     */
    public function getClientReference() {
        return self::CLIENT_REFERENCE_PREFIX . uniqid();
    }
}
