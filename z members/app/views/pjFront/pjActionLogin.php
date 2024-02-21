<?php
$front_validation = __('front_validation', true); 
?>
<div id="ml_memberlogin_container" class="ml-container">
	
</div>
<script type="text/javascript">
	var loginMLObj = new loginML({
		memberlogin_container: "ml_memberlogin_container",
		
		login_form_name: "ml_login_form",
		login_form_login_name: "ml_login_form_login",
		forgot_form_name: "ml_forgot_form",
		forgot_form_send_name: "ml_forgot_form_send",

		load_login_form_url: "<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&action=pjActionLoginForm",
		load_forgot_form_url: "<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&action=pjActionForgotForm",
		login_url: "<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&action=pjActionLoginCheck",
		forgot_url: "<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&action=pjActionForgotSend",

		validation: {
			error_email_invalid: "<?php echo $front_validation['email_invalid']; ?>"
		},

		message: {
			success: "<?php __('front_label_login_success'); ?>",
			error_1: "<?php __('front_label_login_error_1'); ?>",
			error_2: "<?php __('front_label_login_error_2'); ?>",
			error_3: "<?php __('front_label_login_error_3'); ?>",

			forgot_success: "<?php __('front_label_forgot_success'); ?>",
			forgot_error_1: "<?php __('front_label_forgot_error_1'); ?>"
		}
	});
</script>