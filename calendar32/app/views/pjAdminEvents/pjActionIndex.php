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
	if (isset($_GET['err']))
	{
		$titles = __('error_titles', true);
		$bodies = __('error_bodies', true);
		pjUtil::printNotice(@$titles[$_GET['err']], @$bodies[$_GET['err']]);
	}
	$week_start = isset($tpl['option_arr']['o_week_start']) && in_array((int) $tpl['option_arr']['o_week_start'], range(0,6)) ? (int) $tpl['option_arr']['o_week_start'] : 0;
	$jqDateFormat = pjUtil::jqDateFormat($tpl['option_arr']['o_date_format']);
	
	$months = __('months', true);
	$short_months = __('short_months', true);
	ksort($months);
	ksort($short_months);
	$days = __('days', true);
	$short_days = __('short_days', true);
	?>
	<div class="ui-tabs ui-widget ui-widget-content ui-corner-all b10">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminEvents&amp;action=pjActionIndex"><?php __('menuEvents'); ?></a></li>
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminEvents&amp;action=pjActionExport"><?php __('lblExport'); ?></a></li>
		</ul>
	</div>
	<?php
	pjUtil::printNotice(__('infoEventsTitle', true), __('infoEventsDesc', true));
	?>
	<div class="b10">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="float_left pj-form r10">
			<input type="hidden" name="controller" value="pjAdminEvents" />
			<input type="hidden" name="action" value="pjActionCreate" />
			<input type="submit" class="pj-button" value="<?php __('btnAddEvent'); ?>" />
		</form>
		<form action="" method="get" class="float_left pj-form frm-filter">
			<input type="text" name="q" class="pj-form-field pj-form-field-search w120" placeholder="<?php __('btnSearch'); ?>" />
			<button type="button" class="pj-button pj-button-detailed"><span class="pj-button-detailed-arrow"></span></button>
		</form>
		
		<?php
		$filter = __('filter', true);
		$event_statuses = __('event_statarr', true);
		?>
		<div class="float_right t5">
			<a href="#" class="pj-button btn-all"><?php __('lblAll');?></a>
			<a href="#" class="pj-button btn-filter btn-status" data-column="status" data-value="T"><?php echo $event_statuses['T']; ?></a>
			<a href="#" class="pj-button btn-filter btn-status" data-column="status" data-value="F"><?php echo $event_statuses['F']; ?></a>
		</div>
		<br class="clear_both" />
	</div>

	<div class="pj-form-filter-advanced" style="display: none">
		<span class="pj-menu-list-arrow"></span>
		<form action="" method="get" class="form pj-form pj-form-search frm-filter-advanced">
			<div class="float_left w350">
				<p>
					<label class="title80"><?php __('lblEventTitle'); ?></label>
					<input type="text" name="keyword" id="keyword" class="pj-form-field w200" />
				</p>
				<p>
					<label class="title80"><?php __('lblCategory'); ?></label>
					<select name="category_id" id="category_id" class="pj-form-field w200">
						<option value="">-- <?php __('lblChoose');?> --</option>
						<option value="0"><?php __('lblNone');?></option>
						<?php
						foreach($tpl['category_arr'] as $v){
							?><option value="<?php echo $v['id']?>"><?php echo $v['category']?></option><?php
						} 
						?>
					</select>
				</p>
			</div>
			<div class="float_right w350">
				<p>
					<label class="title80"><?php __('lblFrom'); ?></label>
					<span class="pj-form-field-custom pj-form-field-custom-after">
						<input type="text" name="from_date" id="from_date" class="pj-form-field pointer w80 required datepick" value="" readonly="readonly" rel="<?php echo $week_start; ?>" rev="<?php echo $jqDateFormat; ?>" data-msg-required="<?php __('lblFieldRequired');?>" data-months="<?php echo join(',', $months);?>" data-shortmonths="<?php echo join(',', $short_months);?>" data-day="<?php echo join(',', $days);?>" data-daymin="<?php echo join(',', $short_days);?>"/>
						<span class="pj-form-field-after"><abbr class="pj-form-field-icon-date"></abbr></span>
					</span>
				</p>
				<p>
					<label class="title80"><?php __('lblTo'); ?></label>
					<span class="pj-form-field-custom pj-form-field-custom-after">
						<input type="text" name="to_date" id="to_date" class="pj-form-field pointer w80 required datepick" value="" readonly="readonly" rel="<?php echo $week_start; ?>" rev="<?php echo $jqDateFormat; ?>" data-msg-required="<?php __('lblFieldRequired');?>" data-months="<?php echo join(',', $months);?>" data-shortmonths="<?php echo join(',', $short_months);?>" data-day="<?php echo join(',', $days);?>" data-daymin="<?php echo join(',', $short_days);?>"/>
						<span class="pj-form-field-after"><abbr class="pj-form-field-icon-date"></abbr></span>
					</span>
				</p>
			</div>
			<br class="clear_both" />
			<p>
				<label class="title80">&nbsp;</label>
				<input type="submit" value="<?php __('btnSearch'); ?>" class="pj-button" />
				<input type="reset" value="<?php __('btnCancel'); ?>" class="pj-button" />
			</p>
		</form>
	</div>
	
	<div id="grid"></div>
	<script type="text/javascript">
	
	var pjGrid = pjGrid || {};
	pjGrid.jsDateFormat = "<?php echo pjUtil::jsDateFormat($tpl['option_arr']['o_date_format']); ?>";
	pjGrid.find = "<?php echo isset($_GET['find']) ? 'true' : 'false';?>";
	var myLabel = myLabel || {};
	myLabel.eventdate = "<?php __('lblEventDate'); ?>";
	myLabel.category = "<?php __('lblCategory'); ?>";
	myLabel.eventtime = "<?php __('lblEventTime'); ?>";
	myLabel.eventtitle = "<?php __('lblEventTitle'); ?>";
	myLabel.revert_status = "<?php __('revert_status'); ?>";
	myLabel.exported = "<?php __('lblExport'); ?>";
	myLabel.active = "<?php echo $event_statuses['T']; ?>";
	myLabel.inactive = "<?php echo $event_statuses['F']; ?>";
	myLabel.delete_selected = "<?php __('pec_delete_selected'); ?>";
	myLabel.delete_confirmation = "<?php __('pec_delete_confirmation'); ?>";
	myLabel.status = "<?php __('lblStatus'); ?>";
	</script>
	<?php
}
?>