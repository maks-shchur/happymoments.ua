<?php
/* @var $this PagesController */
/* @var $model Pages */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pages-form',
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
    		<?php echo $form->labelEx($model,'text'); ?>
            <?php
            $cur_lang='text'.$suffix;
            $this->widget('ext.Editor.widgets.ExtEditMe', array(
                'name'=>'Pages[text'.$suffix.']',
                'value'=>$model->$cur_lang,
            ));
            ?>
    		<?php //echo $form->textField($model,'text'.$suffix,array('size'=>60,'maxlength'=>250)); ?>
    		<?php echo $form->error($model,'text'.$suffix); ?>
    	</div>
    </fieldset>
    <?php endforeach; ?>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',array(
            'politic'=>'Политика конфиденциальности',
            'user_agriment'=>'Пользовательское соглашение',
            'author'=>'Авторское право',
        ),array('empty'=>'')
        ); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->