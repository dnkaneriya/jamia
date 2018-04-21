<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SchoolExamMarks */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box-header">
School level Exam Marks
</div>
<?php
$form = ActiveForm::begin([
            'id' => 'studentMarkForm',
            'enableClientValidation' => true,
            'fieldConfig' => [
                'template' => '{input}{error}',
                'options' => []
            ],
            'options' => [
                'class' => 'form-horizontal',
            ]
        ])
?>
<div class="box-body">

<div class="form-group">
    <label class="control-label col-sm-3">Select Year *</label>
    <div class="col-sm-8">
        <?=
        $form->field($model, 'year')->dropDownList(
                $yearList, [
            'prompt' => 'Select Year',
                ]
        )
        ?>
    </div>
</div>

<div class="form-group">

    <label class="control-label col-sm-3">Select Class *</label>
    <div class="col-sm-8">
        <?=
        $form->field($model, 'class_id')->dropDownList(
                $classList, [
            'prompt' => 'Select Class',
            'onchange' => '
                            $( "select#schoolexammarks-subclass_id" ).html("showLoading");
                            $.post( "' . Yii::$app->urlManager->createAbsoluteUrl(['admin/mark/get-subclass-list']) . '?id=' . '"+$(this).val(), 
                            function(data) {
                                    $( "select#schoolexammarks-subclass_id" ).html(data);
                            });'
                ]
        )
        ?>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-sm-3">Select Sub Class *</label>

    <div class="col-sm-8">
        <?=
        $form->field($model, 'subclass_id')->dropDownList(
                $subclassList, [
            'prompt' => 'Select Subclass',
            'prompt' => 'Select Subclass',
            'onchange' => '
                $( "select#schoolexammarks-division_id" ).html("showLoading");
                $.post( "' . Yii::$app->urlManager->createAbsoluteUrl(['admin/mark/get-division-list']) . '?class_id=' . '"+$("#schoolexammarks-class_id").val()+"&subclass_id="+$(this).val(), 
                function(data) {
                        $( "select#schoolexammarks-division_id" ).html(data);
                });'
                ]
        )
        ?>

    </div>
</div>

<div class="form-group">
    <label class="control-label col-sm-3">Select Division *</label>
    <div class="col-sm-8">
        <?=
        $form->field($model, 'division_id')->dropDownList(
                $divisionList, [
                    'prompt' => 'Select Divison',
                    'onchange' => '  
                    $( "select#schoolexammarks-subject_id" ).html("showLoading");
                    $.post( "get-subject-list?class_id=' . '"+$("#schoolexammarks-class_id").val()+"&subclass_id="+$("#schoolexammarks-subclass_id").val(), 
                    function(data) {
                            $( "select#schoolexammarks-subject_id" ).html(data);
                    });
                    '
                ]
        )
        ?>
    </div>
</div>
    
<div class="form-group">
    <label class="control-label col-sm-3">Select Standard *</label>
    <div class="col-sm-8">
        <?=
        $form->field($model, 'standard_id')->dropDownList(
                $standardList, [
                    'prompt' => 'Select Standard',
                    'onchange' => '  
                    $( "select#schoolexammarks-semester_id" ).html("showLoading");
                    $.post( "get-semester-list?id=' . '"+$(this).val(), 
                    function(data) {
                            $( "select#schoolexammarks-semester_id" ).html(data);
                    });
                    '
                ]
        )
        ?>
    </div>
</div>    

<div class="form-group">
    <label class="control-label col-sm-3">Select Semester *</label>

    <div class="col-sm-8">
        <?=
        $form->field($model, 'semester_id')->dropDownList(
                $semesterList, [
            'prompt' => 'Select Semester',
                ]
        )
        ?>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-sm-3">Select Subject *</label>
    <div class="col-sm-8">
        <?=
        $form->field($model, 'subject_id')->dropDownList(
                $subjectList, [
            'prompt' => 'Select Subject',
                ]
        )
        ?>
    </div>
</div>

</div>

<div class="box-footer">
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-5">
            <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
        </div>
    </div>  
</div>
<?php ActiveForm::end() ?>