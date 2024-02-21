<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjAdminEvents extends pjAdmin
{
	public function pjActionCreate()
	{
		$this->checkLogin();
		
		if ($this->isAdmin() || $this->isEditor())
		{
			if (isset($_POST['event_create']))
			{
				$pjEventModel = pjEventModel::factory();
				
				$data = array();
				
				$data['event_date'] = pjUtil::formatDate($_POST['event_date'], $this->option_arr['o_date_format']);
				unset($_POST['event_date']);
				
				$time_flag = $_POST['time_flag'];
				$time_ampm = $_POST['time_ampm'];
				if($time_flag == 1)
				{
					if($time_ampm == 0)
					{
						$data['start_time'] = $_POST['start_hour'] . ':' . $_POST['start_minute'] . ':00';
						$data['end_time'] = $_POST['end_hour'] . ':' . $_POST['end_minute'] . ':00';
					}else{
						$data['start_time'] = date("H:i:s", strtotime($_POST['start_hour'] . ':' . $_POST['start_minute'] . ' ' . strtoupper($_POST['start_ampm'])));
						$data['end_time'] = date("H:i:s", strtotime($_POST['end_hour'] . ':' . $_POST['end_minute'] . ' ' . strtoupper($_POST['end_ampm'])));
					}
				}else if($time_flag == 2){
					if($time_ampm == 0)
					{
						$data['end_time'] = $_POST['end_hour'] . ':' . $_POST['end_minute'] . ':00';
					}else{
						$data['end_time'] = date("H:i:s", strtotime($_POST['end_hour'] . ':' . $_POST['end_minute'] . ' ' . strtoupper($_POST['end_ampm'])));
					}
				}else if($time_flag == 3){
					if($time_ampm == 0)
					{
						$data['start_time'] = $_POST['start_hour'] . ':' . $_POST['start_minute'] . ':00';
					}else{
						$data['start_time'] = date("H:i:s", strtotime($_POST['start_hour'] . ':' . $_POST['start_minute'] . ' ' . strtoupper($_POST['start_ampm'])));
					}
				}
				if(empty($_POST['lat']) && empty($_POST['lng']) && $_POST['location'] != '')
				{
					$geo = $this->pjActionGeocode($_POST['location'], $this->option_arr);
					$data['lat'] = $geo['lat']; unset($_POST['lat']);
					$data['lng'] = $geo['lng']; unset($_POST['lng']);
				}
				$id = $pjEventModel->setAttributes(array_merge($_POST, $data))->insert()->getInsertId();
				if ($id !== false && (int) $id > 0)
				{
					$recurring_id = md5($id . PJ_SALT);
					$data['recurring_id'] = $recurring_id;
					$recurring_date = $data['event_date'];
						
					if($_POST['repeat'] == 'none')
					{
						$pjEventModel->reset()->where('id', $id)->limit(1)->modifyAll(array('recurring_id' => $recurring_id));
						
					}else if($_POST['repeat'] == 'daily'){
						$pjEventModel->reset()->where('id', $id)->limit(1)->modifyAll(array('recurring_id' => $recurring_id));
						$num_days = 0;
						if($_POST['end_repeat_date'] != '')
						{
							$end_repeat_date = pjUtil::formatDate($_POST['end_repeat_date'], $this->option_arr['o_date_format']);
							$num_days = pjUtil::dateDiff('d', $recurring_date, $end_repeat_date);
							
						}else{
							if($_POST['end_repeat_times'] != '' && is_numeric($_POST['end_repeat_times']))
							{
								$num_days = intval($_POST['end_repeat_times']);
							}
						}
						if($num_days > 0)
						{
							for($i = 0; $i < $num_days; $i++)
							{
								$recurring_date = date('Y-m-d', strtotime($recurring_date . " +1 day"));
								
								$data['event_date'] = $recurring_date;
								$data['recurring_id'] = $recurring_id;
								$pjEventModel->reset()->setAttributes(array_merge($_POST, $data))->insert();
							}
						}
					}else if($_POST['repeat'] == 'weekly'){
						$pjEventModel->reset()->where('id', $id)->limit(1)->modifyAll(array('recurring_id' => $recurring_id));
						$num_weeks = 0;
						if($_POST['end_repeat_date'] != '')
						{
							$end_repeat_date = pjUtil::formatDate($_POST['end_repeat_date'], $this->option_arr['o_date_format']);
							$num_weeks = pjUtil::dateDiff('ww', $recurring_date, $end_repeat_date);
							
						}else{
							if($_POST['end_repeat_times'] != '' && is_numeric($_POST['end_repeat_times']))
							{
								$num_weeks = intval($_POST['end_repeat_times']);
							}
						}
						if($num_weeks > 0)
						{
							for($i = 0; $i < $num_weeks; $i++)
							{
								$recurring_date = date('Y-m-d', strtotime($recurring_date . " +7 day"));
								
								$data['event_date'] = $recurring_date;
								$data['recurring_id'] = $recurring_id;
								$pjEventModel->reset()->setAttributes(array_merge($_POST, $data))->insert();
							}
						}
					}else if($_POST['repeat'] == 'monthly'){
						$pjEventModel->reset()->where('id', $id)->limit(1)->modifyAll(array('recurring_id' => $recurring_id));
						
						$recurring_date = date('Y-m-d', strtotime($recurring_date . "+1 month"));
						if($_POST['repeat-monthly-date'] != 0)
						{
							$recurring_date = date('Y-m-d', mktime(0,0,0,date('n', strtotime($recurring_date)), $_POST['repeat-monthly-date'], date('Y', strtotime($recurring_date))));
						}else{
							$recurring_date = date('Y-m-d', strtotime(date('Y-m', strtotime($recurring_date)) . '-01 ' .$_POST['repeat-monthly-each'] . ' '  . $_POST['repeat-monthly-day']));
						}
						$number_of_months = 0;
						
						if($_POST['end_repeat_date'] != '')
						{
							$end_repeat_date = pjUtil::formatDate($_POST['end_repeat_date'], $this->option_arr['o_date_format']);
							$number_of_months = pjUtil::dateDiff("m", $recurring_date, $end_repeat_date, false);
						}else{
							if($_POST['end_repeat_times'] != '' && is_numeric($_POST['end_repeat_times']))
							{
								$number_of_months = intval($_POST['end_repeat_times']);
							}
						}
						
						if($number_of_months > 0)
						{
							for($i = 0; $i < $number_of_months; $i++)
							{
								$data['event_date'] = $recurring_date;
								$data['recurring_id'] = $recurring_id;
								$pjEventModel->reset()->setAttributes(array_merge($_POST, $data))->insert();
								if($_POST['repeat-monthly-date'] != 0)
                                {
                                    $recurring_date = date('Y-m-d', strtotime($recurring_date . " +1 month"));
                                }else{
                                	$month_year = date('F Y', strtotime($recurring_date . " +1 month"));
                                	$recurring_date = pjUtil::ordinalDate($_POST['repeat-monthly-each'], $_POST['repeat-monthly-day'], $month_year);
                                }
							}
						}
					}else if($_POST['repeat'] == 'quarterly'){
						$pjEventModel->reset()->where('id', $id)->limit(1)->modifyAll(array('recurring_id' => $recurring_id));
						
						$num_quarters = 0;
						if($_POST['end_repeat_date'] != '')
						{
							$end_repeat_date = pjUtil::formatDate($_POST['end_repeat_date'], $this->option_arr['o_date_format']);
							$number_of_months = pjUtil::dateDiff("m", $recurring_date, $end_repeat_date, false);
							$num_quarters = floor($number_of_months / 3);
						}else{
							if($_POST['end_repeat_times'] != '' && is_numeric($_POST['end_repeat_times']))
							{
								$num_quarters = intval($_POST['end_repeat_times']);
							}
						}
						if($num_quarters > 0)
						{
							for($i = 0; $i < $num_quarters; $i++)
							{
								$recurring_date = date('Y-m-d', strtotime($recurring_date . " +3 months"));
								
								$data['event_date'] = $recurring_date;
								$data['recurring_id'] = $recurring_id;
								$pjEventModel->reset()->setAttributes(array_merge($_POST, $data))->insert();
							}
						}
					}else if($_POST['repeat'] == 'yearly'){
						$pjEventModel->reset()->where('id', $id)->limit(1)->modifyAll(array('recurring_id' => $recurring_id));
						
						$num_years = 0;
						if($_POST['end_repeat_date'] != '')
						{
							$end_repeat_date = pjUtil::formatDate($_POST['end_repeat_date'], $this->option_arr['o_date_format']);
							$num_years = pjUtil::dateDiff("yyyy", $recurring_date, $end_repeat_date, false);
						}else{
							if($_POST['end_repeat_times'] != '' && is_numeric($_POST['end_repeat_times']))
							{
								$num_years = intval($_POST['end_repeat_times']);
							}
						}
						if($num_years > 0)
						{
							for($i = 0; $i < $num_years; $i++)
							{
								$recurring_date = date('Y-m-d', strtotime($recurring_date . " +1 year"));
								
								$data['event_date'] = $recurring_date;
								$data['recurring_id'] = $recurring_id;
								$pjEventModel->reset()->setAttributes(array_merge($_POST, $data))->insert();
							}
						}
					}else if($_POST['repeat'] == 'custom'){
						$pjEventModel->reset()->where('id', $id)->limit(1)->modifyAll(array('recurring_id' => $recurring_id));
						$steps = 0;
						$num_days = 0;
						if($_POST['repeat-custom-days'] != '' && is_numeric($_POST['repeat-custom-days']))
						{
							if($_POST['end_repeat_date'] != '')
							{
								$end_repeat_date = pjUtil::formatDate($_POST['end_repeat_date'], $this->option_arr['o_date_format']);
								$num_days = pjUtil::dateDiff('d', $recurring_date, $end_repeat_date);
								$steps = floor($num_days / $_POST['repeat-custom-days']);
							}else{
								if($_POST['end_repeat_times'] != '' && is_numeric($_POST['end_repeat_times']))
								{
									$steps = intval($_POST['end_repeat_times']);
								}
							}
						}
						if($steps > 0)
						{
							$num_days = intval($_POST['repeat-custom-days']);
							for($i = 0; $i < $steps; $i++)
							{
								$recurring_date = date('Y-m-d', strtotime($recurring_date . " +$num_days day"));
								
								$data['event_date'] = $recurring_date;
								$data['recurring_id'] = $recurring_id;
								$pjEventModel->reset()->setAttributes(array_merge($_POST, $data))->insert();
							}
						}
					}
					
					$err = 'AE03';
				}else{
					$err = 'AE04';
				}
				
				pjUtil::redirect($_SERVER['PHP_SELF'] . "?controller=pjAdminEvents&action=pjActionIndex&err=$err");
			} else {
				
				$pjCategoryModel = pjCategoryModel::factory();
				$category_arr = $pjCategoryModel->select('t1.*')->where('t1.status', 'T')->orderBy("category ASC")->findAll()->getData();
					
				$this->set('category_arr', $category_arr);
				
				$this->appendJs('tinymce.min.js', PJ_THIRD_PARTY_PATH . 'tinymce/');
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				
				$api_key_str = isset($this->option_arr['o_google_map_api']) && !empty($this->option_arr['o_google_map_api']) ? 'key=' . $this->option_arr['o_google_map_api'] . '&' : '';
				$this->appendJs('', '//maps.google.com/maps/api/js?'.$api_key_str.'libraries=places&region=uk&language=en', true);
				$this->appendJs('pjAdminEvents.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionDeleteEvent()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$response = array();
			if (pjEventModel::factory()->setAttributes(array('id' => $_GET['id']))->erase()->getAffectedRows() == 1)
			{
				$response['code'] = 200;
			} else {
				$response['code'] = 100;
			}
			pjAppController::jsonResponse($response);
		}
		exit;
	}
	
	public function pjActionDeleteEventBulk()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if (isset($_POST['record']) && count($_POST['record']) > 0)
			{
				pjEventModel::factory()->whereIn('id', $_POST['record'])->eraseAll();
			}
		}
		exit;
	}
	
	public function pjActionExportEvent()
	{
		$this->checkLogin();
		
		if (isset($_POST['record']) && is_array($_POST['record']))
		{
			$arr = pjEventModel::factory()->whereIn('id', $_POST['record'])->findAll()->getData();
			$csv = new pjCSV();
			$csv
				->setHeader(true)
				->setName("Events-".time().".csv")
				->process($arr)
				->download();
		}
		exit;
	}
	
	public function pjActionGetEvent()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$pjEventModel = pjEventModel::factory();
			$pjEventModel->join("pjCategory", "t2.id=t1.category_id", 'left');
			
			if (isset($_GET['q']) && !empty($_GET['q']))
			{
				$q = pjObject::escapeString($_GET['q']);
				
				$search_date = pjUtil::formatDate($q, $this->option_arr['o_date_format']);
				if($search_date != FALSE)
				{
					$pjEventModel->where('t1.event_date LIKE', $search_date);
				}else{
					$pjEventModel->where('t1.event_title LIKE', "%$q%");
				}
			}
			
			if (isset($_GET['status']) && !empty($_GET['status']) && in_array($_GET['status'], array('T', 'F')))
			{
				$pjEventModel->where('t1.status', $_GET['status']);
			}
			if(isset($_GET['category_id']))
			{
				if($_GET['category_id'] == '0')
				{
					$pjEventModel->where("t1.category_id IS NULL");
				}else if($_GET['category_id'] > 0){
					$pjEventModel->where('t1.category_id', $_GET['category_id']);
				}
			}
			if(isset($_GET['keyword']) && !empty($_GET['keyword']))
			{
				$keyword = pjObject::escapeString($_GET['keyword']);
				$pjEventModel->where('t1.event_title LIKE', "%$keyword%");
			}
			if (isset($_GET['from_date']) && $_GET['from_date'] != '' && isset($_GET['to_date']) && $_GET['to_date'] != '')
			{
				$from_date = pjUtil::formatDate($_GET['from_date'], $this->option_arr['o_date_format']);
				$to_date = pjUtil::formatDate($_GET['to_date'], $this->option_arr['o_date_format']);
				$pjEventModel->where("(t1.event_date >= '$from_date' AND t1.event_date <= '$to_date')");
			} else {
				if (isset($_GET['from_date']) && $_GET['from_date'] != '')
				{
					$from_date = pjUtil::formatDate($_GET['from_date'], $this->option_arr['o_date_format']);
					$pjEventModel->where("(t1.event_date >= '$from_date')");
				} else if (isset($_GET['to_date']) && $_GET['to_date'] != '') {
					$to_date = pjUtil::formatDate($_GET['to_date'], $this->option_arr['o_date_format']);
					$pjEventModel->where("(t1.event_date <= '$to_date')");
				}			
			}
				
			$column = 'event_date';
			$direction = 'DESC';
			if (isset($_GET['direction']) && isset($_GET['column']) && in_array(strtoupper($_GET['direction']), array('ASC', 'DESC')))
			{
				$column = $_GET['column'];
				$direction = strtoupper($_GET['direction']);
			}
			
			$total = $pjEventModel->findCount()->getData();
			$rowCount = isset($_GET['rowCount']) && (int) $_GET['rowCount'] > 0 ? (int) $_GET['rowCount'] : 10;
			$pages = ceil($total / $rowCount);
			$page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
			$offset = ((int) $page - 1) * $rowCount;
			if ($page > $pages)
			{
				$page = $pages;
			}
			$temp_data = $pjEventModel->select('t1.*, t2.category')
									->orderBy("$column $direction")->limit($rowCount, $offset)->findAll()->getData();
			$data = array();
			foreach($temp_data as $k => $v){
				if(!empty($v['start_time']))
				{
					$v['start_time'] = $event_time = pjUtil::formatTime($v['start_time'], 'H:i:s', $this->option_arr['o_time_format']);
				}else{
					$v['start_time'] = '';
				}
				if(!empty($v['end_time']))
				{
					$v['end_time'] = $event_time = pjUtil::formatTime($v['end_time'], 'H:i:s', $this->option_arr['o_time_format']);
				}else{
					$v['end_time'] = '';
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
		
		if ($this->isAdmin() || $this->isEditor())
		{
			$category_arr = pjCategoryModel::factory()->select('t1.*')->where('t1.status', 'T')->orderBy("category ASC")->findAll()->getData();
					
			$this->set('category_arr', $category_arr);
			
			$this->appendJs('jquery.datagrid.js', PJ_FRAMEWORK_LIBS_PATH . 'pj/js/');
			$this->appendJs('pjAdminEvents.js');
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionSaveEvent()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$pjEventModel = pjEventModel::factory();
	
			if (!in_array($_POST['column'], $pjEventModel->i18n))
			{
				$pjEventModel->where('id', $_GET['id'])->limit(1)->modifyAll(array($_POST['column'] => $_POST['value']));
			}
		}
		exit;
	}
	
	public function pjActionStatusEvent()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if (isset($_POST['record']) && count($_POST['record']) > 0)
			{
				pjEventModel::factory()->whereIn('id', $_POST['record'])->modifyAll(array(
					'status' => ":IF(`status`='F','T','F')"
				));
			}
		}
		exit;
	}
	
	public function pjActionUpdate()
	{
		$this->checkLogin();
		
		if ($this->isAdmin() || $this->isEditor())
		{
				
			if (isset($_POST['event_update']))
			{
				$data = array();
				
				$data['event_date'] = pjUtil::formatDate($_POST['event_date'], $this->option_arr['o_date_format']);
				$data['modified'] = date('Y-m-d H:i:s');
				unset($_POST['event_date']);
				
				$time_flag = $_POST['time_flag'];
				$time_ampm = $_POST['time_ampm'];
				if($time_flag == 1)
				{
					if($time_ampm == 0)
					{
						$data['start_time'] = $_POST['start_hour'] . ':' . $_POST['start_minute'] . ':00';
						$data['end_time'] = $_POST['end_hour'] . ':' . $_POST['end_minute'] . ':00';
					}else{
						$data['start_time'] = date("H:i:s", strtotime($_POST['start_hour'] . ':' . $_POST['start_minute'] . ' ' . strtoupper($_POST['start_ampm'])));
						$data['end_time'] = date("H:i:s", strtotime($_POST['end_hour'] . ':' . $_POST['end_minute'] . ' ' . strtoupper($_POST['end_ampm'])));
					}
				}else if($time_flag == 2){
					if($time_ampm == 0)
					{
						$data['end_time'] = $_POST['end_hour'] . ':' . $_POST['end_minute'] . ':00';
					}else{
						$data['end_time'] = date("H:i:s", strtotime($_POST['end_hour'] . ':' . $_POST['end_minute'] . ' ' . strtoupper($_POST['end_ampm'])));
					}
					$data['start_time'] = ':NULL';
				}else if($time_flag == 3){
					if($time_ampm == 0)
					{
						$data['start_time'] = $_POST['start_hour'] . ':' . $_POST['start_minute'] . ':00';
					}else{
						$data['start_time'] = date("H:i:s", strtotime($_POST['start_hour'] . ':' . $_POST['start_minute'] . ' ' . strtoupper($_POST['start_ampm'])));
					}
					$data['end_time'] = ':NULL';
				}else if($time_flag == 0){
					$data['start_time'] = ':NULL';
					$data['end_time'] = ':NULL';
				}
				
				if(empty($_POST['lat']) && empty($_POST['lng']) && $_POST['location'] != '')
				{
					$geo = $this->pjActionGeocode($_POST['location'], $this->option_arr);
					$data['lat'] = $geo['lat']; unset($_POST['lat']);
					$data['lng'] = $geo['lng']; unset($_POST['lng']);
				}
				
				$pjEventModel = pjEventModel::factory();
				if(isset($_POST['apply_recurring']))
				{
					unset($_POST['id']);
					unset($data['event_date']);
					$pjEventModel->where('recurring_id', $_POST['recurring_id'])->modifyAll(array_merge($data,$_POST));
				}else{
					$pjEventModel->where('id', $_POST['id'])->limit(1)->modifyAll(array_merge($data,$_POST));
				}
				pjUtil::redirect(PJ_INSTALL_URL . "index.php?controller=pjAdminEvents&action=pjActionIndex&err=AE01");
				
			} else {
				$pjEventModel = pjEventModel::factory();
				$arr = $pjEventModel->find($_GET['id'])->getData();
				if (count($arr) === 0)
				{
					pjUtil::redirect(PJ_INSTALL_URL. "index.php?controller=pjAdminEvents&action=pjActionIndex&err=AE08");
				}
				
				$pjCategoryModel = pjCategoryModel::factory();
				$category_arr = $pjCategoryModel->select('t1.*')->where('t1.status', 'T')->orderBy("category ASC")->findAll()->getData();
				
				$recurring_id = $arr['recurring_id'];
				$number_of_events = $pjEventModel->reset()->where('recurring_id', $recurring_id)->findCount()->getData();
				
				$this->set('arr', $arr);
				$this->set('category_arr', $category_arr);
				$this->set('number_of_events', $number_of_events);
				
				$this->appendJs('tinymce.min.js', PJ_THIRD_PARTY_PATH . 'tinymce/');
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$api_key_str = isset($this->option_arr['o_google_map_api']) && !empty($this->option_arr['o_google_map_api']) ? 'key=' . $this->option_arr['o_google_map_api'] . '&' : '';
				$this->appendJs('', '//maps.google.com/maps/api/js?'.$api_key_str.'libraries=places&region=uk&language=en', true);
				$this->appendJs('pjAdminEvents.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionGetGeocode()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$geo = pjAdminEvents::pjActionGeocode($_GET['location'], $this->option_arr);
			$response = array('code' => 100);
			if (isset($geo['lat']) && !is_array($geo['lat']))
			{
				$response = $geo;
				$response['code'] = 200;
			}
			pjAppController::jsonResponse($response);
		}
		exit;
	}
	
	private static function pjActionGeocode($str, $option_arr)
	{
		$_address = preg_replace('/\s+/', '+', $str);
		$_address = urlencode($_address);
	
		$api_key_str = isset($option_arr['o_google_map_api']) && !empty($option_arr['o_google_map_api']) ? '&key=' . $option_arr['o_google_map_api'] : '';
		$gfile = "https://maps.googleapis.com/maps/api/geocode/json?address=$_address" . $api_key_str;
		
		$Http = new pjHttp();
		$response = $Http->request($gfile)->getResponse();
	
		$geoObj = pjAppController::jsonDecode($response);
	
		$data = array();
		$geoArr = (array) $geoObj;
		if ($geoArr['status'] == 'OK')
		{
			$geoArr['results'][0] = (array) $geoArr['results'][0];
			$geoArr['results'][0]['geometry'] = (array) $geoArr['results'][0]['geometry'];
			$geoArr['results'][0]['geometry']['location'] = (array) $geoArr['results'][0]['geometry']['location'];
				
			$data['lat'] = $geoArr['results'][0]['geometry']['location']['lat'];
			$data['lng'] = $geoArr['results'][0]['geometry']['location']['lng'];
		} else {
			$data['lat'] = NULL;
			$data['lng'] = NULL;
		}
		return $data;
	}
	
	public function pjActionExport()
	{
		$this->checkLogin();
	
		if ($this->isAdmin() || $this->isEditor())
		{
			if(isset($_POST['event_export']))
			{
				$pjEventModel = pjEventModel::factory();
				
				if($_POST['period'] == 'next')
				{
					$column = 'event_date';
					$direction = 'ASC';

					$where_str = pjUtil::getComingWhere($_POST['coming_period'], $this->option_arr['o_week_start']);
					if($where_str != '')
					{
						$pjEventModel->where($where_str);
					}
				}else{
					$column = 'created';
					$direction = 'ASC';
					$where_str = pjUtil::getMadeWhere($_POST['made_period'], $this->option_arr['o_week_start']);
					if($where_str != '')
					{
						$pjEventModel->where($where_str);
					}
				}

				$arr= $pjEventModel
					->select('t1.*, UNIX_TIMESTAMP(t1.created) AS uuid')
					->orderBy("$column $direction")
					->findAll()
					->getData();
				
				if($_POST['type'] == 'file')
				{
					$this->setLayout('pjActionEmpty');
						
					if($_POST['format'] == 'csv')
					{
						$csv = new pjCSV();
						$csv
						->setHeader(true)
						->setName("Export-".time().".csv")
						->process($arr)
						->download();
					}
					if($_POST['format'] == 'xml')
					{
						$xml = new pjXML();
						$xml
						->setEncoding('UTF-8')
						->setName("Export-".time().".xml")
						->process($arr)
						->download();
					}
					if($_POST['format'] == 'ical')
					{
						foreach($arr as $k => $v)
						{
							$v['date_from'] = $v['event_date'] . ' 00:00:00';
							$v['date_to'] = $v['event_date'] . ' 23:59:59';
							if(!empty($v['start_time']) && !empty($v['end_time']))
							{
								$v['date_from'] = $v['event_date'] . ' ' . $v['start_time'];
								$v['date_to'] = $v['event_date'] . ' ' . $v['end_time'];
							}else if(!empty($v['start_time']) && empty($v['end_time'])){
								$v['date_from'] = $v['event_date'] . ' ' . $v['start_time'];
							}else if(empty($v['start_time']) && !empty($v['end_time'])){
								$v['date_to'] = $v['event_date'] . ' ' . $v['end_time'];
							}
							$_arr = array();
							$_arr[] = $v['event_title'];
							if(!empty($v['description']))
							{
								$_arr[] = __('lblDescription', true) . ': ' . stripslashes($v['description']);
							}
							if(!empty($v['lat']))
							{
								$_arr[] = __('lblLatitude', true) . ': ' . stripslashes($v['lat']);
							}
							if(!empty($v['lng']))
							{
								$_arr[] = __('lblLongitude', true) . ': ' . stripslashes($v['lng']);
							}
							$v['desc'] = join("\; ", $_arr);
							$arr[$k] = $v;
						}
						$ical = new pjICal();
						$ical
							->setName("Export-".time().".ics")
							->setProdID('PHP Event Calendar')
							->setSummary('event_title')
							->setCName('desc')
							->setLocation('location')
							->setTimezone(pjUtil::getTimezoneName($this->option_arr['o_timezone']))
							->process($arr)
							->download();
					}
					exit;
				}else{
					$pjPasswordModel = pjPasswordModel::factory();
					$password = md5($_POST['password'].PJ_SALT);
					$arr = $pjPasswordModel
					->where("t1.password", $password)
					->limit(1)
					->findAll()
					->getData();
					if (count($arr) != 1)
					{
						$pjPasswordModel->setAttributes(array('password' => $password))->insert();
					}
					$this->set('password', $password);
				}
			}
				
			$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
			$this->appendJs('pjAdminEvents.js');
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionExportFeed()
	{
		$this->setLayout('pjActionEmpty');
		$access = true;
		if(isset($_GET['p']))
		{
			$pjPasswordModel = pjPasswordModel::factory();
			$arr = $pjPasswordModel
			->where('t1.password', $_GET['p'])
			->limit(1)
			->findAll()
			->getData();
			if (count($arr) != 1)
			{
				$access = false;
			}
		}
		if($access == true)
		{
			$arr = $this->pjGetFeedData($_GET);
			if(!empty($arr))
			{
				if($_GET['format'] == 'xml')
				{
					$xml = new pjXML();
					echo $xml
					->setEncoding('UTF-8')
					->process($arr)
					->getData();
						
				}
				if($_GET['format'] == 'csv')
				{
					$csv = new pjCSV();
					echo $csv
					->setHeader(true)
					->process($arr)
					->getData();
						
				}
				if($_GET['format'] == 'ical')
				{
					foreach($arr as $k => $v)
					{
						$v['date_from'] = $v['event_date'] . ' 00:00:00';
						$v['date_to'] = $v['event_date'] . ' 23:59:59';
						if(!empty($v['start_time']) && !empty($v['end_time']))
						{
							$v['date_from'] = $v['event_date'] . ' ' . $v['start_time'];
							$v['date_to'] = $v['event_date'] . ' ' . $v['end_time'];
						}else if(!empty($v['start_time']) && empty($v['end_time'])){
							$v['date_from'] = $v['event_date'] . ' ' . $v['start_time'];
						}else if(empty($v['start_time']) && !empty($v['end_time'])){
							$v['date_to'] = $v['event_date'] . ' ' . $v['end_time'];
						}
						$_arr = array();
						$_arr[] = $v['event_title'];
						if(!empty($v['description']))
						{
							$_arr[] = __('lblDescription', true) . ': ' . stripslashes($v['description']);
						}
						if(!empty($v['lat']))
						{
							$_arr[] = __('lblLatitude', true) . ': ' . stripslashes($v['lat']);
						}
						if(!empty($v['lng']))
						{
							$_arr[] = __('lblLongitude', true) . ': ' . stripslashes($v['lng']);
						}
						$v['desc'] = join("\; ", $_arr);
						$arr[$k] = $v;
					}
					$ical = new pjICal();
					echo $ical
					->setProdID('PHP Event Calendar')
					->setSummary('event_title')
					->setCName('desc')
					->setLocation('location')
					->setTimezone(pjUtil::getTimezoneName($this->option_arr['o_timezone']))
					->process($arr)
					->getData();
						
				}
			}
		}else{
			__('lblNoAccessToFeed');
		}
		exit;
	}
	public function pjGetFeedData($get)
	{
		$arr = array();
		$status = true;
		$type = '';
		$period = '';
		if(isset($get['period']))
		{
			if(!ctype_digit($get['period']))
			{
				$status = false;
			}else{
				$period = $get['period'];
			}
		}else{
			$status = false;
		}
		if(isset($get['type']))
		{
			if(!ctype_digit($get['type']))
			{
				$status = false;
			}else{
				$type = $get['type'];
			}
		}else{
			$status = false;
		}
		if($status == true && $type != '' && $period != '')
		{
			$pjEventModel = pjEventModel::factory();
				
			if($type == '1')
			{
				$column = 'event_date';
				$direction = 'ASC';
					
				$where_str = pjUtil::getComingWhere($period, $this->option_arr['o_week_start']);
				if($where_str != '')
				{
					$pjEventModel->where($where_str);
				}
			}else{
				$column = 'created';
				$direction = 'DESC';
				$where_str = pjUtil::getMadeWhere($period, $this->option_arr['o_week_start']);
				if($where_str != '')
				{
					$pjEventModel->where($where_str);
				}
			}
			$arr= $pjEventModel
				->select('t1.*, UNIX_TIMESTAMP(t1.created) AS uuid')
				->orderBy("$column $direction")
				->findAll()
				->getData();
		}
		return $arr;
	}
}
?>