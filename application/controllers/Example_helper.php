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
		$data['user']=$userdata=get_list(2); //number i.e 1,2,3....
		//SELECT * FROM `user` WHERE `id` = 2
		$this->load->view('example-helper-page', $data);
	}
}

?>