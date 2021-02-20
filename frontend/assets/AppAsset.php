<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/style.css',
     //   'https://unpkg.com/bootstrap/dist/css/bootstrap.min.css',
    ];
    public $js = [
		'js/popper.js',
		'js/jquery.min.js',
		'js/bootstrap.min.js',
        'js/main.js',
    ];
    public $depends = [
       'yii\web\YiiAsset',
       // 'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
