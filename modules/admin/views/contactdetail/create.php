<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Contactdetail */

$this->title = Yii::t('app', 'Create Contactdetail');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contactdetails'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contactdetail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
