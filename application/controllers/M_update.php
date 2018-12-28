<?php
/**
 * 
 */
class M_update extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('M_modal_update');
	}
	public function index()
	{
		$this->load->view('M_view/M_update');
	}
	function user_action()
	{
		
			$insert_data=array(
'first_name'=>$this->input->post('first_name'),
'last_name'=>$this->input->post('last_name')
			);
$this->M_modal->insert_crud($insert_data);
echo "data inserted";
		
	}public function fetch_single_user()
	{
		$output=array();
		$data=$this->M_modal_update->fetch_single_user( $_POST['user_id']);
foreach($data as $row)		
{
	$output['first_name']= $row->first_name;
	$output['last_name']= $row->last_name;
	}
	echo json_encode($output);
}
}
?>