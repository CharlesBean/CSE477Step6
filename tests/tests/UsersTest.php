<?php
/** @file
 * @brief Empty unit testing template/database version
 * @cond 
 * @brief Unit tests for the class 
 */

class UsersTest extends \PHPUnit_Extensions_Database_TestCase
{
	/**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    public function getConnection()
    {
        return $this->createDefaultDBConnection(self::$site->pdo(), 'beanchar');
    }

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        return $this->createFlatXMLDataSet(dirname(__FILE__) . '/db/user.xml');
    }

    private static $site;

    public static function setUpBeforeClass() {
        self::$site = new Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }

    public function test_construct() {
        $users = new Users(self::$site);
        $this->assertInstanceOf('Users', $users);
    }

    public function test_login() {
        $users = new Users(self::$site);

        // Test a valid login based on user ID
        $user = $users->login("dudette", "87654321");
        $this->assertInstanceOf("User", $user);

        // Test a valid login based on email address
        $user = $users->login("dudess@dude.com", "87654321");
        $this->assertInstanceOf("User", $user);

        // Test a failed login
        $user = $users->login("dudess@dude.com", "wrongpw");
        $this->assertNull($user);


        // Login
        $user = $users->login("dudess@dude.com", "87654321");

        // Test id
        $this->assertEquals($user->getId(), 7);

        // Test name
        $this->assertEquals("The Dudess", $user->getName());

        // Test joined
        $this->assertEquals(strtotime("2015-01-22 23:50:26"), $user->getJoined());

        // Test role
        $this->assertEquals(1, $user->getRole());

        // Test userid
        $this->assertEquals("dudette", $user->getUserid());

        // Test email
        $this->assertEquals("dudess@dude.com", $user->getEmail());
    }

    public function test_getID() {
        $users = new Users(self::$site);

        // Test a failed login
        $user = $users->get(-1);
        $this->assertNull($user);

        // Test a valid login based on user ID
        $user = $users->get(7);
        $this->assertInstanceOf("User", $user);


        // Test id
        $this->assertEquals($user->getId(), 7);

        // Test name
        $this->assertEquals("The Dudess", $user->getName());

        // Test joined
        $this->assertEquals(strtotime("2015-01-22 23:50:26"), $user->getJoined());

        // Test role
        $this->assertEquals(1, $user->getRole());

        // Test userid
        $this->assertEquals("dudette", $user->getUserid());

        // Test email
        $this->assertEquals("dudess@dude.com", $user->getEmail());
    }

    public function test_exists() {
        $users = new Users(self::$site);

        $this->assertTrue($users->exists("dudess@dude.com"));
        $this->assertTrue($users->exists("dudette"));
        $this->assertTrue($users->exists("cbowen"));
        $this->assertTrue($users->exists("cbowen@cse.msu.edu"));
        $this->assertFalse($users->exists("nobody"));
        $this->assertFalse($users->exists("7"));
    }

    public function test_add() {
        $user['userid'] = "harold";
        $user['name'] = "Good old Harold";
        $user['email'] = "harold@msu.edu";
        $user['password'] = "e7c58adcd7da9448a535b358d1b21c787f039155d713c9d2b39621c702504326";
        $user['joined'] = "2015-03-15 19:19:08";
        $user['salt'] = ")8J2zwSFy7nfCg81";

        $users = new Users(self::$site);
        $users->add($user);

        // Test a valid login based on user ID
        $user = $users->login("harold", "harold");
        $this->assertInstanceOf("User", $user);
        $this->assertEquals('harold', $user->getUserid());
        $this->assertEquals('Good old Harold', $user->getName());
        $this->assertEquals('harold@msu.edu', $user->getEmail());
        $this->assertEquals(1, $user->getRole());
    }
}

/// @endcond

