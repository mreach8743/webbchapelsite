<?php
if (pjObject::getPlugin('pjOneAdmin') !== NULL)
{
	$controller->requestAction(array('controller' => 'pjOneAdmin', 'action' => 'pjActionMenu'));
}
?>

<div class="leftmenu-top"></div>
<div class="leftmenu-middle">
	<ul class="menu">
		<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdmin&amp;action=pjActionIndex" class="<?php echo $_GET['controller'] == 'pjAdmin' && $_GET['action'] == 'pjActionIndex' ? 'menu-focus' : NULL; ?>"><span class="menu-dashboard">&nbsp;</span><?php __('menuDashboard'); ?></a></li>
		<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminGroups&amp;action=pjActionIndex" class="<?php echo $_GET['controller'] == 'pjAdminGroups' ? 'menu-focus' : NULL; ?>"><span class="menu-groups">&nbsp;</span><?php __('menuGroups'); ?></a></li>
		<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminMembers&amp;action=pjActionIndex" class="<?php echo $_GET['controller'] == 'pjAdminMembers' ? 'menu-focus' : NULL; ?>"><span class="menu-members">&nbsp;</span><?php __('menuMembers'); ?></a></li>
		<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminFiles&amp;action=pjActionIndex" class="<?php echo $_GET['controller'] == 'pjAdminFiles' ? 'menu-focus' : NULL; ?>"><span class="menu-files">&nbsp;</span><?php __('menuFiles'); ?></a></li>
		<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminNotes&amp;action=pjActionIndex" class="<?php echo $_GET['controller'] == 'pjAdminNotes' ? 'menu-focus' : NULL; ?>"><span class="menu-notes">&nbsp;</span><?php __('menuNotes'); ?></a></li>
		<?php
		if ($controller->isAdmin())
		{
			?>
			<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminOptions&amp;action=pjActionIndex" class="<?php echo ($_GET['controller'] == 'pjAdminOptions' && in_array($_GET['action'], array('pjActionIndex', 'pjActionRegistrations', 'pjActionEmails', 'pjActionForms'))) || in_array($_GET['controller'], array('pjAdminLocales', 'pjBackup', 'pjLocale')) ? 'menu-focus' : NULL; ?>"><span class="menu-options">&nbsp;</span><?php __('menuOptions'); ?></a></li>
			<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminUsers&amp;action=pjActionIndex" class="<?php echo $_GET['controller'] == 'pjAdminUsers' ? 'menu-focus' : NULL; ?>"><span class="menu-users">&nbsp;</span><?php __('menuUsers'); ?></a></li>
			<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminOptions&amp;action=pjActionInstall" class="<?php echo $_GET['controller'] == 'pjAdminOptions' && $_GET['action'] == 'pjActionInstall' ? 'menu-focus' : NULL; ?>"><span class="menu-install">&nbsp;</span><?php __('menuInstall'); ?></a></li>
			<?php
		}
		?>
		<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdmin&amp;action=pjActionLogout"><span class="menu-logout">&nbsp;</span><?php __('menuLogout'); ?></a></li>
	</ul>
</div>
<div class="leftmenu-bottom"></div>