<?php
$aid=Yii::app()->getRequest()->getParam('id','-1');
?>

<main class="cabinet__portfolio">
          <header class="cabinet__portfolio__title clfx">
            <div class="col-12"><h3>Добавить файл</h3></div>
          </header>
          
          <?php $form=$this->beginWidget('CActiveForm', array(
            	'id'=>'files-form',
                'action'=>'/files/create',
            	'enableAjaxValidation'=>true,
                'enableClientValidation'=>true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => true,
                ),
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
            )); ?>
          <?php //echo $form->errorSummary($file); ?>
          <div class="cabinet__edit-albom">
            <figure class="edit-albom__img">
              <?php
              if(is_file('./users/'.Yii::app()->user->id.'/'.$file->file)) {
              ?>  
              <img src="/users/<?=Yii::app()->user->id?>/<?=$file->file?>" alt="<?=$file->description?>" />
              <?php 
                } else {
              ?>      
              <img src="" alt="" />      
              <?php  
                }
              ?>
              <?php echo $form->fileField($file,'file'); ?>
              <?php echo $form->error($file,'file'); ?>
            </figure>
            <div class="edit-photo__description-container">
              <div class="col-6 edit-photo__title"><label for="text1">Название</label></div>
              <div class="col-12 edit-photo__description">
                <?php echo $form->textField($file,'title',array('class'=>'default__input search__hidden__input--city','placeholder'=>'Панорамная фотосьемка')); ?>
                <?php echo $form->error($file,'title'); ?>
              </div>
              <div class="col-6 edit-photo__title"><label for="text1">Описание</label></div>
              <div class="col-12 edit-photo__description">
                <?php echo $form->textArea($file,'description',array('cols'=>30,'rows'=>3,'placeholder'=>'Данная информаця будет видна другим авторам и потенциальным клиентам')); ?>
                <?php echo $form->error($file,'description'); ?>
              </div>
              <?php
              if($aid=='-1') { ?>
              <div class="col-6 edit-photo__title"><label for="text1">Альбом</label></div>
              <div class="col-12 edit-photo__description">
                <?php echo $form->dropDownList($file,'portfolio_id',CHtml::listData(Portfolio::model()->findAllByAttributes(array('uid'=>Yii::app()->user->id)),'id','title'),array('class'=>'default__input','empty'=>'')); ?>
                <?php echo $form->error($file,'portfolio_id'); ?>
              </div>
              <?php } ?>
              <div class="col-179">
                <?=CHtml::hiddenField('Files[type]','photo');?>
                <?=$aid!='-1'?CHtml::hiddenField('Files[portfolio_id]',Yii::app()->getRequest()->getParam('id')):'';?>
                <?=CHtml::hiddenField('Files[uid]',Yii::app()->user->id);?>
                <?=CHtml::submitButton('СОХРАНИТЬ',array('class'=>'cabinet__profile__btn cabinet__profile__btn-submit'));?>
              </div>
              <div class="col-179">
                <?=CHtml::button('ОТМЕНА', array('onclick'=>'$("#mydialog").dialog("close"); return false;','class'=>'cabinet__profile__btn'));?>
              </div>
            </div>
          </div>
          
          <?php $this->endWidget(); ?>
</main>