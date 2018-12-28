<?php  
/**
 * 
 */
class Website extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
	}
	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('website/index');
		$this->load->view('template/footer');
		
	}
	public function cource()
	{
		$this->load->view('template/header');
		$this->load->view('website/courses');
		$this->load->view('template/footer');
	}
	public function price()
	{

		$this->load->view('template/header');
		$this->load->view('website/pricing');
		$this->load->view('template/footer');
	}
	public function contact()
	{

		$this->load->view('template/header');
		$this->load->view('website/contact');
		$this->load->view('template/footer');
	}
	public function blog()
	{

		$this->load->view('template/header');
		$this->load->view('website/blog');
		$this->load->view('template/footer');
	}
}


?>