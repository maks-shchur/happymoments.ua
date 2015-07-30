<?php

class RegisterController extends Controller
{    
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
            array('allow', // allow all user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create', 'step2', 'step3','captcha','confirm','create_occ','add_occ'),
				'users'=>array('*'),
			),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','genresublist'),
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
    
    public function actionStep2()
	{
	   $model=new Users('step2');
       
       
       /*if(isset($_POST['ajax']) && $_POST['ajax']==='users-form') //тут ajax-валидация
		{
			$model->setScenario('active');
            $model->verifyCode = $_POST['Users']['verifyCode'];
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}*/
       
       if(isset($_POST['Users']))
		{
  		//print_r($_POST); exit();
			$model->name = $_POST['Users']['name'];
            //$model->login = $_POST['Users']['login'];
            $model->email = $_POST['Users']['email'];
            $model->password = $_POST['Users']['password'];
            $model->member = $_POST['Users']['member'];
            //$model->verifyCode = $_POST['Users']['verifyCode'];
            $model->tos = $_POST['Users']['tos'];
            
            if($_POST['Users']['member']==0)
                $model->member_type='client';   
            
            //$model->scenario = 'registerwcaptcha';
            if($model->validate())
            {
                // and here is the actual HACKY part
                $model->scenario = 'step2';
			
                if($model->save()) {
    			    if(!is_dir($_SERVER['DOCUMENT_ROOT'] . '/users/'.$model->id)) mkdir($_SERVER['DOCUMENT_ROOT'] . '/users/'.$model->id); 
                 
                    $key = '';
                    $key = hash('md5','uid='.$model->id.'&activate=1');
                 
                    $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
    				$subject='=?UTF-8?B?'.base64_encode('Регистрация на НМ').'?=';
    				$headers="MIME-Version: 1.0\r\n".
    					"Content-Type: text/plain; charset=UTF-8";
                    $msg="Подтвердите регистрацию! Ссылка - <a href='".$this->createUrl('/register/confirm',array('uid'=>$model->id,'key'=>$key))."'>подтвердить</a>
                    <br />Если Ваш браузер не открывает ссылку, скопируйте ее адрес в браузер - ".$this->createUrl('/register/confirm',array('uid'=>$model->id,'key'=>$key));
                 
                    //if(mail($model->email,$subject,$msg,$headers)) {
    	           if(Users::mailsend($model->email,'hm164@mail.ua',$subject,$msg)) {
                        Yii::app()->user->setFlash('create','На Ваш email отправлено письмо для подтверждения регистрации.');
                        //$this->render('activate',array('model'=>$model));
                        //sleep(100);
                        //$this->redirect(array('/profile/view','id'=>$model->id));
                    }   
    	            else throw new CHttpException(500,'Error send mail().');
                    
                    $this->render('activate',array(
            			'model'=>$model,
            		));
                }
            } else {
                /*echo "not valid"; 
                echo CActiveForm::validate($model);
                Yii::app()->end();*/
                $this->render('step2',array('model'=>$model,));
            }
		}
        else {       
            $this->render('step2',array('model'=>$model,));
        }
	}

	public function actionStep3()
	{
		if(isset($_GET['uid']))
        {
            $user=$this->loadModel(intval($_GET['uid']));
            if(is_object($user))
            {
                $this->render('step3');
            }
            else
                $this->redirect('/site/login');
        }
	}
    
