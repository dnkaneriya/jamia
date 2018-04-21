<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\ArrayHelper;
use app\models\Tarbiyatsubject;
use app\models\Student;
/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = 'Tarbiyar Card';
$student = Student::find()->where(['id'=>$model->student_id])->one();
?>
<div id="m-a-a" class="modal fade animate in" data-backdrop="true" style="display: block;">
  <div class="modal-dialog fade-up" id="animate" ui-class="fade-up">
    <div class="modal-content">
      <div class="modal-header">
      	<h5 class="modal-title"><?=$student->fullname?>'s Tarbiyat Card</h5>
      </div>
      <div class="modal-body text-center p-lg">
        <table class="table table-striped b-t table-bordered" style="margin-bottom: 0px;">
		    <thead>
			<tr>
			    <th>#</th>
			    <th>Subject</th>
			    <th>Option</th>
			</tr>
		    </thead>
						
		    
			<?php
				$index=1;
				$options=array('A'=>'Regular without any person tell','B'=>'Regular but in month some time lazy','C'=>'Regular but always lazy','D'=>'Not Regular');				
				if($tarbiyatcardlist != array()):
					foreach($tarbiyatcardlist as $tarbiyatcard):
					
					$tSubject = Tarbiyatsubject::find()->where(['id'=>$tarbiyatcard->tarbiyat_subject_id])->one();
					$Subject=$tSubject!=array()?$tSubject->subject_en:'';
			?>
					<tr>
                        <td><?=$index?>&nbsp;</td>
                        <td><?=$Subject?>&nbsp;</td>
                        <!--<td><?=$options[$tarbiyatcard->selected_option];?>&nbsp;</td> -->
                        <td><?=$options[$tarbiyatcard->selected_option];?>&nbsp;</td>
					<?php $index++;  endforeach; endif; ?>
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

