<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SchoolSubject */

$this->title = Yii::t('app', 'Create School Subject');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'School Subjects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
        	<?= $this->render('_form', [
		        'model' => $model,
		        'classList' => $classList,
                'subclassList' => $subclassList,
                'semesterList' => $semesterList,
		    ]) ?>
        </div>
    </div>
</div>