<?php

/**
 * This is the model class for table "{{seo}}".
 *
 * The followings are the available columns in table '{{seo}}':
 * @property integer $id
 * @property string $url
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string $top_text
 * @property string $bottom_text
 *
 * The followings are the available model relations:
 * @property Seolang[] $seolangs
 */
class Seo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{seo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('url, title', 'length', 'max'=>500),
			array('keywords, description, top_text, bottom_text', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, url, title, keywords, description, top_text, bottom_text', 'safe', 'on'=>'search'),
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
			'seolangs' => array(self::HAS_MANY, 'Seolang', 'seo_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'url' => 'Url',
			'title' => 'Title',
			'keywords' => 'Keywords',
			'description' => 'Description',
			'top_text' => 'Top Text',
			'bottom_text' => 'Bottom Text',
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
		$criteria->compare('url',$this->url,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('keywords',$this->keywords,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('top_text',$this->top_text,true);
		$criteria->compare('bottom_text',$this->bottom_text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Seo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function checkUrl($url)
    {
        $seo = array();    
        if(!empty($url))
        {
            if(Seo::model()->countByAttributes(array('url'=>$url))<=0)
            {
                $new = new Seo;
                $new->url = $url;
                $new->save();
                
                $seo['title'] = CHtml::encode($this->pageTitle).' - Happy Momments';
                $seo['keywords'] = 'праздник, фотограф, свадьба, видеооператор, HM Агент';
                $seo['description'] = 'Все для организации праздника';
                $seo['top_text'] = '';
                $seo['bottom_text'] = '';
                return $seo;
            }
            else
            {
                $meta=Seo::model()->findByAttributes(array('url'=>$url));
                
                if(!is_null($meta->title)) $seo['title'] = CHtml::encode($meta->title).' - Happy Momments';
                else $seo['title'] = CHtml::encode($this->pageTitle).' - Happy Momments';
                
                if(!is_null($meta->keywords)) $seo['keywords'] = CHtml::encode($meta->keywords);
                else $seo['keywords'] = 'праздник, фотограф, свадьба, видеооператор, HM Агент';
                
                if(!is_null($meta->description)) $seo['description'] = CHtml::encode($meta->description);
                else $seo['description'] = 'Все для организации праздника';
                
                if(!is_null($meta->description)) $seo['top_text'] = CHtml::encode($meta->top_text);
                else $seo['top_text'] = '';
                
                if(!is_null($meta->description)) $seo['bottom_text'] = CHtml::encode($meta->bottom_text);
                else $seo['bottom_text'] = '';
                
                return $seo;
            }
        }
        else
        {
            $seo['title'] = CHtml::encode($this->pageTitle).' - Happy Momments';
            $seo['keywords'] = 'праздник, фотограф, свадьба, видеооператор, HM Агент';
            $seo['description'] = 'Все для организации праздника';
            $seo['top_text'] = '';
            $seo['bottom_text'] = '';
            return $seo;
        }
    }
}
