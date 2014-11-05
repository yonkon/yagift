<?php
/**
 * @var SiteController $this
 * @var Product[] $products
 * @var CPagination $pages
 */

//$this->pageTitle=Yii::app()->name;
?>
<div class="w65 float-l">
    <?php
    $this->renderPartial('gift_list', array('products' => $products, 'pages' => $pages));
    ?>
</div>
<div class="w30 float-l filter-side" >
    <?php
    $this->renderPartial('filter_side');
    ?>
</div>