<?php  
class A_addremovefield extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		
	}
	
	
	public function commacheckbox()
	{
		$type = $this->input->post('type'); // return array
		
		$name = $this->input->post('mytext');
		$data = array(
        'type' => implode(",", $type),
        'name' => implode(",", $name)

        );
        // $data=>Array ( [type] => type1,type2 [name] => udaybhan )
        
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