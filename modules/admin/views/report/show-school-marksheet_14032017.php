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
                    <div class="box-header">
                        School Marksheet  
                    </div>
                    <div class="box-divider m-a-0"></div>

                    <div class="box-body">

                        <div class="report">
                            <table cellpadding="5">                                
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
                                        <table>
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