<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = Yii::$app->params['apptitle'] . ' Email Verification';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="center-block w-xxl w-auto-xs p-y-md">
    <div class="navbar">
        <div class="pull-center">
            <a class="navbar-brand">
                <?= Html::img('@web/img/logo.png',array("style"=>'width:25px;margin-right:10px;'));?>
                <span class="hidden-folded inline"><?= Yii::$app->params['apptitle'] . ' Email Verification'; ?></span>
            </a>
        </div>
    </div>
    <form id="login-form" class="form-signin" style="max-width: 530px;">
        <div class="login-wrap">
            <?php
                $a = \Yii::$app->getSession()->getFlash('flash_msg');
                    if($a){
                        echo $a;
                    }else{
                        $msg = 'You are not allowed to access this page.'; //Yii::$app->params['error_forgot_password_link_expired'];
                        echo \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                    }
            ?>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $('.alert-dismissable').removeClass('alert-dismissable');
        $('.fa-times').removeClass('fa-times');
    });
</script>
