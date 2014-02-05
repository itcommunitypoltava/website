<?php
/**
 * Controller for managing User model.
 *
 * This is the UserController verbatim generated using Gii module.
 * Almost no changes were done to the code.
 *
 * @package YiiBoilerplate\Frontend
 */
class UserController extends FrontendController
{
    /**
     * Creates a new User during registration process.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new User;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['User']))
        {
            $model->attributes=$_POST['User'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create', compact('model'));
    }
}