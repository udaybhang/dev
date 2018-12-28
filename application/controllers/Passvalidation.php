<?php
/**
 * 
 */
class Passvalidation extends CI_controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('crud/Crud_modal');
	}
	public function index()
	{
		$this->load->view('passvalidation');
	}
	public function submit_pass_validation()
	{
		$this->load->view('submit-pass-validation');
	}
	public function dispinview()
	{
                $data['value']=$this->input->post('abc');
		$this->load->view('queri-display-in-view', $data);
	}
	public function display_direct_in_view_ajax()
	{
		$this->load->view('display-direct-in-view-ajax');
	}
	public function ajax_view_query()
	{
		echo $this->input->post('one');
		echo "hi";
	}
}

?>