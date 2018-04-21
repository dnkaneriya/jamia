<?php
use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
//use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/website/images/logo-fav.png" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/libs/jquery/jquery/dist/jquery.js"></script>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="app" id="app">
        <!-- aside -->
        <?php include_once('left.php');?>
        <!-- aside -->
        
        <div id="content" class="app-content box-shadow-z0" role="main">
            <div class="app-header white box-shadow">
                <?php include_once('top_header.php');?>
            </div>
            <?= $content?>
        </div>
        <?php //include_once('footer.php');?>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<script>
jQuery(document).ready(function() {       
   // initiate layout and plugins
   //App.init();
});
</script>