<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjNoteModel extends pjAppModel
{
	protected $primaryKey = 'id';
	
	protected $table = 'notes';
	
	protected $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'title', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'note', 'type' => 'text', 'default' => ':NULL'),
		array('name' => 'modified', 'type' => 'datetime', 'default' => ':NULL'),
		array('name' => 'created', 'type' => 'datetime', 'default' => ':NOW()'),
		array('name' => 'status', 'type' => 'enum', 'default' => 'T')
	);
	
	public static function factory($attr=array())
	{
		return new pjNoteModel($attr);
	}
}
?>