<?php
/**
 * Created by PhpStorm.
 * User: charlesbean
 * Date: 3/6/15
 * Time: 9:19 PM
 */

/**
 * Function to localize our site
 * @param $site The Site object
 */
return function(Site $site) {
    // Set the time zone
    date_default_timezone_set('America/Detroit');

    $site->setEmail('beanchar@cse.msu.edu');
    $site->setRoot('/~beanchar/step6');
    $site->dbConfigure('mysql:host=mysql-user.cse.msu.edu;dbname=beanchar',
        'beanchar',             // Database user
        'A44600967',            // Database password
        's6_');                    // Table prefix
};
