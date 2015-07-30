<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
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
