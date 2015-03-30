<?php
/** @file
 * @brief Empty unit testing template/database version
 * @cond 
 * @brief Unit tests for the class 
 */

class EmailMock extends Email {
    public function mail($to, $subject, $message, $headers)
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->headers = $headers;
    }

    public $to;
    public $subject;
    public $message;
    public $headers;
}

class NewUsersTest extends \PHPUnit_Extensions_Database_TestCase
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
        return $this->createFlatXMLDataSet(dirname(__FILE__) . '/db/newuser.xml');
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
        $users = new NewUsers(self::$site);
        $this->assertInstanceOf('NewUsers', $users);
    }

    public function test_newUser() {
        $nu = new NewUsers(self::$site);

        $mailer = new EmailMock();
        $this->assertContains("must be at least 8 characters long",
            $nu->newUser("", "", "", "ab", "ab", $mailer));
        $this->assertContains("Passwords are not equal",
            $nu->newUser("", "", "", "abcdefgh", "abcdefgg", $mailer));

        $this->assertContains("User ID already exists",
            $nu->newUser("dudette", "", "", "abcdefgh", "abcdefgh", $mailer));
        $this->assertContains("Email address already exists",
            $nu->newUser("dudette1", "", "dudess@dude.com", "abcdefgh", "abcdefgh", $mailer));

        $nu->newUser("bob", "Bob the Builder", "bob@pbs.org", "abcdefgh", "abcdefgh", $mailer);
        $table = $nu->getTableName();
        $sql = <<<SQL
SELECT * from $table where email='bob@pbs.org'
SQL;

        $stmt = $nu->pdo()->prepare($sql);
        $stmt->execute(array());
        $this->assertEquals(1, $stmt->rowCount());

        $this->assertEquals("bob@pbs.org", $mailer->to);
        $this->assertEquals("Confirm your email", $mailer->subject);
    }

    public function test_removeNewUser() {
        $nu = new NewUsers(self::$site);

        // This should get the user
        $newuser = $nu->removeNewUser("abcdefghijklmnopqrstuvwxyzaaaaaa");
        $this->assertEquals("barb", $newuser['userid']);
        $this->assertEquals("barb@space.com", $newuser['email']);

        // Second time it should be removed
        $newuser = $nu->removeNewUser("abcdefghijklmnopqrstuvwxyzaaaaaa");
        $this->assertNull($newuser);
    }
}

/// @endcond

