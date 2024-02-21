<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjNoteMemberModel extends pjAppModel
{
	protected $table = 'notes_members';
	
	protected $schema = array(
		array('name' => 'note_id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'member_id', 'type' => 'int', 'default' => ':NULL')
	);
	
	public $i18n = array('name');
	
	public static function factory($attr=array())
	{
		return new pjNoteMemberModel($attr);
	}
}
?>