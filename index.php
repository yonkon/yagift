<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
$app = Yii::createWebApplication($config);

$app->clientScript->registerCoreScript('jquery', CClientScript::POS_HEAD );
$app->clientScript->registerCoreScript('migrate', CClientScript::POS_HEAD );

$app->clientScript->registerCssFile('/js/ion.RangeSlider/css/ion.rangeSlider.css' );
$app->clientScript->registerCssFile('/js/ion.RangeSlider/css/ion.rangeSlider.skinSimple.css');

if(YII_DEBUG) {
    $app->clientScript->registerScriptFile('/js/ion.RangeSlider/js/ion.rangeSlider.min.js', CClientScript::POS_END);
} else {
    $app->clientScript->registerScriptFile('/js/ion.RangeSlider/js/ion.rangeSlider.min.js', CClientScript::POS_END );
}

//$app->clientScript->registerCssFile('/js/ion.RangeSlider/css/normalize.min.css', CClientScript::POS_HEAD );
$app->clientScript->registerScriptFile('/js/filter.js', CClientScript::POS_END );
$app->language = 'ru';

$app->run();
