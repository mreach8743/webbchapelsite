<?php
if (!isset($_GET['controller']) || empty($_GET['controller']))
{
	$_GET["controller"] = "pjFront";
}
if (!isset($_GET['action']) || empty($_GET['action']))
{
	$_GET["action"] = "pjActionProtect";
}
if(isset($pjGroup))
{
	$_GET["group_id"] = $pjGroup;
}

$dirname = str_replace("\\", "/", dirname(__FILE__));
include str_replace("app/views/pjLayouts", "", $dirname) . '/ind'.'ex.php';
?>