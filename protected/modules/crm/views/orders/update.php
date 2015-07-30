<?php
/* @var $this TendersController */
/* @var $model Tenders */

$this->breadcrumbs=array(
	'Заказы'=>array('index'),
	'Редактирование',
);

?>

<?php $this->renderPartial('_form', array('model_t'=>$model_t,'model'=>$model)); ?>
