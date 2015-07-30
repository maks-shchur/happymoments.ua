<?php
/* @var $this OccupationController */
/* @var $model Occupation */

$this->breadcrumbs=array(
	'Occupations'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Occupation', 'url'=>array('index')),
	array('label'=>'Create Occupation', 'url'=>array('create')),
	array('label'=>'Update Occupation', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Occupation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Occupation', 'url'=>array('admin')),
);
?>

<h1>View Occupation #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
