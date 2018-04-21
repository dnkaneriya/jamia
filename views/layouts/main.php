<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppFrontAsset;
use app\assets\WebAsset;

/* @var $this \yii\web\View */
/* @var $content string */

WebAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="no-scroll">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/website/images/logo-fav.png" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl; ?>/front/css/style.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl; ?>/front/css/parallax.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl; ?>/front/css/slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl; ?>/front/css/navigation.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl; ?>/front/css/dr-framework.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl; ?>/front/css/responsive.css" type="text/css" media="screen" />
	<link href="https://fonts.googleapis.com/css?family=Lato:400,300" rel="stylesheet" type="text/css" />
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,800,700,600,300" rel="stylesheet" type="text/css" />
        

	<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->
	<!-- html5.js for IE less than 9 -->
	<!-- css3-mediaqueries.js for IE less than 9 -->
	<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!--[if lt IE 9]>
 	<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/front/css/ie8-and-down.css" />
	<![endif]-->

	<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/front/js/jquery.min.js"></script>

    <script src="<?php echo Yii::$app->request->baseUrl; ?>/front/js/jquery.flexslider.js"></script>
	<script type="text/javascript" charset="utf-8">
	    $(window).load(function () {
	        $('.flexslider').flexslider();
	    });
	</script>
    <script src="<?php echo Yii::$app->request->baseUrl; ?>/front/js/script.js"></script>
    <?php $this->head() ?>
</head>
<body>

<script src="WebResourceae09.js?d=NTku_peUGMIKaFAnwSWQps2yVqnm4s94g8anJNa3oSMfgmMaW74JfUiHdHQ4aWcH3n4uxYpd_ZfWTCpb-26uZ5lavFufKycbalmVfgMeRoE1&amp;t=635803038500000000" type="text/javascript"></script>
<script src="ScriptResource479b.js?d=9Jrb0t0Vvar4CDtfWbbe5WRq07i_BCAQSZSfhueow67l0iCemRTIsPa0Z6LxBw7DddnFOvf9dPq4K_lttvlUto2hg3_m7BzfThsGTzyPNPz3Ab7GGCJfmig2ny_6i4dBkfVMYvzF7QTM42MdOS7TSL2u-WoWz_g3lh9Pn4GDq4Q1&amp;t=ffffffffd1fec354" type="text/javascript"></script>
<script src="ScriptResourceff2f.js?d=4Jlpc6ezd2UORNjl2deUchkAxLTwjRLXC7KwXwzdL0ql-8pPo1fmYTUnzaIEjS5zAQrWLXMhop5uuzAxA6hutSt5R5GL498JvSOeH14FqSVZIqM_B3Wf_kqwL2QXbxjrRV3BcC8IQIRX7V-_a6pLgw2&amp;t=ffffffffec54f2d7" type="text/javascript"></script>
<script src="ScriptResource7ddc.js?d=vzps_9-TVGuBNC6A-GxYIDlu-R7Prs7G4aBXO6SZBHHgh2RzFCM5Vr8DMmbVgm5YDZe60hfKuzLNgHCZeC1mKH6MsH3DO8WnuULu6-t80PIA8V0_nJqA5_w2wARd0is2f7OKkwWiYRu1SO2yWsnR6Q2&amp;t=ffffffffec54f2d7" type="text/javascript"></script>
<script src="Defaultd2d7.js?_TSM_HiddenField_=ctl00_ScriptManager1_HiddenField&amp;_TSM_CombinedScripts_=%3b%3bAjaxControlToolkit%2c+Version%3d3.5.40412.0%2c+Culture%3dneutral%2c+PublicKeyToken%3d28f01b0e84b6d53e%3aen-GB%3a1547e793-5b7e-48fe-8490-03a375b13a33%3ade1feab2%3af9cec9bc%3a8ad18101%3a35576c48" type="text/javascript"></script>

<?php $this->beginBody() ?>
    <?php include_once('web-home-header.php');?>
    <?= $content ?>
    <?php include_once('footer.php');?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
