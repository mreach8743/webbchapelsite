<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
require_once PJ_CONTROLLERS_PATH . 'pjAdmin.controller.php';
class pjAdminFiles extends pjAdmin
{
	public function pjActionCheckFileTitle()
	{
		$this->setAjax(true);
		
		if ($this->isXHR() && isset($_GET['title']))
		{
			$pjFileModel = pjFileModel::factory();
			if (isset($_GET['id']) && (int) $_GET['id'] > 0)
			{
				$pjFileModel->where('t1.id !=', $_GET['id']);
			}
			echo $pjFileModel->where('t1.title', $_GET['title'])->findCount()->getData() == 0 ? 'true' : 'false';
		}
		exit;
	}
	
	public function pjActionCreate()
	{
		$this->checkLogin();
		
		if ($this->isAdmin())
		{
			if (isset($_POST['file_create']))
			{
				$pjFileModel = pjFileModel::factory();
				$id = $pjFileModel->setAttributes($_POST)->insert()->getInsertId();
				
				if ($id !== false && (int) $id > 0)
				{
					if (isset($_FILES['file']) && !empty($_FILES['file']['tmp_name']))
					{
						$data = array();
						$handle = new pjUpload();
						
						if ($handle->load($_FILES['file'])) {
							$hash = md5(uniqid(rand(), true));
							$file_ext = $handle->getExtension();
							$file_path = PJ_UPLOAD_PATH . 'files/' . $id . "_" . $hash . '.' . $file_ext;
							if($handle->save($file_path))
							{
								$data['file_path'] = $file_path;
								$data['file_name'] = $_FILES['file']['name'];
								$data['mime_type'] = $_FILES['file']['type'];
								$data['hash'] = $hash;
								
								$pjFileModel->reset()->set('id', $id)->modify($data);
							}
						}
					}
					
					if(isset($_POST['group_id']))
					{
						$pjFileGroupModel = pjFileGroupModel::factory();
						$pjFileGroupModel->begin();
						foreach ($_POST['group_id'] as $group_id){
							$data = array();
							$data['group_id'] = $group_id;
							$data['file_id'] = $id;
							$pjFileGroupModel->reset()->setAttributes($data)->insert();
						}
						$pjFileGroupModel->commit();
					}
					
					if(isset($_POST['member_id']))
					{
						$pjFileMemberModel = pjFileMemberModel::factory();
						$pjFileMemberModel->begin();
						foreach ($_POST['member_id'] as $member_id){
							$data = array();
							$data['member_id'] = $member_id;
							$data['file_id'] = $id;
							$pjFileMemberModel->reset()->setAttributes($data)->insert();
						}
						$pjFileMemberModel->commit();
					}
					
					$err = 'AF03';
				} else {
					$err = 'AF04';
				}
				pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminFiles&action=pjActionIndex&err=$err");
			} else {
				$group_arr = pjGroupModel::factory()->where('status', 'T')->orderBy('group_title ASC')->findAll()->getData();
				$member_arr = pjMemberModel::factory()->where('status', 'T')->orderBy('first_name ASC')->findAll()->getData();
				
				$this->set('group_arr', $group_arr);
				$this->set('member_arr', $member_arr);
				
				$this->appendJs('chosen.jquery.min.js', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
				$this->appendCss('chosen.css', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('additional-methods.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('pjAdminFiles.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionDeleteFile()
	{
		$this->setAjax(true);
		
		if ($this->isXHR())
		{
			$response = array();
			if ($this->isAdmin())
			{
				$pjFileModel = pjFileModel::factory();
				$arr = $pjFileModel->find($_GET['id'])->getData();
				if ($pjFileModel->reset()->setAttributes(array('id' => $_GET['id']))->erase()->getAffectedRows() == 1)
				{
					pjFileGroupModel::factory()->where('file_id', $_GET['id'])->eraseAll();
					pjFileMemberModel::factory()->where('file_id', $_GET['id'])->eraseAll();
					
					$file_path = $arr['file_path'];
					if (file_exists(PJ_INSTALL_PATH . $file_path)) {
						if(unlink(PJ_INSTALL_PATH . $file_path)){
						}
					}
					
					$response['code'] = 200;
				} else {
					$response['code'] = 100;
				}
			}
			pjAppController::jsonResponse($response);
		}
		exit;
	}
	
	public function pjActionDeleteFileBulk()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if ($this->isAdmin())
			{
				if (isset($_POST['record']) && count($_POST['record']) > 0)
				{
					$pjFileModel = pjFileModel::factory();
					$file_arr = $pjFileModel->whereIn('id', $_POST['record'])->findAll()->getData();
					foreach($file_arr as $f)
					{
						$file_path = $f['file_path'];
						if (file_exists(PJ_INSTALL_PATH . $file_path)) {
							if(unlink(PJ_INSTALL_PATH . $file_path)){
							}
						}
					}
					$pjFileModel->reset()->whereIn('id', $_POST['record'])->eraseAll();
					pjFileGroupModel::factory()->whereIn('file_id', $_POST['record'])->eraseAll();
					pjFileMemberModel::factory()->whereIn('file_id', $_POST['record'])->eraseAll();
				}
			}
		}
		exit;
	}
	
	public function pjActionExportFile()
	{
		$this->checkLogin();
		
		if (isset($_POST['record']) && is_array($_POST['record']))
		{
			$arr = pjFileModel::factory()->whereIn('id', $_POST['record'])->findAll()->getData();
			$csv = new pjCSV();
			$csv
				->setHeader(true)
				->setName("Files-".time().".csv")
				->process($arr)
				->download();
		}
		exit;
	}
	
	public function pjActionGetFile()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$pjFileModel = pjFileModel::factory();
			
			if (isset($_GET['q']) && !empty($_GET['q']))
			{
				$q = pjObject::escapeString($_GET['q']);
				$pjFileModel->where("(t1.title LIKE '%$q%' || t1.file_name LIKE '%$q%')");
			}

			if (isset($_GET['status']) && !empty($_GET['status']) && in_array($_GET['status'], array('T', 'F')))
			{
				$pjFileModel->where('t1.status', $_GET['status']);
			}
				
			$column = 'title';
			$direction = 'ASC';
			if (isset($_GET['direction']) && isset($_GET['column']) && in_array(strtoupper($_GET['direction']), array('ASC', 'DESC')))
			{
				$column = $_GET['column'];
				$direction = strtoupper($_GET['direction']);
			}

			$total = $pjFileModel->findCount()->getData();
			$rowCount = isset($_GET['rowCount']) && (int) $_GET['rowCount'] > 0 ? (int) $_GET['rowCount'] : 10;
			$pages = ceil($total / $rowCount);
			$page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
			$offset = ((int) $page - 1) * $rowCount;
			if ($page > $pages)
			{
				$page = $pages;
			}
			
			$data = array();
			$arr = $pjFileModel->select('t1.*')
				->orderBy("$column $direction")->limit($rowCount, $offset)->findAll()->getData();
			foreach($arr as $k => $v)
			{
				
				$v['created'] = pjUtil::formatDate(date('Y-m-d', strtotime($v['created'])), 'Y-m-d', $this->option_arr['o_date_format']) . ' ' . pjUtil::formatTime(date('H:i:s', strtotime($v['created'])), 'H:i:s', $this->option_arr['o_time_format']);	
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
			$this->appendJs('pjAdminFiles.js');
			$this->appendJs('index.php?controller=pjAdmin&action=pjActionMessages', PJ_INSTALL_URL, true);
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionSaveFile()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if($_POST['column'] == 'title')
			{
				if($_POST['value'] != '')
				{
					$pjFileModel = pjFileModel::factory();
					
					$check = $pjFileModel->where('t1.title', $_POST['value'])->findCount()->getData() == 0 ? true : false;
					if($check == true)
					{
						$pjFileModel->reset()->where('id', $_GET['id'])->limit(1)->modifyAll(array($_POST['column'] => $_POST['value']));
					}
				}
			}else{
				pjFileModel::factory()->where('id', $_GET['id'])->limit(1)->modifyAll(array($_POST['column'] => $_POST['value']));
			}
		}
		exit;
	}
	
	public function pjActionStatusFile()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if (isset($_POST['record']) && count($_POST['record']) > 0)
			{
				pjFileModel::factory()->whereIn('id', $_POST['record'])->modifyAll(array(
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
			$pjFileModel = pjFileModel::factory();
			if (isset($_POST['file_update']))
			{
				$arr = $pjFileModel->find($_POST['id'])->getData();
				
				$pjFileModel->reset()->where('id', $_POST['id'])->limit(1)->modifyAll(array_merge($_POST, array('modified' => date('Y-m-d H:i:s'))));
				
				if (isset($_FILES['file']) && !empty($_FILES['file']['tmp_name']))
				{
					$data = array();
					$handle = new pjUpload();
					
					if ($handle->load($_FILES['file'])) {
						$hash = md5(uniqid(rand(), true));
						$file_ext = $handle->getExtension();
						$file_path = PJ_UPLOAD_PATH . 'files/' . $_POST['id'] . "_" . $hash . '.' . $file_ext;
						if($handle->save($file_path))
						{
							$data['file_path'] = $file_path;
							$data['file_name'] = $_FILES['file']['name'];
							$data['mime_type'] = $_FILES['file']['type'];
							$data['hash'] = $hash;
							
							$pjFileModel->reset()->set('id', $_POST['id'])->modify($data);
						}
					}
					
					$file_path = $arr['file_path'];
					if (file_exists(PJ_INSTALL_PATH . $file_path)) {
						if(unlink(PJ_INSTALL_PATH . $file_path)){
						}
					}
				}
				
				$pjFileGroupModel = pjFileGroupModel::factory();
				$pjFileGroupModel->where('file_id', $_POST['id'])->eraseAll();
				if(isset($_POST['group_id']))
				{
					$pjFileGroupModel->reset()->begin();
					foreach ($_POST['group_id'] as $group_id){
						$data = array();
						$data['file_id'] = $_POST['id'];
						$data['group_id'] = $group_id;
						$pjFileGroupModel->reset()->setAttributes($data)->insert();
					}
					$pjFileGroupModel->commit();
				}
				
				$pjFileMemberModel = pjFileMemberModel::factory();
				$pjFileMemberModel->where('file_id', $_POST['id'])->eraseAll();
				if(isset($_POST['member_id']))
				{
					$pjFileMemberModel->reset()->begin();
					foreach ($_POST['member_id'] as $member_id){
						$data = array();
						$data['file_id'] = $_POST['id'];
						$data['member_id'] = $member_id;
						$pjFileMemberModel->reset()->setAttributes($data)->insert();
					}
					$pjFileMemberModel->commit();
				}
				
				pjUtil::redirect(PJ_INSTALL_URL . "index.php?controller=pjAdminFiles&action=pjActionIndex&err=AF01");
				
			} else {
				$arr = $pjFileModel->select('t1.*')->find($_GET['id'])->getData();
					
				if (count($arr) === 0)
				{
					pjUtil::redirect(PJ_INSTALL_URL. "index.php?controller=pjAdminFiles&action=pjActionIndex&err=AF08");
				}
				
				$group_arr = pjGroupModel::factory()->where('status', 'T')->orderBy('group_title ASC')->findAll()->getData();
				$member_arr = pjMemberModel::factory()->where('status', 'T')->orderBy('first_name ASC')->findAll()->getData();
				
				$file_group_arr = pjFileGroupModel::factory()->where('file_id', $_GET['id'])->findAll()->getData();
				$group_id_arr = array();
				if(!empty($file_group_arr))
				{
					foreach($file_group_arr as $v)
					{
						$group_id_arr[] = $v['group_id'];
					}
				}
				
				$file_member_arr = pjFileMemberModel::factory()->where('file_id', $_GET['id'])->findAll()->getData();
				$member_id_arr = array();
				if(!empty($file_member_arr))
				{
					foreach($file_member_arr as $v)
					{
						$member_id_arr[] = $v['member_id'];
					}
				}
				
				$this->set('arr', $arr);
				$this->set('group_arr', $group_arr);
				$this->set('member_arr', $member_arr);
				$this->set('group_id_arr', $group_id_arr);
				$this->set('member_id_arr', $member_id_arr);
				
				$this->appendJs('chosen.jquery.min.js', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
				$this->appendCss('chosen.css', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('additional-methods.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('pjAdminFiles.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionDownloadFile()
	{
		$id = $_GET['id'];
		$arr = pjFileModel::factory()->find($id)->getData();
		if(!empty($arr))
		{
			pjToolkit::download(@file_get_contents(PJ_INSTALL_URL . $arr['file_path']), $arr['file_name'], $arr['mime_type']);
			exit;
		}
	}
}
?>