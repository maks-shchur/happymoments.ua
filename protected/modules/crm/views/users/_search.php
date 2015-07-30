<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo'); ?>
		<?php echo $form->textField($model,'photo',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textArea($model,'phone',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gender'); ?>
		<?php echo $form->textField($model,'gender',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_birth'); ?>
		<?php echo $form->textField($model,'date_birth'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'birth_public'); ?>
		<?php echo $form->textField($model,'birth_public'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_registered'); ?>
		<?php echo $form->textField($model,'date_registered'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_lastvisit'); ?>
		<?php echo $form->textField($model,'date_lastvisit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'about'); ?>
		<?php echo $form->textArea($model,'about',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'url'); ?>
		<?php echo $form->textArea($model,'url',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'member'); ?>
		<?php echo $form->textField($model,'member'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'city_id'); ?>
		<?php echo $form->textField($model,'city_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'member_type'); ?>
		<?php echo $form->textField($model,'member_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'occupation_id'); ?>
		<?php echo $form->textField($model,'occupation_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'genre_id'); ?>
		<?php echo $form->textArea($model,'genre_id',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'district'); ?>
		<?php echo $form->textField($model,'district',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'skype'); ?>
		<?php echo $form->textField($model,'skype',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'work_from'); ?>
		<?php echo $form->textField($model,'work_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'work_to'); ?>
		<?php echo $form->textField($model,'work_to'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->