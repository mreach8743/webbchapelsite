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
	
	pjUtil::printNotice(__('infoFormTitle', true), __('infoFormBody', true));
	
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminOptions&amp;action=pjActionUpdate" method="post" class="form pj-form" id="frmForms">
		<input type="hidden" name="options_update" value="1" />
		<input type="hidden" name="form_update" value="1" />
		<input type="hidden" name="next_action" value="pjActionForms" />
		<input type="hidden" name="tab_id" value="<?php echo isset($_GET['tab_id']) && !empty($_GET['tab_id']) ? $_GET['tab_id'] : 'tabs-1'; ?>" />
		
		<div id="tabs">
			<ul>
				<li><a href="#tabs-1"><?php __('lblRegistrationForm'); ?></a></li>
				<li><a href="#tabs-2"><?php __('lblProfileForm'); ?></a></li>
			</ul>
			<div id="tabs-1">
				<?php
				$registration_fields = explode(",", $tpl['option_arr']['o_registration_form']); 
				?>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('first_name', $registration_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					<input type="checkbox" name="data[]" id="first_name" value="first_name" <?php echo in_array('first_name', $registration_fields) ? 'checked="checked"' : null;?> class="registration-fields"/>
					<label for="first_name" class="data-label"><?php __('lblFirstName');?></label>
				</div>
				
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('last_name', $registration_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="last_name" value="last_name" <?php echo in_array('last_name', $registration_fields) ? 'checked="checked"' : null;?> class="registration-fields"/>
					<label for="last_name" class="data-label"><?php __('lblLastName');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('email', $registration_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="email" value="email" <?php echo in_array('email', $registration_fields) ? 'checked="checked"' : null;?> class="registration-fields"/>
					<label for="email" class="data-label"><?php __('lblEmail');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('password', $registration_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="password" value="password" <?php echo in_array('password', $registration_fields) ? 'checked="checked"' : null;?> class="registration-fields"/>
					<label for="password" class="data-label"><?php __('lblPassword');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('phone', $registration_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="phone" value="phone" <?php echo in_array('phone', $registration_fields) ? 'checked="checked"' : null;?> class="registration-fields"/>
					<label for="phone" class="data-label"><?php __('lblPhone');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('website', $registration_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="website" value="website" <?php echo in_array('website', $registration_fields) ? 'checked="checked"' : null;?> class="registration-fields"/>
					<label for="website" class="data-label"><?php __('lblWebsite');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('gender', $registration_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="gender" value="gender" <?php echo in_array('gender', $registration_fields) ? 'checked="checked"' : null;?> class="registration-fields"/>
					<label for="gender" class="data-label"><?php __('lblGender');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('age', $registration_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="age" value="age" <?php echo in_array('age', $registration_fields) ? 'checked="checked"' : null;?> class="registration-fields"/>
					<label for="age" class="data-label"><?php __('lblAge');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('birthday', $registration_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="birthday" value="birthday" <?php echo in_array('birthday', $registration_fields) ? 'checked="checked"' : null;?> class="registration-fields"/>
					<label for="birthday" class="data-label"><?php __('lblBirthday');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('address', $registration_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="address" value="address" <?php echo in_array('address', $registration_fields) ? 'checked="checked"' : null;?> class="registration-fields"/>
					<label for="address" class="data-label"><?php __('lblAddress');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('city', $registration_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="city" value="city" <?php echo in_array('city', $registration_fields) ? 'checked="checked"' : null;?> class="registration-fields"/>
					<label for="city" class="data-label"><?php __('lblCity');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('state', $registration_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="state" value="state" <?php echo in_array('state', $registration_fields) ? 'checked="checked"' : null;?> class="registration-fields"/>
					<label for="state" class="data-label"><?php __('lblState');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('country', $registration_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="country" value="country" <?php echo in_array('country', $registration_fields) ? 'checked="checked"' : null;?> class="registration-fields"/>
					<label for="country" class="data-label"><?php __('lblCountry');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('zip', $registration_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="zip" value="zip" <?php echo in_array('zip', $registration_fields) ? 'checked="checked"' : null;?> class="registration-fields"/>
					<label for="zip" class="data-label"><?php __('lblZip');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('company_name', $registration_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="company_name" value="company_name" <?php echo in_array('company_name', $registration_fields) ? 'checked="checked"' : null;?> class="registration-fields"/>
					<label for="company_name" class="data-label"><?php __('lblCompanyName');?></label>
					
				</div>
				<div class="clear_both"></div>
				<div class="overflow">
					<input type="hidden" id="o_registration_form" name="o_registration_form" value="<?php echo $tpl['option_arr']['o_registration_form'];?>" class="required"/>
				</div>
				<p>
					<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
				</p>
			</div>
			<div id="tabs-2">
				<?php
				$profile_fields = explode(",", $tpl['option_arr']['o_profile_form']); 
				?>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('first_name', $profile_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					<input type="checkbox" name="data[]" id="profile_first_name" value="first_name" <?php echo in_array('first_name', $profile_fields) ? 'checked="checked"' : null;?> class="profile-fields"/>
					<label for="profile_first_name" class="data-label"><?php __('lblFirstName');?></label>
				</div>
				
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('last_name', $profile_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="profile_last_name" value="last_name" <?php echo in_array('last_name', $profile_fields) ? 'checked="checked"' : null;?> class="profile-fields"/>
					<label for="profile_last_name" class="data-label"><?php __('lblLastName');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('email', $profile_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="profile_email" value="email" <?php echo in_array('email', $profile_fields) ? 'checked="checked"' : null;?> class="profile-fields"/>
					<label for="profile_email" class="data-label"><?php __('lblEmail');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('password', $profile_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="profile_password" value="password" <?php echo in_array('password', $profile_fields) ? 'checked="checked"' : null;?> class="profile-fields"/>
					<label for="profile_password" class="data-label"><?php __('lblPassword');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('phone', $profile_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="profile_phone" value="phone" <?php echo in_array('phone', $profile_fields) ? 'checked="checked"' : null;?> class="profile-fields"/>
					<label for="profile_phone" class="data-label"><?php __('lblPhone');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('website', $profile_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="profile_website" value="website" <?php echo in_array('website', $profile_fields) ? 'checked="checked"' : null;?> class="profile-fields"/>
					<label for="profile_website" class="data-label"><?php __('lblWebsite');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('gender', $profile_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="profile_gender" value="gender" <?php echo in_array('gender', $profile_fields) ? 'checked="checked"' : null;?> class="profile-fields"/>
					<label for="profile_gender" class="data-label"><?php __('lblGender');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('age', $profile_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="profile_age" value="age" <?php echo in_array('age', $profile_fields) ? 'checked="checked"' : null;?> class="profile-fields"/>
					<label for="profile_age" class="data-label"><?php __('lblAge');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('birthday', $profile_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="profile_birthday" value="birthday" <?php echo in_array('birthday', $profile_fields) ? 'checked="checked"' : null;?> class="profile-fields"/>
					<label for="profile_birthday" class="data-label"><?php __('lblBirthday');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('address', $profile_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="profile_address" value="address" <?php echo in_array('address', $profile_fields) ? 'checked="checked"' : null;?> class="profile-fields"/>
					<label for="profile_address" class="data-label"><?php __('lblAddress');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('city', $profile_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="profile_city" value="city" <?php echo in_array('city', $profile_fields) ? 'checked="checked"' : null;?> class="profile-fields"/>
					<label for="profile_city" class="data-label"><?php __('lblCity');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('state', $profile_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="profile_state" value="state" <?php echo in_array('state', $profile_fields) ? 'checked="checked"' : null;?> class="profile-fields"/>
					<label for="profile_state" class="data-label"><?php __('lblState');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('country', $profile_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="profile_country" value="country" <?php echo in_array('country', $profile_fields) ? 'checked="checked"' : null;?> class="profile-fields"/>
					<label for="profile_country" class="data-label"><?php __('lblCountry');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('zip', $profile_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="profile_zip" value="zip" <?php echo in_array('zip', $profile_fields) ? 'checked="checked"' : null;?> class="profile-fields"/>
					<label for="profile_zip" class="data-label"><?php __('lblZip');?></label>
					
				</div>
				<div class="float_left w200 b5 r25 pj-checkbox gradient<?php echo in_array('company_name', $profile_fields) ? ' pj-checkbox-checked' : NULL; ?>">
					
					<input type="checkbox" name="data[]" id="profile_company_name" value="company_name" <?php echo in_array('company_name', $profile_fields) ? 'checked="checked"' : null;?> class="profile-fields"/>
					<label for="profile_company_name" class="data-label"><?php __('lblCompanyName');?></label>
					
				</div>
				<div class="clear_both"></div>
				<div class="overflow">
					<input type="hidden" id="o_profile_form" name="o_profile_form" value="<?php echo $tpl['option_arr']['o_profile_form'];?>" class="required"/>
				</div>
				<p>
					<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
				</p>
			</div>
		</div>
	</form>
	<?php 
	if (isset($_GET['tab_id']) && !empty($_GET['tab_id']))
	{
		$tab_id = explode("-", $_GET['tab_id']);
		$tab_id = (int) $tab_id[1] - 1;
		$tab_id = $tab_id < 0 ? 0 : $tab_id;
		?>
		<script type="text/javascript">
		(function ($) {
			$(function () {
				$("#tabs").tabs("option", "selected", <?php echo $tab_id; ?>);
			});
		})(jQuery_1_8_2);
		</script>
		<?php
	}
}
?>