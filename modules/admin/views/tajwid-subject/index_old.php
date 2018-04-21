<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TajwidSubjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tajwid Subjects');
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
                <?= Html::a(Yii::t('app', 'Create Tajwid Subject'), ['create'], ['class' => 'btn btn-success', 'style' => 'float:right;']) ?>
            </div>
            <div class="row p-a">

                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'subject_name',
                        ['attribute' => 'tajwid_class_id',
                            'filter' => Html::activeDropDownList($searchModel, 'tajwid_class_id', $tajwidClassList, ['prompt' => 'Select Class', 'class' => 'form-control']),
                            'value' => 'tajwid.class_name'
                        ],
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);
                ?>

            </div>
        </div>
    </div>
</div>
