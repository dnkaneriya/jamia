<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\grid\GridView;
use app\models\Student;

$this->title = Yii::t('app', 'Student Documents');
$this->params['breadcrumbs'][] = $this->title;

$student = Student::find()->where(['is_deleted' => 'N'])->andWhere(['not', ['grno' => null]])->all();
$studentList = ArrayHelper::map($student, 'id', 'grno');
?>

<h1><?= Html::encode($this->title) ?></h1>


<div ui-view class="app-body" id="view">
    <div class="padding">
        <?php
        echo Yii::$app->getSession()->getFlash('flash_msg');
        ?>
        <div class="box">
            <div class="box-header">
                <h3>Complaint List</h3>
                <?= Html::a(Yii::t('app', 'Create Student Document'), ['create'], ['class' => 'btn btn-success', 'style' => 'float:right;']) ?>
            </div>
            <div class="row p-a">
                <?php Pjax::begin() ?>
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
//                            'id',
                        'student_id',
//            'grno',
                        [
                            'attribute' => 'doc_type',
                            'filter' => Html::activeDropDownList($searchModel, 'doc_type', ['Profile' => 'Profile', 'Other' => 'Other'], ['class' => 'form-control', 'prompt' => 'Select Type'])
                        ],
                        'doc_path',
                        // 'note',
                        // 'is_active',
                        // 'id_deleted',
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
