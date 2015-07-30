<?php
/* @var $this ProfileController */

$this->breadcrumbs=array(
	'Portfolios'=>array('index'),
    'Files'=>array('files'),
);
?>
  <div class="wrapper wrapper-cabinet">
    <div class="container clfx">
      <div class="cabinet-nav">
        <?php
        if(is_file('./users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo)) {
                echo '<a href="#" class="cabinet__user-img">';
                echo CHtml::image('/users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo,'My photo',array('width'=>60));
                echo '</a>';
        }
        ?>
        
        <nav class="cabinet__first-menu">
          <ul>
            <li><?=CHtml::link('Информация','/profile/');?></li>
            <?php if($user->member!=0):?>
            <li><?=CHtml::link('Портфолио','/portfolio/');?></li>
            <li><a href="#0">Услуги</a></li>
            <li><?=CHtml::link('Цены','/prices/');?></li>
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
              <?php //if(Yii::app()->user->member!=0): ?>
              <div class="accaunt__status"><?=Yii::app()->user->member_type;?></div>
              <span class="accaunt__role"><?=Occupation::getName($user->occupation_id);?></span>
              <? //endif; ?>
            </div>
            <div class="accaunt__right__header__rate pt25 col-4">
              <?=Users::getTimeAgo($user->date_registered);?>
            </div>
          </div>
          <nav class="cabinet__second-menu">
            <ul>
              <li class="active"><?=CHtml::link('Профиль','/profile/');?></li>
              <li><?=CHtml::link('Избранное','/my/favorites/');?></li>
              <li><?=CHtml::link('Мои тендеры','/tenders/');?></li>
              <li><?=CHtml::link('Сообщения','/messages/');?></li>
              <li><?=CHtml::link('Настройки','/profile/settings');?></li>
            </ul>
          </nav>
        </header>
        <?php 
        //$this->renderPartial('_albums', array('model'=>$model,'dataProvider'=>$dataProvider));
        $this->renderPartial('_files', array('model'=>$model)); 
        //$this->renderPartial('_add_file', array('model'=>$model,'file'=>Files::model())); 
        ?>
        
       </div>
       
    </div>
  </div>