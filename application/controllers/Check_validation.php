<?php 
/**
 * 
 */
class Check_validation extends CI_Controller
{
	
	function __construct()
	{
		parent::  __construct();

	}
	public function index()
	{
		$this->load->view('check-validation');
	}
}
 ?>