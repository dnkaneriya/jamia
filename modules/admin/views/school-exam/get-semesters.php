<?php
for($i=0; $i<$number; $i++) {
?>
<div class="form-group row">
<label class='control-label col-sm-3'>Semester <?= $i + 1 ?> Marks</label>
<div class="col-sm-5 field-schoolexam-semester_mark">
    <input type="text" name="schoolexam[semester_mark][]" id="schoolexam-semester_mark" class="form-control" onblur="checkMark($(this).val())">
</div>
</div>
<?php
}
?>

<script type="text/javascript">
var semester_mark = 0;
function checkMark(mark)
{
    
    var total_marks = $("#schoolexam-total_mark").val();
    semester_mark += mark;
    //alert(semester_mark);
//    if(semester_mark > total_marks) {
//        alert("dsfd");
//    }
    //alert(total_marks);
}
</script>
