<?php
/* @var $this ProfileController */

$this->breadcrumbs=array(
	'Интерьер',
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
      if($model->top_banner!=''):
      ?> 
      <a href="/my/profile/delbanner"><div class="cabinet-pro-banner__del"></div></a>
      <style>
      #top_banner {
        background: url('/users/<?=$user->id?>/<?=$model->top_banner?>') no-repeat !important;  
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
            <?php if($model->member!=0):?>
                <?php if($model->occupation->templ=='members'):?>
                    <li><?=CHtml::link('Портфолио','/my/portfolio/');?></li>
                    <li><?=CHtml::link('Календарь занятости','/my/calendar/');?></li>
                    <?php if($model->genre_id!=''): ?>
                    <li><?=CHtml::link('Цены','/my/prices/');?></li>
                    <?php endif; ?>
                <?php elseif($model->occupation->templ=='avto'):?>
                    <li><?=CHtml::link('Авто парк','/my/avto/');?></li>
                <?php elseif($model->occupation->templ=='flo'):?>
                    <li><?=CHtml::link('Продукция','/my/flo/');?></li>
                <?php elseif($model->occupation->templ=='rent_photo'):?>
                    <li><?=CHtml::link('Интерьеры','/my/studio/interior');?></li>
                    <li><?=CHtml::link('Аренда','/my/studio/rent');?></li>
                    <li><?=CHtml::link('Оборудование','/my/studio/equip');?></li>
                    <!--li><?=CHtml::link('Услуги','/my/studio/services');?></li>
                    <li><?=CHtml::link('3D  туры','/my/studio/tours');?></li-->
                    <li><?=CHtml::link('Цены','/my/studio/prices',array('class'=>'active'));?></li>
                    <!--li><?=CHtml::link('Календарь занятости','/my/calendar/');?></li-->
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
              <?php if(Yii::app()->user->member!=0): ?>
              <div class="accaunt__status <?=Yii::app()->user->member_type;?>"><?=Yii::app()->user->member_type;?></div>
              <span class="accaunt__role"><?=Occupation::getName($model->occupation_id);?></span>
              <?php endif; ?>
            </div>
            <div class="accaunt__right__header__rate pt25 col-4">
              <?=Users::getTimeAgo($model->date_registered);?>
            </div>
          </div>
          <nav class="cabinet__second-menu">
            <ul>
              <li><?=CHtml::link('Профиль','/my/profile/');?></li>
              <li><?=CHtml::link('Избранное','/my/favorites/');?></li>
              <?php if($model->member_type!='basic'):?>
                  <li><?=CHtml::link('Мои акции','/my/actions/');?></li>
              <?php endif;?>
              <li><?=CHtml::link('Мои тендеры','/my/tenders/');?></li>
              <li><?=CHtml::link('Сообщения','/my/messages/');?></li>
              <li><?=CHtml::link('Настройки','/my/profile/settings');?></li>
            </ul>
          </nav>
        </header>
        
        <div class="cabinet-pro__cost-container">
          <div class="tender-title">ЦЕНЫ</div>
          <table class="cabinet-pro__cost__table">
          <?php
          //$i=0;
          $cnt=ceil(count($halls)/3);
  
          if($cnt>1) {
            for($j=1;$j<=$cnt;$j++) {
          ?>
                    <tr>
          <?php  
              for($i=($j-1)*3;$i<=($j-1)*3+2;$i++) {
                        if(isset($halls[$i])) {
          ?>
                        <th><?=$halls[$i]->title?><span>цена за час</span></th>
          <?php
                        }
                        else {
         ?>
                        <th></th>
         <?php                               
                        }
              }
          ?>        
                    </tr>
                    <tr>
          <?php  
              for($i=($j-1)*3;$i<=($j-1)*3+2;$i++) {
                        if(isset($halls[$i])) {
          ?>
                        <td><?=$halls[$i]->price1?> грн<span>праздники, сб, вс - <?=$halls[$i]->price2?> грн<a href="/my/studio/priceedit/id/<?=$halls[$i]->id?>" class="cabinet__photo__item-edit"></a></td>
          <?php
                        }
                        else {
         ?>
                        <td></td>
         <?php                               
                        }
              }
          ?>  
                        
                    </tr>
          <?php 
            }                   
          }
          else {
          ?>
                <tr>
          <?php
              foreach($halls as $item) {
              ?>
                    <th><?=$item->title?><span>цена за час</span></th>
              <?php  
              }
              ?>
                </tr>
                <tr>
              <?php
              foreach($halls as $item) {
              ?>
                    <td><?=$item->price1?> грн<span>праздники, сб, вс - <?=$item->price2?> грн<a href="/my/studio/priceedit/id/<?=$item->id?>" class="cabinet__photo__item-edit"></a></td>
              <?php  
              }
              ?>
                </tr> 
          <?php
          }
          ?> 
          </table>
        </div>                
        
       </div>
       
    </div>
  </div>
