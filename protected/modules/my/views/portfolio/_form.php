<main class="cabinet__portfolio">
          <header class="cabinet__portfolio__title clfx">
            <div class="col-12"><h3>Редактировать альбом</h3></div>
          </header>
          
          <?php $form=$this->beginWidget('CActiveForm', array(
            	'id'=>'portfolio-form',
            	'enableAjaxValidation'=>true,
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
            )); ?>
          
          <div class="cabinet__edit-albom">
            <figure class="edit-albom__img">
            <?php
              $file="/users/".Yii::app()->user->id."/".$model->picture;
              //echo $file; exit();
              if(is_file('.'.$file)) {
                echo '<img src="'.$file.'" />';
              }
              else 
                echo '<img src="/img/zaglushka.png" />';
            ?>
            <a href="/my/portfolio/delete/id/<?=$model->id?>">Удалить альбом</a>
            <a href="/my/portfolio/album/id/<?=$model->id?>" data-toggle="modal" data-target="#__add-albom-cover">Другую обложку</a>
            </figure>
            <div class="edit-photo__description-container">
              <div class="col-6 edit-photo__title"><label for="text1">Название</label></div>
              <div class="col-12 edit-photo__description">
                <?php echo $form->textField($model,'title',array('class'=>'default__input search__hidden__input--city','placeholder'=>'Панорамная фотосьемка')); ?>
                <?php echo $form->error($model,'title'); ?>
              </div>
              <div class="col-6 edit-photo__title"><label for="text1">Описание</label></div>
              <div class="col-12 edit-photo__description">
                <?php echo $form->textArea($model,'description',array('cols'=>30,'rows'=>3,'placeholder'=>'Данная информаця будет видна другим авторам и потенциальным клиентам')); ?>
                <?php echo $form->error($model,'description'); ?>
              </div>
              <div class="col-179">
                <?=CHtml::hiddenField('Portfolio[uid]',Yii::app()->user->id);?>
                <?=CHtml::submitButton('СОХРАНИТЬ',array('class'=>'cabinet__profile__btn cabinet__profile__btn-submit'));?>
              </div>
              <div class="col-179"><button type="reset" class="cabinet__profile__btn" onclick="window.location.href='/my/portfolio/'">ОТМЕНА</button></div>
              <?php //echo $form->errorSummary($model); ?>
            </div>
          </div>
          
          <?php $this->endWidget(); ?>
</main>