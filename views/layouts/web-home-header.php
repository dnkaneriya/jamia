<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

use app\models\Setting;
?>
<?php
	$student_menu = Setting::find()->where(['setting_key'=>'show_student_menu'])->one();
	$register_menu = Setting::find()->where(['setting_key'=>'show_register_menu'])->one();
	//echo "<pre>";print_r($show_menu->is_active);
?>
<style>
	ul#navlist li:last-child a {
		border-right: none;
	}
</style>
<header>
	<div class="wrapper">
		<div class="logo">
			<a href="<?php echo Yii::$app->request->baseUrl; ?>/site/index" title="Demo 21"><img src="<?php echo Yii::$app->request->baseUrl; ?>/front/images/logo.png" alt="Demo 21" /></a>
		</div>
		<div id="nav">
            <ul id="navlist" class="sf-menu clearfix">
                <li id="ctl00_Navigation1_liHome"><a href="<?php echo Yii::$app->request->baseUrl; ?>/site/index" title="Home">Home</a></li>
                <li id="ctl00_Navigation1_liAbout"><a href="<?php echo Yii::$app->request->baseUrl; ?>/site/aboutus" title="About Us">About Us</a></li>
                <li id="ctl00_Navigation1_liContact"><a href="<?php echo Yii::$app->request->baseUrl; ?>/site/contactus" title="Contact Us">Contact Us</a></li>
				<?php /*if(isset($student_menu->is_active) && $student_menu->is_active == 'Y' ){ ?>
				<li id="ctl00_Navigation1_liStudent"><a href="<?php echo Yii::$app->request->baseUrl; ?>/site/students" title="Students">Students</a></li>
				<?php }*/ ?>
				
				<li id="ctl00_Navigation1_liStudent"><a href="<?php echo Yii::$app->request->baseUrl; ?>/site/register" title="Students">Registration</a></li>
				
                <!--<li id="ctl00_Navigation1_liServices"><a href="1/services.html" title="Services">Services</a>
                    <ul class='sub-menu'>
                        <li><a href='1/services/funeral-services.html' title='Funeral Services'> <span>--</span> Funeral Services</a></li>
                        <li><a href='1/services/marriage.html' title='Marriage'> <span>--</span> Marriage</a></li>
                        <li><a href='1/services/facilities.html' title='Facilities'> <span>--</span> Facilities</a></li>
                        <li><a href='1/services/family-counselling.html' title='Family Counselling'> <span>--</span> Family Counselling</a></li>
                        <li><a href='1/services/visits-tours.html' title='Visits & Tours'> <span>--</span> Visits & Tours</a></li>
                    </ul>
                </li>-->
            </ul>
		</div>
	</div>
    <div class="clear"></div>
</header>