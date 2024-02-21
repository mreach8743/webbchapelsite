<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
require_once ROOT_PATH . 'core/framework/components/pjToolkit.component.php';

class pjUtil extends pjToolkit
{
	static public function dateDiff($interval, $date_from, $date_to, $using_timestamps = false) 
	{
	    
	    if (!$using_timestamps) {
	        $date_from = strtotime($date_from, 0);
	        $date_to = strtotime($date_to, 0);
	    }
	    $difference = $date_to - $date_from;
	     
	    switch($interval) {
	     
		    case 'yyyy': /* Number of full years*/
		
		        $years_difference = floor($difference / 31536000);
		        if (mktime(date("H", $date_from), date("i", $date_from), date("s", $date_from), date("n", $date_from), date("j", $date_from), date("Y", $date_from)+$years_difference) > $date_to) {
		            $years_difference--;
		        }
		        if (mktime(date("H", $date_to), date("i", $date_to), date("s", $date_to), date("n", $date_to), date("j", $date_to), date("Y", $date_to)-($years_difference+1)) > $date_from) {
		            $years_difference++;
		        }
		        $date_difference = $years_difference;
		        break;
		
		    case "q": /*Number of full quarters*/
		
		        $quarters_difference = floor($difference / 8035200);
		        while (mktime(date("H", $date_from), date("i", $date_from), date("s", $date_from), date("n", $date_from)+($quarters_difference*3), date("j", $date_to), date("Y", $date_from)) < $date_to) {
		            $quarters_difference++;
		        }
		        $quarters_difference--;
		        $date_difference = $quarters_difference;
		        break;
		
		    case "m": /*Number of full months*/
		
		        $months_difference = floor($difference / 2678400);
				while (mktime(date("H", $date_from), date("i", $date_from), date("s", $date_from), date("n", $date_from)+($months_difference), date("j", $date_from), date("Y", $date_from)) < $date_to)
					$months_difference++;
				//$months_difference--;*/
				$date_difference = $months_difference;
				break;
		
		    case 'y': /*Difference between day numbers*/
		
		        $date_difference = date("z", $date_to) - date("z", $date_from);
		        break;
		
		    case "d": /*Number of full days*/
		
		        $date_difference = floor($difference / 86400);
		        break;
		
		    case "w": /*Number of full weekdays*/
		
		        $days_difference = floor($difference / 86400);
		        $weeks_difference = floor($days_difference / 7); /*Complete weeks*/
		        $first_day = date("w", $date_from);
		        $days_remainder = floor($days_difference % 7);
		        $odd_days = $first_day + $days_remainder; /*Do we have a Saturday or Sunday in the remainder?*/
		        if ($odd_days > 7) { /*Sunday*/
		            $days_remainder--;
		        }
		        if ($odd_days > 6) { /*Saturday*/
		            $days_remainder--;
		        }
		        $date_difference = ($weeks_difference * 5) + $days_remainder;
		        break;
		
		    case "ww": /*Number of full weeks*/
		
		        $date_difference = floor($difference / 604800);
		        break;
		
		    case "h": /*Number of full hours*/
		
		        $date_difference = floor($difference / 3600);
		        break;
		
		    case "n": /*Number of full minutes*/
		
		        $date_difference = floor($difference / 60);
		        break;
		
		    default: /*Number of full seconds (default)*/
		
		        $date_difference = $difference;
		        break;
	    }    
	
	    return $date_difference;
	
	}
	
	static public function getEventTime($start_time, $end_time, $time_format, $separator)
	{
		$event_time = '';
		if(!empty($start_time) && !empty($end_time))
		{
			$event_time = pjUtil::formatTime($start_time, 'H:i:s', $time_format) . $separator . pjUtil::formatTime($end_time, 'H:i:s', $time_format);
		}else if(empty($start_time) && !empty($end_time)){
			$event_time = '--' . $separator . pjUtil::formatTime($end_time, 'H:i:s', $time_format);
		}else if(!empty($start_time) && empty($end_time)){
			$event_time = pjUtil::formatTime($start_time, 'H:i:s', $time_format) . $separator . '--';
		}
		return $event_time;
	}
	
	static public function ordinalDate($recurring_ordinal, $day_of_week, $month_year)    
	{
	    $first_date = date("j", strtotime($day_of_week . " " . $month_year) );
	    $computed = $first_date;
	    if ($recurring_ordinal == "first")
	    {
	    	$computed = $first_date;
	    } else if ($recurring_ordinal == "second"){
	    	$computed = $first_date + 7;
	    }elseif ($recurring_ordinal == "third"){
	    	$computed = $first_date + 14; 
	    }elseif ($recurring_ordinal == "fourth"){
	    	$computed = $first_date + 21; 
	    }elseif ($recurring_ordinal == "last"){
		    if ( ($first_date + 28) <= date("t", strtotime($month_year)) )
		    {
		        $computed = $first_date + 28; 
		    }else{
		        $computed = $first_date + 21;
		    } 
		}
	    return date("Y-m-d", strtotime($computed . " " . $month_year) );
	}
	
	static public function getHours()
	{
		return array('12', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11');
	}
}

function __($key, $return=false)
{
	$text = pjUtil::field($key);
	if ($return)
	{
		return $text;
	}
	echo $text;
}

function __autoload($className)
{
	$paths = array(
		PJ_FRAMEWORK_PATH . $className . '.class.php',
		PJ_CONTROLLERS_PATH . $className . '.controller.php',
		PJ_MODELS_PATH . str_replace('Model', '', $className) . '.model.php',
		PJ_COMPONENTS_PATH. $className . '.component.php',
		PJ_FRAMEWORK_PATH . 'components/'. $className . '.component.php'
	);

	foreach ($paths as $filename)
	{
		if (is_file($filename))
		{
			require $filename;
			return;
		}
	}
}
?>