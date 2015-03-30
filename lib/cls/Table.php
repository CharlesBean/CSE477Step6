<?php
/**
 * Created by PhpStorm.
 * User: charlesbean
 * Date: 3/14/15
 * Time: 11:33 AM
 */

/**
 * @file
 * @brief Base class for all table classes
 */

/**
 * Base class for all table classes
 */
class Table {
    /**
     * Constructor
     * @param Site $site The site object
     * @param $name The base table name
     */
    public function __construct(Site $site, $name) {
        $this->site = $site;
        $this->tableName = $site->getTablePrefix() . $name;
    }

    /**
     * Get the database table name
     * @return The table name
     */
    public function getTableName() {
        return $this->tableName;
    }

    /**
     * Database connection function
     * @returns PDO object that connects to the database
     */
    public function pdo() {
        return $this->site->pdo();
    }

    protected $site;        ///< The Site object
    protected $tableName;   ///< The table name to use
}