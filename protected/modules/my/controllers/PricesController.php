<?php

class PricesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

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
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','update','add','delete','showform'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
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
		$model=new Prices;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Prices']))
		{
			$model->attributes=$_POST['Prices'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('index',array(
			'model'=>$model,
            'user'=>Users::model()->findByPk(Yii::app()->user->id),
		));
	}
    
    public function actionAdd()
	{
		$model=new Prices;
        
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Prices']))
		{
            $record=Prices::model()->findByAttributes(array(
                                'genre_id'=>$_POST['Prices']['genre_id'],
                                'package'=>$_POST['Prices']['package'],
                                'user_id'=>$_POST['Prices']['user_id'],
                                )
            );
            if($record->id=='') {
    			$model->attributes=$_POST['Prices'];
                //print_r($model->attributes); exit();
    			if($model->save())
    				$this->redirect(array('index'));
            }
            else {
                $model=$this->loadModel($record->id);
                $model->attributes=$_POST['Prices'];
                //print_r($model->attributes); exit();
    			if($model->save())
    				$this->redirect(array('index'));
            }
		}

		$this->render('index',array(
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
		$this->performAjaxValidation($model);

		if(isset($_POST['Prices']))
		{
			if(isset($_POST['Prices']['price']))
                $_POST['Prices']['price']=preg_replace("/\s/", "", $_POST['Prices']['price']);
            $model->attributes=$_POST['Prices'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('index',array(
			'model'=>$model,
            'user'=>Users::model()->findByPk(Yii::app()->user->id)
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model=$this->loadModel($id);
        if(Yii::app()->user->id==$model->user_id)
            $this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Prices');
        $user=new Users;
        
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'user'=>$user->model()->findByPk(Yii::app()->user->id),
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Prices('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Prices']))
			$model->attributes=$_GET['Prices'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Prices the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Prices::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Prices $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='prices-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionShowform($id) {
        $data=explode('_',$id);
        $pack=Prices::model()->findByAttributes(array('genre_id'=>$data[0],'package'=>$data[1],'user_id'=>Yii::app()->user->id));
        
        if(Yii::app()->user->role==2) { //videooperator
            $title=Video::model()->findByAttributes(array('uid'=>Yii::app()->user->id,'id'=>$data[0]));
        }
        else {
            $title=Portfolio::model()->findByAttributes(array('uid'=>Yii::app()->user->id,'id'=>$data[0]));
        }
        if(is_object($pack)) {
            $html='<form action="/my/prices/update/id/'.$pack->id.'" method="post">';
            $html.='<script>
                $(document).ready(function() {
                    $("#price__price").keydown(function (e) {
                        // Allow: backspace, delete, tab, escape, enter and .
                        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                             // Allow: Ctrl+A
                            (e.keyCode == 65 && e.ctrlKey === true) || 
                             // Allow: home, end, left, right, down, up
                            (e.keyCode >= 35 && e.keyCode <= 40)) {
                                 return;
                        }
                        // Ensure that it is a number and stop the keypress
                        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                            e.preventDefault();
                        }
                    });
                });
                </script>';
            $html.='<div class="tooltip_cost_title">'.$title->title.'</div>
                    <label for="albom__name" class="tool_label" style="margin-top: 25px;">Цена</label>
                        <input type="text" name="Prices[price]" value="'.$pack->price.'" id="price__price" class="default__input search__hidden__input--city" maxlength="7" title="Это поле обязательно для заполнение" placeholder="500 грн" required="">
                    <label for="albom__name" class="tool_label">Описание</label>
                        <textarea name="Prices[about]" id="about__user" cols="25" rows="10" class="default__textarea" placeholder="Описание услуги:">'.$pack->about.'</textarea>
                        
                        <div class="col-12 text_center" style="margin-top: 25px;">
                            <div class="btn__group clfx">
                                <div class="col-179">                  
                                    <button type="button" class="t-cls cabinet__profile__btn" id="close_tip" onclick="closeTip(\''.$id.'\')">ОТМЕНА</button>                  
                                </div>                  
                                <div class="col-179">                    
                                    <input type="hidden" name="Prices[user_id]" value="'.Yii::app()->user->id.'" />
                                    <input type="hidden" name="Prices[package]" value="'.$data[1].'" />
                                    <input type="hidden" name="Prices[genre_id]" value="'.$data[0].'" />
                                    <button type="submit" class="t-cls cabinet__profile__btn cabinet__profile__btn-submit">СОХРАНИТЬ</button>
                                </div>                
                            </div>            
                  </div>
                  </form>';       
        }
        else {
            $html='<form action="/my/prices/create/" method="post">';
            $html.='<div class="tooltip_cost_title">'.$title->title.'</div>
                    <label for="albom__name" class="tool_label" style="margin-top: 25px;">Цена</label>
                        <input type="text" name="Prices[price]" id="albom__name" class="default__input search__hidden__input--city" title="Это поле обязательно для заполнение" placeholder="500 грн" required="">
                    <label for="albom__name" class="tool_label">Описание</label>
                        <textarea name="Prices[about]" id="about__user" cols="25" rows="10" class="default__textarea" placeholder="Описание услуги:"></textarea>
                        
                        <div class="col-12 text_center" style="margin-top: 25px;">
                            <div class="btn__group clfx">
                                <div class="col-179">                  
                                    <button type="button" class="t-cls cabinet__profile__btn" id="close_tip" onclick="closeTip(\''.$id.'\')">ОТМЕНА</button>                  
                                </div>                  
                                <div class="col-179">                    
                                    <input type="hidden" name="Prices[user_id]" value="'.Yii::app()->user->id.'" />
                                    <input type="hidden" name="Prices[package]" value="'.$data[1].'" />
                                    <input type="hidden" name="Prices[genre_id]" value="'.$data[0].'" />
                                    <button type="submit" class="t-cls cabinet__profile__btn cabinet__profile__btn-submit">СОХРАНИТЬ</button>
                                </div>                
                            </div>            
                  </div>
                  </form>';
        }     
        
        echo $html;
    }
}
