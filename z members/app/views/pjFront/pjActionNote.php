<div class="ml-container">
	<div class="heading"><?php __('front_label_notes');?></div>
	<div class="ml-note-list">
		<?php
		if(!empty($tpl['note_arr']))
		{
			foreach($tpl['note_arr'] as $v)
			{
				?>
				<div class="ml-note-item">
					<div class="ml-note-title"><?php echo stripslashes($v['title']);?></div>
					<div class="ml-note-content"><?php echo stripslashes($v['note']);?></div>
				</div>
				<?php
			}
		} else {
			__('front_label_no_notes');
		}
		?>
	</div>
</div>