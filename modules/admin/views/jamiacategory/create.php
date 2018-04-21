<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Jamiacategory */

$this->title = Yii::t('app', 'Create Jamiacategory');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jamiacategories'), 'url' => ['index']];
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

