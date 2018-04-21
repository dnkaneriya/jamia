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
                            <label class="col-sm-3 control-label">Exam</label>
                            <div class="col-sm-5">
                                <?= $form->field($model, 'exam')->dropDownList($examList,
                                        [
                                            'prompt' => 'Select Exam'
                                        ])?>
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
                                                $( "select#dynamicmodel-division" ).html("showLoading");
                                                $.post( "' . Yii::$app->urlManager->createAbsoluteUrl('admin/weightheight/get-division-list') . '?class_id=' . '"+$("#dynamicmodel-class").val()+"&subclass_id="+$(this).val(), 
                                                function(data) {
                                                    $( "select#dynamicmodel-division" ).html(data);
                                            });',
                                        ]
                                )
                                ?>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Division</label>
                            <div class="col-sm-5">
                                <?=
                                $form->field($model, 'division')->dropDownList(
                                        $divisionList, [
                                    'prompt' => 'Select Division'
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
                <button type="button" id="print_btn" style="display: none;" class="btn btn-success" onclick="printReport()">Print</button>
                <br><br>
                <div id="reportData">
                </div>
            </div>
        </div>
    </div>    
</div>
<script type="text/javascript">
    function getReport() {
        var year = $("#dynamicmodel-year").val();
        var exam = $("#dynamicmodel-exam").val();
        var classid = $("#dynamicmodel-class").val();
        var subclass = $("#dynamicmodel-subclass").val();
        var division = $("#dynamicmodel-division").val();
        
        var valid = true;
        valid = checkValidation(year, 'dynamicmodel-year');
        valid = checkValidation(classid, 'dynamicmodel-class');
        valid = checkValidation(subclass, 'dynamicmodel-subclass');
        if(valid == true) {
            $.ajax({
                'method': 'POST',
                'url': '<?php echo Yii::$app->urlManager->createAbsoluteUrl(['admin/report/class-result-report']) ?>',
                'data': {
                    'year': year,
                    'exam': exam,
                    'class': classid,
                    'subclass': subclass,
                    'division': division,
                },
                'success': function (data) {
                    $("#print_btn").css("display","");
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
    
    function printReport() {
      var year = $("#dynamicmodel-year").val();
      var exam = $("#dynamicmodel-exam").val();
      var classid = $("#dynamicmodel-class").val();
      var subclass = $("#dynamicmodel-subclass").val();
      var division = $("#dynamicmodel-division").val();
      var QUERY_STRING = '';
        QUERY_STRING +='year='+year+'&exam='+exam+'&class='+classid+'&subclass='+subclass+'&division='+division;
        window.open('<?php echo Yii::$app->urlManager->createAbsoluteUrl(['admin/report/print-class-result-report'])."?" ?>'+QUERY_STRING, '_blank');
    } 

</script>