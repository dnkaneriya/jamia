<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TajwidMarks */

$this->title = Yii::t('app', 'Create New');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tajwid Marks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            <?php echo Yii::$app->getSession()->getFlash('flash_msg'); ?>
            <?= $this->render('_form', [
                'model' => $model,              
                'yearList' => $yearList, 
                'tajwidClassList' => $tajwidClassList,
                'tajwidSubjectList' => $tajwidSubjectList
            ]) ?>
        </div>
    </div>
</div>