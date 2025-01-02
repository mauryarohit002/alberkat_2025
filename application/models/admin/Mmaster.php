<?php
	class Mmaster extends CI_model{
		public function get_cnt($table, $arr){
			$this->db->where($arr);
			return $this->db->count_all_results($table);
		}
		public function get_app_data_cnt($status,$recycle=false)
		{
			$extra = "";
			$order_by = "";
			$date_extra = "";
			if(isset($_GET['search_field']) && isset($_GET['search_keyword'])  && isset($_GET['order']))
			{
				$search_field    = trim($_GET['search_field']);
				$search_keyword  = trim($_GET['search_keyword']);
				$order           = trim($_GET['order']);
				$date 			 = $_GET['start_date'];
				$start_date      = date('Y-m-d',strtotime($_GET['start_date']));
				$end_date        = date('Y-m-d',strtotime($_GET['end_date']));
				if(!empty($search_field) && !empty($search_keyword))
				{
					if ($search_field == 'rm_reg_date')
					{
						$extra .= " AND $search_field like '%".date('Y-m-d',strtotime($search_keyword))."%'";
					}
					else if (!empty($search_field) && !empty($search_keyword))
					{
						$extra .= " AND $search_field like '%".$search_keyword."%'";
					}
				}
				if(!empty($order))
				{
					if (!empty($search_field) && ($search_field !='all'))
					{
						$order_by .= "order by $search_field ".$order."";
					}
					else
					{
						$order_by .= "order by rm_app_no ".$order."";
					}
				}
				if(!empty($date))
				{
					$date_extra .= " AND rm_reg_date BETWEEN '$start_date' AND '$end_date'";
				}
			}
			else if (isset($_GET['search_field']) && isset($_GET['order']))
			{
				$order_by .= "order by $search_field ".$order."";
			}
			else
			{
				$order_by .= 'order by rm_app_no DESC';
			}
			
			if($status==3 && $recycle==true){
				$extra .= " AND DATEDIFF(NOW(),rm_update_date) > 7 ";
			}
			if($status==3 && $recycle==false){
				$extra .= " AND DATEDIFF(NOW(),rm_update_date) <= 7 ";
			}
			if ($status != 'sb') {
				$query = "SELECT * from registration_master WHERE (rm_app_status = '$status') $date_extra $extra $order_by";
			}
			else
			{
				$query = "SELECT * from registration_master WHERE rm_sibling_flag = 1 AND rm_payment_status = 0 $date_extra $extra $order_by ";
			}
			return $this->db->query($query)->num_rows();
		}
		public function get_app_data($limit, $offset,$status,$recycle=false)
		{	
			$extra = "";
			$order_by = "";
			$date_extra = "";
			if(isset($_GET['search_field']) && isset($_GET['search_keyword'])  && isset($_GET['order']))
			{
				$search_field    = trim($_GET['search_field']);
				$search_keyword  = trim($_GET['search_keyword']);
				$order           = trim($_GET['order']);
				$date 			 = $_GET['start_date'];
				$start_date      = date('Y-m-d',strtotime($_GET['start_date']));
				$end_date        = date('Y-m-d',strtotime($_GET['end_date']));
				if(!empty($search_field) && !empty($search_keyword))
				{
					if ($search_field == 'rm_reg_date')
					{
						$extra .= " AND $search_field like '%".date('Y-m-d',strtotime($search_keyword))."%'";
					}
					else if (!empty($search_field) && !empty($search_keyword))
					{
						$extra .= " AND $search_field like '%".$search_keyword."%'";
					}
				}
				if(!empty($order))
				{
					if (!empty($search_field) && ($search_field !='all'))
					{
						$order_by .= "order by $search_field ".$order."";
					}
					else
					{
						$order_by .= "order by rm_app_no ".$order."";
					}
				}
				if(!empty($date))
				{
					$date_extra .= " AND rm_reg_date BETWEEN '$start_date' AND '$end_date'";
				}
			}
			else if (isset($_GET['search_field']) && isset($_GET['order']))
			{
				$order_by .= "order by $search_field ".$order."";
			}
			else
			{
				$order_by .= 'order by rm_app_no DESC';
			}
			if($status==3 && $recycle==true){
				$extra .= " AND DATEDIFF(NOW(),rm_update_date) > 7 ";
			}
			if($status==3 && $recycle==false){
				$extra .= " AND DATEDIFF(NOW(),rm_update_date) <= 7 ";
			}
			if ($status != 'sb') {
				$query = "SELECT * from registration_master WHERE (rm_app_status = '$status') $date_extra $extra $order_by LIMIT $offset,$limit";
			}
			else
			{
				$query = "SELECT * from registration_master WHERE rm_sibling_flag = 1 AND rm_payment_status = 0 $date_extra $extra $order_by LIMIT $offset,$limit";
			}
			// pre($query);exit();
			$record['reg_data'] 	= $this->db->query($query)->result_array();
			$record['app_status']   = $this->config->item('app_status');
			$record['division']   	= $this->config->item('division');
			$record['search_data']  = $this->config->item('app_search');
			$record['data_cnt']     = $this->get_app_data_cnt($status,$recycle);
			return $record;
		}
		public function get_student_data_for_msg_email($rm_id)
		{	
			return $this->db->query("SELECT rm_app_no,rm_parent_mob_no,rm_child_class,rm_child_birth_date,rm_child_surname,rm_child_name,rm_child_father_name,rm_child_mother_name,rm_child_gender,rm_desc_date,rm_child_family_email_id FROM registration_master WHERE rm_id = '$rm_id'")->result_array();
		}
		public function get_confirm_admission_data($app_status,$div)
		{	
			$sub_query = "";
			if ($div != '0') 
			{
				$sub_query .= " AND rm_child_division LIKE '$div%'"; 
			}
			$query = "SELECT rm_app_no,rm_parent_mob_no,rm_child_birth_date,rm_child_surname,rm_child_name,rm_child_father_name,rm_child_mother_name,rm_child_class,rm_child_division,rm_child_gr_no FROM registration_master WHERE rm_app_status = '$app_status' $sub_query ORDER BY rm_child_division,rm_app_no ASC";
			return $this->db->query($query)->result_array();
		}
		public function get_confirm_admission_data_for_xls($app_status,$div)
		{	
			$sub_query = "";
			if ($div != '0') 
			{
				$sub_query .= " AND rm_child_division LIKE '$div%'"; 
			}
			$query = "SELECT rm_app_no,rm_child_aadhar_no,rm_child_class,rm_child_gender,rm_parent_mob_no,rm_child_birth_date,rm_child_surname,rm_child_name,rm_child_father_name,rm_child_mother_name,rm_child_class,rm_child_division,rm_child_gr_no,rm_child_per_add_house_no,rm_child_per_add_town,rm_child_per_add_pin_code FROM registration_master WHERE rm_app_status = '$app_status' $sub_query ORDER BY rm_child_division,rm_app_no ASC";
			// echo "<pre>";print_r($query);exit();
			$data = $this->db->query($query)->result_array();
			$record['excel_array'][0] = array(
                0 =>  'SR NO',
                1 =>  'APP NO',
                2 =>  'STUDENT NAME',
                3 =>  'GR NO',
                4 =>  'BIRTH DATE',
                5 =>  'MOB NO',
                6 =>  'STANDARD',
                7 =>  'DIVISION',
                8 =>  'GENDER',
                9 =>  'ADDRESS',
                10 =>  'TOWN',
                11 =>  'PIN CODE'
            );
			$total = 0;
            $actual_total = 0;  
			foreach ($data as $key => $value) 
	        {
	            /*excel_array*/
	           $record['excel_array'][$key+1][0] = $key+1;
	           $record['excel_array'][$key+1][1] = $value['rm_app_no'];
	           $record['excel_array'][$key+1][2] = $value['rm_child_surname']." ".$value['rm_child_name']." ".$value
	           ['rm_child_father_name'];
	           $record['excel_array'][$key+1][3] = $value['rm_child_gr_no'];
	           $record['excel_array'][$key+1][4] =  date('d-m-Y',strtotime($value['rm_child_birth_date']));
	           $record['excel_array'][$key+1][5] = $value['rm_parent_mob_no'];
	           $record['excel_array'][$key+1][6] = $value['rm_child_class'];
	           $record['excel_array'][$key+1][7] = $value['rm_child_division'];
	           $record['excel_array'][$key+1][8] = $value['rm_child_gender'];
	           $record['excel_array'][$key+1][9] =  $value['rm_child_per_add_house_no'];
	           $record['excel_array'][$key+1][10] = $value['rm_child_per_add_town'];
	           $record['excel_array'][$key+1][11] = $value['rm_child_per_add_pin_code'];
	        }
			// echo "<pre>";print_r($record);exit();
			return $record;
		}
/********************************Get all application data ************************************/
	public function get_all_app_data_cnt()
	{
		$extra = "";
		$order_by = "";
		$date_extra = "";
		if(isset($_GET['search_field']) && isset($_GET['search_keyword'])  && isset($_GET['order']))
		{
			$search_field    = trim($_GET['search_field']);
			$search_keyword  = trim($_GET['search_keyword']);
			$order           = trim($_GET['order']);
			$date 			 = trim($_GET['start_date']);
			$start_date      = date('Y-m-d',strtotime($_GET['start_date']));
			$end_date        = date('Y-m-d',strtotime($_GET['end_date']));
			if(!empty($search_field) && !empty($search_keyword))
			{
				if ($search_field == 'rm_reg_date')
				{
					$extra .= " AND $search_field like '%".date('Y-m-d',strtotime($search_keyword))."%'";
				}
				else if (!empty($search_field) && !empty($search_keyword))
				{
					$extra .= " AND $search_field like '%".$search_keyword."%'";
				}
			}
			if(!empty($order))
			{
				if (!empty($search_field) && ($search_field !='all'))
				{
					$order_by .= "order by $search_field ".$order."";
				}
				else
				{
					$order_by .= "order by rm_app_no ".$order."";
				}
			}
			if(!empty($date))
			{
				$date_extra .= " AND rm_reg_date BETWEEN '$start_date' AND '$end_date'";
			}
		}
		else if (isset($_GET['search_field']) && isset($_GET['order']))
		{
			$order_by .= "order by $search_field ".$order."";
		}
		else
		{
			$order_by .= 'order by rm_app_no DESC';
		}
		$query = "SELECT * FROM registration_master WHERE 1 AND rm_app_status != 3 $date_extra $extra $order_by";
		
		// echo $query;exit;
		return $this->db->query($query)->num_rows();
	}
	public function get_all_app_data($limit, $offset)
	{	
		$extra = "";
		$order_by = "";
		$date_extra = "";
		if(isset($_GET['search_field']) && isset($_GET['search_keyword'])  && isset($_GET['order']))
		{
			$search_field    = trim($_GET['search_field']);
			$search_keyword  = trim($_GET['search_keyword']);
			$order           = trim($_GET['order']);
			$date 			 = $_GET['start_date'];
			$start_date      = date('Y-m-d',strtotime($_GET['start_date']));
			$end_date        = date('Y-m-d',strtotime($_GET['end_date']));
			if(!empty($search_field) && !empty($search_keyword))
			{
				if ($search_field == 'rm_reg_date')
				{
					$extra .= " AND $search_field like '%".date('Y-m-d',strtotime($search_keyword))."%'";
				}
				else if (!empty($search_field) && !empty($search_keyword))
				{
					$extra .= " AND $search_field like '%".$search_keyword."%'";
				}
			}
			if(!empty($order))
			{
				if (!empty($search_field) && ($search_field !='all'))
				{
					$order_by .= "order by $search_field ".$order."";
				}
				else
				{
					$order_by .= "order by rm_app_no ".$order."";
				}
			}
			if(!empty($date))
			{
				$date_extra .= " AND rm_reg_date BETWEEN '$start_date' AND '$end_date'";
			}
		}
		else if (isset($_GET['search_field']) && isset($_GET['order']))
		{
			$order_by .= "order by $search_field ".$order."";
		}
		else
		{
			$order_by .= 'order by rm_app_no DESC';
		}
		$query = "SELECT * from registration_master WHERE 1 AND rm_app_status != 3 $date_extra $extra $order_by LIMIT $offset,$limit";
		
		// echo $query;exit();
		$record['reg_data'] 	= $this->db->query($query)->result_array();
		$record['app_status']   = $this->config->item('app_status');
		$record['search_data']  = $this->config->item('app_search');
		$record['data_cnt']     = $this->get_all_app_data_cnt();
		return $record;
	}
	public function get_app_sms_data($rm_id)
	{
		return $this->db->query("SELECT * FROM message_master WHERE msg_rm_id = '$rm_id'")->result_array();
	}
	public function get_student_app_data($rm_id)
	{
		return $this->db->query("SELECT rm_app_no,rm_parent_mob_no,rm_child_birth_date,rm_child_surname,rm_child_name,rm_child_father_name,rm_child_mother_name,rm_child_gender,rm_desc_date FROM registration_master WHERE rm_id = '$rm_id'")->result_array();
	}
	public function get_payment_record($rm_id)
	{
		return $this->db->query("SELECT pay.*,reg.rm_app_no,reg.rm_child_surname,reg.rm_child_name,reg.rm_child_father_name,reg.rm_child_mother_name FROM registration_payment_master pay LEFT JOIN registration_master reg ON(pay.reg_app_user_id = reg.rm_id) WHERE pay.reg_app_user_id = '$rm_id' AND pay.vpc_trans_resp_code = '0'")->result_array();
	}
	public function get_student_docs_data($rm_id)
	{
		return $this->db->query("SELECT rm_app_no,rm_parent_mob_no,rm_child_birth_date,rm_child_surname,rm_child_name,rm_child_father_name,rm_child_mother_name,rm_child_gender,rm_desc_date,rm_child_photo,rm_child_family_photo,rm_child_birth_certi_photo,rm_child_aadhar_card_photo FROM registration_master WHERE rm_id = '$rm_id'")->result_array();
	}
	
	public function get_parent_mob_no($rm_id)
	{
		return $this->db->query("SELECT rm_app_no,rm_parent_mob_no FROM registration_master WHERE rm_id = '$rm_id'")->result_array();
	}
	public function get_error_msg_data()
	{
		return $this->db->query("SELECT rm_app_no,rm_parent_mob_no FROM registration_master WHERE rm_child_gr_no != ''")->result_array();
	}
/********************************** report query ************************************************************/
	
	public function get_student_data()
	{
		$record = array();
		$extra = "";
		$date_extra = "";
		$report_data = array();
		if(isset($_GET['search_field']))
		{
			$search_field    = trim($_GET['search_field']);
			// $date 			 = $_GET['start_date'];
			// $start_date      = date('Y-m-d',strtotime($_GET['start_date']));
			// $end_date        = date('Y-m-d',strtotime($_GET['end_date']));
			if ($search_field == 10) {
				$extra .= "";
			} else if($search_field == 11) {
				$extra .= " WHERE rm_sibling_flag = 1";
			}
			else {
				$extra .= " WHERE rm_app_status = $search_field";
			}
			
			
			// if(!empty($date))
			// {
			// 	$date_extra .= " AND rm_reg_date BETWEEN '$start_date' AND '$end_date'";
			// }
			$query = "SELECT * from registration_master $extra";
			$regis_data 	= $this->db->query($query)->result_array();
			// echo "<pre>";print_r($regis_data);exit();	
			
			foreach ($regis_data as $key => $value) {
				$id = $value['rm_id'];
				$status = $value['rm_app_status'];
				$get_sms_data = $this->db->query("SELECT msg_content FROM message_master WHERE msg_rm_id = $id AND msg_status = 1 AND msg_app_status = $status order by msg_id DESC LIMIT 1")->result_array();
				if (!empty($get_sms_data)) {
					$msg = $get_sms_data[0]['msg_content'];
				} else {
					$msg = '';
				}
				$report_data[$key]['rm_id'] = $value['rm_id'];
				$report_data[$key]['rm_app_no'] = $value['rm_app_no'];
				$report_data[$key]['rm_reg_date'] = $value['rm_reg_date'];
				$report_data[$key]['rm_child_family_monthly_income'] = $value['rm_child_family_monthly_income'];
				$report_data[$key]['rm_child_name'] = $value['rm_child_name'];
				$report_data[$key]['rm_child_birth_date'] = $value['rm_child_birth_date'];
				$report_data[$key]['rm_parent_mob_no'] = $value['rm_parent_mob_no'];
				$report_data[$key]['rm_child_gender'] = $value['rm_child_gender'];
				$report_data[$key]['rm_child_father_name'] = $value['rm_child_father_name'];
				$report_data[$key]['rm_child_father_last_name'] = $value['rm_child_father_last_name'];
				$report_data[$key]['rm_child_father_qualification'] = $value['rm_child_father_qualification'];
				$report_data[$key]['rm_child_father_occupation'] = $value['rm_child_father_occupation'];
				$report_data[$key]['rm_child_mother_name'] = $value['rm_child_mother_name'];
				$report_data[$key]['rm_child_mother_occupation'] = $value['rm_child_mother_occupation'];
				$report_data[$key]['rm_child_mother_qualification'] = $value['rm_child_mother_qualification'];
				$report_data[$key]['rm_child_guardian_fname'] = $value['rm_child_guardian_fname'];
				$report_data[$key]['rm_child_guardian_lname'] = $value['rm_child_guardian_lname'];
				$report_data[$key]['rm_child_guardian_occupation'] = $value['rm_child_guardian_occupation'];
				$report_data[$key]['rm_app_status'] = $value['rm_app_status'];
				$report_data[$key]['rm_sibling_flag'] = $value['rm_sibling_flag'];
				$report_data[$key]['rm_message'] = $msg;
			}
		}
		$record['app_status']   = $this->config->item('app_status_search');
		$record['reg_data'] 	= $report_data;
		return $record;
	}
	public function get_student_data_xls()
	{
		$record = array();
		$extra = "";
		$date_extra = "";
		if(isset($_GET['search_field']))
		{
			$search_field    = trim($_GET['search_field']);
			// $date 			 = $_GET['start_date'];
			// $start_date      = date('Y-m-d',strtotime($_GET['start_date']));
			// $end_date        = date('Y-m-d',strtotime($_GET['end_date']));
			if ($search_field == 10) {
				$extra .= "";
			} else if($search_field == 11) {
				$extra .= " WHERE rm_sibling_flag = 1";
			}
			else {
				$extra .= " WHERE rm_app_status = $search_field";
			}
			
			
			// if(!empty($date))
			// {
			// 	$date_extra .= " AND rm_reg_date BETWEEN '$start_date' AND '$end_date'";
			// }
			$query = "SELECT * from registration_master $extra";
			$regis_data 	= $this->db->query($query)->result_array();
			$report_data = array();
			foreach ($regis_data as $key => $value) {
				$id = $value['rm_id'];
				$status = $value['rm_app_status'];
				$get_sms_data = $this->db->query("SELECT msg_content FROM message_master WHERE msg_rm_id = $id AND msg_status = 1 AND msg_app_status = $status order by msg_id DESC LIMIT 1")->result_array();
				if (!empty($get_sms_data)) {
					$msg = $get_sms_data[0]['msg_content'];
				} else {
					$msg = '';
				}
				$report_data[$key]['rm_id'] = $value['rm_id'];
				$report_data[$key]['rm_app_no'] = $value['rm_app_no'];
				$report_data[$key]['rm_reg_date'] = $value['rm_reg_date'];
				$report_data[$key]['rm_child_family_monthly_income'] = $value['rm_child_family_monthly_income'];
				$report_data[$key]['rm_child_name'] = $value['rm_child_name'];
				$report_data[$key]['rm_child_birth_date'] = $value['rm_child_birth_date'];
				$report_data[$key]['rm_parent_mob_no'] = $value['rm_parent_mob_no'];
				$report_data[$key]['rm_child_gender'] = $value['rm_child_gender'];
				$report_data[$key]['rm_child_father_name'] = $value['rm_child_father_name'];
				$report_data[$key]['rm_child_father_last_name'] = $value['rm_child_father_last_name'];
				$report_data[$key]['rm_child_father_qualification'] = $value['rm_child_father_qualification'];
				$report_data[$key]['rm_child_father_occupation'] = $value['rm_child_father_occupation'];
				$report_data[$key]['rm_child_mother_name'] = $value['rm_child_mother_name'];
				$report_data[$key]['rm_child_mother_occupation'] = $value['rm_child_mother_occupation'];
				$report_data[$key]['rm_child_mother_qualification'] = $value['rm_child_mother_qualification'];
				$report_data[$key]['rm_child_guardian_fname'] = $value['rm_child_guardian_fname'];
				$report_data[$key]['rm_child_guardian_lname'] = $value['rm_child_guardian_lname'];
				$report_data[$key]['rm_child_guardian_occupation'] = $value['rm_child_guardian_occupation'];
				$report_data[$key]['rm_app_status'] = $value['rm_app_status'];
				$report_data[$key]['rm_sibling_flag'] = $value['rm_sibling_flag'];
				$report_data[$key]['rm_child_per_add_house_no'] = $value['rm_child_per_add_house_no'];
				$report_data[$key]['rm_child_per_add_town'] = $value['rm_child_per_add_town'];
				$report_data[$key]['rm_child_per_add_pin_code'] = $value['rm_child_per_add_pin_code'];
				$report_data[$key]['rm_child_per_add_state'] = $value['rm_child_per_add_state'];
				$report_data[$key]['rm_child_per_add_municipality_ward'] = $value['rm_child_per_add_municipality_ward'];
				$report_data[$key]['rm_message'] = $msg;
			}
			$record['excel_array'][0] = array(
	                0 =>  'APPLICATION NO',
	                1 =>  'DATE OF SUBMISSION',
	                2 =>  'INCOME',
	                3 =>  'CHILD DETAILS',
	                4 =>  'FATHER DETAILS',
	                5 =>  'MOTHER DETAILS',
	               	6 =>  'GUARDIAN DETAILS',
	                7 =>  'ADDRESS',
	                8 =>  'SIBLING',
	                9 =>  'STATUS',
	                10 =>  'MESSAGE'
            );
			foreach ($report_data as $key => $value) 
	    	{
	    		
	    		$child = "NAME : ".$value['rm_child_name'] . "\n" . "DOB : ".date('d-m-Y', strtotime($value['rm_child_birth_date'])). "\n" . "MOB : ".$value['rm_parent_mob_no']. "\n" ."GEN : ".$value['rm_child_gender'];
	    		$father = "NAME : ".$value['rm_child_father_name'] . " ".$value['rm_child_father_last_name'] . "\n" . "QUALI : " . $value['rm_child_father_qualification'] . "\n" . "OCCU : ".$value['rm_child_father_occupation'];
	    		$mother = "NAME : ".$value['rm_child_mother_name'] . " ".$value['rm_child_father_last_name'] . "\n" . "QUALI : ".$value['rm_child_mother_qualification'] . "\n" . "OCCU : ".$value['rm_child_mother_occupation'];
	    		$gaurdian = "NAME : ".$value['rm_child_guardian_fname'] . " ".$value['rm_child_guardian_lname'] . "\n" . "OCCU : ".$value['rm_child_guardian_occupation'];
	    		$address = $value['rm_child_per_add_house_no'].", ".$value['rm_child_per_add_town'].", ".$value['rm_child_per_add_pin_code'].", ".$value['rm_child_per_add_state'].", ".$value['rm_child_per_add_municipality_ward'];
	    		$sibling =  ($value['rm_sibling_flag'] == 1) ? "YES" : "NO";
	    		$status = "";
	    		if ($value['rm_app_status'] == 0) 
                {
                    $status = "PENDING";
                }
                elseif ($value['rm_app_status'] == 1) 
                {
                    $status = "INCOMPLETE APPLICATION";
                }
                elseif ($value['rm_app_status'] == 2) 
                {
                    $status = "PHOTO NOT PROPER";
                }
                elseif ($value['rm_app_status'] == 3) 
                {
                    $status = "PAYMENT NOT DONE";
                }
                elseif ($value['rm_app_status'] == 4) 
                {
                    $status = "APPLICATION PRINT DONE";
                }
                elseif ($value['rm_app_status'] == 5) 
                {
                    $status = "VERIFICATION SCHEDULE";
                }
                elseif ($value['rm_app_status'] == 6) 
                {
                    $status = "APPLICATION REJECTED";
                }
                elseif ($value['rm_app_status'] == 7) 
                {
                    $status = "ADMISSION CONFIRM";
                }
                elseif ($value['rm_app_status'] == 8) 
                {
                    $status = "FEES NOT PAID";
                }
                elseif ($value['rm_app_status'] == 9) 
                {
                    $status = "ABSENT FOR INTERVIEW";
                }
	    		/*excel_array*/
	           	$record['excel_array'][$key+1][0] = $value['rm_app_no'];
	           	$record['excel_array'][$key+1][1] = date('d-m-Y', strtotime($value['rm_reg_date']));
	           	$record['excel_array'][$key+1][2] = $value['rm_child_family_monthly_income'];
	           	$record['excel_array'][$key+1][3] = $child;
	           	$record['excel_array'][$key+1][4] = $father;
	           	$record['excel_array'][$key+1][5] = $mother;
	           	$record['excel_array'][$key+1][6] = $gaurdian;
	           	$record['excel_array'][$key+1][7] = $address;
	           	$record['excel_array'][$key+1][8] = $sibling;
	           	$record['excel_array'][$key+1][9] = $status;
	           	$record['excel_array'][$key+1][10] = $value['rm_message'];
	    	}
		}
		$record['app_status']   = $this->config->item('app_status_search');
		return $record;
	}
	public function get_student_progress_data()
	{
		$record = array();
		$extra = "";
		$date_extra = "";
		if(isset($_GET['search_field']))
		{
			$search_field    = trim($_GET['search_field']);
			// $date 			 = $_GET['start_date'];
			// $start_date      = date('Y-m-d',strtotime($_GET['start_date']));
			// $end_date        = date('Y-m-d',strtotime($_GET['end_date']));
			if ($search_field == 10) {
				$extra .= "";
			} else if($search_field == 11) {
				$extra .= " WHERE rm_sibling_flag = 1";
			}
			else {
				$extra .= " WHERE rm_app_status = $search_field";
			}
			
			
			// if(!empty($date))
			// {
			// 	$date_extra .= " AND rm_reg_date BETWEEN '$start_date' AND '$end_date'";
			// }
			$query = "SELECT * from registration_master $extra";
			$reg_data 	= $this->db->query($query)->result_array();
	        // echo "<pre>";print_r($order_data);exit();
	        foreach ($reg_data as $key => $value) 
	        {   
	            $rm_trans_data = $this->get_app_progress_data($value['rm_id']);
	            $record['app_data'][$key]['data'] = array_merge($value,array('app_progress' =>$rm_trans_data ));
	        }    
		}
		$record['app_status']   = $this->config->item('app_status_search');
		return $record;
	}
	public function get_app_progress_data($rt_id)
    {
        $query = "SELECT * FROM registration_trans WHERE rt_rm_id = $rt_id ORDER BY rt_id DESC";
        return $this->db->query($query)->result_array();
    }
   	public function get_id_card()
    {
    	$extra = "";
		$order_by = "";
		$date_extra = "";
		if(isset($_GET['search_field']) && isset($_GET['search_keyword'])  && isset($_GET['order']))
		{
			$search_field    = trim($_GET['search_field']);
			$search_keyword  = trim($_GET['search_keyword']);
			$order           = trim($_GET['order']);
			$date 			 = $_GET['start_date'];
			$start_date      = date('Y-m-d',strtotime($_GET['start_date']));
			$end_date        = date('Y-m-d',strtotime($_GET['end_date']));
			if(!empty($search_field) && !empty($search_keyword))
			{
				if ($search_field == 'rm_reg_date')
				{
					$extra .= " AND $search_field like '%".date('Y-m-d',strtotime($search_keyword))."%'";
				}
				else if (!empty($search_field) && !empty($search_keyword))
				{
					$extra .= " AND $search_field like '%".$search_keyword."%'";
				}
			}
			if(!empty($order))
			{
				if (!empty($search_field) && ($search_field !='all'))
				{
					$order_by .= "order by $search_field ".$order."";
				}
				else
				{
					$order_by .= "order by rm_app_no ".$order."";
				}
			}
			if(!empty($date))
			{
				$date_extra .= " AND rm_reg_date BETWEEN '$start_date' AND '$end_date'";
			}
		}
		else if (isset($_GET['search_field']) && isset($_GET['order']))
		{
			$order_by .= "order by $search_field ".$order."";
		}
		else
		{
			$order_by .= 'order by rm_app_no DESC';
		}
		
		$query = "SELECT * from registration_master WHERE (rm_app_status = 7) $date_extra $extra $order_by";
    	$id_data = $this->db->query($query)->result_array();
    	// echo "<pre>";print_r($order_data);exit();
    	$record['excel_array'][0] = array(
            0 =>  'CHILD NAME',
            1 =>  'GR NO',
            2 =>  'DIV',
            3 =>  'CLASS',
            4 =>  'DOB',
            5 =>  'CONTACT NO',
            6 =>  'PERMANANT ADDRESS',
            7 =>  'TEMPORARY ADDRESS',
        );
    	foreach ($id_data as $key => $value) 
    	{	
    		$name 	=   $value['rm_child_surname']." ".$value['rm_child_name']." ".$value['rm_child_father_name'];
            $gr_no  = $value['rm_child_gr_no'];
            $div  	= $value['rm_child_division'];
            $class  = $value['rm_child_class'];
            $dob  	= date('d-m-Y',strtotime($value['rm_child_birth_date']));
            $padd  	= $value['rm_child_per_add_house_no'].", ".$value['rm_child_per_add_town'].", ".$value['rm_child_per_add_pin_code'].", ".$value['rm_child_per_add_state'].", ".$value['rm_child_per_add_municipality_ward'];
            $tadd  	= $value['rm_child_temp_add_house_no'].", ".$value['rm_child_temp_add_town'].", ".$value['rm_child_temp_add_pin_code'].", ".$value['rm_child_temp_add_state'];
            $mob = $value['rm_parent_mob_no']."/".$value['rm_child_family_phone_no']."/".$value['rm_child_family_mob_no'];
    		/*excel_array*/
           	$record['excel_array'][$key+1][0] = $name;
           	$record['excel_array'][$key+1][1] = $gr_no;
           	$record['excel_array'][$key+1][2] = $div;
           	$record['excel_array'][$key+1][3] = $class;
           	$record['excel_array'][$key+1][4] = $dob;
           	$record['excel_array'][$key+1][5] = $mob;
           	$record['excel_array'][$key+1][6] = $padd;
           	$record['excel_array'][$key+1][7] = $tadd;
    	}
		return $record;
    }
	}
?>