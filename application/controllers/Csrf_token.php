<?php 
/**
 * 
 */
class Csrf_token extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		//$this->load->library('Auth');
	}
	public function index()
	{
		$data['token']=$this->auth->token();
		$this->load->view('csrf-token-form', $data);
	}
	public function search()
	{
		if($this->input->post('submit') == 'submit')
		{
				echo $this->input->post('search');
				
					if($this->input->post('token') ==  $this->session->userdata('token'))
					{
						echo "hello";
					}
			else
			{
				show_error('Request was invalid. Tokens did not match.', 400);
			}
		}
	}
}
  ?>