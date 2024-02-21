<?php
foreach($tpl['event_arr'] as $v){
	$event_time = pjUtil::getEventTime($v['start_time'], $v['end_time'], $tpl['option_arr']['o_time_format'], ' / ');
	if($event_time != ''){
		$event_title = $event_time . ', ' . $v['event_title'];
	}else{
		$event_title = $v['event_title'];
	}
	?>
	<div id="phpevtcal_event_box_<?php echo $v['id']?>" class="phpevtcal-event-box">
		<div class="phpevtcal-detail-heading">
			<label class="phpevtcal-detail-date"><?php echo pjUtil::formatDate(date('Y-m-d', strtotime($v['event_date'])), 'Y-m-d', $tpl['option_arr']['o_date_format']);?></label>
			<a class="phpevtcal-detail-close" href="javascript:void(0);" rev="<?php echo $v['id']?>"></a>
		</div>
		<div class="phpevtcal-detail-content">
			<label class="phpevtcal-event-title"><?php echo stripslashes($event_title)?></label>
			<?php
			if($tpl['option_arr']['o_enable_categories'] == 'Yes')
			{ 
				?>
				<div class="phpevtcal-detail-cate"><?php echo stripslashes($v['category'])?></div>
				<?php
			} 
			?>
			<div class="phpevtcal-detail-desc"><?php echo nl2br(stripslashes($v['description']));?></div>
		</div>
	</div>
	<?php
} 
?>