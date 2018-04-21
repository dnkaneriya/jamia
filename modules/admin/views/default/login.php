<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = Yii::$app->params['apptitle'].' : Login To Your Account';
$this->params['breadcrumbs'][] = $this->title;


$cookies = Yii::$app->request->cookies;
// get the cookie value 
$email_id = $cookies->getValue(Yii::$app->params['appcookiename'].'email');
//return default value if the cookie is not available
$password = $cookies->getValue(Yii::$app->params['appcookiename'].'password');
$no = $cookies->getValue(Yii::$app->params['appcookiename'].'turns');

for($i=1;$i<=$no;$i++){
	$email_id = base64_decode($email_id);
	$password = base64_decode($password);
}


if($email_id){$model->email = $email_id;}
if($password){$model->password = $password;}
if($email_id){$model->rememberMe = true;}


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
			Sign in with your JAMIAH Account
		</div>
		<?php
            echo \Yii::$app->getSession()->getFlash('flash_msg');
        ?>
		<div class="md-form-group float-label">
			<input id="loginform-email" name="LoginForm[email]" type="email" class="md-input" ng-model="user.email" required>
			<label>Email</label>
		</div>
		<div class="md-form-group float-label">
			<input id="loginform-password" name="LoginForm[password]" type="password" class="md-input" ng-model="user.password" required>
			<label>Password</label>
		</div>      
		<div class="m-b-md">        
			<label class="md-check">
				<input id="loginform-rememberme" name="LoginForm[rememberMe]" type="checkbox" value="1"><i class="primary"></i> Keep me signed in
			</label>
		</div>
		<?= Html::submitButton('Sign in', ['class' => 'btn primary btn-block p-x-md', 'name' => 'login-button']) ?>
	</div>
	<?php ActiveForm::end(); ?>
    <div class="p-v-lg text-center">
		<div class="m-b">
			<!--<a ui-sref="access.forgot-password" href="#/access/forgot-password" class="text-primary _600">Forgot password?</a>-->
			<a ui-sref="access.forgot-password" data-toggle="modal" href="#myModal" class="text-primary _600"> Forgot Password?</a>
		</div>
		<!--<div>Do not have an account? <a ui-sref="access.signup" href="#/access/signup" class="text-primary _600">Sign up</a></div>-->
    </div>
</div>
<!-- ############ LAYOUT END-->
<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
		<div class="modal-content box-shadow-md m-b">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Forgot Password ?</h4>
			</div>
			<!--form-->
			<?php $form = ActiveForm::begin([
					'id' => 'forgot-form',
					'options' => ['class' => ''],
					'action' => ['default/forgotpassword'],
					'enableClientValidation' => true,
					'validateOnSubmit' => true,
					'enableAjaxValidation' => true,
				]); ?>
			<div class="modal-body">
				<p>Enter your e-mail address below to reset your password.</p>
                <?= $form->field($user1, 'email',['inputOptions'=>array('placeholder'=>'Email ID','autocomplete'=>"off",'class'=>"form-control placeholder-no-fix")])->label(false); ?>    
            </div>
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-default dark-white" type="button">Cancel</button>
				<?= Html::submitButton('Submit', ['class' => 'btn primary btn-success']) ?>
			</div>
			<?php ActiveForm::end(); ?>
			<!--end form-->
		</div>
	</div>
</div>
<script>
	jQuery(document).ready(function() {
		//$('input').focus();
		setTimeout(function() { $("input:text:visible:first").focus(); }, 100);
		
		//App.init();
		//Login.init(
		//    jQuery('#login-form').validate({
		//        errorElement: 'span', //default input error message container
		//        errorClass: 'help-block', // default input error message class
		//        focusInvalid: false, // do not focus the last invalid input
		//        ignore: "",
		//        rules: {
		//            "LoginForm[email_id]": {
		//                required: true,
		//                email: true,
		//            },
		//            "LoginForm[password]": {
		//                required: true,
		//            },
		//        },
		//        message:{
		//            "LoginForm[email_id]": {
		//                required: 'Email  is required',
		//                email: 'Invalid email format',
		//            },
		//        },
		//
		//        highlight: function (element) { // hightlight error inputs
		//            $(element)
		//                .closest('.form-group').addClass('has-error'); // set error class to the control group
		//        },
		//
		//        unhighlight: function (element) { // revert the change done by hightlight
		//            $(element)
		//                .closest('.form-group').removeClass('has-error'); // set error class to the control group
		//        },
		//
		//        success: function (label) {
		//            label
		//                .closest('.form-group').removeClass('has-error'); // set success class to the control group            
		//        },
		//    })
		//);
	});
</script>