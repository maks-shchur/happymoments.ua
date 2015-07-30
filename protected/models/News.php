<?php

/**
 * This is the model class for table "{{news}}".
 *
 * The followings are the available columns in table '{{news}}':
 * @property integer $id
 * @property string $title
 * @property string $intro_text
 * @property string $full_text
 * @property string $foto_main
 * @property string $foto1
 * @property string $foto2
 * @property string $foto3
 * @property string $foto4
 * @property string $foto5
 */
class News extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{news}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, intro_text', 'required'),
			array('title', 'length', 'max'=>250),
			array('intro_text', 'length', 'max'=>500),
            array('full_text', 'safe'),
            array('foto_main, foto1, foto2, foto3, foto4, foto5', 'file', 'types'=>'jpg,jpeg,gif,png', 'allowEmpty'=>true, 'safe'=>false),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, intro_text, full_text, foto_main, foto1, foto2, foto3, foto4, foto5', 'safe', 'on'=>'search'),
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
			'title' => 'Заголовок',
			'intro_text' => 'Вступительный текст',
			'full_text' => 'Основной текст',
			'foto_main' => 'Фото для вступительного текста',
			'foto1' => 'Foto1',
			'foto2' => 'Foto2',
			'foto3' => 'Foto3',
			'foto4' => 'Foto4',
			'foto5' => 'Foto5',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('intro_text',$this->intro_text,true);
		$criteria->compare('full_text',$this->full_text,true);
		$criteria->compare('foto_main',$this->foto_main,true);
		$criteria->compare('foto1',$this->foto1,true);
		$criteria->compare('foto2',$this->foto2,true);
		$criteria->compare('foto3',$this->foto3,true);
		$criteria->compare('foto4',$this->foto4,true);
		$criteria->compare('foto5',$this->foto5,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
