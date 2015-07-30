<?php

class PageController extends Controller
{
	public function actionAbout()
	{
		$this->render('about');
	}

	public function actionHelp_us()
	{
		$this->render('help_us');
	}
    
    public function actionHmagent()
	{
		$this->render('hmagent');
	}
    
    public function actionAccounts()
	{
		$this->render('accounts');
	}

	public function actionIndex()
	{
		$this->redirect('/');
	}

	public function actionNews($id='')
	{
		if($id!='') {
		    $model=News::model()->findByPk($id);
            $this->render('_news', array('model'=>$model));    
		}
        else {
            $model=News::model()->findAll('title<>"" order by id desc');
            $this->render('news', array('model'=>$model));    
        }
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
    
    public function actionPolitic()
	{
	    $model=Pages::model()->multilang()->findByAttributes(array('type'=>'politic'));  
		$this->render('politic',array('model'=>$model));
	}
    
    public function actionUser_agreement()
	{
	    $model=Pages::model()->multilang()->findByAttributes(array('type'=>'user_agriment'));  
		$this->render('user_agreement',array('model'=>$model));
	}
    
    public function actionAuthor()
	{
	    $model=Pages::model()->multilang()->findByAttributes(array('type'=>'author'));  
		$this->render('author',array('model'=>$model));
	}
}