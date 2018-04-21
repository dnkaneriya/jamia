<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TajwidClassSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tajwid Classes');
$this->params['breadcrumbs'][] = $this->title;
?>

<div ui-view class="app-body" id="view">
    <div class="padding">
        <?php
        echo Yii::$app->getSession()->getFlash('flash_msg');
        ?>
        <div class="box">
            <div class="box-header">
                <h3>Add Tajwid Classt</h3>
                <?= Html::a(Yii::t('app', 'Create Tajwid Class'), ['create'], ['class' => 'btn btn-success', 'style' => 'float:right;']) ?>
            </div>
            <div class="row p-a">
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
//            'id',
                        'class_name',
//            'is_active',
//            'is_deleted',
//            'i_by',
                        // 'i_date',
                        // 'u_by',
                        // 'u_date',
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);
                ?>

            </div>
        </div>
    </div>
</div>
