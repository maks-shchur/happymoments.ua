<?php

class StudioController extends Controller
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
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','interior','equip','rent','services','prices','tours','uploadbanner','delbanner','visiblealbum','delalbum','album','updatealbum','upload','render','updatefiles',
                                'addrenttext','deltext','textedit','addequip','equipedit','delequip','priceedit'
                ),
				//'users'=>array('@'),
                'expression' => '!Yii::app()->user->isGuest && Yii::app()->user->role == 17',
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
    
    
    public function actionEquip()
	{
		$this->render('equip',array(
			'model'=>Users::model()->findByPk(Yii::app()->user->id),
            'equips'=>StudioEquip::model()->findAllByAttributes(array('uid'=>Yii::app()->user->id)),
		));
	}
    
    public function actionAddequip() {
        if(isset($_POST['StudioEquip'])) {
            $m=new StudioEquip;
            $m->attributes=$_POST['StudioEquip'];
            /*$m->title=$_POST['StudioEquip']['title'];
            $m->description=$_POST['StudioEquip']['description'];
            $m->uid=$_POST['StudioEquip']['uid'];*/
            $m->photo=CUploadedFile::getInstance($m,'photo');
            
            $fileName=$m->photo->getName();
            if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName))
                $fileName=substr($fileName,0,-4).rand(1,1000).substr($fileName,-4);
    
            
            $ih=new CImageHandler();
            $ih
                ->load($m->photo->getTempName())                    
                ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName);
                
            $m->photo=$fileName;
            if($m->save())
                $this->redirect('/my/studio/equip');
        }
        $this->render('/studioEquip/create',array(
			'model'=>Users::model()->findByPk(Yii::app()->user->id),
		));        
    }
    
    public function actionEquipedit($id)
    {
        $m=StudioEquip::model()->findByPk($id);
        if($m->uid==Yii::app()->user->id)
        {
            if(isset($_POST['StudioEquip']))
    		{
    			$m->attributes=$_POST['StudioEquip'];
                
                if($_FILES['StudioEquip']['name']['photo']!='') {
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$m->photo);
                    $m->photo=CUploadedFile::getInstance($m,'photo');
                    
                    $fileName=$m->photo->getName();
                    if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName))
                        $fileName=substr($fileName,0,-4).rand(1,1000).substr($fileName,-4);
            
                    
                    $ih=new CImageHandler();
                    $ih
                        ->load($m->photo->getTempName())                    
                        ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName);
                        
                    $m->photo=$fileName;
                }
                
    			if($m->save())
    				$this->redirect('/my/studio/equip');
    		}           
           
            $this->render('/studioEquip/update',
                array(
                    'model'=>Users::model()->findByPk(Yii::app()->user->id),
                    'equip'=>$m
                )
            );    
        }
        else
            throw new CHttpException(404,'The requested equipment does not exist.');    
    }
    
    public function actionDelequip($id)
    {
        $m=StudioEquip::model()->findByPk($id);
        if($m->uid==Yii::app()->user->id)
        {
            if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$m->photo))
                unlink($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$m->photo);
            if($m->delete()) return true;
        }
        else
            throw new CHttpException(404,'The requested equipment does not exist.');    
    }

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionInterior()
	{
		$this->render('interior',array(
			'model'=>Users::model()->findByPk(Yii::app()->user->id),
            'banners'=>StudioBanners::model()->findByAttributes(array('uid'=>Yii::app()->user->id)),
            'halls'=>StudioHals::model()->findAllByAttributes(array('uid'=>Yii::app()->user->id)),
		));
	}
    
    public function actionUploadbanner()
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
            ->resize(955, 278)
            ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.Yii::app()->user->id.'/'.$fileName);
        
        $mFile=StudioBanners::model()->findByAttributes(array('uid'=>Yii::app()->user->id));
        if(is_object($mFile)) {
            if($mFile->banner1==''){
                StudioBanners::model()->updateByPk($mFile->id,array('banner1'=>$fileName));
            }
            elseif($mFile->banner2==''){
                StudioBanners::model()->updateByPk($mFile->id,array('banner2'=>$fileName));
            }
            elseif($mFile->banner3==''){
                StudioBanners::model()->updateByPk($mFile->id,array('banner3'=>$fileName));
            }
        }
        else {
            $mFile = new StudioBanners;
            $mFile->uid=Yii::app()->user->id;
            $mFile->banner1=$fileName;
            $mFile->save();
        }
        
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        echo $return;// it's array
        //echo $ret;
    }
    
    public function actionDelbanner($id)
    {
        $id=explode('_',$id);
        $b='banner'.$id[1];
        $m=$this->loadModel($id[0]);	   
    	if($m->uid==Yii::app()->user->id) {
    	   if(is_file(Yii::getPathOfAlias('webroot').'/users/'.Yii::app()->user->id.'/'.$m->$b))
                unlink(Yii::getPathOfAlias('webroot').'/users/'.Yii::app()->user->id.'/'.$m->$b);
           $m->$b='';
           $m->save();
        }
        else
            throw new CHttpException(404,'The requested banner does not exist.');
        
        $this->redirect('/my/studio/interior');
    }
    
    public function loadModel($id)
	{
		$model=StudioBanners::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='studiobanners-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionVisiblealbum($id)
    {
        $m=StudioHals::model()->findByPk($id);	   
		if($m->uid==Yii::app()->user->id) {
		    if($m->visible==1) $m->visible=0;
            elseif($m->visible==0) $m->visible=1;
            if($m->save()) 
                $this->redirect('/my/studio/interior');  
		}    
        else
            throw new CHttpException(404,'The requested album does not exist.');
    }
    
    public function actionDelalbum($id)
    {
        $m=StudioHals::model()->findByPk($id);	   
  		if($m->uid==Yii::app()->user->id){
            $files=Files::model()->findAllByAttributes(array('uid'=>$m->uid,'source'=>'hall'));
            if(is_object($files)) {
                foreach($files as $file) {
                    if(is_file(Yii::getPathOfAlias('webroot').'/users/'.Yii::app()->user->id.'/'.$file->file))
                        unlink(Yii::getPathOfAlias('webroot').'/users/'.Yii::app()->user->id.'/'.$file->file);
                }
            }
            Files::model()->deleteAllByAttributes(array('uid'=>$m->uid,'source'=>'hall'));
            if($m->delete()) {
                $u=Users::model()->findByPk(Yii::app()->user->id);
                $u->hals=$u->hals-1;
                $u->save();
                
                $this->redirect('/my/studio/interior');    
            }
        }
        else
            throw new CHttpException(404,'The requested element does not exist.');
    }
    
    public function actionAlbum($id)
    {
        $model=StudioHals::model()->findByPk($id);
        
        if($model->uid==Yii::app()->user->id) {
            $files=Files::model()->findAllByAttributes(
                array('uid'=>Yii::app()->user->id,'portfolio_id'=>$id,'type'=>'photo','source'=>'hall'),
                array('order'=>'id DESC')
            );
            
            $this->render('album',array(
    			'model'=>$model,
                'files'=>$files,
                'user'=>Users::model()->findByPk(Yii::app()->user->id),
    		));
        }
        else throw new CHttpException(404,'The requested album does not exist.');    
    }
    
    public function actionUpdatealbum($id)
    {
        $model=StudioHals::model()->findByPk($id);
        
        if($model->uid==Yii::app()->user->id) {
            if(isset($_POST['StudioHals']))
                StudioHals::model()->updateByPk($id,array('title'=>$_POST['StudioHals']['title']));
            
            $this->redirect('/my/studio/album/id/'.$id);
        }
        else throw new CHttpException(404,'The requested album does not exist.');    
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
        $mFile->source='hall';
        
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
        
        $class='cabinet__photo__item-select'; $del='no';
        
        $res='<div class="data_'.$model->id.'">
                  <figure class="cabinet__photo__item2">
                    <img src="/users/'.Yii::app()->user->id.'/370_'.$model->file.'" alt="">
                    <span class="'.$class.'" id="on_top-'.$model->id.'" data-del="'.$del.'" data-atr="'.$model->file.'" title="РІРёРґРµРѕ РЅР° РіР»Р°РІРЅСѓСЋ"></span>
                    <a href="/my/files/visible/id/'.$model->id.'?back='.$_POST['url'].'" class="cabinet__photo__item-view"></a>
                    <a href="javascript:void(0)" class="message__item-delete_photo"><span class="cabinet__photo__item-delete"></span></a>
                    <div class="delete__hidden">
                        <div class="delete__hidden-title">Вы уверены что хотите удалить?</div>
                        <div class="delete__hidden-yes" id="'.$model->id.'">ДА</div>
                        <div class="delete__hidden-no">нет</div>
                    </div>
                    <input type="radio" class="default-input__radio__style__vertical" id="add-on-cover_'.$model->id.'" name="cover" value="'.$model->portfolio_id.'__'.$model->file.'" />
                    <label class="remember" for="add-on-cover_'.$model->id.'">Обложка альбома</label>
                    <div class="cover__hidden">
                        <div class="cover__hidden-title">Установить эту фотографию <br />как обложку альбома?</div>
                        <div class="cover__hidden-yes" id="cover_'.$model->id.'">ДА</div>
                        <div class="cover__hidden-no">нет</div>
                    </div>
                  </figure>
                
              
            
            <script>
            $(".message__item-delete_photo").click(function(){
              //console.log(this);
              $(this).siblings(".delete__hidden").fadeToggle(400);
            });
            $("#add-on-cover_'.$model->id.'").click(function(){
                $(this).siblings(".cover__hidden").fadeToggle(400);
            });
            $(".cover__hidden-no").click(function(){
              //$(this).parent().fadeToggle(400);
              $(".loader").css("display","block");
              $(this).parent().hide();
              window.location.reload();
            });
            $("#cover_'.$model->id.'").click(function(){
                $(".loader").css("display","block");
                $(".cover__hidden").hide();
                $("#files-form").submit();
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
            $("#on_top-'.$model->id.'").click(function(){
                $(".loader").css("display","block");
                var arg=$("#on_top-'.$model->id.'").attr("data-atr");
                if($("#on_top-'.$model->id.'").attr("data-del")=="no") {
                    $.ajax({
                        url: "/my/view/add",          
                        type : "post",
                        data : {img: arg},                     
                        success: function (data, textStatus) {
                            $(".loader").css("display","none");
                            $("#on_top-'.$model->id.'").removeClass("cabinet__photo__item-select");
                            $("#on_top-'.$model->id.'").addClass("cabinet__photo__item-selected");
                            $("#on_top-'.$model->id.'").attr("data-del","yes");
                        }               
                    });
                }
                if($("#on_top-'.$model->id.'").attr("data-del")=="yes") {
                    $.ajax({
                        url: "/my/view/delete",          
                        type : "post",
                        data : {img: arg},                     
                        success: function (data, textStatus) {
                            $(".loader").css("display","none");
                            $("#on_top-'.$model->id.'").removeClass("cabinet__photo__item-selected");
                            $("#on_top-'.$model->id.'").addClass("cabinet__photo__item-select");
                            $("#on_top-'.$model->id.'").attr("data-del","no");
                        }               
                    });
                }
            });
            </script>
            </div>';
        
        echo $res;
    }
    
    public function actionUpdatefiles()
	{
	   //print_r($_POST); print_r($_FILES); exit();
	   if(isset($_POST)) {
	       $err=false;
           if(!empty($_POST['Files'])) {
    	       foreach($_POST['Files'] as $k=>$item) {
    	           $model=Files::model()->findByPk($item['id']);
                   if($item['description']!='') $model->description = $item['description'];
                   $model->source='hall';
                   
                   if(!$model->save()) $err=true;
    	       }
           } 
           if($err==false){
                if(!empty($_POST['cover'])) {
                    $cover=explode('__',$_POST['cover']);
                    StudioHals::model()->updateByPk($cover[0],array('picture'=>$cover[1]));
                    //$this->redirect('/my/studio/album/id/'.$cover[0]);
                    $this->redirect($_POST['back']);
                }
                else $this->redirect('/my/studio/'); 
           }
	   }
	}

	public function actionPrices()
	{
		$halls=StudioHals::model()->findAllByAttributes(array('uid'=>Yii::app()->user->id));
        if(count($halls)>0) {
            $this->render('prices',array(
    			'model'=>Users::model()->findByPk(Yii::app()->user->id),
                'halls'=>$halls,
    		));
        } 
        else {
            $this->redirect('/my/profile');
        }
	}
    
    public function actionPriceedit($id)
    {
        $m=StudioHals::model()->findByPk($id);	   
  		if($m->uid==Yii::app()->user->id){
            if(isset($_POST['StudioHals'])) {
                $m->attributes=$_POST['StudioHals'];
                if($m->save())
                    $this->redirect('/my/studio/prices');
            }
            $this->render('/studioHals/update',array(
    			'model'=>Users::model()->findByPk(Yii::app()->user->id),
                'm'=>$m,
    		));
        }
        else
            throw new CHttpException(404,'The requested element does not exist.');                
    }

	public function actionRent()
	{
		$this->render('rent',array(
			'model'=>Users::model()->findByPk(Yii::app()->user->id),
            'texts'=>StudioRent::model()->findAllByAttributes(array('uid'=>Yii::app()->user->id)),
		));
	}
    
    public function actionAddrenttext()
    {
        if(isset($_POST['StudioRent'])) {
            $m=new StudioRent;
            $m->attributes=$_POST['StudioRent'];
            if($m->save())
                $this->redirect('/my/studio/rent');
        }
        $this->render('/studioRent/create',array(
			'model'=>Users::model()->findByPk(Yii::app()->user->id),
            'texts'=>StudioRent::model()->findAllByAttributes(array('uid'=>Yii::app()->user->id)),
		));
    }
    
    public function actionDeltext($id)
    {
        $m=StudioRent::model()->findByPk($id);	   
  		if($m->uid==Yii::app()->user->id){
            if($m->delete()) {
                return true;    
            }
        }
        else
            throw new CHttpException(404,'The requested element does not exist.');
    }

    public function actionTextedit($id)
    {
        if(isset($_POST['StudioRent'])) {
            $m=StudioRent::model()->findByPk($id);
            $m->attributes=$_POST['StudioRent'];
            if($m->save())
                $this->redirect('/my/studio/rent');
        }
        $this->render('/studioRent/update',array(
			'model'=>Users::model()->findByPk(Yii::app()->user->id),
            'texts'=>StudioRent::model()->findAllByAttributes(array('uid'=>Yii::app()->user->id)),
            'm'=>StudioRent::model()->findByPk($id),
		));
    }

	public function actionServices()
	{
		$this->render('services');
	}

	public function actionTours()
	{
		$this->render('tours');
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