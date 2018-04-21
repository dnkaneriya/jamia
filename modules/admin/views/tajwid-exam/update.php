<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TajwidExam */

$this->title = 'Update Tajwid Exam: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tajwid Exams', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tajwid-exam-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
