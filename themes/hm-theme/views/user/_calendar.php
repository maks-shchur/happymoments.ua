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
                    <div class="reserv-calendar_front">
                        <header class="reserv-calendar__month"><?=$month_name[$month]?> <?=$year_plus?></header>
                        <table class="reserv-calendar__table_front">
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
                                    if(!empty($v)) $cl='weekend__day';
                                    else $cl='other-month__day';
                                }
                                else {
                                    if(!empty($v)) $cl='';
                                    else $cl='other-month__day';
                                }
                                
                                if(!empty($v)) {
                                    if(Calendar::model()->countByAttributes(array('uid'=>$model->id,'day'=>$year_plus."-".$month."-".$v))>0)
                                    {
                                        $cl.=" reserv__day";
                                        $del1="1";
                                    }
                                    else $del1="0";
                                }
                                else $del1="0";  
                              ?>
                                <td class="<?=$cl?>">
                                  <?=$v ? $v : "&nbsp;"?>
                                </td>
                              <?php } ?>
                            </tr>
                          <?php } ?>
                        </table>
                    </div>
            <?php } ?>
                 
                
                <div style="float: left; margin-top:30px; vertical-align: middle; width: 100%; margin-left: 30px;">
                    <span style="background-color: #fb5353;height:43px;width:43px;display:inline-block;"></span>
                    <span style="display: inline-block;top: -15px;left: 10px;position: relative;font-size: 1.2em;"> - дата занята</span>
                </div>
            </div>
        </div>