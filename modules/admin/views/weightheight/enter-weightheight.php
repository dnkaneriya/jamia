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
                'id' => 'addWeightHeight',
                'enableClientValidation' => true,
                'fieldConfig' => [
                    'template' => '{input}{error}',
                    'options' => [],
                ],
                'options' => [
                    'class' => 'form-horizontal'
                ]
            ]);
            
            echo Html::hiddenInput('t_year', $requestData['t_year']);
            echo Html::hiddenInput('t_month', $requestData['t_month']);
            echo Html::hiddenInput('class_id', $requestData['class_id']);
            echo Html::hiddenInput('subclass_id', $requestData['subclass_id']);
            echo Html::hiddenInput('division_id', $requestData['division_id']);
            
            ?>
            <div class="box-body">
                <div class="form-group row">
                    <label class="col-sm-2">Student GR.No.</label>                    
                    <label class="col-sm-2"><?= $requestData['category'] ?></label>
                </div>
                <?php
                if(isset($students) && !empty($students)){
                $i=0;
                foreach($students as $student) {
                echo "<div class='form-group row'>";    
                $val = '';
                if(isset($stuData[$i][$requestData['category']]) && $stuData[$i][$requestData['category']]!='') {
                    $val = $stuData[$i][$requestData['category']];
                }
                ?>
                <div class="col-sm-2">
                    <?= Html::hiddenInput("student_id[".$i."]", $student['id']); ?>
                    <?= Html::hiddenInput("grno[".$i."]", $student['grno']); ?>    
                    <label class="control-label"><?= $student['grno'] ?></label>
                </div>
                
                <div class="col-sm-2">
                    <?= Html::textInput($requestData['category']."[".$i."]", $val, ['class' => 'form-control', 'placeholder' => 'Weight']) ?>                    
                </div>
                
                
                <?php
                $i++;
                echo "</div>";
                }
                }else{
                    echo 'No student available.';
                }
                ?>
            </div>
            <div class="box-footer">
                <div class="form-group row">
                <div class="col-sm-5">
                    <?= isset($students) && !empty($students)?Html::submitButton('Create', ['class' => 'btn btn-success']):Html::submitButton('Create', ['class' => 'btn btn-success', 'disabled' => 'disabled']) ?>

                </div>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>