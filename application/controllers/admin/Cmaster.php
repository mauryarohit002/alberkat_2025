<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cmaster extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/mmaster');
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('pagination');
		$this->config->load('extra');
		$this->load->library('db_operations');
		
	}
	public function send_sms($mob,$msg)
	{
		$url = "http://sms.interlinkconsultant.com/submitsms.jsp?user=ALBARKAT&key=ecdb2a955cXX&mobile=$mob&message=$msg&senderid=ABMIES&accusage=1";
		file_get_contents($url);
	}
	public function send_whatsapp_message($mob,$msg) {
		$output = send_whatsapp_sms($mob,$msg);
		return (isset($output['status']) && $output['status'] == 'success') ? 1 : 0;
	}
	public function search()
	{
		$this->load->view('admin/pages/search_student_app');
	}
	public function student_search_form($rm_id)
	{
		$record['student_data'] = $this->db_operations->get_record('registration_master',array('rm_id' => $rm_id));
		$record['sms_data'] = $this->db_operations->get_record('message_master',array('msg_rm_id' => $rm_id,'msg_status' => 1));
		// echo "<pre>";print_r($record);exit;
		$this->load->view('admin/pages/app_search_result',$record);
	}
	public function index()
	{
		$user_id = $this->session->userdata('user_id');
		// pre($_SESSION);exit;
		if(!empty($user_id))
		{
			$status = '0';
			$config = array();
			$config = $this->config->item('pagination');
			$total 	= $this->mmaster->get_app_data_cnt($status);
			$config['base_url'] = base_url('admin/cmaster/index?search=true');
			foreach ($_GET as $key => $value)
			{
				if ($key != 'search' && $key != 'offset')
				{
					$config['base_url'] .= '&' . $key . '=' . $value;
				}
			}
			$offset = (!empty($_GET['offset']) ? $_GET['offset'] : '0');
			$config['total_rows'] 	= $total;
			$config['per_page'] 	= 50;
			$this->pagination->initialize($config);
			$record = $this->mmaster->get_app_data($config['per_page'], $offset,$status);
			// echo"<pre>";print_r($record);exit;
			$this->load->view('admin/pages/index',$record);
		}
		else
			$this->load->view('admin/pages/login');
	}
/***************************** Common Functions *****************************/
	public function generate_token($length)
	{
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $token = substr( str_shuffle( $chars ), 0, $length );
        return $token;
    }
/***************************** Application Master ********************************/
	public function get_student_data_fr_preview($rm_id)
	{
		$config = array();
		$record['user_data'] 		= $this->db_operations->get_record('registration_master',array('rm_id' => $rm_id));
		$record['siblings_data'] 	= $this->db_operations->get_record('sibling_transection',array('sbltr_rm_id' => $rm_id));
        $record['fee'] 	= $this->db_operations->get_record('std_master',array('std_name' => $record['user_data'][0]['rm_child_class']));
		$record['user_data'][0]['rm_reg_date'] = date('d-m-Y',strtotime($record['user_data'][0]['rm_reg_date']));
		if($record['user_data'][0]['rm_reg_date'] == "01-01-1970") $record['user_data'][0]['rm_reg_date'] = "";
		$record['user_data'][0]['rm_child_birth_date'] = date('d-m-Y',strtotime($record['user_data'][0]['rm_child_birth_date']));
		echo json_encode($record);
	}
	public function print_student_app($rm_id,$without=0)
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$data = array('rm_id' => $rm_id);
			$st = array('sbltr_rm_id' => $rm_id);
			$result['app'] = $this->db_operations->get_record("registration_master",$data);
			$result['fee'] 	= $this->db_operations->get_record('std_master',array('std_name' => $result['app'][0]['rm_child_class']));
			$result['st'] = $this->db_operations->get_record("sibling_transection",$st);
			$result['pay_data'] = $this->mmaster->get_payment_record($rm_id);
			// echo "<pre>";print_r($result);exit();
			if(!empty($result['app']))
			{
			    if($without==1){
			        $this->load->view('admin/pdfs/print_student_application_without_photo',$result);
			    }else{
			    	$this->load->view('admin/pdfs/print_student_application',$result);
			    }
			}
			else
			{
				echo "No print Available";
			}
		}
		else
			$this->load->view('pages/login');
	}
	public function print_teachers_form($rm_id)
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			// echo"teachers print";
			$data = array('rm_id' => $rm_id);
			$st = array('sbltr_rm_id' => $rm_id);
			$result['app'] = $this->db_operations->get_record("registration_master",$data);
			$result['st'] = $this->db_operations->get_record("sibling_transection",$st);
			// echo "<pre>";print_r($result);exit();
			if(!empty($result['app']))
			{
				$this->load->view('admin/pdfs/print_teacher_form',$result);
			}
			else
			{
				echo "No print Available";
			}
		}
		else
			$this->load->view('pages/login');
	}
