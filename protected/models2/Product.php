<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property string $name
 * @property string $price
 * @property string $image
 * @property string $day
 * @property string $gender
 * @property string $for
 * @property string $age
 * @property integer $Original
 * @property integer $Romantic
 * @property integer $Useful
 * @property integer $ForSoul
 * @property integer $Funny
 * @property integer $Chic
 * @property integer $Smart
 * @property integer $Miracle
 * @property integer $Technology
 * @property integer $Souvenir
 * @property integer $Rest
 * @property integer $Game
 * @property integer $ForHome
 * @property integer $ForOffice
 * @property integer $ForGarden
 * @property integer $Repair
 * @property integer $Hobby
 * @property integer $Developmental
 * @property integer $ForAuto
 * @property integer $ForSport
 * @property integer $Beauty
 * @property integer $Holiday
 * @property integer $Animate
 * @property integer $Tasty
 * @property integer $Music
 * @property integer $ListNumber
 * @property string $url
 */
class Product2 extends CActiveRecord
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
			array('id, name, image, day, gender, for, age, Original, Romantic, Useful, ForSoul, Funny, Chic, Smart, Miracle, Technology, Souvenir, Rest, Game, ForHome, ForOffice, ForGarden, Repair, Hobby, Developmental, ForAuto, ForSport, Beauty, Holiday, Animate, Tasty, Music, url', 'required'),
			array('id, Original, Romantic, Useful, ForSoul, Funny, Chic, Smart, Miracle, Technology, Souvenir, Rest, Game, ForHome, ForOffice, ForGarden, Repair, Hobby, Developmental, ForAuto, ForSport, Beauty, Holiday, Animate, Tasty, Music, ListNumber', 'numerical', 'integerOnly'=>true),
			array('name, url', 'length', 'max'=>256),
			array('price', 'length', 'max'=>16),
			array('image', 'length', 'max'=>512),
			array('day, gender, for, age', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, price, image, day, gender, for, age, Original, Romantic, Useful, ForSoul, Funny, Chic, Smart, Miracle, Technology, Souvenir, Rest, Game, ForHome, ForOffice, ForGarden, Repair, Hobby, Developmental, ForAuto, ForSport, Beauty, Holiday, Animate, Tasty, Music, ListNumber, url', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'price' => 'Price',
			'image' => 'Image',
			'day' => 'Day',
			'gender' => 'Gender',
			'for' => 'For',
			'age' => 'Age',
			'Original' => 'Original',
			'Romantic' => 'Romantic',
			'Useful' => 'Useful',
			'ForSoul' => 'For Soul',
			'Funny' => 'Funny',
			'Chic' => 'Chic',
			'Smart' => 'Smart',
			'Miracle' => 'Miracle',
			'Technology' => 'Technology',
			'Souvenir' => 'Souvenir',
			'Rest' => 'Rest',
			'Game' => 'Game',
			'ForHome' => 'For Home',
			'ForOffice' => 'For Office',
			'ForGarden' => 'For Garden',
			'Repair' => 'Repair',
			'Hobby' => 'Hobby',
			'Developmental' => 'Developmental',
			'ForAuto' => 'For Auto',
			'ForSport' => 'For Sport',
			'Beauty' => 'Beauty',
			'Holiday' => 'Holiday',
			'Animate' => 'Animate',
			'Tasty' => 'Tasty',
			'Music' => 'Music',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('day',$this->day,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('for',$this->for,true);
		$criteria->compare('age',$this->age,true);
		$criteria->compare('Original',$this->Original);
		$criteria->compare('Romantic',$this->Romantic);
		$criteria->compare('Useful',$this->Useful);
		$criteria->compare('ForSoul',$this->ForSoul);
		$criteria->compare('Funny',$this->Funny);
		$criteria->compare('Chic',$this->Chic);
		$criteria->compare('Smart',$this->Smart);
		$criteria->compare('Miracle',$this->Miracle);
		$criteria->compare('Technology',$this->Technology);
		$criteria->compare('Souvenir',$this->Souvenir);
		$criteria->compare('Rest',$this->Rest);
		$criteria->compare('Game',$this->Game);
		$criteria->compare('ForHome',$this->ForHome);
		$criteria->compare('ForOffice',$this->ForOffice);
		$criteria->compare('ForGarden',$this->ForGarden);
		$criteria->compare('Repair',$this->Repair);
		$criteria->compare('Hobby',$this->Hobby);
		$criteria->compare('Developmental',$this->Developmental);
		$criteria->compare('ForAuto',$this->ForAuto);
		$criteria->compare('ForSport',$this->ForSport);
		$criteria->compare('Beauty',$this->Beauty);
		$criteria->compare('Holiday',$this->Holiday);
		$criteria->compare('Animate',$this->Animate);
		$criteria->compare('Tasty',$this->Tasty);
		$criteria->compare('Music',$this->Music);
		$criteria->compare('ListNumber',$this->ListNumber);
		$criteria->compare('url',$this->url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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

    /**
    * @var ParsingResults[] $products - Products without params
     * @return array|bool Return true if all products imported, array of skipped products otherwise
     */
    public static function fromParsingResults() {
        $products = ParsingResults::model()->findAllBySql('SELECT * FROM ' . ParsingResults::model()->tableName() . " WHERE `day`='' AND `gender`='' AND `for`='' AND `age`='' AND `Original`=0 AND `Romantic`=0 AND `Useful`=0 AND `ForSoul`=0 AND `Funny`=0 AND `Chic`=0 AND `Smart`=0 AND `Miracle`=0 AND `Technology`='' AND `Souvenir`='' AND `Rest`='' AND `Game`='' AND `ForHome`='' AND `ForOffice`='' AND `ForGarden`='' AND `Repair`='' AND `Hobby`='' AND `Developmental`='' AND `ForAuto`='' AND `ForSport`='' AND `Beauty`='' AND `Holiday`='' AND `Animate`='' AND `Tasty`='' AND `Music`='' GROUP BY `name` ");
        $skippedResults = array();
        foreach ($products as $product) {
            $newProduct = Product::formParsingResult($product);
            if (!$newProduct) {
                $skippedResults[] = $product;
                continue;
            }
            $allProductRowsInParsingResults = ParsingResults::model()->findAllByAttributes(array('name' => $newProduct));
            foreach($allProductRowsInParsingResults as $pr_row) {
                foreach(Product::$integerFields as $int_f) {
                    if($newProduct->$int_f < $pr_row->$int_f) {
                        $newProduct->$int_f = $pr_row->$int_f;
                    }
                }
                foreach(Product::$booleanFields as $bool_f) {
                    if($pr_row->$bool_f == 'on') {
                        $newProduct->$bool_f = true;
                    }
                }
            }
        }
        return (empty($skippedResults)? true : $skippedResults);
    }

    public static function formParsingResult(ParsingResults $parsingResult) {
        $newProduct = new Product();
        $newProduct->setAttributes($parsingResult->getAttributes(), false);
        if($newProduct->validate()) {
            return $newProduct;
        }
        return false;
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


}
