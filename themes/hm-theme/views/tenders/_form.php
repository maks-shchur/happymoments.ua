<?php
/* @var $this TendersController */
/* @var $model_t Tenders */
/* @var $form CActiveForm */
?>

        <div class="genera-cabinet__tender">
          <div class="tender-title-edit clfx">
            <div class="col-4"><a href="/my/tenders">Все тендеры</a></div>
            <div class="col-4"><?=$model_t->isNewRecord ? 'Добавление тендера' : 'Редактирование тендера';?></div>
            <div class="col-4"></div>
          </div>
          
        <?php 
        if($model_t->isNewRecord):
        ?>  
          <div class="tender-edit">
            <?php $form=$this->beginWidget('CActiveForm', array(
            	'id'=>'tenders-form',
            	'enableAjaxValidation'=>false,
                'enableClientValidation' => false, 
                'clientOptions' => array(
                    'validateOnSubmit' => false,
                    'validateOnChange' => false,
                ),
            )); ?>
            <?php //echo $form->errorSummary($model_t); ?>
              <div class="default-input__container">
                <div class="col-181">
                    <?php echo $form->labelEx($model_t,'occupation',array('class'=>'default-input__label')); ?>
                </div>
                <div class="col-674">
                    <?php //echo $form->dropDownList($model_t,'occupation',CHtml::listData(City::model()->findAll(),'id','name'),array('class'=>'default__input','empty'=>'')); ?>
                    <?php echo $form->dropDownList($model_t,'occupation',CHtml::listData(Occupation::model()->findAll(),'id','name')
                                        ,
                                        array(
                                            'empty'=>'',
                                            'ajax' => array(
                                                'type'=>'POST', //request type
                                                'url'=>CController::createUrl('/my/tenders/genresublist'), //url to call.
                                                //'update'=>'#Tenders_genre', //selector to update
                                                'success'=>'function(html) 
                                                { 
                                                    if(html!="") {
                                                        jQuery("#genre_show").css("display", "block");
                                                        jQuery("#Tenders_genre").html(html);
                                                    }
                                                    else {
                                                        jQuery("#genre_show").css("display", "none");
                                                    }
                                                }',
                                           ),
                                           'class'=>'default__input',
                                        )
                                        ); 
                    ?>
                    <?php echo $form->error($model_t,'occupation'); ?>             
                </div>
              </div>
              
              <?php
              $model_t->genre=unserialize($model_t->genre);
              ?>
              <div class="default-input__container" id="genre_show" style="display: <?=$model_t->genre==''?'none':'block';?>;">
                <div class="col-181">
                    <?php echo $form->labelEx($model_t,'genre',array('class'=>'default-input__label')); ?>
                </div>
                <div class="col-674">
                    <?php      
                        echo $form->checkBoxList($model_t, 'genre', CHtml::listData(Genre::model()->findAll('occ_id=:occ_id', array(':occ_id'=>(int) $model_t->occupation)), 'id', 'name')); 
                    ?>
                    <?php echo $form->error($model_t,'genre'); ?>
                </div>
              </div>
              <div class="default-input__container">
                <div class="col-181">
                    <?php echo $form->labelEx($model_t,'date_end',array('class'=>'default-input__label pt4')); ?>
                </div>
                <div class="col-674">
                    <?php echo $form->textField($model_t,'date_end',array('id'=>'datepicker','class'=>'default__input tender__datepicker','placeholder'=>'25 апреля 2014')); ?>
                    <?php echo $form->error($model_t,'date_end'); ?>
                </div>
              </div>
              <div class="default-input__container">
                <div class="col-181">
                    <?php echo $form->labelEx($model_t,'city',array('class'=>'default-input__label')); ?>
                </div>
                <div class="col-674 city-search__for-add">
                    <?php echo $form->dropDownList($model_t,'city',CHtml::listData(City::model()->findAll(),'id','name'),array('class'=>'default__input search__hidden__input--city','empty'=>'Укажите ближайший город')) ?>
                    <?php echo $form->error($model_t,'city'); ?>
                </div>
              </div>
		      <div class="default-input__container">
                <div class="col-181">
                    <?php echo $form->labelEx($model_t,'price',array('class'=>'default-input__label')); ?>
                </div>
                <div class="col-674">
                    <?php echo $form->textField($model_t,'price',array('class'=>'default__input','placeholder'=>'5000')); ?>
                    <?php echo $form->error($model_t,'price'); ?>
                </div>
              </div>
		      <div class="default-input__container">
                <div class="col-181">
                    <?php echo $form->labelEx($model_t,'description',array('class'=>'default-input__label')); ?>
                </div>
                <div class="col-674">
                    <?php echo $form->textArea($model_t,'description',array('class'=>'default__textarea','placeholder'=>'Текст о тендере','rows'=>10, 'cols'=>25)); ?>
                    <?php echo $form->error($model_t,'description'); ?>
                </div>
              </div>
              <script>
                <?php
                $cnt=1;
                if($model_t->phone!='') $cnt++;
                if($model_t->phone2!='') $cnt++;
                if($model_t->phone3!='') $cnt++;
                ?>
                var count = <?=$cnt;?>;
                
                function addField()
                {
                    if(count<3) {
                        $("#user__tels").append(
                            '<div class="default-input__container" id="tel' + (++count) + '"><div class="col-181"><label class="default-input__label pt4" for="Tenders_phone' + count + '">Дополнительный<br>телефон</label></div><div class="col-674"><input class="default__input" data-id="phone-input" placeholder="+38(099)123-45-67" maxlength="17" name="Tenders[phone' + count + ']" id="Tenders_phone' + count + '" type="text"><div class="default__input__plus-btn-tender" onclick="delField(' + count + '); return false;">-</div></div></div>'
                        );
                    }
                }
                function delField(counter)
                {
                    $("#tel" + counter).remove();
                    --count;
                }
                </script>
              <div class="default-input__container">
                <div class="col-181">
                    <?php echo $form->labelEx($model_t,'phone',array('class'=>'default-input__label')); ?>
                </div>
                <div class="col-674">
                    <?php echo $form->textField($model_t,'phone',array('class'=>'default__input','placeholder'=>'+38(099)123-45-67','maxlength'=>17,'data-id'=>'phone-input')); ?>
                   <div class="default__input__plus-btn-tender" onclick="addField(); return false;">+</div>
                    <?php echo $form->error($model_t,'phone'); ?>
                 </div>
              </div>
              <?php if($model_t->phone2!=''): ?>
              <div class="default-input__container">
                <div class="col-181">
                    <?php echo $form->labelEx($model_t,'phone2',array('class'=>'default-input__label')); ?>
                </div>
                <div class="col-674">
                    <?php echo $form->textField($model_t,'phone2',array('class'=>'default__input','placeholder'=>'+38(099)-123-45-67','maxlength'=>17)); ?>
                    <?php echo $form->error($model_t,'phone2'); ?>
                 </div>
              </div>
              <?php endif; ?>
              <?php if($model_t->phone3!=''): ?>
              <div class="default-input__container">
                <div class="col-181">
                    <?php echo $form->labelEx($model_t,'phone3',array('class'=>'default-input__label')); ?>
                </div>
                <div class="col-674">
                    <?php echo $form->textField($model_t,'phone3',array('class'=>'default__input','placeholder'=>'+38(099)-123-45-67','maxlength'=>17)); ?>
                    <?php echo $form->error($model_t,'phone3'); ?>
                 </div>
              </div>
              <?php endif; ?>
              <div id="user__tels"></div>
              <div class="default-input__container">
                <div class="col-181">
                    <?php echo $form->labelEx($model_t,'email',array('class'=>'default-input__label')); ?>
                </div>
                <div class="col-674">
                    <?php echo $form->emailField($model_t,'email',array('class'=>'default__input','placeholder'=>'example@gmail.com','maxlength'=>255)); ?>
                    <?php echo $form->error($model_t,'email'); ?>
                </div>
              </div>

              <div class="col-181"></div>
              <div class="col-674">
                <div class="col-12 text_right">
                  <div class="btn__group clfx">
                    <div class="col-179">
                    
                      <button type="clear" class="cabinet__profile__btn" onclick="window.location.href='/tenders/'">ОТМЕНА</button>
                    </div>
                    <div class="col-179">
                        <?=CHtml::hiddenField('Tenders[uid]',Yii::app()->user->id);?>
                      <?php echo CHtml::submitButton('СОХРАНИТЬ',array('class'=>'cabinet__profile__btn cabinet__profile__btn-submit')); ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php $this->endWidget(); ?>
          </div>
        <?php
        else:
        ?>
        
          <div class="tender-edit">
            <?php $form=$this->beginWidget('CActiveForm', array(
            	'id'=>'tenders-form',
            	'enableAjaxValidation'=>false,
                'enableClientValidation' => false, 
                'clientOptions' => array(
                    'validateOnSubmit' => false,
                    'validateOnChange' => false,
                ),
            )); ?>
            <?php //echo $form->errorSummary($model_t); ?>
              
		      <div class="default-input__container">
                <div class="col-181">
                    <?php echo $form->labelEx($model_t,'description',array('class'=>'default-input__label')); ?>
                </div>
                <div class="col-674">
                    <?php echo $form->textArea($model_t,'description',array('class'=>'default__textarea','placeholder'=>'Текст о тендере','rows'=>10, 'cols'=>25)); ?>
                    <?php echo $form->error($model_t,'description'); ?>
                </div>
              </div>

              <div class="col-181"></div>
              <div class="col-674">
                <div class="col-12 text_right">
                  <div class="btn__group clfx">
                    <div class="col-179">
                    
                      <button type="clear" class="cabinet__profile__btn" onclick="window.location.href='/tenders/'">ОТМЕНА</button>
                    </div>
                    <div class="col-179">
                        <?=CHtml::hiddenField('Tenders[uid]',Yii::app()->user->id);?>
                      <?php echo CHtml::submitButton('СОХРАНИТЬ',array('class'=>'cabinet__profile__btn cabinet__profile__btn-submit')); ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php $this->endWidget(); ?>
          </div>        
        
        <?php
        endif;
        ?>
        </div>