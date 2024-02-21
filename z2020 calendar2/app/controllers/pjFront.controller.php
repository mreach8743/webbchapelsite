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

		if(isset($_GET['topic_id']))
		{
			$this->setTopic($_GET['topic_id']);
		}
		
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
	
	public function pjActionCaptcha()
	{
		$this->setAjax(true);
		
		$Captcha = new pjCaptcha('app/web/obj/Anorexia.ttf', $this->defaultCaptcha, 6);
		$Captcha->setImage('app/web/img/button.png')->init(isset($_GET['rand']) ? $_GET['rand'] : null);
	}


	public function pjActionCheckCaptcha()
	{
		$this->setAjax(true);
		
		$verification = $_GET['verification'];
				
		if (!isset($_GET['verification']) || empty($_GET['verification']) || strtoupper($_GET['verification']) != $_SESSION[$this->defaultCaptcha]){
			echo 101;
		}else{
			echo 100;
		}
	}
	
	public function pjActionSetLocale()
	{
		$this->setLocaleId(@$_GET['locale']);
		pjUtil::redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function pjActionLoadCss()
	{
		header("Content-type: text/css");
		if(!isset($_GET['cssfile']))
		{
			echo str_replace(array('../img/'), array(PJ_IMG_PATH), @file_get_contents(PJ_CSS_PATH . 'front_layout_1.css')) . "\n";
		}else{
			echo str_replace(array('../img/'), array(PJ_IMG_PATH), @file_get_contents(PJ_CSS_PATH . $_GET['cssfile'])) . "\n";
		}
		exit;
	}
	
	public function pjActionLoadJs()
	{
		header("Content-type: text/javascript");
		$arr = array(
			array('file' => 'jabb-0.4.3.js', 'path' => PJ_LIBS_PATH . 'jabb/'),
			array('file' => 'pjLoad.js', 'path' => PJ_JS_PATH)
		);
		header("Content-type: text/javascript");
		foreach ($arr as $item)
		{
			echo @file_get_contents($item['path'] . $item['file']) . "\n";
		}
		exit;
	}
	
	public function pjActionLoad()
	{
		$pjCategoryModel = pjCategoryModel::factory();
		$pjCategoryModel->where("t1.status", 'T');
		$category_arr = $pjCategoryModel->orderBy('t1.category ASC')->findAll()->getData();
		$this->set('category_arr', $category_arr);
	}
	
	public function pjActionLoadEvents()
	{
		$this->setAjax(true);
		
		$dt = $_GET['year'] . '-'. $_GET['month'];
		$today = date('Y-m-d');
		$pjEventModel = pjEventModel::factory();
		
		$pjEventModel->where("t1.status", 'T');
		
		if($_GET['cate'] > 0)
		{
			$pjEventModel->where('t1.category_id', $_GET['cate']);
		}
		$pjEventModel->where("(t1.category_id IN(SELECT t3.id FROM `".pjCategoryModel::factory()->getTable()."` AS t3 WHERE t3.status = 'T') OR t1.category_id IS NULL)");
		if($_GET['view_mode'] == 'list')
		{
			$pjEventModel->where("t1.event_date >= '$today'");
			
			$total = $pjEventModel->findCount()->getData();
			$rowCount = $this->option_arr['o_events_per_page'];
			$pages = ceil($total / $rowCount);
			$page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
			$offset = ((int) $page - 1) * $rowCount;
			if ($page > $pages)
			{
				$page = $pages;
			}
			$pjEventModel->limit($rowCount, $offset);
			$this->set('pages', $pages);
			$this->set('page', $page);
		}else{
			$pjEventModel->where("t1.event_date LIKE '%$dt%'");
		}
		
		$event_arr = $pjEventModel	->select("t1.*, t2.category")
									->join('pjCategory', 't2.id=t1.category_id', 'left outer')
									->orderBy('t1.event_date ASC, t1.start_time ASC')->findAll()->getData();

		$event_date_arr = array();
		foreach ($event_arr as $v){
			$event_date_arr[$v['event_date']][] = $v;
		}
		
		$this->set('event_arr', $event_arr);
		$this->set('event_date_arr', $event_date_arr);
	}
	
	public function pjActionLoadEventDetail()
	{
		$this->setAjax(true);
		
		$dt = $_GET['dt'];
		
		$pjEventModel = pjEventModel::factory();
		
		$pjEventModel->where("t1.event_date LIKE '%$dt%'");
		if($_GET['cate'] > 0)
		{
			$pjEventModel->where('t1.category_id', $_GET['cate']);
		}
		$event_arr = $pjEventModel	->select("t1.*, t2.category")
									->join('pjCategory', 't2.id=t1.category_id', 'left outer')
									->orderBy('t1.event_date ASC, t1.start_time ASC')->findAll()->getData();
		$this->set('event_arr', $event_arr);
	}
}
?>