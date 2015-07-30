<?php
   //print_r($data->tenders); exit();
?>
   
            <div class="tender__item">
              <div class="col-6 tender__item__title"><h3>Мне нужен: <?php echo Occupation::getName($data->tenders->occupation); ?></h3></div>
              <div class="col-6 tender__item__edit-btns">
                <a href="/tenders/view/<?=$data->id;?>" class="cabinet__photo__item-view"></a>
              </div>
              <div class="clfx"></div>
              <div class="tender__item__content">
                <div class="tender__item__price">Цена: <?=CHtml::encode($data->tenders->price);?>грн.</div>
                <div class="tender__item__text"><?=CHtml::encode($data->tenders->description);?></div>
              </div>
              <div class="tender__item__finish-date">
                <span>Дата окончания тендера:</span>
                <time><?=Settings::dateFormat($data->tenders->date_end);?></time>
              </div>
              <div class="clfx"></div>
              <?php
              if($data->tenders->ordersCount > 0): ?>
              <div class="tender__reply__list clfx">
              <div class="tender__reply__col">Ответов (<?=$data->tenders->ordersCount;?>)</div>
                <?php
                foreach($data->tenders->orders as $item) {
                    echo Settings::smallAva($item->uid);
                }
                ?>
                
                <?php if($data->tenders->ordersCount > 10): ?>
                <a href="#" class="tender__reply__all">все ответы</a>
                <?php endif; ?>
              </div>
              <?php endif; ?>
            </div>