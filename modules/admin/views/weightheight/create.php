<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Industry */

$this->title = Yii::t('app', 'Create Weight & Height');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Weight & Height'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            <?php echo Yii::$app->getSession()->getFlash('flash_msg'); ?>
            <?= $this->render('_form', [
                      'model' => $model,
					  'classList' => $classList,
                      'subclassList' => $subclassList,
                      'divisionList' => $divisionList,
					  'yearList' => $yearList,
					  'monthList' => $monthList		
            ]) ?>
        </div>
    </div>
</div>
