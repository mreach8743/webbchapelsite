<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
require_once PJ_CONTROLLERS_PATH . 'pjAdmin.controller.php';
class pjAdminOptions extends pjAdmin
{
	public function pjActionIndex()
	{
		$this->checkLogin();

		if ($this->isAdmin())
		{
			$arr = pjOptionModel::factory()
				->where('t1.foreign_id', $this->getForeignId())
				->orderBy('t1.order ASC')
				->findAll()
				->getData();
			
			$this->set('arr', $arr);
			$this->appendJs('jquery.tipsy.js', PJ_THIRD_PARTY_PATH . 'tipsy/');
			$this->appendCss('jquery.tipsy.css', PJ_THIRD_PARTY_PATH . 'tipsy/');
			$this->appendJs('pjAdminOptions.js');
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionUpdate()
	{
		$this->checkLogin();

		if ($this->isAdmin())
		{
			if (isset($_POST['options_update']))
			{
				$OptionModel = new pjOptionModel();
			
				foreach ($_POST as $key => $value)
				{
					if (preg_match('/value-(string|text|int|float|enum|bool|color)-(.*)/', $key) === 1)
					{
						list(, $type, $k) = explode("-", $key);
						if (!empty($k))
						{
							$OptionModel
								->reset()
								->where('foreign_id', $this->getForeignId())
								->where('`key`', $k)
								->limit(1)
								->modifyAll(array('value' => $value));
						}
					}
				}
				
				if(isset($_POST['email_update']))
				{
					$pjNotificationModel = pjNotificationModel::factory();
					$email_arr = $pjNotificationModel->findAll()->getData();
					
					foreach($email_arr as $v)
					{
						$data = array();
						$data['key'] = $v['key'];
						$data['subject'] = $_POST['subject_' . $v['key']];
						$data['message'] = $_POST['message_' . $v['key']];
						
						$pjNotificationModel->reset()->set('id', $v['id'])->modify($data);
					}
					$err = 'AO05';
				}
				
				if(isset($_POST['form_update']))
				{
					$OptionModel
								->reset()
								->where('foreign_id', $this->getForeignId())
								->where('`key`', 'o_registration_form')
								->limit(1)
								->modifyAll(array('value' => $_POST['o_registration_form']));
					$OptionModel
								->reset()
								->where('foreign_id', $this->getForeignId())
								->where('`key`', 'o_profile_form')
								->limit(1)
								->modifyAll(array('value' => $_POST['o_profile_form']));

				}
				
				if (isset($_POST['next_action']))
				{
					switch ($_POST['next_action'])
					{
						case 'pjActionIndex':
							$err = 'AO01';
							break;
						case 'pjActionEmails':
							$err = 'AO02';
							break;
						case 'pjActionForms':
							$err = 'AO03';
							break;
						case 'pjActionRegistrations':
							$err = 'AO04';
							break;
					}
				}
				pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminOptions&action=" . @$_POST['next_action'] . "&err=$err");
			}
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionRegistrations()
	{
		$this->checkLogin();
		
		if ($this->isAdmin())
		{
			$arr = pjOptionModel::factory()
				->where('t1.foreign_id', $this->getForeignId())
				->orderBy('t1.order ASC')
				->findAll()
				->getData();
			
			$this->set('arr', $arr);
			$this->appendJs('jquery.tipsy.js', PJ_THIRD_PARTY_PATH . 'tipsy/');
			$this->appendCss('jquery.tipsy.css', PJ_THIRD_PARTY_PATH . 'tipsy/');
			$this->appendJs('pjAdminOptions.js');
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionEmails()
	{
		$this->checkLogin();
		
		if ($this->isAdmin())
		{
			$arr = array();
			
			$arr = pjNotificationModel::factory()->findAll()->getData();
			
			$this->set('arr', $arr);
			
			$this->appendJs('jquery.tipsy.js', PJ_THIRD_PARTY_PATH . 'tipsy/');
			$this->appendCss('jquery.tipsy.css', PJ_THIRD_PARTY_PATH . 'tipsy/');
			$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
			$this->appendJs('pjAdminOptions.js');
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionForms()
	{
		$this->checkLogin();
		
		if ($this->isAdmin())
		{
			
			$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
			$this->appendJs('pjAdminOptions.js');
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionInstall()
	{
		$this->checkLogin();
		
		if ($this->isAdmin())
		{
			$group_arr = pjGroupModel::factory()->where('status', 'T')->orderBy('group_title ASC')->findAll()->getData();
			$this->set('group_arr', $group_arr);
			
			$this->appendJs('chosen.jquery.min.js', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
			$this->appendCss('chosen.css', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
			$this->appendJs('pjAdminOptions.js');
		} else {
			$this->set('status', 2);
		}
	}
}
?>