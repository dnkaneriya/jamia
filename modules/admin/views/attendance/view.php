<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Attendance;
use yii\helpers\ArrayHelper;

$this->title = Yii::$app->params['apptitle'].' : Attendance';
$this->params['breadcrumbs'][] = $this->title;
$month=Yii::$app->params['islamic_month_en'];
?>
<style>
@media print {
   .market-add {
      display: none;
   }

}
.active{
	background-color:#F00;	
}
</style>
<div ui-view class="app-body" id="view">

<div id="print">
	<div class="col-md-12">
    <h1><?php echo $month[$model->t_month]; ?>'s Attendance <!--<button type="button" onclick="printFunction()" class="btn green btn-success market-add " id="noprint">Print</button> --></h1>
    <table border="1" width="100%" align="center">
       <?php $count=1; for($i=1;$i<=30;$i++){
		   $attendance=Attendance::find()->where(['student_id'=>$model->student_id,'t_year'=>$model->t_year,'t_month'=>$model->t_month,'day'=>$i,'is_deleted'=>'N'])->one();
		   $active='';
		   
			if($attendance!=array())
				$active=$attendance->absent=='Y'?'class="active"':'';	
		    ?>
                
       <?php if($count==1){ ?>
                <tr>
        <?php } ?>
				      <td  width="10%" <?=$active?>><?=$i?></td>         
                
                <?php $count+=1; if($count==11){ ?>
                </tr>
            
        <?php $count=1;} ?>
        
        <?php  } ?>
		</table>
    </div>
    </div>
    
</div>

<script type="text/javascript">

function printFunction() {
    
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById("print").innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
   
    
}
</script>