/********************************* edit student register form ******************************/	
	public function edit_student_reg_form($reg_id)
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			if (!empty($reg_id)) {
	        	$data 	= array('rm_id' => $reg_id);
				$st 	= array('sbltr_rm_id' => $reg_id);
				$record['student_data'] = $this->db_operations->get_record("registration_master",$data);
				$record['st'] 			= $this->db_operations->get_record("sibling_transection",$st);
				// echo "<pre>";print_r($record);exit();
				$this->load->view('admin/pages/registration_edit_form',$record);
            } else {
				$this->load->view('errors/error');
            }
		}
		else{
			redirect('admin/Clogin');
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
			if($img_data['rm_child_mother_photo']['error'] == 0)
			{
				$ext = pathinfo($img_data['rm_child_mother_photo']['name'], PATHINFO_EXTENSION);
				$rm_sd_photo_mother = time().'_'.pathinfo($img_data['rm_child_mother_photo']['name'],PATHINFO_FILENAME);
				$rm_sd_photo_mother = str_replace([" ",'.','-',"'","(",")","&"], "_", $rm_sd_photo_mother).'.'.$ext;
				$config['file_name'] = $rm_sd_photo_mother;
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('rm_child_mother_photo'))
				{
					$rm_sd_photo_mother = "no_image.jpg";
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
				$rm_sd_photo_mother = $formdata['rm_child_mother_photo_path'];
			}
			if($img_data['rm_child_father_photo']['error'] == 0)
			{
				$ext = pathinfo($img_data['rm_child_father_photo']['name'], PATHINFO_EXTENSION);
				$rm_sd_photo_father = time().'_'.pathinfo($img_data['rm_child_father_photo']['name'],PATHINFO_FILENAME);
				$rm_sd_photo_father = str_replace([" ",'.','-',"'","(",")","&"], "_", $rm_sd_photo_father).'.'.$ext;
				$config['file_name'] = $rm_sd_photo_father;
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('rm_child_father_photo'))
				{
					$rm_sd_photo_father = "no_image.jpg";
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
				$rm_sd_photo_father = $formdata['rm_child_father_photo_path'];
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
			
			$reg_master['rm_child_aadhar_no'] 				= strtoupper($formdata['rm_child_aadhar_no']);
			$reg_master['rm_child_class'] 					= strtoupper($formdata['rm_child_class']);
			$reg_master['rm_child_division'] 				= strtoupper($formdata['rm_child_division']);
			$reg_master['rm_child_surname'] 				= strtoupper($formdata['rm_child_surname']);
			$reg_master['rm_child_name'] 					= strtoupper($formdata['rm_child_name']);
			$reg_master['rm_child_father_name'] 			= strtoupper($formdata['rm_child_father_name']);
			$reg_master['rm_child_mother_name'] 			= strtoupper($formdata['rm_child_mother_name']);
			$reg_master['rm_child_gender'] 					= strtoupper($formdata['rm_child_gender']);
			$reg_master['rm_child_birth_date'] 				= date('Y-m-d',strtotime($formdata['rm_child_birth_date']));
			if(!empty($formdata['rm_parent_mob_no'])){
			    $reg_master['rm_parent_mob_no'] 			= $formdata['rm_parent_mob_no'];
			}
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
			$reg_master['rm_child_per_add_municipality_ward'] = strtoupper($formdata['rm_child_per_add_municipality_ward']);
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
			$reg_master['rm_child_father_photo'] 			= $rm_sd_photo_father;
			$reg_master['rm_child_mother_photo'] 			= $rm_sd_photo_mother;
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
			redirect('admin/Clogin');
		}
	}
/********************************* edit student register form ******************************/	
/********************************* Incomplete Application ******************************/
	public function incomplete()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$status = '1';
			$config = array();
			$config = $this->config->item('pagination');
			$total 	= $this->mmaster->get_app_data_cnt($status);
			$config['base_url'] = base_url('admin/cmaster/incomplete?search=true');
			foreach ($_GET as $key => $value)
			{
				if ($key != 'search' && $key != 'offset')
				{
					$config['base_url'] .= '&' . $key . '=' . $value;
				}
			}
			$offset = (!empty($_GET['offset']) ? $_GET['offset'] : '0');
			$config['total_rows'] 	= $total;
			$config['per_page'] 	= 50;
			$this->pagination->initialize($config);
			$record = $this->mmaster->get_app_data($config['per_page'], $offset,$status);
			$this->load->view('admin/pages/app_incomplete',$record);
		}
		else
			$this->load->view('admin/pages/login');
	}
/********************************* Photo Not Proper Application ************************/
	public function photo_not_proper()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$status = '2';
			$config = array();
			$config = $this->config->item('pagination');
			$total 	= $this->mmaster->get_app_data_cnt($status);
			$config['base_url'] = base_url('admin/cmaster/photo_not_proper?search=true');
			foreach ($_GET as $key => $value)
			{
				if ($key != 'search' && $key != 'offset')
				{
					$config['base_url'] .= '&' . $key . '=' . $value;
				}
			}
			$offset = (!empty($_GET['offset']) ? $_GET['offset'] : '0');
			$config['total_rows'] 	= $total;
			$config['per_page'] 	= 50;
			$this->pagination->initialize($config);
			$record = $this->mmaster->get_app_data($config['per_page'], $offset,$status);
			$this->load->view('admin/pages/app_photo_nt_proper',$record);
		}
		else
			$this->load->view('admin/pages/login');
	}
