<?php
/**
 * @var $products Product[]
 */
?>
 <div class="gift-list">
<?php
    foreach($products as $p) {
?>
    <div id="gift_<?php echo $p->product_id;?>" class="gift_div">
        <div class="img_box">
            <img src=<?php echo $p->image;?>>
        </div>
        <p class="gift_name">
            <a href="<?php echo $p->url;?>">
                <?php echo $p->name;?>
            </a>
        </p>
        <p class="gift_price">
            <?php echo empty($p->price) ? Yii::t('product', 'For free') : Yii::t('product', 'From') .' '. $p->price . ' '.  Yii::t('product', 'RUR') ;?>
        </p>
    </div>

<?php } ?>
</div>
<div class="clr">&nbsp;</div>
<div class="pagination">
<?php
// рисуем пейджер
$this->widget('CLinkPager', array(
    'pages' => $pages,
));
?>
</div>