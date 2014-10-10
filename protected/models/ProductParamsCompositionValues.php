<?php

/**
 * This is the model class for table "product_params_composition_values".
 *
 * The followings are the available columns in table 'product_params_composition_values':
 * @property integer $product_params_composition_id
 * @property integer $product_params_id
 * @property string $product_param_value
 *
 * The followings are the available model relations:
 * @property ProductParams $productParams
 * @property ProductParamsComposition $productParamsComposition
 */
class ProductParamsCompositionValues extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_params_composition_values';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_params_composition_id, product_params_id, product_param_value', 'required'),
			array('product_params_composition_id, product_params_id', 'numerical', 'integerOnly'=>true),
			array('product_param_value', 'length', 'max'=>512),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('product_params_composition_id, product_params_id, product_param_value', 'safe', 'on'=>'search'),
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
			'productParams' => array(self::BELONGS_TO, 'ProductParams', 'product_params_id'),
			'productParamsComposition' => array(self::BELONGS_TO, 'ProductParamsComposition', 'product_params_composition_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'product_params_composition_id' => 'Product Params Composition',
			'product_params_id' => 'Product Params',
			'product_param_value' => 'Product Param Value',
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

		$criteria->compare('product_params_composition_id',$this->product_params_composition_id);
		$criteria->compare('product_params_id',$this->product_params_id);
		$criteria->compare('product_param_value',$this->product_param_value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductParamsCompositionValues the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
