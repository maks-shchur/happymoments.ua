<?php
/* @var $this FreefotoController */
/* @var $dataProvider CActiveDataProvider */

?>
<div class="wrapper freefoto">
    <div class="container">
        <div class="col-6">
            <iframe width="100%" height="326" src="//www.youtube.com/embed/mjDXrkRiwIE" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="col-6" style="padding-left: 40px;">
            <div style="display: block; margin-bottom: 20px;">
                <span class="free1">Free</span> <span class="free2">Foto</span>
            </div>
            <div style="display: block; margin-bottom: 20px;">
                <span class="free3">Попали в объектив камеры фотографа на улицах города?<br /> 
                Заберите бесплатно свои лучшие фотографии на Free Foto</span>
            </div>
            <div style="display: block; margin-bottom: 20px;">
                <img src="/img/freefoto1.png" style="margin-right: 15px;" />
                <img src="/img/freefoto2.png" style="margin-right: 15px;" />
                <img src="/img/freefoto3.png" />
            </div>
        </div>
    </div>
</div>
<div class="wrapper" style="padding: 40px 0px 40px 0px;">
    <div class="container">
        <?php $this->renderPartial('_form'); ?>
    </div>
</div>

<?php
if(!Yii::app()->user->isGuest && Yii::app()->user->freefoto==1) {
?>   
<div class="wrapper">
    <div class="container">
        <div class="col-12 cabinet__portfolio__add-photo">
            <div class="col-4 global__plus__btn-container">
                <h4>Всего скачиваний: <strong><?=$totalCount?></strong></h4>
            </div>       
            <div class="col-8 global__plus__btn-container">
                <a href="/freefoto/create" class="global__plus__btn"><i></i><span>Добавить фото</span></a>
            </div>
        </div>
    </div>
</div>
<?php
}
?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/min/jquery.fancybox.pack.js'); ?>
<div class="container">

    <div id="listView">
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
        'ajaxUpdate'=>false,
        'template' => "{items}",
        'emptyText'=>Yii::t('category','No results found.'),
    )); 
     
    ?>
    </div>
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
                            '<?php echo Yii::app()->request->csrfTokenName; ?>': '<?php echo Yii::app()->request->csrfToken; ?>',
                            <?=isset($_POST['city_id']) ? "'city_id': ".$_POST['city_id']."," : ""?>
                            <?=isset($_POST['name']) ? "'name': '".$_POST['name']."'," : ""?>
                            <?=isset($_POST['date']) ? "'date': '".$_POST['date']."'," : ""?>
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
