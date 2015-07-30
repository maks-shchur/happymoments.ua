<?php 
            if(count($portfolio) > 0):
            //$genres=unserialize($model->genre_id);
            $cnt=count($portfolio);

                foreach($portfolio as $item) {

                    if($item->visible!=0) {
                        $cnt++;
                ?>
                <figure class="accaunt-gallery_video__thumbnail">
                  <?php if($item->filesCount>0):?>
                  <a href="/user/videoalbum/id/<?=$item->id;?>" class="accaunt-gallery_video__img">
                  <?php else:?>
                  <a href="" class="accaunt-gallery_video__img">
                  <?php endif;?>
                    <?php if($item->picture!=''): ?>
                    <img src="/users/<?=$model->id;?>/370_<?=$item->picture;?>" alt="<?=$item->description?>" />
                    <?php else: 
                        $pic = Yii::app()->db->createCommand()
                                ->select('file')
                                ->from('{{files}}')
                                ->where('portfolio_id=:id and type="photo" and source="portfolio"', array(':id'=>$item->id))
                                ->order('id desc')
                                ->limit(1)
                                ->queryRow();
                        if(is_array($pic)) echo '<img src="/users/'.$model->id.'/370_'.$pic['file'].'" />';
                        else echo '<img src="/img/zaglushka_video.png" />';
                    endif; ?>
                  </a>
                  <figcaption class="accaunt-gallery_video__thumbnail-overlay">
                    <a href="">
                      <div class="accaunt-gallery__info-container"><?=$item->title;?><?=$item->description!=''?'<br />'.substr($item->description,0,35).'...':'';?><div class="accaunt-gallery__info-number"><?=$item->filesCount;?></div></div>
                    </a>
                  </figcaption>
                </figure>
                <?php 
                    }
                } 
                
                /*if($cnt<=3) {
                    $c=round($cnt/3,2);
                    $c=abs(round(1-$c,2));
                    $c=$c/0.33;
                } else {
                    $c=round($cnt/3,2);
                    $c=abs(round(1-$c,2));
                    $c=(1-$c)/0.33;    
                }*/
                for($i=1;$i<=(3-round($cnt%3,2));$i++) {
                ?>
                <figure class="accaunt-gallery_video__thumbnail">
                  <span href="" class="accaunt-gallery_video__img">
                    <img src="/img/zaglushka_video.png" alt="" />
                  </span>
                </figure>
                <?php    
                }
            endif;
          ?>