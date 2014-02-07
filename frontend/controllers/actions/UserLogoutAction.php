<?php
/**
 * Logs out the current user and redirect to homepage.
 *
 * @package YiiBoilerplate\Frontend
 */
class UserLogoutAction extends CAction
{
    public function run()
    {
        Yii::app()->user->logout();
        $this->controller->redirect(Yii::app()->homeUrl);
    }
}