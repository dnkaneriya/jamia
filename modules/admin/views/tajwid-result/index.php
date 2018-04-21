<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use app\models\Student;
use app\models\TajwidClass;
use app\models\TajwidSubject;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::$app->params['apptitle'] . ' : Tajwid Class List';
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
//function for change pagination 
    function dopagination(record)
    {
        if (record != '') {
            $.ajax({
                type: "GET",
                url: "page",
                data: {size: record}, // multiple data sent using ajax
                success: function (result) {
                    $.pjax.reload({container: '#w0-pjax', timeout: 2000});
                }
            });
        }
    }
    $('body').on('click', '.reload', function () {
        $.pjax.reload({container: '#w0-pjax'});
    });
    /*
     *for change status active/deactive
     */
    function state(id, field, action)
    {
        var id1 = id;
        var val1 = field;
        $.ajax({
            type: "GET",
            url: "active",
            data: {id: id1, val: val1}, // multiple data sent using ajax
            success: function (result) {
                alert('Class is successfully updated.');
                $.pjax.reload({container: '#w0-pjax', timeout: 2000});
            }
        });
    }

    $('body').on('click', 'input[type="checkbox"]', function () {
        if ($(this).hasClass('select-on-check-all')) {
            //console.log(2);
            if ($(this).is(":checked")) {
                $('input[type="checkbox"]').each(function () {
                    $(this).closest('span').addClass('checked');
                });
            } else {
                $('input[type="checkbox"]').each(function () {
                    $(this).closest('span').removeClass('checked');
                });
            }
        } else {
            var chkcount = 0;
            var totalcount = 0;
            $('input[type="checkbox"]').each(function () {
                totalcount++;
                if ($(this).attr("class") != "select-on-check-all") {
                    if ($(this).is(":checked"))
                        chkcount++;
                }
            });
            if (totalcount - 1 == chkcount) {
                $('.select-on-check-all').closest('th').find('div span').addClass('checked');
                $('.select-on-check-all').prop('checked', true);
            } else {
                $('.select-on-check-all').closest('th').find('div span').removeClass('checked');
                $('.select-on-check-all').prop('checked', false);
            }
        }
    });

    /*function for activate,deactivate,delete all the selected recoreds*/
    function submitForm()
    {
        var strvalue = "";
        $('input[name="selection[]"]:checked').each(function () {
            if (strvalue != "")
                strvalue = strvalue + "," + this.value;
            else
                strvalue = this.value;
        });

        if (strvalue != "") {
            document.getElementById('delete').href = '<?php echo Yii::$app->request->baseUrl; ?>/admin/complaint/change?str=' + strvalue + '&&field=is_deleted&&val=Y';
        } else {
            document.getElementById('delete').href = 'javascript:void(0);';
        }
    }
