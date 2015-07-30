<?php
/* @var $this AvtoController */
/* @var $model Avto */

$this->breadcrumbs=array(
	'Avtos'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Avto', 'url'=>array('index')),
	array('label'=>'Create Avto', 'url'=>array('create')),
	array('label'=>'Update Avto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Avto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Avto', 'url'=>array('admin')),
);
?>

<h1>View Avto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'class',
		'title',
		'year',
		'doors',
		'seats',
		'color',
		'description',
		'price',
	),
)); ?>
