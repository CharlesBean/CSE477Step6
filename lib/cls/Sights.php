<?php
/**
 * Created by PhpStorm.
 * User: charles
 * Date: 3/20/15
 * Time: 12:48 PM
 */

class Sights extends Table {
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "sight");
    }

    /**
     * Get a sight by id
     * @param $id The sight by ID
     * @returns Sight object if successful, null otherwise.
     */
    public function get($id) {
        $sql =<<<SQL
SELECT * from $this->tableName
where id=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new Sight($statement->fetch(PDO::FETCH_ASSOC));
    }

    /**
     * Get all sights for a given user
     * @param $id The user ID
     * @returns array of Sight objects
     */
    public function getSightsForUser($id) {
        $sql =<<<SQL
SELECT * from $this->tableName
where userid=?
order by name
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($id));

        $result = array();  // Empty initial array
        foreach($statement as $row) {
            $result[] = new Sight($row);
        }

        return $result;
    }

    /**
     * @param $userid
     * @param $name
     * @param $description
     * @param $created
     * @return bool
     */
    public function createSight($userid, $name, $description, $created) {
        $sql =<<<SQL
INSERT INTO $this->tableName(userid, name, description, created)
VALUES(?, ?, ?, ?)
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($userid, $name, $description, $created));

        return true;
    }

    public function deleteSight($id) {
        $sql =<<<SQL
DELETE FROM $this->tableName
WHERE id=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($id));

        return true;
    }

}