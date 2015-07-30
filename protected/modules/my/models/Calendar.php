<?php

/**
 * This is the model class for table "{{calendar}}".
 *
 * The followings are the available columns in table '{{calendar}}':
 * @property string $id
 * @property integer $uid
 * @property string $day
 */
class Calendar extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{calendar}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid', 'required'),
			array('uid', 'numerical', 'integerOnly'=>true),
			array('day', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, uid, day', 'safe', 'on'=>'search'),
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
			'day' => 'Day',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('day',$this->day,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Calendar the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function my_makeCal($year, $month)
    {
        $day_amount = array(1 => '31', 2 =>array(false => '28', true => '29'), 3 => '31', 4 => '30',
                                                    5 => '31', 6 => '30', 7 => '31', 8 => '31', 9 => '30', 10 => '31',
                                                    11 => '30', 12 => '31' );
        if ($month==2)
                $day_in_month = $day_amount[$month][$year % 4==0];
        else
                $day_in_month = $day_amount[$month];
                  // Получаем номер дня недели для 1 числа месяца.
                  // Получаем номер дня недели для последнего дня месяца.
                // Корректируем их, чтобы воскресенье соответствовало числу 7, а не числу 0.
                $wday = JDDayOfWeek(GregorianToJD($month, 1, $year), 0);
                $wday_end_month = JDDayOfWeek(GregorianToJD($month, $day_in_month, $year), 0);
                if ($wday == 0) $wday = 7;
                if ($wday_end_month == 0) $wday_end_month = 7;
            //Заполняем массив календаря значениями от 1 до последнего числа месяца
                $cal   = range(1, $day_in_month);
                //если первое число не совпадает с понедельником
                    if ($wday>1)
                    {
                        $cal_b = array_fill(0, $wday-1, '');//заполняет массив пустыми значениями
                        $cal   = array_merge($cal_b,$cal);//склеиваем массив дат и пустышку
                    }
                //если последнее число не совпадает с воскресеньем
                        if($wday_end_month < 7)
                        {
                                $cal_e = array_fill(0, 7-$wday_end_month, '');//заполняет массив пустыми значениями
                                $cal   = array_merge($cal, $cal_e);//склеиваем массив дат и пустышку
                        }
        $cal = array_chunk($cal, 7);
        return $cal;
    }
}
