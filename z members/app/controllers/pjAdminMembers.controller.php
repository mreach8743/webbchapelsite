<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
require_once PJ_CONTROLLERS_PATH . 'pjAdmin.controller.php';
class pjAdminMembers extends pjAdmin
{
	public function pjActionCheckEmail()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if (!isset($_GET['email']) || empty($_GET['email']))
			{
				echo 'false';
				exit;
			}
			$pjMemberModel = pjMemberModel::factory()->where('t1.email', $_GET['email']);
			if (isset($_GET['id']) && (int) $_GET['id'] > 0)
			{
				$pjMemberModel->where('t1.id !=', $_GET['id']);
			}
			echo $pjMemberModel->findCount()->getData() == 0 ? 'true' : 'false';
		}
		exit;
	}
	
	public function pjActionCreate()
	{
		$this->checkLogin();
		
		if ($this->isAdmin())
		{
			if (isset($_POST['member_create']))
			{
				$pjMemberModel = pjMemberModel::factory();
				
				$data = array();
				if (isset($_POST['birthday']) && !empty($_POST['birthday']))
				{
					$data['birthday'] = pjUtil::formatDate($_POST['birthday'], $this->option_arr['o_date_format']);
				}	
				unset($_POST['birthday']);
				
				$data['ip'] = $_SERVER['REMOTE_ADDR'];
				
				$data = array_merge($_POST, $data);
				
				$id = $pjMemberModel->setAttributes($data)->insert()->getInsertId();
				
				if ($id !== false && (int) $id > 0)
				{
					$err = 'AM03';
				} else {
					$err = 'AM04';
				}
				pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminMembers&action=pjActionIndex&err=$err");
			} else {
				
				$group_arr = pjGroupModel::factory()->where('status', 'T')->orderBy('group_title ASC')->findAll()->getData();
				$country_arr = pjCountryModel::factory()->where('status', 'T')->orderBy('country_title ASC')->findAll()->getData();
				
				$this->set('group_arr', $group_arr);
				$this->set('country_arr', $country_arr);
				
				$this->appendJs('chosen.jquery.min.js', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
				$this->appendCss('chosen.css', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('additional-methods.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('pjAdminMembers.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionImport()
	{
		$this->checkLogin();
		
		if ($this->isAdmin())
		{
			if (isset($_POST['member_import']))
			{
				if (isset($_FILES['csv']) && !empty($_FILES['csv']['tmp_name']))
				{
					if(pjUtil::getFileExtension($_FILES['csv']['name']) == 'csv')
					{
						$csv_data = $this->loadCSV($_FILES['csv']);
						
						$pjMemberModel = pjMemberModel::factory();
						
						$err = 'AM09';
						$pjMemberModel->begin();
						foreach ($csv_data as $row)
						{
							if($pjMemberModel->reset()->where('t1.email', $row['email'])->findCount()->getData() == 0)
							{
								unset($row['modified']);
								unset($row['created']);
								if(!empty($_POST['group_id']))
								{
									$row['group_id'] = $_POST['group_id'];
								}
								$pjMemberModel->reset()->setAttributes($row)->insert();
								
							}else{
								$err = 'AM13';
							}
						}
						$pjMemberModel->commit();
						
						pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminMembers&action=pjActionIndex&err=$err");
						
					}else{
						pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminMembers&action=pjActionImport&err=AM10");
					}
				}else{
					pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminMembers&action=pjActionImport&err=AM11");
				}
			}else{
				$group_arr = pjGroupModel::factory()->where('status', 'T')->orderBy('group_title ASC')->findAll()->getData();
				
				$this->set('group_arr', $group_arr);
				
				$this->appendJs('chosen.jquery.min.js', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
				$this->appendCss('chosen.css', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('additional-methods.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('pjAdminMembers.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionDeleteMember()
	{
		$this->setAjax(true);
		
		if ($this->isXHR())
		{
			$response = array();
			if ($this->isAdmin())
			{
				if (pjMemberModel::factory()->reset()->setAttributes(array('id' => $_GET['id']))->erase()->getAffectedRows() == 1)
				{
					$response['code'] = 200;
				} else {
					$response['code'] = 100;
				}
			}
			pjAppController::jsonResponse($response);
		}
		exit;
	}
	
	public function pjActionDeleteMemberBulk()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if ($this->isAdmin() || $this->isEditor())
			{
				if (isset($_POST['record']) && count($_POST['record']) > 0)
				{
					pjMemberModel::factory()->reset()->whereIn('id', $_POST['record'])->eraseAll();
				}
			}
		}
		exit;
	}
	
	public function pjActionExportMember()
	{
		$this->checkLogin();
		
		if (isset($_POST['record']) && is_array($_POST['record']))
		{
			$arr = pjMemberModel::factory()->select("t1.id, t1.group_id, t1.first_name, t1.last_name, t1.email, AES_DECRYPT(t1.password, '".PJ_SALT."') as password, t1.phone, t1.website, t1.gender, t1.age, t1.birthday, t1.address, t1.city, t1.state, t1.country_id, t1.zip, t1.company_name, t1.ip, t1.modified, t1.created, t1.last_login, t1.status")
					->whereIn('id', $_POST['record'])->findAll()->getData();
			
			$csv = new pjCSV();
			$csv
				->setHeader(true)
				->setName("Members-".time().".csv")
				->process($arr)
				->download();
		}
		exit;
	}
	
	public function pjActionGetMember()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$pjMemberModel = pjMemberModel::factory();
			
			if (isset($_GET['q']) && !empty($_GET['q']))
			{
				$q = pjObject::escapeString($_GET['q']);
				$pjMemberModel->where("(t1.first_name LIKE '%$q%' OR t1.last_name LIKE '%$q%' OR t1.email LIKE '%$q%')");
			}
			if (isset($_GET['first_name']) && !empty($_GET['first_name']))
			{
				$fname = pjObject::escapeString($_GET['first_name']);
				$pjMemberModel->where("(t1.first_name LIKE '%$fname%')");
			}
			if (isset($_GET['last_name']) && !empty($_GET['last_name']))
			{
				$lname = pjObject::escapeString($_GET['last_name']);
				$pjMemberModel->where("(t1.last_name LIKE '%$lname%')");
			}
			if (isset($_GET['email']) && !empty($_GET['email']))
			{
				$email = pjObject::escapeString($_GET['email']);
				$pjMemberModel->where("(t1.email LIKE '%$email%')");
			}
			if (isset($_GET['last_login']) && !empty($_GET['last_login']))
			{
				if($_GET['last_login'] == 'today')
				{
					$login_filter = date('Y-m-d');
					$pjMemberModel->where("(t1.last_login LIKE '%$login_filter%')");
				}else{
					switch ($_GET['last_login']) {
						case '7_days':
							$login_filter = date('Y-m-d H:i:s', strtotime('-7 days'));
						break;
						case '30_days':
							$login_filter = date('Y-m-d H:i:s', strtotime('-30 days'));;
						break;
						case '3_months':
						 	$login_filter = date('Y-m-d H:i:s', strtotime('-3 months'));;
						break;
					}
					$pjMemberModel->where("(t1.last_login >= '$login_filter')");
				}
			}
			if (isset($_GET['country_id']) && !empty($_GET['country_id']))
			{
				$pjMemberModel->where("t1.country_id", $_GET['country_id']);
			}
			
			if (isset($_GET['group_id']) && !empty($_GET['group_id']))
			{
				$pjMemberModel->where("t1.group_id", $_GET['group_id']);
			}

			if (isset($_GET['status']) && !empty($_GET['status']) && in_array($_GET['status'], array('T', 'F')))
			{
				$pjMemberModel->where('t1.status', $_GET['status']);
			}
			if (isset($_GET['gender']) && !empty($_GET['gender']) && in_array($_GET['gender'], array('F', 'M')))
			{
				$pjMemberModel->where('t1.gender', $_GET['gender']);
			}
			if (isset($_GET['age_from']) && $_GET['age_from'] != '' && isset($_GET['age_to']) && $_GET['age_to'] != '')
			{
				$pjMemberModel->where('t1.age >=', $_GET['age_from']);
				$pjMemberModel->where('t1.age <=', $_GET['age_to']);
			} else {
				if (isset($_GET['age_from']) && $_GET['age_from'] != '')
				{
					$pjMemberModel->where('t1.age >=', $_GET['age_from']);
				} else if (isset($_GET['age_to']) && $_GET['age_to'] != '') {
					$pjMemberModel->where('t1.age <=', $_GET['age_to']);
				}			
			}
				
			$column = 'first_name';
			$direction = 'ASC';
			if (isset($_GET['direction']) && isset($_GET['column']) && in_array(strtoupper($_GET['direction']), array('ASC', 'DESC')))
			{
				$column = $_GET['column'];
				$direction = strtoupper($_GET['direction']);
			}

			$total = $pjMemberModel->findCount()->getData();
			$rowCount = isset($_GET['rowCount']) && (int) $_GET['rowCount'] > 0 ? (int) $_GET['rowCount'] : 10;
			$pages = ceil($total / $rowCount);
			$page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
			$offset = ((int) $page - 1) * $rowCount;
			if ($page > $pages)
			{
				$page = $pages;
			}
			
			$pjMemberModel->join('pjGroup', 't1.group_id = t2.id', 'left');
			$data = $pjMemberModel->select('t1.id, t1.first_name, t1.last_name, t1.email, t1.created, t1.status, t2.group_title')
				->orderBy("$column $direction")->limit($rowCount, $offset)->findAll()->getData();

			pjAppController::jsonResponse(compact('data', 'total', 'pages', 'page', 'rowCount', 'column', 'direction'));
		}
		exit;
	}
	
	public function pjActionIndex()
	{
		$this->checkLogin();
		
		if ($this->isAdmin())
		{
			$group_arr = pjGroupModel::factory()->where('status', 'T')->orderBy('group_title ASC')->findAll()->getData();
			$country_arr = pjCountryModel::factory()->where('status', 'T')->orderBy('country_title ASC')->findAll()->getData();
			
			$this->set('group_arr', $group_arr);
			$this->set('country_arr', $country_arr);
			
			$this->appendJs('chosen.jquery.min.js', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
			$this->appendCss('chosen.css', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
			
			$this->appendJs('jquery.datagrid.js', PJ_FRAMEWORK_LIBS_PATH . 'pj/js/');
			$this->appendJs('pjAdminMembers.js');
			$this->appendJs('index.php?controller=pjAdmin&action=pjActionMessages', PJ_INSTALL_URL, true);
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionSaveMember()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if($_POST['column'] == 'first_name')
			{
				if($_POST['value'] != '')
				{
					pjMemberModel::factory()->where('id', $_GET['id'])->limit(1)->modifyAll(array($_POST['column'] => $_POST['value']));
				}
			}else{
				pjMemberModel::factory()->where('id', $_GET['id'])->limit(1)->modifyAll(array($_POST['column'] => $_POST['value']));
                if ($_POST['column'] == 'status' && $_POST['value'] == 'T'){
                    $member = pjMemberModel::factory()->find($_GET['id'])->getData();
                    $this->pjRegistrationCreated($_GET['id'], $member['group_id']);
                } 
			}
		}
		exit;
	}
	
	public function pjActionStatusMember()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if (isset($_POST['record']) && count($_POST['record']) > 0)
			{
				pjMemberModel::factory()->whereIn('id', $_POST['record'])->modifyAll(array(
					'status' => ":IF(`status`='F','T','F')"
				));
                $member_arr = pjMemberModel::factory()->whereIn('id', $_POST['record'])->findAll()->getData();
                foreach($member_arr as $member){
                    if ($member['status'] == 'T'){
                        $this->pjRegistrationCreated($member['id'], $member['group_id']);
                    }

                }

			}
		}
		exit;
	}
	
	public function pjActionUpdate()
	{
		$this->checkLogin();
		
		if ($this->isAdmin())
		{
			$pjMemberModel = pjMemberModel::factory();
			if (isset($_POST['member_update']))
			{
				$data = array();
				if (isset($_POST['birthday']) && !empty($_POST['birthday']))
				{
					$data['birthday'] = pjUtil::formatDate($_POST['birthday'], $this->option_arr['o_date_format']);
				}	
				unset($_POST['birthday']);
				$data['ip'] = $_SERVER['REMOTE_ADDR'];
				
				$data['modified'] = date('Y-m-d H:i:s');
				
				$data = array_merge($_POST, $data);
				
				$pjMemberModel->reset()->where('id', $_POST['id'])->limit(1)->modifyAll($data);

                if ($_POST['status'] == 'T'){
                    $this->pjRegistrationCreated($_POST['id'], $_POST['group_id']);
                }
								
				pjUtil::redirect(PJ_INSTALL_URL . "index.php?controller=pjAdminMembers&action=pjActionIndex&err=AM01");
				
			} else {
				$arr = $pjMemberModel->find($_GET['id'])->getData();
				
				if (count($arr) === 0)
				{
					pjUtil::redirect(PJ_INSTALL_URL. "index.php?controller=pjAdminMembers&action=pjActionIndex&err=AM08");
				}
				$this->set('arr', $arr);
				
				$group_arr = pjGroupModel::factory()->where('status', 'T')->orderBy('group_title ASC')->findAll()->getData();
				$country_arr = pjCountryModel::factory()->where('status', 'T')->orderBy('country_title ASC')->findAll()->getData();
				
				$this->set('group_arr', $group_arr);
				$this->set('country_arr', $country_arr);
				
				$this->appendJs('chosen.jquery.min.js', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
				$this->appendCss('chosen.css', PJ_THIRD_PARTY_PATH . 'harvest/chosen/');
				
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('additional-methods.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('pjAdminMembers.js');
			}
		} else {
			$this->set('status', 2);
		}
	}

    protected function pjRegistrationCreated($member_id, $group_id)
    {
        $arr = pjMemberModel::factory()->find($member_id)->getData();
        $group_arr = pjGroupModel::factory()->find($group_id)->getData();
        $email_arr = pjNotificationModel::factory()->where('t1.key', 'created')->findAll()->getData();
        if(count($email_arr) > 0)
        {
            $email = $email_arr[0];

            $country = '';
            $birthday = '';
            $fee = '';
            $gender = '';
            $gender_arr = __('genderarr', true);
            if(!empty($arr['gender']))
            {
                $gender = $gender_arr[$arr['gender']];
            }
            if(!empty($arr['country_id']))
            {
                $country_arr = pjCountryModel::factory()->find($arr['country_id'])->getData();
                $country = $country_arr['country_title'];
            }
            if(!empty($arr['birthday']))
            {
                $birthday = pjUtil::formatDate($arr['birthday'], 'Y-m-d', $this->option_arr['o_date_format']);
            }

            if(!empty($group_arr['registration_fee']))
            {
                $fee .= __('front_label_registration_fee', true) . ": " . $group_arr['registration_fee'] . $this->option_arr['o_currency'] . "\r\n";
            }
            if(!empty($group_arr['subscription_fee']))
            {
                $fee .= __('front_label_subscription_fee', true) . ": " . $group_arr['subscription_fee'] . $this->option_arr['o_currency'] . " " . __('front_label_per', true) . " " . $group_arr['subscription_period'] . "\r\n";
            }

            $subject = $email['subject'];
            $message = str_replace(	array('{Group}', '{FirstName}', '{LastName}', '{Email}', '{Password}', '{Phone}', '{Website}', '{Gender}', '{Age}', '{Birthday}', '{Address}', '{City}', '{State}', '{Country}', '{Zip}', '{CompanyName}', '{Fee}'),
                array($group_arr['group_title'], $arr['first_name'], $arr['last_name'], $arr['email'], $arr['password'], $arr['phone'], $arr['website'], $gender, $arr['age'], $birthday, $arr['address'], $arr['city'], $arr['state'], $country, $arr['zip'], $arr['company_name'], $fee),
                $email['message']);

            $pjEmail = new pjEmail();
            if ($this->option_arr['o_send_email'] == 'smtp')
            {
                $pjEmail
                    ->setTransport('smtp')
                    ->setSmtpHost($this->option_arr['o_smtp_host'])
                    ->setSmtpPort($this->option_arr['o_smtp_port'])
                    ->setSmtpUser($this->option_arr['o_smtp_user'])
                    ->setSmtpPass($this->option_arr['o_smtp_pass'])
                ;
            }
            $pjEmail->setFrom($this->getFromEmail())
                ->setTo($arr['email'])
                ->setSubject($subject)
                ->send($message);
        }
    }




}
?>