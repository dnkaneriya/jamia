<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Hostelsearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hostel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'grno') ?>

    <?= $form->field($model, 'student_id') ?>

    <?= $form->field($model, 'room_id') ?>

    <?= $form->field($model, 'bed_id') ?>

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
