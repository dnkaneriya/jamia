<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Classes;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClassUpgradeMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-lg-12">
        <!--<section class="panel">-->
            <div class="box-header">
                Class Upgrade
            </div>
            <div class="box-divider m-a-0"></div>
            <div class="box-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'addResultForm',
                    'enableClientValidation' => true,
                    'fieldConfig' => [
                        'template' => "{input}{error}",
                        'options' => [
                            //'tag' => false
                        ]
                    ],
                    'options' => [
                        'class' => 'form-horizontal'
                    ]
                ]); ?>

                <div class="form-group">
                    <label class="control-label col-sm-3">Old Class*</label>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'class_id')->dropDownList(
                        ArrayHelper::map(Classes::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name'),
                        [
                            'prompt' => 'Select Class',
                            'onchange' => '
                                    $( "select#classupgrademaster-subclass_id" ).html("showLoading");
                                    $.post( "get-subclass-list?id='.'"+$(this).val(), 
                                    function(data) {
                                            $( "select#classupgrademaster-subclass_id" ).html(data);
                                    });'
                        ]
                    ) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'subclass_id')->dropDownList([],
                        [
                            'prompt' => 'Select Subclass',
                            'onchange' => '$("#classupgrademaster-upgrade_id").val("").trigger()',
                            /*'onchange' => '
                                    $( "select#classupgrademaster-upgrade_id" ).html("showLoading");
                                    $.post( "get-upgrade-class-list?id='.'"+$("#classupgrademaster-class_id").val(), 
                                    function(data) {
                                            $( "select#classupgrademaster-upgrade_id" ).html(data);
                                    });'*/
                        ]
                    ) ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">New Class*</label>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'upgrade_id')->dropDownList(
                            ArrayHelper::map(Classes::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name'),
                        [
                            'prompt' => 'Select Class',
                            'onchange' => '
                                $( "select#classupgrademaster-upgrade_subclass_id" ).html("showLoading");
                                $.post( "get-upgradesubclass-list?subclass_id='.'"+$("#classupgrademaster-subclass_id").val()+"&class_id="+$(this).val(), 
                                function(data) {
                                        $( "select#classupgrademaster-upgrade_subclass_id" ).html(data);
                                });'
                        ]
                    ) ?>
                    </div>

                    <div class="col-sm-4">
                        <?= $form->field($model, 'upgrade_subclass_id')->dropDownList([], 
                            [
                                'prompt' => 'Select Upgrade Subclass',
                            ]
                        ) ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
                    </div>
                </div>

                <?php ActiveForm::end() ?>
            </div>
    </div>
</div>                
<?php /*
<div class="class-upgrade-master-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'class_id')->textInput() ?>

    <?= $form->field($model, 'upgrade_id')->textInput() ?>

    <?= $form->field($model, 'is_active')->textInput() ?>

    <?= $form->field($model, 'is_deleted')->textInput() ?>

    <?= $form->field($model, 'i_by')->textInput() ?>

    <?= $form->field($model, 'i_at')->textInput() ?>

    <?= $form->field($model, 'u_by')->textInput() ?>

    <?= $form->field($model, 'u_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
*/ ?>