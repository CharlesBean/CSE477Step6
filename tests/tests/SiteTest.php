<?php
/** @file
 * @brief Empty unit testing template
 * @cond 
 * @brief Unit tests for the class 
 */
class SiteTest extends \PHPUnit_Framework_TestCase
{
	public function testEmailGetterAndSetter() {
		$site = new Site();

		$this->assertEquals($site->getEmail(), null);
		$site->setEmail("test");
		$this->assertEquals($site->getEmail(), "test");
	}

	public function testRootGetterAndSetter() {
		$site = new Site();

		$this->assertEquals($site->getRoot(), null);
		$site->setRoot("test");
		$this->assertEquals($site->getRoot(), "test");
	}

	public function testTablePrefixGetter() {
		$site = new Site();

		$this->assertEquals($site->getTablePrefix(), null);
	}

	public function test_localize() {
		$site = new Site();
		$localize = require 'localize.inc.php';
		if(is_callable($localize)) {
			$localize($site);
		}
		$this->assertEquals('test6_', $site->getTablePrefix());
	}
}

/// @endcond