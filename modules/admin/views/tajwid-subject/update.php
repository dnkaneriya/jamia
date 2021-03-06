<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TajwidSubject */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
            'modelClass' => 'Tajwid Subject',
        ]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tajwid Subjects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            <?=
            $this->render('_form', [
                'model' => $model,
                'tajwidClassList' => $tajwidClassList,
            ])
            ?>

        </div>
    </div>
</div>
