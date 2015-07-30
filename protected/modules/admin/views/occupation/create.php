<?php
/* @var $this OccupationController */
/* @var $model Occupation */

$this->breadcrumbs=array(
	'Occupations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Occupation', 'url'=>array('index')),
	array('label'=>'Manage Occupation', 'url'=>array('admin')),
);
?>

<h1>Create Occupation</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>