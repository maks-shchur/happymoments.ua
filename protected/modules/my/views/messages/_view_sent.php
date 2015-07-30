<?php
/* @var $this MessagesController */
/* @var $data Messages */

$usr=Users::model()->findByAttributes(array('id'=>$data->to_uid));
?>

<div class="data_<?=$data->id?>">
<table class="msg__list">
  <tr class="msg__item">
    <td class="msg__item__address">Кому:</td>
    <td class="msg__item__name"><?=CHtml::encode($usr->name);?></td>
    <td class="msg__item__theme">
        <span><?=substr(CHtml::encode(strip_tags($data->msg)),0,100);?> ...</span>
    </td>
    <td class="msg__item__date"><time datetime="<?=CHtml::encode($data->date_send);?>"><?=Messages::getTimeAgo(CHtml::encode($data->date_send));?></time></td>
    <td class="msg__item__delete">
        <a href="javascript:void(0)" class="message__item-delete"><div class="close__btn"></div></a>
          <div class="delete__hidden">
            <div class="delete__hidden-title">Вы уверены что хотите удалить?</div>
            <div class="delete__hidden-yes" id="<?=$data->id?>">ДА</div>
            <div class="delete__hidden-no">нет</div>
          </div>
    </td>
  </tr>
</table>
</div>
<script>
$('#<?=$data->id?>').click(function(){
    $('.delete__hidden').hide();
    $.ajax({
        url: '/my/messages/delete/id/<?=$data->id?>',          
        type : "get",                     
        success: function (data, textStatus) {
            $('.data_<?=$data->id?>').fadeOut(400);
            window.location.href='/my/messages';
        }               
    });
});
</script>