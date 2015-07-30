<?php
/* @var $this PageController */

$this->breadcrumbs=array(
	'Новости'=>'/news',
    $model->title,
);
?>

<div class="container news-open clfx">

    <div class="news-open__gallery">
      <div class="connected-carousels">
      <div class="stage">
          <div class="carousel carousel-stage">
              <ul>
                <?php
                if($model->foto1!='') echo '<li><img src="/upload/'.$model->foto1.'" alt="" /></li>';
                if($model->foto2!='') echo '<li><img src="/upload/'.$model->foto2.'" alt="" /></li>';
                if($model->foto3!='') echo '<li><img src="/upload/'.$model->foto3.'" alt="" /></li>';
                if($model->foto4!='') echo '<li><img src="/upload/'.$model->foto4.'" alt="" /></li>';
                if($model->foto5!='') echo '<li><img src="/upload/'.$model->foto5.'" alt="" /></li>';
                ?>
              </ul>
          </div>
      </div>
       <div class="navigation">
           <div class="carousel carousel-navigation">
               <ul> 
                <?php
                if($model->foto1!='') echo '<li><img src="/upload/thumb_'.$model->foto1.'" alt="" /></li>';
                if($model->foto2!='') echo '<li><img src="/upload/thumb_'.$model->foto2.'" alt="" /></li>';
                if($model->foto3!='') echo '<li><img src="/upload/thumb_'.$model->foto3.'" alt="" /></li>';
                if($model->foto4!='') echo '<li><img src="/upload/thumb_'.$model->foto4.'" alt="" /></li>';
                if($model->foto5!='') echo '<li><img src="/upload/thumb_'.$model->foto5.'" alt="" /></li>';
                ?>
               </ul>
           </div>
       </div>

             </div>
    </div>
    <div class="news-open__content">
    <h1><?=$model->title?></h1>
      <p><?=CHtml::decode($model->intro_text)?></p>
      <br />
      <p><?=CHtml::decode($model->full_text)?></p>
    </div>
    <!--div class="action-open__socil-btn">
      <a href="#"><div class="action-open__socil-btn__vk">45</div></a>
      <a href="#"><div class="action-open__socil-btn__fb">773</div></a>
    </div-->
  </div>
  
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/min/jquery.jcarousel.min.js'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/min/connected-carousels.min.js'); ?>