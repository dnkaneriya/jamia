<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Classes;
use app\models\Student;

/* @var $this yii\web\View */
/* @var $model app\models\Job */
/* @var $form yii\widgets\ActiveForm */

$month = Yii::$app->params['islamic_month_en'];
?>

<!--<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/scripts/jquery.tagsinput.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/plugins/bootstrap-daterangepicker/moment.min.js"></script> -->
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
            echo '<h3>' . Yii::t('app', 'Add Attendance') . '</h3>';
            ?>
        </div>
        <div class="box-divider m-a-0"></div>


        <?php $form = ActiveForm::begin(['id' => 'weightheightForm', 'enableClientValidation' => true, 'fieldConfig' => ['template' => '{input}{error}', 'options' => [],], 'options' => ['class' => 'form-horizontal']]) ?>           
        <div class="form-group row">             
            <label class="col-sm-2 control-label">Year*</label>      
            <div class="col-sm-5">      
                <?= $form->field($model, 't_year')->dropDownList($yearList, ['prompt' => 'Select Year',]) ?>               
            </div>            
        </div>        
        <div class="form-group row"> 
            <label class="col-sm-2 control-label">Month*</label> 
            <div class="col-sm-5">  
                <?= $form->field($model, 't_month')->dropDownList($monthList, ['prompt' => 'Select Month',]) ?>     
            </div>       
        </div>       
        <div class="form-group row">        
            <label class="col-sm-2 control-label">Day*</label>          
            <div class="col-sm-5">        
                <?= $form->field($model, 'day')->dropDownList($dayList, ['prompt' => 'Select Day',]) ?>         
            </div>     
        </div>          
        <div class="form-group row">            
            <label class="col-sm-2 control-label">Class*</label>          
            <div class="col-sm-5">           
                <?= $form->field($model, 'class_id')->dropDownList(ArrayHelper::map(Classes::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name'), ['prompt' => 'Select Class', 'onchange' => '                                    $( "select#attendance-subclass_id" ).html("showLoading");                                    $.post( "' . Yii::$app->urlManager->createAbsoluteUrl('admin/weightheight/get-subclass-list') . '?id=' . '"+$(this).val(),                                     function(data) {                                            $( "select#attendance-subclass_id" ).html(data);                                    });']) ?>      
            </div>         
        </div>       
        <div class="form-group row">          
            <label class="col-sm-2 control-label">Subclass*</label>            
            <div class="col-sm-5">           
                <?= $form->field($model, 'subclass_id')->dropDownList($subclassList, ['prompt' => 'Select Subclass', 'onchange' => '$( "select#attendance-division_id" ).html("showLoading");                                $.post( "' . Yii::$app->urlManager->createAbsoluteUrl(['admin/weightheight/get-division-list']) . '?class_id=' . '"+$("#attendance-class_id").val()+"&subclass_id="+$(this).val(),                                 function(data) {                                        $( "select#attendance-division_id" ).html(data);                                });', ['options' => ['class' => 'form-control']]]) ?>                
            </div>          
        </div>          
        <div class="form-group row">        
            <label class="col-sm-2 control-label">Division*</label>     
            <div class="col-sm-5">       
                <?= $form->field($model, 'division_id')->dropDownList($divisionList, ['prompt' => 'Select Divison']) ?>      
            </div>         
        </div>           
        <div class="form-group row">           
            <div class="col-sm-5 col-sm-offset-2">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>      
                <?php echo Html::a('<button type="button" class="btn btn-default">' . Yii::t('app', 'Cancel') . '</button>', ["index"]); ?>      
            </div>        
        </div>
        <?php ActiveForm::end() ?>  

    </div>
</div>