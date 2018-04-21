<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Letter Masters');
$this->params['breadcrumbs'][] = $this->title;
?>
<div ui-view class="app-body" id="view">
    <div class="padding">
        <?php
        echo Yii::$app->getSession()->getFlash('flash_msg');
        ?>
        <div class="box">
            <div class="box-header">
                <h3>Letter Master</h3>                
                <?= Html::a(Yii::t('app', 'Add New'), ['create'], ['class' => 'btn btn-success', 'style' => 'float:right;']) ?>
            </div>
            <div class="row p-a">


                <?php Pjax::begin() ?>
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],                        
                        [
                            'attribute' => 'type',
                            'format' => 'raw',
                            'value' => function($model) {
                                if($model->type == '0'){
                                    return 'Sender';
                                }else{
                                    return 'Receiver';
                                }
                            }
                        ],
                        'to',
                        'from',
                        'subject',
                        // 'content:ntext',
                        // 'is_active',
                        // 'is_deleted',
                        // 'i_by',
                        // 'i_date',
                        // 'u_by',
                        // 'u_date',

//                        [ 'width' => '10%',
//                            'attribute' => 'date',
//                            'vAlign' => 'middle',
//                            'class' => '\kartik\grid\DataColumn',
//                            'headerOptions' => ['style' => 'text-align:center'],
//                            'pageSummary' => false,
//                            //'filter'=>false,
//                            //'mergeHeader'=>true,
//                            'label' => 'Join Date',
//                            'filterType' => GridView::FILTER_DATE,
//                            'filterWidgetOptions' => [
//                                'pluginOptions' => [
//                                    'format' => 'dd-mm-yyyy',
//                                    'autoclose' => true,
//                                    'todayHighlight' => true,
//                                ]
//                            ],
//                            'value' => function($model) {
//                                return date('d M Y', $model->date);
//                            }],
//                        ['attribute' => 'status',
//                            'filter' => Html::activeDropDownList($searchModel, 'status', ['panding' => 'Panding', 'Approve' => 'Approve', 'Disapprove' => 'Disapprove'], ['class' => 'form-control', 'prompt' => 'Select status'])
//                        ],
                        // 'is_deleted',
                        // 'i_by',
                        // 'i_date',
                        // 'u_by',
                        // 'u_date',
                        ['class' => 'yii\grid\ActionColumn'],
                        ],
                ]);
                ?>
                <?php Pjax::end() ?>

            </div>
        </div>
    </div>
</div>


