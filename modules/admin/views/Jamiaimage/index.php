<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Jamiaimagesearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Jamiaimages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jamiaimage-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Jamiaimage'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'jamia_id',
            'image_path',
            'i_by',
            'i_date',
            // 'u_by',
            // 'u_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
