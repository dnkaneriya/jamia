<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
?>

<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            <div class="box-header"></div>
            <?php
            $form = ActiveForm::begin([
                        'id' => 'addMarkForm',
                        'enableClientValidation' => true,
                        'fieldConfig' => [
                            'template' => '{input}{error}',
                            'options' => [],
                        ],
                        'options' => [
                            'class' => 'form-horizontal'
                        ]
            ]);

            echo Html::hiddenInput('year', $requestData['year']);
            echo Html::hiddenInput('exam_id', $requestData['exam_id']);
            echo Html::hiddenInput('class_id', $requestData['class_id']);
            echo Html::hiddenInput('subclass_id', $requestData['subclass_id']);
            echo Html::hiddenInput('division_id', $requestData['division_id']);
            echo Html::hiddenInput('subject_id', $requestData['subject_id']);
            ?>
            <div class="box-body">
                <div class="panel panel-default">
<!--                    <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Addresses</h4></div>-->
                    <div class="panel-body">
                        <?php
                        DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                            'widgetBody' => '.container-items', // required: css class selector
                            'widgetItem' => '.item', // required: css class
                            'limit' => count($students), // the maximum times, an element can be cloned (default 999)
                            'min' => 1, // 0 or 1 (default 1)
                            'insertButton' => '.add-item', // css class
                            'deleteButton' => '.remove-item', // css class
                            'model' => $modelsMark[0],
                            'formId' => 'addMarkForm',
                            'formFields' => [
                                'student_id',
                                'marks',
                            ],
                        ]);
                        ?>

                        <div class="container-items"><!-- widgetContainer -->
                            <?php foreach ($modelsMark as $i => $modelMark): ?>
                                <div class="item panel panel-default"><!-- widgetBody -->
                                    <div class="panel-heading">
                                        <h3 class="panel-title pull-left">Marks</h3>
                                        <div class="pull-right">
                                            <button type="button" class="add-item btn btn-success btn-xs"><i class="fa fa-plus-circle"></i></button>
                                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="fa fa-minus-circle"></i></button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                        // necessary for update action.
                                        if (!$modelMark->isNewRecord) {
                                            echo Html::activeHiddenInput($modelMark, "[{$i}]id");
                                        }
                                        ?>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-2">Student Gr.No.</label>
                                            <div class="col-sm-4">
                                                <?= $form->field($modelMark, "[{$i}]student_id")->dropDownList($studentList, 
                                                        [
                                                            'prompt' => 'Select Student'
                                                        ]
                                                        ) ?>
                                            </div>
                                            <label class="control-label col-sm-2">Marks</label>
                                            <div class="col-sm-4">
                                                <?= $form->field($modelMark, "[{$i}]marks")->textInput(['maxlength' => true]) ?>
                                            </div>
                                        </div>
       
                                    </div>
                                </div>
                    <?php endforeach; ?>
                        </div>
<?php DynamicFormWidget::end(); ?>
                    </div>
                </div>  
            </div>
            <div class="box-footer">
                <div class="form-group row">
                    <div class="col-sm-5">
<?= isset($students) && !empty($students) ? Html::submitButton('Create', ['class' => 'btn btn-success']) : Html::submitButton('Create', ['class' => 'btn btn-success', 'disabled' => 'disabled']) ?>

                    </div>
                </div>
            </div>
<?php ActiveForm::end() ?>
        </div>
    </div>
</div>
<script>
$(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
    $.each(item.parent().parent().find('[id$=student_id]'), function() {
       alert("tet"); 
    });
});
</script>