<?php 
      //$model=new Users();
      //$model->setScenario('step2');
      $form=$this->beginWidget('CActiveForm', array(
            //'action' => array('/register/create'),
            'id'=>'users-form',
            /*'enableAjaxValidation'=>true,
            'enableClientValidation' => true, 
            'clientOptions' => array(
                'validateOnSubmit' => true,
                'validateOnChange' => true,
            ),*/
      )); ?>
        <?php //echo $form->errorSummary($model); ?>
      
        <div class="col-12 add-action__form-container">
            <?php echo $form->labelEx($model,'name',array('class'=>'cabinet-pro__add-action__label')); ?>
            <?php echo $form->textField($model,'name',array('class'=>'default__input pl33 input__fio','placeholder'=>'Альфа студия')) ?>
            <?php echo $form->error($model,'name'); ?>
        </div>
        <div class="col-12 add-action__form-container">
            <?php echo $form->labelEx($model,'email',array('class'=>'cabinet-pro__add-action__label')); ?>
            <?php echo $form->emailField($model,'email',array('class'=>'default__input pl33  input__email','placeholder'=>'Example@gmail.com')) ?>
            <?php echo $form->error($model,'email'); ?>
        </div>
        <div class="col-12 add-action__form-container">
            <?php echo $form->labelEx($model,'password',array('class'=>'cabinet-pro__add-action__label')); ?>
            <?php echo $form->passwordField($model,'password',array('class'=>'default__input pl33 input__pass','placeholder'=>'Не менее 5 символов')) ?>
            <?php echo $form->error($model,'password'); ?>
        </div>
        <?/*div class="col-12 add-action__form-container">
            <?=CHtml::activeLabelEx($model, 'verifyCode')?>
            <?php $this->widget('CCaptcha'); ?>
            <?=CHtml::activeTextField($model, 'verifyCode',array('class'=>'default__input pl33 input__pass'))?>
            <?php echo $form->error($model,'verifyCode'); ?>
        </div*/?>
        <div class="col-12 add-action__form-container">
        <?php /*echo CHtml::activeLabelEx($model, 'validacion'); ?>
        <?php $this->widget('application.extensions.recaptcha.EReCaptcha', 
           array('model'=>$user, 'attribute'=>'validacion',
                 'theme'=>'red', 'language'=>'en_EN', 
                 'publicKey'=>'6LdhAgQTAAAAADmrxRD5kuVqBU1fJ54_Cs5knXfT')) ?>
        <?php echo CHtml::error($model, 'validacion');*/ ?>
        </div>
        <div class="col-12 agreement clfx">
            <div class="agreement__ckeckbox">
              <?php echo $form->checkBox($model,'tos',array('style'=>'width:30px;height:30px;',"uncheckedValue"=>"")) ?>
              <?php //echo CHtml::label('','big__checkbox'); ?>
            </div>
            <div class="agreement__text">
              Я  соглашаюсь с <a href="<?=$this->createUrl('/page/user_agreement')?>" target="_blank">пользовательским соглашением</a>
              и  <a href="<?=$this->createUrl('/page/politic')?>" target="_blank">политикой конфиденциальности</a>  портала
              Нарруmoments.ua
            </div>
        </div>
        <div class="col-12" style="position: relative; top: 18px;"><?php echo $form->error($model,'tos'); ?></div>
        <div class="clfx"></div>
            <?php echo CHtml::hiddenField('Users[member]',$search) ?>
            <?php echo CHtml::submitButton(Yii::t('register','continue'),array('class'=>'registration__main__btn')); ?>
      <?php $this->endWidget(); ?>