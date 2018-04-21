<?php
    use yii\helpers\Html;
?>
<?php
$controller = strtolower(Yii::$app->controller->id);
$action = strtolower(Yii::$app->controller->action->id);

if($controller == 'site' && $action == 'index'){
    $home = '#home';
    $fibromialgia = '#fibromialgia';
    $sintomas = '#sintomas';
    $causas = '#causes';
    $tretamento = '#tretamento';
    $perguntas = '#perguntas';
    $convivo = '#convivo';
    $dicas = '#dicas';
    $blog = '#blog';
    $entrevistas = '#entrevistas';
    $cadastra = '#cadastra';
    $fale = '#fale';
}else{
    $home = Yii::$app->request->baseurl.'/site/index';
    $fibromialgia = Yii::$app->request->baseurl.'/site/index#fibromialgia';
    $sintomas = Yii::$app->request->baseurl.'/site/index#sintomas';
    $causas = Yii::$app->request->baseurl.'/site/index#causes';
    $tretamento = Yii::$app->request->baseurl.'/site/index#tretamento';
    $perguntas = Yii::$app->request->baseurl.'/site/index#perguntas';
    $convivo = Yii::$app->request->baseurl.'/site/index#convivo';
    $dicas = Yii::$app->request->baseurl.'/site/index#dicas';
    $blog = Yii::$app->request->baseurl.'/site/index#blog';
    $entrevistas = Yii::$app->request->baseurl.'/site/index#entrevistas';
    $cadastra = Yii::$app->request->baseurl.'/site/index#cadastra';
    $fale = Yii::$app->request->baseurl.'/site/index#fale';
}
?>
<footer>
    <div class="footer-primary-container ">
        <div class="container">
            <div class="footer text-center footer-primary uppercase">
                <div class="row">
                    <div class="col-sm-3 wow fadeInUp" data-wow-delay="0.2s">
                        <ul>
                            <li><a class="smoothScroll" href="<?=$home?>">HOME</a></li>
                            <li><a class="smoothScroll" href="<?=$fibromialgia?>">FIBROMIALGIA</a></li>
                            <li><a class="smoothScroll" href="<?=$sintomas?>">Sintomas</a></li>
                            <li><a class="smoothScroll" href="<?=$causas?>">CAUSAS</a></li>
                            <li><a class="smoothScroll" href="<?=$tretamento?>">TRATAMENTOS</a></li>
                            <li><a class="smoothScroll" href="<?=$perguntas?>">PERGUNTAS FREQUENTES</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-3 wow fadeInUp" data-wow-delay="0.4s">
                        <ul>
                            <li><a class="smoothScroll" href="<?=$convivo?>">CONVIVO BEM</a></li>
                            <li><a class="smoothScroll" href="<?=$dicas?>">DICAS DE  BEM-ESTAR</a></li>
                            <li><a class="smoothScroll" href="<?=$perguntas?>">PERGUNTAS FREQUENTES</a></li>
                            <li><a class="smoothScroll" href="<?=$blog?>">FISIOTERAPIA</a></li>
                            <li><a class="smoothScroll" href="#">ALONGAMENTOS</a></li>
                            <li><a class="smoothScroll" href="#">VIDEOS</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-3 wow fadeInUp" data-wow-delay="0.6s">
                        <ul>
                            <li><a href="<?=Yii::$app->request->baseurl?>/site/medico">ENCONTRE UM MÉDICO</a></li>
                            <li><a class="smoothScroll" href="<?=$entrevistas?>">ENTREVISTAS</a></li>
                            <li><a class="smoothScroll" href="#">RELAXAMENTO</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-3 wow fadeInUp" data-wow-delay="0.8s">
                        <ul>
                            <li><a class="smoothScroll" href="<?=$cadastra?>">CADASTRE-SE</a></li>
                            <li><a href="<?=Yii::$app->request->baseurl?>/site/cadastrese">NEWSLETTER</a></li>
                            <li><a class="smoothScroll" href="#">IMPRENSA</a></li>
                            <li><a href="<?=Yii::$app->request->baseurl?>/site/noticias">NOTICIAS</a></li>
                            <li><a class="smoothScroll" href="<?=$fale?>">FALE CONOSCO</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>      
    <div class="footer-bottom-container relative">
        <div class="container">
            <div class="footer footer-bottom">
                <p class="copyright uppercase c-white">&copy; 2016- FIBROMIALGIA.COM.BR.  Todos os direitos reservados  </p>
                <a href="#back-to-top" class="bake-to-top smoothScroll">
                    <i class="fa fa-angle-up"></i>
                </a>
                <div class="social-icon">
                    <a href="#"><i class="icon fa fa-facebook wow rotateIn" data-wow-delay="0.3s"></i></a>
                    <a href="#"><i class="icon fa fa-instagram wow rotateIn" data-wow-delay="0.5s"></i></a>
                    <a href="#"><i class="icon fa fa-google-plus wow rotateIn" data-wow-delay="0.7s"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>