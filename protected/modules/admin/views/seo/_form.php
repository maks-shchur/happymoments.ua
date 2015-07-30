<?php
/* @var $this SeoController */
/* @var $model Seo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
    		<?php echo $form->labelEx($model,'title'); ?>
    		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>500)); ?>
    		<?php echo $form->error($model,'title'); ?>
   	</div>


	<div class="row">
    		<?php echo $form->labelEx($model,'keywords'); ?>
    		<?php echo $form->textArea($model,'keywords',array('rows'=>6, 'cols'=>50)); ?>
    		<?php echo $form->error($model,'keywords'); ?>
	</div>

	<div class="row">
    		<?php echo $form->labelEx($model,'description'); ?>
    		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
    		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
    		<?php echo $form->labelEx($model,'top_text'); ?>
    		<?php echo $form->textArea($model,'top_text',array('rows'=>6, 'cols'=>50)); ?>
    		<?php echo $form->error($model,'top_text'); ?>
	</div>

	<div class="row">
    		<?php echo $form->labelEx($model,'bottom_text'); ?>
    		<?php echo $form->textArea($model,'bottom_text',array('rows'=>6, 'cols'=>50)); ?>
    		<?php echo $form->error($model,'bottom_text'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->