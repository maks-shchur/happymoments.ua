<main class="cabinet__profile">
<?php $form=$this->beginWidget('CActiveForm', array(
            'action' => array('/my/profile/update/id/'.$model->id),
            'id'=>'profile-form',
            'enableAjaxValidation'=>false,
            'method'=>'post',
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
      )); ?> 
      
      <?php //echo $form->errorSummary($model); ?>       
    <div class="default-input__container">
      <div class="col-275">
        <?php //echo $form->labelEx($model,'name',array('class'=>'default-input__label default-input__label__fio')); ?>
        <?php echo $form->labelEx($model,'name_studio',array('class'=>'default-input__label default-input__label__fio')); ?>
      </div>
      <div class="col-384">
        <?php echo $form->textField($model,'name',array('class'=>'default__input','placeholder'=>'Альфа студия')) ?>
        <?php echo $form->error($model,'name_studio'); ?>
      </div>
    </div> 
    <!--div class="default-input__container">
      <div class="col-275">
        <?php echo $form->labelEx($model,'gender',array('class'=>'default-input__label__font')); ?>
      </div>
      <div class="col-384">
        <?php echo $form->radioButtonList($model,'gender',array('m'=>'М','f'=>'Ж','a'=>'Неважно'),array('class'=>'default-input__radio','separator'=>'')) ?>
        <?php echo $form->error($model,'gender'); ?>
      </div>
    </div-->
    <!--div class="default-input__container">
      <div class="col-275">
        <?php echo $form->labelEx($model,'date_birth',array('class'=>'default-input__label')); ?>
      </div>
      <div class="col-384">
        <?php
        if($model->date_birth!='0000-00-00')
            $d=explode('-',$model->date_birth);
        else $d=array('','','');
        ?>
        <div class="col-119">
            <select name="day_b" id="dob" class="default__input" placeholder="День" required="">
                <?php
                echo '<option value="">День</option>';
                for($i=1;$i<=31;$i++) {
                    if($i==$d[2]) echo '<option value="'.$i.'" selected>'.$i.'</option>';
                    else echo '<option value="'.$i.'">'.$i.'</option>';
                }
                ?>
            </select> 
        </div>
        <div class="col-119">
            <select name="month_b" class="default__input" placeholder="Месяц" required="">
                <?php
                echo '<option value="">Месяц</option>';
                for($i=1;$i<=12;$i++) {
                    if($i==1) $name='Январь';
                    if($i==2) $name='Февраль';
                    if($i==3) $name='Март';
                    if($i==4) $name='Апрель';
                    if($i==5) $name='Май';
                    if($i==6) $name='Июнь';
                    if($i==7) $name='Июль';
                    if($i==8) $name='Август';
                    if($i==9) $name='Сентябрь';
                    if($i==10) $name='Октябрь';
                    if($i==11) $name='Ноябрь';
                    if($i==12) $name='Декабрь';
                    if($i==$d[1]) echo '<option value="'.$i.'" selected>'.$name.'</option>';
                    else echo '<option value="'.$i.'">'.$name.'</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-119">
            <select name="year_b" class="default__input" placeholder="Год" required="">
                <?php
                echo '<option value="">Год</option>';
                for($i=1940;$i<=2014;$i++) {
                    if($i==$d[0]) echo '<option value="'.$i.'" selected>'.$i.'</option>';
                    else echo '<option value="'.$i.'">'.$i.'</option>';
                }
                ?>
            </select>
        </div>
        <?php //echo $form->dateField($model,'date_birth',array('class'=>'default__input')) ?>
        <?php //echo $form->textField($model,'date_birth',array('class'=>'default__input')) ?>
        <?php echo $form->error($model,'date_birth'); ?>
      </div>
      <div class="col-270">
        <p>Видна только администрации сайта</p>
      </div>
    </div-->
    <div class="default-input__container">
      <div class="col-275">
        <?php echo $form->labelEx($model,'city_id',array('class'=>'default-input__label')); ?>
      </div>
      <div class="col-384 city-search__for-add">
        <?php echo $form->dropDownList($model,'city_id',CHtml::listData(City::model()->findAll(),'id','name'),array('class'=>'default__input search__hidden__input--city','empty'=>'')) ?>
        <?php echo $form->error($model,'city_id'); ?>
      </div>
    </div> 
    <div class="default-input__container">
      <div class="col-275">
        <?php echo $form->labelEx($model,'district',array('class'=>'default-input__label')); ?>
      </div>
      <div class="col-384">
        <?php echo $form->textField($model,'district',array('class'=>'default__input')) ?>
        <?php echo $form->error($model,'district'); ?>
      </div>
    </div>
    <div class="default-input__container">
      <div class="col-275">
        <?php echo $form->labelEx($model,'address',array('class'=>'default-input__label')); ?>
      </div>
      <div class="col-384">
        <?php echo $form->textField($model,'address',array('class'=>'default__input')) ?>
        <?php echo $form->error($model,'address'); ?>
      </div>
    </div>
    <!--div class="default-input__container">
      <div class="col-275">
        <?php echo $form->labelEx($model,'price_h',array('class'=>'default-input__label')); ?>
      </div>
      <div class="col-384">
        <?php echo $form->textField($model,'price_h',array('class'=>'default__input','placeholder'=>'укажите стоимость аренды')) ?>
        <?php echo $form->error($model,'price_h'); ?>
      </div>
    </div-->
    <script>
    <?php
    if($model->phone!='')$cnt=0;
    else $cnt=1;
    if($model->phone!='') $cnt++;
    if($model->phone2!='') $cnt++;
    if($model->phone3!='') $cnt++;
    ?>
    var count = <?=$cnt;?>;
    
    function addField()
    {
        var c=count-1;
        if(count<3) {
          if(count==1 && $('#Users_phone').val()!='') { 
            $("#user__tels").append(
                '<div class="default-input__container" id="tel' + (++count) + '"><div class="col-275"><label class="default-input__label pt4" for="Users_phone' + count + '">Дополнительный<br>телефон</label></div><div class="col-384"><input class="default__input" placeholder="+38(099)-123-45-67" maxlength="17" name="Users[phone' + count + ']" id="Users_phone' + count + '" type="text"><div class="default__input__plus-btn-tender" onclick="delField(' + count + '); return false;">-</div></div></div>'
            );
          }  
          else {
              if(count==2 && document.getElementById('Users_phone2').value!='') { 
                $("#user__tels").append(
                    '<div class="default-input__container" id="tel' + (++count) + '"><div class="col-275"><label class="default-input__label pt4" for="Users_phone' + count + '">Дополнительный<br>телефон</label></div><div class="col-384"><input class="default__input" placeholder="+38(099)-123-45-67" maxlength="17" name="Users[phone' + count + ']" id="Users_phone' + count + '" type="text"><div class="default__input__plus-btn-tender" onclick="delField(' + count + '); return false;">-</div></div></div>'
                );       
              }
          }
       }    
    }
    function delField(counter)
    {
        $("#tel" + counter).remove();
        --count;
    }
    </script>
    <div class="default-input__container">
      <div class="col-275">
        <?php echo $form->labelEx($model,'phone',array('class'=>'default-input__label')); ?>
      </div>
      <div class="col-384">
        <?php echo $form->textField($model,'phone',array('class'=>'default__input','placeholder'=>'+38(099)-123-45-67','maxlength'=>17)); ?>
        <div class="default__input__plus-btn" onclick="addField(); return false;">+</div>
        <?php echo $form->error($model,'phone'); ?>
      </div>
    </div>
    <?php if($model->phone2!=''): ?>
      <div class="default-input__container" id="tel2">
        <div class="col-275">
            <?php echo $form->labelEx($model,'phone2',array('class'=>'default-input__label')); ?>
        </div>
        <div class="col-384">
            <?php echo $form->textField($model,'phone2',array('class'=>'default__input','placeholder'=>'+38(099)-123-45-67','maxlength'=>17)); ?>
            <div class="default__input__plus-btn-tender" onclick="delField(2); return false;">-</div>
            <?php echo $form->error($model,'phone2'); ?>
         </div>
      </div>
      <?php endif; ?>
      <?php if($model->phone3!=''): ?>
      <div class="default-input__container" id="tel3">
        <div class="col-275">
            <?php echo $form->labelEx($model,'phone3',array('class'=>'default-input__label')); ?>
        </div>
        <div class="col-384">
            <?php echo $form->textField($model,'phone3',array('class'=>'default__input','placeholder'=>'+38(099)-123-45-67','maxlength'=>17)); ?>
            <div class="default__input__plus-btn-tender" onclick="delField(3); return false;">-</div>
            <?php echo $form->error($model,'phone3'); ?>
         </div>
      </div>
      <?php endif; ?>
      <div id="user__tels"></div>
    <div class="default-input__container">
      <div class="col-275">
        <?php echo $form->labelEx($model,'url',array('class'=>'default-input__label')); ?>
      </div>
      <div class="col-384">
        <?php echo $form->textField($model,'url',array('class'=>'default__input','placeholder'=>'http://www.site.com')) ?>
        <?php echo $form->error($model,'url'); ?>
      </div>
    </div>
    <div class="default-input__container">
      <div class="col-275">
        <?php echo $form->labelEx($model,'skype',array('class'=>'default-input__label')); ?>
      </div>
      <div class="col-384">
        <?php echo $form->textField($model,'skype',array('class'=>'default__input')) ?>
        <?php echo $form->error($model,'skype'); ?>
      </div>
    </div> 
    <div class="default-input__container">
      <div class="col-275">
        <?php echo $form->labelEx($model,'email',array('class'=>'default-input__label')); ?>
      </div>
      <div class="col-384">
        <?php echo $form->textField($model,'email',array('class'=>'default__input','placeholder'=>'example@gmail.com')) ?>
        <?php echo $form->error($model,'email'); ?>
      </div>
    </div>
    <div class="default-input__container">
      <div class="col-275">
        <?php echo $form->labelEx($model,'Время работы фотостудии',array('class'=>'default-input__label')); ?>
      </div>
      <div class="col-384">
          <div class="col-179">
            <?php echo $form->textField($model,'work_from',array('class'=>'default__input','placeholder'=>'с 9:00')) ?> 
            <?php echo $form->error($model,'work_from'); ?>
          </div>
          <div class="col-179"> 
            <?php echo $form->textField($model,'work_to',array('class'=>'default__input','placeholder'=>'до 21:00')) ?>
            <?php echo $form->error($model,'work_to'); ?>
          </div>
      </div>
    </div>
    <div class="default-input__container">
      <div class="col-275">
        <?php echo $form->labelEx($model,'hals',array('class'=>'default-input__label')); ?>
      </div>
      <div class="col-384">
        <?php //echo $form->textField($model,'hals',array('class'=>'default__input')) ?>
        <?php
        for($i=1;$i<=20;$i++)
        {
            $count_hals[$i]=$i;
        }
        ?>
        <?php echo $form->dropDownList($model,'hals', $count_hals, array('class'=>'default__input')) ?>
        <?php echo $form->error($model,'hals'); ?>
      </div>
    </div>
    <!--div class="default-input__container">
      <div class="col-275">
        <?php echo $form->labelEx($model,'square',array('class'=>'default-input__label')); ?>
      </div>
      <div class="col-384">
        <?php echo $form->textField($model,'square',array('class'=>'default__input','placeholder'=>'например: 60,5 кв. м.')) ?>
        <?php echo $form->error($model,'square'); ?>
      </div>
    </div>
    <div class="default-input__container">
      <div class="col-275">
        <?php echo $form->labelEx($model,'height',array('class'=>'default-input__label')); ?>
      </div>
      <div class="col-384">
        <?php echo $form->textField($model,'height',array('class'=>'default__input','placeholder'=>'например: 2,75 м.')) ?>
        <?php echo $form->error($model,'height'); ?>
      </div>
    </div-->

    <div class="default-input__container">
      <div class="col-275">
        <?php //echo $form->labelEx($model,'about',array('class'=>'default-input__label')); ?>
        <?php echo $form->labelEx($model,'О фотостудии',array('class'=>'default-input__label')); ?>
      </div>
      <div class="col-384">
        <?php echo $form->textArea($model,'about',array('cols'=>25,'rows'=>10,'class'=>'default__textarea','placeholder'=>'Данная информаця будет видна другим авторам и потенциальным клиентам')) ?>
        <?php echo $form->error($model,'about'); ?>
      </div>
    </div> 
    <div class="default-input__container">
      <div class="col-275">
      </div>
      <div class="col-384">
        <div class="col-179">
          <?php echo CHtml::hiddenField('member',1); ?>
          <?php //echo CHtml::hiddenField('templ',$model->occupation->templ); ?>       
          <?php echo CHtml::button('ОТМЕНА',array('class'=>'cabinet__profile__btn','onClick'=>'window.history.back();')) ?>
        </div>
        <div class="col-179">
          <?php echo CHtml::submitButton('СОХРАНИТЬ',array('class'=>'cabinet__profile__btn cabinet__profile__btn-submit','id'=>'apply')) ?>
        </div>
      </div>
    </div>    

<?php $this->endWidget(); ?>
</main>