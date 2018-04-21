<?php
use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\VerificationAsset;

/* @var $this \yii\web\View */
/* @var $content string */

VerificationAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl; ?>/plugins/bootstrap-fileupload/bootstrap-fileupload.css"/>-->
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/website/images/logo-fav.png" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="login-body">
        <div class="container">
        <?= $content ?>
        </div>
<?php $this->endBody() ?>
<!--<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>-->
</body>
</html>
<?php $this->endPage() ?>

<script>
jQuery(document).ready(function() {       
   // initiate layout and plugins
   //App.init();
});
</script>