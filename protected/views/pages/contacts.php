<?php
/* @var $this PagesController */
/* @var $meta array */
?>
<h1>
  <?php echo empty($meta['h1']) ?  $this->getPageTitle() : $meta['h1'];?>
</h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>
