<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StudentProgress */

$this->title = Yii::t('app', 'Create Student Progress');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Student Progresses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
        
            <?= $this->render('_form', [
                'model' => $model,
                'yearList' => $yearList,
                'monthList' => $monthList,
                'classList' => $classList,
                'subclassList' => $subclassList,
            ]) ?>
            
        </div>
    </div>
</div>