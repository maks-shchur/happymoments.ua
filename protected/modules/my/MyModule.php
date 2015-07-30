<?php

class MyModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'my.models.*',
			'my.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			if(!Yii::app()->user->isGuest)
			    return true;
            else
                Controller::redirect('/site/login');
    
		}
		else
			return false;
	}
}