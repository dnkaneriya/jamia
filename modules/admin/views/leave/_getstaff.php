<div class="form-group field-leave-staff_id required">
    <div class="row"><label class="control-label col-sm-2 form-control-label" for="leave-staff_id">Staff</label>
        <div class="col-lg-6">
        <select id="leave-staff_id" class="form-control" name="Leave[staff_id]">
        <option value="">-Select Staff-</option>
		<?php foreach($model as $staff){
			$selected='';
			if($staff_id != '' && $staff_id==$staff->id)
				$selected="selected='selected'";
			
			?>
        <option value="<?=$staff->id?>" <?=$selected?> ><?=$staff->name?></option>
		 <?php }?>

        </select>
        
        <div class="help-block help-block-error "></div>
        </div>
    </div>
</div>
	
