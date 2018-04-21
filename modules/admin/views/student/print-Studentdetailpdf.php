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
                                <strong style="font-size:22px;">ADMISSION REGISTRATION SLIP</strong>
                            </div>
                            <table cellpadding="5" style="border-collapse: collapse;width:100%;width: 100%;">
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;width:200px;">Registration Status </td>
                                    <td style="padding: 5px;border: 1px solid #000;">
                                        <?php echo (isset($model->register_status) && $model->register_status == 'N') ? "New" : 'Old' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">First Name </td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?= $model->surname_en ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Middle Name </td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?= $model->firstname_en ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Last Name </td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?= $model->lastname_en ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Date Of Birth</td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?php echo date('d-m-Y', $model->dob) ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Fees</td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?php echo (isset($model->fees) && $model->fees == 'Y')? "YES" : 'NO' ?></td>
                                </tr>
                                <?php if(isset($model->fees) && $model->fees == 'Y'){ ?>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Amount</td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?=  $model->amount ?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Father Name</td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?= $model->father_name ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Grand Father Name</td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?= $model->grandfather_name ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Mother Name</td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?= $model->mother_name ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Parent Occupation</td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?= $model->parent_occupation ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Parent Annual Income</td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?= $model->parent_income ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Mobile No (1)</td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?= $model->mobile_no ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Mobile No (2)</td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?= $model->parent_mobile ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Email</td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?= $model->email ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Address</td>
                                    <td style="padding: 5px;border: 1px solid #000;">
                                        <?php echo "Street : ".$model->street."<br>"; ?>
                                        <?php echo "City : ".$model->city."<br>"; ?>
                                        <?php echo "Taluka : ".$model->taluka."<br>"; ?>
                                        <?php echo "State : ".$states = Yii::$app->params['indian_all_states'][$model->state]."<br>"; ?>
                                        <?php echo "District : ".$model->district."<br>"; ?>
                                        <?php echo "Pincode : ".$model->pincode."<br>"; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Previous Madrasa Name</td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?php echo (!$model->isNewRecord && $education != array())? $education->madrasa_name : '' ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Nazra</td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?php echo (!$model->isNewRecord && $education != array() && $education->nazra == 'Y')? "YES" : 'NO' ?></td>
                                </tr>
                                <?php if(!$model->isNewRecord && $education != array() && $education->nazra == 'Y'){ ?>
                                    <tr>
                                        <td style="padding: 5px;border: 1px solid #000;">How many Para’s In Quran Sharif?</td>
                                        <td style="padding: 5px;border: 1px solid #000;"><?php echo $education->nazra_para ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Hifz</td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?php echo (!$model->isNewRecord && $education != array() && $education->hifz == 'Y') ? "YES" : "NO"  ?></td>
                                </tr>
                                <?php if(!$model->isNewRecord && $education != array() && $education->hifz == 'Y'){ ?>
                                    <tr>
                                        <td style="padding: 5px;border: 1px solid #000;">How many Quran Sharif Para You Memorised?</td>
                                        <td style="padding: 5px;border: 1px solid #000;"><?php echo $education->hifz_para ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Urdu</td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?php echo (!$model->isNewRecord && $education != array() && $education->urdu == 'Y') ? "YES" : 'NO' ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Arabic</td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?php echo (!$model->isNewRecord && $education != array() && $education->arabic == 'Y')? "YES" : "NO" ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Previous School Name</td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?php echo (!$model->isNewRecord && $education != array()) ? $education->school_name : '' ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Pass Standard</td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?php echo (!$model->isNewRecord && $education != array()) ? $education->school_standard : '' ?></td>
                                </tr>
                                
                                 <tr>
                                    <td style="padding: 5px;border: 1px solid #000;">Admission Class</td>
                                    <td style="padding: 5px;border: 1px solid #000;"><?= $class->name ?>
                                   </td>
                                </tr>
                              
                                
                                
                            </table>
                            
                           
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
