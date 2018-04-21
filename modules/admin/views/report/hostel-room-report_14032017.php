<link href="../../../../web/plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">                  
                  
<div id="printDiv" style='border:1px double #000; border-radius: 20px; padding:3px 10px 0 10px; color:#000; font-weight:600; font-size:17px; font-family:Roboto; margin:0 0 0px 0; width:auto; display:block;'>
<!--                  <p>Room No. (5)</p>
                  <p>Logo</p>                  -->
    <table class="table table-bordered">
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