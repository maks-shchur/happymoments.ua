<div id="listView">
 
    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view_other',
        'ajaxUpdate'=>false,
        'template'=>"{items}",        
        'pager'=>array(
            'htmlOptions'=>array(
                'class'=>'paginator'
            )
        ),
    )); ?>
 
</div>


