<?php
/* @var $this ActionsController */
/* @var $model Actions */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'actions-form',
	'enableAjaxValidation'=>true,
    'enableClientValidation' => true, 
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
    ),
    'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

    <div class="col-4">
            <figure class="cabinet-pro__banner">
                <?php
                if($model->picture!=''):
                ?>
                    <img src="/users/<?=Yii::app()->user->id?>/<?=$model->picture?>" alt="" />
                <?php else: ?>
                    <img src="/img/zaglushka.png" alt="" />
                <?php endif; ?>
                
                <?php echo CHtml::label('','Actions[picture]',array('class'=>'cabinet__photo__item-refresh show__tooltip')); ?>
                <?php echo $form->fileField($model,'picture',
                            array(
                                'style'=>'opacity:0;width: 303px;height: 218px;margin-right: -189px;position: absolute;right: 189px;top: 0px;cursor:pointer;',
                                'onchange'=>'$("#Actions_picture2").val($("#Actions_picture").val());',
                            )
                        ); 
                ?>
                <?php echo CHtml::textField('Actions[picture2]','not'); ?>            
                <?php echo CHtml::hiddenField('old_picture',$model->picture); ?>
            </figure>
            <?php echo $form->error($model,'picture2'); ?>
            <div id="Actions_picture_text" style="float: left; position: absolute; top: 230px;"></div>
          </div>
          <div class="col-8 cabinet-pro__add-action__form">
              <div class="col-12 add-action__form-container">
                <?php echo $form->labelEx($model,'title',array('class'=>'cabinet-pro__add-action__label')); ?>
        		<?php echo $form->textField($model,'title',array('class'=>'default__input','placeholder'=>'Семейная сьемка')); ?>
        		<?php echo $form->error($model,'title'); ?>
              </div>
              <div class="col-6 add-action__form-container" style="padding-right: 5px;">
                <?php echo $form->labelEx($model,'date_start',array('class'=>'cabinet-pro__add-action__label')); ?>
        		<?php echo $form->textField($model,'date_start',array('class'=>'default__input','placeholder'=>'Выберите дату')); ?>
        		<?php echo $form->error($model,'date_start'); ?>
              </div>
              <div class="col-6 add-action__form-container" style="padding-left: 5px;">
                <?php echo $form->labelEx($model,'date_end',array('class'=>'cabinet-pro__add-action__label')); ?>
        		<?php echo $form->textField($model,'date_end',array('class'=>'default__input','placeholder'=>'Выберите дату')); ?>
        		<?php echo $form->error($model,'date_end'); ?>
              </div>
              <div class="col-5 add-action__form-container price__before__discount">
                <script>
                $(document).ready(function() {
                    $("#Actions_price").keydown(function (e) {
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
                <?php echo $form->textField($model,'price',array('class'=>'default__input','placeholder'=>'.грн', 'maxlength'=>6)); ?>
        		<?php echo $form->error($model,'price'); ?>
              </div>
              <div class="col-5 add-action__form-container price__discount">
                <?php echo $form->labelEx($model,'sale',array('class'=>'cabinet-pro__add-action__label')); ?>
        		<?php echo CHtml::dropDownList('Actions[sale]',$model->sale,
                                array('10'=>'10%','20'=>'20%','30'=>'30%','40'=>'40%','50'=>'50%','60'=>'60%','70'=>'70%','80'=>'80%','90'=>'90%','100'=>'100%'),
                                array('onchange'=>'setDiscount()','class'=>'default__input','empty'=>'')
                            ); 
                ?>
        		<?php echo $form->error($model,'sale'); ?>
              </div>
              <div class="col-2 add-action__form-container price__with__discount" id="res">
                <?php
                if($model->sale!='') {
                    $new_price=$model->price - round($model->price*$model->sale/100);
                    echo $new_price.' грн';
                }
                ?>
              </div>
              <div class="col-12 add-action__form-container">
                <?php echo $form->labelEx($model,'description',array('class'=>'cabinet-pro__add-action__label')); ?>
        		<?php echo $form->textArea($model,'description',array('class'=>'default__textarea','maxlength'=>500,'placeholder'=>'Укажите краткую информацию об акции')); ?>
        		<?php echo $form->error($model,'description'); ?>
              </div>
              <div class="col-12 add-action__form-container">
                <?php echo $form->labelEx($model,'conditions',array('class'=>'cabinet-pro__add-action__label')); ?>
        		<?php echo $form->textArea($model,'conditions',array('class'=>'default__textarea','maxlength'=>500,'placeholder'=>'Данная информаця будет видна другим авторам и клиентам')); ?>
        		<?php echo $form->error($model,'conditions'); ?>
              </div>
              <div class="col-12 text_right">
                  <div class="btn__group clfx">
                    <div class="col-179">
                      <input type="reset" class="cabinet__profile__btn" value="ОТМЕНА" />
                    </div>
                    <div class="col-179">
                      <?php echo CHtml::hiddenField('Actions[uid]',Yii::app()->user->id); ?>
                      <?php echo CHtml::hiddenField('Actions[occupation_id]',Yii::app()->user->role); ?>
                      <?php echo CHtml::submitButton('СОХРАНИТЬ',array('class'=>'cabinet__profile__btn cabinet__profile__btn-submit')); ?>
                    </div>
                  </div>
              </div>
<?php $this->endWidget(); ?>  
<script>
function setDiscount() {
    var price=$('#Actions_price').val();
    if(price=='') alert('Вы должэны сначала указать начальную стоимость.');
    var d=$('#Actions_sale').val();    
    var res=price - Math.ceil(price*d/100);
    //alert(res);    
    $('#res').html(res + ' грн');
}
</script>            