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
	?>
	<div class="ui-tabs ui-widget ui-widget-content ui-corner-all b10">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminFiles&amp;action=pjActionIndex"><?php __('lblUploadedFiles'); ?></a></li>
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminFiles&amp;action=pjActionCreate"><?php __('lblUpload'); ?></a></li>
			<li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminFiles&amp;action=pjActionUpdate&amp;id=<?php echo $tpl['arr']['id']; ?>"><?php __('lblUpdateFile'); ?></a></li>
		</ul>
	</div>
	<?php
	pjUtil::printNotice(__('infoUpdateFilesTitle', true), __('infoUpdateFilesBody', true)); 
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminFiles&amp;action=pjActionUpdate" method="post" id="frmUpdateFile" class="form pj-form" autocomplete="off" enctype="multipart/form-data">
		<input type="hidden" name="file_update" value="1" />
		<input type="hidden" name="id" value="<?php echo $tpl['arr']['id']; ?>" />
		<p>
			<label class="title"><?php __('lblTitle'); ?></label>
			<span class="inline_block">
				<input type="text" name="title" id="title" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['title'])); ?>" class="pj-form-field w300 required" />
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblFile'); ?></label>
			<span class="inline_block">
				<input name="file" type="file"/>
				<span class="pj-file-container">
					<label class="block float_left r10"><?php echo $tpl['arr']['file_name'];?></label>
					<a class="pj-download-file" target="_blank" href="<?php echo PJ_INSTALL_URL;?>index.php?controller=pjAdminFiles&action=pjActionDownloadFile&id=<?php echo $tpl['arr']['id']; ?>"><?php __('lblDownload');?></a>
				</span>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblGroupAccess'); ?></label>
			<span class="inline_block">
				<select id="group_id" name="group_id[]" class="pj-form-field w400" data-placeholder="--<?php __('lblChoose'); ?>--" multiple="multiple">
					<?php
					foreach ($tpl['group_arr'] as $k => $v)
					{
						?><option value="<?php echo $v['id']; ?>" <?php echo in_array($v['id'], $tpl['group_id_arr']) ? 'selected="selected"' : null; ?>><?php echo $v['group_title']; ?></option><?php
					}
					?>
				</select>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblMemberAccess'); ?></label>
			<span class="inline_block">
				<select id="member_id" name="member_id[]" class="pj-form-field w400" data-placeholder="--<?php __('lblChoose'); ?>--" multiple="multiple">
					<?php
					foreach ($tpl['member_arr'] as $k => $v)
					{
						?><option value="<?php echo $v['id']; ?>" <?php echo in_array($v['id'], $tpl['member_id_arr']) ? 'selected="selected"' : null; ?>><?php echo $v['first_name'] . ' ' . $v['last_name']; ?></option><?php
					}
					?>
				</select>
			</span>
		</p>
		<p>
			<label class="title">&nbsp;</label>
			<input type="submit" value="<?php __('btnUpload'); ?>" class="pj-button" />
		</p>
	</form>
	<script type="text/javascript">
		var myLabel = myLabel || {};
		myLabel.same_title = "<?php echo __('pj_same_title', true); ?>";
	</script>
	<?php
}
?>