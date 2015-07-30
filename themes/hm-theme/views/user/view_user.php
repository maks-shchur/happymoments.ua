<?php
/* @var $this ProfileController */

$this->breadcrumbs=array(
    //Occupation::getName($model->occupation_id)=>array('/cat/'.$model->occupation_id),
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
            <div class="wrapper cabinet-pro-banner" id="top_banner"></div>
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
    <div class="container">
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
        
        <div class="equipment-list">
          <?php
          foreach($flo as $item) {
          ?>
          <article class="accaunt-pro__equipment__item">
            <figure>
              <?php
              if($item->picture!=''):
              ?>  
              <a href="/users/<?=$model->id?>/<?=$item->picture?>" class="accaunt-pro__equipment__item__img photo__zoom">
              <?php else: ?>
              <a href="#" class="accaunt-pro__equipment__item__img">
              <?php endif; ?>
                <span>
                    <?php
                    if($item->picture!=''):
                        if(!is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.$model->id.'/280_'.$item->picture)) {
                            $ih=new CImageHandler();
                            $ih
                                ->load($_SERVER['DOCUMENT_ROOT'] . '/users/'.$model->id.'/'.$item->picture)                    
                                ->adaptiveThumb(280, 421)
                                ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.$model->id.'/280_'.$item->picture);
                        }
                    ?>
                    <img src="/users/<?=$model->id?>/280_<?=$item->picture?>" alt="" />
                    <?php else: ?>
                    <img src="/img/zaglushka.png" alt="" />
                    <?php endif; ?>
                </span>
                <div class="flo__price"><?=$item->price?> грн/час</div>
              </a>

              <figcaption class="accaunt-pro__equipment__item__info">
                <h3><?=$item->title?></h3>
                <div class="nano" style="height: 180px;">
                    <p class="nano-content" style="padding-right: 30px;"><?=$item->description?></p>
                </div>
              </figcaption>
            </figure>
          </article>
          <?php
          }
          ?>
          
        </div>
    

    </div>
  </div>