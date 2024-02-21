<?php
$front_required = __('front_required', true);
$front_validation = __('front_validation', true);
$profile_fields = explode(",", $tpl['option_arr']['o_profile_form']);
if($tpl['status'] != 1)
{
	?>
	<div class="ml-container">
		<div class="heading"><?php __('front_label_profile');?></div>
		
		<form action="" method="post" name="ml_profile_form" class="ml-form">
		<?php
		if($tpl['status'] != 0)
		{
			$profile_statuses = __('profile_statuses', true);
			?><p><label class="message info"><?php echo $profile_statuses[$tpl['status']]; ?></label></p><?php
		}else{
			?>
			<input type="hidden" name="id" value="<?php echo $tpl['arr']['id']; ?>"/>
			<?php
			if(in_array('first_name', $profile_fields))
			{ 
				?>
				<p>
					<label class="title"><?php __('front_label_first_name');?></label>
					<input type="text" name="first_name" class="ml-text ml-w200 ml-required" value="<?php echo stripslashes($tpl['arr']['first_name']);?>" lang="<?php echo htmlspecialchars($front_required['first_name']); ?>" />
				</p>
				<?php
			}
			if(in_array('last_name', $profile_fields))
			{ 
				?>
				<p>
					<label class="title"><?php __('front_label_last_name');?></label>
					<input type="text" name="last_name" class="ml-text ml-w200 ml-required" value="<?php echo stripslashes($tpl['arr']['last_name']);?>"  lang="<?php echo htmlspecialchars($front_required['last_name']); ?>"/>
				</p>
				<?php
			}
			if(in_array('email', $profile_fields))
			{ 
				?>
				<p>
					<label class="title"><?php __('front_label_email');?></label>
					<input type="text" name="email" class="ml-text ml-w250 ml-required email" value="<?php echo stripslashes($tpl['arr']['email']);?>" lang="<?php echo htmlspecialchars($front_required['email']); ?>" />
				</p>
				<?php
			}
			if(in_array('password', $profile_fields))
			{ 
				?>
				<p>
					<label class="title"><?php __('front_label_password');?></label>
					<input type="password" name="password" class="ml-text ml-w200" value="<?php echo stripslashes($tpl['arr']['password']);?>"/>
				</p>
				<?php
			}
			if(in_array('phone', $profile_fields))
			{ 
				?>
				<p>
					<label class="title"><?php __('front_label_phone');?></label>
					<input type="text" name="phone" class="ml-text ml-w150 ml-required" value="<?php echo stripslashes($tpl['arr']['phone']);?>" lang="<?php echo htmlspecialchars($front_required['phone']); ?>" />
				</p>
				<?php
			}
			if(in_array('website', $profile_fields))
			{ 
				?>
				<p>
					<label class="title"><?php __('front_label_website');?></label>
					<input type="text" name="website" class="ml-text ml-w250 ml-required" value="<?php echo stripslashes($tpl['arr']['website']);?>" lang="<?php echo htmlspecialchars($front_required['website']); ?>" />
				</p>
				<?php
			}
			if(in_array('gender', $profile_fields))
			{ 
				?>
				<p>
					<label class="title"><?php __('front_label_gender');?></label>
					<select name="gender" class="ml-select ml-150 ml-required" lang="<?php echo htmlspecialchars($front_required['gender']); ?>" >
						<option value="">-- <?php __('front_label_choose'); ?>--</option>
						<?php
						foreach (__('genderarr', true) as $k => $v)
						{
							?><option value="<?php echo $k; ?>" <?php echo $tpl['arr']['gender'] == $k ? 'selected="selected"' : null; ?>><?php echo $v; ?></option><?php
						}
						?>
					</select>
				</p>
				<?php
			}
			if(in_array('age', $profile_fields))
			{ 
				?>
				<p>
					<label class="title"><?php __('front_label_age');?></label>
					<input type="text" name="age" class="ml-text ml-w50 ml-required" value="<?php echo stripslashes($tpl['arr']['age']);?>" lang="<?php echo htmlspecialchars($front_required['age']); ?>" />
				</p>
				<?php
			}
			if(in_array('birthday', $profile_fields))
			{ 
				?>
				<p>
					<label class="title"><?php __('front_label_birthday');?></label>
					<select name="day" class="ml-select ml-60 ml-birthday">
						<option value="">----</option>
						<?php
						$day = $month = $year = '';echo $tpl['arr']['birthday'];
						if(!empty($tpl['arr']['birthday']))
						{
							list($year, $month, $day) = explode("-", $tpl['arr']['birthday']);
						}
						foreach (range(1, 31) as $v)
						{
							$v = str_pad($v, 2, '0', STR_PAD_LEFT); 
							?><option value="<?php echo $v; ?>" <?php echo $day == $v ? 'selected="selected"' : null; ?>><?php echo $v; ?></option><?php
						}
						?>
					</select>
					<select name="month" class="ml-select ml-60 ml-birthday">
						<option value="">----</option>
						<?php
						foreach (range(1, 12) as $v)
						{
							$v = str_pad($v, 2, '0', STR_PAD_LEFT);
							?><option value="<?php echo $v; ?>" <?php echo $month == $v ? 'selected="selected"' : null; ?>><?php echo $v; ?></option><?php
						}
						?>
					</select>
					<select name="year" class="ml-select ml-w80 ml-birthday">
						<option value="">----</option>
						<?php
						foreach (range(1900, date('Y')) as $v)
						{
							?><option value="<?php echo $v; ?>" <?php echo $year == $v ? 'selected="selected"' : null; ?>><?php echo $v; ?></option><?php
						}
						?>
					</select>
					<input type="hidden" name="birthday" class="ml-text nsl-w300 ml-required" value="<?php echo stripslashes($tpl['arr']['birthday']);?>" lang="<?php echo htmlspecialchars($front_required['birthday']); ?>" />
				</p>
				<?php
			}
			if(in_array('address', $profile_fields))
			{ 
				?>
				<p>
					<label class="title"><?php __('front_label_address');?></label>
					<input type="text" name="address" class="ml-text ml-w300 ml-required" value="<?php echo stripslashes($tpl['arr']['address']);?>" lang="<?php echo htmlspecialchars($front_required['address']); ?>" />
				</p>
				<?php
			}
			if(in_array('city', $profile_fields))
			{ 
				?>
				<p>
					<label class="title"><?php __('front_label_city');?></label>
					<input type="text" name="city" class="ml-text ml-w200 ml-required" value="<?php echo stripslashes($tpl['arr']['city']);?>" lang="<?php echo htmlspecialchars($front_required['city']); ?>" />
				</p>
				<?php
			}
			if(in_array('state', $profile_fields))
			{ 
				?>
				<p>
					<label class="title"><?php __('front_label_state');?></label>
					<input type="text" name="state" class="ml-text ml-w200 ml-required" value="<?php echo stripslashes($tpl['arr']['state']);?>" lang="<?php echo htmlspecialchars($front_required['state']); ?>" />
				</p>
				<?php
			}
			if(in_array('country', $profile_fields))
			{ 
				?>
				<p>
					<label class="title"><?php __('front_label_country');?></label>
					<select name="country_id" class="ml-select w300 ml-required" lang="<?php echo htmlspecialchars($front_required['country']); ?>" >
						<option value="">-- <?php __('front_label_choose'); ?>--</option>
						<?php
						foreach ($tpl['country_arr'] as $k => $v)
						{
							?><option value="<?php echo $v['id']; ?>" <?php echo $tpl['arr']['country_id'] == $v['id'] ? 'selected="selected"' : null; ?>><?php echo $v['country_title']; ?></option><?php
						}
						?>
					</select>
				</p>
				<?php
			}
			if(in_array('zip', $profile_fields))
			{ 
				?>
				<p>
					<label class="title"><?php __('front_label_zip');?></label>
					<input type="text" name="zip" class="ml-text ml-w100 ml-required" value="<?php echo stripslashes($tpl['arr']['zip']);?>" lang="<?php echo htmlspecialchars($front_required['zip']); ?>" />
				</p>
				<?php
			}
			if(in_array('company_name', $profile_fields))
			{ 
				?>
				<p>
					<label class="title"><?php __('front_label_company_name');?></label>
					<input type="text" name="company_name" class="ml-text ml-w250 ml-required" value="<?php echo stripslashes($tpl['arr']['company_name']);?>" lang="<?php echo htmlspecialchars($front_required['company_name']); ?>" />
				</p>
				<?php
			} 
			?>
			
			<ul class="ml-error-container" style="display: none"></ul>
			<p class="ml-message-container" style="display: none"></p>
			<p>
				<label class="title">&nbsp;</label>
				<input type="button" value="<?php __('front_button_save'); ?>" name="ml_profile_form_save" class="ml-button" />
			</p>
			<?php
		} 
		?>
		</form>
	</div>
	<?php
} 
?>

<script type="text/javascript">
	<?php
	if($tpl['status'] == 1)
	{
		?>
		window.location.href = "<?php echo $tpl['option_arr']['o_login_page']?>";
		<?php
	} 
	?>
	var profileMLObj = new profileML({
		status: "<?php echo $tpl['status']; ?>",
		
		profile_form_name: "ml_profile_form",
		profile_form_save_name: "ml_profile_form_save",

		check_email_url: "<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&action=pjActionCheckEmail",
		profile_url: "<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&action=pjActionProfileSave",

		validation: {
			error_email_invalid: "<?php echo $front_validation['email_invalid']; ?>",
			error_email_used: "<?php echo $front_validation['email_used']; ?>",
			error_retype_password: "<?php echo $front_validation['retype_password']; ?>",
			error_birthday_invalid: "<?php echo $front_validation['birthday_invalid']; ?>"
		},
		message: {
			info: "<?php __('front_label_profile_info'); ?>",
			success: "<?php __('front_label_profile_success'); ?>",
			error: "<?php __('front_label_profile_error'); ?>"
		}
	});
</script>