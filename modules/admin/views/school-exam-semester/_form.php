<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SchoolExamSemester */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box-header">
    School Exam Semester
</div>
<?php
    $form = ActiveForm::begin([
        'id' => 'schoolExamSemester',
        'enableClientValidation' => true,
        'fieldConfig' => [
            'template' => '{input}{error}',
            'options' => []
        ],
        'options' => [
            'class' => 'form-horizontal'
        ]
    ]);
?>
<div class="box-body">
    <div class="form-group row">
        <label class="control-label col-sm-3">Class</label>
        <div class="col-sm-5">
            <?= $form->field($model, 'class_id')->dropDownList($classList,
                    [
                        'prompt' => 'Select Class',
                    ]) ?>
        </div>
    </div>
    
    <div class="form-group row">
        <label class="control-label col-sm-3">Sub Class</label>
        <div class="col-sm-5">
            <?= $form->field($model, 'subclass_id')->dropDownList($subclassList,
                    [
                        'prompt' => 'Select SubClass',
                    ]) ?>
        </div>
    </div>
    
    <div class="form-group row">
        <label class="control-label col-sm-3">Semester</label>
        <div class="col-sm-5">
            <?= $form->field($model, 'semester')->textInput() ?>
        </div>
    </div>
    
    <div class="form-group row">
        <label class="control-label col-sm-3">Semester Marks</label>
        <div class="col-sm-5">
            <?= $form->field($model, 'semester_marks')->textInput() ?>
        </div>
    </div>
</div>

<div class="box-footer">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>
<?php
    ActiveForm::end();
?>