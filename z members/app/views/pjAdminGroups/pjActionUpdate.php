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
	$periods = __('subscription_period', true);
	?>
	<div class="ui-tabs ui-widget ui-widget-content ui-corner-all b10">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminGroups&amp;action=pjActionIndex"><?php __('menuGroups'); ?></a></li>
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminGroups&amp;action=pjActionCreate"><?php __('lblAddGroup'); ?></a></li>
			<li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminGroups&amp;action=pjActionUpdate&amp;id=<?php echo $tpl['arr']['id']; ?>"><?php __('lblUpdateGroup'); ?></a></li>
		</ul>
	</div>
	<?php
	pjUtil::printNotice(__('infoUpdateGroupTitle', true), __('infoUpdateGroupBody', true));  
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminGroups&amp;action=pjActionUpdate" method="post" id="frmUpdateGroup" class="form pj-form">
		<input type="hidden" name="group_update" value="1" />
		<input type="hidden" name="id" value="<?php echo $tpl['arr']['id']; ?>" />
		<p>
			<label class="title"><?php __('menuMembers'); ?></label>
			<label class="content">
				<?php
				if($tpl['arr']['cnt_members'] > 0)
				{ 
					?><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminMembers&amp;action=pjActionIndex&group_id=<?php echo $tpl['arr']['id'];?>"><?php echo $tpl['arr']['cnt_members'];?></a><?php
				}else{
					echo $tpl['arr']['cnt_members'];
				} 
				?>
			</label>
		</p>
		
		<p>
			<label class="title"><?php __('lblGroup'); ?></label>
			<span class="inline_block">
				<input type="text" name="group_title" id="group_title" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['group_title'])); ?>" class="pj-form-field w300 required" />
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblHomePageUrl'); ?></label>
			<span class="pj-form-field-custom pj-form-field-custom-before">
				<span class="pj-form-field-before"><abbr class="pj-form-field-icon-url"></abbr></span>
				<input type="text" name="home_url" id="home_url" class="pj-form-field w300" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['home_url'])); ?>" />
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblRegistrationFee'); ?></label>
			<span class="pj-form-field-custom pj-form-field-custom-before">
				<span class="pj-form-field-before"><abbr class="pj-form-field-icon-text"><?php echo pjUtil::formatCurrencySign(NULL, $tpl['option_arr']['o_currency'], ""); ?></abbr></span>
				<input type="text" name="registration_fee" value="<?php echo $tpl['arr']['registration_fee']; ?>" class="pj-form-field align_right w70 number" />
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblSubscriptionFee'); ?></label>
			<span class="block overflow">
				<span class="pj-form-field-custom pj-form-field-custom-before float_left">
					<span class="pj-form-field-before"><abbr class="pj-form-field-icon-text"><?php echo pjUtil::formatCurrencySign(NULL, $tpl['option_arr']['o_currency'], ""); ?></abbr></span>
					<input type="text" id="subscription_fee" name="subscription_fee" value="<?php echo $tpl['arr']['subscription_fee']; ?>" class="pj-form-field align_right w70 number" />
				</span>
				<label class="content float_left l5 r5"><?php __('lblPer'); ?></label>
				<select name="subscription_period" id="subscription_period" class="pj-form-field">
					<?php
					foreach ($periods as $k => $v)
					{
						?><option value="<?php echo $k; ?>"<?php echo $k == $tpl['arr']['subscription_period'] ? ' selected="selected"' : NULL; ?>><?php echo $k; ?></option><?php
					}
					?>
				</select>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblStatus'); ?></label>
			<span class="inline_block">
				<select name="status" id="status" class="pj-form-field required">
					<option value="">-- <?php __('lblChoose'); ?>--</option>
					<?php
					foreach (__('u_statarr', true) as $k => $v)
					{
						?><option value="<?php echo $k; ?>"<?php echo $k == $tpl['arr']['status'] ? ' selected="selected"' : NULL; ?>><?php echo $v; ?></option><?php
					}
					?>
				</select>
			</span>
		</p>
		<p>
			<label class="title">&nbsp;</label>
			<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
		</p>
	</form>
	
	<script type="text/javascript">
	var myLabel = myLabel || {};
	myLabel.same_group = "<?php echo __('pj_same_group', true); ?>";
	myLabel.valid_url = "<?php echo __('pj_valid_url', true); ?>";
	myLabel.period_required = "<?php echo __('lblPeriodRequired', true); ?>";
	</script>
	<?php
}
?>