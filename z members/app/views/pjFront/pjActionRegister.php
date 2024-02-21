<?php
$front_required = __('front_required', true);
$front_validation = __('front_validation', true); 
$registration_fields = explode(",", $tpl['option_arr']['o_registration_form']);
?>
<div class="ml-container">
	<div class="heading"><?php __('front_label_register');?></div>
	<form action="" method="post" name="ml_registration_form" class="ml-form">
		<input type="hidden" name="pjSelect" value="<?php echo $_GET['pjSelect'];?>"/>
		<?php
		if($_GET['pjSelect'] == 'Yes')
		{
			?>
			<p>
				<label class="title"><?php __('front_label_group');?></label>
				<select name="group_id" class="ml-select w200 ml-required" lang="<?php echo htmlspecialchars($front_required['group']); ?>">
					<option value="">-- <?php __('front_label_choose'); ?>--</option>
					<?php
					foreach ($tpl['group_arr'] as $k => $v)
					{
						?><option value="<?php echo $v['id']; ?>" <?php echo isset($_GET['group_id']) ? ($_GET['group_id'] == $v['id'] ? 'selected="selected"' : null) : null;?>><?php echo $v['group_title']; ?></option><?php
					}
					?>
				</select>
			</p>
			<?php
		}else{
			?><input type="hidden" name="group_id" value="<?php echo isset($_GET['group_id']) ? $_GET['group_id'] : null;?>"/><?php
		}
		if(in_array('first_name', $registration_fields))
		{ 
			?>
			<p>
				<label class="title"><?php __('front_label_first_name');?></label>
				<input type="text" name="first_name" class="ml-text ml-w200 ml-required" lang="<?php echo htmlspecialchars($front_required['first_name']); ?>" />
			</p>
			<?php
		}
		if(in_array('last_name', $registration_fields))
		{ 
			?>
			<p>
				<label class="title"><?php __('front_label_last_name');?></label>
				<input type="text" name="last_name" class="ml-text ml-w200 ml-required" lang="<?php echo htmlspecialchars($front_required['last_name']); ?>" />
			</p>
			<?php
		}
		if(in_array('email', $registration_fields))
		{ 
			?>
			<p>
				<label class="title"><?php __('front_label_email');?></label>
				<input type="text" name="email" class="ml-text ml-w250 ml-required email" lang="<?php echo htmlspecialchars($front_required['email']); ?>" />
			</p>
			<?php
		}
		if(in_array('password', $registration_fields))
		{ 
			?>
			<p>
				<label class="title"><?php __('front_label_password');?></label>
				<input type="password" name="password" class="ml-text ml-w200 ml-required" lang="<?php echo htmlspecialchars($front_required['password']); ?>" />
			</p>
			<?php
		}
		if(in_array('phone', $registration_fields))
		{ 
			?>
			<p>
				<label class="title"><?php __('front_label_phone');?></label>
				<input type="text" name="phone" class="ml-text ml-w150 ml-required" lang="<?php echo htmlspecialchars($front_required['phone']); ?>" "/>
			</p>
			<?php
		}
		if(in_array('website', $registration_fields))
		{ 
			?>
			<p>
				<label class="title"><?php __('front_label_website');?></label>
				<input type="text" name="website" class="ml-text ml-w250 ml-required" lang="<?php echo htmlspecialchars($front_required['website']); ?>" />
			</p>
			<?php
		}
		if(in_array('gender', $registration_fields))
		{ 
			?>
			<p>
				<label class="title"><?php __('front_label_gender');?></label>
				<select name="gender" class="ml-select ml-150 ml-required" lang="<?php echo htmlspecialchars($front_required['gender']); ?>" >
					<option value="">-- <?php __('front_label_choose'); ?>--</option>
					<?php
					foreach (__('genderarr', true) as $k => $v)
					{
						?><option value="<?php echo $k; ?>"><?php echo $v; ?></option><?php
					}
					?>
				</select>
			</p>
			<?php
		}
		if(in_array('age', $registration_fields))
		{ 
			?>
			<p>
				<label class="title"><?php __('front_label_age');?></label>
				<input type="text" name="age" class="ml-text ml-w50 ml-required" lang="<?php echo htmlspecialchars($front_required['age']); ?>" />
			</p>
			<?php
		}
		if(in_array('birthday', $registration_fields))
		{ 
			?>
			<p>
				<label class="title"><?php __('front_label_birthday');?></label>
				<select name="day" class="ml-select ml-60 ml-birthday">
					<option value="">----</option>
					<?php
					foreach (range(1, 31) as $v)
					{
						$v = str_pad($v, 2, '0', STR_PAD_LEFT); 
						?><option value="<?php echo $v; ?>"><?php echo $v; ?></option><?php
					}
					?>
				</select>
				<select name="month" class="ml-select ml-60 ml-birthday">
					<option value="">----</option>
					<?php
					foreach (range(1, 12) as $v)
					{
						$v = str_pad($v, 2, '0', STR_PAD_LEFT);
						?><option value="<?php echo $v; ?>"><?php echo $v; ?></option><?php
					}
					?>
				</select>
				<select name="year" class="ml-select ml-w80 ml-birthday">
					<option value="">----</option>
					<?php
					foreach (range(1900, date('Y')) as $v)
					{
						?><option value="<?php echo $v; ?>"><?php echo $v; ?></option><?php
					}
					?>
				</select>
				<input type="hidden" name="birthday" class="nsl-text nsl-w300 ml-required" lang="<?php echo htmlspecialchars($front_required['birthday']); ?>" />
			</p>
			<?php
		}
		if(in_array('address', $registration_fields))
		{ 
			?>
			<p>
				<label class="title"><?php __('front_label_address');?></label>
				<input type="text" name="address" class="ml-text ml-w300 ml-required" lang="<?php echo htmlspecialchars($front_required['address']); ?>" />
			</p>
			<?php
		}
		if(in_array('city', $registration_fields))
		{ 
			?>
			<p>
				<label class="title"><?php __('front_label_city');?></label>
				<input type="text" name="city" class="ml-text ml-w200 ml-required" lang="<?php echo htmlspecialchars($front_required['city']); ?>" />
			</p>
			<?php
		}
		if(in_array('state', $registration_fields))
		{ 
			?>
			<p>
				<label class="title"><?php __('front_label_state');?></label>
				<input type="text" name="state" class="ml-text ml-w200 ml-required" lang="<?php echo htmlspecialchars($front_required['state']); ?>" />
			</p>
			<?php
		}
		if(in_array('country', $registration_fields))
		{ 
			?>
			<p>
				<label class="title"><?php __('front_label_country');?></label>
				<select name="country_id" class="ml-select w300 ml-required" lang="<?php echo htmlspecialchars($front_required['country']); ?>" >
					<option value="">-- <?php __('front_label_choose'); ?>--</option>
					<?php
					foreach ($tpl['country_arr'] as $k => $v)
					{
						?><option value="<?php echo $v['id']; ?>"><?php echo $v['country_title']; ?></option><?php
					}
					?>
				</select>
			</p>
			<?php
		}
		if(in_array('zip', $registration_fields))
		{ 
			?>
			<p>
				<label class="title"><?php __('front_label_zip');?></label>
				<input type="text" name="zip" class="ml-text ml-w100 ml-required" lang="<?php echo htmlspecialchars($front_required['zip']); ?>" />
			</p>
			<?php
		}
		if(in_array('company_name', $registration_fields))
		{ 
			?>
			<p>
				<label class="title"><?php __('front_label_company_name');?></label>
				<input type="text" name="company_name" class="ml-text ml-w250 ml-required" lang="<?php echo htmlspecialchars($front_required['company_name']); ?>" />
			</p>
			<?php
		}
		?>
		<p>
			<label class="title"><?php echo __('front_label_captcha'); ?></label>
			<span class="ml-captcha-container">
				<input type="text" name="captcha" maxlength="6" class="ml-text ml-w80 ml-required" lang="<?php echo htmlspecialchars($front_required['captcha']); ?>" />
				<img src="<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&amp;action=pjActionCaptcha&amp;rand=<?php echo rand(1, 999999); ?>" alt="Captcha" />
			</span>
		</p>
		<div id="ml_fee_container">
			<p>
				<label class="title"><?php echo __('front_label_registration_fee'); ?></label>
				<label id="ml_registration_fee" class="content"></label>
			</p>
			<p>
				<label class="title"><?php echo __('front_label_subscription_fee'); ?></label>
				<label id="ml_subscription_fee" class="content"></label>
			</p>
		</div>
		<ul class="ml-error-container" style="display: none"></ul>
		<p class="ml-message-container" style="display: none"></p>
		<p>
			<label class="title">&nbsp;</label>
			<input type="button" value="<?php __('front_button_register'); ?>" name="ml_register_form_register" class="ml-button" />
		</p>
	</form>
	<div id="ml_payment_container" style="display: none"></div>
