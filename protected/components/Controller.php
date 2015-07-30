<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    
    public function init()
    {    
        if (empty($_GET['language']))
            $_GET['language'] = 'ru';
            
        if (isset($_GET['alias']))
        {
            $id=Occupation::model()->findBySql('select id from {{occupation}} where alias="'.$_GET['alias'].'"');
            if(count($id)>0)
                $_GET['id'] = $id->id;    
        }       
        //print_r($_GET);
        Yii::app()->language = $_GET['language'];
        parent::init();
    }
}