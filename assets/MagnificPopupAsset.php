<?php

namespace app\assets;

use yii\web\AssetBundle;

class MagnificPopupAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/magnific-popup.css',
    ];
    public $cssOptions = [
        'type' => 'text/css',
    ];
    public $js = [
        'js/jquery.magnific-popup.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}