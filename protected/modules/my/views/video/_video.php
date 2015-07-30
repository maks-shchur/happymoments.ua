<?php
$str=parse_url($data->file);
//print_r($str); 
$path=explode('/',$str['path']);
if($str['host']=='youtu.be' || $str['host']=='www.youtube.com') {
    if($str['host']=='youtu.be') {
        $code=$path[1];    
    }
    elseif($str['host']=='www.youtube.com') {
        $code=substr($str['query'], 2, 20);    
    }
    
    
    $top=View::model()->findByAttributes(array('uid'=>Yii::app()->user->id,'photo'=>'video_'.$code.'.jpg'));
    if(is_object($top)) {
        if($top->photo=='video_'.$code.'.jpg') {$class='cabinet__video__item-selected'; $del='yes';}
        else {$class='cabinet__photo__item-select'; $del='no';}
    }
    else {$class='cabinet__video__item-select'; $del='no';}
?>
<figure class="cabinet__video__item data_<?=$data->id?>">
    <a class="show_video" href="http://www.youtube.com/embed/<?=$code?>">
        <!--img src="http://img.youtube.com/vi/<?=$code?>/0.jpg" border="0" /-->
        <img src="/users/<?=$data->uid?>/video_<?=$code?>.jpg" border="0" width="300" height="190" />
    </a>
    <span class="<?=$class?>" id="on_top-<?=$data->id?>" data-del="<?=$del?>" data-atr="video_<?=$code?>.jpg" title="видео на главную"></span>
    <a href="/my/files/visible/id/<?=$data->id?>?back=<?=Yii::app()->request->requestUri?>" class="cabinet__photo__item-view"></a>
    <a href="javascript:void(0)" class="message__item-delete_photo"><span class="cabinet__photo__item-delete"></span></a>
            <div class="delete__hidden">
                <div class="delete__hidden-title">Вы уверены что хотите удалить?</div>
                <div class="delete__hidden-yes" id="<?=$data->id?>">ДА</div>
                <div class="delete__hidden-no">нет</div>
            </div>
    <?php
          if($data->visible==0): 
          ?>
          <div class="cabinet__photo__item__hidden">
            ВИДЕО СКРЫТО<br>
            для пользователей
          </div>
    <?php endif; ?>     
<script>
$('#<?=$data->id?>').click(function(){
    $('.delete__hidden').hide();
    $.ajax({
        url: '/my/files/delete/id/<?=$data->id.'?back_url='.Yii::app()->request->requestUri?>',          
        type : "get",                     
        success: function (data, textStatus) {
            $('.data_<?=$data->id?>').fadeOut(400);
        }               
    });
});
$('#on_top-<?=$data->id?>').click(function(){
    $('.loader').css('display','block');
    var arg=$('#on_top-<?=$data->id?>').attr('data-atr');
    if($('#on_top-<?=$data->id?>').attr('data-del')=='no') {
        $.ajax({
            url: '/my/view/add',          
            type : "post",
            data : {img: arg},                     
            success: function (data, textStatus) {
                $('.loader').css('display','none');
                $('#on_top-<?=$data->id?>').removeClass('cabinet__video__item-select');
                $('#on_top-<?=$data->id?>').addClass('cabinet__video__item-selected');
                $('#on_top-<?=$data->id?>').attr('data-del','yes');
            }               
        });
    }
    if($('#on_top-<?=$data->id?>').attr('data-del')=='yes') {
        $.ajax({
            url: '/my/view/delete',          
            type : "post",
            data : {img: arg},                     
            success: function (data, textStatus) {
                $('.loader').css('display','none');
                $('#on_top-<?=$data->id?>').removeClass('cabinet__video__item-selected');
                $('#on_top-<?=$data->id?>').addClass('cabinet__video__item-select');
                $('#on_top-<?=$data->id?>').attr('data-del','no');
            }               
        });
    }
});
</script>
</figure>
<?php    
}
elseif($str['host']=='vimeo.com') {
    if(isset($path[3]))
        $code=$path[3];
    else        
        $code=$path[1];
    
    if ($xml = simplexml_load_file('http://vimeo.com/api/v2/video/'.$code.'.xml')) {
		//$image = $xml->video->thumbnail_large ? (string) $xml->video->thumbnail_large: (string) $xml->video->thumbnail_medium;
        $image = $xml->video->thumbnail_medium;
	}
    
    $top=View::model()->findByAttributes(array('uid'=>Yii::app()->user->id,'photo'=>'video_'.$code.'.jpg'));
    if(is_object($top)) {
        if($top->photo=='video_'.$code.'.jpg') {$class='cabinet__video__item-selected'; $del='yes';}
        else {$class='cabinet__photo__item-select'; $del='no';}
    }
    else {$class='cabinet__video__item-select'; $del='no';}
?>
<figure class="cabinet__video__item data_<?=$data->id?>">
    <a class="show_video" href="//player.vimeo.com/video/<?=$code?>?badge=0">
        <!--img src="<?=$image?>" border="0" /-->
        <img src="/users/<?=$data->uid?>/video_<?=$code?>.jpg" border="0" width="300" height="190" />
    </a>
    <span class="<?=$class?>" id="on_top-<?=$data->id?>" data-del="<?=$del?>" data-atr="video_<?=$code?>.jpg" title="видео на главную"></span>
    <a href="/my/files/visible/id/<?=$data->id?>?back=<?=Yii::app()->request->requestUri?>" class="cabinet__photo__item-view"></a>
    <a href="javascript:void(0)" class="message__item-delete_photo"><span class="cabinet__photo__item-delete"></span></a>
            <div class="delete__hidden">
                <div class="delete__hidden-title">Вы уверены что хотите удалить?</div>
                <div class="delete__hidden-yes" id="<?=$data->id?>">ДА</div>
                <div class="delete__hidden-no">нет</div>
            </div>
    <?php
          if($data->visible==0): 
          ?>
          <div class="cabinet__photo__item__hidden">
            ВИДЕО СКРЫТО<br>
            для пользователей
          </div>
    <?php endif; ?>     
<script>
$('#<?=$data->id?>').click(function(){
    $('.delete__hidden').hide();
    $.ajax({
        url: '/my/files/delete/id/<?=$data->id.'?back_url='.Yii::app()->request->requestUri?>',          
        type : "get",                     
        success: function (data, textStatus) {
            $('.data_<?=$data->id?>').fadeOut(400);
        }               
    });
});
$('#on_top-<?=$data->id?>').click(function(){
    $('.loader').css('display','block');
    var arg=$('#on_top-<?=$data->id?>').attr('data-atr');
    if($('#on_top-<?=$data->id?>').attr('data-del')=='no') {
        $.ajax({
            url: '/my/view/add',          
            type : "post",
            data : {img: arg},                     
            success: function (data, textStatus) {
                $('.loader').css('display','none');
                $('#on_top-<?=$data->id?>').removeClass('cabinet__video__item-select');
                $('#on_top-<?=$data->id?>').addClass('cabinet__video__item-selected');
                $('#on_top-<?=$data->id?>').attr('data-del','yes');
            }               
        });
    }
    if($('#on_top-<?=$data->id?>').attr('data-del')=='yes') {
        $.ajax({
            url: '/my/view/delete',          
            type : "post",
            data : {img: arg},                     
            success: function (data, textStatus) {
                $('.loader').css('display','none');
                $('#on_top-<?=$data->id?>').removeClass('cabinet__video__item-selected');
                $('#on_top-<?=$data->id?>').addClass('cabinet__video__item-select');
                $('#on_top-<?=$data->id?>').attr('data-del','no');
            }               
        });
    }
});
</script>
</figure>
<?php    
}
?>

