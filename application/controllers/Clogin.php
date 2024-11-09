<?php
	
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Clogin extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('mlogin');
			$this->load->library('session');
			$this->load->library('form_validation');
			$this->load->library('db_operations');
			$this->load->library('encrypt');
			$this->load->library('email');
		}
		public function generate_token($length)
		{
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $token = substr( str_shuffle( $chars ), 0, $length );
            return $token;
        }
        public function search()
		{
			$this->session->sess_destroy();
			$this->load->view('pages/search_app_status');
		}
		public function registration()
		{
			$user_id = $this->session->userdata('user_id');
			if(empty($user_id))
			{
				$this->load->view('pages/registration');
			}
			else
				redirect(base_url('cmaster'));
		}
		public function index()
		{
			$user_id = $this->session->userdata('user_id');
			if(empty($user_id))
			{
				$this->load->view('pages/login');
			}
			else
				redirect(base_url('cmaster'));
		}
	
		public function login_action()
		{	
            $form_data['user_mob'] 		= $this->input->post('user_mob'); 
            $form_data['dob'] 			= $this->input->post('dob'); 
            $form_data['user_password'] = $this->input->post('user_password');
            $cnt = $this->mlogin->get_cnt('registration_master', array('rm_app_no' => $form_data['user_mob']));
            // echo $cnt;exit();
            if($cnt != 0)
            {
            	$dob_cnt = $this->mlogin->get_dob_cnt($form_data['user_mob'],date('Y-m-d',strtotime($form_data['dob'])));
            	if ($dob_cnt != 0)
            	{
            		$user_data = $this->mlogin->get_user_data($form_data['user_mob'],date('Y-m-d',strtotime($form_data['dob'])));
           		
	            	if(($user_data[0]['rm_app_status'] == 1 || $user_data[0]['rm_app_status'] == 2 || $user_data[0]['rm_app_status'] == 3) && ($user_data[0]['rm_payment_status'] == 0 || $user_data[0]['rm_payment_status'] == 3) )
	            	{
	            		if($user_data[0]['rm_password'] == md5($form_data['user_password']))
	            		{
	            			
	            			$_SESSION['user_id'] = $user_data[0]['rm_id'];
	            			$_SESSION['app_no'] = $user_data[0]['rm_app_no'];
	            			$_SESSION['mob_no'] = $user_data[0]['rm_parent_mob_no'];
	            			
	            			// $session_data = array(
								// 'user_id' 	=> $user_data[0]['rm_id'],
								// 'app_no' 	=> $user_data[0]['rm_app_no'],
								// 'mob_no' 	=> $user_data[0]['rm_parent_mob_no']
							// );
							// $this->session->set_userdata($session_data);
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
	            		echo 4;
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
		
		public function logout(){
			
			$this->session->sess_destroy();
			redirect(base_url('chome/register'));
		}
	public function search_student_application_status()
	{
		$formdata = $this->input->post();
		$par_mob_no = $formdata['rm_parent_mob_no'];
		$child_dob = date('Y-m-d',strtotime($formdata['rm_child_birth_date']));
		$cnt = $this->mlogin->get_cnt('registration_master', array('rm_app_no' => $formdata['rm_parent_mob_no']));
        if($cnt != 0)
        {
        	$dob_cnt = $this->mlogin->get_dob_cnt($formdata['rm_parent_mob_no'],date('Y-m-d',strtotime($formdata['rm_child_birth_date'])));
        	if ($dob_cnt != 0)
        	{
        		$user_data = $this->mlogin->stud_app_search($formdata['rm_parent_mob_no'],date('Y-m-d',strtotime($formdata['rm_child_birth_date'])));
            	if($user_data[0]['rm_password'] == md5($formdata['rm_password']))
            	{
            		$resp['flag'] 	= 1;
					$resp['student_id'] = encrypt_decrypt("encrypt", $user_data[0]['rm_id'], SECRET_KEY);
					echo json_encode($resp);
            	}
        		else
        		{
        			echo 4;               			
        		}
        	}
        	else
        	{
        		echo 3;
        	}	
        }
    	else
    	{
    		echo 2;
    	}
	}
	public function student_search_form($rm_id)
	{
		$reg_id = encrypt_decrypt("decrypt", $rm_id, SECRET_KEY);
		if (!empty($reg_id)) {
            	
	    	$record['student_data'] = $this->db_operations->get_record('registration_master',array('rm_id' => $reg_id));
			$record['sms_data'] = $this->db_operations->get_record('message_master',array('msg_rm_id' => $reg_id,'msg_status' => 1));
			// echo "<pre>";print_r($record);exit;
			$this->load->view('pages/app_serach_result',$record);
        } else {
			$this->load->view('errors/error');
        }	
	}
	}
?>