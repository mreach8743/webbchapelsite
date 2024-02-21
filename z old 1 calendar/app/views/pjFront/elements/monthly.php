<?php
$first_day_of_month = $_GET['year'] . '-01-01';
$number_of_days = date('t', strtotime($_GET['year'] . '-'. $_GET['month'] .'-01'));
$month_arr = __('months', true);
$shortmonth_arr = __('short_months', true);
$days_arr = __('days', true);
$month = ltrim($_GET['month'], '0');
$year = $_GET['year'];
?>
			
<div class="clearfix text-center pjCalHeading">
	<a href="#" class="btn btn-primary btn-sm pull-left pjPecMonthlyNav" data-direction="prev"><span class="glyphicon glyphicon-chevron-left"></span></a><!-- /.col-md-3 -->

	<h2 class="pjIcCalendarCurrent"><?php echo $month_arr[$month] . ', ' . $year; ?></h2><!-- /.pjIcCalendarCurrent --><!-- /.col-md-6 -->

	<a href="#" class="btn btn-primary btn-sm pull-right pjPecMonthlyNav" data-direction="next"><span class="glyphicon glyphicon-chevron-right"></span></a><!-- /.col-md-3 -->
</div><!-- /.clearfix -->

<div class="table-responsive pjCalMonths">
	<table class="table table-condensed table-bordered">
		<tr>
			<?php
			for($i = 0; $i < 13; $i++)
			{
				if(date('Y-m', strtotime($first_day_of_month)) == $year . '-' . $_GET['month'])
				{
					?><th class="text-center"><a href="javascript:void(0);" class="active"><?php echo $shortmonth_arr[date('n', strtotime($first_day_of_month))];?></a></th><?php
				}else{
					?><th class="text-center"><a href="#" class="pjPecMonthName" data-year="<?php echo date('Y', strtotime($first_day_of_month));?>" data-month="<?php echo date('m', strtotime($first_day_of_month));?>"><?php echo $shortmonth_arr[date('n', strtotime($first_day_of_month))];?></a></th><?php
				}
				$first_day_of_month = date('Y-m-d', strtotime($first_day_of_month . '+1 month'));
			} 
			?>
		</tr>
	</table>
</div>

<table class="table table-condensed table-bordered pjCalTable">
	<?php
	$day_in_month = $_GET['year'] . '-' . $_GET['month'] . '-01';
	$event_date_arr = $tpl['event_date_arr'];
	for($i = 1; $i <= $number_of_days; $i++)
	{
		if(!empty($event_date_arr[$day_in_month]))
		{
			$events = $event_date_arr[$day_in_month];
			$num_events = count($events);
			
			for($j = 0; $j < $num_events; $j++)
			{
				$event_title = $events[$j]['event_title'];
				$event_time = '';
				if(!empty($events[$j]['start_time']) && !empty($events[$j]['end_time']))
				{
					$event_time = pjUtil::formatTime($events[$j]['start_time'], 'H:i:s', $tpl['option_arr']['o_time_format']) . '<br/>' . pjUtil::formatTime($events[$j]['end_time'], 'H:i:s', $tpl['option_arr']['o_time_format']);
				}else if(!empty($events[$j]['start_time']) && empty($events[$j]['end_time'])){
					$event_time = __('front_starts_at', true) . '<br/>' . pjUtil::formatTime($events[$j]['start_time'], 'H:i:s', $tpl['option_arr']['o_time_format']);
				}else if(empty($events[$j]['start_time']) && !empty($events[$j]['end_time'])){
					$event_time = __('front_ends_at', true) . '<br/>' . pjUtil::formatTime($events[$j]['end_time'], 'H:i:s', $tpl['option_arr']['o_time_format']);
				}
				
				if($j == 0)
				{
					?>
					<tr>
						<td rowspan="<?php echo $num_events;?>"><?php echo $i;?></td>
						<td rowspan="<?php echo $num_events;?>"><?php echo $days_arr[date('w', strtotime($day_in_month))];?></td>
						<td width="55"><div class="text-left"><?php echo $event_time; ?></div></td>
						<td>
							<div class="pjCalInner">
								<p>
									<strong>
										<?php echo $event_title;?><?php echo $tpl['option_arr']['o_enable_categories'] == 'Yes' && !empty($events[$j]['category']) ? ', ' . $events[$j]['category'] : NULL;?>
										<?php
										if(!empty($events[$j]['location']))
										{
											?><a class="pjPecEventLocation" href="#" data-id="<?php echo $events[$j]['id'];?>" data-lat="<?php echo $events[$j]['lat'];?>" data-lng="<?php echo $events[$j]['lng'];?>"><?php echo $events[$j]['location'];?></a><?php
										} 
										?>
									</strong>
								</p>								
								<?php
								if(!empty($events[$j]['lat']) && !empty($events[$j]['lat']))
								{
									?><div id="pjPecMapCanvas_<?php echo $events[$j]['id'];?>" class="pjPecMapCanvas"></div><?php
								}
								?>
								<div><?php echo nl2br(stripslashes($events[$j]['description'])); ?></div>
							</div>
						</td>
					</tr>
					<?php
				}else{
					?>
					<tr>
						<td width="55"><div class="text-left"><?php echo $event_time; ?></div></td>
						<td>
							<div class="pjCalInner">
								<p>
									<strong>
										<?php echo $event_title;?><?php echo $tpl['option_arr']['o_enable_categories'] == 'Yes' && !empty($events[$j]['category']) ? ' , ' . $events[$j]['category'] : NULL;?>
										<?php
										if(!empty($events[$j]['location']))
										{
											?><a class="pjPecEventLocation" href="#" data-id="<?php echo $events[$j]['id'];?>" data-lat="<?php echo $events[$j]['lat'];?>" data-lng="<?php echo $events[$j]['lng'];?>"><?php echo $events[$j]['location'];?></a><?php
										} 
										?>
									</strong>
								</p>								
								<?php
								if(!empty($events[$j]['lat']) && !empty($events[$j]['lat']))
								{
									?><div id="pjPecMapCanvas_<?php echo $events[$j]['id'];?>" class="pjPecMapCanvas"></div><?php
								}
								?>
								<div><?php echo nl2br(stripslashes($events[$j]['description'])); ?></div>
							</div>
						</td>
					</tr>
					<?php
				}
			}
		}else{
			?>
			<tr class="no-events<?php echo $day_in_month == date('Y-m-d') ? ' pjPecToday' : null; ?>">
				<td><?php echo $i;?></td>
				<td><?php echo $days_arr[date('w', strtotime($day_in_month))];?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<?php
		}
		$day_in_month = date('Y-m-d', strtotime($day_in_month . '+1 day'));
	}
	?>
</table>