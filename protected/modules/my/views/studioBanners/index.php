<?php
/* @var $this StudioBannersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Studio Banners',
);

$this->menu=array(
	array('label'=>'Create StudioBanners', 'url'=>array('create')),
	array('label'=>'Manage StudioBanners', 'url'=>array('admin')),
);
?>

<h1>Studio Banners</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
