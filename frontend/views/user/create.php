<?php
/**
 * User registration page
 *
 * @var UserController $this
 * @var User $model
 * @var CActiveForm $form
 */
$this->pageTitle=Yii::app()->name . ' - ' . Yii::t('user', 'Register');
?>

<!-- success message -->
<?php  if(Yii::app()->user->hasFlash('success')): ?>
    <div class="row">
        <div class="alert alert-success" style="margin:30px 0 0;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
    </div>
<?php  else: ?>

<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        <!-- registration form -->
        <?php  $form=$this->beginWidget('CActiveForm', array(
            'id' => 'registration-form',
            'enableAjaxValidation' => false,
            'htmlOptions'=> array(
                'role' => 'form',
                'enctype' => 'multipart/form-data',
            )
        )); ?>
            <h2>Please Sign Up <small>It's free and always will be.</small></h2>
            <hr class="colorgraph">

            <!-- errors -->
            <?php  if(CHtml::errorSummary($model)): ?>
                <div class="alert alert-danger">
                    <?php echo CHtml::errorSummary($model); ?>
                </div>
            <?php  endif; ?>

            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group <?php if($form->error($model,'firstname'))echo'has-error';?>">
                        <?php echo $form->textField($model,'firstname', array('class' => 'form-control input-lg', 'placeholder' => 'First Name', 'tabindex' => '1')); ?>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group <?php if($form->error($model,'lastname'))echo'has-error';?>">
                        <?php echo $form->textField($model,'lastname', array('class' => 'form-control input-lg', 'placeholder' => 'Last Name', 'tabindex' => '2')); ?>
                    </div>
                </div>
            </div>
            <div class="form-group <?php if($form->error($model,'username'))echo'has-error';?>">
                <?php echo $form->textField($model,'username', array('class' => 'form-control input-lg', 'placeholder' => 'User Name', 'tabindex' => '3')); ?>
            </div>
            <div class="form-group <?php if($form->error($model,'email'))echo'has-error';?>">
                <?php echo $form->textField($model,'email', array('class' => 'form-control input-lg', 'placeholder' => 'Email Address', 'tabindex' => '4')); ?>
            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group <?php if($form->error($model,'password'))echo'has-error';?>">
                        <?php echo $form->passwordField($model,'password', array('class' => 'form-control input-lg', 'placeholder' => 'Password', 'tabindex' => '5')); ?>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group <?php if($form->error($model,'passwordConfirm'))echo'has-error';?>">
                        <?php echo $form->passwordField($model,'passwordConfirm', array('class' => 'form-control input-lg', 'placeholder' => 'Confirm Password', 'tabindex' => '6')); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3">
                <span class="button-checkbox">
                    <button type="button" class="btn" data-color="info" tabindex="7">I Agree</button>
                    <input type="checkbox" name="User[agree]" id="User_agree" class="hidden" value="1">
                </span>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9">
                    By clicking <strong class="label label-primary">Register</strong>, you agree to the <a href="#" data-toggle="modal" data-target="#t_and_c_m">Terms and Conditions</a> set out by this site, including our Cookie Use.
                </div>
            </div>

            <hr class="colorgraph">
            <div class="row">
                <div class="col-xs-6 col-md-6">
                    <input type="hidden" name="User[agree]" id="User_agree" value="" />
                    <?php echo CHtml::submitButton(Yii::t('user', 'Register'), array('class' => 'btn btn-primary btn-block btn-lg', 'tabindex' => '7')); ?>
                </div>
                <div class="col-xs-6 col-md-6"><a href="/login" class="btn btn-success btn-block btn-lg">Sign In</a></div>
            </div>
        <?php  $this->endWidget(); ?>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
            </div>
            <div class="modal-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">I Agree</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php  endif; ?>