<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
require_once PJ_CONTROLLERS_PATH . 'pjAdmin.controller.php';
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
				if($time_flag == 1)
				{
					$data['start_time'] = $_POST['start_hour'] . ':' . $_POST['start_minute'] . ':00';
					$data['end_time'] = $_POST['end_hour'] . ':' . $_POST['end_minute'] . ':00';
				}else if($time_flag == 2){
					$data['end_time'] = $_POST['end_hour'] . ':' . $_POST['end_minute'] . ':00';
				}else if($time_flag == 3){
					$data['start_time'] = $_POST['start_hour'] . ':' . $_POST['start_minute'] . ':00';
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
						$num_months = 0;
						
						if($_POST['end_repeat_date'] != '')
						{
							$end_repeat_date = pjUtil::formatDate($_POST['end_repeat_date'], $this->option_arr['o_date_format']);
							$num_months = pjUtil::dateDiff("m", $recurring_date, $end_repeat_date, false);
						}else{
							if($_POST['end_repeat_times'] != '' && is_numeric($_POST['end_repeat_times']))
							{
								$num_months = intval($_POST['end_repeat_times']);
							}
						}
						
						if($num_months > 0)
						{
							for($i = 0; $i < $num_months; $i++)
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
							$num_months = pjUtil::dateDiff("m", $recurring_date, $end_repeat_date, false);
							$num_quarters = floor($num_months / 3);
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
				
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
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
			$temp_data = $pjEventModel->select('t1.*')
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
				unset($_POST['event_date']);
				
				$time_flag = $_POST['time_flag'];
				if($time_flag == 1)
				{
					$data['start_time'] = $_POST['start_hour'] . ':' . $_POST['start_minute'] . ':00';
					$data['end_time'] = $_POST['end_hour'] . ':' . $_POST['end_minute'] . ':00';
				}else if($time_flag == 2){
					$data['end_time'] = $_POST['end_hour'] . ':' . $_POST['end_minute'] . ':00';
					$data['start_time'] = ':NULL';
				}else if($time_flag == 3){
					$data['start_time'] = $_POST['start_hour'] . ':' . $_POST['start_minute'] . ':00';
					$data['end_time'] = ':NULL';
				}else if($time_flag == 0){
					$data['start_time'] = ':NULL';
					$data['end_time'] = ':NULL';
				}
				
				$pjEventModel = pjEventModel::factory();
				if(isset($_POST['apply_recurring']))
				{
					unset($_POST['id']);
					unset($data['event_date']);
					$pjEventModel->where('recurring_id', $_POST['recurring_id'])->modifyAll(array_merge($data,$_POST));
				}else{
					$pjEventModel->where('id', $_POST['id'])->limit(1)->modifyAll(array_merge($data,$_POST));

					$recurring_date = $data['event_date'];

					unset($_POST['id']);

					if($_POST['repeat'] == 'daily'){
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
								$data['recurring_id'] = $_POST['recurring_id'];
								$pjEventModel->reset()->setAttributes(array_merge($_POST, $data))->insert();
							}
						}
					}else if($_POST['repeat'] == 'weekly'){
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
								$data['recurring_id'] = $_POST['recurring_id'];
								$pjEventModel->reset()->setAttributes(array_merge($_POST, $data))->insert();
							}
						}
					}else if($_POST['repeat'] == 'monthly'){

						$recurring_date = date('Y-m-d', strtotime($recurring_date . "+1 month"));
						if($_POST['repeat-monthly-date'] != 0)
						{
							$recurring_date = date('Y-m-d', mktime(0,0,0,date('n', strtotime($recurring_date)), $_POST['repeat-monthly-date'], date('Y', strtotime($recurring_date))));
						}else{
							$recurring_date = date('Y-m-d', strtotime(date('Y-m', strtotime($recurring_date)) . '-01 ' .$_POST['repeat-monthly-each'] . ' '  . $_POST['repeat-monthly-day']));
						}
						$num_months = 0;

						if($_POST['end_repeat_date'] != '')
						{
							$end_repeat_date = pjUtil::formatDate($_POST['end_repeat_date'], $this->option_arr['o_date_format']);
							$num_months = pjUtil::dateDiff("m", $recurring_date, $end_repeat_date, false);
						}else{
							if($_POST['end_repeat_times'] != '' && is_numeric($_POST['end_repeat_times']))
							{
								$num_months = intval($_POST['end_repeat_times']);
							}
						}

						if($num_months > 0)
						{
							for($i = 0; $i < $num_months; $i++)
							{
								$data['event_date'] = $recurring_date;
								$data['recurring_id'] = $_POST['recurring_id'];
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

						$num_quarters = 0;
						if($_POST['end_repeat_date'] != '')
						{
							$end_repeat_date = pjUtil::formatDate($_POST['end_repeat_date'], $this->option_arr['o_date_format']);
							$num_months = pjUtil::dateDiff("m", $recurring_date, $end_repeat_date, false);
							$num_quarters = floor($num_months / 3);
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
								$data['recurring_id'] = $_POST['recurring_id'];
								$pjEventModel->reset()->setAttributes(array_merge($_POST, $data))->insert();
							}
						}
					}else if($_POST['repeat'] == 'yearly'){
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
								$data['recurring_id'] = $_POST['recurring_id'];
								$pjEventModel->reset()->setAttributes(array_merge($_POST, $data))->insert();
							}
						}
					}else if($_POST['repeat'] == 'custom'){
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
								$data['recurring_id'] = $_POST['recurring_id'];
								$pjEventModel->reset()->setAttributes(array_merge($_POST, $data))->insert();
							}
						}
					}

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
				
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('pjAdminEvents.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
}
?>