<?php  /**
 * 
 */
class A_deletebycheck extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('crud/B_deletebycheck');
	}

public function index()
{
	$data['state']=$this->B_deletebycheck->fetch_all_data('*','state',array('status'=>1));
	// print_r($data['state']);
	$this->load->view('checkrowcountbydelete', $data);
	}
	public function deleterowbycheck()
	{
$v = $this->uri->segment(2);
			$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
	     	$update_data = array(
		        'status' => '0'
		        
			);
			$where = "id = '$val'";
			
			
		$where1 = "state_id = '$val'";
	     $val_check=$this->B_deletebycheck->check_numrow('city',$where1);
	    // echo $val_check; die;
	     if($val_check>0){
	     	$this->session->set_flashdata('skills_test_insert_message','<div class="danger"><strong>Oops!</strong> Failed to Delete Data</div>');
				redirect(base_url().'deletebycheck');
	     }
	     else{
	     	if($this->B_deletebycheck->update_data($where,'state',$update_data)){
				$this->session->set_flashdata('skills_test_insert_message','<div class="success"><strong>Success!</strong> Data Deleted.</div>');
				redirect(base_url().'deletebycheck');
			}
			
	     }
	     
		}
		
	
	
}

 ?>