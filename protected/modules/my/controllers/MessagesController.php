<?php

class MessagesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','delete','sent','answer'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('update','delete'),
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
        $model=$this->loadModel($id);
        $user=new Users;
        
        if($model->to_uid==Yii::app()->user->id) {
            if($model->is_read==0) {
                $model->updateByPk($id,array('is_read'=>1));
                //$model->is_read=1;
                //$model->save();
            }
            
    		$this->render('view',array(
    			'model'=>$model,
                'user'=>$user->model()->findByPk(Yii::app()->user->id),
    		));
        }
        else throw new CHttpException(500,'The requested message does not exist.');
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Messages;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Messages']))
		{
			$model->attributes=$_POST['Messages'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
    
    public function actionAnswer()
	{
		$model=new Messages;

		if(isset($_POST['answer']))
		{
			$model->from_uid=$_POST['from_uid'];
            $model->to_uid=$_POST['to_uid'];
            $model->title=$_POST['title'];
            $model->msg=CHtml::encode($_POST['answer']).'<br />---------------------------------------<br /><i>'.$_POST['msg'].'</i>';
            
			if($model->save()) {
			    Messages::sendNotify($model->to_uid);
				$this->redirect(array('index'));
            }
		}

		$this->render('view',array(
			'model'=>$this->loadModel($_POST['from_uid'])
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

		if(isset($_POST['Messages']))
		{
			$model->attributes=$_POST['Messages'];
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
		$m=$this->loadModel($id);	   
		if($m->to_uid==Yii::app()->user->id) {
            $m->delete(); 
            //$this->redirect(array('index'));
        }

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//if(!isset($_GET['ajax']))
		//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	*/ 
	public function actionIndex()
	{
		//$dataProvider=new CActiveDataProvider('Messages');
        $dataProvider = new CActiveDataProvider('Messages', array('criteria'=>array(
                    'select'=> '*',
                    'order'=>'id DESC',
                    'condition'=>'to_uid=:to_uid',
                    'params'=>array(':to_uid'=>Yii::app()->user->id)
                    )));
        $user=new Users;

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'user'=>$user->model()->findByPk(Yii::app()->user->id),
		));
	}
    
    public function actionSent()
	{
		//$dataProvider=new CActiveDataProvider('Messages');
        $dataProvider = new CActiveDataProvider('Messages', array('criteria'=>array(
                    'select'=> '*',
                    'condition'=>'from_uid=:from_uid',
                    'params'=>array(':from_uid'=>Yii::app()->user->id)
                    )));
        $user=new Users;
		$this->render('sent',array(
			'dataProvider'=>$dataProvider,
            'user'=>$user->model()->findByPk(Yii::app()->user->id),
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
	    $dataProvider=new CActiveDataProvider('Messages');   
		$model=new Messages('search');
        $user=new Users;
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Messages']))
			$model->attributes=$_GET['Messages'];

		$this->render('index',array(
			'model'=>$model,
            'user'=>$user->model()->findByPk(Yii::app()->user->id),
            'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Messages the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Messages::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Messages $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='messages-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
