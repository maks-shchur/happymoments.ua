<?php
$this->breadcrumbs=array(
	'Пользователи',
	$user->name,
);
?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/min/jquery.fancybox.pack.js'); ?>
<div class="wrapper accaunt-main__gallery">
<div class="container">
    <h2><a href="/id<?=$user->id?>" class="portfolio_link_top"><?=$user->name?></a> - Портфолио</h2>
    <div id="listView">
    <?php     //echo $dataProvider->ItemCount%3; ?>
    <?php $this->widget('zii.widgets.CListView', array(
            	'dataProvider'=>$dataProvider,
            	'itemView'=>'_album_videos',
                'viewData' => array('uid' => $user->id),
                'ajaxUpdate'=>false,
                'template' => "{items}",
            )); ?>
    <?php 
    if($dataProvider->totalItemCount<=$dataProvider->pagination->pageSize) {
        if($dataProvider->ItemCount!=3 && $dataProvider->ItemCount%3!=0) {
            for($i=1;$i<=(3-round($dataProvider->ItemCount%3,2));$i++) {
            //for($i=1;$i<=$dataProvider->ItemCount%3;$i++) {
                if($i==(3-round($dataProvider->ItemCount%3,2))) $st=' style="margin-right:0px !important;"';
                else $st='';
            ?>
            <figure class="accaunt-gallery__thumbnail"<?=$st;?>>
                  <img src="/img/zaglushka_video.png" />
            </figure>
            <?php    
            }
        }
    }
    ?>
    </div>
    <?php if ($dataProvider->totalItemCount > $dataProvider->pagination->pageSize): ?>
     
        <p id="loading" style="display:none"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/loading.gif" alt="" /></p>
        <div class="wrapper wrapper-see-more">
           <a id="showMore" class="see-more" href="#">Смотреть еще</a>
        </div>    
     
        <script type="text/javascript">
        /*<![CDATA[*/
            (function($)
            {
                // скрываем стандартный навигатор
                $('.paginator').hide();
     
                // запоминаем текущую страницу и их максимальное количество
                var page = parseInt('<?php echo (int)Yii::app()->request->getParam('page', 1); ?>');
                var pageCount = parseInt('<?php echo (int)$dataProvider->pagination->pageCount; ?>');
     
                var loadingFlag = false;
     
                $('#showMore').click(function()
                {
                    // защита от повторных нажатий
                    if (!loadingFlag)
                    {
                        // выставляем блокировку
                        loadingFlag = true;
     
                        // отображаем анимацию загрузки
                        $('#loading').show();
     
                        $.ajax({
                            type: 'post',
                            url: window.location.href,
                            data: {
                                // передаём номер нужной страницы методом POST
                                'page': page + 1,
                                '<?php echo Yii::app()->request->csrfTokenName; ?>': '<?php echo Yii::app()->request->csrfToken; ?>'
                            },
                            success: function(data)
                            {
                                // увеличиваем номер текущей страницы и снимаем блокировку
                                page++;                            
                                loadingFlag = false;                            
     
                                // прячем анимацию загрузки
                                $('#loading').hide();
     
                                // вставляем полученные записи после имеющихся в наш блок
                                $('#listView').append(data);
     
                                // если достигли максимальной страницы, то прячем кнопку
                                if (page >= pageCount)
                                    $('#showMore').hide();
                            }
                        });
                    }
                    return false;
                })
            })(jQuery);
        /*]]>*/
        </script>
     
    <?php endif; ?>
</div>
</div>