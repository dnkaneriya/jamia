<link href="../../../../web/plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">                  
                 
<div id="printDiv" style='border:1px double #000; border-radius: 20px; padding:3px 10px 0 10px; color:#000; font-weight:600; font-size:17px; font-family:Roboto; margin:0 0 0px 0; width:auto; display:block;'>
  <div class="row12" style="width:90%;float: left;font-size: 22px;text-align: center;" >
    <strong style="font-size: 32px;">JAMEATUL ULOOM - GADHA
        At & Po. Gadha. Ta. Himmatnagar,</strong><br>
    <strong>
        Dist : Sabarkatha,
        Gujarat(North)India
    </strong><br>
    <strong>
        Room No.:<?php echo $room_no; ?>
    </strong>
  </div>
  <div class="row12" style="width:10%;float: left;" >
    <img src="<?php echo Yii::$app->request->baseUrl; ?>/img/logo.png">
  </div>
  <hr style="width:100%;border:3px solid #000;clear: both;margin: 5px 0px 5px 0px;">
  <div style="width:100%;margin: 30px 0px 70px 0px;font-size: 20px;" >
    <strong style="float: left;">
        <b>Room Monitor : </b><span style="font-weight: initial;"><?php echo $monitor_en; ?></span>
    </strong>
      <strong style="float: right;font-weight: initial;">
        <?php echo $monitor_ar; ?>
    </strong>
  </div>
  <table style="border: 1px;width:100%;text-align: center;margin-bottom: 50px;" border="1">
    <thead>
        <tr>
            <th style="padding: 3px;text-align: center;">Bed No.</th>
            <th style="padding: 3px;text-align: center;">English Name</th>
            <th style="padding: 3px;text-align: center;">Arabic Name</th>
            <th style="padding: 3px;text-align: center;">G.R.</th>			
            <th style="padding: 3px;text-align: center;">Bed No.</th>
            <th style="padding: 3px;text-align: center;">English Name</th>
            <th style="padding: 3px;text-align: center;">Arabic Name</th>
            <th style="padding: 3px;text-align: center;">G.R.</th>			
        </tr>
    </thead>
    <tbody>
      <?php
      $i = 1;
      foreach ($data as $row) {        
        if($i % 2 == 0){
        ?>
            <td style="padding: 3px;"><?= $row['bed_id']; ?></td>
            <td style="padding: 3px;"><?= $row['fullname']; ?></td>
            <td style="padding: 3px;"><?= $row['fullname']; ?></td>
            <td style="padding: 3px;"><?= $row['grno']; ?></td>
            </tr>
        <?php
        }else {                
            ?>
            <tr>
            <td style="padding: 3px;"><?= $row['bed_id']; ?></td>
            <td style="padding: 3px;"><?= $row['fullname']; ?></td>
            <td style="padding: 3px;"><?= $row['fullname']; ?></td>
            <td style="padding: 3px;"><?= $row['grno']; ?></td>
            <?php
        }
        $i++;
      }
      ?>
    </tbody>
  </table>
    
  <table class="table table-bordered" style="display: none;">
    <thead>

        <tr>
            <th colspan="3">Room No. <?php echo isset($room_no)?$room_no:'';?></th>
            <th colspan="3">Logo</th>
        </tr>
         <tr>
            <th colspan="3">Co-Guardian : -</th>
            <th colspan="3">Room Monitor : <?php echo isset($monitor)?$monitor:'';?></th>
        </tr>
        <tr>

            <th>Bed No.</th>

            <th>Room Partners</th>

            <th>G.R.</th>			
            
            <th>Bed No.</th>

            <th>Room Partners</th>

            <th>G.R.</th>			

        </tr>

    </thead>



    <tbody>

        <?php
        $i = 1;

        foreach ($data as $row) {        
            if($i % 2 == 0){
            ?>
                <td><?= $row['bed_id']; ?></td>
                <td><?= $row['fullname']; ?></td>
                <td><?= $row['grno']; ?></td>
                </tr>
            <?php
            }else {                
                ?>
                <tr>
                <td><?= $row['bed_id']; ?></td>
                <td><?= $row['fullname']; ?></td>
                <td><?= $row['grno']; ?></td>
                <?php
            }?>
<!--        </tr>-->
            <?php
            $i++;
            }
            ?>
    </tbody>

</table>
                  </div>

<!--<table class="table table-bordered">

    <thead>

        <tr>
            <th>Room No. </th>
            <th>Logo</th>
        </tr>
        <tr>

            <th>Bed No.</th>

            <th>Room Partners</th>

            <th>G.R.</th>			

        </tr>

    </thead>



    <tbody>

        <?php
        $i = 1;

        foreach ($data as $row) {
        ?>
        <tr>
            <td><?= $row['bed_id']; ?></td>
            <td><?= $row['fullname']; ?></td>
            <td><?= $row['grno']; ?></td>

        </tr>
            <?php
            $i++;
            }
            ?>
    </tbody>

</table>-->