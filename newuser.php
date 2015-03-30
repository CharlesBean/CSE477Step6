<?php
$login = false;
require_once "lib/site.inc.php";
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Sightings New User</title>
    <link href="sightings.css" type="text/css" rel="stylesheet" />
</head>
<body>
<!-- Header and navigation -->
<header><h1><img src="images/right-eye.jpg" width="102" height="45" alt="Eye"> Sightings</h1></header>

<div id="login">
<h2>Create New User</h2>
<form method="post" action="post/newuser-post.php">
    <?php
    if(isset($_SESSION['newuser-error'])) {
        echo "<p>" . $_SESSION['newuser-error'] . "</p>";
        unset($_SESSION['newuser-error']);
    }
    ?>
    <p>
        <label for="userid">User ID:</label><br>
        <input type="text" id="userid" name="userid">
    </p>
    <p>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name">
    </p>
    <p>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email">
    </p>
    <p>
        <label for="password1">Password:</label><br>
        <input type="password" id="password1" name="password1">
    </p>
    <p>
        <label for="password2">Password Again:</label><br>
        <input type="password" id="password2" name="password2">
    </p>
    <p>
        <label for="secret">Secret:</label><br>
        <input type="password" id="secret" name="secret">
    </p>
    <p><input type="submit"></p>
    <p><a href="login.php">Return to Login</a></p>
</form>
</div>
</body>
</html>