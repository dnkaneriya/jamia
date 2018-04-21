<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class WebAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = 
    [
		'website/css/bootstrap/bootstrap.css',
		'website/css/owl-carousel/owl.carousel.css',
		'website/css/owl-carousel/owl.theme.css',
		'website/css/owl-carousel/owl.transitions.css',
		'website/css/style.css',
		'website/css/responsive.css',
		'website/css/animation.css',
		'website/css/animation/animate.css',
		'website/fonts/theme-font/theme-font.css',
		'website/fonts/fontawesome/font-awesome.css',
	];
    
    public $js = 
    [
		'website/js/bootstrap/bootstrap.min.js',
		'website/js/bootstrap/ie10-viewport-bug-workaround.js',
		'website/js/owl-carousel/owl.carousel.min.js',
		'website/js/animation/wow.min.js',
		'website/js/animation/wow.init.js',
		'website/js/script.js',
	];
    
    public $jsOptions = array(
		//'position' => \yii\web\View::POS_HEAD
    );
    
    //public $depends = [
    //    'yii\web\YiiAsset',
    //    'yii\bootstrap\BootstrapAsset',
    //];
}
