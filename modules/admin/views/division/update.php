<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Industry */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Division',
]) . ' ' . $model->division;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Division'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->division, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            <?php echo Yii::$app->getSession()->getFlash('flash_msg'); ?>
            <?= $this->render('_form', [
                'model' => $model,
            	'classList' => $classList,
                'subclassList' => $subclassList,
            ]) ?>
        </div>
    </div>
</div>
