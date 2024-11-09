<?php
	class Db_operations{

		public $CI="";
		public function __construct(){

			$this->CI =& get_instance();
		}

		function data_insert($table='',$arr=''){

			$this->CI->db->insert($table,$arr);
			return $this->CI->db->insert_id();
		}

		function get_recordlist($table='',$field='',$orderby=''){

			if(!empty($orderby)){

				$this->CI->db->order_by($field,$orderby);
			}

			$tdata = $this->CI->db->get($table);
			return $tdata->result_array();
		}

		function get_record($table='', $condition){

			return $this->CI->db->get_where($table,$condition)->result_array();
		}

		function data_update($table='',$arr='',$field='',$value=''){

			$this->CI->db->where($field,$value);
			return $this->CI->db->update($table,$arr);
		}


		function delete_record($table='',$arr=''){

			return $this->CI->db->delete($table,$arr);
		}

		function get_max_id($table, $field){

			$this->CI->db->select_max($field, 'max_id');
			return $this->CI->db->get($table)->result_array()[0]['max_id'];
		}

		function get_cnt($table, $arr){

			$this->CI->db->where($arr);
			return $this->CI->db->count_all_results($table);
		}

		function empty_table($table){

			return $this->CI->db->empty_table($table); 
		}
		function check_duplicate_name($table='',$db_field='', $form_field='')
		{
			$this->CI->db->where($db_field,$form_field);
			return $this->CI->db->get($table)->result_array();
			// print_r($this->CI->db->get($table)->result_array());
		}
	}
?>