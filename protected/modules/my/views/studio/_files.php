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
    $c=StudioHals::model()->findByPk($item->portfolio_id);
    
    if($c->picture==$item->file) $chk='checked';
    else $chk='';
    
    $top=View::model()->findByAttributes(array('uid'=>Yii::app()->user->id,'photo'=>$item->file));
    if(is_object($top)) {
        if($top->photo==$item->file) {$class='cabinet__photo__item-selected'; $del='yes';}
        else {$class='cabinet__photo__item-select'; $del='no';}
    } else {$class='cabinet__photo__item-select'; $del='no';}
?>
    <div class="data_<?=$item->id?>">
        <figure class="cabinet__photo__item2">
            <a href="/users/<?=Yii::app()->user->id?>/<?=$item->file?>" rel="gallery1" class="photo__zoom">
                <img src="/users/<?=Yii::app()->user->id?>/370_<?=$item->file?>" alt="">
            </a>
            <span class="<?=$class?>" id="on_top-<?=$item->id?>" data-del="<?=$del?>" data-atr="<?=$item->file?>" title="видео на главную"></span>
            <a href="/my/files/visible/id/<?=$item->id?>?back=<?=Yii::app()->request->requestUri?>" class="cabinet__photo__item-view"></a>
            <a href="javascript:void(0)" class="message__item-delete_photo"><span class="cabinet__photo__item-delete"></span></a>
            <div class="delete__hidden">
                <div class="delete__hidden-title">Вы уверены что хотите удалить?</div>
                <div class="delete__hidden-yes" id="<?=$item->id?>">ДА</div>
                <div class="delete__hidden-no">нет</div>
            </div>
             
           
            <!--figcaption class="accaunt-gallery__thumbnail-overlay2">
              <a href="#" class="__crop-img" data-crop="<?=$item->id?>">
                Кадрирование фото
              </a>
            </figcaption-->
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
            <div class="cover__hidden">
                <div class="cover__hidden-title">Установить эту фотографию <br />как обложку альбома?</div>
                <div class="cover__hidden-yes" id="cover_<?=$item->id?>">ДА</div>
                <div class="cover__hidden-no">нет</div>
            </div>    
        </figure>   
        
     


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
$('#add-on-cover_<?=$item->id?>').click(function(){
    $(this).siblings('.cover__hidden').fadeToggle(400);
});
$('.cover__hidden-no').click(function(){
  //$(this).parent().fadeToggle(400);
  $('.loader').css('display','block');
  $(this).parent().hide();
  window.location.reload();
});
$('#cover_<?=$item->id?>').click(function(){
    $('.loader').css('display','block');
    $('.cover__hidden').hide();
    $('#files-form').submit();
});

$('#on_top-<?=$item->id?>').click(function(){
    $('.loader').css('display','block');
    var arg=$('#on_top-<?=$item->id?>').attr('data-atr');
    if($('#on_top-<?=$item->id?>').attr('data-del')=='no') {
        $.ajax({
            url: '/my/view/add',          
            type : "post",
            data : {img: arg},                     
            success: function (data, textStatus) {
                $('.loader').css('display','none');
                $('#on_top-<?=$item->id?>').removeClass('cabinet__photo__item-select');
                $('#on_top-<?=$item->id?>').addClass('cabinet__photo__item-selected');
                $('#on_top-<?=$item->id?>').attr('data-del','yes');
            }               
        });
    }
    if($('#on_top-<?=$item->id?>').attr('data-del')=='yes') {
        $.ajax({
            url: '/my/view/delete',          
            type : "post",
            data : {img: arg},                     
            success: function (data, textStatus) {
                $('.loader').css('display','none');
                $('#on_top-<?=$item->id?>').removeClass('cabinet__photo__item-selected');
                $('#on_top-<?=$item->id?>').addClass('cabinet__photo__item-select');
                $('#on_top-<?=$item->id?>').attr('data-del','no');
            }               
        });
    }
});
</script>  
</div>   
<?php
}
?>
