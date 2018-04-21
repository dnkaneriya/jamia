<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Mark */

$this->title = Yii::t('app', 'Add Mark');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mark'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            <?php echo Yii::$app->getSession()->getFlash('flash_msg'); ?>
            <?= $this->render('_form1', [
                'model' => $model,
            	'yearList' => $yearList,
                'classList' => $classList,
                'subclassList' => $subclassList,
                'examList' => $examList,
                'divisionList' => $divisionList,
                'studentList' => $studentList
            ]) ?>
        </div>
    </div>
</div>
