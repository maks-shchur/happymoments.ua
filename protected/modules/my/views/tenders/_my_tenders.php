            <div class="tender__item data_<?=$data->id?>">
              <div class="col-6 tender__item__title"><h3>Мне нужен: <?php echo Occupation::getName($data->occupation); ?></h3></div>
              <div class="col-6 tender__item__edit-btns">
                <a href="/tenders/view/<?=$data->id;?>" class="cabinet__photo__item-view"></a>
                <a href="/my/tenders/update/id/<?=$data->id;?>" class="cabinet__photo__item-edit"></a>
                <a href="javascript:void(0)" class="cabinet__photo__item-delete"></a>
                  <div class="delete__hidden">
                    <div class="delete__hidden-title">Вы уверены что хотите удалить?</div>
                    <div class="delete__hidden-yes">ДА</div>
                    <div class="delete__hidden-no">нет</div>
                  </div>
              </div>
              <div class="clfx"></div>
              <div class="tender__item__content">
                <div class="tender__item__price">Цена: <?=CHtml::encode($data->price);?>грн.</div>
                <div class="tender__item__text"><?=CHtml::encode($data->description);?></div>
              </div>
              <div class="tender__item__finish-date">
                <span>Дата окончания тендера:</span>
                <time><?=Settings::dateFormat($data->date_end);?></time>
              </div>
              <div class="clfx"></div>
              <?php
              if($data->ordersCount > 0): ?>
              <div class="tender__reply__list clfx">
              <div class="tender__reply__col">Ответов (<?=$data->ordersCount;?>)</div>
                <?php
                foreach($data->orders as $item) {
                    echo Settings::smallAva($item->uid);
                }
                ?>
                
                <?php if($data->ordersCount > 10): ?>
                <a href="#" class="tender__reply__all">все ответы</a>
                <?php endif; ?>
              </div>
              <?php endif; ?>
<script>
$('.delete__hidden-yes').click(function(){
    $('.delete__hidden').hide();
    $.ajax({
        url: '/my/tenders/delete/id/<?=$data->id?>',          
        type : "get",                     
        success: function (data, textStatus) {
            $('.data_<?=$data->id?>').fadeOut(400);
        }               
    });
});
</script>            
            </div>