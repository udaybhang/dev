<?php  
/**
 * 
 */
class A_addremovefield extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		
	}
	
	
	public function commacheckbox()
	{
		$type = $this->input->post('type');
		$name = $this->input->post('mytext');
		$data = array(
        'type' => implode(",", $type),
        'name' => implode(",", $name)

        );

     $insert = $this->db->insert('ckbox', $data);
     if($insert){redirect('A_addremovefield/abc');
     echo "inserted";}
     //return $insert;
		
	}
	public function abc(){
$this->load->view('addremovemultipleinsertbycomma');
}
}
 ?>