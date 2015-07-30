<?php

class AvtoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('index','view','create','update','delete','upload','render','setcover', 'deletefile'),
				//'users'=>array('@'),
                'expression' => '!Yii::app()->user->isGuest && Yii::app()->user->role == 5',
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
		$model=new Avto;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Avto']))
		{
			$model->attributes=$_POST['Avto'];
			if($model->save())
				$this->redirect('update/id/'.$model->id.'?new');
		}

		$this->render('create',array(
			'model'=>$model,
            'user'=>Users::model()->findByPk(Yii::app()->user->id),
            'files'=>Files::model()->findAllByAttributes(array('uid'=>Yii::app()->user->id,'source'=>'avto')),
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
		$this->performAjaxValidation($model);

		if(isset($_POST['Avto']))
		{
			$model->attributes=$_POST['Avto'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
            'user'=>Users::model()->findByPk(Yii::app()->user->id),
            'files'=>Files::model()->findAllByAttributes(
                    array(
                        'uid'=>Yii::app()->user->id,
                        'source'=>'avto',
                        'portfolio_id'=>$model->id,
                    )
            ),
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
            $f=Files::model()->findAllByAttributes(array('uid'=>$m->uid,'source'=>'avto','portfolio_id'=>$m->id));
            foreach($f as $item) {
                if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.$m->uid.'/'.$item->file))
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/users/'.$m->uid.'/'.$item->file);
                if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.$m->uid.'/avto304_'.$item->file))
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/users/'.$m->uid.'/avto304_'.$item->file);
                if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.$m->uid.'/avto350_'.$item->file))
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/users/'.$m->uid.'/avto350_'.$item->file);    
                Files::model()->findByPk($item->id)->delete();
            }		            
            $m->delete();    
        }
        else
            throw new CHttpException(404,'The requested car does not exist.');      

        $b=Yii::app()->getRequest()->getParam('back_url');

        $this->redirect($b!='' ? $b : array('index'));
        
        
        //$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//if(!isset($_GET['ajax']))
		//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
    
   	public function actionDeletefile($id,$pid)
	{
		$m=$this->loadModel($pid);	   
		if($m->uid==Yii::app()->user->id) {
            $f=Files::model()->findByPk($id);
            if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.$m->uid.'/'.$f->file))
                unlink($_SERVER['DOCUMENT_ROOT'] . '/users/'.$m->uid.'/'.$f->file);
            $f->delete();
        }
        else
            throw new CHttpException(404,'The requested car does not exist.');      

        $b=Yii::app()->getRequest()->getParam('back_url');

        $this->redirect($b!='' ? $b : array('index'));
    }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Avto',array(
                'criteria'=>array(
                    'condition'=>'uid='.Yii::app()->user->id,
                )
        ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'user'=>Users::model()->findByPk(Yii::app()->user->id),
		));
        /*$model=Avto::model()->findAllByAttributes(array('uid'=>Yii::app()->user->id));
        $this->render('index',array(
            'model'=>$model,
            'user'=>Users::model()->findByPk(Yii::app()->user->id),
        ));*/
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Avto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Avto']))
			$model->attributes=$_GET['Avto'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Avto the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Avto::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Avto $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='avto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionUpload($id)
    {
        //$id=Yii::app()->user->id;
        Yii::import("ext.Upload.qqFileUploader2");
 
        $folder=Yii::getPathOfAlias('webroot').'/users/'.Yii::app()->user->id.'/';// folder for uploaded files
        $allowedExtensions = array("jpg","jpeg","gif","png");//array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 8 * 1024 * 1024;// maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        
 
        $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
        $fileName=$result['filename'];//GETTING FILE NAME
        //$img = CUploadedFile::getInstance($model,'image');
        
        $ih=new CImageHandler();
        $ih
            ->load($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName)                    
            ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName)
            ->reload()
            ->adaptiveThumb(350, 232)
            ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/avto350_'.$fileName)
            ->reload()
            ->resize(304, 202)
            ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/avto304_'.$fileName);

        Yii::import("application.modules.my.models.Files");
        $mFile=new Files;
        $mFile->uid=Yii::app()->user->id;
        $mFile->file=$fileName;
        $mFile->type='photo';
        $mFile->portfolio_id=$id;
        $mFile->source='avto';
        
        if($mFile->save()) {
            //unlink($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName);
            $result['res']=$mFile->id;
        }
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        echo $return;// it's array
        //echo $ret;
    }
    
    public function actionRender()
    {
        Yii::import("application.modules.my.models.Files");
        $model=Files::model()->findByPk($_POST['id']);
        
        $back_url=$_POST['b_url'];
        
        $res='<figure class="plus__add__auto-park__img">
              <a href="#"><img src="/users/'.Yii::app()->user->id.'/'.$model->file.'" alt="" /></a>
                <input type="radio" id="avto_cover_'.$model->id.'" name="avto_cover" value="'.$model->file.'" onClick="setCover('.$_POST['m_id'].',\''.$model->file.'\');">
                <label for="avto_cover_'.$model->id.'">Обложка на главной</label>
                '.CHtml::link('удалить фото','/my/avto/deletefile/id/'.$model->id.'/pid/'.$_POST['m_id'].'?back_url='.$back_url,array('confirm'=>'Точно хотите удалить?')).'
            </figure>';
        
        echo $res;
    }
    
    public function actionSetcover() {
        $m=Avto::model()->findByPk($_POST['id']);
        $m->picture=$_POST['file'];
        $m->save();
    }
}
