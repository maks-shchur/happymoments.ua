<?php
/* @var $this PricesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Prices',
);
?>


<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/min/jquery.tooltipster.min.js'); ?>

<script>                     
        function show(arg) { 
                //alert($('#tip_'+arg).prop('title'));
                $('.tooltipster').tooltipster({
                      trigger: 'custom',
                      position: 'bottom-right',
                      positionTracker: 'true',
                      offsetX: 75,
                      interactive: true,
                      contentAsHTML: 'true'
                });
                
                $('.tooltipster').tooltipster('hide');
                
                //alert($('.tooltipster').tooltipster('content'));
                $('#tip_'+arg).tooltipster('content', $('#tip_'+arg).attr('data-text'));
                //$('.tooltipster').tooltipster('content', $('#tip_'+arg).attr('data-text'));
                $('#tip_'+arg).tooltipster('show');
                
                $('.tooltip_cost_edit').click(function(){
                    id = $('#tip_'+arg).attr("data-set");      
                    $.ajax({
                        type: "POST",
                        url: "/my/prices/showform/id/" + id,
                        success: function(data) {           
                           $('.tooltipster').tooltipster('content', data);
                           //$('.tooltipster').tooltipster('show');
                           //$(".tooltipster-content").html(data);                   
                        }
                    });
                    return false;
                });
        }
        
        
        function closeTip(arg) {
            //$('#tip_'+arg).tooltipster('hide');
            //$('.tooltipster').tooltipster('destroy');
            //$('.tooltipster').tooltipster('content','1');
            window.location.reload();
        }
        function close_tip() {
            //$('#tip_'+arg).tooltipster('hide');
            $('.tooltipster').tooltipster('destroy');
            //$('.tooltipster').tooltipster('content','1');
        }
    </script>

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
            <?php if($user->member!=0):?>
                <?php if($user->occupation->templ=='members'):?>
                    <li><?=CHtml::link('Портфолио','/my/portfolio/');?></li>
                    <li><?=CHtml::link('Календарь занятости','/my/calendar/');?></li>
                    <?php if($user->genre_id!=''): ?>
                    <li><?=CHtml::link('Цены','/my/prices/',array('class'=>'active'));?></li>
                    <?php endif; ?>
                <?php elseif($user->occupation->templ=='avto'):?>
                    <li><?=CHtml::link('Авто парк','/my/avto/');?></li>
                <?php elseif($user->occupation->templ=='flo'):?>
                    <li><?=CHtml::link('Продукция','/my/flo/');?></li>
                <?php elseif($user->occupation->templ=='rent_photo'):?>
                    <li><?=CHtml::link('Интерьеры','/my/studio/interior');?></li>
                    <li><?=CHtml::link('Аренда','/my/studio/rent');?></li>
                    <li><?=CHtml::link('Оборудование','/my/studio/equip');?></li>
                    <!--li><?=CHtml::link('Услуги','/my/studio/services');?></li>
                    <li><?=CHtml::link('3D  туры','/my/studio/tours');?></li-->
                    <li><?=CHtml::link('Цены','/my/studio/prices');?></li>
                    <li><?=CHtml::link('Календарь занятости','/my/calendar/');?></li>
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
        <header class="cabinet__header">
          <div class="cabinet__title clfx">
            <div class="accaunt__right__header__name col-8">
              <h1><?=Yii::app()->user->name;?></h1>
              <?php //if(Yii::app()->user->member!=0):?>
              <div class="accaunt__status <?=Yii::app()->user->member_type;?>"><?=Yii::app()->user->member_type;?></div>
              <span class="accaunt__role"><?=Occupation::getName($user->occupation_id);?></span>
              <? //endif; ?>
            </div>
            <div class="accaunt__right__header__rate pt25 col-4">
              <?=Users::getTimeAgo($user->date_registered);?>
            </div>
          </div>
          <nav class="cabinet__second-menu">
            <ul>
              <li class="active"><?=CHtml::link('Профиль','/my/profile/');?></li>
              <li><?=CHtml::link('Избранное','/my/favorites/');?></li>
              <?php if($user->member_type!='basic'):?>
                    <li><?=CHtml::link('Мои акции','/my/actions/');?></li>
                <?php endif;?>
              <li><?=CHtml::link('Мои тендеры','/my/tenders/');?></li>
                <?php /* ?><li><?=CHtml::link('Сообщения','/my/messages/');?></li><?php */ ?>
              <li><?=CHtml::link('Настройки','/my/profile/settings');?></li>
            </ul>
          </nav>
        </header>
        <?php
        //$genres=unserialize($user->genre_id);
        
        if(Yii::app()->user->role==2) { //videooperator
            $genres=Video::model()->findAllByAttributes(array('uid'=>Yii::app()->user->id));
        }
        else {
            $genres=Portfolio::model()->findAllByAttributes(array('uid'=>Yii::app()->user->id));
        }
        if(count($genres)>0):
        ?>
        <main class="cabinet__portfolio">
        <table class="cost-table">
          <tr>
            <th>Название услуги</th>
            <th>Пакет 1 (грн.)</th>
            <th>Пакет 2 (грн.)</th>
            <th>Пакет 3 (грн.)</th>
            <th>Пакет 4 (грн.)</th>
            <th>Пакет 5 (грн.)</th>
          </tr>
          <?php
          //print_r($genres); exit();
          foreach($genres as $val) {
            if(Yii::app()->user->role==2) $cnt_files=Files::model()->countByAttributes(array('uid'=>Yii::app()->user->id, 'type'=>'video', 'portfolio_id'=>$val->id));
            else $cnt_files=Files::model()->countByAttributes(array('uid'=>Yii::app()->user->id, 'type'=>'photo', 'portfolio_id'=>$val->id));
            
            //if($cnt_files>0):
            echo '<tr>
                    <td>'.$val->title.'</td>';
                    
            //$pack1=Prices::model()->findByAttributes(array('price'),'genre_id=:gen and package=1',array(':gen'=>$val));
            $pack1=Prices::model()->findByAttributes(array('genre_id'=>$val->id,'package'=>1,'user_id'=>Yii::app()->user->id));
            if(is_object($pack1)) {
                $tip="<span class='close__tip' onClick=close_tip()>X</span><div class='tooltip_cost_edit' id='tip_edit_".$val->id."_1'>редактировать</div>";
                $tip.="<div class='tooltip_cost_title'>".$val->title."</div>
                            <p class='tooltip_cost_text'>Описание услуги: ".$pack1->about."</p>";
                echo '<td><span class="tooltipster" id="tip_'.$val->id.'_1" title="'.$tip.'" data-text="'.$tip.'" data-set="'.$val->id.'_1" onmouseover="show(\''.$val->id.'_1\')">'.$pack1->price.' <div class="cost-info"></div></span></td>';
            }
            else {
                $tip="<span class='close__tip' onClick=close_tip()>X</span><div class='tooltip_cost_edit' id='tip_edit_".$val->id."_1'>редактировать</div><div class='tooltip_cost_title'>".$val->title."</div>
                            <p class='tooltip_cost_text'>Описание услуги: </p>";
                echo '<td><span class="tooltipster" id="tip_'.$val->id.'_1" title="'.$tip.'" data-set="'.$val->id.'_1" onmouseover="show(\''.$val->id.'_1\')">0 <div class="cost-info"></div></span></td>';
            }
                
            $pack2=Prices::model()->findByAttributes(array('genre_id'=>$val->id,'package'=>2,'user_id'=>Yii::app()->user->id));
            if(is_object($pack2)) {
                $tip="<span class='close__tip' onClick=close_tip()>X</span><div class='tooltip_cost_edit' id='tip_edit_".$val->id."_2'>редактировать</div><div class='tooltip_cost_title'>".$val->title."</div>
                            <p class='tooltip_cost_text'>Описание услуги: ".$pack2->about."</p>";
                echo '<td><span class="tooltipster" id="tip_'.$val->id.'_2" title="'.$tip.'" data-text="'.$tip.'" data-set="'.$val->id.'_2" onmouseover="show(\''.$val->id.'_2\')">'.$pack2->price.' <div class="cost-info"></div></span></td>';
            }
            else {
                if(is_object($pack1)) {
                    $tip="<span class='close__tip' onClick=close_tip()>X</span><div class='tooltip_cost_edit' id='tip_edit_".$val->id."_2'>редактировать</div><div class='tooltip_cost_title'>".$val->title."</div>
                                <p class='tooltip_cost_text'>Описание услуги: </p>";
                    echo '<td><span class="tooltipster" id="tip_'.$val->id.'_2" title="'.$tip.'" data-set="'.$val->id.'_2" onmouseover="show(\''.$val->id.'_2\')">0 <div class="cost-info"></div></span></td>';
                }
                else
                    echo '<td><span data-set="'.$val->id.'_2">0</span></td>';
            }
                
            $pack3=Prices::model()->findByAttributes(array('genre_id'=>$val->id,'package'=>3,'user_id'=>Yii::app()->user->id));
            if(is_object($pack3)) {
                $tip="<span class='close__tip' onClick=close_tip()>X</span><div class='tooltip_cost_edit' id='tip_edit_".$val->id."_3'>редактировать</div><div class='tooltip_cost_title'>".$val->title."</div>
                            <p class='tooltip_cost_text'>Описание услуги: ".$pack3->about."</p>";
                echo '<td><span class="tooltipster" id="tip_'.$val->id.'_3" title="'.$tip.'" data-text="'.$tip.'" data-set="'.$val->id.'_3" onmouseover="show(\''.$val->id.'_3\')">'.$pack3->price.' <div class="cost-info"></div></span></td>';
            }
            else {
                if(is_object($pack2)) {
                    $tip="<span class='close__tip' onClick=close_tip()>X</span><div class='tooltip_cost_edit' id='tip_edit_".$val->id."_3'>редактировать</div><div class='tooltip_cost_title'>".$val->title."</div>
                                <p class='tooltip_cost_text'>Описание услуги: </p>";
                    echo '<td><span class="tooltipster" id="tip_'.$val->id.'_3" title="'.$tip.'" data-set="'.$val->id.'_3" onmouseover="show(\''.$val->id.'_3\')">0 <div class="cost-info"></div></span></td>';
                }
                else
                    echo '<td><span data-set="'.$val->id.'_3">0</span></td>'; 
            }
            
            $pack4=Prices::model()->findByAttributes(array('genre_id'=>$val->id,'package'=>4,'user_id'=>Yii::app()->user->id));
            if(is_object($pack4)) {
                $tip="<span class='close__tip' onClick=close_tip()>X</span><div class='tooltip_cost_edit' id='tip_edit_".$val->id."_4'>редактировать</div><div class='tooltip_cost_title'>".$val->title."</div>
                            <p class='tooltip_cost_text'>Описание услуги: ".$pack4->about."</p>";
                echo '<td><span class="tooltipster" id="tip_'.$val->id.'_4" title="'.$tip.'" data-text="'.$tip.'" data-set="'.$val->id.'_4" onmouseover="show(\''.$val->id.'_4\')">'.$pack4->price.' <div class="cost-info"></div></span></td>';
            }
            else {
                if(is_object($pack3)) {
                    $tip="<span class='close__tip' onClick=close_tip()>X</span><div class='tooltip_cost_edit' id='tip_edit_".$val->id."_4'>редактировать</div><div class='tooltip_cost_title'>".$val->title."</div>
                                <p class='tooltip_cost_text'>Описание услуги: </p>";
                    echo '<td><span class="tooltipster" id="tip_'.$val->id.'_4" title="'.$tip.'" data-set="'.$val->id.'_4" onmouseover="show(\''.$val->id.'_4\')">0 <div class="cost-info"></div></span></td>';
                }
                else
                    echo '<td><span data-set="'.$val->id.'_4">0</span></td>';
            }
            
            $pack5=Prices::model()->findByAttributes(array('genre_id'=>$val->id,'package'=>5,'user_id'=>Yii::app()->user->id));
            if(is_object($pack5)) {
                $tip="<span class='close__tip' onClick=close_tip()>X</span><div class='tooltip_cost_edit' id='tip_edit_".$val->id."_5'>редактировать</div><div class='tooltip_cost_title'>".$val->title."</div>
                            <p class='tooltip_cost_text'>Описание услуги: ".$pack5->about."</p>";
                echo '<td><span class="tooltipster" id="tip_'.$val->id.'_5" title="'.$tip.'" data-text="'.$tip.'" data-set="'.$val->id.'_5" onmouseover="show(\''.$val->id.'_5\')">'.$pack5->price.' <div class="cost-info"></div></span></td>';
            }
            else {
                if(is_object($pack4)) {
                    $tip="<span class='close__tip' onClick=close_tip()>X</span><div class='tooltip_cost_edit' id='tip_edit_".$val->id."_5'>редактировать</div><div class='tooltip_cost_title'>".$val->title."</div>
                                <p class='tooltip_cost_text'>Описание услуги: </p>";
                    echo '<td><span class="tooltipster" id="tip_'.$val->id.'_5" title="'.$tip.'" data-set="'.$val->id.'_5" onmouseover="show(\''.$val->id.'_5\')">0 <div class="cost-info"></div></span></td>';
                }
                else
                    echo '<td><span data-set="'.$val->id.'_5">0</span></td>';
            }
            
            echo '</tr>';
            //endif;
          }
          ?>
        </table>
        <?php
        else:
            echo '<div class="no-results">Вам необходимо указать жанры, у которых Вы работаете.<br />Вы можете сделать это на <a href="/my/profile">странице Вашего профиля</a></div>';
        endif;
        ?>
        </main>
        

      </div>
    </div>
  </div>