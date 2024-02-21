<?php $front_required = __('front_required', true); ?>
<div class="heading"><?php __('front_label_login');?></div>
	
<form action="" method="post" name="ml_login_form" class="ml-form">
	<p>
		<label class="title"><?php __('front_label_email');?></label>
		<input type="text" name="email" class="ml-text ml-w250" lang="<?php echo htmlspecialchars($front_required['email']); ?>" />
	</p>
	<p>
		<label class="title"><?php __('front_label_password');?></label>
		<input type="password" name="password" class="ml-text ml-w250" lang="<?php echo htmlspecialchars($front_required['password']); ?>" />
	</p>
	<ul class="ml-error-container" style="display: none"></ul>
	<p class="ml-message-container" style="display: none"></p>
	<p>
		<label class="title">&nbsp;</label>
		<input type="button" value="<?php __('front_button_login'); ?>" name="ml_login_form_login" class="ml-button" />
		<a href="javascript:void(0);" class="ml-forgot-password"><?php __('front_label_forgot_password');?></a>
	</p>
</form>