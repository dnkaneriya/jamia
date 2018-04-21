<?php
    use yii\helpers\Html;
    
    $controller = strtolower(Yii::$app->controller->id);
    $action = strtolower(Yii::$app->controller->action->id);
    
    $dash = '';
    
    if($controller == 'site' && $action == 'index'){
        $dash = 'active';
    }
?>
<!--header start-->
<div class="navbar">
    <a data-toggle="collapse" data-target="#navbar-3" class="navbar-item pull-right hidden-md-up m-a-0 m-l">
        <i class="material-icons">&#xe5d2;</i>
    </a>
	<!-- nabar right -->
    <ul class="nav navbar-nav pull-right">
        <li class="nav-item dropdown">
            <a href class="nav-link dropdown-toggle clear" data-toggle="dropdown">
                <span class="hidden-md-down nav-text m-r-sm text-right">
                    <?php
                        $username = Yii::$app->user->identity->email;
                        $user_id = Yii::$app->user->identity->id;
                    ?>
                    <span class="block l-h-1x _500"><?php if(isset($username) && $username!=null) echo $username?></span>
                    <!--<small class="block l-h-1x text-muted"><i class="material-icons text-md">&#xe0c8;</i> Los Angeles, CA</small>-->
                </span>
            </a>
            <div class="dropdown-menu pull-right dropdown-menu-scale">
                <?php /*<?= Html::a('<span><i class="fa fa-user"></i> &nbsp;&nbsp; My Profile</span>',["/site/profile"],["class"=>"dropdown-item", "ui-sref"=>"app.page.profile"]) ?>*/ ?>
                <!--<div class="dropdown-divider"></div>-->
                <?= Html::a('<i class="fa fa-key"></i> &nbsp;&nbsp; Sign Out',["/admin/default/logout"],["class"=>"dropdown-item", "ui-sref"=>"access.signin"]) ?>
            </div>
        </li>
    </ul>
</div>