<?php

class VideoController extends Controller
{
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
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','delete','visible','album','addfile','files','editfile','updatefile','upload','render','updatefiles','video','addvideo'),
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
	   $usr=Users::model()->findByPk(Yii::app()->user->id);
	   if($usr->genre_id=='') {
	       $model=new Flo;

    		// Uncomment the following line if AJAX validation is needed
    		// $this->performAjaxValidation($model);
    
    		if(isset($_POST['Flo']))
    		{
    			$model->attributes=$_POST['Flo'];
                $model->picture=CUploadedFile::getInstance($model,'picture');
                
                $fileName=$model->picture->getName();
                if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName))
                    $fileName=substr($fileName,0,-4).rand(1,1000).substr($fileName,-4);
        
                
                $ih=new CImageHandler();
                $ih
                    ->load($model->picture->getTempName())                    
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName);
                    
                $model->picture=$fileName;    
                    
    			if($model->save()) {
    			    //$path=Yii::getPathOfAlias('webroot').'/users/'.Yii::app()->user->id.'/'.$model->picture->getName();
                    //$model->picture->saveAs($path); 
    				$this->redirect(array('index'));
                }
    		}
    
    		$this->render('create_user',array(
    			'model'=>$model,
                'user'=>Users::model()->findByPk(Yii::app()->user->id),
    		));    
       } else {
		$model=new Portfolio;
//print_r($_FILES); exit();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Portfolio']))
		{                     
            if($_FILES['Portfolio']['tmp_name']['picture']!='') {
                if(!is_dir($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id)) mkdir($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id);
                
                $model->picture=CUploadedFile::getInstance($model,'picture'); 
                $ih=new CImageHandler();
		        $ih
                    ->load($_FILES['Portfolio']['tmp_name']['picture'])                    
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$model->picture->name)
                    ->reload()
                    ->resize(254, 254)
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/254_'.$model->picture->name);
            }	  
			$model->uid=$_POST['Portfolio']['uid'];
            $model->visible=1;
            $model->description=$_POST['Portfolio']['description'];
            $model->uid=$_POST['Portfolio']['uid'];
            $model->title=$_POST['Portfolio']['title'];
            $model->picture=$model->picture->name;
            
            //echo '<pre>'.print_r($model->attributes).'</pre>'; exit();
			if($model->save()) {
			    $this->redirect(array('index'));
            }
            else {
                print_r($model->getErrors()); exit();
            }
		}

		$this->render('index',array(
			'model'=>$model,
            'user'=>Users::model()->findByPk(Yii::app()->user->id),
		));
       }
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		
    		// Uncomment the following line if AJAX validation is needed
    		// $this->performAjaxValidation($model);
            $usr=Users::model()->findByPk(Yii::app()->user->id);
            if($usr->genre_id=='') {
                $model=Flo::model()->findByPk($id);
                if(isset($_POST['Flo']))
        		{
        			$model->attributes=$_POST['Flo'];
                    
                    if($_POST['Flo']['picture']!='') {
                        unlink($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$model->picture);
                        $model->picture=CUploadedFile::getInstance($model,'picture');
                        
                        $fileName=$model->picture->getName();
                        if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName))
                            $fileName=substr($fileName,0,-4).rand(1,1000).substr($fileName,-4);
                
                        
                        $ih=new CImageHandler();
                        $ih
                            ->load($model->picture->getTempName())                    
                            ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName);
                            
                        $model->picture=$fileName;
                    }
                    
        			if($model->save())
        				$this->redirect(array('index'));
        		}
        
        		$this->render('update',array(
        			'model'=>$model,
                    'user'=>Users::model()->findByPk(Yii::app()->user->id),
        		));
            
            } else {
            
                $model=$this->loadModel($id);
                if($model->uid==Yii::app()->user->id) {
            		if(isset($_POST['Portfolio']))
            		{
            			$model->attributes=$_POST['Portfolio'];
            			if($model->save())
            				$this->redirect(array('index'));
            		}
            
            		$this->render('update',array(
            			'model'=>$model,
                        'user'=>Users::model()->findByPk(Yii::app()->user->id),
            		));
                }
                else
                    throw new CHttpException(404,'The requested portfolio does not exist.');
            }
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        $usr=Users::model()->findByPk(Yii::app()->user->id);
        if($usr->genre_id=='') {
            $m=Flo::model()->findByPk($id);	   
    		if($m->uid==Yii::app()->user->id){
                if(is_file(Yii::getPathOfAlias('webroot').'/users/'.Yii::app()->user->id.'/'.$m->picture))
                    unlink(Yii::getPathOfAlias('webroot').'/users/'.Yii::app()->user->id.'/'.$m->picture);
                $m->delete();
                return true;		    
    		}    
            else
                throw new CHttpException(404,'The requested element does not exist.');
        } else {        
                
            
            $m=$this->loadModel($id);	   
    		if($m->uid==Yii::app()->user->id) {
                $files=Files::model()->findAll('portfolio_id='.$m->id);
                if(count($files)>0) {
                    foreach($files as $file) {
                        Files::model()->deleteByPk($file->id);
                        if(is_file(Yii::getPathOfAlias('webroot').'/users/'.Yii::app()->user->id.'/'.$file->file))
                            unlink(Yii::getPathOfAlias('webroot').'/users/'.Yii::app()->user->id.'/'.$file->file);
                        if(is_file(Yii::getPathOfAlias('webroot').'/users/'.Yii::app()->user->id.'/254_'.$file->file))    
                            unlink(Yii::getPathOfAlias('webroot').'/users/'.Yii::app()->user->id.'/254_'.$file->file);
                        if(is_file(Yii::getPathOfAlias('webroot').'/users/'.Yii::app()->user->id.'/370_'.$file->file))
                            unlink(Yii::getPathOfAlias('webroot').'/users/'.Yii::app()->user->id.'/370_'.$file->file);
                        if(is_file(Yii::getPathOfAlias('webroot').'/users/'.Yii::app()->user->id.'/88_'.$file->file))    
                            unlink(Yii::getPathOfAlias('webroot').'/users/'.Yii::app()->user->id.'/88_'.$file->file);
                    }
                }
                //$m->delete();
                $m->picture='';
                $m->visible=0;
                $m->save();    
            }
            else
                throw new CHttpException(404,'The requested album does not exist.');      
    
            $b=Yii::app()->getRequest()->getParam('back_url');
    
            $this->redirect($b!='' ? $b : array('index'));
    		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
    		//if(!isset($_GET['ajax']))
    			//$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
       }
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		/*$dataProvider=new CActiveDataProvider('Portfolio');
        $model=Portfolio::model()->findByAttributes(array('uid'=>Yii::app()->user->id));
        if(!is_object($model)) $model=Portfolio::model();
        
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'user'=>Users::model()->findByPk(Yii::app()->user->id),
            'model'=>$model,
		));*/
        
        $usr=Users::model()->findByPk(Yii::app()->user->id);
        
        if($usr->genre_id=='') {
            $dataProvider=new CActiveDataProvider('Flo',array(
                'criteria'=>array(
                    'order'=>'id desc',
                    'condition'=>'uid='.Yii::app()->user->id,
                    )
            ));
    		$this->render('user',array(
    			'dataProvider'=>$dataProvider,
                'user'=>Users::model()->findByPk(Yii::app()->user->id),
    		));
        }
        else {
            $model=Video::model()->findAllByAttributes(array('uid'=>Yii::app()->user->id));
            $this->render('index_video',array(
                'model'=>$model,
                'user'=>$usr,
            ));    
        }
	}
    
    public function actionVideo()
	{
            /*$model=Portfolio::model()->findAllByAttributes(array('uid'=>Yii::app()->user->id));
            
            $dataProvider=new CActiveDataProvider('Files',array(
                'criteria'=>array(
                    'order'=>'id desc',
                    'condition'=>'uid='.Yii::app()->user->id.' AND source="portfolio" AND type="video"',
                )
            ));
            $this->render('video',array(
                'dataProvider'=>$dataProvider,
                'user'=>Users::model()->findByPk(Yii::app()->user->id),
            ));*/    
        $model=Video::model()->findAllByAttributes(array('uid'=>Yii::app()->user->id));
        $this->render('index_video',array(
            'model'=>$model,
            'user'=>$usr,
        ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Portfolio('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Portfolio']))
			$model->attributes=$_GET['Portfolio'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Portfolio the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Video::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Portfolio $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='portfolio-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionAlbum($id)
	{
		$model=$this->loadModel($id);
            
            $dataProvider=new CActiveDataProvider('Files',array(
                'criteria'=>array(
                    'order'=>'id desc',
                    'condition'=>'uid='.Yii::app()->user->id.' AND source="portfolio" AND type="video" AND portfolio_id='.$id,
                )
            ));
            $this->render('album',array(
                'dataProvider'=>$dataProvider,
                'model'=>$model,
                'user'=>Users::model()->findByPk(Yii::app()->user->id),
            ));
    }
    
    public function actionAddfile()
	{
		$model=new Files;
//print_r($_FILES); exit();
		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['Files']) && $_POST['Files']['title']!='')
		{    
            if($_FILES['Files']['tmp_name']['file']!='') {
                $model->file=CUploadedFile::getInstance($model,'file'); 
                $ih=new CImageHandler();
		        $ih
                    ->load($_FILES['Files']['tmp_name']['file'])                    
                    ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$model->file->name);
            }	  
			$model->attributes=$_POST['Files'];
            $model->source='portfolio';
            //$model->description=$_POST['Files']['description'];
            //print_r($model->attributes); exit();
            
            //echo '<pre>'.print_r($_FILES).'</pre>'; exit();
			if($model->save()) {
			    $this->redirect(array('/portfolio/files'));
            }
		}

		$this->render('album',array(
			'file'=>$model,
            'model'=>new Portfolio,
            'user'=>Users::model()->findByPk(Yii::app()->user->id),
		));
	}
    
    public function actionUpdatefiles()
	{
	   //print_r($_POST); exit();
	   if(isset($_POST)) {
	       $err=false;
           if(isset($_POST['Files'])) {
    	       foreach($_POST['Files'] as $k=>$item) {
    	           $model=Files::model()->findByPk($item['id']);
                   if($item['description']!='') $model->description = $item['description'];
                   $model->source='portfolio';
                   
                   if(!$model->save()) $err=true;
    	       }
           } 
           if($err==false){
                if(!empty($_POST['cover'])) {
                    $cover=explode('__',$_POST['cover']);
                    Portfolio::model()->updateByPk($cover[0],array('picture'=>$cover[1]));
                    $this->redirect('/my/portfolio/album/id/'.$cover[0]);
                }
                else $this->redirect('/my/portfolio/'); 
           }
	   }
	}
    
    public function actionUpdatefile()
	{
	   //print_r($_POST); exit();
		$model=Files::model()->findByPk($id);
        if($model->uid==Yii::app()->user->id) {
    		// Uncomment the following line if AJAX validation is needed
    		//$this->performAjaxValidation($model);
    
    		if(isset($_POST['Files']) && $_POST['Files']['title']!='')
    		{    
                if($_FILES['Files']['tmp_name']['file']!='') {
                    if(is_file('./users/'.Yii::app()->user->id.'/'.$model->file))
                        unlink('./users/'.Yii::app()->user->id.'/'.$model->file);
                    
                    $model->file=CUploadedFile::getInstance($model,'file'); 
                    $ih=new CImageHandler();
    		        $ih
                        ->load($_FILES['Files']['tmp_name']['file'])                    
                        ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$model->file->name);
                }
                if($_FILES['Files']['tmp_name']['file']=='') unset($_POST['Files']['file']);	  
    			$model->attributes=$_POST['Files'];
                //$model->description=$_POST['Files']['description'];
                //$model->portfolio_id=$_POST['Files']['portfolio_id'];
                //print_r($model->attributes); exit();
                
                //echo '<pre>'.print_r($_FILES).'</pre>'; exit();
    			//if($model->save()) {
    			if($model->updateByPk($id,$model->attributes)) { 
    			 
    			    $this->redirect('/portfolio/files');
                }
    		}
    
    		$this->render('files',array(
    			'file'=>$model,
                'model'=>new Portfolio,
                'user'=>Users::model()->findByPk(Yii::app()->user->id),
    		));
        }
        else throw new CHttpException(404,'The requested file does not exist.');
	}
    
    public function actionFiles()
	{
		$model=Files::model()->findAllByAttributes(array('uid'=>Yii::app()->user->id));
        //$model=Portfolio::model()->findAllByAttributes(array('uid'=>Yii::app()->user->id));
        $this->render('files',array(
			'user'=>Users::model()->findByPk(Yii::app()->user->id),
            'model'=>$model,
		));
	}
    
    public function actionEditfile($id)
	{
		$model=Files::model()->findByPk($id);
        //$model=Portfolio::model()->findAllByAttributes(array('uid'=>Yii::app()->user->id));
        $this->render('_edit_file',array(
			'user'=>Users::model()->findByPk(Yii::app()->user->id),
            'model'=>$model,
		));
	}
    
    public function actionVisible($id)
    {
        $m=$this->loadModel($id);	   
		if($m->uid==Yii::app()->user->id) {
		    if($m->visible==1) $m->visible=0;
            elseif($m->visible==0) $m->visible=1;
            if($m->save()) 
                $this->redirect('/my/video');  
		}    
        else
            throw new CHttpException(404,'The requested album does not exist.');
    }
    
    public function actionUpload($id)
    {
 
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
            //->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$model->picture->name)
            //->reload()
            ->adaptiveThumb(254, 254)
            ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/254_'.$fileName)
            ->reload()
            ->adaptiveThumb(370, 370)
            ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/370_'.$fileName)
            ->reload()
            //->resize(1024, 1024)
            //->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/1024_'.$fileName)
            ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName);
        
        Yii::import("application.modules.my.models.Files");
        $mFile=new Files;
        $mFile->uid=Yii::app()->user->id;
        $mFile->file=$fileName;
        $mFile->type='photo';
        $mFile->portfolio_id=$id;
        $mFile->source='portfolio';
        
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
        
        $res='<div class="data_'.$model->id.'">
                  <figure class="cabinet__photo__item2">
                    <img src="/users/'.Yii::app()->user->id.'/370_'.$model->file.'" alt="">
                    <!--a href="#" class="cabinet__photo__item-selected"></a-->
                    <a href="/my/files/visible/id/'.$model->id.'?back='.$_POST['url'].'" class="cabinet__photo__item-view"></a>
                    <a href="javascript:void(0)" class="message__item-delete_photo"><span class="cabinet__photo__item-delete"></span></a>
                    <div class="delete__hidden">
                        <div class="delete__hidden-title">Р’С‹ СѓРІРµСЂРµРЅС‹ С‡С‚Рѕ С…РѕС‚РёС‚Рµ СѓРґР°Р»РёС‚СЊ?</div>
                        <div class="delete__hidden-yes" id="'.$model->id.'">Р”Рђ</div>
                        <div class="delete__hidden-no">РќР•Рў</div>
                    </div>
                    <figcaption class="accaunt-gallery__thumbnail-overlay2">
                      <a href="#" class="__crop-img" data-crop="'.$model->id.'">
                        РљР°РґСЂРёСЂРѕРІР°РЅРёРµ С„РѕС‚Рѕ
                      </a>
                    </figcaption>
                    <input type="radio" class="default-input__radio__style__vertical" id="add-on-cover_'.$model->id.'" name="cover" value="'.$model->portfolio_id.'__'.$model->file.'" />
                    <label class="remember" for="add-on-cover_'.$model->id.'">РћР±Р»РѕР¶РєР° Р°Р»СЊР±РѕРјР°</label>
                  </figure>
                
            <!-- Р В Р’В Р РЋРІвЂћСћР В Р’В Р вЂ™Р’В°Р В Р’В Р СћРІР‚ВР В Р Р‹Р В РІР‚С™Р В Р’В Р РЋРІР‚ВР В Р Р‹Р В РІР‚С™Р В Р’В Р РЋРІР‚СћР В Р’В Р В РІР‚В Р В Р’В Р вЂ™Р’В°Р В Р’В Р В РІР‚В¦Р В Р’В Р РЋРІР‚ВР В Р’В Р вЂ™Р’Вµ -->
            <div class="modal fade" id="__crop-img-'.$model->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog--crop">
                <div class="crop-content clfx">
                  <form action="/my/files/crop" method="post">
                  <div class="crop-img">
                    <div align="center">
                        <img src="/users/'.Yii::app()->user->id.'/'.$model->file.'" alt="" id="target-'.$model->id.'" alt="[РљР°РґСЂРёСЂРѕРІР°РЅРёРµ]">
                    </div>
                  </div>
                    <div class="col-12 text_center">
                        <div class="btn__group clfx">
                            <div class="col-179">
                                <button type="clear" class="cabinet__profile__btn" data-dismiss="modal">РћС‚РјРµРЅР°</button>
                            </div>
                            <div class="col-179">
                                <input type="hidden" name="img" value="/users/'.Yii::app()->user->id.'/'.$model->file.'" />
                                <input type="hidden" name="img_name" value="'.$model->file.'" />
                                <input type="hidden" id="x_'.$model->id.'" name="x" />
                    			<input type="hidden" id="y_'.$model->id.'" name="y" />
                    			<input type="hidden" id="w_'.$model->id.'" name="w" />
                    			<input type="hidden" id="h_'.$model->id.'" name="h" />
                                <input type="hidden" name="back" value="'.$_POST['url'].'" />
                                <button type="submit" class="cabinet__profile__btn cabinet__profile__btn-submit">РЎРћРҐР РђРќРРўР¬</button>
                            </div>
                        </div>
                    </div>
                  </form>  
                </div>
              </div>
            </div>   
            
            <script>
            $(".message__item-delete_photo").click(function(){
              //console.log(this);
              $(this).siblings(".delete__hidden").fadeToggle(400);
            });
            $(".__crop-img").click(function(){
              var arg=this.getAttribute("data-crop");  
              //alert(this.getAttribute("data-crop""));
              $("#__crop-img-"+arg).modal("show");
              $("#target-"+arg).Jcrop({
                aspectRatio: 0,
                allowResize: false,
                allowSelect: false,
                //onChange: updateCoords,
                setSelect:  [ 0, 0, 370, 370 ],
                onChange: function(data) {
                  console.log(data);
                  $("#x_"+arg).val(data.x);
                  $("#y_"+arg).val(data.y);
                  $("#w_"+arg).val(data.w);
                  $("#h_"+arg).val(data.h);
                }
              });
          });
            $("#'.$model->id.'").click(function(){
                $(".delete__hidden").hide();
                $.ajax({
                    url: "/my/files/delete/id/'.$model->id.'",          
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
    
    public function actionAddvideo() {
        $mFile=new Files;
        $mFile->uid=Yii::app()->user->id;
        $mFile->file=$_POST['video'];
        $mFile->type='video';
        $mFile->source='portfolio';
        $mFile->portfolio_id=$_POST['portfolio_id'];
        
        $str=parse_url($_POST['video']);
        //print_r($str); 
        $path=explode('/',$str['path']);
        if($str['host']=='youtu.be' || $str['host']=='www.youtube.com') {
            if($str['host']=='youtu.be') {
                $code=$path[1];    
            }
            elseif($str['host']=='www.youtube.com') {
                $code=substr($str['query'], 2, 20);    
            }
            $image='http://img.youtube.com/vi/'.$code.'/0.jpg';
        }
        elseif($str['host']=='vimeo.com') {
            if(isset($path[3]))
                $code=$path[3];
            else        
                $code=$path[1];
            
            if ($xml = simplexml_load_file('http://vimeo.com/api/v2/video/'.$code.'.xml')) {
        		//$image = $xml->video->thumbnail_large ? (string) $xml->video->thumbnail_large: (string) $xml->video->thumbnail_medium;
                $image = $xml->video->thumbnail_medium;
        	}
        }
        
        $ih=new CImageHandler();
        $ih
            ->load($image)                    
            ->adaptiveThumb(272, 162)
            ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/video_'.$code.'.jpg');
        
        //$mFile->picture='video_'.$code;
        
        if($mFile->save())
            $this->redirect($_POST['back']);
    }
}
