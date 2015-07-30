<?php
/* @var $this TendersController */
/* @var $model Tenders */

$this->breadcrumbs=array(
	'Tenders'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Tenders', 'url'=>array('index')),
	array('label'=>'Create Tenders', 'url'=>array('create')),
	array('label'=>'Update Tenders', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Tenders', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tenders', 'url'=>array('admin')),
);
?>

<h1>View Tenders #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'title',
		'date_end',
		'city',
		'price',
		'description',
		'phone',
		'phone2',
		'phone3',
		'email',
	),
)); ?>
