<?php
/* @var $this StudioEquipController */
/* @var $model StudioEquip */
/* @var $form CActiveForm */
?>
<div class="edit__equipment__item clfx">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'studio-equip-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
            <figure class="edit__equipment__item__img">
              <div class="edit__equipment__item__img-cont">
                <?php
                if($model->photo!=''):
                ?>
                <img src="/users/<?=Yii::app()->user->id?>/<?=$model->photo?>" alt="" />
                <?php else: ?>
                <img src="/img/zaglushka.png" alt="" />
                <?php endif; ?>
              </div>
              <?php echo CHtml::label('','StudioEquip[photo]',array('class'=>'cabinet__photo__item-refresh show__tooltip')); ?>
              <?php echo $form->fileField($model,'photo',
                            array(
                                'style'=>'opacity:0;width: 189px;height: 268px;margin-right: -189px;position: relative;right: 189px;cursor:pointer;',
                                'onchange'=>'(function(){
                                    if($("#StudioEquip_photo").val()!="") 
                                        $("#StudioEquip_photo_text").html("Фото загружено");
                                })()',
                            )
                        ); 
              ?>
		      <?php echo $form->error($model,'photo'); ?>
            </figure>
            <div id="StudioEquip_photo_text" style="float: left; position: absolute; top: 290px;"></div>
            <div class="edit__equipment__item__form">
              <div class="col-12 add-action__form-container">
                <?php echo $form->labelEx($model,'title',array('class'=>'cabinet-pro__add-action__label')); ?>
            	<?php echo $form->textField($model,'title',array('class'=>'default__input','placeholder'=>'Название')); ?>
            	<?php echo $form->error($model,'title'); ?>
              </div>
              <div class="col-12 add-action__form-container">
                <?php echo $form->labelEx($model,'description',array('class'=>'cabinet-pro__add-action__label')); ?>
        		<?php echo $form->textArea($model,'description',array('placeholder'=>'Данная информаця будет видна другим авторам и клиентам', 'class'=>'default__textarea')); ?>
        		<?php echo $form->error($model,'description'); ?>
              </div>
              <div class="col-12 text_right">
                <div class="btn__group clfx">
                  <div class="col-179">
                    <input type="reset" class="cabinet__profile__btn" value="ОТМЕНА" />
                  </div>
                  <div class="col-179">
                    <?php echo CHtml::hiddenField('StudioEquip[uid]',Yii::app()->user->id); ?>
        		<?php echo CHtml::submitButton('СОХРАНИТЬ',array('class'=>'cabinet__profile__btn cabinet__profile__btn-submit')); ?>
                  </div>
                </div>
            </div>
            </div>
<?php $this->endWidget(); ?>
</div>
