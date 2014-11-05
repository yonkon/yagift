<?php
/**
 * Created by PhpStorm.
 * User: shikon
 * Date: 05.11.14

 * This is the configuration for generating message translations
 * for the Yii framework. It is used by the 'yiic message' command.
 */
return array(
  'sourcePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'../..',
  'messagePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'messages',
  'languages'=>array('ru'),
  'fileTypes'=>array('php'),
  'overwrite'=>true,
  'exclude'=>array(
    '.git',
    '.idea',
    'yiilite.php',
    'yiit.php',
    '/i18n/data',
    '/blog',
    '/web/js',
    '/protected/gii',
    '/protected/yii',
    '/protected/messages',
    '/protected/extensions/giix-core',
    '/images',
    '/media',
    '/assets',
    '/protected/assets',
    '/protected/vendors',
  ),
);