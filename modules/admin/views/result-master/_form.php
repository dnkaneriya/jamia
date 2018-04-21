<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Classes;
use app\models\Division;
use app\models\Student;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResultMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-lg-12">
        <!--<section class="panel">-->
            <div class="box-header">
                Add Result
            </div>
            <div class="box-divider m-a-0"></div>
            <div class="box-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'addResultForm',
                    'enableClientValidation' => true,
                    'fieldConfig' => [
                        'template' => "{input}{error}",
                        'options' => [
                            //'tag' => false
                        ]
                    ],
                    'options' => [
                        'class' => 'form-horizontal'
                    ]
                ]); ?>

                <div class="form-group">
                    <label class="control-label col-sm-3">Class</label>
                    <div class="col-sm-8">
                        <?= $form->field($model, 'class_id')->dropDownList(
                            ArrayHelper::map(Classes::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name'),
                            [
                                'prompt' => 'Select Class',
                                'onchange' => '
                                        $( "select#resultmaster-division_id" ).html("showLoading");
                                        $.post( "fetch-divisions?id='.'"+$(this).val(), 
                                        function(data) {
                                                $( "select#resultmaster-division_id" ).html(data);
                                        });'
                            ]
                        ) ?>  
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Division</label>
                    <div class="col-sm-8">
                        <?= $form->field($model, 'division_id')->dropDownList(
                            ArrayHelper::map(Division::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'division'),
                            [
                                'prompt' => 'Select Division',
                                'onchange' => '
                                        $( "select#resultmaster-student_id" ).html("showLoading");
                                        $.post( "fetch-students?id='.'"+$(this).val(), 
                                        function(data) {
                                                $( "select#resultmaster-student_id" ).html(data);
                                        });'
                            ]
                        ) ?>  
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Student Gr.No.</label>
                    <div class="col-sm-8">
                        <?= $form->field($model, 'student_id')->dropDownList([],
                            [
                                'prompt' => 'Select Student',
                                'onchange' => '
                                        $( "#marks_grid" ).html("showLoading");
                                        $.post( "show-student-marks?id='.'"+$(this).val(), 
                                        function(data) {
                                                $( "#marks_grid" ).html(data);
                                        });'
                            ]
                        ) ?>  
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12" id="marks_grid">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
                    </div>
                </div>                

                <?php ActiveForm::end() ?>
            </div>
    </div>
</div>            
<?php /*
<div class="result-master-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'class_id')->textInput() ?>

    <?= $form->field($model, 'division_id')->textInput() ?>

    <?= $form->field($model, 'student_id')->textInput() ?>

    <?= $form->field($model, 'result')->dropDownList([ 'P' => 'P', 'F' => 'F', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'is_active')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'is_deleted')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'i_by')->textInput() ?>

    <?= $form->field($model, 'i_date')->textInput() ?>

    <?= $form->field($model, 'u_by')->textInput() ?>

    <?= $form->field($model, 'u_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
*/ ?>