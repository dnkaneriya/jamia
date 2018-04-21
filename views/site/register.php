<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

use app\models\Classes;
use app\models\Division;
use app\models\Subclass;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::$app->params['apptitle'].' : Student Registration';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>input#student-dob_yy {
    padding: 1px 4px;
    /* margin: 0px; */
    height: 24px;
}</style>

<link type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/scripts/jquery.tagsinput.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/scripts/jquery.validate.min.js"></script>
<script type="text/javascript">
	function upperMe(specificid) {
		var specificid1 = specificid;
		if(specificid1 == 'student-surname_en'){
			//$("#namepapplicantblank,#namepapplicantblank1").show();
			document.getElementById("student-surname_en").value = document.getElementById("student-surname_en").value.toUpperCase(); 
			/*document.getElementById("print_firstname").value = document.getElementById("firstnameupp").value.toUpperCase()+ ' '+document.getElementById("middlenameupp").value.toUpperCase();
			var names = document.getElementById("firstnameupp").value.toUpperCase()+' '+document.getElementById("middlenameupp").value.toUpperCase() +' '+document.getElementById("lastnameupp").value.toUpperCase();
			$("#namepapplicant, #namepapplicant1").show();
			$("#namepapplicant, #namepapplicant1").html(names);
			$("#namepapplicantblank, #namepapplicantblank1").hide();
			$("#namepapplicant, #namepapplicant1").css('text-decoration', 'underline');*/
		}
		if(specificid1 == 'student-firstname_en')
		{ 
			document.getElementById("student-firstname_en").value = document.getElementById("student-firstname_en").value.toUpperCase();
			/*document.getElementById("print_middlename").value = document.getElementById("middlenameupp").value.toUpperCase();
			document.getElementById("print_firstname").value = document.getElementById("firstnameupp").value.toUpperCase() + ' '+document.getElementById("middlenameupp").value.toUpperCase();
			var names = document.getElementById("firstnameupp").value.toUpperCase()+' '+document.getElementById("middlenameupp").value.toUpperCase() +' '+document.getElementById("lastnameupp").value.toUpperCase();
			$("#namepapplicant, #namepapplicant1").show();
			$("#namepapplicant, #namepapplicant1").html(names);
			$("#namepapplicantblank, #namepapplicantblank1").hide();
			$("#namepapplicant, #namepapplicant1").css('text-decoration', 'underline'); */
		}
		if(specificid1 == 'student-lastname_en')
		{
			document.getElementById("student-lastname_en").value = document.getElementById("student-lastname_en").value.toUpperCase();
			/*document.getElementById("print_lastname").value = document.getElementById("lastnameupp").value.toUpperCase();
			var names = document.getElementById("firstnameupp").value.toUpperCase()+' '+document.getElementById("middlenameupp").value.toUpperCase() +' '+document.getElementById("lastnameupp").value.toUpperCase();
			$("#namepapplicant, #namepapplicant1").show();
			$("#namepapplicant, #namepapplicant1").html(names);
			$("#namepapplicantblank, #namepapplicantblank1").hide();
			$("#namepapplicant, #namepapplicant1").css('text-decoration', 'underline'); */
		}
			/*if(specificid1 == 'firstnameothr')
			   document.getElementById("firstnameothr").value = document.getElementById("firstnameothr").value.toUpperCase(); 
			if(specificid1 == 'middlenameothr')
			   document.getElementById("middlenameothr").value = document.getElementById("middlenameothr").value.toUpperCase(); 
			if(specificid1 == 'lastnameothr')
			   document.getElementById("lastnameothr").value = document.getElementById("lastnameothr").value.toUpperCase(); 
			if(specificid1 == 'print_firstname')
			  document.getElementById("print_firstname").value = document.getElementById("print_firstname").value.toUpperCase();
			if(specificid1 == 'print_lastname')
			   document.getElementById("print_lastname").value = document.getElementById("print_lastname").value.toUpperCase();
			if(specificid1 == 'father_fname')
			   document.getElementById("father_fname").value = document.getElementById("father_fname").value.toUpperCase();  
			if(specificid1 == 'father_mname')
			   document.getElementById("father_mname").value = document.getElementById("father_mname").value.toUpperCase();  
			if(specificid1 == 'father_lname')
			   document.getElementById("father_lname").value = document.getElementById("father_lname").value.toUpperCase(); 
			if(specificid1 == 'rafirstname')
			   document.getElementById("rafirstname").value = document.getElementById("rafirstname").value.toUpperCase(); 
			if(specificid1 == 'ramiddlename')
				document.getElementById("ramiddlename").value = document.getElementById("ramiddlename").value.toUpperCase(); 
			if(specificid1 == 'ralastname')
			   document.getElementById("ralastname").value = document.getElementById("ralastname").value.toUpperCase();*/
			/*document.getElementById("firstnameupp").value = document.getElementById("middlenameupp").value.toUpperCase(); 
			document.getElementById("lastnameupp").value = document.getElementById("lastnameupp").value.toUpperCase(); */
}
</script>
<script>
function getdistrict(state) {
	var id= state;
	$.ajax({
		type:"GET",
		url:"getdistrict",
		data:{id:id},    // multiple data sent using ajax
		success: function (result) {
			//alert(result);return false;
			$("#student-district").html(result);
			//$.pjax.reload({container: '#w0-pjax', timeout: 2000});
		}
	});
}
</script>
<style>
.display-none, .display-hide {
    display: none;
}
.disabled{
	background: none;
    color: #999999;
    cursor: default !important;
}
.form-control{
	font-family:inherit;
}
.form-file input {
    height: 100%;
    opacity: 0;
    position: absolute;
    width: 100%;
}
.form-group .form-control-label{
	color:#555555
}
.form-group input, select{
	color:#555555
}
.student_form_heading{
	margin: 0;
	color: #003471;
}
.student_form_heading span {
	background: #0060ac none repeat scroll 0 0;
	border-radius: 15%;
	color: #fff;
	font-size: 20px;
	margin: 5px;
	padding: 0 9px;
}
.tip {
	color: #ff0000;
}
</style>
<div class="content">
	<div class="wrapper">
        <div class="dark container">
            <div class="column12">
				<h1 class="marbot-30">Student Registration</h1>
				<hr>
				<div class="column12"><h3 class="student_form_heading"><span>1</span> Student Personal Information<h3></div>
				<?php echo Yii::$app->getSession()->getFlash('flash_msg'); ?>
				<?php $form = ActiveForm::begin([
						'id'=>'register-form',
						'layout'=>'horizontal',
						'options' => ['class' => 'form-horizontal', 'enctype'=> 'multipart/form-data'],
						'fieldConfig' => [
							//'template' => " <div class=\"control-group\">{lable}<div class=\"controls\">{input}</div>\n<div class=\"col-lg-7\">{error}</div></div>",
							'enableClientValidation'=>false,
							'enableAjaxValidation'=>false,
							'template' => "<div class=\"row\">{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}</div>",
							'horizontalCheckboxTemplate'=>"{beginWrapper}\n<div class=\"checkbox\">\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n</div>\n{error}\n{endWrapper}\n{hint}",
							'horizontalCssClasses' => [
								'label' => 'col-sm-2 form-control-label',
								'offset' => 'col-sm-offset-4',
								'wrapper' => 'col-lg-4',
								'error' => '',
								'hint' => '',
							],
							//'template' => '{label} <div class="col-lg-6">{input}{error}</div>'
							// 'inputOptions' => ['class' => 'm-wrap span6'],
						],
					]);
				?>
				<div class="alert alert-danger display-hide" style="float: left; width: 100%;">
					<button class="close" data-close="alert"></button>
					<?php echo Yii::t('app', 'You have some form errors. Please check below'); ?>
				</div>
				<div class="alert alert-success display-hide" style="float: left; width: 100%;">
					<button class="close" data-close="alert"></button>
					Your form validation is successful!
				</div>
				<div class="column12">
					<div class="form-group field-register_status column6">
						<div class="row">
							<label class="col-sm-5 form-control-label">Registration Status</label>
							<div class="col-lg-5">
								<!--<label class="md-check form-control-label">-->
								<label class="md-check form-control-label">
									<input type="radio" id="register_status_yes" class="has-value" name="Student[register_status]" value="N" checked="checked"> New
									<i class="blue"></i>
								</label>
								<label class="md-check form-control-label">
									<input type="radio" id="register_status_no" class="has-value" name="Student[register_status]" value="O"> Old
									<i class="blue"></i>
								</label>
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
					<div style="visibility: hidden;" class="field-how_old-wrapper">
						<div class="form-group field-student-how_old column6">
							<div class="row">
								<label for="student-how_old" class="col-sm-4 form-control-label">Select Register Status</label>
								<div class="col-lg-8">
									<select name="Student[how_old]" class="student-how_old" id="student-how_old">
										<option value="">--Select Old By Year--</option>
										<option value="1">Old By 1 Year</option>
										<option value="2">Old By 2 Year</option>
										<option value="3">Old By 3 Year</option>
										<option value="4">Old By 4 Year</option>
									</select>
									<div class="help-block help-block-error "></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="column12">
					<div class="form-group field-student-surname_en required column4">
						<div class="row">
							<label class="control-label col-sm-4 form-control-label" for="student-surname_en">First Name</label>
							<div class="col-lg-7">
								<input type="text" id="student-surname_en" class="form-control" name="Student[surname_en]" maxlength="255" onchange="upperMe('student-surname_en')">
								<div class="help-block help-block-error "></div>
							</div>
						</div>
						<i class="tip">(Name should be exactly as per the ID proof)</i>
					</div>
					<div class="form-group field-student-firstname_en required column4">
						<div class="row">
							<label class="control-label col-sm-5 form-control-label" for="student-firstname_en">Middle Name</label>
							<div class="col-lg-7">
								<input type="text" id="student-firstname_en" class="form-control" name="Student[firstname_en]" maxlength="255" onchange="upperMe('student-firstname_en')">
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
					<div class="form-group field-student-lastname_en required column4">
						<div class="row">
							<label class="control-label col-sm-5 form-control-label" for="student-lastname_en">Last Name</label>
							<div class="col-lg-7">
								<input type="text" id="student-lastname_en" class="form-control" name="Student[lastname_en]" maxlength="255" onchange="upperMe('student-lastname_en')">
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
				</div>
				<div class="column12">
					<div class="form-group field-student-dob required column">
						<div class="row">
							<label class="col-sm-2 form-control-label" for="student-dob">Date of Birth</label>
							<div class="col-lg-1">
								<select class="has-value student-dob_dd" name="Student[dob_dd]">
									<option value="">DD</option>
									<?php for($i=1;$i<=31;$i++){ if($i<10){ $dPrefix = '0'; }else{ $dPrefix = ''; } ?>
										<option value="<?=$dPrefix.$i?>"><?=$dPrefix.$i?></option>
									<?php } ?>
								</select>
								<div class="help-block help-block-error "></div>
							</div>
							<div class="col-lg-1">
								<select class="has-value student-dob_mm" name="Student[dob_mm]">
									<option value="">MM</option>
									<?php for($i=1;$i<=12;$i++){ if($i<10){ $mPrefix = '0'; }else{ $mPrefix = ''; } ?>
										<option value="<?=$mPrefix.$i?>"><?=$mPrefix.$i?></option>
									<?php } ?>
								</select>
								<div class="help-block help-block-error "></div>
							</div>
							<div class="col-lg-1">
								<input type="text" name="Student[dob_yy]" maxlength="4" id="student-dob_yy" placeholder="YYYY" size="4">
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
				</div>
				<div class="column12">
					<div class="form-group field-student-bloodgroup column">
						<div class="row">
							<label for="student-bloodgroup" class="col-sm-2 form-control-label">Bloodgroup</label>
							<div class="col-lg-3">
								<!--<input type="text" name="Student[bloodgroup]" class="form-control" id="student-bloodgroup">-->
								<select name="Student[bloodgroup]" id="student-bloodgroup">
									<option value="">--Select Bloodgroup--</option>
									<option value="A+">A+</option>
									<option value="A-">A-</option>
									<option value="B+">B+</option>
									<option value="B-">B-</option>
									<option value="AB+">AB+</option>
									<option value="AB-">AB-</option>
									<option value="O+">O+</option>
									<option value="O-">O-</option>
								</select>
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
				</div>
				<div class="column12">
					<div class="form-group field-fees column">
						<div class="row">
							<label class="col-sm-2 form-control-label">Fees</label>
							<div class="col-lg-9">
								<!--<label class="md-check form-control-label">-->
								<label class="md-check form-control-label">
									<input type="radio" id="fees_yes" class="has-value" name="Student[fees]" value="Y"> Yes
									<i class="blue"></i>
								</label>
								<label class="md-check form-control-label">
									<input type="radio" id="fees_no" class="has-value" name="Student[fees]" value="N" checked="checked"> No
									<i class="blue"></i>
								</label>
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
				</div>
                                <div class="column12">
					<div class="form-group field-amount column" style="display: none;">
						<div class="row">
							<label class="col-sm-2 form-control-label">Amount</label>
							<div class="col-lg-4">
								<!--<label class="md-check form-control-label">-->
								<input type="text" id="student-amount" class="form-control" name="Student[amount]" maxlength="255">
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
				</div>
				<hr class="column12">
				<div class="column12"><h3 class="student_form_heading"><span>2</span> Parent Information<h3></div>
				<div class="column5">
					<div class="form-group field-student-father_name required">
						<div class="row">
							<label for="student-father_name" class="control-label col-sm-4 form-control-label">Father Name</label>
							<div class="col-lg-8">
								<input type="text" maxlength="255" name="Student[father_name]" class="form-control" id="student-father_name">
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
					<div class="form-group field-student-grandfather_name required">
						<div class="row">
							<label for="student-grandfather_name" class="control-label col-sm-4 form-control-label">Grand Father Name</label>
							<div class="col-lg-8">
								<input type="text" maxlength="255" name="Student[grandfather_name]" class="form-control" id="student-grandfather_name">
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
					<div class="form-group field-student-mother_name required">
						<div class="row">
							<label for="student-mother_name" class="control-label col-sm-4 form-control-label">Mother Name</label>
							<div class="col-lg-8">
								<input type="text" maxlength="255" name="Student[mother_name]" class="form-control" id="student-mother_name">
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
				</div>
				<div class="column5">
					<div class="form-group field-student-parent_occupation">
						<div class="row">
							<label for="student-parent_occupation" class="control-label col-sm-5 form-control-label">Parent Occupation</label>
							<div class="col-lg-7">
								<input type="text" name="Student[parent_occupation]" class="form-control" id="student-parent_occupation">
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
					<div class="form-group field-student-parent_income">
						<div class="row">
							<label for="student-parent_income" class="control-label col-sm-5 form-control-label">Parent Annual Income</label>
							<div class="col-lg-7">
								<input type="text" name="Student[parent_income]" class="form-control" id="student-parent_income">
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
					
				</div>
				<hr class="column12">
				<div class="column12"><h3 class="student_form_heading"><span>3</span> Contact Details<h3></div>
				<div class="column12">
					<div class="form-group field-student-mobile_no required column4">
						<div class="row">
							<label class="control-label col-sm-3 form-control-label" for="student-mobile_no">Mobile 1</label>
							<div class="col-lg-7">
								<input type="text" id="student-mobile_code" class="form-control column3" name="Student[mobile_code]" disabled="disabled" readonly="readonly" value="91">
								<input type="text" id="student-mobile_no" class="form-control column9" name="Student[mobile_no]" maxlength="10">
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
					<div class="form-group field-student-parent_mobile required">
						<div class="row">
							<label for="student-parent_mobile" class="control-label col-sm-4 form-control-label">Mobile 2</label>
							<div class="col-lg-8">
								<input type="text" id="student-mobile_code" class="form-control column3"  disabled="disabled" readonly="readonly" value="91">
                            
								<input type="text" maxlength="255" name="Student[parent_mobile]" class="form-control" id="student-parent_mobile" maxlength="10" />
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
					<div class="form-group field-student-email required column4">
						<div class="row">
							<label class="control-label col-sm-3 form-control-label" for="student-email">Email</label>
							<div class="col-lg-7">
								<input type="text" id="student-email" class="form-control" name="Student[email]" maxlength="255">
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
					
				</div>
				<hr class="column12">
				<div class="column12"><h3 class="student_form_heading"><span>4</span> Residence Address<h3></div>
				<div class="column12">
					<div class="form-group field-student-street required column4">
						<div class="row">
							<label class="control-label col-sm-3 form-control-label" for="student-street">Road/Street/Maholla</label>
							<div class="col-lg-7">
								<input type="text" id="student-street" class="form-control" name="Student[street]" maxlength="255">
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
					<div class="form-group field-student-city required column4">
						<div class="row">
							<label class="control-label col-sm-3 form-control-label" for="student-city">City/Village</label>
							<div class="col-lg-8">
								<input type="text" id="student-city" class="form-control" name="Student[city]" maxlength="255">
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
					<div class="form-group field-student-taluka required column4">
						<div class="row">
							<label class="control-label col-sm-5 form-control-label" for="student-taluka">Taluka/Subdivision</label>
							<div class="col-lg-7">
								<input type="text" id="student-taluka" class="form-control" name="Student[taluka]" maxlength="255">
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
				</div>
				<div class="column12">
					<div class="form-group field-student-state required column4">
						<div class="row">
							<label class="col-sm-3 form-control-label" for="student-state">State</label>
							<div class="col-lg-7">
								<?php $states = Yii::$app->params['indian_all_states']; ?>
								<select name="Student[state]" id="student-state" onchange="getdistrict(this.value);">
									<option value="">--Select State--</option>
									<?php
										foreach($states as $key=>$value){
											echo '<option value="'.$key.'">'.$value.'</option>';
										}
									?>
								</select>
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
					<div class="form-group field-student-district required column4">
						<div class="row">
							<label class="col-sm-3 form-control-label" for="student-district">District</label>
							<div class="col-lg-7">
								<?php //$states = Yii::$app->params['indian_all_states']; ?>
								<select name="Student[district]" id="student-district">
									<option value="">--Select District--</option>
								</select>
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
					<div class="form-group field-student-pincode required column4">
						<div class="row">
							<label class="col-sm-5 form-control-label" for="student-pincode">Pincode</label>
							<div class="col-lg-7">
								<input type="text" id="student-pincode" class="form-control" name="Student[pincode]" maxlength="6">
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
				</div>
				<hr class="column12">
				<div class="column12"><h3 class="student_form_heading"><span>5</span> Detail Of Student Education<h3></div>
				<div class="column5">
					<div class="form-group field-studenteducation-madrasa_name required column12">
						<div class="row">
							<label for="studenteducation-madrasa_name" class="control-label col-sm-4 form-control-label">Madrasa Name</label>
							<div class="col-lg-7">
								<input type="text" name="Studenteducation[madrasa_name]" class="form-control" id="studenteducation-madrasa_name">
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
					<div class="form-group field-studenteducation-nazra column4">
						<div class="row">
							<label for="studenteducation-nazra" class="control-label col-sm-7 form-control-label">Nazra</label>
							<div class="col-lg-4">
								<input type="hidden" name="Studenteducation[nazra]" value="0">
								<input type="checkbox" class="has-value" id="Studenteducation-nazra" name="Studenteducation[nazra]" value="1">
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
					<div style="visibility: hidden;" class="field-nazra_para-wrapper">
						<div class="form-group field-student-nazra_para column8">
							<div class="row">
								<label for="student-nazra_para" class="col-sm-7 form-control-label">How many Para’s In Quran Sharif?</label>
								<div class="col-lg-5">
									<select name="Studenteducation[nazra_para]" class="student-nazra_para" id="student-nazra_para">
										<option value="">--Select--</option>
										<?php for($i=1;$i<=30;$i++){ if($i<10){ $npPrefix = '0'; }else{ $npPrefix = ''; } ?>
											<option value="<?=$npPrefix.$i?>"><?=$npPrefix.$i?></option>
										<?php } ?>
									</select>
									<div class="help-block help-block-error "></div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group field-studenteducation-hifz column4">
						<div class="row">
							<label for="studenteducation-hifz" class="control-label col-sm-7 form-control-label">Hifz</label>
							<div class="col-lg-4">
								<input type="hidden" name="Studenteducation[hifz]" value="0">
								<input type="checkbox" class="has-value" id="Studenteducation-hifz" name="Studenteducation[hifz]" value="1">
							</div>
						</div>
					</div>
					<div style="visibility: hidden;" class="field-hifz_para-wrapper">
						<div class="form-group field-student-hifz_para column8">
							<div class="row">
								<label for="student-hifz_para" class="col-sm-7 form-control-label">How many Quran Sharif Para You Memorised?</label>
								<div class="col-lg-5">
									<select name="Studenteducation[hifz_para]" class="student-hifz_para" id="student-hifz_para">
										<option value="">--Select--</option>
										<?php for($i=1;$i<=30;$i++){ if($i<10){ $hpPrefix = '0'; }else{ $hpPrefix = ''; } ?>
											<option value="<?=$hpPrefix.$i?>"><?=$hpPrefix.$i?></option>
										<?php } ?>
									</select>
									<div class="help-block help-block-error "></div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group field-studenteducation-urdu column6">
						<div class="row">
							<label for="studenteducation-urdu" class="control-label col-sm-5 form-control-label">Urdu</label>
							<div class="col-lg-4">
								<input type="hidden" name="Studenteducation[urdu]" value="0">
								<input type="checkbox" class="has-value" id="Studenteducation-urdu" name="Studenteducation[urdu]" value="1">
							</div>
						</div>
					</div>
					<div class="form-group field-studenteducation-arabic column6">
						<div class="row">
							<label for="studenteducation-arabic" class="control-label col-sm-5 form-control-label">Arabic</label>
							<div class="col-lg-4">
								<input type="hidden" name="Studenteducation[arabic]" value="0">
								<input type="checkbox" class="has-value" id="Studenteducation-arabic" name="Studenteducation[arabic]" value="1">
							</div>
						</div>
					</div>
				</div>
				<div class="column5">
					<div class="form-group field-studenteducation-school_name required">
						<div class="row">
							<label for="studenteducation-school_name" class="control-label col-sm-4 form-control-label">School Name</label>
							<div class="col-lg-8">
								<input type="text" name="Studenteducation[school_name]" class="form-control" id="studenteducation-school_name">
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
                    <div class="form-group field-studenteducation-school_standard required">
						<div class="row">
							<label for="studenteducation-school_standard" class="control-label col-sm-4 form-control-label">Standard</label>
							<div class="col-lg-6">
								<input type="text" name="Studenteducation[school_standard]" class="form-control" id="studenteducation-school_standard">
								<div class="help-block help-block-error "></div>
							</div>
							<div class="col-lg-2">Passed</div>
						</div>
					</div>
					<div class="form-group field-studenteducation-school_medium">
						<div class="row">
							<label class="control-label col-sm-4 form-control-label">Medium</label>
							<div class="col-lg-8">
								<!--<label class="md-check form-control-label">-->
								<label class="md-check form-control-label">
									<input type="radio" id="school_medium_urdu" class="has-value" name="Studenteducation[school_medium]" value="U"> Urdu
									<i class="blue"></i>
								</label>
								<label class="md-check form-control-label">
									<input type="radio" id="school_medium_english" class="has-value" name="Studenteducation[school_medium]" value="E" checked="checked"> English
									<i class="blue"></i>
								</label>
								<label class="md-check form-control-label">
									<input type="radio" id="school_medium_hindi" class="has-value" name="Studenteducation[school_medium]" value="H"> Hindi
									<i class="blue"></i>
								</label>
								<label class="md-check form-control-label">
									<input type="radio" id="school_medium_other" class="has-value" name="Studenteducation[school_medium]" value="O"> Other
									<i class="blue"></i>
								</label>
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
					<div class="form-group field-studenteducation-grade required">
						<div class="row">
							<label for="studenteducation-grade" class="control-label col-sm-4 form-control-label">Grade</label>
							<div class="col-lg-8">
								<input type="text" name="Studenteducation[grade]" class="form-control" id="studenteducation-grade" required>
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
				</div>
				<hr class="column12">
				<div class="column12"><h3 class="student_form_heading"><span>6</span> In Which Class You Want To Take Admission<h3></div>
				<div class="form-group field-studenteducation-school_medium">
					<div class="row">
						<!--<label style="text-align: right;" class="col-sm-4 form-control-label">Medium</label>-->
						<div class="col-lg-1"></div>
						<div class="col-lg-8">
							<label class="md-check form-control-label">
								<input type="radio" class="has-value" name="Classes[class_id]" value="1" checked="checked"> Basic
								<i class="blue"></i>
							</label>
							<label class="md-check form-control-label">
								<input type="radio" class="has-value" name="Classes[class_id]" value="3"> Arabic
								<i class="blue"></i>
							</label>
							<label class="md-check form-control-label">
								<input type="radio" class="has-value" name="Classes[class_id]" value="2"> Hifz
								<i class="blue"></i>
							</label>
							<div class="help-block help-block-error "></div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-lg-12 text-center">
							<!--<button type="submit" class="btn btn-success"><?php //echo Yii::t('app', 'Submit'); ?></button>-->
							<?= Html::submitButton(Yii::t('app', 'Register'), ['class' => 'btn btn-success']) ?>
							<?php //echo Html::a('<button type="button" class="btn btn-warning">'.Yii::t('app', 'Cancel').'</button>',["index"]); ?>
						</div>
					</div>
				</div>
                <?php ActiveForm::end(); ?>
			</div>
        </div>
	</div>
