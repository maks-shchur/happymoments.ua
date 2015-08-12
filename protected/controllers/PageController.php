<?php

class PageController extends Controller
{
	public function actionAbout()
	{
		//$this->render('about');
        $model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
			    $to = 'triongroup@gmail.com'; 
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				if(mail($to,$subject,$model->body,$headers))
                {
                    Yii::app()->user->setFlash('contact','Спасибо за Ваш интерес к порталу HappyMoments.ua!<br />Ваше обращение будет рассмотрено в самое ближайщее время.');
				    $this->refresh('true','?contact=send');    
                } else {
                    $this->refresh('true','?contact=error');
                }
				
			}
		}
		$this->render('about',array('model'=>$model));
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
    
    /**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('about',array('model'=>$model));
	}
}