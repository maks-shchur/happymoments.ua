<!DOCTYPE html>
<html>
  <head>
  <script type="text/javascript" src="/themes/hm-theme/js/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="/themes/hm-theme/js/main.js"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
  <meta name="viewport" content="width=device-width">
  <!-- отключение автоматического распознавание номеров на планшетах и телефонах -->
  <meta name="format-detection" content="telephone=no">
  
  <!-- SEO -->
  <?php
  $seo = Seo::checkUrl($_SERVER['REQUEST_URI']);
  ?>
  <title><?php echo $seo['title']; ?></title>
  <meta name="description" content="<?php echo $seo['description']; ?>">
  <meta name="keywords" content="<?php echo $seo['keywords']; ?>">
  <link rel="canonical" href="<?php echo Yii::app()->request->getHostInfo() . '/' . Yii::app()->request->getPathInfo(); ?>" />
  
  
  <!-- css -->
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/css/style.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/css/jquery.Jcrop.css">
  <!--[if IE 8]> 
    <link rel="stylesheet" type="text/css" href="/css/ie-8.css">
  <![endif]-->
  <!--[if IE 9]> 
    <link rel="stylesheet" type="text/css" href="/css/ie-9.css">
  <![endif]-->
  
    <!-- js main files -->
  <?php //Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/main.js'); ?>  
        
  <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/bootstrap.js'); ?>
  <?php //Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/connected-carousels.js'); ?>
  <?php //Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery-1.11.1.min.js'); ?>
  <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery-ui.js'); ?>
  
  <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.glide.js'); ?>
  <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.xdcheckbox.js'); ?>
  <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/modernizr.js'); ?>
  <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/perfect-scrollbar.js'); ?>
  <?php //Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/min/jquery.jcarousel.min.js'); ?>
  
  <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/min/jquery.maskedinput.min.js'); ?>
  <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/min/jquery.Jcrop.min.js'); ?>
  
  <?php //Yii::app()->clientScript->registerCoreScript('jquery'); ?>
  
  <!-- favicon -->
  <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/img/favicon.png"> 
  <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/img/favicon.png" type="image/x-icon">
  
  <!-- player skin -->
   <link rel="stylesheet" href="<?=Yii::app()->theme->baseUrl?>/player/skin/minimalist.css">

   <!-- site specific styling -->
   <style>
   .flowplayer { width: 100%; }
   </style>

   <script src="<?=Yii::app()->theme->baseUrl?>/player/flowplayer.min.js"></script>
   
   <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
    ga('create', 'UA-37480573-1', 'auto');
    ga('send', 'pageview');
    
    </script>
    
    <!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter31387653 = new Ya.Metrika({ id:31387653, clickmap:true, trackLinks:true, accurateTrackBounce:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/31387653" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
   
  </head>
<body>


<?php 
    //DEBUG for emails
    //$this->widget('application.extensions.email.debug'); 
?>
<div class="wrapper-global">
  <div class="wrapper wrapper__header--first">
    <header class="container">
      <?php 
      if(Yii::app()->controller->action->id!='login'):
      ?>
      <!-- Авторизация -->
      <div class="author">
      <?php 
            $model = new LoginForm;
            $form=$this->beginWidget('CActiveForm', array(
            	'id'=>'login-form',
                'action'=>'/site/login',
                'enableAjaxValidation'=>true,
                'enableClientValidation' => true, 
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => false,
                ),
                //'htmlOptions'=>array('class'=>'author'),
            )); ?>
     
      
        <a class="author-close" href="#"></a>
        <div class="author-wrapper">
          <div class="author-name">Авторизация</div>
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
          <div class="sign-social">
            <!--Войти через 
            <a class="author-social-link author-social-link-vk" href="#"></a>
            <a class="author-social-link author-social-link-fb" href="#"></a-->
          </div>
          <?php echo CHtml::submitButton('Войти', array('class'=>'author-submit')); ?>
          <div class="forget-remember-wrapper">
            <a href="<?=$this->createUrl('register/resetpass')?>" class="forget">Забыли пароль</a> 
            <div class="checkbox-wrapper">
                <?php echo $form->checkBox($model,'rememberMe'); ?>
                <?php echo $form->label($model,'rememberMe', array('class'=>'remember')); ?>

            </div>
          </div>
        </div>
        <?php $this->endWidget(); ?>
        <!-- end author-wrapper -->
        <div class="forget-block" style="display: none;">
          <div class="author-wrapper">
            <?php $form=$this->beginWidget('CActiveForm', array(
            	'id'=>'resetpass-form',
                //'name'=>'resetpass-form',
                'action'=>'/site/resetpass',
                'enableAjaxValidation'=>true,
                'htmlOptions'=>array('class'=>'reset'),
            )); ?>
            <div class="input-wrapper">
              <?=CHtml::emailField('email','',array('class'=>'input email-input','placeholder'=>'Введите e-mail'));?>
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
        <a href="<?=$this->createUrl('register/index')?>" class="register"><?=Yii::t('main','register')?></a>
        <?php //echo CHtml::link(Yii::t('main','register'), array('/register'),array('class'=>'register')); ?> 
      
      </div>
      <!-- end author -->
      <?php endif; ?>
      <nav class="header-menu-additional">
        <ul class="header-menu-additional__list clfx">
          <!--li class="header-menu-additional__item"><a href="<?=$this->createUrl('/page/advertisment')?>" class="header-menu-additional__link <?=(Yii::app()->controller->action->id=='advertisment' && !isset(Yii::app()->controller->module->id))?'header-menu-additional__link--current':'';?>">Реклама на сайте</a></li-->
          <!--li class="header-menu-additional__item"><a href="/vacancies" class="header-menu-additional__link <?=(Yii::app()->controller->action->id=='vacancies' && !isset(Yii::app()->controller->module->id))?'header-menu-additional__link--current':'';?>">Вакансии</a></li-->
          <!--li class="header-menu-additional__item"><a href="<?=$this->createUrl('/page/help_us')?>" class="header-menu-additional__link <?=(Yii::app()->controller->action->id=='help_us' && !isset(Yii::app()->controller->module->id))?'header-menu-additional__link--current':'';?>">Помощь проекту</a></li-->
          <!--li class="header-menu-additional__item"><a href="<?=$this->createUrl('/page/news')?>" class="header-menu-additional__link <?=(Yii::app()->controller->action->id=='news' && !isset(Yii::app()->controller->module->id))?'header-menu-additional__link--current':'';?>">Новости</a></li-->
          <!--li class="header-menu-additional__item"><a href="#" class="header-menu-additional__link">Форум</a></li-->
          <li class="header-menu-additional__item"><a href="<?=$this->createUrl('/page/about')?>" class="header-menu-additional__link <?=(Yii::app()->controller->action->id=='about' && !isset(Yii::app()->controller->module->id))?'header-menu-additional__link--current':'';?>">О проекте</a></li>
        </ul>
      </nav>
      <div class="header-search">
          <button class="header-search__btn"></button>
      </div> 
      <?php if(Yii::app()->user->isGuest): ?>
      <button class="sign">Вход</button>
      <?php else: ?>
      <button class="sign_logout" onclick="window.location.href='<?=$this->createUrl('/site/logout')?>'">Выход</button>
      <?php endif; ?>
      
      <button class="register_top" onclick="window.location.href='<?=$this->createUrl('register/index')?>'">Регистрация</button>
      <?php /*<div class="lang">
        <ul class="lang__list">
          <li class="lang__item<?=Yii::app()->language=='ru' ? '' : ' lang__item--hide'?>"><a href="<?=Settings::changeLang('ru')?>" class="lang__link">Ru</a></li>
          li class="lang__item<?=Yii::app()->language=='ru' ? '' : ' lang__item--hide'?>"><a href="#" class="lang__link">En</a></li
          <!--li class="lang__item<?=Yii::app()->language=='uk' ? '' : ' lang__item--hide'?>"><a href="<?=Settings::changeLang('uk')?>" class="lang__link">Uk</a></li-->
        </ul>
      </div>*/?>
      <div class="header-social-btns">
        <span class="social-top-text">Мы в соц. сетях</span>
        <a href="https://twitter.com/HMUkraine" target="_blank" class="header-social-btns__link header-social-btns__link--tw"></a>
        <a href="https://vk.com/happymoments" target="_blank" class="header-social-btns__link header-social-btns__link--vk"></a>
        <a href="https://www.facebook.com/pages/Happy-Moments/347923621985767" target="_blank" class="header-social-btns__link header-social-btns__link--fb"></a>
      </div>
      <div class="search-results__container">
        <form autocomplete="off">
          <input type="text" class="search-results__input" placeholder="Укажите имя, фамилию или название компании участника">
          
          <button type="reset" class="search-results__reset"></button>
          <button type="submit" class="search-results__submit"></button>
          <ul class="search-results__list">            
          </ul>
        </form>
      </div>
    </header>
  </div>
  <nav class="wrapper wrapper__header--second">
    <div class="container">
      <a href="/" class="hm-logo"><img src="/img/logo.png" alt="Лого"></a>
      <ul class="header-menu-primary__list">
        <li class="header-menu-primary__item __dropdownmenu"><a href="#0" class="header-menu-primary__link header-menu-primary__link--service">Услуги</a></li>
        <li class="header-menu-primary__item <?=(Yii::app()->controller->id=='tenders' && !isset(Yii::app()->controller->module->id))?'header-menu-primary__item--current':'';?>"><a href="<?=$this->createUrl('/tenders/index');?>" class="header-menu-primary__link header-menu-primary__link--current">Тендеры</a></li>
        <li class="header-menu-primary__item <?=(Yii::app()->controller->id=='actions' && !isset(Yii::app()->controller->module->id))?'header-menu-primary__item--current':'';?>"><a href="<?=$this->createUrl('/actions/index');?>" class="header-menu-primary__link">Акции</a></li>
        <li class="header-menu-primary__item <?=(Yii::app()->controller->id=='freefoto' && !isset(Yii::app()->controller->module->id))?'header-menu-primary__item--current':'';?>"><a href="<?=$this->createUrl('/freefoto/index');?>" class="header-menu-primary__link">Free foto</a></li>
        <li class="header-menu-primary__item <?=(Yii::app()->controller->action->id=='hmagent' && !isset(Yii::app()->controller->module->id))?'header-menu-primary__item--current':'';?>"><a href="<?=$this->createUrl('/page/hmagent');?>" class="header-menu-primary__link">HM Agent</a></li>
      </ul>
      
      <?php
      if(!Yii::app()->user->isGuest):
      ?> 
      <div class="header-profile__ava">`
        <?php
        if(is_file('./users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo)) {
                echo '<a href="#" class="header-profile__icon">';
                echo CHtml::image('/users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo,'My photo');
                echo '</a>';
        }
        else {
                echo '<a href="#" class="header-profile__icon">';
                echo CHtml::image('/img/zaglushka.png','My photo');
                echo '</a>';            
        }
        ?>
        <?php if(Messages::countUnreadMsg(Yii::app()->user->id)>0) {
                echo CHtml::link('','#',array('class'=>'header-profile__msg'));
              }
              else {
                echo CHtml::link('','#',array('class'=>'header-profile__no_msg'));
              } 
        ?>
      </div>
      <?php endif; ?>
      
      
      <?php
      if(!isset(Yii::app()->controller->module->id))
      {
          if(Yii::app()->getRequest()->getPost('city')) {
                $cookie = new CHttpCookie('city', $_POST['city']);
                Yii::app()->request->cookies['city']=$cookie; 
                $cookie->expire = time() + 2629743;
                $c=City::model()->findByPk($_POST['city'])->name;
                echo '<button class="show-cities" id="cur_city">'.$c.'</button>';
          }
          elseif(isset(Yii::app()->request->cookies['city'])) {
                $c=City::model()->findByPk(Yii::app()->request->cookies['city']->value)->name;
                echo '<button class="show-cities" id="cur_city">'.$c.'</button>';
          }
          else 
                echo '<button class="show-cities" id="cur_city">Укажите город</button>'; 
      }
      //else 
      //          echo '<button class="show-cities-disabled" id="cur_city" disabled>Укажите город</button>';
      ?>
      
      
      
      <?php
      if(!Yii::app()->user->isGuest):
        $u=Users::model()->findByPk(Yii::app()->user->id);
        if($u->member==1) {
            if($u->occupation->templ=='members')
                $link='/my/portfolio';
            elseif($u->occupation->templ=='avto')
                $link='/my/avto';
            elseif($u->occupation->templ=='flo')
                $link='/my/flo';    
        	else $link='/my/portfolio';
         }
         else {
            $link='/my/tenders';
         }
      ?>
      <div class="cabinet__user__account-changer" style="display: none;">
        <header><a href="<?=$link?>"><?=Yii::app()->user->name?></a></header>
        <div class="cabinet__user__account-changer__list clfx">
          <div class="col-9">
            <a href="<?=$link?>" class="enter__in__account">ПЕРЕЙТИ В АККАУНТ</a>
          </div>
          <?php if(Messages::countUnreadMsg(Yii::app()->user->id)>0) {
                echo '<div class="col-3 account-changer__list__msg">';
                echo CHtml::link(Messages::countUnreadMsg(Yii::app()->user->id),'/my/messages');
                echo '</div>';
             } else {
                echo '<div class="col-3 account-changer__list__msg_no">';
                //echo CHtml::link('0','/my/messages');
                echo '</div>';
             } 
          ?>
          <div class="col-12 block__border__dashed"></div>
          <div class="col-12">
            <?php if($u->member==1): ?>
            <div class="col-7 money__have">
                На счету<a href="#" data-toggle="modal" data-target="#__accaunt_balans"><span><?=is_object($u->balans)?$u->balans->balans:0?> грн.</span></a>
                <?=(is_object($u->balans) && ($u->balans->end!='' || !is_null($u->balans->end))) ? '<br /><span style="color: #272a33; font-size: 15px;">оплачен до '.Settings::dateFormat($u->balans->end,'%d-%m-%Y').'</span>' : ''?>
            </div>
            <?php else: ?>
            <div class="col-7 money__have"></div>
            <?php endif; ?>
            <div class="col-5 client__id">
                Ваш <a href="/id<?=Yii::app()->user->id?>"><span>(ID: <?=Yii::app()->user->id?>)</span></a>            
            </div>
          </div>
        </div>
        <footer><button type="button" data-toggle="modal" data-target="#__accaunt_balans">пополнить счет</button></footer>
            <div class="modal fade" id="__accaunt_balans" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 2000;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <header class="add-albom__modal__header"><h6>ПОПОЛНЕНИЕ БАЛАНСА</h6><a href="#0" data-dismiss="modal" class=""></a></header>
                  <div class="balans__modal__content">
                  <p class="balans_smal_text">После поступления денег на баланс, вы сможете мгновенно оплатить продление любых услуг с личного баланса</p>
                  <script>
                  function getPayData()
                  {
                    var id=parseFloat($('#amount').val());
                    $.ajax({
                      url: '/user/getpaydata',
                      type: "POST",
                      data: {sum:id,uid:<?=Yii::app()->user->id?>},
                      success: function(data) {
                                $('#res_data').html(data);
                              },
                    });
                  }
                  function getPayData2()
                  {
                    var id=parseFloat($('#amount2').val());
                    $.ajax({
                      url: '/user/getpaydata',
                      type: "POST",
                      data: {sum:id,uid:<?=Yii::app()->user->id?>},
                      success: function(data) {
                                $('#res_data2').html(data);
                              },
                    });
                  }
                  </script>
                  <form method="post" action="https://www.liqpay.com/api/checkout">
                    <div class="col-12">
                        <div class="col-8">
                            <table border="0">
                                <tr style="height: 45px;">
                                    <td align="right" style="width:200px"><span class="balans_label">Текущий баланс:</span></td>
                                    <td align="left" style="width:200px; padding-left: 15px;"><span class="balans_now_red"><?=is_object($u->balans)?$u->balans->balans:0?> грн.</span></td>
                                </tr>
                                <tr style="height: 45px;">
                                    <td align="right" style="width:200px"><span class="balans_label">Сумма, грн:</span></td>
                                    <td align="left" style="width:200px; padding-left: 15px;"><input type="text" name="amount" id="amount" class="default__input_balans" onkeyup="getPayData()" /></td>
                                </tr>
                            </table>
                         </div>
                        <div class="col-4">
                            <table border="0">
                                <tr style="height: 45px;">
                                    <td align="left">
                                        <input type="radio" name="system" id="sys_pb" value="pb" class="default-input__radio" checked="checked" />
                                        <label for="sys_pb"><span class="balans_label">LiqPay</span></label>
                                    </td>
                                </tr>
                                <tr style="height: 45px;">
                                    <td align="left"></td>
                                </tr>
                            </table>     
                        </div>
                    </div>
                    <div class="col-12" align="center">
                        <div id="res_data"></div>
                    </div>
                  </form>  
                  </div>
                </div>
              </div>
            </div>
      </div>  
      <?php endif; ?>    
      
    </div>
  </nav>
  <div class="wrapper wrapper--dropdownmenu">
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
                $list1=$model->localized('ru')->findAll('cat_id=:cid',array(':cid'=>$v->id));
                $i=1;
                foreach($list1 as $k1=>$v1) {
                    //echo '<li class="dropdownmenu__item__list__item"><a href="" class="dropdownmenu__item__list__item__link">Воздушные акробаты<span class="dropdown__link__col">&nbsp;(25)</span></a></li>';
                    if($v1->alias!='')
                    {
                        $alias=$v1->alias;    
                    }
                    else
                    {
                        $alias=Settings::toLatin($v1->name);
                        Occupation::model()->updateByPk($v1->id,array('alias'=>$alias));
                    }
                    
                    if(Yii::app()->getRequest()->getParam('id')==$v1->id && Yii::app()->controller->id=='cat')
                        echo '<li class="dropdownmenu__item__list__item"><a href="'.$this->createUrl('/cat/view',array('alias'=>$alias)).'" class="dropdownmenu__item__list__item__link dropdownmenu__item__list__item__link--current">'.$v1->name.'<span class="dropdown__link__col">&nbsp;('.Occupation::CalcUsers($v1->id).')</span></a></li>';
                    else
                        echo '<li class="dropdownmenu__item__list__item"><a href="'.$this->createUrl('/cat/view',array('alias'=>$alias)).'" class="dropdownmenu__item__list__item__link">'.$v1->name.'<span class="dropdown__link__col">&nbsp;('.Occupation::CalcUsers($v1->id).')</span></a></li>';
                    //$i++;
                }
          }
          ?>
            </ul>
          </li>  
        </ul>
    </div>
  </div>
  <div class="wrapper wrapper--cities-hidden">
    <script>
        function setCity(arg) {
            $.ajax({
                url: '/site/setcity',
                type: 'get',
                data: {id: arg, url: '<?=Yii::app()->controller->id?>/<?=$this->action->id?>', get: '<?=serialize($_GET);?>'},
                dataType: 'json',
                success: function(data) {
                    //alert(data);
                    $('#cur_city').html(data['name']);
                    $('.wrapper--cities-hidden').slideToggle(400);
                    window.location.href=data['url'];
                    //window.location.href='<?=$this->createUrl('/'.Yii::app()->controller->id.'/'.$this->action->id)?>';
                }
            });
        }
    </script>
    <section class="container">
        <h6 class="cities-hidden__title">Укажите город в котором вы живете или ищите услугу</h6>
          <ul class="cities-hidden__list">
            <?php
            //print_r(Yii::app()->request->cookies);
            $cities=City::model()->findAll(array('order'=>'name asc'));
            $active='';
            foreach($cities as $city) {
                if(isset(Yii::app()->request->cookies['city'])) {
                    if(Yii::app()->request->cookies['city']->value==$city->id) $active=' cities-hidden__link--current';
                    else $active='';
                }
                
                echo '<li class="cities-hidden__item">';
                echo '<a href="#" class="cities-hidden__link'.$active.'" onClick="setCity('.$city->id.')">'.$city->name.'</a>';
                echo '</li>';
            }
            ?>
          </ul>
    </section>
  </div>
  
  <?php
  ////////include search/////////////
  if(!isset(Yii::app()->controller->module->id) && Yii::app()->controller->id!='page') {
    if(Yii::app()->controller->id=='cat') {
        if(in_array(Yii::app()->getRequest()->getParam('id'), array(1,2,4,18,19))) {
          if(is_file('./themes/hm-theme/views/search/_photo.php')) {
            $this->renderFile('./themes/hm-theme/views/search/_photo.php');
          }
        }
        else {
          if(is_file('./themes/hm-theme/views/search/_'.Yii::app()->controller->id.'.php')) {
            $this->renderFile('./themes/hm-theme/views/search/_'.Yii::app()->controller->id.'.php');
          }  
        }
    }
    else {
        if(Yii::app()->controller->id=='tenders') {
          if(is_file('./themes/hm-theme/views/search/_tenders.php')) {
            $this->renderFile('./themes/hm-theme/views/search/_tenders.php');
          }
        }
        //elseif(Yii::app()->controller->id=='actions' && !isset($_GET['id'])) {
        elseif(Yii::app()->controller->id=='actions') {
          if(is_file('./themes/hm-theme/views/search/_actions.php')) {
            $this->renderFile('./themes/hm-theme/views/search/_actions.php');
          }
        }    
    }
  }
  ?>
  
    <?php if(isset($this->breadcrumbs) && !isset(Yii::app()->controller->module->id)):?>
        <div class="wrapper bread-crumbs">
            <div class="container">
        		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
        			'links'=>$this->breadcrumbs,
                    'separator'=>'',
                    'homeLink'=>CHtml::link(Yii::t('menu','home_link'), Yii::app()->request->hostInfo.'/', array('class'=>'bread-crumbs-link_main')),
                    'activeLinkTemplate'=>'<a href="{url}" class="bread-crumbs-link">{label}</a>',
                    'encodeLabel'=>'false',
        		)); ?><!-- breadcrumbs -->
            </div>
       </div>   
	<?php endif?>
  
  <?php echo $content; ?>


  <div class="wrapper wrapper-big-banner">
    <a class="big-banner__link" href="https://www.ideax-nescafe.com.ua/2388661">
        <!--span class="container">
            <span class="big-banner__link--large-text">Рекламный</span>
            <br>баннер
        </span-->
    </a>
  </div>
  <div class="wrapper wrapper--footer-text">
    <div class="container container--footer-text">
      <p><span>Happymoments.ua</span> - это портал быстрого и удобного поиска профессионалов для проведения любого типа мероприятия, а также для удобного поиска фотостудии,банкетного зала, ивент агенство, которые помогут создать праздник, которого Вы достойны. На нашем портале вы можете найти такие услуги как: аренда автомобилей,развлечения и шоу программы , которые порадуют Вас и ваших гостей,а так же другие ....  В каком бы городе Вы не находились,участники нашего сайта смогут организовать самый не забываемый и яркий праздник для Вас,вашей семьи,друзей,коллег...</p>
    </div>
  </div>
  <div class="wrapper wrapper--footer">
    <footer class="container container--footer">
       <div class="social-copy-wrapper">
         <div class="social">
          <div class="social-text">Мы в соц. сетях</div>
          <a class="social-link tw" target="_blank" href="https://twitter.com/HMUkraine"></a>
          <a class="social-link vk" target="_blank" href="https://vk.com/happymoments"></a>
          <a class="social-link fb" target="_blank" href="https://www.facebook.com/pages/Happy-Moments/347923621985767"></a>
         </div>
         <div class="copy">
           ©   2012—<?=date('Y')?><br>
           Все работы выложенные на сайте являються  собственностью их авторов. По вопросам использования работ связывайтесь с авторами.
         </div>
       </div>
       <!-- end social-copy-wrapper -->
       <div class="footer-info">
         <div class="footer-header">Информация</div>
         <a class="footer-link footer-info-link" href="<?=$this->createUrl('page/about')?>">О проекте</a>
         <!--a class="footer-link footer-info-link" href="<?=$this->createUrl('page/news')?>">Новости</a-->
         <!--a class="footer-link footer-info-link" href="#">Помощь в разработке</a-->
       </div>
       <!-- end footer-info -->
       <div class="footer-info">
         <div class="footer-header">Сотрудничество</div>
         <a class="footer-link footer-info-link" href="#">Условия размещения</a>
         <!--a class="footer-link footer-info-link" href="#">Помощь проекту</a>
         <a class="footer-link footer-info-link" href="#">Реклама на сайте</a-->         
       </div>
       
      <!--div class="footer-popular">
        <div class="footer-header">Популярные категории</div>
        <div class="footer-links-block">
          <a class="footer-link" href="#">Фотографы</a>
          <a class="footer-link" href="#">Видеооператоры</a>
          <a class="footer-link" href="#">Аниматоры</a>
          <a class="footer-link" href="#">Свадьбы</a>
          <a class="footer-link" href="#">Аренда</a>
          <a class="footer-link" href="#">Загс</a>
        </div>
        <div class="footer-links-block">
          <a class="footer-link" href="#">Фотографы</a>
          <a class="footer-link" href="#">Видеооператоры</a>
          <a class="footer-link" href="#">Аниматоры</a>
          <a class="footer-link" href="#">Свадьбы</a>
          <a class="footer-link" href="#">Фотографы</a>
          <a class="footer-link" href="#">Видеооператоры</a>
        </div>
        <div class="footer-links-block">
          <a class="footer-link" href="#">Фотографы</a>
          <a class="footer-link" href="#">Видеооператоры</a>
          <a class="footer-link" href="#">Аниматоры</a>
          <a class="footer-link" href="#">Свадьбы</a>
          <a class="footer-link" href="#">Фотографы</a>
          <a class="footer-link" href="#">Видеооператоры</a>
        </div>
      </div-->
      <!-- end footer-popular -->
    </footer>
  </div>
  <a href="#" class="scrollup"></a>
  <a href="mailto:#" class="writeletter-btn--fixed"></a>
  <div class="loader"></div>
  <?php
  if(Yii::app()->user->hasFlash('success_save') || Yii::app()->user->hasFlash('pass_save')) {
  ?>
    <div class="apply"><?=Yii::t('main','Your data save');?></div>
    <script>
    $(document).ready(function(){
        $('.apply').css('display','block');
        $('.apply').delay(2000).fadeOut();
    });    
    </script>
  <?php
  } elseif(Yii::app()->user->hasFlash('add_occ')) {
  ?>
  <div class="apply"><?=Yii::t('main','Category already added');?></div>
    <script>
    $(document).ready(function(){
        $('.apply').css('display','block');
        $('.apply').delay(3500).fadeOut();
    });    
    </script>
  <?php  
  } elseif(Yii::app()->user->hasFlash('create_occ')) {
  ?>
  <div class="apply"><?=Yii::t('main','Category added');?></div>
    <script>
    $(document).ready(function(){
        $('.apply').css('display','block');
        $('.apply').delay(3000).fadeOut();
    });    
    </script>
  <?php  
  } elseif(Yii::app()->user->hasFlash('add_favorite')) {
  ?>
  <div class="apply"><?=Yii::app()->user->getFlash('add_favorite');?></div>
    <script>
    $(document).ready(function(){
        $('.apply').css('display','block');
        $('.apply').delay(3000).fadeOut();
    });    
    </script>
  <?php  
  } elseif(Yii::app()->user->hasFlash('balans_add')) {
  ?>
  <div class="apply"><?=Yii::app()->user->getFlash('balans_add');?></div>
    <script>
    $(document).ready(function(){
        $('.apply').css('display','block');
        $('.apply').delay(3000).fadeOut();
    });    
    </script>
  <?php  
  } elseif(Yii::app()->user->hasFlash('account_activated')) {
  ?>
  <div class="apply"><?=Yii::t('register','Account activated');?></div>
    <script>
    $(document).ready(function(){
        $('.apply').css('display','block');
        $('.apply').delay(3000).fadeOut();
    });    
    </script>
  <?php  
  }
  ?>
</div>
</body>
</html>