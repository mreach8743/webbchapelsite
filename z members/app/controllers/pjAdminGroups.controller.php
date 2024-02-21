<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
require_once PJ_CONTROLLERS_PATH . 'pjAdmin.controller.php';
class pjAdminGroups extends pjAdmin
{
	public function pjActionCheckGroupName()
	{
		$this->setAjax(true);
		
		if ($this->isXHR() && isset($_GET['group_title']))
		{
			$pjGroupModel = pjGroupModel::factory();
			if (isset($_GET['id']) && (int) $_GET['id'] > 0)
			{
				$pjGroupModel->where('t1.id !=', $_GET['id']);
			}
			echo $pjGroupModel->where('t1.group_title', $_GET['group_title'])->findCount()->getData() == 0 ? 'true' : 'false';
		}
		exit;
	}
	
	public function pjActionCreate()
	{
		$this->checkLogin();
		
		if ($this->isAdmin())
		{
			if (isset($_POST['group_create']))
			{
				$pjGroupModel = pjGroupModel::factory();
				$id = $pjGroupModel->setAttributes($_POST)->insert()->getInsertId();
				if ($id !== false && (int) $id > 0)
				{
					$err = 'AG03';
				} else {
					$err = 'AG04';
				}
				pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminGroups&action=pjActionIndex&err=$err");
			} else {
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('additional-methods.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('pjAdminGroups.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionDeleteGroup()
	{
		$this->setAjax(true);
		
		if ($this->isXHR())
		{
			$response = array();
			if ($this->isAdmin())
			{
				if (pjGroupModel::factory()->reset()->setAttributes(array('id' => $_GET['id']))->erase()->getAffectedRows() == 1)
				{
					pjMemberModel::factory()->where('group_id', $_GET['id'])->eraseAll();
					
					$response['code'] = 200;
				} else {
					$response['code'] = 100;
				}
			}
			pjAppController::jsonResponse($response);
		}
		exit;
	}
	
	public function pjActionDeleteGroupBulk()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if ($this->isAdmin())
			{
				if (isset($_POST['record']) && count($_POST['record']) > 0)
				{
					pjGroupModel::factory()->reset()->whereIn('id', $_POST['record'])->eraseAll();
					pjMemberModel::factory()->whereIn('group_id', $_POST['record'])->eraseAll();
				}
			}
		}
		exit;
	}
	
	public function pjActionExportGroup()
	{
		$this->checkLogin();
		
		if (isset($_POST['record']) && is_array($_POST['record']))
		{
			$arr = pjGroupModel::factory()->whereIn('id', $_POST['record'])->findAll()->getData();
			$csv = new pjCSV();
			$csv
				->setHeader(true)
				->setName("Groups-".time().".csv")
				->process($arr)
				->download();
		}
		exit;
	}
	
	public function pjActionGetGroup()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$pjGroupModel = pjGroupModel::factory();
			
			if (isset($_GET['q']) && !empty($_GET['q']))
			{
				$q = pjObject::escapeString($_GET['q']);
				$pjGroupModel->where('t1.group_title LIKE', "%$q%");
			}

			if (isset($_GET['status']) && !empty($_GET['status']) && in_array($_GET['status'], array('T', 'F')))
			{
				$pjGroupModel->where('t1.status', $_GET['status']);
			}
				
			$column = 'group_title';
			$direction = 'ASC';
			if (isset($_GET['direction']) && isset($_GET['column']) && in_array(strtoupper($_GET['direction']), array('ASC', 'DESC')))
			{
				$column = $_GET['column'];
				$direction = strtoupper($_GET['direction']);
			}

			$total = $pjGroupModel->findCount()->getData();
			$rowCount = isset($_GET['rowCount']) && (int) $_GET['rowCount'] > 0 ? (int) $_GET['rowCount'] : 10;
			$pages = ceil($total / $rowCount);
			$page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
			$offset = ((int) $page - 1) * $rowCount;
			if ($page > $pages)
			{
				$page = $pages;
			}
			$data = array();
			$arr = $pjGroupModel->select('t1.*, (SELECT COUNT(*) FROM `'.pjMemberModel::factory()->getTable().'` as t2 WHERE t2.group_id = t1.id) as cnt_members')
				->orderBy("$column $direction")->limit($rowCount, $offset)->findAll()->getData();

			foreach($arr as $k => $v)
			{
				if(!empty($v['registration_fee']))
				{
					$v['registration_fee'] = pjUtil::formatCurrencySign($v['registration_fee'], $this->option_arr['o_currency']);
				}
				if(!empty($v['subscription_fee']))
				{
					$v['subscription_fee'] = pjUtil::formatCurrencySign($v['subscription_fee'], $this->option_arr['o_currency']) . ' ' . __('lblPer', true) . ' ' . $v['subscription_period'];
				}
				$data[$k] = $v;
			}
			pjAppController::jsonResponse(compact('data', 'total', 'pages', 'page', 'rowCount', 'column', 'direction'));
		}
		exit;
	}
	
	public function pjActionIndex()
	{
		$this->checkLogin();
		
		if ($this->isAdmin())
		{
			$this->appendJs('jquery.datagrid.js', PJ_FRAMEWORK_LIBS_PATH . 'pj/js/');
			$this->appendJs('pjAdminGroups.js');
			$this->appendJs('index.php?controller=pjAdmin&action=pjActionMessages', PJ_INSTALL_URL, true);
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionSaveGroup()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if($_POST['column'] == 'group_title')
			{
				if($_POST['value'] != '')
				{
					$pjGroupModel = pjGroupModel::factory();
					
					$check = $pjGroupModel->where('t1.group_title', $_POST['value'])->findCount()->getData() == 0 ? true : false;
					if($check == true)
					{
						$pjGroupModel->reset()->where('id', $_GET['id'])->limit(1)->modifyAll(array($_POST['column'] => $_POST['value']));
					}
				}
			}else{
				pjGroupModel::factory()->where('id', $_GET['id'])->limit(1)->modifyAll(array($_POST['column'] => $_POST['value']));
			}
		}
		exit;
	}
	
	public function pjActionStatusGroup()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if (isset($_POST['record']) && count($_POST['record']) > 0)
			{
				pjGroupModel::factory()->whereIn('id', $_POST['record'])->modifyAll(array(
					'status' => ":IF(`status`='F','T','F')"
				));
			}
		}
		exit;
	}
	
	public function pjActionUpdate()
	{
		$this->checkLogin();
		
		if ($this->isAdmin())
		{
			$pjGroupModel = pjGroupModel::factory();
			if (isset($_POST['group_update']))
			{
				$pjGroupModel->reset()->where('id', $_POST['id'])->limit(1)->modifyAll($_POST);
				pjUtil::redirect(PJ_INSTALL_URL . "index.php?controller=pjAdminGroups&action=pjActionIndex&err=AG01");
				
			} else {
				$arr = $pjGroupModel->select('t1.*, (SELECT COUNT(*) FROM `'.pjMemberModel::factory()->getTable().'` as t2 WHERE t2.group_id = t1.id) as cnt_members')
					->find($_GET['id'])->getData();
					
				if (count($arr) === 0)
				{
					pjUtil::redirect(PJ_INSTALL_URL. "index.php?controller=pjAdminGroups&action=pjActionIndex&err=AG08");
				}
				$this->set('arr', $arr);
				
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('additional-methods.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('pjAdminGroups.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
}
?>