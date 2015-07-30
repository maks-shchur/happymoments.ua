<?php

class TendersController extends Controller
{
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
				'actions'=>array('index','view','create','update','delete','genresublist','myorders','genreddlist'),
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
		$model=new Tenders;
        $user=Users::model()->findByPk(Yii::app()->user->id);
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
        
		if(isset($_POST['Tenders']))
		{
		  //print_r($_POST); exit();
			$model->attributes=$_POST['Tenders'];
            //print_r($model->attributes); exit();
			if($model->validate() && $model->save())
				$this->redirect('/my/tenders');
            //else print_r($model->getErrors()); 
		}

		$this->render('create',array(
			'model_t'=>$model,
            'model'=>$user,
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
        $user=Users::model()->findByPk(Yii::app()->user->id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tenders']))
		{
			$model->attributes=$_POST['Tenders'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model_t'=>$model,
            'model'=>$user,
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
		if($m->uid==Yii::app()->user->id) {
		  $m->delete(); 
        }

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Tenders', array('criteria'=>array(
                    'select'=> '*',
                    'condition'=>'uid=:uid order by date_end desc',
                    'params'=>array(':uid'=>Yii::app()->user->id),
             )));
        $user=Users::model()->findByPk(Yii::app()->user->id);
        
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'model'=>$user,
		));
	}
    
    public function actionMyorders()
	{
		$criteria = new CDbCriteria();
        $criteria->with=array('tenders');
        $criteria->condition='`t`.`uid` = :userid';
        $criteria->params=array(':userid'=>Yii::app()->user->id);
        $criteria->order='date_end DESC';
        $dataProvider = new CActiveDataProvider('TenderOrders',array('criteria'=>$criteria));

        /*$dataProvider=new CActiveDataProvider('Tenders', array('criteria'=>array(
                    'select'=> '*',
                    'condition'=>'uid=:uid order by date_end desc',
                    'params'=>array(':uid'=>Yii::app()->user->id)
             )));*/
             
        $user=Users::model()->findByPk(Yii::app()->user->id);
        
		$this->render('orders',array(
			'dataProvider'=>$dataProvider,
            'model'=>$user,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Tenders('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tenders']))
			$model->attributes=$_GET['Tenders'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Tenders the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Tenders::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Tenders $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tenders-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionGenresublist()
    {
        $data_genre=Genre::model()->findAll('occ_id=:occ_id', array(':occ_id'=>(int) $_POST['Tenders']['occupation']));
     
        if(!empty($data_genre)) {
            $data_genre=CHtml::listData($data_genre,'id','name');
            echo CHtml::checkBoxList('Tenders[genre]','',$data_genre);
        }
        else echo '';                
    }
    
    public function actionGenreddlist()
    {
        $data_genre=Genre::model()->findAll('occ_id=:occ_id', array(':occ_id'=>(int) $_POST['Tenders']['occupation']));
     
        if(!empty($data_genre)) {
            $data_genre=CHtml::listData($data_genre,'id','name');
            echo CHtml::dropDownList('Tenders[genre]','',$data_genre,array('class'=>'default__input'));
        }
        else echo '';                
    }    
}
