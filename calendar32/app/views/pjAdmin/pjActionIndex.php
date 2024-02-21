<?php
if (isset($tpl['status']))
{
	$status = __('status', true);
	switch ($tpl['status'])
	{
		case 2:
			pjUtil::printNotice(NULL, $status[2]);
			break;
	}
}else{
	$week_start = isset($tpl['option_arr']['o_week_start']) && in_array((int) $tpl['option_arr']['o_week_start'], range(0,6)) ? (int) $tpl['option_arr']['o_week_start'] : 0;
	$jqDateFormat = pjUtil::jqDateFormat($tpl['option_arr']['o_date_format']);
	?>
	<div class="dashboard">
		<div class="dashboard_header">
			<div class="left"></div>
			<div class="middle">
				<div class="today-events"><div class="header-content"><span><?php echo count($tpl['today_events']); ?></span><label><?php echo strtolower(__('lblTodayEvents', true));?></label></div></div>
				<div class="total-events"><div class="header-content"><span><?php echo $tpl['cnt_events']; ?></span><label><?php echo strtolower(__('lblTotalEvents', true));?></label></div></div>
				<div class="users"><div class="header-content"><span><?php echo $tpl['cnt_users']; ?></span><label><?php echo strtolower(__('lblUsers', true));?></label></div></div>
			</div>
			<div class="right"></div>
		</div>
		<div class="dashboard_box today-events-box">
			<div class="header">
				<div class="left"></div>
				<div class="middle"><span><?php __('lblTodayEvents');?></span></div>
				<div class="right"></div>
			</div>
			<div class="content">
				<div class="dashboard_list">
					<?php
					if(!empty($tpl['today_events']))
					{
						$row_count = count($tpl['today_events']) > 5 ? 4 : count($tpl['today_events']) - 1;
						foreach($tpl['today_events'] as $k => $v)
						{
							$event_time = null;
							if(!empty($v['start_time']) && !empty($v['end_time']))
							{
								$event_time = pjUtil::formatTime($v['start_time'], 'H:i:s', $tpl['option_arr']['o_time_format']) . ' / ' . pjUtil::formatTime($v['end_time'], 'H:i:s', $tpl['option_arr']['o_time_format']);
							}else if(!empty($v['start_time']) && empty($v['end_time'])){
								$event_time = pjUtil::formatTime($v['start_time'], 'H:i:s', $tpl['option_arr']['o_time_format']) . ' / --';
							}else if(empty($v['start_time']) && !empty($v['end_time'])){
								$event_time = '-- / ' . pjUtil::formatTime($v['end_time'], 'H:i:s', $tpl['option_arr']['o_time_format']);
							}
							?>
							<div class="dashboard_row today-events-row <?php echo $k == $row_count ? 'dashboard_last_row' : null; ?>">
								<div class="event-title" >
									<a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminEvents&amp;action=pjActionUpdate&id=<?php echo $v['id'];?>"><?php echo pjSanitize::html(stripslashes($v['event_title']));?></a>
								</div>
								<label><?php echo pjUtil::formatDate(date('Y-m-d', strtotime($v['event_date'])), "Y-m-d", $tpl['option_arr']['o_date_format']);?></label>
								<?php
								if($event_time != null)
								{ 
									?><span><?php echo __('lblTime', true) . ': ' . $event_time;?></span><?php
								} 
								?>									
							</div>
							<?php
							if($k == 4)
							{
								break;
							}
						}
					} else {
						?>
						<div class="dashboard_row"><div class="event-title"><?php __('lblNoEventFound');?></div></div>
						<?php
					}
					?>
				</div>
			</div>
			<div class="footer">
				<div class="left"></div>
				<div class="middle"></div>
				<div class="right"></div>
			</div>
		</div>
		<div class="dashboard_box total-events-box">
			<div class="header">
				<div class="left"></div>
				<div class="middle"><span><?php __('lblUpcomingEvents');?></span></div>
				<div class="right"></div>
			</div>
			<div class="content">
				<div class="dashboard_list">
					<?php
					if(!empty($tpl['upcoming_events']))
					{
						 
						$row_count = count($tpl['upcoming_events']);
						
						foreach($tpl['upcoming_events'] as $k => $v)
						{
							$event_time = null;
							if(!empty($v['start_time']) && !empty($v['end_time']))
							{
								$event_time = pjUtil::formatTime($v['start_time'], 'H:i:s', $tpl['option_arr']['o_time_format']) . ' / ' . pjUtil::formatTime($v['end_time'], 'H:i:s', $tpl['option_arr']['o_time_format']);
							}else if(!empty($v['start_time']) && empty($v['end_time'])){
								$event_time = pjUtil::formatTime($v['start_time'], 'H:i:s', $tpl['option_arr']['o_time_format']) . ' / --';
							}else if(empty($v['start_time']) && !empty($v['end_time'])){
								$event_time = '-- / ' . pjUtil::formatTime($v['end_time'], 'H:i:s', $tpl['option_arr']['o_time_format']);
							}
							?>
							<div class="dashboard_row today-events-row <?php echo $k + 1 == $row_count ? 'dashboard_last_row' : null; ?>">
								<div class="event-title" >
									<a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminEvents&amp;action=pjActionUpdate&id=<?php echo $v['id'];?>"><?php echo pjSanitize::html(stripslashes($v['event_title']));?></a>
								</div>
								<label><?php echo pjUtil::formatDate(date('Y-m-d', strtotime($v['event_date'])), "Y-m-d", $tpl['option_arr']['o_date_format']);?></label>
								<?php
								if($event_time != null)
								{ 
									?><span><?php echo __('lblTime', true) . ': ' . $event_time;?></span><?php
								} 
								?>									
							</div>
							<?php
						}
					} else {
						?>
						<div class="dashboard_row"><div class="event-title"><?php __('lblNoEventFound');?></div></div>
						<?php
					}
					?>
				</div>
			</div>
			<div class="footer">
				<div class="left"></div>
				<div class="middle"></div>
				<div class="right"></div>
			</div>
		</div>
		<div class="dashboard_box user-box">
			<div class="header">
				<div class="left"></div>
				<div class="middle"><span><?php __('lblQuickLinks');?></span></div>
				<div class="right"></div>
			</div>
			<div class="content">
				<div class="dashboard_list dashboard_quicklinks">
					<label><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminEvents&amp;action=pjActionCreate"><?php __('btnAddEvent');?></a></label>
					<label><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminCategories&amp;action=pjActionCreate"><?php __('btnAddCategory');?></a></label>
					<label><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminEvents&amp;action=pjActionExport"><?php __('btnExportEvents');?></a></label>
					<label><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminUsers&amp;action=pjActionCreate"><?php __('btnAddUser');?></a></label>
					<br/>
					<br/>
					<label><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminEvents&amp;action=pjActionIndex&find=1"><?php __('lnkFindEvents');?></a></label>
					<label><a href="preview.php?theme=<?php echo $tpl['option_arr']['o_theme'];?>" target="_blank"><?php __('lnkPreviewCalendar');?></a></label>
					<br/>
					<br/>
					<label><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjBackup&action=pjActionIndex"><?php __('lnkBackupData');?></a></label>
					<label><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjLocale&action=pjActionIndex&tab=1"><?php __('lnkTranslateCalendar');?></a></label>
				</div>
			</div>
			<div class="footer">
				<div class="left"></div>
				<div class="middle"></div>
				<div class="right"></div>
			</div>
		</div>
	</div>
	<div class="clear_left t20 overflow">
		<div class="float_left black t30"><span class="gray"><?php echo ucfirst(__('lblDashLastLogin', true)); ?>:</span> <?php echo date("F d, Y H:i", strtotime($_SESSION[$controller->defaultUser]['last_login'])); ?></div>
		<div class="float_right overflow">
		<?php
		list($hour, $day, $other) = explode("_", date("H:i_l_F d, Y"));
		$days = __('days', true, false);
		?>
			<div class="dashboard_date">
				<abbr><?php echo $days[date('w')]; ?></abbr>
				<?php echo $other; ?>
			</div>
			<div class="dashboard_hour"><?php echo $hour; ?></div>
		</div>
	</div>
	<?php
}
?>