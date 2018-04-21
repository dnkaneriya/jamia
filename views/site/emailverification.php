<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = Yii::$app->params['apptitle'].' : Email ID Verification';
$this->params['breadcrumbs'][] = $this->title;
?>
<form id="login-form" class="form-signin" style="max-width: 530px;">
        <h2 class="form-signin-heading">
            <?= Html::img('@web/img/logo.png',array("style"=>'width:25px;margin-right:10px;'));?>
            <?= Yii::$app->params['apptitle'] . " : Email ID Verification"; ?>
        </h2>
        <div class="login-wrap">
            <?php
                echo \Yii::$app->getSession()->getFlash('flash_msg');
            ?>
        </div>
</form>		
<script>
    $(document).ready(function(){
        $('.alert-dismissable').removeClass('alert-dismissable');
    });
</script>
