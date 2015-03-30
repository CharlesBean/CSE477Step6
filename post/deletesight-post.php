<?php
/**
 * Created by PhpStorm.
 * User: charles
 * Date: 3/20/15
 * Time: 6:38 PM
 */

require '../lib/site.inc.php';

$controller = new SightController($site, $_REQUEST, $_SESSION);

header("location: ../index.php");