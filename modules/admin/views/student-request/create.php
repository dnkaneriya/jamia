<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StudentRequest */

$this->title = Yii::t('app', 'Student Request');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Student Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>
        </div>
    </div>
</div>
