<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TajwidSubject */

$this->title = Yii::t('app', 'Create Tajwid Subject');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tajwid Subjects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            <?php echo Yii::$app->getSession()->getFlash('flash_msg'); ?>
            <?=
            $this->render('_form', [
                'model' => $model,
                'tajwidClassList' => $tajwidClassList,
            ])
            ?>
        </div>
    </div>
</div>
