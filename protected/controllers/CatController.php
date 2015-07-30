<?php

class CatController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionView($id)
	{
        if($id==5 && Yii::app()->controller->id=='cat') { //avto
            //$this->actionAvto($id);
            //Yii::app()->runController('/cat/avto');
            $this->forward('cat/avto',1);
        }
        elseif($id==6 && Yii::app()->controller->id=='cat') { //flo
            //$this->actionAvto($id);
            //Yii::app()->runController('/cat/avto');
            $this->forward('cat/flo',1);
        }
        elseif($id==2 && Yii::app()->controller->id=='cat') { //videooperators
            //$this->actionAvto($id);
            //Yii::app()->runController('/cat/avto');
            $this->forward('cat/video',1);
        }
        elseif(($id!=1 && $id!=4 && $id!=17 && $id!=18 && $id!=19)  && Yii::app()->controller->id=='cat' ) { //other
            $this->forward('cat/other',1);
        }
        
        
        $this->processPageRequest('page');
        
        $criteria = new CDbCriteria();
            
        //$criteria->with='filesCount';
        //$criteria->with='calendar';
        //$criteria->together = true;    
        $criteria->condition='member=1 AND activate=1';
        $criteria->addCondition('occupation_id='.$id);
        
        if(!empty($_POST['city'])) {
            $criteria->addCondition('city_id='.$_POST['city'].' OR other_city='.$_POST['city']);    
        }
        else {
            if(isset(Yii::app()->request->cookies['city']))
                $criteria->addCondition('city_id='.Yii::app()->request->cookies['city']->value.' OR other_city='.Yii::app()->request->cookies['city']->value);   
        }
        if(!empty($_POST['name'])) {
            $criteria->addCondition('name like "%'.$_POST['name'].'%" OR id="'.$_POST['name'].'"');    
        }
        /*if(!empty($_POST['genre'])) {
            $criteria->addCondition('name like "%'.$_POST['name'].'%"');    
        }*/
        if(!empty($_POST['m_type'])) {
            $criteria->addCondition('member_type="'.$_POST['m_type'].'"');    
        }
        if(!empty($_POST['price_from'])) {
            $criteria->addCondition('price_h>='.$_POST['price_from']);    
        }
        if(!empty($_POST['price_to'])) {
            $criteria->addCondition('price_h<='.$_POST['price_to']);    
        }
        /*if(!empty($_POST['calend'])) {
            $criteria->addCondition('calendar.day!="'.$_POST['calend'].'"');    
        }*/
        
        $criteria->order='member_type desc, name asc';
        $dataProvider=new CActiveDataProvider('Users', array(
                'criteria' => $criteria,
                'pagination'=>array(
                    'pageSize'=>10,
                    'pageVar' =>'page',
                ),
        ));
        
        if (Yii::app()->request->isAjaxRequest){
            $this->renderPartial('_loop', array(
                'dataProvider'=>$dataProvider,
            ));
            Yii::app()->end();
        } else {
            $this->render('view', array(
                'dataProvider'=>$dataProvider,
                'id'=>$id
            ));
        }
	}
    
    public function actionAvto($id)
	{
        $this->processPageRequest('page');
        
        $criteria = new CDbCriteria();
            
        $criteria->condition='member=1';
        $criteria->addCondition('occupation_id='.$id);
        
        if(!empty($_POST['city'])) {
            $criteria->addCondition('city_id='.$_POST['city'].' OR other_city='.$_POST['city']);    
        }
        else {
            if(isset(Yii::app()->request->cookies['city']))
                $criteria->addCondition('city_id='.Yii::app()->request->cookies['city']->value.' OR other_city='.Yii::app()->request->cookies['city']->value);   
        }
        if(!empty($_POST['name'])) {
            $criteria->addCondition('name like "%'.$_POST['name'].'%" OR id="'.$_POST['name'].'"');    
        }
        if(!empty($_POST['m_type'])) {
            $criteria->addCondition('member_type="'.$_POST['m_type'].'"');    
        }
        
        $criteria->with='avto';
        $criteria->together = true;
        $criteria->addCondition('avto.uid>0');
        
        if(!empty($_POST['price_from'])) {
            $criteria->addCondition('avto.price>='.$_POST['price_from']);    
        }
        if(!empty($_POST['price_to'])) {
            $criteria->addCondition('avto.price<='.$_POST['price_to']);    
        }
        
        $criteria->order='member_type desc, avto.class desc, name asc';
        $dataProvider=new CActiveDataProvider('Users', array(
                'criteria' => $criteria,
                'pagination'=>array(
                    'pageSize'=>10,
                    'pageVar' =>'page',
                ),
        ));
        
        if (Yii::app()->request->isAjaxRequest){
            $this->renderPartial('_loop_avto', array(
                'dataProvider'=>$dataProvider,
            ));
            Yii::app()->end();
        } else {
            $this->render('view_avto', array(
                'dataProvider'=>$dataProvider,
                'id'=>$id
            ));
        }
	}
    
    public function actionFlo($id)
	{
        $this->processPageRequest('page');
        
        $criteria = new CDbCriteria();
            
        $criteria->condition='member=1';
        $criteria->addCondition('occupation_id='.$id);
        
        if(!empty($_POST['city'])) {
            $criteria->addCondition('city_id='.$_POST['city'].' OR other_city='.$_POST['city']);    
        }
        else {
            if(isset(Yii::app()->request->cookies['city']))
                $criteria->addCondition('city_id='.Yii::app()->request->cookies['city']->value.' OR other_city='.Yii::app()->request->cookies['city']->value);   
        }
        if(!empty($_POST['name'])) {
            $criteria->addCondition('name like "%'.$_POST['name'].'%" OR id="'.$_POST['name'].'"');    
        }
        if(!empty($_POST['m_type'])) {
            $criteria->addCondition('member_type="'.$_POST['m_type'].'"');    
        }
        
        $criteria->with='flo';
        $criteria->together = true;
        
        if(!empty($_POST['price_from'])) {
            $criteria->addCondition('flo.price>='.$_POST['price_from']);    
        }
        if(!empty($_POST['price_to'])) {
            $criteria->addCondition('flo.price<='.$_POST['price_to']);    
        }
        
        $criteria->order='member_type desc, flo.price asc, name asc';
        $dataProvider=new CActiveDataProvider('Users', array(
                'criteria' => $criteria,
                'pagination'=>array(
                    'pageSize'=>10,
                    'pageVar' =>'page',
                ),
        ));
        
        if (Yii::app()->request->isAjaxRequest){
            $this->renderPartial('_loop_flo', array(
                'dataProvider'=>$dataProvider,
            ));
            Yii::app()->end();
        } else {
            $this->render('view_flo', array(
                'dataProvider'=>$dataProvider,
                'id'=>$id
            ));
        }
	}
    
    public function actionVideo($id)
	{
        $this->processPageRequest('page');
        
        $criteria = new CDbCriteria();
            
        $criteria->condition='member=1';
        $criteria->addCondition('occupation_id='.$id);
        
        if(!empty($_POST['city'])) {
            $criteria->addCondition('city_id='.$_POST['city'].' OR other_city='.$_POST['city']);    
        }
        else {
            if(isset(Yii::app()->request->cookies['city']))
                $criteria->addCondition('city_id='.Yii::app()->request->cookies['city']->value.' OR other_city='.Yii::app()->request->cookies['city']->value);   
        }
        if(!empty($_POST['name'])) {
            $criteria->addCondition('name like "%'.$_POST['name'].'%" OR id="'.$_POST['name'].'"');    
        }
        if(!empty($_POST['m_type'])) {
            $criteria->addCondition('member_type="'.$_POST['m_type'].'"');    
        }
        
        if(!empty($_POST['price_from'])) {
            $criteria->addCondition('flo.price>='.$_POST['price_from']);    
        }
        if(!empty($_POST['price_to'])) {
            $criteria->addCondition('flo.price<='.$_POST['price_to']);    
        }
        
        $criteria->order='member_type desc, name asc';
        $dataProvider=new CActiveDataProvider('Users', array(
                'criteria' => $criteria,
                'pagination'=>array(
                    'pageSize'=>10,
                    'pageVar' =>'page',
                ),
        ));
        
        if (Yii::app()->request->isAjaxRequest){
            $this->renderPartial('_loop_video', array(
                'dataProvider'=>$dataProvider,
            ));
            Yii::app()->end();
        } else {
            $this->render('view_video', array(
                'dataProvider'=>$dataProvider,
                'id'=>$id
            ));
        }
	}
    
    public function actionOther($id)
	{
        $this->processPageRequest('page');
        
        $criteria = new CDbCriteria();
            
        $criteria->condition='member=1';
        $criteria->addCondition('occupation_id='.$id);
        
        if(!empty($_POST['city'])) {
            $criteria->addCondition('city_id='.$_POST['city'].' OR other_city='.$_POST['city']);    
        }
        else {
            if(isset(Yii::app()->request->cookies['city']))
                $criteria->addCondition('city_id='.Yii::app()->request->cookies['city']->value.' OR other_city='.Yii::app()->request->cookies['city']->value);   
        }
        if(!empty($_POST['name'])) {
            $criteria->addCondition('name like "%'.$_POST['name'].'%" OR id="'.$_POST['name'].'"');    
        }
        if(!empty($_POST['m_type'])) {
            $criteria->addCondition('member_type="'.$_POST['m_type'].'"');    
        }
        
        $criteria->with='flo';
        $criteria->together = true;
        
        if(!empty($_POST['price_from'])) {
            $criteria->addCondition('flo.price>='.$_POST['price_from']);    
        }
        if(!empty($_POST['price_to'])) {
            $criteria->addCondition('flo.price<='.$_POST['price_to']);    
        }
        
        $criteria->order='member_type desc, flo.price asc, name asc';
        $dataProvider=new CActiveDataProvider('Users', array(
                'criteria' => $criteria,
                'pagination'=>array(
                    'pageSize'=>10,
                    'pageVar' =>'page',
                ),
        ));
        
        if (Yii::app()->request->isAjaxRequest){
            $this->renderPartial('_loop_other', array(
                'dataProvider'=>$dataProvider,
            ));
            Yii::app()->end();
        } else {
            $this->render('view_other', array(
                'dataProvider'=>$dataProvider,
                'id'=>$id
            ));
        }
	}
    
    protected function processPageRequest($param='page')
    {
        if (Yii::app()->request->isAjaxRequest && isset($_POST[$param]))
            $_GET[$param] = Yii::app()->request->getPost($param);
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