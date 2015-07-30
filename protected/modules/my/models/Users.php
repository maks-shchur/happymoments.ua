<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property string $id
 * @property string $name
 * @property string $login
 * @property string $password
 * @property string $photo
 * @property string $phones
 * @property string $email
 * @property string $gender
 * @property string $date_birth
 * @property integer $birth_public
 * @property string $date_registered
 * @property string $date_lastvisit
 * @property string $about
 * @property string $url
 * @property integer $member
 * @property integer $city_id
 * @property integer $member_type
 * @property integer $occupation_id
 * @property string $genre_id
 * @property string $district
 * @property string $address
 * @property string $skype
 * @property integer $work_from
 * @property integer $work_to
 *
 * The followings are the available model relations:
 * @property Occupation $occupation
 * @property City $city
 */
class Users extends CActiveRecord
{
    public $rememberMe;
    private $_identity;
    public $verifyCode;
    public $password2;
    public $name_studio;
    
    
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('photo, phones, gender, date_birth, birth_public, member_type, date_registered, about, url, city_id, occupation_id, genre_id, district, address, skype, work_from, work_to', 'required', 'on'=>'update'),
            array('name, login, password, email, member', 'required', 'on'=>'register'),
            array('photo', 'file', 'types'=>'jpg,jpeg,gif,png', 'allowEmpty'=>true, 'safe'=>false),
            array('name, date_birth, city_id, email', 'required', 'on'=>'update'),
            array('name_studio, city_id, email', 'required', 'on'=>'studio_update'),
            array('views,admin,freefoto', 'numerical', 'integerOnly'=>true),
			array('name, gender, date_birth, city_id, email, genre_id', 'required', 'on'=>'genre'),
            array('email', 'unique'),
			//array('name, login, password, photo, email, district, address', 'length', 'max'=>250),
			//array('gender', 'length', 'max'=>1),
			//array('phones','match','pattern' => '/^((\+?38)((\d{3})))-((\d{3}))-((\d{2}))-((\d{2}))$/','message' => 'Некорректный формат поля {attribute}'),
            array('phone, phone2, phone3', 'length', 'max'=>17),
			array('date_lastvisit, top_banner, gender', 'safe'),
            array('verifyCode','captcha','on'=>'register'),
            array('password', 'length', 'min'=>5),
            //array('password, password2', 'required', 'on'=>'updatesettings'),
            array('password2', 'compare', 'compareAttribute'=>'password', 'on'=>'updatesettings', 'message'=>'Пароли не совпадают'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, login, password, photo, phones, email, gender, date_birth, birth_public, date_registered, date_lastvisit, about, url, member, city_id, member_type, occupation_id, genre_id, district, address, skype, work_from, work_to', 'safe', 'on'=>'search'),
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
			'occupation' => array(self::BELONGS_TO, 'Occupation', 'occupation_id'),
			'city' => array(self::BELONGS_TO, 'City', 'city_id'),
            'balans' => array(self::HAS_ONE, 'Balans', 'uid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Имя, Фамилия или<br>название компании',
            'name_studio' => 'Название фотостудии',
			'login' => 'Login',
			'password' => 'Password',
            'photo' => 'Фото',
			'phone' => 'Телефон',
            'phone2' => 'Дополнительный<br />телефон',
            'phone3' => 'Дополнительный<br />телефон',
			'email' => 'Публичный e-mail',
			'gender' => 'Пол',
			'date_birth' => 'Дата рождения',
			'birth_public' => 'Birth Public',
			'date_registered' => 'Date Registered',
			'date_lastvisit' => 'Date Lastvisit',
			'about' => 'О себе',
			'url' => 'Личный сайт',
			'member' => 'Member',
			'city_id' => 'Город',
            'other_city' => 'Дополнительный город',
			'member_type' => 'Member Type',
			'occupation_id' => 'Услуга',
			'genre_id' => 'В каких жанрах Вы работаете?',
			'district' => 'Район',
			'address' => 'Адрес',
			'skype' => 'Скайп',
			'work_from' => 'Work From',
			'work_to' => 'Work To',
            'views' => 'Просмотров',
            'hals' => 'Количество залов',
            'square' => 'Площадь помещения',
            'height' => 'Высота потолков',
            'price_h' => 'Цена за час аренды',
            'price' => 'Цена за услугу'
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('phones',$this->phones,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('date_birth',$this->date_birth,true);
		$criteria->compare('birth_public',$this->birth_public);
		$criteria->compare('date_registered',$this->date_registered,true);
		$criteria->compare('date_lastvisit',$this->date_lastvisit,true);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('member',$this->member);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('member_type',$this->member_type);
		$criteria->compare('occupation_id',$this->occupation_id);
		$criteria->compare('genre_id',$this->genre_id,true);
		$criteria->compare('district',$this->district,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('work_from',$this->work_from);
		$criteria->compare('work_to',$this->work_to);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
            //$this->password=CPasswordHelper::hashPassword($this->password);
            
               
            
            if($this->isNewRecord)
                $this->password=CPasswordHelper::hashPassword($this->password);
            else {
                if(isset($_POST['Users']['password'])) {
                    $this->password=CPasswordHelper::hashPassword($this->password);
                }   
            }
                            
            return true;
        }
        else
            return false;
    }
    
    public function validatePassword($password, $user)
    {
        return CPasswordHelper::verifyPassword($password,$user);
    }
    /**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
	   
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->email,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','Incorrect username or password.');
            else 
                $this->login2();
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login2()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->email,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
    
    public function getTimeAgo($date_time)
	{
		$timeAgo = time() - strtotime($date_time);
		$timePer = array(
            //'month' => array(3600 * 24 * 31, 'мес.'),
			'day' 	=> array(3600 * 24, 'дн.'),
			'hour' 	=> array(3600, ''),
			'min' 	=> array(60, 'мин.'),
			'sek' 	=> array(1, 'сек.'),
			);
		foreach ($timePer as $type =>  $tp) {
			$tpn = floor($timeAgo / $tp[0]);
			if ($tpn) {
				
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
				return 'на сайте '.$tpn.' '.$tp[1];
			}
		}
	}   

	public function mailsend($to,$from,$subject,$message){
	        $templ='<!DOCTYPE>
                <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
                
                <head>
                	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
                    <style>
                        .wrapper {
                          width: 100%;
                          margin: 0 auto;
                          /*min-width: 1200px;*/
                        }
                        .wrapper__header--second {
                          min-height: 89px;
                          background: #272a33;
                          border-top: 4px solid #90b651;
                        }
                        .container {
                          display: block;
                          padding: 0 20px 0 20px;
                          margin: 0 auto;
                        }
                        .hm-logo {
                          display: inline-block;
                          float: left;
                          margin-top: 19px;
                        }
                        .templ_body {
                            background-color: #fff;
                        }
                        .templ_body a {
                            color: #395a92;
                            text-decoration: underline;
                        }
                        .templ_icon {
                            display: block;
                            width: 204px;
                            height: 158px;
                            background: url("'.Yii::app()->request->hostInfo.'/img/hm_email1.png") no-repeat;
                            margin:30px 0px;
                        }
                        .templ_text {
                            font: 1em PTSansNarrowRegular, sans-serif;
                            color: #000;
                        }
                        .templ_strike {
                            display: block;
                            height:1px;
                            border-top: 1px solid #c8c8c8;
                            margin: 20px;
                        }
                        .templ_social {
                            font: 0.85em PTSansNarrowRegular, sans-serif;
                            color: #c8c8c8;
                        }
                        .social {
                          width: 87%;
                          padding: 0 0 8px 0;
                          font-family: PT Sans, sans-serif;
                          color: #777a82;
                          border-bottom: #bebebe 1px solid;
                        }
                        .social::after {
                          content: "";
                          display: table;
                          clear: both;
                        }
                        
                        .social-text {
                          display: block;
                          margin: 7px 7% 0 0;
                          vertical-align: top;
                          float: left;
                        }
                        
                        .social-link {
                          display: block;
                          width: 30px;
                          height: 30px;
                          margin-left: 8px;
                          border-radius: 40px;
                          float: left;
                          -webkit-transition: all ease-out 0.25s;
                          -moz-transition: all ease-out 0.25s;
                          -o-transition: all ease-out 0.25s;
                          -ms-transition: all ease-out 0.25s;
                          transition: all ease-out 0.25s;
                        }
                        
                        .tw {
                          background: url("'.Yii::app()->request->hostInfo.'/img/social.png") left top no-repeat;
                        }
                        
                        .tw:hover {
                          background: url("'.Yii::app()->request->hostInfo.'/img/social.png") left bottom no-repeat;
                        }
                        
                        .vk {
                          background: url("'.Yii::app()->request->hostInfo.'/img/social.png") center top no-repeat;
                        }
                        
                        .vk:hover {
                          background: url("'.Yii::app()->request->hostInfo.'/img/social.png") center bottom no-repeat;
                        }
                        
                        .fb {
                          background: url("'.Yii::app()->request->hostInfo.'/img/social.png") right top no-repeat;
                        }
                        
                        .fb:hover {
                          background: url("'.Yii::app()->request->hostInfo.'/img/social.png") right bottom no-repeat;
                        }
                    </style>
                </head>
                
                <body>
                <nav class="wrapper wrapper__header--second">
                    <div class="container">
                      <a href="'.Yii::app()->request->hostInfo.'" class="hm-logo"><img src="'.Yii::app()->request->hostInfo.'/img/logo.png" alt="Лого"></a>
                    </div>
                </nav>
                <div class="templ_body">
                    <div align="center"><span class="templ_icon"></span></div>
                    <div class="templ_text">'.$message.'</div>
                    <div class="templ_strike"></div>
                    <div class="social">
                          <div class="social-text">Мы в соц. сетях</div>
                          <a class="social-link tw" href="#"></a>
                          <a class="social-link vk" href="#"></a>
                          <a class="social-link fb" href="#"></a>
                    </div>
                </div>
                
                
                </body>
                </html>';
       
       
        $mail=Yii::app()->Smtpmail;
        $mail->SetFrom($from, 'HM Mailer');
        $mail->Subject    = $subject;
        $mail->MsgHTML($templ);
        $mail->AddAddress($to, "");
        if($mail->Send()) {
            return true;
        }else {
            return false;
        }
    }

 
}
