<?php
class Settings {
    public function dateFormat($string, $format="%d.%m.%Y", $lang = 'ru')
	{
		
	    if (substr(PHP_OS,0,3) == 'WIN') {
	           $_win_from = array ('%e',  '%T',       '%D');
	           $_win_to   = array ('%#d', '%H:%M:%S', '%m/%d/%y');
	           $format = str_replace($_win_from, $_win_to, $format);
	    }
 	    
 	    if($string != '') {
	        $out = strftime($format, strtotime($string));
	    } else {
	        $out = '';
	    }
	    
		$strFrom = array(
				'january', 		'jan',	
				'february', 	'feb',	
				'march', 		'mar',	
				'april', 		'apr',	
				'may', 			'may',	
				'june',  	   'jun',	
				'july', 		'jul',	
				'august', 		'aug',	
				'september',	'sep',	
				'october',		'oct',	
				'november',		'nov',	
				'december',		'dec',
				'monday',	
				'tuesday',	
				'wednesday',	
				'thursday',	
				'friday',	
				'saturday',	
				'sunday',
				'mon',
				'tue',
				'wed',
				'thu',
				'fri',
				'sat',
				'sun',			
			);
			$strTo = array('ru' => array(
								'Январь',	'Янв',	
								'Февраль',	'Фев',	
								'Март',		'Мар',	
								'Апрель',	'Апр',	
								'Май',		'Май',	
								'Июнь',		'Июн',	
								'Июль',		'Июл',	
								'Август',	'Авг',	
								'Сентябрь',	'Сен',	
								'Октябрь',	'Окт',
								'Ноябрь',	'Ноя',	
								'Декабрь',	'Дек',	
								'Понедельник',
								'Вторник',
								'Среда',
								'Четверг',
								'Пятница',
								'Суббота',
								'Воскресенье',
								'Пн',
								'Вт',
								'Ср',
								'Чт',
								'Пт',
								'Сб',
								'Вс',
							),
							'ua' => array(
								'Січень','Січ',	
								'Лютий',		'Лют',	
								'Березень',		'Бер',
								'Квітень', 		'Кві',	
								'Травень',		'Тра',	
								'Червень',		'Чер',	
								'Липень',		'Лип',	
								'Серпень',		'Сер',	
								'Вересень',		'Вер',	
								'Жовтень',		'Жов',	
								'Листопад',		'Лис',	
								'Грудень',		'Грд',
								'Понеділок',
								'Вівторок',
								'Середа',
								'Четвер',
								'П\'ятниця',
								'Субота',
								'Неділя',
								'Пн',
								'Вт',
								'Ср',
								'Чт',
								'Пт',
								'Сб',
								'Нд',
							)
		
				);
			
 		$outOld = $out;
 		
		$out = str_replace($strFrom, $strTo[$lang], strtolower($out));
 		if ($out == strtolower($outOld)){
			$out = $outOld;
		}
 		$out = str_replace('Май.', 'мая', $out);
 		return $out;	    
 	}
 	
	protected function dateRidN2R($str)
	{
			$arrFrom = array(	
								'январь',	 
								'февраль',	 
								'март',		 
								'апрель',	 
								'май',		 
								'июнь',		 
								'июль',		 
								'август',	 
								'сентябрь',	 
								'октябрь',	 
								'ноябрь',	 
								'декабрь',	 );
			$arrTo = array(	
								'января',	 
								'февраля',	 
								'марта',		 
								'апреля',	 
								'мая',		 
								'июня',		 
								'июля',		 
								'августа',	 
								'сентября',	 
								'октября',	 
								'ноября',	 
								'декабря');
		$str = str_replace($arrFrom, $arrTo,  strtolower($str));								
		return $str;
	}    
    
    public function smallAva($uid) {
        $model = Users::model()->findByPk($uid);
        
        $role=$model->member_type;
        if($role=='') $role='client';
        $html='';
        $html .= '<a href="/id'.$model->id.'" class="tender__reply__item-container">
                  <span class="tender__reply__item">
                    <span class="tender__reply__item__img-container">'.CHtml::image('/users/'.$model->id.'/'.$model->photo).'</span>
                    <span class="tender__reply__item__account '.$role.'">'.$model->member_type.'</span>
                  </span>
                  </a>';
        
        return $html;
    }
    
    public function getTimer($date_time)
	{
		$timeAgo = strtotime($date_time) - time();
		$timePer = array(
			'day' 	=> array(3600 * 24, 'дн.'),
			'hour' 	=> array(3600, ''),
			'min' 	=> array(60, 'мин.'),
			'sek' 	=> array(1, 'сек.'),
			);
		foreach ($timePer as $type =>  $tp) {
			$tpn = floor($timeAgo / $tp[0]);
			if ($tpn) {
				
				switch ($type) {
					case 'hour':
						if (in_array($tpn, array(1, 21))){
							$tp[1] = 'час';
						}elseif (in_array($tpn, array(2, 3, 4, 22, 23)) ) {
							$tp[1] = 'часa';
						}else {
							$tp[1] = 'часов';
						}
						break;
				}
				return $tpn.' '.$tp[1];
			}
		}
	}
    
