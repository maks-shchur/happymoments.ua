<?php

/**
 * This is the model class for table "{{pages}}".
 *
 * The followings are the available columns in table '{{pages}}':
 * @property integer $id
 * @property string $text
 * @property string $type
 *
 * The followings are the available model relations:
 * @property Pageslang[] $pageslangs
 */
class Pages extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{pages}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('text, type', 'required'),
			array('type', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, text, type', 'safe', 'on'=>'search'),
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
			'pageslangs' => array(self::HAS_MANY, 'Pageslang', 'page_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'text' => 'Text',
			'type' => 'Type',
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
		$criteria->compare('text',$this->text,true);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			//'criteria'=>$criteria,
            'criteria' => $this->ml->modifySearchCriteria($criteria),
		));
	}
    
    public function behaviors()
    {
        return array(
            'ml' => array(
                'class' => 'application.models.behaviors.MultilingualBehavior',
                'localizedAttributes' => array(
                    'text',
                ),
                'langClassName' => 'PagesLang',
                'langTableName' => 'pageslang',
                'languages' => Yii::app()->params['translatedLanguages'],
                'defaultLanguage' => Yii::app()->params['defaultLanguage'],
                'langForeignKey' => 'page_id',
                'dynamicLangClass' => true,
            ),
        );
    }
 
    public function defaultScope()
    {
        return $this->ml->localizedCriteria();
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public static function getNamebyType($type)
    {
        if($type=='politic') echo 'Политика конфиденциальности';
        if($type=='user_agriment') echo 'Пользовательское соглашение';
        if($type=='author') echo 'Авторское право';
    }
}