/********************************* Payment Not Done Application ************************/
	public function pay_not_done()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$status = '3';
			$config = array();
			$config = $this->config->item('pagination');
			$total 	= $this->mmaster->get_app_data_cnt($status);
			$config['base_url'] = base_url('admin/cmaster/pay_not_done?search=true');
			foreach ($_GET as $key => $value)
			{
				if ($key != 'search' && $key != 'offset')
				{
					$config['base_url'] .= '&' . $key . '=' . $value;
				}
			}
			$offset = (!empty($_GET['offset']) ? $_GET['offset'] : '0');
			$config['total_rows'] 	= $total;
			$config['per_page'] 	= 50;
			$this->pagination->initialize($config);
			$record = $this->mmaster->get_app_data($config['per_page'], $offset,$status);
			$this->load->view('admin/pages/app_pay_nt_done',$record);
		}
		else
			$this->load->view('admin/pages/login');
	}
/*********************************  recycle bin Application ************************/
	public function recycle_bin()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$status = '3';
			$config = array();
			$config = $this->config->item('pagination');
			$total 	= $this->mmaster->get_app_data_cnt($status,true);
			$config['base_url'] = base_url('admin/cmaster/recycle_bin?search=true');
			foreach ($_GET as $key => $value)
			{
				if ($key != 'search' && $key != 'offset')
				{
					$config['base_url'] .= '&' . $key . '=' . $value;
				}
			}
			$offset = (!empty($_GET['offset']) ? $_GET['offset'] : '0');
			$config['total_rows'] 	= $total;
			$config['per_page'] 	= 50;
			$this->pagination->initialize($config);
			$record = $this->mmaster->get_app_data($config['per_page'], $offset,$status,true);
			$this->load->view('admin/pages/recycle_bin',$record);
		}
		else
			$this->load->view('admin/pages/login');
	}	
/********************************* Print Done Application ******************************/
	public function print_done()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$status = '4';
			$config = array();
			$config = $this->config->item('pagination');
			$total 	= $this->mmaster->get_app_data_cnt($status);
			$config['base_url'] = base_url('admin/cmaster/print_done?search=true');
			foreach ($_GET as $key => $value)
			{
				if ($key != 'search' && $key != 'offset')
				{
					$config['base_url'] .= '&' . $key . '=' . $value;
				}
			}
			$offset = (!empty($_GET['offset']) ? $_GET['offset'] : '0');
			$config['total_rows'] 	= $total;
			$config['per_page'] 	= 50;
			$this->pagination->initialize($config);
			$record = $this->mmaster->get_app_data($config['per_page'], $offset,$status);
			$this->load->view('admin/pages/app_print_done',$record);
		}
		else
			$this->load->view('admin/pages/login');
	}
/********************************* test exam Application ******************************/
	public function test_exam()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$status = '12';
			$config = array();
			$config = $this->config->item('pagination');
			$total 	= $this->mmaster->get_app_data_cnt($status);
			$config['base_url'] = base_url('admin/cmaster/test_exam?search=true');
			foreach ($_GET as $key => $value)
			{
				if ($key != 'search' && $key != 'offset')
				{
					$config['base_url'] .= '&' . $key . '=' . $value;
				}
			}
			$offset = (!empty($_GET['offset']) ? $_GET['offset'] : '0');
			$config['total_rows'] 	= $total;
			$config['per_page'] 	= 50;
			$this->pagination->initialize($config);
			$record = $this->mmaster->get_app_data($config['per_page'], $offset,$status);
			$this->load->view('admin/pages/app_test_exam',$record);
		}
		else
			$this->load->view('admin/pages/login');
	}
/********************************* Interview Schedule Application **********************/
	public function interview_schedule()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$status = '5';
			$config = array();
			$config = $this->config->item('pagination');
			$total 	= $this->mmaster->get_app_data_cnt($status);
			$config['base_url'] = base_url('admin/cmaster/interview_schedule?search=true');
			foreach ($_GET as $key => $value)
			{
				if ($key != 'search' && $key != 'offset')
				{
					$config['base_url'] .= '&' . $key . '=' . $value;
				}
			}
			$offset = (!empty($_GET['offset']) ? $_GET['offset'] : '0');
			$config['total_rows'] 	= $total;
			$config['per_page'] 	= 50;
			$this->pagination->initialize($config);
			$record = $this->mmaster->get_app_data($config['per_page'], $offset,$status);
			$this->load->view('admin/pages/app_interview_schedule',$record);
		}
		else
			$this->load->view('admin/pages/login');
	}
/********************************* Rejected Application ********************************/
	public function rejected()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$status = '6';
			$config = array();
			$config = $this->config->item('pagination');
			$total 	= $this->mmaster->get_app_data_cnt($status);
			$config['base_url'] = base_url('admin/cmaster/rejected?search=true');
			foreach ($_GET as $key => $value)
			{
				if ($key != 'search' && $key != 'offset')
				{
					$config['base_url'] .= '&' . $key . '=' . $value;
				}
			}
			$offset = (!empty($_GET['offset']) ? $_GET['offset'] : '0');
			$config['total_rows'] 	= $total;
			$config['per_page'] 	= 50;
			$this->pagination->initialize($config);
			$record = $this->mmaster->get_app_data($config['per_page'], $offset,$status);
			$this->load->view('admin/pages/app_rejected',$record);
		}
		else
			$this->load->view('admin/pages/login');
	}
