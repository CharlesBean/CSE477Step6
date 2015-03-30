<?php
/**
 * Created by PhpStorm.
 * User: charles
 * Date: 3/20/15
 * Time: 12:36 PM
 */

$login = true;
require '../lib/site.inc.php';

if(isset($_POST['search'])) {
    $controller = new SearchController($site, $_REQUEST, $_SESSION);

    // TODO...
//    $user = $users->login($_POST['user'], $_POST['password']);
//    if($user !== null) {
//        $_SESSION['user'] = $user;
//        header("location: ../");
//        exit;
//    }
}

header("location: ../login.php");