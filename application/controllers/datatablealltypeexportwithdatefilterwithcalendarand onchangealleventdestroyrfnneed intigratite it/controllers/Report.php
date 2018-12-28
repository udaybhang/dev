<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct(){
		
        parent::__construct();
        error_reporting(0);
        $this->load->library('Pagination_new');
		// Load model
		$this->load->model('Report_model');
		$this->load->model('Admindashboard_modal');
		$this->load->model('crud/Crud_modal');
		$this->load->model('userdashboard/Userdashboard_modal');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->model('mailer/Mailer_model');
		$this->load->model('Pagination_model',"pgn");
		$this->load->model('assignments/Assignments_modal');
	    $this->load->library('Phpmailer');
	    $this->load->helper('packageskills_helper');
		if(($this->session->userdata('admin_name')=="" || $this->session->userdata('admin_name')==null) && ($this->session->userdata('admin_role')=="" || $this->session->userdata('admin_role')==null)){
			redirect(base_url().'admin');
		}
		ini_set('memory_limit', '-1');
	}

	public function package_not_attempted_user(){
		$v = $this->uri->segment(2);
		$data['encode_pack_id']=$v;
		//$v=$this->input->get("package_id");
		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
		$data['package_id']=$val;
		if($val!=""){
			$package_id=$val;
		}else{
			$package_id="";
		}
		if($this->input->post('pageh') !=''){
          $rowno = $this->input->post('pageh');
		}else{
          $rowno=0;
		}
        $search_text = "";
		if($this->input->post('search') != '' ){
			$search_text = $this->input->post('search');
			//$this->session->set_userdata(array("search"=>$search_text));
		}else{
			// if($this->session->userdata('search') != NULL){
			// 	$search_text = $this->session->userdata('search');
			// }
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
			//$rowno.','.$rowperpage.',';
			 $rowno = ($rowno-1) * $rowperpage;
		}
		$data_pack=$this->Crud_modal->all_data_select('distinct(u_id) as uids','score',"package_id=$package_id",'u_id desc');
		$test_result = array_column($data_pack, "uids");
		$id_list=implode(',', $test_result);
      	$fetch_columns="mm_uid,mm_user_full_name,mm_user_email";
      	$table="user";			
      	$search_column="mm_user_email";
      	$count_column="mm_uid";

      	$where="mm_uid not in($id_list)";
      	// All records count
      	//$allcount = $this->Report_model->getrecordCount($search_text);
      	if($id_list!=""){
      		$allcount = $this->Report_model->getrecordCount1($search_text,$count_column,$table,$search_column,$where);
	      	// Get  records
	      	//$users_record = $this->Report_model->getData($rowno,$rowperpage,$search_text);
	      	$users_record = $this->Report_model->getData1($rowno,$rowperpage,$search_text,$fetch_columns,$table,$search_column,$where);
	    }
      	
      	// Pagination Configuration
      	$config['base_url'] = base_url().'package-not-attempted-user';
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
		$this->load->view('admintempletes/head');
		$this->load->view('admintempletes/header');	
		$this->load->view('admintempletes/sidebar');
		$this->load->view('package-not-attempted-user',$data);
		$this->load->view('admintempletes/footer');
		
	}
	public function package_attempted_user(){
		$v = $this->uri->segment(2);
		$data['encode_pack_id']=$v;
		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
		$data['package_id']=$val;
		if($val!=""){ $package_id=$val; }else{ $package_id=""; }
		if($this->input->post('pageh') !=''){
          $rowno = $this->input->post('pageh');
		}else{
          $rowno=0;
		}
        $search_text = "";
		if($this->input->post('search') != '' ){
			$search_text = $this->input->post('search');
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
		$data_pack=$this->Crud_modal->all_data_select('distinct(u_id) as uids','score',"package_id=$package_id",'u_id desc');
		$test_result = array_column($data_pack, "uids");
		$id_list=implode(',', $test_result);
      	$fetch_columns="mm_uid,mm_user_full_name,mm_user_email";
      	$table="user";			
      	$search_column="mm_user_email";
      	$count_column="mm_uid";
      	$where="mm_uid in($id_list)";
      	if($id_list!=""){
      		// All records count
      		$allcount = $this->Report_model->getrecordCount1($search_text,$count_column,$table,$search_column,$where);
	      	// Get  records
	      	$users_record = $this->Report_model->getData1($rowno,$rowperpage,$search_text,$fetch_columns,$table,$search_column,$where);
	    }     	
      	// Pagination Configuration
      	$config['base_url'] = base_url().'package-attempted-user';
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
		$this->load->view('admintempletes/head');
		$this->load->view('admintempletes/header');	
		$this->load->view('admintempletes/sidebar');
		$this->load->view('package-attempted-user',$data);
		$this->load->view('admintempletes/footer');		
	}
	public function package_not_completed_user(){
		$v = $this->uri->segment(2);
		$data['encode_pack_id']=$v;
		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
		$data['package_id']=$val;
		if($val!=""){ $package_id=$val; }else{ $package_id=""; }
		if($this->input->post('pageh') !=''){
          $rowno = $this->input->post('pageh');
		}else{
          $rowno=0;
		}
        $search_text = "";
		if($this->input->post('search') != '' ){
			$search_text = $this->input->post('search');
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
		$id_arr=[];
		$total_level=$this->Crud_modal->check_numrow("master_level","pack_id=$package_id");
		$data_pack=$this->Crud_modal->all_data_select('distinct(u_id) as uids','score',"package_id=$package_id",'u_id desc');
		for($i=0;$i<sizeof($data_pack);$i++){
			$uid=$data_pack[$i]['uids'];
			$score=$this->Crud_modal->fetch_single_data('count(level_id) as count,u_id','score',"package_id=$package_id and u_id='$uid'");
			if($score['count']>0 && $score['count']!=$total_level){
				$id_arr[$i]=$score['u_id'];
			}
		}
		$id_list=implode(',', $id_arr);
      	$fetch_columns="mm_uid,mm_user_full_name,mm_user_email";
      	$table="user";			
      	$search_column="mm_user_email";
      	$count_column="mm_uid";
      	$where="mm_uid in($id_list)";
      	if($id_list!=""){
      		// All records count
      		$allcount = $this->Report_model->getrecordCount1($search_text,$count_column,$table,$search_column,$where);
	      	// Get  records
	      	$users_record = $this->Report_model->getData1($rowno,$rowperpage,$search_text,$fetch_columns,$table,$search_column,$where);
	    }     	
      	// Pagination Configuration
      	$config['base_url'] = base_url().'package-not-completed-user';
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
		$this->load->view('admintempletes/head');
		$this->load->view('admintempletes/header');	
		$this->load->view('admintempletes/sidebar');
		$this->load->view('package-not-completed-user',$data);
		$this->load->view('admintempletes/footer');		
	}

   public function export_users_data(){
    if($this->input->post("package_id")!=""){
        $package_id=$this->input->post("package_id");
        $data["selected_package_id"]=$pid;
        $data_pack=$this->Crud_modal->all_data_select('distinct(u_id) as uids','score',"package_id=$package_id",'u_id desc');
		$test_result = array_column($data_pack, "uids");
		$id_list=implode(',', $test_result);
      	
      	$fetch_columns="mm_uid,mm_user_full_name,mm_user_email";
      	$table="user";
      	$where="mm_uid in($id_list)";
      	if($id_list!=""){
      		// Get  records
	      	$data["users"] = $this->Crud_modal->all_data_select($fetch_columns,$table,$where,"mm_uid desc");
	    } 
    }
      echo $this->load->view('export-attempt-user-list',$data,true);
   }
   public function export_users_data2(){
    if($this->input->post("package_id")!=""){
        $package_id=$this->input->post("package_id");
        $data["selected_package_id"]=$pid;
        $data_pack=$this->Crud_modal->all_data_select('distinct(u_id) as uids','score',"package_id=$package_id",'u_id desc');
		$test_result = array_column($data_pack, "uids");
		$id_list=implode(',', $test_result);
      	
      	$fetch_columns="mm_uid,mm_user_full_name,mm_user_email";
      	$table="user";
      	$where="mm_uid not in($id_list)";
      	if($id_list!=""){
      		// Get  records
	      	$data["users"] = $this->Crud_modal->all_data_select($fetch_columns,$table,$where,"mm_uid desc");
	      	
	    } 
	}
      echo $this->load->view('export-attempt-user-list',$data,true);
   }
   public function export_users_data3(){
    if($this->input->post("package_id")!=""){
        $package_id=$this->input->post("package_id");
        $data["selected_package_id"]=$pid;
        $id_arr=[];
		$total_level=$this->Crud_modal->check_numrow("master_level","pack_id=$package_id");
		$data_pack=$this->Crud_modal->all_data_select('distinct(u_id) as uids','score',"package_id=$package_id",'u_id desc');
		for($i=0;$i<sizeof($data_pack);$i++){
			$uid=$data_pack[$i]['uids'];
			$score=$this->Crud_modal->fetch_single_data('count(level_id) as count,u_id','score',"package_id=$package_id and u_id='$uid'");
			if($score['count']>0 && $score['count']!=$total_level){
				$id_arr[$i]=$score['u_id'];
			}
		}
		$id_list=implode(',', $id_arr);
      	$fetch_columns="mm_uid,mm_user_full_name,mm_user_email";
      	$table="user";
      	$where="mm_uid in($id_list)";
      	if($id_list!=""){
      		// Get  records
	      	$data["users"] = $this->Crud_modal->all_data_select($fetch_columns,$table,$where,"mm_uid desc");
	      	
	    } 
	}
      echo $this->load->view('export-attempt-user-list',$data,true);
   }

   public function package_record_list(){
	   	$data["pack_type_list"]=$this->Crud_modal->all_data_select("pack_type_id,pack_type_name","mm_master_package_type","status=1","pack_type_id");
		if($this->input->post('pageh') !=''){
	        $rowno = $this->input->post('pageh');
		}else{
	        $rowno=0;
		}
	    $search_text = "";
		if($this->input->post('search') != '' ){
			$search_text = $this->input->post('search');
		}else{
			$search_text ='';
		}
		if($this->input->post('package_type') != '' ){
			$data["pack_type"]=$this->input->post('package_type');
			$search_text = $this->input->post('package_type');
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
		//$pids=$this->Crud_modal->fetch_single_data("*","package_map","usertype_id=2");
      	$fetch_columns="package_id,package_name,total_marks,total_time,skills,pack_type_id";
      	$table="mm_packages";	
      	if($this->input->post('package_type') != '' ){
			$search_column="pack_type_id";
		}else{
			$search_column="package_name";
		}	
      	//$search_column="package_name";
      	$count_column="package_id";
      	$where="status=1";
      	
      	// All records count
      	$allcount = $this->Report_model->getrecordCount1($search_text,$count_column,$table,$search_column,$where);
	    // Get  records
	    $users_record = $this->Report_model->getData1($rowno,$rowperpage,$search_text,$fetch_columns,$table,$search_column,$where);
	   
      	// Pagination Configuration
      	$config['base_url'] = base_url().'package-record-list';
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
		if($this->input->post('package_type') != '' ){$data['search'] = ""; }
		// Load view
		$this->load->view('admintempletes/head');
		$this->load->view('admintempletes/header');	
		$this->load->view('admintempletes/sidebar');
		$this->load->view('package-record-list',$data);
		$this->load->view('admintempletes/footer');		
   }
   public function view_package_data(){
   	 $v = $this->uri->segment(2);
	 $pack_id = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
	
   	 $data=array();
		$package_detail=$this->Crud_modal->fetch_single_data("ma_id,package_name,total_time,total_marks,pack_type_id","mm_packages","package_id='$pack_id'");
		$data['package_name']=$package_detail['package_name'];
		$data['total_time']=$package_detail['total_time'];
		$data['total_marks']=$package_detail['total_marks'];
		$ptype=$this->Crud_modal->fetch_single_data("pack_type_name","mm_master_package_type","pack_type_id=".$package_detail['pack_type_id']);
		$data['package_type']=$ptype['pack_type_name'];
		$expo_maid=explode(",", $package_detail['ma_id']);
		for($i=0;$i<sizeof($expo_maid);$i++){
			$assignment_name=$this->Crud_modal->fetch_single_data("assignment_name,assignment_description","master_assignment","maid='$expo_maid[$i]'");
			$data['assignment_list'][$i]['assignment_name']=$assignment_name['assignment_name'];
            $data['assignment_list'][$i]['assignment_description']=$assignment_name['assignment_description'];
			$level_detail=$this->Assignments_modal->get_level_details($expo_maid[$i]);
			$yy=0;
			$previous_key_com=[];
			$previous_skills=[];
			foreach ($level_detail as $key => $value) {
				$data['assignment_list'][$i]['level_list'][$yy]['level_name']=$value['lvl_name'];
				$data['assignment_list'][$i]['level_list'][$yy]['skills_name']=$value['skills_name'];
				$data['assignment_list'][$i]['level_list'][$yy]['time_limit']=$value['time_limit'];
				$data['assignment_list'][$i]['level_list'][$yy]['description']=$value['description'];
				$data['assignment_list'][$i]['level_list'][$yy]['key_competency_assessed']=$value['key_competency_assessed'];
				$previous_skills[$yy]=$value['skills_name'];
				$previous_key_com[$yy]=$value['key_competency_assessed'];;
				$yy++;
			}
			
			$data['assignment_list'][$i]['unique_skills']=explode(',',implode(',', array_unique($previous_skills)));
			$data['assignment_list'][$i]['unique_key_com']=explode(',',implode(',',array_unique($previous_key_com)));
			
		}
		
   	 $this->load->view('admintempletes/head');
	 $this->load->view('admintempletes/header');	
	 $this->load->view('admintempletes/sidebar');
	 $this->load->view('view-package-data',$data);
	 $this->load->view('admintempletes/footer');	
   }
   
   public function interactive_case_option_new(){
	 if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
 		$data['title']='Admin Dashboard for Monday Morning';
 		if($this->input->post('pageh') !=''){
          $rowno = $this->input->post('pageh');
		}else{
          $rowno=0;
		}
        $search_text = "";
		if($this->input->post('search') != '' ){
			$search_text = $this->input->post('search');
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
		$fetch_columns="*";
      	$table="mm_interactive_case_option";			
      	$search_column="option_id";
      	$count_column="option_id";

      	$where = "status = 1";
      	// All records count
      	$allcount = $this->Report_model->getrecordCount1($search_text,$count_column,$table,$search_column,$where);
	    // Get  records
	    $users_record = $this->Report_model->getData1($rowno,$rowperpage,$search_text,$fetch_columns,$table,$search_column,$where);
	    // Pagination Configuration
      	$config['base_url'] = base_url().'interactive-case-option-new';
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
		$this->load->view('admintempletes/head',$data);
		$this->load->view('admintempletes/header',$data);	
		$this->load->view('admintempletes/sidebar',$data);
		$this->load->view('interactive_case_option_new',$data);
		$this->load->view('admintempletes/footer');	 
	  }else{
		redirect(base_url().'admin','refresh');
	  }
   }
   public function registered_user_new(){
	 if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
 		$data['title']='Admin Dashboard for Monday Morning';
 		if($this->input->post('fromdate')!="" && $date_to=$this->input->post('todate') !=""){
            $date1=$this->input->post('fromdate');
            $date2=$this->input->post('todate');
            $date_from = date("Y-m-d", strtotime($date1));
            $date_to = date("Y-m-d", strtotime($date2.'+1 days'));
            $data['f_date']=$date1;
            $data['t_date']=$date2;
		}else{
            $date_to = date('Y-m-d');
            $date_to = date('Y-m-d',strtotime($date_to.'+1 days'));
            $date_from = date('Y-m-d', strtotime($date_to. ' - 10 days'));
            $data['f_date']=date("m/d/Y", strtotime($date_from));
            $data['t_date']=date("m/d/Y", strtotime($date_to.' - 1 days'));
        }
     	if($this->input->post('pageh') !=''){
          $rowno = $this->input->post('pageh');
		}else{
          $rowno=0;
		}
        $search_text = "";
		if($this->input->post('search') != '' ){
			$search_text = $this->input->post('search');
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
		$fetch_columns="*";
      	$table="user";			
      	$search_column="reg_date";
      	$count_column="reg_date";

      	$where = "reg_date>='".$date_from."' and reg_date<='".$date_to."'";
      	// All records count
      	$allcount = $this->Report_model->getrecordCount1($search_text,$count_column,$table,$search_column,$where);
      	// Get  records
	    $users_record = $this->Report_model->getData1($rowno,$rowperpage,$search_text,$fetch_columns,$table,$search_column,$where);
	    // Pagination Configuration
      	$config['base_url'] = base_url().'registered-user-new';
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
		$this->load->view('admintempletes/head',$data);
		$this->load->view('admintempletes/header',$data);	
		$this->load->view('admintempletes/sidebar',$data);
		$this->load->view('registered_user_new',$data);
		$this->load->view('admintempletes/footer');	 
	  }else{
		redirect(base_url().'admin','refresh');
	  }
   }
    public function instruction_list_new(){
	 if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
 		$data['title']='Admin Dashboard for Monday Morning';
 		if($this->input->post('pageh') !=''){
          $rowno = $this->input->post('pageh');
		}else{
          $rowno=0;
		}
        $search_text = "";
		if($this->input->post('search') != '' ){
			$search_text = $this->input->post('search');
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
		$where1='ml_status="1"';
		$data['select_inst']=$this->Crud_modal->all_data_select('inst_id','master_level',$where1,'ml_id');
		$fetch_columns="*";
      	$table="instruction_widget";			
      	$search_column="instruction_id";
      	$count_column="instruction_id";
      	$where = "status = 1";
      	// All records count
      	$allcount = $this->Report_model->getrecordCount1($search_text,$count_column,$table,$search_column,$where);
	    // Get  records
	    $users_record = $this->Report_model->getData1($rowno,$rowperpage,$search_text,$fetch_columns,$table,$search_column,$where);
	    // Pagination Configuration
      	$config['base_url'] = base_url().'instruction-list-new';
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
		$this->load->view('admintempletes/head',$data);
		$this->load->view('admintempletes/header',$data);	
		$this->load->view('admintempletes/sidebar',$data);
		$this->load->view('instruction-list-new',$data);
		$this->load->view('admintempletes/footer');	 
	  }else{  
		redirect(base_url().'admin','refresh');
	  }
   }
}