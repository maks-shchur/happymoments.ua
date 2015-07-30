<?php
$this->widget('ext.tooltipster.tooltipster',
          array(
            'identifier'=>'.tooltipster_front', 
            'options'=>array(
                'position'=>'bottom',
                'interactive' => true,
                'interactiveTolerance'=>'550',
                'timer'=>'1000',
                'fixedWidth'=>'435',
            )
));
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
          //$genres=unserialize($user->genre_id);
          //print_r($genres); exit();
          if($user->occupation_id==2) { //videooperator
            $genres=Video::model()->findAllByAttributes(array('uid'=>$user->id));
          }
          else {
            $genres=Portfolio::model()->findAllByAttributes(array('uid'=>$user->id));
          }
          
          
          foreach($genres as $val) {
            
            if($user->occupation_id==2) $cnt_files=Files::model()->countByAttributes(array('uid'=>$user->id, 'type'=>'video', 'portfolio_id'=>$val->id));
            else $cnt_files=Files::model()->countByAttributes(array('uid'=>$user->id, 'type'=>'photo', 'portfolio_id'=>$val->id));
            
            if($cnt_files>0):
            
                echo '<tr>
                        <td>'.$val->title.'</td>';
                        
                //$pack1=Prices::model()->findByAttributes(array('price'),'genre_id=:gen and package=1',array(':gen'=>$val));
                $pack1=Prices::model()->findByAttributes(array('genre_id'=>$val->id,'package'=>1));
                if(is_object($pack1)) {
                    $tip="<div class='tooltip_cost_title'>".$val->title."</div>
                                <p class='tooltip_cost_text'>Описание услуги: ".$pack1->about."</p>";
                    echo '<td><span class="tooltipster_front" title="'.$tip.'" data-set="'.$val->id.'_1">'.$pack1->price.'грн <div class="cost-info"></div></span></td>';
                }
                else {
                    echo '<td><span data-set="'.$val->id.'_1">....</span></td>';
                }
                    
                $pack2=Prices::model()->findByAttributes(array('genre_id'=>$val->id,'package'=>2));
                if(is_object($pack2)) {
                    $tip="<div class='tooltip_cost_title'>".$val->title."</div>
                                <p class='tooltip_cost_text'>Описание услуги: ".$pack2->about."</p>";
                    echo '<td><span class="tooltipster_front" title="'.$tip.'" data-set="'.$val->id.'_2">'.$pack2->price.'грн <div class="cost-info"></div></span></td>';
                }
                else {
                    echo '<td><span data-set="'.$val->id.'_2">....</span></td>';
                }
                    
                $pack3=Prices::model()->findByAttributes(array('genre_id'=>$val->id,'package'=>3));
                if(is_object($pack3)) {
                    $tip="<div class='tooltip_cost_title'>".$val->title."</div>
                                <p class='tooltip_cost_text'>Описание услуги: ".$pack3->about."</p>";
                    echo '<td><span class="tooltipster_front" title="'.$tip.'" data-set="'.$val->id.'_3">'.$pack3->price.'грн <div class="cost-info"></div></span></td>';
                }
                else {
                    echo '<td><span data-set="'.$val->id.'_3">....</span></td>'; 
                }
                
                $pack4=Prices::model()->findByAttributes(array('genre_id'=>$val->id,'package'=>4));
                if(is_object($pack4)) {
                    $tip="<div class='tooltip_cost_title'>".$val->title."</div>
                                <p class='tooltip_cost_text'>Описание услуги: ".$pack4->about."</p>";
                    echo '<td><span class="tooltipster_front" title="'.$tip.'" data-set="'.$val->id.'_4">'.$pack4->price.'грн <div class="cost-info"></div></span></td>';
                }
                else {
                    echo '<td><span data-set="'.$val->id.'_4">....</span></td>';
                }
                
                $pack5=Prices::model()->findByAttributes(array('genre_id'=>$val->id,'package'=>5));
                if(is_object($pack5)) {
                    $tip="<div class='tooltip_cost_title'>".$val->title."</div>
                                <p class='tooltip_cost_text'>Описание услуги: ".$pack5->about."</p>";
                    echo '<td><span class="tooltipster_front" title="'.$tip.'" data-set="'.$val->id.'_5">'.$pack5->price.'грн <div class="cost-info"></div></span></td>';
                }
                else {
                    echo '<td><span data-set="'.$val->id.'_5">....</span></td>';
                }
                
                echo '</tr>';
            
            endif;
          
          }
          ?>
        </table>
        
        </main>