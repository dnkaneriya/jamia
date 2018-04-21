<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SchoolExam */
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
                        'id' => 'createSchoolExamForm',
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
                    <label class="conrol-label col-sm-3">Class</label>
                    <div class="col-sm-5">
                        <?= $form->field($model, 'class_id')->dropDownList($classList,
                                [
                                    'prompt' => 'Select Class',
                                    'onchange' => '
                                    $( "select#schoolexam-subclass_id" ).html("showLoading");
                                    $.post( "' . Yii::$app->urlManager->createAbsoluteUrl('admin/weightheight/get-subclass-list') . '?id=' . '"+$(this).val(), 
                                    function(data) {
                                            $( "select#schoolexam-subclass_id" ).html(data);

                                    });'
                                ]) ?>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="conrol-label col-sm-3">Subclass</label>
                    <div class="col-sm-5">
                        <?= $form->field($model, 'subclass_id')->dropDownList($subclassList,
                                [
                                    'prompt' => 'Select Subclass'
                                ]) ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-3">Standard</label>
                    <div class="col-sm-5">
                        <?= $form->field($model, 'standard')->textinput() ?>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="control-label col-sm-3">Total Marks</label>
                    <div class="col-sm-5">
                        <?= $form->field($model, 'total_mark')->textinput() ?>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="control-label col-sm-3">Passing Marks</label>
                    <div class="col-sm-5">
                        <?= $form->field($model, 'passing_mark')->textinput() ?>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="control-label col-sm-3">Number of Semesters</label>
                    <div class="col-sm-5">
                        <?= $form->field($model, 'no_of_semester')->textinput([
                            'onblur' => '$( "#semesters" ).html("showLoading");
                                    $.post( "' . Yii::$app->urlManager->createAbsoluteUrl('admin/school-exam/get-semesters') . '?number=' . '"+$(this).val(), 
                                function(data) {
                                    $( "#semesters" ).html(data);
                                });'
                        ]) ?>
                    </div>
                </div>
                
                <div id="semesters">
                    
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