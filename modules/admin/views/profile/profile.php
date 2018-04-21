<style type="text/css">
/*    table {
        border-collapse: collapse !important;
        width:100%
    }

    table td,  table th{
        border: 2px solid #333 !important;
    }

    table th {
        background: #dcdcdc;
    }*/
    .text-center {
        text-align: center;
    }
    .padding-5{
      padding: 5px;
    }
    .font-size-15{
      font-size: 15px;
    }
    .border-bottom-1{
        border-bottom: 1px solid #000;
        
    }
    .margin-5{
      margin: 5px;
    }
</style>

<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box-divider m-a-0"></div>

                    <div class="box-body">

                        <div class="report">
                          <div class="row12" style="width:100%;" >
                            <div class="row12" style="width:45%;float: left;font-size: 22px;" >
                              <strong style="font-size: 32px;">JAMEATUL ULOOM - GADHA</strong><br>
                              <strong>
                                  At & Po. Gadha.<br> 
                                  Ta. Himmatnagar,Dist : Sabarkatha,<br>
                                  Gujarat(North)India Pin:383010<br> 
                                  Phone:(02772) 281367
                              </strong>
                            </div>
                            <div class="row12" style="width:10%;float: left;" >
                              <img src="<?php echo Yii::$app->request->baseUrl; ?>/img/logo.png">
                            </div>
                            <div class="row12" style="width:45%;float: left;font-size: 22px;text-align: right;" >
                              <strong style="font-size: 32px;">JAMEATUL ULOOM - GADHA</strong><br>
                              <strong>
                                  At & Po. Gadha.<br> 
                                  Ta. Himmatnagar,Dist : Sabarkatha,<br>
                                  Gujarat(North)India Pin:383010<br> 
                                  Phone:(02772) 281367
                              </strong>
                            </div>
                            <hr style="width:100%;border:2px solid #000;clear: both;margin: 5px 0px 5px 0px;">
                              
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h2><u>Profile View</u></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <img style="height: 160px;" src="<?php echo Yii::$app->request->baseUrl ."/img/user.png" ?>"  />
                            </div>
                            <div class="col-sm-8 text-left">
                                <p class="font-size-15"><b>G.R. :</b><?= $student->grno ?></p>
                                <p class="font-size-15"><b>Surname :</b><?= $student->surname_en ?></p>
                                <p class="font-size-15"><b>Student Name :</b> <?= $student->firstname_en ?> <?= $student->lastname_en ?></p>
                                <p class="font-size-15"><b>Father Name :</b><?= $student->father_name ?></p>
                                <p class="font-size-15"><b>Mother Name :</b><?= $student->mother_name ?></p>
                                
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12">
                            <table class="font-size-15 margin-5" style="border: none;width:100%;padding: 5px;margin-top: 30px;">
                                <tr>
                                    <td style="width:10%;" class=""><b>Date Of Birth :</b></td>
                                    <td style="width:25%;" class="border-bottom-1 "><?= $dob ?></td>
                                    
                                    <td style="width:10%;"><b>Bloud Group : </b></td>
                                    <td style="width:25%;" class="border-bottom-1"><?= $student->bloodgroup ?></td>
                                    
                                    <td style="width:5%;"><b>Fees : </b></td>
                                    <td style="width:25%;" class="border-bottom-1 "><?= $student->fees ?></td>
                                </tr>
                            </table>
                            <table class="font-size-15 margin-5" style="border: none;width:100%;padding: 5px;margin-top: 30px;">
                              <tr>
                                  <td style="width:15%;" class=""><b>Parent Occupation:</b></td>
                                  <td style="width:40%;" class="border-bottom-1 "><?= $student->parent_occupation ?></td>

                                  <td style="width:10%;"><b>Parent Income : </b></td>
                                  <td style="width:35%;" class="border-bottom-1"><?= $student->parent_income ?></td>
                                </tr>
                            </table>
                            <table class="font-size-15 margin-5" style="border: none;width:100%;padding: 5px;margin-top: 30px;">
                              <tr>
                                <td style="width:10%;" class=""><b>Mobile No. 1 :</b></td>
                                <td style="width:40%;" class="border-bottom-1 "><?= $student->mobile_no ?></td>

                                <td style="width:10%;"><b>Mobile No. 2 : </b></td>
                                <td style="width:40%;" class="border-bottom-1"><?= $student->parent_mobile ?></td>
                              </tr>
                            </table>
                            <table class="font-size-15 margin-5" style="border: none;width:100%;padding: 5px;margin-top: 30px;">
                              <tr>
                                <td style="width:15%;" class=""><b>Residence Address :</b></td>
                                <td style="width:85%;" class="border-bottom-1 "><?= $student->street ?> <?= $student->taluka ?> <?= $student->district ?>, </td>
                              </tr>
                            </table>
                            <table class="font-size-15 margin-5" style="border: none;width:100%;padding: 5px;margin-top: 30px;">
                              <tr>
                                <td style="width:15%;" class="">&nbsp;</td>
                                <td style="width:85%;" class="border-bottom-1 "><?= $student->city ?>. <?= $student->pincode ?></td>
                              </tr>
                            </table> 
                            <table class="font-size-15 margin-5" style="border: none;width:100%;padding: 5px;margin-top: 30px;">
                                <tr>
                                    <td style="width:5%;" class=""><b>Class :</b></td>
                                    <td style="width:25%;" class="border-bottom-1 "><?= $class_name ?></td>
                                    
                                    <td style="width:8%;"><b>Sub Class : </b></td>
                                    <td style="width:27%;" class="border-bottom-1"> <?= $subclass_name ?></td>
                                    
                                    <td style="width:7%;"><b>Divison : </b></td>
                                    <td style="width:28%;" class="border-bottom-1 "><?= $division_name ?></td>
                                </tr>
                            </table>
                            <table class="font-size-15 margin-5" style="border: none;width:100%;padding: 5px;margin-top: 30px;">
                              <tr>
                                <td style="width:10%;" class=""><b>Standard :</b></td>
                                <td style="width:40%;" class="border-bottom-1 "><?= $class_name ?></td>

                                <td style="width:10%;"><b>Hostel Room : </b></td>
                                <td style="width:40%;" class="border-bottom-1"><?= $room_no ?></td>
                              </tr>
                            </table>  
                          </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   
