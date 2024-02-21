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
	?>
	<div class="ui-tabs ui-widget ui-widget-content ui-corner-all b10">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminEvents&amp;action=pjActionIndex"><?php __('menuEvents'); ?></a></li>
			<li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminEvents&amp;action=pjActionCreate"><?php __('lblAddEvent'); ?></a></li>
		</ul>
	</div>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminEvents&amp;action=pjActionCreate" method="post" id="frmCreateEvent" class="pj-form form">
		<input type="hidden" name="event_create" value="1" />
		<input type="hidden" id="time_flag" name="time_flag" value="0" />
		
		<p>
			<label class="title"><?php __('lblEventDate'); ?></label>
			<span class="pj-form-field-custom pj-form-field-custom-after">
				<input type="text" name="event_date" id="event_date" class="pj-form-field pointer w80 required datepick" value="" readonly="readonly" rel="<?php echo $week_start; ?>" rev="<?php echo $jqDateFormat; ?>" />
				<span class="pj-form-field-after"><abbr class="pj-form-field-icon-date"></abbr></span>
			</span>
		</p>
		<p id="time_link_container">
			<label class="title">&nbsp;</label>
			<span class="inline_block">
				<a href="#" id="time_link" class="time-link" rev="0"><?php __('lnkAddTime');?></a>
			</span>
		</p>
		<p id="start_time_box" style="display:none;">
			<label class="title"><?php __('lblStartTime'); ?></label>
			<select name="start_hour" id="start_hour" class="pj-form-field">
				<?php 
				for($i = 0; $i < 24; $i++)
				{
					if($i < 10){
						$i = '0' . $i;
					}
					?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php
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
					?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php
				}
				?>
			</select>
			<span class="inline_block">
				<a href="#" class="remove-link" rev="2"><?php __('lnkRemoveTime');?></a>
			</span>
		</p>
		<p id="end_time_box"  style="display:none;">
			<label class="title"><?php __('lblEndTime'); ?></label>
			<select name="end_hour" id="end_hour" class="pj-form-field">
				<?php 
				for($i = 0; $i < 24; $i++)
				{
					if($i < 10){
						$i = '0' . $i;
					}
					?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php
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
					?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php
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
				<input type="text" name="event_title" id="event_title" class="pj-form-field w400 required" />
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblCategory'); ?></label>
			<span class="inline_block">
				<select name="category_id" id="category_id" class="pj-form-field w250">
					<option value="">-- <?php __('lblChoose');?> --</option>
					<?php
					foreach($tpl['category_arr'] as $v){
						?><option value="<?php echo $v['id']?>"><?php echo $v['category']?></option><?php
					} 
					?>
				</select>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblDescription'); ?></label>
			<span class="inline_block">
				<textarea name="description" id="description" class="pj-form-field w450 h100"></textarea>
			</span>
		</p>
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