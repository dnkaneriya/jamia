<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;


use app\models\Subject;
use app\models\Mark;
/* @var $this yii\web\View */
/* @var $model app\models\Mark */
/* @var $form yii\widgets\ActiveForm */

$mark_arr=Mark::find()->where(['grno'=>$model->grno])->all();
?>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/scripts/jquery.validate.min.js"></script>
<div class="row">
    <div class="col-lg-12">
		<!--<section class="panel">-->
            <div class="box-header">
				<?php
						echo '<h3>'.Yii::t('app', 'Update Student Mark').'</h3>';
				?>
            </div>
			<div class="box-divider m-a-0"></div>
            <div class="box-body">
                <!--<form class="form-horizontal" role="form">-->
				<?php $form = ActiveForm::begin([
                                            'id'=>'mark-form',
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
                
                <div class="form-group field-mark-grno required">
                    <div class="row"><label class="control-label col-sm-2 form-control-label" for="mark-grno">GR No</label>
                        <div class="col-lg-4">
                            <input type="hidden" name="student_id" class="form-control" value="<?php echo $model->student_id; ?>" />
                                   <input type="text" id="mark-grno" class="form-control has-value" name="Mark[grno]" value="<?php echo $model->grno; ?>" maxlength="255" placeholder="GR No" readonly="readonly">

                        </div>
                    </div>
                </div>
				<?php $i=0;foreach($mark_arr as $mark){
					
					$subject=Subject::find()->where(['id'=>$mark->subject_id])->one();
					?>
                        <div class="form-group field-mark-marks">
                            <div class="row"><label class="control-label col-sm-2 form-control-label" for="mark-marks"><?=$subject->name_ar?></label>
                                <div class="col-lg-4">
                                <input type="text" id="mark-marks" class="form-control has-value" name="Mark[marks][<?=$i?>]" value="<?=$mark->marks?>" maxlength="255" placeholder="Marks"><span for="mark-marks" class="help-block"></span>
                                <input type="hidden" name="Mark[ids][<?=$i?>]" value='<?=$mark->id?>' />
                                 
                                <div class="help-block help-block-error "></div>
                                </div>
                              </div>
                            </div>
                        
                    <?php $i++;}?>
                
                
                <div class="form-group">
					<div class="row">
						<div class="col-lg-offset-2 col-lg-10">
							<!--<button type="submit" class="btn btn-success"><?php //echo Yii::t('app', 'Submit'); ?></button>-->
							<?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
							<?php echo Html::a('<button type="button" class="btn btn-default">'.Yii::t('app', 'Cancel').'</button>',["index"]); ?>
						</div>
					</div>
				</div>
				  
			    <?php ActiveForm::end(); ?>
            </div>
        <!--</section>-->
    </div>
</div>
<script>
$('#mark-grno').on('input', function(){
    var options = $('datalist')[0].options;
    for (var i=0;i<options.length;i++){
       if (options[i].value == $(this).val()) 
         {
			 var id=$('#mark-grno').data('id');
			 var gr = $(this).val();
			 callsubject(gr,id);
		 }else $(".dispdata").html('');
    }
});
<?php if(!$model->isNewRecord){?>
	callsubject($('#mark-grno').val());
<?php } ?>
function callsubject(gr,id){
	$.ajax({type: "GET",
		url: "getsubdata",
		data: { id: gr, mid:id},
		success:function(result){
			if(result != '')
				$(".dispdata").html(result);
		}
	});
}
</script>
<script type="text/javascript">
    var form1 = $('#mark-form');
	var error1 = $('.alert-danger', form1);
    var success1 = $('.alert-success', form1);
	form1.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block', // default input error message class
		focusInvalid: true, // do not focus the last invalid input
		ignore: [],
		//ignore: "#job-walkin_time",
		rules: {
            "Mark[grno]": {
				required: true,
				digits:true,
			},
			"Mark[marks][0]": {
				required: true
				digits:true
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