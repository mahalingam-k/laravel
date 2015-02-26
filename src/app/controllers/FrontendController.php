<?php


class FrontendController extends BaseController {

    protected $activePage = null;

    /**
     * Constructor
     **/
    public function __construct()
    {
        $routeAction = Route::currentRouteAction();
        switch($routeAction) {
            case 'SearchController@showBrowse':
                $this->activePage = 'browse';
                break;
            default:
                $this->activePage = 'simple';
        }
    }
}