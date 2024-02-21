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
<table id="phpevtcal_table_calendar" class="phpevtcal-table-calendar">
	<tr class="phpevtcal-tr-nav">
      	<td><a class="month-nav prev" href="javascript:void(0);" rev="<?php echo $prev_month;?>" rel="<?php echo $prev_year;?>"></a></td>
      	<td colspan="5" class="current-month"><?php echo $month_arr[ltrim($month, '0')] . ', ' . $year; ?></td>
      	<td><a class="month-nav next" href="javascript:void(0);" rev="<?php echo $next_month;?>" rel="<?php echo $next_year;?>"></a></td>
  	</tr>
  	<tr class="phpevtcal-tr-space" >
  		<td colspan="7"></td>
  	</tr>
  	<tr class="phpevtcal-tr-weekday">
  		<?php
  		$week_start = $day_index;
  		for($i = 1; $i <= 7; $i++)
  		{
  			?><td class="week-day"><?php echo $short_days_of_week[$week_start];?></td><?php
  			$week_start++;
  			if($week_start == 7)
  			{
  				$week_start = 0;
  			}
  		}
  		?>
  	</tr>
  	<tr class="phpevtcal-tr-space" >
  		<td colspan="7"></td>
  	</tr>
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

for($row = 1; $row <= $num_rows; $row++)
{
	?><tr class="phpevtcal-tr-day"><?php
	for($col = 1; $col <= 7; $col++)
	{
		if($run_day_timestamp < $first_day_timestamp)
		{
			?><td class="last-month-day"><?php echo date('j', $run_day_timestamp);?></td><?php
		}else{
			if($run_day_timestamp <= $last_day_timestamp)
			{
				$run_date = date('Y-m-d', $run_day_timestamp);

				if(!empty($event_date_arr[$run_date]))
				{
					$day = date('j', $run_day_timestamp);
					$events = $event_date_arr[$run_date];
					$num_events = count($events);
					?>
					<td class="has-event" axis="<?php echo $day;?>" abbr="<?php echo $col;?>" lang="<?php echo $num_events;?>">
						<?php 
						echo $day;
						
						$event_title = '';
						for($j = 0; $j < $num_events; $j++)
						{
							if(!empty($events[$j]['start_time'])){
								$event_time = pjUtil::formatTime($events[$j]['start_time'], 'H:i:s', $tpl['option_arr']['o_time_format']);
								$event_title .= $event_time . ' - ' . $events[$j]['event_title'] . '<br/>';
							}else{
								$event_title .= $events[$j]['event_title'] . '<br/>';
							}
						}
						?>
						<div class="phpevtcal-event-title" style="<?php echo $tpl['option_arr']['o_event_title_position'] == 'datecell' ? 'display:block;' : 'display:none;'; ?>"><?php echo $event_title;?></div>
						<div class="phpevtcal-tooltip" id="phpevtcal_tooltip_<?php echo $day;?>">
							<?php echo $event_title;?>
						</div>
					</td>
					<?php
				}else{	
					if($run_day_timestamp == $today_timestamp)
					{
						?><td class="current-date"><?php echo date('j', $run_day_timestamp);?></td><?php
					}else{	
						?><td class=""><?php echo date('j', $run_day_timestamp);?></td><?php
					}
				}
			}else{
				?><td class="next-month-day"><?php echo date('j', $run_day_timestamp);?></td><?php
			}
		}
		$run_day_timestamp = strtotime ( '+'. ($i) .' day' , $star_day_timestamp );
		$i++;
	}
	?></tr><?php
}
?>
</table>
<div id="phpevtcal_event_detail"></div>