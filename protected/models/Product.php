<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $product_id
 * @property string $name
 * @property string $price
 * @property string $image
 * @property integer $ListNumber
 * @property string $url
 *
 * The followings are the available model relations:
 * @property ProductValues[] $productValues
 */
class Product extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, image', 'required'),
			array('ListNumber', 'numerical', 'integerOnly'=>true),
			array('name, url', 'length', 'max'=>256),
			array('price', 'length', 'max'=>16),
			array('image', 'length', 'max'=>512),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('product_id, name, price, image, ListNumber', 'safe', 'on'=>'search'),
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
			'productValues' => array(self::HAS_MANY, 'ProductValues', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'product_id' => 'Product',
			'name' => 'Name',
			'price' => 'Price',
			'image' => 'Image',
			'ListNumber' => 'List Number',
			'url' => 'Url',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('ListNumber',$this->ListNumber);
		$criteria->compare('url',$this->url,true);

		return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'pagination'=>array(
                    'pageSize'=>self::$defaults['page_size'],
                ),
                'sort' => array (
                    'defaultOrder' => 'ListNumber ASC'
                )
            )
        );
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /* CUSTOM LOGIC */
    /**
     * @var ParsingResults[] $products - Products without params
     * @return array|bool Return true if all products imported, array of skipped products otherwise
     */
    public static function fromParsingResults() {
        $products = ParsingResults::selectProductsWithoutFilters();
        $skippedResults = array();
        $listNumber = 1;
        foreach ($products as $product) {
            $newProduct = Product::formParsingResult($product, null, $listNumber++);
            if (!$newProduct) {
                $skippedResults[] = $product;
                continue;
            }

            ProductValues::updateFromParsingResults($newProduct);
        }
        return (empty($skippedResults)? true : $skippedResults);
    }

    /**
     * @param ParsingResults $parsingResult
     * @param null $product_id
     * @return bool|null|Product
     */
    public static function formParsingResult(ParsingResults $parsingResult, $product_id = null, $listNumber = null) {
        if($product_id == null) {
            $newProduct = new Product();
        } else {
            $newProduct = self::model()->findByPk($product_id);
            if(empty ($newProduct)) {
                $newProduct = new Product();
                $newProduct->product_id = $product_id;
            }
        }
        if($listNumber)
            $newProduct->ListNumber = $listNumber;
        $parsingResultAttributes = $parsingResult->getAttributes();
        $newProduct->setAttributes($parsingResultAttributes , false);
        if($newProduct->validate()) {
            $newProduct->save();
            foreach ($parsingResultAttributes as $attr => $val) {
                $newProduct->setParam($attr, $val);
            }
            return $newProduct;
        }
        return false;
    }

    public function setParam($name, $value, $additional = null) {
        if(in_array($name, ProductValues::$selectFields) ) {
            if(empty($value)) {
                return true;
            }
            $name = "{$name}[{$value}]";
            if($additional == null) {
                $value = 'on';
            } else {
                $value = $additional;
            }
        }
        $product_param = ProductParams::model()->findByAttributes(array('param_name' => $name));
        if(empty($product_param)) {
            return false;
        }
        $pv = ProductValues::model()->findByAttributes(array('product_id' => $this->product_id, 'product_params_id' => $product_param['product_params_id']));
        if(empty($pv)) {
            $pv = new ProductValues();
        }
        $pv->product_id = $this->product_id;
        $pv->product_params_id = $product_param['product_params_id'];
        $pv->value = $value;
        return ($pv->validate() && $pv->save());
    }


    public static $defaults = array (
        'page_size' => 20
    );
}
