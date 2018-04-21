<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Complaint */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <?php
                        if($model->isNewRecord) {
                                echo '<h3>'.Yii::t('app', 'Add Complaint').'</h3>';
                        }else{
                                echo '<h3>'.Yii::t('app', 'Edit Complaint').'</h3>';
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
                <div class="form-group">
                    <label class="control-label col-sm-3">Student</label>
                    <div class="col-sm-8">
                        <?= $form->field($model, 'student_id')->dropDownList(
                                $studentList,
                                [
                                    'prompt' => 'Select Student'
                                ]
                                ) ?>
                   
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-3">Date</label>
                    <div class="col-sm-8">
                        <?= $form->field($model, 'c_date')->widget(DatePicker::classname(), [
                            'options' => ['placeholder' => 'Select Date'],
                            'pluginOptions' => [
                                'autoclose'=>true
                            ]
                        ]); ?>
                        
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-3">Comment</label>
                    <div class="col-sm-8">
                        <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
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
