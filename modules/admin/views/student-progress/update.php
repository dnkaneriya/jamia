<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StudentProgress */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Student Progress',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Student Progresses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="student-progress-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
