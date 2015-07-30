  <div class="container full__tender-container clfx">
    <header class="clfx">
      <?php if(!empty($_POST['occupation'])): ?>
      <h3 class="title__full__tender">Тендеры на: <?=Occupation::getName($_POST['occupation']);?></h3>
      <?php else: ?>
      <h3 class="title__full__tender">Тендеры</h3>
      <?php endif; ?>
      <div class="add__full__tender">
        <button type="clear" class="cabinet__profile__btn" onclick="window.location.href='/my/tenders/create'">ДОБАВИТЬ ТЕНДЕР</button>
        <!--p>Только для аккунтов Pro, Plus</p-->
      </div>
    </header>
    
    <div id="listView">
    <?php $this->widget('zii.widgets.CListView', array(
            	'dataProvider'=>$dataProvider,
            	'itemView'=>'_my_tenders',
                'ajaxUpdate'=>false,
                'template' => "{items}",
                'emptyText'=>Yii::t('tender','No results found public.'),
            )); ?>
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
<?php
/* @var $this ProfileController */

$this->breadcrumbs=array(
	'Тендеры',
);
?>
