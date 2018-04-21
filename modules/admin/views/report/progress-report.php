<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SchoolSubject */
/* @var $form yii\widgets\ActiveForm */
?>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">

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
                        <?=
                        $form->field($model, 'year')->dropDownList($yearList, [
                            'prompt' => 'Select Year'
                                ]
                        )
                        ?>
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
                        <?=
                        $form->field($model, 'class_id')->dropDownList($classList, [
                            'prompt' => 'Select Class',
                            'onchange' => '
                                $( "select#dynamicmodel-subclass_id" ).html("showLoading");
                                $.post( "' . Yii::$app->urlManager->createAbsoluteUrl('admin/weightheight/get-subclass-list') . '?id=' . '"+$(this).val(), 
                                function(data) {
                                        $( "select#dynamicmodel-subclass_id" ).html(data);
                                });'
                        ])
                        ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-3">Sub Class</label>
                    <div class="col-sm-5">
                        <?=
                        $form->field($model, 'subclass_id')->dropDownList($subclassList, [
                            'prompt' => 'Select SubClass',
                            'onchange' => '
                                $( "select#dynamicmodel-division_id" ).html("showLoading");
                                $.post( "' . Yii::$app->urlManager->createAbsoluteUrl('admin/weightheight/get-division-list') . '?subclass_id=' . '"+$(this).val()+"&class_id="+$("#dynamicmodel-class_id").val(), 
                                function(data) {
                                        $( "select#dynamicmodel-division_id" ).html(data);
                                });'
                        ])
                        ?>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="control-label col-sm-3">Division</label>
                    <div class="col-sm-5">
                        <?= 
                            $form->field($model, 'division_id')->dropDownList($divisionList,
                                    [
                                        'prompt' => 'Select Division',
                                        'onchange' => '
                                        $( "select#dynamicmodel-student_id" ).html("showLoading");
                                        $.post( "' . Yii::$app->urlManager->createAbsoluteUrl('admin/report/get-student-list') . '?division_id=' . '"+$(this).val()+"&class_id="+$("#dynamicmodel-class_id").val()+"&subclass_id="+$("#dynamicmodel-subclass_id").val(), 
                                        function(data) {
                                                $( "select#dynamicmodel-student_id" ).html(data);
                                        });'
                                    ])
                        ?>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="control-label col-sm-3">Student</label>
                    <div class="col-sm-5">
                        <?=
                        $form->field($model, 'student_id')->dropDownList($studentList,
                                [
                                    'prompt' => 'Select Student'
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

        </div>
    </div>
</div>    