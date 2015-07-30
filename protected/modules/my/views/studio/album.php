<?php
/* @var $this StudioController */

$this->breadcrumbs=array(
	'Портфолио'=>array('index'),
    'Альбом'=>array('index'),
	$model->title=>array('album','id'=>$model->id),
);
?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/min/jquery.fancybox.pack.js'); ?>
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
                    <li><?=CHtml::link('Интерьеры','/my/studio/interior',array('class'=>'active'));?></li>
                    <li><?=CHtml::link('Аренда','/my/studio/rent');?></li>
                    <li><?=CHtml::link('Оборудование','/my/studio/equip');?></li>
                    <!--li><?=CHtml::link('Услуги','/my/studio/services');?></li>
                    <li><?=CHtml::link('3D  туры','/my/studio/tours');?></li-->
                    <li><?=CHtml::link('Цены','/my/studio/prices');?></li>
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
              <span class="accaunt__role"><?=Occupation::getName($user->occupation_id);?></span>
              <?php endif; ?>
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
        
        <main class="cabinet__portfolio">
          <header class="cabinet__portfolio__title clfx">
            <div class="col-4 albom-name"><a href="/my/studio/interior">все залы</a></div>
            <div class="col-4"><h3><?=$model->title;?></h3></div>
            <div class="col-4 albom-edit"><!--i></i><a href="/my/portfolio/update/id/<?=$model->id;?>">Редактировать альбом</a--></div>
          </header>
          <div class="col-9 cabinet__portfolio__select4-photo">
          <?php
            $form=$this->beginWidget('CActiveForm', array(
            	'id'=>'studio-hals',
                'action'=>'/my/studio/updatealbum/id/'.$model->id,
            	'enableAjaxValidation'=>true,
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
          ?>  
                <?=$form->textField($model,'title',array('class'=>'default__input'));?>
                <div style="display: block; float:  right;">
                    <div class="emtpy-575"></div>
                    <div class="col-179">
                        <button type="button" class="cabinet__profile__btn">ОТМЕНА</button>
                    </div>
                    <div class="col-179">
                        <?=CHtml::submitButton('СОХРАНИТЬ',array('class'=>'cabinet__profile__btn cabinet__profile__btn-submit'));?>
                    </div>
                </div>
          <?php $this->endWidget(); ?>
          </div>
          <div class="col-3 cabinet__portfolio__add-photo">      
            <div class="col-12 global__plus__btn-container">
                <?php
                 $this->widget('ext.Upload.Upload',
                array(
                        'id'=>'uploadFiles',
                        'config'=>array(
                               'action'=>Yii::app()->createUrl('/my/studio/upload/id/'.$_GET['id']),
                               'allowedExtensions'=>array("jpg","jpeg","gif","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                               'sizeLimit'=>8*1024*1024,// maximum file size in bytes
                               'minSizeLimit'=>1*1024,
                               'auto'=>true,
                               'multiple' => true,
                               'onSubmit'=>'js:function(file, extension) { 
                                    $(".loader").css("display","block");
                               }',
                               'onComplete'=>'js:function(id, fileName, responseJSON){
                                    if (responseJSON.success)
                                    {    
                                        $.ajax({
                                            url: "/my/studio/render",
                                            cache: false,
                                            type: "POST",
                                            data: {id: responseJSON.res, url: "'.Yii::app()->request->requestUri.'"},
                                            success: function(data)
                                            {
                                                $(data).prependTo("#photos");
                                                $(".loader").css("display","none");
                                                window.location.reload();
                                            }
                                        });
                                    }
                                }',
                               )
                 
                 ));
                ?>
            </div>
          </div>
          <div class="clfx"></div>
                <?php $form=$this->beginWidget('CActiveForm', array(
                    	'id'=>'files-form',
                        'action'=>'/my/studio/updatefiles/',
                    	'enableAjaxValidation'=>true,
                        'htmlOptions' => array('enctype' => 'multipart/form-data'),
                    )); ?>
                <div class="cabinet__photo__list">    
                <div id="photos"></div>
          
          
                <?php 
                if(count($files)<=0) echo '<div class="no-results"><h4>Не загружено ни одной фотографии.</h4></div>';
                
                $this->renderPartial('_files', array('model'=>$files)); 
                //$this->renderPartial('_add_file', array('model'=>$model,'file'=>Files::model())); 
                
                echo CHtml::hiddenField('back',Yii::app()->request->requestUri);
                ?>                
                </div>
                <?php $this->endWidget(); ?>
        </main>
        
        
       </div>
       
    </div>
  </div>