/********************************* Confirm Application *********************************/
	public function admission_confirm()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$status = '7';
			$config = array();
			$config = $this->config->item('pagination');
			$total 	= $this->mmaster->get_app_data_cnt($status);
			$config['base_url'] = base_url('admin/cmaster/admission_confirm?search=true');
			foreach ($_GET as $key => $value)
			{
				if ($key != 'search' && $key != 'offset')
				{
					$config['base_url'] .= '&' . $key . '=' . $value;
				}
			}
			$offset = (!empty($_GET['offset']) ? $_GET['offset'] : '0');
			$config['total_rows'] 	= $total;
			$config['per_page'] 	= 50;
			$this->pagination->initialize($config);
			$record = $this->mmaster->get_app_data($config['per_page'], $offset,$status);
			$this->load->view('admin/pages/app_admission_confirm',$record);
		}
		else
			$this->load->view('admin/pages/login');
	}
	public function admission_confirm_print()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$record = array();
			$div = isset($_GET['div'])?$_GET['div'] : 0;
			$status = '7';
			$record['data'] = $this->mmaster->get_confirm_admission_data($status,$div);
			// echo "<pre>";print_r($record);exit();
			$this->load->view('admin/pdfs/admission_confirm_list',$record);
		}
		else
			$this->load->view('admin/pages/login');
	}
	public function admission_confirm_xls()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$record = array();
			$div = isset($_GET['div'])?$_GET['div'] : 0;
			$status = '7';
			$record = $this->mmaster->get_confirm_admission_data_for_xls($status,$div);
			// echo "<pre>";print_r($record);exit();
			$this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->setTitle("NURSERY STUDENT REPORT");
			// echo "<pre>";print_r($record);exit();
			$rowCount = 1;
            foreach ($record['excel_array'] as $key => $data)
            {
                /*SET COLUMN WIDTH AND DATA*/
                foreach(range('A','L') as $key => $columnID)
                {
                    /*set coulumn width*/
                    $this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
                    /*set column data*/
                    $this->excel->getActiveSheet()->SetCellValue($columnID.$rowCount, $data[$key]);
                }
                $rowCount++;
            }
            $filename='nursery_student_data'.date('dMY').'.csv'; //save our workbook as this file name
            header('Content-Type: application/vnd.ms-excel'); //mime type
            header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
            header('Cache-Control: max-age=0'); //no cache
            // Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
            // Write the Excel file to filename some_excel_file.xlsx in the current directory
            $objWriter->save('php://output');
		}
		else
			$this->load->view('admin/pages/login');
	}
/********************************* Fees Not Paid Application ***************************/
	public function fees_not_paid()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$status = '8';
			$config = array();
			$config = $this->config->item('pagination');
			$total 	= $this->mmaster->get_app_data_cnt($status);
			$config['base_url'] = base_url('admin/cmaster/fees_not_paid?search=true');
			foreach ($_GET as $key => $value)
			{
				if ($key != 'search' && $key != 'offset')
				{
					$config['base_url'] .= '&' . $key . '=' . $value;
				}
			}
			$offset = (!empty($_GET['offset']) ? $_GET['offset'] : '0');
			$config['total_rows'] 	= $total;
			$config['per_page'] 	= 50;
			$this->pagination->initialize($config);
			$record = $this->mmaster->get_app_data($config['per_page'], $offset,$status);
			$this->load->view('admin/pages/app_fees_not_paid',$record);
		}
		else
			$this->load->view('admin/pages/login');
	}
/********************************* Sibling Application ***************************/
	public function sibling()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$status = 'sb';
			$config = array();
			$config = $this->config->item('pagination');
			$total 	= $this->mmaster->get_app_data_cnt($status);
			$config['base_url'] = base_url('admin/cmaster/sibling?search=true');
			foreach ($_GET as $key => $value)
			{
				if ($key != 'search' && $key != 'offset')
				{
					$config['base_url'] .= '&' . $key . '=' . $value;
				}
			}
			$offset = (!empty($_GET['offset']) ? $_GET['offset'] : '0');
			$config['total_rows'] 	= $total;
			$config['per_page'] 	= 50;
			$this->pagination->initialize($config);
			$record = $this->mmaster->get_app_data($config['per_page'], $offset,$status);
			$this->load->view('admin/pages/app_sibling',$record);
		}
		else
			$this->load->view('admin/pages/login');
	}
/********************************* All Application ************************************/
	public function all_application()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$config = array();
			$config = $this->config->item('pagination');
			$total 	= $this->mmaster->get_all_app_data_cnt();
			$config['base_url'] = base_url('admin/cmaster/all_application?search=true');
			foreach ($_GET as $key => $value)
			{
				if ($key != 'search' && $key != 'offset')
				{
					$config['base_url'] .= '&' . $key . '=' . $value;
				}
			}
			$offset = (!empty($_GET['offset']) ? $_GET['offset'] : '0');
			$config['total_rows'] 	= $total;
			$config['per_page'] 	= 50;
			$this->pagination->initialize($config);
			$record = $this->mmaster->get_all_app_data($config['per_page'], $offset);
			$this->load->view('admin/pages/all_application',$record);
		}
		else
			$this->load->view('admin/pages/login');
	}
