<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\Classes;
use app\models\Student;

/* @var $this yii\web\View */
/* @var $model app\models\Job */
/* @var $form yii\widgets\ActiveForm */
$month=Yii::$app->params['islamic_month_en'];
?>

<!--<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/scripts/jquery.tagsinput.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/plugins/bootstrap-daterangepicker/moment.min.js"></script>
 -->
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
<?php
	//echo "<pre>";print_r($companyModel);die;
	$controller = strtolower(Yii::$app->controller->id);
	$action = strtolower(Yii::$app->controller->action->id);
?>
<div class="row">
    <div class="col-lg-12">
		<!--<section class="panel">-->
            <div class="box-header">
				<?php
					if($model->isNewRecord) {
						echo '<h3>'.Yii::t('app', 'Add Weight & Height').'</h3>';
					}else{
						echo '<h3>'.Yii::t('app', 'Edit Weight & Height').'</h3>';
					}
				?>
            </div>
			<div class="box-divider m-a-0"></div>
            <div class="box-body">
                <!--<form class="form-horizontal" role="form">-->
				<?php $form = ActiveForm::begin([
                                            'id'=>'weightheight-form',
											'layout'=>'horizontal',
											'options' => ['class' => 'form-horizontal'],
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
				<div class="alert alert-danger display-hide">
					<button class="close" data-close="alert"></button>
					<?php echo Yii::t('app', 'You have some form errors. Please check below'); ?>
				</div>
				<div class="alert alert-success display-hide">
					<button class="close" data-close="alert"></button>
					Your form validation is successful!
				</div>
                <?php
                    $student = Student::find()->where(['is_active'=>'Y', 'is_deleted'=>'N','is_selected'=>'C'])->all();
                    $slistData = ArrayHelper::map($student,'id','fullname');
					
					$class = Classes::find()->where(['is_active'=>'Y', 'is_deleted'=>'N'])->all();
                    $clistData = ArrayHelper::map($class,'id','name');
					
                ?>
                <?= $form->field($model, 'student_id')->dropDownList($slistData, ['prompt' => '-Select Student-']); ?>
               	<div class="form-group field-date">
                    <div class="row">
                        <label class="control-label col-sm-2 form-control-label" for="weightheight-t_year">Year</label>
                        <div class="col-lg-4">
                        <select name="Weightheight[t_year]" class="form-control" id="weightheight-t_year">
                        <?php for($i=1430;$i<=1600;$i++){ ?>
                           		<option value="<?php echo $i; ?>"  <?php echo $model->t_year==$i?'selected="selected"':''; ?> ><?php echo $i; ?></option>
                           <?php } ?>
                        	
                           </select>
                            <div class="help-block help-block-error "></div>
                        </div>
                    </div>
                </div>
                <div class="form-group field-date">
                    <div class="row">
                        <label class="control-label col-sm-2 form-control-label" for="weightheight-month">Month</label>
                        <div class="col-lg-4">
                        <select name="Weightheight[t_month]" class="form-control" id="weightheight-month">
                           <?php if($model->isNewRecord) $model->t_month=date('m');?>
                           <?php foreach($month as $key=>$value){ ?>
                           		<option value="<?php echo $key; ?>" <?php echo $model->t_month==$key?'selected="selected"':''; ?>><?php echo $value; ?></option>
                           <?php } ?>
                           </select>
                            <div class="help-block help-block-error "></div>
                        </div>
                    </div>
                </div>
                <?= $form->field($model, 'weight')->textInput(['maxlength' => true, 'placeholder' => 'Weight']) ?>
                <?= $form->field($model, 'height')->textInput(['maxlength' => true, 'placeholder' => 'Height']) ?>

				<div class="form-group">
					<div class="row">
						<div class="col-lg-offset-2 col-lg-10">
							<!--<button type="submit" class="btn btn-success"><?php //echo Yii::t('app', 'Submit'); ?></button>-->
							<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
							<?php echo Html::a('<button type="button" class="btn btn-default">'.Yii::t('app', 'Cancel').'</button>',["index"]); ?>
						</div>
					</div>
				</div>
				  
			    <?php ActiveForm::end(); ?>
            </div>
        <!--</section>-->
    </div>
</div>
<script type="text/javascript">
	
	
    var form1 = $('#weightheight-form');
	var error1 = $('.alert-danger', form1);
    var success1 = $('.alert-success', form1);
	form1.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block', // default input error message class
		focusInvalid: true, // do not focus the last invalid input
		ignore: [],
		//ignore: "#job-walkin_time",
		rules: {
			"Weightheight[weight]": {
				required: true
			},
			"Weightheight[height]": {
				required: true
			},
			"Weightheight[student_id]": {
				required: true
			},
            "Weightheight[t_year]": {
				required: true
			},
            "Weightheight[t_month]": {
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