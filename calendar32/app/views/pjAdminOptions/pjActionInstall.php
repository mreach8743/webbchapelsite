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
	$install_view = __('install_view', true);
	$yesno_arr = __('_yesno', true);
	
	$theme_arr = __('option_themes', true);
	ksort($theme_arr);
	$selected_theme = str_replace("theme", "", $tpl['option_arr']['o_theme']);
	if(isset($_GET['theme']))
	{
		$selected_theme = 'theme' . $_GET['theme'];
	}
	?>
	<div id="tabs">
		<ul>
			<li><a href="#tabs-1"><?php __('lblInstall'); ?></a></li>
		</ul>
		<div id="tabs-1" class="pj-form form">
		
			<?php pjUtil::printNotice(NULL, __('lblInstallPhp1Title', true), false, false); ?>
			
			<p style="margin: 0 0 10px; font-weight: bold"><?php __('lblInstall_1'); ?></p>
			<p>
				<label class="title"><?php __('opt_o_theme'); ?></label>
				<span class="inline_block">
					<select name="theme" id="theme" class="pj-form-field w150">
						<?php
						foreach($theme_arr as $k => $v)
						{
							?><option value="<?php echo $k?>"<?php echo $selected_theme == $k ? ' selected="selected"' : NULL;?>><?php echo $v;?></option><?php
						} 
						?>
					</select>
				</span>
			</p>
			<p>
				<label class="title"><?php __('lblView'); ?></label>
				<span class="inline_block">
					<select name="install_view" id="install_view" class="pj-form-field w150">
						<option value="list"><?php echo $install_view['list'];?></option>
						<option value="calendar" selected="selected"><?php echo $install_view['calendar'];?></option>
						<option value="monthly"><?php echo $install_view['monthly'];?></option>
					</select>
				</span>
			</p>
			<p>
				<label class="title"><?php __('lblHideSwitchIcons'); ?></label>
				<span class="inline_block">
					<select name="hide_icons" id="hide_icons" class="pj-form-field w100">
						<option value="F"><?php echo $yesno_arr['F'];?></option>
						<option value="T"><?php echo $yesno_arr['T'];?></option>
					</select>
				</span>
			</p>
			<p>
				<label class="title"><?php __('lblHideCategories'); ?></label>
				<span class="inline_block">
					<select name="hide_categories" id="hide_categories" class="pj-form-field w100">
						<option value="F"><?php echo $yesno_arr['F'];?></option>
						<option value="T"><?php echo $yesno_arr['T'];?></option>
					</select>
				</span>
			</p>
			<p style="display:none;">
				<label class="title">&nbsp;</label>
				<span id="install_css_explanation"></span>
			</p>
			<p style="display:none;">
				<label class="title"><?php __('lblCSSFile'); ?></label>
				<span class="inline_block">
					<input type="text" name="css_file" id="css_file" value="<?php echo $tpl['default_css'];?>" class="pj-form-field w400" />
				</span>
			</p>
			<p>
				<label class="title">&nbsp;</label>
				<span class="inline_block"><input type="button" value="<?php __('menuPreview', false, true); ?>" class="pj-button pjPecPreviewButton"/></span>
			</p>
			<p style="margin: 0 0 10px; font-weight: bold"><?php __('lblInstall_2'); ?></p>
			<textarea id="install_step_1" class="pj-form-field w700 textarea_install" style="overflow: auto; height:120px"></textarea>
									
			<div id="clone_step_1" style="display:none;">&lt;link href="<?php echo PJ_INSTALL_URL.PJ_FRAMEWORK_LIBS_PATH . 'pj/css/'; ?>pj.bootstrap.min.css" type="text/css" rel="stylesheet" /&gt;
&lt;link href="<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjFront&amp;action=pjActionLoadCss&amp;theme={THEME}" type="text/css" rel="stylesheet" /&gt;
&lt;script type="text/javascript" src="<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjFront&amp;action=pjActionLoad&amp;theme={THEME}&amp;view={VIEW}&amp;icons={ICONS}&amp;cats={CATS}"&gt;&lt;/script&gt;</div>
			<span id="clone_explanation" style="display:none;"><?php __('lblInstallCSSExplanation');?></span>
		</div><!-- tabs-1 -->
	</div>
	<?php
}
?>