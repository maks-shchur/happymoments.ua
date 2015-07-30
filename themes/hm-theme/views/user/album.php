<?php
$this->breadcrumbs=array(
	'Пользователи',
	$user->name,
);
?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/min/jquery.fancybox.pack.js'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/fancy.js'); ?>
<div class="wrapper accaunt-main__gallery">
<div class="container">
    <h2>Портфолио</h2>
    <div id="listView">
    <?php
    (3-$dataProvider->ItemCount%3)==1 ? $s=' style="margin-right:0;"' : $s='';
    ?>
    <?php $this->widget('zii.widgets.CListView', array(
            	'dataProvider'=>$dataProvider,
            	'itemView'=>'_album_photos',
                'ajaxUpdate'=>false,
                'template' => "{items}",
            )); ?>
    <?php 
    if($dataProvider->totalItemCount<=$dataProvider->pagination->pageSize) {
        if($dataProvider->ItemCount!=3 && $dataProvider->ItemCount%3!=0) {
            for($i=1;$i<=(3-round($dataProvider->ItemCount%3,2));$i++) {
            ?>
            <figure class="accaunt-gallery__thumbnail"<?=$s?>>
                  <img src="/img/zaglushka.png" width="370" />
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