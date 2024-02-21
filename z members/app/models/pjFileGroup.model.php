<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjFileGroupModel extends pjAppModel
{
	protected $table = 'files_groups';
	
	protected $schema = array(
		array('name' => 'file_id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'group_id', 'type' => 'int', 'default' => ':NULL')
	);
	
	public $i18n = array('name');
	
	public static function factory($attr=array())
	{
		return new pjFileGroupModel($attr);
	}
}
?>