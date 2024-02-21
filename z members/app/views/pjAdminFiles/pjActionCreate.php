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
			<li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminFiles&amp;action=pjActionCreate"><?php __('lblUpload'); ?></a></li>
		</ul>
	</div>
	<?php
	pjUtil::printNotice(__('infoUploadFilesTitle', true), __('infoUploadFilesBody', true)); 
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminFiles&amp;action=pjActionCreate" method="post" id="frmCreateFile" class="form pj-form" autocomplete="off" enctype="multipart/form-data">
		<input type="hidden" name="file_create" value="1" />
		<p>
			<label class="title"><?php __('lblTitle'); ?></label>
			<span class="inline_block">
				<input type="text" name="title" id="title" class="pj-form-field w300 required" />
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblFile'); ?></label>
			<span class="inline_block">
				<input name="file" type="file" class="required"/>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblGroupAccess'); ?></label>
			<span class="inline_block">
				<select id="group_id" name="group_id[]" class="pj-form-field w400" data-placeholder="--<?php __('lblChoose'); ?>--" multiple="multiple">
					<?php
					foreach ($tpl['group_arr'] as $k => $v)
					{
						?><option value="<?php echo $v['id']; ?>"><?php echo $v['group_title']; ?></option><?php
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
						?><option value="<?php echo $v['id']; ?>"><?php echo $v['first_name'] . ' ' . $v['last_name']; ?></option><?php
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