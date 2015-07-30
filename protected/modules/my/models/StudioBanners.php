<?php

/**
 * This is the model class for table "{{studio_banners}}".
 *
 * The followings are the available columns in table '{{studio_banners}}':
 * @property integer $id
 * @property integer $uid
 * @property string $banner1
 * @property string $banner2
 * @property string $banner3
 */
class StudioBanners extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{studio_banners}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('uid, banner1, banner2, banner3', 'required'),
			array('uid', 'numerical', 'integerOnly'=>true),
			array('banner1, banner2, banner3', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, uid, banner1, banner2, banner3', 'safe', 'on'=>'search'),
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
			'banner1' => 'Banner1',
			'banner2' => 'Banner2',
			'banner3' => 'Banner3',
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
		$criteria->compare('banner1',$this->banner1,true);
		$criteria->compare('banner2',$this->banner2,true);
		$criteria->compare('banner3',$this->banner3,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StudioBanners the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
