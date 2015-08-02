<?php
/* @var $this ProfileController */

$this->breadcrumbs=array(
	'Profile',
);


                    

?>
 <?php
  if(!Yii::app()->user->isGuest) {
    if(Yii::app()->user->member=='0') {
  ?>
  <div class="wrapper cabinet-general__profile__banner">
    <div class="wrapper cabinet-general__profile__banner-overlay"></div>
    <div class="container">
      <figure class="cabinet-general__ava">
        <?php
        if(is_file('./users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo)) {
            echo CHtml::image('/users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo,'My photo',array('id'=>'my_ava'));
        }
        else {
            echo CHtml::image('/img/zaglushka.png','My photo',array('id'=>'my_ava'));
        }
        ?>
        
        <figcaption>
            <?php
            $this->widget('ext.EAjaxUpload.EAjaxUpload',
            array(
                    'id'=>'uploadFile',
                    'config'=>array(
                           'action'=>Yii::app()->createUrl('my/profile/updateava',array('id'=>Yii::app()->user->id)),
                           'allowedExtensions'=>array("jpg","jpeg","gif","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                           'sizeLimit'=>2*1024*1024,// maximum file size in bytes
                           //'minSizeLimit'=>10*1024*1024,// minimum file size in bytes
                           'onComplete'=>"js:function(id, fileName, responseJSON){ $('#my_ava').attr('src', '/users/".Yii::app()->user->id."/'+fileName); location.reload(); }",
                           //'messages'=>array(
                           //                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                           //                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                           //                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                           //                  'emptyError'=>"{file} is empty, please select files again without it.",
                           //                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                           //                 ),
                           //'showMessage'=>"js:function(message){ alert(message); }"
                          )
            ));
            ?>
        </figcaption>
    </figure>
    </div>
  </div>
  <?php    
    }
    else {
    if(Yii::app()->user->member_type=='basic') {
  ?>
    <div class="container">
      <figure class="cabinet-general__ava" style="top:10px !important;">
        <?php
        if(is_file('./users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo)) {
            echo CHtml::image('/users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo,'My photo',array('id'=>'my_ava'));
        }
        else {
            echo CHtml::image('/img/zaglushka.png','My photo',array('id'=>'my_ava'));
        }
        ?>
        
        <figcaption>
            <?php
            $this->widget('ext.EAjaxUpload.EAjaxUpload',
            array(
                    'id'=>'uploadFile',
                    'config'=>array(
                           'action'=>Yii::app()->createUrl('my/profile/updateava',array('id'=>Yii::app()->user->id)),
                           'allowedExtensions'=>array("jpg","jpeg","gif","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                           'sizeLimit'=>2*1024*1024,// maximum file size in bytes
                           //'minSizeLimit'=>10*1024*1024,// minimum file size in bytes
                           'onComplete'=>"js:function(id, fileName, responseJSON){ $('#my_ava').attr('src', '/users/".Yii::app()->user->id."/'+fileName); location.reload(); }",
                           //'messages'=>array(
                           //                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                           //                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                           //                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                           //                  'emptyError'=>"{file} is empty, please select files again without it.",
                           //                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                           //                 ),
                           //'showMessage'=>"js:function(message){ alert(message); }"
                          )
            ));
            ?>
        </figcaption>
    </figure>
    </div>
  <?php      
    }    
    if(Yii::app()->user->member_type=='plus' || Yii::app()->user->member_type=='pro') {
        
  ?>
  <style>
  .cabinet-pro-banner__upload {
    bottom: -196px !important;
  }
  </style>
  <div class="wrapper cabinet-pro-banner cabinet-plus-banner" id="top_banner">
    <div class="container">
      <?php
      if($user->top_banner!=''):
      ?> 
      <a href="/my/profile/delbanner"><div class="cabinet-pro-banner__del"></div></a>
      <style>
      #top_banner {
        background: url('/users/<?=$user->id?>/<?=$user->top_banner?>') no-repeat !important;  
      }
      </style>
      <?php
      else:
      ?>
      <?php
      /*   $this->widget('ext.Banner.Banner',
        array(
                'id'=>'uploadBanner',
                'config'=>array(
                       'action'=>Yii::app()->createUrl('/my/profile/addbanner'),
                       'allowedExtensions'=>array("jpg","jpeg","gif","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                       'sizeLimit'=>8*1024*1024,// maximum file size in bytes
                       'minSizeLimit'=>1*1024,
                       'auto'=>true,
                       'multiple' => false,
                       'onComplete'=>"js:function(id, fileName, responseJSON){
                            $('#top_banner').css('background', 'url(/users/".Yii::app()->user->id."/banner_+fileName) no-repeat !important');
                            window.location.reload();
                        }",
                       )
         
         ));*/
        ?>  
      <?php
      endif;
      ?>
      <figure class="cabinet-general__ava" style="top: 140px !important;">
        <?php
        if(is_file('./users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo)) {
            echo CHtml::image('/users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo,'My photo',array('id'=>'my_ava'));
        }
        else {
            echo CHtml::image('/img/zaglushka.png','My photo',array('id'=>'my_ava'));
        }
        ?>
        
        <figcaption>
            <?php
            $this->widget('ext.EAjaxUpload.EAjaxUpload',
            array(
                    'id'=>'uploadFile',
                    'config'=>array(
                           'action'=>Yii::app()->createUrl('my/profile/updateava',array('id'=>Yii::app()->user->id)),
                           'allowedExtensions'=>array("jpg","jpeg","gif","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                           'sizeLimit'=>2*1024*1024,// maximum file size in bytes
                           //'minSizeLimit'=>10*1024*1024,// minimum file size in bytes
                           'onComplete'=>"js:function(id, fileName, responseJSON){ $('#my_ava').attr('src', '/users/".Yii::app()->user->id."/'+fileName); location.reload(); }",
                           //'messages'=>array(
                           //                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                           //                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                           //                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                           //                  'emptyError'=>"{file} is empty, please select files again without it.",
                           //                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                           //                 ),
                           //'showMessage'=>"js:function(message){ alert(message); }"
                          )
            ));
            ?>
        </figcaption>
    </figure>
    </div>
  </div>  
  <?php      
    }
    /*elseif(Yii::app()->user->member_type=='pro') {
  ?>
  <style>
  .qq-upload-button3 input {
    top: 285px !important;
  }
  </style>
  <div class="wrapper cabinet-pro-banner" id="top_banner">
    <div class="container">
      <?php
      if($user->top_banner!=''):
      ?>  
      <a href="/my/profile/delbanner"><div class="cabinet-pro-banner__del"></div></a>
      <style>
      #top_banner {
        background: url('/users/<?=$user->id?>/<?=$user->top_banner?>') no-repeat !important;  
      }
      </style>
      <?php
      else:
      ?> 
      <?php
         $this->widget('ext.Banner.Banner',
        array(
                'id'=>'uploadBanner',
                'config'=>array(
                       'action'=>Yii::app()->createUrl('/my/profile/addbanner'),
                       'allowedExtensions'=>array("jpg","jpeg","gif","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                       'sizeLimit'=>8*1024*1024,// maximum file size in bytes
                       'minSizeLimit'=>1*1024,
                       'auto'=>true,
                       'multiple' => false,
                       'onComplete'=>"js:function(id, fileName, responseJSON){
                            $('#top_banner').css('background', 'url(/users/".Yii::app()->user->id."/banner_+fileName) no-repeat !important');
                            window.location.reload();
                        }",
                       )
         
         ));
        ?> 
      <?php
      endif;
      ?> 
      <figure class="cabinet-general__ava_pro">
        <?php
        if(is_file('./users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo)) {
            echo CHtml::image('/users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo,'My photo',array('id'=>'my_ava'));
        }
        else {
            echo CHtml::image('/img/zaglushka.png','My photo',array('id'=>'my_ava'));
        }
        ?>
        
        <figcaption>
            <?php
            $this->widget('ext.EAjaxUpload.EAjaxUpload',
            array(
                    'id'=>'uploadFile',
                    'config'=>array(
                           'action'=>Yii::app()->createUrl('my/profile/updateava',array('id'=>Yii::app()->user->id)),
                           'allowedExtensions'=>array("jpg","jpeg","gif","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                           'sizeLimit'=>2*1024*1024,// maximum file size in bytes
                           //'minSizeLimit'=>10*1024*1024,// minimum file size in bytes
                           'onComplete'=>"js:function(id, fileName, responseJSON){ $('#my_ava').attr('src', '/users/".Yii::app()->user->id."/'+fileName); location.reload(); }",
                           //'messages'=>array(
                           //                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                           //                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                           //                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                           //                  'emptyError'=>"{file} is empty, please select files again without it.",
                           //                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                           //                 ),
                           //'showMessage'=>"js:function(message){ alert(message); }"
                          )
            ));
            ?>
        </figcaption>
    </figure>
    </div>
  </div>
  <?php      
        }*/
    }
  } 
  ?>
  <div class="wrapper wrapper-cabinet">
    <div class="container clfx">
      <div class="cabinet-nav">
        <nav class="cabinet__first-menu">
          <ul>
            <li><?=CHtml::link('Информация','/my/profile/');?></li>
            <?php if($user->member!=0):?>
                <?php if($user->occupation->templ=='members'):?>
                    <li><?=CHtml::link('Портфолио','/my/portfolio/');?></li>
                    <li><?=CHtml::link('Календарь занятости','/my/calendar/');?></li>
                    <?php if($user->genre_id!=''): ?>
                    <li><?=CHtml::link('Цены','/my/prices/');?></li>
                    <?php endif; ?>
                <?php elseif($user->occupation->templ=='avto'):?>
                    <li><?=CHtml::link('Авто парк','/my/avto/');?></li>
                <?php elseif($user->occupation->templ=='flo'):?>
                    <li><?=CHtml::link('Продукция','/my/flo/');?></li>
                <?php elseif($user->occupation->templ=='rent_photo'):?>
                    <li><?=CHtml::link('Интерьеры','/my/studio/interior');?></li>
                    <li><?=CHtml::link('Аренда','/my/studio/rent');?></li>
                    <li><?=CHtml::link('Оборудование','/my/studio/equip');?></li>
                    <li><?=CHtml::link('Услуги','/my/studio/services');?></li>
                    <li><?=CHtml::link('3D  туры','/my/studio/tours');?></li>
                    <li><?=CHtml::link('Цены','/my/studio/prices');?></li>
                <?php else: ?>
                    <li><?=CHtml::link('Портфолио','/my/portfolio/');?></li>
                <?php endif;?>
            <?php endif; ?>
          </ul>
        </nav>
        <?php if(Yii::app()->user->member_type=='basic'):?>
        <div class="cabinet__text-about"></div>
        <div class="cabiner__abount-accaunts">
          <div class="cabiner__abount-accaunts-plus">plus</div>
          <div class="cabiner__abount-accaunts-pro">pro</div>
          <a href="/accounts" class="cabiner__abount-accaunts-readmore">подробнее</a>
        </div>
        <?php elseif(Yii::app()->user->member_type=='plus'): ?>
        <div class="cabinet__text-about"></div>
        <div class="cabiner__abount-accaunts cabiner__plus__bount-accaunts">
          <div class="cabiner__abount-accaunts-pro ">pro</div>
          <a href="/accounts" class="cabiner__abount-accaunts-readmore">подробнее</a>
        </div>
        <?php endif;?>
      </div>
      
      <div class="cabinet-main" <?=(Yii::app()->user->member_type=='basic')?'style="top:-180px !important;"':'';?>>
      <div class="clfx"></div>
        <header class="cabinet__header">
          <div class="cabinet__title clfx">
            <div class="accaunt__right__header__name col-8">
              <h1><?=Yii::app()->user->name;?></h1>
              <?php //if(Yii::app()->user->member!=0): ?>
              <div class="accaunt__status <?=Yii::app()->user->member_type;?>"><?=Yii::app()->user->member_type;?></div>
              <span class="accaunt__role"><?=Occupation::getName($user->occupation_id);?></span>
              <? //endif; ?>
            </div>
            <div class="accaunt__right__header__rate pt25 col-4">
              <?=Users::getTimeAgo($user->date_registered);?>
            </div>
          </div>
          <nav class="cabinet__second-menu">
            <ul>
              <li class="active"><?=CHtml::link('Профиль','/my/profile/');?></li>
              <li><?=CHtml::link('Избранное','/my/favorites/');?></li>
              <?php if($user->member_type!='basic'):?>
                    <li><?=CHtml::link('Мои акции','/my/actions/');?></li>
                <?php endif;?>
              <li><?=CHtml::link('Мои тендеры','/my/tenders/');?></li>
              <li><?=CHtml::link('Сообщения','/my/messages/');?></li>
              <li><?=CHtml::link('Настройки','/my/profile/settings');?></li>
            </ul>
          </nav>
        </header>
        <?php 
        if(count($model) > 0):
            //$genres=unserialize($model->genre_id);
            $cnt=count($model);
            
         
            //$this->renderPartial('_albums', array('model'=>$model,'dataProvider'=>$dataProvider));
            //$this->renderPartial('_add_album', array('model'=>$model)); 
        ?>
        
        <main class="cabinet__portfolio">
        <div id="cabiner__gallery__select">
          <h3 class="cabinet__accordion__title">Видео альбомы</h3>
            <div class="cabinet__photo__list">
              <div class="col-9 cabinet__portfolio__select4-photo"><a href="#">Выберите любые 4-е фотографии из любых альбомов для главной страницы</a></div>
              <div class="col-3 cabinet__portfolio__add-photo">
              <!--div class="col-12 global__plus__btn-container">
                <a href="#" class="global__plus__btn" data-toggle="modal" data-target="#__add-albom"><i></i><span>Добавить фото</span></a>
              </div-->

              </div>
              <div class="clfx"></div>
                <?php
                foreach($model as $item) {
                ?>
                <div class="data_<?=$item->id?>">
                <figure class="cabinet__photo__item">
                  <a href="/my/video/album/id/<?=$item->id;?>">
                    <?php if($item->picture!=''): ?>
                    <img src="/users/<?=Yii::app()->user->id?>/254_<?=$item->picture?>" alt="<?=$item->description?>" />
                    <?php else: ?>
                    <img src="/img/zaglushka.png" alt="" />
                    <?php endif; ?>
                  </a>
                  <a href="/my/video/visible/id/<?=$item->id?>" class="cabinet__photo__item-view"></a>
                  <a href="/my/video/album/id/<?=$item->id?>" class="cabinet__photo__item-edit"></a>
                  <a href="javascript:void(0)" class="message__item-delete"><span class="cabinet__photo__item-delete"></span></a>
                    <div class="delete__hidden">
                        <div class="delete__hidden-title">Вы уверены что хотите удалить?</div>
                        <div class="delete__hidden-yes" id="<?=$item->id?>">ДА</div>
                        <div class="delete__hidden-no">нет</div>
                    </div>
                  <figcaption class="accaunt-gallery__thumbnail-overlay cabinet-gallery__thumbnail-overlay">
                    <a href="">
                      <div class="accaunt-gallery__info-container"><?=$item->title;?><div class="accaunt-gallery__info-number"><?=count($item->videos);?></div></div>
                    </a>
                  </figcaption>
                  <?php
                  if($item->visible==0): 
                  ?>
                  <a href="/my/video/visible/id/<?=$item->id?>">
                  <div class="cabinet__photo__item__hidden">
                    АЛЬБОМ НЕВИДЕН<br>
                    пользователям
                  </div>
                  </a>
                  <?php endif; ?>
                </figure>
                <script>
                $('#<?=$item->id?>').click(function(){
                    $('.delete__hidden').hide();
                    $.ajax({
                        url: '/my/video/delete/id/<?=$item->id.'?back_url='.Yii::app()->request->requestUri?>',          
                        type : "get",                     
                        success: function (data, textStatus) {
                            //$('.data_<?=$item->id?>').fadeOut(400);
                            window.location.reload();
                        }               
                    });
                });
                </script>
                
                
                </div>
                <?php } 
                if($cnt<=3) {
                    $c=round($cnt/3,2);
                    $c=abs(round(1-$c,2));
                    $c=$c/0.33;
                } else {
                    $c=$cnt%3;
                    //$c=abs(round(1-$c,2));
                    //$c=(1-$c)/0.33;
                    $c=3-$c;    
                }
                for($i=1;$i<=$c;$i++) {
                ?>
                <figure class="cabinet__photo__item">
                  <img src="/img/zaglushka.png" alt="" />
                </figure>
                <?php    
                }
                ?>
            </div>
            <!--h3 class="cabinet__accordion__title">Видео</h3>
            <div class="cabinet__video__list">
              <div class="col-9 cabinet__portfolio__select4-photo"><a href="#">Выберите любые 4-е видео файла для главной страницы</a></div>
              <div class="col-3 cabinet__portfolio__add-photo cabinet__portfolio__add-photo">      
                <div class="col-12 global__plus__btn-container">
                    <a href="#" class="global__plus__btn" onclick='$("#addvideo").dialog("open"); return false;'><i></i><span>Добавить видео</span></a>
                </div>
              </div>
              <div class="clfx"></div>
              <figure class="cabinet__video__item">
                <div class="cabinet__video-link">
                  <iframe width="300" height="auto" src="//www.youtube.com/embed/tNhzssozKuU?rel=0" frameborder="0" allowfullscreen></iframe>
                </div>
                <a href="#" class="cabinet__photo__item-selected"></a>
                <a href="#" class="cabinet__photo__item-view"></a>
                <a href="#" class="cabinet__photo__item-edit"></a>
                <a href="#" class="cabinet__photo__item-delete"></a>
              </figure>
              <figure class="cabinet__video__item">
                <div class="cabinet__video-link">
                  <iframe width="300" height="auto" src="//www.youtube.com/embed/wDlrRQ6Yzis?rel=0" frameborder="0" allowfullscreen></iframe>
                </div>
                <a href="#" class="cabinet__photo__item-selected"></a>
                <a href="#" class="cabinet__photo__item-view"></a>
                <a href="#" class="cabinet__photo__item-edit"></a>
                <a href="#" class="cabinet__photo__item-delete"></a>
              </figure>
              <figure class="cabinet__video__item">
                <div class="cabinet__video-link">
                  <iframe width="300" height="auto" src="//www.youtube.com/embed/Yc80wS2EU5A?rel=0" frameborder="0" allowfullscreen></iframe>
                </div>
                <a href="#" class="cabinet__photo__item-selected"></a>
                <a href="#" class="cabinet__photo__item-view"></a>
                <a href="#" class="cabinet__photo__item-edit"></a>
                <a href="#" class="cabinet__photo__item-delete"></a>
              </figure>
            </div-->
        </div>
        </main>
        
        <?php
        else:
            //$this->renderPartial('_add_album', array('model'=>new Portfolio));
            echo Yii::t('portfolio','Add genres'); 
        endif;
        ?>
       </div>
       
    </div>
  </div>
