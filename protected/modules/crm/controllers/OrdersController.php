<?php

class OrdersController extends Controller
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
				'actions'=>array('index','view','create','update','delete','genresublist','myorders','genreddlist','admin','delete','findbyphone'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','view','create','update','delete','genresublist','myorders','genreddlist','admin','delete','findbyphone'),
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
		
        $model=new Orders;
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
        
		if(isset($_POST['Orders']))
		{
		  //print_r($_POST); exit();
          if($_POST['Orders']['uid'] != -1) {
          
			$model->attributes=$_POST['Orders'];
            $model->date_end = str_replace('.','-',$_POST['Orders']['date_end']);
            if($_POST['Orders']['date_create']=='0000-00-00') { 
                $_POST['Orders']['date_create'] = date('Y-m-d');
                $model->date_create = $_POST['Orders']['date_create'];
            }
            //print_r($model->attributes); exit();
			if($model->validate() && $model->save())
				$this->redirect('/crm/orders');
            //else print_r($model->getErrors());
          } else {
            if(!empty($_POST['client_phone']) && !empty($_POST['client_name'])) {
                $user=new Users;
                $user->name = $_POST['client_name'];
                $user->phone = $_POST['client_phone'];
                if($user->save()) {
                    $uid = $user->id;
                    $model->attributes=$_POST['Orders'];
                    $model->date_end = str_replace('.','-',$_POST['Orders']['date_end']);
                    $model->uid = $uid;
                    //print_r($model->attributes); exit();
        			if($model->validate() && $model->save())
        				$this->redirect('/crm/orders');
                } else {
                    throw new CHttpException(500,'Ошибка при создании нового пользователя.');
                }
            } else {
                $model->addError('uid', 'Необходимо указать ФИО и телефон клиента!'); 
                $model->attributes=$_POST['Orders'];       
            }
          } 
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
        $user=Users::model()->findByPk($model->uid);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Orders']))
		{
		    //print_r($_POST);
            $model->date_end = str_replace('.','-',$_POST['Orders']['date_end']);
            if($_POST['Orders']['date_create']=='0000-00-00') { 
                $model->date_create = date('Y-m-d');
            } else {
                $model->date_create = $_POST['Orders']['date_create']; 
            }
            $model->attributes=$_POST['Orders'];
            //print_r($model->attributes); exit();
			if($model->save())
				$this->redirect(array('/crm/orders'));
		}

		$this->render('update',array(
			'model_t'=>$model,
            'model'=>$user,
            'client_name' => $user->name,
            'client_phone' => $user->phone,
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
		//if($m->uid==Yii::app()->user->id) {
		  $m->delete(); 
        //}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		/*$dataProvider=new CActiveDataProvider('Tenders', array('criteria'=>array(
                    'select'=> '*',
                    'condition'=>'uid=:uid order by date_end desc',
                    'params'=>array(':uid'=>Yii::app()->user->id),
             )));
        $user=Users::model()->findByPk(Yii::app()->user->id);
        
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'model'=>$user,
		));*/
        $model=new Orders('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tenders']))
			$model->attributes=$_GET['Tenders'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
    
    public function actionMyorders()
	{
		$criteria = new CDbCriteria();
        $criteria->with=array('tenders');
        $criteria->condition='`t`.`uid` = :userid';
        $criteria->params=array(':userid'=>Yii::app()->user->id);
        $criteria->order='date_end DESC';
        $dataProvider = new CActiveDataProvider('TenderOrders',array('criteria'=>$criteria));

        /*$dataProvider=new CActiveDataProvider('Tenders', array('criteria'=>array(
                    'select'=> '*',
                    'condition'=>'uid=:uid order by date_end desc',
                    'params'=>array(':uid'=>Yii::app()->user->id)
             )));*/
             
        $user=Users::model()->findByPk(Yii::app()->user->id);
        
		$this->render('orders',array(
			'dataProvider'=>$dataProvider,
            'model'=>$user,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Orders('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tenders']))
			$model->attributes=$_GET['Tenders'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Tenders the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Orders::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Tenders $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tenders-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionGenresublist()
    {
        $data_genre=Genre::model()->findAll('occ_id=:occ_id', array(':occ_id'=>(int) $_POST['Tenders']['occupation']));
     
        if(!empty($data_genre)) {
            $data_genre=CHtml::listData($data_genre,'id','name');
            echo CHtml::checkBoxList('Tenders[genre]','',$data_genre);
        }
        else echo '';                
    }
    
    public function actionGenreddlist()
    {
        $data_genre=Genre::model()->findAll('occ_id=:occ_id', array(':occ_id'=>(int) $_POST['Orders']['occupation']));
     
        if(!empty($data_genre)) {
            $data_genre=CHtml::listData($data_genre,'id','name');
            echo CHtml::dropDownList('Orders[genre]','',$data_genre,array('class'=>'default__input'));
        }
        else echo '';                
    }
    
    public function actionFindbyphone()
    {
         $term = Yii::app()->getRequest()->getParam('term');

         if(Yii::app()->request->isAjaxRequest && $term) {
              $users = Users::model()->findAll(array('condition'=>"phone LIKE '%$term%'"));
              $result = array();
              
              if(count($users) > 0) {
                $label='<script>
                      $(".search_user_crm").click(function() {
                        $("#Order_uid").val($(this).attr("data-uid"));
                        //$(this).val(data.phone); 
                        $("#client_name").val($(this).attr("data-name"));
                        $("#client_phone").val($(this).attr("data-phone"));
                        $("#Orders_phone").val($(this).attr("data-phone"));
                        $("#Orders_phone").attr("readonly", "true");
                        $("#Orders_email").val($(this).attr("data-email"));
                        $(".order_client_phone__list").hide( "fast");
                      });
                  </script>';
                  foreach($users as $user) {
                       $label.= "<span class='search_user_crm'";
                       $label.= " id='order_u' data-uid='".$user['id']."'";
                       $label.= " data-phone='".$user['phone']."' data-name='".$user['name']."' data-email='".$user['email']."' >";
                       $label.= $user['phone']." ".$user['name']."</span>";
                       //$result[] = array('uid'=>$user['id'], 'label'=>$label, 'phone'=>$user['phone'], 'fio'=>$user['name']);
                  }
              } /*else {
                 $label = "<span class='search_user_crm_create'>добавить нового пользователя</span>";                   
              }*/  
              //echo CJSON::encode($result);
              echo $label;
              Yii::app()->end();
         }
    }    
}
