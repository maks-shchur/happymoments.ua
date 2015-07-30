<?php /* @var $this Controller */ ?>
<?php $this->beginContent('/layouts/main'); ?>
<div style="width: 80%; float: left;">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div style="width: 20%; float: left;">
	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Действия',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>