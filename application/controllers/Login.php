<?php 

/**
 * 
 */
class Login extends CI_controller
{
	
	function __construct()
	{
		parent:: __construct();
		
	}
	public function index()
	{
		$this->load->view('loginregister/login');
	}
	public function process()
	{
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		if($username=='uday' && $password=='123')
		{
			$this->session->set_userdata(array('username'=>$username));
			$this->load->view('loginregister/welcome');
		}
		else{
			$data['error']='account is invalid';
			$this->load->view('loginregister/login',$data);
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('username');
		redirect('login');
	}
}
 ?>