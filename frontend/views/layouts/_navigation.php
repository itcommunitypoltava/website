<?php
/**
 * Top menu definition.
 *
 * @var FrontendController $this
 */
?>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">IT Community</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="/site/index">Home</a></li>
                <?php if(Yii::app()->user->isGuest):?>
                <li><a href="/register">Register</a></li>
                <li><a href="/login">Login</a></li>
                <?php endif;?>
                <?php if(!Yii::app()->user->isGuest):?>
                    <li><a href="/logout">Logout</a></li>
                <?php endif;?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

