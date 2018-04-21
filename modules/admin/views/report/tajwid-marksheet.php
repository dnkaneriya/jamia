<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Student;
use app\models\ExamMaster;
use app\models\Classes;
use app\models\Subclass;

/* @var $this yii\web\View */
/* @var $model app\models\Mark */

/* @var $form yii\widgets\ActiveForm */
$student_data = Student::find()->where(['is_deleted' => 'N', 'is_selected' => 'C', 'is_active' => 'Y'])->andWhere('grno != ""')->all();

$mydata = array();

if ($student_data != array()) {
    $mydata = ArrayHelper::map($student_data, 'grno', 'grno');
}
?>

<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/scripts/jquery.validate.min.js"></script>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            <div class="row">
                <div class="col-lg-12">
                    <!--<section class="panel">-->
                    <div class="box-header">
                        <?php
                        echo '<h3>' . Yii::t('app', 'Tajwid Marksheet') . '</h3>';
                        ?>
                    </div>
                    <div class="box-divider m-a-0"></div>

                    <?php
                    $form = ActiveForm::begin([
                                'id' => 'tajwidMarksheet',
                                'enableClientValidation' => true,
                                'fieldConfig' => [
                                    'template' => '{input}{error}',
                                    'options' => []
                                ],
                                'options' => [
                                    'class' => 'form-horizontal',
                                ]
                            ])
                    ?>        

                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label col-sm-3">Select Year *</label>
                            <div class="col-sm-8">
                                <?=
                                $form->field($model, 'year')->dropDownList(
                                        $yearList, [
                                    'prompt' => 'Select Year',
                                        ]
                                )
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Select Class *</label>
                            <div class="col-sm-8">
                                <?=
                                $form->field($model, 'class_id')->dropDownList(
                                        $classList, [
                                        'prompt' => 'Select Class',
                                           'onchange' => '
                                                $( "select#dynamicmodel-student_id" ).html("showLoading");
                                                $.post( "' . Yii::$app->urlManager->createAbsoluteUrl('admin/report/get-tajwid-student-list') . '?class_id="+$(this).val(), 
                                                function(data) {
                                                    $( "select#dynamicmodel-student_id" ).html(data);
                                            });'
                                        ]
                                );
                                ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Student</label>
                            <div class="col-sm-8">
                                <?=
                                $form->field($model, 'student_id')->dropDownList(
                                        $studentList, [
                                    'prompt' => 'Select Student'
                                        ]
                                )
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>  
                    </div>
                    <?php ActiveForm::end() ?>        
                </div>
            </div>
        </div>
    </div>
</div>
