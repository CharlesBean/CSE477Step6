<?php
/**
 * Created by PhpStorm.
 * User: charlesbean
 * Date: 3/6/15
 * Time: 7:13 PM
 */

class Format {
    /**
     * Generate HTML for the standard page header
     * @param $title page title
	 * @return html
     */
    public static function header($title)
    {
        return <<<HTML
<header>
	<h1>
		<img src="images/right-eye.jpg" width="102" height="45" alt="Eye"> $title
	</h1>
</header>
<nav>
	<ul>
		<li><a href="./">Home</a></li>
		<li><a href="form.php">New Sight</a></li>
		<li><a href="post/logout-post.php">Log out</a></li>
	<li><form method="post" action="post/search-post.php">
		<input type="search"> <input type="submit" value="Search">
	</form></li>
	</ul>
</nav>
HTML;
    }

    /**
     * @return string footer
     */
    public static function footer() {
        return <<<HTML
<footer>
	<p>Copyright 2015, Super Sightings, Inc.</p>
</footer>
HTML;
    }
}