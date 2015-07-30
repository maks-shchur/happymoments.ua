<?php
/* @var $this ProfileController */

$this->breadcrumbs=array(
	'Portfolios'=>array('index'),
    'Files'=>array('files'),
    'Edit'
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
              <li><a href="#0">Избранное</a></li>
              <li><a href="#0">Мои тендеры</a></li>
              <li><?=CHtml::link('Сообщения','/messages/');?></li>
              <li><?=CHtml::link('Настройки','/profile/settings');?></li>
            </ul>
          </nav>
        </header>
        <?php 
        //$this->renderPartial('_albums', array('model'=>$model,'dataProvider'=>$dataProvider));
        //$this->renderPartial('_files', array('model'=>$model)); 
        //$this->renderPartial('_add_file', array('file'=>$model)); 
        ?>
        <main class="cabinet__portfolio">
                  <header class="cabinet__portfolio__title clfx">
                    <div class="col-12"><h3>Редактировать файл</h3></div>
                  </header>
                  
                  <?php $form=$this->beginWidget('CActiveForm', array(
                    	'id'=>'files-form',
                        'action'=>'/portfolio/updatefile/'.$model->id,
                    	'enableAjaxValidation'=>true,
                        'htmlOptions' => array('enctype' => 'multipart/form-data'),
                    )); ?>
                  
                  <div class="cabinet__edit-albom">
                    <figure class="edit-albom__img">
                      <?php
                      if(is_file('./users/'.Yii::app()->user->id.'/'.$model->file)) {
                      ?>  
                      <img src="/users/<?=Yii::app()->user->id?>/<?=$model->file?>" alt="<?=$model->description?>" />
                      <?php 
                        } else {
                      ?>      
                      <img src="" alt="" />      
                      <?php  
                        }
                      ?>
                      <?php echo $form->fileField($model,'file'); ?>
                      <?php echo $form->error($model,'file'); ?>
                    </figure>
                    <div class="edit-photo__description-container">
                      <div class="col-6 edit-photo__title"><label for="text1">Название</label></div>
                      <div class="col-12 edit-photo__description">
                        <?php echo $form->textField($model,'title',array('class'=>'default__input search__hidden__input--city','placeholder'=>'Панорамная фотосьемка')); ?>
                        <?php echo $form->error($model,'title'); ?>
                      </div>
                      <div class="col-6 edit-photo__title"><label for="text1">Описание</label></div>
                      <div class="col-12 edit-photo__description">
                        <?php echo $form->textArea($model,'description',array('cols'=>30,'rows'=>3,'placeholder'=>'Данная информаця будет видна другим авторам и потенциальным клиентам')); ?>
                        <?php echo $form->error($model,'description'); ?>
                      </div>
                      <div class="col-6 edit-photo__title"><label for="text1">Альбом</label></div>
                      <div class="col-12 edit-photo__description">
                        <?php echo $form->dropDownList($model,'portfolio_id',CHtml::listData(Portfolio::model()->findAllByAttributes(array('uid'=>Yii::app()->user->id)),'id','title'),array('class'=>'default__input','empty'=>'')); ?>
                        <?php echo $form->error($model,'portfolio_id'); ?>
                      </div>
                      <div class="col-179">
                        <?=CHtml::hiddenField('Files[type]','photo');?>
                        <?=CHtml::hiddenField('Files[uid]',Yii::app()->user->id);?>
                        <?=CHtml::submitButton('СОХРАНИТЬ',array('class'=>'cabinet__profile__btn cabinet__profile__btn-submit'));?>
                      </div>
                      <div class="col-179"><button type="reset" class="cabinet__profile__btn">ОТМЕНА</button></div>
                      <?php echo $form->errorSummary($model); ?>
                    </div>
                  </div>
                  
                  <?php $this->endWidget(); ?>
        </main>
       </div>
       
    </div>
  </div>