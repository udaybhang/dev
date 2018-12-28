<?php
/**
 * 
 */
class Ajax_table extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('crud/Crud_modal');
	}
	public function index()
	{
		$this->load->view('ajax-table-page');
	}
	public function ajax_display()
	{
		$res=$this->Crud_modal->fetch_all_data('name,salary','tbperson','1=1');
		foreach($res as $row)
		{
   	$rows[]=$row;
            
		}
		echo json_encode($rows);
	}
	public function fetch_data()
	{
		$res=$this->Crud_modal->fetch_all_data('name,salary','tbperson','1=1');
		foreach($res as $row)
		{
   	$rows[]=$row;
            
		}
		echo json_encode($rows);
	}
}
?>