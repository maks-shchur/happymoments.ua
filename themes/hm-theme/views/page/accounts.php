<?php
/* @var $this PageController */

$this->breadcrumbs=array(
	'Accounts',
);

?>
<div class="container">
    <div class="col-6">
        <div class="account_plus">
            <span id="title">Happy moments Plus</span>
            <span id="subtitle">Доступен всем участникам портала Happymoments.ua</span>
            <?php if(!Yii::app()->user->isGuest && (Yii::app()->user->member_type=='plus' || Yii::app()->user->member_type=='pro')): ?>
            <a href="" class="account_plus_btn2" data-toggle="modal" data-target="#__accaunt_balans_buy">
                    <span id="acc_plus1_1">Продлить Plus</span>
            </a>
            <?php else: ?>            
            <a href="" class="account_plus_btn2" data-toggle="modal" data-target="#__accaunt_balans_buy">
                    <span id="acc_plus1_1">Купить Plus</span>
            </a>
            <?php endif; ?>
            <div class="dot-line"></div>
            <span id="title2">Участие в тендерах</span>
            <span id="text">Тендеры - это рассылка заказов (предложений о<br />
             работе от заказчиков на конкурсной основе<br /> 
             по вашему направлению)
            </span>
            
            <span id="title2">Акционные предложения</span>
            <span id="text">Акционные предложения  - это предложения, которые<br />
                действуют в определенный период на ваши услуги<br /> 
                в том размере, который определяете вы
            </span>
            
            <span id="priority">Приоритетность в поиске, над аккаунтами Basic</span>
        </div>
        <?php if(Yii::app()->user->isGuest || Yii::app()->user->member_type=='basic'): ?>
        <button class="account_plus_btn" data-toggle="modal" data-target="#__accaunt_balans_buy">
            <span id="acc_plus1">Купить Plus</span>
            <span id="acc_plus2">400 грн/год</span>
        </button>
        <?php endif; ?> 
    </div>
    <div class="col-6">
        <div class="account_pro">
            <span id="title">Happy moments Pro</span>
            <span id="subtitle">Доступен только профессионалам портала<br />Happymoments.ua</span>
            <?php if(!Yii::app()->user->isGuest && Yii::app()->user->member_type=='pro'): ?>
            
            <?php else: ?>
            <a href="/site/accept_pro" class="account_pro_btn2">
                    <span id="acc_pro1_1">Активировать Pro</span>
                    <span id="acc_pro2_1">бесплатно</span>
            </a>
            <?php endif; ?>
            <div class="dot-line"></div>
            <span id="title2">Участие в тендерах</span>
            <span id="text">Тендеры - это рассылка заказов (предложений о<br />
             работе от заказчиков на конкурсной основе<br /> 
             по вашему направлению)
            </span>
             
            <span id="title2">Акционные предложения</span>
            <span id="text">Акционные предложения  - это предложения, которые<br />
                действуют в определенный период на ваши услуги<br /> 
                в том размере, который определяете вы
            </span>
            
            <span id="title2">Сотрудничество с <a href="/hmagent">HM Agent</a><br />компании Happymoments</span>
            <span id="text">HM Agent - бесплатный персональный помощник<br /> 
                в поиске артистов, ведущих, фотографов,<br /> 
                развлечений и шоу-программ!<br />
                HM Agent! Один звонок - и лучшие<br /> 
                предложения уже у Вас!
            </span>
            
            <a href="" class="rules">Правила сотрудничества с  HM Agent</a>
            
            <span id="priority">Приоритетность в поиске, над аккаунтами<br />Basic и Plus</span>
        </div>
        <?php if(Yii::app()->user->isGuest || Yii::app()->user->member_type!='pro'): ?>
        <a href="/site/accept_pro">
            <div class="account_pro_btn">
                <span id="acc_pro1">Активировать Pro</span>
                <span id="acc_pro2">бесплатно</span>
            </div>
        </a>
        <?php endif; ?>
    </div>
</div>


<div class="modal fade" id="__accaunt_balans_buy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 2000;">
  <div class="modal-dialog">
    <div class="modal-content">
      <header class="add-albom__modal__header"><h6>HAPPY MOMENTS PLUS</h6><a href="#0" data-dismiss="modal" class=""></a></header>
      <div class="choose__modal__content">
      <?php if(Yii::app()->user->isGuest): ?>
      <p class="balans_smal_text"><strong>Оплату Вы сможете совершить только после авторизации!</strong></p>
      <?php endif; ?>
      <p class="balans_smal_text">Обратите внимание: подписка стоит меньше, если вы оформляете ее на дольше</p>
      <?php if(!Yii::app()->user->isGuest && Yii::app()->user->member_type!='pro'): ?>
        <script>
        function Pay(m,sum) {
            $.ajax({
              url: '/user/subscribe',
              type: "POST",
              data: {sum:sum,uid:<?=Yii::app()->user->id?>,month:m},
              success: function(data) {
                        $('.choose__modal__content').html(data);
                      },
            });    
        }
        </script>
        <div class="col-12">
            <div class="choose1" onclick="Pay(1,49)">
                <span class="choose_month">1 месяц</span>  
                <span class="choose_price">49</span>
                <span class="choose_uah">грн</span> 
                <span class="choose_note"></span> 
            </div>
            <div class="choose3" onclick="Pay(3,129)">
                <span class="choose_month">3 месяца</span>
                <span class="choose_price">129</span>
                <span class="choose_uah">грн</span>
                <span class="choose_note">43 грн в месяц</span>
            </div>
            <div class="choose6" onclick="Pay(6,219)">
                <span class="choose_month">6 месяцев</span>
                <span class="choose_price">219</span>
                <span class="choose_uah">грн</span>
                <span class="choose_note">36 грн в месяц</span>
            </div>
            <div class="choose12" onclick="Pay(12,399)">
                <span class="choose_month">12 месяцев</span>
                <span class="choose_price">399</span>
                <span class="choose_uah">грн</span>
                <span class="choose_note">30 грн в месяц</span>
            </div>
        </div>
      <?php else: ?>
        <div class="col-12">
            <div class="choose1">
                <span class="choose_month">1 месяц</span>  
                <span class="choose_price">49</span>
                <span class="choose_uah">грн</span> 
                <span class="choose_note"></span> 
            </div>
            <div class="choose3">
                <span class="choose_month">3 месяца</span>
                <span class="choose_price">129</span>
                <span class="choose_uah">грн</span>
                <span class="choose_note">43 грн в месяц</span>
            </div>
            <div class="choose6">
                <span class="choose_month">6 месяцев</span>
                <span class="choose_price">219</span>
                <span class="choose_uah">грн</span>
                <span class="choose_note">36 грн в месяц</span>
            </div>
            <div class="choose12">
                <span class="choose_month">12 месяцев</span>
                <span class="choose_price">399</span>
                <span class="choose_uah">грн</span>
                <span class="choose_note">30 грн в месяц</span>
            </div>
        </div>
      <?php endif; ?>  
      </div>
    </div>
  </div>
</div>
