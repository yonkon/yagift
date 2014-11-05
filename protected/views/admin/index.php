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
    /**
     * @var $pages CPagination
     */
    // рисуем пейджер
    $this->widget('giftokPager', array(
        'pages' => $pages,
    ));
    $ps20_class = $ps50_class = $ps100_class = 'pageSize-button ';
    $ps20_class     .= $pages->pageSize == 20   ? 'active' : '';
    $ps50_class     .= $pages->pageSize == 50   ? 'active' : '';
    $ps100_class    .= $pages->pageSize == 100  ? 'active' : '';
    $pageSizeLabel = Yii::t('general', 'Items per page');
    echo "<div class='padding-v-05'>
    <form>
    <span>{$pageSizeLabel}</span>
    <input type='hidden' name='pageSize' value='{$pages->pageSize}'>
    <button class='{$ps20_class}' onclick='setPageSize(20);'>20</button>
    <button class='{$ps50_class}' onclick='setPageSize(50);'>50</button>
    <button class='{$ps100_class}' onclick='setPageSize(100);'>100</button>
    </form>
    </div>";
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
        <th>
          <?php echo Yii::t('general', 'Actions'); ?>
        </th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($products as $p) {
        ?>
        <tr id="gift_<?php echo $p->product_id;?>" class="gift_tr <?php if(!$p->isEnabled()) echo 'disabled-product';?>" data-id="<?php echo $p->product_id;?>">
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
            <td class="gift_actions">
                <button type="button" data-action="disable" class="gift-disable <?php if(!$p->isEnabled()) echo 'hidden';?>">
                  <?php echo Yii::t('general', 'Delete'); ?>
                </button>
                <button type="button" data-action="enable" class="gift-enable <?php if($p->isEnabled()) echo 'hidden';?>">
                  <?php echo Yii::t('general', 'Return'); ?>
                </button>
            </td>
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
    $this->widget('giftokPager', array(
        'pages' => $pages,
    ));
    ?>
</div>
<a href="#" class="scrollup">Вверх</a>

<form id="gift_name_form">
    <div id="gift_name_div">
        <input id="gift_name_input" class="w60" type="search" name="name"
               value="<?php echo !empty($_REQUEST['name'])? $_REQUEST['name']: ''?>"
               placeholder="<?php echo Yii::t('admin', 'Search by product name');?>"
            >
        <input id="gift_name_submit" class="w35" type="submit" value="<?php echo Yii::t('general', 'Search');?>">
<!--        <label for="gift_name_submit"> --><?php //echo Yii::t('general', 'Search');?><!--</label>-->
    </div>
</form>
