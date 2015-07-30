<?php
/* @var $this NewsController */
/* @var $data News */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('intro_text')); ?>:</b>
	<?php echo CHtml::encode($data->intro_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('full_text')); ?>:</b>
	<?php echo CHtml::encode($data->full_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('foto_main')); ?>:</b>
	<?php echo CHtml::encode($data->foto_main); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('foto1')); ?>:</b>
	<?php echo CHtml::encode($data->foto1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('foto2')); ?>:</b>
	<?php echo CHtml::encode($data->foto2); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('foto3')); ?>:</b>
	<?php echo CHtml::encode($data->foto3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('foto4')); ?>:</b>
	<?php echo CHtml::encode($data->foto4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('foto5')); ?>:</b>
	<?php echo CHtml::encode($data->foto5); ?>
	<br />

	*/ ?>

</div>