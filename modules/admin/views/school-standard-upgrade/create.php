<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SchoolStandardUpgrade */

$this->title = Yii::t('app', 'Create School Standard Upgrade');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'School Standard Upgrades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            
            <?= $this->render('_form', [
                'model' => $model,
                'standardList' => $standardList,
            ]) ?>
            
        </div>
    </div>
</div>    