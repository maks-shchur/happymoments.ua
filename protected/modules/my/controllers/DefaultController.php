<?php

class DefaultController extends Controller
{
	public function accessRules()
	{
		return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index'),
				'users'=>array('*'),
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
		if (!Yii::app()->user->isGuest) {
            $this->redirect('/my/profile');
        }
        else {
            $this->redirect(array('/site/login'));
        }
	}
}