<?php

namespace frontend\assets;


class TinymceAssets extends \yii\web\AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $js = [
	];
	public $depends = [
		'yii\web\JqueryAsset',
	];
}
