<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjFileMemberModel extends pjAppModel
{
	protected $table = 'files_members';
	
	protected $schema = array(
		array('name' => 'file_id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'member_id', 'type' => 'int', 'default' => ':NULL')
	);
	
	public $i18n = array('name');
	
	public static function factory($attr=array())
	{
		return new pjFileMemberModel($attr);
	}
}
?>