<?php
use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/plugins/bootstrap-fileupload/bootstrap-fileupload.css"/>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/website/images/logo-fav.png" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/libs/jquery/jquery/dist/jquery.js"></script>
    <?php $this->head() ?>
</head>
<body class="full-width">

<?php $this->beginBody() ?>
    
    <?php include_once('top_header.php');?>
    
    <div class="page-container">
        <?php //include_once('left.php');?>
        <?= $content ?>
    </div>
    
    <?php include_once('footer.php');?>

<?php $this->endBody() ?>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
</body>
</html>
<?php $this->endPage() ?>

<script>
jQuery(document).ready(function() {       
   // initiate layout and plugins
   App.init();
});
</script>