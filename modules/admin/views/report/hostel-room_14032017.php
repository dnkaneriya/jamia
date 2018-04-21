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

                        Hostel Room  

                    </div>

                    <div class="box-divider m-a-0"></div>

<?php
$form = ActiveForm::begin([

            'id' => 'hostelRoom',
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

                            <label class="col-sm-3 control-label">Room</label>

                            <div class="col-sm-5">

                    <?=
                    $form->field($model, 'room')->dropDownList(
                            $roomList, [
                        'prompt' => 'Select Room'
                            ]);
                    ?>

                            </div>

                        </div>

                    </div>

                    <div class="box-footer">

                        <div class="form-group">

                            <div class="col-sm-offset-3 col-sm-5">

                                <button type="button" class="btn btn-success" onclick="getReport()">Show</button>

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

        var room = $("#dynamicmodel-room").val();
        $.ajax({

            'method':'POST',

            'url' : '<?php echo Yii::$app->urlManager->createAbsoluteUrl(['admin/report/hostel-room-report']) ?>',

            'data' : {

                'room' : room,

            },
            'success' : function(data) {

                $("#reportData").html(data);

            }      

        });

    }    

</script>