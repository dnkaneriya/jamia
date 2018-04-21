<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Forgot Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    
<h3 class="form-title"><?= Html::encode($this->title) ?></h3>
    <!--<p>Please fill out the following fields to login:</p>-->

    <?php $form = ActiveForm::begin([
        'id' => 'forget-form',
        'options' => ['class' => 'login-form'],
        //'fieldConfig' => [
        //    //'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        //    //'labelOptions' => ['class' => 'col-lg-1 control-label'],
        //],
    ]); ?>
    <?php
        echo \Yii::$app->getSession()->getFlash('flash_msg');
    ?>
    <?= $form->field($model, 'email',['template' => "<div class=\"form-group\"><div class=\"input-icon\"><i class='fa fa-user'></i>{input}\n</div></div>",'inputOptions'=>array('placeholder'=>'Email ID')]); ?>

    
    
    <div class="forget-password">
	<?= Html::a('<button type="button" id="back-btn" class="btn"><i class="m-icon-swapleft"></i> Back</button>',['site/login']); ?>
	<?= Html::submitButton('Get Password', ['class' => 'btn btn-primary', 'name' => 'login-button','style'=>'float:right;']) ?>
	<!--<a href="/apps/productlist/web/site/login">-->
	<!--    <button type="button" id="back-btn" class="btn"><i class="m-icon-swapleft"></i> Back</button>-->
	<!--</a>-->
    </div>
    
    <?php ActiveForm::end(); ?>
    
</div>
<script>
		jQuery(document).ready(function() {
		  App.init();
		  Login.init();
		});
		
		
		$('#forget-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            ignore: "",
	            rules: {
	                "Users[email]": {
	                    required: true,
	                    email: true
	                }
	            },
			
	            messages: {
	                "Users[email]": {
	                    required: "Email is required."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   

	            },

	            highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                error.insertAfter(element.closest('.input-icon'));
	            },

	            //submitHandler: function (form) {
	            //    form.submit();
	            //}
	        });
	</script>