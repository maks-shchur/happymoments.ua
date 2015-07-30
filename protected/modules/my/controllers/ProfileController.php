<?php

class ProfileController extends Controller
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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','settings','updatesettings','genresublist','updateava','addbanner','delbanner'),
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
    
	public function actionIndex()
	{
        $model=$this->loadModel(Yii::app()->user->id);
        if(isset($model->occupation->templ) && $model->occupation->templ=='members') {
            $model->scenario='genre';
        }	   
		$this->render('index',array(
			'model'=>$model,
		));
	}
    
    public function actionSettings()
	{
		$this->render('settings',array(
			'model'=>$this->loadModel(Yii::app()->user->id),
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        if($model->occupation->templ=='members') {
            $model->scenario='genre';
        }
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
            if($_POST['member']==0) {
                $model->name = $_POST['Users']['name'];
                Yii::app()->user->name = $model->name;
                $model->gender = $_POST['Users']['gender'];
                $model->date_birth = $_POST['year_b'].'-'.$_POST['month_b'].'-'.$_POST['day_b'];
                $model->birth_public = $_POST['Users']['birth_public'];
                $model->city_id = $_POST['Users']['city_id'];
                $model->email = $_POST['Users']['email'];
                $model->about = $_POST['Users']['about'];
                $model->phone = $_POST['Users']['phone'];
                $model->phone2 = $_POST['Users']['phone2'];
                $model->phone3 = $_POST['Users']['phone3'];
                
    			if($model->validate() && $model->save()) {
    			    Yii::app()->user->setFlash('success_save','1'); 
        			$this->redirect(array('index'));
                }
                /*else { 
                    echo CHtml::errorSummary($model);
                    //exit();
                }*/
           }
           if($_POST['member']==1) {
                //$model->attributes=$_POST['Users'];
                if(isset($_POST['Users']['name_studio'])) {
                    $_POST['Users']['name']=$_POST['Users']['name_studio'];
                    //unset($_POST['Users']['name_studio']);
                    $model->setScenario('studio_update');
                }
                
                
                foreach($_POST['Users'] as $k=>$v) {
                    if($k=='photo') {
                        if($v!='') $model->photo=CUploadedFile::getInstance($model,'photo'); 
                    }
                    elseif($k=='url') {
                        $v=str_replace('http://','',$v);
                        $model->$k=$v;
                    }
                    else $model->$k=$v;
                }
                if(!isset($_POST['Users']['phone2'])) $model->phone2='';
                if(!isset($_POST['Users']['phone3'])) $model->phone3='';
                if(isset($_POST['year_b']))
                    $model->date_birth = $_POST['year_b'].'-'.$_POST['month_b'].'-'.$_POST['day_b'];                
                Yii::app()->user->name = $model->name;
                //echo '<pre>'; 
                //print_r($_POST);
                //echo '</pre>';
                //exit();
                if(isset($_POST['Users']['genre_id'])) {
                    $model->genre_id=serialize($_POST['Users']['genre_id']);
                }
                               
                if($model->save()) {
                    if(isset($_POST['Users']['genre_id'])) {
                        Yii::import('application.modules.my.models.Portfolio');
                        Yii::import('application.modules.my.models.Video');
                        Yii::import('application.modules.my.models.Genre');
                        $keys=array();
                        $data='';
                        $data=Portfolio::model()->findAllByAttributes(array('uid'=>Yii::app()->user->id));
                        //print_r($data); exit();
                        if(is_array($data) && !empty($data)) {
                            //Portfolio::model()->deleteAllByAttributes(array('uid'=>Yii::app()->user->id));
                            //exit();
                                foreach($_POST['Users']['genre_id'] as $genre) {
                                    $item=Portfolio::model()->findByAttributes(array('uid'=>Yii::app()->user->id,'title'=>Genre::getName($genre)));
                                    if(count($item)>0) {
                                        $keys[]=$item->id;
                                    }
                                    else {
                                        $mod= new Portfolio;
                                        $mod->title=Genre::getName($genre);
                                        $mod->uid=Yii::app()->user->id;
                                        $mod->save(); 
                                        $keys[]=$mod->id;   
                                    }
                                }
                                $del=new Portfolio;
                                
                                $criteria=new CDbCriteria;
                                $criteria->condition='uid='.Yii::app()->user->id;
                                $criteria->addNotInCondition('id', $keys);
                                       
                                $del->deleteAll($criteria);
                        }
                        else {
                            foreach($_POST['Users']['genre_id'] as $genre) {
                                    $mod= new Portfolio;
                                    $mod->title=Genre::getName($genre);
                                    $mod->uid=Yii::app()->user->id;
                                    $mod->save();
                                    //print_r($mod);    
                                }
                            //exit();
                        }        
                        //////////VIDEO/////////////////////////
                        $keys=array();
                        $data='';
                        $data=Video::model()->findAllByAttributes(array('uid'=>Yii::app()->user->id));
                        //print_r($data); exit();
                        if(is_array($data) && !empty($data)) {
                            //Portfolio::model()->deleteAllByAttributes(array('uid'=>Yii::app()->user->id));
                            //exit();
                                foreach($_POST['Users']['genre_id'] as $genre) {
                                    $item=Video::model()->findByAttributes(array('uid'=>Yii::app()->user->id,'title'=>Genre::getName($genre)));
                                    if(count($item)>0) {
                                        $keys[]=$item->id;
                                    }
                                    else {
                                        $mod= new Video;
                                        $mod->title=Genre::getName($genre);
                                        $mod->uid=Yii::app()->user->id;
                                        $mod->save(); 
                                        $keys[]=$mod->id;   
                                    }
                                }
                                $del=new Video;
                                
                                $criteria=new CDbCriteria;
                                $criteria->condition='uid='.Yii::app()->user->id;
                                $criteria->addNotInCondition('id', $keys);
                                       
                                $del->deleteAll($criteria);
                        
                        
                        }
                        else {
                            foreach($_POST['Users']['genre_id'] as $genre) {
                                    $mod= new Video;
                                    $mod->title=Genre::getName($genre);
                                    $mod->uid=Yii::app()->user->id;
                                    $mod->save();
                                    //print_r($mod);    
                                }
                            //exit();
                        }
                    }
                    elseif(isset($_POST['Users']['hals'])) {
                        StudioHals::model()->deleteAllByAttributes(array('uid'=>Yii::app()->user->id));
                        
                        $h=1;
                        while($h<=$_POST['Users']['hals']) {
                            $mod= new StudioHals;
                            $mod->title='Зал '.$h;
                            $mod->uid=Yii::app()->user->id;
                            $mod->save();
                            $h++;
                        }    
                    }
                    
                    Yii::app()->user->setFlash('success_save','1');
        			$this->redirect(array('index'));
                }
                /*else { 
                    $this->render('index',array('model'=>$model));
                    //echo CHtml::errorSummary($model);
                    //exit();
                } */               
           }
		}
        //if(empty($_POST['Users']['genre_id']))
        //    $model->addError('genre_id','Необходимо указать жанр, в котром Вы работаете.');

		$this->render('index',array('model'=>$model));
	}
    
    public function actionUpdateava($id) {
        $model=$this->loadModel($id);
        
        if(is_file('./users/'.Yii::app()->user->id.'/'.$model->photo)) {
            unlink('./users/'.Yii::app()->user->id.'/'.$model->photo);
        }
        
        Yii::import("ext.EAjaxUpload.qqFileUploader");
 
        $folder='users/'.$id.'/';// folder for uploaded files
        $allowedExtensions = array("jpg","jpeg","gif","png");//array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 2 * 1024 * 1024;// maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
 
        $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
        $fileName=$result['filename'];//GETTING FILE NAME
        
        $ih=new CImageHandler();
        $ih
            ->load($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName)                    
            //->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$model->picture->name)
            ->adaptiveThumb(174, 174)
            //->resize(200, 200)
            ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/100_'.$fileName)
            ->reload()
            ->adaptiveThumb(290, 292)
            ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/290_'.$fileName);
        
        $model->photo = '100_'.$fileName;
        if($model->save()){
            Yii::app()->user->photo = '100_'.$fileName;
            unlink($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName);
        }
        
        //$model->photo = $fileName;
        echo $return;// it's array
    }
    
    public function actionUpdatesettings($id)
	{
		$model=$this->loadModel($id);
        $model->setScenario('updatesettings');
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if($_POST['Users']['password']!='' || $_POST['Users']['receive_email']!='')
		{
		  //print_r($_POST); exit();
            $model->setScenario('updatesttings');
			$model->attributes=$_POST['Users'];
            $model->password = $_POST['Users']['password'];
            $model->password2 = $_POST['Users']['password2'];
            $model->receive_email = $_POST['Users']['receive_email'];
            if($model->validate() && $model->save()) {
                 Yii::app()->user->setFlash('pass_save','1');
			     $this->redirect(array('settings'));
            }
            //else { 
                //echo CHtml::errorSummary($model);
                //exit();
            //}
		}

		//$model=new Users;
        $this->render('settings',array('model'=>$model));
	}

	public function actionView()
	{
		$model=new Users;
        $this->render('index',array(
			'model'=>$model->findByPk($id),
		));
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}    
    
    public function actionGenresublist()
    {
        $data_genre=Genre::model()->findAll('occ_id=:occ_id', array(':occ_id'=>(int) $_POST['Users']['occupation_id']));
     
        $data_genre=CHtml::listData($data_genre,'id','name');
        //foreach($data_genre as $value=>$name) {
        //    $data_genre[$value]=iconv('utf-8','windows-1251',CHtml::encode($name));
        //}
        echo CHtml::checkBoxList('genre_id','',$data_genre);
        /*foreach($data_genre as $value=>$name)
        {
            echo CHtml::tag('checkbox', array('value'=>$value),iconv('utf-8','windows-1251',CHtml::encode($name)),true);
        }*/
        
    }
    
    public function actionAddbanner() {
        $model=$this->loadModel(Yii::app()->user->id);
        
        Yii::import("ext.Banner.qqFileUploader3");
 
        $folder='users/'.Yii::app()->user->id.'/';// folder for uploaded files
        $allowedExtensions = array("jpg","jpeg","gif","png");//array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 8 * 1024 * 1024;// maximum file size in bytes
        $uploader = new qqFileUploader3($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
 
        $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
        $fileName=$result['filename'];//GETTING FILE NAME
        
        $ih=new CImageHandler();
        $ih
            ->load($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName)                    
            //->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$model->picture->name)
            //->reload()
            ->resize(1920, 436, false)
            ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/banner_'.$fileName);
        
        $model->top_banner = 'banner_'.$fileName;
        if($model->save()){
            //Yii::app()->user->photo = '100_'.$fileName;
            unlink($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName);
        }
        echo $return;// it's array
    }
    
    public function actionDelbanner() {
        $m=$this->loadModel(Yii::app()->user->id);
        unlink($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$m->top_banner);
        $m->top_banner='';
        if($m->save())
            $this->redirect('/my/profile');
    }
}