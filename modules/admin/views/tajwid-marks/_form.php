<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\TajwidMarks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <?php
                        if($model->isNewRecord) {
                                echo '<h3>'.Yii::t('app', 'Create New').'</h3>';
                        }else{
                                echo '<h3>'.Yii::t('app', 'Edit').'</h3>';
                        }
                ?>
            </div>
            <?php
            $form = ActiveForm::begin([
                'id' => 'createTajwidMarksForm',
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
                <div class="form-group">
                    <label class="control-label col-sm-3">Select Year *</label>
                    <div class="col-sm-8">
                        <?= $form->field($model, 'year')->dropDownList(
                                $yearList,
                                [
                                    'prompt' => 'Select Year'
                                ]
                                ) ?>
                   
                    </div>
                </div>
                
<!--                <div class="form-group">
                    <label class="control-label col-sm-3">Class</label>
                    <div class="col-sm-8">
                        <?= $form->field($model, 'class_id')->dropDownList(
                                $tajwidClassList,
                                [
                                    'prompt' => 'Select Class'
                                ]
                                ) ?>
                   
                    </div>
                </div>-->
                
                <div class="form-group">

                <label class="control-label col-sm-3">Select Class *</label>
                <div class="col-sm-8">
                    <?=
                    $form->field($model, 'class_id')->dropDownList(
                            $tajwidClassList, [
                        'prompt' => 'Select Class',
                        'onchange' => '
                            $( "select#tajwidmarks-subject_id" ).html("showLoading");
                            $.post( "get-subject-list?id=' . '"+$(this).val(), 
                            function(data) {
                                    $( "select#tajwidmarks-subject_id" ).html(data);
                            });'
                            ]
                    )
                    ?>
                </div>
            </div>
                
                
                
                
                <div class="form-group">
                    <label class="control-label col-sm-3">Select Subject *</label>
                    <div class="col-sm-8">
                        <?= $form->field($model, 'subject_id')->dropDownList(
                                [],
                                [
                                    'prompt' => 'Select Subject'
                                ]
                                ) ?>
                   
                    </div>
                </div>
            </div>
            
            <div class="box-footer">
                <div class="form-group">
                    <div class="col-sm-5 col-sm-offset-3">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
            
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>