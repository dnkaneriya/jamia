<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SchoolExam */

$this->title = Yii::t('app', 'Create School Exam');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'School Exams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            <?= $this->render('_form', [
                'model' => $model,
                'classList' => $classList,
                'subclassList' => $subclassList,
            ]) ?>
        </div>
    </div>
</div>