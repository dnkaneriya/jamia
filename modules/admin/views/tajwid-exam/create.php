<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TajwidExam */

$this->title = 'Create Tajwid Exam';
$this->params['breadcrumbs'][] = ['label' => 'Tajwid Exams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tajwid-exam-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
