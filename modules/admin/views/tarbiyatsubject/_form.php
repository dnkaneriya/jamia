<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Student;

/* @var $this yii\web\View */
/* @var $model app\models\Job */
/* @var $form yii\widgets\ActiveForm */
?>

<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/scripts/jquery.validate.min.js"></script>
<style>
    .display-none, .display-hide {
        display: none;
    }
    .disabled{
        background: none;
        color: #999999;
        cursor: default !important;
    }
</style>
<?php
//echo "<pre>";print_r($companyModel);die;
$controller = strtolower(Yii::$app->controller->id);
$action = strtolower(Yii::$app->controller->action->id);
?>
<div class="row">
    <div class="col-lg-12">
                <!--<section class="panel">-->
        <div class="box-header">
            <?php
            if ($model->isNewRecord) {
                echo '<h3>' . Yii::t('app', 'Add Tarbiyat Subject') . '</h3>';
            } else {
                echo '<h3>' . Yii::t('app', 'Edit Tarbiyat Subject') . '</h3>';
            }
            ?>
        </div>
        <div class="box-divider m-a-0"></div>
        <?php
        $form = ActiveForm::begin([
                    'id' => 'tarbiyatSubjectForm',
                    'enableClientValidation' => true,
                    'fieldConfig' => [
                        'template' => '{input}{error}',
                        'options' => [
                            //'tag' => false
                        ]
                    ],
                    'options' => [
                        'class' => 'form-horizontal'
                    ]
                ])
        ?>
        <div class="box-body">
            <div class="form-group row">
                <label class="col-sm-2">Subject En*</label>
                <div class="col-sm-5">
                    <?= $form->field($model, 'subject_en')->textInput() ?>
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-2">Subject Ar</label>
                <div class="col-sm-5">
                    <?= $form->field($model, 'subject_ar')->textInput() ?>
                </div>
            </div>
            
            <div class="form-group row">
                <h6>Grade Criteria</h6>
                <hr/>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-2">Grade A</label>
                <div class="col-sm-5">
                    <?= $form->field($model, 'A')->textInput() ?>
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-2">Grade B</label>
                <div class="col-sm-5">
                    <?= $form->field($model, 'B')->textInput() ?>
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-2">Grade C</label>
                <div class="col-sm-5">
                    <?= $form->field($model, 'C')->textInput() ?>
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-2">Grade D</label>
                <div class="col-sm-5">
                    <?= $form->field($model, 'D')->textInput() ?>
                </div>
            </div>
        </div>
        
        <div class="box-footer">
            <div class="form-group row">
                <div class="col-sm-10 col-sm-offset-2">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    <?php echo Html::a('<button type="button" class="btn btn-default">'.Yii::t('app', 'Cancel').'</button>',["index"]); ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end() ?>
        <!--</section>-->
    </div>
</div>
<script type="text/javascript">

    var form1 = $('#tarbiyatsubject-form');
    var error1 = $('.alert-danger', form1);
    var success1 = $('.alert-success', form1);
    form1.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: true, // do not focus the last invalid input
        ignore: [],
        //ignore: "#job-walkin_time",
        rules: {
            "Tarbiyatsubject[subject_en]": {
                required: true
            },
        },

        invalidHandler: function (event, validator) { //display error alert on form submit              
            success1.hide();
            error1.show();
        },

        highlight: function (element) { // hightlight error inputs
            $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
        },

        unhighlight: function (element) { // revert the change done by hightlight
            $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
        },

        success: function (label) {
            label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group

        },
        errorPlacement: function (error, element) { // render error placement for each input type
            error.insertAfter(element); // for other inputs, just perform default behavoir
        },
    });
</script>