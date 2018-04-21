<?php
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\helpers\Html;

$this->title = Yii::$app->params['apptitle']." : BUSCA";
?>
<div class="full-width-banner">
	<div class="item">
		<div class="item-image" style="background: url(<?=Url::to('@web/website/images/slider/slider5.jpg')?>) no-repeat 70% center;"></div>
		<div class="banner-caption text-left">
			<div class="v-grid">
				<div class="container">
					<h2 class="Hero_Light c-primary">BUSCA</h2>
				</div>
			</div>
		</div>            
	</div>
</div>

<div class="main-container">
	
	<!-- Custom Content Section -->
	<section class="custom-content-section padd-top40 padd-bot60">
		<div class="container">
			<div class="section-title mar-bot50">
				<a href="<?=Yii::$app->request->baseurl?>/site/index" class="f-size18 pull-right c-blue"><strong>< VOLTAR</strong></a>
				<?php if(isset($_REQUEST['keyword']) && $_REQUEST['keyword'] != ''){ ?>
				<h2 class="c-blue f-size25">Foram encontrados “<?php echo count($result); ?>” resultados da palavra “<?php echo $_REQUEST['keyword']; ?>”</h2>
				<?php } ?>
			</div>                             
			<div class="noticias-content-section f-size18">                 
				<?php
				if($result != array()) {
					$i = 0;
					foreach($result as $value)
					{
						$i++;
				?>
				<p class="mar-bot30"><?php echo $i; ?>- <?php echo $value->Description; ?></p>
				<?php
					}
				}
				?>
                <div class="section-bottom text-right">
					<a href="<?=Yii::$app->request->baseurl?>/site/index" class="f-size18 c-blue"><strong>< VOLTAR</strong></a>
				</div>                    
			</div>
		</div>
	</section>   
	
	<?php include('footer-email.php'); ?>
	
</div>