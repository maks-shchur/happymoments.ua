<?php

/**
 * This is the model class for table "{{occupation}}".
 *
 * The followings are the available columns in table '{{occupation}}':
 * @property integer $id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Occupationlang[] $occupationlangs
 */
class Occupation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{occupation}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cat_id, name, templ', 'required'),
			array('name', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, cat_id, templ', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
        if(isset(Yii::app()->request->cookies['city']))
            $city='city_id="'.Yii::app()->request->cookies['city']->value;
        else 
            $city='city_id!=""';
		return array(
			'occupationlangs' => array(self::HAS_MANY, 'Occupationlang', 'occ_id'),
            'cat'=>array(self::BELONGS_TO,'Category','cat_id'),
            'users'=>array(self::STAT, 'Users', 'occupation_id', 'select'=>'count(*)'),
            'usersCity'=>array(self::HAS_MANY, 'Users', 'occupation_id', 'condition'=>$city.'" or other_city="'.$city.'"'),
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
            'cat_id' => 'Category',
            'templ' => 'Template',
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
        
        $criteria->with = 'cat';
        $criteria->compare('cat.id',$this->cat_id);

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
        $criteria->compare('templ',$this->templ,true);

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
                'langClassName' => 'OccupationLang',
                'langTableName' => 'occupationlang',
                'languages' => Yii::app()->params['translatedLanguages'],
                'defaultLanguage' => Yii::app()->params['defaultLanguage'],
                'langForeignKey' => 'occ_id',
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
	 * @return Occupation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function getName($id)
    {
        $data = Occupation::model()->findByPk($id);
        return $data->name;
    }
    
    public function CalcUsers($id)
    {
        if(isset(Yii::app()->request->cookies['city']))
            $city='city_id="'.Yii::app()->request->cookies['city']->value.'" or other_city="'.Yii::app()->request->cookies['city']->value.'"';
        else 
            $city='city_id!="" or other_city!=""';
        $users=Users::model()->findAllBySql('select id from {{users}} where ('.$city.') and activate=1 and occupation_id='.$id);
        $i=0;
        foreach($users as $user) {
            if($id==1 || $id==2 || $id==4 || $id==18 || $id==19 || $id==17) {
                if(Files::model()->countByAttributes(array('uid'=>$user->id))>=4)
                    $i++;
            }
            elseif($id==5) {
                if(Avto::model()->countByAttributes(array('uid'=>$user->id))>=1)
                    $i++;
            }
            else {
                if(Flo::model()->countByAttributes(array('uid'=>$user->id))>=1)
                    $i++;
            }            
        }
        return $i;
    }
}
