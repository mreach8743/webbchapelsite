<div class="ml-form ml-registration">
	<?php
	$status = $tpl['status'];
	$activation_messages = __('front_activation', true);
	?>
	<p><label class="<?php echo $status == 'FA01' ? 'success' : 'error';?>"><?php echo $activation_messages[$status]?></label></p>
</div>