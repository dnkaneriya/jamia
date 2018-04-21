<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LetterMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <?php
                if ($model->isNewRecord) {
                    echo '<h3>' . Yii::t('app', 'Add Letter') . '</h3>';
                } else {
                    echo '<h3>' . Yii::t('app', 'Edit Letter') . '</h3>';
                }
                ?>
            </div>
            <?php
            $form = ActiveForm::begin([
                        'id' => 'createComplaintForm',
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
                    ])
            ?>
            <div class="box-body">
                <div class="form-group row">
                    <label class="control-label col-sm-3">Type</label>
                    <div class="col-sm-5">
                        <?= $form->field($model,'type')->dropDownList(
                                ['0' => 'Sender','1' => 'Receiver'], 
                                [
                                    'prompt' => 'Select Type',
                                    'onchange' => 'var letterType = $(this).val();
                                        
                                        if(letterType == 0) {
                                            $("#lettermaster-to").parent().parent().parent().css({"display": "block"});
                                            $("#lettermaster-from").parent().parent().parent().css({"display": "none"});
                                        	$("#lettermaster-content").parent().parent().parent().css({"display": "block"});
                                        	$("#replyDiv").css({"display": "none"});
                                        } else if(letterType == 1){
                                            $("#lettermaster-to").parent().parent().parent().css({"display": "none"});
                                            $("#lettermaster-from").parent().parent().parent().css({"display": "block"});
                                            $("#lettermaster-content").parent().parent().parent().css({"display": "none"});
                                        	$("#replyDiv").css({"display": "block"});
                                        } else {
                                            $("#lettermaster-to").parent().parent().parent().css({"display": "none"});
                                            $("#lettermaster-from").parent().parent().parent().css({"display": "none"});
                                        }
                                    '
                                ]) ?>
                    </div>
                </div>

                <div class="form-group row" style="display:none">
                    <label class="control-label col-sm-3">To</label>
                    <div class="col-sm-5">
                        <?= $form->field($model, 'to')->textInput(['maxlength' => true]) ?>

                    </div>
                </div>

                <div class="form-group row" style="display:none">
                    <label class="control-label col-sm-3">From</label>
                    <div class="col-sm-5">
                        <?= $form->field($model, 'from')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-3">Subject</label>
                    <div class="col-sm-5">
                        <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            
                <div class="form-group row" style="display:none" id="replyDiv">
                	<label class="control-label col-sm-3">Reply</label>
                	<div class="col-sm-5">
                		<?= Html::radioList('reply', 0, [0 => 'No', 1 => 'Yes'], [
						    'class' => '',
						    'onchange' => 'var replyval = $( "input[name=reply]:checked" ).val();
						    	if(replyval == 0) {
						    		$("#lettermaster-content").parent().parent().parent().css({"display": "none"});
						    	} else {
						    		$("#lettermaster-content").parent().parent().parent().css({"display": "block"});
						    	}
						    ',
						    'itemOptions' => ['class' => 'radio'],
						]); ?>
                	</div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-3">Content</label>
                    <div class="col-sm-5">
                        <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
                    </div>
                </div>
            </div>
            
            
            
        
            <div class="box-footer">
                <div class="form-group row">
                    <div class="col-sm-5 col-sm-offset-3">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>

