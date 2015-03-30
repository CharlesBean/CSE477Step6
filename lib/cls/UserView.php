<?php
/**
 * Created by PhpStorm.
 * User: charles
 * Date: 3/20/15
 * Time: 3:28 PM
 */

class UserView {
    /**
     * Constructor
     * @param $site site we are a member of
     * @param $user
     * @param $request $_REQUEST array
     */
    public function __construct(Site $site, User $user=null, $request) {
        $this->site = $site;
        $users = new Users($site);

        if (isset($request['i']) && $users->get($request['i'])){
            $this->user = $users->get($request['i']);
        } else {
            $this->user = $user;
        }
    }

    /**
     * @return get the name of the user
     */
    public function getName() {
        return $this->user->getName();
    }

    public function presentSights() {
        $sights = new Sights($this->site);
        $userSights = $sights->getSightsForUser($this->user->getId());

        $html = '<div class="options"><h2>SIGHTS</h2>';

        foreach ($userSights as $sight) {
            $sightID = $sight->getId();
            $sightName = $sight->getName();

            $html .= "<p><a href='sight.php?i=$sightID'>$sightName</a></p>";
        }

        $html .= '</div>';

        if (sizeof($userSights) > 0) {
            return $html;
        }

        return null;
    }

    private $user;
    private $site;
}