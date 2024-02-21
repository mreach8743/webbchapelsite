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
	
	$months = __('months', true);
	$short_months = __('short_months', true);
	ksort($months);
	ksort($short_months);
	$days = __('days', true);
	$short_days = __('short_days', true);
	
	$time_ampm = 0;
	$max_hour = 24;
	if(strpos($tpl['option_arr']['o_time_format'], 'a') > -1)
	{
		$time_ampm = 1;
		$max_hour = 12;
	}
	if(strpos($tpl['option_arr']['o_time_format'], 'A') > -1)
	{
		$time_ampm = 2;
		$max_hour = 12;
	}
	$ampm_arr = array('am' => 'AM', 'pm' => 'PM');
	
	?>
	<div class="ui-tabs ui-widget ui-widget-content ui-corner-all b10">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminEvents&amp;action=pjActionIndex"><?php __('menuEvents'); ?></a></li>
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminEvents&amp;action=pjActionExport"><?php __('lblExport'); ?></a></li>
		</ul>
	</div>
	<?php
	pjUtil::printNotice(__('infoAddEventTitle', true), __('infoAddEventDesc', true));
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminEvents&amp;action=pjActionCreate" method="post" id="frmCreateEvent" class="pj-form form">
		<input type="hidden" name="event_create" value="1" />
		<input type="hidden" id="time_flag" name="time_flag" value="0" />
		<input type="hidden" id="time_ampm" name="time_ampm" value="<?php echo $time_ampm;?>" />
		
		<p>
			<label class="title"><?php __('lblEventDate'); ?></label>
			<span class="pj-form-field-custom pj-form-field-custom-after">
				<input type="text" name="event_date" id="event_date" class="pj-form-field pointer w80 required datepick" value="" readonly="readonly" rel="<?php echo $week_start; ?>" rev="<?php echo $jqDateFormat; ?>" data-msg-required="<?php __('lblFieldRequired');?>" data-months="<?php echo join(',', $months);?>" data-shortmonths="<?php echo join(',', $short_months);?>" data-day="<?php echo join(',', $days);?>" data-daymin="<?php echo join(',', $short_days);?>"/>
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
				if($time_ampm == 0)
				{ 
					for($i = 0; $i < 24; $i++)
					{
						if($i < 10){
							$i = '0' . $i;
						}
						?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php
					}
				}else{
					foreach(pjUtil::getHours() as $v)
					{
						?><option value="<?php echo $v;?>"><?php echo $v;?></option><?php
					}
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
			<?php
			if($time_ampm > 0)
			{
				?>
				<select name="start_ampm" id="start_ampm" class="pj-form-field">
					<?php
					foreach($ampm_arr as $k => $v)
					{
						?><option value="<?php echo $time_ampm == 1 ? $k : $v;?>"><?php echo $time_ampm == 1 ? $k : $v;?></option><?php
					} 
					?>
				</select>
				<?php
			} 
			?>
			<span class="inline_block">
				<a href="#" class="remove-link" rev="2"><?php __('lnkRemoveTime');?></a>
			</span>
		</p>
		<p id="end_time_box"  style="display:none;">
			<label class="title"><?php __('lblEndTime'); ?></label>
			<select name="end_hour" id="end_hour" class="pj-form-field">
				<?php
				if($time_ampm == 0)
				{ 
					for($i = 0; $i < 24; $i++)
					{
						if($i < 10){
							$i = '0' . $i;
						}
						?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php
					}
				}else{
					foreach(pjUtil::getHours() as $v)
					{
						?><option value="<?php echo $v;?>"><?php echo $v;?></option><?php
					}
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
			<?php
			if($time_ampm > 0)
			{
				?>
				<select name="end_ampm" id="end_ampm" class="pj-form-field">
					<?php
					foreach($ampm_arr as $k => $v)
					{
						?><option value="<?php echo $time_ampm == 1 ? $k : $v;?>"><?php echo $time_ampm == 1 ? $k : $v;?></option><?php
					} 
					?>
				</select>
				<?php
			} 
			?>
			<span class="inline_block">
				<a href="#" class="remove-link" rev="3"><?php __('lnkRemoveTime');?></a>
			</span>
			<span id="err_time_check" style="display:none;"><label><?php __('lblTimeError');?></label></span>
		</p>
		<p>
			<label class="title"><?php __('lblEventTitle'); ?></label>
			<span class="inline_block">
				<input type="text" name="event_title" id="event_title" class="pj-form-field w400 required" data-msg-required="<?php __('lblFieldRequired');?>"/>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblCategory'); ?></label>
			<span class="inline_block">
				<?php
				if(!empty($tpl['category_arr']))
				{ 
					?>
					<select name="category_id" id="category_id" class="pj-form-field w250">
						<option value="">-- <?php __('lblChoose');?> --</option>
						<?php
						foreach($tpl['category_arr'] as $v){
							?><option value="<?php echo $v['id']?>"><?php echo $v['category']?></option><?php
						} 
						?>
					</select>
					<?php
				}else{
					$link = __('lblNoCategoriesSet', true);
					$link = str_replace("[STAG]", '<a href="'.$_SERVER['PHP_SELF'].'?controller=pjAdminCategories&amp;action=pjActionIndex">', $link);
					$link = str_replace("[ETAG]", '</a>', $link);
					?>
					<label class="content"><?php echo $link; ?></label>
					<?php
				} 
				?>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblLocation'); ?></label>
			<span class="inline_block">
				<input type="text" name="location" id="location" class="pj-form-field w400 float_left r5" />
				<input type="hidden" name="lat" id="lat"/>
				<input type="hidden" name="lng" id="lng"/>
				<input type="hidden" name="tmp_lat" id="tmp_lat"/>
				<input type="hidden" name="tmp_lng" id="tmp_lng"/>
				<a href="#" class="pecMapIcon"></a>
			</span>
			<em style="display: none;"><label id="location_validation_message" for="location" generated="true" class="err" style="display: block;"><?php __('lblRequiredField');?></label></em>
		</p>
		<p>
			<label class="title"><?php __('lblDescription'); ?></label>
			<span class="inline_block">
				<textarea name="description" id="description" class="mceEditor" style="width: 570px; height: 300px"></textarea>
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
							<option value="fourth"><?php echo $monthly_each['fourth'];?></option>
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
					<input type="text" name="end_repeat_date" id="end_repeat_date" class="pj-form-field pointer w80 datepick" value="" readonly="readonly" rel="<?php echo $week_start; ?>" rev="<?php echo $jqDateFormat; ?>" data-months="<?php echo join(',', $months);?>" data-shortmonths="<?php echo join(',', $short_months);?>" data-day="<?php echo join(',', $days);?>" data-daymin="<?php echo join(',', $short_days);?>"/>
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
			<label class="title"><?php __('lblStatus'); ?></label>
			<span class="inline_block">
				<select name="status" id="status" class="pj-form-field required" data-msg-required="<?php __('lblFieldRequired');?>">
					<option value="">-- <?php __('lblChoose'); ?>--</option>
					<?php
					foreach (__('event_statarr', true) as $k => $v)
					{
						?><option value="<?php echo $k; ?>"<?php echo $k == 'T' ? ' selected="selected"' : null;?>><?php echo $v; ?></option><?php
					}
					?>
				</select>
			</span>
		</p>
		<p>
			<label class="title">&nbsp;</label>
			<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
			<input type="button" value="<?php __('btnCancel'); ?>" class="pj-button" onclick="window.location.href='<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjAdminEvents&action=pjActionIndex';" />
		</p>
	</form>
	<div id="dialogMapLocation" title="<?php __('infoDefineLocation'); ?>" style="display:none;">
		<div id="map_canvas" class="map-canvas"></div>
	</div>
	
	<script type="text/javascript">
	
	var myLabel = myLabel || {};
	myLabel.add_time = "<?php __('lnkAddTime'); ?>";
	myLabel.add_start_time = "<?php __('lnkAddStartTime'); ?>";
	myLabel.add_end_time = "<?php __('lnkAddEndTime'); ?>";
	myLabel.location_not_found = "<?php __('lblLocationNotFound'); ?>";
	</script>
	<?php
}
?>