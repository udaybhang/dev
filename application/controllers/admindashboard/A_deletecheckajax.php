<?php
/**
 * 
 */
class A_deletecheckajax extends CI_Controller
{
function __construct()
	{
		parent:: __construct();
		$this->load->model('crud/Crud_modal');
	}
	public function index()
	{
		    $field="u.employer_company, s.* ";
			$table_name="mm_employer as u";
			$join1[0]='mm_master_job as s';
			$join1[1]='u.employer_id=s.company_id';
			$join1[2]="inner";
			$where="s.status=1";
		$data['company']=$this->Crud_modal->fetch_data_by_one_table_join($field,$table_name,$join1,$where);
		// print_r($data['company']);
		$data['com']=$this->Crud_modal->fetch_alls('mm_employer', 'employer_id asc');
		// print_r($data['com']);
		$this->load->view('delete-check-ajax', $data);

	}
	public function fetchjobbycompanyajax()
	{
		
	$indus_id=$this->input->post('indus_id');
	//echo $indus_id; die;
	
	       $field="u.*, s.* ";
			$tbl="mm_master_job as s";
			$join1[0]='mm_employer as u';
			$join1[1]='u.employer_id=s.company_id';
			$join1[2]="inner";
      	$where="company_id='$indus_id' ";
      	
      	 $pro=$this->Crud_modal->fetch_data_by_one_table_join($field,$tbl,$join1,$where);
	
	if($indus_id!='')
	{
		$a=1;
		foreach($pro as $data)
		{
			echo '<tr>
                         <td>'.$a.'</td> <td>'.$data["job_title"].'</td> <td>'.$data["employer_company"].'</td><td><a href="employer-delete/'.$data["employer_id"].'" onclick="return doconfirm();">Delete</a></td>
			</tr>';
			$a++;
		}
	}
	
	}
	public function deletecheck()
	{
$v = $this->uri->segment(2);
$where1 = "company_id = '$v'";
	     $val_check=$this->Crud_modal->check_numrow('mm_master_job',$where1);
	     if($val_check>0)

	     {
	     	$this->session->set_flashdata('message','<div class="danger"> Not able to delete skill. As it is already exist.</div>');
				redirect(base_url().'delete-check-ajax');
	     }
	     else{
	     	$update_data=array('status'=>0);
	     	$where="employer_id='$v'";
	     	if($this->Crud_modal->update_data($where,'mm_employer',$update_data)){
				$this->session->set_flashdata('message','<div class="success"><strong>Success!</strong> Data Deleted.</div>');
				redirect(base_url().'delete-check-ajax');}
	     }
	}
}

?>