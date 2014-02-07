<?php
/**
 * Basic "kitchen sink" controller for frontend.
 * It was configured to be accessible by `/site` route, not the `/frontendSite` one!
 *
 * @package YiiBoilerplate\Frontend
 */
class FrontendSiteController extends FrontendController
{
	/**
     * Actions attached to this controller
     *
	 * @return array
	 */
	public function actions()
    {
		return [
            'index' => 'LandingPageAction',
            'error' =>  'SimpleErrorAction',
            'login' => 'PasswordLoginAction',
            'logout' => 'UserLogoutAction',
		];
	}
}