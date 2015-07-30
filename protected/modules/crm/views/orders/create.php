<?php
/* @var $this TendersController */
/* @var $model Tenders */

$this->breadcrumbs=array(
	'Tenders'=>array('index'),
	'Create',
);

?>

<?php $this->renderPartial('_form', array('model_t'=>$model_t,'model'=>$model)); ?>
