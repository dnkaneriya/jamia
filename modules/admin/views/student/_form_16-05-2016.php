<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\Classes;
use app\models\Division;
use app\models\Subclass;
use app\models\Studenteducation;

/* @var $this yii\web\View */
/* @var $model app\models\Job */
/* @var $form yii\widgets\ActiveForm */
?>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/scripts/jquery.tagsinput.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/plugins/bootstrap-daterangepicker/moment.min.js"></script>
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
</style>
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
<?php
	//echo "<pre>";print_r($companyModel);die;
	$controller = strtolower(Yii::$app->controller->id);
	$action = strtolower(Yii::$app->controller->action->id);
	$education = Studenteducation::find()->where(['student_id'=>$model->id])->one();
?>
<div class="row">
    <div class="col-lg-12">
		<!--<section class="panel">-->
            <div class="box-header">
				<?php
					if($model->isNewRecord) {
						echo '<h3>'.Yii::t('app', 'Add Student').'</h3>';
					}else{
						echo '<h3>'.Yii::t('app', 'Edit Student').'</h3>';
					}
				?>
            </div>
			<div class="box-divider m-a-0"></div>
            <div class="box-body">
                <!--<form class="form-horizontal" role="form">-->
				<?php $form = ActiveForm::begin([
                                            'id'=>'student-form',
											'layout'=>'horizontal',
											'options' => ['class' => 'form-horizontal','enctype'=>'multipart/form-data'],
											'fieldConfig' => [
												//'template' => " <div class=\"control-group\">{lable}<div class=\"controls\">{input}</div>\n<div class=\"col-lg-7\">{error}</div></div>",
												'enableClientValidation'=>false,
												'enableAjaxValidation'=>false,
												'template' => "<div class=\"row\">{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}</div>",
												'horizontalCheckboxTemplate'=>"{beginWrapper}\n<div class=\"checkbox\">\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n</div>\n{error}\n{endWrapper}\n{hint}",
												'horizontalCssClasses' => [
													'label' => 'col-sm-3 form-control-label',
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
				<div class="alert alert-danger display-hide">
					<button class="close" data-close="alert"></button>
					<?php echo Yii::t('app', 'You have some form errors. Please check below'); ?>
				</div>
				<div class="alert alert-success display-hide">
					<button class="close" data-close="alert"></button>
					Your form validation is successful!
				</div>
				<hr>
				<h6 style="margin: 0;color: #003471;">Student Personal Information</h6>
				<hr>
				<div class="form-group field-register_status">
					<div class="row">
						<label class="control-label col-sm-3 form-control-label">Registration Status</label>
						<?php if(isset($model->register_status) && $model->register_status == 'N') { $new = 'checked="checked"'; $old = ''; $how = 'style="display:none;"'; }else{ $new = ''; $old = 'checked="checked"'; $how = 'style="display:block;"'; } ?>
						<div class="col-lg-4">
							<!--<label class="md-check form-control-label">-->
							<label class="md-check form-control-label">
								<input type="radio" id="register_status_yes" class="has-value" name="Student[register_status]" value="N" <?=$new?>> New
								<i class="blue"></i>
							</label>
							<label class="md-check form-control-label">
								<input type="radio" id="register_status_no" class="has-value" name="Student[register_status]" value="O" <?=$old?>> Old
								<i class="blue"></i>
							</label>
							<div class="help-block help-block-error "></div>
						</div>
					</div>
				</div>
				<div <?=$how?> class="field-how_old-wrapper">
					<div class="form-group field-student-how_old">
						<div class="row">
							<label for="student-how_old" class="col-sm-3 form-control-label">Select Registration Status</label>
							<div class="col-lg-4">
								<select name="Student[how_old]" class="form-control student-how_old" id="student-how_old">
									<option value="">--Select Old By Year--</option>
									<option value="1" <?php if($model->how_old == '1'){ echo 'selected="selected"'; } ?>>Old By 1 Year</option>
									<option value="2" <?php if($model->how_old == '2'){ echo 'selected="selected"'; } ?>>Old By 2 Year</option>
									<option value="3" <?php if($model->how_old == '3'){ echo 'selected="selected"'; } ?>>Old By 3 Year</option>
									<option value="4" <?php if($model->how_old == '4'){ echo 'selected="selected"'; } ?>>Old By 4 Year</option>
								</select>
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
				</div>
				<?= $form->field($model, 'surname_en')->textInput(['maxlength' => true, 'placeholder' => 'FIrst Name (English)']) ?>
				<?= $form->field($model, 'surname_ar')->textInput(['maxlength' => true, 'placeholder' => 'FIrst Name (Arabic)']) ?>
                <?= $form->field($model, 'firstname_en')->textInput(['maxlength' => true, 'placeholder' => 'Middle Name (English)']) ?>
				<?= $form->field($model, 'firstname_ar')->textInput(['maxlength' => true, 'placeholder' => 'Middle Name (Arabic)']) ?>
				<?= $form->field($model, 'lastname_en')->textInput(['maxlength' => true, 'placeholder' => 'Last Name (English)']) ?>
				<?= $form->field($model, 'lastname_ar')->textInput(['maxlength' => true, 'placeholder' => 'Last Name (Arabic)']) ?>
				<div class="form-group field-student-dob required column">
					<div class="row">
						<label class="control-label col-sm-3 form-control-label" for="student-dob">Date of Birth</label>
						<div class="col-lg-1">
							<?php $date = date('d', $model->dob); ?>
							<select class="form-control has-value student-dob_dd" name="Student[dob_dd]">
								<option value="">DD</option>
								<?php for($i=1;$i<=31;$i++){ if($i<10){ $dPrefix = '0'; }else{ $dPrefix = ''; } ?>
									<?php if(!$model->isNewRecord && $date == $i) { $dateSelect = 'selected="selected"'; }else{ $dateSelect = ''; } ?>
									<option value="<?=$dPrefix.$i?>" <?=$dateSelect?>><?=$dPrefix.$i?></option>
								<?php } ?>
							</select>
							<div class="help-block help-block-error "></div>
						</div>
						<div class="col-lg-1">
							<?php $month = date('m', $model->dob); ?>
							<select class="form-control has-value student-dob_mm" name="Student[dob_mm]">
								<option value="">MM</option>
								<?php for($i=1;$i<=12;$i++){ if($i<10){ $mPrefix = '0'; }else{ $mPrefix = ''; } ?>
									<?php if(!$model->isNewRecord && $month == $i) { $monthSelect = 'selected="selected"'; }else{ $monthSelect = ''; } ?>
									<option value="<?=$mPrefix.$i?>" <?=$monthSelect?>><?=$mPrefix.$i?></option>
								<?php } ?>
							</select>
							<div class="help-block help-block-error "></div>
						</div>
						<div class="col-lg-2">
							<input type="text" name="Student[dob_yy]" class="form-control" maxlength="4" id="student-dob_yy" <?php if(!$model->isNewRecord){ ?> value="<?=date('Y', $model->dob)?>" <?php } ?>>
							<div class="help-block help-block-error "></div>
						</div>
					</div>
				</div>
				<div class="form-group field-student-image">
					<div class="row">
						<label for="student-image" class="control-label col-sm-3 form-control-label">Image</label>
						<div class="col-lg-4">
							<input type="hidden" value="" name="Student[image]">
							<div class="form-file">
								<input type="file" value="<?=$model->image?>" name="Student[image]" id="student-image">
								<button class="btn white">Select file ...</button>
							</div>
							<div class="help-block help-block-error "></div>
						</div>
					</div>
				</div>
				<div class="form-group field-student-bloodgroup">
					<div class="row">
						<label for="student-bloodgroup" class="col-sm-3 form-control-label">Bloodgroup</label>
						<div class="col-lg-4">
							<!--<input type="text" name="Student[bloodgroup]" class="form-control" id="student-bloodgroup">-->
							<select name="Student[bloodgroup]" class="form-control" id="student-bloodgroup">
								<option value="">--Select Bloodgroup--</option>
								<option value="A+" <?php if($model->bloodgroup == 'A+') { echo 'selected="selected"'; } ?>>A+</option>
								<option value="A-" <?php if($model->bloodgroup == 'A-') { echo 'selected="selected"'; } ?>>A-</option>
								<option value="B+" <?php if($model->bloodgroup == 'B+') { echo 'selected="selected"'; } ?>>B+</option>
								<option value="B-" <?php if($model->bloodgroup == 'B-') { echo 'selected="selected"'; } ?>>B-</option>
								<option value="AB+" <?php if($model->bloodgroup == 'AB+') { echo 'selected="selected"'; } ?>>AB+</option>
								<option value="AB-" <?php if($model->bloodgroup == 'AB-') { echo 'selected="selected"'; } ?>>AB-</option>
								<option value="O+" <?php if($model->bloodgroup == 'O+') { echo 'selected="selected"'; } ?>>O+</option>
								<option value="O-" <?php if($model->bloodgroup == 'O-') { echo 'selected="selected"'; } ?>>O-</option>
							</select>
							<div class="help-block help-block-error "></div>
						</div>
					</div>
				</div>
				<?php if(isset($model->fees) && $model->fees == 'Y'){ $checked = 'checked="checked"'; $style = 'style="display: block;"'; }else{ $checked = ''; $style = 'style="display: none;"'; } ?>
				<div class="form-group field-fees">
					<div class="row">
						<label class="control-label col-sm-3 form-control-label">Fees</label>
						<div class="col-lg-4">
							<!--<label class="md-check form-control-label">-->
							<label class="md-switch form-control-label">
								<input type="hidden" value="0" name="Student[fees]">
								<input type="checkbox" value="1" name="Student[fees]" id="student-fees" class="has-value" <?=$checked?>>
								<i class="blue"></i>
							</label>
							<div class="help-block help-block-error "></div>
						</div>
					</div>
				</div>
                                <div class="field-amount-wrapper" <?=$style?>>
					<?= $form->field($model, 'amount')->textInput(['maxlength' => true, 'placeholder' => 'Amount']) ?>
				</div>
				<hr>
				<h6 style="margin: 0;color: #003471;">Parent Information</h6>
				<hr>
				<?= $form->field($model, 'father_name')->textInput(['maxlength' => true, 'placeholder' => 'Father Name']) ?>
				<?= $form->field($model, 'grandfather_name')->textInput(['maxlength' => true, 'placeholder' => 'Grand Father Name']) ?>
				<?= $form->field($model, 'mother_name')->textInput(['maxlength' => true, 'placeholder' => 'Mother Name']) ?>
				<?= $form->field($model, 'parent_occupation')->textInput(['maxlength' => true, 'placeholder' => 'Parent Occupation']) ?>
				<?= $form->field($model, 'parent_income')->textInput(['maxlength' => true, 'placeholder' => 'Parent Income']) ?>
                <hr>
				<h6 style="margin: 0;color: #003471;">Contact Details</h6>
				<hr>
				<?= $form->field($model, 'mobile_no')->textInput(['maxlength' => true, 'placeholder' => 'Mobile Number1']) ?>
				<?= $form->field($model, 'parent_mobile')->textInput(['maxlength' => true, 'placeholder' => 'Mobile Number2']) ?>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>
				
				<hr>
				<h6 style="margin: 0;color: #003471;">Residence Address</h6>
				<hr>
				<?= $form->field($model, 'street')->textInput(['maxlength' => true, 'placeholder' => 'Road/Street/Maholla']) ?>
				<?= $form->field($model, 'city')->textInput(['maxlength' => true, 'placeholder' => 'City/Village']) ?>
				<?= $form->field($model, 'taluka')->textInput(['maxlength' => true, 'placeholder' => 'Taluka/Subdivision']) ?>
				<?php $states = Yii::$app->params['indian_all_states']; ?>
				<div class="form-group field-student-state required">
					<div class="row">
						<label for="student-state" class="control-label col-sm-3 form-control-label">State</label>
						<div class="col-lg-4">
							<select name="Student[state]" class="form-control" id="student-state" onchange="getdistrict(this.value);">
								<option value="">--Select State--</option>
								<?php
									foreach($states as $key=>$value){
										if($model->state == $key){ $selected = 'selected="selected"'; }else{ $selected = '';}
										echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
									}
								?>
							</select>
							<div class="help-block help-block-error "></div>
						</div>
					</div>
				</div>
				<div class="form-group field-student-district required">
					<div class="row">
						<label for="student-district" class="control-label col-sm-3 form-control-label">District</label>
						<div class="col-lg-4">
						<?php
							if(!$model->isNewRecord){
							$districts = Yii::$app->params['indian_all_district'][$model->state];
						?>
							<select name="Student[district]" class="form-control" id="student-district">
								<option value="">--Select District--</option>
								<?php
									foreach($districts as $district){
										if($model->district == $district) { $selected = 'selected="selected"'; }else{ $selected = ''; }
								?>
									<option value="<?=$district?>" <?=$selected?>><?=$district?></option>
								<?php
									}
								?>
							</select>
						<?php
							}else{
						?>
								<select name="Student[district]" class="form-control" id="student-district">
									<option value="">--Select District--</option>
								</select>
						<?php
							}
						?>
							<div class="help-block help-block-error "></div>
						</div>
					</div>
				</div>
				<?= $form->field($model, 'pincode')->textInput(['maxlength' => true, 'placeholder' => 'Pincode']) ?>
                <hr>
				<h6 style="margin: 0;color: #003471;">Detail Of Student Education</h6>
				<hr>
				<div class="form-group field-studenteducation-madrasa_name">
					<div class="row">
						<label for="studenteducation-madrasa_name" class="control-label col-sm-3 form-control-label">Madrasa Name</label>
						<div class="col-lg-4">
							<input type="text" name="Studenteducation[madrasa_name]" <?php if(!$model->isNewRecord){ ?> value="<?=$education->madrasa_name?>" <?php } ?> class="form-control" id="studenteducation-madrasa_name">
							<div class="help-block help-block-error "></div>
						</div>
					</div>
				</div>
				<div class="form-group field-studenteducation-nazra">
					<div class="row">
						<label for="studenteducation-nazra" class="control-label col-sm-3 form-control-label">Nazra</label>
						<div class="col-lg-4">
							<input type="hidden" name="Studenteducation[nazra]" value="0">
							<input type="checkbox" class="has-value" id="Studenteducation-nazra" name="Studenteducation[nazra]" value="1" <?php if(!$model->isNewRecord && $education->nazra == 'Y'){ echo 'checked="checked"'; $nazra_display = 'style="display:block;"'; }else{ $nazra_display = 'style="display:none;"'; } ?>>
							<div class="help-block help-block-error "></div>
						</div>
					</div>
				</div>
				<div <?=$nazra_display?> class="field-nazra_para-wrapper">
					<div class="form-group field-student-nazra_para">
						<div class="row">
							<label for="student-nazra_para" class="control-label col-sm-3 form-control-label">How many Para’s In Quran Sharif?</label>
							<div class="col-lg-4">
								<select name="Studenteducation[nazra_para]" class="form-control student-nazra_para" id="student-nazra_para">
									<option value="">--Select--</option>
									<?php for($i=1;$i<=30;$i++){ if($i<10){ $npPrefix = '0'; }else{ $npPrefix = ''; } ?>
										<?php if(!$model->isNewRecord && $education->nazra_para == $i){ $nazra_selected = 'selected="selected"'; }else{ $nazra_selected = ''; } ?>
										<option value="<?=$npPrefix.$i?>" <?=$nazra_selected?>><?=$npPrefix.$i?></option>
									<?php } ?>
								</select>
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group field-studenteducation-hifz">
					<div class="row">
						<label for="studenteducation-hifz" class="control-label col-sm-3 form-control-label">Hifz</label>
						<div class="col-lg-4">
							<input type="hidden" name="Studenteducation[hifz]" value="0">
							<input type="checkbox" class="has-value" id="Studenteducation-hifz" name="Studenteducation[hifz]" value="1" <?php if(!$model->isNewRecord && $education->hifz == 'Y'){ echo 'checked="checked"'; $hifz_display = 'style="display:block;"'; }else{ $hifz_display = 'style="display:none;"'; } ?>>
						</div>
					</div>
				</div>
				<div <?=$hifz_display?> class="field-hifz_para-wrapper">
					<div class="form-group field-student-hifz_para">
						<div class="row">
							<label for="student-nazra_para" class="control-label col-sm-3 form-control-label">How many Quran Sharif Para You Memorised?</label>
							<div class="col-lg-4">
								<select name="Studenteducation[hifz_para]" class="form-control student-hifz_para" id="student-hifz_para">
									<option value="">--Select--</option>
									<?php for($i=1;$i<=30;$i++){ if($i<10){ $npPrefix = '0'; }else{ $npPrefix = ''; } ?>
									<?php if(!$model->isNewRecord && $education->hifz_para == $i){ $hifz_selected = 'selected="selected"'; }else{ $hifz_selected = ''; } ?>
										<option value="<?=$npPrefix.$i?>" <?=$hifz_selected?>><?=$npPrefix.$i?></option>
									<?php } ?>
								</select>
								<div class="help-block help-block-error "></div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group field-studenteducation-urdu">
					<div class="row">
						<label for="studenteducation-urdu" class="control-label col-sm-3 form-control-label">Urdu</label>
						<div class="col-lg-4">
							<input type="hidden" name="Studenteducation[urdu]" value="0">
							<input type="checkbox" class="has-value" id="Studenteducation-urdu" name="Studenteducation[urdu]" value="1" <?php if(!$model->isNewRecord && $education->urdu == 'Y'){ echo 'checked="checked"'; } ?>>
						</div>
					</div>
				</div>
				<div class="form-group field-studenteducation-arabic">
					<div class="row">
						<label for="studenteducation-arabic" class="control-label col-sm-3 form-control-label">Arabic</label>
						<div class="col-lg-4">
							<input type="hidden" name="Studenteducation[arabic]" value="0">
							<input type="checkbox" class="has-value" id="Studenteducation-arabic" name="Studenteducation[arabic]" value="1" <?php if(!$model->isNewRecord && $education->arabic == 'Y'){ echo 'checked="checked"'; } ?>>
						</div>
					</div>
				</div>
				<div class="form-group field-studenteducation-school_name">
					<div class="row">
						<label for="studenteducation-school_name" class="control-label col-sm-3 form-control-label">School Name</label>
						<div class="col-lg-4">
							<input type="text" name="Studenteducation[school_name]" <?php if(!$model->isNewRecord){ ?> value="<?=$education->school_name?>" <?php } ?> class="form-control" id="studenteducation-school_name">
							<div class="help-block help-block-error "></div>
						</div>
					</div>
				</div>
                <div class="form-group field-studenteducation-school_standard">
					<div class="row">
						<label for="studenteducation-school_standard" class="control-label col-sm-3 form-control-label">School Standard</label>
						<div class="col-lg-4">
							<input type="text" name="Studenteducation[school_standard]" <?php if(!$model->isNewRecord){ ?> value="<?=$education->school_standard?>" <?php } ?> class="form-control" id="studenteducation-school_standard">
							<div class="help-block help-block-error "></div>
						</div>
					</div>
				</div>
				<div class="form-group field-studenteducation-school_medium">
					<div class="row">
						<label class="control-label col-sm-3 form-control-label">Medium</label>
						<div class="col-lg-4">
							<!--<label class="md-check form-control-label">-->
							<?php if($model->isNewRecord) { $eng = 'checked="checked"'; }else{ $eng = ''; } ?>
							<label class="md-check form-control-label">
								<input type="radio" id="school_medium_urdu" class="has-value" name="Studenteducation[school_medium]" value="U" <?php if(!$model->isNewRecord && $education->school_medium == 'U'){ echo 'checked="checked"'; } ?>> Urdu
								<i class="blue"></i>
							</label>
							<label class="md-check form-control-label">
								<input type="radio" id="school_medium_english" class="has-value" name="Studenteducation[school_medium]" value="E" <?php if(!$model->isNewRecord && $education->school_medium == 'E'){ echo 'checked="checked"'; } ?> <?=$eng?>> English
								<i class="blue"></i>
							</label>
							<label class="md-check form-control-label">
								<input type="radio" id="school_medium_hindi" class="has-value" name="Studenteducation[school_medium]" value="H" <?php if(!$model->isNewRecord && $education->school_medium == 'H'){ echo 'checked="checked"'; } ?>> Hindi
								<i class="blue"></i>
							</label>
							<label class="md-check form-control-label">
								<input type="radio" id="school_medium_other" class="has-value" name="Studenteducation[school_medium]" value="O" <?php if(!$model->isNewRecord && $education->school_medium == 'O'){ echo 'checked="checked"'; } ?>> Other
								<i class="blue"></i>
							</label>
							<div class="help-block help-block-error "></div>
						</div>
					</div>
				</div>
				<div class="form-group field-studenteducation-grade">
					<div class="row">
						<label for="studenteducation-grade" class="control-label col-sm-3 form-control-label">Grade</label>
						<div class="col-lg-4">
							<input type="text" name="Studenteducation[grade]" <?php if(!$model->isNewRecord){ ?> value="<?=$education->grade?>" <?php } ?> class="form-control" id="studenteducation-grade">
							<div class="help-block help-block-error "></div>
						</div>
					</div>
				</div>
				<hr>
				<?php if(isset($model->is_selected) && $model->is_selected == 'Y'){ $disabled = 'disabled="disabled"'; }else{ $disabled = ''; } ?>
				<div class="form-group field-selected">
					<div class="row">
						<label class="control-label col-sm-3 form-control-label">Selected</label>
						<div class="col-lg-4">
							<!--<label class="md-check form-control-label">-->
							<?php if($model->isNewRecord) { $pending = 'checked="checked"'; }else{ $pending = ''; } ?>
							<label class="md-check form-control-label">
								<!--<input type="hidden" value="0" name="Student[is_selected]">-->
								<input type="radio" value="Y" name="Student[is_selected]" id="student-selected" class="has-value" <?php if(isset($model->is_selected) && $model->is_selected == 'Y'){ echo "checked"; } ?> <?=$disabled?>>Yes
								<i class="blue"></i>
							</label>
							<label class="md-check form-control-label">
								<input type="radio" value="N" name="Student[is_selected]" id="student-selected" class="has-value" <?php if(isset($model->is_selected) && $model->is_selected == 'N'){ echo "checked"; } ?> <?=$disabled?>>No
								<i class="blue"></i>
							</label>
							<label class="md-check form-control-label">
								<input type="radio" value="P" name="Student[is_selected]" id="student-selected" class="has-value" <?php if(isset($model->is_selected) && $model->is_selected == 'P'){ echo "checked"; } ?> <?=$disabled?> <?=$pending?>>Pending
								<i class="blue"></i>
							</label>
							<div class="help-block help-block-error "></div>
						</div>
					</div>
				</div>
                <?php
                    $division = Division::find()->where(['is_active'=>'Y', 'is_deleted'=>'N'])->all();
                    $dlistData = ArrayHelper::map($division,'id','division');
					
					$class = Classes::find()->where(['is_active'=>'Y', 'is_deleted'=>'N'])->all();
                    $clistData = ArrayHelper::map($class,'id','name');
					
					$subclass = Subclass::find()->where(['is_active'=>'Y', 'is_deleted'=>'N'])->all();
                    $slistData = ArrayHelper::map($subclass,'id','sub_class');
                ?>
                <?= $form->field($model, 'divison_id')->dropDownList($dlistData, ['prompt' => '-Select Division-']); ?>
				<?= $form->field($model, 'class_id')->dropDownList($clistData, ['prompt' => '-Select Class-']); ?>
				<?= $form->field($model, 'sub_class_id')->dropDownList($slistData, ['prompt' => '-Select Sub Class-']); ?>
                <div class="form-group">
					<div class="row">
						<div class="col-lg-offset-3 col-lg-9">
							<!--<button type="submit" class="btn btn-success"><?php //echo Yii::t('app', 'Submit'); ?></button>-->
							<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
							<?php echo Html::a('<button type="button" class="btn btn-default">'.Yii::t('app', 'Cancel').'</button>',["pending"]); ?>
						</div>
					</div>
				</div>
				  
			    <?php ActiveForm::end(); ?>
            </div>
        <!--</section>-->
    </div>
</div>
<script type="text/javascript">
	
	/*$( "#student-dob" ).datepicker({
		format: 'mm/dd/yyyy',
		autoclose: true,
		endDate: '-1d',
	});*/
	
	$(document).ready(function() {
		$("#student-parent_income, #student-parent_mobile, #student-mobile_no, #student-dob_yy, #student-contact_std, #student-landline_no, #student-pincode, #student-amount").keydown(function (e) {
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
        $('.field-fees input:checkbox').change(function(){
		if($('#student-fees').is(":checked")) {
			$('.field-amount-wrapper').css("display","block");
			$('#student-amount').attr('required');
		} else {
			$('.field-amount-wrapper').css("display","none");
			$('#student-amount').removeAttr('required');
		}
	});
	
	$('.field-register_status input:radio').change(function(){
		if($('#register_status_no').is(":checked")) {
			$('.field-how_old-wrapper').css("display","block");
			$('#student-how_old').attr('required');
		} else {
			$('.field-how_old-wrapper').css("display","none");
			$('#student-how_old').removeAttr('required');
		}
	});
	
	$('.field-studenteducation-nazra input:checkbox').change(function(){
		if($('#Studenteducation-nazra').is(":checked")) {
			$('.field-nazra_para-wrapper').css("display","block");
			$('#student-nazra_para').attr('required');
		} else {
			$('.field-nazra_para-wrapper').css("display","none");
			$('#student-nazra_para').removeAttr('required');
		}
	});
	
	$('.field-studenteducation-hifz input:checkbox').change(function(){
		if($('#Studenteducation-hifz').is(":checked")) {
			$('.field-hifz_para-wrapper').css("display","block");
			$('#student-hifz_para').attr('required');
		} else {
			$('.field-hifz_para-wrapper').css("display","none");
			$('#student-hifz_para').removeAttr('required');
		}
	});
	
	/*$('.field-fees input:checkbox').change(function(){
		if($(this).is(":checked")) {
			$('.field-amount-wrapper').slideDown();
		} else {
			$('.field-amount-wrapper').slideUp();
		}
	});*/
	
	jQuery.validator.addMethod("imagetype", function(value, element) {
		return this.optional(element) || /^.*\.(jpg|png|jpeg)$/i.test(value);
	}, "Plese Select .jpg .png or .jpeg Image");
	
    var form1 = $('#student-form');
	var error1 = $('.alert-danger', form1);
    var success1 = $('.alert-success', form1);
	form1.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block', // default input error message class
		focusInvalid: true, // do not focus the last invalid input
		//ignore: [],
		//ignore: "#job-walkin_time",
		rules: {
			"Student[how_old]": {
				required: function(){
					return $("#register_status_no").is(":checked");
				}
			},
                        "Student[amount]": {
				required: function(){
					return $("#student-fees").is(":checked");
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
			/*"Student[image]": {
				required: <?php echo ($model->isNewRecord) ? 'true' : 'false';?>,
				imagetype:true
			},*/
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
			},
			"Student[mobile_no]": {
				required: true,
				minlength: 10,
				maxlength: 10,
			},
			"Student[email]": {
				email:true
			},
			"Student[contact_std]": {
				required: true,
				maxlength: 7,
			},
			"Student[landline_no]": {
				required: true,
				maxlength: 7,
			},
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
			
            "Student[class_id]": {
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
			if (element.attr("name") == "User[image]") { // for uniform radio buttons, insert the after the given container
				error.addClass("no-left-padding").insertAfter("#image-error");
			}
			else if (element.attr("name") == "Job[skills]") { // for uniform radio buttons, insert the after the given container
				error.addClass("no-left-padding").insertAfter("#job-skills_tagsinput");
			}else {
				error.insertAfter(element); // for other inputs, just perform default behavoir
			}
		},
	});
</script>