<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use app\models\Student;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::$app->params['apptitle'] . ' : Students Quran Data';
$this->params['breadcrumbs'][] = $this->title;

$year = array();
for ($i = 1430; $i <= 1600; $i++)
    $year[$i] = $i;

$studentList = ArrayHelper::map(Student::find()->where(['is_deleted' => 'N', 'is_selected' => 'C'])->all(), 'id', 'grno');
$options = array('C' => 'Class', 'H' => 'Hostel', 'B' => 'Both');
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
            document.getElementById('delete').href = '<?php echo Yii::$app->request->baseUrl; ?>/admin/attendance/change?str=' + strvalue + '&&field=is_deleted&&val=Y';
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

</script>
<div ui-view class="app-body" id="view">
    <div class="padding">
        <?php
        echo Yii::$app->getSession()->getFlash('flash_msg');
        ?>
        <div class="box">
            <div class="box-header">
                <h3>Student's Attendance Data</h3>
            </div>
            <div class="row p-a">
                <div class="col-sm-5">
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
                    &nbsp&nbsp
                    <?php //echo Html::a(Yii::t('app', 'Delete All').'<i class="icon-trash"></i>',"javascript:void(0);",["class"=>"btn btn-fw danger",'data-placement'=>'bottom','title'=>'Delete All', "id" => "delete", "escape" => false, "onclick" => "submitForm();if(this.href=='javascript:void(0);') { alert('Please Select At least One Record');} else { if(!confirm('Are you sure to delete these records?')) return false;}"]); ?>&nbsp&nbsp
                    <!--<button class="btn btn-sm white">Apply</button>                -->
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3 text-right">
                    <a href="<?= Yii::$app->request->baseurl ?>/admin/attendance/create" id="job-export" class="btn btn-fw primary" title="Create a class"><i class="fa fa-plus"></i> Add New</a>
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
                'captionOptions' => ['title' => 'Student Attendace Data'],
                'columns' => [
                        [
                        'class' => '\kartik\grid\SerialColumn',
                        'width' => '5%',
                    ],
                        [
                        'width' => '25',
                        'attribute' => 'grno',
                        'vAlign' => 'middle',
                        'class' => '\kartik\grid\DataColumn',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'pageSummary' => false,
                        'filter' => $studentList,
                        'label' => 'Student GrNo'
                        
                        
                    ],
                    /* [
                      'width'=>'10%',
                      'attribute'=>'day',
                      'vAlign'=>'middle',
                      'class' => '\kartik\grid\DataColumn',
                      'headerOptions' => ['style' => 'text-align:center'],
                      'pageSummary' => false,
                      'filter'=>$year,
                      'label'=>'Date',
                      'value'=>function($model){
                      return $model->day!=''?$model->day:'';
                      }
                      ], */
                        [
                        'width' => '10%',
                        'attribute' => 't_year',
                        'vAlign' => 'middle',
                        'class' => '\kartik\grid\DataColumn',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'pageSummary' => false,
                        'filter' => $year,
                        'label' => 'Year',
                        'value' => function($model) {
                            return $model->t_year != '' ? $model->t_year : '';
                        }
                    ],
                        [
                        'width' => '20%',
                        'attribute' => 't_month',
                        'vAlign' => 'middle',
                        'class' => '\kartik\grid\DataColumn',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'pageSummary' => false,
                        'filter' => Yii::$app->params['islamic_month_en'],
                        'label' => 'Month',
                        'value' => function($model) {
                            $month = Yii::$app->params['islamic_month_en'];
                            return isset($model->t_month) ? $month[$model->t_month] : '';
                        }
                    ],
                    [
                        'width' => '20%',
                        'attribute' => 'day',
                        'vAlign' => 'middle',
                        'class' => '\kartik\grid\DataColumn',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'pageSummary' => false,
                        //'filter' => Yii::$app->params['islamic_month_en'],
                        'label' => 'Day',
                        
                    ],
                    [
                        'width' => '20%',
                        'attribute' => 'hostel',
                        'vAlign' => 'middle',
                        'class' => '\kartik\grid\DataColumn',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'pageSummary' => false,
                        //'filter' => Yii::$app->params['islamic_month_en'],
                        'label' => 'Hostel',
                        'value'=>function($model){
                            return $model->hostel=='A'?'Absent':'Present';
                        }
                    ],
                    [
                        'width' => '20%',
                        'attribute' => 'class',
                        'vAlign' => 'middle',
                        'class' => '\kartik\grid\DataColumn',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'pageSummary' => false,
                        //'filter' => Yii::$app->params['islamic_month_en'],
                        'label' => 'Class',
                        'value'=>function($model){
                            return $model->class=='A'?'Absent':'Present';
                        }
                    ],
                    /* [
                      'width'=>'10%',
                      'attribute'=>'absent',
                      'vAlign'=>'middle',
                      'class' => '\kartik\grid\DataColumn',
                      'headerOptions' => ['style' => 'text-align:center'],
                      'pageSummary' => false,
                      'filter'=>['Y'=>'Yes','N'=>'No'],
                      //'mergeHeader'=>true,
                      'value'=>function($model){
                      return $model->absent=='Y'?'Yes':'No';
                      }
                      ],
                      [
                      'width'=>'10%',
                      'attribute'=>'option',
                      'vAlign'=>'middle',
                      'class' => '\kartik\grid\DataColumn',
                      'headerOptions' => ['style' => 'text-align:center'],
                      'pageSummary' => false,
                      'filter'=>$options,
                      //'mergeHeader'=>true,
                      'value'=>function($model) use($options){
                      return (isset($model->option) && $model->option!='')?$options[$model->option]:'';
                      }
                      ], */
                        [
                        'width' => '15%',
                        'class' => '\kartik\grid\ActionColumn',
                        'contentOptions' => ['style' => ''],
                        'headerOptions' => ['style' => 'text-align:center'],
                        'template' => '{view}&nbsp;{update}&nbsp;{delete}', //{view}&nbsp;
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<button class="btn btn-info ajaxupdate" style="padding:5px 10px;"><i class="fa fa-eye"></i></button>', $url, [
                                            'title' => Yii::t('app', 'Profile'), 'data-pjax' => true
                                ]);
                            },
                            'update' => function ($url, $model) {
                                return Html::a('<button class="btn btn-primary ajaxupdate" style="padding:5px 10px;"><i class="fa fa-pencil"></i></button>', $url, [
                                            'title' => Yii::t('app', 'update'), 'data-pjax' => true
                                ]);
                            },
                            'delete' => function ($url, $model) {
                                return '<button class="btn btn-danger delete" id="' . $model->id . '" field="Y" onclick="del(' . $model->id . ',\'Y\'' . ')" style="padding:5px 10px;"><i class="fa fa-trash-o"></i></button>';
                            }
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'view') {
                                $url = Yii::$app->request->baseUrl . '/admin/attendance/view?id=' . $model->id;
                                return $url;
                            }
                            if ($action === 'update') {
                                $url = Yii::$app->request->baseUrl . '/admin/attendance/update?id=' . $model->id;
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