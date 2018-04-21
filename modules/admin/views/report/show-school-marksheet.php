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
    .font-size-20{
        font-size: 20px;
    }
    .font-size-18{
        font-size: 18px;
    }
    .border-bottom{
        border-bottom: 2px solid #000;
    }
    
    
</style>
<link rel="stylesheet" type="text/css" media="print" href="<?php echo Yii::$app->request->baseUrl; ?>/css/print.css">
<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box-header">
                        School Marksheet  
                    </div>
                    <div class="box-divider m-a-0"></div>

                    <div class="box-body">

                        <div class="report">
                            <button type="button" id="print_btn" class="btn btn-success" onclick="printReport()">Print</button>
                            <br><br>
                            <div class="row" >
                                
                              <div class="col-lg-3"></div>
                              <div class="col-lg-6" style="border:1px solid #000;padding: 10px;">
                                <div class="col-lg-7 font-size-20">
                                  <strong>JAMEATUL ULOOM - GADHA</strong><br>
                                  <strong>JAMEATUL ULOOM - GADHA</strong><br>
                                  <strong>JAMEATUL ULOOM - GADHA</strong>
                                </div>
                                <div class="col-lg-1">
                                 <img src="<?php echo Yii::$app->request->baseUrl; ?>/img/logo.png">
                                </div>
                                <div class="col-lg-4 text-right">
                                  <strong>
                                      At & Po. GADHA.<br> 
                                      Ta. Himmatnagar,<br> 
                                      Dist : Sabarkatha,<br>
                                      (Guj.) Pin : 383010.<br> 
                                      Ph.:(02772) 281367
                                  </strong>
                                </div>
                                <div class="col-lg-12 font-size-20">
                                  <hr style="height: 1px"> 
                                </div>
                                <div class="col-lg-12 font-size-20">
                                    <strong>Result of Annual Exam (School department) <span class="border-bottom"><?= $year ?></span></strong>
                                </div>  
                                <div class="col-lg-12 font-size-20">
                                  <hr style="height: 1px"> 
                                </div>  
                                  <div class="col-lg-12 font-size-18" style="margin-bottom: 15px;">
                                      <strong>Name Student :<span style="border-bottom: 2px solid #000;"><?php echo $student->surname_en." ".$student->firstname_en." ".$student->lastname_en; ?></span></strong>
                                </div> 
                                <div class="col-lg-4 font-size-18">
                                    <strong>GR. NO.:<span style="border-bottom: 2px solid #000;"><?php echo $student->grno; ?></span></strong>
                                </div>
                                <div class="col-lg-3 font-size-18">
                                    <strong>Std.:<span style="border-bottom: 2px solid #000;"><?php echo $student->school_standard; ?></span></strong>
                                </div>
                                <div class="col-lg-5 font-size-18">
                                    <strong>Class : Arabic______</strong>
                                </div> 
                                <div class="col-lg-12 font-size-18" style="margin: 15px 0px 15px 0px;">
                                  <table>
                                    <thead>
                                      <tr>
                                        <th class="text-center">S.No.</th>
                                        <th class="text-center">Subjects</th>
                                        <th class="text-center">Total Marks</th>
                                        <th class="text-center">Obt. Marks</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                      $taj_count = 0;
                                      $t_obt_marks = 0;
                                      $t_total_marks = 0;
                                      if(!empty($markdata)){
                                          foreach($markdata as $row){                                                
                                              ?>
                                          <tr>
                                            <td class="text-center"><?php echo ++$taj_count;?></td>
                                            <td class="text-center"><?php echo $row['name_en'];?></td>
                                            <td class="text-center"><?php echo $row['total_mark'];?></td>
                                            <td class="text-center"><?php echo $row['marks'];?></td>
                                          </tr>
                                          <?php
                                          $t_obt_marks +=  $row['marks'];
                                          $t_total_marks += $row['total_mark'];
                                          }
                                          ?>
                                          <tr>
                                            <td class="text-center">&nbsp;</td>
                                            <td class="text-center">&nbsp;</td>
                                            <td class="text-center">&nbsp;</td>
                                            <td class="text-center">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td class="text-center">&nbsp;</td>
                                            <td class="text-center">&nbsp;</td>
                                            <td class="text-center">&nbsp;</td>
                                            <td class="text-center">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td class="text-center">&nbsp;</td>
                                            <td class="text-center"><?php echo '<b>Total</b>';?></td>
                                            <td class="text-center"><?php echo $t_total_marks;?></td>
                                            <td class="text-center"><?php echo $t_obt_marks;?></td>
                                          </tr>
                                          <?php
                                      }
                                      else{
                                         echo "<tr><td colspan='4'>No data Available!</td></tr>";
                                      }
                                      ?>
                                    </tbody>
                                  </table> 
                                </div>
                                <div class="col-lg-12 font-size-18" style="margin-bottom: 15px;">
                                    <strong>Grade:____________________________________________</strong>
                                </div>
                                <div class="col-lg-5 font-size-18">
                                    <strong>Date :______________</strong>
                                </div>
                                <div class="col-lg-7 font-size-18">
                                    <strong>Parent`s Sign.________________</strong>
                                </div>
                                  
                                <div class="col-lg-5 font-size-18 text-left" style="margin-top: 55px;">
                                    <strong style="border-top:2px solid #000;">Class teacher's Sign.</strong>
                                </div>
                                <div class="col-lg-7 font-size-18 text-right" style="margin-top: 55px;">
                                    <strong style="border-top:2px solid #000;">Principal's Sign.</strong>
                                </div>  
                              </div>
                          <div class="col-lg-3"></div>
                            
                        </div>    
                            
                            <table cellpadding="5" style="display: none;">                                
                                    <tr>
                                        <td><strong>JAMEATUL ULOOM - GADHA <br>
At & Po. GADHA. Ta. Himmatnagar, Dist : S.K. (Gujarat)<br>

India Pin : 383010. Ph. (02772) 281367</strong></td>
                                        <td colspan="2" class="text-center" >
                            <img src="/demo/web/img/logo.png">
                        </td>
                                        <td class="text-right"><strong>JAMEATUL ULOOM - GADHA <br>
At & Po. GADHA. Ta. Himmatnagar, Dist : S.K. (Gujarat)<br>

India Pin : 383010. Ph. (02772) 281367</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-center">RESULT OF ANUAL EXAMINATION <?= $year ?></td>                                    
                                    </tr>

                                    <tr>
                                        <table style="display: none;">
                                            <thead>
                                            <tr>
                                            <th class="text-center">Obt. Marks</th>
                                            <th class="text-center">Total Marks</th>
                                            <th class="text-center">Subjects</th>
                                            <th class="text-center">S.No.</th>
                                            </tr>
                                            </thead>
                                        <tbody>
                                            <?php 
                                            $taj_count = 0;
                                            $t_obt_marks = 0;
                                            $t_total_marks = 0;
                                            if(!empty($markdata)){
                                                foreach($markdata as $row){                                                
                                                    ?>
                                                <tr>
                                                <td class="text-center"><?php echo $row['marks'];?></td>
                                                <td class="text-center"><?php echo $row['total_mark'];?></td>
                                                <td class="text-center"><?php echo $row['name_en'];?></td>
                                                <td class="text-center"><?php echo ++$taj_count;?></td>
                                                </tr>
                                                <?php
                                                $t_obt_marks +=  $row['marks'];
                                                $t_total_marks += $row['total_mark'];
                                                }
                                                ?>
                                                <tr>
                                                <td class="text-center"><?php echo $t_obt_marks;?></td>
                                                <td class="text-center"><?php echo $t_total_marks;;?></td>
                                                <td class="text-center"><?php echo '<b>Total</b>';?></td>
                                                <td class="text-center">&nbsp;</td>
                                                </tr>
                                                <?php
                                            }
                                            else{
                                               echo "<tr><td colspan='4'>No data Available!</td></tr>";
                                            }
                                            ?>
                                            
                                        </tbody>
                                        <tfoot>
                                            <th><?= $obtainedMarks ?></th>
                                            <th> - Total Marks</th>
                                            <th><?= $per ?> %</th>
                                            <th> - Percentage</th>
                                        </tfoot>
                                        </table>
                                    </tr>
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
        window.open('<?php echo Yii::$app->urlManager->createAbsoluteUrl(['admin/report/print-show-school-marksheet'])."?".$_SERVER["QUERY_STRING"] ?>', '_blank');
    } 

</script>