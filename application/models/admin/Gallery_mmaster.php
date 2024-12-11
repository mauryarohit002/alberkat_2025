<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Gallery_mmaster extends CI_Model
{
    function __construct(){
        parent::__construct();
        
        $this->term = "gallery";
        $this->master = "gallery_master";
    }
    /********* core function ******/
        public function isexist($id){
            // $data = $this->db->query("SELECT qns_id FROM qns_master WHERE qns_stage_id = $id")->result_array();
            // if(!empty($data))return TRUE;
            return FALSE;
        }
        public function get_gallery_data($wantCount, $per_page = 20, $offset = 0){
            $record     = [];
            $subsql     = '';
            $limit      = '';
            $ofset      = '';
            
            if(!$wantCount){
                $limit .= " LIMIT $per_page";
                $ofset .= " OFFSET $offset";
            }
            if(isset($_GET['_title_name']) && !empty($_GET['_title_name'])){
                $subsql .=" AND ".$this->term.".".$this->term."_title_name = '".$_GET['_title_name']."'";
                $record['search']['_title_name']['value'] = $_GET['_title_name'];
                $record['search']['_title_name']['text'] = $_GET['_title_name'];
            }
            if(isset($_GET['_status']) && !empty($_GET['_status'])){
                $subsql .=" AND ".$this->term.".".$this->term."_status = '".$_GET['_status']."'";
                $record['search']['_status']['value'] = $_GET['_status'];
                $record['search']['_status']['text'] = $_GET['_status'];
            }
            
            $query ="
                    SELECT ".$this->term.".*
                    FROM ".$this->master." ".$this->term."
                    WHERE 1
                    $subsql
                    ORDER BY ".$this->term."_id DESC
                    $limit
                    $ofset
                ";
            // echo "<pre>"; print_r($query); exit;
            if($wantCount){
                return $this->db->query($query)->num_rows();
            }
            $record['data'] = $this->db->query($query)->result_array();
            if(!empty($record['data'])){
                foreach($record['data'] as $key => $value){
                    $record['data'][$key]['isexist'] = $this->isexist($value[$this->term.'_id']);
                }
            }
            return $record;
        }
        public function get_gallery_data_edit($id){
            $query ="
                    SELECT ".$this->term.".*
                    FROM ".$this->master." ".$this->term."
                    WHERE ".$this->term.".".$this->term."_id = $id
                    ORDER BY ".$this->term."_id DESC
                ";
            $record['data'] = $this->db->query($query)->result_array();
            if(!empty($record['data'])){
                foreach($record['data'] as $kay=>$value){
                    if(!empty($value['gallery_image'])){
                        $record['data'][$kay]['gallery_image'] = json_decode($value['gallery_image']);
                    }    
                }
            }
            // pre($record);exit;
            return $record;
        }
    /********* core function ******/
    /********* search function ******/
        public function _title_name(){
            $subsql = "";
            $limit  = PER_PAGE;
            $offset = OFFSET;
            $page   = 1;
            // echo "<pre>"; print_r($_GET); exit;
            if(isset($_GET['limit']) && !empty($_GET['limit'])){
                $limit = $_GET['limit'];
            }
            if(isset($_GET['page']) && !empty($_GET['page'])){
                $page   = $_GET['page'];
                $offset = $limit * ($page - 1);
            }
            if(isset($_GET['name']) && !empty($_GET['name'])){
                $name   = $_GET['name'];
                $subsql .= " AND (".$this->term.".".$this->term."_title_name LIKE '".$name."%' ) ";
            }
            $query="SELECT ".$this->term.".".$this->term."_title_name as id, upper(".$this->term.".".$this->term."_title_name) as name
                    FROM ".$this->master." ".$this->term."
                    WHERE 1
                    $subsql
                    GROUP BY ".$this->term.".".$this->term."_title_name
                    ORDER BY ".$this->term.".".$this->term."_title_name ASC
                    LIMIT $limit
                    OFFSET $offset";
            // echo $query; exit();
            return $this->db->query($query)->result_array();
        }
    /********* search function ******/
//end model
}
?>