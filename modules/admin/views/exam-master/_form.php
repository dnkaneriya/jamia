<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ExamMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-lg-12">
        <!--<section class="panel">-->
        <div class="box-header">
            Class Upgrade
        </div>
        <div class="box-divider m-a-0"></div>
        <div class="box-body">

        <?php $form = ActiveForm::begin([
               'id' => 'createExamForm',
               'enableClientValidation' => true,
               'fieldConfig' => [
                    'template' => '{input}{error}',
               ],
               'options' => [
                    'class' => 'form-horizontal',
               ]
        ])?>

        <div class="form-group">
            <label class="col-sm-3 control-label">Exam Name*</label>
            <div class="col-sm-8">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>                
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Total Marks*</label>
            <div class="col-sm-8">
                <?= $form->field($model, 'total_marks')->textInput(['maxlength' => true]) ?>                
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Passing Marks*</label>
            <div class="col-sm-8">
                <?= $form->field($model, 'passing_marks')->textInput(['maxlength' => true]) ?>                
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-8">
                <?= $form->field($model, 'class_upgrade')->checkbox() ?>                
            </div>
        </div>    
            
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-5">
                <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>