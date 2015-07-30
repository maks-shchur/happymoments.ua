<?php
/* @var $this ActionsController */
/* @var $data Actions */

$new_price=$data->price - round($data->price*$data->sale/100);
?>

<div class="col-12 cabinet-pro__action__item clfx" id="data_<?=$data->id?>">
            <div class="col-4">
              <a href="#"><figure class="cabinet-pro__banner">
                <?php
                if($data->picture!=''):
                ?>
                <img src="/users/<?=Yii::app()->user->id?>/304_<?=$data->picture?>" alt="" />
                <?php else: ?>
                <img src="/img/zaglushka.png" alt="" />
                <?php endif; ?>
              <div class="action__thumbnail-discount">- <?=$data->sale?>%</div>
                <figcaption class="accaunt-gallery__thumbnail-overlay">
                    до <?=Settings::dateFormat($data->date_end)?>
                </figcaption>
              </figure></a>
            </div>
            <div class="col-8 pro__action__item__text">
                <a href="/actions/<?=$data->id?>" class="cabinet__photo__item-view" style="top: 0px;"></a>
                <a href="/my/actions/update/id/<?=$data->id?>" class="cabinet__photo__item-edit" style="top: 0px;"></a>
                <a href="javascript:void(0)" class="cabinet__photo__item-delete" style="top: 0px;"></a>
                  <div class="delete__hidden">
                    <div class="delete__hidden-title">Вы уверены что хотите удалить?</div>
                    <div class="delete__hidden-yes" id="<?=$data->id?>">ДА</div>
                    <div class="delete__hidden-no">нет</div>
                  </div>
                <a href="/my/actions/<?=$data->id?>"><h3><?=$data->title?></h3></a>
                <div class="col-12">
                    <div class="col-9" style="top: -25px;">
                        <?php if(strlen($data->description)>200): ?>
                        <p class="first-text"><?=mb_substr($data->description,0,200).'...'?></p>
                        <?php else: ?>
                        <p class="first-text"><?=CHtml::encode($data->description)?></p>
                        <?php endif; ?>
                    </div>
                    <div class="col-3" style="vertical-align: top;padding-left: 30px;">
                        <div class="action__open__table__price"><?=$new_price?> грн</div>
                        <div class="action__open__table__old-price"><?=$data->price?> грн</div>
                    </div>
                </div>
            </div>
          
<script>
$('#<?=$data->id?>').click(function(){
    $('.delete__hidden').hide();
    $.ajax({
        url: '/my/actions/delete/id/<?=$data->id?>',          
        type : "get",                     
        success: function (data, textStatus) {
            $('#data_<?=$data->id?>').fadeOut(400);
        }               
    });
});
</script>
</div>          