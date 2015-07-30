<?php

/**
 * This is the model class for table "{{trnders}}".
 *
 * The followings are the available columns in table '{{orders}}':
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
class Orders extends CActiveRecord
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
			array('uid, phone', 'required'),
            array('uid, occupation, genre, date_end, city, price, description, phone, email', 'required', 'on'=>'update'),
			array('uid, price, occupation', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>255),
            array('description', 'length', 'min'=>10),
			array('phone, phone2, phone3', 'length', 'max'=>17),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, uid, occupation, genre, date_end, date_create, city, price, description, phone, phone2, phone3, email', 'safe', 'on'=>'search'),
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
            'cities' => array(self::BELONGS_TO, 'City', 'city'),
            'orders' => array(self::HAS_MANY, 'TenderOrders', 'tender_id', 'order'=>'orders.date_ans DESC'),
            'ordersCount'=>array(self::STAT, 'TenderOrders', 'tender_id', 'select'=>'count(*)',),
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
			'date_end' => 'Дата окончания<br>тендера',
			'city' => 'Город',
			'price' => 'Стоимость',
			'description' => 'Описание тендера',
			'phone' => 'Телефон',
			'phone2' => 'Дополнительный<br>телефон',
			'phone3' => 'Дополнительный<br>телефон',
			'email' => 'E-mail',
            'date_create' => 'Дата создания<br>тендера',
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
		$criteria->compare('date_end',$this->date_end,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('phone2',$this->phone2,true);
		$criteria->compare('phone3',$this->phone3,true);
		$criteria->compare('email',$this->email,true);
        //$criteria->order = 'date_end DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'id  DESC',
            ),
            'pagination'=>array(
                'pageSize'=>20,
            ),        
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return orders the static model class
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
    
    public function getRowCssClass() { 
        //$model = Orders::model()->findByPk($id);
         
        if(isset($this->uid) && $this->date_end!="0000-00-00" && $this->phone!="" && $this->email!="") {
            if($this->date_create >= date('Y-m-d', strtotime('-3 days')) && $this->date_create!='' && $this->date_create!='0000-00-00')
            {
                return 'order_created';    
            } else {
                return 'order_ok';
            }
        } else {
            return 'order_new';
        }  
    } 
}
