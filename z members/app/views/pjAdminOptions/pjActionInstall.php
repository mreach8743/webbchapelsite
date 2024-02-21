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
	<div id="tabs">
		<ul>
			<li><a href="#tabs-1"><?php __('lblAccount'); ?></a></li>
			<li><a href="#tabs-2"><?php __('lblProtectedPages'); ?></a></li>
			<li><a href="#tabs-3"><?php __('lblProtectedFiles'); ?></a></li>
			<li><a href="#tabs-4"><?php __('lblProtectedNotes'); ?></a></li>
		</ul>
		<div id="tabs-1" class="pj-form form">
			<fieldset class="overflow b10">
				<legend><?php __('lblRegistrationForm'); ?></legend>
				<?php pjUtil::printInstallNotice(NULL, __('lblInstallRegister', true), false, false); ?>
				<p>
					<label class="title"><?php __('lblGroup'); ?></label>
					<span class="inline_block">
						<select id="group_id" name="group_id" class="pj-form-field w300">
							<option value="">--<?php __('lblChoose'); ?>--</option>
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
					<label class="title"><?php __('lblMemberSelectGroup'); ?></label>
					<span class="inline_block">
						<input type="checkbox" name="member_select" checked="checked" class="t8"/>
					</span>
				</p>
				<br/>
				<textarea id="install_register" class="pj-form-field w700 textarea_install" style="overflow: auto; height:120px"></textarea>
			</fieldset>
			
			<fieldset class="overflow b10">
				<legend><?php __('lblLoginForm'); ?></legend>
				<?php pjUtil::printInstallNotice(NULL, __('lblInstallLogin', true), false, false); ?>
				<textarea class="pj-form-field w700 textarea_install" style="overflow: auto; height:120px">&lt;link href="<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjFront&amp;action=pjActionLoadCss" type="text/css" rel="stylesheet" /&gt;
&lt;script type="text/javascript" src="<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjFront&amp;action=pjActionLoginJs"&gt;&lt;/script&gt;
&lt;script type="text/javascript" src="<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&amp;action=pjActionLogin"&gt;&lt;/script&gt;</textarea>
			</fieldset>
			
			<fieldset class="overflow b10">
				<legend><?php __('lblProfileForm'); ?></legend>
				<?php pjUtil::printInstallNotice(NULL, __('lblInstallProfile', true), false, false); ?>
				<textarea class="pj-form-field w700 textarea_install" style="overflow: auto; height:120px">&lt;link href="<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjFront&amp;action=pjActionLoadCss" type="text/css" rel="stylesheet" /&gt;
&lt;script type="text/javascript" src="<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjFront&amp;action=pjActionProfileJs"&gt;&lt;/script&gt;
&lt;script type="text/javascript" src="<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&amp;action=pjActionProfile"&gt;&lt;/script&gt;</textarea>
			</fieldset>
			
			<fieldset class="overflow b10">
				<legend><?php __('lblLogoutLink'); ?></legend>
				<?php pjUtil::printInstallNotice(NULL, __('lblInstallLogout', true), false, false); ?>
				<textarea class="pj-form-field w700 textarea_install" style="overflow: auto; height:40px">&lt;a href="<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&amp;action=pjActionLogout"&gt;<?php __('front_label_logout');?>&lt;/a&gt;</textarea>
			</fieldset>
			
			<div id="install_register_clone" style="display:none;">&lt;link href="<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjFront&amp;action=pjActionLoadCss" type="text/css" rel="stylesheet" /&gt;
&lt;script type="text/javascript" src="<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjFront&amp;action=pjActionRegisterJs"&gt;&lt;/script&gt;
&lt;script type="text/javascript" src="<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&amp;action=pjActionRegister{MemberSelect}{GroupID}"&gt;&lt;/script&gt;</div>
		</div><!-- tabs-1 -->
		<div id="tabs-2" class="pj-form form">
			<?php pjUtil::printNotice(NULL, __('lblInstallProtectedPages', true), false, false); ?>
			<p>
				<label class="title"><?php __('lblGroup'); ?></label>
				<span class="inline_block">
					<select id="protected_group_id" name="group_id[]" class="pj-form-field w300" data-placeholder="--<?php __('lblChoose'); ?>--" multiple="multiple">
						<?php
						foreach ($tpl['group_arr'] as $k => $v)
						{
							?><option value="<?php echo $v['id']; ?>" <?php echo $k == 0 ? 'selected="selected"' : null; ?>><?php echo $v['group_title']; ?></option><?php
						}
						?>
					</select>
				</span>
			</p>
			<textarea id="install_protected" class="pj-form-field w700 textarea_install" style="overflow: auto; height:80px"></textarea>
			<div id="install_protected_clone" style="display:none;">&lt;?php {GroupID} include '<?php echo dirname($_SERVER['SCRIPT_FILENAME']); ?>/app/views/pjLayouts/pjActionProtect.php'; ?&gt;</div>
		</div><!-- tabs-2 -->
		
		<div id="tabs-3" class="pj-form form">
			<?php pjUtil::printNotice(NULL, __('lblInstallProtectedFiles', true), false, false); ?>
			
			<textarea class="pj-form-field w700 textarea_install" style="overflow: auto; height:120px">&lt;link href="<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjFront&amp;action=pjActionLoadCss" type="text/css" rel="stylesheet" /&gt;
&lt;script type="text/javascript" src="<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&amp;action=pjActionFile"&gt;&lt;/script&gt;</textarea>
		</div><!-- tabs-3 -->
		<div id="tabs-4" class="pj-form form">
			<?php pjUtil::printNotice(NULL, __('lblInstallProtectedNotes', true), false, false); ?>
			
			<textarea class="pj-form-field w700 textarea_install" style="overflow: auto; height:120px">&lt;link href="<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjFront&amp;action=pjActionLoadCss" type="text/css" rel="stylesheet" /&gt;
&lt;script type="text/javascript" src="<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&amp;action=pjActionNote"&gt;&lt;/script&gt;</textarea>
		</div><!-- tabs-4 -->
	</div>
	<?php
}
?>