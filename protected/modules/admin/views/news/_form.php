<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'intro_text'); ?>
        <?php
        $this->widget('ext.Editor.widgets.ExtEditMe', array(
            'name'=>'News[intro_text]',
            'value'=>$model->intro_text,
        ));
        ?>
		<?php //echo $form->textArea($model,'intro_text',array('cols'=>50,'rows'=>6)); ?>
		<?php echo $form->error($model,'intro_text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'full_text'); ?>
        <?php
        $this->widget('ext.Editor.widgets.ExtEditMe', array(
            'name'=>'News[full_text]',
            'value'=>$model->full_text,
        ));
        ?>
		<?php //echo $form->textArea($model,'full_text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'full_text'); ?>
	</div>

	<div class="row">
        <?php
        if($model->foto_main!='')
            echo '<img src="/upload/'.$model->foto_main.'" /><br />';
        ?>
		<?php echo $form->labelEx($model,'foto_main'); ?>
		<?php echo $form->fileField($model,'foto_main'); ?>
		<?php echo $form->error($model,'foto_main'); ?>
	</div>

	<div class="row">
        <?php
        if($model->foto1!='')
            echo '<img src="/upload/'.$model->foto1.'" /><br />';
        ?>
		<?php echo $form->labelEx($model,'foto1'); ?>
		<?php echo $form->fileField($model,'foto1'); ?>
		<?php echo $form->error($model,'foto1'); ?>
	</div>

	<div class="row">
        <?php
        if($model->foto2!='')
            echo '<img src="/upload/'.$model->foto2.'" /><br />';
        ?>
		<?php echo $form->labelEx($model,'foto2'); ?>
		<?php echo $form->fileField($model,'foto2'); ?>
		<?php echo $form->error($model,'foto2'); ?>
	</div>

	<div class="row">
        <?php
        if($model->foto3!='')
            echo '<img src="/upload/'.$model->foto3.'" /><br />';
        ?>
		<?php echo $form->labelEx($model,'foto3'); ?>
		<?php echo $form->fileField($model,'foto3'); ?>
		<?php echo $form->error($model,'foto3'); ?>
	</div>

	<div class="row">
        <?php
        if($model->foto4!='')
            echo '<img src="/upload/'.$model->foto4.'" /><br />';
        ?>
		<?php echo $form->labelEx($model,'foto4'); ?>
		<?php echo $form->fileField($model,'foto4'); ?>
		<?php echo $form->error($model,'foto4'); ?>
	</div>

	<div class="row">
        <?php
        if($model->foto5!='')
            echo '<img src="/upload/'.$model->foto5.'" /><br />';
        ?>
		<?php echo $form->labelEx($model,'foto5'); ?>
		<?php echo $form->fileField($model,'foto5'); ?>
		<?php echo $form->error($model,'foto5'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->