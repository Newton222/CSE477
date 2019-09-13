<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 3/20/2018
 * Time: 2:16 PM
 */

/**
 * Function to localize our site
 * @param $site The Site object
 */
return function(Felis\Site $site) {
    // Set the time zone
    date_default_timezone_set('America/Detroit');

    $site->setEmail('xuchensh@cse.msu.edu');
    $site->setRoot('/~xuchensh/step8');
    $site->dbConfigure('mysql:host=mysql-user.cse.msu.edu;dbname=xuchensh',
        'xuchensh',       // Database user
        'Xcs23456',     // Database password
        'test8_');            // Table prefix
};
