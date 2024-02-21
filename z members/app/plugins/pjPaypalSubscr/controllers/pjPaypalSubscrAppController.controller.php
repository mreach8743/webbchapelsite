<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjPaypalSubscrAppController extends pjPlugin
{
	public static function getConst($const)
	{
		$registry = pjRegistry::getInstance();
		$store = $registry->get('pjPaypalSubscr');
		return isset($store[$const]) ? $store[$const] : NULL;
	}
}
?>