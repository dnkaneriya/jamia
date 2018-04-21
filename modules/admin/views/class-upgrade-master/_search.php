<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClassUpgradeMasterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="class-upgrade-master-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'class_id') ?>

    <?= $form->field($model, 'upgrade_id') ?>

    <?= $form->field($model, 'is_active') ?>

    <?= $form->field($model, 'is_deleted') ?>

    <?php // echo $form->field($model, 'i_by') ?>

    <?php // echo $form->field($model, 'i_at') ?>

    <?php // echo $form->field($model, 'u_by') ?>

    <?php // echo $form->field($model, 'u_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
