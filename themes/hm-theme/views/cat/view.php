<?php
/* @var $this CatController */

$this->breadcrumbs=array(
	'Услуги',
	Occupation::getName($id),
);
?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/min/jquery.stellar.min.js'); ?>

<div id="listView">
<?php
$_SESSION['res_']=0; 
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'ajaxUpdate'=>false,
    'template' => "{items}",
    'emptyText'=>Yii::t('category','No results found.'),
)); 
if(!empty($_POST['calend']) || !empty($_POST['genre'])) {
    if($_SESSION['res_']==0 && $dataProvider->totalItemCount > 0) echo Yii::t('category','No results found.');    
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