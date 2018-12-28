<?php
/**
 * 
 */
class Tokenfield extends CI_Controller
{
	
function __construct()
	{
		
		parent:: __construct();
		$this->load->model('crud/Crud_modal');
	}
	public function index()
	{
		$this->load->view('tokenfield');
	}
	public function insertt()
	{
		//echo $_POST['name']; // both echo line same output 
		//echo $this->input->post('name');
		if(isset($_POST['name']))
		{
			$data=array(
                 'name'  => $_POST["name"],
   'skill' => $_POST["skill"]

			);
$result=$this->db->insert('programmer', $data);
			if(isset($result))
 {
  $output = '
  <div class="alert alert-success">
   Your data has been successfully saved into System
  </div>
  ';
 }
 echo $output;
		}
	}
}

?>