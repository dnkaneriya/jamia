<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SchoolExamResult */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="school-exam-result-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'class_id')->textInput() ?>

    <?= $form->field($model, 'subclass_id')->textInput() ?>

    <?= $form->field($model, 'standard_id')->textInput() ?>

    <?= $form->field($model, 'grno')->textInput() ?>

    <?= $form->field($model, 'student_id')->textInput() ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'result')->dropDownList([ 'P' => 'P', 'F' => 'F', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'is_active')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'is_deleted')->dropDownList([ 'N' => 'N', 'Y' => 'Y', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'i_by')->textInput() ?>

    <?= $form->field($model, 'i_date')->textInput() ?>

    <?= $form->field($model, 'u_by')->textInput() ?>

    <?= $form->field($model, 'u_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
