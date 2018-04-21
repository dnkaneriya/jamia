<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Industry */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Sub Class',
]) . ' ' . $model->sub_class;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sub Class'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sub_class, 'url' => ['view', 'id' => $model->id]];
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
