<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
                    echo '<h3>' . Yii::t('app', 'Add School Standard') . '</h3>';
                } else {
                    echo '<h3>' . Yii::t('app', 'Edit School Standard') . '</h3>';
                }
                ?>
            </div>
            <?php
            $form = ActiveForm::begin([
                'id' => 'schoolStandardUpgrade',
                'enableClientValidation' => true,
                'fieldConfig' => [
                    'template' => '{input}{error}',
                    'options' => [],
                ],
                'options' => [
                    'class' => 'form-horizontal'
                ]
            ]);
            ?>
            <div class="box-body">
                <div class="form-group row">
                    <label class="control-label col-sm-3">Standard</label>
                    <div class="col-sm-5">
                        <?= $form->field($model, 'standard_id')->dropDownList($standardList,
                                [
                                    'prompt' => 'Select Standard',
                                    'onchange' => '
                                        $( "select#schoolstandardupgrade-upgrade_standard_id" ).html("showLoading");
                                        $.post( "' . Yii::$app->urlManager->createAbsoluteUrl('admin/school-standard-upgrade/get-upgradestandard-list') . '?id=' . '"+$(this).val(), 
                                        function(data) {
                                                $( "select#schoolstandardupgrade-upgrade_standard_id" ).html(data);
                                    });'
                                ]) ?>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="control-label col-sm-3">Upgrade Class</label>
                    <div class="col-sm-5">
                        <?= $form->field($model, 'upgrade_standard_id')->dropDownList($standardList,
                                [
                                    'prompt' => 'Select Standard',
                                ]) ?>
                    </div>
                </div>
            </div>
            
            <div class="box-footer">
                <div class="form-group row">
                    <div class="col-lg-offset-2 col-lg-10">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        <?php echo Html::a('<button type="button" class="btn btn-default">' . Yii::t('app', 'Cancel') . '</button>', ["index"]); ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>    