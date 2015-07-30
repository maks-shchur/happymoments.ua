<?php
/* @var $this StudioHalsController */
/* @var $model StudioHals */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'studio-hals-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<div class="col-8 edit__cost__title"><?=$model->title?></div>
        <div class="default-input__container">
          <div class="col-4 text_right">
            <?php echo $form->labelEx($model,'price1',array('class'=>'default-input__label pr22')); ?>
          </div>
          <div class="col-8">
            <?php if($model->price1==0) $model->price1=''; ?>
            <?php echo $form->textField($model,'price1',array('class'=>'default__input','placeholder'=>'.грн')); ?>
            <?php echo $form->error($model,'price1'); ?>
          </div>
        </div>
        <div class="default-input__container">
          <div class="col-4 text_right">
            <?php echo $form->labelEx($model,'price2',array('class'=>'default-input__label pt4 pr22')); ?>
          </div>
          <div class="col-8">
            <?php if($model->price2==0) $model->price2=''; ?>
            <?php echo $form->textField($model,'price2',array('class'=>'default__input','placeholder'=>'.грн')); ?>
            <?php echo $form->error($model,'price2'); ?>
          </div>
        </div>
        <div class="col-12 text_center pt76">
            <div class="btn__group clfx">
              <div class="col-179">
                <input type="reset" class="cabinet__profile__btn" value="ОТМЕНА" />
              </div>
              <div class="col-179">
                <?php echo CHtml::hiddenField('StudioHals[uid]',Yii::app()->user->id); ?>
                <?php echo CHtml::submitButton('СОХРАНИТЬ',array('class'=>'cabinet__profile__btn cabinet__profile__btn-submit')); ?>
              </div>
            </div>
        </div>
<?php $this->endWidget(); ?>
