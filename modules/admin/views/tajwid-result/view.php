<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TajwidResult */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tajwid Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">

<!--<div class="tajwid-result-view">-->

    <h1><?//= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'class_id',
            'student_id',
            'result',
            'is_active',
            'is_deleted',
            'i_by',
            'i_date',
            'u_by',
            'u_date',
        ],
    ]) ?>

</div>
</div>
</div>