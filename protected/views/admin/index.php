<?php
/* @var $this AdminController */

$this->breadcrumbs=array(
	'Admin',
);
/**
 * @var $products Product[]
 */
?>

<div class="pagination">
    <?php
    // рисуем пейджер
    $this->widget('CLinkPager', array(
        'pages' => $pages,
    ));
    ?>
</div>
<div class="clr padding-v-05">&nbsp;</div>
<table class="gift-list w65 float-l">
    <thead>
    <tr>
        <th>
          <?php echo Yii::t('general', 'ID'); ?>
        </th>
        <th>
          <?php echo Yii::t('general', 'Image'); ?>
        </th>
        <th>
          <?php echo Yii::t('general', 'Name'); ?>
        </th>
        <th>
          <?php echo Yii::t('general', 'Price, RUR'); ?>
        </th>
        <th>
          <?php echo Yii::t('general', 'URL'); ?>
        </th>
<!--        <th>-->
<!--          --><?php //echo Yii::t('general', 'Actions'); ?>
<!--        </th>-->
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($products as $p) {
        ?>
        <tr id="gift_<?php echo $p->product_id;?>" class="gift_tr" data-id="<?php echo $p->product_id;?>">
            <td class="gift_id">
              <?php echo $p->product_id; ?>
            </td>
            <td class="img_box min">
                <img src=<?php echo $p->image_min;?>>
            </td>
            <td class="gift_name">
                <input type="text" class="gift_name" name="name"
                       value="<?php echo $p->name;?>"
                       data-initial="<?php echo $p->name;?>"
                    >
            </td>
            <td class="gift_price">
                <input type="text" class="gift_price" name="price"
                       value="<?php echo empty($p->price) ? 0 : $p->price ;?>"
                       data-initial="<?php echo empty($p->price) ? 0 : $p->price ;?>"
                    >
            </td>
            <td class="gift_url">
                <input type="text" class="gift_url" name="url"
                       value="<?php echo $p->url;?>"
                       data-initial="<?php echo $p->url;?>"
                    >
            </td>
<!--            <td class="gift_actions">-->
<!--                <button type="button" class="gift-disable --><?php //if(!$p->isEnabled()) echo 'hidden';?><!--">-->
<!--                  --><?php //echo Yii::t('general', 'Delete'); ?>
<!--                </button>-->
<!--                <button type="button" class="gift-enable --><?php //if($p->isEnabled()) echo 'hidden';?><!--">-->
<!--                  --><?php //echo Yii::t('general', 'Return'); ?>
<!--                </button>-->
<!--            </td>-->
        </tr>

    <?php } ?>
    </tbody>
</table>
<div class="w35 float-r">
    <?php $this->renderPartial('filter_side'); ?>
</div>
<div class="clr padding-v-05">&nbsp;</div>
<div class="pagination">
    <?php
    // рисуем пейджер
    $this->widget('CLinkPager', array(
        'pages' => $pages,
    ));
    ?>
</div>