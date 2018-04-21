<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StudentDocument */

$this->title = Yii::t('app', 'Create Student Document');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Student Documents'), 'url' => ['index']];
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
