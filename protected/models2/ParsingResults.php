<?php

/**
 * This is the model class for table "parsing_results".
 *
 * The followings are the available columns in table 'parsing_results':
 * @property integer $id
 * @property string $name
 * @property string $price
 * @property string $image
 * @property string $day
 * @property string $gender
 * @property string $for
 * @property string $age
 * @property integer $Price_min
 * @property integer $Price_max
 * @property integer $Original
 * @property integer $Romantic
 * @property integer $Useful
 * @property integer $ForSoul
 * @property integer $Funny
 * @property integer $Chic
 * @property integer $Smart
 * @property integer $Miracle
 * @property string $Technology
 * @property string $Souvenir
 * @property string $Rest
 * @property string $Game
 * @property string $ForHome
 * @property string $ForOffice
 * @property string $ForGarden
 * @property string $Repair
 * @property string $Hobby
 * @property string $Developmental
 * @property string $ForAuto
 * @property string $ForSport
 * @property string $Beauty
 * @property string $Holiday
 * @property string $Animate
 * @property string $Tasty
 * @property string $Music
 * @property integer $p
 */
class ParsingResults extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'parsing_results';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, image, day, gender, for, age, Original, Romantic, Useful, ForSoul, Funny, Chic, Smart, Miracle, Technology, Souvenir, Rest, Game, ForHome, ForOffice, ForGarden, Repair, Hobby, Developmental, ForAuto, ForSport, Beauty, Holiday, Animate, Tasty, Music', 'required'),
			array('Price_min, Price_max, Original, Romantic, Useful, ForSoul, Funny, Chic, Smart, Miracle, p', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>256),
			array('price', 'length', 'max'=>16),
			array('image', 'length', 'max'=>512),
			array('day, gender, for, age', 'length', 'max'=>32),
			array('Technology, Souvenir, Rest, Game, ForHome, ForOffice, ForGarden, Repair, Hobby, Developmental, ForAuto, ForSport, Beauty, Holiday, Animate, Tasty, Music', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, price, image, day, gender, for, age, Price_min, Price_max, Original, Romantic, Useful, ForSoul, Funny, Chic, Smart, Miracle, Technology, Souvenir, Rest, Game, ForHome, ForOffice, ForGarden, Repair, Hobby, Developmental, ForAuto, ForSport, Beauty, Holiday, Animate, Tasty, Music, p', 'safe', 'on'=>'search'),
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
			'Price_min' => 'Price Min',
			'Price_max' => 'Price Max',
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
			'p' => 'P',
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
		$criteria->compare('Price_min',$this->Price_min);
		$criteria->compare('Price_max',$this->Price_max);
		$criteria->compare('Original',$this->Original);
		$criteria->compare('Romantic',$this->Romantic);
		$criteria->compare('Useful',$this->Useful);
		$criteria->compare('ForSoul',$this->ForSoul);
		$criteria->compare('Funny',$this->Funny);
		$criteria->compare('Chic',$this->Chic);
		$criteria->compare('Smart',$this->Smart);
		$criteria->compare('Miracle',$this->Miracle);
		$criteria->compare('Technology',$this->Technology,true);
		$criteria->compare('Souvenir',$this->Souvenir,true);
		$criteria->compare('Rest',$this->Rest,true);
		$criteria->compare('Game',$this->Game,true);
		$criteria->compare('ForHome',$this->ForHome,true);
		$criteria->compare('ForOffice',$this->ForOffice,true);
		$criteria->compare('ForGarden',$this->ForGarden,true);
		$criteria->compare('Repair',$this->Repair,true);
		$criteria->compare('Hobby',$this->Hobby,true);
		$criteria->compare('Developmental',$this->Developmental,true);
		$criteria->compare('ForAuto',$this->ForAuto,true);
		$criteria->compare('ForSport',$this->ForSport,true);
		$criteria->compare('Beauty',$this->Beauty,true);
		$criteria->compare('Holiday',$this->Holiday,true);
		$criteria->compare('Animate',$this->Animate,true);
		$criteria->compare('Tasty',$this->Tasty,true);
		$criteria->compare('Music',$this->Music,true);
		$criteria->compare('p',$this->p);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ParsingResults the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    

}
