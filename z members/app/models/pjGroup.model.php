<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjGroupModel extends pjAppModel
{
	protected $primaryKey = 'id';
	
	protected $table = 'groups';
	
	protected $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'group_title', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'home_url', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'registration_fee', 'type' => 'decimal', 'default' => ':NULL'),
		array('name' => 'subscription_fee', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'subscription_period', 'type' => 'enum', 'default' => ':NULL'),
		array('name' => 'status', 'type' => 'enum', 'default' => 'T')
	);
	
	public $i18n = array('name');
	
	public static function factory($attr=array())
	{
		return new pjGroupModel($attr);
	}
}
?>