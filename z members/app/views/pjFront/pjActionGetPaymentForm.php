<?php
if (pjObject::getPlugin('pjPaypalSubscr') !== NULL)
{
	$controller->requestAction(array('controller' => 'pjPaypalSubscr', 'action' => 'pjActionForm', 'params' => $tpl['params']));
}
?>