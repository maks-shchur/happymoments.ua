<?php
if($data->videosCount>=4) {
    
    if($data->genre_id!='' || $data->genre_id!='N;')
        $genres=unserialize($data->genre_id);
    $_SESSION['res_']=0; 
    if(!empty($_POST['genre'])) {   
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
              <a href="/id<?=$data->id?>/prices">Стоимость услуг</a>
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
                    
                    echo '<a href="/id'.$data->id.'" class="cat-video-img__link last"><img class="cat-video-img" src="/users/'.$data->id.'/'.$img.'" alt=""></a>';
                }             
            }
            else 
            {
                $i=1;
                foreach($data->videos as $file) {
                    if($file->type=='video' && $file->source='portfolio') {                    
                        if($i==4) {
                            if($file->file!='') {
                                $code='';
                                $str=parse_url($file->file);
                                //print_r($str); 
                                $path=explode('/',$str['path']);
                                if($str['host']=='youtu.be' || $str['host']=='www.youtube.com') {
                                    if($str['host']=='youtu.be') {
                                        $code=$path[1];    
                                    }
                                    elseif($str['host']=='www.youtube.com') {
                                        $code=substr($str['query'], 2, 20);    
                                    }
                                }
                                elseif($str['host']=='vimeo.com') {
                                    if(isset($path[3]))
                                        $code=$path[3];
                                    else        
                                        $code=$path[1];
                                }
                                
                                $img='video_'.$code.'.jpg';
                                
                                echo '<a href="/id'.$data->id.'" class="cat-video-img__link last"><img class="cat-video-img" src="/users/'.$data->id.'/'.$img.'" alt="'.$file->description.'"></a>';
                            } else
                                echo '<a href="/id'.$data->id.'" class="cat-video-img__link last"><img class="cat-video-img" src="/img/zaglushka.png" alt=""></a>';
                        }
                        else {
                            if($file->file!='') {
                                $code='';
                                $str=parse_url($file->file);
                                //print_r($str); 
                                $path=explode('/',$str['path']);
                                if($str['host']=='youtu.be' || $str['host']=='www.youtube.com') {
                                    if($str['host']=='youtu.be') {
                                        $code=$path[1];    
                                    }
                                    elseif($str['host']=='www.youtube.com') {
                                        $code=substr($str['query'], 2, 20);    
                                    }
                                }
                                elseif($str['host']=='vimeo.com') {
                                    if(isset($path[3]))
                                        $code=$path[3];
                                    else        
                                        $code=$path[1];
                                }
                                
                                $img='video_'.$code.'.jpg';
                                
                                echo '<a href="/id'.$data->id.'" class="cat-video-img__link"><img class="cat-video-img" src="/users/'.$data->id.'/'.$img.'" alt="'.$file->description.'"></a>';
                            } else
                                echo '<a href="/id'.$data->id.'" class="cat-video-img__link"><img class="cat-video-img" src="/img/zaglushka.png" alt=""></a>';
                        }
                        $i++;
                    }
                }
            }
            if($i<=4) {
                while($i<=4) {
                    if($i==4)
                        echo '<a href="/id'.$data->id.'" class="cat-video-img__link last"><img class="cat-video-img" src="/img/zaglushka.png" alt=""></a>';
                    else
                        echo '<a href="/id'.$data->id.'" class="cat-video-img__link"><img class="cat-video-img" src="/img/zaglushka.png" alt=""></a>';                    
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
              <a href="/id<?=$data->id?>/prices">Стоимость услуг</a>
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
                    
                    echo '<a href="/id'.$data->id.'" class="cat-video-img__link last"><img class="cat-video-img" src="/users/'.$data->id.'/'.$img.'" alt=""></a>';
                }             
            }
            else 
            {
                $i=1;
                foreach($data->videos as $file) {
                    if($file->type=='video' && $file->source='portfolio') {                    
                        if($i==4) {
                            if($file->file!='') {
                                $code='';
                                $str=parse_url($file->file);
                                //print_r($str); 
                                $path=explode('/',$str['path']);
                                if($str['host']=='youtu.be' || $str['host']=='www.youtube.com') {
                                    if($str['host']=='youtu.be') {
                                        $code=$path[1];    
                                    }
                                    elseif($str['host']=='www.youtube.com') {
                                        $code=substr($str['query'], 2, 20);    
                                    }
                                }
                                elseif($str['host']=='vimeo.com') {
                                    if(isset($path[3]))
                                        $code=$path[3];
                                    else        
                                        $code=$path[1];
                                }
                                
                                $img='video_'.$code.'.jpg';
                                
                                echo '<a href="/id'.$data->id.'" class="cat-video-img__link last"><img class="cat-video-img" src="/users/'.$data->id.'/'.$img.'" alt="'.$file->description.'"></a>';
                            } else
                                echo '<a href="/id'.$data->id.'" class="cat-video-img__link last"><img class="cat-video-img" src="/img/zaglushka.png" alt=""></a>';
                        }
                        else {
                            if($file->file!='') {
                                $code='';
                                $str=parse_url($file->file);
                                //print_r($str); 
                                $path=explode('/',$str['path']);
                                if($str['host']=='youtu.be' || $str['host']=='www.youtube.com') {
                                    if($str['host']=='youtu.be') {
                                        $code=$path[1];    
                                    }
                                    elseif($str['host']=='www.youtube.com') {
                                        $code=substr($str['query'], 2, 20);    
                                    }
                                }
                                elseif($str['host']=='vimeo.com') {
                                    if(isset($path[3]))
                                        $code=$path[3];
                                    else        
                                        $code=$path[1];
                                }
                                
                                $img='video_'.$code.'.jpg';
                                
                                echo '<a href="/id'.$data->id.'" class="cat-video-img__link"><img class="cat-video-img" src="/users/'.$data->id.'/'.$img.'" alt="'.$file->description.'"></a>';
                            } else
                                echo '<a href="/id'.$data->id.'" class="cat-video-img__link"><img class="cat-video-img" src="/img/zaglushka.png" alt=""></a>';
                        }
                        $i++;
                    }
                }
            }
            if($i<=4) {
                while($i<=4) {
                    if($i==4)
                        echo '<a href="/id'.$data->id.'" class="cat-video-img__link last"><img class="cat-video-img" src="/img/zaglushka.png" alt=""></a>';
                    else
                        echo '<a href="/id'.$data->id.'" class="cat-video-img__link"><img class="cat-video-img" src="/img/zaglushka.png" alt=""></a>';                    
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
              <a href="/id<?=$data->id?>/prices">Стоимость услуг</a>
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
                    
                    echo '<a href="/id'.$data->id.'" class="cat-video-img__link last"><img class="cat-video-img" src="/users/'.$data->id.'/'.$img.'" alt=""></a>';
                }             
            }
            else 
            {
                $i=1;
                foreach($data->videos as $file) {
                    if($file->type=='video' && $file->source='portfolio') {                    
                        if($i==4) {
                            if($file->file!='') {
                                $code='';
                                $str=parse_url($file->file);
                                //print_r($str); 
                                $path=explode('/',$str['path']);
                                if($str['host']=='youtu.be' || $str['host']=='www.youtube.com') {
                                    if($str['host']=='youtu.be') {
                                        $code=$path[1];    
                                    }
                                    elseif($str['host']=='www.youtube.com') {
                                        $code=substr($str['query'], 2, 20);    
                                    }
                                }
                                elseif($str['host']=='vimeo.com') {
                                    if(isset($path[3]))
                                        $code=$path[3];
                                    else        
                                        $code=$path[1];
                                }
                                
                                $img='video_'.$code.'.jpg';
                                
                                echo '<a href="/id'.$data->id.'" class="cat-video-img__link last"><img class="cat-video-img" src="/users/'.$data->id.'/'.$img.'" alt="'.$file->description.'"></a>';
                            } else
                                echo '<a href="/id'.$data->id.'" class="cat-video-img__link last"><img class="cat-video-img" src="/img/zaglushka.png" alt=""></a>';
                        }
                        else {
                            if($file->file!='') {
                                $code='';
                                $str=parse_url($file->file);
                                //print_r($str); 
                                $path=explode('/',$str['path']);
                                if($str['host']=='youtu.be' || $str['host']=='www.youtube.com') {
                                    if($str['host']=='youtu.be') {
                                        $code=$path[1];    
                                    }
                                    elseif($str['host']=='www.youtube.com') {
                                        $code=substr($str['query'], 2, 20);    
                                    }
                                }
                                elseif($str['host']=='vimeo.com') {
                                    if(isset($path[3]))
                                        $code=$path[3];
                                    else        
                                        $code=$path[1];
                                }
                                
                                $img='video_'.$code.'.jpg';
                                
                                echo '<a href="/id'.$data->id.'" class="cat-video-img__link"><img class="cat-video-img" src="/users/'.$data->id.'/'.$img.'" alt="'.$file->description.'"></a>';
                            } else
                                echo '<a href="/id'.$data->id.'" class="cat-video-img__link"><img class="cat-video-img" src="/img/zaglushka.png" alt=""></a>';
                        }
                        $i++;
                    }
                }
            }
            if($i<=4) {
                while($i<=4) {
                    if($i==4)
                        echo '<a href="/id'.$data->id.'" class="cat-video-img__link last"><img class="cat-video-img" src="/img/zaglushka.png" alt=""></a>';
                    else
                        echo '<a href="/id'.$data->id.'" class="cat-video-img__link"><img class="cat-video-img" src="/img/zaglushka.png" alt=""></a>';                    
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