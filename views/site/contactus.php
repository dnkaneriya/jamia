<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\models\Cms;
use app\models\Contact;
use app\models\Contactdetail;

/* @var $this yii\web\View */
$this->title = 'Contact Us';
?>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/scripts/jquery.validate.min.js"></script>
<style>
.display-none, .display-hide {
    display: none;
}
.disabled{
	background: none;
    color: #999999;
    cursor: default !important;
}
.help-block {
	color: #a94442;
}
</style>
<div class="welcome">
	<div class="wrapper">
		<h1>Contact Us</h1>
		<?php
			$contact_content = Cms::find()->where(['id'=>3])->one();
			if($contact_content){
				echo $contact_content->content;
			}
		?>
	</div>
</div>
<div class="clear"></div>
<div class="wrapper">
	<div class="map">
        <div class="dark">
            <div class="column6">
                <div class="dark">
                    <div class="column5">
						<p><strong>Address</strong></p>
						<?php $address = Contactdetail::find()->where(['id'=>1])->one(); ?>
						<p><?=$address->address?></p>
						<p><strong>Phone:</strong> <?=$address->phone?><br><strong>Email:</strong> <?=$address->email?></p>
					</div>
					<div class="column7">
						<?php
							$address=str_replace(" ","+",$address->address);
							/*if ($address) {
								$json = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$address.
								'&sensor=true');
								echo $json;
							}*/
						?>
						<!--<iframe width="100%" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.co.uk/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=B14+5DD&amp;sll=52.417079,-1.856003&amp;sspn=0.04858,0.169086&amp;ie=UTF8&amp;hq=&amp;hnear=<&amp;ll=52.410557,-1.884465&amp;spn=0.012146,0.042272&amp;z=14&amp;output=embed"></iframe>-->
						<iframe width="100%" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $address; ?>&amp;aq=0&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $address; ?>&amp;t=m&amp;z=12&amp;iwloc=&amp;output=embed"></iframe>
					</div>
				</div>
			</div>
			
			<div class="column6">
				<?php $form = ActiveForm::begin([
					'id'=>'contact-form',
					//'layout'=>'horizontal',
					//'options' => ['class' => 'form-horizontal'],
					'fieldConfig' => [
						//'template' => " <div class=\"control-group\">{lable}<div class=\"controls\">{input}</div>\n<div class=\"col-lg-7\">{error}</div></div>",
						'enableClientValidation'=>false,
						'enableAjaxValidation'=>false,
						/*'template' => "<div class=\"row\">{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}</div>",
						'horizontalCheckboxTemplate'=>"{beginWrapper}\n<div class=\"checkbox\">\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n</div>\n{error}\n{endWrapper}\n{hint}",
						'horizontalCssClasses' => [
							'label' => 'col-sm-2 form-control-label',
							'offset' => 'col-sm-offset-4',
							'wrapper' => 'col-lg-6',
							'error' => '',
							'hint' => '',
						],*/
						//'template' => '{label} <div class="col-lg-6">{input}{error}</div>'
						// 'inputOptions' => ['class' => 'm-wrap span6'],
					],
					]);
                ?>
				<div class="alert alert-danger display-hide">
					<button class="close" data-close="alert"></button>
					<?php echo Yii::t('app', 'You have some form errors. Please check below'); ?>
				</div>
				<div class="alert alert-success display-hide">
					<button class="close" data-close="alert"></button>
					Your form validation is successful!
				</div>
				<div class="col-sm-6">
					<label>Name</label>
					<input type="text" maxlength="255" name="Contact[name]" id="contact-name">
					<div class="help-block help-block-error "></div>
				</div>
				<div class="col-sm-6">
					<label>Email</label>
					<input type="text" maxlength="255" name="Contact[email]" id="contact-email">
					<div class="help-block help-block-error "></div>
				</div>
				<div class="col-sm-12">
					<label>Message</label>
					<textarea ui-jp="summernote" rows="6" name="Contact[message]" id="contact-message"></textarea>
					<div class="help-block help-block-error "></div>
				</div>
				<input type="submit" title="Send" id="ctl00__mailing_list1_Button1" onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$_mailing_list1$Button1&quot;, &quot;&quot;, true, &quot;SubscriptionForm&quot;, &quot;&quot;, false, false))" value="Send" name="ctl00$_mailing_list1$Button1">
				<div class="clear"></div>
				<?php ActiveForm::end(); ?>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>
<script type="text/javascript">
    
    var form1 = $('#contact-form');
	var error1 = $('.alert-danger', form1);
    var success1 = $('.alert-success', form1);
	form1.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block', // default input error message class
		focusInvalid: true, // do not focus the last invalid input
		//ignore: [],
		//ignore: "#job-walkin_time",
        //ignore: "",
		rules: {
			"Contact[name]": {
				required: true
			},
			"Contact[email]": {
				required: true
			},
			"Contact[message]": {
				required: true
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
</script>