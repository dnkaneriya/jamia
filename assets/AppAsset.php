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
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/animate.css/animate.min.css',
        'plugins/font-awesome/css/font-awesome.min.css',
        'css/material-design-icons/material-design-icons.css',
        'plugins/bootstrap/dist/css/bootstrap.min.css',
        'css/styles/app.css',
        'css/styles/font.css',
        'plugins/bootstrap-datepicker/css/datepicker.css',
        'css/styles/custom.css',
    ];
    public $js = [
        //'plugins/libs/jquery/jquery/dist/jquery.js',
        'libs/jquery/tether/dist/js/tether.min.js',
        'libs/jquery/bootstrap/dist/js/bootstrap.js',
        'libs/jquery/underscore/underscore-min.js',
        'libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js',
        'libs/jquery/PACE/pace.min.js',
        'scripts/js/config.lazyload.js',
        'scripts/js/palette.js',
        'scripts/js/ui-load.js',
        'scripts/js/ui-jp.js',
        'scripts/js/ui-include.js',
        'scripts/js/ui-device.js',
        'scripts/js/ui-form.js',
        'scripts/js/ui-nav.js',
        'scripts/js/ui-screenfull.js',
        'scripts/js/ui-scroll-to.js',
        'scripts/js/ui-toggle-class.js',
        'scripts/js/app.js',
            //'scripts/js/jquery.validate.min.js',
            //'plugins/libs/jquery/jquery-pjax/jquery.pjax.js',
            //'scripts/js/ajax.js'
            //'scripts/jquery.validate.min.js',
    ];
    public $jsOptions = array(
            //'position' => \yii\web\View::POS_HEAD
    );

    //public $depends = [
    //    'yii\web\YiiAsset',
    //    'yii\bootstrap\BootstrapAsset',
    //];
}
