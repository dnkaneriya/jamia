<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SchoolExamMarks */

$this->title = Yii::t('app', 'Create School Exam Marks');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'School Exam Marks'), 'url' => ['index']];
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
	            'divisionList' => $divisionList,
	            'subjectList' => $subjectList,
	            'standardList' => $standardList,
	            'yearList' => $yearList,
		    ]) ?>

        </div>
    </div>
</div>