<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudentDocument */
/* @var $form yii\widgets\ActiveForm */
use app\models\Student;

$student = Student::find()->where(['is_deleted' => 'N'])->andWhere(['not', ['grno' => null]])->all();
$studentList = ArrayHelper::map($student, 'id', 'grno');
?>
<div class="row">
    <div class="col-lg-12">
        <!--<section class="panel">-->
        <div class="box-header">
            <b>Add Student Document</b>
        </div>
        <div class="box-divider m-a-0"></div>
        <div class="box-body">

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <?php echo $form->field($model, 'student_id')->dropDownList($studentList, ['prompt' => 'Select Student']) ?>

            <?php echo $form->field($model, 'doc_type')->dropDownList([ 'Profile' => 'Profile', 'Other' => 'Other',], ['prompt' => 'Select Document Type']) ?>

            <?php echo $form->field($model, 'imageFile')->fileInput(['class' => 'form-control']) ?>

            <?php echo $form->field($model, 'note')->textarea(['rows' => 3]) ?>


            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
