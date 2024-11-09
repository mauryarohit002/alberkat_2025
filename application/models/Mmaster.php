<?php
	class Mmaster extends CI_model{
		public function get_cnt($table, $arr){
			$this->db->where($arr);
			return $this->db->count_all_results($table);
		}
		public function get_user_data($mob)
		{
			return $this->db->query("SELECT rm_id,rm_app_no,rm_parent_mob_no,rm_password FROM registration_master WHERE rm_parent_mob_no = '$mob'" )->result_array() ;
		}
		public function get_max_app_id()
		{
			$record = $this->db->query("SELECT MAX(rm_app_no) as max_no FROM registration_master")->result_array();
			if(empty($record[0]['max_no']))
			{
				return 012425;
			}
			else
			{
				return $record[0]['max_no']+1;
			}
		}
		public function check_duplicate_mob_dob($field1,$field2)
		{
			return $this->db->query("SELECT rm_parent_mob_no,rm_child_birth_date FROM registration_master WHERE rm_parent_mob_no = $field1 AND rm_child_birth_date = '$field2'")->result_array();
		}
		public function get_data_after_reg($id){
			return $this->db->query("
				SELECT rm_app_no,rm_parent_mob_no,rm_child_aadhar_no,rm_child_birth_date
				FROM registration_master
				WHERE rm_id = $id;
				")->result_array();
		}
		public function get_all_app_details(){
			return $this->db->query("SELECT rm.rm_id,rm.rm_app_no,rm.rm_sr_mob,rm.rm_sd_date,rm.rm_fp_income,rm.rm_fp_fr_quli,rm.rm_fp_fr_occu,rm.rm_fp_mr_quli,rm.rm_fp_mr_occu,rm.rm_sd_per_addr_ward,rm.ba_acc_edit_status,rm.ba_admi_status,rm.ba_interview_details,rm.ba_interview_date,rm.ba_app_reg,rm.ba_app_status,rm.rm_stage1,rm.rm_stage2,rm.rm_stage3,rm.rm_stage4,rm.rm_stage5,st.rm_fp_cs_id
					FROM registration_master rm
					LEFT JOIN siblings_transaction st ON(st.rm_fp_cs_rm_id = rm.rm_id)
                    GROUP BY rm.rm_id")->result_array();
		}
		public function get_stud_data($rm_id)
		{
			return $this->db->query("SELECT rm_id,rm_app_no,rm_parent_mob_no,rm_child_birth_date,rm_child_surname,rm_child_name,rm_child_father_name,rm_child_mother_name,rm_child_gender,rm_reg_date FROM registration_master WHERE rm_id = '$rm_id'")->result_array();
		}
		public function update_payment_status($rm_id)
		{
			$rm_tnc_datetime = date('Y-m-d H:i:s');
 			return $this->db->query("UPDATE registration_master SET rm_payment_status = 0 ,rm_app_status = 0,rm_tnc = 1,rm_tnc_datetime = '".$rm_tnc_datetime."' WHERE rm_id = $rm_id");
		}
		public function get_payment_record($rm_id)
		{
			return $this->db->query("SELECT pay.*,reg.rm_app_no,reg.rm_child_surname,reg.rm_child_name,reg.rm_child_father_name,reg.rm_child_mother_name FROM registration_payment_master pay LEFT JOIN registration_master reg ON(pay.reg_app_user_id = reg.rm_id) WHERE pay.reg_app_user_id = '$rm_id' AND pay.vpc_trans_resp_code = '0'")->result_array();
		}
		public function get_gallery_data(){
			$query = "SELECT gallery_title_name, gallery_image FROM gallery_master WHERE gallery_status = 1 ORDER BY gallery_id ";
			$data = $this->db->query($query)->result_array();
			if(!empty($data)){
				foreach($data as $kay=>$value){
                    if(!empty($value['gallery_image'])){
                        $data[$kay]['gallery_image'] = json_decode($value['gallery_image']);
                    }    
                }
			}
			return $data;
		}
	}
?>