<?php
/**
 * Created by PhpStorm.
 * User: charles
 * Date: 3/25/15
 * Time: 6:14 PM
 */

class ValidationController {
    /**
     * Constructor
     * @param Site $site The site object
     */
    public function __construct(Site $site) {
        $this->site = $site;
    }

    /**
     * Validate a user
     * @param $validator The validator string
     * @return null or an error message
     */
    public function validate($validator) {
        $users = new Users($this->site);
        $nu = new NewUsers($this->site);

        $user = $nu->removeNewUser($validator);
        if($user === null) {
            return "Invalid validator";
        }

        $users->add($user);
        return null;
    }

    public function resetPassword($validator) {
        $users = new Users($this->site);
        $lp = new LostPasswords($this->site);

        $user = $lp->removeLostPassword($validator);
        if($user === null) {
            return "Invalid validator";
        }

        $users->resetPassword($user);
        return null;
    }

    private $site;
}