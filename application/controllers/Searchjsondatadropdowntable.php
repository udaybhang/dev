<?php
/**
 * 
 */
class Searchjsondatadropdowntable extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('crud/Crud_modal');
	}
	public function index()
	{
		$this->load->view('search-json-dropdown-table');
	}
	public function table_json_onchange()
	{
		$vs=$this->input->post('vs');
		$data=$this->Crud_modal->fetch_all();
		print_r($data);
		
	}
}
?>