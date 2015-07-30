<?php
/* @var $this CityController */
/* @var $model City */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'city-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    
    
    <?php foreach (Yii::app()->params['translatedLanguages'] as $l => $lang) :
    if($l === Yii::app()->params['defaultLanguage']) $suffix = '';
    else $suffix = '_'.$l;
    ?>
    <fieldset>
        <legend><?php echo $lang; ?></legend>
        
    	<div class="row">
    		<?php echo $form->labelEx($model,'name'); ?>
    		<?php echo $form->textField($model,'name'.$suffix,array('size'=>60,'maxlength'=>250)); ?>
    		<?php echo $form->error($model,'name'.$suffix); ?>
    	</div>
    </fieldset>
    <?php endforeach; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->