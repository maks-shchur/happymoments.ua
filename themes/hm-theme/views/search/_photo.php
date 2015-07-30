 <div class="wrapper parallax__wrap">
    <div class="parallax__wrap--inner">
      <div class="parallax__bg" data-stellar-background-ratio="0.6">
        <div class="container">
          <h1 class="header-parallax__title"><?=Occupation::getName(Yii::app()->getRequest()->getParam('id'))?></h1>
        </div>
      </div>
    </div>
  </div>
  <div class="wrapper wrapper--advanced-search">
    <div class="container">
      <button class="advanced-search__title">РАСШИРЕННЫЙ ПОИСК</button>
      <div class="advanced-search__hidden">
        <?php $form=$this->beginWidget('CActiveForm', array(
            	'id'=>'users-form',
                'enableAjaxValidation'=>false,
                'enableClientValidation' => false, 
                'clientOptions' => array(
                    'validateOnSubmit' => false,
                    'validateOnChange' => false,
                ),
            )); ?>
          <div class="search__hidden__float-container search__hidden__float-container--w210">
            <label for="city" class="search__hidden__input-label">Город</label>
            <?php
                if(isset(Yii::app()->request->cookies['city']))
                    $active=Yii::app()->request->cookies['city']->value;
                else $active='';
                echo CHtml::dropDownList('city',$active,CHtml::listData(City::model()->findAll(),'id','name'),array('id'=>'city','empty'=>'Укажите город')); 
            ?>
          </div>
          <div class="search__hidden__float-container search__hidden__float-container--w236">
            <label for="name" class="search__hidden__input-label">Имя или название организации</label>
            <input type="text" name="name" class="search__hidden__input" placeholder="Альфа-компани" />
          </div>
          <div class="search__hidden__float-container search__hidden__float-container--w210">
            <label for="city" class="search__hidden__input-label">Жанр</label>
            <?php
                echo CHtml::dropDownList('genre','',CHtml::listData(Genre::model()->findAllByAttributes(array('occ_id'=>Yii::app()->getRequest()->getParam('id'))),'id','name'),array('id'=>'genre','empty'=>'Жанр')); 
            ?>
          </div>
          <div class="search__hidden__float-container search__hidden__float-container--w210">
            <label for="city" class="search__hidden__input-label">Статус участника</label>
            <?php
                echo CHtml::dropDownList('m_type','',array('basic'=>'basic','plus'=>'plus','pro'=>'pro'),array('id'=>'m_type','empty'=>'Статус учасника')); 
            ?>
          </div>
          <div class="search__hidden__float-container search__hidden__float-container--w210" style="width:150px;">
            <label for="calend" class="search__hidden__input-label">Дата</label>
            <?php
                echo CHtml::textField('calend','',array('id'=>'search_date','placeholder'=>'Выберите дату','class'=>'search__hidden__input')); 
            ?>
          </div>
          <div class="clfx"></div>
          <div class="search__hidden__buttons-wrapper">
            <div class="green-btn green-btn__slide">ОТМЕНА</div>
            <?=CHtml::submitButton('ИСКАТЬ',array('class'=>'green-btn'));?>
          </div>
        <?php $this->endWidget(); ?>
      </div>
    </div>
  </div>
