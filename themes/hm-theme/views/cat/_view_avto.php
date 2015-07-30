<?php
//print_r($data); exit();
if($data->avto[0]->picture!='') {
?>    
    <section class="wrapper photo-item">
      <div class="container">
        <div class="cat-item-header">
          <a href="/id<?=$data->id?>"><h4 class="cat-item-user"><?=$data->name?></h4></a>
          <div class="cat-item-accaunt <?=$data->member_type?>"><?=$data->member_type?></div>
          <div class="cat__city_user">г. <?=City::getName($data->city_id)?></div>
          <!--div class="cat-item-rating">9,5</div-->
        </div>
        <div class="cat-item-price-top">
          <div class="cat-item-price-big car__price"><?=$data->avto[0]->price?> <span>грн/час</span></div>
          
          </div>
        <div class="clfx"></div>
        <div class="category-car__item clfx">
          <a href="/id<?=$data->id?>" class="category-car__img">
            <img src="/users/<?=$data->id?>/<?=$data->avto[0]->picture?>" alt="" />
            <figcaption class="accaunt-gallery__thumbnail-overlay">
              <?php
              $cnt=Files::model()->findAllByAttributes(array('uid'=>$data->id,'portfolio_id'=>$data->avto[0]->id));
              ?>
              <div class="accaunt-gallery__info-number"><?=count($cnt)?> фотографий</div>
            </figcaption>
          </a>
          
          <div class="category-car__info">
          <a href="/id<?=$data->id?>"><h3><?=CHtml::encode($data->avto[0]->title)?></h3></a>
            <?=CHtml::encode($data->avto[0]->year)?> год,<br>
            Количество дверей: <?=CHtml::encode($data->avto[0]->doors)?><br>
            Количество мест: <?=CHtml::encode($data->avto[0]->seats)?><br>
            Цвет: <?=CHtml::encode($data->avto[0]->color)?>
          </div>
          <div class="category-car__text">
            <h5>Дополнительные условия:</h5>
            <p>
              Описание услуги: <?=CHtml::encode($data->avto[0]->description)?> 
            </p>
          </div>
        </div>

      </div>
    </section> 
<?php
}
?>   