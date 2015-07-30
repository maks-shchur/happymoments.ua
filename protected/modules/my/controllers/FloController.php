<?php

class FloController extends Controller
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
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','delete'),
				//'users'=>array('@'),
                'expression' => '!Yii::app()->user->isGuest && Yii::app()->user->role == 6',
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
		$model=new Flo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Flo']))
		{
			$model->attributes=$_POST['Flo'];
            $model->picture=CUploadedFile::getInstance($model,'picture');
            
            $fileName=$model->picture->getName();
            if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName))
                $fileName=substr($fileName,0,-4).rand(1,1000).substr($fileName,-4);
    
            
            $ih=new CImageHandler();
            $ih
                ->load($model->picture->getTempName())                    
                ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName);
                
            $model->picture=$fileName;    
                
			if($model->save()) {
			    //$path=Yii::getPathOfAlias('webroot').'/users/'.Yii::app()->user->id.'/'.$model->picture->getName();
                //$model->picture->saveAs($path); 
				$this->redirect(array('index'));
            }
		}

		$this->render('create',array(
			'model'=>$model,
            'user'=>Users::model()->findByPk(Yii::app()->user->id),
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
		// $this->performAjaxValidation($model);

		if(isset($_POST['Flo']))
		{
			$model->attributes=$_POST['Flo'];
            
            if($_POST['Flo']['picture']!='') {
                unlink($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$model->picture);
                $model->picture=CUploadedFile::getInstance($model,'picture');
                
                $fileName=$model->picture->getName();
                if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName))
                    $fileName=substr($fileName,0,-4).rand(1,1000).substr($fileName,-4);
        
                
                $ih=new CImageHandler();
                $ih
                    ->load($model->picture->getTempName())                    
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName);
                    
                $model->picture=$fileName;
            }
            
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
            'user'=>Users::model()->findByPk(Yii::app()->user->id),
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
            $m->delete();
            return true;		    
		}    
        else
            throw new CHttpException(404,'The requested good does not exist.'); 
        
        
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//if(!isset($_GET['ajax']))
		//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Flo',array(
            'criteria'=>array(
                'order'=>'id desc',
                'condition'=>'uid='.Yii::app()->user->id,
                )
        ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'user'=>Users::model()->findByPk(Yii::app()->user->id),
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Flo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Flo']))
			$model->attributes=$_GET['Flo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Flo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Flo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Flo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='flo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
