<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Student;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Guestsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Student Request');
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
//function for change pagination 
function dopagination(record)
{
    if(record != ''){
        $.ajax({
            type:"GET",
            url:"page",
            data:{size:record},    // multiple data sent using ajax
            success: function (result) {
                $.pjax.reload({container: '#w0-pjax', timeout: 2000});
            }
        });
    }
}
$('body').on('click','.reload',function(){
    $.pjax.reload({container: '#w0-pjax'});
});

$('body').on('click','input[type="checkbox"]',function(){
    if($(this).hasClass('select-on-check-all')){
        //console.log(2);
        if ($(this).is(":checked")) {
            $('input[type="checkbox"]').each(function(){
                $(this).closest('span').addClass('checked');
            });
        }else{
            $('input[type="checkbox"]').each(function(){
                $(this).closest('span').removeClass('checked');
            });
        }
    }else{
        var chkcount = 0;
        var totalcount = 0;
        $('input[type="checkbox"]').each(function(){
            totalcount++;
            if($(this).attr("class") != "select-on-check-all"){
                if($(this).is(":checked"))
                chkcount ++;
            }
        });
        if (totalcount-1==chkcount) {
            $('.select-on-check-all').closest('th').find('div span').addClass('checked');
            $('.select-on-check-all').prop('checked', true);
        }else{
            $('.select-on-check-all').closest('th').find('div span').removeClass('checked');
            $('.select-on-check-all').prop('checked', false);
        }
    }
});

function chagen_status(newstatus)
{
    var strvalue = "";
    $('input[name="selection[]"]:checked').each(function() {
        if(strvalue!="")
            strvalue = strvalue + ","+this.value;
        else
            strvalue = this.value;    
    });
   
    if(strvalue == "")
	{
		alert('Please select atleast one record');
		return false;
	}
   
    if(strvalue!=""){
       $.ajax({
        type:"GET",
        url:"approverequest",
        data:{str:strvalue, newstatus: newstatus},    // multiple data sent using ajax
        success: function (result) {
            $.pjax.reload({container: '#w0-pjax', timeout: 2000});
        }
   		 });
    }
}

//for delete signle job
function del(id,field)
{
    var a = confirm("Are you sure want to delete this data?");
    if(a){
        var id1 = id;
        var field1 =field;
        $.ajax({type: "GET",
            url: "delete",
            data: { id: id1,field :field1},
            success:function(result){
                $.pjax.reload({container: '#w0-pjax', timeout: 2000});
                //setTimeout(function(){
                //        reloadcheckbox();
                //},2001);
            }
        });
    }
}
function reloadcheckbox()
{
	if(!$('.grid-view .table input[type="checkbox"]').parent().hasClass("md-check"))
	{
		$('.grid-view .table input[type="checkbox"]').wrap('<label class="md-check"></label>');
		$('.grid-view .table input[type="checkbox"]').after('<i class="blue"></i>');
	}
}
$(function()
{
	reloadcheckbox();
});
$(document).ajaxComplete(function() {
    reloadcheckbox();
});

