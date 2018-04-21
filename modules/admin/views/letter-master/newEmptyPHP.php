<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\StudentRequest */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Letter Master'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">

            <p>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?=
                Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                        ],
                ])
                ?>
            </p>

            <?=
            DetailView::widget([
                'model' => $model,
                 'attributes' => [
            [
            'attribute' => 'type',
            'value' => (($model->type ==0) ? "Sender": "Receiver"),
            ],
            'to',
            'from',
            'subject',
            'content:ntext',
//            'is_active',
//            'is_deleted',
//            'i_by',
//            'i_date',
//            'u_by',
//            'u_date',
        ],
            ])
            ?>

        </div>
    </div>
</div>