    public function actions(){
        return array(
            'captcha'=>array(
                'class'=>'CCaptchaAction',
            ),
        );
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Users('ajax');

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);
        if(isset($_POST['ajax']) && $_POST['ajax']==='users-form') //тут ajax-валидация
		{
			$model->setScenario('spam');
            $model->verifyCode = $_POST['Users']['verifyCode'];
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['Users']))
		{
  		//print_r($_POST); exit();
			$model->name = $_POST['Users']['name'];
            //$model->login = $_POST['Users']['login'];
            $model->email = $_POST['Users']['email'];
            $model->password = $_POST['Users']['password'];
            $model->member = $_POST['Users']['member'];
            $model->verifyCode = $_POST['Users']['verifyCode'];
            $model->tos = $_POST['Users']['tos'];
            
			if($model->save()) {
			    if(!is_dir($_SERVER['DOCUMENT_ROOT'] . '/users/'.$model->id)) mkdir($_SERVER['DOCUMENT_ROOT'] . '/users/'.$model->id); 
             
                $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode('Регистрация на НМ').'?=';
				$headers="MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";
                $msg="Подтвердите регистрацию! Ссылка - <a href='".Yii::app()->request->hostInfo.$this->createUrl('/register/confirm',array('uid'=>$model->id,'activate'=>1))."'>подтвердить</a>
                <br />Если Ваш браузер не открывает ссылку, скопируйте ее адрес в браузер - ".Yii::app()->request->hostInfo.$this->createUrl('/register/confirm',array('uid'=>$model->id,'activate'=>1));
             
                //if(mail($model->email,$subject,$msg,$headers)) {
	           if(Users::mailsend($model->email,'hm164@mail.ua',$subject,$msg)) {
                    Yii::app()->user->setFlash('create','На Ваш email отправлено письмо для подтверждения регистрации.');
                    //$this->render('activate',array('model'=>$model));
                    //sleep(100);
                    //$this->redirect(array('/profile/view','id'=>$model->id));
                }   
	            else throw new CHttpException(500,'Error send mail().');
                
                $this->render('activate',array(
        			'model'=>$model,
        		));
            }
		}

		/*$this->render('step2',array(
			'model'=>$model,
            'model_search'=>$_POST['Users']['member']
		));*/
	}
    
    public function actionConfirm($uid, $key)
	{
        $model=$this->loadModel($uid);
        $key_hash = hash('md5','uid='.$uid.'&activate=1');
        //$model->activate=1;   
        //echo $model->activate; exit();
        if($key == $key_hash) {
            if($model->activate!=1) {
                if($model->updateByPk($uid,array('activate'=>1))) {
                    if($model->member==1)
        				//$this->render('step3',array('uid'=>$uid));
                        $this->redirect(array('/register/step3?uid='.$uid));
                    else {
                        $this->redirect(array('/site/login'));
                        //Yii::app()->user->setFlash('account_activated','1');
                        
                    }
                }
                else 
                        //echo CHtml::errorSummary($model); exit();
                        $this->redirect(array('/site/login'));
            }
            else $this->redirect('/site/login'); 
        } else {
            throw new CHttpException(500,'Ошибка активации аккаунта.');
        }             	   
    }
    
    public function actionCreate_occ()
	{
        $model=new Occupation;
        if(isset($_POST['Occupation']))
		{
            $cat=Occupation::model()->countByAttributes(array('cat_id'=>$_POST['Occupation']['cat_id'], 'name'=>$_POST['Occupation']['name']));
            if($cat<=0) {
                $templ=Occupation::model()->findByAttributes(array('cat_id'=>$_POST['Occupation']['cat_id']));
                
                $model->name = $_POST['Occupation']['name']; 
                $model->cat_id = $_POST['Occupation']['cat_id'];
                $model->templ = $templ->templ;
                if($model->save()) {
                    Yii::app()->user->setFlash('create_occ','1');
    				//$this->redirect(array('/register/step3/uid/'.$_POST['uid'],'add'=>1));
                    $this->actionAdd_occ($model->id,$_POST['uid']);
                } 
                else print_r($model->getErrors());  
            }
            else {
                Yii::app()->user->setFlash('add_occ','1');
                //$this->redirect(array('/register/step3/uid/'.$_POST['uid']));
                $this->actionAdd_occ($cat->id,$_POST['uid']);
            }
        }
            	   
    }
    
    public function actionAdd_occ($id, $uid)
	{
        //$model=new Users;
        if(!empty($id) && !empty($uid))
		{
            $model=$this->loadModel($uid);
            $model->occupation_id = $id; 
            $model->gender='';
            $model->setScenario('add_occ');
            
            if($id==17) $model->member_type='pro';
            
            if($model->save()) {
                Yii::app()->user->setFlash('account_activated','1');
                $_SESSION['confirm']='ok';
				$this->redirect(array('/my/profile'));
            } 
            else print_r($model->getErrors());   
        }
            	   
    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	   if(Yii::app()->user->isGuest) {
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('index',array(
			'model'=>$model,
		));
       }
       else {
        $this->redirect(array('/'));
       }
    }
    
    public function actionGenresublist()
    {
        $data_genre=Genre::model()->findAll('occ_id=:occ_id', array(':occ_id'=>(int) $_POST['Users']['occupation_id']));
     
        $data_genre=CHtml::listData($data_genre,'id','name');
        foreach($data_genre as $value=>$name) {
            $data_genre[$value]=iconv('utf-8','windows-1251',CHtml::encode($name));
        }
        echo CHtml::checkBoxList('genre_id','',$data_genre,array('class'=>'checkbox_normal'));
        /*foreach($data_genre as $value=>$name)
        {
            echo CHtml::tag('checkbox', array('value'=>$value),iconv('utf-8','windows-1251',CHtml::encode($name)),true);
        }*/
        
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Users the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Users $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}