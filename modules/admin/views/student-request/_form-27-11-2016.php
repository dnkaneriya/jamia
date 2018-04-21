<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Student;

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

            <?php echo $form->field($model, 'date')->textInput() ?>

            <?php echo $form->field($model, 'status')->dropDownList([ 'Panding' => 'Panding', 'Approve' => 'Approve', 'Disapprove' => 'Disapprove',]) ?>

            <div class="form-group">
                <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
