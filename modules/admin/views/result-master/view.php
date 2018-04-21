<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ResultMaster */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Result Masters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div ui-view class="app-body" id="view">
    <div class="padding">
        
        <div class="box">
            <div class="box-header">
              <h3>Result Details</h3>
            </div>
            <div class="box-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'classname',
                        'divisionname',
                        'studentGR',
                        //'result',
                        [
                        	'label' => 'Result',
                        	'format' => 'raw',
                        	'value' => ($model->result == 'P') ? "<span class='label label-success' style='background:green'>Pass</span>" : "<span class='label label-danger' style='background:red'>Fail</span>",
                        ]
                        //'is_active',
                        //'is_deleted',
                        //'i_by',
                        //'i_date',
                        //'u_by',
                        //'u_date',
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>            
<?php /*
<div class="result-master-view">

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
            'division_id',
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
*/ ?>