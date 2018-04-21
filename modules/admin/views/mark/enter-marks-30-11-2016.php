<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
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
            ?>
            <div class="box-body">
                <div class="form-group row">
                    <label class="col-sm-2">Student GR.No.</label>
                    <?php
                    foreach ($subjects as $subject) {
                    ?>
                    <label class="col-sm-2"><?= $subject['name_ar'] ?></label>
                    <?php
                    }
                    ?>
                </div>
                <?php
                $i=0;
                foreach($students as $student) {
                echo "<div class='form-group row'>";    
                ?>
                <div class="col-sm-2">
                    <?= Html::textInput("student[".$i."]", $student['id'], ['class' => 'form-control', 'readonly' => true]) ?>
                </div>
                <?php
                    $j=0;
                    foreach ($subjects as $subject) {
                ?>
                <div class="col-sm-2">
                    <?= Html::textInput("subject[".$i."][".$j."]", '', ['class' => 'form-control', 'placeholder' => $subject['name_ar']]) ?>
                </div>
                <?php
                    $j++;
                    }
                ?>
                <?php
                $i++;
                echo "</div>";
                }
                ?>
            </div>
            <div class="box-footer">
                <div class="form-group row">
                <div class="col-sm-5">
                    <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
                </div>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>