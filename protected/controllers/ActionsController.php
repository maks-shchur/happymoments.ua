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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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
		$model = $this->loadModel($id);
        $sameActions = Actions::model()->findAllBySql('select * from {{actions}} where occupation_id='.$model->occupation_id.' and id!='.$id.' and date_end>="'.date('Y-m-d').'" and picture!="" limit 2');
        
        $this->render('view',array(
			'model'=>$model,
            'sameActions'=>$sameActions
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
		// $this->performAjaxValidation($model);

		if(isset($_POST['Actions']))
		{
			$model->attributes=$_POST['Actions'];
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Actions']))
		{
			$model->attributes=$_POST['Actions'];
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
        $this->processPageRequest('page');
        
        $criteria = new CDbCriteria();
            
        $criteria->with='user';
        
        $criteria->condition='date_end>="'.date('Y-m-d').'" and picture<>""';
        
        if(!empty($_POST['city'])) {
            $criteria->addCondition('user.city_id='.$_POST['city']);    
        }
        else {
            if(isset(Yii::app()->request->cookies['city']))
                $criteria->addCondition('user.city_id='.Yii::app()->request->cookies['city']->value);   
        }
        if(!empty($_POST['name'])) {
            $criteria->addCondition('user.name like "%'.$_POST['name'].'%"');    
        }
        if(!empty($_POST['discount'])) {
            $criteria->addCondition('sale>='.$_POST['discount']);    
        }
        if(!empty($_POST['price_to'])) {
            $criteria->addCondition('price<='.$_POST['price_to']);    
        }
        if(!empty($_POST['date'])) {
            if($_POST['date']=='d') 
                $criteria->addCondition('date_start="'.date('Y-m-d').'"');
            if($_POST['date']=='w') 
                $criteria->addCondition('date_start>="'.date('Y-m-d', strtotime('-7 days')).'" and date_start<="'.date('Y-m-d').'"');
            if($_POST['date']=='m') 
                $criteria->addCondition('date_start>="'.date('Y-m-d', strtotime('-30 days')).'" and date_start<="'.date('Y-m-d').'"'); //date("Y-m-d" ,time()-60*60*24*31)       
        }
        
        $criteria->order='date_end desc, name asc';
        $dataProvider=new CActiveDataProvider('Actions', array(
                'criteria' => $criteria,
                'pagination'=>array(
                    'pageSize'=>10,
                    'pageVar' =>'page',
                ),
        ));
        
        if (Yii::app()->request->isAjaxRequest){
            $this->renderPartial('_loop', array(
                'dataProvider'=>$dataProvider,
            ));
            Yii::app()->end();
        } else {
            $this->render('index', array(
                'dataProvider'=>$dataProvider,
            ));
        }	   
       
		/*$dataProvider=new CActiveDataProvider('Actions');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
	}
    
    protected function processPageRequest($param='page')
    {
        if (Yii::app()->request->isAjaxRequest && isset($_POST[$param]))
            $_GET[$param] = Yii::app()->request->getPost($param);
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
