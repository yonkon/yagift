<?php
/**
 * Created by PhpStorm.
 * User: shikon
 * Date: 20.10.14
 * Time: 1:30
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