<?php
$month_arr = __('months', true);

$month = $_GET['month'];
$year = $_GET['year'];

$prev_year = $year;
$next_year = $year;
$prev_month = intval($month)-1;
$next_month = intval($month)+1;

if ($month == 12 ) {
	$next_month = 1;
	$next_year = $year + 1;
} elseif ($month == 1 ) {
	$prev_month = 12;
	$prev_year = $year - 1;
}
if($next_month < 10)
{
	$next_month = '0' . $next_month;
}
if($prev_month < 10)
{
	$prev_month = '0' . $prev_month;
}

$days_of_week = __('days', true);
$short_days_of_week = __('day_shortnames', true);  
$day_index = $tpl['option_arr']['o_week_start'];
?>

<div id="pjPecCalendar_<?php echo $_GET['index']; ?>" class="pjIcContainer">
	<div class="pjIcCalendar">
		<header class="pjIcCalendarHead clearfix text-center">
			<div class="pull-left">
				<div class="btn-group" role="group" aria-label="...">
				 	<a href="#" class="btn btn-default btn-sm pjPecCalendarNav" data-month="<?php echo $prev_month;?>" data-year="<?php echo $prev_year;?>"><span class="glyphicon glyphicon-chevron-left"></span></a>
				</div>
			</div><!-- /.pull-left -->
			
			<h2 class="pjIcCalendarCurrent"><?php echo $month_arr[ltrim($month, '0')] . ', ' . $year; ?></h2><!-- /.pjIcCalendarCurrent -->
			
			<div class="btn-group pull-right" role="group" aria-label="...">
				<div class="btn-group" role="group" aria-label="...">
				 	<a href="#" class="btn btn-default btn-sm pjPecCalendarNav" data-month="<?php echo $next_month;?>" data-year="<?php echo $next_year;?>"><span class="glyphicon glyphicon-chevron-right"></span></a>
				</div>
			</div><!-- /.col-md-3 --><!-- /.row -->
		</header><!-- /.pjIcCalendarHead -->
		
		<table class="table table-bordered pjIcCalendarTable">
			<thead>
				<tr>
					<?php
			  		$week_start = $day_index;
			  		for($i = 1; $i <= 7; $i++)
			  		{
			  			?><th><?php echo $short_days_of_week[$week_start];?></th><?php
			  			$week_start++;
			  			if($week_start == 7)
			  			{
			  				$week_start = 0;
			  			}
			  		}
			  		?>
				</tr>
			</thead>
			<?php
			$first_day_timestamp = mktime(0, 0, 0, $month, 1, $year);
			$maxday = date("t", $first_day_timestamp);
			$last_day_timestamp = mktime(0, 0, 0, $month, $maxday, $year);
			
			$days_of_prev_month = 0;
			$star_day_timestamp = $first_day_timestamp;
			while(date('w', $star_day_timestamp) != $day_index){
				$star_day_timestamp = strtotime(date('Y-m-d', $star_day_timestamp) . '-1 day');
				$days_of_prev_month++;
			}
			$total_cells = $maxday + $days_of_prev_month;
			
			$num_rows = intval($total_cells / 7);
			if($total_cells % 7 > 0)
			{
				$num_rows++;
			}
			$run_day_timestamp = $star_day_timestamp;
			$today_timestamp = mktime(0, 0, 0, date('n'), date('j'), date('Y'));
			$i = 1;
			
			$event_date_arr = $tpl['event_date_arr'];
			?>
			<tbody>
				<?php
				for($row = 1; $row <= $num_rows; $row++)
				{
					?>
					<tr>
						<?php
						for($col = 1; $col <= 7; $col++)
						{
							$day = date('j', $run_day_timestamp);
							if($run_day_timestamp < $first_day_timestamp)
							{
								?><td class="pjIcMonthAlt"><?php echo $day;?></td><?php
							}else{
								if($run_day_timestamp <= $last_day_timestamp)
								{
									$run_date = date('Y-m-d', $run_day_timestamp);
									if(!empty($event_date_arr[$run_date]))
									{
										$events = $event_date_arr[$run_date];
										$num_events = count($events);
										$event_array = array();
										for($j = 0; $j < $num_events; $j++)
										{
											if(!empty($events[$j]['start_time']))
											{
												$event_time = pjUtil::formatTime($events[$j]['start_time'], 'H:i:s', $tpl['option_arr']['o_time_format']);
												$event_array[] .= $event_time . ', ' . $events[$j]['event_title'];
											}else{
												$event_array[] .= $events[$j]['event_title'];
											}
										}
										?>
										<td class="pjTooltipster pjIcDayChosen pjPecDayHasEvents" data-day="<?php echo $day; ?>" data-events="<?php echo $num_events;?>"><?php echo $day;?><div class="pj-calendar-tooltip" style="display:none;"><?php echo join("<br>", $event_array);?></div></td>
										<?php
									}else{
										if($run_day_timestamp == $today_timestamp)
										{
											?><td class="pjTooltipster pjIcDayToday"><?php echo $day;?><div class="pj-calendar-tooltip" style="display:none;"><?php __('front_today');?></div></td><?php
										}else{
											?><td><?php echo date('j', $run_day_timestamp);?></td><?php
										}
									}
								}else{
									?><td class="pjIcMonthAlt"><?php echo $day;?></td><?php
								}
							}
							$run_day_timestamp = strtotime ( '+'. ($i) .' day' , $star_day_timestamp );
							$i++;
						} 
						?>
					</tr>
					<?php
				} 
				?>
			</tbody>
		</table>
	</div>
</div>
<div id="pjPecEventList_<?php echo $_GET['index']; ?>"></div>