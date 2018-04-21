<?php
use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
//use yii\widgets\Breadcrumbs;
use app\assets\WebAsset;

/* @var $this \yii\web\View */
/* @var $content string */

WebAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en" class="no-scroll" id="back-to-top">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/website/images/logo-fav.png" />
    
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
        
     <?php $this->head() ?>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
     <link href="<?php echo Yii::$app->request->baseUrl; ?>/website/css/bootstrap/ie10-viewport-bug-workaround.css" rel="stylesheet">        
     
     <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
     <!--[if lt IE 9]><script src="<?php echo Yii::$app->request->baseUrl; ?>/website/js/bootstrap/ie8-responsive-file-warning.js"></script><![endif]-->
     <script src="<?php echo Yii::$app->request->baseUrl; ?>/website/js/bootstrap/ie-emulation-modes-warning.js"></script>
     
     <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
     <!--[if lt IE 9]>
       <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
       <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
     <![endif]-->
     
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $(".custom-loader").fadeOut("slow");
        })
    </script>
</head>
<!-- Video Modal -->
<div class="modal fade video-modal" id="VideoModal" tabindex="-1" role="dialog" aria-labelledby="VideoModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <video width="100%" height="515" controls>
                  <source src="mov_bbb.mp4" type="video/mp4">
                  <source src="mov_bbb.ogg" type="video/ogg">
                  Your browser does not support HTML5 video.
                </video>            
            </div>
            <div class="modal-footer text-right">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>            
                <div class="social-icon">
                    <a href="#" class="push-effects-down"><i class="fa fa-envelope"></i></a>
                    <a href="#" class="push-effects-down"><i class="fa fa-facebook-square"></i></a>
                    <a href="#" class="push-effects-down"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="push-effects-down"><i class="fa fa-share"></i><strong>MAIS</strong></a>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .custom-loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 1;
        background: url("<?=Yii::$app->request->baseurl?>/website/images/custom-loader.gif") 50% 50% no-repeat rgb(249,249,249);
    }
</style>
<body class="" data-hijacking="off" data-animation="parallax">
    <!--<div class="custom-loader"></div>-->
  <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56a7f5df3b686b70" async="async"></script>
    <?php $this->beginBody() ?>
        <div class="wrapper">
            <?php include_once('web-home-header.php');?>
            <?= $content?>
            <?php include_once('web-footer.php');?>
        </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>