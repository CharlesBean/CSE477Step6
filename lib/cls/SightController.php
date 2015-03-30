<?php
/**
 * Created by PhpStorm.
 * User: charles
 * Date: 3/20/15
 * Time: 5:10 PM
 */

/**
 * Class SightController
 */
class SightController {
    /**
     * Constructor
     * @param $site site we are a member of
     * @param $request $_REQUEST array
     * @param $session
     */
    public function __construct(Site $site, $request, $session) {
        $this->site = $site;
        $this->sights = new Sights($site);

        if (isset($session['user'])) {
            $this->user = $session['user'];
        }

        if (isset($request['userid']) && isset($request['name']) && isset($request['description']) && isset($request['created'])) {
            $this->createSight($request['userid'], $request['name'], $request['description'], $request['created']);
        }

        if (isset($request['deleteID'])) {
            $this->deleteSight($request['deleteID']);
        }
    }

    /**
     * @param $userid
     * @param $name
     * @param $description
     * @param $created
     * @return bool
     */
    public function createSight($userid, $name, $description, $created) {
        return $this->sights->createSight($userid, $name, $description, $created);
    }

    public function deleteSight($id) {
        $userSights = $this->sights->getSightsForUser($this->user->getId());

        foreach ($userSights as $sight) {
            if ($sight->getId() == $id) {
                return $this->sights->deleteSight($id);
            }
        }

        return false;
    }

    private $site;
    private $sights;
    private $user;
}