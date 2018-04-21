<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use app\models\Category;
use app\models\Leavetype;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Leave */
/* @var $form yii\widgets\ActiveForm */

$category=Category::find()->where(['is_deleted'=>'N'])->all();
$categorylist=ArrayHelper::map($category,'id','category');

$Leavetype=Leavetype::find()->where(['is_deleted'=>'N'])->all();
$typelist=ArrayHelper::map($Leavetype,'id','name');
?>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
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
<div class="row">
    <div class="col-lg-12">
		<!--<section class="panel">-->
            <div class="box-header">
				<?php
					if($model->isNewRecord) {
						echo '<h3>'.Yii::t('app', 'Add Staff Leave').'</h3>';
					}else{
						echo '<h3>'.Yii::t('app', 'Edit Staff Leave').'</h3>';
					}
				?>
            </div>
			<div class="box-divider m-a-0"></div>
            <div class="box-body">
                <!--<form class="form-horizontal" role="form">-->
				<?php $form = ActiveForm::begin([
                                            'id'=>'leave-form',
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
													'wrapper' => 'col-lg-6',
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
				<?php echo Yii::$app->getSession()->getFlash('flash_msg'); ?>
                <?= $form->field($model, 'staff_cat_id')->dropDownList($categorylist, ['prompt' => '-Select Staff Category-','class'=>'form-control changecategory']); ?>
                <div class="dispstaff"></div>
                <?= $form->field($model, 'type_id')->dropDownList($typelist, ['prompt' => '-Select Leave Type-']); ?>
                 <?= $form->field($model, 'reason')->textarea(['rows' => 6]) ?>
                <?= $form->field($model, 'leave_date')->textInput(['maxlength' => 255,'id'=>'leave_date']); ?>
               
               
               
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
    $( "#leave_date" ).datepicker({
		format: 'dd-mm-yyyy',
		autoclose: true,
	});
	$('.changecategory').change(function(){
		getstaff($(this).val(),'');
	});
	<?php if(!$model->isNewRecord){?>
	getstaff($(".changecategory option:selected").val(),<?=$model->staff_id?>);
	 <?php } ?>
	function getstaff(id,staff_id){
		if(id != '')
		{
			if(id == 2)
				jQuery('#leave-type_id').children('option[value="1"]').css('display','none');
			else
				jQuery('#leave-type_id').children('option[value="1"]').css('display','block');			
			$(".dispstaff").html('');
			$.ajax({type: "GET",
				url: "getstaff",
				data: { id: id,staff_id:staff_id},
				success:function(result){
					if(result != '')
						$(".dispstaff").html(result);
				}
			});
		}else $(".dispstaff").html('');
	}
    var form1 = $('#staff-form');
	var error1 = $('.alert-danger', form1);
    var success1 = $('.alert-success', form1);
	form1.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block', // default input error message class
		focusInvalid: true, // do not focus the last invalid input
        //ignore: "",
		rules: {
			"Leave[staff_cat_id]": {
				required: true
			},
			"Leave[staff_id]": {
				required: true
			},
			"Leave[type_id]": {
				required: true
			},
			"Leave[reason]": {
				required: true
			},
			"Leave[leave_date]": {
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
