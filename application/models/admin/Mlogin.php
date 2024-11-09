<?php
	class Mlogin extends CI_model{
		public function get_cnt($table, $arr){
			$this->db->where($arr);
			return $this->db->count_all_results($table);
		}
		public function get_dob_cnt($mob_no,$dob)
		{
			return $this->db->query("SELECT rm_id,rm_app_no,rm_parent_mob_no,rm_password,rm_acc_edit_status FROM registration_master WHERE rm_parent_mob_no = $mob_no AND rm_child_birth_date = '$dob'")->num_rows();
		}
		public function get_user($email){
			$this->db->where(array('user_name' => $email));
			return $this->db->get('user_master')->result_array();
		}
		public function get_user_data($mob,$dob)
		{
			return $this->db->query("SELECT rm_id,rm_app_no,rm_parent_mob_no,rm_password,rm_acc_edit_status FROM registration_master WHERE rm_parent_mob_no = $mob AND rm_child_birth_date = '$dob'" )->result_array() ;
		}
	}
?>