<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Student;
use app\models\Tarbiyatsubject;
use app\models\Subjectoption;
use app\models\Tarbiyatcard;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Job */
/* @var $form yii\widgets\ActiveForm */
$month = Yii::$app->params['islamic_month_en'];
?>

<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/scripts/jquery.tagsinput.js"></script>
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
<script>
    function subjectoptions(subject_id) {
        var id = subject_id;
        $.ajax({
            type: "GET",
            url: "subjectoptions",
            data: {id: id}, // multiple data sent using ajax
            success: function (result) {
                //alert(result);return false;
                $("#tarbiyatcard-selected_option_id").html(result);
                //$.pjax.reload({container: '#w0-pjax', timeout: 2000});
            }
        });
    }
</script>
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
                echo '<h3>' . Yii::t('app', 'Add Tarbiyat Card') . '</h3>';
            } else {
                echo '<h3>' . Yii::t('app', 'Edit Tarbiyat Card') . '</h3>';
            }
            ?>
        </div>
        <div class="box-divider m-a-0"></div>
        <div class="box-body">
            <!--<form class="form-horizontal" role="form">-->
            <?php
            $form = ActiveForm::begin([
                        'id' => 'tarbiyatcard-form',
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
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
<?php echo Yii::t('app', 'You have some form errors. Please check below'); ?>
            </div>
            <div class="alert alert-success display-hide">
                <button class="close" data-close="alert"></button>
                Your form validation is successful!
            </div>
            <?php
            $student = Student::find()->where(['is_active' => 'Y', 'is_deleted' => 'N', 'is_selected' => 'C'])->all();
            $studentData = ArrayHelper::map($student, 'id', 'grno');

            $subject = Tarbiyatsubject::find()->where(['is_active' => 'Y', 'is_deleted' => 'N'])->all();
            //$subjectData = ArrayHelper::map($subject,'id','subject_en');

            /* $option = Subjectoption::find()->where(['is_active'=>'Y', 'is_deleted'=>'N'])->all();
              $optionData = ArrayHelper::map($option,'id','options'); */
            ?>
            <?= $form->field($model, 'student_id')->widget(Select2::classname(), [
                'data' => $studentData,
                'language' => 'en',
                'options' => ['placeholder' => '-Select Gr No-'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
            
            <?php 
            $year = [];
            for ($i = 1430; $i <= 1600; $i++) { 
                $year[$i] = $i;
            }
            ?>
            <?= $form->field($model, 't_year')->widget(Select2::classname(), [
                'data' => $year,
                'language' => 'en',
                'options' => ['placeholder' => '-Select Year-'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
            <div class="form-group field-date">
                <div class="row">
                    <label class="control-label col-sm-2 form-control-label" for="tarbiyatcard-month">Month</label>
                    <div class="col-lg-4">
                        <select name="Tarbiyatcard[t_month]" class="form-control" id="tarbiyatcard-month">
                            <?php if ($model->isNewRecord) $model->t_month = date('m'); ?>
                            <?php foreach ($month as $key => $value) { ?>
                                <option value="<?php echo $key; ?>" <?php echo $model->t_month == $key ? 'selected="selected"' : ''; ?>><?php echo $value; ?></option>
                            <?php } ?>
                        </select>
                        <div class="help-block help-block-error "></div>
                    </div>
                </div>
            </div>

            <?php foreach ($subject as $sub) {
                ?>
                <div class="form-group field-subject">
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="hidden" class="form-control" name="Tarbiyatcard[tarbiyat_subject_id][]" value="<?= $sub['id'] ?>">
                            <h4><?= $sub['subject_en'] ?></h4>
                        </div>
                    </div>
                </div>
                <?php
                $selectedoption = 'A';
                if (!$model->isNewRecord) {
                    $tarbiyatcard = Tarbiyatcard::find()->where(['student_id' => $model->student_id, 'tarbiyat_subject_id' => $sub['id'], 't_year' => $model->t_year, 't_month' => $model->t_month])->one();
                    $selectedoption = $tarbiyatcard != array() ? $tarbiyatcard->selected_option : 'A';
                }
                ?>
                <div class="col-lg-12">
                    <div class="form-group field-tarbiyatcard-selected_option-<?= $sub['id'] ?> required">
                        <input type="hidden" name="Tarbiyatcard[selected_option][<?= $sub['id'] ?>]" value="">
                        <div id="tarbiyatcard-selected_option-<?= $sub['id'] ?>">
                            <label class="radio-inline"><input type="radio" name="Tarbiyatcard[selected_option][<?= $sub['id'] ?>]" value="A" <?= $selectedoption == 'A' ? 'checked="checked"' : ''; ?>> <?= 'A' ?></label>
                            <label class="radio-inline"><input type="radio" name="Tarbiyatcard[selected_option][<?= $sub['id'] ?>]" value="B" <?= $selectedoption == 'B' ? 'checked="checked"' : ''; ?>> <?= 'B' ?></label>
                            <label class="radio-inline"><input type="radio" name="Tarbiyatcard[selected_option][<?= $sub['id'] ?>]" value="C" <?= $selectedoption == 'C' ? 'checked="checked"' : ''; ?>> <?= 'C' ?></label>
                            <label class="radio-inline"><input type="radio" name="Tarbiyatcard[selected_option][<?= $sub['id'] ?>]" value="D" <?= $selectedoption == 'D' ? 'checked="checked"' : ''; ?>> <?= 'D' ?></label></div>
                        <div class="help-block help-block-error "></div>
                    </div>                
                </div>

<?php } ?>


            <div class="form-group">
                <div class="row">
                    <div class="col-lg-offset-2 col-lg-10">
                            <!--<button type="submit" class="btn btn-success"><?php //echo Yii::t('app', 'Submit');  ?></button>-->
<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
<?php echo Html::a('<button type="button" class="btn btn-default">' . Yii::t('app', 'Cancel') . '</button>', ["index"]); ?>
                    </div>
                </div>
            </div>

<?php ActiveForm::end(); ?>
        </div>
        <!--</section>-->
    </div>
</div>
<script type="text/javascript">

    /*$( "#tarbiyatcard-date" ).datepicker({
     format: 'mm/dd/yyyy',
     autoclose: true,
     //startDate: '-1d',
     });*/

    var form1 = $('#tarbiyatcard-form');
    var error1 = $('.alert-danger', form1);
    var success1 = $('.alert-success', form1);
    form1.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: true, // do not focus the last invalid input
        ignore: [],
        //ignore: "#job-walkin_time",
        rules: {
            "Tarbiyatcard[student_id]": {
                required: true
            },
            "Tarbiyatcard[tarbiyat_subject_id]": {
                required: true
            },
            "Tarbiyatcard[selected_option]": {
                required: true
            },
            "Tarbiyatcard[t_year]": {
                required: true
            },
            "Tarbiyatcard[t_month]": {
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