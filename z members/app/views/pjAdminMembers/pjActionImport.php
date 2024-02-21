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
	?>
	<div class="ui-tabs ui-widget ui-widget-content ui-corner-all b10">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminMembers&amp;action=pjActionIndex"><?php __('menuMembers'); ?></a></li>
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminMembers&amp;action=pjActionCreate"><?php __('lblAddMember'); ?></a></li>
			<li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminMembers&amp;action=pjActionImport"><?php __('lblImport'); ?></a></li>
		</ul>
	</div>
	<?php
	pjUtil::printNotice(__('infoImportTitle', true, true), __('infoImportBody', true, true), false);
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminMembers&amp;action=pjActionImport" method="post" id="frmImportMember" class="form pj-form" autocomplete="off" enctype="multipart/form-data">
		<input type="hidden" name="member_import" value="1" />
		<p>
			<label class="title"><?php __('lblGroup'); ?></label>
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
			<label class="title"><?php __('lblCSVFile'); ?></label>
			<span class="inline_block">
				<input id="csv" name="csv" type="file" class="required"/>
			</span>
		</p>
		<p>
			<label class="title">&nbsp;</label>
			<input type="submit" value="<?php __('btnImport'); ?>" class="pj-button" />
		</p>
	</form>
	<script type="text/javascript">
		var myLabel = myLabel || {};
		myLabel.csv_allowed = "<?php __('lblCSVAllowed'); ?>";
	</script>
	<?php
}
?>