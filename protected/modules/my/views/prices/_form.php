<?php
/* @var $this PricesController */
/* @var $model Prices */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'prices-form',
	'action'=>'/my/prices/update/id/'.$id,
    'enableAjaxValidation'=>true,
    'enableClientValidation' => true, 
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
    ),
)); ?>

<div class="tooltip_cost_title"><?=$title?></div>
<?php echo CHtml::label('Цена','albom__name',array('class'=>'tool_label','style'=>'margin-top: 25px;')); ?>
<?php echo $form->textField($model,'price',array('class'=>'default__input search__hidden__input--city','placeholder'=>'500 грн','maxlength'=>7)); ?>
<?php echo $form->error($model,'price'); ?>
                        
<?php echo CHtml::label('Описание','albom__name',array('class'=>'tool_label')); ?>
<?php echo $form->textArea($model,'about',array('class'=>'default__textarea','placeholder'=>'Описание услуги:')); ?>
<?php echo $form->error($model,'about'); ?>
                        
<div class="col-12 text_center" style="margin-top: 25px;">
    <div class="btn__group clfx">
        <div class="col-179">                  
            <button type="button" class="t-cls cabinet__profile__btn" id="close_tip" onclick="closeTip()">ОТМЕНА</button>                  
        </div>                  
        <div class="col-179">                    
            <?=CHtml::hiddenField('Prices[user_id]',Yii::app()->user->id);?>
            <?=CHtml::hiddenField('Prices[package]',$pack);?>
            <?=CHtml::hiddenField('Prices[genre_id]',$genre);?>
            <?=CHtml::submitButton('СОХРАНИТЬ',array('class'=>'t-cls cabinet__profile__btn cabinet__profile__btn-submit'));?>
        </div>                
    </div>            
</div>
<?php $this->endWidget(); ?>