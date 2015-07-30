<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<header class="container">
<div align="center">

<?php if(isset($_SESSION['confirm']) && $_SESSION['confirm']=='ok'): ?>
<div class="apply"><?=Yii::t('register','Account activated')?></div>
    <script>
    $(document).ready(function(){
        $('.apply').css('display','block');
        $('.apply').delay(3000).fadeOut();
    });    
    </script>

<!--div class="flash-success">
	<?php echo Yii::app()->user->getFlash('reset'); ?>
</div-->
<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('reset_not_email')): ?>
<div class="flash-error">
	<?php echo Yii::app()->user->getFlash('reset_not_email'); ?>
</div>
<?php endif; ?>

<?php 
            //$model = new Users;
            $form=$this->beginWidget('CActiveForm', array(
            	'id'=>'login-form',
                'action'=>'/site/login',
                'enableAjaxValidation'=>true,
                'enableClientValidation' => true, 
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => false,
                ),
                'htmlOptions'=>array('class'=>'author2'),
            )); ?>
     
      
        <div class="author-wrapper">
            <br />
          <div class="author-name">Авторизация</div>
          <?php //echo $form->errorSummary($model); ?>
          <div class="input-wrapper">
            <?php //echo $form->labelEx($model,'email'); ?>
    		<?php echo $form->emailField($model,'username', array('class'=>'input email-input', 'placeholder'=>'Введите e-mail')); ?>
    		<?php echo $form->error($model,'username'); ?>
          </div>
          <div class="input-wrapper">
            <?php //echo $form->labelEx($model,'password'); ?>
    		<?php echo $form->passwordField($model,'password', array('class'=>'input password-input', 'placeholder'=>'***********')); ?>
    		<?php echo $form->error($model,'password'); ?>
          </div>
          <!--div class="sign-social">
            Войти через 
            <a class="author-social-link author-social-link-vk" href="#"></a>
            <a class="author-social-link author-social-link-fb" href="#"></a>
          </div-->
          <div style="margin: 10px 0px 30px 0px;">
              <?php echo CHtml::submitButton('Войти', array('class'=>'author-submit','style'=>'display:block; position:relative; z-index:100;')); ?>
              <div class="forget-remember-wrapper2">
                <?=CHtml::link('Забыли пароль','/site/resetpass',array('class'=>'forget'));?>
                <div class="checkbox-wrapper">
                    <?php echo $form->checkBox($model,'rememberMe'); ?>
                    <?php echo $form->label($model,'rememberMe', array('class'=>'remember')); ?>
    
                </div>
              </div>
          </div>
        </div>
        <?php echo CHtml::link(Yii::t('main','register'), array('/register'),array('class'=>'register')); ?>
        <?php $this->endWidget(); ?>
        
        <!-- end author-wrapper -->
        <div class="forget-block" style="display: none;">
          <div class="author-wrapper">
            <?php $form=$this->beginWidget('CActiveForm', array(
            	'id'=>'resetpass-form',
                //'name'=>'resetpass-form',
                'action'=>'/site/resetpass',
                'htmlOptions'=>array('class'=>'reset'),
            )); ?>
            <div class="input-wrapper">
              <?=CHtml::textField('email','',array('class'=>'input email-input','placeholder'=>'Введите e-mail'));?>
              <div class="invalid-input-message">
                <div class="invalid-input-message-bg"></div>
                Неправильно введена почта
              </div>
            </div>
            <div class="forget-block-text">
              пароль будет отправлен
              Вам на почту
            </div>
            <?php echo CHtml::submitButton('Отправить', array('class'=>'forget-submit','onClick'=>'document.forms["resetpass-form"].submit();')); ?>
            <?php $this->endWidget(); ?>
          </div>
          <!-- end author-wrapper -->
        </div>
        <!-- end forget-block -->
</div>      
</header>      