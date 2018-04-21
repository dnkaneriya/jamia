<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TajwidSubject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <?php
                if ($model->isNewRecord) {
                    echo '<h3>' . Yii::t('app', 'Add Tajwid Class') . '</h3>';
                } else {
                    echo '<h3>' . Yii::t('app', 'Edit Tajwid Class') . '</h3>';
                }
                ?>
            </div>
            <?php
            $form = ActiveForm::begin([
                        'layout' => 'horizontal',
                        'options' => ['class' => 'form-horizontal'],
                        'fieldConfig' => [
                            //'template' => " <div class=\"control-group\">{lable}<div class=\"controls\">{input}</div>\n<div class=\"col-lg-7\">{error}</div></div>",
                            'enableClientValidation' => false,
                            'enableAjaxValidation' => false,
                            'template' => "<div class=\"row\">{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}</div>",
                            'horizontalCheckboxTemplate' => "{beginWrapper}\n<div class=\"checkbox\">\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n</div>\n{error}\n{endWrapper}\n{hint}",
                            'horizontalCssClasses' => [
                                'label' => 'col-sm-2 form-control-label',
                                'offset' => 'col-sm-offset-4',
                                'wrapper' => 'col-lg-4',
                                'error' => '',
                                'hint' => '',
                            ],
                        //'template' => '{label} <div class="col-lg-6">{input}{error}</div>'
                        // 'inputOptions' => ['class' => 'm-wrap span6'],
                        ],
            ]);
            ?>

            <div class="box-body">
                <?= $form->field($model, 'tajwid_class_id')->dropDownList($tajwidClassList, ['prompt' => 'Selet Tajwadi Class']) ?>

                <?= $form->field($model, 'subject_name')->textInput(['maxlength' => true]) ?>


                <div class="form-group">
                    <div class="row">
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
</div>
