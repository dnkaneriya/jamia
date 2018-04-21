<?php

use yii\helpers\Html;

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
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe871;</i></span><span class="nav-text">Dashboard</span>',["/admin/default/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe86e;</i></span><span class="nav-text">Class</span>',["/admin/classes/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe86e;</i></span><span class="nav-text">Sub Class</span>',["/admin/subclass/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe86e;</i></span><span class="nav-text">Division</span>',["/admin/division/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <?php /*
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe8d2;</i></span><span class="nav-text">Subject</span>',["/admin/subject/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li ui-sref-active="active">
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe7ef;</i></span><span class="nav-text">Students</span>',["/admin/student/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    */ ?>
                    <li ui-sref-active="active">
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe7ef;</i></span><span class="nav-text">Registered Students</span>',["/admin/student/pending"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe7ef;</i></span><span class="nav-text">Selected Students</span>',["/admin/student/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe7ef;</i></span><span class="nav-text">Confirmed Students</span>',["/admin/student/confirm"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe86e;</i></span><span class="nav-text">Qur\'an</span>',["/admin/quran/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe86e;</i></span><span class="nav-text">Tarbiyat Subject</span>',["/admin/tarbiyatsubject/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe86e;</i></span><span class="nav-text">Tarbiyat Subject Options</span>',["/admin/subjectoption/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe86e;</i></span><span class="nav-text">Tarbiyat Card</span>',["/admin/tarbiyatcard/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <?php /*
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe86e;</i></span><span class="nav-text">Complaint</span>',["/admin/complaint/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe86e;</i></span><span class="nav-text">Request</span>',["/admin/request/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe86e;</i></span><span class="nav-text">Guest</span>',["/admin/guest/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe86e;</i></span><span class="nav-text">Event</span>',["/admin/event/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe86e;</i></span><span class="nav-text">Program</span>',["/admin/program/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li>
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe86e;</i></span><span class="nav-text">Penalty</span>',["/admin/penalty/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li ui-sref-active="active">
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xe8e8;</i></span><span class="nav-text">Students Status</span>',["/admin/studentstatus/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li ui-sref-active="active">
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xeb43;</i></span><span class="nav-text">Weight & Height</span>',["/admin/weightheight/index"], ["class"=>"nav-link"]) ?>
                    </li>*/ ?>
                    <li ui-sref-active="active">
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xE0BA;</i></span><span class="nav-text">Important Contacts</span>',["/admin/impcontact/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    <li ui-sref-active="active">
                        <?= Html::a('<span class="nav-icon"><i class="material-icons">&#xE8B8;</i></span><span class="nav-text">Settings</span>',["/admin/setting/index"], ["class"=>"nav-link"]) ?>
                    </li>
                    
                </ul>
            </nav>
        </div>
    </div>
</div>