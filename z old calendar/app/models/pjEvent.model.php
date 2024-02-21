<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjEventModel extends pjAppModel
{
	protected $primaryKey = 'id';
	
	protected $table = 'events';
	
	protected $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'recurring_id', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'category_id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'event_title', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'location', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'lat', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'lng', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'description', 'type' => 'text', 'default' => ':NULL'),
		array('name' => 'event_date', 'type' => 'date', 'default' => ':NULL'),
		array('name' => 'start_time', 'type' => 'time', 'default' => ':NULL'),
		array('name' => 'end_time', 'type' => 'time', 'default' => ':NULL'),
		array('name' => 'status', 'type' => 'enum', 'default' => 'T'),
		array('name' => 'modified', 'type' => 'datetime', 'default' => ':NULL'),
		array('name' => 'created', 'type' => 'datetime', 'default' => ':NOW()')
	);
	
	public $i18n = array('name');
	
	public static function factory($attr=array())
	{
		return new pjEventModel($attr);
	}
}
?>