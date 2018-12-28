<?php
/**
 * 
 */
class Presentation extends CI_Controller
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('B_presentation');
	}
	
	public function index()
	{
		$data['user']=$this->B_presentation->fetch_mazercities();
	$this->load->view('presentation3', $data);
	}
	public function presentation1()
	{
	$this->load->view('presentation1');
	}
	public function presentation2()
	{
		$this->load->view('presentation2');
	}
	public function presentation3()
	{

  $output = '';
  $query = '';
 
  if($this->input->post('query'))
  {
   $query = $this->input->post('query');
  }
  $data = $this->B_presentation->fetch_data($query);
  
  if($this->input->post('query')!='')
  {
   foreach($data->result() as $row)
   {
    $output .= '
      
    <option  data-value="'.$row->cities.'">'.$row->cities.'</option>';
   }
  }
  else
  {
   $output .= '<span>No Data Found</span> ';
  }
 
   echo $output;

 }
 
	
	public function presentation4()
	{
		$this->load->view('presentation4');
	}
	
	public function presentation5()
	{
		$this->load->view('presentation5');
	}
	public function presentation6()
	{
				$this->load->view('presentation6');

	}
	function presentation7()
	{
				$this->load->view('presentation7');

	}

	function presentation8()
	{
				$this->load->view('presentation8');

	}
	public function custom_date_picker()
	{
		$this->load->view('custom-datepicker');
	}
	
}

?>