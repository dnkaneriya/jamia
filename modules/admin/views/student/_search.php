<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'grno') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'contact_no') ?>

    <?php // echo $form->field($model, 'fees') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'parent_mobile') ?>

    <?php // echo $form->field($model, 'is_continue') ?>

    <?php // echo $form->field($model, 'reason') ?>

    <?php // echo $form->field($model, 'divison_id') ?>

    <?php // echo $form->field($model, 'class_id') ?>

    <?php // echo $form->field($model, 'sub_class_id') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <?php // echo $form->field($model, 'i_by') ?>

    <?php // echo $form->field($model, 'i_date') ?>

    <?php // echo $form->field($model, 'u_by') ?>

    <?php // echo $form->field($model, 'u_date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
