<?php

class FavoritesController extends Controller
{
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
				'actions'=>array('index','delete'),
				'users'=>array('@')
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
    
	public function actionDelete($id)
	{
		$m=$this->loadModel($id);	   
		if($m->uid==Yii::app()->user->id) {
            $m->delete();    
        }
        else
            throw new CHttpException(404,'The requested user does not exist.');      

        $b=Yii::app()->getRequest()->getParam('back_url');

        $this->redirect($b!='' ? $b : array('index'));
	}

	public function actionIndex()
	{
		$this->render('index',array(
			'dataProvider'=>Favorites::model()->findAllByAttributes(array('uid'=>Yii::app()->user->id)),
            'model'=>Users::model()->findByPk(Yii::app()->user->id),
		));
	}
    
    public function loadModel($id)
	{
		$model=Favorites::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested user does not exist.');
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