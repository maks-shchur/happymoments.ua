<?php
/* @var $this ActionsController */
/* @var $data Actions */
$new_price=$data->price - round($data->price*$data->sale/100);
?>
<div class="action__continer">
        <a href="<?=$this->createUrl('/actions/view', array('id'=>$data->id));?>">
          <figure class="action__img-container clfx">
            <?php
            if($data->picture!=''):
            ?>
            <img src="<?=Yii::app()->request->hostInfo?>/users/<?=$data->user->id?>/568_<?=$data->picture?>" alt="Акция" />
            <?php else: ?>
            <img src="<?=Yii::app()->request->hostInfo?>/img/zaglushka.png" alt="Акция" />
            <?php endif; ?>
            <div class="action__thumbnail-discount">- <?=$data->sale?>%</div>
            <div class="action__thumbnail-city">г. <?=City::getName($data->user->city_id)?></div>
            <figcaption class="action__thumbnail-overlay"><?=$data->title?></figcaption>
          </figure>
        </a>
        <div class="action__short-info clfx">
          <a href="<?=Yii::app()->request->hostInfo?>/id<?=$data->user->id?>">
            <figure class="short-info__avatar clfx">
              <?php
              if(is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.$data->user->id.'/'.$data->user->photo)):
              ?>  
              <img src="<?=Yii::app()->request->hostInfo?>/users/<?=$data->user->id?>/<?=$data->user->photo?>" alt="<?=$data->user->name?>" class="short-info__avatar-img" />
              <?php else: ?>
              <img src="<?=Yii::app()->request->hostInfo?>/img/zaglushka.png" alt="Пользователь" class="short-info__avatar-img" />
              <?php endif;?>
              <figcaption class="action__short-info__avatar-name"><?=$data->user->name?></figcaption>
            </figure>
          </a>
          <div class="short-info__price">
            <div class="short-info__price-hot"><?=$new_price?> грн</div>
            <div class="short-info__price-old"><?=$data->price?> грн</div>
          </div>
          <div class="short-info__time">
            <div class="short-info__time-last-to">до <?=Settings::dateFormat($data->date_end)?></div>
            <div class="short-info__time-days"><?=Settings::get_duration(date('Y-m-d',time()),$data->date_end)?> дней</div>
          </div>
        </div>
      </div>