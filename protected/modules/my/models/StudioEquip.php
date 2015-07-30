<?php

/**
 * This is the model class for table "{{studio_equip}}".
 *
 * The followings are the available columns in table '{{studio_equip}}':
 * @property integer $id
 * @property integer $uid
 * @property string $title
 * @property string $description
 * @property string $photo
 * @property integer $visible
 */
class StudioEquip extends CActiveRecord
{
    public $photo;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{studio_equip}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, title, description', 'required'),
            array('photo', 'file',  'types'=>'jpg,jpeg,gif,png', 'allowEmpty'=>true, 'safe'=>false),
			array('uid, visible', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>250),
			array('description', 'length', 'max'=>1000),
			array('photo', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, uid, title, description, photo, visible', 'safe', 'on'=>'search'),
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
			'uid' => 'Uid',
			'title' => 'Название',
			'description' => 'Описание',
			'photo' => 'Фото',
			'visible' => 'Visible',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('visible',$this->visible);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StudioEquip the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
