<style type="text/css">
    table {
        border-collapse: collapse !important;
        width:100%
    }

    table td,  table th{
        border: 2px solid #333 !important;
    }

    table th {
        background: #dcdcdc;
    }
    .text-center {
        text-align: center;
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
                          <button type="button" id="print_btn"  class="btn btn-success" onclick="printReport()">Print</button>
                          <br><br>  
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
                            
                            <div class="row12" style="width:100%;font-size: 20px;text-align: center;margin: 15px 0px 15px 0px;" >
                                <strong style="font-size:22px;">MARKS SHEET :  </strong>
                              <strong> 123</strong>
                            </div>
                            <div class="row12" style="width:100%;text-align: center;font-size: 20px;margin: 15px 0px 15px 0px;" >
                              <strong>Exam Name : <?= $examdata->name ?> </strong>
                            </div>
                            <div class="row12" style="width:100%;text-align: center;font-size: 20px;margin: 15px 0px 15px 0px;" >
                              <strong>Exam Year <?= $year ?> </strong>
                            </div>
                            
                            <div class="row12" style="width:50%;float: left;font-size: 20px;margin: 15px 0px 15px 0px;" >
                              <strong>G.R.No. : </strong>
                              <strong> <?= $student->grno ?></strong><br>
                              <strong>Name Of Student : </strong>
                              <strong> <?= $student->surname_en ?> <?= $student->firstname_en ?> <?= $student->lastname_en ?></strong><br>
                              <strong>Sub Class : </strong>
                              <strong> <?= $subClass->sub_class ?></strong><br>
                              <strong>Divison : </strong>
                              <strong> <?= $divison->division ?></strong>
                            </div>
                            <div class="row12" style="text-align: right;width:50%;float: left;font-size: 20px;margin: 15px 0px 15px 0px;" >
                              <strong>Arabio Name : </strong>
                              <strong> <?= $student->surname_ar ?> <?= $student->firstname_ar ?> <?= $student->lastname_ar ?></strong><br>
                              <strong>Sub Class : </strong>
                              <strong> <?= $subClass->sub_class ?></strong><br>
                            </div>
                            
                            <hr style="width:100%;border:3px solid #000;clear: both;margin: 5px 0px 5px 0px;">
                            
                            <div class="row12" style="width:50%;float: left;font-size: 20px;margin: 15px 0px 15px 0px;" >
                              <strong>MAX. Marks 100 Min. Marks 40</strong>
                            </div>
                            <div class="row12" style="text-align: right;width:50%;float: left;font-size: 20px;margin: 15px 0px 15px 0px;" >
                              <strong>MAX. Marks 100 Min. Marks 40</strong>
                            </div>
                            <table  cellpadding="5" style="padding: 5px;text-align: center;">
                                <thead>
                                  <tr>
                                    <th style="padding: 5px;text-align: center;">Obt. Marks</th>
                                    <th style="padding: 5px;text-align: center;">Subject</th>
                                    <th style="padding: 5px;text-align: center;">Sr.No.</th>
                                  </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $i = 1;
                                    if(empty($markdata) || count($markdata) == 0) {
                                        echo "<tr><td colspan='4'>No data Avalable!</td></tr>";
                                    } else {
                                        foreach ($markdata as $obj) {
                                            ?>
                                            <tr>
                                                <td style="padding: 5px;"><?= $obj['marks']; ?></td>
                                                <td style="padding: 5px;"><?= $obj['name_en']; ?></td>
                                                <td style="padding: 5px;"><?= $i; ?></td>
                                                
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="row12" style="width:50%;float: left;font-size: 20px;margin: 15px 0px 15px 0px;" >
                              <span>Percentage : <?= round($per, 2); ?></span>
                            </div>
                            <div class="row12" style="text-align: right;width:50%;float: left;font-size: 20px;margin: 15px 0px 15px 0px;" >
                              <span>Result : </span>
                            </div>           
                          </div>  
                            
                            
                            
                            <br><br><br><br>
                            <table cellpadding="5" style="display: none;">
                                <thead>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2" class="text-center">RESULT OF ANUAL EXAMINATION <?= $year ?></td>

                                    </tr>
                                    <tr>
                                        <td>Name of Student: <?= $student->surname_en ?> <?= $student->firstname_en ?> <?= $student->lastname_en ?></td>
                                        <td><?= $student->surname_ar ?> <?= $student->firstname_ar ?> <?= $student->lastname_ar ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>GR No. <?= $student->grno ?></td>
                                        <td>Percentage : <?= $per ?> %</td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="2">
                                            <table  cellpadding="5">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.No.</th>
                                                        <th>Subject</th>
                                                        <th>Total Marks</th>
                                                        <th>Obt. Marks</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    if(empty($markdata) || count($markdata) == 0) {
                                                        echo "<tr><td colspan='4'>No data Avalable!</td></tr>";
                                                    } else {
                                                        foreach ($markdata as $obj) {
                                                            ?>
                                                            <tr>
                                                                <td><?= $i; ?></td>
                                                                <td><?= $obj['name_en']; ?></td>
                                                                <td><?= $examdata->total_marks; ?></td>
                                                                <td><?= $obj['marks']; ?></td>
                                                            </tr>
                                                            <?php
                                                            $i++;
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="3"> Total Marks : </th>
                                                        <th><?= $obtainedMarks ?></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>    
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   

<script type="text/javascript">
    function printReport() {
       window.open('<?php echo Yii::$app->urlManager->createAbsoluteUrl(['admin/report/print-show-islamic-marksheet'])."?".$_SERVER['QUERY_STRING'] ?>', '_blank');
    } 
</script>