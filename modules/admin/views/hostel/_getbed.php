<div class="form-group field-hostel-room_id required">
    <div class="row"><label class="control-label col-sm-2 form-control-label" for="hostel-bed_id">Bed</label>
        <div class="col-lg-6">
        <select id="hostel-bed_id" class="form-control changebed" name="Hostel[bed_id]">
        <option value="">-Select Bed-</option>
		<?php foreach($model as $bed){
			$selected='';
			if($bed_id != '' && $bed_id==$bed->id)
				$selected="selected='selected'";
			
			?>
        <option value="<?=$bed->id?>" <?=$selected?> ><?=$bed->bed_no?></option>
		 <?php }?>

        </select>
        
        <div class="help-block help-block-error "></div>
        </div>
    </div>
</div>
	
