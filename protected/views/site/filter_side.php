<?php
/**
 * @var $app CApplication
 */
$filterGroups = ProductParams::getFiltersGroups();
$pps = ProductParams::model()->findAll();


?>
<form enctype="multipart/form-data" action="<?php echo(Yii::app()->createUrl('site/list')); ?>">
    <div id="filters" class="center">
        <div id="filter-content">
<div class="w100">
<!--    <div id="filters" class="center">-->
<!--        <div id="filter-content">-->
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
    <div class="padding-v-05">
        <label for="for">
            <?php echo Yii::t('filter', 'For'); ?>
        </label>
      <?php if(empty($_REQUEST['gender']) ) $_REQUEST['gender'] = 'ForWoman';?>
        <input
            id="gender"
            type="hidden"
            name="gender"
            value="<?php if(!empty($_REQUEST['gender']) ) echo $_REQUEST['gender']?>">
        <div>
            <button
                class="gender-button ForMan<?php if(!empty($_REQUEST['gender']) && $_REQUEST['gender'] == 'ForMan') echo ' active '?>"
                type="button"
                name="gender[ForMan]">
                <?php echo Yii::t('filter', 'For man'); ?>
            </button>
            <button
                class="gender-button ForWoman<?php if(!empty($_REQUEST['gender']) && $_REQUEST['gender'] == 'ForWoman') echo ' active '?>"
                type="button"
                name="gender[ForWoman]">
                <?php echo Yii::t('filter', 'For woman'); ?>
            </button>
        </div>
    </div>
    <div class="padding-v-05">
        <div class="two-column-filter">
          <?php if(empty($_REQUEST['for']) ) $_REQUEST['for'] = 'ForLover';?>
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
                      <?php echo Yii::t('filter', trim($f['label'] . ' ' . $filterGroups['gender[' . $_REQUEST['gender'] . ']']['label']) ); ?>

<!--                      --><?php //echo Yii::t('filter', $f['label']); ?>
                    </label>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
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


    <div class="padding-v-05">
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
    <div class="clr">&nbsp;</div>
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
    <div class="clr">&nbsp;</div>
    <div class="padding-v-05 irs-margin-top">
        <div class="clr">
            <label class="w30 float-l" for="Romantic">
                <?php echo Yii::t('filter' , $filterGroups['Romantic']['label']);?>
            </label>
            <div class="w70 float-l">
                <input
                    type="number"
                    id="Romantic"
                    name="Romantic"
                    value="<?php echo (!empty($_REQUEST['Romantic'])) ? $_REQUEST['Romantic'] : '1';?>"
                    >
            </div>
        </div>
        <div class="clr">
            <label class="w30 float-l" for="Original">
                <?php echo Yii::t('filter' , $filterGroups['Original']['label']);?>
            </label>
            <div class="w70 float-l">
                <input type="number" id="Original" name="Original"
                       value="<?php echo (!empty($_REQUEST['Original'])) ? $_REQUEST['Original'] : '1';?>"
                    >
            </div>
        </div>
        <div class="clr">
            <label class="w30 float-l" for="Useful">
                <?php echo Yii::t('filter' , $filterGroups['Useful']['label']);?>
            </label>
            <div class="w70 float-l">
                <input
                    type="number"
                    id="Useful"
                    name="Useful"
                    value="<?php echo (empty($_REQUEST['Useful'])) ? '1' :$_REQUEST['Useful'] ;?>"
                    >
            </div>
        </div>
        <div class="clr">
            <label class="w30 float-l" for="ForSoul">
                <?php echo Yii::t('filter' , $filterGroups['ForSoul']['label']);?>
            </label>
            <div class="w70 float-l">
                <input type="number" id="ForSoul" name="ForSoul"
                       value="<?php echo (empty($_REQUEST['ForSoul'])) ? '1' :$_REQUEST['ForSoul'] ;?>"
                    >
            </div>
        </div>
        <div class="clr">
            <label class="w30 float-l" for="Funny">
                <?php echo Yii::t('filter' , $filterGroups['Funny']['label']);?>
            </label>
            <div class="w70 float-l">
                <input type="number" id="Funny" name="Funny"
                       value="<?php echo (empty($_REQUEST['Funny'])) ? '1' :$_REQUEST['Funny'] ;?>"
                    >
            </div>
        </div>
        <div class="clr">
            <label class="w30 float-l" for="Chic">
                <?php echo Yii::t('filter' , $filterGroups['Chic']['label']);?>
            </label>
            <div class="w70 float-l">
                <input type="number" id="Chic" name="Chic"
                       value="<?php echo (empty($_REQUEST['Chic'])) ? '1' :$_REQUEST['Chic'] ;?>"
                    >
            </div>
        </div>
        <div class="clr">
            <label class="w30 float-l" for="Smart">
                <?php echo Yii::t('filter' , $filterGroups['Smart']['label']);?>
            </label>
            <div class="w70 float-l">
                <input type="number" id="Smart" name="Smart"
                       value="<?php echo (empty($_REQUEST['Smart'])) ? '1' :$_REQUEST['Smart'] ;?>"                    >
            </div>
        </div>
        <div class="clr">
            <label class="w30 float-l" for="Miracle">
                <?php echo Yii::t('filter' , $filterGroups['Miracle']['label']);?>
            </label>
            <div class="w70 float-l">
                <input type="number" id="Miracle" name="Miracle"
                       value="<?php echo (empty($_REQUEST['Miracle'])) ? '1' :$_REQUEST['Miracle'] ;?>"
                    >
            </div>
        </div>
    </div>

<div class="padding-v-05">
    <div class="two-column-filter">
            <div class="w50 float-l">
                <input id="Animate"
                       type="checkbox"
                       name="Animate"
                       value="on"
                    <?php if(!empty($_REQUEST['Animate'])) echo ' checked="checked" '?>
                    >
                <label for="Animate"><?php echo Yii::t('filter', 'Animate')?>
                </label>
            </div>
        <div class="w50 float-l">
            <input id="Tasty"
                   type="checkbox"
                   name="Tasty"
                   value="on"
                <?php if(!empty($_REQUEST['Tasty'])) echo ' checked="checked" '?>
                >
            <label for="Tasty"><?php echo Yii::t('filter', 'Tasty')?>
            </label>
        </div>
        <div class="w50 float-l">
            <input id="Music"
                   type="checkbox"
                   name="Music"
                   value="on"
                <?php if(!empty($_REQUEST['Music'])) echo ' checked="checked" '?>
                >
            <label for="Music"><?php echo Yii::t('filter', 'Music')?>
            </label>
        </div>
    </div>
</div>
    <?php
//        echo ProductParams::getFiltersHTML();
        ?>
<!--        </div>-->
<!--    </div>-->
</div>
            <div class="clr padding-v-05">&nbsp;</div>
            <input type="submit" name="submit"
                   value="<?php echo Yii::t('filter', 'submit')?>"
              >
        </div>
    </div>
</form>
<script type="text/javascript">
<?php echo Yii::t('filter', 'js_lang_for' ); ?>
  $('.gender-button').click(function(){
    var $this = $(this);
    var gender = '';
    if($this.hasClass('ForMan')) {
      gender = 'man';
    } else {
      gender = 'woman';
    }
    var labels = lang_for[gender];
    for(l in labels) {
      if(labels.hasOwnProperty(l)) {
        var labelSeector = 'label[for="for[' + l + ']"]';
        var $label = $(labelSeector);
        $label.text(labels[l]);
      }
    }
  });
</script>