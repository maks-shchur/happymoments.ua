<?php
/* @var $this PortfolioController */
/* @var $model Portfolio */

$this->breadcrumbs=array(
	'Portfolios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Portfolio', 'url'=>array('index')),
	array('label'=>'Manage Portfolio', 'url'=>array('admin')),
);
?>

<h1>Create Portfolio</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>