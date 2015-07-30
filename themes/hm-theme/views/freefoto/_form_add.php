<?php
/* @var $this FreefotoController */
/* @var $model Freefoto */
/* @var $form CActiveForm */
?>

<div class="form">
<?php
if(!isset($_POST['add_photo'])) {
?>
    <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'freefoto-form',
    	// Please note: When you enable ajax validation, make sure the corresponding
    	// controller action is handling ajax validation correctly.
    	// There is a call to performAjaxValidation() commented in generated controller code.
    	// See class documentation of CActiveForm for details on this.
    	'enableAjaxValidation'=>false,
    )); ?>
    
    	<p class="freefoto_search_title">Добавление фото</p>
    
    	<div class="search__hidden__float-container search__hidden__float-container--w269">
            <label for="city" class="search__hidden__input-label">Город</label>
            <?php
                if(isset($_POST['city_id']))
                    $active=$_POST['city_id'];
                else $active='';
                echo CHtml::dropDownList('city_id',$active,CHtml::listData(City::model()->findAll(),'id','name'),array('id'=>'city_freefoto','empty'=>'Ваш город')); 
            ?>
        </div>
        <div class="search__hidden__float-container search__hidden__float-container--w269">
            <label for="datepicker" class="search__hidden__input-label">Дата фотографии</label>
            <input type="text" value="<?=isset($_POST['date'])?$_POST['date']:''?>" id="date_freefoto" name="date" placeholder="Выберите дату" class="search__hidden__input search__hidden__input--datepicker" style="background: white url(/img/datepicker_icon.png) 220px 8px no-repeat;" />
        </div>
        <div class="search__hidden__float-container search__hidden__float-container--w269" style="padding-top:26px;">
            <?=CHtml::hiddenField('add_photo',1);?>
            <?=CHtml::submitButton('СОХРАНИТЬ',array('class'=>'green-btn', 'style'=>'height:47px;'));?>
        </div>
    
    <?php $this->endWidget(); ?>
<?php
}
else {
?>
    <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'freefoto-form',
    	// Please note: When you enable ajax validation, make sure the corresponding
    	// controller action is handling ajax validation correctly.
    	// There is a call to performAjaxValidation() commented in generated controller code.
    	// See class documentation of CActiveForm for details on this.
    	'enableAjaxValidation'=>false,
    )); ?>
    
    	<p class="freefoto_search_title">Добавление фото</p>
    
    	<div class="search__hidden__float-container search__hidden__float-container--w269">
            <label for="city" class="search__hidden__input-label">Город</label>
            <?php
                if(isset($_POST['city_id']))
                    $active=$_POST['city_id'];
                else $active='';
                echo CHtml::dropDownList('city_id',$active,CHtml::listData(City::model()->findAll(),'id','name'),array('id'=>'city_freefoto','empty'=>'Ваш город')); 
            ?>
        </div>
        <div class="search__hidden__float-container search__hidden__float-container--w269">
            <label for="datepicker" class="search__hidden__input-label">Дата фотографии</label>
            <input type="text" value="<?=isset($_POST['date'])?$_POST['date']:''?>" id="date_freefoto" name="date" placeholder="Выберите дату" class="search__hidden__input search__hidden__input--datepicker" style="background: white url(/img/datepicker_icon.png) 220px 8px no-repeat;" />
        </div>
        <div class="search__hidden__float-container search__hidden__float-container--w269" style="padding-top:26px;">
            <?=CHtml::hiddenField('add_photo',1);?>
            <?=CHtml::submitButton('СОХРАНИТЬ',array('class'=>'green-btn', 'style'=>'height:47px;'));?>
        </div>
    
    <?php $this->endWidget(); ?>
    
        <div class="col-12 global__plus__btn-container">
                <?php
                 $this->widget('ext.Upload.Upload',
                array(
                        'id'=>'uploadFiles',
                        'config'=>array(
                               'action'=>Yii::app()->createUrl('/freefoto/upload?name='.Yii::app()->user->name.'&city_id='.$_POST['city_id'].'&date='.$_POST['date']),
                               'allowedExtensions'=>array("jpg","jpeg","gif","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                               'sizeLimit'=>24*1024*1024,// maximum file size in bytes
                               'minSizeLimit'=>1*1024,
                               'auto'=>true,
                               'multiple' => true,
                               'onSubmit' => 'js:function(file, extension)  {
                                    $(".loader").css("display","block");
                                }',
                               'onComplete'=>'js:function(id, fileName, responseJSON){
                                    if (responseJSON.success)
                                    {    
                                        $.ajax({
                                            url: "/freefoto/render",
                                            cache: false,
                                            type: "POST",
                                            data: {id: responseJSON.res, url: "'.Yii::app()->request->requestUri.'"},
                                            success: function(data)
                                            {
                                                $(data).prependTo("#photos");
                                                $(".loader").css("display","none");
                                                //window.location.reload();
                                            }
                                        });
                                    }
                                }',
                               )
                 
                 ));
                ?>
            </div>
<?php    
}
?>
<div id="photos"></div>
</div><!-- form -->