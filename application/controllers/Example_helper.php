<?php  
/**
 * 
 */
class Example_helper extends CI_Controller
{
	
	function __construct()
	{
	parent:: __construct();
	$this->load->helper('test');
	}
	public function index()
	{
		$data['user']=$userdata=get_list(2);
		
		$this->load->view('example-helper-page', $data);
	}
}

?>