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
class VerificationAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
	public $css = [
		'css/animate.css/animate.min.css',
		'plugins/font-awesome/css/font-awesome.min.css',
		'css/material-design-icons/material-design-icons.css',
		'plugins/bootstrap/dist/css/bootstrap.min.css',
		'css/styles/app.css',
		'css/styles/font.css'
	];
    
    public $js = [
		'plugins/libs/jquery/jquery/dist/jquery.js',
		'plugins/libs/jquery/tether/dist/js/tether.min.js',
		'plugins/libs/jquery/bootstrap/dist/js/bootstrap.js',
		'plugins/libs/jquery/underscore/underscore-min.js',
		'plugins/libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js',
		'plugins/libs/jquery/PACE/pace.min.js',
		
		'scripts/config.lazyload.js',
		'scripts/palette.js',
		'scripts/ui-load.js',
		'scripts/ui-jp.js',
		'scripts/ui-include.js',
		'scripts/ui-device.js',
		'scripts/ui-form.js',
		'scripts/ui-nav.js',
		'scripts/ui-screenfull.js',
		'scripts/ui-scroll-to.js',
		'scripts/ui-toggle-class.js',
		'scripts/app.js',
		
		'plugins/libs/jquery/jquery-pjax/jquery.pjax.js',
		'scripts/ajax.js'
	];
    
    public $jsOptions = array(
		'position' => \yii\web\View::POS_HEAD
    );
    
    //public $depends = [
    //    'yii\web\YiiAsset',
    //    'yii\bootstrap\BootstrapAsset',
    //];
}
