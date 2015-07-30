<?php

class UserController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','getphone','getphotos','album','videoalbum','addFavorite','getvideos','getcalendar','result','prices','calendar'),
				'users'=>array('*'),
			),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete','getpaydata','subscribe'),
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
        $user=$this->loadModel($id);
        if($user->occupation_id==5) { //avto
            if(Yii::app()->getRequest()->getParam('class')!='') $avto=Avto::model()->findAllByAttributes(array('uid'=>$id,'class'=>Yii::app()->getRequest()->getParam('class')));
            else $avto=Avto::model()->findAllByAttributes(array('uid'=>$id));
    		$this->render('view_avto',array(
    			'model'=>$user,
                'avto'=>$avto,
    		));
        }
        elseif($user->occupation_id==6) { //flo
            $flo=Flo::model()->findAllByAttributes(array('uid'=>$id));
    		$this->render('view_flo',array(
    			'model'=>$user,
                'flo'=>$flo,
    		));
        }
        elseif($user->occupation_id==17) { //studio
            //$cond_hals='type="photo" and source="hall" and visible=1';
            $hals=StudioHals::model()->with('files')->findAllByAttributes(array('uid'=>$id,'visible'=>1));
            $banners=StudioBanners::model()->findByAttributes(array('uid'=>$id));
    		
            if(isset($_GET['calendar'])) {
                $this->render('view_studio_calendar',array(
        			'model'=>$user,
        		));    
            }
            elseif(isset($_GET['equip'])) {
                $this->render('view_studio_equip',array(
        			'model'=>$user,
                    'equips'=>StudioEquip::model()->findAllByAttributes(array('uid'=>$id,'visible'=>1))
        		));    
            }
            elseif(isset($_GET['prices'])) {
                $this->render('view_studio_prices',array(
        			'model'=>$user,
                    'prices'=>StudioHals::model()->findAllByAttributes(array('uid'=>$id,'visible'=>1))
        		));    
            }
            elseif(isset($_GET['rent'])) {
                $this->render('view_studio_rent',array(
        			'model'=>$user,
                    'rent'=>StudioRent::model()->findAllByAttributes(array('uid'=>$id,'visible'=>1))
        		));    
            }
            elseif(isset($_GET['halls'])) {
                if(isset($_GET['hid'])) {
                    $hals=StudioHals::model()->findAllByAttributes(array('uid'=>$id,'visible'=>1));
                    $hall=StudioHals::model()->with('files')->findByAttributes(array('id'=>intval($_GET['hid']),'uid'=>$id,'visible'=>1));
                    $this->render('view_studio_hals',array(
            			'model'=>$user,
                        'hall'=>$hall,
                        'hals'=>$hals,
                    ));
                }
                else {
                    $this->render('view_studio',array(
            			'model'=>$user,
                        'hals'=>$hals,
                        'banners'=>$banners,
            		));
                }     
            }
            else {
                $this->render('view_studio',array(
        			'model'=>$user,
                    'hals'=>$hals,
                    'banners'=>$banners,
        		));
            }
        }
        elseif($user->genre_id=='') { //other users without genres
            $flo=Flo::model()->findAllByAttributes(array('uid'=>$id));
    		$this->render('view_user',array(
    			'model'=>$user,
                'flo'=>$flo,
    		));
        }
        else {
            if($user->occupation_id==2) { //video operator
                /*$portfolio=Files::model()->findAllByAttributes(array('uid'=>$id,'type'=>'video','source'=>'portfolio'));
                $this->render('view_video',array(
        			'model'=>$this->loadModel($id),
                    'portfolio'=>$portfolio,
        		));*/
                $portfolio=Video::model()->findAllByAttributes(array('uid'=>$id));
        		$this->render('view_video',array(
        			'model'=>$this->loadModel($id),
                    'portfolio'=>$portfolio,
        		));
            }
            else {
                $portfolio=Portfolio::model()->findAllByAttributes(array('uid'=>$id));
        		$this->render('view',array(
        			'model'=>$this->loadModel($id),
                    'portfolio'=>$portfolio,
        		));
            }
        }
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Users;
        $user=Users::model()->findByPk(Yii::app()->user->id);
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
        
		if(isset($_POST['Users']))
		{
		  //print_r($_POST); exit();
			$model->attributes=$_POST['Users'];
            //print_r($model->attributes); exit();
			if($model->validate() && $model->save())
				$this->redirect('/Users');
		}

		$this->render('create',array(
			'model_t'=>$model,
            'model'=>$user,
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
        $user=Users::model()->findByPk(Yii::app()->user->id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model_t'=>$model,
            'model'=>$user,
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
		  $m->delete(); 
        }

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Users', array('criteria'=>array(
                    'select'=> '*',
                    'condition'=>'date_end>=:date order by date_end desc',
                    'params'=>array(':date'=>date('Y-m-d'))
             )));
        
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
        
        /*$dataProvider=new Users('search');
		$dataProvider->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$dataProvider->attributes=$_GET['Users'];

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Users the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested user does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Users $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='Users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionGetphone() {
        $m=$this->loadModel($_POST['id']);
        $str=$m->phone.'<br />';
        if($m->phone2!='') $str.=$m->phone2;
        if($m->phone3!='') $str.='<br />'.$m->phone3;
        echo '<span class="accaunt-contacts__link">'.$str.'</span>';
    }
    
    public function actionGetphotos()
	{
        $portfolio=Portfolio::model()->findAllByAttributes(array('uid'=>$_POST['id']));
		$this->renderPartial('_photos',array(
			'model'=>$this->loadModel($_POST['id']),
            'portfolio'=>$portfolio,
		));
	}
    
    public function actionAlbum($id) {
        $u=Files::model()->findByAttributes(array('portfolio_id'=>$id,'type'=>'photo'));
        $user=Users::model()->findByPk($u->uid);
        //$this->render('album',array('model'=>$model,'user'=>$user));
        
        if(!isset($_GET['photo']))
        {           
            $this->processPageRequest('page');
            
            $criteria = new CDbCriteria();
            
             $criteria->condition='portfolio_id="'.$id.'"';
             $criteria->addCondition('visible=1');
             $dataProvider=new CActiveDataProvider('Files', array(
                    'criteria' => $criteria,
                    'pagination'=>array(
                        'pageSize'=>48,
                        'pageVar' =>'page',
                    )
             ));
            
    		
            if (Yii::app()->request->isAjaxRequest){
                $this->renderPartial('_loop_photo', array(
                    'dataProvider'=>$dataProvider,
                    'user'=>$user,
                ));
                Yii::app()->end();
            } else {
                $this->render('album', array(
                    'dataProvider'=>$dataProvider,
                    'user'=>$user,
                ));
            }
        }
        else
        {
            $model=Files::model()->findAllByAttributes(array('portfolio_id'=>$id,'visible'=>1));
            $photos=array();
            foreach($model as $k=>$v)
            {
                $photos[$v->id]=$v->file;
            }
            
            $photo_key=substr($_GET['photo'],5);
            if(!isset($photos[$photo_key])) throw new CHttpException(404,'The requested photo does not exist.');
            $current=$photos[$photo_key];
            $current_key=$photo_key;
            if(in_array($current,$photos))
            {    
                $key = $current_key; // Значение ключа для поиска соседних ключей
                while ($value = current($photos)) {
                    if (key($photos) == $key) {
                        prev($photos);
                        $prev=key($photos);
                        next($photos);
                        next($photos);
                        $next=key($photos);
                        //exit;    
                    }
                    next($photos);
                }
                if($prev==reset($photos) || $prev=='')
                {
                    $prev='';
                    next($photos);
                    $next=key($photos);    
                }
            }
            else {
                $current='';
                $current_key='';
                $prev='';
                $next='';
            }
            
            
            if (Yii::app()->request->isAjaxRequest){
                $this->renderPartial('_cur_photo', array(
                    'user'=>$user,
                    'model'=>$model,
                    'current'=>$current,
                    'current_key'=>$current_key,
                    'next'=>$next,
                    'prev'=>$prev
                ));
                Yii::app()->end();
            } else {
            
                if($current!='') {
                    $this->render('photo',array(
                        'user'=>$user,
                        'model'=>$model,
                        'current'=>$current,
                        'current_key'=>$current_key,
                        'next'=>$next,
                        'prev'=>$prev
                        )
                    );
                }
                else throw new CHttpException(404,'The requested photo does not exist.');
            }
        }
    }
    
    public function actionVideoalbum($id) {
        $u=Files::model()->findByAttributes(array('portfolio_id'=>$id,'type'=>'video'));
        $user=Users::model()->findByPk($u->uid);
        //$this->render('album',array('model'=>$model,'user'=>$user));
        
        $this->processPageRequest('page');
        
        $criteria = new CDbCriteria();
        
         $criteria->condition='portfolio_id="'.$id.'"';
         $criteria->addCondition('visible=1');
         $dataProvider=new CActiveDataProvider('Files', array(
                'criteria' => $criteria,
                'pagination'=>array(
                    'pageSize'=>48,
                    'pageVar' =>'page',
                )
         ));
        
		
        if (Yii::app()->request->isAjaxRequest){
            $this->renderPartial('_loop_video', array(
                'dataProvider'=>$dataProvider,
                'user'=>$user,
            ));
            Yii::app()->end();
        } else {
            $this->render('video_album', array(
                'dataProvider'=>$dataProvider,
                'user'=>$user,
            ));
        }
    }
    
    protected function processPageRequest($param='page')
    {
        if (Yii::app()->request->isAjaxRequest && isset($_POST[$param]))
            $_GET[$param] = Yii::app()->request->getPost($param);
    }
      
    public function actionAddFavorite() {
        $res='';
        if(isset($_POST)) {
            $f=Favorites::model()->count('uid=:uid and user_id=:user_id',array(':uid'=>$_POST['uid'],':user_id'=>$_POST['user_id']));
            if($f>0) $res='Пользователь уже есть в Вашем списке Избранное';
            else {
                $m = new Favorites;
                $m->uid = $_POST['uid'];
                $m->user_id = $_POST['user_id'];
                
                $user_name=Users::model()->findByPk($_POST['user_id'])->name;
                
                if($m->save()) $res=$user_name.' добавлен в Избранное';
                else $res='Произошла ошибка.';
            }
            //echo '<div class="apply">'.$res.'</div>';
            Yii::app()->user->setFlash('add_favorite','<span id="apply1">'.$res.'</span>');
            return true;
        }
    } 
    
    public function actionGetvideos() {
        /*$portfolio=Files::model()->findAllByAttributes(array('uid'=>$_POST['id'],'type'=>'video','source'=>'portfolio'));
        $this->renderPartial('_videos_genre',array(
			'model'=>$this->loadModel($_POST['id']),
            'portfolio'=>$portfolio,
		));*/
        
        $portfolio=Video::model()->findAllByAttributes(array('uid'=>$_POST['id']));
		$this->renderPartial('_videos_genre',array(
			'model'=>$this->loadModel($_POST['id']),
            'portfolio'=>$portfolio,
		));
    }
    
    public function actionGetcalendar() {
        //$calend=Calendar::model()->findAllBySql('select * from {{calendar}} where uid="'.$_POST['id'].'" and day>="'.date("Y").'-'.date("m").'-01"');
		$this->renderPartial('_calendar',array(
			'model'=>$this->loadModel($_POST['id']),
            //'calend'=>$calend,
		));
    }
    
    public function actionCalendar($id) {
        //$calend=Calendar::model()->findAllBySql('select * from {{calendar}} where uid="'.$_POST['id'].'" and day>="'.date("Y").'-'.date("m").'-01"');
		$this->render('calendar',array(
			'model'=>$this->loadModel($id),
            //'calend'=>$calend,
		));
    }
    
    public function actionPrices($id) {
        //$calend=Calendar::model()->findAllBySql('select * from {{calendar}} where uid="'.$_POST['id'].'" and day>="'.date("Y").'-'.date("m").'-01"');
		$this->render('prices',array(
			'model'=>$this->loadModel($id),
            //'calend'=>$calend,
		));
    }
    
    public function actionGetpaydata()
    {
        $private_key='Zz6GIrfhdaL7aDPwd49BeTgE0elrNjQ8bVi7ZGarxn1F9';
        if(isset($_POST)) {
            if($_POST['sum']>0) {
                $params['version']=3;
                $params['public_key']='i6848531905';
                $params['amount']=$_POST['sum'];
                $params['currency']='UAH';
                $params['description']='ID '.$_POST['uid'].', Пополнение баланса участника на портале HappyMoments.ua';
                $params['order_id']='hm_'.date('YmdiH');
                $params['result_url']='http://new.happymoments.ua/';
                $params['server_url']='http://new.happymoments.ua/user/result';
                $params['sandbox']=1;
                
                $data_pay=base64_encode( json_encode($params) );
                $str=$private_key . $data_pay . $private_key;
                $sign_pay=base64_encode(sha1($str,1));
                
                $html='';
                $html.='<input type="hidden" name="data" value="'.$data_pay.'" />';
                $html.='<input type="hidden" name="signature" value="'.$sign_pay.'" />';
                $html.='<button class="pay_balans_btn" type="submit">ПОПОЛНИТЬ СЧЕТ</button>';
            }
            else $html='';
            
            echo $html;
        }
        else
            echo 'error';
    }
    
    public function actionResult()
    {
        if(isset($_POST)) {
            $data=json_decode(base64_decode($_POST['data']),true);      
            
            if($data['status']=='success' || $data['status']=='sandbox')
            //if($data['status']=='success')
            {
                $id_user=explode(',',$data['description']);
                $id_user=substr($id_user[0],3);
                
                $b=Balans::model()->countByAttributes(array('uid'=>$id_user));
                if($b>0)
                {
                    $b=Balans::model()->findByAttributes(array('uid'=>$id_user));
                    $sum=$b->balans + $data['amount'];
                    $b->balans=$sum;
                    $b->save(); 
                }
                else
                {
                    $bal=new Balans;
                    $bal->uid=$id_user;
                    $bal->balans=$data['amount'];
                    $bal->save(); 
                    
                }
                Yii::app()->user->setFlash('balans_add','<span id="apply1">Ваш балан успешно пополнен.</span>');
            }
            else {
                if($data['status']=='failure') $out='неуспешный платеж';
                if($data['status']=='wait_secure') $out='платеж на проверке';
                if($data['status']=='processing') $out='платеж обрабатывается';
                if($data['status']=='reversed') $out='возврат клиенту после списания';
                Yii::app()->user->setFlash('balans_add','<span id="apply1">Произошла ошибка: '.$out.'</span>');    
            }
        }
    }
    
    public function actionSubscribe()
    {
        if(isset($_POST))
        {
            $b_cnt=Balans::model()->countByAttributes(array('uid'=>$_POST['uid']));
            if($b_cnt>0) {
                $b=Balans::model()->findByAttributes(array('uid'=>$_POST['uid']));
                if($b->balans < $_POST['sum']) { 
                    $html='<h3>На Вашем счету недостаточно средств!<br />Пожалуйста, пополните баланс и повторите попытку.</h3><p>Для оплаты Вам нужно поплнить баланс минимум на '.($_POST['sum']-$b->balans).' грн.</p>';
                    $html.='
                              <form method="post" action="https://www.liqpay.com/api/checkout">
                                <div class="col-12">
                                    <div class="col-8">
                                        <table border="0">
                                            <tr style="height: 45px;">
                                                <td align="right" style="width:200px"><span class="balans_label">Текущий баланс:</span></td>
                                                <td align="left" style="width:200px; padding-left: 15px;"><span class="balans_now_red">'.(is_object($b)?$b->balans:0).' грн.</span></td>
                                            </tr>
                                            <tr style="height: 45px;">
                                                <td align="right" style="width:200px"><span class="balans_label">Сумма, грн:</span></td>
                                                <td align="left" style="width:200px; padding-left: 15px;"><input type="text" name="amount" id="amount2" class="default__input_balans" onkeyup="getPayData2()" /></td>
                                            </tr>
                                        </table>
                                     </div>
                                    <div class="col-4">
                                        <table border="0">
                                            <tr style="height: 45px;">
                                                <td align="left">
                                                    <input type="radio" name="system" id="sys_pb" value="pb" class="default-input__radio" checked="checked" />
                                                    <label for="sys_pb"><span class="balans_label">Privat24</span></label>
                                                </td>
                                            </tr>
                                            <tr style="height: 45px;">
                                                <td align="left"></td>
                                            </tr>
                                        </table>     
                                    </div>
                                </div>
                                <div class="col-12" align="center">
                                    <div id="res_data2"></div>
                                </div>
                              </form>';
                }
                else {
                    $b->uid=$_POST['uid'];
                    $b->balans=$b->balans-$_POST['sum'];
                    $b->begin=date('Y-m-d');
                    if($_POST['month']==12) {
                        $b->end=date('Y-m-d',Settings::DateAdd('yyyy',1,''));
                        $end=date('Y-m-d',Settings::DateAdd('yyyy',1,''));
                    }
                    else {
                        $b->end=date('Y-m-d',Settings::DateAdd('m',$_POST['month'],''));
                        $end=date('Y-m-d',Settings::DateAdd('m',$_POST['month'],''));
                    }
                    if($b->save()) $html='<h2>Поздравляем! Оплата прошла успешно.<br />Ваш аккаунт продлен до '.$end.'</h2>';
                    else $html='<h3>При попытке оплаты произошла ошибка.<br />Попробуйте еще раз.</h3>';
                }
            }
            else {
                $html='<h3>На Вашем счету недостаточно средств!<br />Пожалуйста, пополните баланс и повторите попытку.</h3><p>Для оплаты Вам нужно поплнить баланс минимум на '.$_POST['sum'].' грн.</p>';
                $html.='<form method="post" action="https://www.liqpay.com/api/checkout">
                                <div class="col-12">
                                    <div class="col-8">
                                        <table border="0">
                                            <tr style="height: 45px;">
                                                <td align="right" style="width:200px"><span class="balans_label">Текущий баланс:</span></td>
                                                <td align="left" style="width:200px; padding-left: 15px;"><span class="balans_now_red">0 грн.</span></td>
                                            </tr>
                                            <tr style="height: 45px;">
                                                <td align="right" style="width:200px"><span class="balans_label">Сумма, грн:</span></td>
                                                <td align="left" style="width:200px; padding-left: 15px;"><input type="text" name="amount" id="amount2" class="default__input_balans" onkeyup="getPayData2()" /></td>
                                            </tr>
                                        </table>
                                     </div>
                                    <div class="col-4">
                                        <table border="0">
                                            <tr style="height: 45px;">
                                                <td align="left">
                                                    <input type="radio" name="system" id="sys_pb" value="pb" class="default-input__radio" checked="checked" />
                                                    <label for="sys_pb"><span class="balans_label">Privat24</span></label>
                                                </td>
                                            </tr>
                                            <tr style="height: 45px;">
                                                <td align="left"></td>
                                            </tr>
                                        </table>     
                                    </div>
                                </div>
                                <div class="col-12" align="center">
                                    <div id="res_data2"></div>
                                </div>
                              </form>';                
            } 
            echo '<div align="center">'.$html.'</div>';  
        }
    }     
}
