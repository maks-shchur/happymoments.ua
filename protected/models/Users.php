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
    public $tos;
    public $validacion;
    
    
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
            array('name, password, email, member', 'required', 'on'=>'step2'),
            array('tos', 'required', 'requiredValue' => true, 'on'=>'step2', 'message'=>Yii::t('register','Tos')),
            array('photo', 'file', 'types'=>'jpg,jpeg,gif,png', 'allowEmpty'=>true, 'safe'=>false),
            array('name, date_birth, city_id, email', 'required', 'on'=>'update'),
            array('views,admin,freefoto', 'numerical', 'integerOnly'=>true),
            array('email', 'unique'),
			//array('birth_public, member, city_id, member_type, occupation_id, work_from, work_to', 'numerical', 'integerOnly'=>true),
			//array('name, login, password, photo, email, district, address', 'length', 'max'=>250),
			//array('gender', 'length', 'max'=>1),
			//array('phones','match','pattern' => '/^((\+?38)((\d{3})))-((\d{3}))-((\d{2}))-((\d{2}))$/','message' => 'Некорректный формат поля {attribute}'),
			array('date_lastvisit, top_banner, gender', 'safe'),
            //array('verifyCode','captcha', 'allowEmpty'=> !CCaptcha::checkRequirements(),'on'=>'step2'),
            
            //array('validacion', 'application.extensions.recaptcha.EReCaptchaValidator', 'privateKey'=>'6LdhAgQTAAAAAAUCj_Teo8BoyYczC9dlNaZY6o9S', 'on' => 'step2'),
            
            //array('verifyCode', 'activeCaptcha', 'on'=>'active'),
            array('password', 'length', 'min'=>5),
            array('password', 'compare', 'compareAttribute'=>'password2', 'on'=>'updatesettings', 'message'=>'Not compare'),
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
            'online'=>array(self::STAT, 'Session', 'user_id', 'select'=>'count(*)'),
            'files'=>array(self::HAS_MANY, 'Files', 'uid', 'on'=>'files.type="photo"', 'limit'=>4),
            'videos'=>array(self::HAS_MANY, 'Files', 'uid', 'on'=>'videos.type="video" and videos.source="portfolio"', 'limit'=>4),
            'filesCount'=>array(self::STAT, 'Files', 'uid', 'condition'=>'type="photo"', 'select'=>'count(*)'),
            'videosCount'=>array(self::STAT, 'Files', 'uid', 'condition'=>'type="video"', 'select'=>'count(*)'),
            'avtoCount'=>array(self::STAT, 'Avto', 'uid', 'select'=>'count(*)'),
            'floCount'=>array(self::STAT, 'Flo', 'uid', 'select'=>'count(*)'),
            'avto' => array(self::HAS_MANY, 'Avto', 'uid'),
            'flo' => array(self::HAS_MANY, 'Flo', 'uid', 'select'=>'picture, price', 'limit'=>5),
            'calendar' => array(self::HAS_MANY, 'Calendar', 'uid'),
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
			'name' => 'Имя, Фамилия или название компании',
			'login' => 'Login',
			'password' => 'Пароль',
            'photo' => 'Фото',
			'phone' => 'Телефон',
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
            'tos' => 'Пользовательское соглашение',
            'validacion' => 'Повторите код',
            'crm' => 'CRM'
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
		$criteria->compare('phone',$this->phone,true);
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
            //$this->genre_id=serialize($this->genre_id);    
            
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
                          
                          /*min-width: 1200px;*/
                        }
                        .wrapper__header--second {
                          
                        }
                        .container {
                          
                        }
                        .hm-logo {
                          
                        }
                        .templ_body {
                            
                        }
                        .templ_body a {
                            color: #395a92;
                            text-decoration: underline;
                        }
                        .templ_icon {
                            
                        }
                        .templ_text {
                            font: 1em PTSansNarrowRegular, sans-serif;
                            color: #000;
                        }
                        .templ_strike {
                            
                        }
                        .templ_social {
                            font: 0.85em PTSansNarrowRegular, sans-serif;
                            color: #c8c8c8;
                        }
                        .social {
                          
                          border-bottom: #bebebe 1px solid;
                        }
                        .social::after {
                          content: "";
                          display: table;
                          clear: both;
                        }
                        
                        .social-text {
                          
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
                <div style="height: 89px; background: #272a33; border-top: 4px solid #90b651; width: 100%">
                    <div style="display: block; padding: 0px 20px;">
                      <a href="'.Yii::app()->request->hostInfo.'" style="display: inline-block; float: left; margin-top: 19px;">
                        <img src="'.Yii::app()->request->hostInfo.'/img/logo.png" alt="Лого" border="0">
                      </a>
                    </div>
                </div>
                <div style="background-color: #fff;">
                    <div align="center">
                        <div style="display: block; margin:30px 0px;">
                            <img src="'.Yii::app()->request->hostInfo.'/img/hm_email1.png" border="0" />
                        </div>
                    </div>
                    <div style="font-size: 14px; color: #000;">'.$message.'</div>
                    <div style="display: block; height:1px; border-top: 1px solid #c8c8c8; margin: 20px;"></div>
                    <div stylw="padding: 0 0 8px 0; color: #777a82;">
                          <div style="display: block; margin: 7px 7% 0 0; vertical-align: top; float: left;">Мы в соц. сетях</div>
                          <a href="https://twitter.com/HMUkraine" style="display: block; width: 30px; height: 30px; margin-left: 8px; float: left;"><img src="'.Yii::app()->request->hostInfo.'/img/email_tw.png" border="0" /></a>
                          <a href="https://vk.com/happymoments" style="display: block; width: 30px; height: 30px; margin-left: 8px; float: left;"><img src="'.Yii::app()->request->hostInfo.'/img/email_vk.png" border="0" /></a>
                          <a href="https://www.facebook.com/pages/Happy-Moments/347923621985767" style="display: block; width: 30px; height: 30px; margin-left: 8px; float: left;"><img src="'.Yii::app()->request->hostInfo.'/img/email_fb.png" border="0" /></a>
                    </div>
                </div>
                
                
                </body>
                </html>';
       
       
        /*$mail=Yii::app()->Smtpmail;
        $mail->SetFrom($from, 'HM Mailer');
        $mail->Subject    = $subject;
        $mail->MsgHTML($templ);
        $mail->AddAddress($to, "");
        if($mail->Send()) {*/
        $email = Yii::app()->email;
        $email->to = $to;
        $email->from = 'HM Mailer <mailer@happymoments.ua>';
        $email->subject = $subject;
        $email->message = $templ;
        if($email->send()) {
            return true;
        }else {
            //return false;
            echo $mail->ErrorInfo; exit();
        }
    }

    public function addHit($id)
    {
        $m=Users::model()->findByPk($id);
        if(!Yii::app()->request->cookies[$id])
        {
            $cookie = new CHttpCookie($id, true);   
            $cookie->expire = time() + 60*60*3;                       
            Yii::app()->request->cookies[$id] = $cookie;   
            $m->views=$m->views+1;
            $m->save();
        }
    }
    
    public static function newPass($lenght)
    {
        //набор символов для пароля
        $symbols = array('a','b','c','d','e','f',
                         'g','h','i','j','k','l',
                         'm','n','o','p','r','s',
                         't','u','v','x','y','z',
                         'A','B','C','D','E','F',
                         'G','H','I','J','K','L',
                         'M','N','O','P','R','S',
                         'T','U','V','X','Y','Z',
                         '1','2','3','4','5','6',
                         '7','8','9');
        $password='';    
        //запускаем цикл с количеством витков $lenght
        for($i = 0; $i < $lenght; $i++)
        {
            //случайным образом выбираем номер символа из массива $symbols для вставки в новый пароль
            $index = rand(0, count($symbols) - 1);
            //склеиваем точкой имеющийся $password со случайным символом $symbols[$index]
            $password = $password.$symbols[$index];
        }
     
        //возвращаем новый пароль
        return $password;
    } 
    
    public function activeCaptcha() {
        $code = Yii::app()->controller->createAction('captcha')->getVerifyCode();
        //echo 'code='.$code.', verify='.$this->verifyCode;
        //$_SESSION['code']=$code;
        //print_r($_SESSION); exit();
        if ($code != $this->verifyCode)
                $this->addError('verifyCode', 'Неправильный код проверки222.');
        if (!(isset($_POST['ajax']) && $_POST['ajax']=='users-form'))
                Yii::app()->controller->createAction('captcha')->getVerifyCode(true);
    }
}
