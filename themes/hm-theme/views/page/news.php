<?php
/* @var $this PageController */

$this->breadcrumbs=array(
	'Новости',
);
?>
<div class="container news__list">
    <?php
    if(count($model)>0) {
        foreach($model as $item) {
    ?>
            <section class="news__item">
              <a href="/news/<?=$item->id?>" class="news__img-container"><img src="/upload/<?=$item->foto_main?>" alt="" /></a>
              <article class="news__info-container">
                <a href="/news/<?=$item->id?>" class="news__title"><h3><?=$item->title?></h3></a>
                <div class="news__text-intro">
                  <?=CHtml::decode($item->intro_text)?> 
                </div>
                <a href="/news/<?=$item->id?>" class="news__readmore">подробнее</a>
              </article>
            </section>
    <?php    
        }
    }
    else echo '<h3>Пока новостей нет...</h3>';
    ?>
</div>

