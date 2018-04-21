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
<input type="button" onclick="printDiv('report')" value="Print" />
<div class="report">
    <table class="table table-bordered" border="2" style="border-color: #999; border-collapse: collapse">
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