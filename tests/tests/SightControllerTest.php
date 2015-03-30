<?php
/** @file
 * @brief Empty unit testing template/database version
 * @cond 
 * @brief Unit tests for the class 
 */

class EmptyDBTest extends \PHPUnit_Extensions_Database_TestCase
{
    private static $site;

    public static function setUpBeforeClass() {
        self::$site = new Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }

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
        return $this->createFlatXMLDataSet(dirname(__FILE__) . '/db/full.xml');
    }

    public function test_constructor() {
        $controller = new SightController(self::$site, array(), array());
        $this->assertInstanceOf('SightController', $controller);
    }

    public function test_createSight() {
        $controller = new SightController(self::$site, array(), array());

        $sightCreated = $controller->createSight(3, "Tom Cruise", "I am tom", "2015-02-20 05-06-12");

        $this->assertTrue($sightCreated);
    }

    public function test_deleteSight() {
//        $users = new Users(self::$site);
//        $user = $users->login('beanchar', 'password');
//
//        $controller = new SightController(self::$site, array(), array(
//            'user' => $user
//        ));
//
//        $sightCreated = $controller->createSight(3, "Tom Cruise", "I am tom", "2015-02-20 05-06-12");
//
//        $this->assertTrue($sightCreated);
//
//        $sightDeleted = $controller->deleteSight(48);
//
//        $this->assertTrue($sightDeleted);
    }
}

/// @endcond
?>
