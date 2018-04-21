

<div id="view" class="app-body" ui-view="">
    <div class="padding">
        <div class="box">
            <div class="row">
                <div class="col-lg-12">
                   <div class="box-divider m-a-0"></div>

                    <div class="box-body">

                        <div class="report">
                          <div class="row12" style="width:100%;" >
                            <div class="row12" style="width:45%;float: left;font-size: 16px;" >
                              <strong style="font-size: 20px;">JAMEATUL ULOOM - GADHA</strong><br>
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
                            <div class="row12" style="width:45%;float: left;font-size: 16px;text-align: right;" >
                              <strong style="font-size: 20px;">JAMEATUL ULOOM - GADHA</strong><br>
                              <strong>
                                  At & Po. Gadha.<br> 
                                  Ta. Himmatnagar,Dist : Sabarkatha,<br>
                                  Gujarat(North)India Pin:383010<br> 
                                  Phone:(02772) 281367
                              </strong>
                            </div>
                            <hr style="width:100%;border:10px solid #000;height: 5px;clear: both;margin: 5px 0px 5px 0px;">
                            
                            <div class="row12" style="width:100%;font-size: 16px;text-align: center;margin: 10px 0px 10px 0px;" >
                                <strong style="font-size:22px;">MARKS SHEET :  </strong>
                              <strong> 123</strong>
                            </div>
                            <div class="row12" style="width:100%;text-align: center;font-size: 16px;margin: 10px 0px 10px 0px;" >
                              <strong>Exam Name : <?= $examdata->name ?> </strong>
                            </div>
                            <div class="row12" style="width:100%;text-align: center;font-size: 16px;margin: 10px 0px 10px 0px;" >
                              <strong>Exam Year <?= $year ?> </strong>
                            </div>
                            
                            <div class="row12" style="width:50%;float: left;font-size: 16px;margin: 10px 0px 10px 0px;" >
                              <strong>G.R.No. : </strong>
                              <strong> <?= $student->grno ?></strong><br>
                              <strong>Name Of Student : </strong>
                              <strong> <?= $student->surname_en ?> <?= $student->firstname_en ?> <?= $student->lastname_en ?></strong><br>
                              <strong>Sub Class : </strong>
                              <strong> <?= $subClass->sub_class ?></strong><br>
                              <strong>Divison : </strong>
                              <strong> <?= $divison->division ?></strong>
                            </div>
                            <div class="row12" style="text-align: right;width:50%;float: left;font-size: 16px;margin: 10px 0px 10px 0px;" >
                              <strong>Arabio Name : </strong>
                              <strong> <?= $student->surname_ar ?> <?= $student->firstname_ar ?> <?= $student->lastname_ar ?></strong><br>
                              <strong>Sub Class : </strong>
                              <strong> <?= $subClass->sub_class ?></strong><br>
                            </div>
                            
                            <hr style="width:100%;border:10px solid #000;height: 7px;clear: both;margin: 5px 0px 5px 0px;">
                            
                            <div class="row12" style="width:50%;float: left;font-size: 16px;margin: 10px 0px 10px 0px;" >
                              <strong>MAX. Marks 100 Min. Marks 40</strong>
                            </div>
                            <div class="row12" style="text-align: right;width:50%;float: left;font-size: 16px;margin: 10px 0px 10px 0px;" >
                              <strong>MAX. Marks 100 Min. Marks 40</strong>
                            </div>
                            <table  cellpadding="5" style="border-collapse: collapse;width:100%;text-align: center;width: 100%;">
                                <thead>
                                  <tr>
                                    <th style="padding: 5px;text-align: center;border: 1px solid #000;">Obt. Marks</th>
                                    <th style="padding: 5px;text-align: center;border: 1px solid #000;">Subject</th>
                                    <th style="padding: 5px;text-align: center;border: 1px solid #000;">Sr.No.</th>
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
                                                <td style="padding: 5px;text-align: center;border: 1px solid #000;"><?= $obj['marks']; ?></td>
                                                <td style="padding: 5px;text-align: center;border: 1px solid #000;"><?= $obj['name_en']; ?></td>
                                                <td style="padding: 5px;text-align: center;border: 1px solid #000;"><?= $i; ?></td>
                                                
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="row12" style="width:50%;float: left;font-size: 16px;margin: 10px 0px 10px 0px;" >
                              <span>Percentage : <?= round($per, 2); ?></span>
                            </div>
                            <div class="row12" style="text-align: right;width:50%;float: left;font-size: 16px;margin: 10px 0px 10px 0px;" >
                              <span>Result : </span>
                            </div>           
                          </div>  
                           
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    