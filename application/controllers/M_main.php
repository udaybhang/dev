<?php
/**
 * 
 */
class M_main extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('M_modal');
	}
	public function index()
	{
		$this->load->view('M_view/M_profile');
	}
	function user_action()
	{
		
			$insert_data=array(
'first_name'=>$this->input->post('first_name'),
'last_name'=>$this->input->post('last_name')
			);
$this->M_modal->insert_crud($insert_data);
echo "data inserted";
		
	}
}
?>