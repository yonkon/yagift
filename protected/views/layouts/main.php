<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

  <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" />


	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div id="page">

	<div id="header">
    <a class="w65 float-l" href="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->request->baseUrl);?>"><img id="main_logo" src="/css/logo.png"></a>
    <div class="filter-header" >
<!--    <div class="float-r" style="width: 41%;">-->
      <span >СЕРВИС ВЫБОРА ПОДАРКОВ</span>
<!--      <span class="filter-header">СЕРВИС ВЫБОРА ПОДАРКОВ</span>-->
    </div>
	<!--	<div class="span-10" id="logo"><?php /*echo CHtml::encode(Yii::app()->name); */?></div>
        <div class="span-10" id="search">
            <form action="<?php /*echo (Yii::app()->createUrl('product/search')); */?>">
                <input class="input no-margin" style="padding-right: 5em;" type="search" name="search"/>
                <input class="input no-margin" style="margin-left: -5em;" type="submit" name="submit" value="submit"/>
            </form>
        </div>-->
	</div><!-- header -->

<!--	<div id="mainmenu">-->
<!--		--><?php //$this->widget('zii.widgets.CMenu',array(
//			'items'=>array(
//				array('label'=>'Home', 'url'=>array('/site/index')),
//				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
//				array('label'=>'Contact', 'url'=>array('/site/contact')),
//				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
//				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
//			),
//		)); ?>
<!--	</div><!-- mainmenu -->
<!--	--><?php //if(isset($this->breadcrumbs)):?>
<!--		--><?php //$this->widget('zii.widgets.CBreadcrumbs', array(
//			'links'=>$this->breadcrumbs,
//		)); ?><!--<!-- breadcrumbs -->
<!--	--><?php //endif?>

	<?php echo $content; ?>

	<div class="clr padding-v-2"></div>
	<div id="footer">
    <div class="footer-links">
      <a
        href="<?php echo Yii::app()->createAbsoluteUrl('/');?>">
        <?php echo Yii::t('footer','Main page');?>
      </a>
      <a
        href="<?php echo Yii::app()->createUrl('pages/help');?>">
        <?php echo Yii::t('footer','Site help');?>
      </a>
      <a
        href="<?php echo Yii::app()->createUrl('pages/payment');?>">
        <?php echo Yii::t('footer','Payment/Shipping');?>
      </a>
      <a
        href="<?php echo Yii::app()->createUrl('pages/contacts');?>">
        <?php echo Yii::t('footer','Contacts');?>
      </a>
    </div>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
