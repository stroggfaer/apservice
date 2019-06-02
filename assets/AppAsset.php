<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/site.css',
        'js/vendor/carousel/slick.css',
        'js/vendor/fancybox/jquery.fancybox.css',
        'js/vendor/font-awesome/css/font-awesome.min.css',
         'build/fonts/style.css',
         'build/css/style.bundle.css'
    ];
    public $js = [
        'js/vendor/fancybox/jquery.fancybox.js',
        'js/vendor/carousel/slick.min.js',
        'js/vendor/cookie/jquery.cookie.js',
       // '//maps.googleapis.com/maps/api/js',
       // 'js/vendor/map/landcarte.min.js',
        'js/site.js',
        'js/functions.js',
       // 'js/map.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
