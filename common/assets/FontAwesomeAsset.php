<?php

namespace common\assets;

use yii\web\AssetBundle;

/**
 * Class FontAwesomeAsset
 *
 * @package greppi\common\components
 */
class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/fortawesome/font-awesome';
    public $css = [
        'css/font-awesome.css',
    ];
}