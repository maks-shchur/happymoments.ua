<?php 
            if(count($portfolio) > 0):
            //$genres=unserialize($model->genre_id);
            $cnt=count($portfolio);

                foreach($portfolio as $item) {

                    if($item->visible!=0) {
                        
                        $str=parse_url($item->file);
                        //print_r($str); 
                        $path=explode('/',$str['path']);
                        if($str['host']=='youtu.be' || $str['host']=='www.youtube.com') {
                            if($str['host']=='youtu.be') {
                                $code=$path[1];    
                            }
                            elseif($str['host']=='www.youtube.com') {
                                $code=substr($str['query'], 2, 20);    
                            }
                        ?>
                        <figure class="accaunt-video__thumbnail">
                            <a class="show_video" href="http://www.youtube.com/embed/<?=$code?>">
                                <img src="http://img.youtube.com/vi/<?=$code?>/0.jpg" border="0" width="370" />
                            </a>
                        </figure>
                        <?php    
                        }
                        elseif($str['host']=='vimeo.com') {
                            if(isset($path[3]))
                                $code=$path[3];
                            else        
                                $code=$path[1];
                            
                            if ($xml = simplexml_load_file('http://vimeo.com/api/v2/video/'.$code.'.xml')) {
                        		//$image = $xml->video->thumbnail_large ? (string) $xml->video->thumbnail_large: (string) $xml->video->thumbnail_medium;
                                $image = $xml->video->thumbnail_medium;
                        	}
                        ?>
                        <figure class="accaunt-video__thumbnail">
                            <a class="show_video" href="//player.vimeo.com/video/<?=$code?>?badge=0">
                                <img src="<?=$image?>" border="0" width="370" />
                            </a>
                        </figure>
                        <?php    
                        }
                    }
                } 
                
                if($cnt<=3) {
                    $c=round($cnt/3,2);
                    $c=abs(round(1-$c,2));
                    $c=$c/0.33;
                } else {
                    $c=round($cnt/3,2);
                    $c=abs(round(1-$c,2));
                    $c=(1-$c)/0.33;    
                }
                for($i=1;$i<=$c;$i++) {
                ?>
                    <figure class="accaunt-video__thumbnail">
                        <img src="/img/zaglushka.png" border="0" width="370" height="277" />
                    </figure>
                <?php    
                }
            endif;
          ?>