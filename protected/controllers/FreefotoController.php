<?php

class FreefotoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','download'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','delete','upload','render'),
				//'users'=>array('@'),
                'expression' => '!Yii::app()->user->isGuest && Yii::app()->user->freefoto == 1',
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
	public function actionDownload($pic)
	{
		$pic=Freefoto::model()->findByPk($pic);
        $file=Yii::app()->request->hostInfo .'/freefotos/'.$pic->uid.'/'.$pic->photo;
        $file_extension = strtolower(substr(strrchr($file, '.'), 1)); 
        
        $cnt = $pic->downloads+1;

        $res = Freefoto::model()->updateByPk($pic->id,array('downloads'=>$cnt));
        if($res != 1) {
            die(Freefoto::model()->getError());
        } 
        
        Yii::app()->request->sendFile(basename($file),file_get_contents($file));
        
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Freefoto;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['add_photo']) && $_POST['add_photo']==2)
		{
			$model->attributes=$_POST['Freefoto'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
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
		// $this->performAjaxValidation($model);

		if(isset($_POST['Freefoto']))
		{
			$model->attributes=$_POST['Freefoto'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
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
            if(is_object(Users::model()->findByAttributes(array('id'=>$m->uid)))) {
                if(is_file($_SERVER['DOCUMENT_ROOT'] . '/freefotos/'.Yii::app()->user->id.'/370_'.$m->photo))
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/freefotos/'.Yii::app()->user->id.'/370_'.$m->photo);
                if(is_file($_SERVER['DOCUMENT_ROOT'] . '/freefotos/'.Yii::app()->user->id.'/'.$m->photo))
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/freefotos/'.Yii::app()->user->id.'/'.$m->photo);
                if($m->delete()) return true;
            }
            else return false;
        }
        else return false; 

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//if(!isset($_GET['ajax']))
		//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->processPageRequest('page');
        $criteria=new CDbCriteria;

		$criteria->condition='city_id!=""';
        if(isset($_POST['city_id']) && !empty($_POST['city_id']))
            $criteria->addCondition('city_id='.$_POST['city_id']);
        if(isset($_POST['name']) && !empty($_POST['name']))
            $criteria->addCondition('name like "%'.$_POST['name'].'%"');
        if(isset($_POST['date']) && !empty($_POST['date']))
            $criteria->addCondition('date="'.$_POST['date'].'"');
        $criteria->order='date DESC';
        
        $dataProvider=new CActiveDataProvider('Freefoto',array(
                                    'criteria'=>$criteria,
                                    'pagination'=>array(
                                        'pageSize'=>42,
                                        'pageVar' =>'page',
                                    ),
        ));
        
        $cnt = Yii::app()->db->createCommand()
                    ->select('SUM(`downloads`) as cnt')
                    ->from('{{freefoto}}')
                    ->where('downloads>0')
                    ->queryRow();                   
		
        if (Yii::app()->request->isAjaxRequest){
            $this->renderPartial('_loop', array(
                'dataProvider'=>$dataProvider,
            ));
            Yii::app()->end();
        } else {
            $this->render('index', array(
                'dataProvider'=>$dataProvider,
                'totalCount'=>$cnt['cnt'],
            ));
        }
	}
    
    protected function processPageRequest($param='page')
    {
        if (Yii::app()->request->isAjaxRequest && isset($_POST[$param]))
            $_GET[$param] = Yii::app()->request->getPost($param);
    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Freefoto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Freefoto']))
			$model->attributes=$_GET['Freefoto'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Freefoto the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Freefoto::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Freefoto $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='freefoto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionUpload()
    {
 
        Yii::import("ext.Upload.qqFileUploader2");
 
        if(!is_dir(Yii::getPathOfAlias('webroot').'/freefotos/'.Yii::app()->user->id.'/'))
            mkdir(Yii::getPathOfAlias('webroot').'/freefotos/'.Yii::app()->user->id.'/');
        $folder=Yii::getPathOfAlias('webroot').'/freefotos/'.Yii::app()->user->id.'/';// folder for uploaded files
        $allowedExtensions = array("jpg","jpeg","gif","png");//array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 24 * 1024 * 1024;// maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        
 
        $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
        $fileName=$result['filename'];//GETTING FILE NAME
        //$img = CUploadedFile::getInstance($model,'image');
        
        $ih=new CImageHandler();
        $ih
            ->load($_SERVER['DOCUMENT_ROOT'] . '/freefotos/'.Yii::app()->user->id.'/'.$fileName)
            ->adaptiveThumb(370, 370)
            //->watermark($_SERVER['DOCUMENT_ROOT'] . '/img/watermark2.png', 20, 10, CImageHandler::CORNER_LEFT_BOTTOM)
            ->save($_SERVER['DOCUMENT_ROOT'] . '/freefotos/'.Yii::app()->user->id.'/370_'.$fileName)
            ->reload()
            ->watermark($_SERVER['DOCUMENT_ROOT'] . '/img/watermark2_big.png', 20, 20, CImageHandler::CORNER_LEFT_BOTTOM)                    
            ->save($_SERVER['DOCUMENT_ROOT'] . '/freefotos/'.Yii::app()->user->id.'/'.$fileName);
            //->reload()
            //->resize(1024, 1024)
            //->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/1024_'.$fileName)
            //->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName);
        
        $mFile=new Freefoto;
        $mFile->name=$_GET['name'];
        $mFile->uid=Yii::app()->user->id;
        $mFile->photo=$fileName;
        $mFile->date=$_GET['date'];
        $mFile->city_id=$_GET['city_id'];
        
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
        $model=Freefoto::model()->findByPk($_POST['id']);
        
        $res='<div class="data_'.$model->id.'">
                  <figure class="accaunt-gallery__thumbnail" style="margin-right:16px;">
                    <img src="/freefotos/'.Yii::app()->user->id.'/370_'.$model->photo.'" alt="">
                    <a href="javascript:void(0)" class="message__item-delete_photo"><span class="cabinet__photo__item-delete"></span></a>
                    <div class="delete__hidden">
                        <div class="delete__hidden-title">Хотите удалить?</div>
                        <div class="delete__hidden-yes" id="'.$model->id.'">ДА</div>
                        <div class="delete__hidden-no">нет</div>
                    </div>
                  </figure>
           
            <script>
            $(".message__item-delete_photo").click(function(){
              //console.log(this);
              $(this).siblings(".delete__hidden").fadeToggle(400);
            });
            $("#'.$model->id.'").click(function(){
                $(".delete__hidden").hide();
                $.ajax({
                    url: "/freefoto/delete/?id='.$model->id.'",          
                    type : "get",                    
                    success: function (data, textStatus) {
                        $(".data_'.$model->id.'").fadeOut(400);
                    }               
                });
            });
            </script>
            </div>';
        
        echo $res;
    }
}
