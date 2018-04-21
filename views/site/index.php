<?php
use yii\helpers\Html;
use yii\helpers\Url;

use app\models\Homebanners;
use app\models\Cms;

$this->title = Yii::$app->params['apptitle'];
?>
<?php
	$banners = Homebanners::find()->where(['is_active'=>'Y', 'is_deleted'=>'N'])->all();
	if(!empty($banners)){
?>

<div id="ctl00__banner_top_bannerPanel1">
	<div class="flexslider">
		<ul class="slides">
			<?php foreach($banners as $banner){ ?>
			<li><img src="<?=Url::to('@web/')?>/<?=$banner->banner?>" alt="Jameatul Uloom" width="1423" height="465"/></li>
			<?php } ?>
			
		</ul>
	</div>
</div>
<?php } ?>
<div class="welcome">
	<div class="wrapper">
		<?php
			$home_content = Cms::find()->where(['id'=>1])->one();
			if($home_content){
				echo $home_content->content;
			}
		?>
		<!--<h1>About Us</h1>
 <p>Considering of present situation and time only one sided knowledge is not enough.Jameah's main goal is to impart religious education but looking at the present demand one perfect alim should have the knowledge of religious subjects like tafsir,hadith,fiqh,nahw,sarf etc. besides the subjects like science,maths,english,technology.</p>
                
				<p>The main purpose is to serve the society by making up combination of both education the religious and formal education.
th alim has to deal with those people who are educated.In this position one sided knowledge may be useless and imperfect.The prophet hazrat Muhammad S.A.W had advised the sahaba to learn the roman language because they had to deal with the roman people.Thinking of future situation Jameah has decied to provide religious knowledge,besides formal education,ibadat and the development of good virtues.</p>
-->
	</div>
</div>
<div class="clear"></div>