<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Subscribers;

$model = new Subscribers();
?>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/scripts/jquery.validate.min.js"></script>
<!-- Email Section -->
<span class="anchor" id="fale"></span>
<section class="email-section padd-top20 padd-bot80 wow fadeIn" data-wow-delay="0.2s">
	<div class="container">
		<div class="text-center">
			<div class="section-title text-center Hero_Light c-primary mar-bot45">
				<h2>FALE CONOSCO</h2>
			</div>
			<?php $form = ActiveForm::begin([
						'id'=>'contact-form',
						//'layout'=>'horizontal',
						'options' => ['class' => 'form-email'],
						'action' => ['site/contact'],
						'fieldConfig' => [
							//'template' => " <div class=\"control-group\">{lable}<div class=\"controls\">{input}</div>\n<div class=\"col-lg-7\">{error}</div></div>",
							'enableClientValidation'=>false,
							'enableAjaxValidation'=>false,
						],
					]);
			?>
				<div class="row">
					<!--<div class="form-group col-sm-6" id="subscriber_name" style="display: none;">-->
					<div class="form-group col-sm-6" id="contact_name">
						<input type="text" name="Contactus[name]" class="form-control Hero_Light " id="contact-name" placeholder="NOME" autocomplete="off">
					</div>
					<div class="form-group col-sm-6" id="contact_email">
						<input type="text" name="Contactus[email]" class="form-control Hero_Light" id="contact-email" placeholder="E-MAIL" autocomplete="off">
					</div>
					<div class="row">
						<div class="form-group col-sm-12 mar-top30">
							<textarea type="text" name="Contactus[message]" class="form-control Hero_Light" id="contact-message" placeholder="MENSAGEM"></textarea>
						</div>
					</div>
				</div>
				<!--<button id="next" class="btn btn-secondary btn-md"><i class="fa fa-angle-right"></i></button>-->
				<!--<button id="submit" type="submit" class="btn btn-secondary btn-md" style="display: none;font-size:19px;">OK</button>-->
				<button type="submit" class="btn btn-primary btn-md">ENVIAR</button>
			<?php ActiveForm::end(); ?>
		</div>

	</div>
</section>
<script type="text/javascript">
	/*$(document).ready(function(e) {
		$("#next").on("click", function() {
			var sEmail = $('#subscribers-email').val();
			if ($.trim(sEmail).length == 0) {
				//alert('All fields are mandatory');
				e.preventDefault();
			}
			if (validateEmail(sEmail)) {
				$("#subscriber_email").hide();
				$("#subscriber_name").show();
				$("#next").hide();
				$("#submit").show();
				//alert('Nice!! your Email is valid, now you can continue..');
			}else{
				//alert('Invalid Email Address');
				e.preventDefault();
			}
		});
	});
	function validateEmail(sEmail) {
		var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		if (filter.test(sEmail)) {
			return true;
		}else{
			return false;
		}
	}*/
	var form1 = $('#contact-form');
	var error1 = $('.alert-danger', form1);
    var success1 = $('.alert-success', form1);
	form1.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block', // default input error message class
		focusInvalid: true, // do not focus the last invalid input
		rules: {
			
			/* Validate personal info */
			"Contactus[email]": {
				required: true,
                email: true
			},
			"Contactus[name]": {
				required: true,
			},
			"Contactus[message]": {
				required: true,
			},
        },
			
		invalidHandler: function (event, validator) { //display error alert on form submit              
			success1.hide();
			error1.show();
		},

		highlight: function (element) { // hightlight error inputs
			$(element)
				.closest('.form-group').addClass('has-error'); // set error class to the control group
		},
		
		unhighlight: function (element) { // revert the change done by hightlight
			$(element)
				.closest('.form-group').removeClass('has-error'); // set error class to the control group
		},

		success: function (label) {
			label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
	
		},
		errorPlacement: function (error, element) { // render error placement for each input type
			error.insertAfter(element); // for other inputs, just perform default behavoir
		},
	});
	
	jQuery.extend(jQuery.validator.messages, {
		required: "Esse campo é obrigatório",
		/*remote: "Please fix this field.",
		email: "Please enter a valid email address.",
		url: "Please enter a valid URL.",
		date: "Please enter a valid date.",
		dateISO: "Please enter a valid date (ISO).",
		number: "Please enter a valid number.",
		digits: "Please enter only digits.",
		creditcard: "Please enter a valid credit card number.",
		equalTo: "Please enter the same value again.",
		accept: "Please enter a value with a valid extension.",
		maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
		minlength: jQuery.validator.format("Please enter at least {0} characters."),
		rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
		range: jQuery.validator.format("Please enter a value between {0} and {1}."),
		max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
		min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")*/
	});

</script>