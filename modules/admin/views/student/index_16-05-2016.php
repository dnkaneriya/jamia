<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\grid\GridView;

use app\models\Classes;
use app\models\Subclass;
use app\models\Division;
use app\models\Student;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::$app->params['apptitle'].' : Selected Student List';
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
/*
 *for change status active/deactive
*/    
function state(id,field,action)
{
    var id1= id;
    var val1 = field;
    $.ajax({
        type:"GET",
        url:"active",
        data:{id:id1,val:val1},    // multiple data sent using ajax
        success: function (result) {
            alert('Class is successfully updated.');
            $.pjax.reload({container: '#w0-pjax', timeout: 2000});
        }
    });
}

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

/*function for activate,deactivate,delete all the selected recoreds*/
function submitForm()
{
    var strvalue = "";
    $('input[name="selection[]"]:checked').each(function() {
        if(strvalue!="")
            strvalue = strvalue + ","+this.value;
        else
            strvalue = this.value;    
    });
    
    if(strvalue!=""){
        //document.getElementById('deactive').href = '<?php echo Yii::$app->request->baseUrl;?>/job/change?str='+strvalue+'&&field=is_active&&val=N';
        //document.getElementById('active').href = '<?php echo Yii::$app->request->baseUrl;?>/job/change?str='+strvalue+'&&field=is_active&&val=Y';
        document.getElementById('delete').href = '<?php echo Yii::$app->request->baseUrl;?>/admin/student/change?str='+strvalue+'&&field=is_deleted&&val=Y';
    }else{
        //document.getElementById('deactive').href = 'javascript:void(0);';
        document.getElementById('delete').href = 'javascript:void(0);';
        //document.getElementById('active').href = 'javascript:void(0);';
    }
}

