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
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminNotes&amp;action=pjActionIndex"><?php __('menuNotes'); ?></a></li>
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminNotes&amp;action=pjActionCreate"><?php __('lblAddNote'); ?></a></li>
			<li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminNotes&amp;action=pjActionUpdate&amp;id=<?php echo $tpl['arr']['id']; ?>"><?php __('lblUpdateNote'); ?></a></li>
		</ul>
	</div>
	<?php
	pjUtil::printNotice(__('infoUpdateNoteTitle', true), __('infoUpdateNoteBody', true)); 
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminNotes&amp;action=pjActionUpdate" method="post" id="frmUpdateNote" class="form pj-form" autocomplete="off">
		<input type="hidden" name="note_update" value="1" />
		<input type="hidden" name="id" value="<?php echo $tpl['arr']['id']; ?>" />
		<p>
			<label class="title120"><?php __('lblTitle'); ?></label>
			<span class="inline_block">
				<input type="text" name="title" id="title" class="pj-form-field w300 required" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['title'])); ?>" />
			</span>
		</p>
		<p>
			<label class="title120"><?php __('lblNote'); ?></label>
			<span class="inline_block">
				<textarea id="note" name="note" class="mceEditor required" style="width: 600px; height: 250px"><?php echo htmlspecialchars(stripslashes($tpl['arr']['note'])); ?></textarea>
			</span>
		</p>
		<p>
			<label class="title120"><?php __('lblGroupAccess'); ?></label>
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
			<label class="title120"><?php __('lblMemberAccess'); ?></label>
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
			<label class="title120">&nbsp;</label>
			<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button pj-button-save" />
		</p>
	</form>
	<script type="text/javascript">
		var myLabel = myLabel || {};
		myLabel.install_url = "<?php echo PJ_INSTALL_URL; ?>";
	</script>
	<?php
}
?>