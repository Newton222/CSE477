<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 3/20/2018
 * Time: 12:55 PM
 */

namespace Felis;


class StaffView extends View
{
    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct() {
        $this->setTitle("Felis Staff");
        $this->addLink("post/logout.php", "Log out");
    }
}