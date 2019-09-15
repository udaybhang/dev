<?php
/**
 * 
 */
class AA_pagination extends CI_Controller
{
	
	function __construct()
	{
	parent:: __construct();
	$this->load->model('BB_pagination');
	}
	public function index()
	{

				$query = $this->db->query('SELECT * FROM city');
		  $count=$query->num_rows(); 

 $num=ceil($count/5);
 $data['pag']=$num;
		$tblname='city';
        $page1=0;
        $perpage=$this->uri->segment(2);
            if($perpage=='' || $perpage=='1')
	        {
 			$page1=0;
 		}
		    else{
		    	$page1=($perpage*5)-5;
 			}
		$data['list']=$this->BB_pagination->fetch_alls($tblname, 'city_id asc', $page1);
		// SELECT * FROM `city` ORDER BY `city_id` asc LIMIT 10, 5
		 $this->load->view('ppagination', $data);
		 }}
  ?>