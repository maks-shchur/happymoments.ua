<?php

class NewsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update'),
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
		$model=new News;
        $ih=new CImageHandler();
        
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
            if(isset($_POST['News']['foto_main'])) {
                $model->foto_main=CUploadedFile::getInstance($model,'foto_main');
                $path=Yii::getPathOfAlias('webroot').'/upload/'.$model->foto_main->getName();
                $model->foto_main->saveAs($path);
                
                $ih
                    ->load($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto_main->getName())                    
                    ->resize(270, 270)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto_main->getName());
                $model->foto_main=$model->foto_main->getName();
            }
           if(isset($_POST['News']['foto1'])) {
                $model->foto1=CUploadedFile::getInstance($model,'foto1');
                $path=Yii::getPathOfAlias('webroot').'/upload/'.$model->foto1->getName();
                $model->foto1->saveAs($path);
                
                $ih
                    ->load($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto1->getName())                   
                    ->resize(477, 297)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto1->getName())
                    ->reload()
                    ->adaptiveThumb(88, 84)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/thumb_'.$model->foto1->getName());
                $model->foto1=$model->foto1->getName();
            }
            if(isset($_POST['News']['foto2'])) {
                $model->foto2=CUploadedFile::getInstance($model,'foto2');
                $path=Yii::getPathOfAlias('webroot').'/upload/'.$model->foto2->getName();
                $model->foto2->saveAs($path);
                
                $ih
                    ->load($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto2->getName())                   
                    ->resize(477, 297)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto2->getName())
                    ->reload()
                    ->adaptiveThumb(88, 84)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/thumb_'.$model->foto2->getName());
                $model->foto1=$model->foto2->getName();
            }
            if(isset($_POST['News']['foto3'])) {
                $model->foto3=CUploadedFile::getInstance($model,'foto3');
                $path=Yii::getPathOfAlias('webroot').'/upload/'.$model->foto3->getName();
                $model->foto3->saveAs($path);
                
                $ih
                    ->load($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto3->getName())                   
                    ->resize(477, 297)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto3->getName())
                    ->reload()
                    ->adaptiveThumb(88, 84)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/thumb_'.$model->foto3->getName());
                $model->foto3=$model->foto3->getName();
            }
            if(isset($_POST['News']['foto4'])) {
                $model->foto4=CUploadedFile::getInstance($model,'foto4');
                $path=Yii::getPathOfAlias('webroot').'/upload/'.$model->foto4->getName();
                $model->foto4->saveAs($path);
                
                $ih
                    ->load($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto4->getName())                   
                    ->resize(477, 297)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto4->getName())
                    ->reload()
                    ->adaptiveThumb(88, 84)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/thumb_'.$model->foto4->getName());
                $model->foto4=$model->foto4->getName();
            }
            if(isset($_POST['News']['foto5'])) {
                $model->foto5=CUploadedFile::getInstance($model,'foto5');
                $path=Yii::getPathOfAlias('webroot').'/upload/'.$model->foto5->getName();
                $model->foto5->saveAs($path);
                
                $ih
                    ->load($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto5->getName())                   
                    ->resize(477, 297)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto5->getName())
                    ->reload()
                    ->adaptiveThumb(88, 84)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/thumb_'.$model->foto5->getName());
                $model->foto5=$model->foto5->getName();
            }
            		  
          
          
			$model->attributes=$_POST['News'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
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
        //print_r($_POST); exit();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
            if(!empty($_POST['News']['foto_main'])) {
                $model->foto_main=CUploadedFile::getInstance($model,'foto_main');
                $path=Yii::getPathOfAlias('webroot').'/upload/'.$model->foto_main->getName();
                $model->foto_main->saveAs($path);
                
                $ih
                    ->load($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto_main->getName())                    
                    ->resize(270, 270)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto_main->getName());
                $model->foto_main=$model->foto_main->getName();
            }
           if(!empty($_POST['News']['foto1'])) {
                $model->foto1=CUploadedFile::getInstance($model,'foto1');
                $path=Yii::getPathOfAlias('webroot').'/upload/'.$model->foto1->getName();
                $model->foto1->saveAs($path);
                
                $ih
                    ->load($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto1->getName())                   
                    ->resize(477, 297)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto1->getName())
                    ->reload()
                    ->adaptiveThumb(88, 84)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/thumb_'.$model->foto1->getName());
                $model->foto1=$model->foto1->getName();
            }
            if(!empty($_POST['News']['foto2'])) {
                $model->foto2=CUploadedFile::getInstance($model,'foto2');
                $path=Yii::getPathOfAlias('webroot').'/upload/'.$model->foto2->getName();
                $model->foto2->saveAs($path);
                
                $ih
                    ->load($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto2->getName())                   
                    ->resize(477, 297)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto2->getName())
                    ->reload()
                    ->adaptiveThumb(88, 84)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/thumb_'.$model->foto2->getName());
                $model->foto1=$model->foto2->getName();
            }
            if(!empty($_POST['News']['foto3'])) {
                $model->foto3=CUploadedFile::getInstance($model,'foto3');
                $path=Yii::getPathOfAlias('webroot').'/upload/'.$model->foto3->getName();
                $model->foto3->saveAs($path);
                
                $ih
                    ->load($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto3->getName())                   
                    ->resize(477, 297)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto3->getName())
                    ->reload()
                    ->adaptiveThumb(88, 84)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/thumb_'.$model->foto3->getName());
                $model->foto3=$model->foto3->getName();
            }
            if(!empty($_POST['News']['foto4'])) {
                $model->foto4=CUploadedFile::getInstance($model,'foto4');
                $path=Yii::getPathOfAlias('webroot').'/upload/'.$model->foto4->getName();
                $model->foto4->saveAs($path);
                
                $ih
                    ->load($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto4->getName())                   
                    ->resize(477, 297)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto4->getName())
                    ->reload()
                    ->adaptiveThumb(88, 84)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/thumb_'.$model->foto4->getName());
                $model->foto4=$model->foto4->getName();
            }
            if(!empty($_POST['News']['foto5'])) {
                $model->foto5=CUploadedFile::getInstance($model,'foto5');
                $path=Yii::getPathOfAlias('webroot').'/upload/'.$model->foto5->getName();
                $model->foto5->saveAs($path);
                
                $ih
                    ->load($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto5->getName())                   
                    ->resize(477, 297)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/'.$model->foto5->getName())
                    ->reload()
                    ->adaptiveThumb(88, 84)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/upload/thumb_'.$model->foto5->getName());
                $model->foto5=$model->foto5->getName();
            }		  
          
			$model->attributes=$_POST['News'];
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
		/*$dataProvider=new CActiveDataProvider('News');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
        $model=new News('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['News']))
			$model->attributes=$_GET['News'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new News('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['News']))
			$model->attributes=$_GET['News'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return News the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=News::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param News $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
