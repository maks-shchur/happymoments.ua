<?php
/* @var $this ProfileController */

$this->breadcrumbs=array(
	'Profile',
);
?>
  <div class="wrapper wrapper-cabinet">
    <div class="container clfx">
      <div class="cabinet-nav">  
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
                                   'sizeLimit'=>1*1024*1024,// maximum file size in bytes
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
        <nav class="cabinet__first-menu">
          <ul>
            <li><?=CHtml::link('Информация','/my/profile/');?></li>
            <?php if($model->member!=0):?>
            <li><?=CHtml::link('Портфолио','/my/portfolio/');?></li>
            <li><a href="#0">Услуги</a></li>
            <li><?=CHtml::link('Цены','/my/prices/');?></li>
            <li><a href="#0">Календарь занятости</a></li>
            <?php endif; ?>
          </ul>
        </nav>
        <div class="cabinet__text-about"></div>
        <div class="cabiner__abount-accaunts">
          <div class="cabiner__abount-accaunts-plus">plus</div>
          <div class="cabiner__abount-accaunts-pro">pro</div>
          <a href="#0" class="cabiner__abount-accaunts-readmore">подробнее</a>
        </div>
      </div>
      
      <div class="cabinet-main">
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
              <li class="active"><?=CHtml::link('Профиль','/my/profile/');?></li>
              <li><a href="#0">Избранное</a></li>
              <li><?=CHtml::link('Мои тендеры','/my/tenders/');?></li>
              <li><?=CHtml::link('Сообщения','/my/messages/');?></li>
              <li><?=CHtml::link('Настройки','/my/profile/settings');?></li>
            </ul>
          </nav>
        </header>
        <?php 
        if($model->member==0)
            $this->renderPartial('_form_visiter', array('model'=>$model)); 
        else {
            $this->renderPartial('_form_'.$model->occupation->templ, array('model'=>$model));    
        }
        ?>
       </div>
       
    </div>
  </div>
