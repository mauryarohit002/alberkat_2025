<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Chome extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->library('db_operations');
			$this->load->library('upload');
			$this->load->model('mmaster');
			$this->load->library('pagination');
			$this->load->library('mypdf_class');
		}
		public function contact_us()
		{
			$this->load->view('pages/contact_us');
		}
		public function about_us()
		{
			$this->load->view('pages/about_us');
		}
		public function gallery()
		{
			$record['data'] = $this->mmaster->get_gallery_data();
			$this->load->view('pages/gallery',$record);
		}
		public function privacy_policy()
		{
			$this->load->view('pages/privacy_policy');
		}
		public function refund_policy()
		{
			$this->load->view('pages/refund_policy');
		}
		public function index()
		{
			$this->load->view('pages/index');
		}
		public function user_login()
		{
			$this->load->view('pages/user_login');
		}
		public function register()
		{
			// echo "<pre>";print_r($_SESSION);exit();
			$this->load->view('pages/registration');
		}
		public function register_admin()// this function is called from backend admin pannel that's Y the user authentication is must important;
		{
			$user_id = $this->session->userdata('user_id');
			if(!empty($user_id))
			{
				$this->load->view('pages/admin_registration');
			}
			else{
				redirect(base_url('/admin/'));	
			}
		}
		public function admin()
		{
			$this->load->view('pages/admin_login');
		}
		public function stud_registration()
		{
			$this->load->view('pages/stud_registration_step1');
		}
		public function logout()
		{
			$this->session->sess_destroy();
			redirect(base_url('chome/user_login'));
		}
		public function forget_password()
		{
			$this->load->view('pages/forget_password');
		}
		public function criteria()
		{
			$this->load->view('pages/criteria');
		}
		public function send_forget_password()
		{
			$formdata = $this->input->post();
			$parent_mob_no = $formdata['rm_parent_mob_no'];
			$cnt = $this->mmaster->get_cnt('registration_master', array('rm_parent_mob_no' => $parent_mob_no));
			if ($cnt != 0) {
				$user_data = $this->mmaster->get_user_data($parent_mob_no);
				$resp = array();
				$resp['id'] 	= $user_data[0]['rm_id'];
				$resp['flag'] 	= 1;
				echo json_encode($resp);
			}else {
				echo 2;
			}
		}
		public function update_password($rm_id)
		{
			$formdata = $this->input->post();
			$reg_master['rm_password'] 	= md5($formdata['rm_password']);
			$this->db->trans_start();
			$result = $this->db_operations->data_update("registration_master",$reg_master,'rm_id',$rm_id);
			$trans_complete = $this->db->trans_complete();
			if(($result == 1) && ($trans_complete == 1))
			{
				echo 1;
			}
			else
			{
				echo 2;
			}
		}
		public function send_otp($mob,$otp)
		{   
		    
 			$data = $this->db_operations->get_record('registration_master',['rm_parent_mob_no'=>$mob]);
 			
 			$message  = "Dear Parents, *".$otp."* is the OTP for verification. OTPs are SECRET. DO NOT disclose it to anyone. \n\n Regard \nalbarkaat team";
        	
 			if(!empty($mob)){
    			$output = send_whatsapp_sms($mob,$message);
			}
            if(!empty($data) && !empty($data[0]['rm_child_family_email_id'])){
	            $option = [];
				$option['message'] = "Dear Parents,<br/> This <b>".$otp."</b> is the OTP for verification. OTPs are SECRET. DO NOT disclose it to anyone. <br/><br/> Regard <br/> albarkaat team";
				$option['to'] = $data[0]['rm_child_family_email_id'];
				$option['subject'] = " OTP verification";
				$mail_output = @send_mail($option);
			}else{$mail_output['status'] = false;}	
            return (isset($output['status']) && $output['status'])?1:(($mail_output['status'])?1:0);
		}
		public function send_sms($mob,$msg)
        {   
            $msg =  urlencode($msg);
           	// $url = "http://sms.interlinkconsultant.com/submitsms.jsp?user=ALBARKAT&key=ecdb2a955cXX&mobile=$mob&message=$msg&senderid=ALRTSM&accusage=1";
            file_get_contents($url);
           	
        }
        public function send_captcha_on_whatsapp($mob,$msg){
            $form_data = $this->input->post();
            // pre($form_data);exit;
        	$message  = "Dear Parents, *".$msg."* is the OTP for your phone number verification. OTPs are SECRET. DO NOT disclose it to anyone.\n\n Regard \nalbarkaat team";
        	
        	if(!empty($mob)){
    			$output = send_whatsapp_sms($mob,$message);
			}
        	if(!empty($form_data['family_email_id'])){
    			$option = [];
    			$option['message'] = "Dear Parents,<br/> This <b>".$msg."</b> is the OTP for your Email ID verification. OTPs are SECRET. DO NOT disclose it to anyone. <br/><br/> Regard <br/> albarkaat team";
    			$option['to'] = $form_data['family_email_id'];
    			$option['subject'] = " OTP verification";
    
    			$mail_output = @send_mail($option);
			}
			// pre($output,$mail_output);exit;
			return (isset($output['status']) && $output['status'])?1:(($mail_output['status'])?1:0);
        }
		public function add_update_student_registration()
		{   
			$formdata 	= $this->input->post();
		    
			$rm_sr_mob 	= $formdata['rm_parent_mob_no'];
			$rm_sd_dob 	= date('Y-m-d',strtotime($formdata['rm_child_birth_date']));
			$record 	= $this->mmaster->check_duplicate_mob_dob($rm_sr_mob,$rm_sd_dob);
			$reg_master =	array();
			$rm_app_no 	= 	$this->mmaster->get_max_app_id();
			$reg_master['rm_app_no'] 			= $rm_app_no;
			$reg_master['rm_parent_mob_no'] 	= $formdata['rm_parent_mob_no'];
			$reg_master['rm_child_family_email_id'] = $formdata['rm_child_family_email_id'];
			if(isset($formdata['rm_child_aadhar_no']))
			{
			    $reg_master['rm_child_aadhar_no'] 	= $formdata['rm_child_aadhar_no'];
			}
			else
			{
			    $reg_master['rm_child_aadhar_no'] 	= '';
			}
			$reg_master['rm_child_birth_date'] 	= date('Y-m-d',strtotime($formdata['rm_child_birth_date']));
			if(date('m') > 7){
				$startNur = strtotime(date('01-10-Y',strtotime('-3 years')));
				$endNur = strtotime(date('31-12-Y',strtotime('-2 years')));
				$startJrkg = strtotime(date('01-10-Y',strtotime('-4 years')));
				$endJrkg = strtotime(date('30-9-Y',strtotime('-3 years')));
				$startSrkg = strtotime(date('01-10-Y',strtotime('-5 years')));
				$endSrkg = strtotime(date('30-9-Y',strtotime('-4 years')));
			}else{
				$startNur = strtotime(date('01-10-Y',strtotime('-4 years')));
				$endNur = strtotime(date('31-12-Y',strtotime('-3 years')));
				$startJrkg = strtotime(date('01-10-Y',strtotime('-5 years')));
				$endJrkg = strtotime(date('30-9-Y',strtotime('-4 years')));
				$startSrkg = strtotime(date('01-10-Y',strtotime('-6 years')));
				$endSrkg = strtotime(date('30-9-Y',strtotime('-5 years')));
			}
			if( strtotime($reg_master['rm_child_birth_date']) >= $startNur && strtotime($reg_master['rm_child_birth_date']) <= $endNur ){
				$reg_master['rm_child_class'] 		= NURSERY;
			}elseif ( strtotime($reg_master['rm_child_birth_date']) >= $startJrkg && strtotime($reg_master['rm_child_birth_date']) <= $endJrkg ) {
				$reg_master['rm_child_class'] 		= JRKG;
			}elseif ( strtotime($reg_master['rm_child_birth_date']) >= $startSrkg && strtotime($reg_master['rm_child_birth_date']) <= $endSrkg ) {
				$reg_master['rm_child_class'] 		= SRKG;
			}else{
				echo 5;//dob out of year range for preprimary admission;
				return;
			}	
			// echo 5;//admission closed that's y this written here;
			// return;
				
			$reg_master['rm_password'] 			= md5($formdata['rm_password']);
			$reg_master['rm_reg_date'] 			= date('Y-m-d');
			$reg_master['rm_update_date'] 		= date('Y-m-d');
			// pre($reg_master);exit;
			$this->db->trans_start();
			$result = $this->db_operations->data_insert("registration_master",$reg_master);
			if(!empty($result))
			{
				$user_data = $this->mmaster->get_data_after_reg($result);
				$_SESSION['user_id'] 	=  $result;
				$_SESSION['app_no'] 	=  $user_data[0]['rm_app_no'];
				$_SESSION['mob_no'] 	=  $user_data[0]['rm_parent_mob_no'];
				$_SESSION['aadhar_no'] 	=  $user_data[0]['rm_child_aadhar_no'];
				$_SESSION['dob'] 		=  $user_data[0]['rm_child_birth_date'];
				// $session_data = array(
				// 		'user_id' 	=> $result,
				// 		'app_no' 	=> $user_data[0]['rm_app_no'],
				// 		'mob_no' 	=> $user_data[0]['rm_parent_mob_no'],
				// 		'aadhar_no' => $user_data[0]['rm_child_aadhar_no'],
				// 		'dob' 		=> $user_data[0]['rm_child_birth_date']
				// 	);
				// $this->session->set_userdata($session_data);
				if ($this->db->trans_complete() == 1)
				{
					$resp['flag'] 	= 1 ;
					$resp['reg_id'] = encrypt_decrypt("encrypt", $result, SECRET_KEY);
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
		public function student_reg_form($id)
		{
			// echo "<pre>";print_r($_SESSION);
			// exit();
			$reg_id = encrypt_decrypt("decrypt", $id, SECRET_KEY);
			// echo "<pre>";print_r($reg_id);
			// exit();
            
			$user_id = $this->session->userdata('user_id');
			if(!empty($user_id))
			{
				if (!empty($reg_id)) {
            	$data 	= array('rm_id' => $reg_id);
				$st 	= array('sbltr_rm_id' => $reg_id);
				$record['student_data'] = $this->db_operations->get_record("registration_master",$data);
				$record['st'] 			= $this->db_operations->get_record("sibling_transection",$st);
				// echo "<pre>";print_r($record);exit();
				$this->load->view('pages/stud_registration_step1',$record);
	            } else {
					$this->load->view('errors/error');
	            }
			}
			else{
				redirect('clogin/logout');
			}
		}
		public function update_student_data($rm_id)
		{
			$formdata = $this->input->post();
			$img_data = $_FILES;
			$user_id = $this->session->userdata('user_id');
			if(!empty($user_id))
			{
				$config['upload_path'] 		= 'public/uploads/product/';
				$config['allowed_types'] 	= 'jpg|jpeg|png|pdf';
				// $config['max_size']	= '300';
				// $config['max_width']  = '300';
				// $config['max_height']  = '300';
				$this->upload->initialize($config);
				if($img_data['rm_child_photo']['error'] == 0)
				{
					$ext = pathinfo($img_data['rm_child_photo']['name'], PATHINFO_EXTENSION);
					$rm_sd_photo_child = time().'_'.pathinfo($img_data['rm_child_photo']['name'],PATHINFO_FILENAME);
					$rm_sd_photo_child = str_replace([" ",'.','-',"'","(",")","&"], "_", $rm_sd_photo_child).'.'.$ext;
					$config['file_name'] = $rm_sd_photo_child;
					// var_dump($this->upload->initialize($config));exit;
					$this->upload->initialize($config);
					// print_r($config);exit;
					if (!$this->upload->do_upload('rm_child_photo'))
					{
						$error = array('error' => $this->upload->display_errors());
						$rm_sd_photo_child = "no_image.jpg";
					}
					else
					{
						$full_path = $this->upload->data('full_path');
						$config_thumb['image_library'] 	= 'gd2';
						$config_thumb['source_image'] 	= $full_path;
						$config_thumb['maintain_ratio'] 	= TRUE;
						$config_thumb['width']         	= 120;
						$config_thumb['height']       	= 180;
						$this->load->library('image_lib');
						$this->image_lib->initialize($config_thumb);
						$this->image_lib->resize();
						$this->image_lib->clear();
					}
				}
				else
				{
					$rm_sd_photo_child = $formdata['rm_child_photo_path'];
				}
				if($img_data['rm_child_family_photo']['error'] == 0)
				{
					$ext = pathinfo($img_data['rm_child_family_photo']['name'], PATHINFO_EXTENSION);
					$rm_sd_photo_family = time().'_'.pathinfo($img_data['rm_child_family_photo']['name'],PATHINFO_FILENAME);
					$rm_sd_photo_family = str_replace([" ",'.','-',"'","(",")","&"], "_", $rm_sd_photo_family).'.'.$ext;
					$config['file_name'] = $rm_sd_photo_family;
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('rm_child_family_photo'))
					{
						$rm_sd_photo_family = "no_image.jpg";
					}
					else
					{
						$full_path = $this->upload->data('full_path');
						$config_thumb['image_library'] 	= 'gd2';
						$config_thumb['source_image'] 	= $full_path;
						$config_thumb['maintain_ratio'] 	= TRUE;
						$config_thumb['width']         	= 120;
						$config_thumb['height']       	= 180;
						$this->load->library('image_lib');
						$this->image_lib->initialize($config_thumb);
						$this->image_lib->resize();
						$this->image_lib->clear();
					}
				}
				else
				{
					$rm_sd_photo_family = $formdata['rm_child_family_photo_path'];
				}
				if($img_data['rm_child_birth_certi_photo']['error'] == 0)
				{
					$ext = pathinfo($img_data['rm_child_birth_certi_photo']['name'], PATHINFO_EXTENSION);
					$rm_sd_photo_birth_cert = time().'_'.pathinfo($img_data['rm_child_birth_certi_photo']['name'],PATHINFO_FILENAME);
					$rm_sd_photo_birth_cert = str_replace([" ",'.','-',"'","(",")","&"], "_", $rm_sd_photo_birth_cert).'.'.$ext;
					$config['file_name'] = $rm_sd_photo_birth_cert;
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('rm_child_birth_certi_photo')){
						$rm_sd_photo_birth_cert = "no_image.jpg";
					}
					else
					{
						$full_path = $this->upload->data('full_path');
						$config_thumb['image_library'] 	= 'gd2';
						$config_thumb['source_image'] 	= $full_path;
						$config_thumb['maintain_ratio'] 	= TRUE;
						$config_thumb['width']         	= 120;
						$config_thumb['height']       	= 180;
						$this->load->library('image_lib');
						$this->image_lib->initialize($config_thumb);
						$this->image_lib->resize();
						$this->image_lib->clear();
					}
				}
				else
				{
					$rm_sd_photo_birth_cert = $formdata['birth_certi_path'];
				}
				if($img_data['rm_child_aadhar_card_photo']['error'] == 0)
				{
					$ext = pathinfo($img_data['rm_child_aadhar_card_photo']['name'], PATHINFO_EXTENSION);
					$rm_sd_photo_aadhar = time().'_'.pathinfo($img_data['rm_child_aadhar_card_photo']['name'],PATHINFO_FILENAME);
					$rm_sd_photo_aadhar = str_replace([" ",'.','-',"'","(",")","&"], "_", $rm_sd_photo_aadhar).'.'.$ext;
					$config['file_name'] = $rm_sd_photo_aadhar;
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('rm_child_aadhar_card_photo')){
						$rm_sd_photo_aadhar = "no_image.jpg";
					}
					else
					{
						$full_path = $this->upload->data('full_path');
						$config_thumb['image_library'] 	= 'gd2';
						$config_thumb['source_image'] 	= $full_path;
						$config_thumb['maintain_ratio'] 	= TRUE;
						$config_thumb['width']         	= 120;
						$config_thumb['height']       	= 180;
						$this->load->library('image_lib');
						$this->image_lib->initialize($config_thumb);
						$this->image_lib->resize();
						$this->image_lib->clear();
					}
				}
				else
				{
					$rm_sd_photo_aadhar = $formdata['aadhar_certi_path'];
				}
				$reg_master =array();
				// $reg_master['rm_reg_date'] 						= date('Y-m-d',strtotime($formdata['rm_reg_date']));
				// $reg_master['rm_child_aadhar_no'] 				= strtoupper($formdata['rm_child_aadhar_no']);
				$reg_master['rm_child_surname'] 				= strtoupper($formdata['rm_child_surname']);
				$reg_master['rm_child_name'] 					= strtoupper($formdata['rm_child_name']);
				$reg_master['rm_child_father_name'] 			= strtoupper($formdata['rm_child_father_name']);
				$reg_master['rm_child_mother_name'] 			= strtoupper($formdata['rm_child_mother_name']);
				$reg_master['rm_child_gender'] 					= strtoupper($formdata['rm_child_gender']);
				// $reg_master['rm_child_birth_date'] 				= date('Y-m-d',strtotime($formdata['rm_child_birth_date']));
				$reg_master['rm_child_birth_town'] 				= strtoupper($formdata['rm_child_birth_town']);
				$reg_master['rm_child_birth_state'] 			= strtoupper($formdata['rm_child_birth_state']);
				$reg_master['rm_child_nationality'] 			= strtoupper($formdata['rm_child_nationality']);
				$reg_master['rm_child_religion'] 				= strtoupper($formdata['rm_child_religion']);
				$reg_master['rm_child_community'] 				= strtoupper($formdata['rm_child_community']);
				$reg_master['rm_child_mother_tongue'] 			= strtoupper($formdata['rm_child_mother_tongue']);
				$reg_master['rm_child_per_add_house_no'] 		= strtoupper($formdata['rm_child_per_add_house_no']);
				$reg_master['rm_child_per_add_town'] 			= strtoupper($formdata['rm_child_per_add_town']);
				$reg_master['rm_child_per_add_pin_code'] 		= strtoupper($formdata['rm_child_per_add_pin_code']);
				$reg_master['rm_child_per_add_state'] 			= strtoupper($formdata['rm_child_per_add_state']);
				$reg_master['rm_child_per_add_municipality_ward'] 	= strtoupper($formdata['rm_child_per_add_municipality_ward']);
				$reg_master['rm_child_temp_add_house_no'] 		= strtoupper($formdata['rm_child_temp_add_house_no']);
				$reg_master['rm_child_temp_add_town'] 			= strtoupper($formdata['rm_child_temp_add_town']);
				$reg_master['rm_child_temp_add_pin_code'] 		= strtoupper($formdata['rm_child_temp_add_pin_code']);
				$reg_master['rm_child_temp_add_state'] 			= strtoupper($formdata['rm_child_temp_add_state']);
				$reg_master['rm_child_lng_spkn_at_home_1'] 		= strtoupper($formdata['rm_child_lng_spkn_at_home_1']);
				$reg_master['rm_child_lng_spkn_at_home_2'] 		= strtoupper($formdata['rm_child_lng_spkn_at_home_2']);
				$reg_master['rm_child_lng_spkn_at_home_3'] 		= strtoupper($formdata['rm_child_lng_spkn_at_home_3']);
				$reg_master['rm_child_pre_school_attend'] 		= strtoupper($formdata['rm_child_pre_school_attend']);
				if (isset($formdata['rm_child_pre_school_name']))
				{
					$reg_master['rm_child_pre_school_name'] 		= strtoupper($formdata['rm_child_pre_school_name']);
				}
				$reg_master['rm_child_photo'] 					= $rm_sd_photo_child;
				$reg_master['rm_child_family_photo'] 			= $rm_sd_photo_family;
				$reg_master['rm_child_birth_certi_photo'] 		= $rm_sd_photo_birth_cert;
				$reg_master['rm_child_aadhar_card_photo'] 		= $rm_sd_photo_aadhar;
				$reg_master['rm_child_father_middle_name'] 		= strtoupper($formdata['rm_child_father_middle_name']);
				$reg_master['rm_child_father_last_name'] 		= strtoupper($formdata['rm_child_father_last_name']);
				$reg_master['rm_child_father_age'] 				= strtoupper($formdata['rm_child_father_age']);
				$reg_master['rm_child_father_qualification'] 		= strtoupper($formdata['rm_child_father_qualification']);
				$reg_master['rm_child_father_occupation'] 			= strtoupper($formdata['rm_child_father_occupation']);
				// $reg_master['rm_child_father_designation'] 			= strtoupper($formdata['rm_child_father_designation']);
				$reg_master['rm_child_mother_full_name'] 			= strtoupper($formdata['rm_child_mother_full_name']);
				$reg_master['rm_child_mother_qualification'] 		= strtoupper($formdata['rm_child_mother_qualification']);
				$reg_master['rm_child_mother_occupation'] 			= strtoupper($formdata['rm_child_mother_occupation']);
				$reg_master['rm_child_family_office_add'] 			= strtoupper($formdata['rm_child_family_office_add']);
				$reg_master['rm_child_family_office_add_city'] 		= strtoupper($formdata['rm_child_family_office_add_city']);
				$reg_master['rm_child_family_office_add_pin_code'] 	= strtoupper($formdata['rm_child_family_office_add_pin_code']);
				$reg_master['rm_child_family_office_add_state'] 	= strtoupper($formdata['rm_child_family_office_add_state']);
				$reg_master['rm_child_family_phone_no'] 			= strtoupper($formdata['rm_child_family_phone_no']);
				$reg_master['rm_child_family_mob_no'] 				= strtoupper($formdata['rm_child_family_mob_no']);
				// $reg_master['rm_child_family_fax_no'] 				= strtoupper($formdata['rm_child_family_fax_no']);
				$reg_master['rm_child_family_email_id'] 			= strtoupper($formdata['rm_child_family_email_id']);
				$reg_master['rm_child_family_monthly_income'] 		= strtoupper($formdata['rm_child_family_monthly_income']);
				$reg_master['rm_child_guardian_fname'] 				= strtoupper($formdata['rm_child_guardian_fname']);
				$reg_master['rm_child_guardian_mname'] 				= strtoupper($formdata['rm_child_guardian_mname']);
				$reg_master['rm_child_guardian_lname'] 				= strtoupper($formdata['rm_child_guardian_lname']);
				$reg_master['rm_child_guardian_relationship'] 		= strtoupper($formdata['rm_child_guardian_relationship']);
				$reg_master['rm_child_guardian_age'] 				= strtoupper($formdata['rm_child_guardian_age']);
				$reg_master['rm_child_guardian_occupation'] 		= strtoupper($formdata['rm_child_guardian_occupation']);
				$reg_master['rm_child_guardian_designation'] 		= strtoupper($formdata['rm_child_guardian_designation']);
				$reg_master['rm_child_guardian_office_add'] 		= strtoupper($formdata['rm_child_guardian_office_add']);
				$reg_master['rm_child_guardian_office_add_city'] 	= strtoupper($formdata['rm_child_guardian_office_add_city']);
				$reg_master['rm_child_guardian_office_add_pin_code'] = strtoupper($formdata['rm_child_guardian_office_add_pin_code']);
				$reg_master['rm_child_guardian_office_add_state'] 	= strtoupper($formdata['rm_child_guardian_office_add_state']);
				$reg_master['rm_child_guardian_phone_no'] 			= strtoupper($formdata['rm_child_guardian_phone_no']);
				$reg_master['rm_child_guardian_mobile_no'] 			= strtoupper($formdata['rm_child_guardian_mobile_no']);
				$reg_master['rm_child_guardian_fax_no'] 			= strtoupper($formdata['rm_child_guardian_fax_no']);
				$reg_master['rm_child_guardian_email_id'] 			= strtoupper($formdata['rm_child_guardian_email_id']);
				$reg_master['rm_child_guardian_monthly_income'] 	= strtoupper($formdata['rm_child_guardian_monthly_income']);
				$reg_master['rm_child_guardian_mother_tongue'] 		= strtoupper($formdata['rm_child_guardian_mother_tongue']);
				if (isset($formdata['sbltr_sbl_name']))
				{
					$reg_master['rm_sibling_flag'] 	= 1;
				}
				else
				{
					$reg_master['rm_sibling_flag'] 	= 0;
				}
				$reg_master['rm_update_date'] 			= date('Y-m-d');
				$this->db->trans_start();
				$result = $this->db_operations->data_update("registration_master",$reg_master,'rm_id',$rm_id);
				if(!empty($result) && isset($formdata['sbltr_sbl_name']))
				{
					$this->db_operations->delete_record('sibling_transection',array('sbltr_rm_id' => $rm_id));
					foreach ($formdata['sbltr_sbl_name'] as $key => $value)
					{
						$siblings_trans = array();
						$siblings_trans['sbltr_rm_id'] 		= $rm_id;
						$siblings_trans['sbltr_sbl_name'] 	= strtoupper($value);
						$siblings_trans['sbltr_school'] 	= strtoupper($formdata['sbltr_school'][$key]);
						$siblings_trans['sbltr_gr_no'] 		= strtoupper($formdata['sbltr_gr_no'][$key]);
						$siblings_trans['sbltr_sbl_std']	= strtoupper($formdata['sbltr_sbl_std'][$key]);
						$siblings_trans['sbltr_sbl_div']	= strtoupper($formdata['sbltr_sbl_div'][$key]);
						$siblings_trans['sbltr_sbl_roll_no'] =strtoupper($formdata['sbltr_sbl_roll_no'][$key]);
						$sib_trans = $this->db_operations->data_insert("sibling_transection",$siblings_trans);
					}
				}
				
				$trans_complete = $this->db->trans_complete();
				if(!empty($result) && ($trans_complete == 1))
				{
					echo 1;
				}
				else
				{
					echo 2;
				}
			}
			else
			{
				redirect('clogin/logout');
			}
		}
		public function print_application($rm_id)
		{
			$user_id = $this->session->userdata('user_id');
			if(!empty($user_id))
			{
				$data 	= array('rm_id' => $rm_id);
				$st 	= array('sbltr_rm_id' => $rm_id);
				$result['app'] 		= $this->db_operations->get_record("registration_master",$data);
				$result['st'] 		= $this->db_operations->get_record("sibling_transection",$st);
				$result['pay_data'] = $this->mmaster->get_payment_record($rm_id);
				$result['fee'] 	= $this->db_operations->get_record('std_master',array('std_name' => $result['app'][0]['rm_child_class']));
				if(!empty($result['app']))
				{
					$this->load->view('pdfs/print_application',$result);
				}
				else
				{
					$this->load->view('pdfs/empty_data');
				}
			}
			else{
				redirect('clogin/logout');
			}
		}
		public function get_stud_all_data($rm_id)
		{
			$user_id = $this->session->userdata('user_id');
			if(!empty($user_id))
			{
				$record['user_data'] = $this->db_operations->get_record('registration_master',array('rm_id' => $rm_id));
				$record['fee'] 	= $this->db_operations->get_record('std_master',array('std_name' => $record['user_data'][0]['rm_child_class']));
				$record['siblings_data'] = $this->db_operations->get_record('sibling_transection',array('sbltr_rm_id' => $rm_id));
				$record['user_data'][0]['rm_reg_date'] 	= date('d-m-Y',strtotime($record['user_data'][0]['rm_reg_date']));
				if($record['user_data'][0]['rm_reg_date'] == "01-01-1970") $record['user_data'][0]['rm_reg_date'] = "";
				$record['user_data'][0]['rm_child_birth_date'] = date('d-m-Y',strtotime($record['user_data'][0]['rm_child_birth_date']));
				echo json_encode($record);
			}
			else{
				redirect('clogin/logout');
			}
		}
		public function final_submission($rm_id)
		{
			// echo 1;
			$user_id = $this->session->userdata('user_id');
			$mob = $this->session->userdata('mob_no');
			$app_no = $this->session->userdata('app_no');
			if(!empty($user_id))
			{
				$result = $this->db_operations->data_update("registration_master",array('rm_acc_edit_status' => 0),'rm_id',$rm_id);
				if(!empty($result))
				{
					$msg = "Dear%20parents,%20Your%20application%20is%20successfully%20submited.%20Your%20online%20application%20form%20no.%20is%20$app_no.%20Best%20Wishes%20ABMIES";
	 				// print_r($msg);exit;
	 				$this->send_sms($mob,$msg);
	 				echo $result;
				}
			}
			else{
				redirect('clogin/logout');
			}
		}
		public function payment_form($id,$appno)
		{
			$arr['params'] = array(
				'mer_acc_code'	=> MERCHANT_ACCESS_CODE,
				'mer_trans_ref'	=> 'AL-Barkaat Malik Mohammad Islam English',
				'mer_id' 		=> MERCHANT_ID,
				'order_no'		=> $appno,
				'reg_amt' 		=> '100500'
			);
			$this->load->view('paygateway/pay_order_form',$arr);
		}
		public function pay_form_action()
		{
			// $form_data = $this->input->post();
			// echo "<pre>";print_r($form_data);exit;
			$this->load->view('paygateway/pay_order_do');
		}
		public function recp_return_url()
		{
			//$user_id = $this->session->userdata('user_id');
			$user_id = $_SESSION['user_id'];
            
			$student_data = $this->mmaster->get_stud_data($user_id);
			$barappno 	= $student_data[0]['rm_app_no'];
			$birth_date = $student_data[0]['rm_child_birth_date'];
			$reg_date 	= $student_data[0]['rm_reg_date'];
			$b_date 	= preg_replace("/-/", "", $birth_date);
			$r_date 	= preg_replace("/-/", "", $reg_date);
			$barcode 	= $barappno.$b_date.$r_date;
			$student_name = $student_data[0]['rm_child_surname']." ".$student_data[0]['rm_child_name']." ".$student_data[0]['rm_child_father_name'];
			$resp_data = array(
				'reg_app_user_id' 						=> $user_id,
				'mer_id' 								=> $_GET['vpc_Merchant'],
				'order_info' 							=> $_GET['vpc_OrderInfo'],
				'child_full_name'		 				=> $student_name,
				'trans_amt' 							=> substr($_GET['vpc_Amount'], 0, -2),
				'vpc_trans_resp_code'	 				=> $_GET['vpc_TxnResponseCode'],
				'message' 								=> $_GET['vpc_Message'],
				'trans_number' 							=> $_GET['vpc_TransactionNo'],
				'card_type' 							=> isset($_GET['vpc_Card']) ? $_GET['vpc_Card'] : "",
				'unique_3ds_trans_identifier_xid' 		=> isset($_GET['vpc_3DSXID']) ? $_GET['vpc_3DSXID'] : "",
				'unique_barcode' 						=> $barcode,
				'cdate' 								=> date('Y-m-d H:i:s'),
				'payment_date' 							=> date('Y-m-d')
			);
			$this->db->trans_start();
			$result = $this->db_operations->data_insert("registration_payment_master",$resp_data);
			$rm_data = array();
			if ($resp_data['message'] == "Approved")
			{
				$rm_data['rm_payment_date'] = date('Y-m-d');
				$pay_result = $this->db_operations->data_update('registration_master', $rm_data, 'rm_id', $user_id);
			}
			$this->db->trans_complete();
			//route used
			// $this->load->view('paygateway/pay_order_dr');
			redirect(base_url()."chome/success_page/".$_GET['vpc_TxnResponseCode'],"refresh");
			// $this->load->view('paygateway/pay_error',$arr_resp);
		}
		public function success_page($resp)
		{
			$user_id = $this->session->userdata('user_id');
			$student_data = $this->mmaster->get_stud_data($user_id);
			$barappno 		= $student_data[0]['rm_app_no'];
			$birth_date 	= $student_data[0]['rm_child_birth_date'];
			$reg_date 	= $student_data[0]['rm_reg_date'];
			$b_date = preg_replace("/-/", "", $birth_date);
			$r_date = preg_replace("/-/", "", $reg_date);
			$barcode = $barappno.$b_date.$r_date;
			$student_name = $student_data[0]['rm_child_surname']." ".$student_data[0]['rm_child_name']." ".$student_data[0]['rm_child_father_name'];
			if ($resp == '0')
			{
				$res = $this->mmaster->update_payment_status($user_id);
				$this->online_application_form($student_data[0]['rm_id']);
			}
			$arr_resp = array(
					'respcode' 			=> $resp,
					'user_id'	 		=> $user_id,
					'app_no' 			=> $student_data[0]['rm_app_no'],
					'child_name' 		=> $student_name,
					'barcode' 			=> $barcode,
				);
			$this->load->view('paygateway/pay_error',$arr_resp);
		}
		public function online_application_form($rm_id)
		{
			$user_id = $this->session->userdata('user_id');
			if(!empty($user_id))
			{
				$data 	= array('rm_id' => $rm_id);
				$st 	= array('sbltr_rm_id' => $rm_id);
				$result['app'] 	= $this->db_operations->get_record("registration_master",$data);
				$result['st'] 	= $this->db_operations->get_record("sibling_transection",$st);
				$result['fee'] 	= $this->db_operations->get_record('std_master',array('std_name' => $result['app'][0]['rm_child_class']));
				// pre($result);exit;
				if(!empty($result['app']))
				{
					$this->load->view('pdfs/online_application_form',$result);
					$mob = $result['app'][0]['rm_parent_mob_no'];
					$file_name = "application form number ".$result['app'][0]['rm_app_no'];
					$file_path = base_url("public/uploads/pdf/application_form_".$result['app'][0]['rm_app_no'].".pdf");
					$msg = "Dear parent, please find below attachment of online application form ";
					if(!empty($mob)){
						$output = send_whatsapp_pdf_attachment($mob,$msg,$file_path,$file_name);
					}
					if(!empty($result['app']) && !empty($result['app'][0]['rm_child_family_email_id'])){
			            $option = [];
						$option['message'] = "Dear Parents,<br/> please find below attachment of online application form <br/><br/> Regard <br/> albarkaat team";
						$option['to'] = $data[0]['rm_child_family_email_id'];
						$option['subject'] = " Application form number".$result['app'][0]['rm_app_no'];
						$option['attachment'] = $file_path;
						$mail_output = @send_mail($option);
					}
				}
			}
			else{
				redirect('clogin/logout');
			}
		}
		//chome controller ends
	}
?>