<?php
/* @var $this ProfileController */

$this->breadcrumbs=array(
	'Profile',
);
?>
  <?php
  if(!Yii::app()->user->isGuest) {
    if(Yii::app()->user->member=='0') {
  ?>
  <div class="wrapper cabinet-general__profile__banner">
    <div class="wrapper cabinet-general__profile__banner-overlay"></div>
    <div class="container">
      <figure class="cabinet-general__ava">
        <?php
        if(is_file('./users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo)) {
            echo CHtml::image('/users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo,'My photo',array('id'=>'my_ava'));
        }
        else {
            echo CHtml::image('/img/zaglushka.png','My photo',array('id'=>'my_ava'));
        }
        ?>
        
        <figcaption>
            <?php
            $this->widget('ext.EAjaxUpload.EAjaxUpload',
            array(
                    'id'=>'uploadFile',
                    'config'=>array(
                           'action'=>Yii::app()->createUrl('my/profile/updateava',array('id'=>Yii::app()->user->id)),
                           'allowedExtensions'=>array("jpg","jpeg","gif","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                           'sizeLimit'=>2*1024*1024,// maximum file size in bytes
                           //'minSizeLimit'=>10*1024*1024,// minimum file size in bytes
                           'onComplete'=>"js:function(id, fileName, responseJSON){ $('#my_ava').attr('src', '/users/".Yii::app()->user->id."/'+fileName); location.reload(); }",
                           //'messages'=>array(
                           //                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                           //                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                           //                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                           //                  'emptyError'=>"{file} is empty, please select files again without it.",
                           //                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                           //                 ),
                           //'showMessage'=>"js:function(message){ alert(message); }"
                          )
            ));
            ?>
        </figcaption>
    </figure>
    </div>
  </div>
  <?php    
    }
    else {
    if(Yii::app()->user->member_type=='basic') {
  ?>
      <div class="container">
      <figure class="cabinet-general__ava" style="top:10px !important;">
        <?php
        if(is_file('./users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo)) {
            echo CHtml::image('/users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo,'My photo',array('id'=>'my_ava'));
        }
        else {
            echo CHtml::image('/img/zaglushka.png','My photo',array('id'=>'my_ava'));
        }
        ?>
        
        <figcaption>
            <?php
            $this->widget('ext.EAjaxUpload.EAjaxUpload',
            array(
                    'id'=>'uploadFile',
                    'config'=>array(
                           'action'=>Yii::app()->createUrl('my/profile/updateava',array('id'=>Yii::app()->user->id)),
                           'allowedExtensions'=>array("jpg","jpeg","gif","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                           'sizeLimit'=>2*1024*1024,// maximum file size in bytes
                           //'minSizeLimit'=>10*1024*1024,// minimum file size in bytes
                           'onComplete'=>"js:function(id, fileName, responseJSON){ $('#my_ava').attr('src', '/users/".Yii::app()->user->id."/'+fileName); location.reload(); }",
                           //'messages'=>array(
                           //                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                           //                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                           //                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                           //                  'emptyError'=>"{file} is empty, please select files again without it.",
                           //                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                           //                 ),
                           //'showMessage'=>"js:function(message){ alert(message); }"
                          )
            ));
            ?>
        </figcaption>
    </figure>
    </div>
  <?php      
    }    
    if(Yii::app()->user->member_type=='plus' || Yii::app()->user->member_type=='pro') {
        
  ?>
  <style>
  .cabinet-pro-banner__upload {
    bottom: -196px !important;
  }
  </style>
  <div class="wrapper cabinet-pro-banner cabinet-plus-banner" id="top_banner">
    <div class="container">
      <?php
      if($model->top_banner!=''):
      ?> 
      <a href="/my/profile/delbanner"><div class="cabinet-pro-banner__del"></div></a>
      <style>
      #top_banner {
        background: url('/users/<?=$user->id?>/<?=$model->top_banner?>') no-repeat !important;  
      }
      </style>
      <?php
      else:
      ?>
      <?php
      /*   $this->widget('ext.Banner.Banner',
        array(
                'id'=>'uploadBanner',
                'config'=>array(
                       'action'=>Yii::app()->createUrl('/my/profile/addbanner'),
                       'allowedExtensions'=>array("jpg","jpeg","gif","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                       'sizeLimit'=>8*1024*1024,// maximum file size in bytes
                       'minSizeLimit'=>1*1024,
                       'auto'=>true,
                       'multiple' => false,
                       'onComplete'=>"js:function(id, fileName, responseJSON){
                            $('#top_banner').css('background', 'url(/users/".Yii::app()->user->id."/banner_+fileName) no-repeat !important');
                            window.location.reload();
                        }",
                       )
         
         ));*/
        ?>  
      <?php
      endif;
      ?>
      <figure class="cabinet-general__ava" style="top: 140px !important;">
        <?php
        if(is_file('./users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo)) {
            echo CHtml::image('/users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo,'My photo',array('id'=>'my_ava'));
        }
        else {
            echo CHtml::image('/img/zaglushka.png','My photo',array('id'=>'my_ava'));
        }
        ?>
        
        <figcaption>
            <?php
            $this->widget('ext.EAjaxUpload.EAjaxUpload',
            array(
                    'id'=>'uploadFile',
                    'config'=>array(
                           'action'=>Yii::app()->createUrl('my/profile/updateava',array('id'=>Yii::app()->user->id)),
                           'allowedExtensions'=>array("jpg","jpeg","gif","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                           'sizeLimit'=>2*1024*1024,// maximum file size in bytes
                           //'minSizeLimit'=>10*1024*1024,// minimum file size in bytes
                           'onComplete'=>"js:function(id, fileName, responseJSON){ $('#my_ava').attr('src', '/users/".Yii::app()->user->id."/'+fileName); location.reload(); }",
                           //'messages'=>array(
                           //                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                           //                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                           //                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                           //                  'emptyError'=>"{file} is empty, please select files again without it.",
                           //                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                           //                 ),
                           //'showMessage'=>"js:function(message){ alert(message); }"
                          )
            ));
            ?>
        </figcaption>
    </figure>
    </div>
  </div>  
  <?php      
    }
    /*elseif(Yii::app()->user->member_type=='pro') {
  ?>
  <style>
  .qq-upload-button3 input {
    top: 285px !important;
  }
  </style>
  <div class="wrapper cabinet-pro-banner" id="top_banner">
    <div class="container">
      <?php
      if($user->top_banner!=''):
      ?>  
      <a href="/my/profile/delbanner"><div class="cabinet-pro-banner__del"></div></a>
      <style>
      #top_banner {
        background: url('/users/<?=$user->id?>/<?=$user->top_banner?>') no-repeat !important;  
      }
      </style>
      <?php
      else:
      ?> 
      <?php
         $this->widget('ext.Banner.Banner',
        array(
                'id'=>'uploadBanner',
                'config'=>array(
                       'action'=>Yii::app()->createUrl('/my/profile/addbanner'),
                       'allowedExtensions'=>array("jpg","jpeg","gif","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                       'sizeLimit'=>8*1024*1024,// maximum file size in bytes
                       'minSizeLimit'=>1*1024,
                       'auto'=>true,
                       'multiple' => false,
                       'onComplete'=>"js:function(id, fileName, responseJSON){
                            $('#top_banner').css('background', 'url(/users/".Yii::app()->user->id."/banner_+fileName) no-repeat !important');
                            window.location.reload();
                        }",
                       )
         
         ));
        ?> 
      <?php
      endif;
      ?> 
      <figure class="cabinet-general__ava_pro">
        <?php
        if(is_file('./users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo)) {
            echo CHtml::image('/users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo,'My photo',array('id'=>'my_ava'));
        }
        else {
            echo CHtml::image('/img/zaglushka.png','My photo',array('id'=>'my_ava'));
        }
        ?>
        
        <figcaption>
            <?php
            $this->widget('ext.EAjaxUpload.EAjaxUpload',
            array(
                    'id'=>'uploadFile',
                    'config'=>array(
                           'action'=>Yii::app()->createUrl('my/profile/updateava',array('id'=>Yii::app()->user->id)),
                           'allowedExtensions'=>array("jpg","jpeg","gif","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                           'sizeLimit'=>2*1024*1024,// maximum file size in bytes
                           //'minSizeLimit'=>10*1024*1024,// minimum file size in bytes
                           'onComplete'=>"js:function(id, fileName, responseJSON){ $('#my_ava').attr('src', '/users/".Yii::app()->user->id."/'+fileName); location.reload(); }",
                           //'messages'=>array(
                           //                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                           //                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                           //                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                           //                  'emptyError'=>"{file} is empty, please select files again without it.",
                           //                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                           //                 ),
                           //'showMessage'=>"js:function(message){ alert(message); }"
                          )
            ));
            ?>
        </figcaption>
    </figure>
    </div>
  </div>
  <?php      
        }*/
    }
  } 
  ?>  
  <div class="wrapper wrapper-cabinet">
    <div class="container clfx">
      <div class="cabinet-nav">  
                
        <nav class="cabinet__first-menu">
          <ul>
            <li><?=CHtml::link('Информация','/my/profile/');?></li>
            <?php if($model->member!=0):?>
                <?php if($model->occupation->templ=='members'):?>
                    <li><?=CHtml::link('Портфолио','/my/portfolio/');?></li>
                    <li><?=CHtml::link('Календарь занятости','/my/calendar/',array('class'=>'active'));?></li>
                    <?php if($model->genre_id!=''): ?>
                    <li><?=CHtml::link('Цены','/my/prices/');?></li>
                    <?php endif; ?>
                <?php elseif($model->occupation->templ=='avto'):?>
                    <li><?=CHtml::link('Авто парк','/my/avto/');?></li>
                <?php elseif($model->occupation->templ=='flo'):?>
                    <li><?=CHtml::link('Продукция','/my/flo/');?></li>
                <?php elseif($model->occupation->templ=='rent_photo'):?>
                    <li><?=CHtml::link('Интерьеры','/my/studio/interior');?></li>
                    <li><?=CHtml::link('Аренда','/my/studio/rent');?></li>
                    <li><?=CHtml::link('Оборудование','/my/studio/equip');?></li>
                    <!--li><?=CHtml::link('Услуги','/my/studio/services');?></li>
                    <li><?=CHtml::link('3D  туры','/my/studio/tours');?></li-->
                    <li><?=CHtml::link('Цены','/my/studio/prices');?></li>
                    <li><?=CHtml::link('Календарь занятости','/my/calendar/',array('class'=>'active'));?></li>
                <?php else: ?>
                    <li><?=CHtml::link('Портфолио','/my/portfolio/');?></li>
                <?php endif;?>
            <?php endif; ?>
          </ul>
        </nav>
        <?php if(Yii::app()->user->member_type=='basic'):?>
        <div class="cabinet__text-about"></div>
        <div class="cabiner__abount-accaunts">
          <div class="cabiner__abount-accaunts-plus">plus</div>
          <div class="cabiner__abount-accaunts-pro">pro</div>
          <a href="/accounts" class="cabiner__abount-accaunts-readmore">подробнее</a>
        </div>
        <?php elseif(Yii::app()->user->member_type=='plus'): ?>
        <div class="cabinet__text-about"></div>
        <div class="cabiner__abount-accaunts cabiner__plus__bount-accaunts">
          <div class="cabiner__abount-accaunts-pro ">pro</div>
          <a href="/accounts" class="cabiner__abount-accaunts-readmore">подробнее</a>
        </div>
        <?php endif;?>
      </div>
      
      <div class="cabinet-main" <?=(Yii::app()->user->member_type=='basic')?'style="top:-180px !important;"':'';?>>
      <div class="clfx"></div>
        <header class="cabinet__header">
          <div class="cabinet__title clfx">
            <div class="accaunt__right__header__name col-8">
              <h1><?=Yii::app()->user->name;?></h1>
              <?php if(Yii::app()->user->member!=0): ?>
              <div class="accaunt__status <?=Yii::app()->user->member_type;?>"><?=Yii::app()->user->member_type;?></div>
              <span class="accaunt__role"><?=Occupation::getName($model->occupation_id);?></span>
              <?php endif; ?>
            </div>
            <div class="accaunt__right__header__rate pt25 col-4">
              <?=Users::getTimeAgo($model->date_registered);?>
            </div>
          </div>
          <nav class="cabinet__second-menu">
            <ul>
              <li class="active"><?=CHtml::link('Профиль','/my/profile/');?></li>
              <li><?=CHtml::link('Избранное','/my/favorites/');?></li>
              <?php if($model->member_type!='basic'):?>
                  <li><?=CHtml::link('Мои акции','/my/actions/');?></li>
              <?php endif;?>
              <li><?=CHtml::link('Мои тендеры','/my/tenders/');?></li>
                <?php /* ?><li><?=CHtml::link('Сообщения','/my/messages/');?></li><?php */ ?>
              <li><?=CHtml::link('Настройки','/my/profile/settings');?></li>
            </ul>
          </nav>
        </header>

        <div class="cabinet-pro__calendar-container">
            <div class="reserv-calendar__container">
            <?php
           
            
            $year  = date("Y");
            $month = date("n");
            
            $month_name = array(1=>'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');
            
            for($j=1;$j<=12;$j++) {
                $cal = Calendar::my_makeCal($year, $month);
                      
                //выясняем какой будет следующий месяц и какой предидущий и тоже узнаем про год!
                if(($month)==1)
                {
                    $month_minus = 12;
                    $year_minus  = $year-1;
                    $month_plus  = 2;
                    $year_plus   = $year;
                }
                elseif(($month)==12)
                {
                    $month_minus = 11;
                    $year_minus  = $year;
                    $month_plus  = 1;
                    $year_plus   = $year+1;
                }
                else
                {
                    $month_minus = $month-1;
                    $year_minus  = $year;
                    $month_plus  = $month+1;
                    $year_plus   = $year;
                }
        
                $month=date("n")+($j-1);
                if($month>12) $month=$month-12;
                ?>
                    <!-- Шаблон вывода календаря. -->
                    <div class="reserv-calendar">
                        <header class="reserv-calendar__month"><?=$month_name[$month]?> <?=$year_plus?></header>
                        <table class="reserv-calendar__table">
                          <tr>
                            <th>ПН</th>
                            <th>ВТ</th>
                            <th>СР</th>
                            <th>ЧТ</th>
                            <th>ПТ</th>
                            <th>СБ</th>
                            <th>ВС</th>
                          </tr>
                          <?php foreach ($cal as $row) {?>
                            <tr>
                              <?php foreach ($row as $i=>$v) {
                                if(($i==5 || $i==6)) {
                                    if(!empty($v)) $cl='weekend__day cal_day';
                                    else $cl='other-month__day';
                                }
                                else {
                                    if(!empty($v)) $cl='cal_day';
                                    else $cl='other-month__day';
                                }
                                
                                if(!empty($v)) {
                                    if(Calendar::model()->countByAttributes(array('uid'=>Yii::app()->user->id,'day'=>$year_plus."-".$month."-".$v))>0)
                                    {
                                        $cl.=" reserv__day";
                                        $del1="1";
                                    }
                                    else $del1="0";
                                }
                                else $del1="0";  
                              ?>
                                <td class="<?=$cl?>" id="<?=$v ? $v."__".$month."__".$year_plus : ""?>" data-cel="<?=$v ? $v."__".$month."__".$year_plus : ""?>" data-del="<?=$del1?>">
                                  <?=$v ? $v : "&nbsp;"?>
                                </td>
                              <?php } ?>
                            </tr>
                          <?php } ?>
                        </table>
                    </div>
            <?php } ?>
                
                
                
                
                  
                
                <div style="float: left; margin-top:30px; vertical-align: middle; width: 100%;">
                    <span style="background-color: #fb5353;height:43px;width:36px;display:inline-block;"></span>
                    <span style="display: inline-block;top: -15px;left: 10px;position: relative;font-size: 1.2em;"> - дата занята</span>
                </div>
            </div>
        </div>
            
       </div>
       
    </div>
  </div>


