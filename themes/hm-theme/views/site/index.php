<?php
$top_banner=array(
    1=>'<span class="slide-text--big">Тендеры</span>
        <span class="slide-text--small">Рассылка предложений о работе от заказчиков
на конкурсной основе по вашему направлению</span>',
    2=>'<span class="slide-text--big"><span style="color:#90b651">HM</span> Agent</span>
        <span class="slide-text--small">Бесплатный персональный помощник в поиске артистов, 
<br />ведущих, фотографов, развлечений и шоу-программ!<br />
        <span style="color:#90b651">HM</span>Agent! <strong>Один звонок - и лучшие предложения уже у Вас!</strong>
        <br />
        <span style="float:right">093 0000 164 &nbsp;&nbsp;&nbsp;095 0000 164 &nbsp;&nbsp;&nbsp;096 0000 164</span>
        </span>',
    3=>'<span class="slide-text--big">Free <span style="color:#90b651">foto</span></span>
        <span class="slide-text--small">Попали в объектив камеры фотографа на улицах города?<br />
Заберите бесплатно свои лучшие фотографии на Free <span style="color:#90b651">Foto</span>!</span>',
    4=>'<span class="slide-text--big">Happymoments.ua</span>
        <span class="slide-text--small">Самый удобный, универсальный портал для организации вашего праздника!</span>'
);

?>  
  
  <div class="wrapper" style="margin-top: -14px;">
    <div class="container">
      <div class="slider-text">
        <?php
        $top_rand=rand(1,4);
        echo $top_banner[$top_rand];
        ?>
        <?php if(Yii::app()->user->isGuest): ?>
            <?php if($top_rand==2): ?>
                <button class="slider-text__sign" style="margin-top: 22px;">ВХОД / РЕГИСТРАЦИЯ</button>
            <?php else: ?>
                <button class="slider-text__sign">ВХОД / РЕГИСТРАЦИЯ</button>
            <?php endif; ?>
        <?php endif; ?>
        <span class="photo_by">photo by <a href="">Nesterenko Sergey</a></span>
      </div>
    </div>
    <div class="slider">
      <ul class="slider__wrapper">
        <li class="slider__item"><div class="box"><img src="/img/slide-1.jpg" alt=""></div></li>
      </ul>
    </div>
<?php
$actions=Actions::model()->findAllBySql('select * from {{actions}} where date_end>=:date_end and picture<>"" order by rand() limit 4',array(':date_end'=>date('Y-m-d')));
if(count($actions)>0):
?>
    <div class="wrapper wrapper--users-promotions">
      <section class="container">
        <div class="container__title-wrapper">
          <h5 class="container__title">АКЦИИ УЧАСТНИКОВ</h5>
        </div>
        <div class="action-blocks-wrapper">
<?php        
    foreach($actions as $action) {
        $act_user=Users::model()->findByPk($action['uid']);
        $new_price=$action['price'] - round($action['price']*$action['sale']/100);
?>

                <a class="action-block" href="/actions/<?=$action['id']?>">
                  <div class="action-block-discount">-<?=$action['sale']?>%</div>
                  <?php
                  if(is_file('./users/'.$action['uid'].'/267_'.$action['picture'])):
                  ?>
                  <img class="action-block-img" src="/users/<?=$action['uid']?>/267_<?=$action['picture']?>" alt="">
                  <?php else: ?>
                  <img class="action-block-img" src="/users/<?=$action['uid']?>/304_<?=$action['picture']?>" alt="">
                  <?php endif; ?>
               <div class="action-block-user" style="display: none;">
                    <?php
                    if(is_file('./users/'.$action['uid'].'/'.$act_user->photo)):
                    ?>
                    <img class="action-block-user-photo" src="/users/<?=$action['uid']?>/<?=$act_user->photo?>" alt="">
                    <?php else: ?>
                    <img class="action-block-user-photo" src="/img/zaglushka.png" alt="">
                    <?php endif; ?>
                    <div class="action-block-user-name">
                      <?=$act_user->name?>
                    </div>
                  </div>
                  <div class="action-block-desc">
                    <div class="action-block-desc-bg"></div>
                    <div class="action-block-desc-city">г. <?=City::getName($act_user->city_id)?></div>
                    <div class="action-block-desc-name">
                      <?=$action['title']?>
                    </div>
                  </div>
                  <div class="action-block-price">
                    <div class="action-block-price-big"><?=$new_price?> грн</div>
                    <div class="action-block-old-price"><?=$action['price']?> грн</div>
                    <div class="action-block-time">
                      <div class="action-block-time-day"><?=Settings::get_duration(date('Y-m-d',time()),$action['date_end'])?> дн.</div>
                    </div>
                  </div>
                </a>
<?php } ?>               
        </div>
      </section>
    </div>
  </div>
  <div class="wrapper wrapper--add-promotion">
    <a class="add-promotion" href="/my/actions">Добавить акцию<span class="add-promotion-plus">+</span></a>
  </div>  
