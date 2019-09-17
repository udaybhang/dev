<?php
/**
 * 
 */

class Session_expire_loader extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('crud/Crud_modal');
	}
	public function login()
	{
		$this->load->view('sign-up');
	}
	public function check_login()

	{
	$email=$this->input->post('email');
	$pass=$this->input->post('password');
	$where="email='$email' and password='$pass'";
	if(empty($email) || empty($pass))
	{
		echo "please enter email or password";
	}
	else{
	
        
		$data=$this->Crud_modal->check_numrow('tbl_login',$where);
		if($data>0)
		{
			// $where="email='$email' and password='$pass'";
           $data=$this->Crud_modal->fetch_single_data('email,password','tbl_login',$where);
           
           // $vemail=
           // echo $vemail;
           $this->session->set_userdata('email',$data['email']);
            // echo $this->session->userdata('email');

         
		}
		else{
			echo "please enter correct email or password";
		}
	}
	}
	public function logout()
	{
		session_start();
$this->session->sess_destroy();
redirect('login');
	}
	public function hello()
	{
		$this->load->view('home');
	}
	public function check_session()
	{
		if($this->session->userdata('email'))
		{
			echo '0';
		}
		else{
			echo "1";
		}
	}
}




?>