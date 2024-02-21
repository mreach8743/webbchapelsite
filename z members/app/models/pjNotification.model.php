<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjNotificationModel extends pjAppModel
{
	protected $primaryKey = 'id';
	
	protected $table = 'notifications';
	
	protected $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'key', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'subject', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'message', 'type' => 'text', 'default' => ':NULL')
	);
	
	public static function factory($attr=array())
	{
		return new pjNotificationModel($attr);
	}
}
?>