<?php endif; ?>  
  
<?php
$users=Users::model()->findAllBySql('select * from {{users}} where (member_type="plus" or member_type="pro") and activate=1 and city_id!="" order by rand() limit 4');
if(count($users)>0):
?>  
  <div class="wrapper wrapper--popular">
    <section class="container">
      <div class="container__title-wrapper">
        <h5 class="container__title container__title--popular">ВОСТРЕБОВАННЫЕ УЧАСТНИКИ</h5>
      </div>
<?php
    foreach($users as $u) {
        if(is_file('./users/'.$u['id'].'/290_'.substr($u['photo'],4)))
            $img='290_'.substr($u['photo'],4);
        else
            $img=$u['photo'];
?>
      <a class="popular-block" href="/id<?=$u['id']?>">
        <img class="popular-block-img" src="/users/<?=$u['id']?>/<?=$img?>" alt="" style="top: 0px; right: 0px; width: 100%; height: 100%;">
        <div class="popular-block-city">
          <div class="popular-block-city-bg"></div>
          <div class="popular-block-city-content">г.<?=City::getName($u['city_id'])?></div>
        </div>
        <div class="popular-block-account" style="display: none;">
          <div class="popular-block-account-border"></div>
          <?=$u['member_type']?>
        </div>
        <div class="popular-block-info">
          <div class="popular-block-info-bg"></div>
          <div class="popular-block-name-prof">
            <div class="popular-block-name">
            <?php
            if(strlen($u['name'])>45) echo substr($u['name'],45).'...';
            else echo $u['name']; 
            ?>
            </div>
            <div class="popular-block-proffesion"><?=Occupation::getName($u['occupation_id'])?></div>
          </div>
          <!--div class="popular-block-rating">9,9</div-->
        </div>
      </a><!-- end popular-block -->
<?php   } ?>      
    </section>
  </div>
<?php endif; ?>  
  
  
  <div class="wrapper wrapper--last-registers">
    <section class="container">
      <div class="container__title-wrapper">
        <h5 class="container__title">ПОСЛЕДНИЕ ЗАРЕГИСТРИРОВАННЫЕ УЧАСТНИКИ</h5>
      </div>
      <?php
      $users=Users::model()->findAllBySql('select * from {{users}} where activate=1 and photo!="" order by id desc limit 12');
      foreach($users as $item) {
        if($item['member']==0) $member_type='client';
        else $member_type=$item['member_type'];
      ?>
      <a class="last-reg-user" href="/id<?=$item['id']?>">
         <?php
         if(is_file('./users/'.$item['id'].'/'.$item['photo'])):
         ?>
         <img class="last-reg-user-photo" src="/users/<?=$item['id']?>/<?=$item['photo']?>" alt="<?=$item['name']?>" />
         <?php else: ?>
         <img class="last-reg-user-photo" src="/img/zaglushka.png" alt="<?=$item['name']?>" />
         <?php endif; ?>
         <div class="last-reg-user-account last-reg-user-account-<?=$member_type?>"><?=$member_type?></div>
      </a>
      <?php } ?>
    </section>
  </div>  