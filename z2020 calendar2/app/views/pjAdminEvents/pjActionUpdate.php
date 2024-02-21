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
} else {
	$week_start = isset($tpl['option_arr']['o_week_start']) && in_array((int) $tpl['option_arr']['o_week_start'], range(0,6)) ? (int) $tpl['option_arr']['o_week_start'] : 0;
	$jqDateFormat = pjUtil::jqDateFormat($tpl['option_arr']['o_date_format']);
	
	$rev = 0;
	$time_link = __('lnkAddTime', true);
	$start_hour = '00'; $start_minute = '00';
	$end_hour = '00'; $end_minute = '00';
	if(!empty($tpl['arr']['start_time']) && !empty($tpl['arr']['end_time']))
	{
		$rev = 1;
		$start_time_arr = explode(':', $tpl['arr']['start_time']);
		$start_hour = $start_time_arr[0];
		$start_minute = $start_time_arr[1];
		$end_time_arr = explode(':', $tpl['arr']['end_time']);
		$end_hour = $end_time_arr[0];
		$end_minute = $end_time_arr[1];
	}else if(empty($tpl['arr']['start_time']) && !empty($tpl['arr']['end_time'])){
		$rev = 2;
		$end_time_arr = explode(':', $tpl['arr']['end_time']);
		$end_hour = $end_time_arr[0];
		$end_minute = $end_time_arr[1];
		$time_link = __('lnkAddStartTime', true);
	}else if(!empty($tpl['arr']['start_time']) && empty($tpl['arr']['end_time'])){
		$rev = 3;
		$start_time_arr = explode(':', $tpl['arr']['start_time']);
		$start_hour = $start_time_arr[0];
		$start_minute = $start_time_arr[1];
		$time_link = __('lnkAddEndTime', true);
	}
	?>
	<div class="ui-tabs ui-widget ui-widget-content ui-corner-all b10">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminEvents&amp;action=pjActionIndex"><?php __('menuEvents'); ?></a></li>
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminEvents&amp;action=pjActionCreate"><?php __('lblAddEvent'); ?></a></li>
			<li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminEvents&amp;action=pjActionUpdate&amp;id=<?php echo $tpl['arr']['id']; ?>"><?php __('lblUpdateEvent'); ?></a></li>
		</ul>
	</div>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminEvents&amp;action=pjActionUpdate" method="post" id="frmUpdateEvent" class="form pj-form">
		<input type="hidden" name="event_update" value="1" />
		<input type="hidden" name="id" value="<?php echo $tpl['arr']['id']; ?>" />
		<input type="hidden" name="recurring_id" value="<?php echo $tpl['arr']['recurring_id']; ?>" />
		<input type="hidden" id="time_flag" name="time_flag" value="<?php echo $rev;?>" />
		<p>
			<label class="title"><?php __('lblEventDate'); ?></label>
			<span class="pj-form-field-custom pj-form-field-custom-after">
				<input type="text" name="event_date" id="event_date" class="pj-form-field pointer w80 required datepick" value="<?php echo pjUtil::formatDate($tpl['arr']['event_date'], "Y-m-d", $tpl['option_arr']['o_date_format']); ?>" readonly="readonly" rel="<?php echo $week_start; ?>" rev="<?php echo $jqDateFormat; ?>" />
				<span class="pj-form-field-after"><abbr class="pj-form-field-icon-date"></abbr></span>
			</span>
		</p>
		
		<p id="time_link_container">
			<label class="title">&nbsp;</label>
			<span class="inline_block">
				<a href="#" id="time_link" class="time-link" rev="<?php echo $rev?>" style="display:<?php echo $rev != 1 ? 'block' : 'none';?>;" ><?php echo $time_link;?></a>
			</span>
		</p>
		<p id="start_time_box" style="display:<?php echo ($rev == 2 || $rev == 0) ? 'none' : 'block';?>;">
			<label class="title"><?php __('lblStartTime'); ?></label>
			<select name="start_hour" id="start_hour" class="pj-form-field">
				<?php 
				for($i = 0; $i < 24; $i++)
				{
					if($i < 10){
						$i = '0' . $i;
					}
					?><option value="<?php echo $i;?>" <?php echo $start_hour == $i ? 'selected="selected"' : null; ?>><?php echo $i;?></option><?php
				}
				?>
			</select>
			<select name="start_minute" id="start_minute" class="pj-form-field">
				<?php 
				for($i = 0; $i < 60; $i = $i + 5)
				{
					if($i < 10){
						$i = '0' . $i;
					}
					?><option value="<?php echo $i;?>" <?php echo $start_minute == $i ? 'selected="selected"' : null; ?>><?php echo $i;?></option><?php
				}
				?>
			</select>
			<span class="inline_block">
				<a href="#" class="remove-link" rev="2"><?php __('lnkRemoveTime');?></a>
			</span>
		</p>
		<p id="end_time_box"  style="display:<?php echo ($rev == 3 || $rev == 0) ? 'none' : 'block';?>;">
			<label class="title"><?php __('lblEndTime'); ?></label>
			<select name="end_hour" id="end_hour" class="pj-form-field">
				<?php 
				for($i = 0; $i < 24; $i++)
				{
					if($i < 10){
						$i = '0' . $i;
					}
					?><option value="<?php echo $i;?>" <?php echo $end_hour == $i ? 'selected="selected"' : null; ?>><?php echo $i;?></option><?php
				}
				?>
			</select>
			<select name="end_minute" id="end_minute" class="pj-form-field">
				<?php 
				for($i = 0; $i < 60; $i = $i + 5)
				{
					if($i < 10){
						$i = '0' . $i;
					}
					?><option value="<?php echo $i;?>" <?php echo $end_minute == $i ? 'selected="selected"' : null; ?>><?php echo $i;?></option><?php
				}
				?>
			</select>
			<span class="inline_block">
				<a href="#" class="remove-link" rev="3"><?php __('lnkRemoveTime');?></a>
			</span>
			<span id="err_time_check" style="display:none;"><label><?php __('lblTimeError');?></label></span>
		</p>
		<p>
			<label class="title"><?php __('lblEventTitle'); ?></label>
			<span class="inline_block">
				<input type="text" name="event_title" id="event_title" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['event_title'])); ?>" class="pj-form-field w400 required" />
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblCategory'); ?></label>
			<span class="inline_block">
				<select name="category_id" id="category_id" class="pj-form-field w250">
					<option value="">-- <?php __('lblChoose');?> --</option>
					<?php
					foreach($tpl['category_arr'] as $v){
						?><option value="<?php echo $v['id']?>" <?php echo $v['id'] == $tpl['arr']['category_id'] ? 'selected="selected"' : null; ?>><?php echo $v['category']?></option><?php
					} 
					?>
				</select>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblDescription'); ?></label>
			<span class="inline_block">
				<textarea name="description" id="description" class="pj-form-field w450 h100"><?php echo stripslashes($tpl['arr']['description']);?></textarea>
			</span>
		</p>
		<?php
		if($tpl['number_of_events'] > 1)
		{ 
			$text_apply = str_replace('{numevents}', $tpl['number_of_events'], __('lblApplyRecurring', true));
			?>
			<p>
				<label class="title">&nbsp;</label>
				<span class="inline_block">
					<input type="checkbox" class="float_left t5 r10" value="1" id="apply_recurring" name="apply_recurring">
					<label for="apply_recurring" class="apply-recurring"><?php echo $text_apply;?></label>
				</span>
			</p>
			<?php
		} else {
			?>
			<p>
				<label class="title"><?php __('lblRepeat'); ?></label>
				<?php
				$repeat_arr = __('repeatarr', true);
				?>
				<select name="repeat" id="repeat" class="pj-form-field">
					<option value="none">-- <?php echo $repeat_arr['none'];?> --</option>
					<option value="daily"><?php echo $repeat_arr['daily'];?></option>
					<option value="weekly"><?php echo $repeat_arr['weekly'];?></option>
					<option value="monthly"><?php echo $repeat_arr['monthly'];?></option>
					<option value="quarterly"><?php echo $repeat_arr['quarterly'];?></option>
					<option value="yearly"><?php echo $repeat_arr['yearly'];?></option>
					<option value="custom"><?php echo $repeat_arr['custom'];?></option>
				</select>
			</p>
			<div id="repeat_box" style="display:none;">
				<p id="repeat_daily" style="display:none;">
					<label class="title">&nbsp;</label>
				<span class="inline_block">
					<?php __('lblRepeatEveryDay');?>
				</span>
				</p>
				<p id="repeat_weekly" style="display:none;">
					<label class="title">&nbsp;</label>
				<span class="inline_block">
					<?php __('lblRepeatEveryWeek');?>
				</span>
				</p>
				<div id="repeat_monthly" style="display:none;">
					<p>
						<label class="title"><?php __('lblOn');?></label>
					<span class="inline_block">
						<select id="repeat-monthly-date" name="repeat-monthly-date" class="pj-form-field">
							<?php
							$monthly_date = __('monthly_date', true);
							ksort($monthly_date);
							foreach($monthly_date as $k => $v){
								?><option value="<?php echo $k;?>"><?php echo $v;?></option><?php
							}
							?>
						</select>
					</span>
					<span class="inline_block">
						<?php __('lblOfTheMonth');?>
					</span>
					</p>
					<p>
						<label class="title"><?php __('lblOrEach');?></label>
					<span class="inline_block">
						<select id="repeat-monthly-each" name="repeat-monthly-each" class="pj-form-field">
							<?php
							$monthly_each = __('monthly_each', true);
							?>
							<option value="first"><?php echo $monthly_each['first'];?></option>
							<option value="second"><?php echo $monthly_each['second'];?></option>
							<option value="third"><?php echo $monthly_each['third'];?></option>
							<option value="forth"><?php echo $monthly_each['forth'];?></option>
						</select>
					</span>
					<span class="inline_block">
						<select id="repeat-monthly-day" name="repeat-monthly-day" class="pj-form-field">
							<?php
							$day_names = __('days', true);
							ksort($day_names);
							foreach($day_names as $k => $v){
								?><option value="<?php echo $v;?>"><?php echo substr($v, 0, 3);?></option><?php
							}
							?>
						</select>
					</span>
					<span class="inline_block">
						<?php __('lblOfTheMonth');?>
					</span>
					</p>
				</div>
				<p id="repeat_quarterly" style="display:none;">
					<label class="title">&nbsp;</label>
				<span class="inline_block">
					<?php __('lblRepeatEveryQuarter');?>
				</span>
				</p>
				<p id="repeat_yearly" style="display:none;">
					<label class="title">&nbsp;</label>
				<span class="inline_block">
					<?php __('lblRepeatEveryYear');?>
				</span>
				</p>
				<p id="repeat_custom" style="display:none;">
					<label class="title"><?php __('lblEach');?></label>
				<span class="inline_block">
					<input type="text" name="repeat-custom-days" id="repeat-custom-days" class="pj-form-field w50" />
				</span>
				<span class="inline_block">
					<?php __('lblDays');?>
				</span>
				</p>
				<p>
					<label class="title"><?php __('lblEndRecurringOn'); ?></label>
				<span class="pj-form-field-custom pj-form-field-custom-after">
					<input type="text" name="end_repeat_date" id="end_repeat_date" class="pj-form-field pointer w80 datepick" value="" readonly="readonly" rel="<?php echo $week_start; ?>" rev="<?php echo $jqDateFormat; ?>" />
					<span class="pj-form-field-after"><abbr class="pj-form-field-icon-date"></abbr></span>
				</span>
				</p>
				<p>
					<label class="title"><?php __('lblOrRepeat'); ?></label>
				<span class="inline_block">
					<input type="text" name="end_repeat_times" id="end_repeat_times" class="pj-form-field w50" />
				</span>
				<span class="inline_block">
					<?php __('lblTimes');?>
				</span>
				</p>
			</div>
			<?php
		}
		?>
		<p>
			<label class="title">&nbsp;</label>
			<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
			<input type="button" value="<?php __('btnCancel'); ?>" class="pj-button" onclick="window.location.href='<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjAdminEvents&action=pjActionIndex';" />
		</p>
		
	</form>
	<script type="text/javascript">
	var myLabel = myLabel || {};
	myLabel.add_time = "<?php __('lnkAddTime'); ?>";
	myLabel.add_start_time = "<?php __('lnkAddStartTime'); ?>";
	myLabel.add_end_time = "<?php __('lnkAddEndTime'); ?>";
	</script>
	<?php
}
?>