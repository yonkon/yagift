<?php

/**
 * This is the model class for table "product_params".
 *
 * The followings are the available columns in table 'product_params':
 * @property integer $product_params_id
 * @property string $param_name
 * @property string $param_description
 * @property string $param_type
 * @property string $param_default
 * @property integer $param_status
 *
 * The followings are the available model relations:
 * @property ProductParamsCompositionValues[] $productParamsCompositionValues
 * @property ProductParamsEnum[] $productParamsEnums
 * @property ProductValues[] $productValues
 */
class ProductParams extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_params';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('param_name, param_description, param_default', 'required'),
			array('param_status', 'numerical', 'integerOnly'=>true),
			array('param_name', 'length', 'max'=>80),
			array('param_description, param_default', 'length', 'max'=>512),
			array('param_type', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('product_params_id, param_name, param_description, param_type, param_default, param_status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'productParamsCompositionValues' => array(self::HAS_MANY, 'ProductParamsCompositionValues', 'product_params_id'),
			'productParamsEnums' => array(self::HAS_MANY, 'ProductParamsEnum', 'product_params_id'),
			'productValues' => array(self::HAS_MANY, 'ProductValues', 'product_params_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'product_params_id' => 'Product Params',
			'param_name' => 'Param Name',
			'param_description' => 'Param Description',
			'param_type' => 'Param Type',
			'param_default' => 'Param Default',
			'param_status' => 'Param Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('product_params_id',$this->product_params_id);
		$criteria->compare('param_name',$this->param_name,true);
		$criteria->compare('param_description',$this->param_description,true);
		$criteria->compare('param_type',$this->param_type,true);
		$criteria->compare('param_default',$this->param_default,true);
		$criteria->compare('param_status',$this->param_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductParams the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getFiltersGroups() {
        $allParams = self::model()->findAllByAttributes(array('param_status' => 1));
        $groups = array();
        /**
         * @var $p ProductParams
         */
        foreach($allParams as $p) {
            if (in_array($p->param_type, self::$standartTypes ) ) {
                $groups[$p->param_name]['label'] = Yii::t('params', $p->param_description);
                $groups[$p->param_name]['type'] = $p->param_type;
            } else {
                $groups[$p->param_type]['elements'][] = array(
                    'value' => preg_replace('/' . $p->param_type.'\[(.*)\]/', '$1',  $p->param_name),
                    'label' => Yii::t('params', $p->param_description),
                    'name' => $p->param_type == 'select' ? '' : $p->param_name
                    );
            }
        }
       foreach ($groups as $g_name => $g_data) {
           if(empty($g_data['type'])) {
               unset($groups[$g_name]);
           }
       }
        return $groups;
    }

    public static function getFiltersHTMLArray($filterValues = null, $filterGroups = null) {
        $filtersHtml = array();
        if (empty ($filterGroups)) {
            $filterGroups = self::getFiltersGroups();
        }
        $fieldNo = 0;
        foreach ($filterGroups as $g_name => $f_data) {
            $innerHtml = '';
            $innerType = $f_data['type'] == 'select' ? 'option' : $f_data['type'];
            $innerType = $innerType == 'checkbox-group' ? 'checkbox' : $innerType;
            if (!empty ($f_data['elements'])) {
                foreach($f_data['elements'] as $el) {
                    if($innerType == 'option') {
                        $inputGroupParams = array('value' => self::name2value($el['name']));
                    } else {
                        $inputGroupParams = array('name' => $el['name']);
                    }
                    $innerHtml .= self::type2tag($innerType, $fieldNo, $el['label'], $inputGroupParams);
                }
            }
            $groupHtml = '<div id="' .self::trim2identifier($g_name) . '_group" class="filter-group">';
            $groupHtml .= self::type2tag($f_data['type'], $fieldNo, $f_data['label'], array('name' => $g_name, 'html' => $innerHtml));
            $groupHtml .= '</div>';
            $filtersHtml[] = $groupHtml;
        }
        return $filtersHtml;
    }


        public static function getFiltersHTML($filterValues = null, $filterGroups = null) {
            $resultHtml = '';
            $filterArray = self::getFiltersHTMLArray($filterValues, $filterGroups);
            foreach ($filterArray as $f_html) {
                $resultHtml .= $f_html;
            }
            return $resultHtml;
//        $filtersHtml = '';
//        if (empty ($filterGroups)) {
//            $filterGroups = self::getFiltersGroups();
//        }
//        $fieldNo = 0;
//        foreach ($filterGroups as $g_name => $f_data) {
//            $innerHtml = '';
//            $innerType = $f_data['type'] == 'select' ? 'option' : $f_data['type'];
//            $innerType = $innerType == 'checkbox-group' ? 'checkbox' : $innerType;
//            if (!empty ($f_data['elements'])) {
//                foreach($f_data['elements'] as $el) {
//                    if($innerType == 'option') {
//                        $inputGroupParams = array('value' => self::name2value($el['name']));
//                    } else {
//                        $inputGroupParams = array('name' => $el['name']);
//                    }
//                    $innerHtml .= self::type2tag($innerType, $fieldNo, $el['label'], $inputGroupParams);
//                }
//            }
//            $groupHtml = '<div id="' .self::trim2identifier($g_name) . '_group" class="filter-group">';
//            $groupHtml .= self::type2tag($f_data['type'], $fieldNo, $f_data['label'], array('name' => $g_name, 'html' => $innerHtml));
//            $groupHtml .= '</div>';
//            $filtersHtml .= $groupHtml;
//        }
//        return $filtersHtml;
    }


    public static $standartTypes = array(
        'text', 'checkbox', 'checkbox-group', 'radio', 'textarea', 'number', 'email', 'search', 'select', 'option', 'button', 'hidden'
    );

    public static function type2tag($type, &$fieldNo, $label = '', $params=array()) {
        $resultHtml = '';
        if(empty($params['id']) && !empty($params['name'])) {
            $id = preg_replace('/[^\w\d_]/', '_', $params['name']);
        } else {
            $id = !empty($params['id']) ? $params['id'] : 'ai_'.$fieldNo++;
        }
        $params['id'] = $id;
        if($type == 'option') {
            $params['text'] = $label;
            $label = '';
        }
        $labelHtml = '';
        if(!empty($label) && $type != 'hidden') {
            if($type == 'button') {
                $params['text'] = $label;
            } else {
                $labelHtml = '<label for="' . $params['id'] . '">' . htmlentities($label) . '</label>';
            }
        }
        $map = array(
            'hidden'    =>  array('<input type="hidden" '),
            'text'      =>  array('<input type="text" '),
            'checkbox'  =>  array('<input type="checkbox" '),
            'radio'     =>  array('<input type="radio" '),
            'textarea'  =>  array('<textarea ', '</textarea>'),
            'select'    =>  array('<select ', '</select>'),
            'option'    =>  array('<option ', '</option>'),
            'number'    =>  array('<input type="number" '),
            'email'     =>  array('<input type="email" class="input-email" '),
            'search'    =>  array('<input type="email" class="input-search"'),
            'button'    =>  array('<button type="button" ', '</button>'),
            'checkbox-group' => array('<div class="checkbox-group" ', '</div>')
        );
        if (!in_array($type, array_keys($map))) {
            $type = 'text';
        }
        if (count($map[$type]) == 1) {
            $closingTag = '/>';
        } else {
            $closingTag = '>';
        }
        $paramHtml = ' ';
        $text = '';
        if (!empty ($params['text']) ) {
            $text = htmlentities($params['text']);
            unset($params['text']);
        }
        if (!empty ($params['html'])) {
            $text = $params['html'];
            unset($params['html']);
        }
       foreach($params as $key => $val) {
           if (is_integer($key) || empty($key)) {
              $key = $val;
           }
           $paramHtml .= " $key=\"$val\" ";
       }
        $resultHtml = $labelHtml . $map[$type][0] . $paramHtml . $closingTag;
        if(!empty($map[$type][1])) {
            $resultHtml .= $text . $map[$type][1];
        }
        return $resultHtml;

    }

    public static function trim2identifier($str) {
        return preg_replace('/[^\w\d_]/', '_', $str);
    }

    public static function name2value($str) {
        return preg_replace('/.*\[(.*)\]/', '$1', $str);
    }

}
