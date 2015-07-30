<?php

class CalendarController extends Controller
{
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
				'actions'=>array('index','add','delete'),
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
    
    public function actionAdd()
	{
		if(isset($_POST['date']))
        {
            $day=explode('__',$_POST['date']);
            
            $model=new Calendar;
            $model->uid=Yii::app()->user->id;
            $model->day=$day[2]."-".$day[1]."-".$day[0];
            
            $model->save();
        }
	}

	public function actionDelete()
	{
		if(isset($_POST['date']))
        {
            $day=explode('__',$_POST['date']);
            
            Calendar::model()->deleteAllByAttributes(array('uid'=>Yii::app()->user->id,'day'=>$day[2]."-".$day[1]."-".$day[0]));
        }
	}

	public function actionIndex()
	{
		$model=Users::model()->findByPk(Yii::app()->user->id);
	   
		$this->render('index',array(
			'model'=>$model,
		));
	}
    
    public function loadModel($id)
	{
         
		$model=Calendar::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}