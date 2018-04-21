<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SchoolSubject */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'School Subject',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'School Subjects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
        	<?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
        </div>
    </div>
</div>