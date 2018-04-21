<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\ArrayHelper;
use app\models\Program;
use app\models\Student;
/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = 'Participated  List';

?>
<div id="m-a-a" class="modal fade animate in" data-backdrop="true" style="display: block;">
  <div class="modal-dialog fade-up" id="animate" ui-class="fade-up">
    <div class="modal-content">
      <div class="modal-header">
      	<h5 class="modal-title"><?=$model->name.' - '?><?=date('d M Y', $model->p_date);?></h5>
      </div>
      <div class="modal-body text-center p-lg">
      <h5>List of Student</h5>
        <table class="table table-striped b-t table-bordered" style="margin-bottom: 0px;">
		    <thead>
			<tr>
			    <th>#</th>
			    <th>Paricipated Gr No</th>
			    <th>Participated Name</th>
			</tr>
		    </thead>
						
		    
			<?php
				$index = 1;
				$grnos=explode(",",$model->grnos);
				$students = Student::find()->where(['is_deleted'=>'N','grno'=>$grnos])->all();
				if($students != array())
				{
					foreach($students as $student):
			?>
					<tr id="safar-<?=$student->id?>">
					<td><?=$index?>&nbsp;</td>
					<td><?=$student->grno?>&nbsp;</td>
					<td><?=$student->fullname_en?>&nbsp;</td>
					<?php $index++; ?>
				<?php  endforeach; } ?>
			</tr>
			
		    </tbody>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
        
      </div>
    </div><!-- /.modal-content -->
  </div>
</div>

