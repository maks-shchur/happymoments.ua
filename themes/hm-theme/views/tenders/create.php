<?php
/* @var $this TendersController */
/* @var $model Tenders */

$this->breadcrumbs=array(
	'Tenders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tenders', 'url'=>array('index')),
	array('label'=>'Manage Tenders', 'url'=>array('admin')),
);
?>
<?php
/* @var $this ProfileController */

$this->breadcrumbs=array(
	'Tenders',
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
            <li><?=CHtml::link('Мои тендеры','/my/tenders/');?></li>
            <li><?=CHtml::link('Мои заявки','/my/tenders/myorders');?></li>
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
              <span class="accaunt__role"><?=Occupation::getName($model->occupation_id);?></span>
              <? //endif; ?>
            </div>
            <div class="accaunt__right__header__rate pt25 col-4">
              <?=Users::getTimeAgo($model->date_registered);?>
            </div>
          </div>
          <nav class="cabinet__second-menu">
            <ul>
              <li><?=CHtml::link('Профиль','/my/profile/');?></li>
              <li><a href="#0">Избранное</a></li>
              <li class="active"><?=CHtml::link('Мои тендеры','/my/tenders/');?></li>
              <li><?=CHtml::link('Сообщения','/my/messages/');?></li>
              <li><?=CHtml::link('Настройки','/my/profile/settings');?></li>
            </ul>
          </nav>
        </header>
        
        
        <?php $this->renderPartial('_form', array('model_t'=>$model_t,'model'=>$model)); ?>
        
        
        
       </div>
       
    </div>
  </div>