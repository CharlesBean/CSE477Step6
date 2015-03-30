<?php
/**
 * Created by PhpStorm.
 * User: charles
 * Date: 3/20/15
 * Time: 12:59 PM
 */

/**
 * Class SightView View class for a sight
 */
class SightView {
    /**
     * Constructor
     * @param $site site we are a member of
     * @param $request $_REQUEST array
     * @param $session
     */
    public function __construct(Site $site, $request, $session) {
        $this->site = $site;
        $sights = new Sights($site);

        if (isset($session['user'])) {
            $this->user = $session['user'];
        }

        if (isset($request['i']) && $sights->get($request['i'])) {
            $this->sight = $sights->get($request['i']);
        } else {
            header("location: index.php");
        }
    }

    /**
     * @return Get the name of the sight
     */
    public function getName() {
        return $this->sight->getName();
    }

    /**
     * @return Description of the sight
     */
    public function getDescription() {
        return $this->sight->getDescription();
    }

    /**
     * @return HTML for the Super Sighter block
     */
    public function presentSuper() {
        $userid = $this->sight->getUserid();

        $users = new Users($this->site);
        $user = $users->get($userid);
        $username = $user->getName();

        $html = <<<HTML
<div class="options">
<h2>SUPER SIGHTER</h2>
<p><a href="./?i=$userid">$username</a></p>
<p>Since 6-25-2014</p>
</div>
HTML;

        return $html;
    }

    /**
     * @return HTML for the Stats block
     */
    public function presentStats() {
        return '';
    }

    /**
     * @return HTML for all of the sightings
     */
    public function presentSightings() {
        return '';
    }

    public function presentOwnerControls() {
        $sights = new Sights($this->site);
        $userid = $this->user->getId();
        $sightID = $this->sight->getId();
        $sightUserID = $this->sight->getUserid();
        $userSights = $sights->getSightsForUser($sightUserID);


        $html = <<<HTML
<div class="options">
<h2>OPTIONS</h2>
<p><a href="post/deletesight-post.php?deleteID=$sightID">Delete Sight</a></p>
</div>
HTML;

        foreach ($userSights as $sight) {
            if ($sight->getUserid() == $userid) {
                return $html;
            }
        }

        return null;
    }

    private $sight;
    private $site;
    private $user;
}