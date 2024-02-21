<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
require_once dirname(__FILE__) . '/pjPaypalSubscrAppController.controller.php';
class pjPaypalSubscr extends pjPaypalSubscrAppController
{	
	public function pjActionForm()
	{
		$this->setAjax(true);
		//KEYS:
		//-------------
		//name
		//id
		//business
		//item_name
		//custom
		//amount
		//currency_code
		//return
		//a1
		//p1
		//t1
		//a3
		//p3
		//t3
		//src
		//sra
		//submit
		//submit_class
		//target
		$this->set('arr', $this->getParams());
	}
}
?>