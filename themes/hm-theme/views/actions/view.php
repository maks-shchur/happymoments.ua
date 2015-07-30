<?php
/* @var $this ActionsController */
/* @var $model Actions */

$this->breadcrumbs=array(
	'Акции'=>array('index'),
	$model->title,
);

$new_price=$model->price - round($model->price*$model->sale/100);
?>

<div class="wrapper main__action-open">
    <div class="container">
      <div class="action-open__left-col">
        <firuge class="action-open__left__img clfx">
            <?php
            if($model->picture!=''):
            ?>
            <img src="<?=Yii::app()->request->hostInfo?>/users/<?=$model->user->id?>/721_<?=$model->picture?>" alt="Акция" />
            <?php else: ?>
            <img src="<?=Yii::app()->request->hostInfo?>/img/zaglushka.png" alt="Акция" />
            <?php endif; ?>
          <div class="action__thumbnail-discount">- <?=$model->sale?>%</div>
          <div class="action__thumbnail-city">г. <?=City::getName($model->user->city_id)?></div>
        </firuge>
        <nav class="action-open__ajax-menu">
          <a href="#0" class="action-open__ajax-menu-item">об акции</a>
          <!--a href="#0" class="action-open__ajax-menu-item">отзывы</a-->
        </nav>
        <div class="action-open__text">
            <?=$model->description?>
        </div>
        <?php if($model->conditions!=''): ?>
        <section class="action-open__terms">
          <h6>Условия акции</h6>
          <p><?=$model->conditions?></p>
        </section>
        <?php endif; ?>
        <!--div class="comments-btn">
          <a href="#0" class="col-6 comments__view">Комментарии <span>( 51 )</span></a>
          <a href="#0" class="col-6 comments__complaint">Пожаловаться</a>
        </div-->
      </div>
      <div class="action-open__right-col">
        <h1><?=$model->title?></h1>
        <div class="action__user-info">
          <a href="<?=Yii::app()->request->hostInfo?>/id<?=$model->user->id?>">
          <figure class="action__user-info__ava">
            <?php
            if($model->user->photo!=''):
            ?>
            <img src="<?=Yii::app()->request->hostInfo?>/users/<?=$model->user->id?>/<?=$model->user->photo?>" alt="<?=$model->user->name?>" />
            <?php else: ?>
            <img src="<?=Yii::app()->request->hostInfo?>/img/zaglushka.png" alt="Пользователь" />
            <?php endif; ?>
            <figcaption><h4><?=$model->user->name?></h4></figcaption>
          </figure>
          </a>
          <div class="action__user-info__address">
            <a href="tel:<?=$model->user->phone?>" class="action__user-info__tel"><?=$model->user->phone?></a>
            <a href="mailto:<?=$model->user->email?>" class="action__user-info__email"><?=$model->user->email?></a>
          </div>
        </div>
        <div class="action-open__price">
          Стоимость: <span><?=$new_price?> грн.</span>
        </div>
        <div class="action-open__price-old">
          Старая цена: <span><?=$model->price?> грн</span>
        </div>
        <div class="action-open__time__date">
          Акция действует: <span>до <?=Settings::dateFormat($model->date_end)?></span>
        </div>
        <div class="action-open__time__days">
          До окончания акции: <span><?=Settings::get_duration(date('Y-m-d',time()),$model->date_end)?></span> дней
        </div>
        <!--div class="action-open__socil-btn">
          <a href="#"><div class="action-open__socil-btn__vk">45</div></a>
          <a href="#"><div class="action-open__socil-btn__fb">773</div></a>
        </div-->
        
        <div align="center" style="margin-top: 40px;font: 1.4em PTSansNarrowBold, sans-serif;">ПОХОЖИЕ АКЦИИ</div>
        <?php if(count($sameActions)>0): ?>
        <aside class="mini__action-container">
          <?php foreach($sameActions as $action) { 
            //print_r($action); exit();
            $new_price_mini=$action->price - round($action->price*$action->sale/100);  
          ?>
          <div class="mini__action">
            <a href="<?=$this->createUrl('/actions/view', array('id'=>$action->id));?>">
              <figure class="mini__action__img-container clfx">
                <img src="<?=Yii::app()->request->hostInfo?>/users/<?=$model->user->id?>/568_<?=$action->picture?>" alt="<?=$model->user->name?>">
                <div class="mini__action__thumbnail-discount">- <?=$action->sale?>%</div>
                <div class="mini__action__thumbnail-city">г. <?=City::getName($action->user->city_id)?></div>
                <figcaption class="mini__action__thumbnail-overlay"><?=$action->title?></figcaption>
              </figure>
            </a>
            <div class="mini__action__short-info clfx">
              <a href="<?=Yii::app()->request->hostInfo?>/id<?=$action->user->id?>">
                <figure class="mini__action__short-info__avatar clfx">
                  <?php
                    if($model->user->photo!=''):
                    ?>
                    <img src="<?=Yii::app()->request->hostInfo?>/users/<?=$model->user->id?>/<?=$model->user->photo?>" alt="<?=$model->user->name?>" class="mini__action__short-info__avatar-img" />
                    <?php else: ?>
                    <img src="<?=Yii::app()->request->hostInfo?>/img/zaglushka.png" alt="" class="mini__action__short-info__avatar-img" />
                  <?php endif; ?> 
                  <figcaption class="mini__action__short-info__avatar-name"><?=str_replace(' ','<br />',$action->user->name)?></figcaption>
                </figure>
              </a>
              <div class="mini__action__short-info__price">
                <div class="mini__action__short-info__price-hot"><?=$new_price_mini?> грн</div>
                <div class="mini__action__short-info__price-old"><?=$action->price?> грн</div>
              </div>
              <div class="mini__action__short-info__time">
                <div class="mini__action__short-info__time-last-to">до <?=Settings::dateFormat($action->date_end)?></div>
                <div class="mini__action__short-info__time-days"><?=Settings::get_duration(date('Y-m-d',time()),$action->date_end)?></div>
              </div>
            </div>
          </div>
          <?php } ?>
        </aside>
        <?php endif; ?>
      </div>
    </div>
  </div>
