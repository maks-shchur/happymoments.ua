<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
    
    /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','login','error','resetpass','setcity','sendmsg','search','callme','accept_pro'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('logout'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

        if (!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->homeUrl);
        } else {
    		// collect user input data
    		if(isset($_POST['LoginForm']))
    		{
    			$model->attributes=$_POST['LoginForm'];
    			// validate user input and redirect to the previous page if valid
    			if($model->validate() && $model->login()) {
    			    //$m=new Session;
                    //$m->uid=Yii::app()->user->id; 
    			    //$m->save(); 
                    $u=Users::model()->findByPk(Yii::app()->user->id);
                    if($u->gender=='') {
                        $this->redirect('/my/profile');
                    }
                    else {
                        if($u->member==1)
                        {
                            if($u->occupation->templ=='members')
                                $this->redirect('/my/portfolio');
                            elseif($u->occupation->templ=='avto')
                                $this->redirect('/my/avto');
                            elseif($u->occupation->templ=='flo')
                                $this->redirect('/my/flo');    
                        	elseif($u->occupation->templ=='rent_photo')
                                $this->redirect('/my/studio/interior');
                            else $this->redirect('/my/portfolio');
                        }
                        else {
                            $this->redirect('/my/tenders');
                        } 
                    }
                }
    		}
    		// display the login form
    		$this->render('login',array('model'=>$model));
        }
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
	    //$m=Session::model()->findByAttributes(array('uid'=>Yii::app()->user->id));
        //if(is_object($m)) $m->delete();
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
    
    public function actionResetpass()
	{
	   //print_r($_POST); exit();
	   if(!empty($_POST['email'])) {
	       $model = Users::model()->findByAttributes(array('email'=>$_POST['email']));
           if($model->id>0) {
                $new_pass=Users::newPass(6);
                $name=$model->name;
                $headers="MIME-Version: 1.0\r\n".
					"Content-Type: text/html; charset=UTF-8";
                               
                $pass = CPasswordHelper::hashPassword($new_pass); 
                
        
                $msg='Ваш новый пароль - '.$new_pass.'<br /> Поменять его Вы можете в настройках в Вашем профиле.';
                
                //echo $model->Pasword; exit();
                if($model->updateByPk($model->id,array('password'=>$pass))) { 
    				//mail($name,'Восстановление пароля',$msg,$headers);
                    if(Users::mailsend($model->email,'hm164@mail.ua','Восстановление пароля',$msg))
                        Yii::app()->user->setFlash('reset','На указанный Email Вам был отправлен новый пароль.');
                    else 
                        Yii::app()->user->setFlash('reset','Ошибка отправки почты.');
                    //$this->refresh();
                }
           }
           else 
                //throw new CHttpException(404,'Указанный Email не зарегисрирован.');
                Yii::app()->user->setFlash('reset','Указанный Email не зарегисрирован.');
       }
       $model=new LoginForm;
       $this->render('login',array('model'=>$model));
	}
    
    public function actionSetcity($id,$url,$get) {
        if(isset(Yii::app()->request->cookies['city'])) {
            unset(Yii::app()->request->cookies['city']);
        }
        $cookie = new CHttpCookie('city', $id);
        Yii::app()->request->cookies['city']=$cookie; 
        $cookie->expire = time() + 3600;
        
        $m=City::model()->localized('ru')->findByPk($id);
        //echo '<button class="show-cities">'.$m->name.'</button>';
        $res=array();
        
        $get=unserialize($get);
        //print_r($get); exit();
        
        if(isset($get))
        {
            $new_ulr=array();
            foreach($get as $k=>$v)
            {   
                if($k=='alias')
                {
                    if($k=='city')
                    {
                        if($url!='site/index')
                            $new_ulr['city']=$id;
                    }
                    $new_ulr[$k]=$v; 
                    break;   
                }
                else
                {
                    if($v!='ru')
                    {
                        if($k=='city')
                        {
                            if($url!='site/index')
                                $new_ulr['city']=$id;
                            else 
                                break;
                        }
                        $new_ulr[$k]=$v;    
                    }
                    else
                    {
                        break;
                    }
                    //$new_ulr[$k]=$v;
                }
            }
            if($url=='site/index') $res['url']=$this->createUrl($url);     
            else $res['url']=$this->createUrl($url,$new_ulr);
        }
        else
            $res['url']=$this->createUrl($url);
        
        $res['name']=$m->name;
        echo json_encode($res);
    }
    
    public function actionSendmsg() {
        if(isset($_POST['msg'])) {
            $m=new Messages;
            isset($_POST['from_uid']) ? $m->from_uid=$_POST['from_uid'] : $m->from_uid=0;
            $m->to_uid=$_POST['to_uid'];
            $m->title=$_POST['title'];
            
            if(isset($_POST['from_uid'])) $m->msg=$_POST['msg'].'<br /><br />E-mail отправителя: '.$_POST['email'];
            else $m->msg=$_POST['msg']; 
            
            $msg='Вам пришло новое сообщение от посетителя сайта happymoments.ua<br />Посмотреть его Вы можете в Вашем <a href="http://happymoments.ua">кабинете пользователя</a>';
            
            $u=Users::model()->findByPk($_POST['to_uid']);
            if($m->save()) {
                $res='<div align="center" style="font-size:16px;">Спасибо. Ваше сообщение отправлено</div>';
                //Users::mailsend($u->email,'HM Sender<noanswer@happymoments.ua>',$_POST['title'],$_POST['msg']);
                Users::mailsend($u->email,'hm164@mail.ua','Сообщение с сайта happymoments.ua',$msg);
            }
            else $res='<div align="center" style="font-size:16px;">Ошибка отправки сообщения. Повторите попытку</div>';
            
            echo $res;
        }
    }
    
    public function actionSearch() {
     
       if(Yii::app()->request->isAjaxRequest && isset($_GET['q']))
       {
          $name = $_GET['q']; 
          $limit = 50; 
          $criteria = new CDbCriteria;
          $criteria->condition = "name LIKE :sterm and activate=1";
          $criteria->params = array(":sterm"=>"%$name%");
          $criteria->limit = $limit;
          $userArray = Users::model()->findAll($criteria);
          $returnVal = '';
          foreach($userArray as $userAccount)
          {
             $returnVal .= '<li class="search-results__item"><a href="/id'.$userAccount->id.'" class="search-results__link">'.$userAccount->name.'<span class="small_search">'.Occupation::getName($userAccount->occupation_id).', '.City::getName($userAccount->city_id).'</span></a></li>';
          }
          echo $returnVal;
       }
   }
   
   public function actionCallme() {
        if(isset($_POST['phone'])) {
            $m=new Messages;
            isset($_POST['from_uid']) ? $m->from_uid=$_POST['from_uid'] : $m->from_uid=0;
            $m->to_uid=$_POST['to_uid'];
            $m->title='Обратный звонок';
            
            $m->msg='Телефон: '.$_POST['phone'].'<br /><br />'.$_POST['msg']; 
            
            $msg='Вам пришло новое сообщение от посетителя сайта happymoments.ua<br />Посмотреть его Вы можете в Вашем <a href="http://happymoments.ua">кабинете пользователя</a>';
            
            $u=Users::model()->findByPk($_POST['to_uid']);
            if($m->save()) {
                $res='<div align="center" style="font-size:14px;">Спасибо. Ваше сообщение отправлено</div>';
                //Users::mailsend($u->email,'HM Sender<noanswer@happymoments.ua>',$_POST['title'],$_POST['msg']);
                Users::mailsend($u->email,'hm164@mail.ua','Сообщение с сайта happymoments.ua',$msg);
            }
            else $res='Ошибка отправки сообщения. Повторите попытку';
            
            echo $res;
        }
    }
  
  public function actionAccept_pro()
  {
        if(!Yii::app()->user->isGuest)
        {
            $msg='Пользователь с ID '.Yii::app()->user->id.' подал заявку на аккаунт ПРО.';
            if(Users::mailsend('hm164@mail.ua','HM Sender','Заявка на предоставление аккаунта ПРО',$msg))
                $this->render('accept');
            else
                //throw new CHttpException(404,'The requested page does not exist.');
                echo 'Ошибка отправки почты.';    
        }
        else
        {
            $this->render('not_accept');
        }
  }     
}