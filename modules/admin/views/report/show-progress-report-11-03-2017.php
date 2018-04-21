<style type="text/css">
    table {
        border-collapse: collapse !important;
        width:100%
    }

    table td,  table th{
        border: 2px solid #333 !important;
        cellspacing:5px;
        margin:2px;
        padding:5px;
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
                        Progress Report
                    </div>
                    <div class="box-divider m-a-0"></div>

                    <div class="box-body">

                        <div class="report">
                            <?php
                            if(empty($islamicSubjects) || count($islamicSubjects) == 0 || empty($schoolSubjects) || count($schoolSubjects) == 0) {
                              echo "<p>No Islamic/School Subjects Available for this Class</p>";  
                            } else {
                            ?>
                            <table cellspacing="10" cellpadding="10">
                                <tr>
                                    <td colspan="2" style="text-align:center"><h2><?= Yii::$app->params['islamic_month_en'][$month] ?></h2></td>
                                </tr>
                                <tr>
                                    <td width="75%">
                                        <table style="border:0px !important">
                                            <tr>
                                                <td style="border:0px !important">
                                                    <table>
                                                        <tbody>    
                                                            <?php
                                                            for ($i = 100; $i >= 10; $i = $i - 10) {
                                                                ?>
                                                                <tr>
                                                                    <?php
                                                                    foreach ($islamicSubjects as $islamic) {
                                                                        ?>
                                                                        <td style="background-color: <?php if(isset($islamic['rating']) && $islamic['rating']>=($i-10)){ echo 'green'; } ?>">&nbsp;</td>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <?php
                                                            foreach ($islamicSubjects as $isubject) {
                                                                ?>
                                                            <th><?= $isubject['name_ar']; ?></th>
                                                            <?php
                                                        }
                                                        ?>
                                                        </tfoot>
                                                    </table>
                                                </td>
                                                <td style="border:0px !important">

                                                    <table>
                                                        <tbody>    
                                                            <?php
                                                            for ($i = 100; $i >= 10; $i = $i - 10) {
                                                                ?>
                                                                <tr>
                                                                    <td><?= $i ?></td>
                                                                </tr> 


                                                            <?php } ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>&nbsp;</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>

                                                </td>
                                                <td style="border:0px !important">

                                                    <table>
                                                        <tbody>    
                                                            <?php
                                                            for ($i = 100; $i >= 10; $i = $i - 10) {
                                                                ?>
                                                                <tr>
                                                                    <?php
                                                                    foreach ($schoolSubjects as $school) {
                                                                        ?>
                                                                        <td style="background-color: <?php if(isset($school['rating']) && $school['rating']>=($i-10)){ echo 'green'; } ?>">&nbsp;</td>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <?php
                                                            foreach ($schoolSubjects as $ssubject) {
                                                                ?>
                                                            <th><?= $ssubject['name_ar']; ?></th>
                                                            <?php
                                                        }
                                                        ?>
                                                        </tfoot>
                                                    </table>

                                                </td>
                                            </tr>
                                        </table>

                                    </td>
                                    <td width="25%">
                                        <table>
                                            <tr>
                                                <td style="border:0px !important">
                                                    <strong>Weight : <?= isset($weightheight->weight) ? $weightheight->weight : '-' ?></strong> CM<br>
                                                    <strong>Height : <?= isset($weightheight->height) ? $weightheight->height : '-' ?></strong> KG
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border:0px !important">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td style="border:0px !important">
                                                    <table>
                                                        <tr>
                                                            <?php
                                                            for ($i = 1; $i <= 30; $i++) {
                                                                ?>
                                                            <td style="background-color: <?php if(isset($attendance[$i]) && $attendance[$i]['class']=='A'){ echo 'red'; } ?>"><?= $i ?></td>
                                                                <?php
                                                                if ($i % 6 == 0) {
                                                                    echo "</tr>";
                                                                    echo "<tr>";
                                                                }
                                                            }
                                                            ?>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <?php } ?>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
