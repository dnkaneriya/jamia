<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Tarbiyatsubject;
use yii\helpers\ArrayHelper;

$this->title = Yii::$app->params['apptitle'].' : Tarbiyati Card';
$this->params['breadcrumbs'][] = $this->title;

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
    <h1>Tarbiyati Card <button type="button" onclick="printFunction()" class="btn green btn-success market-add " id="noprint">Print</button></h1>
       <?php $i=0; foreach($tarbiyatcard_arr as $tarbiyatcard){ ?>
       <?php if($i==0){ ?>
    	<div class="col-md-6">
        	<table border="0" width="100%">
            	<tr>
                	<th colspan="3" style="font-size:18px;"><?php $month=Yii::$app->params['islamic_month_en'];
                                    echo $month[$tarbiyatcard->t_month];
                                 ?></th>
<!--                    <th colspan="3"  style="text-align: right; font-size:18px;"><?php // $month=Yii::$app->params['islamic_month_ar'];
//                                    echo $month[$tarbiyatcard->t_month];
                                 ?></th>-->
                </tr>
                </table>
                <table border="1" width="100%" align="center">
            	<tr>
                	<th style="text-align:center">D</th>
                    <th style="text-align:center">C</th>
                    <th style="text-align:center">B</th>
                    <th style="text-align:center">A</th>
                    <th style="text-align:center">Aamal</th>
                </tr>
                <?php } ?>
                <tr>
				      <td  width="18%" <?php if($tarbiyatcard->selected_option=='D') echo 'class="active"'; ?>></td>         
				      <td  width="18%" <?php if($tarbiyatcard->selected_option=='C') echo 'class="active"'; ?>></td>         
				      <td width="18%" <?php if($tarbiyatcard->selected_option=='B') echo 'class="active"'; ?>></td>         
				      <td  width="18%"<?php if($tarbiyatcard->selected_option=='A') echo 'class="active"'; ?>></td>         
                      <td  style="text-align:center" width="28%"><?php $tSubject = Tarbiyatsubject::find()->where(['id'=>$tarbiyatcard->tarbiyat_subject_id])->one();
                                echo $tSubject!=array()?$tSubject->subject_en:''; ?></td>
                </tr>
                <?php $i+=1; if($i==$totalSub){ ?>
            </table>
        </div>
        <?php $i=0;} ?>
        <?php  } ?>

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