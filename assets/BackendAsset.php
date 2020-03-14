<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;


class BackendAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'static/backend/lib/mdi/css/materialdesignicons.min.css',
        'static/backend/lib/flag-icon-css/css/flag-icon.min.css',
        'static/backend/lib/perfect-scrollbar/css/perfect-scrollbar.css',
        'static/backend/lib/fonticonpicker/css/jquery.fonticonpicker.css',
        'static/backend/lib/font-awesome/css/font-awesome.min.css',
        'static/backend/lib/jquery-tags-input/dist/jquery.tagsinput.min.css',
        'static/backend/lib/jquery-toast-plugin/dist/jquery.toast.min.css',
        'static/backend/lib/codemirror/lib/codemirror.css',
        'static/backend/lib/codemirror/theme/midnight.css',
        'static/backend/lib/kindeditor/themes/default/default.css',
        'static/backend/css/style.css',
        'static/backend/lib/fonticonpicker/themes/grey-theme/jquery.fonticonpicker.grey.min.css',
        'static/backend/lib/spectrum/spectrum.css',
        'static/backend/css/custom.css'
    ];


    public $js = [
        'static/backend/lib/jquery/dist/jquery.min.js',
        'static/backend/lib/popper.js/dist/umd/popper.min.js',
        'static/backend/lib/bootstrap/dist/js/bootstrap.min.js',
        'static/backend/lib/perfect-scrollbar/dist/perfect-scrollbar.min.js',
        'static/backend/js/misc.js',
        'static/backend/js/settings.js',
        'static/backend/lib/colresizable/colResizable-1.6.js',
        'static/backend/lib/jquery-tags-input/dist/jquery.tagsinput.min.js',
        'static/backend/lib/jquery-validation/dist/jquery.validate.min.js',
        'static/backend/lib/jquery-toast-plugin/dist/jquery.toast.min.js',
        'static/backend/lib/codemirror/lib/codemirror.js',
        'static/backend/lib/codemirror/mode/javascript/javascript.js',
        'static/backend/lib/sweetalert/dist/sweetalert.min.js',
        'static/backend/lib/kindeditor/kindeditor-all-min.js',
        'static/backend/lib/kindeditor/lang/zh-CN.js',
        'static/backend/lib/fonticonpicker/jquery.fonticonpicker.js',
        'static/backend/lib/bootstrap-input-spinner/bootstrap-input-spinner.js',
        'static/backend/lib/spectrum/spectrum.js',
        'static/backend/lib/spectrum/jquery.spectrum-zh-cn.js',
        'static/backend/js/custom.js'

    ];

    public $jsOptions = [
        'position' => View::POS_HEAD
    ];
    public $depends = [

    ];
}
