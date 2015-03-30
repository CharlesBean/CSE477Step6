<?php
/**
 * Created by PhpStorm.
 * User: charles
 * Date: 3/20/15
 * Time: 12:39 PM
 */

$login = false;
require '../lib/site.inc.php';

unset($_SESSION['user']);

header("location: ../login.php");