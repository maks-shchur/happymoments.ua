<?php
/* @var $this FreefotoController */
/* @var $model Freefoto */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'freefoto-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="freefoto_search_title">Уточните поиск</p>
    
    <div id="freefoto-div">
	<div class="search__hidden__float-container search__hidden__float-container--w269">
        <label for="city" class="search__hidden__input-label">Где Вас сфотографировали</label>
        <?php
            if(isset($_POST['city_id']))
                $active=intval($_POST['city_id']);
            elseif(isset(Yii::app()->request->cookies['city']))
                $active=Yii::app()->request->cookies['city']->value;
            else $active='';
            echo CHtml::dropDownList('city_id',$active,CHtml::listData(City::model()->findAll(),'id','name'),array('id'=>'city_freefoto','empty'=>'Ваш город')); 
        ?>
    </div>
    <div class="search__hidden__float-container search__hidden__float-container--w269">
        <label for="datepicker" class="search__hidden__input-label">Когда Вас сфотографировали</label>
        <input type="text" id="date_freefoto" value="<?=isset($_POST['date'])?$_POST['date']:''?>" name="date" placeholder="Выберите дату" class="search__hidden__input freefoto__hidden__input--datepicker" />
    </div>
    <?/*div class="search__hidden__float-container search__hidden__float-container--w269">
        <label for="name" class="search__hidden__input-label">Кто Вас сфотографировал</label>
        <input type="text" name="name" value="<?=isset($_POST['name'])?$_POST['name']:''?>" class="search__hidden__input" placeholder="необязательое поле" id="free3" />
    </div*/?>
    <div class="search__hidden__float-container search__hidden__float-container--w269" style="padding-top:26px;">
        <?=CHtml::submitButton('ИСКАТЬ',array('class'=>'green-btn', 'style'=>'height:46px;'));?>
    </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->