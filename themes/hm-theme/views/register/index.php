<?php
/* @var $this RegisterController */

$this->breadcrumbs=array(
	'Register',
);
?>

  <div class="container registration-title">
    <div class="container__title-wrapper">
      <h5 class="container__title"><?=Yii::t('register','reg_title');?></h5>
    </div>
  </div>    
  <div class="container register_2-container clfx">
    <form action="<?=$this->createUrl('/register/step2');?>" method="post">
      <div class="big_radio-container">
        <input type="radio" id="big__radio2" name="search" value="1" class="big_radio">
        <label for="big__radio2"></label>
        <?=Yii::t('register','i_do_service');?>

        <input type="radio" id="big__radio" name="search" value="0" class="big_radio">
        <label for="big__radio" style="margin-left: 35px;"></label>
        <?=Yii::t('register','i_search_service');?>
      </div>
      <button type="submit" class="registration__main__btn"><?=Yii::t('register','continue');?></button>
    </form>
  </div>     
 
  
  
