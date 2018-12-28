<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Report_model extends CI_Model {


	public function __construct() {
		parent::__construct(); 
		$this->load->database();
        $this->load->library('session');
	}

	// Fetch records
	public function getData($rowno,$rowperpage,$search="") {
			
		$this->db->select('mm_user_full_name,mm_user_email');
		$this->db->from('user');

		if($search != ''){
        	$this->db->like('mm_user_full_name', $search);
			$this->db->or_like('mm_user_full_name', $search);
        }

        $this->db->limit($rowperpage, $rowno);  
		$query = $this->db->get();
       	
		return $query->result_array();
	}

	// Select total records
    public function getrecordCount($search = '') {

    	$this->db->select('count(mm_uid) as allcount');
      	$this->db->from('user');
      
      	if($search != ''){
       		$this->db->like('mm_user_full_name', $search);
			$this->db->or_like('mm_user_full_name', $search);
      	}

      	$query = $this->db->get();
      	$result = $query->result_array();
      
      	return $result[0]['allcount'];
    }
    // Fetch records
	public function getData1($rowno,$rowperpage,$search="",$fetch_columns,$table,$search_column,$where) {
			
		$this->db->select($fetch_columns);
		$this->db->from($table);

		$where1="";
      	if($search != ''){
       		$where1=$search_column.' like "%'.$search.'%" and ';
      	}
      	$this->db->where($where1.''.$where);  

        $this->db->limit($rowperpage, $rowno);  
		$query = $this->db->get();
       	
		return $query->result_array();
	}

	// Select total records
    public function getrecordCount1($search = '',$count_column,$table,$search_column,$where) {

    	$this->db->select('count('.$count_column.') as allcount');
      	$this->db->from($table);
      	$where1="";
      	if($search != ''){
       		$where1=$search_column.' like "%'.$search.'%" and ';
      	}
      	$this->db->where($where1.''.$where);  
      	$query = $this->db->get();
      	$result = $query->result_array();
      
      	return $result[0]['allcount'];
    }

}