<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
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
	
	static public function getWeekRange($date, $week_start)
	{
		$week_arr = array(
				0=>'sunday',
				1=>'monday',
				2=>'tuesday',
				3=>'wednesday',
				4=>'thursday',
				5=>'friday',
				6=>'saturday');
			
		$ts = strtotime($date);
		$start = (date('w', $ts) == 0) ? $ts : strtotime('last ' . $week_arr[$week_start], $ts);
		$week_start = ($week_start == 0 ? 6 : $week_start -1);
		return array(date('Y-m-d', $start), date('Y-m-d', strtotime('next ' . $week_arr[$week_start], $start)));
	}
	
	static public function getComingWhere($period, $week_start)
	{
		$where_str = '';
		switch ($period) {
			case 1:
				$where_str = "(CURDATE() = t1.event_date)";
				break;
				;
			case 2:
				$where_str = "(DATE(DATE_ADD(NOW(), INTERVAL 1 DAY)) = t1.event_date)";
				break;
				;
			case 3:
				list($start_week, $end_week) = pjUtil::getWeekRange(date('Y-m-d'), $week_start);
				$where_str = "(t1.event_date BETWEEN CURDATE() AND '$end_week')";
				break;
				;
			case 4:
				list($start_week, $end_week) = pjUtil::getWeekRange(date('Y-m-d', strtotime("+7 days")), $week_start);
				$where_str = "(t1.event_date BETWEEN '$start_week' AND '$end_week')";
				break;
				;
			case 5:
				$end_month = date('Y-m-t',strtotime('this month'));
				$where_str = "(t1.event_date BETWEEN CURDATE() AND '$end_month')";
				break;
				;
			case 6:
				$start_month = date("Y-m-d", mktime(0, 0, 0, date("m") + 1, 1, date("Y")));
				$end_month = date("Y-m-d", mktime(0, 0, 0, date("m") + 2, 0, date("Y")));
				$where_str = "(t1.event_date BETWEEN '$start_month' AND '$end_month')";
				break;
				;
		}
		return $where_str;
	}
	
	static public function getMadeWhere($period, $week_start)
	{
		$where_str = '';
		switch ($period) {
			case 1:
				$where_str = "(DATE(t1.created) = CURDATE() OR DATE(t1.modified) = CURDATE())";
				break;
				;
			case 2:
				$where_str = "(DATE(t1.created) = DATE(DATE_SUB(NOW(), INTERVAL 1 DAY)) OR DATE(t1.modified) = DATE(DATE_SUB(NOW(), INTERVAL 1 DAY)))";
				break;
				;
			case 3:
				list($start_week, $end_week) = pjUtil::getWeekRange(date('Y-m-d'), $week_start);
				$where_str = "((DATE(t1.created) BETWEEN '$start_week' AND '$end_week') OR (DATE(t1.modified) BETWEEN '$start_week' AND '$end_week'))";
				break;
				;
			case 4:
				list($start_week, $end_week) = pjUtil::getWeekRange(date('Y-m-d', strtotime("-7 days")), $week_start);
				$where_str = "((DATE(t1.created) BETWEEN '$start_week' AND '$end_week') OR (DATE(t1.modified) BETWEEN '$start_week' AND '$end_week'))";
				break;
				;
			case 5:
				$start_month = date('Y-m-01',strtotime('this month'));
				$end_month = date('Y-m-t',strtotime('this month'));
				$where_str = "((DATE(t1.created) BETWEEN '$start_month' AND '$end_month') OR (DATE(t1.modified) BETWEEN '$start_month' AND '$end_month'))";
				break;
				;
			case 6:
				$start_month = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1, date("Y")));
				$end_month = date("Y-m-d", mktime(0, 0, 0, date("m"), 0, date("Y")));
				$where_str = "((DATE(t1.created) BETWEEN '$start_month' AND '$end_month') OR (DATE(t1.modified) BETWEEN '$start_month' AND '$end_month'))";
				break;
				;
		}
		return $where_str;
	}
	
	static public function getTimezoneName($timezone)
	{
		$offset = $timezone / 3600;
		$timezone_name = timezone_name_from_abbr(null, $offset * 3600, true);
		if($timezone_name === false)
		{
			$timezone_name = timezone_name_from_abbr(null, $offset * 3600, false);
		}
		if($offset == -12)
		{
			$timezone_name = 'Pacific/Wake';
		}
		return $timezone_name;
	}
}
?>