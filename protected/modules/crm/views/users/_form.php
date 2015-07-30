<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'login'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'photo'); ?>
		<?php echo $form->textField($model,'photo',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'photo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php
        $this->widget('CMaskedTextField', array(
            'model' => $model,
            'attribute' => 'phone',
            'mask' => '+38(999)-999-99-99',
            'placeholder' => '*',
            'completed' => 'function(){console.log("ok");}',
        ));
        ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->dropDownList($model,'gender',array('m'=>'man','w'=>'woman','c'=>'company')); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_birth'); ?>
		<?php echo $form->dateField($model,'date_birth'); ?>
		<?php echo $form->error($model,'date_birth'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birth_public'); ?>
		<?php echo $form->dropDownList($model,'birth_public',array('0'=>'no','1'=>'yes')); ?>
		<?php echo $form->error($model,'birth_public'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_registered'); ?>
		<?php echo $form->textField($model,'date_registered'); ?>
		<?php echo $form->error($model,'date_registered'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_lastvisit'); ?>
		<?php echo $form->textField($model,'date_lastvisit'); ?>
		<?php echo $form->error($model,'date_lastvisit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'about'); ?>
		<?php echo $form->textArea($model,'about',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'about'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->urlField($model,'url',array('placeholder'=>'http://site.com')); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'member'); ?>
		<?php echo $form->textField($model,'member'); ?>
		<?php echo $form->error($model,'member'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city_id'); ?>
		<?php echo $form->dropDownList($model,'city_id',CHtml::listData(City::model()->findAll(),'id','name')); ?>
		<?php echo $form->error($model,'city_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'member_type'); ?>
		<?php echo $form->textField($model,'member_type'); ?>
		<?php echo $form->error($model,'member_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'occupation_id'); ?>
		<?php echo $form->dropDownList($model,'occupation_id',CHtml::listData(Occupation::model()->findAll(),'id','name')
                                        ,
                                        array(
                                            'empty'=>'- select -',
                                            'ajax' => array(
                                                'type'=>'POST', //request type
                                                'url'=>CController::createUrl('users/genresublist'), //url to call.
                                                //Style: CController::createUrl('currentController/methodToCall')
                                                'update'=>'#Users_genre_id', //selector to update
                                                //'data'=>'js:javascript statement' 
                                                //leave out the data key to pass all form values through
                                           )
                                        )
                                        ); 
        ?>
		<?php echo $form->error($model,'occupation_id'); ?>
	</div>

	<div class="row">
        
        <?
            //print_r($model->genre_id);
            $model->genre_id=unserialize($model->genre_id);
        ?>
		<?php echo $form->labelEx($model,'genre_id'); ?>
		<?php //echo CHtml::dropDownList('genre_id','', array(), array('empty'=>'- select -',)); ?>
        <?php echo $form->checkBoxList($model, 'genre_id', CHtml::listData(Genre::model()->findAll('occ_id=:occ_id', array(':occ_id'=>(int) $model->occupation_id)), 'id', 'name')); ?>
		<?php echo $form->error($model,'genre_id'); ?>
        
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'district'); ?>
		<?php echo $form->textField($model,'district',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'district'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'skype'); ?>
		<?php echo $form->textField($model,'skype',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'skype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'work_from'); ?>
		<?php //echo $form->textField($model,'work_from'); ?>
        <label for="amt">Volume:</label>
        <input type="text" id="amount-range" style="border:0; color:#f6931f; font-weight:bold;" value="11-22" />
        <?php
        $this->widget('zii.widgets.jui.CJuiSliderInput',array(
            'model'=>$model,
            'event'=>'change',
            'attribute'=>'work_from',
            'maxAttribute'=>'work_to',
            // additional javascript options for the slider plugin
            'options'=>array(
                'range'=>true,
                'min'=>0,
                'max'=>24,
                'slide'=>'js:function(event,ui){$("#amount-range").val(ui.values[0]+\'-\'+ui.values[1]);}',
            ),
        ));
        ?>
        <?php echo $form->textField($model,'work_from'); ?>
        <?php echo $form->error($model,'work_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'work_to'); ?>
		<?php echo $form->textField($model,'work_to'); ?>
		<?php echo $form->error($model,'work_to'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->