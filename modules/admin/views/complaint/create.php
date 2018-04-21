<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Complaint */

$this->title = Yii::t('app', 'Create Complaint');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Complaints'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            <?php echo Yii::$app->getSession()->getFlash('flash_msg'); ?>
            <?= $this->render('_form', [
                'model' => $model,
                'studentList' => $studentList,
            ]) ?>
        </div>
    </div>
</div>
