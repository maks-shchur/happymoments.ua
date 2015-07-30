<?php
$str=parse_url($data->file);
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
        <!--img src="http://img.youtube.com/vi/<?=$code?>/0.jpg" border="0" width="370" height="218" /-->
        <img src="/users/<?=$uid?>/video_<?=$code?>.jpg" border="0" width="370" height="218" />
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
        <!--img src="<?=$image?>" border="0" width="370" height="218" /-->
        <img src="/users/<?=$uid?>/video_<?=$code?>.jpg" border="0" width="370" height="218" />
    </a>
</figure>
<?php
}
?>