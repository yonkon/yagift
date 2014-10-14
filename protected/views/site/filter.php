<?php
/**
 * @var $app CApplication
 */
$filterGroups = ProductParams::getFiltersGroups();
$pps = ProductParams::model()->findAll();


?>
<form enctype="multipart/form-data" action="<?php echo(Yii::app()->createUrl('site/list')); ?>">
    <div id="filters" class="center double">
        <div id="filter-content">
<div class="w100">
<!--    <div id="filters" class="center">-->
<!--        <div id="filter-content">-->
    <div class="float-l w50">
        <div class="padding-v-05">
            <label for="day">
                <?php echo Yii::t('filter', $filterGroups['day']['label']); ?>
            </label>
            <div class="clr">&nbsp;</div>
            <select id="day" name="day">
                <?php
                foreach($filterGroups['day']['elements'] as $f) {
                    ?>
                    <option
                        value="<?php echo $f['value'] ;?>"
                        <?php if(!empty($_REQUEST['day']) && $_REQUEST['day'] == $f['value']) echo ' selected="selected" '?>>
                        <?php echo Yii::t('filter', $f['label']); ?>
                    </option>
                <?php
                }
                ?>
            </select>
        </div>
    </div>
    <div class="float-r w50">
        <div class="padding-v-05 ion-range-margin-top">
            <label for="price">
                <?php echo Yii::t('filter', 'Price'); ?>
            </label>
            <input
                type="hidden"
                name="PriceMin"
                <?php if(!empty($_REQUEST['PriceMin'])) echo ' value="' . $_REQUEST['PriceMin'] . '" '?>
                >
            <input
                type="hidden"
                name="PriceMax"
                <?php if(!empty($_REQUEST['PriceMax'])) echo ' value="' . $_REQUEST['PriceMax'] . '" '?>
                >
            <input id="price-slider" type="range">
        </div>
    </div>
    <div class="float-l w50">
        <div class="padding-v-05">
            <label for="for">
                <?php echo Yii::t('filter', 'For'); ?>
            </label>
            <input
                id="gender"
                type="hidden"
                name="gender"
                <?php if(!empty($_REQUEST['gender']) ) echo 'value="'.$_REQUEST['gender'].'" '?>>
            <div>
                <button
                    class="gender-button<?php if(!empty($_REQUEST['gender']) && $_REQUEST['gender'] == 'ForMan') echo ' active '?>"
                    type="button"
                    name="gender[ForMan]">
                    <?php echo Yii::t('filter', 'For man'); ?>
                </button>
                <button
                    class="gender-button<?php if(!empty($_REQUEST['gender']) && $_REQUEST['gender'] == 'ForWoman') echo ' active '?>"
                    type="button"
                    name="gender[ForWoman]">
                    <?php echo Yii::t('filter', 'For woman'); ?>
                </button>
            </div>
        </div>
    </div>
    <div class="float-r w50">
        <div class="padding-v-05">
            <label for="category">
                <?php echo Yii::t('filter', 'Category'); ?>
            </label>
            <div class="two-column-filter">
                <?php
                foreach($filterGroups['category']['elements'] as $f) {
                    ?>
                    <div class="w50">
                        <input id="<?php echo $f['name']; ?>"
                               type="checkbox"
                               name="<?php echo $f['name']; ?>"
                            <?php if(!empty($_REQUEST[$f['name']]) && $_REQUEST[$f['name']] == 'on') echo ' checked="checked" '?>
                               value="on">
                        <label for="<?php echo $f['name']; ?>"><?php echo Yii::t('filter', $f['label']); ?>
                        </label>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="float-l w50">
        <div class="padding-v-05">
            <div class="two-column-filter">
                <?php
                foreach($filterGroups['for']['elements'] as $f) {
                    ?>
                    <div class="w50">
                        <input id="<?php echo $f['name']; ?>"
                               type="radio"
                               name="for"
                            <?php if(!empty($_REQUEST['for']) && $_REQUEST['for'] == $f['value']) echo ' checked="checked" '?>
                               value="<?php echo $f['value']; ?>">
                        <label for="<?php echo $f['name']; ?>">
                            <?php echo Yii::t('filter', $f['label']); ?>
                        </label>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="float-l w50">
        <div class="padding-v-05">
            <label for="age">
                <?php echo Yii::t('filter', $filterGroups['age']['label']); ?>
            </label>
            <div class="clr">&nbsp;</div>
            <select id="age" name="age">
                <?php
                foreach($filterGroups['age']['elements'] as $f) {
                    ?>
                    <option
                        value="<?php echo $f['value'] ;?>"
                        <?php if(!empty($_REQUEST['age']) && $_REQUEST['age'] == $f['value']) echo ' selected="selected" '?>
                        >
                        <?php echo Yii::t('filter', $f['label']); ?>
                    </option>
                <?php
                }
                ?>
            </select>
        </div>

    </div>
    <div class="clr">&nbsp;</div>
    <div class="w100 irs-margin-top">
        <div class="w50 float-l">
            <label for="Original">
                <?php echo Yii::t('filter' , $filterGroups['Original']['label']);?>
            </label>
            <div class="clr">&nbsp;</div>
            <div class="w90">
                <input type="number" id="Original" name="Original"
                       value="<?php echo (!empty($_REQUEST['Original'])) ? $_REQUEST['Original'] : '1';?>"
                    >
            </div>
        </div>
        <div class="w50 float-l">
            <label for="Romantic">
                <?php echo Yii::t('filter' , $filterGroups['Romantic']['label']);?>
            </label>
            <div class="clr">&nbsp;</div>
            <div class="w90">
                <input type="number" id="Romantic" name="Romantic"
                       value="<?php echo (!empty($_REQUEST['Romantic'])) ? $_REQUEST['Romantic'] : '1';?>"
                    >
            </div>
        </div>
    </div>
    <?php
//        echo ProductParams::getFiltersHTML();
        ?>
<!--        </div>-->
<!--    </div>-->
</div>
            <div class="clr">&nbsp;</div>
            <input type="submit" name="submit" value="submit">
        </div>
    </div>
</form>