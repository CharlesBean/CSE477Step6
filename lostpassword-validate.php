<?php
/**
 * Created by PhpStorm.
 * User: charles
 * Date: 3/25/15
 * Time: 5:42 PM
 */

$login = false;
require_once "lib/site.inc.php";

$controller = new ValidationController($site);
$msg = $controller->resetPassword($_GET['v']);

header("location: login.php");
exit;