function assign_gr()
{
    var strvalue = "";
    $('input[name="selection[]"]:checked').each(function() {
        if(strvalue!="")
            strvalue = strvalue + ","+this.value;
        else
            strvalue = this.value;    
    });
    
    var series = document.getElementById('series_value').value;
    if(strvalue == "")
	{
		alert('Please select atleast one record');
		return false;
	}
    if(series == "")
	{
		alert('Please enter series number');
		return false;
	}

    if(strvalue!="" && series!=""){
        document.getElementById('student_select').href = '<?php echo Yii::$app->request->baseUrl;?>/admin/student/allocategr?str='+strvalue+'&&series='+series;
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
			  <h3>Selected Student List</h3>
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
			  <div class="col-sm-2">
                
			  </div>
			  <div class="col-sm-5 text-right">
                <input type="number" min="0" class="gr_assign" name="series" id="series_value" placeholder="Series Number">
                <a href="javascript:void(0);" class="btn btn-fw primary" onclick="assign_gr();" id="student_select">Confirm and give GR No.</a>
				<!--<a href="<?=Yii::$app->request->baseurl?>/admin/student/create" id="job-export" class="btn btn-fw primary" title="Create a class"><i class="fa fa-plus"></i> Add New</a>-->
			  </div>
			</div>
            <?php
                $states = Yii::$app->params['indian_all_states'];
                $stateList = ArrayHelper::map(Student::find()->where(['is_deleted'=>'N'])->all(), 'state', 'state');
                foreach($stateList as $key=>$value){
                    $stateFilter[$key] = $states[$value];
                }
                $regDateList = ArrayHelper::map(Student::find()->where(['is_deleted'=>'N'])->all(), 'i_date', 'i_date');
                foreach($regDateList as $key=>$value){
                    $dateFilter[$key] = date('d M Y', $value);
                }
                //echo "<pre>";print_r($dateFilter);
            ?>
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
					'captionOptions'=>['title'=>'Student List'],
					'columns' => [
						[
                            'class' => '\kartik\grid\CheckboxColumn',
                            'width'=>'5%',
						],
                        [
                            'width'=>'10%',
                            'attribute'=>'image',
                            'vAlign'=>'middle',
                            'class' => '\kartik\grid\DataColumn',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'pageSummary' => false,
                            'filter'=>false,
                            'format'=>'raw',
                            //'mergeHeader'=>true,
                            'value'=>function($model){
                                if(isset($model->image) && $model->image != null){
                                    return '<img src="'.Url::to('@web/'.$model->image).'" width="100" height="100"/>';
                                }else{
                                    return '';
                                }
                            }
                        ],
                        [
                            'width'=>'17%',
                            'attribute'=>'firstname_en',
                            'vAlign'=>'middle',
                            'class' => '\kartik\grid\DataColumn',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'pageSummary' => false,
                            'filter'=>true,
                            'label'=>'Name (English)',
                            //'mergeHeader'=>true,
							'value'=>function($model){
                                $name='';
								if($model->surname_en != '')
									$name .=$model->surname_en.' ';
								if($model->firstname_en != '')
									$name .=$model->firstname_en.' ';
								if($model->lastname_en != '')
									$name .=$model->lastname_en.' ';		
								
								return $name;
                            }
                        ],
                        [
                            'width'=>'7%',
                            'attribute'=>'state',
                            'vAlign'=>'middle',
                            'class' => '\kartik\grid\DataColumn',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'pageSummary' => false,
                            'filter'=>$stateFilter,
                            //'mergeHeader'=>true,
                            'value'=>function($model){
                                $states = Yii::$app->params['indian_all_states'];
                                //echo "<pre>";print_r($states);
                                if(isset($model->state) && $model->state != null){
                                    return $states[$model->state];
                                }else{
                                    return '';
                                }
                            }
                        ],
                        [
                            'width'=>'7%',
                            'attribute'=>'district',
                            'vAlign'=>'middle',
                            'class' => '\kartik\grid\DataColumn',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'pageSummary' => false,
                            'filter'=>true,
                            //'mergeHeader'=>true,
                        ],
                        [
                            'width'=>'9%',
                            'attribute'=>'dob',
                            'vAlign'=>'middle',
                            'class' => '\kartik\grid\DataColumn',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'pageSummary' => false,
                            'filter'=>false,
                            //'mergeHeader'=>true,
                            'label'=>'Date Of Birth',
                            'value'=>function($model){
                                return date('d M Y', $model->dob);
                            }
                        ],
                        [
                            'width'=>'1%',
                            'attribute'=>'register_status',
                            'vAlign'=>'middle',
                            'class' => '\kartik\grid\DataColumn',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'pageSummary' => false,
                            'filter'=>false,
                            //'mergeHeader'=>true,
                            'label'=>'Status',
                            'value'=>function($model){
                                if($model->register_status == 'N'){
                                    return 'New';
                                }else{
                                    return 'Old';
                                }
                            }
                        ],
                        [
                            'width'=>'9%',
                            'attribute'=>'i_date',
                            'vAlign'=>'middle',
                            'class' => '\kartik\grid\DataColumn',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'pageSummary' => false,
                            'filterType' => GridView::FILTER_DATE,
                            'filterWidgetOptions' => [
                                'pluginOptions' => [
                                    'format' => 'dd-mm-yyyy',
                                    'autoclose' => true,
                                    'todayHighlight' => true,
                                ]
                            ],
                            //'mergeHeader'=>true,
							'label'=>'Registration Date',
                            'value'=>function($model){
                                return date('d M Y', $model->i_date);
                            }
                        ],
						/*[
                            'options'=>['class'=>'skip-export'], 
                            'attribute' => 'is_active',
                            'width'=>'5%',
                            'label'=>'Status',
                            'contentOptions' => ['style' => 'text-align:center'],
                            'headerOptions' => ['style' => 'text-align:center'],
                            'format' => 'raw',
                            'filter'=>['Y'=>Yii::t('app', 'Yes'),'N'=>Yii::t('app', 'No')],
                            'value' => function($data)
                            {
                                if($data->is_active=="Y")
                                    $btn='<button class="btn btn-success" id="'.$data->id.'" field="N" onclick="state('.$data->id.',\'N\''.')" style="padding:5px 10px;"><i class="fa fa-check"></i></button>';
                                else if($data->is_active=="N")
                                    $btn='<button class="btn btn-danger" id="'.$data->id.'" field="Y" onclick="state('.$data->id.',\'Y\''.')" style="padding:5px 10px;"><i class="fa fa-times icon-white"></i></button>';
                                return $btn;
                            },
                        ],*/
						[
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
                                        $url =Yii::$app->request->baseUrl.'/admin/student/view?id='.$model->id;
                                        return $url;
                                }
                                if ($action === 'update') {
                                        $url = Yii::$app->request->baseUrl.'/admin/student/update?id='.$model->id;
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