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
                        Islamic Marksheet  
                    </div>
                    <div class="box-divider m-a-0"></div>

                    <div class="box-body">

                        <div class="report">
                            <table cellpadding="5">
                                <thead>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2" class="text-center">RESULT OF ANUAL EXAMINATION <?= $year ?></td>

                                    </tr>
                                    <tr>
                                        <td>Name of Student: <?= $student->surname_en ?> <?= $student->firstname_en ?> <?= $student->lastname_en ?></td>
                                        <td><?= $student->surname_ar ?> <?= $student->firstname_ar ?> <?= $student->lastname_ar ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>GR No. <?= $student->grno ?></td>
                                        <td>Percentage : <?= $per ?> %</td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="2">
                                            <table  cellpadding="5">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.No.</th>
                                                        <th>Subject</th>
                                                        <th>Total Marks</th>
                                                        <th>Obt. Marks</th>
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
                                                                <td><?= $i; ?></td>
                                                                <td><?= $obj['name_en']; ?></td>
                                                                <td><?= $examdata->total_marks; ?></td>
                                                                <td><?= $obj['marks']; ?></td>
                                                            </tr>
                                                            <?php
                                                            $i++;
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="3"> Total Marks : </th>
                                                        <th><?= $obtainedMarks ?></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>    
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    