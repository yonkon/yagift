<?php
/**
 * @var $products Product[]
 */
foreach($products as $p) {
?>
<div id="gift_<?php echo $p->product_id;?>" class="gift_div">
<img src=<?php echo $p->image;?>>
<p><a href="<?php echo $p->url;?>"><?php echo $p->name;?></a></p>
<p><?php echo empty($p->price) ? Yii::t('product', 'For free') : Yii::t('product', 'From') . $p->price . Yii::t('product', 'RUR') ;?></p>
</div>
<?php
}
// рисуем пейджер
$this->widget('CLinkPager', array(
    'pages' => $pages,
));
?>