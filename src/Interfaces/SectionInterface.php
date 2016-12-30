<?php
namespace Fortytwo\Wordpress\Plugin\TwoFactorAuthenticationForCf\Interfaces;

/**
 * Define the section interface.
 */
interface SectionInterface
{
    /**
     * Add section in the wordpress admin page
     *
     * @param $id Identificator of the section
     * @param $name Name of the section
     *
     * @return the current instance
     */
    public function add();

    /**
     * Print the description above the title
     */
    public function description();
}
