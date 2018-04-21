<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SchoolSubject */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box-header">
    <h2> Student Progress </h2>
</div>
<?php
    $form = ActiveForm::begin([
        'id' => 'schoolSubject',
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
        <label class="col-sm-3 control-label">Year</label>
        <div class="col-sm-5">
            <?= $form->field($model, 'year')->dropDownList($yearList,
                    [
                        'prompt' => 'Select Year'
                    ]
                    ) ?>
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-sm-3 control-label">Month*</label>
        <div class="col-sm-5">
            <?=
            $form->field($model, 'month')->dropDownList(
                    $monthList, [
                'prompt' => 'Select Month',
                    ]
            )
            ?>
        </div>
    </div>
    
    <div class="form-group row">
        <label class="control-label col-sm-3">Class</label>
        <div class="col-sm-5">
            <?= $form->field($model, 'class_id')->dropDownList($classList,
                    [
                        'prompt' => 'Select Class',
                        'onchange' => '
                                $( "select#studentprogress-subclass_id" ).html("showLoading");
                                $.post( "' . Yii::$app->urlManager->createAbsoluteUrl('admin/weightheight/get-subclass-list') . '?id=' . '"+$(this).val(), 
                                function(data) {
                                        $( "select#studentprogress-subclass_id" ).html(data);
                                });'
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
        <label class="control-label col-sm-3">Category</label>
        <div class="col-sm-5">
            <?= $form->field($model, 'category')->dropDownList(['1' => 'Islamic', '2' => 'School'],
                    [
                        'prompt' => 'Select Category',
                        'onchange' => '
                                $( "select#studentprogress-subject_id" ).html("showLoading");
                                $.post( "' . Yii::$app->urlManager->createAbsoluteUrl('admin/student-progress/get-subject-list') . '?id=' . '"+$(this).val() + "&class_id=" + $("#studentprogress-class_id").val() + "&subclass_id=" + $("#studentprogress-subclass_id").val(), 
                                function(data) {
                                        $( "select#studentprogress-subject_id" ).html(data);
                                });'
                    ]) ?>
        </div>
    </div>
    
    <div class="form-group row">
        <label class="control-label col-sm-3">Subject</label>
        <div class="col-sm-5">
            <?= $form->field($model, 'subject_id')->dropDownList([],
                    [
                        'prompt' => 'Select Subject',
                    ]) ?>
        </div>
    </div>
    
</div>

<div class="box-footer">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
