<?php
$this->widget('application.extensions.tooltipster.tooltipster',
          array(
            'identifier'=>'#show_tooltip',
            //'onlyOne'=>'false',
            'options'=>array(
                'position'=>'bottom',
            )
));

foreach($model as $item) {
    $c=Portfolio::model()->findByPk($item->portfolio_id);
    
    if($c->picture==$item->file) $chk='checked';
    else $chk='';
?>
    <div class="data_<?=$item->id?>">
        <figure class="cabinet__photo__item2">
            <a href="/users/<?=Yii::app()->user->id?>/<?=$item->file?>" rel="gallery1" class="photo__zoom">
                <img src="/users/<?=Yii::app()->user->id?>/370_<?=$item->file?>" alt="">
            </a>
            <!--a href="#" class="cabinet__photo__item-selected"></a-->
            <a href="/my/files/visible/id/<?=$item->id?>?back=<?=Yii::app()->request->requestUri?>" class="cabinet__photo__item-view"></a>
            <a href="javascript:void(0)" class="message__item-delete_photo"><span class="cabinet__photo__item-delete"></span></a>
            <div class="delete__hidden">
                <div class="delete__hidden-title">Вы уверены что хотите удалить?</div>
                <div class="delete__hidden-yes" id="<?=$item->id?>">ДА</div>
                <div class="delete__hidden-no">нет</div>
            </div>
             
           
            <figcaption class="accaunt-gallery__thumbnail-overlay2">
              <a href="#" class="__crop-img" data-crop="<?=$item->id?>">
                Кадрирование фото
              </a>
            </figcaption>
            <?php
                  if($item->visible==0): 
                  ?>
                  <div class="cabinet__photo__item__hidden">
                    ФОТО СКРЫТО<br>
                    для пользователей
                  </div>
            <?php endif; ?>
            
            <input type="radio" class="default-input__radio__style__vertical" id="add-on-cover_<?=$item->id?>" name="cover" <?=$chk?> value="<?=$item->portfolio_id?>__<?=$item->file?>" />
            <label class="remember" for="add-on-cover_<?=$item->id?>">Обложка альбома</label>
                
        </figure>   
        
    
<!-- Кадрирование -->
<div class="modal fade" id="__crop-img-<?=$item->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog--crop">
    <div class="crop-content clfx">
      <div class="crop-img">
        <div align="center">
            <img src="/users/<?=Yii::app()->user->id?>/<?=$item->file?>" alt="" id="target-<?=$item->id?>" alt="[Кадрирование]">
        </div>
      </div>
      <div class="col-12 text_center">
            <div class="btn__group clfx">
                <div class="col-179">
                    <button type="clear" class="cabinet__profile__btn" data-dismiss="modal">ОТМЕНА</button>
                </div>
                <div class="col-179">
                    <input type="hidden" name="img" value="/users/<?=Yii::app()->user->id?>/<?=$item->file?>" />
                    <input type="hidden" name="img_name" value="<?=$item->file?>" />
                    <input type="hidden" id="x_<?=$item->id?>" name="x" />
        			<input type="hidden" id="y_<?=$item->id?>" name="y" />
        			<input type="hidden" id="w_<?=$item->id?>" name="w" />
        			<input type="hidden" id="h_<?=$item->id?>" name="h" />
                    <input type="hidden" name="back" value="<?=Yii::app()->request->requestUri?>" />
                    <button type="button" id="crop-<?=$item->id?>" class="cabinet__profile__btn cabinet__profile__btn-submit">СОХРАНИТЬ</button>   
                </div>
            </div>
        </div>  
    </div>   
  </div>
</div>   


<script>
$('#<?=$item->id?>').click(function(){
    $('.delete__hidden').hide();
    $.ajax({
        url: '/my/files/delete/id/<?=$item->id.'?back_url='.Yii::app()->request->requestUri?>',          
        type : "get",                     
        success: function (data, textStatus) {
            $('.data_<?=$item->id?>').fadeOut(400);
        }               
    });
});
$('#crop-<?=$item->id?>').click(function(){
    $.ajax({
        url: '/my/files/crop',          
        type : "post",
        data : {
            x : $('#x_<?=$item->id?>').val(),
            y : $('#y_<?=$item->id?>').val(),
            w : $('#w_<?=$item->id?>').val(),
            h : $('#h_<?=$item->id?>').val(),
            back : "<?=Yii::app()->request->requestUri?>",
            img_name : "<?=$item->file?>",
            img : "/users/<?=Yii::app()->user->id?>/<?=$item->file?>"
        },                     
        success: function (data, textStatus) {
            window.location.reload();
        }               
    });
});
</script>  
</div>   
<?php
}
?>
