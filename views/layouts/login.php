<?php
use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\LoginAsset;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<?php
LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/website/images/logo-fav.png" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="login-body">
    
    <?php $this->beginBody() ?>
    
    <!--<div class="logo">-->
    <!--    <span style="color:red;font-size: 30px;">Cross</span><span style="color:white;font-size: 30px;">Fit</span>-->
    <!---->
    <!--</div>-->
    <div class="container">
    <?= $content ?>
    </div>
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>