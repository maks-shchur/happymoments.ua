<?php
/* @var $this PricesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Prices',
);

$this->menu=array(
	array('label'=>'Create Prices', 'url'=>array('create')),
	array('label'=>'Manage Prices', 'url'=>array('admin')),
);

$this->widget('ext.tooltipster.tooltipster',
          array(
            'options'=>array(
                'position'=>'bottom',
                'interactive' => true,
                'interactiveTolerance'=>'550',
                'timer'=>'1000',
                'fixedWidth'=>'435',
                'functionBefore'=>'js:function(origin, continueTooltip) { 
                    continueTooltip(); 
                    $(".tooltip_cost_edit").click(function() {
                        id = origin.attr("data-set");      
                        $.ajax({
                            type: "POST",
                            url: "/my/prices/showform/id/" + id,
                            success: function(data) {                   
                               $(".tooltipster-content").html(data);                   
                            }
                        });    
                    });                   
                }',
            )
));
?>

  <div class="wrapper cabinet-general">
    <div class="container">
      <div class="clfx"></div>
      <div class="cabinet-nav">
      <?php
        if(is_file('./users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo)) {
                echo '<a href="#" class="cabinet__user-img">';
                echo CHtml::image('/users/'.Yii::app()->user->id.'/'.Yii::app()->user->photo,'My photo',array('width'=>60));
                echo '</a>';
        }
        ?>
      
        <nav class="cabinet__first-menu">
          <ul>
            <li><?=CHtml::link('Информация','/my/profile/');?></li>
            <?php if(Yii::app()->user->member!=0):?>
            <li><?=CHtml::link('Портфолио','/my/portfolio/');?></li>
            <li><a href="#0">Услуги</a></li>
            <li><?=CHtml::link('Цены','/my/prices/',array('class'=>'active'));?></li>
            <li><a href="#0">Календарь занятости</a></li>
            <?php endif; ?>
          </ul>
        </nav>
      </div>
      <div class="cabinet-main">
        <header class="cabinet__header">
          <div class="cabinet__title clfx">
            <div class="accaunt__right__header__name col-8">
              <h1><?=Yii::app()->user->name;?></h1>
              <?php //if(Yii::app()->user->member!=0):?>
              <div class="accaunt__status <?=Yii::app()->user->member_type;?>"><?=Yii::app()->user->member_type;?></div>
              <span class="accaunt__role"><?=Occupation::getName($user->occupation_id);?></span>
              <? //endif; ?>
            </div>
            <div class="accaunt__right__header__rate col-4">
              <?=Users::getTimeAgo($user->date_registered);?>
            </div>
          </div>
          <nav class="cabinet__second-menu">
            <ul>
              <li class="active"><?=CHtml::link('Профиль','/profile/');?></li>
              <li><a href="#0">Избранное</a></li>
              <li><?=CHtml::link('Мои тендеры','/my/tenders/');?></li>
              <li><?=CHtml::link('Сообщения','/my/messages/');?></li>
              <li><?=CHtml::link('Настройки','/my/profile/settings');?></li>
            </ul>
          </nav>
        </header>
        
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
          $genres=unserialize($user->genre_id);
          //print_r($genres); exit();
          foreach($genres as $key=>$val) {
            echo '<tr>
                    <td>'.Genre::getName($val).'</td>';
                    
            //$pack1=Prices::model()->findByAttributes(array('price'),'genre_id=:gen and package=1',array(':gen'=>$val));
            $pack1=Prices::model()->findByAttributes(array('genre_id'=>$val,'package'=>1));
            if(is_object($pack1)) {
                $tip="<div class='tooltip_cost_edit' id='tip_edit'>редактировать</div>";
                $tip.="<div class='tooltip_cost_title'>".Genre::getName($val)."</div>
                            <p class='tooltip_cost_text'>Описание услуги: ".$pack1->about."</p>";
                echo '<td><span class="tooltipster" title="'.$tip.'" data-set="'.$val.'_1">'.$pack1->price.'грн <div class="cost-info"></div></span></td>';
            }
            else {
                $tip="<div class='tooltip_cost_edit'>редактировать</div><div class='tooltip_cost_title'>".Genre::getName($val)."</div>
                            <p class='tooltip_cost_text'>Описание услуги: </p>";
                echo '<td><span class="tooltipster" title="'.$tip.'" data-set="'.$val.'_1">0грн <div class="cost-info"></div></span></td>';
            }
                
            $pack2=Prices::model()->findByAttributes(array('genre_id'=>$val,'package'=>2));
            if(is_object($pack2)) {
                $tip="<div class='tooltip_cost_edit'>редактировать</div><div class='tooltip_cost_title'>".Genre::getName($val)."</div>
                            <p class='tooltip_cost_text'>Описание услуги: ".$pack2->about."</p>";
                echo '<td><span class="tooltipster" title="'.$tip.'" data-set="'.$val.'_2">'.$pack2->price.'грн <div class="cost-info"></div></span></td>';
            }
            else {
                if(is_object($pack1)) {
                    $tip="<div class='tooltip_cost_edit'>редактировать</div><div class='tooltip_cost_title'>".Genre::getName($val)."</div>
                                <p class='tooltip_cost_text'>Описание услуги: </p>";
                    echo '<td><span class="tooltipster" title="'.$tip.'" data-set="'.$val.'_2">0грн <div class="cost-info"></div></span></td>';
                }
                else
                    echo '<td><span data-set="'.$val.'_2">0грн</span></td>';
            }
                
            $pack3=Prices::model()->findByAttributes(array('genre_id'=>$val,'package'=>3));
            if(is_object($pack3)) {
                $tip="<div class='tooltip_cost_edit'>редактировать</div><div class='tooltip_cost_title'>".Genre::getName($val)."</div>
                            <p class='tooltip_cost_text'>Описание услуги: ".$pack3->about."</p>";
                echo '<td><span class="tooltipster" title="'.$tip.'" data-set="'.$val.'_3">'.$pack3->price.'грн <div class="cost-info"></div></span></td>';
            }
            else {
                if(is_object($pack2)) {
                    $tip="<div class='tooltip_cost_edit'>редактировать</div><div class='tooltip_cost_title'>".Genre::getName($val)."</div>
                                <p class='tooltip_cost_text'>Описание услуги: </p>";
                    echo '<td><span class="tooltipster" title="'.$tip.'" data-set="'.$val.'_3">0грн <div class="cost-info"></div></span></td>';
                }
                else
                    echo '<td><span data-set="'.$val.'_3">0грн</span></td>'; 
            }
            
            $pack4=Prices::model()->findByAttributes(array('genre_id'=>$val,'package'=>4));
            if(is_object($pack4)) {
                $tip="<div class='tooltip_cost_edit'>редактировать</div><div class='tooltip_cost_title'>".Genre::getName($val)."</div>
                            <p class='tooltip_cost_text'>Описание услуги: ".$pack4->about."</p>";
                echo '<td><span class="tooltipster" title="'.$tip.'" data-set="'.$val.'_4">'.$pack4->price.'грн <div class="cost-info"></div></span></td>';
            }
            else {
                if(is_object($pack3)) {
                    $tip="<div class='tooltip_cost_edit'>редактировать</div><div class='tooltip_cost_title'>".Genre::getName($val)."</div>
                                <p class='tooltip_cost_text'>Описание услуги: </p>";
                    echo '<td><span class="tooltipster" title="'.$tip.'" data-set="'.$val.'_4">0грн <div class="cost-info"></div></span></td>';
                }
                else
                    echo '<td><span data-set="'.$val.'_4">0грн</span></td>';
            }
            
            $pack5=Prices::model()->findByAttributes(array('genre_id'=>$val,'package'=>5));
            if(is_object($pack5)) {
                $tip="<div class='tooltip_cost_edit'>редактировать</div><div class='tooltip_cost_title'>".Genre::getName($val)."</div>
                            <p class='tooltip_cost_text'>Описание услуги: ".$pack5->about."</p>";
                echo '<td><span class="tooltipster" title="'.$tip.'" data-set="'.$val.'_5">'.$pack5->price.'грн <div class="cost-info"></div></span></td>';
            }
            else {
                if(is_object($pack4)) {
                    $tip="<div class='tooltip_cost_edit'>редактировать</div><div class='tooltip_cost_title'>".Genre::getName($val)."</div>
                                <p class='tooltip_cost_text'>Описание услуги: </p>";
                    echo '<td><span class="tooltipster" title="'.$tip.'" data-set="'.$val.'_5">0грн <div class="cost-info"></div></span></td>';
                }
                else
                    echo '<td><span data-set="'.$val.'_5">0грн</span></td>';
            }
            
            echo '</tr>';
          }
          ?>
        </table>
        
        </main>
        

      </div>
    </div>
  </div>