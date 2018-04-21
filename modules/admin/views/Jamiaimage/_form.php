<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Jamiaimage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jamiaimage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jamia_id')->textInput() ?>

    <?= $form->field($model, 'image_path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'i_by')->textInput() ?>

    <?= $form->field($model, 'i_date')->textInput() ?>

    <?= $form->field($model, 'u_by')->textInput() ?>

    <?= $form->field($model, 'u_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
