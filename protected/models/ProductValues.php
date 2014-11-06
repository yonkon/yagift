<?php

/**
 * This is the model class for table "product_values".
 *
 * The followings are the available columns in table 'product_values':
 * @property integer $product_id
 * @property integer $product_params_id
 * @property string $value
 *
 * The followings are the available model relations:
 * @property Product $product
 * @property ProductParams $productParams
 */
class ProductValues extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_values';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, product_params_id', 'required'),
			array('product_id, product_params_id', 'numerical', 'integerOnly'=>true),
			array('value', 'length', 'max'=>512),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('product_id, product_params_id, value', 'safe', 'on'=>'search'),
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
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'productParams' => array(self::BELONGS_TO, 'ProductParams', 'product_params_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'product_id' => 'Product',
			'product_params_id' => 'Product Params',
			'value' => 'Value',
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

		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('product_params_id',$this->product_params_id);
		$criteria->compare('value',$this->value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductValues the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function updateFromParsingResults(Product $product) {
        $allProductOccurencies = ParsingResults::model()->findAllByAttributes(array('name' => $product->name));
        foreach($allProductOccurencies as $pr_row) {
            foreach(self::$integerFields as $int_f) {
                $current_value = self::getByName($product->product_id, $int_f);
                if(!isset($current_value ) || $current_value  < $pr_row->$int_f) {
                    $product->setParam($int_f, $pr_row->$int_f);
                }
            }
            foreach(self::$booleanFields as $bool_f) {
                if($pr_row->$bool_f == 'on') {
                    $product->setParam($bool_f, $pr_row->$bool_f);
                }
            }
           foreach(self::$selectFields as $sel_f) {
               if(!empty($pr_row->$sel_f)) {
                   $product->setParam($sel_f, $pr_row->$sel_f, 'on' );
               }
           }
        }
    }

    public static function getByName($product_id, $name) {
        if(in_array($name, self::$selectFields) ) {
            $params = ProductParams::model()->findAllByAttributes(null, " WHERE param_name LIKE %$name% ");
            $params_ids = array();
            foreach($params as $p) {
                $params_ids[] = $p->product_params_id;
            }
            $values = self::model()->findAllBySql('SELECT param_name, value FROM ' . self::tableName() . ' WHERE product_id = :pr_id AND product_params_id IN (":par_ids")', array('pr_id' => $product_id, 'par_ids' => join(', ', $params_ids) ) );
            $result = array();
            foreach($values as $n => $v) {
                $result[$n] = $v;
            }
            return $result;
        } else {
            $param = ProductParams::model()->findByAttributes(array('param_name' => $name) );
            $value = self::model()->findByAttributes(array('product_params_id' => $param->product_params_id , 'product_id' => $product_id));
            $value = $value->value;
            return $value;
        }
    }

    public static $integerFields = array(
        'Original',
        'Romantic',
        'Useful',
        'ForSoul',
        'Funny',
        'Chic',
        'Smart',
        'Miracle',
    );

    public static $booleanFields = array(
        'Technology',
        'Souvenir',
        'Rest',
        'Game',
        'ForHome',
        'ForOffice',
        'ForGarden',
        'Repair',
        'Hobby',
        'Developmental',
        'ForAuto',
        'ForSport',
        'Beauty',
        'Holiday',
        'Animate',
        'Tasty',
        'Music'
    );

    public static $selectFields = array(
        'for', 'age', 'day', 'gender'
    );

    public static function processFilter($filter) {
        $processed = array();
        foreach($filter as $name => $value) {
            $param = self::filter2value($name, $value);
            if (empty($param['value'])) {
                continue;
            }
            if (!empty($param['param_id'])) {
                $processed[] = $param;
            }
        }
        return $processed;
    }

    public static function filter2value($name, $value) {
        if(!empty($name) && !empty($value)) {
            if(!in_array($name, self::$standaloneParams)) {
                $name = "{$name}[{$value}]";
                $value = 'on';
            }
        }
        $result = array(
            'param' => ProductParams::model()->findByAttributes(array('param_name' => $name) ),
            'value' => $value
        );
        if (!empty($result['param'])) {
            $result['param_id'] = $result['param']['product_params_id'];
        }
        return $result;
    }

    public static $standaloneParams = array(
   'Original', 'Romantic', 'Useful', 'ForSoul', 'Funny', 'Chic', 'Smart', 'Miracle',
        'Technology', 'Souvenir', 'Rest', 'Game', 'ForHome', 'ForOffice', 'ForGarden', 'Repair',
'Hobby', 'Developmental', 'ForAuto', 'ForSport', 'Funny', 'Chic', 'Smart', 'Miracle', 'Beauty',
        'Holiday', 'Animate', 'Tasty', 'Music'
    );

    public static function getFilterCriteria($filter) {
        $criteria = new CDbCriteria();
        if(empty($filter)) {
            return $criteria;
        }
        $result_ids = array();
        $intersect_added = false;
        $merge_added = false;
        $table = ProductValues::tableName();
        foreach ($filter as $field) {
            $par_id = $field['param_id'];
            if (empty ($par_id)) {
                continue;
            }
            $val = $field['value'];
            if(empty($val)) {
                continue;
            }
            if($field['param']['param_type'] == 'number' ) {
                $sql="SELECT product_id FROM $table WHERE product_params_id = $par_id AND value >= $val ";
            } else {
                $sql="SELECT product_id FROM $table WHERE product_params_id = $par_id AND value = '$val' ";
            }
            if(in_array($field['param']['param_type'] , array('number', 'for', 'gender', 'day', 'age', 'button', 'checkbox') )) {
                $param_combine = 'intersect';
            } else {
                $param_combine = 'merge';
            }
            $connection=Yii::app()->db;
            $command=$connection->createCommand($sql);
            $rowCount=$command->execute(); // execute the non-query SQL
            $dataReader=$command->query(); // execute a query SQL
            /**
             * @var CDbDataReader $dataReader
             */
            $field_pids = array();
            $temp_pids = $dataReader->readAll();
            foreach($temp_pids as $pid) {
                $field_pids[] = $pid['product_id'];
            }

            if(!$intersect_added && $param_combine == 'intersect') {
                $result_ids['intersect'] = $field_pids;
                $intersect_added = true;
            } elseif(!$merge_added && $param_combine == 'merge') {
                $result_ids['merge'] = $field_pids;
                $merge_added = true;
            } else  {
                $result_ids[$param_combine] = $param_combine == 'intersect' ?
                    array_intersect($result_ids[$param_combine], $field_pids) :
                    array_unique(array_merge($result_ids[$param_combine], $field_pids));
            }

            if((empty($result_ids['intersect']) && $intersect_added) ) {
                $criteria->condition = ' 1=0 ' ;
                return $criteria;
            }
        }
        if($merge_added) {
            $temp_pids = $result_ids['merge'];
            if($intersect_added) {
                $temp_pids = array_intersect($temp_pids, $result_ids['intersect']);
            }
        } else {
            $temp_pids = $result_ids['intersect'];
        }
        $result_ids = join(', ', $temp_pids);
        $criteria->condition = " product_id IN ($result_ids) ";
      $criteria->addCondition(' status = 1 ');
        return $criteria;
    }
}
