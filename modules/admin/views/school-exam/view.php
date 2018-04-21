<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SchoolExam */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'School Exams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-exam-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'class_id',
            'subclass_id',
            'standard',
            'total_mark',
            'passing_mark',
            'no_of_semester',
            'is_active',
            'is_deleted',
            'i_at',
            'i_by',
            'u_at',
            'u_by',
        ],
    ]) ?>

</div>
