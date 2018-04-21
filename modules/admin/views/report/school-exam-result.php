<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box-header">
                        Class Result  
                    </div>
                    <div class="box-divider m-a-0"></div>
                    <?php
                    $form = ActiveForm::begin([
                                'id' => 'classResult',
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
                            <label class="col-sm-3 control-label">Year</label>
                            <div class="col-sm-5">
                                <?=
                                $form->field($model, 'year')->dropDownList(
                                        $yearList, [
                                    'prompt' => 'Select Year'
                                        ]
                                )
                                ?>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Class</label>
                            <div class="col-sm-5">
                                <?=
                                $form->field($model, 'class')->dropDownList(
                                        $classList, [
                                    'prompt' => 'Select Class',
                                    'onchange' => '
                                        $( "select#dynamicmodel-subclass" ).html("showLoading");
                                        $.post( "' . Yii::$app->urlManager->createAbsoluteUrl('admin/weightheight/get-subclass-list') . '?id=' . '"+$(this).val(), 
                                        function(data) {
                                                $( "select#dynamicmodel-subclass" ).html(data);
                                        });'
                                        ]
                                )
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Subclass</label>
                            <div class="col-sm-5">
                                <?=
                                $form->field($model, 'subclass')->dropDownList(
                                        $subclassList, [
                                    'prompt' => 'Select Subclass',
                                    'onchange' => '
                                                $( "select#dynamicmodel-standard" ).html("showLoading");
                                                $.post( "' . Yii::$app->urlManager->createAbsoluteUrl('admin/report/get-standard-list') . '?class_id=' . '"+$("#dynamicmodel-class").val()+"&subclass_id="+$(this).val(), 
                                                function(data) {
                                                    $( "select#dynamicmodel-standard" ).html(data);
                                            });',
                                        ]
                                )
                                ?>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Standard</label>
                            <div class="col-sm-5">
                                <?=
                                $form->field($model, 'standard')->dropDownList(
                                        $standardList, [
                                    'prompt' => 'Select Standard'
                                        ]
                                )
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="button" class="btn btn-success" onclick="getReport()">Create</button>
                            </div>
                        </div>
                    </div>
                    <?php
                    ActiveForm::end();
                    ?>
                </div>        
            </div>
        </div>
        <div class="box">
            <div class="box-heading">

            </div>
            <div class="box-body">
                <div id="reportData">
                </div>
            </div>
        </div>
    </div>    
</div>
<script type="text/javascript">
    function getReport() {
        var year = $("#dynamicmodel-year").val();
        var classid = $("#dynamicmodel-class").val();
        var subclass = $("#dynamicmodel-subclass").val();
        var standard = $("#dynamicmodel-standard").val();
        
        var valid = true;
        valid = checkValidation(year, 'dynamicmodel-year');
        valid = checkValidation(classid, 'dynamicmodel-class');
        valid = checkValidation(subclass, 'dynamicmodel-subclass');
        valid = checkValidation(standard, 'dynamicmodel-standard');
        if(valid == true) {
            $.ajax({
                'method': 'POST',
                'url': '<?php echo Yii::$app->urlManager->createAbsoluteUrl(['admin/report/school-result-report']) ?>',
                'data': {
                    'year': year,
                    'class': classid,
                    'subclass': subclass,
                    'standard': standard,
                },
                'success': function (data) {
                    $("#reportData").html(data);
                }
            });
        }
    }
    
    function checkValidation(fieldval, fieldid) {
        var returnval = true;
        if(!$("#" + fieldid).val() || $("#" + fieldid).val() == '') {
            $("#" + fieldid).parent().addClass('has-error');
            returnval = false;
        }
        return returnval;
    }
</script>