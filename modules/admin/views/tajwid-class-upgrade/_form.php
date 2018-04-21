<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\TajwidClassUpgrade */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <?php
                if ($model->isNewRecord) {
                    echo '<h3>' . Yii::t('app', 'Add Tajwid Class Upgrade') . '</h3>';
                } else {
                    echo '<h3>' . Yii::t('app', 'Edit Tajwid Class Upgrade') . '</h3>';
                }
                ?>
            </div>
            <?php
            $form = ActiveForm::begin([
                'id' => 'tajwidClassUpgrade',
                'enableClientValidation' => true,
                'fieldConfig' => [
                    'template' => '{input}{error}',
                    'options' => [],
                ],
                'options' => [
                    'class' => 'form-horizontal'
                ]
            ])
            ?>
            <div class="box-body">
                <div class="form-group row">
                    <label class="col-sm-3 control-label">Class*</label>
                    <div class="col-sm-5">
                        <?= $form->field($model, 'class_id')->dropDownList($tajwidClass, 
                                [
                                    'prompt' => 'Select class',
                                    'onchange' => '
                                    $( "select#tajwidclassupgrade-upgrade_class_id" ).html("showLoading");
                                    $.post( "get-upgradeclass-list?id='.'"+$(this).val(), 
                                    function(data) {
                                            $( "select#tajwidclassupgrade-upgrade_class_id" ).html(data);
                                    });'
                                 ]
                                ) ?>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-3 control-label">Upgrade Class*</label>
                    <div class="col-sm-5">
                        <?= $form->field($model, 'upgrade_class_id')->dropDownList($tajwidClass, 
                                [
                                    'prompt' => 'Select Upgrade class',
                                 ]
                                ) ?>
                    </div>
                </div>
            </div>
            
            <div class="box-footer">
                <div class="form-group row">
                    <div class="col-sm-5">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            <?php echo Html::a('<button type="button" class="btn btn-default">' . Yii::t('app', 'Cancel') . '</button>', ["index"]); ?>
                    </div>
                </div>
            </div>
            <?php
            Activeform::end();
            ?>
        </div>
    </div>
</div>    
