<?php

/**
 * This is the model class for table "{{tenders}}".
 *
 * The followings are the available columns in table '{{tenders}}':
 * @property integer $id
 * @property integer $uid
 * @property string $title
 * @property string $date_end
 * @property string $city
 * @property integer $price
 * @property string $description
 * @property string $phone
 * @property string $phone2
 * @property string $phone3
 * @property string $email
 */
class Tenders extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{tenders}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, occupation, date_end, city, price, description, phone, email', 'required'),
			array('uid, price, occupation', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>255),
            array('description', 'length', 'min'=>10),
			array('phone, phone2, phone3', 'length', 'max'=>17),
            array('genre','safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, uid, occupation, genre, date_end, city, price, description, phone, phone2, phone3, email', 'safe', 'on'=>'search'),
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
            'user' => array(self::BELONGS_TO, 'Users', 'uid'),
            'orders' => array(self::HAS_MANY, 'TenderOrders', 'tender_id'),
            'ordersCount'=>array(self::STAT, 'TenderOrders', 'tender_id', 'select'=>'count(*)'),
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
			'occupation' => 'Кого Вы ищете',
            'genre' => 'Укажите жанр',
			'date_end' => 'Дата<br>мероприятия',
			'city' => 'Город',
			'price' => 'Стоимость',
			'description' => 'Описание тендера',
			'phone' => 'Телефон',
			'phone2' => 'Дополнительный<br>телефон',
			'phone3' => 'Дополнительный<br>телефон',
			'email' => 'E-mail',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('date_end',$this->date_end,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('phone2',$this->phone2,true);
		$criteria->compare('phone3',$this->phone3,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tenders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
            $this->genre=serialize($this->genre);    
            return true;
        }
        else
            return false;
    }
}
