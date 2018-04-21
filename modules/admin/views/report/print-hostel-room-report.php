               
<div id="printDiv" style='border:2px double #000; border-radius: 20px; padding:3px 10px 0 10px; color:#000; font-weight:600; font-size:17px; font-family:Roboto; margin:0 0 0px 0; width:auto; display:block;'>
  <div class="row12" style="width:80%;float: left;font-size: 18px;text-align: center;" >
    <strong style="font-size: 22px;">JAMEATUL ULOOM - GADHA
        At & Po. Gadha. Ta. Himmatnagar,</strong><br>
    <strong>
        Dist : Sabarkatha,
        Gujarat(North)India
    </strong><br>
    <strong>
        Room No.:<?php echo $room_no; ?>
    </strong>
  </div>
  <div class="row12" style="width:10%;float: left;text-align: center;" >
    <img src="<?php echo Yii::$app->request->baseUrl; ?>/img/logo.png">
  </div>
  <hr style="width:100%;border:3px solid #000;clear: both;margin: 5px 0px 5px 0px;">
  <div style="width:55%;float: left;margin: 3px 0px 10px 0px;font-size: 14px;" >
    <span>
        <b>Room Monitor : </b><span style="font-weight: initial;"><?php echo $monitor_en; ?></span>
    </span>
  </div>
  <div style="width:45%;float: left;margin: 3px 0px 10px 0px;font-size: 18px;text-align: right;" >
    <span style="">
        <?php echo $monitor_ar; ?>
    </span>
  </div>
  <div style="clear: both;"></div>
  <table style="border-collapse: collapse;width:100%;text-align: center;margin-bottom: 50px;" >
    <thead>
        <tr>
            <th style="padding: 3px;text-align: center;border: 1px solid #000;">Bed No.</th>
            <th style="padding: 3px;text-align: center;border: 1px solid #000;">English Name</th>
            <th style="padding: 3px;text-align: center;border: 1px solid #000;">Arabic Name</th>
            <th style="padding: 3px;text-align: center;border: 1px solid #000;">G.R.</th>			
            <th style="padding: 3px;text-align: center;border: 1px solid #000;">Bed No.</th>
            <th style="padding: 3px;text-align: center;border: 1px solid #000;">English Name</th>
            <th style="padding: 3px;text-align: center;border: 1px solid #000;">Arabic Name</th>
            <th style="padding: 3px;text-align: center;border: 1px solid #000;">G.R.</th>			
        </tr>
    </thead>
    <tbody>
      <?php
      $i = 1;
      foreach ($data as $row) {        
        if($i % 2 == 0){
        ?>
            <td style="padding: 3px;border: 1px solid #000;"><?= $row['bed_id']; ?></td>
            <td style="padding: 3px;border: 1px solid #000;"><?= $row['fullname']; ?></td>
            <td style="padding: 3px;border: 1px solid #000;"><?= $row['fullname']; ?></td>
            <td style="padding: 3px;border: 1px solid #000;"><?= $row['grno']; ?></td>
            </tr>
        <?php
        }else {                
            ?>
            <tr>
            <td style="padding: 3px;border: 1px solid #000;"><?= $row['bed_id']; ?></td>
            <td style="padding: 3px;border: 1px solid #000;"><?= $row['fullname']; ?></td>
            <td style="padding: 3px;border: 1px solid #000;"><?= $row['fullname']; ?></td>
            <td style="padding: 3px;border: 1px solid #000;"><?= $row['grno']; ?></td>
            <?php
        }
        $i++;
      }
      ?>
    </tbody>
  </table>
</div>
