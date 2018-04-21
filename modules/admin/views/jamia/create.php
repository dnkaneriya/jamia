<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Jamia */

$this->title = Yii::t('app', 'Create Jamia');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jamias'), 'url' => ['index']];
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