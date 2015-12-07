<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    /*public $basePath = '@webroot';
    public $baseUrl = '@web';*/
    public $sourcePath = "@webroot";
    public $css = [
        'css/site.css',
    ];
    public $js = [
        /*'js/tinymce/tinymce.min.js',*/
        'js/_guest-book.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'letyii\tinymce\TinymceAssets',
    ];
}
