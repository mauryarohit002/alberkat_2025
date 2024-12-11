<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Gallery_cmaster extends CI_Controller {
    	public function __construct(){
    		parent::__construct();
    	
    		$this->load->model('admin/gallery_mmaster','model');
    		$this->load->config('extra');
    		$this->load->library('db_operations');
    		$this->load->library('pagination');
    		$this->load->library('upload');
       	}
       	public function index(){
	       	$user_id = $this->session->userdata('user_id');
			if((!empty($user_id)))
			{
				if(isset($_GET['action']) && $_GET['action'] == 'add'){
					$this->load->view('admin/pages/gallery_form');
				}else if(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id']) && !empty($_GET['id'])){
					$id 		= $_GET['id'];
	                $gallery_id 	= encrypt_decrypt("decrypt", $id, SECRET_KEY);
	                $record = $this->model->get_gallery_data_edit($gallery_id);
                	$this->load->view('admin/pages/gallery_form',$record);
	           	}else{
				    $config = array();
				    $this->config->load('extra');
				    $this->load->library('pagination');
				    $config = $this->config->item('pagination');
				    $config['total_rows'] = $this->model->get_gallery_data(true);
				    $config['base_url'] = base_url("gallery_cmaster?search=true");
				    foreach ($_GET as $key => $value) 
				    {
				    	if($key != 'search' && $key != 'offset')
				    	{
				    		$config['base_url'] .= "&" . $key . "=" .$value;
				    	}
				    }
				    $offset = (!empty($_GET['offset'])) ? $_GET['offset'] : 0;
				    $this->pagination->initialize($config);
				    $record['count'] = $offset;
				    $record['total_rows'] = $config['total_rows'];
				    $record['gallery_data'] = $this->model->get_gallery_data(false,$config['per_page'],$offset);
				    // print_r($record);exit;
				    $this->load->view('admin/pages/gallery_master',$record);
				}
			} 
			else 
			{
				redirect('admin/clogin');
			}
		}
		public function gallery_insert($gallery_id)
	    {
	    	$user_id = $this->session->userdata('user_id');
			if((!empty($user_id)))
			{
	    		$form_data = $this->input->post();
	    		// pre($form_data);exit;
	    		if(empty($form_data)){
	    			echo json_encode(['status'=>FALSE,'data'=>[],'msg'=>'Form data is empty.']);
	    			return;
	    		}
	    		$gallery_image = [];
	    		if(!empty($form_data['gallery_image'])){
	    			foreach($form_data['gallery_image'] as $key=>$value){
	    				array_push($gallery_image,$value);
	    			}
	    		}
	    		
	    		$gallery_array = array();
	    		$gallery_array['gallery_title_name'] 	= trim($form_data['gallery_title_name']);
	    		$gallery_array['gallery_status'] 		= isset($form_data['gallery_status'])?trim($form_data['gallery_status']):1;
	    		$gallery_array['gallery_image'] 		= json_encode($gallery_image);
	    		$gallery_array['gallery_updated_by'] 	= $user_id;			
				
				$this->db->trans_begin();
	    		if($gallery_id == 0) 
				{
					$gallery_array['gallery_created_by'] 	= $user_id;				
					$gallery_array['gallery_created_at'] 	= date('Y-m-d H:i:s');				
					$result = $this->db_operations->data_insert('gallery_master', $gallery_array);
					if($result < 1){
		    			echo json_encode(['status'=>FALSE,'data'=>[],'msg'=>'Gallery data not inserted.']);
		    			return;
		    		}
					$msg = "successfully added.";
				}
				else
				{
					$result = $this->db_operations->data_update('gallery_master', $gallery_array, 'gallery_id', $gallery_id);
					if($result < 1){
		    			echo json_encode(['status'=>FALSE,'data'=>[],'msg'=>'Gallery data not updated.']);
		    			return;
		    		}
					$msg = "successfully updated.";
				}
				if ($this->db->trans_status() === FALSE) {
				    $this->db->trans_rollback();
				    echo json_encode(['status'=>FALSE,'data'=>[],'msg'=>'Transaction rollback.']);
				    return;
				} 
			    $this->db->trans_commit();
				echo json_encode(['status'=>TRUE,'data'=>[],'msg'=>$msg]);
			}
	    	else
	    	{
	    		redirect('admin/clogin');
	    	}
	    }
	    public function add_gallery_images($id){
	    	$files = $_FILES;
	    	if(empty($_FILES)){
	    		echo json_encode(['status'=>FALSE,'data'=>[],'folder_name'=>'','msg'=>'Image data is empty.']);
				return;
	    	}
	    	$gallery_image = [];
            if(!empty($files)){
            	$cnt = count($files['gallery_image']['name']);
            	for($i = 0; $i < $cnt; $i++){
					if($files['gallery_image']['error'][$i] == 0){
						$_FILES['gallery_image']['name']		= $files['gallery_image']['name'][$i];
						$_FILES['gallery_image']['type']		= $files['gallery_image']['type'][$i];
				        $_FILES['gallery_image']['tmp_name']	= $files['gallery_image']['tmp_name'][$i];
				        $_FILES['gallery_image']['error']		= $files['gallery_image']['error'][$i];
				        $_FILES['gallery_image']['size']		= $files['gallery_image']['size'][$i];
						unset($config);
						$config 					= array();
						$config['upload_path'] 		= 'public/uploads/gallery_images';
						$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
				      	$file_name 					= $files['gallery_image']['name'][$i];
				      	if(!file_exists($config['upload_path'])){
				      		mkdir($config['upload_path'], 0777,true);
				      	}
				      	$ext 						= strtolower(substr($file_name, strrpos($file_name, '.') + 1));
				      	$filename 					= "albarkaat_gallery_image_".$i.time().'.'.$ext;
				      	$config['file_name'] 		= $filename;
				      	$this->upload->initialize($config);
				      	if(!$this->upload->do_upload('gallery_image')){
				      		echo json_encode(['status' => FALSE, 'data' => [],'folder_name'=>'', 'msg' => $this->upload->display_errors()]);
				      		return;
				      	}
				      	$imageinfo = $this->upload->data();
						$full_path = $imageinfo['full_path'];
						
						$image_path = base_url('public/uploads/gallery_images/'.$filename);
						array_push($gallery_image,$image_path);
					}
				}
			}		
			echo json_encode(['status' => TRUE, 'data' => $gallery_image, 'msg' => 'Image added successfully.']);
		}
		public function gallery_delete($id)
	    {
	    	$user_id = $this->session->userdata('user_id');
			if((!empty($user_id)))
			{
	    		$gallery_id = encrypt_decrypt("decrypt", $id, SECRET_KEY);
	    		if($this->model->isexist($gallery_id)){
	    			echo json_encode(['status'=>FALSE,'data'=>[],'msg'=>'You can not delete this record! It\'s already exists somewhere.']);
	    			return;
	    		}
	    		$this->db->trans_begin();
	    		$result = $this->db_operations->delete_record('gallery_master', array('gallery_id' => $gallery_id));
	    		if($result < 1){
	    			echo json_encode(['status'=>FALSE,'data'=>[],'msg'=>'Gallery data not deleted.']);
	    			return;
	    		}
	    		if ($this->db->trans_status() === FALSE) {
				    $this->db->trans_rollback();
				    echo json_encode(['status'=>FALSE,'data'=>[],'msg'=>'Transaction rollback.']);
				    return;
				} 
			    $this->db->trans_commit();
				echo json_encode(['status'=>TRUE,'data'=>[],'msg'=>'Gallery data deleted successfully.']);
	    	}
	    	else
	    	{
	    		redirect('admin/clogin');
	    	}
	    }
		public function get_select2($func){
			$json = [];
			$data = $this->model->$func();
			foreach ($data as $key => $value){
				$json[] = ['id'=>$value['id'], 'text'=>$value['name']];
			}
			echo json_encode($json);
		}
	// end controller	
	}
?>