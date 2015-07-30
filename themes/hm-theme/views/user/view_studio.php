<?php
/* @var $this ProfileController */

$this->breadcrumbs=array(
    //Occupation::getName($model->occupation_id)=>array('/cat/'.$model->occupation_id),
    Occupation::getName($model->occupation_id)=>$this->createUrl('cat/view',array('alias'=>Settings::toLatin(Occupation::getName($model->occupation_id)))),
	$model->name,
);

if(!Yii::app()->user->isGuest) {
    if(Yii::app()->user->id!=$model->id)
        Users::addHit($model->id);
}
else Users::addHit($model->id);
?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/min/jquery.nanoscroller.min.js'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/min/jquery.stellar.min.js'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/min/jquery.fancybox.pack.js'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/min/jquery.tooltipster.min.js'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/masked.js'); ?>

<script>
$(document).ready(function(){
   $("#phone").mask("+38(999) 999-99-99"); 
    
   $("#phone_user").click(function(){
      $.ajax({
          url: '<?=$this->createUrl('/user/getphone')?>',
          type: "POST",
          data: {'id':$('#phone_user').attr('data-phone')},
          success: function (data) {
            $('#phone_user').hide();
            $('#res_' + $('#phone_user').attr('data-phone')).css('padding-left','35px');
            $('#res_' + $('#phone_user').attr('data-phone')).css('margin-top','-20px');
            $('#res_' + $('#phone_user').attr('data-phone')).html(data);
          },
        });
   });
});
function call() {
  var msg   = $('#formx').serialize();
  if($('#about__user').val()!='') {
    $('.loader').css('display','block');
    $.ajax({
      type: 'POST',
      url: '<?=$this->createUrl('/site/sendmsg')?>',
      data: msg,
      success: function(data) {
        $('.add-albom__modal__content').html(data);
        $('.loader').css('display','none');
      },
      error:  function(xhr, str){
            $('.loader').css('display','none');
            alert('Возникла ошибка: ' + xhr.responseCode);
        }
    });
  }
  else alert('Напишите Ваше сообщение');
}

function call_me() {
  var msg   = $('#formx2').serialize();
  $('.loader').css('display','block');
  if($('#phone').val()!='') {
    $.ajax({
      type: 'POST',
      url: '<?=$this->createUrl('/site/callme')?>',
      data: msg,
      success: function(data) {
        $('.add-albom__modal__content').html(data);
        $('.loader').css('display','none');
        setTimeout(function(){
          $("#__accaunt_call_me").modal('hide');
        }, 2000);
        
      },
      error:  function(xhr, str){
            $('.loader').css('display','none');
            alert('Возникла ошибка: ' + xhr.responseCode);
        }
    });
  }
  else alert('Напишите Ваш телефон');
}
    
function addFavorite(arg) {
    $.ajax({
      type: 'POST',
      url: '<?=$this->createUrl('/user/addFavorite')?>',
      data: {uid:<?=isset(Yii::app()->user->id)?Yii::app()->user->id:0?>, user_id:arg},
      success: function(data) {
        window.location.reload();
      },
      error:  function(xhr, str){
            alert('Возникла ошибка: ' + xhr.responseCode);
        }
    });    
}
</script>
<?php
  if($model->member=='0') {
  ?>
  <div class="wrapper cabinet-general__profile__banner">
    <div class="wrapper cabinet-general__profile__banner-overlay"></div>
  </div>
<?php
    }
    else {
        if($model->member_type=='plus') {
?>
<style>
.accaunt__left-info {
    top: -120px;
  }
.bread-crumbs {
    float:left;    
}  
.accaunt__left-info {
    max-height:250px;
} 
</style>
            <div class="wrapper cabinet-pro-banner cabinet-plus-banner" id="top_banner"></div>
<?php            
            if($model->top_banner!='') {
?> 
              <style>
              #top_banner {
                background: url('/users/<?=$model->id?>/<?=$model->top_banner?>') no-repeat !important;  
              }
              </style>
<?php
            }
        }
        if($model->member_type=='pro') {
?>
<style>
.accaunt__left-info {
    top: -120px;
  }
.bread-crumbs {
    float:left;    
}
.accaunt__left-info {
    max-height:250px;
}   
</style>
            <div class="wrapper cabinet-pro-banner" id="top_banner">
              <div class="pro_top_menu">
              <div class="container">
                <ul class="accaunt-pro__header__menu">
                    <li class="top_pro_active"><a href="/id<?=$model->id?>">Интерьер</a></li>
                    <li><a href="/id<?=$model->id?>?rent">Аренда</a></li>
                    <li><a href="/id<?=$model->id?>?equip">Оборудование</a></li>
                    <!--li><a href="#">Услуги</a></li>
                    <li><a href="#">Портфолио</a></li>
                    <li><a href="#">3D туры</a></li-->
                    <li><a href="/id<?=$model->id?>?prices">Цены</a></li>
                    <!--li><a href="/id<?=$model->id?>?calendar">Календарь</a></li-->
                </ul>
              </div>
              </div>
            </div>
<?php            
            if($model->top_banner!='') {
?> 
              <style>
              #top_banner {
                background: url('/users/<?=$model->id?>/<?=$model->top_banner?>') no-repeat !important;  
              }
              </style>
<?php
            }
        }
  }
