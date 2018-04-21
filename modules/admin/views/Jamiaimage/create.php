<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Jamiaimage */

$this->title = Yii::t('app', 'Create Jamiaimage');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jamiaimages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jamiaimage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