</div>

<script type="text/javascript">
	var registerMLObj = new registerML({
		registration_form_name: "ml_registration_form",
		registration_form_register_name: "ml_register_form_register",
		paypal_form_name: "ml_memberlogin_paypal_form",

		check_email_url: "<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&action=pjActionCheckEmail",
		check_captcha_url: "<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&action=pjActionCheckCaptcha",
		get_fee_url: "<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&action=pjActionGetFee",
		get_payment_form_url: "<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&action=pjActionGetPaymentForm",
		registration_url: "<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&action=pjActionRegisterSave",
		thankyou_page: "<?php echo $tpl['option_arr']['o_thankyou_page']; ?>",

		select_group: "<?php echo $_GET['pjSelect']; ?>",
		
		validation: {
			error_email_invalid: "<?php echo $front_validation['email_invalid']; ?>",
			error_email_used: "<?php echo $front_validation['email_used']; ?>",
			error_birthday_invalid: "<?php echo $front_validation['birthday_invalid']; ?>",
			error_captcha_incorrect: "<?php echo $front_validation['captcha_incorrect']; ?>"
		},
		message: {
			info: "<?php __('front_label_register_info'); ?>",
			load: "<?php __('front_label_register_load_payment'); ?>",
			success: "<?php __('front_label_register_success'); ?>",
			error: "<?php __('front_label_register_error'); ?>"
		}
	});
</script>