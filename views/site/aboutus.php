<?php
use yii\helpers\Html;

use app\models\Cms;

/* @var $this yii\web\View */
$this->title = 'About';
?>

<div class="content">
	<div class="wrapper">
        <div class="dark">
            <div class="column12">
				<h1>About Us</h1>
				<?php
					$about_content = Cms::find()->where(['id'=>2])->one();
					if($about_content){
						echo $about_content->content;
					}
				?>
                <!--<h1>About Us</h1>
                <p>Considering of present situation and time only one sided knowledge is not enough.Jameah's main goal is to impart religious education but looking at the present demand one perfect alim should have the knowledge of religious subjects like tafsir,hadith,fiqh,nahw,sarf etc. besides the subjects like science,maths,english,technology.</p>
                
				<p>The main purpose is to serve the society by making up combination of both education the religious and formal education.
th alim has to deal with those people who are educated.In this position one sided knowledge may be useless and imperfect.The prophet hazrat Muhammad S.A.W had advised the sahaba to learn the roman language because they had to deal with the roman people.Thinking of future situation Jameah has decied to provide religious knowledge,besides formal education,ibadat and the development of good virtues.</p>

<p>Jameah celebrates both national festivals with zeal,cultural activities programs,to bring out student's talents and to develop the spirit of patriotism,brotherhood,secularism,national integrity among them.</p>

<p>Jameah also encourages the students for the service of people,religious service,service to nation,social service welfare and works for the women education also.Jameah works for the sports andcelebretes sport programs also.</p>

<p>Jameah works for the welfare of the poor and backward classes.</p>


                <p>&nbsp;</p>-->
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>