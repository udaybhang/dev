<?php
/**
 * 
 */
class Jsondisplay extends CI_Controller
{
	
	function __construct()
	{
		
		parent:: __construct();
		$this->load->model('crud/Crud_modal');
	}
	public function index()
	{
		$data['com']=$this->Crud_modal->fetch_alls('mm_employer', 'id asc');
		$this->load->view('jsondisplay', $data);
	}
public function view_package_data(){
	try{
		echo $pack_id=$this->input->post('packid');
			$where1 = "id='$pack_id'";
	    	$allass_lists= $this->Crud_modal->fetch_single_data('employer_name, id','mm_employer',$where1);
	    	$aslist['emp_name'] = $allass_lists['employer_name'];
	    	$empid=$allass_lists['id'];
	    	$aslist['asval'] = $this->Crud_modal->all_data_select('job_name,job_description' ,'mm_job',"employer_id IN ($empid)",'id asc');
	    	echo json_encode($aslist);
	    }catch(Exception $e){
		echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	}
}

}


?>
