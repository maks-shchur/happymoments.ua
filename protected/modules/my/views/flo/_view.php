<?php
/* @var $this FloController */
/* @var $data Flo */
?>

<div class="data_<?=$data->id?>">
<div class="cabinet-pro__quipment__item cabinet-pro__quipment__item-1 clfx">
    <figure class="edit__equipment__item__img">
      <div class="edit__equipment__item__img-cont">
        <?php
        if($data->picture!=''):
        ?>
        <img src="/users/<?=Yii::app()->user->id?>/<?=$data->picture?>" alt="" />
        <?php else: ?>
        <img src="/img/zaglushka.png" alt="" />
        <?php endif; ?>
      </div>
    </figure>
    <div class="edit__equipment__item__info">
      <a href="/user/<?=Yii::app()->user->id?>" class="cabinet__photo__item-view"></a>
      <a href="/my/flo/update/id/<?=$data->id?>" class="cabinet__photo__item-edit"></a>
      <a href="javascript:void(0)" class="cabinet__photo__item-delete"></a>
      <div class="delete__hidden">
        <div class="delete__hidden-title">Вы уверены что хотите удалить?</div>
        <div class="delete__hidden-yes" id="<?=$data->id?>">ДА</div>
        <div class="delete__hidden-no">нет</div>
      </div>
      <a href="#"><h3><?=$data->title?></h3></a>
      <div class="nano" style="height: 220px;width: 80%;">
        <p class="nano-content" style="padding-right: 30px;"><?=CHtml::encode($data->description)?></p>
      </div>
      <div class="flo__price_profile"><?=$data->price?> грн</div>
    </div>
</div>
</div>
<script>
$('#<?=$data->id?>').click(function(){
    $('.delete__hidden').hide();
    $.ajax({
        url: '/my/flo/delete/id/<?=$data->id?>',          
        type : "get",                     
        success: function (data, textStatus) {
            $('.data_<?=$data->id?>').fadeOut(400);
        }               
    });
});
</script>