/********************************* Update Form Status **********************************/
	public function update_app_status($rm_id)
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$form_data = $this->input->post();
			if(empty($form_data)){
				echo json_encode(['status'=>FALSE,'data'=>[],'msg'=>"1. Form data is empty."]);
				return;
			}
			
			$dob 		= isset($form_data['birth_date']) ? $form_data['birth_date'] : "";
			$stu_mob_no = isset($form_data['mobile_no']) ? $form_data['mobile_no'] : "";
			// $incomplete_app = str_replace(" ","%20",$form_data['rm_desc']);
			$incomplete_app = $form_data['rm_desc'];
			$link = base_url('/chome/user_login');
			$stud_data = $this->mmaster->get_student_data_for_msg_email($rm_id);
			if(empty($stud_data)){
				echo json_encode(['status'=>FALSE,'data'=>[],'msg'=>"2. Student data not found."]);
				return;
			}
			// echo "<pre>";print_r($stud_data);exit();
			$std_name 	= $stud_data[0]['rm_child_class'];
			$mob 		= $stud_data[0]['rm_parent_mob_no'];
			$app_no 	= $stud_data[0]['rm_app_no'];
			$inter_date = date('d-m-Y',strtotime($stud_data[0]['rm_desc_date']));
			$msg 	= "";
			$whtsapp_msg = "";
			$option = [];
			$data = array();
			if($form_data['rm_app_status'] == 1)
			{
				//incomplete application
				$msg .= "Dear%20Parents,%20Your%20application%20form%20no.%20$app_no%20is%20incomplete%20Note:%20please%20click%20on%20link%20:$link%20and%20log%20on,edit%20application,%20put%20your%20application%20no%20as%20mentioned%20above,%20DOB:$dob,%20password:$stu_mob_no%20and%20complete%20your%20application%20procedure.Best%20Wishes%20ABMMIES";
				$whtsapp_msg .= "Dear Parents, Your application form no. $app_no is incomplete Note: please click on link :$link and log on,edit application, put your application no as mentioned above, DOB:$dob, password:$stu_mob_no and complete your application procedure. Best Wishes ABMMIES";
				$option['message'] = "Dear Parents,<br/> Your application form no. $app_no is incomplete Note: please click on link :$link and log on,edit application, put your application no as mentioned above, DOB:$dob, password:$stu_mob_no and complete your application procedure. Best Wishes ABMMIES 
					<br/><br/> Regard <br/> albarkaat team";
				$option['subject'] = "Incomplete Application";
		
			}
			else if($form_data['rm_app_status'] == 2)
			{
				//photo not proper new
				$msg .= "Dear%20parents,%20Photo%20is%20not%20as%20per%20the%20required%20format,%20please%20update%20the%20photograph.%20Best%20Wishes%20ABMMIES.";
				$whtsapp_msg .= "Dear parents, Photo is not as per the required format, please update the photograph. Best Wishes ABMMIES.";
				$option['message'] = "Dear parents,<br/> Photo is not as per the required format, please update the photograph. Best Wishes ABMMIES. <br/><br/> Regard <br/> albarkaat team";
				$option['subject'] = "Photo Not Proper";
			}
			else if($form_data['rm_app_status'] == 5)
			{
				//interview schedule approved
				$msg .= "Dear%20Parents,%20You%20are%20called%20upon%20in%20Al%20Barkaat%20M.M.I.E.S%20with%20your%20child%20on%20".$form_data['rm_desc_date']."%20".$incomplete_app."%20for%20interaction%20of%20the%20child/verification%20of%20the%20following%20documents%201.Childs%20Birth%20Certificate%20and%20Aadhar%20Card.%202.Parents%20Qualifications%20Certificates.%203.Parents%20Aadhar%20Card.%204.Parents%20Salary%20Slip%20or%20Income%20Proof.5.%20Parents%20should%20also%20carry%20one%20passport%20size%20photo%20of%20the%20child%20(applicant)%20and%20passport%20size%20photograph%20of%20father%20and%20mother%20(only)%20in%20white%20back%20ground.%20Note:%20Parents%20Should%20carry%20all%20original%20documents%20and%20one%20set%20of%20Xerox%20copy.%20NOTE.%20Verification%20of%20documents%20does%20not%20confirm%20the%20admission%20of%20your%20ward.";

				$whtsapp_msg .= "Dear Parents, You are called upon in Al Barkaat M.M.I.E.S with your child on ".$form_data['rm_desc_date']." ".$incomplete_app." for interaction of the child/verification of the following documents \n 1.Childs Birth Certificate and Aadhar Card. \n 2.Parents Qualifications Certificates. \n 3.Parents Aadhar Card. \n 4.Parents Salary Slip or Income Proof. \n 5. Parents should also carry one passport size photo of the child (applicant) and passport size photographs of father and mother (only) in white back ground. \n Note: Parents Should carry all original documents and one set of Xerox copy. \n  NOTE. Verification of documents does not confirm the admission of your ward.\n Best Wishes \n ABMMIES";
				$option['message'] = "Dear Parents,<br/> You are called upon in Al Barkaat M.M.I.E.S with your child on ".$form_data['rm_desc_date']." ".$incomplete_app." for interaction of the child/verification of the following documents. <br/> 1. Childs Birth Certificate and Aadhar Card. <br/>2. Parents Qualifications Certificates. <br/>3. Parents Aadhar Card. <br/> 4. Parents Salary Slip or Income Proof. <br/>5. Parents should also carry one passport size photo of the child (applicant) and passport size photographs of father and mother (only) in white back ground. <br/> Note: Parents Should carry all original documents and one set of Xerox copy. <br/> NOTE. Verification of documents does not confirm the admission of your ward.<br/> Best Wishes ABMMIES <br/><br/> Regard <br/> albarkaat team";
				$option['subject'] = "Verification Schedule";
			}
			else if($form_data['rm_app_status'] == 6)
			{
				//application rejection -approved
				$msg .= "Dear%20Parents,%20Your%20application%20form%20no:%20.".$app_no."%20for%20registration%20of%20".$std_name."%20admission%20is%20rejected%20due%20to%20incomplete/%20incorrect%20particulars/unavailability%20of%20seats.%20Thanking%20you%20ABMMIES.";
				$whtsapp_msg .= "Dear Parents, Your application form no: .".$app_no." for registration of ".$std_name." admission is rejected due to incomplete/ incorrect particulars/unavailability of seats. Thanking you ABMMIES.";
				$option['message'] = "Dear Parents,<br/> Your application form no: .".$app_no." for registration of ".$std_name." admission is rejected due to incomplete/ incorrect particulars/unavailability of seats. Thanking you ABMMIES. <br/><br/> Regard <br/> albarkaat team";
				$option['subject'] = "Application Rejected";
			}
			else if($form_data['rm_app_status'] == 7)
			{
				//admission confirm - approved
				$msg .= "".$incomplete_app."";
			}
			else if($form_data['rm_app_status'] == 9)
			{
				//Absent for interview
				$msg .= "Dear%20Parents,%20Your%20application%20form%20no:%20".$app_no."%20for%20registration%20of%20".$std_name."%20admission%20is%20Rejected%20due%20to%20your%20absentee%20for%20verification%20of%20documents%20even%20after%202nd%20reminder%20Regards%20ABMMIES";
				$whtsapp_msg .= "Dear Parents, Your application form no.: ".$app_no." for registration of ".$std_name." admission is Rejected due to your absentee for verification of documents even after 2nd reminder Regards ABMMIES";
				$option['message'] = "Dear Parents,<br/> Your application form no.: ".$app_no." for registration of ".$std_name." admission is Rejected due to your absentee for verification of documents even after 2nd reminder. Thanking you ABMMIES <br/><br/> Regard <br/> albarkaat team";
				$option['subject'] = "Absent For Interview";
			}
			else if($form_data['rm_app_status'] == 8)
			{
				// echo "hello";
				//Fees not paid
				 $msg .= "Assalamualaikum,%20Respected%20Parents,%20This%20is%20to%20inform%20you%20that%20your%20form%20no:%20".$app_no."%20has%20been%20provisionally%20selected%20for%20".$std_name.".%20To%20confirm%20your%20childs%20admission%20you%20are%20required%20to%20pay%20Rs.58,600/-%20by%20clicking%20on%20the%20link%20https://www.albarkaatadmissions.com/fees2526/chome/nur_fees_payment%20OR%20through%20Demand%20Draft%20in%20favour%20of%20AL-BARKAAT%20MALIK%20MUHAMMAD%20ISLAM%20ENGLISH%20SCHOOL%20(payable%20Mumbai),%20OR%20through%20QR%20Scan%20option%20available%20at%20School%20Fees%20Office%20Timing:%2011.00%20am%20to%202.00%20pm%20on%20working%20days.%20Kindly%20clear%20your%20fees%20".$incomplete_app."%20Thanking%20you%20ABMMIES.";
                 $whtsapp_msg .= "Assalamualaikum, Respected Parents, This is to inform you that your form no: ".$app_no." has been provisionally selected for ".$std_name.". To confirm your childs admission you are required to pay Rs.58,600/- by clicking on the link https://www.albarkaatadmissions.com/fees2526/chome/nur_fees_payment  OR through Demand Draft in favour of AL-BARKAAT MALIK MUHAMMAD ISLAM ENGLISH SCHOOL (payable Mumbai), OR through QR Scan option available at School Fees, Office Timing: 11.00 am to 2.00 pm on working days. Kindly clear your fees ".$incomplete_app." Thanking you ABMMIES.";
                $option['message'] = "Assalamualaikum, Respected Parents,<br/> This is to inform you that your form no: ".$app_no." has been provisionally selected for ".$std_name.". To confirm your childs admission you are required to pay Rs.58,600/- by clicking on the link https://www.albarkaatadmissions.com/fees2526/chome/nur_fees_payment  OR through Demand Draft in favour of AL-BARKAAT MALIK MUHAMMAD ISLAM ENGLISH SCHOOL (payable Mumbai), OR through QR Scan option available at School Fees, Office Timing: 11.00 am to 2.00 pm on working days. Kindly clear your fees ".$incomplete_app." Thanking you ABMMIES. <br/><br/> Regard <br/> albarkaat team";
				$option['subject'] = "Provisional Selection";
				
			}
			// echo $msg;
			// exit();
			$data['rm_app_status'] 		= $form_data['rm_app_status'];
			if(!empty($form_data['rm_desc_date'])){
				$data['rm_desc_date'] 	= date('Y-m-d',strtotime($form_data['rm_desc_date']));
			}else{
				$data['rm_desc_date'] 	= '0000-00-00';
			}
			// echo "<pre>";print_r($form_data);exit();
			$data['rm_desc'] 			= $form_data['rm_desc'];
			$data['rm_update_date'] 	= date('Y-m-d');
			if (isset($form_data['rm_child_division'])) {
				$data['rm_child_division'] 	= $form_data['rm_child_division'];
			}
			if (isset($form_data['rm_child_gr_no'])) {
				$data['rm_child_gr_no'] 	= $form_data['rm_child_gr_no'];
			}
			// echo $mob;exit();
			// echo $msg;exit();
			$rt_data = array();
			$rt_data['rt_rm_id'] = $rm_id;
			$rt_data['rt_rm_status'] = $form_data['rm_app_status'];
			$rt_data['rt_status_date'] = date('Y-m-d');
			$rt_data['rt_status_time'] = date('H:i:s');
			$this->db->trans_begin();
			if($this->db_operations->data_update('registration_master', $data, 'rm_id', $rm_id)<1){
				$this->db->trans_rollback();
				echo json_encode(['status'=>FALSE,'data'=>[],'msg'=>"3. Registration data not updated."]);
				return;
			}
			if($this->db_operations->data_insert('registration_trans', $rt_data)<1){
				$this->db->trans_rollback();
				echo json_encode(['status'=>FALSE,'data'=>[],'msg'=>"4. Registration trans data not updated."]);
				return;
			}
			
			if($form_data['rm_app_status'] == 0 || $form_data['rm_app_status'] == 3 || $form_data['rm_app_status'] == 4)
			{
				if($this->db->trans_status()==FALSE){
					$this->db->trans_rollback();
					echo json_encode(['status'=>FALSE,'data'=>[],'msg'=>"5. Transection Rollback."]);
					return;
				}
				$this->db->trans_commit();
				echo json_encode(['status'=>TRUE,'data'=>[],'msg'=>"6. Registration data update successfully."]);
				return;
			}
			else
			{
				if ($form_data['rm_app_status'] == 8)
				{
					$register_data = $this->db_operations->get_record('registration_master',['rm_id'=> $rm_id]);
					if(empty($register_data)){
						$this->db->trans_rollback();
						echo json_encode(['status' => FALSE, 'data' => [], 'msg' => "7. Registration data not found."]);
						return;
					}
					// pre($register_data);exit;
					$result = $this->add_update_inward($register_data);
					if(!$result['status']){
						$this->db->trans_rollback();
						echo json_encode(['status' => FALSE, 'data' => $result['data'], 'msg' => $result['msg']]);
						return;
					}
					if($this->db_operations->data_update('registration_master', ['rm_student_id' => $result['data']], 'rm_id', $rm_id) < 1){
						$this->db->trans_rollback();
						echo json_encode(['status' => FALSE, 'data' => [], 'msg' => '8. Student id not updated.']);
						return;	
					}				
				}
				
				$msg_content =  str_replace('%20', ' ', $msg);
				$msg_data = array(
					'msg_rm_id' 		=> $rm_id,
					'msg_rm_app_no' 	=> $app_no,
					'msg_parent_mob_no' => $mob,
					'msg_app_status' 	=> $form_data['rm_app_status'],
					'msg_content' 		=> $msg_content,
					'msg_send_date' 	=> date('Y-m-d H:i:s')
				);
				if ($form_data['rm_app_status'] != 7)
				{
					$sms_res = '';
					// this is for the sms
					// $sms_res .= $this->send_sms($mob,$msg);
					// pre($whtsapp_msg);exit;
					//this is for the whatsapp sms
					$sms_res = $this->send_whatsapp_message($mob,$whtsapp_msg);
					if($sms_res == 1)
					{
						$msg_data['msg_status'] = 1;
						if ($this->db_operations->data_insert("message_master",$msg_data)<1)
						{
							$this->db->trans_rollback();
							echo json_encode(['status'=>FALSE,'data'=>[],'msg'=>"9. Message data not inserted."]);
							return;
						}
					}
					if(!empty($stud_data[0]['rm_child_family_email_id'])){
						$option['to'] = $stud_data[0]['rm_child_family_email_id'];
						$mail_output = @send_mail($option);
					}	
				}
				
				if($this->db->trans_status()==FALSE){
					$this->db->trans_rollback();
					echo json_encode(['status'=>FALSE,'data'=>[],'msg'=>"10. Transection Rollback."]);
					return;
				}
				$this->db->trans_commit();
				echo json_encode(['status'=>TRUE,'data'=>[],'msg'=>"11. Registration data update successfully."]);
			}
		}
		else
			$this->load->view('admin/pages/login');
	}
	public function add_update_inward($post_data){
		$url = "https://albarkaatadmissions.com/fees2425/api/student/add_update";
		// echo "<pre>"; print_r($url); exit;
		// Create a new cURL resource
		$init = curl_init($url);
		// $post_data['om_id'] 		= $id;
		// $post_data['om_company_id'] = $company_id;
		// $post_data['pm_company_id'] = $this->constant_company['SOURCE_COMPANY'];
		// $post_data['pm_fin_year'] 	= $_SESSION['fin_year'];
		// Setup request to send json via POST
		$payload = json_encode($post_data);
		
		// Attach encoded JSON string to the POST fields
		curl_setopt($init, CURLOPT_POSTFIELDS, $payload);
		
		// Set the content type to application/json
		curl_setopt($init, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		
		// Return response instead of outputting
		curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
		
		// Execute the POST request
		$result = curl_exec($init);
		$result = json_decode($result, true);
		// Close cURL resource
		curl_close($init);
		// echo"<pre>"; print_r($result);exit;
		return $result;
	}
	public function get_all_application_sms()
	{
		$rm_id = $_GET['id'];
		$result['student_data'] = $this->mmaster->get_student_app_data($rm_id);
		$result['sms_data'] = $this->mmaster->get_app_sms_data($rm_id);
		// echo "<pre>";print_r($result);exit();
		$this->load->view('admin/pages/app_sms_report',$result);
	}
	public function get_all_uploaded_docs()
	{
		$rm_id = $_GET['id'];
		$result['student_data'] = $this->mmaster->get_student_docs_data($rm_id);
		// echo "<pre>";print_r($result);exit();
		$this->load->view('admin/pages/child_docs',$result);
	}
	public function get_single_mob_no($rm_id)
	{
		$result = $this->mmaster->get_parent_mob_no($rm_id);
		echo json_encode($result);
	}
	public function update_mobile_no($rm_id)
	{
		$form_data = $this->input->post();
		$result = $this->db_operations->data_update('registration_master', $form_data, 'rm_id', $rm_id);
		echo $result;
	}
	public function send_custom_sms_to_parent($rm_id)
	{
		$form_data = $this->input->post();
		// $msg = str_replace(" ","%20",$form_data['cust_msg']);
		$msg = $form_data['cust_msg'];
		$app_data = $this->mmaster->get_parent_mob_no($rm_id);
		$mob = $app_data[0]['rm_parent_mob_no'];
		$msg_content =  str_replace('%20', ' ', $msg);
		$msg_data = array(
			'msg_rm_id' 		=> $rm_id,
			'msg_rm_app_no' 	=> $app_data[0]['rm_app_no'],
			'msg_parent_mob_no' => $app_data[0]['rm_parent_mob_no'],
			'msg_app_status' 	=> 100,
			'msg_content' 		=> $msg,
			'msg_send_date' 	=> date('Y-m-d H:i:s')
		);
		// this is for the sms
		// $sms_res = $this->send_sms($mob,$msg);
		//this is for the whatsapp sms
		$sms_res = $this->send_whatsapp_message($mob,$msg);
		if($sms_res == '')
		{
			$result = $this->db_operations->data_insert("message_master",$msg_data);
			if (!empty($result))
			{
				echo 1;
			}
		}
	}
	public function send_error_msg()
	{
		$data = $this->mmaster->get_error_msg_data();
		foreach ($data as $key => $value)
		{
			$mobile = $value['rm_parent_mob_no'];
			// echo "<pre>";print_r($mobile);
		}
	}
/********************************** Report **************************************************/
	public function report()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$record = $this->mmaster->get_student_data();
			// echo "<pre>";print_r($record);exit();
			$this->load->view('admin/pages/student_report',$record);
		}
		else
		{
			redirect('admin/clogin/logout');
		}
	}
	public function report_print()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$record = $this->mmaster->get_student_data();
			// echo "<pre>";print_r($record);exit();
			$this->load->view('admin/pdfs/student_data_pdf',$record);
		}
		else
		{
			redirect('admin/clogin/logout');
		}
	}
	public function report_excel()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$record = $this->mmaster->get_student_data_xls();
			// echo "<pre>";print_r($record);exit();
			$this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->setTitle("STUDENT ADMISSION REPORT");
            $rowCount = 1;
            foreach ($record['excel_array'] as $key => $data)
            {
                /*SET COLUMN WIDTH AND DATA*/
                foreach(range('A','K') as $key => $columnID)
                {
                    /*set coulumn width*/
                    $this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
                    $this->excel->getActiveSheet()->getStyle($columnID)->getAlignment()->setWrapText(true);
                    /*set column data*/
                    $this->excel->getActiveSheet()->SetCellValue($columnID.$rowCount, $data[$key]);
                }
                $rowCount++;
            }
            $filename='student_data_summary'.date('dMY').'.csv'; //save our workbook as this file name
            header('Content-Type: application/vnd.ms-excel'); //mime type
            header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
            header('Cache-Control: max-age=0'); //no cache
            // Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
            // Write the Excel file to filename some_excel_file.xlsx in the current directory
            $objWriter->save('php://output');
		}
		else
		{
			redirect('admin/clogin/logout');
		}
	}
	public function app_progress()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$record = $this->mmaster->get_student_progress_data();
			// echo "<pre>";print_r($record);exit();
			$this->load->view('admin/pages/app_progress_report',$record);
		}
		else
		{
			redirect('admin/clogin/logout');
		}
	}
	public function app_progress_print()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$record = $this->mmaster->get_student_progress_data();
			// echo "<pre>";print_r($record);exit();
			$this->load->view('admin/pdfs/app_progress_pdf',$record);
		}
		else
		{
			redirect('admin/clogin/logout');
		}
	}
	public function id_card_xls()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$record = $this->mmaster->get_id_card();
			// echo "<pre>";print_r($record);exit();
			// echo "<pre>";print_r($record);exit();
			$this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->setTitle("ID CRAD ".$_SESSION['user_id']);
            $rowCount = 1;
            foreach ($record['excel_array'] as $key => $data)
            {
                /*SET COLUMN WIDTH AND DATA*/
                foreach(range('A','H') as $key => $columnID)
                {
                    /*set coulumn width*/
                    $this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
                    /*set column data*/
                    $this->excel->getActiveSheet()->SetCellValue($columnID.$rowCount, $data[$key]);
                }
                $rowCount++;
            }
            $filename='id_card_summary'.date('dMY').'.csv'; //save our workbook as this file name
            header('Content-Type: application/vnd.ms-excel'); //mime type
            header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
            header('Cache-Control: max-age=0'); //no cache
            // Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
            // Write the Excel file to filename some_excel_file.xlsx in the current directory
            $objWriter->save('php://output');
		}
		else
		{
			redirect('admin/clogin/logout');
		}
	}
//contoller end
	}
?>