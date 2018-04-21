<link rel="stylesheet" type="text/css" media="print" href="<?php echo Yii::$app->request->baseUrl; ?>/css/print.css">
<div id="view" class="app-body" ui-view="">
  <div class="padding">
    <div class="box">
      <div class="row">
        <div class="col-lg-12">
          <div class="box-divider m-a-0"></div>
            <div class="box-body">
              <div class="report">
                <div style="width:100%;" >
                  <div style="width:15%;float: left;" >&nbsp;</div>    
                  <div style="width:70%;float: left;font-size: 16px;border:1px solid #000;padding: 10px 10px 5px 10px ;" >
                    <div style="width:52%;float: left;">
                      <strong>JAMEATUL ULOOM - GADHA</strong><br>
                      <strong>JAMEATUL ULOOM - GADHA</strong><br>
                      <strong>JAMEATUL ULOOM - GADHA</strong>
                    </div>
                    <div style="width:10%;float: left;">
                     <img src="<?php echo Yii::$app->request->baseUrl; ?>/img/logo.png">
                    </div>
                    <div style="width:35%;float: left;text-align: right;font-size: 12px;">
                      <strong>
                          At & Po. GADHA.<br> 
                          Ta. Himmatnagar,<br> 
                          Dist : Sabarkatha,<br>
                          (Guj.) Pin : 383010.<br> 
                          Ph.:(02772) 281367
                      </strong>
                    </div>
                    <div style="width:100%;font-size: 16px;" >  
                    <hr style="width:100%;border:3px solid #000;height: 2px;margin: 5px 0px 5px 0px;">  
                    </div>
                    <div style="width:100%;font-size: 16px;" >

                      <strong>Result of Annual Exam (School department) <span class="border-bottom"><?= $year ?></span></strong>
                    </div>
                    <div style="width:100%;font-size: 16px;" >  
                    <hr style="width:100%;border:3px solid #000;height: 2px;margin: 5px 0px 5px 0px;">  
                    </div>
                    <div style="width:100%;font-size: 16px;margin: 5px 0px 0px 0px;">
                      <table cellpadding="5" style="border-collapse: collapse;width:100%;text-align: center;"> 
                        <tr>
                          <td style="width:25%;padding: 5px 5px 5px 0px; text-align: left;"><b><b>Name Student :</b></b></td>
                          <td style="width:75%;padding: 5px;text-align: left;border-bottom: 1px solid #000;"><span><?php echo $student->surname_en." ".$student->firstname_en." ".$student->lastname_en; ?></span></td>
                        </tr>
                      </table>
                    </div>   
                    <div style="width:100%;font-size: 16px;margin: 15px 0px 0px 0px;"> 
                      <table cellpadding="5" style="border-collapse: collapse;width:100%;text-align: center;"> 
                        <tr>
                          <td style="width:15%;padding: 5px 5px 5px 0px; text-align: left;"><b>GR. NO.:</b></td>
                          <td style="width:15%;padding: 5px;text-align: left;border-bottom: 1px solid #000;"><span><?php echo $student->grno; ?></span></td>
                          <td style="width:10%;padding: 5px 5px 5px 0px; text-align: left;"><b>Std.:</b></td>
                          <td style="width:10%;padding: 5px;text-align: left;border-bottom: 1px solid #000;"><span><?php echo $student->school_standard; ?></span></td>
                          <td style="width:22%;padding: 5px 5px 5px 0px; text-align: left;"><b>Class : Arabic </b></td>
                          <td style="width:28%;padding: 5px;text-align: left;border-bottom: 1px solid #000;"><span> test </span></td>
                        </tr>
                      </table>  

                    </div>
                    <div style="width:100%;font-size: 16px;margin: 15px 0px 0px 0px;">
                      <table cellpadding="5" style="border-collapse: collapse;width:100%;text-align: center;">
                        <thead>
                          <tr>
                            <th style="padding: 5px;text-align: center;border: 1px solid #000;">S.No.</th>
                            <th style="padding: 5px;text-align: center;border: 1px solid #000;">Subjects</th>
                            <th style="padding: 5px;text-align: center;border: 1px solid #000;">Total Marks</th>
                            <th style="padding: 5px;text-align: center;border: 1px solid #000;">Obt. Marks</th>
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
                                <td style="padding: 5px;text-align: center;border: 1px solid #000;"><?php echo ++$taj_count;?></td>
                                <td style="padding: 5px;text-align: center;border: 1px solid #000;"><?php echo $row['name_en'];?></td>
                                <td style="padding: 5px;text-align: center;border: 1px solid #000;"><?php echo $row['total_mark'];?></td>
                                <td style="padding: 5px;text-align: center;border: 1px solid #000;"><?php echo $row['marks'];?></td>
                              </tr>
                              <?php
                              $t_obt_marks +=  $row['marks'];
                              $t_total_marks += $row['total_mark'];
                              }
                              ?>
                              <tr>
                                <td style="padding: 5px;text-align: center;border: 1px solid #000;">&nbsp;</td>
                                <td style="padding: 5px;text-align: center;border: 1px solid #000;">&nbsp;</td>
                                <td style="padding: 5px;text-align: center;border: 1px solid #000;">&nbsp;</td>
                                <td style="padding: 5px;text-align: center;border: 1px solid #000;">&nbsp;</td>
                              </tr>
                              <tr>
                                <td style="padding: 5px;text-align: center;border: 1px solid #000;">&nbsp;</td>
                                <td style="padding: 5px;text-align: center;border: 1px solid #000;">&nbsp;</td>
                                <td style="padding: 5px;text-align: center;border: 1px solid #000;">&nbsp;</td>
                                <td style="padding: 5px;text-align: center;border: 1px solid #000;">&nbsp;</td>
                              </tr>
                              <tr>
                                <td style="padding: 5px;text-align: center;border: 1px solid #000;">&nbsp;</td>
                                <td style="padding: 5px;text-align: center;border: 1px solid #000;"><?php echo '<b>Total</b>';?></td>
                                <td style="padding: 5px;text-align: center;border: 1px solid #000;"><?php echo $t_total_marks;?></td>
                                <td style="padding: 5px;text-align: center;border: 1px solid #000;"><?php echo $t_obt_marks;?></td>
                              </tr>
                              <tr>
                                <td style="padding: 5px;text-align: left;padding-top: 20px;"><b>Grade:</b></td>
                                <td colspan="3" style="padding: 5px;text-align: left;border-bottom:1px solid #000;padding-top: 20px;"></td>
                              </tr>
                              <tr>
                                <td  style="width:15%;padding: 5px;text-align: left;padding-top: 20px;"><b>Date :</b></td>
                                <td  style="width:17%;padding: 5px;text-align: left;border-bottom:1px solid #000;padding-top: 20px;"><b></b></td>
                                <td  style="width:27%;padding: 5px;text-align: left;padding-top: 20px;"><b>Parent`s Sign.</b></td>
                                <td  style="padding: 5px;text-align: left;border-bottom:1px solid #000;padding-top: 20px;"><b></b></td>
                              </tr>

                              <?php
                          }
                          else{
                             echo "<tr><td colspan='4'>No data Available!</td></tr>";
                          }
                          ?>

                        </tbody>
                      </table> 
                      <table cellpadding="5" style="border-collapse: collapse;width:100%;text-align: center;"> 
                        <tr>
                          <td style="width:50%;padding: 5px;text-align: left;padding-top: 50px;"><b style="border-top:1px solid #000;">Class teacher's Sign.</b></td>
                          <td style="width:50%;padding: 5px;text-align: right;padding-top: 50px;"><b style="border-top:1px solid #000;">Principal's Sign.</b></td>
                        </tr>
                      </table> 
                    </div>  
                  </div>
<!--                              <div style="width:20%;float: left;" ></div>-->
                </div>
              </div>    
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
