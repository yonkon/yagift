<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<form enctype="multipart/form-data" action="<?php echo(Yii::app()->createUrl('site/list')); ?>">
    <div id="filters" class="center">
        <div id="filter-content">
    <?php
    $this->renderPartial('filter');
    ?>
    <input type="submit" name="submit" value="submit">
        </div>
    </div>

</form>
