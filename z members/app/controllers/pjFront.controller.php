<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
require_once PJ_CONTROLLERS_PATH . 'pjAppController.controller.php';
class pjFront extends pjAppController
{
	public $defaultCaptcha = 'StivaSoftCaptcha';
	
	public $defaultLocale = 'front_locale_id';
	
	public $defaultMember = 'front_default_member';
	
	public function __construct()
	{
		$this->setLayout('pjActionFront');
		ob_start();
	}

	public function afterFilter()
	{		
		
	}
	
	public function beforeFilter()
	{
		$OptionModel = pjOptionModel::factory();
		$this->option_arr = $OptionModel->getPairs($this->getForeignId());
		$this->set('option_arr', $this->option_arr);
		$this->setTime();

		if (!isset($_SESSION[$this->defaultLocale]))
		{
			pjObject::import('Model', 'pjLocale:pjLocale');
			$locale_arr = pjLocaleModel::factory()->where('is_default', 1)->limit(1)->findAll()->getData();
			if (count($locale_arr) === 1)
			{
				$this->setLocaleId($locale_arr[0]['id']);
			}
		}
		pjAppController::setFields($this->getLocaleId());
	}
	
	public function beforeRender()
	{
		if (isset($_GET['iframe']))
		{
			$this->setLayout('pjActionIframe');
		}
	}
	
