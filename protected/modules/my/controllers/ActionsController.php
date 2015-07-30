<?php

class ActionsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','view','create','update','delete'),
				'expression' => '!Yii::app()->user->isGuest && Yii::app()->user->member_type != "basic"',
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
		$model=new Actions;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Actions']))
		{
			if(isset($_POST['Actions']['price']))
                $_POST['Actions']['price']=preg_replace("/\s/", "", $_POST['Actions']['price']);
            
            $model->attributes=$_POST['Actions'];
            
            if(!empty($_FILES['Actions']['name']['picture'])) {
                $model->picture=CUploadedFile::getInstance($model,'picture');
                
                $fileName=$model->picture->getName();
                if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName))
                    $fileName=substr($fileName,0,-4).rand(1,1000).substr($fileName,-4);
        
                
                $ih=new CImageHandler();
                $ih
                    ->load($model->picture->getTempName())
                    ->adaptiveThumb(304,217)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/304_'.$fileName)
                    ->reload()
                    ->adaptiveThumb(267,290)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/267_'.$fileName)
                    ->reload()
                    ->adaptiveThumb(568,316)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/568_'.$fileName)
                    ->reload()
                    ->adaptiveThumb(721,377)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/721_'.$fileName)
                    ->reload()                   
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName);
                    
                $model->picture=$fileName;
            }
            
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'action'=>$model,
            'model'=>Users::model()->findByPk(Yii::app()->user->id),
		));
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
		$this->performAjaxValidation($model);

		if(isset($_POST['Actions']))
		{            
		  //print_r($_POST['Actions']);           
            if($_POST['Actions']['picture2']!='not') {
                if(!empty($_FILES['Actions']['name']['picture'])) {
                    if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$model->picture))
                        unlink($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$model->picture);
                    if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/304_'.$model->picture))
                        unlink($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/304_'.$model->picture);
                    if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/267_'.$model->picture))
                        unlink($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/267_'.$model->picture);
                    if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/568_'.$model->picture))
                        unlink($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/568_'.$model->picture);
                    if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/721_'.$model->picture))
                        unlink($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/721_'.$model->picture);
                        
                    
                    $model->picture=CUploadedFile::getInstance($model,'picture');
                    
                    $fileName=$model->picture->getName();
                    if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName))
                        $fileName=substr($fileName,0,-4).rand(1,1000).substr($fileName,-4);
            
                    
                    $ih=new CImageHandler();
                    $ih
                        ->load($model->picture->getTempName())
                        ->adaptiveThumb(304,217)
                        ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/304_'.$fileName)
                        ->reload()
                        ->adaptiveThumb(267,290)
                        ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/267_'.$fileName)
                        ->reload()
                        ->adaptiveThumb(568,316)
                        ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/568_'.$fileName)
                        ->reload()
                        ->adaptiveThumb(721,377)
                        ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/721_'.$fileName)
                        ->reload()                   
                        ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName);
                        
                    //$model->picture=$fileName;
                    $_POST['Actions']['picture']==$fileName;
                }
            } else {
                $_FILES['Actions']['name']['picture'] = $_POST['old_picture'];
                $_POST['Actions']['picture'] = $_POST['old_picture'];
            }
            if(isset($_POST['Actions']['price']))
                $_POST['Actions']['price']=preg_replace("/\s/", "", $_POST['Actions']['price']);
            $model->attributes=$_POST['Actions'];
            //print_r($model->attributes);
            
			if($model->save())
				$this->redirect(array('index'));
            else { 
                print_r($model->getErrors());
                die;
            }    
		}

		$this->render('update',array(
			'action'=>$model,
            'model'=>Users::model()->findByPk(Yii::app()->user->id),
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        $m=$this->loadModel($id);	   
		if($m->uid==Yii::app()->user->id){
            if(is_file(Yii::getPathOfAlias('webroot').'/users/'.Yii::app()->user->id.'/'.$m->picture))
                unlink(Yii::getPathOfAlias('webroot').'/users/'.Yii::app()->user->id.'/'.$m->picture);
            if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/267_'.$m->picture))
                unlink($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/267_'.$m->picture);
            if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/304_'.$m->picture))
                unlink($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/304_'.$m->picture);
            if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/568_'.$m->picture))
                unlink($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/568_'.$m->picture);
            if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/721_'.$m->picture))
                unlink($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/721_'.$m->picture);
            
            $m->delete();
            return true;		    
		}    
        else
            throw new CHttpException(404,'The requested action does not exist.');
       
		/*$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));*/
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	   $dataProvider=new CActiveDataProvider('Actions',array(
                'criteria'=>array(
                    'order'=>'id desc',
                    'condition'=>'uid='.Yii::app()->user->id,
                )
        ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'model'=>Users::model()->findByPk(Yii::app()->user->id),
		));
       
		/*$dataProvider=new CActiveDataProvider('Actions');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Actions('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Actions']))
			$model->attributes=$_GET['Actions'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Actions the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Actions::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Actions $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='actions-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
