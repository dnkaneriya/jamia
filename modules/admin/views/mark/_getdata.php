<?php $i=0;foreach($model as $subject){?>
	<div class="form-group field-mark-marks">
        <div class="row"><label class="control-label col-sm-2 form-control-label" for="mark-marks"><?=$subject->name_ar?></label>
            <div class="col-lg-4">
            <input type="text" id="mark-marks" class="form-control has-value" name="Mark[marks][<?=$i?>]" value="" maxlength="255" placeholder="Marks"><span for="mark-marks" class="help-block"></span>
            <input type="hidden" name="Mark[id][<?=$i?>]" value='<?=$subject->id?>' />
             <input type="hidden" name="Mark[subject][<?=$i?>]" value='<?=$subject->id?>' />
            <div class="help-block help-block-error "></div>
            </div>
          </div>
        </div>
	
<?php $i++;}?>
<?php /*
<input type="hidden" name="Mark[student_id]" value='<?=$student->id?>' />
<input type="hidden" name="Mark[class_id]" value='<?=$student->class_id?>' />
<input type="hidden" name="Mark[subclass_id]" value='<?=$student->sub_class_id?>' />
<input type="hidden" name="Mark[division_id]" value='<?=$student->divison_id?>' />*/ ?>