<?php
/* @var $this OccupationController */
/* @var $model Occupation */

$this->breadcrumbs=array(
	'Occupations'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Occupation', 'url'=>array('index')),
	array('label'=>'Create Occupation', 'url'=>array('create')),
	array('label'=>'View Occupation', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Occupation', 'url'=>array('admin')),
);
?>

<h1>Update Occupation <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>