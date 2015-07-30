<?php
/* @var $this RegisterController */

$this->breadcrumbs=array(
	'Register'=>array('/register'),
	'Step3',
);
?>
  <div class="container registration-title">
    <div class="container__title-wrapper">
      <h5 class="container__title"><?=Yii::t('register','specify');?></h5>
    </div>
  </div>
  
  <form action="<?=$this->createUrl('/register/step2');?>" method="post">
  <!--div class="container register_2-container clfx">
      <div class="big_radio-container">
        <input type="radio" id="big__radio2" name="search" value="1" checked="checked" class="big_radio">
        <label for="big__radio2"></label>
        <?=Yii::t('register','i_do_service');?>

        <input type="radio" id="big__radio" name="search" value="0" disabled="true" class="big_radio">
        <label for="big__radio" style="margin-left: 35px;"></label>
        <?=Yii::t('register','i_search_service');?>
      </div>
  </div-->  
  <div class="container">
    <ul class="header-menu-primary__dropdownmenu__container">
      <li class="dropdownmenu__item">
        <ul class="dropdownmenu__item__list">
      <?php
      $data_cat = new Category;
      $list=$data_cat->findAll();
      $i=1;
      foreach($list as $k=>$v) {
            //if($i%8==0) {
            //    echo '</ul></li>';
            //    echo '      <li class="dropdownmenu__item">
            //            <ul class="dropdownmenu__item__list">';    
            //}  
            echo '<li class="dropdownmenu__item__list__item"><h3 class="dropdownmenu__item__list__item__title">'.$v->name.'</h3></li>';
            $model = new Occupation;
            $list1=$model->findAll('cat_id=:cid',array(':cid'=>$v->id));
            $i=1;
            foreach($list1 as $k1=>$v1) {
                //echo '<li class="dropdownmenu__item__list__item"><a href="" class="dropdownmenu__item__list__item__link">Воздушные акробаты<span class="dropdown__link__col">&nbsp;(25)</span></a></li>';
                //echo '<li class="dropdownmenu__item__list__item"><a href="'.$this->createUrl('/register/add_occ',array('id'=>$v1->id,'uid'=>Yii::app()->getRequest()->getParam('uid'))).'" class="dropdownmenu__item__list__item__link">'.$v1->name.'</a></li>';
                echo '<li class="dropdownmenu__item__list__item"><a href="javascript:void(0)" onClick="choose_cat(\''.$v1->name.'\','.$v1->id.')" class="dropdownmenu__item__list__item__link">'.$v1->name.'</a></li>';
                //$i++;
            }
      }
      ?>
        </ul>
      </li>  
    </ul>
    <script>
    function choose_cat(name, cat_id)
    {
        $('#cat_name').html(name);
        $('.cat_choose_hidden-yes').attr('data-cat-id',cat_id);
        $('.cat_choose_hidden').fadeToggle(400);
    }
    </script>
    <div class="cat_choose_hidden">
        <div class="cat_choose_hidden-title">Вы выбрали категорию "<span id="cat_name"></span>".<br />Вы уверены?</div>
        <div class="cat_choose_hidden-yes" data-cat-id="">ДА</div>
        <div class="cat_choose_hidden-no">нет</div>
    </div>
  </div>
  <script>
  $('.cat_choose_hidden-yes').click(function(){
        cid = $('.cat_choose_hidden-yes').attr('data-cat-id');
        //window.location.href="/register/add_occ/id/"+cid+"/uid/<?=Yii::app()->getRequest()->getParam('uid')?>";    
        window.location.href="/register/add_occ?id="+cid+"&uid=<?=Yii::app()->getRequest()->getParam('uid')?>";
    });
    $('.cat_choose_hidden-no').click(function(){
        $(this).parent().fadeToggle(400);    
    });
  </script>
  </form>   
      <div class="clfx"></div>
      <div class="container register_2_dop">
        <h2>Если вашей предоставляемой услуги нет в списке, выберите подходящую категорию и укажите название услуги</h2>
                <?php 
                //$model = new Occupation;
                $form=$this->beginWidget('CActiveForm', array(
                	'id'=>'occ-form',
                    'action'=>$this->createUrl('/register/create_occ'),
                	'enableClientValidation'=>true,
                	'clientOptions'=>array(
                		'validateOnSubmit'=>true,
                	),
                )); ?>
                <div class="col-12 add-action__form-container">
                    <?php echo $form->dropDownList($model,'cat_id',CHtml::listData(Category::model()->findAll(),'id','name'),array('class'=>'default__input','style'=>'width: 547px; margin: 0 auto;'));?>
                    <?php echo $form->error($model,'cat_id'); ?>
                </div>
                <div class="col-12 add-action__form-container">
                    <?php //echo $form->labelEx($model,'email'); ?>
            		<?php echo $form->textField($model,'name', array('class'=>'default__input', 'placeholder'=>'Мим','style'=>'width: 547px; margin: 0 auto;')); ?>
            		<?php echo $form->error($model,'name'); ?>
                    <?php echo CHtml::hiddenField('uid',Yii::app()->getRequest()->getParam('uid')); ?>
                    <?php echo CHtml::submitButton('', array('class'=>'registe_2_submit')); ?>
                </div>
                
                <?php $this->endWidget(); ?>
      </div>

        <!--div class="col-12 text_center">
            <div class="btn__group clfx">
              <div class="col-179">
                <button type="button" onClick="window.history.back();" class="cabinet__profile__btn"><?=Yii::t('register','cancel');?></button>
              </div>
              <div class="col-179">
                <button type="submit" class="cabinet__profile__btn cabinet__profile__btn-submit"><?=Yii::t('register','save');?></button>
              </div>
            </div>
        </div-->     
