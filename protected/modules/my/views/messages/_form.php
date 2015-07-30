<?php
/* @var $this MessagesController */
/* @var $model Messages */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'messages-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'from_uid'); ?>
		<?php echo $form->textField($model,'from_uid'); ?>
		<?php echo $form->error($model,'from_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'to_uid'); ?>
		<?php echo $form->textField($model,'to_uid'); ?>
		<?php echo $form->error($model,'to_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'msg'); ?>
		<?php echo $form->textArea($model,'msg',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'msg'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_send'); ?>
		<?php echo $form->textField($model,'date_send'); ?>
		<?php echo $form->error($model,'date_send'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_read'); ?>
		<?php echo $form->textField($model,'is_read'); ?>
		<?php echo $form->error($model,'is_read'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->