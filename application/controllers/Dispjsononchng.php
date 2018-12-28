<?php
/**
 * 
 */
class Dispjsononchng extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('crud/Crud_modal');
	}
	public function index()
	{
		$this->load->view('json-data');
	}
	public function get_employee_json()
	{
if($this->input->post('id')!='')
{
	$id=$this->input->post('id');
	$where="id='$id'";
 $row=$this->Crud_modal->fetch_single_data('*','employee',$where);
 
 
 	$name = $row['name'];
  $address = $row['address'];
  $gender = $row['gender'];
  $designation = $row['designation'];
  $age = $row['age'];
 
 $data=array(
'name'=>$name,'address'=>$address,'gender'=>$gender,'designation'=>$designation,'age'=>$age
 );
 echo json_encode($data);
}

	}
	// new start
	public function table_json()
	{
		$this->load->view('display-table-json');
	}
	public function table_display_json()
	{


	// $id=$this->input->post('id');
	// $where="id='$id'";
 $data=$this->Crud_modal->fetch_alls('employee','id asc');
 
 

 echo json_encode($data);
		
	}
}