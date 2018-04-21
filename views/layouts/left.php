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
                    <li class="<?=activeness(['classes', 'index'])?>" style="display: <?php echo (Yii::$app->user->identity->role == 1 || Yii::$app->user->identity->role == 3 ) ? 'block' : 'none' ?>">
                        <a>
                            <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                            <span class="nav-icon"><i class="material-icons">&#xe80c;</i></span>
                            <span class="nav-text">Classes & Subjects</span>
                        </a>
                        <ul class="nav-sub">
                           <li>
                                <a>
                                    <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                                    <span class="nav-icon"><i class="material-icons">&#xe7f9;</i></span>
                                    <span class="nav-text">Islamic</span>
                                </a>
                                <ul class="nav-sub">
                                    <li class="<?=activeness(['classes', 'index'])?>">
                                        <?= Html::a('<span class="nav-text">1 - Class</span>',["/admin/classes/index"], ["class"=>"classes"]) ?>
                                    </li>
                                    <li class="<?=activeness(['subclass', 'index'])?>">
                                        <?= Html::a('<span class="nav-text">2 - Sub Class</span>',["/admin/subclass/index"], ["class"=>"classes"]) ?>
                                    </li>
                                    <li class="<?=activeness(['division', 'index'])?>">
                                        <?= Html::a('<span class="nav-text">3 - Division</span>',["/admin/division/index"], ["class"=>"classes"]) ?>
                                    </li>
                                    <li class="<?=activeness(['class-upgrade-master', 'index'])?>"> 
                                        <?= Html::a('<span class="nav-text">4 - Class Upgrade</span>',["/admin/class-upgrade-master/index"], ["class"=>"classes"]) ?>
                                    </li>        
                                </ul>   
                           </li>
                           <li>
                               <a>
                                    <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                                    <span class="nav-icon"><i class="material-icons">&#xe7f9;</i></span>
                                    <span class="nav-text">Tajwid</span>
                                </a>
                                <ul class="nav-sub">
                                    <li class="<?=activeness(['classes', 'index'])?>">
                                        <?= Html::a('<span class="nav-text">1 - Tajwid Class</span>',["/admin/tajwid-class/index"], ["class"=>"classes"]) ?>
                                        <?= Html::a('<span class="nav-text">2 - Tajwid Class Upgrade</span>',["/admin/tajwid-class-upgrade/index"], ["class"=>"classes"]) ?>
                                    </li>
                                            
                                </ul>
                           </li>

                           <li>
                               <a>
                                    <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                                    <span class="nav-icon"><i class="material-icons">&#xe7f9;</i></span>
                                    <span class="nav-text">School</span>
                                </a>
                                <ul class="nav-sub">
                                    <li class="<?=activeness(['classes', 'index'])?>">
                                        <?= Html::a('<span class="nav-text">1 - standard</span>',["/admin/school-exam/index"], ["class"=>"classes"]) ?>
                                        <?= Html::a('<span class="nav-text">2 - Semester</span>',["/admin/school-exam-semester/index"], ["class"=>"classes"]) ?>
                                        <?= Html::a('<span class="nav-text">3 - School Standard Upgrade</span>',["/admin/school-standard-upgrade/index"], ["class"=>"classes"]) ?>
                                    </li>
                                </ul>
                           </li>
                        </ul>
                    </li>

                    <li class="<?=activeness(['classes', 'index'])?>" style="display: <?php echo (Yii::$app->user->identity->role == 1 || Yii::$app->user->identity->role == 3 ) ? 'block' : 'none' ?>">
                        <a>
                            <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                            <span class="nav-icon"><i class="material-icons">&#xe80c;</i></span>
                            <span class="nav-text">Exam</span>
                        </a>
                        <ul class="nav-sub">
                           <li>
                                <a>
                                    <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                                    <span class="nav-icon"><i class="material-icons">&#xe7f9;</i></span>
                                    <span class="nav-text">Islamic</span>
                                </a>
                                <ul class="nav-sub">
                                    <li class="<?=activeness(['subject', 'index'])?>">
                                        <?= Html::a('<span class="nav-text">1 - Subject</span>',["/admin/subject/index"], ["class"=>"classes"]) ?>
                                    </li>
                                    <li class="<?=activeness(['classes', 'index'])?>">
                                        <?= Html::a('<span class="nav-text">2 - Exam Master</span>',["/admin/exam-master/index"], ["class"=>"classes"]) ?>
                                    </li>
                                    <li class="<?=activeness(['classes', 'index'])?>">
                                        <?= Html::a('<span class="nav-text">3 - Mark</span>',["/admin/mark/index"], ["class"=>"classes"]) ?>
                                    </li>
                                    <li class="<?=activeness(['subclass', 'index'])?>">
                                        <?= Html::a('<span class="nav-text">4 - Result</span>',["/admin/result-master/index"], ["class"=>"classes"]) ?>
                                    </li>
                                    
                                    
                                </ul>   
                           </li>
                           <li>
                               <a>
                                    <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                                    <span class="nav-icon"><i class="material-icons">&#xe7f9;</i></span>
                                    <span class="nav-text">Tajwid</span>
                                </a>
                                <ul class="nav-sub">
                                    <li class="<?=activeness(['subclass', 'index'])?>">
                                        <?= Html::a('<span class="nav-text">1 - Tajwid Subject</span>',["/admin/tajwid-subject/index"], ["class"=>"classes"]) ?>
                                    </li>
                                    <li class="<?=activeness(['classes', 'index'])?>">
                                        <?= Html::a('<span class="nav-text">2 - Mark</span>',["/admin/tajwid-marks/index"], ["class"=>"classes"]) ?>
                                    </li>
                                    <li class="<?=activeness(['subclass', 'index'])?>">
                                        <?= Html::a('<span class="nav-text">3 - Result</span>',["/admin/tajwid-result/index"], ["class"=>"classes"]) ?>
                                    </li>
                                </ul>
                           </li>

                           <li>
                               <a>
                                    <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                                    <span class="nav-icon"><i class="material-icons">&#xe7f9;</i></span>
                                    <span class="nav-text">School</span>
                                </a>
                                <ul class="nav-sub">
                                    <li class="<?=activeness(['subject', 'index'])?>">
                                        <?= Html::a('<span class="nav-text">1 - Subject</span>',["/admin/school-subject/index"], ["class"=>"classes"]) ?>
                                    </li>
                                    <li class="<?=activeness(['classes', 'index'])?>">
                                        <?= Html::a('<span class="nav-text">2 - Mark</span>',["/admin/school-exam-marks/index"], ["class"=>"classes"]) ?>
                                    </li>
                                    <li class="<?=activeness(['subclass', 'index'])?>">
                                        <?= Html::a('<span class="nav-text">3 - Result</span>',["/admin/school-exam-result/index"], ["class"=>"classes"]) ?>
                                    </li>
                                    
                                </ul>
                           </li>
                        </ul>
                    </li>

                    <li style="display: <?php echo (Yii::$app->user->identity->role == 1) ? 'block' : 'none' ?>">
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
                    <li style="display: <?php echo (Yii::$app->user->identity->role == 1) ? 'block' : 'none'; ?>">
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
                     <li style="display: <?php echo (Yii::$app->user->identity->role == 1) ? 'block' : 'none'; ?>">
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe7ef;</i></span><span class="nav-text">Students</span>',["/admin/student/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li style="display: <?php echo (Yii::$app->user->identity->role == 1) ? 'block' : 'none' ?>">
                        <a>
                            <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                            <span class="nav-icon"><i class="material-icons">&#xe7ef;</i></span>
                            <span class="nav-text">Other Students</span>                            
                        </a>
                        <ul class="nav-sub">
                            <li>
                                <?= Html::a('<span class="nav-icon"></span><span class="nav-text">Closed Students</span>',["/admin/student/closed-students"], ["class"=>"nav-link"]) ?>
                            </li>
                            <li>
                            <?= Html::a('<span class="nav-icon"></span><span class="nav-text">Hafiz Students</span>',["/admin/student/hafiz-students"], ["class"=>"nav-link"]) ?>
                            </li>
                            <li>
                            <?= Html::a('<span class="nav-icon"></span><span class="nav-text">Aalim Students</span>',["/admin/student/aalim-students"], ["class"=>"nav-link"]) ?>
                            </li>
                        </ul>
                        
                    </li>
                    <li style="display: <?php echo (Yii::$app->user->identity->role == 1) ? 'block' : 'none' ?>">
                        <a>
                            <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                            <span class="nav-icon"><i class="material-icons">&#xe7ef;</i></span>
                            <span class="nav-text">Tarbiyat</span>                            
                        </a>
                        <ul class="nav-sub">
                            <li>
                                <?= Html::a('<span class="nav-icon"></span><span class="nav-text">Tarbiyat Subject</span>',["/admin/tarbiyatsubject/index"], ["class"=>"nav-link"]) ?>
                            </li>
                            <li>
                            <?= Html::a('<span class="nav-icon"></span><span class="nav-text">Tarbiyat Card</span>',["/admin/tarbiyatcard/index"], ["class"=>"nav-link"]) ?>
                            </li>
                        </ul>
                        
                    </li>
                    <li  style="display: <?php echo (Yii::$app->user->identity->role == 1 || Yii::$app->user->identity->role == 2 ||  Yii::$app->user->identity->role == 5 ) ? 'block' : 'none' ?>">
                        <a>
                            <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                            <span class="nav-icon"><i class="material-icons">&#xe7ef;</i></span>
                            <span class="nav-text">Other Activities</span>                            
                        </a>
                        <ul class="nav-sub">
                            <li style="display: <?php echo (Yii::$app->user->identity->role == 1 || Yii::$app->user->identity->role == 2) ? 'block' : 'none'; ?>">
                                <?= Html::a('<span class="nav-icon"></span><span class="nav-text">Attendance</span>',["/admin/attendance/index"], ["class"=>"nav-link"]) ?>
                            </li>
                            <li style="display: <?php echo (Yii::$app->user->identity->role == 1 || Yii::$app->user->identity->role == 2) ? 'block' : 'none' ?>">
                                <?= Html::a('<span class="nav-icon"></span><span class="nav-text">Student Rating</span>',["/admin/student-progress/index"], ["class"=>"nav-link"]) ?>
                            </li>
                            <li style="display: <?php echo (Yii::$app->user->identity->role == 1 || Yii::$app->user->identity->role == 5 ) ? 'block' : 'none' ?>">
                                <?= Html::a('<span class="nav-icon"></span><span class="nav-text">Complaint Register</span>',["/admin/complaint/index"], ["class"=>"nav-link"]) ?>
                            </li>
                            <li style="display: <?php echo (Yii::$app->user->identity->role == 1) ? 'block' : 'none' ?>">
                                <?= Html::a('<span class="nav-icon"></span><span class="nav-text">Qur\'an</span>',["/admin/quran/index"], ["class"=>"nav-link"]) ?>
                            </li>
                            <li style="display: <?php echo (Yii::$app->user->identity->role == 1 || Yii::$app->user->identity->role == 2) ? 'block' : 'none' ?>">
                                <?= Html::a('<span class="nav-icon"></span><span class="nav-text">Document</span>',["/admin/student-document/index"], ["class"=>"nav-link"]) ?>
                            </li>
                            <li style="display: <?php echo (Yii::$app->user->identity->role == 1 || Yii::$app->user->identity->role == 2) ? 'block' : 'none' ?>">
                                <?= Html::a('<span class="nav-icon"></span><span class="nav-text">Student Request</span>',["/admin/student-request/index"], ["class"=>"nav-link"]) ?>
                            </li>

                            <li style="display: <?php echo (Yii::$app->user->identity->role == 1 ||  Yii::$app->user->identity->role == 5 ) ? 'block' : 'none' ?>">
                                <?= Html::a('<span class="nav-icon"></span><span class="nav-text">Guest</span>',["/admin/guest/index"], ["class"=>"nav-link"]) ?>
                            </li>
                             <li style="display: <?php echo (Yii::$app->user->identity->role == 1 ||  Yii::$app->user->identity->role == 5 ) ? 'block' : 'none' ?>">
                                <?= Html::a('<span class="nav-icon"></span><span class="nav-text">Event</span>',["/admin/event/index"], ["class"=>"nav-link"]) ?>
                            </li>
                            
                            <li style="display: <?php echo (Yii::$app->user->identity->role == 1 ||  Yii::$app->user->identity->role == 5 ) ? 'block' : 'none' ?>">
                                <?= Html::a('<span class="nav-icon"></span><span class="nav-text">Decision</span>',["/admin/decision/index"], ["class"=>"nav-link"]) ?>
                            </li>
                            <li style="display: <?php echo (Yii::$app->user->identity->role == 1 ||  Yii::$app->user->identity->role == 5 ) ? 'block' : 'none' ?>">
                                <?= Html::a('<span class="nav-icon"></span><span class="nav-text">Program</span>',["/admin/program/index"], ["class"=>"nav-link"]) ?>
                            </li>
                             <li ui-sref-active="active" style="display: <?php echo (Yii::$app->user->identity->role == 1 || Yii::$app->user->identity->role == 5 ) ? 'block' : 'none' ?>">
                                <?= Html::a('<span class="nav-icon"></span><span class="nav-text">Important Contacts</span>',["/admin/impcontact/index"], ["class"=>"nav-link"]) ?>
                            </li>
                             <li ui-sref-active="active" style="display: <?php echo (Yii::$app->user->identity->role == 1 || Yii::$app->user->identity->role == 2) ? 'block' : 'none' ?>">
                                <?= Html::a('<span class="nav-icon"></span><span class="nav-text">Weight & Height</span>',["/admin/weightheight/index"], ["class"=>"nav-link"]) ?>
                            </li>
                        </ul>
                    </li>
                    
                    
                    
                      
                        <li style="display: <?php echo (Yii::$app->user->identity->role == 1) ? 'block' : 'none' ?>">
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
                    <li style="display: <?php echo (Yii::$app->user->identity->role == 1 || Yii::$app->user->identity->role == 4) ? 'block' : 'none' ?>">
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
                     
                    <li style="display: <?php echo (Yii::$app->user->identity->role == 1) ? 'block' : 'none' ?>">
                        <a>
                            <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                            <span class="nav-icon"><i class="material-icons">&#xe7f9;</i></span>
                            <span class="nav-text">Jamiah Album</span>                            
                        </a>
                        <ul class="nav-sub">
                            <li><?= Html::a('<span class="nav-text">Category</span>',["/admin/jamiacategory/index"], ["class"=>"nav-link"]) ?></li>
                            <li><?= Html::a('<span class="nav-text">List</span>',["/admin/jamia/index"], ["class"=>"nav-link"]) ?></li>
                        </ul>
                    </li>
                    <li style="display: <?php echo (Yii::$app->user->identity->role == 1 || Yii::$app->user->identity->role == 3 || Yii::$app->user->identity->role == 4 || Yii::$app->user->identity->role == 5) ? 'block' : 'none' ?>">
                        <a>
                            <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                            <span class="nav-icon"><i class="material-icons">&#xe7f9;</i></span>
                            <span class="nav-text">Report</span>                            
                        </a>
                        <ul class="nav-sub">
                            <li style="display: <?php echo (Yii::$app->user->identity->role == 1 || Yii::$app->user->identity->role == 3) ? 'block' : 'none' ?>"><?= Html::a('<span class="nav-text">Class Result</span>',["/admin/report/class-result"], ["class"=>"nav-link"]) ?></li>
                            <li style="display: <?php echo (Yii::$app->user->identity->role == 1 || Yii::$app->user->identity->role == 3) ? 'block' : 'none' ?>"><?= Html::a('<span class="nav-text">School Exam Result</span>',["/admin/report/school-exam-result"], ["class"=>"nav-link"]) ?></li>
                            <li style="display: <?php echo (Yii::$app->user->identity->role == 1 || Yii::$app->user->identity->role == 4) ? 'block' : 'none' ?>"><?= Html::a('<span class="nav-text">Hostel Report</span>',["/admin/report/hostel-room"], ["class"=>"nav-link"]) ?></li>
                            <li style="display: <?php echo (Yii::$app->user->identity->role == 1 || Yii::$app->user->identity->role == 5) ? 'block' : 'none' ?>"><?= Html::a('<span class="nav-text">Student Icard</span>',["/admin/report/student-icard"], ["class"=>"nav-link"]) ?></li>
                            <li style="display: <?php echo (Yii::$app->user->identity->role == 1 || Yii::$app->user->identity->role == 3) ? 'block' : 'none' ?>"><?= Html::a('<span class="nav-text">Islamic Markjsheet</span>',["/admin/report/islamic-marksheet"], ["class"=>"nav-link"]) ?></li>
                            <li style="display: <?php echo (Yii::$app->user->identity->role == 1 || Yii::$app->user->identity->role == 3) ? 'block' : 'none' ?>"><?= Html::a('<span class="nav-text">School Markjsheet</span>',["/admin/report/school-marksheet"], ["class"=>"nav-link"]) ?></li>
                            <li style="display: <?php echo (Yii::$app->user->identity->role == 1 || Yii::$app->user->identity->role == 3) ? 'block' : 'none' ?>"><?= Html::a('<span class="nav-text">Tajwid Markjsheet</span>',["/admin/report/tajwid-marksheet"], ["class"=>"nav-link"]) ?></li>
                            <li style="display: <?php echo (Yii::$app->user->identity->role == 1) ? 'block' : 'none' ?>"><?= Html::a('<span class="nav-text">Progress Report</span>',["/admin/report/progress-report"], ["class"=>"nav-link"]) ?></li>
                            <li style="display: <?php echo (Yii::$app->user->identity->role == 1) ? 'block' : 'none' ?>"><?= Html::a('<span class="nav-text">Quran Report</span>',["/admin/report/quran-report"], ["class"=>"nav-link"]) ?></li>
                            
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>