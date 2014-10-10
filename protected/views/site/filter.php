<?php
/**
 *
 */
?>
<form
        <?php
        $pps = ProductParams::model()->findAll();
        echo ProductParams::getFiltersHTML();

        ?>
