<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Jamiaimage;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Jamia */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$jamiaimages=Jamiaimage::find()->where(['jamia_id'=>$model->id])->all();
?>
<link rel="stylesheet" type="text/css" href="<?=Yii::$app->request->baseurl?>/css/gallery.css" />
<script type="text/javascript" src="<?=Yii::$app->request->baseurl?>/plugins/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="<?=Yii::$app->request->baseurl?>/plugins/fancybox/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="<?=Yii::$app->request->baseurl?>/plugins/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
<!--main content start-->
<style>
    .user-bio p > span{
        display: inline-block;
        width: 30%;
    }
    .pagination li {
        display: inline !important;
        padding: 0 !important;
        width: auto !important;
    }
</style>
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <ul class="breadcrumb">

                        <li><i class="fa fa-home"></i> <?php echo Html::a(Yii::t('app', 'Home'), ['default/index']); ?></li>
                          <li><?php echo Html::a(Yii::t('app', 'Jamia'), ['jamia/index']); ?></li>
                           
                        <li>View</li>
                    </ul>
            </div>

            <aside class="profile-info col-lg-12">
                <section class="panel">
                   <h1><?=$model->name?>'s Album</h1>
                    <div class="panel-body bio-graph-info">
                    
			             <?php if($jamiaimages!=array()){ 
						 	foreach($jamiaimages as $jamiaimage){
						 		if(isset($jamiaimage->image) && $jamiaimage->image != null){
									$image = $jamiaimage->image;
								}else{
									$image = 'img/default.png';
								}
						 ?>
                            <div class="col-md-3">
                                   
                                    <a class="fancybox" href="<?=Url::to('@web/'.$image)?>" data-fancybox-group="gallery"><img src="<?=Url::to('@web/'.$image)?>" alt="" height="225" /></a>
                            </div>
                            <?php } } ?>
                    </div>
                </section>
            </aside>
           
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<script>
$('.fancybox').fancybox();</script>
