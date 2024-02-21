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
	include_once PJ_VIEWS_PATH . 'pjLayouts/elements/optmenu.php';
	
	pjUtil::printNotice(__('infoEmailTitle', true), __('infoEmailBody', true));
	
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminOptions&amp;action=pjActionUpdate" method="post" class="form pj-form" id="frmEmails">
		<input type="hidden" name="options_update" value="1" />
		<input type="hidden" name="email_update" value="1" />
		<input type="hidden" name="next_action" value="pjActionEmails" />
		
		<div class="clear_both">
			<?php
			if($controller->isAdmin())
			{
				$tokens = __('tokens', true);
				foreach($tpl['arr'] as $v)
				{
					?>
					<fieldset class="overflow b10">
						<legend><span><?php __('lblLegend' . ucfirst($v['key'])); ?></span><a href="#" class="pj-form-langbar-tip listing-tip" title="<?php __('lblEmailTip' . ucfirst($v['key']));?>"></a></legend>
						
						<p>
							<label class="title"><?php __('lblEmailSubject'); ?></label>
							<span class="inline_block">
								<input type="text" name="subject_<?php echo $v['key']?>" class="pj-form-field w500" value="<?php echo htmlspecialchars(stripslashes(@$v['subject'])); ?>" />
							</span>
						</p>
							
						<p>
							<label class="title">
								<?php __('lblEmailMessage'); ?>
								<span class="block t10">
									<?php echo nl2br($tokens[$v['key']]); ?>
								</span>
							</label>
							<span class="inline_block">
								<textarea name="message_<?php echo $v['key']?>" class="pj-form-field textarea h350 w500"><?php echo htmlspecialchars(stripslashes(@$v['message'])); ?></textarea>
							</span>
						</p>
							
						<p>
							<label class="title">&nbsp;</label>
							<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
						</p>
					</fieldset>
					<?php
				}
			}
			?>
		</div>
	</form>
	<?php 
}
?>