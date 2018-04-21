<div class="report" style="">
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
        <hr style="width:100%;border:3px solid #000;clear: both;margin: 5px 0px 5px 0px;">
        <div class="row12" style="width:50%;float: left;font-size: 16px;margin: 15px 0px 15px 0px;" >
          <strong>Exam Name</strong>
          <strong><?= $examdatadata->name ?></strong>
        </div>
        <div class="row12" style="width:50%;float: left;font-size: 16px;margin: 15px 0px 15px 0px;" >
          <strong>Exam Year </strong>
          <strong><?= $year ?></strong><br>
        </div>
        <div class="row12" style="width:100%;font-size: 16px;text-align: center;margin: 15px 0px 15px 0px;" >
          <strong>Sub Class :  </strong>
          <strong><?= $subClassdata->sub_class ?></strong><br>
        </div>
        <div class="row12" style="width:100%;text-align: center;font-size: 16px;margin: 15px 0px 15px 0px;" >
          <strong>Divison : </strong>
          <strong> <?= $divisondata->division ?></strong><br>
        </div>
        <table cellpadding="5" style="border-collapse: collapse;width:100%;text-align: center;width: 100%;">
        <thead>
            <tr>
                <th style="padding: 5px;text-align: center;border: 1px solid #000;">No.</th>
                <th style="padding: 5px;text-align: center;border: 1px solid #000;">G.R.</th>
                <th style="padding: 5px;text-align: center;border: 1px solid #000;">Student Name Arabic</th>
                
                <?php
                foreach ($subjects as $subject) {
                    ?>
                    <th style="padding: 5px;text-align: center;border: 1px solid #000;"><?= $subject['name_en'] ?></th>
                    <?php
                }
                ?>
                <th style="padding: 5px;text-align: center;border: 1px solid #000;">Total</th>
                <th style="padding: 5px;text-align: center;border: 1px solid #000;">Percentage</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($data as $student) {
                ?>
                <tr>
                    <td style="padding: 5px;text-align: center;border: 1px solid #000;"><?= $i; ?></td>
                    <td style="padding: 5px;text-align: center;border: 1px solid #000;"><?= $student['grno']; ?></td>
                    <td style="padding: 5px;text-align: center;border: 1px solid #000;"><?= $student['fullname']; ?></td>
                    
                    <?php
                    foreach ($subjects as $obj) {
                        ?>
                        <td style="padding: 5px;text-align: center;border: 1px solid #000;"><?= (isset($student['subject'][$obj['id']]) && $student['subject'][$obj['id']] != '' ) ? $student['subject'][$obj['id']] : '-'; ?></td>
                        <?php
                    }
                    ?>
                    <td style="padding: 5px;text-align: center;border: 1px solid #000;"><?= $data[$i - 1]['total'] ?></td>
                    <td style="padding: 5px;text-align: center;border: 1px solid #000;"><?= $data[$i - 1]['per'] ?> %</td>     
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
    </div>
</div>
