<?php
if($data->filesCount>=4) {
    
    if($data->genre_id!='' || $data->genre_id!='N;')
        $genres=unserialize($data->genre_id);
    else $genres=array();
    $_SESSION['res_']=0; 
    if(!empty($_POST['genre'])) { 
        //print_r($genres); exit();
        if(!is_array($genres)) $arr=unserialize($genres);
        else $arr=$genres;
        
        if(in_array($_POST['genre'],$arr))
        {
            if(!empty($_POST['calend']))
            {
                $is_busy=Calendar::model()->countByAttributes(array('uid'=>$data->id, 'day'=>$_POST['calend']));
                if($is_busy<=0) $_SESSION['res_']=$_SESSION['res_']+1;
            }
            //else $_SESSION['res_']=$_SESSION['res_']+1;
            
            $_SESSION['res_']=$_SESSION['res_']+1;
            
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
              <!--div class="cat-item-price-big"><?=$data->price_h?></div> грн/час-->
              <?php
              if($data->occupation_id==17):
              ?>
              <a href="/id<?=$data->id?>?prices">Стоимость услуг</a>
              <?php else: ?>
              <a href="/id<?=$data->id?>/prices">Стоимость услуг</a>
              <?php endif; ?>  
            </div>
            <div class="clfx"></div>
            <?php
            $top=View::model()->countByAttributes(array('uid'=>$data->id));
            if($top>=4) {
                $top=View::model()->findAllBySql('select * from {{view}} where uid='.$data->id.' ORDER BY RAND() limit 4');
                $i=1;
                foreach($top as $file)
                {
                    $img=$file->photo;
                    $link_data = Files::model()->findBySql('select id, portfolio_id from {{files}} where uid='.$data->id.' and type="photo" and source="portfolio" and visible=1 and file="'.$img.'"');
                    $img_link = $this->createUrl('/user/album',array('id'=>$link_data->portfolio_id)).'?photo=photo'.$link_data->id;
                    
                        if($i==4) {
                            if($file->photo!='')
                                //echo '<a href="/id'.$data->id.'" class="cat-photo-img__link last"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                                echo '<a href="'.$img_link.'" class="cat-photo-img__link last"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                            else
                                echo '<a href="/id'.$data->id.'" class="cat-photo-img__link last"><img class="cat-photo-img" src="/img/zaglushka.png" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                        }
                        else {
                            if($file->photo!='')
                                //echo '<a href="/id'.$data->id.'" class="cat-photo-img__link"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                                echo '<a href="'.$img_link.'" class="cat-photo-img__link"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                            else
                                echo '<a href="/id'.$data->id.'" class="cat-photo-img__link"><img class="cat-photo-img" src="/img/zaglushka.png" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                        }
                        $i++;
                }    
            }
            else {
                $i=1;
                foreach($data->files as $file)
                {
                    $img=$file->file;
                    $link_data = Files::model()->findBySql('select id, portfolio_id from {{files}} where uid='.$data->id.' and type="photo" and source="portfolio" and visible=1 and file="'.$img.'"');
                    $img_link = $this->createUrl('/user/album',array('id'=>$link_data->portfolio_id)).'?photo=photo'.$link_data->id;
                    
                    if($file->type=='photo') {
                        if($i==4) {
                            if($file->file!='')
                                //echo '<a href="/id'.$data->id.'" class="cat-photo-img__link last"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                                echo '<a href="'.$img_link.'" class="cat-photo-img__link last"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                            else
                                echo '<a href="/id'.$data->id.'" class="cat-photo-img__link last"><img class="cat-photo-img" src="/img/zaglushka.png" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                        }
                        else {
                            if($file->file!='')
                                //echo '<a href="/id'.$data->id.'" class="cat-photo-img__link"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                                echo '<a href="'.$img_link.'" class="cat-photo-img__link"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                            else
                                echo '<a href="/id'.$data->id.'" class="cat-photo-img__link"><img class="cat-photo-img" src="/img/zaglushka.png" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                        }
                        $i++;
                    }
                }    
            }
            
            if($i<=4) {
                while($i<=4) {
                    if($i==4)
                        echo '<a href="/id'.$data->id.'" class="cat-photo-img__link last"><img class="cat-photo-img" src="/img/zaglushka.png" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                    else
                        echo '<a href="/id'.$data->id.'" class="cat-photo-img__link"><img class="cat-photo-img" src="/img/zaglushka.png" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';                    
                    $i++;
                }
            }
            ?>
          </div>
        </section>
    <?php
        }
        //if($res==0) echo Yii::t('category','No results found.');
    }
    else {
        if(!empty($_POST['calend']))
        {
            $is_busy=Calendar::model()->countByAttributes(array('uid'=>$data->id, 'day'=>$_POST['calend']));
            if($is_busy<=0):
                $_SESSION['res_']=$_SESSION['res_']+1;
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
              <!--div class="cat-item-price-big"><?=$data->price_h?></div> грн/час-->
              <?php
              if($data->occupation_id==17):
              ?>
              <a href="/id<?=$data->id?>?prices">Стоимость услуг</a>
              <?php else: ?>
              <a href="/id<?=$data->id?>/prices">Стоимость услуг</a>
              <?php endif; ?>
            </div>
            <div class="clfx"></div>
            <?php
            $top=View::model()->countByAttributes(array('uid'=>$data->id));
            if($top>=4) {
                $top=View::model()->findAllBySql('select * from {{view}} where uid='.$data->id.' ORDER BY RAND() limit 4');
                $i=1;
                foreach($top as $file)
                {
                    $img=$file->photo;
                    $link_data = Files::model()->findBySql('select id, portfolio_id from {{files}} where uid='.$data->id.' and type="photo" and source="portfolio" and visible=1 and file="'.$img.'"');
                    $img_link = $this->createUrl('/user/album',array('id'=>$link_data->portfolio_id)).'?photo=photo'.$link_data->id;
                    
                        if($i==4) {
                            if($file->photo!='')
                                //echo '<a href="/id'.$data->id.'" class="cat-photo-img__link last"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                                echo '<a href="'.$img_link.'" class="cat-photo-img__link last"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                            else
                                echo '<a href="/id'.$data->id.'" class="cat-photo-img__link last"><img class="cat-photo-img" src="/img/zaglushka.png" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                        }
                        else {
                            if($file->photo!='')
                                //echo '<a href="/id'.$data->id.'" class="cat-photo-img__link"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                                echo '<a href="'.$img_link.'" class="cat-photo-img__link"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                            else
                                echo '<a href="/id'.$data->id.'" class="cat-photo-img__link"><img class="cat-photo-img" src="/img/zaglushka.png" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                        }
                        $i++;
                }    
            }
            else {
                $i=1;
                foreach($data->files as $file)
                {
                    $img=$file->file;
                    $link_data = Files::model()->findBySql('select id, portfolio_id from {{files}} where uid='.$data->id.' and type="photo" and source="portfolio" and visible=1 and file="'.$img.'"');
                    $img_link = $this->createUrl('/user/album',array('id'=>$link_data->portfolio_id)).'?photo=photo'.$link_data->id;
                    
                    if($file->type=='photo') {
                        if($i==4) {
                            if($file->file!='')
                                //echo '<a href="/id'.$data->id.'" class="cat-photo-img__link last"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                                echo '<a href="'.$img_link.'" class="cat-photo-img__link last"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                            else
                                echo '<a href="/id'.$data->id.'" class="cat-photo-img__link last"><img class="cat-photo-img" src="/img/zaglushka.png" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                        }
                        else {
                            if($file->file!='')
                                //echo '<a href="/id'.$data->id.'" class="cat-photo-img__link"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                                echo '<a href="'.$img_link.'" class="cat-photo-img__link"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                            else
                                echo '<a href="/id'.$data->id.'" class="cat-photo-img__link"><img class="cat-photo-img" src="/img/zaglushka.png" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                        }
                        $i++;
                    }
                }    
            }
            if($i<=4) {
                while($i<=4) {
                    if($i==4)
                        echo '<a href="/id'.$data->id.'" class="cat-photo-img__link last"><img class="cat-photo-img" src="/img/zaglushka.png" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                    else
                        echo '<a href="/id'.$data->id.'" class="cat-photo-img__link"><img class="cat-photo-img" src="/img/zaglushka.png" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';                    
                    $i++;
                }
            }
            ?>
          </div>
        </section>
    <?php
            endif; 
            //if($res==0) echo Yii::t('category','No results found.');  
        } 
        else {
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
              <!--div class="cat-item-price-big"><?=$data->price_h?></div> грн/час-->
              <?php
              if($data->occupation_id==17):
              ?>
              <a href="/id<?=$data->id?>?prices">Стоимость услуг</a>
              <?php else: ?>
              <a href="/id<?=$data->id?>/prices">Стоимость услуг</a>
              <?php endif; ?>
            </div>
            <div class="clfx"></div>
            <?php
            $top=View::model()->countByAttributes(array('uid'=>$data->id));
            if($top>=4) {
                $top=View::model()->findAllBySql('select * from {{view}} where uid='.$data->id.' ORDER BY RAND() limit 4');
                $i=1;
                foreach($top as $file)
                {
                    $img=$file->photo;
                    $link_data = Files::model()->findBySql('select id, portfolio_id from {{files}} where uid='.$data->id.' and type="photo" and source="portfolio" and visible=1 and file="'.$img.'"');
                    $img_link = $this->createUrl('/user/album',array('id'=>$link_data->portfolio_id)).'?photo=photo'.$link_data->id;
                    
                        if($i==4) {
                            if($file->photo!='')
                                //echo '<a href="/id'.$data->id.'" class="cat-photo-img__link last"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                                echo '<a href="'.$img_link.'" class="cat-photo-img__link last"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                            else
                                echo '<a href="/id'.$data->id.'" class="cat-photo-img__link last"><img class="cat-photo-img" src="/img/zaglushka.png" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                        }
                        else {
                            if($file->photo!='')
                                //echo '<a href="/id'.$data->id.'" class="cat-photo-img__link"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                                echo '<a href="'.$img_link.'" class="cat-photo-img__link"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                            else
                                echo '<a href="/id'.$data->id.'" class="cat-photo-img__link"><img class="cat-photo-img" src="/img/zaglushka.png" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                        }
                        $i++;
                }    
            }
            else {
                $i=1;
                foreach($data->files as $file)
                {
                    $img=$file->file;
                    $link_data = Files::model()->findBySql('select id, portfolio_id from {{files}} where uid='.$data->id.' and type="photo" and source="portfolio" and visible=1 and file="'.$img.'"');
                    $img_link = $this->createUrl('/user/album',array('id'=>$link_data->portfolio_id)).'?photo=photo'.$link_data->id;
                    
                    if($file->type=='photo') {
                        if($i==4) {
                            if($file->file!='')
                                //echo '<a href="/id'.$data->id.'" class="cat-photo-img__link last"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                                echo '<a href="'.$img_link.'" class="cat-photo-img__link last"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                            else
                                echo '<a href="/id'.$data->id.'" class="cat-photo-img__link last"><img class="cat-photo-img" src="/img/zaglushka.png" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                        }
                        else {
                            if($file->file!='')
                                //echo '<a href="/id'.$data->id.'" class="cat-photo-img__link"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                                echo '<a href="'.$img_link.'" class="cat-photo-img__link"><img class="cat-photo-img" src="/users/'.$data->id.'/370_'.$img.'" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                            else
                                echo '<a href="/id'.$data->id.'" class="cat-photo-img__link"><img class="cat-photo-img" src="/img/zaglushka.png" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                        }
                        $i++;
                    }
                }    
            }
            if($i<=4) {
                while($i<=4) {
                    if($i==4)
                        echo '<a href="/id'.$data->id.'" class="cat-photo-img__link last"><img class="cat-photo-img" src="/img/zaglushka.png" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';
                    else
                        echo '<a href="/id'.$data->id.'" class="cat-photo-img__link"><img class="cat-photo-img" src="/img/zaglushka.png" alt="'.$data->name.' - '.Occupation::getName($data->occupation_id).'"></a>';                    
                    $i++;
                }
            }
            ?>
          </div>
        </section>            
    <?php
        }
    }
    
}
?>