</div>
<div class="clear"></div>
<script type="text/javascript">
	
	/*$( ".student-dob" ).datepicker({
		format: 'mm/dd/yyyy',
		autoclose: true,
		endDate: '-1d',
	});*/
	
	$(document).ready(function() {
		$("#student-parent_income, #student-parent_mobile, #student-mobile_no, #student-dob_yy, #student-pincode, #student-amount").keydown(function (e) {
			// Allow: backspace, delete, tab, escape, enter and .
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
				 // Allow: Ctrl+A, Command+A
				(e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
				 // Allow: home, end, left, right, down, up
				(e.keyCode >= 35 && e.keyCode <= 40)) {
					 // let it happen, don't do anything
					 return;
			}
			// Ensure that it is a number and stop the keypress
			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
			}
		});
	});

        $('.field-fees input:radio').change(function(){
		if($('#fees_yes').is(":checked")) {
			$('.field-amount').css("display","block");
			$('#student-amount').attr('required');
		} else {
			$('.field-amount').css("display","none");
			$('#student-amount').removeAttr('required');
		}
	});
	
	//$(':checkbox:checked').prop('checked',false);
	$('.field-register_status input:radio').change(function(){
		if($('#register_status_no').is(":checked")) {
			$('.field-how_old-wrapper').css("visibility","visible");
			$('#student-how_old').attr('required');
		} else {
			$('.field-how_old-wrapper').css("visibility","hidden");
			$('#student-how_old').removeAttr('required');
		}
	});
	
	$('.field-studenteducation-nazra input:checkbox').change(function(){
		if($('#Studenteducation-nazra').is(":checked")) {
			$('.field-nazra_para-wrapper').css("visibility","visible");
			$('#student-nazra_para').attr('required');
		} else {
			$('.field-nazra_para-wrapper').css("visibility","hidden");
			$('#student-nazra_para').removeAttr('required');
		}
	});
	
	$('.field-studenteducation-hifz input:checkbox').change(function(){
		if($('#Studenteducation-hifz').is(":checked")) {
			$('.field-hifz_para-wrapper').css("visibility","visible");
			$('#student-hifz_para').attr('required');
		} else {
			$('.field-hifz_para-wrapper').css("visibility","hidden");
			$('#student-hifz_para').removeAttr('required');
		}
	});
	
	jQuery.validator.addMethod("imagetype", function(value, element) {
		return this.optional(element) || /^.*\.(jpg|png|jpeg)$/i.test(value);
	}, "Plese Select .jpg .png or .jpeg Image");
	
	var form1 = $('#register-form');
	var error1 = $('.alert-danger', form1);
    var success1 = $('.alert-success', form1);
	form1.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block', // default input error message class
		focusInvalid: true, // do not focus the last invalid input
		ignore: [],
		//ignore: "#job-walkin_time",
		rules: {
			"Student[how_old]": {
				required: function(){
					return $("#register_status_no").is(":checked");
				}
			},
                        "Student[amount]": {
				required: function(){
					return $("#fees_yes").is(":checked");
				}
			},
			"Student[surname_en]": {
				required: true
			},
			"Student[firstname_en]": {
				required: true
			},
			"Student[lastname_en]": {
				required: true
			},
			"Student[dob_dd]": {
				required: true
			},
			"Student[dob_mm]": {
				required: true
			},
			"Student[dob_yy]": {
				required: true
			},
			"Student[father_name]": {
				required: true
			},
			"Student[grandfather_name]": {
				required: true
			},
			"Student[mother_name]": {
				required: true
			},
			"Student[parent_occupation]": {
				required: true
			},
			"Student[parent_income]": {
				required: true
			},
			"Student[parent_mobile]": {
				required: true,
				minlength: 10,
				maxlength: 10,
				digits: true,
			},
			"Student[mobile_no]": {
				required: true,
				minlength: 10,
				maxlength: 10,
				digits: true,
			},
			"Student[email]": {
				email:true
			},
			/*"Student[contact_std]": {
				required: true,
				maxlength: 7,
			},
			"Student[landline_no]": {
				required: true,
				maxlength: 7,
			},*/
			"Student[street]": {
				required: true,
			},
			"Student[city]": {
				required: true,
			},
			"Student[taluka]": {
				required: true,
			},
			"Student[state]": {
				required: true,
			},
			"Student[district]": {
				required: true,
			},
			"Student[pincode]": {
				required: true,
			},
			"Studenteducation[madrasa_name]": {
				required: true,
			},
			"Studenteducation[nazra_para]": {
				required: function(){
					return $("#Studenteducation-nazra").is(":checked");
				}
			},
			"Studenteducation[hifz_para]": {
				required: function(){
					return $("#Studenteducation-hifz").is(":checked");
				}
			},
			"Studenteducation[school_name]": {
				required: true,
			},
			"Studenteducation[grade]": {
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
</script>