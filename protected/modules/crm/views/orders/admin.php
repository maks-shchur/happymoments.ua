<?php
/* @var $this TendersController */
/* @var $model Tenders */

$this->breadcrumbs=array(
	'Tenders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Все заказы', 'url'=>array('index')),
	array('label'=>'Новый заказ', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tenders-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tenders-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'rowCssClassExpression' => '$data->getRowCssClass()',
	'columns'=>array(
		'id'=>array(
            'name'=>'id',
            'htmlOptions'=>array(
                'style'=>'width:20px;'
            ),
        ),
		'uid' => array(
            'name' => 'uid',
            'header' => 'Клиент',
            'value' => '$data->user->name',
            'filter' => CHtml::listData(Users::model()->findAll(), 'id', 'name'),
        ),
        'date_create',
		'date_end',
		'city' => array(
            'name' => 'city',
            'header' => 'Город',
            'value' => '$data->cities->name',
            'filter' => CHtml::listData(City::model()->findAll(), 'id', 'name'),
        ),
        'phone',
		'price',
		/*
		'description',
		
		'phone2',
		'phone3',
		'email',
		*/
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}&nbsp;&nbsp;&nbsp;&nbsp;{delete}',
		),
	),
)); ?>
