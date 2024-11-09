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
		$url = "http://sms.interlinkconsultant.com/submitsms.jsp?user=ALBARKAT&key=ecdb2a955cXX&mobile=$mob&message=$msg&senderid=INFOSM&accusage=1";
		file_get_contents($url);
	}
	public function index()
	{
		$user_id = $this->session->userdata('user_id');
		
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
			$config['per_page'] 	= 10;
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
		$record['user_data'] 		= $this->db_operations->get_record('registration_master',array('rm_id' => $rm_id));
		$record['siblings_data'] 	= $this->db_operations->get_record('sibling_transection',array('sbltr_rm_id' => $rm_id));
		$record['user_data'][0]['rm_reg_date'] = date('d-m-Y',strtotime($record['user_data'][0]['rm_reg_date']));
		if($record['user_data'][0]['rm_reg_date'] == "01-01-1970") $record['user_data'][0]['rm_reg_date'] = "";
		$record['user_data'][0]['rm_child_birth_date'] = date('d-m-Y',strtotime($record['user_data'][0]['rm_child_birth_date']));
		echo json_encode($record);
	}
	public function print_student_app($rm_id)
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$data = array('rm_id' => $rm_id);
			$st = array('sbltr_rm_id' => $rm_id);
			$result['app'] = $this->db_operations->get_record("registration_master",$data);
			$result['st'] = $this->db_operations->get_record("sibling_transection",$st);
			// echo "<pre>";print_r($result);exit();
			if(!empty($result['app']))
			{
				$this->load->view('admin/pdfs/print_student_application',$result);
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
			$config['per_page'] 	= 10;
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
			$config['per_page'] 	= 10;
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
			$config['per_page'] 	= 10;
			$this->pagination->initialize($config);
			$record = $this->mmaster->get_app_data($config['per_page'], $offset,$status);
			$this->load->view('admin/pages/app_pay_nt_done',$record);
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
			$config['per_page'] 	= 10;
			$this->pagination->initialize($config);
			$record = $this->mmaster->get_app_data($config['per_page'], $offset,$status);
			$this->load->view('admin/pages/app_print_done',$record);
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
			$config['per_page'] 	= 10;
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
			$config['per_page'] 	= 10;
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
			$config['per_page'] 	= 10;
			$this->pagination->initialize($config);
			$record = $this->mmaster->get_app_data($config['per_page'], $offset,$status);
			$this->load->view('admin/pages/app_admission_confirm',$record);
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
			$config['per_page'] 	= 10;
			$this->pagination->initialize($config);
			$record = $this->mmaster->get_app_data($config['per_page'], $offset,$status);
			$this->load->view('admin/pages/app_fees_not_paid',$record);
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
			$config['per_page'] 	= 10;
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
			$stud_data = $this->mmaster->get_student_data_for_msg_email($rm_id);
			$mob 		= $stud_data[0]['rm_parent_mob_no'];
			$app_no 	= $stud_data[0]['rm_app_no'];
			$inter_date = date('d-m-Y',strtotime($stud_data[0]['rm_desc_date']));
			$msg 	= "";
			if($form_data['rm_app_status'] == 1)
			{
				//incomplete application
				$msg .= "Dear%20parents,%20your%20application%20form%20no.%20$app_no%20is%20incomplete%20please%20log%20in%20to%20www.albarkaatadmissions.com%20and%22do%20the%20needful.Best%20Wishes%20ABMIES.";
			}
			else if($form_data['rm_app_status'] == 2)
			{
				//photo not proper new
				$msg .= "Dear%20parents,%20Photo%20is%20not%20as%20per%20required%20standerd%20please%20update%20photograph.%20Best%20Wishes%20ABMIES.";
			}
			else if($form_data['rm_app_status'] == 5)
			{
				//interview schedule approved
				$msg .= "Dear%20Parents,%20You%20are%20called%20upon%20in%20Al%20barkaat%20M.M.I.E.S%20with%20your%20child%20on%20.".$form_data['rm_desc_date']."%20at%2003:00%20pm%20for%20verification%20of%20the%20following%20documents%201.Child%20Birth%20Certificate%20and%20Aadhar%20Card.%202.Parents%20Qualifications%20Certificates.%203.Parents%20Aadhar%20Card.%204.Parents%20Salary%20Slip%20or%20Income%20Proof.%20Parents%20Should%20carry%20all%20original%20documents%20and%20one%20set%20of%20Xerox%20copy.%20NOTE.%20Verification%20of%20documents%20does%20not%20confirm%20the%20admission%20of%20your%20ward.";
			}
			else if($form_data['rm_app_status'] == 6)
			{
				//application rejection -approved
				$msg .= "Dear%20Parents,%20Your%20application%20form%20no:%20.$app_no%20for%20registration%20of%20Nursery%20admission%20is%20rejected%20due%20to%20incomplete/%20incorrect%20particulars/unavailability%20of%20seats.%20Thanking%20you%20ABMIES.";
			}
			else if($form_data['rm_app_status'] == 7)
			{
				//admission confirm - approved
				$msg .= "Dear%20parents,%20Your%20form%20no%20.$app_no%20has%20been%20selected.To%20confirm%20your%20Child%20Admission%20for%20Nursery,%20You%20are%20requested%20to%20pay%20Rs.36050/-%20by%20Demand%20Draft%20in%20Favour%20of%20AL%20BARKAAT%20MALIK%20MUHAMMAD%20ISLAM%20ENGLISH%20SCHOOL%20on%20.*%20Timing%20:%2010:30am%20to1:00pm.%20Thanking%20you%20ABMIES.";
			}
			else if($form_data['rm_app_status'] == 9)
			{
				//Absent for interview
				$msg .= "Dear%20Parents,%20Your%20application%20form%20no:.*%20for%20registration%20of%20Nursery%20admission%20is%20Rejected%20due%20to%20your%20absentee%20for%20verification%20of%20documents%20even%20after%202nd%20reminder%20Regards%20ABMIES";
			}
			$data = array();
			$data['rm_app_status'] 		= $form_data['rm_app_status'];
			if(!empty($form_data['rm_desc_date'])){
				$data['rm_desc_date'] 	= date('Y-m-d',strtotime($form_data['rm_desc_date']));
			}else{
				$data['rm_desc_date'] 	= '0000-00-00';
			}
			$data['rm_desc'] 			= $form_data['rm_desc'];
			$data['rm_update_date'] 			= date('Y-m-d');
			$this->db->trans_start();
			$result = $this->db_operations->data_update('registration_master', $data, 'rm_id', $rm_id);;
			if($this->db->trans_complete() == 1)
			{
				if($form_data['rm_app_status'] == 0 || $form_data['rm_app_status'] == 3 || $form_data['rm_app_status'] == 4 || $form_data['rm_app_status'] == 8)
				{
					echo 1;
				}
				else
				{
					$msg_content =  str_replace('%20', ' ', $msg);
					$msg_data = array(
						'msg_rm_id' 		=> $rm_id,
						'msg_rm_app_no' 	=> $app_no,
						'msg_parent_mob_no' => $mob,
						'msg_app_status' 	=> $form_data['rm_app_status'],
						'msg_content' 		=> $msg_content,
						'msg_send_date' 	=> date('Y-m-d H:i:s')
					);
					$sms_res = $this->send_sms($mob,$msg);
					// echo $sms_res;exit;
					if($sms_res == '')
					{
						$result = $this->db_operations->data_insert("message_master",$msg_data);
						if (!empty($result))
						{
							echo 1;
						}
					}
				}
			}
		}
		else
			$this->load->view('admin/pages/login');
	}
	public function get_all_application_sms()
	{
		$rm_id = $_GET['id'];
		$result['student_data'] = $this->mmaster->get_student_app_data($rm_id);
		$result['sms_data'] = $this->mmaster->get_app_sms_data($rm_id);
		// echo "<pre>";print_r($result);exit();
		$this->load->view('admin/pages/app_sms_report',$result);
	}
//contoller end
	}
?>