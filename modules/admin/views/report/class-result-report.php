<style type="text/css">
    table {
        border-collapse: collapse !important;
    }

    table td,  table th{
        border: 1px solid #333 !important;
    }
    
    table th {
        background: #dcdcdc;
    }
</style>
<div class="report" style="">
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
        <hr style="width:100%;border:3px solid #000;clear: both;margin: 5px 0px 5px 0px;">
        <div class="row12" style="width:50%;float: left;font-size: 20px;margin: 15px 0px 15px 0px;" >
          <strong>Exam Name</strong>
          <strong><?= $examdatadata->name ?></strong>
        </div>
        <div class="row12" style="width:50%;float: left;font-size: 20px;margin: 15px 0px 15px 0px;" >
          <strong>Exam Year </strong>
          <strong><?= $year ?></strong><br>
        </div>
        <div class="row12" style="width:100%;font-size: 20px;text-align: center;margin: 15px 0px 15px 0px;" >
          <strong>Sub Class :  </strong>
          <strong><?= $subClassdata->sub_class ?></strong><br>
        </div>
        <div class="row12" style="width:100%;text-align: center;font-size: 20px;margin: 15px 0px 15px 0px;" >
          <strong>Divison : </strong>
          <strong> <?= $divisondata->division ?></strong><br>
        </div>
        <table class="table table-bordered" border="2" style="border-color: #999; border-collapse: collapse">
        <thead>
            <tr>
                <th>No.</th>
                <th>G.R.</th>
                <th>Student Name Arabic</th>
                
                <?php
                foreach ($subjects as $subject) {
                    ?>
                    <th><?= $subject['name_en'] ?></th>
                    <?php
                }
                ?>
                <th>Total</th>
                <th>Percentage</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($data as $student) {
                ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $student['grno']; ?></td>
                    <td><?= $student['fullname']; ?></td>
                    
                    <?php
                    foreach ($subjects as $obj) {
                        ?>
                        <td><?= (isset($student['subject'][$obj['id']]) && $student['subject'][$obj['id']] != '' ) ? $student['subject'][$obj['id']] : '-'; ?></td>
                        <?php
                    }
                    ?>
                    <td><?= $data[$i - 1]['total'] ?></td>
                    <td><?= $data[$i - 1]['per'] ?> %</td>     
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
    </div>
    
    
    
    <table class="table table-bordered" border="2" style="display: none;border-color: #999; border-collapse: collapse">
        <thead>
            <tr>
                <th>Sr.No.</th>
                <th>GrNo</th>
                <th>Name</th>
                <th>Total</th>
                <th>Percentage</th>
                <?php
                foreach ($subjects as $subject) {
                    ?>
                    <th><?= $subject['name_en'] ?></th>
                    <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($data as $student) {
                ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $student['grno']; ?></td>
                    <td><?= $student['fullname']; ?></td>
                    <td><?= $data[$i - 1]['total'] ?></td>
                    <td><?= $data[$i - 1]['per'] ?> %</td>
                    <?php
                    foreach ($subjects as $obj) {
                        ?>
                        <td><?= (isset($student['subject'][$obj['id']]) && $student['subject'][$obj['id']] != '' ) ? $student['subject'][$obj['id']] : '-'; ?></td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>