	public function pjActionSetLocale()
	{
		$this->setLocaleId(@$_GET['locale']);
		pjUtil::redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function pjActionCaptcha()
	{
		$this->setAjax(true);
		
		$Captcha = new pjCaptcha('app/web/obj/Anorexia.ttf', $this->defaultCaptcha, 6);
		$Captcha->setImage('app/web/img/button.png')->init(isset($_GET['rand']) ? $_GET['rand'] : null);
	}


	public function pjActionCheckCaptcha()
	{
		$this->setAjax(true);
				
		if (!isset($_GET['captcha']) || empty($_GET['captcha']) || strtoupper($_GET['captcha']) != $_SESSION[$this->defaultCaptcha]){
			echo 101;
		}else{
			echo 100;
		}
	}
	
	public function pjActionCheckEmail()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if (!isset($_GET['email']) || empty($_GET['email']))
			{
				echo 101;
				exit;
			}
			$pjMemberModel = pjMemberModel::factory()->where('t1.email', $_GET['email']);
			if (isset($_GET['id']) && (int) $_GET['id'] > 0)
			{
				$pjMemberModel->where('t1.id !=', $_GET['id']);
			}
			echo $pjMemberModel->findCount()->getData() == 0 ? 100 : 101;
		}
		exit;
	}
	
	public function pjActionLoadCss()
	{
		header("Content-type: text/css");
		$arr = array(
			array('file' => 'front.css', 'path' => PJ_CSS_PATH),
		);
		foreach ($arr as $item)
		{
			$css_content = file_get_contents($item['path'] . $item['file']);
			echo str_replace(array('../img/'), array(PJ_IMG_PATH), $css_content) . "\n";			
		}
		exit;
	}
	
	public function pjActionRegisterJs()
	{
		header("Content-type: text/javascript");
		$arr = array(
			array('file' => 'jabb-0.4.3.js', 'path' => PJ_LIBS_PATH . 'jabb/'),
			array('file' => 'pjRegister.js', 'path' => PJ_JS_PATH)
		);
		foreach ($arr as $item)
		{
			$js_content = file_get_contents($item['path'] . $item['file']);
			echo $js_content . "\n";
		}
		exit;
	}
	
	public function pjActionRegister()
	{
		$this->setLayout('pjActionFrontJS');
		
		$pjGroupModel = pjGroupModel::factory();
		
		$group_arr = $pjGroupModel->where('status', 'T')->orderBy('group_title ASC')->findAll()->getData();
		$country_arr = pjCountryModel::factory()->where('status', 'T')->orderBy('country_title ASC')->findAll()->getData();
		
		if(isset($_GET['group_id']))
		{
			$arr = $pjGroupModel->reset()->find($_GET['group_id'])->getData();
			$this->set('arr', $arr);
		}
		
		$this->set('group_arr', $group_arr);
		$this->set('country_arr', $country_arr);
	}
	public function pjActionGetFee()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$arr = pjGroupModel::factory()->find($_GET['id'])->getData();
			
			if(!empty($arr))
			{
				if(!empty($arr['registration_fee']) && $arr['registration_fee'] > 0)
				{
					$arr['registration_fee'] = pjUtil::formatCurrencySign($arr['registration_fee'], $this->option_arr['o_currency']);
				}else{
					$arr['registration_fee'] = '';
				}
				
				if(!empty($arr['subscription_fee']) && $arr['subscription_fee'] > 0)
				{
					$arr['subscription_fee'] = pjUtil::formatCurrencySign($arr['subscription_fee'], $this->option_arr['o_currency']) . ' ' . __('front_label_per', true) . ' ' . $arr['subscription_period'];
				}else{
					$arr['subscription_fee'] = '';
				}
			}
			
			pjAppController::jsonResponse($arr);
		}
		exit;
	}
	public function pjActionRegisterSave()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$pjMemberModel = pjMemberModel::factory();
			$data = array();
			$birthday = '';

			$json = array();
			$json['code'] = 100;
			if (!empty($_POST['day']) && !empty($_POST['month']) && !empty($_POST['year']))
			{
				$data['birthday'] = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
				$birthday = pjUtil::formatDate($data['birthday'], 'Y-m-d', $this->option_arr['o_date_format']);
			}
			$data['ip'] = $_SERVER['REMOTE_ADDR'];
			$data['status'] = 'F';
			$data = array_merge($_POST, $data);
			
			$id = $pjMemberModel->setAttributes($data)->insert()->getInsertId();
			
			if ($id !== false && (int) $id > 0)
			{
				$this->pjAdminNotification($id, $_POST['group_id']);
				if($this->option_arr['o_registration_confirmation'] == 'manual')
				{
					//$this->pjRegistrationCreated($id, $_POST['group_id']);
				}else if($this->option_arr['o_registration_confirmation'] == 'confirm'){
					$this->pjRegistrationConfirmation($id, $_POST['group_id']);
				}else if($this->option_arr['o_registration_confirmation'] == 'payment'){
					$group_arr = pjGroupModel::factory()->find($_POST['group_id'])->getData();
					$amount = floatval($group_arr['registration_fee']) + floatval($group_arr['subscription_fee']);
					if($amount <= 0)
					{
						$json['code'] = 100;
						$pjMemberModel->reset()->where('id', $id)->limit(1)->modifyAll(array('status' => 'T'));
					}else{
						$json['code'] = 200;
						$json['id'] = $id;	
					}
				}
			} else {
				$json['code'] = 101;
			}
			pjAppController::jsonResponse($json);
		}
		exit;
	}
	
	public function pjActionGetPaymentForm()
	{
		$this->setAjax(true);
		
		if ($this->isXHR())
		{
			$member_arr = pjMemberModel::factory()->find($_GET['id'])->getData();
			$group_arr = pjGroupModel::factory()->find($member_arr['group_id'])->getData();

			$amount = floatval($group_arr['registration_fee']) + floatval($group_arr['subscription_fee']);
			$item_name = $group_arr['group_title'] . ' ' . pjUtil::formatCurrencySign(floatval($group_arr['registration_fee']), $this->option_arr['o_currency']) . ' ' . __('front_label_registration_fee', true) . ' + ' . pjUtil::formatCurrencySign(floatval($group_arr['subscription_fee']), $this->option_arr['o_currency']) . ' ' . __('front_label_subscription_fee', true);
			$t3 = 'M';
			if($group_arr['	subscription_period'] == 'week')
			{
				$t3 = 'W';
			}else if($group_arr['	subscription_period'] == 'year'){
				$t3 = 'Y';
			}
			$this->set('params', array(
						'name' => 'ml_memberlogin_paypal_form',
						'id' => 'ml_memberlogin_paypal_form',
						'business' => $this->option_arr['o_paypal_address'],
						'item_name' => $item_name,
						'custom' => $member_arr['id'],
						'currency_code' => $this->option_arr['o_currency'],
						'return' => $this->option_arr['o_thankyou_page'],
						'a1' => number_format(floatval($group_arr['registration_fee']), 2, '.', ''),
						'a3' => number_format(floatval($group_arr['subscription_fee']), 2, '.', ''),
						't3' => $t3,
						'target' => '_self'
					));
					
			$this->log('submit payment form');
		}
	}
	
	public function pjActionConfirmPaypal()
	{
		$this->setAjax(true);
		
		if (pjObject::getPlugin('pjPaypal') === NULL)
		{
			$this->log('Paypal plugin not installed');
			exit;
		}
		
		$pjMemberModel = pjMemberModel::factory();
		
		$member_arr = $pjMemberModel->find($_POST['custom'])->getData();
		$group_arr = pjGroupModel::factory()->find($member_arr['group_id'])->getData();

		$amount = floatval($group_arr['registration_fee']) + floatval($group_arr['subscription_fee']);
				
		$params = array(
			'txn_id' => '',
			'paypal_address' => $this->option_arr['o_paypal_address'],
			'deposit' => $amount,
			'currency' => $this->option_arr['o_currency'],
			'key' => md5($this->option_arr['private_key'] . PJ_SALT)
		);
		$response = $this->requestAction(array('controller' => 'pjPaypal', 'action' => 'pjActionConfirm', 'params' => $params), array('return'));
		
		if ($response !== FALSE && $response['status'] === 'OK')
		{
			$this->log('Payment confirmed');
			$pjMemberModel->setAttributes(array('id' => $member_arr['id']))->modify(array('status' => 'T'));
			$this->pjPaymentConfirmation($member_arr['id'], $member_arr['group_id']);
			
		} elseif (!$response) {
			$this->log('Authorization failed');
		} else {
			$this->log('Payment not confirmed');
		}
		exit;
	}
	
	public function pjActionConfirm()
	{
		$id = $_GET['id'];
		$hash = $_GET['hash'];
		if($hash == md5(PJ_SALT . $id))
		{
			$pjMemberModel = pjMemberModel::factory();
			if($pjMemberModel->where('id', $id)->where('status', 'T')->findCount()->getData() == 0)
			{
				$pjMemberModel->reset()->where('id', $id)->limit(1)->modifyAll(array('status'=>'T'));
				
				$err = 'FA01';
			}else{
				$err = 'FA03';
			}
		}else{
			$err = 'FA02';
		}
		$this->set('status', $err);
		$this->appendCss('front.css');
	}
	
	public function pjActionLoginJs()
	{
		header("Content-type: text/javascript");
		$arr = array(
			array('file' => 'jabb-0.4.3.js', 'path' => PJ_LIBS_PATH . 'jabb/'),
			array('file' => 'pjLogin.js', 'path' => PJ_JS_PATH)
		);
		foreach ($arr as $item)
		{
			$js_content = file_get_contents($item['path'] . $item['file']);
			echo $js_content . "\n";
		}
		exit;
	}
	
	public function pjActionLogin()
	{
		$this->setLayout('pjActionFrontJS');
	}
	public function pjActionLoginForm()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			
		}
	}
	public function pjActionForgotForm()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			
		}
	}
	public function pjActionForgotSend()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$json = array();
			$member = pjMemberModel::factory()
				->where('t1.email', $_POST['email'])
				->limit(1)
				->findAll()
				->getData();
			if (count($member) != 1)
			{
				$json['code'] = 101;
			}else{
				$arr = $member[0];
				$email_arr = pjNotificationModel::factory()->where('t1.key', 'forgot')->findAll()->getData();
				if(count($email_arr) > 0)
				{
					$email = $email_arr[0];
					
					$subject = $email['subject'];
					$message = str_replace(	array('{FirstName}', '{Password}'), 
											array($arr['first_name'], $arr['password']), 
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
				$json['code'] = 100;
			}
			pjAppController::jsonResponse($json);
		}
		exit;
	}
	
	public function pjActionLoginCheck()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$pjMemberModel = pjMemberModel::factory();
			
			$json = array();
			
			$member = $pjMemberModel
				->where('t1.email', $_POST['email'])
				->limit(1)
				->findAll()
				->getData();
			if (count($member) != 1)
			{
				$json['code'] = 101;
			}else{
				
				$member = $pjMemberModel
					->where('t1.id', $member[0]['id'])
					->where(sprintf("t1.password = AES_ENCRYPT('%s', '%s')", pjObject::escapeString($_POST['password']), PJ_SALT))
					->limit(1)
					->findAll()
					->getData();
				if(count($member) != 1)
				{
					$json['code'] = 102;
				}else{
					
					$member = $member[0];
					unset($member['password']);
					
					if ($member['status'] != 'T')
					{
						$json['code'] = 103;
					}else{
						$last_login = date("Y-m-d H:i:s");
		    			$_SESSION[$this->defaultMember] = $member;
		    			
		    			# Update
		    			$data = array();
		    			$data['last_login'] = $last_login;
		    			$pjMemberModel->reset()->setAttributes(array('id' => $member['id']))->modify($data);
		    			
		    			$group_arr = pjGroupModel::factory()
							->find($member['group_id'])
							->getData();
		    			
						$json['home_url'] = '';	
						if (!empty($group_arr))
						{
							$json['home_url'] = $group_arr['home_url'];
						}	
		    			$json['code'] = 100;
					}
				}
			}
			pjAppController::jsonResponse($json);
		}
		exit;
	}
	
	public function pjActionProfileJs()
	{
		header("Content-type: text/javascript");
		$arr = array(
			array('file' => 'jabb-0.4.3.js', 'path' => PJ_LIBS_PATH . 'jabb/'),
			array('file' => 'pjProfile.js', 'path' => PJ_JS_PATH)
		);
		foreach ($arr as $item)
		{
			$js_content = file_get_contents($item['path'] . $item['file']);
			echo $js_content . "\n";
		}
		exit;
	}
	
	public function pjActionProfile()
	{
		$this->setLayout('pjActionFrontJS');
		
		$status = 0;
		
		if(isset($_SESSION[$this->defaultMember]))
		{
			$id = $_SESSION[$this->defaultMember]['id'];
			
			$arr = pjMemberModel::factory()->find($id)->getData();
			
			if (count($arr) === 0)
			{
				$status = 2;
			}else{
				if($arr['status'] != 'T')
				{
					$status = 3;
				}else{
					$country_arr = pjCountryModel::factory()->where('status', 'T')->orderBy('country_title ASC')->findAll()->getData();
					
					$this->set('country_arr', $country_arr);
					$this->set('arr', $arr);
				}
			}
		}else{
			$status = 1;
		}
		
		$this->set('status', $status);
	}
	
	public function pjActionProfileSave()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$pjMemberModel = pjMemberModel::factory();
			$data = array();
			$birthday = '';
			if (!empty($_POST['day']) && !empty($_POST['month']) && !empty($_POST['year']))
			{
				$data['birthday'] = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
				$birthday = pjUtil::formatDate($data['birthday'], 'Y-m-d', $this->option_arr['o_date_format']);
			}else if (empty($_POST['day']) && empty($_POST['month']) && empty($_POST['year'])){
				$data['birthday'] = ':NULL';
			}
			$data['modified'] = date('Y-m-d H:i:s');
			
			$data = array_merge($_POST, $data);
			
			$pjMemberModel->reset()->where('id', $_POST['id'])->limit(1)->modifyAll($data);
			
			echo 100;
		}
		exit;
	}
	
	public function pjActionLogout()
	{
		if(isset($_SESSION[$this->defaultMember]))
		{
			unset($_SESSION[$this->defaultMember]);
		}
		pjUtil::redirect($this->option_arr['o_login_page']);
	}
	
	public function pjActionProtect()
	{
		if(!isset($_SESSION[$this->defaultMember]))
		{
			pjUtil::redirect($this->option_arr['o_protected_page']);
		}
		
		$group_allowed_arr = explode(",", $_GET['group_id']);
		
		if(!in_array($_SESSION[$this->defaultMember]['group_id'], $group_allowed_arr))
		{
			pjUtil::redirect($this->option_arr['o_protected_page']);
		}
	}
	
	public function pjActionFile()
	{
		$this->setLayout('pjActionFrontJS');
		
		$file_arr = array();
		
		if(isset($_SESSION[$this->defaultMember]))
		{
						
			$group_id = $_SESSION[$this->defaultMember]['group_id'];
			
			$file_arr = pjFileModel::factory()	->where("t1.id IN(SELECT TFG.file_id FROM `".pjFileGroupModel::factory()->getTable()."` AS TFG WHERE TFG.group_id IN ($group_id))")
												->orWhere("t1.id IN(SELECT TFM.file_id FROM `".pjFileMemberModel::factory()->getTable()."` AS TFM WHERE TFM.member_id=".$_SESSION[$this->defaultMember]['id'].")")
												->findAll()->getData();
											
		}
		
		$this->set('file_arr', $file_arr);
	}
	
	public function pjActionNote()
	{
		$this->setLayout('pjActionFrontJS');
		
		$file_arr = array();
		
		if(isset($_SESSION[$this->defaultMember])){
						
			$group_id = $_SESSION[$this->defaultMember]['group_id'];
			
			$note_arr = pjNoteModel::factory()	->where("t1.id IN(SELECT TNG.note_id FROM `".pjNoteGroupModel::factory()->getTable()."` AS TNG WHERE TNG.group_id IN ($group_id))")
												->orWhere("t1.id IN(SELECT TNM.note_id FROM `".pjNoteMemberModel::factory()->getTable()."` AS TNM WHERE TNM.member_id=".$_SESSION[$this->defaultMember]['id'].")")
												->findAll()->getData();
											
		}
		$this->set('note_arr', $note_arr);
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
	
	protected function pjAdminNotification($member_id, $group_id)
	{
		$arr = pjMemberModel::factory()->find($member_id)->getData();
		$group_arr = pjGroupModel::factory()->find($group_id)->getData();
		$email_arr = pjNotificationModel::factory()->where('t1.key', 'notify')->findAll()->getData();
		if(count($email_arr) > 0)
		{
			$email = $email_arr[0];
			
			$country = '';
			$fee = '';
			$birthday = '';
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
			$message = str_replace(	array('{Group}', '{FirstName}', '{LastName}', '{Email}', '{Password}', '{Phone}', '{Website}', '{Gender}', '{Age}', '{Birthday}', '{Address}', '{City}', '{State}', '{Country}', '{Zip}', '{CompanyName}', '{CompanyName}', '{Fee}'), 
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
			
			$user_arr = pjUserModel::factory()->where('t1.role_id', 1)->findAll()->getData();
			foreach($user_arr as $admin)
			{
				$pjEmail->setFrom($this->getFromEmail())
						->setTo($admin['email'])
						->setSubject($subject)
						->send($message);
			}
		}
	}

    protected function pjRegistrationConfirmation($member_id, $group_id)
    {
        $arr = pjMemberModel::factory()->find($member_id)->getData();
        $group_arr = pjGroupModel::factory()->find($group_id)->getData();
        $email_arr = pjNotificationModel::factory()->where('t1.key', 'register')->findAll()->getData();
        if(count($email_arr) > 0)
        {
            $email = $email_arr[0];

            $country = '';
            $birthday = '';
            $fee = '';
            $confirmURL = '';
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
            $hash = md5(PJ_SALT . $member_id);
            $confirmURL = PJ_INSTALL_URL.'index.php?controller=pjFront&action=pjActionConfirm&id='.$member_id.'&hash='.$hash;

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
            $message = str_replace(	array('{Group}', '{FirstName}', '{LastName}', '{Email}', '{Password}', '{Phone}', '{Website}', '{Gender}', '{Age}', '{Birthday}', '{Address}', '{City}', '{State}', '{Country}', '{Zip}', '{CompanyName}', '{Fee}', '{ConfirmURL}'),
                array($group_arr['group_title'], $arr['first_name'], $arr['last_name'], $arr['email'], $arr['password'], $arr['phone'], $arr['website'], $gender, $arr['age'], $birthday, $arr['address'], $arr['city'], $arr['state'], $country, $arr['zip'], $arr['company_name'], $fee, $confirmURL),
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
	
	protected function pjPaymentConfirmation($member_id, $group_id)
	{
		$arr = pjMemberModel::factory()->find($member_id)->getData();
		$group_arr = pjGroupModel::factory()->find($group_id)->getData();
		$email_arr = pjNotificationModel::factory()->where('t1.key', 'payment')->findAll()->getData();
		if(count($email_arr) > 0)
		{
			$email = $email_arr[0];
			
			$country = '';
			$birthday = '';
			$fee = '';
			$confirmURL = '';
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