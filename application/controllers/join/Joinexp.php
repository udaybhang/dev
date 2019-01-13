<?php   

/**
 * 
 */
class Joinexp extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('crud/Crud_modal');
	}
	public function index()
	{
		$field="j2.deptname, j3.name";
		$table_name="join2 as j2";
		$join1[0]="join3 as j3";
		$join1[1]="j2.id=j3.deptid";
		$join1[2]="left";
		$where="1=1";
		$data['user']=$this->Crud_modal->fetch_data_by_one_table_join($field,$table_name,$join1,$where);
		$this->load->view('join-all', $data);
		print_r($data['user']);
	}
}

?>