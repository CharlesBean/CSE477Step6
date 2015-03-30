<?php
/**
 * Created by PhpStorm.
 * User: charles
 * Date: 3/20/15
 * Time: 5:56 PM
 */

require '../lib/site.inc.php';

$controller = new SightController($site, $_REQUEST, $_SESSION);

header("location: ../index.php");