//for delete signle job
    function del(id, field)
    {
        var a = confirm("Are you sure want to delete this data?");
        if (a) {
            var id1 = id;
            var field1 = field;
            $.ajax({type: "GET",
                url: "delete",
                data: {id: id1, field: field1},
                success: function (result) {
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
        if (!$('.grid-view .table input[type="checkbox"]').parent().hasClass("md-check"))
        {
            $('.grid-view .table input[type="checkbox"]').wrap('<label class="md-check"></label>');
            $('.grid-view .table input[type="checkbox"]').after('<i class="blue"></i>');
        }
    }
    $(function ()
    {
        reloadcheckbox();
    });
    $(document).ajaxComplete(function () {
        reloadcheckbox();
    });
    
function upgrade_tajwid()
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
                <h3>Tajwid Class</h3>
            </div>
            <div class="row p-a">
                <div class="col-sm-3">
                    <?php
                    $opt1 = Yii::$app->common->paginationarray();
                    $size = \Yii::$app->session->get('user.size');
                    if (isset($size) && $size != null)
                        $searchModel->id = \Yii::$app->session->get('user.size');
                    else
                        $searchModel->id = 5;
                    echo Html::activeDropDownList($searchModel, 'id', $opt1, array('class' => 'input-sm form-control w-sm inline v-middle', 'onchange' => 'dopagination(this.value);', 'value' => 5, 'label' => false, 'div' => false)
                    );
                    ?>
                </div>
                
                <div class="col-sm-9 text-right">
                   

                <a href="javascript:void(0);" class="btn btn-fw primary" onclick="upgrade_tajwid();" id="assign_standard">Upgrade</a>
                </div>
            </div>
            <?php \yii\widgets\Pjax::begin(['linkSelector' => '', 'id' => 'w0-pjax']); ?>	
            <?php
            $layout = '<div class="btn-group pull-right">{toolbar}</div><div class="clearfix"></div>{items}<div class="text-right">{pager}</div>';
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'showPageSummary' => false,
                'summary' => false,
                'pjax' => true,
                //'export' => ['fontAwesome'=>true],
                'toolbar' => [
                //'{export}',
                ],
                'tableOptions' => ['class' => 'table table-striped b-t'],
                //'exportConfig' => $defaultExportConfig,
                'layout' => $layout,
                'captionOptions' => ['title' => 'Complaint List'],
                'columns' => [
                    [
                            'class' => '\kartik\grid\CheckboxColumn',
                            'width'=>'5%',
                    ],
                    [
                        'width' => '20%',
                        'attribute' => 'class_id',
                        'vAlign' => 'middle',
                        'class' => '\kartik\grid\DataColumn',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'pageSummary' => false,
                        'filter' => $tajwidClassList,
                        'value' => function($model) {
                            $className = TajwidClass::find()->where(['id' => $model->class_id])->one();
                            if ($className) {
                                return $className->class_name;
                            } else {
                                return '';
                            }
                        }
                    ],
                    [
                        'width' => '20%',
                        'attribute' => 'student_id',
                        'vAlign' => 'middle',
                        'class' => '\kartik\grid\DataColumn',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'pageSummary' => false,
                        'label' => 'Student Name',
//                        'filter' => $studentList,
                        'value' => function($model) {
                            $student = Student::find()->where(['id' => $model->student_id])->one();
                            if ($student) {
                                return $student->surname_en . " " . $student->firstname_en . " " . $student->lastname_en;
                            } else {
                                return '';
                            }
                        }
                    ],
                    
                    [
                        'width' => '20%',
                        'attribute' => 'result',
                        'vAlign' => 'middle',
                        'class' => '\kartik\grid\DataColumn',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'pageSummary' => false,
                        'format' => 'raw',
                        'value' => function($model) {                        
                            if ($model->result == 'F') {
                                return '<label class="label label-danger" style="background:red">Fail</label>';
                            } else {
                                return '<label class="label label-success" style="background:green">Pass</label>';
                            }
                        }
                    ],            
                    [
                        'class' => '\kartik\grid\ActionColumn',
                        'contentOptions' => ['style' => ''],
                        'headerOptions' => ['style' => 'text-align:center'],
                        'template' => '{delete}', //{view}&nbsp;
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<button class="btn btn-info ajaxupdate" style="padding:5px 10px;"><i class="fa fa-eye"></i></button>', $url, [
                                            'title' => Yii::t('app', 'Profile'), 'data-pjax' => true
                                ]);
                            },
                                    
                                    'delete' => function ($url, $model) {
                                return '<button class="btn btn-danger delete" id="' . $model->id . '" field="Y" onclick="del(' . $model->id . ',\'Y\'' . ')" style="padding:5px 10px;"><i class="fa fa-trash-o"></i></button>';
                            }
                                ],
                                'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'view') {
                                $url = Yii::$app->request->baseUrl . '/admin/tajwid-result/view?id=' . $model->id;
                                return $url;
                            }
                            if ($action === 'update') {
                                $url = Yii::$app->request->baseUrl . '/admin/tajwid-result/update?id=' . $model->id;
                                return $url;
                            }
                            if ($action === 'delete') {
                                $url = 'delete?id=' . $model->id;
                                return $url;
                            }
                        }
                            ],
                        ],
                    ]);
                    ?>
                    <?php \yii\widgets\Pjax::end(); ?>
        </div>
    </div>
</div>