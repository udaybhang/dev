<?php

error_reporting('1');
class Submitmultipleform extends CI_Controller
{
	
	
	function __construct()
	{
		parent:: __construct();
	}
	public function index()
	{
		$this->load->view('submitmultipleform');
	}
	public function multiple_form()
	{
		if( $_POST['submit_a'] ) {
			echo "hello";
}
    else if( $_POST['submit_2'] )
 {
	echo "hie";
}
	}
	public function complex_function()
	{
		 $secondsubmit=$this->input->post('secondsubmit');
		if($secondsubmit == 'Submit')
		{
			 // echo "hello";
			 if($this->input->post('newdate')!='' && $this->input->post('xx')!='' ){
			 	echo "hello date";

			 }
			 else if($this->input->post('xx')!='' || $this->input->post('newdate')!='')
		{
             echo  "hello ".$this->input->post('xx');
		}
		   
		
		}
		else{
			echo "default";
		}
		
$this->load->view('submitmultipleform');

		
						
	}
}


?>