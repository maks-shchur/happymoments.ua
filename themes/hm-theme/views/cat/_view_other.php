<?php
//print_r($data); exit();
if(!empty($data->flo)) {
    if($data->flo[0]->picture!='') {
?>    
    <section class="wrapper photo-item">
      <div class="container">
        <div class="cat-item-header">
          <a href="/id<?=$data->id?>"><h4 class="cat-item-user"><?=$data->name?></h4></a>
          <div class="cat-item-accaunt <?=$data->member_type?>"> <?=$data->member_type?></div>
          <div class="cat__city_user">г. <?=City::getName($data->city_id)?></div>
          <!--div class="cat-item-rating">9,5</div-->
        </div>
        <div class="cat-item-price-top">
          <div class="cat-item-price-big"></div> 
          
          </div>
        <div class="clfx"></div>
        <?php
        //print_r($data->flo);
        $i=0;
        foreach($data->flo as $item) {    
            if($i<=4) {
        ?>
            <figure class="flo_figure" onclick="window.location.href='/id<?=$data->id?>'">
              <div class="img-container">
                <?php
                if($item->picture!=''):
                    if(!is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.$data->id.'/280_'.$item->picture)) {
                        $ih=new CImageHandler();
                        $ih
                            ->load($_SERVER['DOCUMENT_ROOT'] . '/users/'.$data->id.'/'.$item->picture)                    
                            ->adaptiveThumb(280, 421)
                            ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.$data->id.'/280_'.$item->picture);
                    }
                ?>
                <img src="/users/<?=$data->id?>/280_<?=$item->picture?>" alt="<?=$data->name?> - <?=Occupation::getName($data->occupation_id)?>" />
                <?php else: ?>
                <img src="/img/zaglushka_other.png" alt="<?=$data->name?> - <?=Occupation::getName($data->occupation_id)?>" />
                <?php endif; ?>
              </div>
              <?php if(!empty($item->price)): ?>
                <div class="flo__price"><span><?=$item->price?></span> грн/час</div>
              <?php endif; ?>
            </figure>
        <?php
            $i++;
            }
        }
        
        if($i<4) {
            while($i<=4) {
        ?>
                <figure class="flo_figure" onclick="window.location.href='/user/<?=$data->id?>'">
                  <div class="img-container">
                    <img src="/img/zaglushka_other.jpg" alt="<?=$data->name?> - <?=Occupation::getName($data->occupation_id)?>" />
                  </div>
                  <!--div class="flo__price"><span></span></div-->
                </figure>      
        <?php
                $i++;
            }    
        }
        
        ?>
      </div>
    </section>
<?php
    }
}
?>    