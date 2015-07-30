<?php
class UrlManager extends CUrlManager
{
    public function createUrl($route, $params=array(), $ampersand='&')
    {
        if (empty($params['language']) && Yii::app()->language !== 'ru') {
            $params['language'] = Yii::app()->language;
        }
        
        if(!isset(Yii::app()->controller->module->id))
        {
            if(!strstr($route,'register'))
            {
                if(isset($_POST['city'])) {
                    $cookie = new CHttpCookie('city', $_POST['city']);
                    Yii::app()->request->cookies['city']=$cookie; 
                    $cookie->expire = time() + 3600;
                    $c=City::model()->localized('ru')->findByPk($_POST['city'])->name;
                    $params['city'] = Settings::toLatin($c);
                }
                elseif(isset(Yii::app()->request->cookies['city'])) {
                    $c=City::model()->localized('ru')->findByPk(Yii::app()->request->cookies['city']->value)->name;
                    $params['city'] = Settings::toLatin($c);
                }
                else
                {
                    unset($params['city']);
                }
            }
            else
            {
                unset($params['city']);
            }
        }
        /*if (!strstr($route,'/')) {
            $route = '/cat/'.$route;
        }*/
        
        return Yii::app()->request->hostInfo . parent::createUrl($route, $params, $ampersand);
    }
}
?>