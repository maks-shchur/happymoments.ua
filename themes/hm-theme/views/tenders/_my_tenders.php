<div class="wrapper tender-item">
<div class="full__tender__item clfx">
      <div class="full__tender__response-col">
        <?=$data->ordersCount;?><small>ответов</small>
      </div>
      <div class="full__tender__info">
        <a href="/id<?=$data->user->id;?>" class="full__tender__info__user-name"><?=$data->user->name;?></a>
        <div class="full__tender__item__title">
          <a href="/tenders/<?=$data->id;?>"><h3>Мне нужен: <?php echo Occupation::getName($data->occupation); ?> </h3></a>
        </div>
        <div class="full__tender__item__text">
          <?=CHtml::encode($data->description);?>
        </div>
        <div class="full__tender__item__price">
          <span>Цена:</span><?=CHtml::encode($data->price);?> грн
        </div>
        <div class="full__tender__item__date">
          <i></i><?=Settings::dateFormat($data->date_end);?>
        </div>
        <div class="full__tender__item__time">
          <i></i>осталось: <?=Settings::getTimer($data->date_end)<0 ? '0 дн.' : Settings::getTimer($data->date_end);?>
        </div>
        <?php
        if($data->ordersCount > 0): 
        ?>
        <div class="tender__reply__list clfx">
            <?php
                foreach($data->orders as $item) {
                    echo Settings::smallAva($item->uid);
                }
            ?>
        
            <?php
            if($data->ordersCount > 10):
            ?>
                <a href="#" class="tender__reply__all">все ответы</a>
            <?php endif; ?>
        </div>
        <?php
        endif;
        ?>
    </div>
</div>
</div>