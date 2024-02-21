<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
require_once PJ_CONTROLLERS_PATH . 'pjAdmin.controller.php';
class pjAdminNotes extends pjAdmin
{
	public function pjActionCreate()
	{
		$this->checkLogin();
		
		if ($this->isAdmin())
		{
			if (isset($_POST['note_create']))
			{
				$pjNoteModel = pjNoteModel::factory();
				$id = $pjNoteModel->setAttributes($_POST)->insert()->getInsertId();
				
				if ($id !== false && (int) $id > 0)
				{
					if(isset($_POST['group_id']))
					{
						$pjNoteGroupModel = pjNoteGroupModel::factory();
						$pjNoteGroupModel->begin();
						foreach ($_POST['group_id'] as $group_id){
							$data = array();
							$data['group_id'] = $group_id;
							$data['note_id'] = $id;
							$pjNoteGroupModel->reset()->setAttributes($data)->insert();
						}
						$pjNoteGroupModel->commit();
					}
					
					if(isset($_POST['member_id']))
					{
						$pjNoteMemberModel = pjNoteMemberModel::factory();
						$pjNoteMemberModel->begin();
						foreach ($_POST['member_id'] as $member_id){
							$data = array();
							$data['member_id'] = $member_id;
							$data['note_id'] = $id;
							$pjNoteMemberModel->reset()->setAttributes($data)->insert();
						}
						$pjNoteMemberModel->commit();
					}
					
					$err = 'AN03';
				} else {
					$err = 'AN04';
				}
				pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminNotes&action=pjActionIndex&err=$err");
			} else {
				$group_arr = pjGroupModel::factory()->where('status', 'T')->orderBy('group_title ASC')->findAll()->getData();
				$member_arr = pjMemberModel::factory()->where('status', 'T')->orderBy('first_name ASC')->findAll()->getData();
				
				$this->set('group_arr', $group_arr);
				$this->set('member_arr', $member_arr);
				
				# TinyMCE
				$this->appendJs('tinymce.min.js', PJ_THIRD_PARTY_PATH . 'tiny_mce/');
				
				$this->appendJs('chosen.jquery.min.js', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
				$this->appendCss('chosen.css', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('additional-methods.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('pjAdminNotes.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionDeleteNote()
	{
		$this->setAjax(true);
		
		if ($this->isXHR())
		{
			$response = array();
			if ($this->isAdmin())
			{
				$pjNoteModel = pjNoteModel::factory();
				$arr = $pjNoteModel->find($_GET['id'])->getData();
				if ($pjNoteModel->reset()->setAttributes(array('id' => $_GET['id']))->erase()->getAffectedRows() == 1)
				{
					pjNoteGroupModel::factory()->where('note_id', $_GET['id'])->eraseAll();
					pjNoteMemberModel::factory()->where('note_id', $_GET['id'])->eraseAll();
					
					$response['code'] = 200;
				} else {
					$response['code'] = 100;
				}
			}
			pjAppController::jsonResponse($response);
		}
		exit;
	}
	
	public function pjActionDeleteNoteBulk()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if ($this->isAdmin())
			{
				if (isset($_POST['record']) && count($_POST['record']) > 0)
				{
					pjNoteModel::factory()->whereIn('id', $_POST['record'])->eraseAll();
					pjNoteGroupModel::factory()->whereIn('note_id', $_POST['record'])->eraseAll();
					pjNoteMemberModel::factory()->whereIn('note_id', $_POST['record'])->eraseAll();
				}
			}
		}
		exit;
	}
	
	public function pjActionExportNote()
	{
		$this->checkLogin();
		
		if (isset($_POST['record']) && is_array($_POST['record']))
		{
			$arr = pjNoteModel::factory()->whereIn('id', $_POST['record'])->findAll()->getData();
			$csv = new pjCSV();
			$csv
				->setHeader(true)
				->setName("Notes-".time().".csv")
				->process($arr)
				->download();
		}
		exit;
	}
	
	public function pjActionGetNote()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$pjNoteModel = pjNoteModel::factory();
			
			if (isset($_GET['q']) && !empty($_GET['q']))
			{
				$q = pjObject::escapeString($_GET['q']);
				$pjNoteModel->where("(t1.note LIKE '%$q%')");
			}

			if (isset($_GET['status']) && !empty($_GET['status']) && in_array($_GET['status'], array('T', 'F')))
			{
				$pjNoteModel->where('t1.status', $_GET['status']);
			}
				
			$column = 'created';
			$direction = 'DESC';
			if (isset($_GET['direction']) && isset($_GET['column']) && in_array(strtoupper($_GET['direction']), array('ASC', 'DESC')))
			{
				$column = $_GET['column'];
				$direction = strtoupper($_GET['direction']);
			}

			$total = $pjNoteModel->findCount()->getData();
			$rowCount = isset($_GET['rowCount']) && (int) $_GET['rowCount'] > 0 ? (int) $_GET['rowCount'] : 10;
			$pages = ceil($total / $rowCount);
			$page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
			$offset = ((int) $page - 1) * $rowCount;
			if ($page > $pages)
			{
				$page = $pages;
			}
			
			$data = array();
			$arr = $pjNoteModel->select('t1.*')->orderBy("$column $direction")->limit($rowCount, $offset)->findAll()->getData();
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
			$this->appendJs('pjAdminNotes.js');
			$this->appendJs('index.php?controller=pjAdmin&action=pjActionMessages', PJ_INSTALL_URL, true);
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionSaveNote()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if($_POST['column'] == 'note')
			{
				if($_POST['value'] != '')
				{
					pjNoteModel::factory()->where('id', $_GET['id'])->limit(1)->modifyAll(array($_POST['column'] => $_POST['value']));
				}
			}else{
				pjNoteModel::factory()->where('id', $_GET['id'])->limit(1)->modifyAll(array($_POST['column'] => $_POST['value']));
			}
		}
		exit;
	}
	
	public function pjActionStatusNote()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if (isset($_POST['record']) && count($_POST['record']) > 0)
			{
				pjNoteModel::factory()->whereIn('id', $_POST['record'])->modifyAll(array(
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
			$pjNoteModel = pjNoteModel::factory();
			if (isset($_POST['note_update']))
			{
				$arr = $pjNoteModel->find($_POST['id'])->getData();
				
				$pjNoteModel->reset()->where('id', $_POST['id'])->limit(1)->modifyAll(array_merge($_POST, array('modified' => date('Y-m-d H:i:s'))));
				
				$pjNoteGroupModel = pjNoteGroupModel::factory();
				$pjNoteGroupModel->where('note_id', $_POST['id'])->eraseAll();
				if(isset($_POST['group_id']))
				{
					$pjNoteGroupModel->reset()->begin();
					foreach ($_POST['group_id'] as $group_id){
						$data = array();
						$data['note_id'] = $_POST['id'];
						$data['group_id'] = $group_id;
						$pjNoteGroupModel->reset()->setAttributes($data)->insert();
					}
					$pjNoteGroupModel->commit();
				}
				
				$pjNoteMemberModel = pjNoteMemberModel::factory();
				$pjNoteMemberModel->where('note_id', $_POST['id'])->eraseAll();
				if(isset($_POST['member_id']))
				{
					$pjNoteMemberModel->reset()->begin();
					foreach ($_POST['member_id'] as $member_id){
						$data = array();
						$data['note_id'] = $_POST['id'];
						$data['member_id'] = $member_id;
						$pjNoteMemberModel->reset()->setAttributes($data)->insert();
					}
					$pjNoteMemberModel->commit();
				}
				
				pjUtil::redirect(PJ_INSTALL_URL . "index.php?controller=pjAdminNotes&action=pjActionIndex&err=AN01");
				
			} else {
				$arr = $pjNoteModel->select('t1.*')->find($_GET['id'])->getData();
					
				if (count($arr) === 0){
					pjUtil::redirect(PJ_INSTALL_URL. "index.php?controller=pjAdminNotes&action=pjActionIndex&err=AN08");
				}
				
				$group_arr = pjGroupModel::factory()->where('status', 'T')->orderBy('group_title ASC')->findAll()->getData();
				$member_arr = pjMemberModel::factory()->where('status', 'T')->orderBy('first_name ASC')->findAll()->getData();
				
				$note_group_arr = pjNoteGroupModel::factory()->where('note_id', $_GET['id'])->findAll()->getData();
				$group_id_arr = array();
				if(!empty($note_group_arr)){
					foreach($note_group_arr as $v)
					{
						$group_id_arr[] = $v['group_id'];
					}
				}
				
				$note_member_arr = pjNoteMemberModel::factory()->where('note_id', $_GET['id'])->findAll()->getData();
				$member_id_arr = array();
				if(!empty($note_member_arr)){
					foreach($note_member_arr as $v){
						$member_id_arr[] = $v['member_id'];
					}
				}
				
				$this->set('arr', $arr);
				$this->set('group_arr', $group_arr);
				$this->set('member_arr', $member_arr);
				$this->set('group_id_arr', $group_id_arr);
				$this->set('member_id_arr', $member_id_arr);
				
				# TinyMCE
				$this->appendJs('tinymce.min.js', PJ_THIRD_PARTY_PATH . 'tiny_mce/');
				
				$this->appendJs('chosen.jquery.min.js', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
				$this->appendCss('chosen.css', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('additional-methods.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('pjAdminNotes.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
}
?>