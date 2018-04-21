<?php

use yii\helpers\Html;

use app\models\Student;

/* @var $this yii\web\View */
/* @var $model app\models\Industry */

$name = Student::find()->where(['id'=>$model->student_id])->one();
$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Student',
]) . ' ' . $name->name_en;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Student'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $name->name_en, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            <?php echo Yii::$app->getSession()->getFlash('flash_msg'); ?>
            <?= $this->render('_form', [
                      'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
