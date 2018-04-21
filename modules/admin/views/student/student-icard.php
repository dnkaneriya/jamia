<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Industry */
?>
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            <div class="box-header">Student Identity Card</div>

            <div class="box-divider m-a-0"></div>

            <div class="box-body">
                <table class="student-icard" cell-padding="5" style="padding: 10px !important; width:500px">
                    <tr class="icard-header">
                        <td style="width:15%; padding:10px 5px 10px 10px">
                            <img src="<?php echo Yii::$app->request->baseUrl . "/img/logo.png"; ?>"
                        </td>
                        <td style="width:85%; padding:10px 10px 10px 5px">
                            <table>
                                <tr>
                                    <td>
                                        <h3 style="font-weight:900; margin-bottom:2px">JAMEATUL ULOOM - GADHA</h3  >
                                        <p style="margin-bottom:2px"><strong>At & Po. GADHA. Ta. Himmatnagar, Dist : S.K. (Gujarat)</strong></p>
                                        <p style="margin-bottom:5px"><strong>India Pin : 383010. Ph. (02772) 281367</strong></p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr class="icard-body">
                        <td colspan="2" style="padding:10px 10px 5px 10px">
                            <table style="width:100%">
                                <tr>
                                    <td style="width: 80%">
                                        <div class="form-horizontal">
                                            <div class="form-group row" style="margin-bottom:0px">
                                                <label class="col-sm-4" style="margin-bottom:0px"><strong>Name</strong><span style="float:right">:</span></label>
                                                <div class="col-sm-8">
                                                    <?= $student->surname_en ?> <?= $student->firstname_en ?> <?= $student->lastname_en ?>
                                                </div>
                                            </div>



                                            <div class="form-group row" style="margin-bottom:0px">
                                                <label class="col-sm-4" style="margin-bottom:0px"><strong>Father's Name</strong><span style="float:right">:</span></label>
                                                <div class="col-sm-8">
                                                    <?= $student->father_name ?>
                                                </div>
                                                
                                            </div>


                                            <div class="form-group row" style="margin-bottom:0px">
                                                <label class="col-sm-4" style="margin-bottom:0px"><strong>GR. No.</strong><span style="float:right">:</span></label>
                                                <div class="col-sm-2">
                                                    <?= $student->grno ?>
                                                </div>
                                                
                                                <label class="col-sm-3" style="margin-bottom:0px"><strong>Standard</strong><span style="float:right">:</span></label>   
                                                <div class="col-sm-3">
                                                    <?= $class_name ?>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row" style="margin-bottom:0px">
                                                <label class="col-sm-4" style="margin-bottom:0px"><strong>Subclass </strong><span style="float:right">:</span></label>
                                                <div class="col-sm-2">
                                                    <?= $subclass_name ?>
                                                </div>
                                                
                                                <label class="col-sm-3" style="margin-bottom:0px"><strong>Division</strong><span style="float:right">:</span></label>   
                                                <div class="col-sm-3">
                                                    <?= $division_name ?>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row" style="margin-bottom:0px">
                                                <label class="col-sm-4" style="margin-bottom:0px"><strong>DOB</strong><span style="float:right">:</span></label>
                                                <div class="col-sm-8">
                                                    <?= $dob ?>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group row" style="margin-bottom:0px">
                                                <label class="col-sm-4" style="margin-bottom:0px"><strong>Blood Group</strong><span style="float:right">:</span></label>
                                                <div class="col-sm-8">
                                                    <?= $student->bloodgroup ?>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group row" style="margin-bottom:0px">
                                                <label class="col-sm-4" style="margin-bottom:0px"><strong>Valid From</strong><span style="float:right">:</span></label>
                                                <div class="col-sm-3">
                                                    12-05-2015
                                                </div>
                                                
                                                <label class="col-sm-2" style="margin-bottom:0px"><strong>To</strong><span style="float:right">:</span></label>   
                                                <div class="col-sm-3">
                                                    12-05-2016
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width:20%; text-align: center; border:1px solid #dcdcdc">
                                        <img src="<?php echo Yii::$app->request->baseUrl . $_GET['profileImage']; ?>" width="60" height="80" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border: 2px solid #999999; margin-top:10px; padding:5px; border-radius:10px; margin-left:10px; margin-right:10px">
                                        <p>Resi. Address : <?= $student->street ?> <?= $student->taluka ?> <?= $student->district ?>,<br /> <?= $student->city ?>. <?= $student->pincode ?></p>
                                    </td>
                                </tr>
                            </table>  
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>    
