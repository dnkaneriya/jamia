<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TajwidClassUpgrade */

$this->title = Yii::t('app', 'Create Tajwid Class Upgrade');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tajwid Class Upgrades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            
            <?= $this->render('_form', [
                'model' => $model,
                'tajwidClass' => $tajwidClass
            ]) ?>
            
        </div>
    </div>
</div>