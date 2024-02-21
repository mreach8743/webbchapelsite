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
	
	pjUtil::printNotice(__('infoUpdateCategoryTitle', true), __('infoUpdateCategoryDesc', true));
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminCategories&amp;action=pjActionUpdate" method="post" id="frmUpdateCategory" class="form pj-form">
		<input type="hidden" name="category_update" value="1" />
		<input type="hidden" name="id" value="<?php echo $tpl['arr']['id']; ?>" />
		
		<p>
			<label class="title"><?php __('lblCategory'); ?></label>
			<span class="inline_block">
				<input type="text" name="category" id="category" class="pj-form-field w300 required" value="<?php echo stripslashes($tpl['arr']['category'])?>" />
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
						?><option value="<?php echo $k; ?>"<?php echo $k ==$tpl['arr']['status'] ? ' selected="selected"' : NULL;?>><?php echo $v; ?></option><?php
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