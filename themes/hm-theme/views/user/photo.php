<?php
$this->breadcrumbs=array(
	'Пользователи',
	$user->name,
);
?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/min/jquery.fancybox.pack.js'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/min/slick.min.js'); ?>
<?php //Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquerypp.custom.js'); ?>

<div class="wrapper accaunt-main__gallery">
<div class="container">
    <h2><a href="/id<?=$user->id?>" class="portfolio_link_top"><?=$user->name?></a> - Портфолио</h2>
    
    <div class="connected-carousels">
      <div class="navigation">
        <!--a href="#" class="prev prev-navigation"></a>
        <a href="#" class="next next-navigation"></a-->
          <div class="carousel carousel-navigation">
              <?php
                    foreach($model as $item)
                    {
                        if(!is_file($_SERVER['DOCUMENT_ROOT'].'/users/'.$user->id.'/88_'.$item->file))
                        {
                            $ih=new CImageHandler();
            		        $ih
                                ->load($_SERVER['DOCUMENT_ROOT'].'/users/'.$user->id.'/'.$item->file)                    
                                ->adaptiveThumb(88, 84)
                                ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.$user->id.'/88_'.$item->file);
                                
                             echo '<div><a href="'.$this->createUrl('user/album',array('id'=>$item->portfolio_id,'photo'=>'photo'.$item->id)).'"><img src="/users/'.$user->id.'/88_'.$item->file.'" alt=""></a></div>';
                        }
                        else echo '<div><a href="'.$this->createUrl('user/album',array('id'=>$item->portfolio_id,'photo'=>'photo'.$item->id)).'"><img src="/users/'.$user->id.'/88_'.$item->file.'" alt=""></a></div>';    
                    }
              ?>  
          </div>
      </div>
      <div class="middle_photo">
          
          <div class="cur_photo">           
          <?php
                echo '<div id="content_photo">';
                if($next!=''):
                    echo '<a href="'.parse_url(Yii::app()->request->requestUri, PHP_URL_PATH).'?photo=photo'.$next.'" class="next_item">';
                endif; 

                if(!is_file($_SERVER['DOCUMENT_ROOT'].'/users/'.$user->id.'/940_'.$current))
                {
                    $ih=new CImageHandler();
    		        $ih
                        ->load($_SERVER['DOCUMENT_ROOT'].'/users/'.$user->id.'/'.$current)                    
                        ->resize(940, 680)
                        ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.$user->id.'/940_'.$current);
                        
                     echo '<img src="/users/'.$user->id.'/940_'.$current.'" alt="'.$user->name.' - Фотограф - '.Portfolio::model()->findByPk(Yii::app()->getRequest()->getParam('id'))->title.'">';
                }
                else echo '<img src="/users/'.$user->id.'/940_'.$current.'" alt="'.$user->name.' - Фотограф - '.Portfolio::model()->findByPk(Yii::app()->getRequest()->getParam('id'))->title.'">';
                  
                if($next!=''):
                    echo '</a>';
                endif;
                
                echo '<a href="/users/'.$user->id.'/'.$current.'" class="gallery__zoom" rel="big" data-img="/users/'.$user->id.'/'.$current.'"></a>'; 
                echo '</div>'; 
          ?>
          </div>
 
    </div>
   </div>
   
    <div id="big_gallery" style="display: none;">
    <?php
    foreach($model as $item)
    {
        echo '<a href="/users/'.$user->id.'/'.$item->file.'" class="gallery__zoom" rel="big"></a>';    
    }
    ?> 
    </div>  
   
</div>