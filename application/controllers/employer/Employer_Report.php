<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employer_Report extends CI_Controller {

	public function __construct(){
		
        parent::__construct();
        error_reporting(0);
        $this->load->library('Pagination_new');
		// Load model
		$this->load->model('Employer_Report_Model');
		$this->load->model('crud/Crud_modal');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->model('mailer/Mailer_model');
		$this->load->model('assignments/Assignments_modal');
	    $this->load->library('Phpmailer');
	    $this->load->helper('packageskills_helper');
		if($this->session->userdata('employer_id')=="" || $this->session->userdata('employer_id')==null){
			redirect(base_url().'employer');
		}
		//ini_set('memory_limit', '-1');
	}

	
	public function not_applied_candidate(){
		 $emp_id=$this->session->userdata('employer_id');
        $job_id=base64_decode(str_pad(strtr($this->input->post('job_id'), '-_', '+/'), strlen($this->input->post('job_id')) % 4, '=', STR_PAD_RIGHT));
        $data['jobs']=$this->Crud_modal->all_data_select("job_id,package_id,job_title,status","mm_master_job","status in(1,3) and company_id='$emp_id'","job_id DESC");
        $data['select_job']=$this->input->post('job_id');
        $job_published=$this->Crud_modal->fetch_single_data("*","mm_master_job","job_id='$job_id' ");
        $id=$job_published['job_id']; 
        $pack_id=$job_published['package_id'];
        $data['pack_id']=$pack_id;
        $data['job_title']=$job_published['job_title'];
        $count_val=0;
        $data_array = array();
        if($pack_id!=''){
            $dis_uid =$this->Crud_modal->all_data_select("distinct(uid) as uid","mm_user_applied_job","job_id='$job_id'","");
            $get_assgnment_id =$this->Crud_modal->all_data_select("ma_id","mm_packages","package_id in ($pack_id)","package_id");
            $count_app=0;
            $i=0;
            foreach ($dis_uid as $key => $value) {
                $uid = $value['uid'];
                $done_count=0;
                $assignment_count=0;
                foreach ($get_assgnment_id as $key => $value) {
                    $assignment_count+= sizeof(explode(",",$value['ma_id']));
                    $maid=$value['ma_id'];
                    $done_count+= $this->Crud_modal->check_numrow('completed_assignment',"uid='$uid' AND status = 1 AND maid IN ($maid)");
                }
                if ($done_count==$assignment_count) {
                    $count_app++;
                }else{
                    //$data_fetch = $this->Crud_modal->fetch_single_data("*","user","mm_uid='$uid' and user_status='1'");
                    #########join ##########
                    $field="u.mm_user_full_name,u.mm_user_email,ud.contact_number,jd.created_data";
                    $table_name="user as u";
                    $join1[0]="user_data as ud";
                    $join1[1]="ud.uid=u.mm_uid";
                    $join1[2]="inner";
                    $join2[0]="mm_user_applied_job as jd";
                    $join2[1]="u.mm_uid=jd.uid";
                    $join2[2]="inner";
                    $where = "u.user_status=1 and u.mm_uid='$uid'";
                    $data_fetch   = $this->Crud_modal->fetch_data_by_two_table_join($field,$table_name,$join1,$join2,$where);
                    #########join ##########
                    $data_array[$i]['user_name'] = $data_fetch[0]['mm_user_full_name'];
                    $data_array[$i]['email'] = $data_fetch[0]['mm_user_email'];
                    $data_array[$i]['contact_number'] = $data_fetch[0]['contact_number'];
                    $data_array[$i]['created_data'] = $data_fetch[0]['created_data'];
                    $i++;
                } 
            }
            }
        $data['package_neurons']=$package_neurons;
        $data['data_array'] = $data_array;
		// Load view
		$this->load->view('employertempletes/head');
		$this->load->view('employertempletes/header');	
		$this->load->view('employertempletes/sidebar');
		$this->load->view('not-applied-candidate',$data);
		$this->load->view('employertempletes/footer');		
	}
	public function trainee_report_new(){
		$emp_id=$this->session->userdata('employer_id');
		$query="select distinct"." emp.emp_pack_id, pack.package_name FROM mm_employer_package_map as emp JOIN mm_packages as pack ON emp.emp_pack_id=pack.package_id WHERE emp.status = 1 and emp.pack_type_id=5";
    	$data['trainings']=$this->db->query($query)->result_array();
		if($this->input->post("training_id")!="" && $this->input->post("training_id")!="0"){
			$training_id=$this->input->post('training_id');
        	$data['selected_training_id']=$training_id;
		}else{
			$data['selected_training_id']="";
		}
		if($this->input->post('pageh') !=''){
          $rowno = $this->input->post('pageh');
		}else{
          $rowno=0;
		}
		
        $search_text = "";
		if($this->input->post('training_id') != '' ){
			$search_text = $training_id;
		}else{
			$search_text ='';
		}
		// Row per page
		if($this->input->post('nor') !=''){
            $rowperpage = $this->input->post('nor');
		}else{
          	$rowperpage = 10;
		}
		// Row position
		if($rowno != 0){
			$rowno = ($rowno-1) * $rowperpage;
		}
		
      	$u=$this->Crud_modal->fetch_single_data("group_concat(company_functional_id) as func","mm_employer_package_map","emp_pack_id=".$training_id);
        $func=$u['func'];
        $field="u.mm_uid,u.mm_user_full_name,u.mm_user_email,mmad.status,mmu.company_unit_name,mmd.department_name,mmf.company_functional_name";
        $table_name="mm_user_department_details as mmad";
        $join1[0]="user as u";
        $join1[1]="u.mm_uid=mmad.user_id";
        $join1[2]="left";
        $join2[0]="mm_company_unit as mmu";
        $join2[1]="mmu.company_unit_id=mmad.company_unit_id";
        $join2[2]="left";
        $join3[0]="mm_company_department as mmd";
        $join3[1]="mmd.department_id=mmad.department_id";
        $join3[2]="left";
        $join4[0]="mm_company_functional as mmf";
        $join4[1]="mmad.functional_id=mmf.company_functional_id";
        $join4[2]="left";
    
        if($func!=""){
            $where="mmad.company_id='$emp_id' and mmf.company_functional_id in($func)";
        }else{
            $data['trainee_details']="";
        }
        $fetch_columns=$field;
        $count_column="u.mm_uid";
        $search_column="u.mm_uid";
      	if($training_id!=""){
      		// All records count
      		$allcount= $this->Employer_Report_Model->getrecordCount_trainee($search_text,$count_column,$table_name,$join1,$join2,$join3,$join4,$search_column,$where);
      		// Get  records
	      	$users_record = $this->Employer_Report_Model->getData_trainee($rowno,$rowperpage,$search_text,$fetch_columns,$table_name,$join1,$join2,$join3,$join4,$search_column,$where);
	    }     	
	   // Pagination Configuration
      	$config['base_url'] = base_url().'trainee-report-new';
      	$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $allcount;
		$config['per_page'] = $rowperpage;
		// Initialize
		$p =$this->pagination_new->initialize($config);
		$data['pagination'] = $this->pagination_new->create_links($this->input->post('pageh'));
		$data['result'] = $users_record;
		$data['row'] = $rowno;
		$data['search'] = $search_text;
		$data['tsearch'] = $rowperpage;
		// Load view
		$this->load->view('employertempletes/head');
		$this->load->view('employertempletes/header');	
		$this->load->view('employertempletes/sidebar');
		$this->load->view('trainee-report-new',$data);
		$this->load->view('employertempletes/footer');		
	}
   
}