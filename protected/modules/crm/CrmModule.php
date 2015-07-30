<?php

class CrmModule extends CWebModule
{
    public $layout = 'crm.views.layouts.main';
    
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'crm.models.*',
			'crm.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			if(!Yii::app()->user->isGuest && Yii::app()->user->isCrm)
			    return true;
            else
                Controller::redirect('/site/login');
		}
		else
			return false;
	}
}
