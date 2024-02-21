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
	
	pjUtil::printNotice(__('infoAddCategoryTitle', true), __('infoAddCategoryDesc', true));
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminCategories&amp;action=pjActionCreate" method="post" id="frmCreateCategory" class="pj-form form">
		<input type="hidden" name="category_create" value="1" />
		
		<p>
			<label class="title"><?php __('lblCategory'); ?></label>
			<span class="inline_block">
				<input type="text" name="category" id="category" class="pj-form-field w300 required" data-msg-required="<?php __('lblFieldRequired');?>"/>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblStatus'); ?></label>
			<span class="inline_block">
				<select name="status" id="status" class="pj-form-field required" data-msg-required="<?php __('lblFieldRequired');?>">
					<option value="">-- <?php __('lblChoose'); ?>--</option>
					<?php
					foreach (__('u_statarr', true) as $k => $v)
					{
						?><option value="<?php echo $k; ?>"<?php echo $k == 'T' ? ' selected="selected"' : NULL;?>><?php echo $v; ?></option><?php
					}
					?>
				</select>
			</span>
		</p>	
		<p>
			<label class="title">&nbsp;</label>
			<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
			<input type="button" value="<?php __('btnCancel'); ?>" class="pj-button" onclick="window.location.href='<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjAdminCategories&action=pjActionIndex';" />
		</p>
	</form>
	<script type="text/javascript">
	var myLabel = myLabel || {};
	myLabel.same_category = "<?php __('lblSameCategory'); ?>";
	
	</script>
	<?php
}
?>