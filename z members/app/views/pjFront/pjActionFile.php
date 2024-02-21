<div class="ml-container">
	<div class="heading"><?php __('front_label_files');?></div>
	<div class="ml-file-list">
		<?php
		if(!empty($tpl['file_arr']))
		{
			foreach($tpl['file_arr'] as $v)
			{
				?>
				<a href="<?php echo PJ_INSTALL_URL;?>index.php?controller=pjFront&action=pjActionDownloadFile&id=<?php echo $v['id']; ?>"><?php echo $v['title']?></a>
				<?php
			}
		} else {
			__('front_label_no_files');
		}
		?>
	</div>
</div>