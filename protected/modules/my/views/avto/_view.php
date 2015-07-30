<?php
/* @var $this AvtoController */
/* @var $data Avto */
$user=Users::model()->findByPk(Yii::app()->user->id);
?>

<div class="col-12 cabinet-plus__auto__item border__bottom-grey data_<?=$data->id?>">
            <div class="col-4 plus__add__auto-park__img-container">
              <figure class="plus__add__auto-park__img">
                <?php if($data->picture!=''):?>
                    <a href="/my/avto/update/id/<?=$data->id?>"><img src="/users/<?=Yii::app()->user->id?>/<?=$data->picture?>" alt="" /></a>
                <?php else: ?>
                    <a href="/my/avto/update/id/<?=$data->id?>"><img src="/img/zaglushka.png" alt="" /></a>
                <?php endif; ?>
                <input class="default-input__radio__style__vertical" type="radio"<?=$data->class=='econom'?' checked':''?> id="text1" name="" readonly="true" />
                <label for="text">Эконом</label>
                <input class="default-input__radio__style__vertical" type="radio"<?=$data->class=='premium'?' checked':''?> id="text2" name="" readonly="true" />
                <label for="text">Премиум</label>
                <input class="default-input__radio__style__vertical" type="radio"<?=$data->class=='bus'?' checked':''?> id="text3" name="" readonly="true" />
                <label for="text">Автобусы</label>
              </figure>
            </div>
            <div class="col-8 plus__add__auto-park__form-container">
              <a href="/user/<?=$user->id?>" class="cabinet__photo__item-view"></a>
              <a href="/my/avto/update/id/<?=$data->id?>" class="cabinet__photo__item-edit"></a>
              <a href="javascript:void(0)" class="cabinet__photo__item-delete"></a>
              <div class="delete__hidden">
                <div class="delete__hidden-title">Вы уверены что хотите удалить?</div>
                <div class="delete__hidden-yes">ДА</div>
                <div class="delete__hidden-no">нет</div>
              </div>              
              <a href="#"><h4><?=$data->title?></h4></a>
              <div class="col-9 tech__car__info">
                <p><?=$data->year?>,<?=$data->color?></p>
                <p><?=CHtml::encode($data->description)?></p>
              </div>
              <div class="col-3 tech__car__price">
                  <div class="plus__car-price">
                    Стоимость: <br />
                    <span><?=$data->price?> грн/час</span>
                  </div>
            </div>
          </div>
<script>
$('.delete__hidden-yes').click(function(){
    $('.delete__hidden').hide();
    $.ajax({
        url: '/my/avto/delete/id/<?=$data->id?>',          
        type : "get",                     
        success: function (data, textStatus) {
            $('.data_<?=$data->id?>').fadeOut(400);
        }               
    });
});
</script>          