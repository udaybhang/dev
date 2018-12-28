<?php 
/**
 * 
 */
class A_fetchfrombothtbl extends CI_controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('B_fetchfrombothtbl');
	}
	public function index()
	{
$data['user']=$this->B_fetchfrombothtbl->fetchfromtwotbl();
$this->load->view('displayfrombothtbl', $data);
	}
}


 ?>
