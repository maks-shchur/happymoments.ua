<?php
/* @var $this AvtoController */
/* @var $model Avto */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'avto-form',
	'enableAjaxValidation'=>true,
    'enableClientValidation' => true, 
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
    ),
)); 
?>

            <div class="col-12 add-action__form-container">
              <?php echo $form->labelEx($model,'class',array('class'=>'cabinet-pro__add-action__label')); ?>
		      <?php echo $form->dropDownList($model,'class',array('econom'=>'эконом','premium'=>'премиум','bus'=>'автобусы'),array('empty'=>'','class'=>'default__input')); ?>
		      <?php echo $form->error($model,'class'); ?>
            </div>
            <div class="col-12 add-action__form-container">
              <?php echo $form->labelEx($model,'title',array('class'=>'cabinet-pro__add-action__label')); ?>
		      <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100,'class'=>'default__input','placeholder'=>'Skoda Fabia')); ?>
		      <?php echo $form->error($model,'title'); ?>
            </div>
            <div class="group__of__input clfx">
              <div class="col-4">
                <?php echo $form->labelEx($model,'year',array('class'=>'cabinet-pro__add-action__label')); ?>
                <?php //echo $form->textField($model,'year',array('size'=>4,'maxlength'=>4,'class'=>'default__input','placeholder'=>'2008')); ?>
                <?php
                for($i=date('Y');$i>=1930;$i--) {
                    $y_data[$i]=$i;
                }
                ?>
                <?php echo $form->dropDownList($model,'year',$y_data,array('class'=>'default__input','empty'=>'')); ?>
                <?php echo $form->error($model,'year'); ?>
              </div>
              <div class="col-4">
                <?php echo $form->labelEx($model,'doors',array('class'=>'cabinet-pro__add-action__label')); ?>
                <?php echo $form->textField($model,'doors',array('class'=>'default__input','placeholder'=>'5')); ?>
                <?php echo $form->error($model,'doors'); ?>
              </div>
            </div>
            
            <div class="group__of__input clfx">
              <div class="col-4">
                <?php echo $form->labelEx($model,'seats',array('class'=>'cabinet-pro__add-action__label')); ?>
                <?php echo $form->textField($model,'seats',array('class'=>'default__input','placeholder'=>'5')); ?>
                <?php echo $form->error($model,'seats'); ?>
              </div>
              <div class="col-4">
                <?php echo $form->labelEx($model,'color',array('class'=>'cabinet-pro__add-action__label')); ?>
                <?php echo $form->textField($model,'color',array('class'=>'default__input','placeholder'=>'Белый')); ?>
                <?php echo $form->error($model,'color'); ?>
              </div>
            </div>
            <div class="col-12 add-action__form-container">
              <?php echo $form->labelEx($model,'description',array('class'=>'cabinet-pro__add-action__label')); ?>
		      <?php echo $form->textArea($model,'description',array('maxlength'=>500,'class'=>'default__textarea','placeholder'=>'Данная информация видна всем потребителям и клиентам')); ?>
              <?php echo $form->error($model,'description'); ?>
            </div>
            <div class="col-12 add-action__form-container">
                <script>
                $(document).ready(function() {
                    $("#Avto_price").keydown(function (e) {
                        // Allow: backspace, delete, tab, escape, enter and .
                        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                             // Allow: Ctrl+A
                            (e.keyCode == 65 && e.ctrlKey === true) || 
                             // Allow: home, end, left, right, down, up
                            (e.keyCode >= 35 && e.keyCode <= 40)) {
                                 // let it happen, don't do anything
                                 return;
                        }
                        // Ensure that it is a number and stop the keypress
                        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                            e.preventDefault();
                        }
                    });
                });
                </script>  
              <?php echo $form->labelEx($model,'price',array('class'=>'cabinet-pro__add-action__label')); ?>
		      <?php echo $form->textField($model,'price',array('class'=>'default__input','placeholder'=>'.грн')); ?>
		      <?php echo $form->error($model,'price'); ?>
            </div>
            <div class="col-12 text_right">
              <div class="btn__group clfx">
                <div class="col-179">
                  <input type="reset" class="cabinet__profile__btn" value="ОТМЕНА" onclick="window.location.href='/my/avto'" />
                </div>
                <div class="col-179">
                  <?php echo CHtml::hiddenField('Avto[uid]',Yii::app()->user->id); ?>  
                  <?php echo CHtml::submitButton('СОХРАНИТЬ',array('class'=>'cabinet__profile__btn cabinet__profile__btn-submit')); ?>
                </div>
              </div>
            </div>

<?php $this->endWidget(); ?>
