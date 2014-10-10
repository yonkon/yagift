<?php
/**
 * @var SiteController $this
 * @var Product[] $products
 * @var CPagination $pages
 */

$this->pageTitle=Yii::app()->name;
$this->renderPartial('filter');
$this->renderPartial('gift_list', array('products' => $products, 'pages' => $pages));
