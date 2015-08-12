  <div class="wrapper about_us__form ">
  <div class="container clfx">
    <div class="col-6 about_us__cont">
      <div class="about_us_cont-title">
        Контакты
      </div>
      <div class="about_text-1">По вопросам рекламы пишите в обратною связь или звоните по телефону:</div>
      <div class="about_text-2">
        +38 (093) 162 000 164<br>
        +38 (095) 162 000 164<br>
        +38 (096) 162 000 164
      </div>
            <div class="about_text-3">Все остальные вопросы через обратную связь</div>
      <div class="about_text-4">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. 
      </div>
            <div class="about_text-4">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. 
      </div>
    </div>
    <div class="col-6 about_us__send"> 
        
        <?php
        $form=$this->beginWidget('CActiveForm', array(
        	'id'=>'contact-form',
        	'enableClientValidation'=>true,
        	'clientOptions'=>array(
        		'validateOnSubmit'=>true,
        	),
        )); ?>
        
        
        	<?php //echo $form->errorSummary($model); ?>
                
                <?php echo $form->labelEx($model,'name',array('class'=>'cabinet-pro__add-action__label')); ?>
        		<?php echo $form->textField($model,'name',array('class'=>'default__input search__hidden__input--city','title'=>'Это поле обязательно для заполнение','placeholder'=>'Ваше имя')); ?>
        		<?php echo $form->error($model,'name'); ?>
        
        		<?php echo $form->labelEx($model,'email',array('class'=>'cabinet-pro__add-action__label')); ?>
        		<?php echo $form->textField($model,'email',array('class'=>'default__input search__hidden__input--city','title'=>'Это поле обязательно для заполнение','placeholder'=>'Exemple@gmail.com')); ?>
        		<?php echo $form->error($model,'email'); ?>
        
        		<?php echo $form->labelEx($model,'subject',array('class'=>'cabinet-pro__add-action__label')); ?>
        		<?php echo $form->textField($model,'subject',array('class'=>'default__input search__hidden__input--city','title'=>'Это поле обязательно для заполнение','placeholder'=>'Хочу заказать Вашу услугу')); ?>
        		<?php echo $form->error($model,'subject'); ?>
        
        		<?php echo $form->labelEx($model,'body',array('class'=>'cabinet-pro__add-action__label')); ?>
        		<?php echo $form->textArea($model,'body',array('class'=>'default__textarea','cols'=>25,'rows'=>10,'title'=>'Это поле обязательно для заполнение','placeholder'=>'Подробная информация о ваших пожеланиях, предложениях')); ?>
        		<?php echo $form->error($model,'body'); ?>
        
        		<?php echo CHtml::submitButton('ОТПРАВИТЬ',array('class'=>'enter__in__account')); ?>
        
        <?php 
        $this->endWidget();
        ?>
    </div>
  </div>
  </div>