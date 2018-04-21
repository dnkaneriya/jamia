<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TajwidMarks */

$this->title = 'Update Tajwid Marks: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tajwid Marks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tajwid-marks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
