<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use yii\helpers\ArrayHelper;

use app\models\Category;
use app\models\Classes;
use app\models\Subclass;
use app\models\Division;
use app\models\Student;
use app\models\ExamMaster;


/* @var $this yii\web\View */
/* @var $searchModel app\models\Guestsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Result List');
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
            alert('Staff List is successfully updated.');
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
        document.getElementById('delete').href = '<?php echo Yii::$app->request->baseUrl;?>/admin/staff/change?str='+strvalue+'&&field=is_deleted&&val=Y';
    }else{
        //document.getElementById('deactive').href = 'javascript:void(0);';
        document.getElementById('delete').href = 'javascript:void(0);';
        //document.getElementById('active').href = 'javascript:void(0);';
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
function upgrade_class()
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
        //alert(strvalue);
    if(strvalue!=""){
       $.ajax({
        type:"POST",
        url:"upgrade-student",
        data:{'str':strvalue},    // multiple data sent using ajax
        success: function (result) {
            $.pjax.reload({container: '#w0-pjax', timeout: 2000});
        }
        });
    }
}
</script>
<div ui-view class="app-body" id="view">
    <div class="padding">
        <?php
            echo Yii::$app->getSession()->getFlash('flash_msg');
        ?>
        <div class="box">
            <div class="box-header">
              <h3>Result List</h3>
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
              <div class="col-sm-4">
              </div>
              <div class="col-sm-3 text-right">
                  <a href="javascript:void(0);" class="btn btn-fw primary" onclick="upgrade_class();" id="assign_standard">Upgrade</a>
                <?php /*
                <a href="<?=Yii::$app->request->baseurl?>/admin/result-master/create" id="job-export" class="btn btn-fw primary" title="Add Result"><i class="fa fa-plus"></i> Add New</a> 
                */ ?>
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
                    'captionOptions'=>['title'=>'Staff List'],
                    'columns' => [
                        [
                            'class' => '\kartik\grid\CheckboxColumn',
                            'width'=>'5%',
                        ],
                        [
                            'width'=>'10%',
                            'attribute'=>'exam_id',
                            'vAlign'=>'middle',
                            'class' => '\kartik\grid\DataColumn',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'pageSummary' => false,
                            'filter'=>$examList,
                            'label' => 'Exam',
                            //'mergeHeader'=>true,
                            'value'=>function($model){
                                $exam =  ExamMaster::find()->where(['id'=>$model->exam_id])->one();
                                $exam_name = '';
                                if(!empty($exam) && count($exam) > 0) {
                                    $exam_name = $exam->name;
                                }
                                return $exam_name;
                            }
                        ],
                                [
                            'width'=>'10%',
                            'attribute'=>'year',
                            'vAlign'=>'middle',
                            'class' => '\kartik\grid\DataColumn',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'pageSummary' => false,
                            'filter'=>$classList,
                            'label' => 'Year',
                            //'mergeHeader'=>true,
                        ],
                        [
                            'width'=>'10%',
                            'attribute'=>'class_id',
                            'vAlign'=>'middle',
                            'class' => '\kartik\grid\DataColumn',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'pageSummary' => false,
                            'filter'=>$classList,
                            'label' => 'Class',
                            //'mergeHeader'=>true,
                            'value'=>function($model){
                                return Classes::find()->where(['id'=>$model->class_id])->one()->name;
                            }
                        ],
                        [
                            'width'=>'10%',
                            'attribute'=>'subclass_id',
                            'vAlign'=>'middle',
                            'class' => '\kartik\grid\DataColumn',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'pageSummary' => false,
                            'filter'=>$subclassList,
                            'label' => 'Subclass',
                            //'mergeHeader'=>true,
                            'value'=>function($model){
                                return Subclass::find()->where(['id'=>$model->subclass_id])->one()->sub_class;
                            }
                        ],
                        [
                            'width'=>'10%',
                            'attribute'=>'division_id',
                            'vAlign'=>'middle',
                            'class' => '\kartik\grid\DataColumn',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'pageSummary' => false,
                            'filter'=>$divisionList,
                            //'mergeHeader'=>true,
                            'value'=>function($model){
                                return Division::find()->where(['id'=>$model->division_id])->one()->division;
                            }
                        ],
                        [
                            'width'=>'10%',
                            'attribute'=>'student_id',
                            'vAlign'=>'middle',
                            'class' => '\kartik\grid\DataColumn',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'pageSummary' => false,
                            'filter'=>$studentList,
                            'label' => 'GrNo.',
                            //'mergeHeader'=>true,
                            'value'=>function($model){
                                return Student::find()->where(['id'=>$model->student_id])->one()->grno;
                            }
                        ],
                        [
                            'width'=>'10%',
                            'attribute'=>'result',
                            'vAlign'=>'middle',
                            'class' => '\kartik\grid\DataColumn',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'pageSummary' => false,
                            'filter'=>true,
                            'format'=>'raw',
                            //'mergeHeader'=>true,
                            'value' => function($model) {
                                $res = "<span class='label label-success' style='background:green'>Pass</span>";
                                if($model->result == 'F') {
                                    $res = "<span class='label label-danger' style='background:red'>Fail</span>";
                                }

                                return $res;
                            }
                        ],
                        [
                            'width'=>'10%',
                            'class' => '\kartik\grid\ActionColumn',
                            'contentOptions' => ['style' => ''],
                            'headerOptions' => ['style' => 'text-align:center'],
                            'template' => '{view}&nbsp;{delete}', //{view}&nbsp;
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
                                        $url =Yii::$app->request->baseUrl.'/admin/result-master/view?id='.$model->id;
                                        return $url;
                                }
                                if ($action === 'update') {
                                        $url = Yii::$app->request->baseUrl.'/admin/result-master/update?id='.$model->id;
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