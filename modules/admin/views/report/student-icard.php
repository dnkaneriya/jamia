<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box-header">
                        Student Icard  
                    </div>
                    <div class="box-divider m-a-0"></div>
                    <?php
                    $form = ActiveForm::begin([
                                'id' => 'studentIcard',
                                'enableClientValidation' => true,
                                'fieldConfig' => [
                                    'template' => '{input}{error}',
                                    'options' => [],
                                ],
                                'options' => [
                                    'class' => 'form-horizontal'
                                ]
                            ])
                    ?>
                    <div class="box-body">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Class</label>
                            <div class="col-sm-5">
                                <?=
                                $form->field($model, 'class')->dropDownList(
                                        $classList, [
                                    'prompt' => 'Select Class',
                                    'onchange' => '
                                        $( "select#dynamicmodel-subclass" ).html("showLoading");
                                        $.post( "' . Yii::$app->urlManager->createAbsoluteUrl('admin/weightheight/get-subclass-list') . '?id=' . '"+$(this).val(), 
                                        function(data) {
                                                $( "select#dynamicmodel-subclass" ).html(data);
                                        });'
                                        ]
                                )
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Subclass</label>
                            <div class="col-sm-5">
                                <?=
                                $form->field($model, 'subclass')->dropDownList(
                                        $subclassList, [
                                    'prompt' => 'Select Subclass',
                                    'onchange' => '
                                                $( "select#dynamicmodel-division" ).html("showLoading");
                                                $.post( "' . Yii::$app->urlManager->createAbsoluteUrl('admin/weightheight/get-division-list') . '?class_id=' . '"+$("#dynamicmodel-class").val()+"&subclass_id="+$(this).val(), 
                                                function(data) {
                                                    $( "select#dynamicmodel-division" ).html(data);
                                            });',
                                        ]
                                )
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Division</label>
                            <div class="col-sm-5">
                                <?=
                                $form->field($model, 'division')->dropDownList(
                                        $divisionList, [
                                    'prompt' => 'Select Division',
                                    'onchange' => '
                                                $( "select#dynamicmodel-student_id" ).html("showLoading");
                                                $.post( "' . Yii::$app->urlManager->createAbsoluteUrl('admin/report/get-student-list') . '?class_id=' . '"+$("#dynamicmodel-class").val()+"&subclass_id="+$("#dynamicmodel-subclass").val()+"&division_id="+$(this).val(), 
                                                function(data) {
                                                    $( "select#dynamicmodel-student_id" ).html(data);
                                            });'
                                        ]
                                )
                                ?>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Student</label>
                            <div class="col-sm-5">
                                <?=
                                $form->field($model, 'student_id')->dropDownList(
                                        $studentList, [
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
                                <button type="submit" class="btn btn-success">Create</button>
                            </div>
                        </div>
                    </div>
                    <?php
                    ActiveForm::end();
                    ?>
                </div>        
            </div>
        </div>
    </div>    
</div>