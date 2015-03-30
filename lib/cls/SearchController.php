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
class SearchController {
    /**
     * Constructor
     * @param $site site we are a member of
     * @param $request $_REQUEST array
     * @param $session
     */
    public function __construct(Site $site, $request, $session) {
        $this->site = $site;
        $this->sights = new Sights($site);
        $this->users = new Users($site);
    }
    // TODO....

    private $site;
    private $sights;
    private $users;
}