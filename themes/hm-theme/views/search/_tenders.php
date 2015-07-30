 
  <div class="wrapper wrapper--advanced-search">
    <div class="container">
      <button class="advanced-search__title">ПОИСК ТЕНДЕРА</button>
      <div class="advanced-search__hidden">
        <?php $form=$this->beginWidget('CActiveForm', array(
            	'id'=>'tenders-form',
                'enableAjaxValidation'=>false,
                'enableClientValidation' => false, 
                'clientOptions' => array(
                    'validateOnSubmit' => false,
                    'validateOnChange' => false,
                ),
            )); ?>
          <div class="search__hidden__float-container search__hidden__float-container--w310">
            <label for="city" class="search__hidden__input-label">Город</label>
            <?php
                if(isset(Yii::app()->request->cookies['city']))
                    $active=Yii::app()->request->cookies['city']->value;
                else $active='';
                echo CHtml::dropDownList('city',$active,CHtml::listData(City::model()->findAll(),'id','name'),array('id'=>'tender_city','empty'=>'Укажите ближайший город')); 
            ?>
          </div>
          <!-- div class="search__hidden__float-container search__hidden__float-container--w210">
            <label for="datepicker" class="search__hidden__input-label">Дата мероприятия</label>
            <input type="text" id="datepicker" name="" placeholder="Выберите дату" class="search__hidden__input search__hidden__input--datepicker" />
          </div-->
          <div class="search__hidden__float-container search__hidden__float-container--w310">
            <label for="genre" class="search__hidden__input-label">Услуга</label>
            <?php echo CHtml::dropDownList('occupation','',CHtml::listData(Occupation::model()->findAll(),'id','name'),array('id'=>'tender_genre','empty'=>'Выберите нужную услугу')) ?>
          </div>
          <div class="search__hidden__float-container search__hidden__float-container--w236">
            <label for="minPrice" class="search__hidden__input-label search__hidden__input-label_pl10">Стоимость, грн</label>
            <div class="search__hidden__price-container">
              <input type="text" name="price_from" id="minPrice" class="search__hidden__input" placeholder="от">
            </div>
            <div class="search__hidden__price-container">
              <input type="text" name="price_to" class="search__hidden__input" placeholder="до">
            </div>
          </div>
          <!--div class="clfx"></div>
          <div class="radio-wrapper">
            <div class="checkbox-name">Пол участника</div>
            <input class="radio" type="radio" name="lorem" id="radio-1">
            <label class="radio-label" for="radio-1">Мужчина</label>
            <input class="radio" type="radio" name="lorem" id="radio-2">
            <label class="radio-label" for="radio-2">Женщина</label>
            <input type="radio" name="lorem" id="radio-3" class="radio">
            <label class="radio-label" for="radio-3">Организация/компания</label>
          </div-->
          <div class="clfx"></div>
          <div class="search__hidden__buttons-wrapper">
            <div class="green-btn green-btn__slide">ОТМЕНА</div>
            <?=CHtml::submitButton('ИСКАТЬ',array('class'=>'green-btn'));?>
          </div>
        <?php $this->endWidget(); ?>
      </div>
    </div>
  </div>