</script>
<div ui-view class="app-body" id="view">
	<div class="padding">
		<?php
			echo Yii::$app->getSession()->getFlash('flash_msg');
		?>
		<div class="box">
			<div class="box-header">
			  <h3>Student Request List</h3>
			</div>
			<div class="row p-a">
			  <div class="col-sm-5">
				<?php
					$opt1 = Yii::$app->common->paginationarray();
					$size=\Yii::$app->session->get('user.size');
					if(isset($size) && $size!=null)
					$searchModel->id=\Yii::$app->session->get('user.size');
					else
					$searchModel->id=5;
					echo Html::activeDropDownList($searchModel, 'id',$opt1,
						array('class'=>'input-sm form-control w-sm inline v-middle','onchange'=>'dopagination(this.value);','value'=>5,'label'=>false,'div'=>false)
					);
				?>
				&nbsp&nbsp
				<?php //echo Html::a(Yii::t('app', 'Delete All').'<i class="icon-trash"></i>',"javascript:void(0);",["class"=>"btn btn-fw danger",'data-placement'=>'bottom','title'=>'Delete All', "id" => "delete", "escape" => false, "onclick" => "submitForm();if(this.href=='javascript:void(0);') { alert('Please Select At least One Record');} else { if(!confirm('Are you sure to delete these records?')) return false;}"]); ?>&nbsp&nbsp
				<!--<button class="btn btn-sm white">Apply</button>                -->
			  </div>
			  
			  <div class="col-sm-7 text-right">
                              <a href="javascript:void(0);" class="btn btn-fw primary" onclick="chagen_status('Approve');" id="assign_tajwidclass">Approve</a>
                              <a href="javascript:void(0);" class="btn btn-fw primary" onclick="chagen_status('Disapprove');" id="assign_tajwidclass">DisApprove</a>
				<a href="<?=Yii::$app->request->baseurl?>/admin/student-request/create" id="job-export" class="btn btn-fw primary" title="Create a class"><i class="fa fa-plus"></i> Add New</a> 
			  </div>
			</div>
            <?php \yii\widgets\Pjax::begin(['linkSelector'=>'','id'=>'w0-pjax']); ?>	
			<?php $layout = '<div class="btn-group pull-right">{toolbar}</div><div class="clearfix"></div>{items}<div class="text-right">{pager}</div>';
					echo  GridView::widget([
					'dataProvider' => $dataProvider,
					'filterModel' => $searchModel,
					'showPageSummary' => false,
					'summary' => false,
					'pjax'=>true,
					//'export' => ['fontAwesome'=>true],
					'toolbar'=>[
						//'{export}',
					],
					'tableOptions' => ['class' => 'table table-striped b-t'],
					//'exportConfig' => $defaultExportConfig,
					'layout' => $layout,
					'captionOptions'=>['title'=>'Student Request List'],
					'columns' => [
                        [
                            'class' => '\kartik\grid\CheckboxColumn',
                            'width'=>'5%',
                        ],
                        [
                            'width'=>'20%',
                            'attribute'=>'student_id',
                            'vAlign'=>'middle',
                            'class' => '\kartik\grid\DataColumn',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'pageSummary' => false,
                            'filter'=>true,
                            'label' => 'GR No.',
                            'filter' => $studentList,
                            'value' => function($model) {
                                 $student = Student::findOne(['id' => $model->student_id]);
                                 return isset($student['grno']) ? $student['grno'] : '-';
                            }
                            //'mergeHeader'=>true,
                        ],
			[
                            'width'=>'20%',
                            'attribute'=>'request',
                            'vAlign'=>'middle',
                            'class' => '\kartik\grid\DataColumn',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'pageSummary' => false,
                            'filter'=>true,
                            //'mergeHeader'=>true,
                        ],		
                        [
                            //'width'=>'9%',
                            'width'=>'10%',
                            'attribute'=>'date',
                            'vAlign'=>'middle',
                            'class' => '\kartik\grid\DataColumn',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'pageSummary' => false,
                            //'filter'=>false,
                            //'mergeHeader'=>true,
                            'label'=>'Date',
                            'filterType' => GridView::FILTER_DATE,
                            'filterWidgetOptions' => [
                                'pluginOptions' => [
                                    'format' => 'dd-mm-yyyy',
                                    'autoclose' => true,
                                    'todayHighlight' => true,
                                ]
                            ],
                            'value'=>function($model){
                                return date('d-m-Y', $model->date);
                            }
                        ],
                        [
                            'width'=>'20%',
                            'attribute'=>'status',
                            'vAlign'=>'middle',
                            'class' => '\kartik\grid\DataColumn',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'pageSummary' => false,
                            'filter'=>true,
                            'format' => 'raw',
                            'value' => function($model) {
                                if($model->status=='Approve') {
                                    return "<label class='label label-succes' style='background:green'>". $model->status ."</label>";
                                } else if($model->status == "Disapprove") {
                                    return "<label class='label label-danger' style='background:red'>". $model->status ."</label>";
                            } else {
                                return "<label class='label label-orange' style='background:yellow'>". $model->status ."</label>";
                            }
                            }
                            //'mergeHeader'=>true,
                        ],        
                        [
							'width'=>'10%',
                            'class' => '\kartik\grid\ActionColumn',
                            'contentOptions' => ['style' => ''],
                            'headerOptions' => ['style' => 'text-align:center'],
                            'template' => '{update}&nbsp;{delete}', //{view}&nbsp;
                            'buttons' => [
                                'view' => function ($url, $model){
                                    return Html::a('<button class="btn btn-info ajaxupdate" style="padding:5px 10px;"><i class="fa fa-eye"></i></button>', $url, [
                                        'title' => Yii::t('app', 'Profile'),'data-pjax' => true
                                    ]);
                                },
                                'update' => function ($url, $model){
                                    return Html::a('<button class="btn btn-primary ajaxupdate" style="padding:5px 10px;"><i class="fa fa-pencil"></i></button>', $url, [
                                    'title' => Yii::t('app', 'update'),'data-pjax' => true
                                    ]);
                                },
                                'delete' => function ($url, $model){
                                    return '<button class="btn btn-danger delete" id="'.$model->id.'" field="Y" onclick="del('.$model->id.',\'Y\''.')" style="padding:5px 10px;"><i class="fa fa-trash-o"></i></button>';
                                }
							],
							'urlCreator' => function ($action, $model, $key, $index) {
                                if ($action === 'view') {
                                        $url =Yii::$app->request->baseUrl.'/admin/student-request/view?id='.$model->id;
                                        return $url;
                                }
                                if ($action === 'update') {
                                        $url = Yii::$app->request->baseUrl.'/admin/student-request/update?id='.$model->id;
                                        return $url;
                                }
                                if ($action === 'delete') {
                                        $url ='delete?id='.$model->id;
                                        return $url;
                                }
							}
						],
					],
				]); ?>
			<?php \yii\widgets\Pjax::end(); ?>
		</div>
	</div>
</div>