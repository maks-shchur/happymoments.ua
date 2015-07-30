<?php

/**
 * This is the model class for table "{{genre}}".
 *
 * The followings are the available columns in table '{{genre}}':
 * @property integer $id
 * @property string $name
 * @property integer $occ_id
 *
 * The followings are the available model relations:
 * @property Genrelang[] $genrelangs
 */
class Genre extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{genre}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, occ_id', 'required'),
			array('occ_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, occ_id', 'safe', 'on'=>'search'),
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
			'genrelangs' => array(self::HAS_MANY, 'Genrelang', 'genre_id'),
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
			'occ_id' => 'Occ',
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
		$criteria->compare('occ_id',$this->occ_id);

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
                    'name',
                ),
                'langClassName' => 'GenreLang',
                'langTableName' => 'genrelang',
                'languages' => Yii::app()->params['translatedLanguages'],
                'defaultLanguage' => Yii::app()->params['defaultLanguage'],
                'langForeignKey' => 'genre_id',
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
	 * @return Genre the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function getName ($id) {
        return Genre::model()->findByPk($id)->name;
    }
}
