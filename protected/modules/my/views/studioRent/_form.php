<?php
/* @var $this StudioRentController */
/* @var $model StudioRent */
/* @var $form CActiveForm */
?>

<div class="edit__equipment__item clfx">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'studio-rent-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php //echo $form->errorSummary($model); ?>

	<!--div class="col-12 add-action__form-container">
        <?php echo $form->labelEx($model,'title',array('class'=>'cabinet-pro__add-action__label')); ?>
    	<?php echo $form->textField($model,'title',array('class'=>'default__input','placeholder'=>'Заголовок')); ?>
    	<?php echo $form->error($model,'title'); ?>
    </div-->
    
    <div class="col-12 add-action__form-container">
		<?php echo $form->labelEx($model,'text',array('class'=>'cabinet-pro__add-action__label')); ?>
		<?php echo $form->textArea($model,'text',array('placeholder'=>'Данная информаця будет видна другим авторам и клиентам', 'class'=>'default__textarea')); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="col-12 text_right">
        <div class="btn__group clfx">
          <div class="col-179">
            <input type="reset" class="cabinet__profile__btn" value="ОТМЕНА" />
          </div>
          <div class="col-179">
            <?php echo CHtml::hiddenField('StudioRent[uid]',Yii::app()->user->id); ?>
		<?php echo CHtml::submitButton('СОХРАНИТЬ',array('class'=>'cabinet__profile__btn cabinet__profile__btn-submit')); ?>
          </div>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->