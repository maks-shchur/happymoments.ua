<div class="tender__proposal__item clfx">
      <div class="col-1 tender__proposal__item__img">
        <a href="/id<?=$user->id;?>">
            <figure>
            <?php
            if($user->photo!='' && is_file('./users/'.$user->id.'/'.$user->photo)):
            ?>
            <img src="/users/<?=$user->id?>/<?=$user->photo?>" alt="" />
            <?php else: ?>
            <img src="/img/zaglushka.png" alt="" />
            <?php endif; ?>
            </figure>
        </a>
      </div>
      <div class="col-9 tender__proposal__item__info">
        <a href="/id<?=$user->id;?>">
          <h6><?=$user->name;?></h6>
        </a>
        <time style="float: right; padding-right: 30px;"><?=$model->time_ans;?>&nbsp;&nbsp;&nbsp;<?=Settings::dateFormat($model->date_ans);?></time>
        <p><?=CHtml::encode($model->description);?></p>
      
        <?php
        $gal=Files::model()->findAllByAttributes(array('uid'=>$user->id,'type'=>'photo'),array('limit'=>'8'));
        if(count($gal)>0) {
            echo '<ul class="tender__proposal__item__info__gal clfx">';
            foreach($gal as $photo) {
                if(!is_file($_SERVER['DOCUMENT_ROOT'] . '/users/'.$photo->uid.'/83_'.$photo->file))
                {
                    $ih=new CImageHandler();
                    $ih
                        ->load($_SERVER['DOCUMENT_ROOT'] . '/users/'.$photo->uid.'/'.$photo->file) 
                        ->adaptiveThumb(83,83)                   
                        ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.$photo->uid.'/83_'.$photo->file);
                }
                            
                echo '<li class="tender__proposal__item__info__gal__item"><a href="/id'.$photo->uid.'"><img src="/users/'.$photo->uid.'/83_'.$photo->file.'" alt=""></a></li>';
            }
            echo '</ul>';
        }
        ?>
      
      </div>
      <div class="col-2 tender__proposal__item__contacts">
        <ul class="accaunt-contacts__list">
                      <li class="accaunt-contacts__item accaunt-tel"><span class="accaunt-contacts__link" id="phone_<?=$user->id?>" data-phone="<?=$user->id?>" onclick="getPhone(<?=$user->id?>)">+38 показать номер</span></li><div id="res_<?=$user->id?>"></div>
                      <?php if($user->skype!=''): ?>
                      <li class="accaunt-contacts__item accaunt-skype"><a href="skype:<?=$user->skype;?>?call" class="accaunt-contacts__link"><?=$user->skype;?></a></li>
                      <?php endif; ?>
                      <li class="accaunt-contacts__item accaunt-email"><a href="mailto:<?=$user->email;?>" class="accaunt-contacts__link"><?=$user->email;?></a></li>
                      <?php if($user->url!=''): ?>
                      <li class="accaunt-contacts__item accaunt-site"><a href="http://<?=$user->url;?>" target="_blank" class="accaunt-contacts__link"><?=$user->url;?></a></li>
                      <?php endif; ?>
                    </ul>
      </div>
</div>