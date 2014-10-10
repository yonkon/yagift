<?php

/**
 * This is the model class for table "product_params_composition".
 *
 * The followings are the available columns in table 'product_params_composition':
 * @property integer $product_params_composition_id
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $seo_url
 *
 * The followings are the available model relations:
 * @property ProductParamsCompositionValues[] $productParamsCompositionValues
 */
class ProductParamsComposition extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_params_composition';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_params_composition_id, meta_title, meta_description, meta_keywords, seo_url', 'required'),
			array('product_params_composition_id', 'numerical', 'integerOnly'=>true),
			array('meta_title, seo_url', 'length', 'max'=>256),
			array('meta_description, meta_keywords', 'length', 'max'=>512),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('product_params_composition_id, meta_title, meta_description, meta_keywords, seo_url', 'safe', 'on'=>'search'),
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
			'productParamsCompositionValues' => array(self::HAS_MANY, 'ProductParamsCompositionValues', 'product_params_composition_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'product_params_composition_id' => 'Product Params Composition',
			'meta_title' => 'Meta Title',
			'meta_description' => 'Meta Description',
			'meta_keywords' => 'Meta Keywords',
			'seo_url' => 'Seo Url',
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
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('seo_url',$this->seo_url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductParamsComposition the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
