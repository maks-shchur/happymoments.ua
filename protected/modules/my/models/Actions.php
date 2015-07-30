<?php

/**
 * This is the model class for table "{{actions}}".
 *
 * The followings are the available columns in table '{{actions}}':
 * @property integer $id
 * @property integer $uid
 * @property string $picture
 * @property string $title
 * @property string $date_start
 * @property string $date_end
 * @property integer $sale
 * @property integer $price
 * @property string $description
 * @property string $conditions
 */
class Actions extends CActiveRecord
{
	public $picture2;
    
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{actions}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, title, date_start, date_end, sale, price, description, occupation_id', 'required'),
			array('uid, sale, price', 'numerical', 'integerOnly'=>true),
			array('picture', 'file', 'types'=>'jpg,jpeg,gif,png', 'allowEmpty'=>false, 'safe'=>false, 'on'=>'create'),
            array('picture', 'file', 'types'=>'jpg,jpeg,gif,png', 'allowEmpty'=>true, 'on'=>'update', 'safe'=>true),
			array('title', 'length', 'max'=>250),
			array('description, conditions', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, uid, picture, title, date_start, date_end, sale, price, description, conditions', 'safe', 'on'=>'search'),
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
			'picture' => 'Фото',
            'picture2' => 'Фото2',
			'title' => 'Название акции',
			'date_start' => 'Дата старта',
			'date_end' => 'Дата окончания',
			'sale' => 'Размер скидки',
			'price' => 'Стоимость до скидки',
			'description' => 'Об акции',
			'conditions' => 'Условия акции',
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
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('date_start',$this->date_start,true);
		$criteria->compare('date_end',$this->date_end,true);
		$criteria->compare('sale',$this->sale);
		$criteria->compare('price',$this->price);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('conditions',$this->conditions,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Actions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
