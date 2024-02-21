<?php
if(!empty($tpl['event_arr']))
{
	?>
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
			<div class="thumbnail">
				<br>
				<div class="container-fluid">
					<em><?php echo join(", ", $date_time_arr);?></em>
					<br/>
					<strong><?php echo pjSanitize::html($v['event_title']);?></strong>
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
				</div>
			</div>
			<?php
		}
		$page = isset($_GET['page']) ? $_GET['page'] : 1 ;
		$pages = $tpl['pages'];
		if($pages > 1)
		{
			?>
			<br/>
			<div class="clearfix text-center pjPecPagination">
				<?php
				if($page < $pages)
				{
					?><a href="#" class="btn btn-primary btn-sm pull-right pjPecPaging" data-page="<?php echo $page + 1;?>"><span class="glyphicon glyphicon-chevron-right"></span></a><!-- /.col-md-3 --><?php
				}
				if($page > 1)
				{
					?><a href="#" class="btn btn-primary btn-sm pull-left pjPecPaging" data-page="<?php echo $page - 1;?>"><span class="glyphicon glyphicon-chevron-left"></span></a><!-- /.col-md-3 -->
				<?php
				}
				?>			
			</div><!-- /.clearfix -->
			<?php 
		}
		?>
	</div>
	<?php
}else{
	?><br/><?php
	__('front_no_events_found');
} 
?>