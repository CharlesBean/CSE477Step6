<?php
/**
 * Created by PhpStorm.
 * User: charles
 * Date: 3/25/15
 * Time: 3:34 PM
 */

class LostPasswords extends Table {
    /**
     * Constructor
     * @param $site Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "lostpassword");
    }

    public function newLostPassword($email, $password1, $password2, Email $mailer) {
        // Ensure the passwords are valid and equal
        if(strlen($password1) < 8) {
            return "Passwords must be at least 8 characters long";
        }

        if($password1 !== $password2) {
            return "Passwords are not equal";
        }

        // Ensure the email exists
        $users = new Users($this->site);
        if(!$users->exists($email)) {
            return "Email address does not exist. Please ensure you have the correct email for this account.";
        }

        // Create a validator key
        $validator = $this->createValidator();

        // Create salt and encrypted password
        $salt = self::random_salt();
        $hash = hash("sha256", $password1 . $salt);

        // Add a record to the lostpassword table
        $sql = <<<SQL
REPLACE INTO $this->tableName(email, password, salt, validator)
values(?, ?, ?, ?)
SQL;

        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($email, $hash, $salt, $validator));


        // Send email with the validator in it
        $link = "http://webdev.cse.msu.edu" . $this->site->getRoot() . '/lostpassword-validate.php?v=' . $validator;

        $from = $this->site->getEmail();

        $subject = "Confirm your email";
        $message = <<<MSG
<html>
<p>Password Reset</p>

<p>In order to reset your password,
please verify your email address by visiting the following link:</p>

<p><a href="$link">$link</a></p>
</html>
MSG;
        $headers = "MIME-Version: 1.0\r\nContent-type: text/html; charset=iso=8859-1\r\nFrom: $from\r\n";
        $mailer->mail($email, $subject, $message, $headers);

    }

    /**
     * @brief Generate a random validator string of characters
     * @param $len Length to generate, default is 32
     * @returns Validator string
     */
    private function createValidator($len = 32) {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $l = strlen($chars) - 1;
        $str = '';
        for ($i = 0; $i < $len; ++$i) {
            $str .= $chars[rand(0, $l)];
        }
        return $str;
    }

    /**
     * @brief Generate a random salt string of characters for password salting
     * @param $len Length to generate, default is 16
     * @returns Salt string
     */
    public static function random_salt($len = 16) {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789`~!@#$%^&*()-=_+';
        $l = strlen($chars) - 1;
        $str = '';
        for ($i = 0; $i < $len; ++$i) {
            $str .= $chars[rand(0, $l)];
        }
        return $str;
    }

    /**
     * Get a new user record, removing it when we are done.
     * @param $validator The validator string
     * @returns Array with key for each column or null if the validator does not exist.
     */
    public function removeLostPassword($validator) {
        // Getting the user
        $sql =<<<SQL
SELECT * from $this->tableName
where validator=?
SQL;

        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($validator));
        if($statement->rowCount() === 0) {
            return null;
        }

        // Creating return array
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        // Removing the lost password from lp table
        $sql = <<<SQL
DELETE FROM $this->tableName
WHERE validator=?
SQL;

        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($validator));

        return $row;
    }
}