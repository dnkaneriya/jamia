<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SchoolExamMarks */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'School Exam Marks',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'School Exam Marks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="school-exam-marks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'classList' => $classList,
        'subclassList' => $subclassList,
        'semesterList' => $semesterList,
        'divisionList' => $divisionList,
        'yearList' => $yearList,
    ]) ?>

</div>
