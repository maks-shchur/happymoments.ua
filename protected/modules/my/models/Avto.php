<?php

/**
 * This is the model class for table "{{avto}}".
 *
 * The followings are the available columns in table '{{avto}}':
 * @property integer $id
 * @property integer $uid
 * @property string $class
 * @property string $title
 * @property string $year
 * @property integer $doors
 * @property integer $seats
 * @property string $color
 * @property string $description
 * @property integer $price
 */
class Avto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{avto}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, class, title, year, doors, seats, color, price', 'required'),
			array('uid, doors, seats, price', 'numerical', 'integerOnly'=>true),
			array('class', 'length', 'max'=>10),
			array('title', 'length', 'max'=>100),
			array('year', 'length', 'max'=>4),
			array('color', 'length', 'max'=>50),
			array('description', 'length', 'max'=>500),
            array('picture', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, uid, class, title, year, doors, seats, color, description, price', 'safe', 'on'=>'search'),
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
            'files' => array(self::HAS_MANY, 'Files', 'portfolio_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uid' => 'Uid',
			'class' => 'Класс автомобиля',
			'title' => 'Название модели',
			'year' => 'Год выпуска',
			'doors' => 'Количество дверей',
			'seats' => 'Количество мест',
			'color' => 'Цвет',
			'description' => 'Дополнительный условия',
			'price' => 'Стоимость за час',
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
		$criteria->compare('uid',$this->uid);
		$criteria->compare('class',$this->class,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('doors',$this->doors);
		$criteria->compare('seats',$this->seats);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('price',$this->price);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Avto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
