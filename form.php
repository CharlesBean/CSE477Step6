<?php
require 'lib/site.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Data Entry</title>
	<link rel="stylesheet" type="text/css" href="sightings.css" media="screen" />
</head>
<body>

<?php echo Format::header("Form"); ?>

<!-- Main body of page -->
<div class="main">
	<!-- Left side items -->
	<div class="left">
	<!-- If you don't put something the column disappears -->
	<p>Enter a new something or other...</p>

	</div>

	<!-- Right side items -->
	<div class="right">
		<div class="form">
			<h2>Data Entry Form</h2>
			<form action="post/addsight-post.php">
				<h3>Userid</h3>
				<p><input type="text" name="userid"></p>
				<h3>Name</h3>
				<p><input type="text" name="name"></p>
				<h3>Description</h3>
				<p><input type="text" name="description"></p>
				<h3>Created</h3>
				<p><input type="text" name="created"></p>

				<p><input type="submit" value="Add Sight"></p>
			</form>
		</div>
	</div>

</div>

<?= Format::footer(); ?>

</body>
</html>
