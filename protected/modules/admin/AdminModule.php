<?php

class AdminModule extends CWebModule
{
    public $layout = 'admin.views.layouts.main';
    
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			if(!Yii::app()->user->isGuest && Users::model()->findByPk(Yii::app()->user->id)->admin==1)
			    return true;
            else
                Controller::redirect('/site/login');
		}
		else
			return false;
	}
}
