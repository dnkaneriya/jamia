<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
?>

<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            <div class="box-header"></div>
            <?php
            $form = ActiveForm::begin([
                        'id' => 'addTajwidMarksForm',
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
            echo Html::hiddenInput('class_id', $requestData['class_id']);
            echo Html::hiddenInput('exam_id', $requestData['exam_id']);
            echo Html::hiddenInput('subject_id', $requestData['subject_id']);
            ?>
            <div class="box-body">
                <div class="form-group row">
                    <label class="col-sm-2">Student GR.No.</label>                    
                    <label class="col-sm-2"><?= $subjects['subject_name'] ?></label>
                </div>
                <?php
                if (isset($students) && !empty($students)) {
                    $i = 0;
                    foreach ($students as $student) {
                        echo "<div class='form-group row'>";
                        ?>
                        <div class="col-sm-2">
                            <?php // Html::textInput("student[" . $i . "]", $student['grno'], ['class' => 'form-control', 'readonly' => true]) ?>    
                            <?=
                            Select2::widget([
                                'name' => 'student[' . $i . ']',
                                'value' => '',
                                'data' => $studentArray,
                                'options' => ['multiple' => false, 'placeholder' => 'Select states ...']
                            ]);
                            ?>
                        </div>
                        <?php
                        // $j=0;
                        //foreach ($subjects as $subject) {
                        ?>
                        <div class="col-sm-2">
                        <?= Html::textInput("subject[" . $i . "]", isset($markArr[$i]) ? $markArr[$i] : '', ['class' => 'form-control', 'placeholder' => $subjects['subject_name']]) ?>                    
                        </div>
                        <?php
                        //$j++;
                        //}
                        ?>
                        <?php
                        $i++;
                        echo "</div>";
                    }
                } else {
                    echo 'No student available.';
                }
                ?>
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