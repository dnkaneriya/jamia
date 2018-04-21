<?php

use yii\helpers\Html;
$dash = $user = $admin = '';

$controller = strtolower(Yii::$app->controller->id);
$action = strtolower(Yii::$app->controller->action->id);
function openness($controller)
{
    if(strtolower(Yii::$app->controller->id) == $controller)
    {
        return 'open active';
    }
}

function activeness($action)
{
    if(strtolower(Yii::$app->controller->id) == $action[0])
    {
        if(strtolower(Yii::$app->controller->action->id) == $action[1])
        {
            return 'active';
        }
    }
}
?>

<div id="aside" class="app-aside modal fade nav-dropdown" ng-class="{'folded': app.setting.folded}">
    <!-- fluid app aside -->
    <div class="left navside dark dk" layout="column">
        <div class="navbar no-radius">
            <!-- brand -->
            <a href="<?php echo Yii::$app->request->baseUrl.'/site/index'?>" class="navbar-brand">
                <?= Html::img('@web/website/images/logo-fav.png',array("class"=>''));?>
                <span class="hidden-folded inline"><?php echo Yii::$app->params['apptitle']; ?></span>
            </a>
            <!-- / brand -->
        </div>
        <div flex class="hide-scroll">
            <nav class="scroll nav-light">
                <ul class="nav" ui-nav>
                    <li ui-sref-active="active">
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe871;</i></span><span class="nav-text">Dashboard</span>',["/admin/default/index"], ["class"=>openness('dashboard')]) ?>
                    </li>
                    <li class="<?=activeness(['classes', 'index'])?>">
                        <a>
                            <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                            <span class="nav-icon"><i class="material-icons">&#xe80c;</i></span>
                            <span class="nav-text">Classes</span>
                        </a>
                        <ul class="nav-sub">
                           <li class="<?=activeness(['classes', 'index'])?>">
                                <?= Html::a('<span class="nav-text">Class</span>',["/admin/classes/index"], ["class"=>"classes"]) ?>
                            </li>
                            <li class="<?=activeness(['subclass', 'index'])?>">
                                <?= Html::a('<span class="nav-text">Sub Class</span>',["/admin/subclass/index"], ["class"=>"classes"]) ?>
                            </li>
                            <li class="<?=activeness(['division', 'index'])?>">
                                <?= Html::a('<span class="nav-text">Division</span>',["/admin/division/index"], ["class"=>"classes"]) ?>
                            </li>

                        </ul>
                    </li>
                    <li class="<?=activeness(['classes', 'index'])?>">
                        <a>
                            <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                            <span class="nav-icon"><i class="material-icons">&#xe80c;</i></span>
                            <span class="nav-text">Tajwid</span>
                        </a>
                        <ul class="nav-sub">
                           <li class="<?=activeness(['classes', 'index'])?>">
                                <?= Html::a('<span class="nav-text">Tajwid Class</span>',["/admin/tajwid-class/index"], ["class"=>"classes"]) ?>
                            </li>
                            <li class="<?=activeness(['subclass', 'index'])?>">
                                <?= Html::a('<span class="nav-text">Tajwid Subject</span>',["/admin/tajwid-subject/index"], ["class"=>"classes"]) ?>
                            </li>
                            
                        </ul>
                    </li>
                    <?php /*
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe8d2;</i></span><span class="nav-text">Subject</span>',["/admin/subject/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li ui-sref-active="active">
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe7ef;</i></span><span class="nav-text">Students</span>',["/admin/student/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    */ ?>
                    <li>
                        <a>
                            <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                            <span class="nav-icon"><i class="material-icons">&#xe7f9;</i></span>
                            <span class="nav-text">CMS</span>                            
                        </a>
                        <ul class="nav-sub">
                            <li>
                                <?= Html::a('<span class="nav-text">CMS Pages</span>',["/admin/cms/index"], ["class"=>"nav-link"]) ?>
                            </li>
                            <li>
                                <?= Html::a('<span class="nav-text">Home Banners</span>',["/admin/homebanners/index"], ["class"=>"nav-link"]) ?>
                            </li>
                            <li>
                                <?= Html::a('<span class="nav-text">Contact Detail</span>',["/admin/contactdetail/update?id=1"], ["class"=>"nav-link"]) ?>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a>
                            <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                            <span class="nav-icon"><i class="material-icons">&#xe7ef;</i></span>
                            <span class="nav-text">Registration</span>                            
                        </a>
                        <ul class="nav-sub">
                            <li>
                                <?= Html::a('<span class="nav-text">Registered Students</span>',["/admin/student/pending"], ["class"=>"nav-link"]) ?>
                            </li>
                            <li>
                                <?= Html::a('<span class="nav-text">Selected Students</span>',["/admin/student/selected"], ["class"=>"nav-link"]) ?>
                            </li>
                            <li>
                                <?= Html::a('<span class="nav-text">Confirmed Students</span>',["/admin/student/confirm"], ["class"=>"nav-link"]) ?>
                            </li>
                        </ul>
                    </li>
                     <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe7ef;</i></span><span class="nav-text">Students</span>',["/admin/student/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe7ef;</i></span><span class="nav-text">Tarbiyat Card</span>',["/admin/tarbiyatcard/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe02f;</i></span><span class="nav-text">Complaint Register</span>',["/admin/complaint/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe02f;</i></span><span class="nav-text">Attendance</span>',["/admin/attendance/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe02f;</i></span><span class="nav-text">Qur\'an</span>',["/admin/quran/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe02f;</i></span><span class="nav-text">Exam</span>',["/admin/exam-master/index"], ["class"=>"nav-link"]) ?>
                    </li>
                  <!--  <li>
                        <a>
                            <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                            <span class="nav-icon"><i class="material-icons">&#xe85d;</i></span>
                            <span class="nav-text">Tarbiyat</span>                            
                        </a>
                        <ul class="nav-sub">
                            <li>
                                <?= Html::a('<span class="nav-text">Tarbiyat Subject</span>',["/admin/tarbiyatsubject/index"], ["class"=>"nav-link"]) ?>
                            </li>
                            <li>
                                <?= Html::a('<span class="nav-text">Tarbiyat Subject Options</span>',["/admin/subjectoption/index"], ["class"=>"nav-link"]) ?>
                            </li>
                            <li>
                                <?= Html::a('<span class="nav-text">Tarbiyat Card</span>',["/admin/tarbiyatcard/index"], ["class"=>"nav-link"]) ?>
                  
                            </li>
                        </ul>
                    </li> -->
                     <li>
                        <a>
                            <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                            <span class="nav-icon"><i class="material-icons">&#xe7f9;</i></span>
                            <span class="nav-text">Islamic Exam</span>                            
                        </a>
                        <ul class="nav-sub">
                            <li>
                                <?= Html::a('<span class="nav-text">Islamic Subject</span>',["/admin/subject/index"], ["class"=>"nav-link"]) ?>
                            </li>
                            <li>
                                <?= Html::a('<span class="nav-text">Marks</span>',["/admin/mark/index"], ["class"=>"nav-link"]) ?>
                            </li>
                            
                        </ul>
                        </li>

                        <li>
                        <a>
                            <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                            <span class="nav-icon"><i class="material-icons">&#xe7f9;</i></span>
                            <span class="nav-text">Result Master</span>                            
                        </a>
                        <ul class="nav-sub">
                            <li>
                                <?= Html::a('<span class="nav-text">Result</span>',["/admin/result-master/index"], ["class"=>"nav-link"]) ?>
                            </li>
                            <li>
                                <?= Html::a('<span class="nav-text">Upgrade Class</span>',["/admin/class-upgrade-master/index"], ["class"=>"nav-link"]) ?>
                            </li>
                            
                        </ul>
                        </li>

                        <li>
                        <a>
                            <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                            <span class="nav-icon"><i class="material-icons">&#xe7f9;</i></span>
                            <span class="nav-text">Staff Module</span>                            
                        </a>
                        <ul class="nav-sub">
                            <li><?= Html::a('<span class="nav-text">Staff</span>',["/admin/staff/index"], ["class"=>"nav-link"]) ?></li>
                            <li><?= Html::a('<span class="nav-text">Leave</span>',["/admin/leave/index"], ["class"=>"nav-link"]) ?></li>
                            
                        </ul>
                    </li>
                    <li>
                        <a>
                            <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                            <span class="nav-icon"><i class="material-icons">&#xe7f9;</i></span>
                            <span class="nav-text">Hostel Management</span>                            
                        </a>
                        <ul class="nav-sub">
                            <li><?= Html::a('<span class="nav-text">Rooms</span>',["/admin/room/index"], ["class"=>"nav-link"]) ?></li>
                            <li><?= Html::a('<span class="nav-text">Bed</span>',["/admin/bed/index"], ["class"=>"nav-link"]) ?></li>
                            <li><?= Html::a('<span class="nav-text">Hostel</span>',["/admin/hostel/index"], ["class"=>"nav-link"]) ?></li>
                            
                        </ul>
                    </li>
                     <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe02f;</i></span><span class="nav-text">Guest</span>',["/admin/guest/index"], ["class"=>"nav-link"]) ?>
                    </li>
                     <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe02f;</i></span><span class="nav-text">Event</span>',["/admin/event/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <?php /* <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe7f3;</i></span><span class="nav-text">Complaint</span>',["/admin/complaint/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe86e;</i></span><span class="nav-text">Request</span>',["/admin/request/index"], ["class"=>"nav-link"]) ?>
                    </li> */?>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe86e;</i></span><span class="nav-text">Decision</span>',["/admin/decision/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe86e;</i></span><span class="nav-text">Program</span>',["/admin/program/index"], ["class"=>"nav-link"]) ?>
                    </li>
                     <li ui-sref-active="active">
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xE0BA;</i></span><span class="nav-text">Important Contacts</span>',["/admin/impcontact/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li ui-sref-active="active">
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe86e;</i></span><span class="nav-text">Letter Master</span>',["/admin/letter-master/index"], ["class"=>"nav-link"]) ?>
                    </li>
                     <li ui-sref-active="active">
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xeb43;</i></span><span class="nav-text">Weight & Height</span>',["/admin/weightheight/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <a>
                            <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                            <span class="nav-icon"><i class="material-icons">&#xe7f9;</i></span>
                            <span class="nav-text">Jamiah Management</span>                            
                        </a>
                        <ul class="nav-sub">
                            <li><?= Html::a('<span class="nav-text">Category</span>',["/admin/jamiacategory/index"], ["class"=>"nav-link"]) ?></li>
                            <li><?= Html::a('<span class="nav-text">List</span>',["/admin/jamia/index"], ["class"=>"nav-link"]) ?></li>
                        </ul>
                    </li>
                    <?php /*<li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe86e;</i></span><span class="nav-text">Penalty</span>',["/admin/penalty/index"], ["class"=>"nav-link"]) ?>
                    </li>
                   
                    <li ui-sref-active="active">
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe8e8;</i></span><span class="nav-text">Students Status</span>',["/admin/studentstatus/index"], ["class"=>"nav-link"]) ?>
                    </li>
                   
                   
                    <li ui-sref-active="active">
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xE8B8;</i></span><span class="nav-text">Settings</span>',["/admin/setting/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    */ ?>
                </ul>
            </nav>
        </div>
    </div>
</div>