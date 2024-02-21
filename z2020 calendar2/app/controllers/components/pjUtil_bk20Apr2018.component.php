<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
require_once ROOT_PATH . 'core/framework/components/pjToolkit.component.php';

class pjUtil extends pjToolkit
{
	static public function dateDiff($interval, $datefrom, $dateto, $using_timestamps = false) {
	    
	    if (!$using_timestamps) {
	        $datefrom = strtotime($datefrom, 0);
	        $dateto = strtotime($dateto, 0);
	    }
	    $difference = $dateto - $datefrom;
	     
	    switch($interval) {
	     
		    case 'yyyy': // Number of full years
		
		        $years_difference = floor($difference / 31536000);
		        if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
		            $years_difference--;
		        }
		        if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
		            $years_difference++;
		        }
		        $datediff = $years_difference;
		        break;
		
		    case "q": // Number of full quarters
		
		        $quarters_difference = floor($difference / 8035200);
		        while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
		            $months_difference++;
		        }
		        $quarters_difference--;
		        $datediff = $quarters_difference;
		        break;
		
		    case "m": // Number of full months
		
		        $months_difference = floor($difference / 2678400);
				while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $datefrom), date("Y", $datefrom)) < $dateto)
					$months_difference++;
				//$months_difference--;
				$datediff = $months_difference;
				break;
		
		    case 'y': // Difference between day numbers
		
		        $datediff = date("z", $dateto) - date("z", $datefrom);
		        break;
		
		    case "d": // Number of full days
		
		        $datediff = floor($difference / 86400);
		        break;
		
		    case "w": // Number of full weekdays
		
		        $days_difference = floor($difference / 86400);
		        $weeks_difference = floor($days_difference / 7); // Complete weeks
		        $first_day = date("w", $datefrom);
		        $days_remainder = floor($days_difference % 7);
		        $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
		        if ($odd_days > 7) { // Sunday
		            $days_remainder--;
		        }
		        if ($odd_days > 6) { // Saturday
		            $days_remainder--;
		        }
		        $datediff = ($weeks_difference * 5) + $days_remainder;
		        break;
		
		    case "ww": // Number of full weeks
		
		        $datediff = floor($difference / 604800);
		        break;
		
		    case "h": // Number of full hours
		
		        $datediff = floor($difference / 3600);
		        break;
		
		    case "n": // Number of full minutes
		
		        $datediff = floor($difference / 60);
		        break;
		
		    default: // Number of full seconds (default)
		
		        $datediff = $difference;
		        break;
	    }    
	
	    return $datediff;
	
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