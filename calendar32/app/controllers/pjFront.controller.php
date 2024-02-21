<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjFront extends pjAppController
{
	public $defaultCaptcha = 'StivaSoftCaptcha';
	
	public $defaultLocale = 'front_locale_id';
	
	public function __construct()
	{
		$this->setLayout('pjActionFront');
		self::allowCORS();
	}

	public function isXHR()
	{
		return parent::isXHR() || isset($_SERVER['HTTP_ORIGIN']);
	}
	
	static protected function allowCORS()
	{
		$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '*';
		header("Access-Control-Allow-Origin: $origin");
		header("Access-Control-Allow-Credentials: true");
		header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With");
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
			$locale_arr = pjLocaleModel::factory()->where('is_default', 1)->limit(1)->findAll()->getData();
			if (count($locale_arr) === 1)
			{
				$this->setLocaleId($locale_arr[0]['id']);
			}
		}
		if (!in_array($_GET['action'], array('pjActionLoadCss')))
		{
			$this->loadSetFields();
		}
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
	
	public function pjActionLoadCss()
	{
		$dm = new pjDependencyManager(PJ_INSTALL_PATH, PJ_THIRD_PARTY_PATH);
		$dm->load(PJ_CONFIG_PATH . 'dependencies.php')->resolve();
		
		$theme = isset($_GET['theme']) ? $_GET['theme'] : $this->option_arr['o_theme'];
		if((int) $theme > 0)
		{
			$theme = 'theme' . $theme;
		}
		$arr = array(
			array('file' => 'font-awesome.min.css', 'path' => $dm->getPath('font_awesome') . 'css/'),
			array('file' => 'tooltipster.css', 'path' => $dm->getPath('pj_tooltipster')),
			array('file' => 'pjPHPEventCalendar.css', 'path' => PJ_CSS_PATH),
			array('file' => "$theme.css", 'path' => PJ_CSS_PATH . 'themes/')
		);
		header("Content-Type: text/css; charset=utf-8");
		foreach ($arr as $item)
		{
			ob_start();
			@readfile($item['path'] . $item['file']);
			$string = ob_get_contents();
			ob_end_clean();
			
			if ($string !== FALSE)
			{
				echo str_replace(
					array('../fonts/fontawesome', "pjWrapper"),
					array(
						PJ_INSTALL_URL . $dm->getPath('font_awesome') . 'fonts/fontawesome',
						"pjWrapperPHPEventCalendar_" . $theme
					),
					$string
				) . "\n";
			}
		}
		exit;
	}
	
	public function pjActionLoad()
	{
		ob_start();
		header("Content-Type: text/javascript; charset=utf-8");
		
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
		$event_arr = $pjEventModel	
			->select("t1.*, t2.category")
			->join('pjCategory', 't2.id=t1.category_id', 'left outer')
			->orderBy('t1.event_date ASC, t1.start_time ASC')
			->where("t1.status", 'T')
			->findAll()
			->getData();
		$this->set('event_arr', $event_arr);
	}
}
?>