?>

<div class="wrapper accaunt-container">
    <div class="container accaunt-pro">
      <section class="accaunt">
        <div class="accaunt__left-info">
          <figure class="accaunt__left__user-photo"<?=$model->member_type=='basic'?' style="background:none;padding-left:0px;"':''?>>
            <?php
            if(is_file('./users/'.$model->id.'/'.$model->photo)) {
                echo CHtml::image('/users/'.$model->id.'/'.$model->photo,'My photo');
            }
            else {
                echo CHtml::image('/img/zaglushka.png','My photo');
            }
            ?>
          </figure>
          <?php if(!Yii::app()->user->isGuest) { 
                    if(Yii::app()->user->id!=$model->id) {
          ?>
          <div class="accaunt__left__under-photo">
            <a href="#0" class="accaunt_send-massage" data-toggle="modal" data-target="#__accaunt_send-massage"></a>
            <!--span class="accaunt_send-massage"></span-->
            
            <a href="" onclick="addFavorite(<?=$model->id;?>)" class="accaunt_like"></a>
          </div>

              <!-- отправить сообщение -->
                <div class="modal fade" id="__accaunt_send-massage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <header class="add-albom__modal__header"><h6>НАПИСАТЬ ПИСЬМО</h6><a href="#0" data-dismiss="modal" class=""></a></header>
                      <div class="add-albom__modal__content">
                      <form method="post" id="formx" action="javascript:void(null);" onsubmit="call()">
                        <!--label for="albom__name">Тема</label>
                        <input type="text" name="title" id="albom__name" class="default__input search__hidden__input--city" title="Это поле обязательно для заполнение" placeholder="Хочу заказать Вашу услугу" required=""-->
                        <label for="albom__name">Сообщение</label>
                        <textarea name="msg" id="about__user" cols="25" rows="10" class="default__textarea" placeholder="Подробная информация о ваших пожеланиях, предложениях"></textarea>
                        <input type="hidden" name="to_uid" value="<?=$model->id;?>" />
                        <input type="hidden" name="from_uid" value="<?=Yii::app()->user->id;?>" />
                        <button class="enter__in__account" type="submit">ОТПРАВИТЬ</button>
                      </form>  
                      </div>
                    </div>
                  </div>
                </div>
          <div class="accaunt__call-me"><a href="#0" data-toggle="modal" data-target="#__accaunt_call_me">Перезвоните мне</a></div>
                <div class="modal fade" id="__accaunt_call_me" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <header class="add-albom__modal__header"><h6>ПЕРЕЗВОНИТЕ МНЕ</h6><a href="#0" data-dismiss="modal" class=""></a></header>
                      <div class="add-albom__modal__content">
                      <form method="post" id="formx2" action="javascript:void(null);" onsubmit="call_me()">
                        <label for="albom__name">Ваш телефон</label>
                        <input type="text" name="phone" id="phone" class="default__input search__hidden__input--city" title="Это поле обязательно для заполнение" placeholder="+38..." required="">
                        <label for="albom__name">Сообщение</label>
                        <textarea name="msg" id="about__user" cols="25" rows="10" class="default__textarea" placeholder="Подробная информация о ваших пожеланиях, предложениях"></textarea>
                        <input type="hidden" name="to_uid" value="<?=$model->id;?>" />
                        <button class="enter__in__account" type="submit">ОТПРАВИТЬ</button>
                      </form>  
                      </div>
                    </div>
                  </div>
                </div>
          <?php 
                    }
          } else { ?>
          <div class="accaunt__left__under-photo">
            <a href="#0" class="accaunt_send-massage" data-toggle="modal" data-target="#__accaunt_send-massage"></a>
            <!--span class="accaunt_send-massage"></span-->
            
            <span class="accaunt_like"></span>
          </div>

              <!-- отправить сообщение -->
                <div class="modal fade" id="__accaunt_send-massage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <header class="add-albom__modal__header"><h6>НАПИСАТЬ ПИСЬМО</h6><a href="#0" data-dismiss="modal" class=""></a></header>
                      <div class="add-albom__modal__content">
                      <form method="post" id="formx" action="javascript:void(null);" onsubmit="call()">
                        <label for="albom__name">Ваш e-mail</label>
                        <input type="text" name="email" id="albom__name" class="default__input search__hidden__input--city" title="Это поле обязательно для заполнение" placeholder="Exemple@gmail.com" required="">
                        <!--label for="albom__name">Тема</label>
                        <input type="text" name="title" id="albom__name" class="default__input search__hidden__input--city" title="Это поле обязательно для заполнение" placeholder="Хочу заказать Вашу услугу" required=""-->
                        <label for="albom__name">Сообщение</label>
                        <textarea name="msg" id="about__user" cols="25" rows="10" class="default__textarea" placeholder="Подробная информация о ваших пожеланиях, предложениях"></textarea>
                        <input type="hidden" name="to_uid" value="<?=$model->id;?>" />
                        <button class="enter__in__account" type="submit">ОТПРАВИТЬ</button>
                      </form>  
                      </div>
                    </div>
                  </div>
                </div>
          <div class="accaunt__call-me"><a href="#0" data-toggle="modal" data-target="#__accaunt_call_me">Перезвоните мне</a></div>
                <div class="modal fade" id="__accaunt_call_me" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <header class="add-albom__modal__header"><h6>ПЕРЕЗВОНИТЕ МНЕ</h6><a href="#0" data-dismiss="modal" class=""></a></header>
                      <div class="add-albom__modal__content">
                      <form method="post" id="formx2" action="javascript:void(null);" onsubmit="call_me()">
                        <label for="albom__name">Ваш телефон</label>
                        <input type="text" name="phone" id="phone" class="default__input search__hidden__input--city" title="Это поле обязательно для заполнение" placeholder="+38..." required="">
                        <label for="albom__name">Сообщение</label>
                        <textarea name="msg" id="about__user" cols="25" rows="10" class="default__textarea" placeholder="Подробная информация о ваших пожеланиях, предложениях"></textarea>
                        <input type="hidden" name="to_uid" value="<?=$model->id;?>" />
                        <button class="enter__in__account" type="submit">ОТПРАВИТЬ</button>
                      </form>  
                      </div>
                    </div>
                  </div>
                </div>
          <?php } ?>
          <div class="accaunt__views">Просмотров&nbsp;&nbsp;<?=$model->views;?></div>
        </div>
        <div class="accaunt__right-info">
          <header class="accaunt__right__header">
            <div class="accaunt__right__header__name col-8">
              <h1><?=$model->name;?></h1>
              <div class="accaunt__status <?=$model->member_type;?>"><?=$model->member_type;?></div>
              <span class="accaunt__role"><?=Occupation::getName($model->occupation_id);?></span>
            </div>
            <div class="accaunt__right__header__rate col-4">
              <?=Users::getTimeAgo($model->date_registered);?><span><!--9,5--></span>
            </div>
          </header>
          <div class="col-4 accaunt-contacts">
            <ul class="accaunt-contacts__list">
              <?php if($model->address!=''): ?>
              <li class="accaunt-contacts__item accaunt-address"><a href="#" class="accaunt-contacts__link"><?=$model->address;?></a></li>
              <?php endif; ?>
              <li class="accaunt-contacts__item accaunt-tel"><span class="accaunt-contacts__link" id="phone_user" data-phone="<?=$model->id?>">+38 показать номер</span></li><div id="res_<?=$model->id?>"></div>
              <?php if($model->skype!=''): ?>
              <li class="accaunt-contacts__item accaunt-skype"><a href="skype:<?=$model->skype;?>?call" class="accaunt-contacts__link"><?=$model->skype;?></a></li>
              <?php endif; ?>
              <li class="accaunt-contacts__item accaunt-email"><a href="mailto:<?=$model->email;?>" class="accaunt-contacts__link"><?=$model->email;?></a></li>
              <?php if($model->url!=''): ?>
              <li class="accaunt-contacts__item accaunt-site"><a href="http://<?=$model->url;?>" class="accaunt-contacts__link" target="_blank"><?=$model->url;?></a></li>
              <?php endif; ?>
            </ul>
          </div>
          <article class="col-8 accaunt_description">
            <?php 
            $m=Session::model()->findByAttributes(array('user_id'=>$model->id));
            if(is_object($m)):
            ?>
            <div class="online-status">ONLINE</div>
            <?php endif; ?>
            <?php if($model->about!=''):?>
            <h6>Описание</h6>
            <div class="accaunt_description__scroll-block nano">
              <div class="nano-content">
                <div style="max-width: 593px;word-break: break-word;"><?=$model->about;?></div>
              </div>
            </div>
            <?php endif; ?>
          </article>
         </div>
      </section>
      
      <?php
      if((isset($banners->banner1) && $banners->banner1!='') || (isset($banners->banner2) && $banners->banner2!='') || (isset($banners->banner3) && $banners->banner3!=''))
      {
      ?>
      <div class="accaunt-pro__main-slider-container">
          <!-- Wrapper -->
          <div class="accaunt-pro__main-slider-wrapper">
              <!-- Carousel -->
              <div class="accaunt-pro__main-slider">
                  <ul>
                    <?php if($banners->banner1!=''): ?>
                        <li class="accaunt-pro__main-slider__item">
                            <img src="/users/<?=$model->id?>/<?=$banners->banner1?>" alt="" width="1160" height="325">
                        </li>
                    <?php endif; ?>
                    <?php if($banners->banner2!=''): ?>
                        <li class="accaunt-pro__main-slider__item">
                            <img src="/users/<?=$model->id?>/<?=$banners->banner2?>" alt="" width="1160" height="325">
                        </li>
                    <?php endif; ?>
                    <?php if($banners->banner3!=''): ?>
                        <li class="accaunt-pro__main-slider__item">
                            <img src="/users/<?=$model->id?>/<?=$banners->banner3?>" alt="" width="1160" height="325">
                        </li>
                    <?php endif; ?>
                  </ul>
              </div>
              <a href="#" class="accaunt-pro__main-slider-next"></a>
              <!-- Pagination -->
              <div class="accaunt-pro__main-slider__pagination">
                  <!-- Pagination items will be generated in here -->
              </div>
          </div>
        </div>
      <?php  
      }
      ?> 
      
      <?php
      if(count($hals)>0):
        $cnt=0;
      ?>
        <div class="accaunt-gallery-container">
      <?php
        foreach($hals as $hal) {
            $cnt++;
      ?> 
          <figure class="accaunt-gallery__thumbnail">
            <a href="/id<?=$model->id?>?halls&hid=<?=$hal->id?>" class="accaunt-gallery__img">
                <?php if($hal->picture!=''): ?>
                    <img src="/users/<?=$model->id?>/<?=$hal->picture?>" alt="<?=$model->name?> - <?=$hal->title?>" />
                <?php else: ?>
                    <img src="/img/zaglushka.png" alt="">
                <?php endif ?>
            </a>
            <figcaption class="accaunt-gallery__thumbnail-overlay">
              <a href="#">
                <div class="accaunt-gallery__info-container"><?=$hal->title?><div class="icon__img"></div></div>
              </a>
            </figcaption>
          </figure>
    <?php 
        }
        for($i=1;$i<=(3-round($cnt%3,2));$i++) {
        ?>
          <figure class="accaunt-gallery__thumbnail">
            <span class="accaunt-gallery__img">
                <img src="/img/zaglushka.png" alt="">
            </span>
          </figure>
        <?php    
        }
    ?>
        </div>
    <?php
    endif; ?>        

    </div>
  </div>