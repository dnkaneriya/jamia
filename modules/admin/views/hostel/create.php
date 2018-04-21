<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Hostel */

$this->title = Yii::t('app', 'Create Hostel');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hostels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            <?php echo Yii::$app->getSession()->getFlash('flash_msg'); ?>
            <?= $this->render('_form', [
                'model' => $model,
                'studentList' => $studentList,
                'roomList' => $roomList,
            ]) ?>
        </div>
    </div>
</div>
