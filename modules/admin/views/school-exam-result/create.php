<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SchoolExamResult */

$this->title = Yii::t('app', 'Create School Exam Result');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'School Exam Results'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-exam-result-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
