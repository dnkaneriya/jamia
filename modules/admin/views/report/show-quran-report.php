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
                        Quran Report 
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
                                    <td colspan="4" class="text-center">Quran Report <?= $year ?> - <?= Yii::$app->params['islamic_month_en'][$month] ?></td>                                    
                                </tr>

                                <tr>
                                <table cellpadding="10" cellspacing="10">
                                    <tr>
                                        <td width="75%">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <?php
                                                        for ($i = 1; $i <= 30; $i++) {
                                                            ?>
                                                            <td>
                                                                <?= $i ?>
                                                                <br>
                                                                Para No. <?= $quranArr[$i]['para_no'] ?>
                                                                <br>
                                                                Line No. <?= $quranArr[$i]['line_no'] ?>
                                                            </td>
                                                            <?php
                                                            if ($i % 6 == 0) {
                                                                echo "</tr><tr>";
                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td sidth="25%">

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
                                                                    <td style="background-color: <?php if (isset($attendance[$i]) && $attendance[$i]['class'] == 'A') {
                                                                    echo 'red';
                                                                } ?>"><?= $i ?></td>
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

                                </tr>
                            </table>    
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    