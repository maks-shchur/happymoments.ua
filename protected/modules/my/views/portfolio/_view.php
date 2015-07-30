<?php
/* @var $this PortfolioController */
/* @var $data Portfolio */
?>
<div class="cabinet__edit-albom cabinet__edit-photo__list">
    <figure class="edit-albom__img">
      <?php
      if($data->picture!='') {
          $file="/users/".Yii::app()->user->id."/254_".$data->picture;
          //echo $file; exit();
          if(is_file('.'.$file)) {
            echo '<img src="'.$file.'" />';
          } 
      }
      ?>
      <?=CHtml::link('Файлы альбома','/portfolio/album/'.$data->id);?>
      <?=CHtml::link('Редактировать альбом','/portfolio/update/'.$data->id);?>
      <?=CHtml::link('Удалить альбом','/portfolio/delete/'.$data->id);?>
    </figure>
    <div class="edit-photo__description-container">
      <div class="col-6 edit-photo__title"><label for="text1">Название</label></div>
      <div class="col-12 edit-photo__description">
        <p><strong><?php echo CHtml::encode($data->title); ?></strong></p>
      </div>
      <div class="col-6 edit-photo__title"><label for="text1">Описание</label></div>
      <div class="col-12 edit-photo__description">
        <p><strong><?php echo CHtml::encode($data->description); ?></strong></p>
      </div>
    </div>
</div>
