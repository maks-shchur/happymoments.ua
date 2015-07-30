<script>
$('#content_photo .next_item').click(function(){
   var url = $(this).attr('href');
   //var img = $(this).attr('data-img');

    $.ajax({
        url:     url,
        success: function(data){
            //$('.gallery__zoom').attr('href',img);
            $('#content_photo').html(data);
        }
    });

    // А вот так просто меняется ссылка
    if(url != window.location){
        window.history.pushState(null, null, url);
    }
    
    return false; 
});
</script>
<?php
if($next!=''):
    echo '<a href="'.parse_url(Yii::app()->request->requestUri, PHP_URL_PATH).'?photo=photo'.$next.'" class="next_item">';
endif; 

if(!is_file($_SERVER['DOCUMENT_ROOT'].'/users/'.$user->id.'/940_'.$current))
{
    $ih=new CImageHandler();
    $ih
        ->load($_SERVER['DOCUMENT_ROOT'].'/users/'.$user->id.'/'.$current)                    
        ->resize(940, 680)
        ->save($_SERVER['DOCUMENT_ROOT'] . '/users/'.$user->id.'/940_'.$current);
        
     echo '<img src="/users/'.$user->id.'/940_'.$current.'" alt="'.$user->name.' - Фотограф - '.Portfolio::model()->findByPk(Yii::app()->getRequest()->getParam('id'))->title.'">';
}
else echo '<img src="/users/'.$user->id.'/940_'.$current.'" alt="'.$user->name.' - Фотограф - '.Portfolio::model()->findByPk(Yii::app()->getRequest()->getParam('id'))->title.'">';
  
if($next!=''):
    echo '</a>';
endif;

echo '<a href="/users/'.$user->id.'/'.$current.'" class="gallery__zoom" rel="big" data-img="/users/'.$user->id.'/'.$current.'"></a>';
?>