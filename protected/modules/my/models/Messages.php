<?php

/**
 * This is the model class for table "{{messages}}".
 *
 * The followings are the available columns in table '{{messages}}':
 * @property string $id
 * @property integer $from_uid
 * @property integer $to_uid
 * @property string $title
 * @property string $msg
 * @property string $date_send
 * @property integer $is_read
 */
class Messages extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{messages}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('from_uid, to_uid, title, msg', 'required'),
			array('from_uid, to_uid, is_read', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, from_uid, to_uid, title, msg, date_send, is_read', 'safe', 'on'=>'search'),
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
			'from_uid' => 'From Uid',
			'to_uid' => 'To Uid',
			'title' => 'Title',
			'msg' => 'Msg',
			'date_send' => 'Date Send',
			'is_read' => 'Is Read',
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
		$criteria->compare('from_uid',$this->from_uid);
		$criteria->compare('to_uid',$this->to_uid);
		$criteria->compare('title',$this->title,true);
		//$criteria->compare('msg',$this->msg,true);
		$criteria->compare('date_send',$this->date_send,true);
		//$criteria->compare('is_read',$this->is_read);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Messages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function getTimeAgo($date_time)
	{
		$timeAgo = time() - strtotime($date_time);
		$timePer = array(
			'day' 	=> array(3600 * 24, 'дн.'),
			'hour' 	=> array(3600, ''),
			'min' 	=> array(60, 'мин.'),
			'sek' 	=> array(1, 'сек.'),
			);
		foreach ($timePer as $type =>  $tp) {
			$tpn = floor($timeAgo / $tp[0]);
			if ($tpn){
				
				switch ($type) {
					case 'hour':
						if (in_array($tpn, array(1, 21))){
							$tp[1] = 'час';
						}elseif (in_array($tpn, array(2, 3, 4, 22, 23)) ) {
							$tp[1] = 'часa';
						}else {
							$tp[1] = 'часов';
						}
						break;
				}
				return $tpn.' '.$tp[1].' назад';
			}
		}
	}
    
    public function countUnreadMsg($uid) {
        return Messages::model()->count('is_read=0 and to_uid=:to_uid',array(':to_uid'=>$uid));
    }
    
    public function sendNotify($uid) {
        //echo $this->to_uid; exit();
        $user=Users::model()->findByPk($uid);
        
        if($user->receive_email==1) {
    		$subject='=?UTF-8?B?'.base64_encode('У Вас новое сообщение на портале HappyMoments').'?=';
    		$headers="From: НМ-mailer <hm@site.com>\r\n".
    			"Reply-To: hm@site.com\r\n".
    			"MIME-Version: 1.0\r\n".
    			"Content-Type: text/html; charset=UTF-8";
            $msg=$user->name.', Вам пришло новое сообщение на портале HappyMoments. Посмотреть его Вы можете в <a href="'.Yii::app()->request->hostInfo.Yii::app()->getHomeUrl().'/messages">Ваших сообщениях</a>';
         
            if(!mail($user->email,$subject,$msg,$headers)) exit();
       }
    }
}
