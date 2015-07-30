<?php
/* @var $this OccupationController */
/* @var $model Occupation */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'occupation-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cat_id'); ?>
		<?php echo $form->dropDownList($model,'cat_id',CHtml::listData(Category::model()->findAll(),'id','name'),array('empty'=>'')); ?>
		<?php echo $form->error($model,'cat_id'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'templ'); ?>
		<?php echo $form->dropDownList($model,'templ',
                                            array(
                                                'members'=>'участники', //фото, видеоопер, музыканты, визаж, парикмахер, тамада
                                                'avto'=>'аренда авто',
                                                'rent_eqip'=>'аренда аппаратуры',
                                                'rent_photo'=>'аренда фотостудии',
                                                'scene'=>'мобильная сцена',
                                                'ceremony'=>'выездная церемония',
                                                'relax'=>'развлечения',
                                                'show'=>'шоу программы',
                                                'animation'=>'аниматоры, обучение',
                                                'other'=>'разное',                                             
                                            ),
                                            array('empty'=>'')); ?>
		<?php echo $form->error($model,'templ'); ?>
	</div>
    
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