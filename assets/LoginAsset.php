<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;


class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'static/backend/lib/mdi/css/materialdesignicons.min.css',
        'static/backend/lib/flag-icon-css/css/flag-icon.min.css',
        'static/backend/lib/perfect-scrollbar/css/perfect-scrollbar.css',
        'static/backend/css/style.css',
        'static/backend/css/custom.css'
    ];


    public $js = [
        'static/backend/lib/jquery/dist/jquery.min.js',
        'static/backend/lib/popper.js/dist/umd/popper.min.js',
        'static/backend/lib/bootstrap/dist/js/bootstrap.min.js',
        'static/backend/lib/perfect-scrollbar/dist/perfect-scrollbar.min.js',
        'static/backend/js/misc.js',
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD
    ];
    public $depends = [

    ];
}
