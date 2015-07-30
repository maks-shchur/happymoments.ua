<?php
/* @var $this RegisterController */

$this->breadcrumbs=array(
	'Register'=>array('/register'),
	'Step2',
);

//print_r($_POST); 
if(isset($_POST['search'])) $search=$_POST['search'];
elseif(isset($model_search)) $search=$model_search;
else $search=0;
?>

  <div class="container registration-title">
    <div class="container__title-wrapper">
      <h5 class="container__title"><?=Yii::t('register','reg_title');?></h5>
    </div>
  </div>
<!--div class="wrapper social__login">
    <div class="container clfx">
      <div class="col-6 text_right"><a href="#"><img src="/img/login_vk.png" alt=""></a></div>
      <div class="col-6"><a href="#"><img src="/img/login_fb.png" alt=""></a></div>
    </div>
  </div-->
  <div class="container registration__main clfx">
    <div class="col-6 registration__main__promo">
      <div class="registration__main__promo__user-icons">
        <ul>
        <?php
        $last_users=Users::model()->findAllBySql('select id,photo from {{users}} where photo!="" order by id desc limit 9');
        $i=0;
        foreach($last_users as $item) {
        ?>
          <li><a href="/id<?=$item->id?>">
            <?php if(is_file('./users/'.$item->id.'/'.$item->photo)):?>
            <img src="/users/<?=$item->id?>/<?=$item->photo?>" alt="">
            <?php else: ?>
            <img src="/img/zaglushka.png" alt="">
            <?php endif; ?>
          </a></li>
        <?php
          $i++;
        }
        if($i<9) {
            for($j=$i;$j<=9;$j++) 
            {
        ?>
                <li><a href="#"><img src="/img/photo.png" alt=""></a></li>
        <?php        
            }
        }
        ?>   
       </ul>
      </div>
      <h4 class="registration__main__promo__title">Преимущества регистрации:</h4>
      <div class="registration__main__promo__plus">
        <ol>
          <li>
            Создать и настроить свою услугу
            за 10 минут
          </li>
          <li>
            Быстро найти подрядчика
            по вашим требованиям
          </li>
          <li>
            Быстро добавить на сайт услугу,
            добавить акции и обьявить тендер
          </li>
        </ol>
      </div>
    </div>
    <div class="col-6 registration__main__form">
      <div class="col-12 add-action__form-container">

        <?php $this->renderPartial('_form',array('model'=>$model, 'search'=>$search)); ?>      

    </div>
  </div>