    public function get_duration ($date_from, $date_till) {
        if($date_till=='') $date_till=date('Y-m-d',time());
        
        $date_from = explode('-', $date_from);
        $date_till = explode('-', $date_till);
 
        $time_from = mktime(0, 0, 0, $date_from[1], $date_from[2], $date_from[0]);
        $time_till = mktime(0, 0, 0, $date_till[1], $date_till[2], $date_till[0]);
        
        $diff = ($time_till - $time_from)/60/60/24;
        //$diff = date('d', $diff); - как делал))
 
        return round($diff);
    }
    
    public function DateAdd($interval, $number, $date) {
    
        if($date!='') $date_time_array = getdate($date);
        else $date_time_array = getdate();
        
        $hours = $date_time_array['hours'];
        $minutes = $date_time_array['minutes'];
        $seconds = $date_time_array['seconds'];
        $month = $date_time_array['mon'];
        $day = $date_time_array['mday'];
        $year = $date_time_array['year'];
    
        switch ($interval) {
        
            case 'yyyy':
                $year+=$number;
                break;
            case 'q':
                $year+=($number*3);
                break;
            case 'm':
                $month+=$number;
                break;
            case 'y':
            case 'd':
            case 'w':
                $day+=$number;
                break;
            case 'ww':
                $day+=($number*7);
                break;
            case 'h':
                $hours+=$number;
                break;
            case 'n':
                $minutes+=$number;
                break;
            case 's':
                $seconds+=$number; 
                break;            
        }
           $timestamp= mktime($hours,$minutes,$seconds,$month,$day,$year);
        return $timestamp;
    }
    
    public function changeLang($lang)
    {
        if(Yii::app()->language!=$lang)
        {
            if($lang=='ru')
            {
                if(isset($_SERVER['REQUEST_URI']))
                {
                    if($_SERVER['REQUEST_URI']=='/')
                    {
                        $url = $_SERVER['REQUEST_URI'];        
                    }
                    else
                    {
                        $url = substr($_SERVER['REQUEST_URI'],3);
                        //header('Location: '. $url);
                    }
                }
                else
                {
                    $url = '/'.$lang;    
                }    
            }
            else
            {
                if(isset($_SERVER['REQUEST_URI']))
                {
                    if($_SERVER['REQUEST_URI']=='/')
                    {
                        $url = $lang;        
                    }
                    else
                    {
                        //$url = str_replace(Yii::app()->language, $lang, $_SERVER['REQUEST_URI']);
                        //header('Location: '. $url);
                        $url='/'.$lang.'/'.substr($_SERVER['REQUEST_URI'],1);
                    }
                }
                else
                {
                    $url = '/'.$lang;    
                }
            }
            return $url;
        }
    }
    
    public function toLatin($title)
	{
        		$tbl= array(
    			'а'=>'a', 'б'=>'b', 'в'=>'v', 'г'=>'g', 'д'=>'d', 'е'=>'e', 'ж'=>'zh', 'з'=>'z',
    			'и'=>'i', 'й'=>'y', 'к'=>'k', 'л'=>'l', 'м'=>'m', 'н'=>'n', 'о'=>'o', 'п'=>'p',
    			'р'=>'r', 'с'=>'s', 'т'=>'t', 'у'=>'u', 'ф'=>'f', 'ы'=>'i', 'э'=>'e', 'А'=>'A',
    			'Б'=>'B', 'В'=>'V', 'Г'=>'G', 'Д'=>'D', 'Е'=>'E', 'Ж'=>'Zh', 'З'=>'Z', 'И'=>'I',
    			'Й'=>'Y', 'К'=>'K', 'Л'=>'L', 'М'=>'M', 'Н'=>'N', 'О'=>'O', 'П'=>'P', 'Р'=>'R',
    			'С'=>'S', 'Т'=>'T', 'У'=>'U', 'Ф'=>'F', 'Ы'=>'I', 'Э'=>'E', 'ё'=>"yo", 'х'=>"h",
    			'ц'=>"ts", 'ч'=>"ch", 'ш'=>"sh", 'щ'=>"shch", 'ъ'=>"", 'ь'=>"", 'ю'=>"yu", 'я'=>"ya",
    			'Ё'=>"YO", 'Х'=>"H", 'Ц'=>"TS", 'Ч'=>"CH", 'Ш'=>"SH", 'Щ'=>"SHCH", 'Ъ'=>"", 'Ь'=>"",
    			'Ю'=>"YU", 'Я'=>"YA", ' '=>"-", '('=>'', ')'=>'', ','=>'', '.'=>''
    			);

		//$translate = mb_strtolower(strtr($title, $tbl));
		$res = strtolower(strtr($title, $tbl));
		return $res;
	}
}
?>