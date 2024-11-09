<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Clogin extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('admin/mlogin');
			$this->load->library('session');
			$this->load->library('form_validation');
			$this->load->library('db_operations');
			$this->load->helper('cookie');
		}
		public function index()
		{
			$this->load->view('admin/pages/login');
		}
		public function admin_login_action()
		{
            $form_data['user_name'] = $this->input->post('user_name');
            $form_data['user_password'] = $this->input->post('user_password');
            // echo "<pre>";print_r($form_data);exit;
                $cnt = $this->mlogin->get_cnt('user_master', array('user_name' => $form_data['user_name']));
                if($cnt != 0)
                {
                	$record = $this->mlogin->get_user($form_data['user_name']);
                	// if($record[0]['user_status'] == 1)
                	// {
                		// echo"111";exit;
                		if($record[0]['user_password'] == md5($form_data['user_password']))
	            		{
	            			// echo 111;exit;
	            			$session_data = array(
								'user_id' => $record[0]['user_id'],
								'user_role_id' => $record[0]['user_role_id'],
								'user_name' => $record[0]['user_name'],
								'user_full_name' => $record[0]['user_full_name']
							);
							$this->session->set_userdata($session_data);
							$arr = array(
									'user_ip' => $_SERVER["REMOTE_ADDR"]
								);
							$record = $this->db_operations->data_update("user_master", $arr, 'user_id', $record[0]['user_id']);
							if(!empty($record))
							{
								echo 1;
							}
							else
							{
							    echo 0;
							}
	            		}
	            		else
	            		{
	            			echo 2;
	            		}
                	// }
                	// else
                	// {
                	// 	echo 3;
                	// }
                }
            	else
            	{
            		echo 3;
            	}
		}
		public function logout(){
			$arr = array(
				'user_log_status' => 0,
				'user_ip' => $_SERVER["REMOTE_ADDR"]
			);
			$user_id = $this->session->userdata('user_id');
			$this->db_operations->data_update("user_master", $arr, 'user_id', $user_id);
			$this->session->sess_destroy();
			redirect(base_url('/admin'));
		}
		public function check_session_status(){
			echo get_cookie('session_user_id');
			// echo "string";
		}
		public function user_login()
		{
			$this->load->view('admin/pages/user_login');
		}
		public function login_action()
		{
            $form_data['user_mob'] 		= $this->input->post('user_mob');
            $form_data['dob'] 			= $this->input->post('dob');
            $form_data['user_password'] = $this->input->post('user_password');
            $cnt = $this->mlogin->get_cnt('registration_master', array('rm_parent_mob_no' => $form_data['user_mob']));
            // echo $cnt;exit();
            if($cnt != 0)
            {
            	$dob_cnt = $this->mlogin->get_dob_cnt($form_data['user_mob'],date('Y-m-d',strtotime($form_data['dob'])));
            	if ($dob_cnt != 0)
            	{
            		$user_data = $this->mlogin->get_user_data($form_data['user_mob'],date('Y-m-d',strtotime($form_data['dob'])));
	            	if($user_data[0]['rm_password'] == md5($form_data['user_password']))
            		{
            			$session_data = array(
							'user_id' 	=> $user_data[0]['rm_id'],
							'app_no' 	=> $user_data[0]['rm_app_no'],
							'mob_no' 	=> $user_data[0]['rm_parent_mob_no']
						);
						$this->session->set_userdata($session_data);
						$resp['flag'] 	= 1;
						$resp['rm_id'] 	= encrypt_decrypt("encrypt", $user_data[0]['rm_id'], SECRET_KEY);
						echo json_encode($resp);
            		}
            		else
            		{
            			echo 2;
            		}
            	}
            	else
            	{
            		echo 5;
            	}
            }
        	else
        	{
        		echo 3;
        	}
		}
	}
?>