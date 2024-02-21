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
	$start_ampm = $end_ampm = '';
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
	
	$rev = 0;
	$time_link = __('lnkAddTime', true);
	$start_hour = '00'; $start_minute = '00';
	$end_hour = '00'; $end_minute = '00';
	if(!empty($tpl['arr']['start_time']) && !empty($tpl['arr']['end_time']))
	{
		$rev = 1;
		if($time_ampm == 0)
		{
			$start_time_arr = explode(':', $tpl['arr']['start_time']);
		}else{
			$_date = date("g:i a", strtotime($tpl['arr']['start_time']));
			list($start_hour_min, $start_ampm) = explode(" ", $_date);
			$start_time_arr = explode(':', $start_hour_min);
		}
		$start_hour = $start_time_arr[0];
		$start_minute = $start_time_arr[1];
		if($time_ampm == 0)
		{
			$end_time_arr = explode(':', $tpl['arr']['end_time']);
		}else{
			$_date = date("g:i a", strtotime($tpl['arr']['end_time']));
			list($end_hour_min, $end_ampm) = explode(" ", $_date);
			$end_time_arr = explode(':', $end_hour_min);
		}
		$end_hour = $end_time_arr[0];
		$end_minute = $end_time_arr[1];
	}else if(empty($tpl['arr']['start_time']) && !empty($tpl['arr']['end_time'])){
		$rev = 2;
		if($time_ampm == 0)
		{
			$end_time_arr = explode(':', $tpl['arr']['end_time']);
		}else{
			$_date = date("g:i a", strtotime($tpl['arr']['end_time']));
			list($end_hour_min, $end_ampm) = explode(" ", $_date);
			$end_time_arr = explode(':', $end_hour_min);
		}
		$end_hour = $end_time_arr[0];
		$end_minute = $end_time_arr[1];
		$time_link = __('lnkAddStartTime', true);
	}else if(!empty($tpl['arr']['start_time']) && empty($tpl['arr']['end_time'])){
		$rev = 3;
		if($time_ampm == 0)
		{
			$start_time_arr = explode(':', $tpl['arr']['start_time']);
		}else{
			$_date = $time_ampm == date("g:i a", strtotime($tpl['arr']['start_time']));
			list($start_hour_min, $start_ampm) = explode(" ", $_date);
			$start_time_arr = explode(':', $start_hour_min);
		}
		$start_hour = $start_time_arr[0];
		$start_minute = $start_time_arr[1];
		$time_link = __('lnkAddEndTime', true);
	}
	?>
	<div class="ui-tabs ui-widget ui-widget-content ui-corner-all b10">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminEvents&amp;action=pjActionIndex"><?php __('menuEvents'); ?></a></li>
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminEvents&amp;action=pjActionExport"><?php __('lblExport'); ?></a></li>
		</ul>
	</div>
	<?php
	pjUtil::printNotice(__('infoUpdateEventTitle', true), __('infoUpdateEventDesc', true));
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminEvents&amp;action=pjActionUpdate" method="post" id="frmUpdateEvent" class="form pj-form">
		<input type="hidden" name="event_update" value="1" />
		<input type="hidden" name="id" value="<?php echo $tpl['arr']['id']; ?>" />
		<input type="hidden" name="recurring_id" value="<?php echo $tpl['arr']['recurring_id']; ?>" />
		<input type="hidden" id="time_flag" name="time_flag" value="<?php echo $rev;?>" />
		<input type="hidden" id="time_ampm" name="time_ampm" value="<?php echo $time_ampm;?>" />
		<p>
			<label class="title"><?php __('lblEventDate'); ?></label>
			<span class="pj-form-field-custom pj-form-field-custom-after">
				<input type="text" name="event_date" id="event_date" class="pj-form-field pointer w80 required datepick" value="<?php echo pjUtil::formatDate($tpl['arr']['event_date'], "Y-m-d", $tpl['option_arr']['o_date_format']); ?>" readonly="readonly" rel="<?php echo $week_start; ?>" rev="<?php echo $jqDateFormat; ?>" data-msg-required="<?php __('lblFieldRequired');?>" data-months="<?php echo join(',', $months);?>" data-shortmonths="<?php echo join(',', $short_months);?>" data-day="<?php echo join(',', $days);?>" data-daymin="<?php echo join(',', $short_days);?>"/>
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
				if($time_ampm == 0)
				{ 
					for($i = 0; $i < $max_hour; $i++)
					{
						if($i < 10){
							$i = '0' . $i;
						}
						?><option value="<?php echo $i;?>" <?php echo $start_hour == $i ? 'selected="selected"' : null; ?>><?php echo $i;?></option><?php
					}
				}else{
					foreach(pjUtil::getHours() as $v)
					{
						?><option value="<?php echo $v;?>"<?php echo $start_hour == $v ? 'selected="selected"' : null; ?>><?php echo $v;?></option><?php
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
					?><option value="<?php echo $i;?>" <?php echo $start_minute == $i ? 'selected="selected"' : null; ?>><?php echo $i;?></option><?php
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
						?><option value="<?php echo $time_ampm == 1 ? $k : $v;?>"<?php echo $k == $start_ampm ? ' selected="selected"' : null;?>><?php echo $time_ampm == 1 ? $k : $v;?></option><?php
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
		<p id="end_time_box"  style="display:<?php echo ($rev == 3 || $rev == 0) ? 'none' : 'block';?>;">
			<label class="title"><?php __('lblEndTime'); ?></label>
			<select name="end_hour" id="end_hour" class="pj-form-field">
				<?php 
				if($time_ampm == 0)
				{
					for($i = 0; $i < $max_hour; $i++)
					{
						if($i < 10){
							$i = '0' . $i;
						}
						?><option value="<?php echo $i;?>" <?php echo $end_hour == $i ? 'selected="selected"' : null; ?>><?php echo $i;?></option><?php
					}
				}else{
					foreach(pjUtil::getHours() as $v)
					{
						?><option value="<?php echo $v;?>"<?php echo $end_hour == $v ? 'selected="selected"' : null; ?>><?php echo $v;?></option><?php
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
					?><option value="<?php echo $i;?>" <?php echo $end_minute == $i ? 'selected="selected"' : null; ?>><?php echo $i;?></option><?php
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
						?><option value="<?php echo $time_ampm == 1 ? $k : $v;?>"<?php echo $k == $end_ampm ? ' selected="selected"' : null;?>><?php echo $time_ampm == 1 ? $k : $v;?></option><?php
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
				<input type="text" name="event_title" id="event_title" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['event_title'])); ?>" class="pj-form-field w400 required" data-msg-required="<?php __('lblFieldRequired');?>"/>
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
							?><option value="<?php echo $v['id']?>" <?php echo $v['id'] == $tpl['arr']['category_id'] ? 'selected="selected"' : null; ?>><?php echo $v['category']?></option><?php
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
				<input type="text" name="location" id="location" value="<?php echo stripslashes($tpl['arr']['location']);?>" class="pj-form-field w400 float_left r5" />
				<input type="hidden" name="lat" id="lat" value="<?php echo stripslashes($tpl['arr']['lat']);?>"/>
				<input type="hidden" name="lng" id="lng" value="<?php echo stripslashes($tpl['arr']['lng']);?>"/>
				<input type="hidden" name="tmp_lat" id="tmp_lat" value="<?php echo stripslashes($tpl['arr']['lat']);?>"/>
				<input type="hidden" name="tmp_lng" id="tmp_lng" value="<?php echo stripslashes($tpl['arr']['lng']);?>"/>
				<a href="#" class="pecMapIcon"></a>
			</span>
			<em style="display: none;"><label id="location_validation_message" for="location" generated="true" class="err" style="display: block;"><?php __('lblRequiredField');?></label></em>
		</p>
		<p>
			<label class="title"><?php __('lblDescription'); ?></label>
			<span class="inline_block">
				<textarea name="description" id="description" class="mceEditor" style="width: 570px; height: 300px"><?php echo stripslashes($tpl['arr']['description']);?></textarea>
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
		} 
		?>
		<p>
			<label class="title"><?php __('lblStatus'); ?></label>
			<span class="inline_block">
				<select name="status" id="status" class="pj-form-field required" data-msg-required="<?php __('lblFieldRequired');?>">
					<option value="">-- <?php __('lblChoose'); ?>--</option>
					<?php
					foreach (__('event_statarr', true) as $k => $v)
					{
						?><option value="<?php echo $k; ?>"<?php echo $tpl['arr']['status'] == $k ? ' selected="selected"' : null;?>><?php echo $v; ?></option><?php
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
	<div id="dialogMapLocation" title="<?php __('lblLocationOnMap'); ?>" style="display:none;">
		<div class="map-message"><?php __('infoDefineLocation'); ?></div>
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