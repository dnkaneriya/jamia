<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = Yii::$app->params['apptitle'].' : Reset Passowrd';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- ############ LAYOUT START-->
<div class="center-block w-xxl w-auto-xs p-y-md">
	<div class="navbar">
		<div class="pull-center">
			<a class="navbar-brand">
				<?= Html::img('@web/img/logo.png',array("style"=>'width:25px;margin-right:10px;'));?>
				<span class="hidden-folded inline"><?= Yii::$app->params['apptitle']; ?></span>
			</a>
		</div>
    </div>
	<?php $form = ActiveForm::begin([
		'id' => 'login-form',
		'options' => ['class' => 'form-signin'],
    ]); ?>
	<div class="p-a-md box-color r box-shadow-z1 text-color m-a">
		<div class="m-b text-sm">
			<!--Sign in with your APPLY Account-->
            <h6 class="form-signin-heading">Reset Password</h6>
		</div>
		<?php
            echo \Yii::$app->getSession()->getFlash('flash_msg');
        ?>
		<div class="md-form-group float-label">
			<?= $form->field($model, 'password',['inputOptions'=>array('class'=>"md-input",'placeholder'=>'Password')])->passwordInput()->label("Password"); ?>
			<!--<input id="user-password" name="User[password]" type="password" class="md-input" required>-->
			<!--<label>Password</label>-->
		</div>
        <div class="md-form-group float-label">
			<?= $form->field($model, 'PasswordConfirm',['inputOptions'=>array('class'=>"md-input",'placeholder'=>'Password')])->passwordInput()->label("Confirm Password"); ?>
			<!--<input id="user-passwordconfirm" name="User[PasswordConfirm]" type="password" class="md-input" required>-->
			<!--<label>Confirm Password</label>-->
		</div>
		<?= Html::submitButton('Submit', ['class' => 'btn primary btn-block p-x-md', 'name' => 'login-button']) ?>
	</div>
	<?php ActiveForm::end(); ?>
</div>
<!-- ############ LAYOUT END-->