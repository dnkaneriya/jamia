<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jamia */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Jamia',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jamias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
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
