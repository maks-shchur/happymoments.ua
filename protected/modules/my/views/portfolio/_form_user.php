<?php
/* @var $this FloController */
/* @var $model Flo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'flo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>
<?php echo $form->errorSummary($model); ?>
<div class="edit__equipment__item clfx">
            <figure class="edit__equipment__item__img">
              <div class="edit__equipment__item__img-cont">
                <?php
                if($model->picture!=''):
                ?>
                <img src="/users/<?=Yii::app()->user->id?>/<?=$model->picture?>" alt="" />
                <?php else: ?>
                <img src="/img/zaglushka.png" alt="" />
                <?php endif; ?>
              </div>
              <!--a href="#" class="cabinet__photo__item-refresh show__tooltip" data-toggle="tooltip" data-placement="bottom" data-title="заменить" data-original-title="" title=""></a-->
              <?php echo CHtml::label('','Flo[picture]',array('class'=>'cabinet__photo__item-refresh show__tooltip')); ?>
              <?php echo $form->fileField($model,'picture',
                            array(
                                'style'=>'opacity:0;width: 189px;height: 268px;margin-right: -189px;position: relative;right: 189px;cursor:pointer;',
                                'onchange'=>'$("#Flo_picture_text").html($("#Flo_picture").val());',
                            )
                        ); 
              ?>
		      <?php echo $form->error($model,'picture'); ?>
            </figure>
            <div id="Flo_picture_text" style="float: left; position: absolute; top: 275px;"></div>
            <div class="edit__equipment__item__form">
              <?php if(!$model->isNewRecord): ?>
              <div class="close__btn" onclick="window.location.href='/my/portfolio/delete/id/<?=$model->id?>'"></div>
              <?php endif; ?>
              <div class="col-12 add-action__form-container">
                <?php echo $form->labelEx($model,'title',array('class'=>'cabinet-pro__add-action__label')); ?>
        		<?php echo $form->textField($model,'title',array('class'=>'default__input','placeholder'=>'Свадебное фото')); ?>
        		<?php echo $form->error($model,'title'); ?>
              </div>
              <div class="col-12 add-action__form-container">
                <?php echo $form->labelEx($model,'price',array('class'=>'cabinet-pro__add-action__label')); ?>
        		<?php echo $form->textField($model,'price',array('class'=>'default__input','placeholder'=>'грн.')); ?>
        		<?php echo $form->error($model,'price'); ?>
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
                    <?php echo CHtml::hiddenField('Flo[uid]',Yii::app()->user->id); ?>
                    <?php echo CHtml::submitButton('СОХРАНИТЬ',array('class'=>'cabinet__profile__btn cabinet__profile__btn-submit')); ?>
                  </div>
                </div>
              </div>
            </div>
</div>
<?php $this->endWidget(); ?>