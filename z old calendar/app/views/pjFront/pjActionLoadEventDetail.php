<div class="pjPecEventContainer">
	<?php
	foreach($tpl['event_arr'] as $v)
	{
		$date_time_arr = array();
		$date_time_arr[] = pjUtil::formatDate(date('Y-m-d', strtotime($v['event_date'])), 'Y-m-d', $tpl['option_arr']['o_date_format']);
		if(!empty($v['start_time']) && !empty($v['end_time']))
		{
			$date_time_arr[] = pjUtil::formatTime($v['start_time'], 'H:i:s', $tpl['option_arr']['o_time_format']) . ' - ' . pjUtil::formatTime($v['end_time'], 'H:i:s', $tpl['option_arr']['o_time_format']);
		}else if(!empty($v['start_time']) && empty($v['end_time'])){
			$date_time_arr[] = __('front_starts_at', true) . ' ' . pjUtil::formatTime($v['start_time'], 'H:i:s', $tpl['option_arr']['o_time_format']);
		}else if(empty($v['start_time']) && !empty($v['end_time'])){
			$date_time_arr[] = __('front_ends_at', true) . ' ' . pjUtil::formatTime($v['end_time'], 'H:i:s', $tpl['option_arr']['o_time_format']);
		}
		
		?>
		<div id="pjPecEventBox_<?php echo $v['id']?>" class="thumbnail">
			<br/>
			<div class="container-fluid">
				<div class="pull-left">
					<em class="">
						<?php echo join(", ", $date_time_arr);?>
					</em>
					<br/>
					<strong><?php echo pjSanitize::html($v['event_title']);?></strong>
				</div>
				<a href="#" class="pull-right pjPecCloseEvent" data-id="<?php echo $v['id']?>"><span class="glyphicon glyphicon-remove"></span></a>
			</div><!-- /.container-fluid -->
			
			<br/>
			
			<div class="container-fluid">
				<p>
					<?php
					if($tpl['option_arr']['o_enable_categories'] == 'Yes' && !empty($v['category']))
					{
						echo stripslashes($v['category']) . (!empty($v['location']) ? ', ' : NULL);
					}
					if(!empty($v['location']))
					{
						?><a class="pjPecEventLocation" href="#" data-id="<?php echo $v['id'];?>" data-lat="<?php echo $v['lat'];?>" data-lng="<?php echo $v['lng'];?>"><?php echo $v['location'];?></a><?php
					} 
					?>
				</p>
				
				<?php
				if(!empty($v['lat']) && !empty($v['lat']))
				{
					?><div id="pjPecMapCanvas_<?php echo $v['id'];?>" class="pjPecMapCanvas"></div><?php
				}
				?>
				<div><?php echo nl2br(stripslashes($v['description'])); ?></div>
			</div><!-- /.container-fluid -->
		</div><!-- /.thumbnail -->
		<?php
	} 
	?>
</div>