<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Attendance */

$this->title = Yii::t('app', 'Create Attendance');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Attendances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            <?php echo Yii::$app->getSession()->getFlash('flash_msg'); ?>
            <?= $this->render('_form1', [
                    'model' => $model,
                    'classList' => $classList,
                    'subclassList' => $subclassList,
                    'divisionList' => $divisionList,
                    'yearList' => $yearList,
                    'monthList' => $monthList,
                    'dayList' => $dayList,
            ]) ?>
        </div>
    </div>
</div>
