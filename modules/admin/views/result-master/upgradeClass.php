<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Classes;

?>

<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            
        	<div class="row">
			    <div class="col-lg-12">
			        <!--<section class="panel">-->
			            <div class="box-header">
			                Upgrade Class
			            </div>
			            <div class="box-divider m-a-0"></div>
			            <div class="box-body">

			            <?php $form = ActiveForm::begin([
			            	'id' => 'upgradeClassForm',
			            	'enableClientValidation' => true,
			            	'fieldConfig' => [
			            		'template' => '{input}{error}',
			            		'options' => [
			            			//'tag' => false,
			            		]
			            	],
			            	'options' => [
			            		'class' => 'form-horizontal'
			            	]
			            ]) ?>	

			            <div class="form-group">
			            	<label class="col-sm-3 control-label">Old Class*</label>
			            	<div class="col-sm-8">
			            		<?= $form->field($model, 'class_id')->dropDownList(
	                            ArrayHelper::map(Classes::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name'),
	                            [
	                                'prompt' => 'Select Class',
	                                'onchange' => '
	                                        $( "select#classupgrademaster-upgrade_id" ).html("showLoading");
	                                        $.post( "get-upgrade-class-list?id='.'"+$(this).val(), 
	                                        function(data) {
	                                                $( "select#classupgrademaster-upgrade_id" ).html(data);
	                                        });'
	                            ]
	                        ) ?>
			            	</div>
			            </div>
			            		<br><br><br>
			            <div class="form-group">
			            	<label class="col-sm-3 control-label">New Class*</label>
			            	<div class="col-sm-8">
			            		<?= $form->field($model, 'upgrade_id')->dropDownList([],
	                            [
	                                'prompt' => 'Select Class',
	                            ]
	                        ) ?>
			            	</div>
			            </div>
			            <br><br>
			            <div class="form-group">
		                    <div class="col-sm-offset-3 col-sm-5">
		                        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
		                    </div>
		                </div>

			            <?php ActiveForm::end() ?>
			            </div>
			    </div>
			</div>            
        </div>
    </div>
</div>