<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SchoolExamSemester */

$this->title = Yii::t('app', 'Create School Exam Semester');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'School Exam Semesters'), 'url' => ['index']];
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
            ]) ?>
        </div>
    </div>
</div>