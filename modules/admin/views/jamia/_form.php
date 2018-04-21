<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use app\models\Jamiacategory;
use app\models\Jamiaimage;

$category = Jamiacategory::find()->where(['is_active'=>'Y','is_deleted'=>'N'])->all();
$categoryList = ArrayHelper::map($category,'id','category');
if(!$model->isNewRecord)
	$model->album_date = date("d/m/Y",$model->album_date);
/* @var $this yii\web\View */
/* @var $model app\models\Jamia */
/* @var $form yii\widgets\ActiveForm */

if($model->isNewRecord)
{
	$images = array();
}else{
	$images = Jamiaimage::find()->where(['jamia_id'=>$model->id])->all();
}
?>
<link href="<?php echo Yii::$app->request->baseUrl; ?>/plugins/bootstrap-fileupload/bootstrap-fileupload.css"  rel="stylesheet">
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>

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
						echo '<h3>'.Yii::t('app', 'Add Jamia').'</h3>';
					}else{
						echo '<h3>'.Yii::t('app', 'Edit Jamia').'</h3>';
					}
				?>
            </div>
			<div class="box-divider m-a-0"></div>
            <div class="box-body">
                <!--<form class="form-horizontal" role="form">-->
				<?php $form = ActiveForm::begin([
                                            'id'=>'jamia-form',
											'layout'=>'horizontal',
											'options' => ['class' => 'form-horizontal','enctype'=>'multipart/form-data'],
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
                 <?= $form->field($model, 'name')->textInput(['maxlength' => 255]); ?>
			
				<?= $form->field($model, 'category_id')->dropDownList($categoryList); ?>
                <?= $form->field($model, 'album_date')->textInput(['maxlength' => 255,'id'=>'album_date']); ?>
                <div class="field-jamia-wrapper">
                <?php $count = 0; ?>
                <?php
				
				if(!$model->isNewRecord) { ?>
				<?php $userExpData = Jamiaimage::find()->where(['jamia_id' => $model->id])->all();
				if($userExpData != array())
				{
					foreach($userExpData as $exp)
					{
				?>
                <div class="form-group last <?=$count?>">
                	<label for="user-image<?=$count?>" class="control-label col-sm-2 form-control-label">Image</label>
                    <div class="col-md-10">
                    	<div class="fileupload fileupload-new" data-provides="fileupload">
                        	<input type="hidden" value="<?=$exp->id?>" name="Jamiaimage[id][<?=$count?>]">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                             <?php if($exp->image != '') {
										echo '<img src="'.Yii::$app->request->baseUrl.'/'.$exp->image.'" />';
                                } else { ?>
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                <?php } ?>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 2px;"></div>
                        <div>
                        <span class="btn default btn-file">
                        	<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                            <input type="file" class="default" name="Jamiaimage[image][<?=$count?>]">
                        </span>
                     </div>
                   </div>
                </div>
              </div>
                <?php $count+=1;} } ?>
                
               <?php }  ?>
                  
            </div>
            
                <div class="form-group">
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="btn-add btn-add-images col-md-4">
							<img src="<?php echo Url::to('@web/img/add.svg',true); ?>">
							<div>Add Jamiah Image</div>
						</div>
					</div>
				</div>
                
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
 expGroup = <?php echo $count; ?>;
$("#jamia-form").on("click", '.btn-add-images', function(){
		$(".field-jamia-wrapper")
			.append(
				'<div class="form-group last '+expGroup+'"><label for="user-image'+expGroup+'" class="control-label col-sm-2 form-control-label">Image</label><div class="col-md-10"><div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden" value="" name="Jamiaimage[id]['+expGroup+']"><div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""></div><div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 2px;"></div><div><span class="btn default btn-file"><span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span><input type="file" class="default" name="Jamiaimage[image]['+expGroup+']"></span></div></div></div></div>');
		
		expGroup++;
	});





     $( "#album_date" ).datepicker({
		format: 'dd-mm-yyyy',
		autoclose: true,
	});
	
	
    var form1 = $('#jamia-form');
	var error1 = $('.alert-danger', form1);
    var success1 = $('.alert-success', form1);
	form1.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block', // default input error message class
		focusInvalid: true, // do not focus the last invalid input
        //ignore: "",
		rules: {
			"Jamia[name]": {
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
