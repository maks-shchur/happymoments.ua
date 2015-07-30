<?php

class ViewController extends Controller
{
	public function actionAdd()
	{
	   if(isset($_POST['img'])) {
    	    //INSERT
            $mod=new View;
            $mod->uid=Yii::app()->user->id;
            $mod->photo=$_POST['img'];
            if($mod->save()) return true;
            else return false;                               
	   }
       else echo 'false'; 
	}

	public function actionDelete()
	{
		if(isset($_POST['img'])) {
	       $model=View::model()->findByAttributes(array('uid'=>Yii::app()->user->id,'photo'=>$_POST['img']));
           if(is_object($model)) { 
                if($model->delete()) {
                    return true;
                }
           }
           else {
                return false;                            
           }   
	   }
       else echo 'false';
	}
}