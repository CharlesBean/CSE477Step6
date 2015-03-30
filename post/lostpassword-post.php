<?php
/**
 * Created by PhpStorm.
 * User: charles
 * Date: 3/25/15
 * Time: 4:40 PM
 */

$login = false;
require_once "../lib/site.inc.php";

unset($_SESSION['newuser-error']);

$lp = new LostPasswords($site);
$msg = $lp->newLostPassword(
    strip_tags($_POST['email']),
    strip_tags($_POST['password1']),
    strip_tags($_POST['password2']),
    new Email());

if($msg !== null) {
    $_SESSION['newuser-error'] = $msg;
    header("location: ../lostpassword.php");
    exit;
}

header("location: ../validating.php");
exit;