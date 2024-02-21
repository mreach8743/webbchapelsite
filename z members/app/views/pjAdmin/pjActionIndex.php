<?php
if (isset($tpl['status']))
{
	$status = __('status', true);
	switch ($tpl['status'])
	{
		case 2:
			pjUtil::printNotice(NULL, $status[2]);
			break;
	}
}else{
	?>
	<div class="dashboard_header">
		<div class="item">
			<div class="stat members">
				<div class="info">
					<abbr><?php echo $tpl['cnt_members'];?></abbr>
					<?php echo (int) $tpl['cnt_members'] !== 1 ? strtolower(__('lblMembers', true)) : strtolower(__('lblMember', true)); ?>
				</div>
			</div>
		</div>
		<div class="item">
			<div class="stat members">
				<div class="info">
					<abbr><?php echo $tpl['cnt_active_members'];?></abbr>
					<?php echo (int) $tpl['cnt_active_members'] !== 1 ? strtolower(__('lblActiveMembers', true)) : strtolower(__('lblActiveMember', true)); ?>
				</div>
			</div>
		</div>
		<div class="item">
			<div class="stat groups">
				<div class="info">
					<abbr><?php echo $tpl['cnt_groups'];?></abbr>
					<?php echo (int) $tpl['cnt_groups'] !== 1 ? strtolower(__('lblGroups', true)) : strtolower(__('lblGroup', true)); ?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="dashboard_box">
		<div class="dashboard_top">
			<div class="dashboard_column_top"><?php __('lblLastRegistered');?></div>
			<div class="dashboard_column_top"><?php __('lblDashLastLogin');?></div>
			<div class="dashboard_column_top"><?php __('lblMostPopularGroups');?></div>
		</div>
		
		<div class="dashboard_middle">
			<div class="dashboard_column">
				<?php
				$cnt = count($tpl['last_registered_arr']);
				if ($cnt === 0)
				{
					?><p class="m10"><?php __('lblMemberNotFound'); ?></p><?php
				}else{
					foreach ($tpl['last_registered_arr'] as $k => $v)
					{
						?>
						<div class="dashboard_member_row dashboard_row<?php echo $k + 1 !== $cnt ? NULL : ' dashboard_row_last'; ?>">
							<span><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminMembers&amp;action=pjActionUpdate&id=<?php echo $v['id'];?>"><?php echo pjSanitize::clean($v['first_name'] . ' ' . $v['last_name']);?></a></span>
							<span><?php echo pjSanitize::clean($v['email']);?></span>
							<span><?php echo pjUtil::formatDate(date('Y-m-d', strtotime($v['created'])), 'Y-m-d', $tpl['option_arr']['o_date_format']) . ' ' . pjUtil::formatTime(date('H:i:s', strtotime($v['created'])), 'H:i:s', $tpl['option_arr']['o_time_format']);?></span>
						</div>
						<?php
					}
				} 
				?>
			</div>
			<div class="dashboard_column">
				<?php
				$cnt = count($tpl['last_login_arr']);
				if ($cnt === 0)
				{
					?><p class="m10"><?php __('lblMemberNotFound'); ?></p><?php
				}else{
					foreach ($tpl['last_login_arr'] as $k => $v)
					{
						?>
						<div class="dashboard_member_row dashboard_row<?php echo $k + 1 !== $cnt ? NULL : ' dashboard_row_last'; ?>">
							<span><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminMembers&amp;action=pjActionUpdate&id=<?php echo $v['id'];?>"><?php echo pjSanitize::clean($v['first_name'] . ' ' . $v['last_name']);?></a></span>
							<span><?php echo pjSanitize::clean($v['email']);?></span>
							<span><?php echo pjUtil::formatDate(date('Y-m-d', strtotime($v['last_login'])), 'Y-m-d', $tpl['option_arr']['o_date_format']) . ' ' . pjUtil::formatTime(date('H:i:s', strtotime($v['last_login'])), 'H:i:s', $tpl['option_arr']['o_time_format']);?></span>
						</div>
						<?php
					}
				} 
				?>
			</div>
			<div class="dashboard_column">
				<?php
				$cnt = count($tpl['popular_groups']);
				if ($cnt === 0)
				{
					?><p class="m10"><?php __('lblGroupNotFound'); ?></p><?php
				}else{
					foreach ($tpl['popular_groups'] as $k => $v)
					{
						?>
						<div class="dashboard_member_row dashboard_row<?php echo $k + 1 !== $cnt ? NULL : ' dashboard_row_last'; ?>">
							<span><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminGroups&amp;action=pjActionUpdate&id=<?php echo $v['id'];?>"><?php echo pjSanitize::clean($v['group_title']);?></a></span>
							<span><?php echo $v['cnt_members'] . ' ' . ((int) $v['cnt_members'] !== 1 ? strtolower(__('lblMembers', true)) : strtolower(__('lblMember', true))); ?></span>
						</div>
						<?php
					}
				} 
				?>
			</div>
		</div>
		<div class="dashboard_bottom"></div>
	</div>
	
	<div class="clear_left t20 overflow">
		<div class="float_left black t30 t20"><span class="gray"><?php echo ucfirst(__('lblDashLastLogin', true)); ?>:</span> <?php echo date("F d, Y H:i", strtotime($_SESSION[$controller->defaultUser]['last_login'])); ?></div>
		<div class="float_right overflow">
		<?php
		list($hour, $day, $other) = explode("_", date("H:i_l_F d, Y"));
		?>
			<div class="dashboard_date">
				<abbr><?php echo $day; ?></abbr>
				<?php echo $other; ?>
			</div>
			<div class="dashboard_hour"><?php echo $hour; ?></div>
		</div>
	</div>
	<?php
}
?>