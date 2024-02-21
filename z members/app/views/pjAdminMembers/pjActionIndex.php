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
	?>
	<div class="ui-tabs ui-widget ui-widget-content ui-corner-all b10">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminMembers&amp;action=pjActionIndex"><?php __('menuMembers'); ?></a></li>
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminMembers&amp;action=pjActionCreate"><?php __('lblAddMember'); ?></a></li>
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminMembers&amp;action=pjActionImport"><?php __('lblImport'); ?></a></li>
		</ul>
	</div>
	
	<div class="b10">
		<form action="" method="get" class="float_left pj-form frm-filter">
			<input type="text" name="q" class="pj-form-field pj-form-field-search w150" placeholder="<?php __('btnSearch'); ?>" />
			<button type="button" class="pj-button pj-button-detailed"><span class="pj-button-detailed-arrow"></span></button>
		</form>
		<?php
		$filter = __('filter', true);
		?>
		<div class="float_right t5">
			<a href="#" class="pj-button btn-all">All</a>
			<a href="#" class="pj-button btn-filter btn-status" data-column="status" data-value="T"><?php echo $filter['active']; ?></a>
			<a href="#" class="pj-button btn-filter btn-status" data-column="status" data-value="F"><?php echo $filter['inactive']; ?></a>
		</div>
		<br class="clear_both" />
	</div>

	<div class="pj-form-filter-advanced" style="display: none">
		<span class="pj-menu-list-arrow"></span>
		<form action="" method="get" class="form pj-form pj-form-search frm-filter-advanced">
			<div class="float_left w350">
				<p>
					<label class="title120"><?php __('lblFirstName'); ?></label>
					<input type="text" name="first_name" id="first_name" class="pj-form-field w200" />
				</p>
				<p>
					<label class="title120"><?php __('lblLastName'); ?></label>
					<input type="text" name="last_name" id="last_name" class="pj-form-field w200" />
				</p>
				<p>
					<label class="title120"><?php __('lblEmail'); ?></label>
					<input type="text" name="email" id="email" class="pj-form-field w200" />
				</p>
				<p>
					<label class="title120"><?php __('lblFilterLastLogin'); ?></label>
					<select name="last_login" id="last_login" class="pj-form-field w200">
						<option value="">-- <?php __('lblChoose'); ?> --</option>
						<?php
						$last_login = __('last_login', true, false);
						?>
						<option value="today"><?php echo $last_login['today']; ?></option>
						<option value="7_days"><?php echo $last_login['7_days']; ?></option>
						<option value="30_days"><?php echo $last_login['30_days']; ?></option>
						<option value="3_months"><?php echo $last_login['3_months']; ?></option>
					</select>
				</p>
				
			</div>
			<div class="float_right w350">
				<p>
					<label class="title120"><?php __('lblGroup'); ?></label>
					<select name="group_id" id="group_id" class="pj-form-field w200">
						<option value="">-- <?php __('lblChoose'); ?> --</option>
						<?php
						foreach ($tpl['group_arr'] as $v)
						{
							?><option value="<?php echo $v['id']; ?>"><?php echo stripslashes($v['group_title']); ?></option><?php
						}
						?>
					</select>
				</p>
				<p>
					<label class="title120"><?php __('lblStatus'); ?></label>
					<span class="inline_block">
						<select name="status" id="status" class="pj-form-field required w200">
							<option value="">-- <?php __('lblChoose'); ?>--</option>
							<?php
							foreach (__('u_statarr', true) as $k => $v)
							{
								?><option value="<?php echo $k; ?>"><?php echo $v; ?></option><?php
							}
							?>
						</select>
					</span>
				</p>
				<p>
					<label class="title120"><?php __('lblGender'); ?></label>
					<span class="inline_block">
						<select name="gender" id="gender" class="pj-form-field w200">
							<option value="">-- <?php __('lblChoose'); ?>--</option>
							<?php
							foreach (__('genderarr', true) as $k => $v)
							{
								?><option value="<?php echo $k; ?>"><?php echo $v; ?></option><?php
							}
							?>
						</select>
					</span>
				</p>
				<p>
					<label class="title120"><?php __('lblAge'); ?></label>
					<label class="content float_left r3"><?php __('lblFrom');?></label>
					<input type="text" name="age_from" id="age_from" class="pj-form-field w70 block float_left" />
					<label class="content float_left r3 l3"><?php __('lblTo');?></label>
					<input type="text" name="age_to" id="age_to" class="pj-form-field w70 block float_left" />
				</p>
			</div>
			<br class="clear_both" />
			<p>
				<label class="title120"><?php __('lblCountry'); ?></label>
				<select name="country_id" id="country_id" class="pj-form-field w350">
					<option value="">-- <?php __('lblChoose'); ?> --</option>
					<?php
					foreach ($tpl['country_arr'] as $v)
					{
						?><option value="<?php echo $v['id']; ?>"><?php echo stripslashes($v['country_title']); ?></option><?php
					}
					?>
				</select>
			</p>
			<p>
				<label class="title120">&nbsp;</label>
				<input type="submit" value="<?php __('btnSearch'); ?>" class="pj-button" />
				<input type="reset" value="<?php __('btnCancel'); ?>" class="pj-button" />
			</p>
		</form>
	</div>

	<div id="grid"></div>
	
	<script type="text/javascript">
		var pjGrid = pjGrid || {};
		pjGrid.roleId = <?php echo (int) $_SESSION[$controller->defaultUser]['role_id']; ?>;
		pjGrid.queryString = "";
		<?php
		if (isset($_GET['group_id']) && (int) $_GET['group_id'] > 0)
		{
			?>pjGrid.queryString += "&group_id=<?php echo (int) $_GET['group_id']; ?>";<?php
		}
		?>
		var myLabel = myLabel || {};
		myLabel.install_url = "<?php echo PJ_INSTALL_URL; ?>";
		myLabel.first_name = "<?php __('lblFirstName'); ?>";
		myLabel.last_name = "<?php __('lblLastName'); ?>";
		myLabel.email = "<?php __('lblEmail'); ?>";
		myLabel.group = "<?php __('lblGroup'); ?>";
		myLabel.active = "<?php __('lblActive'); ?>";
		myLabel.inactive = "<?php __('lblInactive'); ?>";
		myLabel.exported = "<?php __('lblExport'); ?>";
		myLabel.revert_status = "<?php __('revert_status'); ?>";
		myLabel.delete_selected = "<?php __('pj_delete_selected'); ?>";
		myLabel.delete_confirmation = "<?php __('pj_delete_confirmation'); ?>";
		myLabel.status = "<?php __('lblStatus'); ?>";
	</script>
	<?php
}
?>