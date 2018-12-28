<?php 
/**
 * 
 */
class Main_modal extends CI_Controller
{
	
	function __construct()
	{
		parent :: __construct();
$this->load->model('Modal_popup');
	}
	public function index()
	{
		$this->load->view('modal/profile_user');
	}
	public function add()
	{
		$data=array(
'name'=>$this->input->post('name'),
'email'=>$this->input->post('email'),
'phone'=>$this->input->post('phone')
		);
		// print_r($data); 
	$this->Modal_popup->add($data);
	}
	public function all_data()
	{
		$data['user']=$this->Modal_popup->select_all_data();
		//print_r($data['user']);  die; // print Array ( [0] => Array ( [id] => 1 [name] => fdfd [email] => fffd ))
		$this->load->view('modal/profile_user', $data);
	}
	public function fetch_single()
	{
		$id=$this->input->post('id'); //$_POST['id']== $id
		// echo $id; die();
		$output= array();
		$data=$this->Modal_popup->fetch_single($id); // ya $id likhe aur comment hataye same hai matlab
			//$this->load->view('modal/profile_user', $data);
foreach($data as $row)
{
$output['name']= $row->name;
$output['email']= $row->email;
$output['phone']= $row->phone;

}
echo json_encode($output);//convert php array to php string
	}
}
?>