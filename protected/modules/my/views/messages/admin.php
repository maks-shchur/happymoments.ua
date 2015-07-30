<?php
/* @var $this MessagesController */
/* @var $model Messages */

$this->breadcrumbs=array(
	'Messages'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Messages', 'url'=>array('index')),
	array('label'=>'Create Messages', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#messages-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

  <div class="wrapper cabinet-general">
    <div class="container">
      <div class="clfx"></div>
      <div class="cabinet-nav">
      <figure class="cabinet-general__ava">
      <?php
        if(is_file('./users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo)) {
                echo '<a href="#" class="cabinet__user-img">';
                echo CHtml::image('/users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo,'My photo',array('width'=>60));
                echo '</a>';
        }
        else {
                    echo CHtml::image('/img/zaglushka.png','My photo',array('id'=>'my_ava'));
                }
        ?>
      </figure>
      
        <nav class="cabinet__first-menu">
          <ul>
            <li><a href="#0">Входящие</a></li>
            <li><a href="#0">Отправленные</a></li>
          </ul>
        </nav>
      </div>
      <div class="cabinet-main">
        <header class="cabinet__header">
          <div class="cabinet__title clfx">
            <div class="accaunt__right__header__name col-8">
              <h1><?=Yii::app()->user->name;?></h1>
              <?php if(Yii::app()->user->member!=0):?>
              <div class="accaunt__status"><?=Yii::app()->user->member_type;?></div>
              <span class="accaunt__role"><?=Occupation::getName($user->occupation_id);?></span>
              <? endif; ?>
            </div>
            <div class="accaunt__right__header__rate col-4">
              на сайте 2 дня
            </div>
          </div>
          <nav class="cabinet__second-menu">
            <ul>
              <li><?=CHtml::link('Профиль','/index.php/profile/');?></li>
              <li><a href="#0">Избранное</a></li>
              <li><a href="#0">Мои тендеры</a></li>
              <li class="active"><?=CHtml::link('Сообщения','/index.php/messages/');?></li>
              <li><?=CHtml::link('Настройки','/index.php/profile/settings');?></li>
            </ul>
          </nav>
        </header>
        <table class="msg__list">
          <tr class="msg__item">
            <td class="msg__item__address">Кому:</td>
            <td class="msg__item__name">Александр Снежин</td>
            <td class="msg__item__theme">Понравилось ваше портфолио&nbsp;-&nbsp;<span>Хотел бы с вами сотрудничать бы с вами сотрудничать бы с вами ...</span></td>
            <td class="msg__item__date"><time datetime="14:22">14:22</time></td>
            <td class="msg__item__delete"><div class="close__btn"></div></td>
          </tr>
          <tr class="msg__item">
            <td class="msg__item__address">Кому:</td>
            <td class="msg__item__name">Александр Снежин</td>
            <td class="msg__item__theme">Понравилось ваше портфолио&nbsp;-&nbsp;<span>Хотел бы с вами сотрудничать бы с вами сотрудничать бы с вами ...</span></td>
            <td class="msg__item__date"><time datetime="14:22">18 янв.</time></td>
            <td class="msg__item__delete"><div class="close__btn"></div></td>
          </tr>
          <tr class="msg__item">
            <td class="msg__item__address">Кому:</td>
            <td class="msg__item__name">Александр Снежин</td>
            <td class="msg__item__theme">Понравилось ваше портфолио&nbsp;-&nbsp;<span>Хотел бы с вами сотрудничать бы с вами сотрудничать бы с вами ...</span></td>
            <td class="msg__item__date"><time datetime="14:22">14:22</time></td>
            <td class="msg__item__delete"><div class="close__btn"></div></td>
          </tr>
          <tr class="msg__item">
            <td class="msg__item__address">Кому:</td>
            <td class="msg__item__name">Александр Снежин</td>
            <td class="msg__item__theme">Понравилось ваше портфолио&nbsp;-&nbsp;<span>Хотел бы с вами сотрудничать бы с вами сотрудничать бы с вами ...</span></td>
            <td class="msg__item__date"><time datetime="14:22">14:22</time></td>
            <td class="msg__item__delete"><div class="close__btn"></div></td>
          </tr>
          <tr class="msg__item">
            <td class="msg__item__address">Кому:</td>
            <td class="msg__item__name">Александр Снежин</td>
            <td class="msg__item__theme">Понравилось ваше портфолио&nbsp;-&nbsp;<span>Хотел бы с вами сотрудничать бы с вами сотрудничать бы с вами ...</span></td>
            <td class="msg__item__date"><time datetime="14:22">февр.</time></td>
            <td class="msg__item__delete"><div class="close__btn"></div></td>
          </tr>
          <tr class="msg__item msg__item__come">
            <td class="msg__item__address">От:</td>
            <td class="msg__item__name">Александр Снежин</td>
            <td class="msg__item__theme">Понравилось ваше портфолио&nbsp;-&nbsp;<span>Хотел бы с вами сотрудничать бы с вами сотрудничать бы с вами ...</span></td>
            <td class="msg__item__date"><time datetime="14:22">14:22</time></td>
            <td class="msg__item__delete"><div class="close__btn"></div></td>
          </tr>
          <tr class="msg__item msg__item__come">
            <td class="msg__item__address">От:</td>
            <td class="msg__item__name">Александр Снежин</td>
            <td class="msg__item__theme">Понравилось ваше портфолио&nbsp;-&nbsp;<span>Хотел бы с вами сотрудничать бы с вами сотрудничать бы с вами ...</span></td>
            <td class="msg__item__date"><time datetime="14:22">14:22</time></td>
            <td class="msg__item__delete"><div class="close__btn"></div></td>
          </tr>
          <tr class="msg__item">
            <td class="msg__item__address">От:</td>
            <td class="msg__item__name">Александр Снежин</td>
            <td class="msg__item__theme">Понравилось ваше портфолио&nbsp;-&nbsp;<span>Хотел бы с вами сотрудничать бы с вами сотрудничать бы с вами ...</span></td>
            <td class="msg__item__date"><time datetime="14:22">14:22</time></td>
            <td class="msg__item__delete"><div class="close__btn"></div></td>
          </tr>
        </table>
      </div>
    </div>
  </div>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'messages-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'from_uid',
		'to_uid',
		'title',
		'msg',
		'date_send',
		/*
		'is_read',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
