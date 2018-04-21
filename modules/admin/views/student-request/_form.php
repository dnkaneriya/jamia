<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Student;
use kartik\widgets\DatePicker;

$student = Student::find()->where(['is_deleted' => 'N'])->andWhere(['not', ['grno' => null]])->all();
$studentList = ArrayHelper::map($student, 'id', 'grno');
?>
<div class="row">
    <div class="col-lg-12">
        <!--<section class="panel">-->
        <div class="box-header">
            <b>Student Request</b>
        </div>
        <div class="box-divider m-a-0"></div>
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>

            <?php echo $form->field($model, 'student_id')->dropDownList($studentList, ['prompt' => 'Selcet Student']) ?>

            <?php echo $form->field($model, 'request')->textarea(['rows' => 5]) ?>
            
            <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
                            'options' => ['placeholder' => 'Select Date'],
                            'pluginOptions' => [
                                'autoclose'=>true
                            ]
                        ]); ?>

            
            <div class="form-group">
                <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
