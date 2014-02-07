<?php
/**
 * @var FrontendController $this
 * @var FrontendLoginForm $model
 * @var CActiveForm $form
 */

$this->pageTitle = Yii::app()->name . ' - Login';
?>

<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        <?php  $form=$this->beginWidget('CActiveForm', array(
            'id' => 'registration-form',
            'enableAjaxValidation' => false,
            'htmlOptions'=> array(
                'role' => 'form',
                'enctype' => 'multipart/form-data',
            )
        )); ?>
            <fieldset>
                <h2>Please Sign In</h2>
                <hr class="colorgraph">
                <!-- errors -->
                <?php  if(CHtml::errorSummary($model)): ?>
                    <div class="alert alert-danger">
                        <?php echo CHtml::errorSummary($model); ?>
                    </div>
                <?php  endif; ?>
                <div class="form-group <?php if($form->error($model,'username'))echo'has-error';?>">
                    <?= $form->textField($model, 'username',['class'=>'form-control input-lg','placeholder'=>'Email Address']); ?>
                </div>
                <div class="form-group <?php if($form->error($model,'password'))echo'has-error';?>">
                    <?= $form->passwordField($model, 'password',['class'=>'form-control input-lg','placeholder'=>'Password']); ?>
                </div>
				<span class="button-checkbox">
					<button type="button" class="btn" data-color="info">Remember Me</button>
                    <?= $form->checkBox($model, 'rememberMe', ['checked'=>'checked', 'class'=>'hidden'])?>
					<a href="/forgotpassword" class="btn btn-link pull-right">Forgot Password?</a>
				</span>
                <hr class="colorgraph">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <input type="submit" class="btn btn-lg btn-success btn-block" value="Sign In">
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <a href="/register" class="btn btn-lg btn-primary btn-block">Register</a>
                    </div>
                </div>
            </fieldset>
        <?php  $this->endWidget(); ?>
    </div>
</div>