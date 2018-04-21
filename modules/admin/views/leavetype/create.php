<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Leavetype */

$this->title = Yii::t('app', 'Create Leavetype');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Leavetypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
