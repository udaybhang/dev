<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employer extends MX_Controller {	
	public function __construct(){
			//error_reporting(0);
			parent::__construct();
			$this->load->model('crud/Crud_modal');		
            $this->load->model('Employer_model');
            $this->load->model('admindashboard/Admindashboard_modal');
            $this->load->model('userdashboard/Userdashboard_modal');
            $this->load->helper('url');
			$this->load->library('session');
			$this->load->library('image_lib');
			$this->load->model('mailer/Mailer_model'); 
			$this->load->library('Phpmailer'); 
			$this->load->helper('packageskills_helper');
			
		}
		

	public function signup(){
		$data["industry_value"]=$this->Crud_modal->fetch_alls('mm_master_industry_topic', 'industry_name asc');
		$data["value"]=$this->Crud_modal->fetch_alls('states', 'name asc');
		$data['meta_title']='mondaymorning employer';
		$data['meta_keywords']='assessment, curated CVs, resume, CV, profile, hiring, recruitment, training, placement, business, consulting, finance, jobs'; 
		$data['meta_description']='Ensure that you always find the right candidate for the job! The MondayMorning platform trains, assesses and identifies the perfect candidates for you.';					
		$data['title']='Employer Zone - MondayMorning';					
		$this->load->view('templetes/head',$data);
		$this->load->view('templetes/header');
		$this->load->view('employer-signup',$data);
		$this->load->view('templetes/footer');
		$this->load->view('templetes/foot');

		if(isset($msg)){
			$this->uri->segment(4); 
		}
	}
    function index()
    {
			$data['meta_title']='mondaymorning employer';
			$data['meta_keywords']='assessment, curated CVs, resume, CV, profile, hiring, recruitment, training, placement, business, consulting, finance, jobs'; 
			$data['meta_description']='Ensure that you always find the right candidate for the job! The MondayMorning platform trains, assesses and identifies the perfect candidates for you.';					
			$data['title']='Employer Zone - MondayMorning';	
            $this->load->view('templetes/head',$data);
            $this->load->view('templetes/header1');
            $this->load->view('employer-login');
            $this->load->view('templetes/footer');
            $this->load->view('templetes/foot');
           
    }	
    
     public function forget(){
        $data['title']='Monday Morning blog';
        $this->load->view('templetes/head');
        //$this->load->view('templetes/header');
        $this->load->view('forget_view',$data);
        $this->load->view('templetes/footer');
        $this->load->view('templetes/foot');
    }
	 function getCities()
     {
                $where = array('state_id' => $this->input->post('state_id') );
                $data1["values"]=$this->Crud_modal->all_data_select('*','cities',$where ,'name asc');
                echo '<option value="">--Select City*--</option>';
                foreach($data1 as $v){
                        
                	foreach ($v as $value) {
                		echo '<option value="'.$value["ci_id"].'">'.$value["name"].'</option>';
                	}
                }
       }  
        function insert_emp(){  
            $email=trim($this->input->post('user_email'));
            $password=trim($this->input->post('user_password'));
            $designation=trim($this->input->post('designation'));
            $pincode=trim($this->input->post('pin_code'));
            $alternate_email=trim($this->input->post('user_alt_email'));
            $company   = trim($this->input->post('cname'));  
            $industry     = trim($this->input->post('industry'));
            $name  = trim($this->input->post('con_per_name'));  
            $address  = trim($this->input->post('office_address'));
            $city     = trim($this->input->post('city'));
            $mobile  = trim($this->input->post('mobile'));  
            $url= trim($this->input->post('web_url'));
            if($email=="" || $password=="" ||  $designation=="" ||  $pincode=="" ||  $company=="" ||  $industry=="" ||  $name=="" ||  $address=="" ||  $city=="" ||  $mobile=="" || $url==""){
                  $this->session->set_flashdata('reg-sucess', 'Please Fill Required* Fields.');
                  redirect(base_url().'employer/signup/','refresh'); 
            }
            else{                 
                $get_res=0;
                $r=$this->Crud_modal->check_employer_email($email);
                if($r==1){
                    $res=$this->Crud_modal->employer_exists_delete($email);
                    if($res["employer_id"]){
                       $this->Crud_modal->delete_employer_not_verified($res["employer_id"]);
                       $get_res=0;
                    }
                    else{
                        $get_res=1;
                    }                     
                }
                else{
                    $get_res=0;
                }
                if($get_res==0){
					$picname1='';
                    $p1= date('ymdHis');
                    $picname="employer_".$p1;
                    $config['upload_path']          = './upload/employer_upload/profile_pic/';
                    $config['allowed_types']        = 'jpg|png|jpeg';
                    $config['max_size']             = 2000;
                    $config['file_name'] = $picname; // set the name here
                    $this->load->library('upload', $config);             
                    if ($this->upload->do_upload('userfile')){ 
                        $data = $this->upload->data();
                        $picname1 = $data['file_name'];
                    }
                    $pwd=md5($password);
                    $auth_key=md5(mt_rand(0,99999999));
					$phone='';
					if($this->input->post('usrtel')!=''){					
						$phone=$this->input->post('usrtel_code')."-".$this->input->post('usrtel');
					}
                    $data = array(  
                        'employer_email'     => $this->input->post('user_email'),  
                        'employer_password'  => $pwd,  
                        'employer_company'   => $this->input->post('cname'),  
                        'employer_industry_id'     => $this->input->post('industry'),  
                        'employer_contact_person_name'  => $this->input->post('con_per_name'),  
                        'employer_address'   => $this->input->post('office_address'),
                        'employer_city_id'     => $this->input->post('city'),  
                        'employer_mobile'  => $this->input->post('mobile'),  
                        'employer_phone'   => $phone,
                        'profile_pic'     => $picname1,  
                        'employer_status'  => "0",  
                        'employer_auth_key'   => $auth_key,
                        'employer_reg_date'     => date("Y-m-d H:i:sa"),  
                        'eamil_auth_status'  => "0" ,
                        'designation'   => $designation,
                        'pincode'     => $pincode,  
                        'alternate_email'  => $alternate_email,
                        'web_link'=> $url
                    ); 
                //insert data into database table.  
				$q_res=$this->Crud_modal->data_insert('mm_employer',$data);
                    if($q_res){
                        $this->session->set_flashdata('reg-sucess', 'Successfully Registered! Please Verify Your Email Id.');
                        
                        $created_mail=$this->Mailer_model->employer_mail("Employer Email Verification Mail",$auth_key,$email,$password,$name);
                        redirect(base_url().'employer/signup/','refresh'); 
                    }else{
                        $this->session->set_flashdata('reg-sucess', 'Error');
                        redirect(base_url().'employer/signup/','refresh');
                    }
                }else{
                  //echo "Email Already Exists";
                  $this->session->set_flashdata('reg-sucess', 'Email Already Exists');
                  redirect(base_url().'employer/signup/','refresh'); 
                }
            }
          
            
        }

  public function confirm_mail(){
       $uri=$this->uri->segment(2);
       $where="`employer_auth_key`='$uri'";
       $field=array('eamil_auth_status'=>1);                        
       $data['data_updated']= $this->Crud_modal->update_data($where,'mm_employer',$field);
       if($data['data_updated']==1){
           $authkey=$uri;
           $gocafone= $this->Employer_model->employer_session_authkey($authkey);
           if($gocafone==1){
               redirect(base_url().'confirm-employer-message','refresh');
           }else{
               redirect(base_url(),'refresh');
           }
       }else{
           redirect(base_url(),'refresh');
       }
                   
   }
        function change_emp_status()
        {
                $where = array('employer_email' => $this->input->post('username'));  
                $data = array('eamil_auth_status' => '1' );  

               // print_r($where); echo "<br>"; print_r($data); die;
                if($this->db->update("mm_employer", $data, $where))
                {
                    redirect(base_url().'employer/confirm_mail'); 
                } 
                else{
                    echo "error";
                }
            
             
        }  
        public function close_job(){
	   if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
                $uid=$this->session->userdata('employer_id');
                $where="`employer_id`='$uid'";
                $empdat=$this->Crud_modal->fetch_single_data('employer_industry_id','mm_employer',$where);
                $inid = $empdat['employer_industry_id']; 
                $where="industry_id=$inid"; 
                $data["functional_area"]=$this->Crud_modal->all_data_select('*','mm_master_industry_functional',$where,'functional_id asc'); //print_r($data["functional_area"]); die;
        
                $functional_id=$this->input->post("selected_functional_id"); 
                $data["functional_id"]=$this->input->post("selected_functional_id"); 
                $data["jobs"]= $this->Employer_model->get_jobs_open_close($uid,"0");  //print_r($data["jobs"]); die;
                if($this->input->post('selected_functional_id')!=''){
                    $data["jobs"]= $this->Employer_model->get_jobs_by_functional_open_close($uid,$functional_id,"0"); //echo $this->db->last_query(); die;
                }else{
                    $data["jobs"]= $this->Employer_model->get_jobs_open_close($uid,"0");// print_r($data["jobs"]); die;
                }
                $this->load->view('employertempletes/head');
                $this->load->view('employertempletes/header');
                $this->load->view('open_close_job',$data);
                $this->load->view('employertempletes/footer');
                $this->load->view('employertempletes/sidebar');
        }
        else{
            redirect(base_url().'employer');
        }
   }
   
    public function open_job(){
	   if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
                $uid=$this->session->userdata('employer_id');
                $where="`employer_id`='$uid'";
                $empdat=$this->Crud_modal->fetch_single_data('employer_industry_id','mm_employer',$where);
                $inid = $empdat['employer_industry_id']; 
                $where="industry_id=$inid"; 
                $data["functional_area"]=$this->Crud_modal->all_data_select('*','mm_master_industry_functional',$where,'functional_id asc'); //print_r($data["functional_area"]); die;
        
                $functional_id=$this->input->post("selected_functional_id"); 
                $data["functional_id"]=$this->input->post("selected_functional_id"); 
                $data["jobs"]= $this->Employer_model->get_jobs_open_close($uid,"1");  //print_r($data["jobs"]); die;
                if($this->input->post('selected_functional_id')!=''){
                    $data["jobs"]= $this->Employer_model->get_jobs_by_functional_open_close($uid,$functional_id,"1"); //echo $this->db->last_query(); die;
                }else{
                    $data["jobs"]= $this->Employer_model->get_jobs_open_close($uid,"1");// print_r($data["jobs"]); die;
                }
                $this->load->view('employertempletes/head');
                $this->load->view('employertempletes/header');
                $this->load->view('open_close_job',$data);
                $this->load->view('employertempletes/footer');
                $this->load->view('employertempletes/sidebar');
        }
        else{
            redirect(base_url().'employer');
        }
   }
function employer_dashboard(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
            $uid=$this->session->userdata('employer_id');
            $where="`employer_id`='$uid'";
            $empdat=$this->Crud_modal->fetch_single_data('*','mm_employer',$where);

            $data['name'] = $empdat['employer_contact_person_name'];
            $data['pic']=$empdat['profile_pic'];
            $data['desc']=$empdat['employer_description'];
            $data['company']=$empdat['employer_company'];
            if($data['pic']!=""){$data['img']=$data['pic'];}else{$data['img']="user.jpg";}
            $data['fbLink']=$empdat['fb_link'];
            $data['twLink']=$empdat['twitter_link'];
            $data['gmLink']=$empdat['google_link'];
            $data['lnLink']=$empdat['linkedin_link'];
            $data['company']=$empdat['employer_company'];
            if($data['fbLink']==""){ $data['fbLink']="#"; }
            if($data['twLink']==""){ $data['twLink']="#"; }
            if($data['gmLink']==""){ $data['gmLink']="#"; }
            if($data['lnLink']==""){ $data['lnLink']="#"; }
            $cid=$empdat['employer_city_id'];
            $data['company_city']=$this->Crud_modal->fetch_single_data('name','cities',"ci_id=$cid");
			$data['total_unpublish_jobs']=$this->Crud_modal->check_numrow('mm_master_job',"company_id=$uid and status=3");       
			$data['total_publish_jobs']=$this->Crud_modal->check_numrow('mm_master_job',"company_id=$uid and status=1");  
			
			$job_id = $this->Crud_modal->fetch_single_data('group_concat(job_id) as job_id','mm_master_job',"company_id='$uid'");
			$data['total_apply_clicks']=0;
			if($job_id['job_id']!=''){
				$jobid=$job_id['job_id'];
				$data['total_apply_clicks']=$this->Crud_modal->check_numrow('mm_user_applied_job',"job_id in($jobid)");
			}				
			$data['total_view_jobs']=$this->Crud_modal->check_numrow('mm_user_job_click',"employer_id ='$uid'");
			$pend_jobs=$this->Crud_modal->all_data_select('job_id','mm_master_job',"company_id=$uid and status=0",'job_id');
            $data['total_pending_jobs']=sizeof($pend_jobs);
            $this->load->view('employertempletes/head',$data); 
            $this->load->view('employertempletes/header',$data);
            $this->load->view('employer-dashboard',$data); 
            $this->load->view('employertempletes/footer',$data);
            $this->load->view('employertempletes/sidebar',$data);
        }else{
            redirect(base_url().'employer');
        }
    }

        function employer_company_profile(){
            $eid=$this->session->userdata('employer_id');
            //echo $eid;  
            if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
            $data['employer']=$this->Crud_modal->get_employer($eid);
           // print_r($data['employer']); die;
            $data["city_value"]=$this->Crud_modal->fetch_alls('cities', 'name asc');
           
            $this->load->view('employertempletes/head');
            $this->load->view('employertempletes/header');
            $this->load->view('emp-company-profile',$data);
            $this->load->view('employertempletes/footer');
            $this->load->view('employertempletes/sidebar');
            }
            else{
                redirect(base_url().'employer');
            }
        }
    public function test_login(){     
        $em=$this->input->post('email');
        $pwd=$this->input->post('pwd');         
        if($em=="" || $pwd==""){
            $this->session->set_flashdata('error_email', 'Please Fill All Fields');
            redirect(base_url().'employer','refresh');
        }else{
            $data['exixts_or_not']= $this->Employer_model->check_employer_email_exists();
            if($data['exixts_or_not']==1){
                $data['login_user_status']= $this->Employer_model->check_employer_email_verified();
                if($data['login_user_status']==1){
                    $data['login_user']= $this->Employer_model->employer_login();
                    if($data['login_user']==1){
                        $data['job_data']=$this->Crud_modal->fetchdata_with_limit("*","mm_master_job","1","created_date desc",'6');
                         redirect(base_url().'employer-dashboard',$data);
                        //redirect(base_url().'emp-dashboard',$data);
                    }else{
                        $this->session->set_flashdata('error_email', 'Your Username or Password is Wrong.');
                        redirect(base_url().'employer','refresh');
                    }
                }else{
                    $this->session->set_flashdata('error_email', 'Your email id is not verified.');
                    redirect(base_url().'employer','refresh');
                }

            }else{
                $this->session->set_flashdata('error_email', 'Not Registered Member?.');
                redirect(base_url().'employer','refresh');
            }
        }
    }
    public function employer_logout()
     {
           try
           {
            
                            $this->session->unset_userdata('emp_name');
                            $this->session->unset_userdata('emp_email');							
                            $this->session->unset_userdata('employer_id');
                            $this->load->view('remove_javascript_session');
                            redirect(base_url().'employer','refresh');
                            
             }
           catch (Exception $e)
           {
                    echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
           }
 
    }
    public function employer_password_match(){
        try {
                if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
                    $uid=$this->session->userdata('employer_id');
                    $new=$this->input->post('newpassword');
                    $conf= $this->input->post('confirmnewpassword');
                    $oldpass=$this->input->post('oldpassword');
                    $data= $this->Employer_model->check_employer_password($uid);
                    $old_password=$data['employer_password'];
                    if($old_password==md5($oldpass)) {
                        if($this->input->post('newpassword')!='' && $this->input->post('confirmnewpassword')!=''){
                            if($this->input->post('newpassword')==$this->input->post('confirmnewpassword')){
                              $pass=md5($this->input->post('newpassword'));
                              $where="employer_id='$uid'";
                                $data=array(
                                'employer_password' =>$pass,
                                 );
                                $this->Crud_modal->update_data($where,'mm_employer',$data);
                                echo json_encode(array('status' =>"1","message"=>"Password Update"));
                            }
                            else{
                                echo json_encode(array('status' =>"0","message"=>"New password  and confirm password doesnot match"));
                            }
                        }
                    }else{ echo json_encode(array('status' =>"0","message"=>"Old password doesnot match"));
                    }       

                }
            }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
    }
    public function employer_data_edit()
    {
         try
            {
                  
             if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null )
             {
                            //$pk= $this->input->post('pk');
                            $db_col= $this->input->post('name');
                            $val= $this->input->post('value');
                            $uid=$this->session->userdata('employer_id');
							if($db_col=="employer_description"){
                                $val=htmlentities($this->input->post('value'));
                            }
                            $field=array($db_col=>$val);
                            $where="`employer_id`='$uid'"; 
                            $data['data_update']= $this->Crud_modal->update_data($where,'mm_employer',$field);

                }
            }
            catch (Exception $e)
            {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            
    }
    public function employer_updeditable(){
        try
            {
                  
             if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null )
             {
                $clmnname= $this->input->post('name');
                $val= $this->input->post('value');
                $uid=$this->session->userdata('employer_id');

                if($clmnname=='state_id'){
                    $field=array(
                        'employer_city_id' => '',$clmnname=>$val
                    );
                }elseif($clmnname=='reg_state'){
                    $field=array(
                        $clmnname=>$val,
                        'reg_city' => ''
                    );
                }else{
                    $field=array($clmnname=>$val);
                }
                $where="`employer_id`=$uid";
                $this->Crud_modal->update_data($where,'mm_employer',$field);
                echo '{"msg":"succ"}';
            }
        }
        catch (Exception $e)
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
 public function emp_selectstate(){
        try
            {
                   
            $where="country_id=101";
            $state= $this->Userdashboard_modal->allfield_for_editable('sid as value,name as text','states',$where, 'name asc');
            echo json_encode($state);
            }
        
        catch (Exception $e)
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
     public function emp_selectcity(){
        try
            {
            $uid=$this->session->userdata('employer_id');
            $where="`employer_id`='$uid'";
            $stateid=$this->Crud_modal->fetch_single_data('reg_state','mm_employer',$where);
            $sid = $stateid['reg_state'];
            $where="state_id='$sid'";
            $cities= $this->Userdashboard_modal->allfield_for_editable('ci_id as value,name as text','cities',$where, 'name asc');
            echo json_encode($cities);
            }
        
        catch (Exception $e)
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
	public function emp_selectcity_head(){
        try
            {
            $uid=$this->session->userdata('employer_id');
            $where="`employer_id`='$uid'";
            $stateid=$this->Crud_modal->fetch_single_data('state_id','mm_employer',$where);
            $sid = $stateid['state_id'];
            $where="state_id='$sid'";
            $cities= $this->Userdashboard_modal->allfield_for_editable('ci_id as value,name as text','cities',$where, 'name asc');
            echo json_encode($cities);
            }
        
        catch (Exception $e)
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
     public function emp_selectindustry(){
        try{
           $where="status=1";
            $industriesnew= $this->Userdashboard_modal->allfield_for_editable('industry_id as value, industry_name as text','mm_master_industry_topic',$where, 'industry_name asc');
            echo json_encode($industriesnew);
            }
        
        catch (Exception $e)
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    public function employer_image_update(){     
                if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null ){
                    $uid=$this->session->userdata('employer_id');
                    $img=$this->input->post('image');
                
                     $img = str_replace('data:image/png;base64,','', $img);
                     $img = str_replace(' ', '+', $img);
                     $data = base64_decode($img);
                     $filename="$uid-emp".date("ymd").".png";
                     $file = "./upload/employer_upload/profile_pic/$filename";
                     $success = file_put_contents($file, $data);                    
                    $field_user_data_tbl=array(
                    'profile_pic'=>$filename,
                    );
                    $where_user_data="`employer_id`='$uid'";
                    if($this->Crud_modal->update_data($where_user_data,'mm_employer',$field_user_data_tbl)){
                        echo true;                    
                    } else{
                        echo false;
                    }  
                    
                    
                }else{
                    echo false;
                }

    
    }
    public function emp_dashboard(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null ){
            $this->load->view('employertempletes/head');
            $this->load->view('employertempletes/header');  
            $this->load->view('employertempletes/sidebar');
            $this->load->view('emp-dashboard');
            $this->load->view('employertempletes/footer');
        }
        else{
            redirect(base_url().'employer');
        }
    }
    function get_packages_by_industry()
     {
        $ch=$this->input->post('industryname'); $where=" status='1' "; 
        if($ch=="All"){
            $data1["values"]=$this->Crud_modal->all_data_select('*','mm_packages',$where ,'package_id asc');
        }
        else{
             $where = array('industry_id' => $this->input->post('industryname'), 'status' =>'1');
            $data1["values"]=$this->Crud_modal->all_data_select('*','mm_packages',$where ,'package_id asc');
                
        }
      //  $this->load->view('response_package_code',$data1);
               
               echo " <table class='table table-striped'  id='testtable2' style='font-size: 13px;font-family:Calibri'>
                                                                    <thead>
                                                                    <tr>
                                                                        <th>S.No</th>
                                                                        <th>Package Name</th>
                                                                        <th>Total Neurons </th>
                                                                        <th>Skill Mapped </th>
                                                                        <th>Info</th>
                                                                        <th>Select</th>
                                                                        <th>Enter Min. Neurons</th>
                                                                      </tr>
                                                                    </thead>";
               foreach($data1 as $v){
                $jns=0;
                    foreach ($v as $package) { $jns++;
                        // echo "<tr><td>".$value["package_name"]."</td>";
                        // echo "<td>".$value["total_marks"]."</td>";
                        // echo "</tr>"; 
                        echo "<tr>";
                        echo "<td>".$jns."."."</td>";
                        echo "<td>". $package['package_name']."</td>";
                        echo "<td class='td_total_neurons' >". $package['total_marks']."</td>";
                        echo "<td>"; 
                                                                                $str = $package['ma_id']; 
                                                                                $as_id=array(); $as_id=explode(",",$str); $IDS = array();
                                                                                
                                                                  foreach ($as_id as $key => $value) {    $IDS[$key]=$value; }
                                    $skill_arr=array();  
                                    $getSkills['skills']=$this->Crud_modal->fetch_alls('master_skills_test','skills_id asc');
                                    $i=0;
                                     foreach($getSkills as $skl){ 
                                        foreach ($skl as $sk) {
                                            $skill_arr[$i]=$sk["skills_id"]; $i++;
                                        }
                                        
                                    }
                                    //print_r($skill_arr);
                                    $myarr=array(); $tm=0; $sum=0; $myarr1=array(); $skids= array(); $skneurons= array();  $kk=0;
                                     for($i=0;$i<count($IDS);$i++){ 
                                            $aid=$IDS[$i]; 
                                            $where="maid=$aid"; 
                                            $getSki['skills_levels']=$this->Employer_model->get_skill_group_by('*','master_level',$where,' skills');
                                            $skill_arr_lev=array(); $k=0;
                                            foreach($getSki as $skll){ 
                                                foreach ($skll as $sks) {
                                                        $skill_arr_lev[$k]=$sks["skills"]; $k++;
                                                }
                                                    
                                            }
                                            //print_r($skill_arr_lev);
                                           
                                                    for($j=0;$j<count($skill_arr_lev);$j++){
                                                        $sid=$skill_arr_lev[$j];
                                                        $where="maid=$aid and skills=$sid";
                                                        $getLevels['levels']=$this->Crud_modal->all_data_select('sum(`time_limit`)/100*d_level as sum,skills','master_level',$where,'ml_id asc');
                                                        
                                                        foreach($getLevels as $lvl){ 
                                                            foreach ($lvl as $ls) {
                                                                    //echo $ls['skills']." ".$ls['sum']."<br>";
                                                                    $myarr[$kk]['skills_id']=$ls['skills']; $myarr[$kk]['neurons']=$ls['sum']; $kk++;
                                                                   
                                                                 }
                                                            }
                                                      }
                                                    
                                     } 
                                   
                                     $sum=array_reduce($myarr, function($a,$b){
                                        isset($a[$b['skills_id']])?$a[$b['skills_id']]['neurons']+=$b['neurons']:$a[$b['skills_id']]=$b;
                                        return $a;
                                     });
                                    
                                     $myarr1=array_values($sum);
                                    for ($im = 0; $im < count($myarr1); $im++) {
                                            $skname=$this->Employer_model->get_skill_by_skill_id($myarr1[$im]['skills_id']);
                                            echo $skname['skills_name']; 
                                            if($im+1<count($myarr1)){
                                                echo ", ";
                                            }
                                            
                                    }

                        echo "</td>";
                         echo "<td><button class='btn btn-circle btn-info moreinfo' type='button' data-id=".$package['package_id']." ><big><i class='fa fa-info-circle' aria-hidden='true'></i></big></button></td>
                            <td><input type='checkbox' class='icheckbox_square-green ads_Checkbox' name='selector[]' id='ad_Checkbox".$j."' type='checkbox' value='".$package['package_id']."'></td>
                             <td><input type='text' class='number_validation compare_neurons' name='min_neurons".$package['package_id']."' id='min_neurons".$package['package_id']."' pattern='^[0-9]+$' /></td></td></tr></table>";

                    }
                }
       } 
function get_packages_by_functional()
     {
        $chi=$this->input->post('industry_id');
        $ch=$this->input->post('functionalname'); $where=" status='1' "; 
        if($ch!="All" && $chi!="All"){
            $where = array('industry_id' => $chi, 'functional_id' => $ch, 'status' =>'1');
        }
        elseif($ch=="All" && $chi!="All"){
            $where = array('industry_id' => $chi, 'status' =>'1');
        }else{
             $where=" status='1' ";
        }
        $data1["values"]=$this->Crud_modal->all_data_select('*','mm_packages',$where ,'package_id asc');
        echo " <table class='table table-striped'  id='testtable2' style='font-size: 15px;font-family:Calibri'>
                                                                    <thead>
                                                                    <tr>
                                                                        <th>S.No</th>
                                                                        <th>Package Name</th>
                                                                        <th>Total Neurons </th>
                                                                        <th>Skill Mapped </th>
                                                                        <th>Info</th>
                                                                        <th>Select</th>
                                                                        <th>Enter Min. Neurons</th>
                                                                      </tr>
                                                                    </thead>";
               foreach($data1 as $v){
                $jns=0;
                    foreach ($v as $package) { $jns++;
                        // echo "<tr><td>".$value["package_name"]."</td>";
                        // echo "<td>".$value["total_marks"]."</td>";
                        // echo "</tr>"; 
                        echo "<tr>";
                        echo "<td>".$jns."."."</td>";
                        echo "<td>". $package['package_name']."</td>";
                        echo "<td class='td_total_neurons' id='neu".$package['package_id']."'>". $package['total_marks']."</td>";
                        echo "<td>"; 
                                    $str = $package['ma_id']; 
                                    $as_id=array(); $as_id=explode(",",$str); $IDS = array();
                                    foreach ($as_id as $key => $value) {    $IDS[$key]=$value; }
                                    $skill_arr=array();  
                                    $getSkills['skills']=$this->Crud_modal->fetch_alls('master_skills_test','skills_id asc');
                                    $i=0;
                                     foreach($getSkills as $skl){ 
                                        foreach ($skl as $sk) {
                                            $skill_arr[$i]=$sk["skills_id"]; $i++;
                                        }
                                        
                                    }
                                    //print_r($skill_arr);
                                    $myarr=array(); $tm=0; $sum=0; $myarr1=array(); $skids= array(); $skneurons= array();  $kk=0;
                                     for($i=0;$i<count($IDS);$i++){ 
                                            $aid=$IDS[$i]; 
                                            $where="maid=$aid"; 
                                            $getSki['skills_levels']=$this->Employer_model->get_skill_group_by('*','master_level',$where,' skills');
                                            $skill_arr_lev=array(); $k=0;
                                           
                                            $m_type_arr=array(); $km=0;
                                            foreach($getSki as $skll){ 
                                                foreach ($skll as $sks){
                                                    $m_type_arr[$km]=$sks["m_type"];$km++;
                                                    if($sks["m_type"]==12){
                                                        $lid=$sks["ml_id"];
                                                        $skill_arr_lev[$k]=$lid; 
                                                        $k++;
                                                       
                                                    }else{
                                                        $skill_arr_lev[$k]=$sks["skills"]; 
                                                        $k++;
                                                    }
                                                    
                                                }
                                                    
                                            }
                                            //print_r($skill_arr_lev);
                                            for($j=0;$j<count($skill_arr_lev);$j++){
                                                        $sid=$skill_arr_lev[$j];
                                                        $m_type=$m_type_arr[$j];
                                                        if($m_type=="12"){
                                                            $lid=$skill_arr_lev[$j];
                                                            $skills_List=$this->Crud_modal->fetch_single_data("skills_map,skills_value","mm_case_map","level_id=$lid");
                                                            $skillsList=$skills_List["skills_map"];
                                                            $skillsVal=$skills_List["skills_value"];
                                                            
                                                            if(strpos($skillsList, ',') !== false){
                                                                $mySK=explode(',', $skillsList);
                                                                $myV=explode(',', $skillsVal);
                                                                for($fi=0;$fi<sizeof($mySK);$fi++){
                                                                    // $skill_arr_lev[$k]=$mySK[$fi]; echo "-".$mySK[$fi];
                                                                    // $k++;
                                                                  $myarr[$kk]['skills_id']=$mySK[$fi]; $myarr[$kk]['neurons']=$myV[$fi]; 
                                                                  $kk++;
                                                                }
                                                            }
                                                        }else{
                                                         $where="maid=$aid and skills=$sid";
                                                         $getLevels['levels']=$this->Crud_modal->all_data_select('sum(`time_limit`)/100*d_level as sum,skills','master_level',$where,'ml_id asc');
                                                         foreach($getLevels as $lvl){ 
                                                            foreach($lvl as $ls){
                                                                $myarr[$kk]['skills_id']=$ls['skills']; $myarr[$kk]['neurons']=$ls['sum']; 
                                                                $kk++;
                                                            }
                                                         }
                                                        }
                                                    }
                                     } 
                                   
                                     $sum=array_reduce($myarr, function($a,$b){
                                        isset($a[$b['skills_id']])?$a[$b['skills_id']]['neurons']+=$b['neurons']:$a[$b['skills_id']]=$b;
                                        return $a;
                                     });
                                    
                                     $myarr1=array_values($sum);
                                    for ($im = 0; $im < count($myarr1); $im++) {
                                            $skname=$this->Employer_model->get_skill_by_skill_id($myarr1[$im]['skills_id']);
                                            echo $skname['skills_name']; 
                                            if($im+1<count($myarr1)){
                                                echo ", ";
                                            }
                                            
                                    }

                        echo "</td>";
                        echo "<td><button class='btn btn-circle btn-info moreinfo' type='button' data-id=".$package['package_id']." ><big><i class='fa fa-info-circle' aria-hidden='true'></i></big></button></td>
                            <td><input type='checkbox' class='icheckbox_square-green ads_Checkbox' name='selector[]' id='ad_Checkbox".$j."' type='checkbox' value='".$package['package_id']."'></td>
                             <td><input type='text' class='number_validation compare_neurons' name='min_neurons".$package['package_id']."' id='min_neurons".$package['package_id']."' pattern='^[0-9]+$' data-id='".$package['package_id']."' /></td></td></tr></table>";

                    }
                }
       }    
     public function employer_job_post(){
        $uid=$this->session->userdata('employer_id');
        $where="`employer_id`='$uid'";
        $empdat=$this->Crud_modal->fetch_single_data('employer_industry_id','mm_employer',$where);
        $inid = $empdat['employer_industry_id'];
        $where="industry_id=$inid"; 
        $data["industry_name"]=$this->Crud_modal->all_data_select('*','mm_master_industry_topic',$where,'industry_id asc');
        $data["functional"]=$this->Crud_modal->all_data_select('*','mm_master_industry_functional',$where,'functional_id asc');
         $iname=$this->input->post('industryname');                 
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null ) {
            $certi=$this->input->post('job_title');
            if($certi==''){             
                $data['master_industry']=$this->Crud_modal->fetch_alls('mm_master_industry_topic','industry_id asc');
                $data['master_certification']=$this->Crud_modal->all_data_select("certification_id,certification_name",'mm_master_certification',"status='1'",'certification_id asc');
                $data['master_states']=$this->Crud_modal->fetch_alls('states','sid asc');
                $data['master_package']=$this->Crud_modal->all_data_select("*","mm_packages","status='1' and industry_id=$inid ","package_id asc");
                $iname=$this->input->post('industryname'); 
                if($this->input->post('industryname')!=""){
                    $data['master_package']=$this->Crud_modal->all_data_select("*","mm_packages","status='1'","package_id asc");
                    
                }
                
                $this->load->view('employertempletes/head');
                $this->load->view('employertempletes/header');  
                $this->load->view('employertempletes/sidebar');
                $this->load->view('employer-job-form1', $data);
                $this->load->view('employertempletes/footer');
            }
    }else{
            redirect(base_url().'employer','refresh');
        }
    }

 public function get_skills(){
    $pid['ids']=$this->input->post('package_id');
    $pidneu['min_neurons']=$this->input->post('pack_min_neurons'); 
    $pneurons=array();
    $pneurons=$this->input->post('pack_min_neurons');
   
     echo " <table class='table table-striped'  id='testtable2' style='font-size: 13px;font-family:Calibri'>
            <thead><tr>
                    <th>S.No</th> <th>Package Name</th><th>Skill Mapped </th><th>Total Neurons </th><th>Min. Neurons </th>
            </tr></thead>";
               foreach($pid as $v){  $jns=0;
                    foreach ($v as $package_id) { $jns++; 
                         $where="package_id=$package_id"; 
                         $data["pack"]=$this->Crud_modal->all_data_select('*','mm_packages',$where,'package_id asc');
                         foreach($data as $vp){ 
                           foreach ($vp as $packs) {
                        echo "<tr>";
                        echo "<td>".$jns."."."</td>";
                        echo "<td>". $packs['package_name']."</td>";
                        echo "<td>"; 
                                    $str = $packs['ma_id']; 
                                    $as_id=array(); $as_id=explode(",",$str); $IDS = array();
                                                                                
                                    foreach ($as_id as $key => $value) {    $IDS[$key]=$value; }
                                    $skill_arr=array();  
                                    $getSkills['skills']=$this->Crud_modal->fetch_alls('master_skills_test','skills_id asc');
                                    $i=0;
                                     foreach($getSkills as $skl){ 
                                        foreach ($skl as $sk) {
                                            $skill_arr[$i]=$sk["skills_id"]; $i++;
                                        }
                                        
                                    }
                                    //print_r($skill_arr);
                                    $myarr=array(); $tm=0; $sum=0; $myarr1=array(); $skids= array(); $skneurons= array();  $kk=0;
                                     for($i=0;$i<count($IDS);$i++){ 
                                            $aid=$IDS[$i]; 
                                            $where="maid=$aid"; 
                                            $getSki['skills_levels']=$this->Employer_model->get_skill_group_by('*','master_level',$where,' skills');
                                            $skill_arr_lev=array(); $k=0;
                                            foreach($getSki as $skll){ 
                                                foreach ($skll as $sks) {
                                                        $skill_arr_lev[$k]=$sks["skills"]; $k++;
                                                }
                                                    
                                            }
                                            //print_r($skill_arr_lev);
                                           
                                                    for($j=0;$j<count($skill_arr_lev);$j++){
                                                        $sid=$skill_arr_lev[$j];
                                                        $where="maid=$aid and skills=$sid";
                                                        $getLevels['levels']=$this->Crud_modal->all_data_select('sum(`time_limit`)/100*d_level as sum,skills','master_level',$where,'ml_id asc');
                                                        
                                                        foreach($getLevels as $lvl){ 
                                                            foreach ($lvl as $ls) {
                                                                    //echo $ls['skills']." ".$ls['sum']."<br>";
                                                                    $myarr[$kk]['skills_id']=$ls['skills']; $myarr[$kk]['neurons']=$ls['sum']; $kk++;
                                                                   
                                                                 }
                                                            }
                                                      }
                                                    
                                     } 
                                   
                                     $sum=array_reduce($myarr, function($a,$b){
                                        isset($a[$b['skills_id']])?$a[$b['skills_id']]['neurons']+=$b['neurons']:$a[$b['skills_id']]=$b;
                                        return $a;
                                     });
                                    
                                     $myarr1=array_values($sum);
                                    for ($im = 0; $im < count($myarr1); $im++) {
                                            $skname=$this->Employer_model->get_skill_by_skill_id($myarr1[$im]['skills_id']);
                                            echo $skname['skills_name']; echo ", Total Neurons: ";
                                            echo $myarr1[$im]['neurons']; 
                                            echo "<br>";
                                    }
                                             
                        echo "</td>";
                        echo "<td>". $packs['total_marks']."</td>";
                        echo "<td>"; 
                            for($jns1=1;$jns1<=count($pneurons);$jns1++){
                                if($jns1==$jns){
                                    echo $pneurons[$jns1-1]; 
                                }
                                else{
                                }
                            }
                        echo "</td>";
                        }
                     }
                }
            }
}

public function get_skills1(){
    $pid['ids']=$this->input->post('package_id');
    $pidneu['min_neurons']=$this->input->post('pack_min_neurons'); 
    $pneurons=array();
    $pd=implode(",",$pid['ids']);
    $pneurons=$this->input->post('pack_min_neurons');
    $pmin=implode(",",$pneurons);
   $mynewarr=array(); $mynewarr1=array(); $ims=0;
        foreach($pid as $v){  $jns=0;
            foreach ($v as $package_id) { $jns++; 
                    $where="package_id=$package_id"; 
                    $data["pack"]=$this->Crud_modal->all_data_select('*','mm_packages',$where,'package_id asc');
                         foreach($data as $vp){ 
                           foreach ($vp as $packs) {
                       
                                    $str = $packs['ma_id']; 
                                    $as_id=array(); $as_id=explode(",",$str); $IDS = array();
                                                                                
                                    foreach ($as_id as $key => $value) {    $IDS[$key]=$value; }
                                    $skill_arr=array();  
                                    $getSkills['skills']=$this->Crud_modal->fetch_alls('master_skills_test','skills_id asc');
                                    $i=0;
                                     foreach($getSki as $skll){ 
                                                            foreach ($skll as $sks){
                                                               $m_type_arr[$km]=$sks["m_type"];$km++;
                                                               if($sks["m_type"]==12){
                                                                  $lid=$sks["ml_id"];
                                                                  $skill_arr_lev[$k]=$lid; 
                                                                  $k++;
                                                               }else{
                                                                  $skill_arr_lev[$k]=$sks["skills"]; 
                                                                  $k++;
                                                               }
                                                            }
                                                         }
                                    //print_r($skill_arr);
                                    $myarr=array(); $tm=0; $sum=0; $myarr1=array(); $skids= array(); $skneurons= array();  $kk=0;
                                     for($i=0;$i<count($IDS);$i++){ 
                                            $aid=$IDS[$i]; 
                                            $where="maid=$aid"; 
                                            $getSki['skills_levels']=$this->Employer_model->get_skill_group_by('*','master_level',$where,' skills');
                                            $skill_arr_lev=array(); $k=0;
                                            $m_type_arr=array(); $km=0;
                                           foreach($getSki as $skll){ 
                                                            foreach ($skll as $sks){
                                                               $m_type_arr[$km]=$sks["m_type"];$km++;
                                                               if($sks["m_type"]==12){
                                                                  $lid=$sks["ml_id"];
                                                                  $skill_arr_lev[$k]=$lid; 
                                                                  $k++;
                                                               }else{
                                                                  $skill_arr_lev[$k]=$sks["skills"]; 
                                                                  $k++;
                                                               }
                                                            }
                                                         }
                                            //print_r($skill_arr_lev);
                                           
                                                      for($j=0;$j<count($skill_arr_lev);$j++){
                                                           $sid=$skill_arr_lev[$j];
                                                           $m_type=$m_type_arr[$j];
                                                           if($m_type=="12"){
                                                               $lid=$skill_arr_lev[$j];
                                                               $skills_List=$this->Crud_modal->fetch_single_data("skills_map,skills_value","mm_case_map","level_id=$lid");
                                                               $skillsList=$skills_List["skills_map"];
                                                               $skillsVal=$skills_List["skills_value"];
                                                              
                                                               if(strpos($skillsList, ',') !== false){
                                                                   $mySK=explode(',', $skillsList);
                                                                   $myV=explode(',', $skillsVal);
                                                                   for($fi=0;$fi<sizeof($mySK);$fi++){
                                                                       // $skill_arr_lev[$k]=$mySK[$fi]; echo "-".$mySK[$fi];
                                                                       // $k++;
                                                                     $myarr[$kk]['skills_id']=$mySK[$fi]; $myarr[$kk]['neurons']=$myV[$fi]; 
                                                                     $kk++;
                                                                   }
                                                               }
                                                           }else{
                                                            $where="maid=$aid and skills=$sid";
                                                            $getLevels['levels']=$this->Crud_modal->all_data_select('sum(`time_limit`)/100*d_level as sum,skills','master_level',$where,'ml_id asc');
                                                            foreach($getLevels as $lvl){ 
                                                               foreach($lvl as $ls){
                                                                   //echo $ls['skills']." ".$ls['sum']."<br>";
                                                                   $myarr[$kk]['skills_id']=$ls['skills']; $myarr[$kk]['neurons']=$ls['sum']; 
                                                                   $kk++;
                                                               }
                                                            }
                                                           }
                                                      }
                                                    
                                     } 
                                //   print_r($myarr); //exit;
                                     $sum=array_reduce($myarr, function($a,$b){
                                        isset($a[$b['skills_id']])?$a[$b['skills_id']]['neurons']+=$b['neurons']:$a[$b['skills_id']]=$b;
                                        return $a;
                                     });
                                    
                                     $myarr1=array_values($sum); 
                                    for ($im = 0; $im < count($myarr1); $im++) {
                                            $skname=$this->Employer_model->get_skill_by_skill_id($myarr1[$im]['skills_id']);
                                           // echo $skname['skills_name']; 
                                            $mynewarr[$ims]['SkillName']=$skname['skills_name']; 
                                            $mynewarr[$ims]['SkillId']=$myarr1[$im]['skills_id'];
                                            $mynewarr[$ims]['Skill_Total']=$myarr1[$im]['neurons'];
                                            $ims++;
                                            //echo "<br>";
                                    }
                                 
                                             
                        }

                     }
                     

                }
            }
            $mynewarr1=array_unique(array_column($mynewarr, 'SkillName'));
            $mynewarr2=array_unique(array_column($mynewarr, 'SkillId'));
            $mynewarr3=array_unique(array_column($mynewarr, 'Skill_Total'));
            $mynewarr1 =explode(',',implode(",",$mynewarr1));
            $mynewarr2 =explode(',',implode(",",$mynewarr2));        

            for ($ik = 0; $ik < count($mynewarr1); $ik++) {
                echo " <div class='form-group'>
                        <div class='col-md-12' style='adding: 0px;'>
                           <div class='col-sm-2' style='padding: 0px;'>";
                echo "<input type='checkbox' name=skills_name value=".$mynewarr2[$ik]." data-val='".$mynewarr1[$ik]."'> ".$mynewarr1[$ik];
                echo "</div>";
                echo "<div class='col-sm-3' style='padding: 0px;margin:2px'>";
                echo " <input type='text' class='form-control number_validation check_percentage' id=textbox".$mynewarr2[$ik]." > </div>";
                echo "<div class='col-sm-3' style='padding: 0px;margin:2px'>";
                echo " <input type='hidden' class='form-control number_validation check_percentage' id=total".$mynewarr2[$ik]." value='".round($mynewarr3[$ik])."'> </div>";       
                echo "</div></div>";
                
            }
            echo "<input type=hidden value=".$pd." id=select_pack_id>";
            echo "<input type=hidden value=".$pmin." id=select_pack_min_neurons>";   

    }
		public function get_summary(){
        $data['sids'] =$skills_ids=$this->input->post('skills_ids');
        $data['snames']=$this->input->post('skills_names');
        $data['sper']=$pernew=$this->input->post('skills_pers');
        $pid=$this->input->post('package_ids');
        $min_neurons=explode(",",$this->input->post('pneurons'));
        
        $data['pack_data']=$this->Crud_modal->all_data_select("package_name,package_id,ma_id,total_marks","mm_packages","package_id in($pid)","package_id");
        $pid_arr=explode(',', $pid);
        for($i=0;$i<sizeof($pid_arr);$i++){
            $r= get_all_package_skills($pid_arr[$i]);
            $c=sizeof($r);
            $skArr=[];$skMArr=[];
            for($kk=0;$kk<$c;$kk++){
                $skArr[$kk]=$r[$kk]["SkillId"];
                $skmArr[$kk]=$r[$kk]["Skill_Total"];
            }
            for($j=0;$j<sizeof($skills_ids);$j++){
                if(in_array($skills_ids[$j], $skArr)){
                    $key=array_search($skills_ids[$j], $skArr);
                    $data['pack_data'][$i]['skills_ids'][$j]= (round($r[$key]["Skill_Total"])*$pernew[$j])/100  .'/'.round($r[$key]["Skill_Total"]);
                }else{
                    $data['pack_data'][$i]['skills_ids'][$j]= '';
                }
            }
            $data['pack_data'][$i]['min_neurons']=$min_neurons[$i]; 
           //print_r($r);
        }
        echo json_encode($data); 
    }
public function search_city_emp(){
        try{

                   $keyword=$this->input->post('keyword');                 
                    if(!empty($keyword)){
                        $data_val=$this->Admindashboard_modal->search_city($keyword);
                    }               
                    if(!empty($data_val)){
                        echo '<ul id="country-list" class="rahul" style="max-height:300px!important;overflow-y:scroll;width:300px!important;position:absolute;z-index:2000;background:#fff;border:1px solid #ccc">';
                        foreach($data_val as $val) {
                                
                        echo '<li class="members_col" style="list-style:none" data-id="'.$val["ci_id"].'" data-val="'.$val["name"].'" ><a href="javascript:void(0)" >'.$val["name"].'</a></li>';
                         
                         } 
                        echo '</ul>';
                    }
                
            }catch(Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
    }
  
 public function submit_emp_job_data(){
    $employer_id=$this->session->userdata('employer_id');
    $where="`employer_id`='$employer_id'";
    $empdat=$this->Crud_modal->fetch_single_data('employer_industry_id','mm_employer',$where);
    $industry_id = $empdat['employer_industry_id'];       
    $job_title=$this->input->post('job_title');
    $functional_name=$this->input->post('functional_name');
    $no_of_position=$this->input->post('no_of_position');
    $ctc_from=$this->input->post('ctc_from');
    $ctc_to=$this->input->post('ctc_to');
    $job_desc=$this->input->post('job_desc');
    $experience=$this->input->post('experience');
    $status=$this->input->post('status');
    $min_neurons=$this->input->post('min_neurons');
    $cities=$this->input->post('cities');
    $keys=$this->input->post('keywords');
	$loc_status=$this->input->post('show_location');
	$expire_time=$this->input->post('expire_time');
    if($cities!=''){        
        $cities1 =implode(",",$cities);
    }else{
        $cities1 ='';
    }
    
     if($job_desc=="" || $job_title=="" || $functional_name=="" || $no_of_position=="" || $experience==""){
        echo json_encode(["msg"=>2]);
     }
     else{
      $data = array( 
					'show_location'=>$loc_status,
					'keywords'=>$keys,
                    'company_id'=>$employer_id,
                    'job_title'=>$job_title,
                    'industry_id'=>$industry_id,
                    'functional_id'=>$functional_name,
                    'no_of_position'=>$no_of_position,
                    'ctc_from'=>$ctc_from,
                    'ctc_to'=>$ctc_to,
                    'job_description'=>$job_desc,
                    'experience'=>$experience,
                    'status'=>$status,
                    'required_system_neurons'=>$min_neurons,
                    'job_location_id'=>$cities1,
                    'created_by'=>$employer_id, 
                    'modified_by'=>$employer_id, 
                    'created_date'=>date("Y-m-d H:i:s"),
                    'modified_date'=>date("Y-m-d H:i:s"),
					'expire_time'=>$expire_time
                    );  
        if($status==1){
             $data["publish_date"]=date("Y-m-d H:i:s");
        }
        $inserted_id=$this->Employer_model->data_insert_emp_job('mm_master_job',$data);  
        if($inserted_id){
            echo json_encode(['msg'=>1,"inserted_id"=>$inserted_id]);              
        }else{
            echo json_encode(["msg"=>0]);
        }
    }
                
   }
   public function update_emp_job_data(){
    $employer_id=$this->session->userdata('employer_id');    
    $jid=$this->input->post('inserted_id');
    $pid=$this->input->post('package_id');
    $pmin=$this->input->post('pack_min_neurons');
    $sid=$this->input->post('skills_id');
    $per=$this->input->post('skills_per');

    if($pid!=''){        
        $pid1 =implode(",",$pid);
    }else{
        $pid1 ='';
    }
    if($pmin!=''){        
        $pmin1 =implode(",",$pmin);
    }else{
        $pmin1 ='';
    }
    if($sid!=''){        
        $sid1 =implode(",",$sid);
    }else{
        $sid1 ='';
    }
    if($per!=''){        
        $per1 =implode(",",$per);
    }else{
        $per1 ='';
    }

    $where="`job_id`='$jid'";
    $data = array(  
                    'package_id'=>$pid1,
                    'package_skills_id'=>$sid1,
                    'pack_min_neurons'=>$pmin1,
                    'skills_percentage'=>$per1,
                    'created_date'=>date("Y-m-d H:i:s"),
					'temp_skill_id'=>$sid1,
                    'modified_date'=>date("Y-m-d H:i:s")   
                );  
         //print_r($data); die();
         
        if($this->Crud_modal->update_data($where,'mm_master_job',$data)){
            echo "Successfully Submitted!";              
        }else{
            echo "Some Error Occurred!";
        }
                
   }
function job_desc_view(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
				$jid=$uri=$this->uri->segment(2);
				$code= base64_decode(str_pad(strtr($jid, '-_', '+/'), strlen($jid) % 4, '=', STR_PAD_RIGHT));     
				$data['jobdata']=$this->Employer_model->fetch_single_job($code);
                $this->load->view('employertempletes/head');
                $this->load->view('employertempletes/header');
                $this->load->view('job_desc_view',$data);
                $this->load->view('employertempletes/footer');
                $this->load->view('employertempletes/sidebar');
        }else{
                redirect(base_url().'employer');
        }
    }
    public function applied_condidate_detail(){
      $uid=$this->session->userdata('employer_id');
        $data['user_data']=$this->Employer_model->get_user_appied_data($uid);
        // echo "<pre>";
        // print_r($data);
        // echo "<pre>";     
        // exit; 
        $this->load->view('employertempletes/head');
        $this->load->view('employertempletes/header');
        $this->load->view('employertempletes/sidebar');
        $this->load->view('emp-condidate-detail',$data);
        $this->load->view('employertempletes/footer');
    }
function delete_emp_job(){
        $jid=$this->input->post("job_id"); 
        $r=$this->Employer_model->delete_record("mm_master_job","job_id",$jid);
        if($r==TRUE){
            echo "1";
        }else{
            echo "0";
        }
   }
 function share_emp_job(){
     $jid=$this->input->post("job_id"); 
     $st=$this->input->post("status"); 
     $where="`job_id`='$jid'";
     $data = array(  
                    'status'=>$st,
                    'created_date'=>date("Y-m-d H:i:s"),
                    'modified_date'=>date("Y-m-d H:i:s")   
                ); 
         if($st==1){
            $data["publish_date"]=date("Y-m-d H:i:s");
         } 
         if($this->Crud_modal->update_data($where,'mm_master_job',$data)){
                echo "1";              
         }else{
                echo "0";
         }
    }     
function employer_my_jobs(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
                $uid=$this->session->userdata('employer_id');
                $where="`employer_id`='$uid'";
                $empdat=$this->Crud_modal->fetch_single_data('employer_industry_id','mm_employer',$where);
                $inid = $empdat['employer_industry_id']; 
                $where="industry_id=$inid"; 
                $data["functional_area"]=$this->Crud_modal->all_data_select('*','mm_master_industry_functional',$where,'functional_id asc'); //print_r($data["functional_area"]); die;
        
                $functional_id=$this->input->post("selected_functional_id"); 
                $data["functional_id"]=$this->input->post("selected_functional_id"); 
                $data["jobs1"]= $this->Employer_model->get_jobs($uid);  //print_r($data["jobs"]); die;
                if($this->input->post('job_status')!=''){
                    //$data["jobs"]= $this->Employer_model->get_jobs_by_functional($uid,$functional_id); //echo $this->db->last_query(); die;
                      $status = $this->input->post('job_status');
                     if($status=='All'){
                          $data['message'] = 'Job Posted';
                          $data["filter_status"]='All';
                         $data["jobs1"]= $this->Employer_model->get_jobs($uid); 
                     }else{
                        $data["filter_status"]=$this->input->post('job_status');
                                             if($data["filter_status"]==0){
                                                 $data['message'] = 'Pending Jobs';                          
                                             }elseif($data["filter_status"]==1){
                                                 $data['message'] = 'Published Jobs';   
                                             }elseif($data["filter_status"]==2){
                                                 $data['message'] = 'Rejected Jobs';                     
                                             }elseif($data["filter_status"]==3){
                                                 $data['message'] = 'Unpublished Jobs';                      
                                             }
                        $data["jobs1"]= $this->Employer_model->get_jobs1($uid,$status); 
                     }
                    
                }else{
                    $status='1';
                    $data["filter_status"]='1';
                    $data['message'] = 'Published Jobs';
                    $data["jobs1"]= $this->Employer_model->get_jobs1($uid,$status);// print_r($data["jobs"]); die;
                }
                
                $this->load->view('employertempletes/head');
                $this->load->view('employertempletes/header');
                $this->load->view('emp-my-jobs',$data);
                $this->load->view('employertempletes/footer');
                $this->load->view('employertempletes/sidebar');
        }
        else{
            redirect(base_url().'employer');
        }
   }       	
    function edit_emp_job(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
            $uid=$this->session->userdata('employer_id');
            $where="`employer_id`='$uid'";
            $empdat=$this->Crud_modal->fetch_single_data('employer_industry_id','mm_employer',$where);
            $inid = $empdat['employer_industry_id'];
            $where="industry_id=$inid"; 
            $data["industry_name"]=$this->Crud_modal->all_data_select('*','mm_master_industry_topic',$where,'industry_id asc');
            $data["functional_areas"]=$this->Crud_modal->all_data_select('*','mm_master_industry_functional',$where,'functional_id asc'); 
            $iname=$this->input->post('industryname');
            if($this->input->post('industryname')!=""){ }
                $this->load->view('employertempletes/head');
                $this->load->view('employertempletes/header');
                $this->load->view('edit_job',$data);
                $this->load->view('employertempletes/footer');
                $this->load->view('employertempletes/sidebar');
        }else{
                redirect(base_url().'employer');
        }
	}
public function edit_emp_job_data(){
   // print_r($this->input->post());
    $employer_id=$this->session->userdata('employer_id');  
    $job_id=$this->input->post('job_id'); 
    $job_title=$this->input->post('job_title');
    $functional_name=$this->input->post('functional_name');
    $no_of_position=$this->input->post('no_of_position');
    $ctc_from=$this->input->post('ctc_from');
    $ctc_to=$this->input->post('ctc_to');
    $job_desc=$this->input->post('job_desc');
    $experience=$this->input->post('experience');
    $status=$this->input->post('status');
    $min_neurons=$this->input->post('min_neurons');
    $cities=$this->input->post('cities');
    $keys=$this->input->post('keywords');
	$loc_status=$this->input->post('show_location');
    if($cities!=''){        
        $cities1 =implode(",",$cities);
    }else{
        $cities1 ='';
    }
    $where="job_id=$job_id";
     if($job_desc=="" || $job_title=="" || $functional_name=="" || $no_of_position=="" ||  $experience==""){
        echo json_encode(["msg"=>2]);
     }
     else{
      $data = array(  
					'show_location'=>$loc_status,
					'keywords'=>$keys,
                    'job_title'=>$job_title,
                    'functional_id'=>$functional_name,
                    'no_of_position'=>$no_of_position,
                    'ctc_from'=>$ctc_from,
                    'ctc_to'=>$ctc_to,
                    'job_description'=>$job_desc,
                    'experience'=>$experience,
                    'status'=>$status,
                    'required_system_neurons'=>$min_neurons,
                    'job_location_id'=>$cities1,
                    'modified_by'=>$employer_id, 
                    'modified_date'=>date("Y-m-d H:i:s")
                    );  
          if($status==1){
             $data["publish_date"]=date("Y-m-d H:i:s");
          }
     
         if($this->Crud_modal->update_data($where,'mm_master_job',$data)){
                echo "1";              
         }else{
                echo "0";
         }
    }
}
  function applied_candidate_list(){
      if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){        
        $jid=$this->uri->segment(2); 
		$sum_arr=Array();
        $code= base64_decode(str_pad(strtr($jid, '-_', '+/'), strlen($jid) % 4, '=', STR_PAD_RIGHT)); 
        $data['search_val']="";
        $data['search_top']=""; 
		$data['search_date_from']="";
		$data['search_date_to']="";
		$data['job_details']=$this->Crud_modal->fetch_single_data("job_title,status,publish_date,experience,required_system_neurons,functional_id","mm_master_job","job_id='$code'");
		$this->db->query('SET SESSION group_concat_max_len=15000');
		 if($this->input->post("cut_off")!=""){
          $m=$this->input->post("cut_off");
          if($m!="*"){
				$job_pack= $this->Crud_modal->fetch_single_data("package_id","mm_master_job","job_id='$code'");
                $pack_id=$job_pack['package_id'];
				$sum_marks=$this->Crud_modal->all_data_select('sum(total_marks) as total_marks','mm_packages',"package_id in($pack_id)",'package_id asc');
				$cut_off_val=($sum_marks[0]['total_marks']*$m)/100;
                $data['search_top']=$m;
                $uids = $this->Crud_modal->fetch_single_data('group_concat(uid) as u_id','mm_user_applied_job',"job_id='$code'");
                $uid = $uids['u_id'];				
                $select = "sum(marks) as sum_neurons,u_id"; 
                $table_name="score s"; 
                $where= "s.package_id in($pack_id) ";  
                $group= "u_id";
                $having= "s.u_id in($uid) and sum(marks)>$cut_off_val";
                $order="sum_neurons desc";
                $limit = '';
                $neu=$this->Crud_modal->fetchdata_with_limit_and_having($select,$table_name,$where,$group,$having,$order,$limit);		
                $new_id_arr=[];				
                for($r=0;$r<sizeof($neu);$r++){
                    $new_id_arr[$r]=$neu[$r]['u_id'];
                }			
                if(!empty($new_id_arr)){
                    $new_id_list=implode(',',$new_id_arr);
                    $where="mmj.job_id=$code and maj.uid in($new_id_list)";
					$data['user_data'] = $this->Employer_model->get_user_appied_data_by_job_id($where,"FIELD(maj.uid,$new_id_list)");
					$data['select_cut']=$m;
                   	
                }else{
                    $data['user_data']=$this->Employer_model->get_user_appied_data_by_job_id("`mmj`.`job_id` = '$code'","`mmj`.`job_id`");
					$data['select_cut']=$m;
                }
          }
        }else if($this->input->post("filter_marks")!=""){
          $m=$this->input->post("filter_marks");
          if($m!="*"){
				$job_pack= $this->Crud_modal->fetch_single_data("package_id","mm_master_job","job_id='$code'");
                $pack_id=$job_pack['package_id'];
                $data['search_top']=$m;
                $uids = $this->Crud_modal->fetch_single_data('group_concat(uid) as u_id','mm_user_applied_job',"job_id='$code'");
                $uid = $uids['u_id'];
                $select = "sum(marks) sum_neurons,u_id"; 
                $table_name="score s"; 
                $where= "s.package_id in($pack_id)";  
                $group= "u_id";
                $having= "s.u_id in($uid)";
                $order="sum_neurons desc";
                $limit = $m;
                $neu=$this->Crud_modal->fetchdata_with_limit_and_having($select,$table_name,$where,$group,$having,$order,$limit);		
                $new_id_arr=[];				
                for($r=0;$r<sizeof($neu);$r++){
                    $new_id_arr[$r]=$neu[$r]['u_id'];
                }			
                if(!empty($new_id_arr)){
                    $new_id_list=implode(',',$new_id_arr);
                    $where="mmj.job_id=$code and maj.uid in($new_id_list)";
					$data['user_data'] = $this->Employer_model->get_user_appied_data_by_job_id($where,"FIELD(maj.uid,$new_id_list)");
                   	
                }else{
                    $data['user_data']=$this->Employer_model->get_user_appied_data_by_job_id("`mmj`.`job_id` = '$code'"); 
                }
          }
        }elseif($this->input->post("experience")!=""){
		  $years=0; 
		  $months=0; 
		  $new_u=Array(); 
		  $j=0; 
          $ex=$this->input->post("experience");
          $data['search_val']=$ex;
          $u=$this->Employer_model->get_user_appied_data_by_job_id("`mmj`.`job_id` = '$code'","`maj`.`created_data`");           
          for($i=0;$i<sizeof($u);$i++){
            $uid=$u[$i]['uid']; 
            $exp=$this->Crud_modal->fetch_single_data("sum(DATEDIFF(IFNULL(`emp_to`,Now()), `emp_from`)) as exp","work_experience","user_id =$uid");
			$years=0;
            if($exp['exp']!=0){
                $convert = $exp['exp']; // days you want to convert
                $years = ($convert / 365) ; // days / 365 days
                $years = floor($years); // Remove all decimals
                $month = ($convert % 365) / 30.5; // I choose 30.5 for Month (30,31) ;)
                $month = floor($month); // Remove all decimals
                if($years==0){ $years='0'; }
                if($years==1){ $years=$years; }
                if($years>1){ $years=$years; }
                if($month==0){ $month='0'; }
                if($month==1){ $month=$month; }
                if($month>1){ $month=$month; }  
                if($month>=6){$years=0.6;}              
            }else{  
                $years=0;
            }  
            if($years==$ex){ 
                $new_u[$j]=$u[$i]; 
                $j++;
            } 
          }  
          $data['user_data']= $new_u;    
          if($ex=="*"){
             $data['user_data']=$this->Employer_model->get_user_appied_data_by_job_id("`mmj`.`job_id` = '$code'","`maj`.`created_data`");
	
          }
        }elseif($this->input->post("from")!="" && $this->input->post("to")!=""){
            $from=date("Y-m-d",strtotime($this->input->post('from')));
            $to=date("Y-m-d",strtotime($this->input->post('to').'+1 days' ));
            $data['search_date_from']=date("m/d/Y",strtotime($from));
            $data['search_date_to']=date("m/d/Y",strtotime($to.'-1 days'));			
            $where="mmj.job_id = '$code' and date(maj.created_data) >= '$from' and date(maj.created_data)<'$to'";						
            $data['user_data'] = $this->Employer_model->get_user_appied_data_by_job_id($where,"`maj`.`created_data`");
			
        }else{
			$from=date("Y-m-d");
            $to=date("Y-m-d",strtotime(date().'+1 days' ));
			$data['search_date_from']=date("m/d/Y",strtotime($from));
            $data['search_date_to']=date("m/d/Y",strtotime($to.'-1 days'));			
            $where="mmj.job_id = '$code' and date(maj.created_data) >= '$from' and date(maj.created_data)<'$to'";						
            $data['user_data'] = $this->Employer_model->get_user_appied_data_by_job_id($where,"`maj`.`created_data`");
        }
        $data['code']=$jid;
		$data['total_count']=$this->Crud_modal->check_numrow("mm_user_applied_job","job_id = '$code'");
        $this->load->view('employertempletes/head');
        $this->load->view('employertempletes/header');
        $this->load->view('applied_candidate_list', $data);
        $this->load->view('employertempletes/footer');
        $this->load->view('employertempletes/sidebar');
      }
      else{
        redirect(base_url().'employer');
      }   
   }
public function export_data(){
  $code= base64_decode(str_pad(strtr($this->input->post('code'), '-_', '+/'), strlen($this->input->post('code')) % 4, '=', STR_PAD_RIGHT));
  if($this->input->post('ids_string')!=""){
   $_id=$this->input->post('ids_string');
   $id_list=str_replace('|', ',', $_id);
   $data['user_data']=$this->Employer_model->get_user_appied_data_by_job_id("mmj.job_id = $code and ud.uid in($id_list)","maj.created_data");
  }else{
    $data['user_data']=$this->Employer_model->get_user_appied_data_by_job_id("`mmj`.`job_id` = '$code'","`maj`.`created_data`");
  }
  $data['job_id']=$code; 
  echo $this->load->view('export_applied_candidate_list', $data,true);
}

   public function candidate_full_detail(){
	   if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        		$code= base64_decode(str_pad(strtr($this->uri->segment(2), '-_', '+/'), strlen($this->uri->segment(2)) % 4, '=', STR_PAD_RIGHT));
				$data['user_data']=$this->Crud_modal->fetch_single_data("*","user_data","uid='$code'");
				$data['user']=$this->Crud_modal->fetch_single_data("*","user","mm_uid='$code'");
				$data['neurons']=$this->Crud_modal->fetch_single_data("neurons","neurons","u_id='$code'");
				$data['wallet']=$this->Crud_modal->fetchdata_with_limit("total","mm_wallet","user_id='$code'","wallet_id desc","1");
				$data['cerificate']=$this->Crud_modal->fetchdata_with_limit("cerificate_id","mm_certificate_log","uid='$code'","certificate_log_id desc","1");
				// echo "<pre>";
				// print_r($data);
				// exit;
				$this->load->view('employertempletes/head');
                $this->load->view('employertempletes/header');
                $this->load->view('candidate_full_detail',$data);
                $this->load->view('employertempletes/footer');
                $this->load->view('employertempletes/sidebar');
	   }else{
	   }
   }
   function edit_job_second_step(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
            $uid=$this->session->userdata('employer_id');
            $where="`employer_id`='$uid'";
            $empdat=$this->Crud_modal->fetch_single_data('employer_industry_id','mm_employer',$where);
            $inid = $empdat['employer_industry_id'];
            $where="industry_id=$inid"; 
            $data["industry_name"]=$this->Crud_modal->all_data_select('*','mm_master_industry_topic',$where,'industry_id asc');
            $data["functional_areas"]=$this->Crud_modal->all_data_select('*','mm_master_industry_functional',$where,'functional_id asc'); 
			$jid=$uri=$this->uri->segment(2);
			$data["encoded_job_id"]=$jid;
            $code= base64_decode(str_pad(strtr($jid, '-_', '+/'), strlen($jid) % 4, '=', STR_PAD_RIGHT));      
            $data['jobdata']=$jobdat=$this->Employer_model->fetch_single_job($code);
            $pid=$data["package_ids"]=$jobdat['package_id']; 
            $data["job_id"]=$jobdat['job_id'];
            $data['master_package']=$this->Crud_modal->all_data_select("*","mm_packages","status='1' and package_id in($pid)","package_id asc");
            $data["pack_neurons"]=$jobdat['pack_min_neurons'];
            $data["skills_per"]=$jobdat['skills_percentage'];
            $data["skills_ids"]=$jobdat['package_skills_id'];
            $iname=$this->input->post('industryname');
            
            $iname=$this->input->post('industryname');
            if($this->input->post('industryname')!=""){ }
                $this->load->view('employertempletes/head');
                $this->load->view('employertempletes/header');
                $this->load->view('edit_job_second_step',$data);
                $this->load->view('employertempletes/footer');
                $this->load->view('employertempletes/sidebar');
        }else{
                redirect(base_url().'employer');
        }
   }
function edit_job_second_step_next(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
            $uid=$this->session->userdata('employer_id');
            $where="`employer_id`='$uid'";
            $empdat=$this->Crud_modal->fetch_single_data('employer_industry_id','mm_employer',$where);
            $inid = $empdat['employer_industry_id'];
            $where="industry_id=$inid"; 
            $data["industry_name"]=$this->Crud_modal->all_data_select('*','mm_master_industry_topic',$where,'industry_id asc');
            $data["functional_areas"]=$this->Crud_modal->all_data_select('*','mm_master_industry_functional',$where,'functional_id asc'); 
			$jid=$uri=$this->uri->segment(2);
			$data["encoded_job_id"]=$jid;
            $code= base64_decode(str_pad(strtr($jid, '-_', '+/'), strlen($jid) % 4, '=', STR_PAD_RIGHT));      
            $data['jobdata']=$jobdat=$this->Employer_model->fetch_single_job($code);
            $pid=$data["package_ids"]=$jobdat['package_id']; 
            $data["job_id"]=$jobdat['job_id'];
            $data['master_package']=$this->Crud_modal->all_data_select("*","mm_packages","status='1' and industry_id=$inid","package_id asc");
            $data["pack_neurons"]=$jobdat['pack_min_neurons'];
            $data["skills_per"]=$jobdat['skills_percentage'];
            $data["skills_ids"]=$jobdat['package_skills_id'];
            $iname=$this->input->post('industryname');
            
            $iname=$this->input->post('industryname');
            if($this->input->post('industryname')!=""){ }
                $this->load->view('employertempletes/head');
                $this->load->view('employertempletes/header');
                $this->load->view('edit_job_second_step_next',$data);
                $this->load->view('employertempletes/footer');
                $this->load->view('employertempletes/sidebar');
        }else{
                redirect(base_url().'employer');
        }
   }
      public function check_employer_email_valid(){
      if($this->input->post()!=''){
				$emailid=explode("@",$this->input->post('USEREMAIL'));
				if($emailid[1] == "hotmail.com" || $emailid[1] == "live.com" || $emailid[1] == "outlook.com" || $emailid[1] == "msn.com" || $emailid[1] == "yahoo.in" || $emailid[1] =="yahoo.com" || $emailid[1] =="rocketmail.com" || $emailid[1] =="yahoo.co.in" || $emailid[1] =="yahoomail.com" ){
					echo 1;
				}else{				
					$ch = curl_init();  
					$username="mondaymorning";
					$password="mondaymorning";
					$email=$this->input->post('USEREMAIL');
					$url="http://api.verify-email.org/api.php?usr=$username&pwd=$password&check=$email";
					curl_setopt($ch,CURLOPT_URL,$url);
					curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
					$output=curl_exec($ch);
					curl_close($ch);
					$data= json_decode($output);
					echo $data->verify_status;
				}
				
			}
    }

    public function email_employer_ajax_check(){
        $user_email=$this->input->post('USEREMAIL');
        $data_num=$this->Crud_modal->check_numrow("mm_employer","employer_email='$user_email' and eamil_auth_status='1'");
        if($data_num>0){
            echo "1";
        }else{
           echo "0"; 
        }
    }
	function edit_emp_job_after_applied(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
            $uid=$this->session->userdata('employer_id');
            $where="`employer_id`='$uid'";
            $empdat=$this->Crud_modal->fetch_single_data('employer_industry_id','mm_employer',$where);
            $inid = $empdat['employer_industry_id'];
            $where="industry_id=$inid"; 
            $data["industry_name"]=$this->Crud_modal->all_data_select('*','mm_master_industry_topic',$where,'industry_id asc');
            $data["functional_areas"]=$this->Crud_modal->all_data_select('*','mm_master_industry_functional',$where,'functional_id asc'); 
            $iname=$this->input->post('industryname');
            if($this->input->post('industryname')!=""){ }
               
                $this->load->view('employertempletes/head');
                $this->load->view('employertempletes/header');
                $this->load->view('edit_job_after_applied',$data);
                $this->load->view('employertempletes/footer');
                $this->load->view('employertempletes/sidebar');
        }else{
                redirect(base_url().'employer');
        }
    }
   public function edit_emp_job_data_after_applied(){
    $employer_id=$this->session->userdata('employer_id');  
    $job_id=$this->input->post('job_id'); 
    $no_of_position=$this->input->post('no_of_position');
    $job_desc=$this->input->post('job_desc');
    $keys=$this->input->post('keywords');
    
    $where="job_id=$job_id";
     if($job_desc=="" || $no_of_position==""){
        echo json_encode(["msg"=>2]);
     }
     else{
      $data = array(  
                    'no_of_position'=>$no_of_position,
                    'job_description'=>$job_desc,
                    'modified_by'=>$employer_id, 
                    'keywords'=>$keys,
                    'modified_date'=>date("Y-m-d H:i:s")
                    );  
         if($this->Crud_modal->update_data($where,'mm_master_job',$data)){
                echo "1";              
         }else{
                echo "0";
         }
     }
                
   }

public function emp_step_process_condidate(){
    if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $emp_id=$this->session->userdata('employer_id');    
        $br=explode("-",$this->uri->segment(2));
        $data['can_uid']=$can_uid= base64_decode(str_pad(strtr($br[0], '-_', '+/'), strlen($br[0]) % 4, '=', STR_PAD_RIGHT));
        $data['job_id']=$job_id= base64_decode(str_pad(strtr($br[1], '-_', '+/'), strlen($br[1]) % 4, '=', STR_PAD_RIGHT));
        $data['job_data']=$this->Crud_modal->fetch_single_data("*","mm_master_job","job_id='$job_id'");
        $data['applied_job_data']=$this->Crud_modal->fetch_single_data("*","mm_user_applied_job","job_id='$job_id' and uid='$can_uid'");
		
        $data['user_data']=$this->Crud_modal->fetch_single_data("contact_number","user_data","uid='$can_uid'");
        $data['user']=$this->Crud_modal->fetch_single_data("mm_user_email,mm_user_full_name,mm_last_name","user","mm_uid='$can_uid'");
        $data['cerificate']=$this->Crud_modal->fetchdata_with_limit("cerificate_id","mm_certificate_log","uid='$can_uid'","certificate_log_id desc","1");
        $data['neurons']=$this->Crud_modal->fetch_single_data("neurons","neurons","u_id='$can_uid'");
        $data['user_schedule']=$this->Crud_modal->all_data_select("*","mm_emp_job_interview_schedule_detail","uid='$can_uid' and job_id='$job_id' and created_by='$emp_id'","job_schedule_id asc");    
        $data['step_name']=$this->Crud_modal->all_data_select("*","mm_emp_job_process_step","1=1","step_id asc");
        $data['employer_detail']=$this->Employer_model->get_employer_detail($emp_id);    
            
        $this->load->view('employertempletes/head');
        $this->load->view('employertempletes/header');
        $this->load->view('emp-step-process-condidate',$data);
        $this->load->view('employertempletes/footer');
        $this->load->view('employertempletes/sidebar');
    }else{
            redirect(base_url().'employer');
    }

}
function job_desc_view_ajax(){
    if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $code= $this->input->post('job_id');  
        $data['jobdata']=$this->Employer_model->fetch_single_job($code);            
        echo $this->load->view('job_desc_view_ajax',$data,true);
    }
}
public function candidate_full_detail_ajax(){
    if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
            $code= $this->input->post('candidate_id');  
            $data['user_data']=$this->Crud_modal->fetch_single_data("*","user_data","uid='$code'");
            $data['user']=$this->Crud_modal->fetch_single_data("*","user","mm_uid='$code'");
            $data['neurons']=$this->Crud_modal->fetch_single_data("neurons","neurons","u_id='$code'");
            $data['wallet']=$this->Crud_modal->fetchdata_with_limit("total","mm_wallet","user_id='$code'","wallet_id desc","1");
            $data['cerificate']=$this->Crud_modal->fetchdata_with_limit("cerificate_id","mm_certificate_log","uid='$code'","certificate_log_id desc","1");           
            echo $this->load->view('candidate_full_detail_ajax',$data,true);
        }       
}
public function shortlist_status_update(){
   if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
       $applied_id = $this->input->post('applied_id');
       $status = $this->input->post('status');
       if($status==1){ // when reject
           if($this->Crud_modal->update_data("applied_job_id='$applied_id'","mm_user_applied_job",['job_process_step'=>'2-1'])){
               echo true;
           }else{
               echo false;
           }
       }else if($status==0){ // when shortlist for next round
           if($this->Crud_modal->update_data("applied_job_id='$applied_id'","mm_user_applied_job",['job_process_step'=>'3-0'])){     
               echo true;
           }else{
               echo false;
           }
       }else{
            echo false;
       }      
   }       
}
public function save_job_schedule_data(){
   if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
       print_r($this->input->post());
       if($this->input->post('schedule_id')==''){
           $data['mode']=$data1['mode']=$this->input->post('mode');
           $data['schedule_date_time']=$data1['reschedule_date_time']=date("Y-m-d H:i:s",strtotime($this->input->post('schedule_date').' '.$this->input->post('schedule_time')));
           if($data['mode']=="Face to Face"){
               $data['venue']=$this->input->post('venue');
           }        
           $data['round']=$data1['round']=$this->input->post('round');
           $data['job_id']= $data1['job_id']=$this->input->post('job_id');
           $data['uid']=$data1['uid']=$this->input->post('candidate_id');
           $data['created_date']=$data1['created_date']=date("Y-m-d H:i:s");
           $data['created_by']=$data1['created_by']=$this->session->userdata('employer_id');
           $this->Crud_modal->data_insert("mm_emp_job_interview_schedule_detail",$data);
           $this->Crud_modal->data_insert("mm_emp_job_reschedule",$data1);
       }else{
           $data['mode']=$data1['mode']=$this->input->post('mode');
           $data['schedule_date_time']=$data1['reschedule_date_time']=date("Y-m-d H:i:s",strtotime($this->input->post('schedule_date').' '.$this->input->post('schedule_time')));
           if($data['mode']=="Face to Face"){
               $data['venue']=$this->input->post('venue');
           }        
           $data['round']=$data1['round']=intval($this->input->post('round'))-1;
           $data['job_id']= $data1['job_id']=$this->input->post('job_id');
           $data['uid']=$data1['uid']=$this->input->post('candidate_id');
           $data['created_date']=$data1['created_date']=date("Y-m-d H:i:s");
           $data['created_by']=$data1['created_by']=$this->session->userdata('employer_id');
           $schedule_id=$this->input->post('schedule_id');
           $this->Crud_modal->update_data("job_schedule_id='$schedule_id'","mm_emp_job_interview_schedule_detail",$data);
           $this->Crud_modal->data_insert("mm_emp_job_reschedule",$data1);
       }
      

   }
}
function clear_interview(){
   if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
       //print_r($this->input->post());
       $data['round_status']=$this->input->post('status');
       $data['comment']=$this->input->post('comment');
       $schedule_id=$this->input->post('schedule_id');
       $applied_id=$this->input->post('applied_id');
       if($this->Crud_modal->update_data("applied_job_id='$applied_id'","mm_user_applied_job",['job_process_step'=>'4-0'])){
            if($this->Crud_modal->update_data("job_schedule_id='$schedule_id'","mm_emp_job_interview_schedule_detail",$data)){
               echo true;
            }else{
               echo false;
            }          
       }else{
           echo false;
       }
   }
}
function ongoing_interview(){
   if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
       $data['round_status']=$this->input->post('status');
       $data['comment']=$this->input->post('comment');
       $schedule_id=$this->input->post('schedule_id');
	   $applied_id=$this->input->post('applied_id');
       if($this->Crud_modal->update_data("job_schedule_id='$schedule_id'","mm_emp_job_interview_schedule_detail",$data)){
           $data1['uid']=$this->input->post('candidate_id');
           $data1['job_id'] =$this->input->post('job_id');
           $data1['round'] =$this->input->post('round');
           $data1['created_by'] =$this->session->userdata('employer_id');
           $data1['created_date'] =date("Y-m-d H:i:s");
            if($this->Crud_modal->data_insert("mm_emp_job_interview_schedule_detail",$data1)){
				$this->Crud_modal->update_data("applied_job_id='$applied_id'","mm_user_applied_job",['job_process_step'=>'3-0']);
               echo true;
            }else{
               echo false;
            }          
       }else{
           echo false;
       }
   }

}
function reject_interview(){
   if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
       //print_r($this->input->post());
       $data['round_status']=$this->input->post('status');
       $data['comment']=$this->input->post('comment');
       $schedule_id=$this->input->post('schedule_id');
       $applied_id=$this->input->post('applied_id');
       if($this->Crud_modal->update_data("applied_job_id='$applied_id'","mm_user_applied_job",['job_process_step'=>'3-1'])){
            if($this->Crud_modal->update_data("job_schedule_id='$schedule_id'","mm_emp_job_interview_schedule_detail",$data)){
               echo true;
            }else{
               echo false;
            }          
       }else{
           echo false;
       }
   }
}
function update_job_schedule_data(){
   if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
       $data['mode']=$data1['mode']=$this->input->post('mode');
       $data['schedule_date_time']=$data1['reschedule_date_time']=date("Y-m-d H:i:s",strtotime($this->input->post('schedule_date').' '.$this->input->post('schedule_time')));
       if($data['mode']=="Face to Face"){
           $data['venue']=$this->input->post('venue');
       }
       $data['comment']=$this->input->post('comment');        
       $data1['round']=intval($this->input->post('round'))-1;
       $data1['job_id']=$this->input->post('job_id');
       $data1['uid']=$this->input->post('candidate_id');
       $data['created_date']=$data1['created_date']=date("Y-m-d H:i:s");
       $data['created_by']=$data1['created_by']=$this->session->userdata('employer_id');
       $data['round_status']=0;
       $schedule_id=$this->input->post('schedule_id');      
       $this->Crud_modal->update_data("job_schedule_id='$schedule_id'","mm_emp_job_interview_schedule_detail",$data);
       $this->Crud_modal->data_insert("mm_emp_job_reschedule",$data1);
	   $applied_id=$this->input->post('applied_id');
	   $this->Crud_modal->update_data("applied_job_id='$applied_id'","mm_user_applied_job",['job_process_step'=>'3-0']);
   }    
}
function mail_interview_data(){
   if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
       $round=intval($this->input->post('round'))-1;
       $emp_id=$this->session->userdata('employer_id');        
       $job_id=$this->input->post('job_id');
       $uid = $this->input->post('candidate_id');
       $job_data=$this->Crud_modal->fetch_single_data("job_title,","mm_master_job","job_id='$job_id'");
       $emp_data=$this->Crud_modal->fetch_single_data("employer_company,employer_contact_person_name","mm_employer","employer_id='$emp_id'");
       $user_data=$this->Crud_modal->fetch_single_data("mm_user_full_name,mm_user_email","user","mm_uid='$uid'");
       $data['mode']=$this->input->post('mode');
       $data['schedule_date']=$this->input->post('schedule_date');
       $data['schedule_time']=$this->input->post('schedule_time');
       $data['venue']=$this->input->post('venue');
       $data['job_name']=$job_data['job_title'];
       $data['emp_name']=$emp_data['employer_contact_person_name'];
       $data['emp_compnay']=$emp_data['employer_company'];
       $data['user_name']=$user_data['mm_user_full_name'];
       $data['user_email']=$user_data['mm_user_email'];  
       if($this->input->post('data_action')==''){                      
           if($this->Mailer_model->schedule_mail_to_user($data)){
               echo true;
           }else{
               echo false;
           }
       }else{
           $old_schedule_data=$this->Employer_model->get_prev_schedule_date("reschedule_date_time,job_reschedule_id","mm_emp_job_reschedule","uid='$uid' and job_id='$job_id a' and round='$round' and created_by='$emp_id'","job_reschedule_id desc");
           $data['old_schedule_date']=date("F d,Y",strtotime($old_schedule_data['reschedule_date_time']));
           $data['old_schedule_time']=date("h:i A",strtotime($old_schedule_data['reschedule_date_time']));          
            if($this->Mailer_model->reschedule_mail_to_user($data)){
               echo true;
           }else{
               echo false;
           }

       }
      

   }   
}
function send_offer_to_user(){
   if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){        
       $config['upload_path']          = './upload/offer_letter/';
       $config['allowed_types']        = 'pdf';
       $config['max_size']             = 2000;
       $config['file_name'] = date("dmY").'-'.$_FILES['offer_letter']['name'];
       $this->load->library('upload', $config);            
       if ($this->upload->do_upload('offer_letter')){
           $data1 = $this->upload->data();
           $full_path= $data1['full_path'];
           $file_name= $data1['file_name'];          
           $data['offer_letter']=$data1['file_name'];
           $data['job_process_step']='5-0';
           $applied_id=$this->input->post('applied_job_id');
           $this->Crud_modal->update_data("applied_job_id='$applied_id'","mm_user_applied_job",$data);
           $job_id=$this->input->post('job_id');
           $uid = $this->input->post('candidate_id');
           $emp_id=$this->session->userdata('employer_id');
           $job_data=$this->Crud_modal->fetch_single_data("job_title,","mm_master_job","job_id='$job_id'");
           $emp_data=$this->Crud_modal->fetch_single_data("employer_company,employer_contact_person_name","mm_employer","employer_id='$emp_id'");
           $user_data=$this->Crud_modal->fetch_single_data("mm_user_full_name,mm_user_email","user","mm_uid='$uid'");
           $data1['job_name']=$job_data['job_title'];
           $data1['emp_compnay']=$emp_data['employer_company'];
           $data1['user_name']=$user_data['mm_user_full_name'];
           $data1['user_email']=$user_data['mm_user_email'];
           if($this->Mailer_model->send_offer_letter($full_path,$file_name,$data1)){
               echo true;
               $this->Crud_modal->update_data("applied_job_id='$applied_id'","mm_user_applied_job",$data);
           }else{
               echo false;
           }
       }

   }
}


function interview_final_mail(){
   if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
       $emp_id=$this->session->userdata('employer_id');        
       $job_id=$this->input->post('job_id');
       $uid = $this->input->post('candidate_id');
       $applied_job_id = $this->input->post('applied_job_id');
       $job_data=$this->Crud_modal->fetch_single_data("job_title,","mm_master_job","job_id='$job_id'");
       $emp_data=$this->Crud_modal->fetch_single_data("employer_company,employer_contact_person_name","mm_employer","employer_id='$emp_id'");
       $user_data=$this->Crud_modal->fetch_single_data("mm_user_full_name,mm_user_email","user","mm_uid='$uid'");
       $job_status=$this->Crud_modal->fetch_single_data("job_process_step","mm_user_applied_job","applied_job_id='$applied_job_id'");
       $process_step=explode('-', $job_status['job_process_step']);
       $data['job_name']=$job_data['job_title'];
       $data['emp_name']=$emp_data['employer_contact_person_name'];
       $data['emp_compnay']=$emp_data['employer_company'];
       $data['user_name']=$user_data['mm_user_full_name'];
       $data['user_email']=$user_data['mm_user_email'];
       if($process_step[0]==4){
           if($this->Mailer_model->interview_final_mail($data)){
               echo true;
           }else{
               echo false;
           }
       }

   }
}

public function confirm_employer_message(){
       $this->load->view('confirmation_message');
  }

   function employer_account_activation(){
     $em=$uri=$this->uri->segment(2);
     $email= base64_decode(str_pad(strtr($em, '-_', '+/'), strlen($em) % 4, '=', STR_PAD_RIGHT));  
     $this->db->select('*');
     $this->db->from('mm_employer');
     $this->db->where(array('employer_email'=>$email,'employer_status'=>'1','eamil_auth_status'=>'1'));
     $query = $this->db->get();
     if($query->num_rows() == 1){
         $result=$query->row_array();
         $uid=$result['employer_id'];
         $uemail=$result['employer_email'];
         $name=$result['employer_contact_person_name'];
         $login_user_data = array('emp_email'=>$uemail,'emp_name'=>$name,'employer_id'=>$uid); 
         $session_set= $this->session->set_userdata($login_user_data);
         redirect(base_url().'employer-dashboard');
     }else{
         redirect(base_url());
     }
  } 

public function shortlist_mail(){
   if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
       $emp_id=$this->session->userdata('employer_id');
       $job_id=$this->input->post('job_id');
       $uid = $this->input->post('candidate_id');
       $job_data=$this->Crud_modal->fetch_single_data("job_title,","mm_master_job","job_id='$job_id'");
       $emp_data=$this->Crud_modal->fetch_single_data("employer_company,employer_contact_person_name","mm_employer","employer_id='$emp_id'");
       $user_data=$this->Crud_modal->fetch_single_data("mm_user_full_name,mm_user_email","user","mm_uid='$uid'");
       $data['job_name']=$job_data['job_title'];
       $data['emp_name']=$emp_data['employer_contact_person_name'];
       $data['emp_compnay']=$emp_data['employer_company'];
       $data['user_name']=$user_data['mm_user_full_name'];
       $data['user_email']=$user_data['mm_user_email'];
       if($this->Mailer_model->shortlist_mail($data)){
           echo true;
       }else{
           echo false;
       }

   }
}

function confirm_joining(){
   if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
       $join=$this->input->post("join");
       $applied_id=$this->input->post("applied_job_id");
       if($join=="join"){
           $data['job_process_step']='6-0';
       }else if($join=="not join"){
           $data['job_process_step']='5-1';
       }
       if($this->Crud_modal->update_data("applied_job_id='$applied_id'","mm_user_applied_job",$data)){
           echo true;
       }else{
           echo false;
       }
   }
}
function get_same_day_schedule_user_count(){
   $emp_id=$this->session->userdata('employer_id');
   $date=date("Y-m-d",strtotime($this->input->post('date_value')));
   echo $this->Crud_modal->check_numrow("mm_emp_job_interview_schedule_detail","schedule_date_time like '%$date%'");  
}
function all_job_list(){
            if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
                $uid=$this->session->userdata('employer_id');
                $where="`employer_id`='$uid'";
                $empdat=$this->Crud_modal->fetch_single_data('employer_industry_id','mm_employer',$where);
                $inid = $empdat['employer_industry_id'];
                $where="industry_id=$inid"; 
                $data["functional_area"]=$this->Crud_modal->all_data_select('*','mm_master_industry_functional',$where,'functional_id asc');
                
                $functional_id=$this->input->post("selected_functional_id"); 
                $data["functional_id"]=$this->input->post("selected_functional_id"); 
                $data["jobs"]= $JOBDATA=$this->Employer_model->get_jobs($uid);  
                             
                for($i=0;$i<sizeof($JOBDATA);$i++){
                    $app_job=$this->Employer_model->get_total_applied($JOBDATA[$i]['job_id']);
                    $tap=$app_job['total_applied'];
                    $JOBDATA[$i]['total_job_applied']=$tap;
                }
                $datas['job']=$this->Employer_model->array_sort($JOBDATA, 'total_job_applied', SORT_DESC);
                $new_job_array=array();
                $j=0;
                foreach($datas as $job){ 
                    foreach ($job as $jb) {
                        $new_job_array[$j]["job_id"]=$jb["job_id"]; 
                        $new_job_array[$j]["job_title"]=$jb["job_title"];
                        $new_job_array[$j]["required_system_neurons"]=$jb["required_system_neurons"];
                        $new_job_array[$j]["company_id"]=$jb["company_id"];
                        $new_job_array[$j]["ctc_from"]=$jb["ctc_from"];
                        $new_job_array[$j]["ctc_to"]=$jb["ctc_to"];
                        $new_job_array[$j]["ctc_from"]=$jb["ctc_from"];
                        $new_job_array[$j]["status"]=$jb["status"];
                        $new_job_array[$j]["package_id"]=$jb["package_id"];
                        $new_job_array[$j]["industry_id"]=$jb["industry_id"];
                        $new_job_array[$j]["functional_id"]=$jb["functional_id"];
                        $new_job_array[$j]["job_created_date"]=$jb["job_created_date"];
                        $new_job_array[$j]["publish_date"]=$jb["publish_date"];
                        $new_job_array[$j]["remarks"]=$jb["remarks"];
                        $new_job_array[$j]["package_skills_id"]=$jb["package_skills_id"];
                        $new_job_array[$j]["functional_name"]=$jb["functional_name"];
                        $new_job_array[$j]["total_job_applied"]=$jb["total_job_applied"];
                        $j++;
                    }
                }
                $data["jobs"]=$new_job_array;
                if($this->input->post('selected_functional_id')!=''){
                    $data["jobs"]= $this->Employer_model->get_jobs_by_functional($uid,$functional_id); //echo $this->input->post('selected_functional_id'); exit;
                }else{
                    $data["jobs"]= $new_job_array;  
                }
                $this->load->view('employertempletes/head'); 
                $this->load->view('employertempletes/header');
                $this->load->view('all-job-list',$data); 
                $this->load->view('employertempletes/footer');
                $this->load->view('employertempletes/sidebar');

            }
            else{
                redirect(base_url().'employer');
            }
        }

public function job_viewer_list(){
       if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
            $uid=$this->session->userdata('employer_id');
            $publish_jobs=$this->Crud_modal->all_data_select('job_id','mm_master_job',"company_id=$uid and status=1",'job_id');
           
            $jids=implode(',', $publish_jobs[0]);
            if($jids!=''){
                $data["users"]=$udata=$this->Crud_modal->all_data_select('uid','mm_user_job_click',"employer_id=$uid",'user_job_click_id');
                for($i=0;$i<sizeof($udata);$i++){
                    $id=$udata[$i]['uid'];
                    $data["users"][$i]["education"]="NA";
                    $edu=$this->Crud_modal->fetch_single_data('grad_degree,pg_degree','user_data',"uid=$id");
                  
                    if($edu['pg_degree']!=""){
                        $id=$edu['pg_degree'];
                        $e=$this->Crud_modal->fetch_single_data('degree_name','master_degree',"md_id=$id");
                        $data["users"][$i]["education"]=$e['degree_name'];
                    }elseif($edu['grad_degree']!=""){
                        $id=$edu['grad_degree'];
                        $e=$this->Crud_modal->fetch_single_data('degree_name','master_degree',"md_id=$id");
                        $data["users"][$i]["education"]=$e['degree_name'];
                    }
                    
                    $u=$this->Crud_modal->fetch_single_data('mm_user_full_name','user',"mm_uid=$id");
                    $data["users"][$i]["name"]=$u['mm_user_full_name'];
                    $un=$this->Crud_modal->fetch_single_data('neurons','neurons',"u_id=$id");
                    $data["users"][$i]["neurons"]=$un['neurons'];
                }
            }
            $this->load->view('employertempletes/head');
            $this->load->view('employertempletes/header');
            $this->load->view('job-viewer-list',$data);
            $this->load->view('employertempletes/footer');
            $this->load->view('employertempletes/sidebar');
        }
        else{
            redirect(base_url().'employer');
        }
   }
public function apply_click_list(){
       if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
            $uid=$this->session->userdata('employer_id');
            $publish_jobs=$this->Crud_modal->fetch_single_data('Group_concat(job_id) as job_id','mm_master_job',"company_id=$uid",'job_id');
         
            $jids=$publish_jobs['job_id'];
            if($jids!=''){
                $data["users"]=$udata=$this->Crud_modal->all_data_select('*','mm_user_applied_job',"job_id in($jids)",'applied_job_id');
                for($i=0;$i<sizeof($udata);$i++){
                    $id=$udata[$i]['uid'];
                    $data["users"][$i]["education"]="NA";
                    $edu=$this->Crud_modal->fetch_single_data('grad_degree,pg_degree','user_data',"uid=$id");
                  
                    if($edu['pg_degree']!=""){
                        $id=$edu['pg_degree'];
                        $e=$this->Crud_modal->fetch_single_data('degree_name','master_degree',"md_id=$id");
                        $data["users"][$i]["education"]=$e['degree_name'];
                    }elseif($edu['grad_degree']!=""){
                        $id=$edu['grad_degree'];
                        $e=$this->Crud_modal->fetch_single_data('degree_name','master_degree',"md_id=$id");
                        $data["users"][$i]["education"]=$e['degree_name'];
                    }
                    
                }
            }
            $this->load->view('employertempletes/head');
            $this->load->view('employertempletes/header');
            $this->load->view('apply-click-list',$data);
            $this->load->view('employertempletes/footer');
            $this->load->view('employertempletes/sidebar');
        }
        else{
            redirect(base_url().'employer');
        }
   }
public function candidate_comparison_chart(){
      if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $years=0; $months=0; $new_u=Array(); $j=0; $data['search_val']="";
       $data['search_ssc_per']=""; $data['search_hsc_per']="";
        $jid=$this->input->post("job_id");
        $id_lists=$this->input->post("id_list");
        $code= base64_decode(str_pad(strtr($jid, '-_', '+/'), strlen($jid) % 4, '=', STR_PAD_RIGHT));
        if($id_lists!=""){}else{
            redirect(base_url().'all-job-list');
        }
        $data['job_data']=$this->Employer_model->fetch_single_job($code); 
        $id_list=str_replace('|', ',', $id_lists);

        $data['id_list']=$id_lists;

        if($this->input->post("ssc_per")!="" && $this->input->post("hsc_per")!=""){
          $ssc_per_cond=$this->input->post("ssc_per");
          $hsc_per_cond=$this->input->post("hsc_per"); 
          $data['search_ssc_per']=$ssc_per_cond;
          $data['search_hsc_per']=$hsc_per_cond;
          $idArr=explode(',',$id_list);
          $k=0; $filter_arr=[];
          for($i=0;$i<sizeof($idArr);$i++){
            $uid=$idArr[$i];
            $shper=$this->Crud_modal->fetch_single_data("ssc_marks_per,hsc_marks_per","user_data","uid =$uid");
            $res1=$this->Employer_model->check_percentage($shper['ssc_marks_per'],$ssc_per_cond);
            $res2=$this->Employer_model->check_percentage($shper['hsc_marks_per'],$hsc_per_cond);
            if($res1 && $res2){
                $filter_arr[$k]=$uid;
                $k++;
            }
          }  
          if(!empty($filter_arr)){
            $new_id_list=implode(',',$filter_arr);
            $data['user_data']= $this->Crud_modal->all_data_select("*","mm_user_applied_job","job_id=$code and uid in($new_id_list)","applied_job_id"); 
          }
        }elseif($this->input->post("exp_gap")!=""){
          $idArr=explode(',',$id_list);
          $l=0; $filter_arr=[];
          for($i=0;$i<sizeof($idArr);$i++){
            $uid=$idArr[$i]; //echo "<b>".$uid."</b> ";//1767 1767 26 2 1706 37
            $exp=$this->Crud_modal->all_data_select("*","work_experience","user_id =$uid","work_exe_id desc");
            $emp_from=0; $emp_to=0;
            for($jk=0;$jk<sizeof($exp);$jk++){
                if($jk==0){
                    $emp_from=$exp[$jk]['emp_from'];
                }
                if($jk==1){
                    $emp_to=$exp[$jk]['emp_to'];
                }
            }
           // echo $emp_from."  ".$emp_to."<br>";
            if($emp_from!="" && $emp_to!=""){
                $datetime1 = strtotime($emp_to);
                $datetime2 = strtotime($emp_from);
                $secs = $datetime2 - $datetime1;// == <seconds between the two times>
                $days = floor($secs / (24 * 60 * 60 ));
            }else{
                $days = -1 ;
            }
             //echo $days." ";
            if($days<30 && $days>0){
                $filter_arr[$l]=$uid;
                $l++;
            }
          }  
          if(!empty($filter_arr)){
            $new_id_list=implode(',',$filter_arr);
            $data['user_data']= $this->Crud_modal->all_data_select("*","mm_user_applied_job","job_id=$code and uid in($new_id_list)","applied_job_id"); 
          }
          //print_r($data['user_data']);
        // exit;
        }elseif($this->input->post("ssc_per")!=""){
          $ssc_per_cond=$this->input->post("ssc_per");
          $data['search_ssc_per']=$ssc_per_cond;
          $idArr=explode(',',$id_list);
          $k=0; $filter_arr=[];
          for($i=0;$i<sizeof($idArr);$i++){
            $uid=$idArr[$i];
            $sper=$this->Crud_modal->fetch_single_data("ssc_marks_per","user_data","uid =$uid");
            $res=$this->Employer_model->check_percentage($sper['ssc_marks_per'],$ssc_per_cond);
            if($res){
                $filter_arr[$k]=$uid;
                $k++;
            }
          }  
          if(!empty($filter_arr)){
            $new_id_list=implode(',',$filter_arr);
            $data['user_data']= $this->Crud_modal->all_data_select("*","mm_user_applied_job","job_id=$code and uid in($new_id_list)","applied_job_id"); 
          }
        }elseif($this->input->post("hsc_per")!=""){
          $hsc_per_cond=$this->input->post("hsc_per");
          $data['search_hsc_per']=$hsc_per_cond;
          $idArr=explode(',',$id_list);
          $k=0; $filter_arr=[];
          for($i=0;$i<sizeof($idArr);$i++){
            $uid=$idArr[$i];
            $hper=$this->Crud_modal->fetch_single_data("hsc_marks_per","user_data","uid =$uid");
            $res=$this->Employer_model->check_percentage($hper['hsc_marks_per'],$hsc_per_cond);
            if($res){
                $filter_arr[$k]=$uid;
                $k++;
            }
          }  
          if(!empty($filter_arr)){
            $new_id_list=implode(',',$filter_arr);
            $data['user_data']= $this->Crud_modal->all_data_select("*","mm_user_applied_job","job_id=$code and uid in($new_id_list)","applied_job_id"); 
          }
        }elseif($this->input->post("education")!=""){
          $st=$this->input->post("education");
          $data['search_edu']=$st;
          $idArr=explode(',',$id_list);
          $k=0; $filter_arr=[];
          for($i=0;$i<sizeof($idArr);$i++){
            $uid=$idArr[$i];
            $year_gap=$this->Crud_modal->fetch_single_data("(hsc_year_pass-ssc_year_pass) as hyear","user_data","uid =$uid");
            if($year_gap['hyear']>0 && $year_gap['hyear']==2){
                $filter_arr[$k]=$uid;
                $k++;
            }
          }  
          if(!empty($filter_arr)){
            $new_id_list=implode(',',$filter_arr);
            $data['user_data']= $this->Crud_modal->all_data_select("*","mm_user_applied_job","job_id=$code and uid in($new_id_list)","applied_job_id"); 
          }
          
        }elseif($this->input->post("experience")!=""){
          $ex=$this->input->post("experience");
          $data['search_val']=$ex;
          $u=$this->Crud_modal->all_data_select("*","mm_user_applied_job","job_id=$code and uid in($id_list)","applied_job_id");
          for($i=0;$i<sizeof($u);$i++){
            $uid=$u[$i]['uid']; 
            $exp=$this->Crud_modal->fetch_single_data("sum(DATEDIFF(`emp_to`, `emp_from`)) as exp","work_experience","user_id =$uid");
         
            $years=0;
            if($exp['exp']!=0){
                $convert = $exp['exp']; // days you want to convert
                $years = ($convert / 365) ; // days / 365 days
                $years = floor($years); // Remove all decimals
                $month = ($convert % 365) / 30.5; // I choose 30.5 for Month (30,31) ;)
                $month = floor($month); // Remove all decimals
                if($years==0){ $years='0'; }
                if($years==1){ $years=$years; }
                if($years>1){ $years=$years; }
                if($month==0){ $month='0'; }
                if($month==1){ $month=$month; }
                if($month>1){ $month=$month; }                                
                // if($month<12 && $years==0){
                //     $years=0;
                // }
                if($month>=6){$years=0.6;}
            }else{  
                $years=0;
            } 
           
            if($years==$ex){ 
                $new_u[$j]['experience_u']=$years; 
                $new_u[$j]['applied_job_id']= $u[$i]['applied_job_id'];
                $new_u[$j]['uid']= $u[$i]['uid'];
                $new_u[$j]['designation']= $u[$i]['designation'];
                $new_u[$j]['preferred_location_id']= $u[$i]['preferred_location_id'];
                $new_u[$j]['name']= $u[$i]['name'];
                $new_u[$j]['job_id']= $u[$i]['job_id'];
                $new_u[$j]['phone_no']= $u[$i]['phone_no'];
                $new_u[$j]['dob']= $u[$i]['dob'];
                $new_u[$j]['gender']= $u[$i]['gender'];
                $new_u[$j]['resume_link']= $u[$i]['resume_link'];
                $new_u[$j]['created_data']= $u[$i]['created_data'];
                $new_u[$j]['skills']= $u[$i]['skills'];
                $new_u[$j]['skill_per']= $u[$i]['skill_per'];
                $new_u[$j]['pack_min_neurons']= $u[$i]['pack_min_neurons'];
                $new_u[$j]['job_process_step']= $u[$i]['job_process_step'];

                $j++;
            } 
          }  
          $data['user_data']= $new_u;    
          if($ex=="*"){
            $data['user_data']=$this->Crud_modal->all_data_select("*","mm_user_applied_job","job_id=$code and uid in($id_list)","applied_job_id");
          }
        }else{
            $data['user_data']=$this->Crud_modal->all_data_select("*","mm_user_applied_job","job_id=$code and uid in($id_list)","applied_job_id");
        }
        $data['code']=$jid;
       
        $this->load->view('employertempletes/head'); 
        $this->load->view('employertempletes/header');
        $this->load->view('candidate-comparison-chart',$data); 
        $this->load->view('employertempletes/footer');
        $this->load->view('employertempletes/sidebar');
      }else{
        redirect(base_url().'employer');
      }
    }
	
	public function open_user_job(){
		$emp_id=$this->session->userdata('employer_id');
		$job_id=base64_decode(str_pad(strtr($this->uri->segment(2), '-_', '+/'), strlen($this->uri->segment(2)) % 4, '=', STR_PAD_RIGHT));
		$job_published=$this->Crud_modal->fetch_single_data("*","mm_master_job","job_id='$job_id' ");
		$id=$job_published['job_id']; 
		$pack_id=$job_published['package_id'];
		$data['pack_id']=$pack_id;
		$data['job_title']=$job_published['job_title'];
		$count_val=0;
		if($pack_id!=''){
		$select="u_id";
		$table_name="score";
		$where="package_id in($pack_id) and u_id not in (select uid from mm_user_applied_job where job_id='$id') and u_id in (select mm_uid from user where user_type_id='2') ";
		$group="u_id";
		$having="count(u_id) = (SELECT count(ml_id) FROM `master_level` WHERE `pack_id`  in($pack_id) and `ml_status` = '1')";
		$order="score_id desc";
		$limit ="";										   
		$package_neurons=$this->Crud_modal->fetchdata_with_limit_and_having($select,$table_name,$where,$group,$having,$order,$limit);
		}
		$data['package_neurons']=$package_neurons;
		$this->load->view('employertempletes/head'); 
        $this->load->view('employertempletes/header');
        $this->load->view('eligible-candidate',$data); 
        $this->load->view('employertempletes/footer');
        $this->load->view('employertempletes/sidebar');
	}
public function bulk_cv_download(){
        $emp_id=$this->session->userdata('employer_id');
        $this->load->library('zip');
        $limit=explode("-",$this->input->post('id_s'));
        $limit[1]=$limit[1]-$limit[0];
        $job_id=base64_decode(str_pad(strtr($this->input->post('job'), '-_', '+/'), strlen($this->input->post('job')) % 4, '=', STR_PAD_RIGHT));
        $job_resume=$this->Crud_modal->fetchdata_with_stat_and_end_limit("uid,resume_link","mm_user_applied_job","job_id='$job_id'","created_data desc",$limit);
		// echo $this->db->last_query();
		// echo "<pre>";
		// print_r($job_resume);
        $job_n=$this->Crud_modal->fetch_single_data("job_title","mm_master_job","job_id='$job_id'");
        $job_name=$job_n['job_title'];
        $path="./upload/user_resume/";
        foreach ($job_resume as $value) {
            $name = $value['resume_link'];              
            //if($name!=''){
                   // *** False ***** for not directory structure ***** True *** for make file into directory structure       
                $this->zip->read_file($path . $name, false); 
            //}
           
        }
        $str_array=[' ','/',')','('];
        $str_replaces=str_replace($str_array,'_', $job_name);
        $nameq=date("Y_m_d").'_'.$str_replaces.$emp_id;        
        $this->zip->archive('assets/temp_bulk_cv_save/'.$nameq.'.zip');
        echo json_encode(["url"=>base_url().'assets/temp_bulk_cv_save/'.$nameq.'.zip',"file_name"=>$nameq.'.zip']);
       // $this->zip->download($name);

   }
   function delete_file(){
        $date=$this->input->post('link');
        unlink('./assets/temp_bulk_cv_save/'.$date);
        echo 1;
   } 
public function create_job_questionaire(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
       $emp_id=$this->session->userdata('employer_id');
       $data['jobs'] = $this->Crud_modal->all_data_select("job_id,job_title,status","mm_master_job","company_id='$emp_id' and status in(0,1,2,3)",'job_id desc');
       $this->load->view('employertempletes/head');
       $this->load->view('employertempletes/header');
       $this->load->view('job-questionnaire',$data);
       $this->load->view('employertempletes/footer');
       $this->load->view('employertempletes/sidebar');
        }else{
        redirect(base_url().'employer','refresh');
        }
   }
public function save_questionnaire(){
       $jid=$this->input->post('job_id');
       $oid=$this->input->post('order');
       $data_array = array(
           'job_id'=>$this->input->post('job_id'), 
           'job_question'=>$this->input->post('question'), 
           'tool_wise'=>$this->input->post('form_element'),
           'options_value'=>$this->input->post('items'),
           'order_id'=>$this->input->post('order'),
           'company_id'=>$this->session->userdata('employer_id'),
           'status'=>1,
           'is_mand'=>$this->input->post('is_mand'),
           'created_date'=>date('Y-m-d H:i:s'),
           'modified_date'=>date('Y-m-d H:i:s')
       );
       $check_order_exist=$this->Crud_modal->fetch_single_data('order_id','mm_master_job_question',"order_id=$oid and job_id=$jid and status=1");
       if($check_order_exist['order_id']!=""){
           echo 2; //order already exists in that job
       }else{
           if($data_return=$this->Crud_modal->data_insert('mm_master_job_question',$data_array)){
               echo 1;
           }else{
               echo 0; 
           }
       }
   }


     public function view_job_questionaire(){
        $emp_id=$this->session->userdata('employer_id');
        $data['jobs'] = $this->Crud_modal->all_data_select("job_id,job_title","mm_master_job","company_id='$emp_id' and status in(0,1)",'job_id desc');
        $this->load->view('employertempletes/head'); 
        $this->load->view('employertempletes/header');
        $this->load->view('view-questionnaire',$data); 
        $this->load->view('employertempletes/footer');
        $this->load->view('employertempletes/sidebar');
    }
   public function get_job_questionnaire(){
    if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
       $jid=$this->input->post('job_id');
       $data=$this->Crud_modal->all_data_select('*','mm_master_job_question',"job_id=$jid and status=1","order_id asc");
       echo json_encode($data);
        }else{
        redirect(base_url().'employer','refresh');
    }
   }
    public function delete_job_question(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
            $id = $this->input->post('job_question_id'); 
            $where="job_question_id = '$id'";
            $tblname='mm_master_job_question';
            $field = array('status'=>0);
            if($this->Crud_modal->update_data($where,$tblname,$field)){
                echo '{"msg":"Record Deleted"}';
            }else{
                echo '{"msg":"Some Error"}';
            }
        }else{
            redirect(base_url().'employer','refresh');
        }
    }
   public function get_job_question(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
            $eid=$this->session->userdata('employer_id');
            $id = $this->input->post('job_question_id'); 
            $data1['edit_data'] = $this->Crud_modal->fetch_single_data('*','mm_master_job_question',"job_question_id = '$id'");
            $data1['job_list']=$this->Crud_modal->all_data_select('job_id,job_title,status','mm_master_job',"company_id=$eid ",'job_id desc');
            echo json_encode($data1); 
        }else{
            redirect(base_url().'employer','refresh');
        }
    }
public function update_questionnaire(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
       $jqid=$this->input->post('job_question_id');
       $jid=$this->input->post('job_id');
       $oid=$this->input->post('order');
	   $job_status=$this->input->post('job_status');
       if($job_status=="Pending"){
           $data_array = array(
           'job_id'=>$this->input->post('job_id'),
           'job_question'=>$this->input->post('question'),
           'tool_wise'=>$this->input->post('form_element'),
           'options_value'=>$this->input->post('items'),
           'order_id'=>$this->input->post('order'),
           'is_mand'=>$this->input->post('is_req'),
           'modified_date'=>date('Y-m-d H:i:s')
         );
       }else{
           $data_array = array(
           'job_question'=>$this->input->post('question'),
           'is_mand'=>$this->input->post('is_req'),
           'modified_date'=>date('Y-m-d H:i:s')
         );
       }
       if($data_return=$this->Crud_modal->update_data("job_question_id=$jqid",'mm_master_job_question',$data_array)){
           echo 1;
       }else{
           echo 0;
       }
        }else{
        redirect(base_url().'employer','refresh');
    }
   }
	
	public function create_employer_skills(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $emp_id=$this->session->userdata('employer_id');
        $data['data_skills']=$this->Crud_modal->all_data_select("*","mm_employer_skill","cmp_id='$emp_id' and status='1'",'');
        $this->load->view('employertempletes/head'); 
        $this->load->view('employertempletes/header');
        $this->load->view('emp-internal-add-record-form',$data); 
        $this->load->view('employertempletes/footer');
        $this->load->view('employertempletes/sidebar');
        }
        else{
            redirect(base_url().'employer');
        }
    }

    public function insert_employer_skills(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $emp_id=$this->session->userdata('employer_id');
        $skills_name=$this->input->post('skills_name');
        $file_name=$_FILES["userfile"]["name"];
        $skill_description=$this->input->post('skill_description');
        if($skills_name!='' && $file_name!='' && $skill_description!=''){

        $check=$this->Crud_modal->check_numrow("mm_employer_skill","cmp_id='$emp_id' and status='1' and skill_name='$skills_name'");
        if($check>0){
            $this->session->set_flashdata('data_message', 'You have already added this skills '.$skills_name);
            redirect(base_url().'create-employer-skills','refresh');
        }
        ###########skills upload ########################
        $imageFileType = pathinfo($_FILES["userfile"]["name"], PATHINFO_EXTENSION);                                      
        if($imageFileType!='jpg' && $imageFileType!='png' && $imageFileType!='jpeg' && $imageFileType!='PNG'){
            $this->session->set_flashdata('data_message', 'Image file not supported (Only extensions jpg are allowed).');
            redirect(base_url().'create-employer-skills','refresh');
        }
        $new_name=time().'_'.$_FILES["userfile"]['name'];
        $config = array(
        'upload_path' => "assets/images/skillicon/skillsicon/",
        'allowed_types' => "jpg|png|jpeg", 
        'overwrite' => TRUE,
        'max_size' => "100",
        'max_width' => "38",
        'max_height' => "38",
        'file_name' => $new_name
        );
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload())
        {
        $this->session->set_flashdata('data_message', $this->upload->display_errors());
        redirect(base_url().'create-employer-skills','refresh');
        }
        ###########skills upload ########################
        $company=$this->Crud_modal->fetch_single_data("employer_industry_id","mm_employer","employer_id='$emp_id'");
        $createdata=array('skill_name'=>$this->input->post('skills_name'),
                          'status'=>'1',
                          'cmp_id'=>$emp_id,
                          'skill_icon'=>$new_name,
                          'skills_desc'=>$this->input->post('skill_description'),
                          'indus_id'=>$company['employer_industry_id'],
                          'creation_date'=>date('Y-m-d H:i:s'),
                          'modification_date'=>date('Y-m-d H:i:s'),
                          'modified_by'=>$emp_id,
                          'created_by'=>$emp_id
        );
        if($this->Crud_modal->data_insert("mm_employer_skill",$createdata)){
            $this->session->set_flashdata('data_message','<div class="success"><strong>You have successfully created the Skiils!</strong></div>');
            redirect(base_url().'create-employer-skills');
        }
        }else{
            $this->session->set_flashdata('data_message','<div class="success"><strong>Something went wrong!</strong></div>');
            redirect(base_url().'create-employer-skills');
        }
        }
        else{
            redirect(base_url().'employer');
        }
        }
public function preview_job_questionaire(){
       $emp_id=$this->session->userdata('employer_id');
       //$data['jobs'] = $this->Crud_modal->all_data_select("job_id,job_title,status","mm_master_job","company_id='$emp_id' and status in(0,1,3)",'job_id desc');
       $where_state_id="country_id='101'";
       $data['state']=$this->Crud_modal->all_data_select('*','states',$where_state_id,'name asc');
       $data['university']=$this->Crud_modal->all_data_select('*','master_university',"un_status='1'",'un_name asc');
       if($this->input->post("job_id")!=""){
           $j=$this->input->post("job_id");
           $jt=$this->Crud_modal->fetch_single_data("job_title","mm_master_job","job_id=".$j);
           $data['job_title']=$jt['job_title'];
           $data['screening_data']=$this->Crud_modal->all_data_select("job_question,tool_wise,job_question_id,options_value,is_mand","mm_master_job_question","job_id=$j AND status='1'","order_id ASC");
           $data['show_div']=1;
           $data['selected_job_id']=$j;
       }else{
           $data['screening_data']="";
           $data['show_div']=0;
           $data['selected_job_id']="";
       }
        $this->load->view('employertempletes/head');
        $this->load->view('employertempletes/header');
        $this->load->view('preview-job-questionnaire',$data);  
        $this->load->view('employertempletes/footer');
        $this->load->view('employertempletes/sidebar');
   }

        // public function emp_skills_view(){
            // if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
            // $emp_id=$this->session->userdata('employer_id');
            // $data['data_skills']=$this->Crud_modal->all_data_select("*","mm_employer_skill","cmp_id='$emp_id' and status='1'",'');
            // $this->load->view('employertempletes/head'); 
            // $this->load->view('employertempletes/header');
            // $this->load->view('emp-skills-view',$data); 
            // $this->load->view('employertempletes/footer');
            // $this->load->view('employertempletes/sidebar');
            // }
            // else{
                // redirect(base_url().'employer');
            // }
        // }

        public function edit_employer_skills(){
            if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
            $v = $this->uri->segment(2);
            $emp_id=$this->session->userdata('employer_id');
            $val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
            $data['title']='Admin Dashboard for MondayMorning';
            $where = "emp_skill_id='$val' and cmp_id='$emp_id'";
            $data['data_skills']=$this->Crud_modal->fetch_single_data('*','mm_employer_skill',$where);
            $this->load->view('employertempletes/head'); 
            $this->load->view('employertempletes/header');
            $this->load->view('emp-edit-skills',$data); 
            $this->load->view('employertempletes/footer');
            $this->load->view('employertempletes/sidebar');
            }
            else{
                redirect(base_url().'employer');
            }
        }


    public function edit_insert_employer_skills(){
            if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
            $skills_id=$this->input->post('skills_id');
            $emp_id=$this->session->userdata('employer_id');
            $skills_name=$this->input->post('skills_name');
            $file_name=$_FILES["userfile"]["name"];
            $skill_description=$this->input->post('skill_description');
             $company=$this->Crud_modal->fetch_single_data("employer_industry_id","mm_employer","employer_id='$emp_id'");
            ############new post ##############################
            if($file_name!=''){
            $file='assets/images/skillicon/skillsicon/'.$this->input->post('old_icon');
            unlink($file);
            $imageFileType = pathinfo($_FILES["userfile"]["name"], PATHINFO_EXTENSION);                                        
            if($imageFileType!='jpg'){
                $this->session->set_flashdata('data_message', 'Image file not supported (Only extensions jpg are allowed).');
                redirect(base_url().'create-employer-skills','refresh');
            }
            $new_name=time().'_'.$_FILES["userfile"]['name'];
            $config = array(
            'upload_path' => "assets/images/skillicon/skillsicon/",
            'allowed_types' => "jpg",
            'overwrite' => TRUE,
            'max_size' => "50",
            'file_name' => $new_name
            );
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload())
            {
            $this->session->set_flashdata('data_message', $this->upload->display_errors());
            redirect(base_url().'edit-employer-skills','refresh');
            }
            $createdata=array('skill_name'=>$this->input->post('skills_name'),
                              'status'=>'1',
                              'cmp_id'=>$emp_id,
                              'skill_icon'=>$new_name,
                              'skills_desc'=>$this->input->post('skill_description'),
                              'indus_id'=>$company['employer_industry_id'],
                              'creation_date'=>date('Y-m-d H:i:s'),
                              'modification_date'=>date('Y-m-d H:i:s'),
                              'modified_by'=>$emp_id,
                              'created_by'=>$emp_id
                );
            }else{
                  $createdata=array('skill_name'=>$this->input->post('skills_name'),
                              'status'=>'1',
                              'cmp_id'=>$emp_id,
                              'skills_desc'=>$this->input->post('skill_description'),
                              'indus_id'=>$company['employer_industry_id'],
                              'creation_date'=>date('Y-m-d H:i:s'),
                              'modification_date'=>date('Y-m-d H:i:s'),
                              'modified_by'=>$emp_id,
                              'created_by'=>$emp_id
                );
                  
            }
            ############new post ##############################
            $where = "emp_skill_id='$skills_id'";
            if($this->Crud_modal->update_data($where,'mm_employer_skill',$createdata)){
                 $where = "emp_skill_id='$skills_id' and cmp_id='$emp_id'";
                 $data['data_skills']=$this->Crud_modal->fetch_single_data('*','mm_employer_skill',$where);
                 $this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Updated.</div>');
                redirect(base_url().'edit-employer-skills/'.rtrim(strtr(base64_encode($skills_id), '+/', '-_'), '='));
            }else{
                $this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Updated Data</div>');
                redirect(base_url().'edit-employer-skills/'.rtrim(strtr(base64_encode($skills_id), '+/', '-_'), '='));
            }
            $this->load->view('employertempletes/head'); 
            $this->load->view('employertempletes/header');
            $this->load->view('edit-insert-employer-skills',$data); 
            $this->load->view('employertempletes/footer');
            $this->load->view('employertempletes/sidebar');
            }
            else{
                redirect(base_url().'employer');
            }
        }
		
		##############new functionalities employer ################
   public function employee_add_dep(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $emp_id=$this->session->userdata('employer_id');
         $data['company']=$this->Crud_modal->fetch_single_data("employer_company","mm_employer","employer_id='$emp_id'");
        $data['unit_det']=$this->Crud_modal->all_data_select("*","mm_company_unit","company_id='$emp_id' and status='1'", '');
        $data['company_deparment'] =  $this->Crud_modal->all_data_select('*','mm_company_department',"status=1 and company_id='$emp_id'",'department_id');
        //print_r($data['company_deparment']); die; 
        $this->load->view('employertempletes/head'); 
        $this->load->view('employertempletes/header');
        $this->load->view('emp-add-department',$data); 
        $this->load->view('employertempletes/footer');
        $this->load->view('employertempletes/sidebar');
        }
        else{
            redirect(base_url().'employer');
        }
    }
    public function employee_add_func(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $emp_id=$this->session->userdata('employer_id');
        $data['company']=$this->Crud_modal->fetch_single_data("employer_company","mm_employer","employer_id='$emp_id'");
        $data['unit_det']=$this->Crud_modal->all_data_select("*","mm_company_unit","company_id='$emp_id' and status='1'", '');
        $data['dep_det']=$this->Crud_modal->all_data_select("*","mm_company_department","company_id='$emp_id' and status='1'", '');
        $data['company_function'] = $this->Crud_modal->all_data_select('*','mm_company_functional',"status=1 and company_id='$emp_id'",'company_functional_id');
        //print_r($data['company_function']);
        $this->load->view('employertempletes/head'); 
        $this->load->view('employertempletes/header');
        $this->load->view('emp-add-functional',$data); 
        $this->load->view('employertempletes/footer');
        $this->load->view('employertempletes/sidebar');
        }
        else{
            redirect(base_url().'employer');
        }
    }  

    public function show_dep(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $emp_id=$this->session->userdata('employer_id');
        $unit_id=$this->input->post('unit_id');
        $dep_det=$this->Crud_modal->all_data_select("*","mm_company_department","company_id='$emp_id' and company_unit_id='$unit_id' and status='1'", '');
       // echo '<label>Department:</label>';
        echo '<select size="1" id="department" class="form-control sss-dep" title="" type="select" name="department" required>
                           <option value="">Select Department</option>';
                        for ($i=0; $i <sizeof($dep_det) ; $i++) { 
                              echo '<option value='.$dep_det[$i]["department_id"].'>'.$dep_det[$i]["department_name"].'</option>';
                        }
                        echo '</select><span class="dep_error"  style="color: red;display: none;">* Please select Department</span>';
        }
        else{
            redirect(base_url().'employer');
        }
    }

    public function show_func(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $emp_id=$this->session->userdata('employer_id');
        $dep_id=$this->input->post('dep_id');
        $func_det=$this->Crud_modal->all_data_select("*","mm_company_functional","company_id='$emp_id' and department_id='$dep_id' and status='1'", '');
        //echo '<label>Functional Area:</label>';
        echo '<select size="1" id="functional" class="form-control func" title="" type="select" name="functional" required>
                           <option value="">Select Role</option>';
                        for ($i=0; $i <sizeof($func_det) ; $i++) { 
                              echo '<option  value='.$func_det[$i]["company_functional_id"].'>'.$func_det[$i]["company_functional_name"].'</option>';
                        }
                        echo '</select><span class="func_error"  style="color: red;display: none;">* Please select Functional</span>';
        }
        else{
            redirect(base_url().'employer');
        }
    }


    public function employee_add_unit(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $emp_id=$this->session->userdata('employer_id');
        $data['company']=$this->Crud_modal->fetch_single_data("employer_company","mm_employer","employer_id='$emp_id'");
        $data['record_unit'] = $this->Crud_modal->all_data_select('*','mm_company_unit',"status=1 and company_id='$emp_id'",'company_unit_id');
        //print_r($data['record-unit']); die;
        $this->load->view('employertempletes/head'); 
        $this->load->view('employertempletes/header');
        $this->load->view('emp-add-record-unit',$data); 
        $this->load->view('employertempletes/footer');
        $this->load->view('employertempletes/sidebar');
        }
        else{
            redirect(base_url().'employer');
        }
    }

    public function emp_unit_insert(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $emp_id=$this->session->userdata('employer_id');
        $createdata=array('company_unit_name'=>$this->input->post('unit_name'),
                          'status'=>'1',
                          'company_id'=>$emp_id,
                          'creation_date'=>date('Y-m-d H:i:s'),
                          'modification_date'=>date('Y-m-d H:i:s')
        );
        if($this->Crud_modal->data_insert("mm_company_unit",$createdata)){
            $this->session->set_flashdata('data_message','<div class="success"><strong>You have successfully created the unit!</strong></div>');
            redirect(base_url().'employee-add-unit');
        } 
        }
        else{
            redirect(base_url().'employer');
        }
    }

    public function emp_dep_insert(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $emp_id=$this->session->userdata('employer_id');
        $createdata=array('department_name'=>$this->input->post('department'),
                          'status'=>'1',
                          'company_id'=>$emp_id,
                          'company_unit_id'=>$this->input->post('unit_id'),
                          'creation_date'=>date('Y-m-d H:i:s'),
                          'modification_date'=>date('Y-m-d H:i:s')
        );
        if($this->Crud_modal->data_insert("mm_company_department",$createdata)){
            $this->session->set_flashdata('data_message','<div class="success"><strong>Department Created Successfully !</strong></div>');
            redirect(base_url().'employee-add-dep');
        }
        }
        else{
            redirect(base_url().'employer');
        }
    }

    public function emp_func_insert(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $emp_id=$this->session->userdata('employer_id');
        $createdata=array('department_id'=>$this->input->post('department'),
                          'status'=>'1',
                          'company_functional_name'=>$this->input->post('functional_name'),
                          'company_id'=>$emp_id,
                          'company_unit_id'=>$this->input->post('unit_id'),
                          'creation_date'=>date('Y-m-d H:i:s'),
                          'modification_date'=>date('Y-m-d H:i:s')
        );
        if($this->Crud_modal->data_insert("mm_company_functional",$createdata)){
            $this->session->set_flashdata('data_message','<div class="success"><strong>Role Created Successfully!</strong></div>');
            redirect(base_url().'employee-add-func');
        }
        }
        else{
            redirect(base_url().'employer');
        }
    }

    public function add_user_to_company(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $emp_id=$this->session->userdata('employer_id');
        $data['company']=$this->Crud_modal->fetch_single_data("employer_company","mm_employer","employer_id='$emp_id'");
        $this->load->view('employertempletes/head'); 
        $this->load->view('employertempletes/header');
        $this->load->view('emp-internal-data'); 
        $this->load->view('employertempletes/footer');
        $this->load->view('employertempletes/sidebar');
        }
        else{
            redirect(base_url().'employer');
        }
    }

     public function job_offer_list(){
         if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        //$emp_id=$this->session->userdata('employer_id');
       $emp_id=$this->session->userdata('employer_id');
        $data['job_list']=$this->Crud_modal->all_data_select("*","mm_master_job","company_id='$emp_id' and status='1'","job_id");
        if($this->input->post()){
            $start_date=$this->input->post('startDate3');
            $end_date=$this->input->post('endDate3');
            $job_id=$this->input->post('job_id');
            $field="u.mm_uid,u.mm_user_full_name,u.mm_user_email,mmj.job_title,mmaj.created_data,mmj.job_id";
            $table_name="mm_user_applied_job as mmaj";
            $join1[0]="user as u";
            $join1[1]="u.mm_uid=mmaj.uid";
            $join1[2]="left";
            $join2[0]="mm_master_job as mmj";
            $join2[1]="mmj.job_id=mmaj.job_id";
            $join2[2]="left";
            $where="mmaj.job_id='$job_id' and date(mmaj.created_data) between '$start_date' and '$end_date' and mmaj.job_process_step='6-0'";
            $applied_list=$this->Crud_modal->fetch_data_by_two_table_join($field,$table_name,$join1,$join2,$where);
            $data['select_job']=$job_id;
            $data['start_date']=$start_date;
            $data['end_date']=$end_date;
            $data['applied_list']=$applied_list;
            $data['unit_det']=$this->Crud_modal->all_data_select("*","mm_company_unit","company_id='$emp_id' and status='1'", '');
        }else{
        }
        $this->load->view('employertempletes/head'); 
        $this->load->view('employertempletes/header');
        $this->load->view('create-emp-already-registered',$data); 
        $this->load->view('employertempletes/footer');
        $this->load->view('employertempletes/sidebar');
        }
        else{
            redirect(base_url().'employer');
        }
    }
	
	 public function emp_add_func_insert(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $emp_id=$this->session->userdata('employer_id');
        $user_id_det=$this->input->post('quiz_value');
        $unit_id=$this->input->post('unit_id');
        $dep_id=$this->input->post('dep_id');
        $func_id=$this->input->post('func_id');
        for ($i=0; $i <sizeof($user_id_det) ; $i++) { 
                           $insert[$i]['user_id']=$user_id_det[$i];
                            $insert[$i]['company_id']=$emp_id;
                            $insert[$i]['company_unit_id']=$unit_id;
                            $insert[$i]['creation_date']= date("Y-m-d H:i:sa");
                            $insert[$i]['department_id']= $dep_id;
                            $insert[$i]['modification_date']= date("Y-m-d H:i:sa");
                            $insert[$i]['functional_id']= $func_id;
                            $insert[$i]['status']=1;
        }
        
        //$this->Crud_modal->insert_batch('mm_user_department_details',$insert);
        if($this->Crud_modal->insert_batch('mm_user_department_details',$insert)){
            echo "Success";
        }
        }
        else{
            redirect(base_url().'employer');
        }
    }
   public function edit_emp_function(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $v = $this->uri->segment(2);
        $val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
        $emp_id=$this->session->userdata('employer_id');
        $data['company']=$this->Crud_modal->fetch_single_data("employer_company","mm_employer","employer_id='$emp_id'");
        $data['dep_det']=$this->Crud_modal->all_data_select("*","mm_company_department","company_id='$emp_id' and status='1'", '');
        $data['unit_det']=$this->Crud_modal->all_data_select("*","mm_company_unit","company_id='$emp_id' and status='1'", '');
        $data['company_func_data']=$this->Crud_modal->fetch_single_data('*','mm_company_functional',"company_functional_id='$val'",'company_functional_id');
        $this->load->view('employertempletes/head'); 
        $this->load->view('employertempletes/header');
        $this->load->view('emp-edit-functional',$data); 
        $this->load->view('employertempletes/footer');
        $this->load->view('employertempletes/sidebar'); 
        }
        else{
            redirect(base_url().'employer');
        }
    }  
    public function emp_func_edit_insert(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
       $update_id = $this->input->post('edit_id');
        $data_array=array(
                        'company_unit_id' => $this->input->post('unit_id'),
                        'department_id' => $this->input->post('department'),
                        'company_functional_name' => $this->input->post('functional_name'),
                        "modification_date" => date('Y-m-d H:i:s'),
                    );
                    $where="company_functional_id='$update_id'";
                    if($data_return=$this->Crud_modal->update_data($where,'mm_company_functional',$data_array)){
                      $this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data upadte Successfully.</div>');
                            redirect(base_url().'employee-add-func');
                    }
        }
        else{
            redirect(base_url().'employer');
        }                   
    }
    public function add_old_employee(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
            $emp_id=$this->session->userdata('employer_id');
            $data['unit_det']=$this->Crud_modal->all_data_select("*","mm_company_unit","company_id='$emp_id' and status='1'", '');
            $field="u.mm_uid,u.mm_user_full_name,u.mm_user_email,mmad.status,mmad.count_mail,mmu.company_unit_name,mmd.department_name,mmf.company_functional_name";
            $table_name="mm_user_department_details as mmad";
            $join1[0]="user as u";
            $join1[1]="u.mm_uid=mmad.user_id";
            $join1[2]="inner";
            $join2[0]="mm_company_unit as mmu";
            $join2[1]="mmu.company_unit_id=mmad.company_unit_id";
            $join2[2]="inner";
            $join3[0]="mm_company_department as mmd";
            $join3[1]="mmd.department_id=mmad.department_id";
            $join3[2]="inner";
            $join4[0]="mm_company_functional as mmf";
            $join4[1]="mmad.functional_id=mmf.company_functional_id";
            $join4[2]="inner";
            $where="mmad.company_id='$emp_id'";
            $data['user_details']=$this->Crud_modal->fetch_data_by_four_table_join($field,$table_name,$join1,$join2,$join3,$join4,$where);
            $this->load->view('employertempletes/head'); 
            $this->load->view('employertempletes/header');
            $this->load->view('add-new-employee',$data); 
            $this->load->view('employertempletes/footer');
            $this->load->view('employertempletes/sidebar');
        }
        else{
            redirect(base_url().'employer');
        }
    }
    
    

    public function check_email_dep(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $email=$this->input->post('email');
        #######email checker #####################
        $emailid=explode("@",$email);
        $tblname="user";
        $where="mm_user_email='$email' and user_status='1'";
        $check_numrow=$this->Crud_modal->fetch_single_data("mm_uid",$tblname,$where); 
        if(sizeof($check_numrow)==0){
            if($emailid[1] == "hotmail.com" || $emailid[1] == "live.com" || $emailid[1] == "outlook.com" || $emailid[1] == "msn.com" || $emailid[1] == "yahoo.in" || $emailid[1] =="yahoo.com" || $emailid[1] =="rocketmail.com" || $emailid[1] =="yahoo.co.in" || $emailid[1] =="yahoomail.com" || $emailid[1] =="nitie.ac.in" || $emailid[1] =="fms.edu" || $emailid[1] =="email.com" ){
                $data_status=1;
            }else{              
                $ch = curl_init();  
                $username="mondaymorning";
                $password="morningmonday";
                $url="http://api.verify-email.org/api.php?usr=$username&pwd=$password&check=$email";
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                $output=curl_exec($ch);
                curl_close($ch);
                $data= json_decode($output);
                $data_status=$data->verify_status;
            }
        }else{
            $data_status=1; 
        }
        if($data_status==1){
        #######email checker #####################
        $unit_id=$this->input->post('unit_id');
        $functional=$this->input->post('functional');
        $department=$this->input->post('department');
        $name=$this->input->post('name');
        $emp_id=$this->session->userdata('employer_id');
        $data_company=$this->Crud_modal->fetch_single_data("employer_company","mm_employer","employer_id='$emp_id'");
        $emp_company_id=$this->input->post('emp_cmp_id');
        $data_all_check=$this->Crud_modal->all_data_select("group_concat(user_id) as uidd","mm_user_department_details","company_id='$emp_id'", '');
        if($data_all_check[0]['uidd']!=''){
            $all_uid=$data_all_check[0]['uidd'];
            $check_user_data=$this->Crud_modal->check_numrow("user_data","employee_company_id='$emp_company_id' and uid in($all_uid)");
        }else{
            $check_user_data=0;
        }
        if(sizeof($check_numrow)!=0){
            if($check_user_data==0){
            $check_dept=$this->Crud_modal->check_numrow("mm_user_department_details","user_id='$check_numrow[mm_uid]'");
                if($check_dept==0){
                    $arrayName = array(
                                    'user_id'=>$check_numrow['mm_uid'],
                                    'company_id'=>$emp_id,
                                    'company_unit_id'=>$unit_id,
                                    'creation_date'=> date("Y-m-d H:i:sa"),
                                    'department_id'=> $department,
                                    'modification_date'=> date("Y-m-d H:i:sa"),
                                    'functional_id'=> $functional,
                                    'status'=>0
                        ); 
                if($this->Crud_modal->data_insert_returnid("mm_user_department_details",$arrayName)){
                    $user_idd=$check_numrow['mm_uid'];
                    $field_new=array("employee_company_id" =>$this->input->post('emp_cmp_id'),
                                    "contact_number"=>$this->input->post('mobile')
                    );
                    $this->Crud_modal->update_data("uid='$user_idd'","user_data",$field_new);
                    echo json_encode(array("message"=>"You have successfully added as employee",
                                     "status"=>"1")
                        );
                } 
            }else{
                    echo json_encode(array("message"=>"You have already added as employee",
                                     "status"=>"0")
                        );
            }
            }else{
                echo json_encode(array("message"=>"You have entered duplicate employee_id",
                                     "status"=>"0")
                        );
            }
            
        }else{
            $check_dept=$this->Crud_modal->check_numrow("mm_user_department_details","user_id='$check_numrow[mm_uid]' and status='1'");
        if($check_user_data==0){
            if($check_dept==0){
                $pass=mt_rand(0,4); 
                $field=array(
                                'mm_user_full_name'=>trim($name),
                                'mm_user_email'=>trim($email),
                                'signup'=>"employer",
                                'user_password'=>md5($pass),
                                'user_status'=>1,
                                'mm_auth_key'=>"",
                                'reg_date'=>date('Y-m-d H:i:s'),
                                'eamil_auth_status'=>1,
                                'user_type_id'=>"2",
                                'refferal'=>"" 
                                );            
                $data['data_added']= $this->Crud_modal->user_data_insert1('user',$field);
                $user_idd=$data['data_added'];
                $field_new=array("employee_company_id" =>$this->input->post('emp_cmp_id'),
                                 "contact_number"=>$this->input->post('mobile')
                    );
                $this->Crud_modal->update_data("uid='$user_idd'","user_data",$field_new);
                if($data['data_added']){
                        $arrayName = array(
                                'user_id'=>$data['data_added'],
                                'company_id'=>$emp_id,
                                'company_unit_id'=>$unit_id,
                                'creation_date'=> date("Y-m-d H:i:sa"),
                                'department_id'=> $department,
                                'modification_date'=> date("Y-m-d H:i:sa"),
                                'functional_id'=> $functional,
                                'status'=>0
                    );

                    if($this->Crud_modal->data_insert_returnid("mm_user_department_details",$arrayName)){
                        echo json_encode(array("message"=>"You have successfully added in registration and as employee",
                                     "status"=>"1")
                        );
                    } 
                }

            }
            }else{
                echo json_encode(array("message"=>"You have enetered duplicate data",
                                     "status"=>"0")
                        );
            }
        }
        }else{
            echo json_encode(array("message"=>"Email id does not exist",
                                     "status"=>"0")
                        );
        }
        }
        else{
            redirect(base_url().'employer');
        }

    }
    public function create_training_widget(){
        $data['traing_widget']= $this->Crud_modal->all_data_select('*','mm_training_widget',"status='1'",'widget_id');
        //print_r($data['traing_widget']); die;
        $this->load->view('employertempletes/head'); 
        $this->load->view('employertempletes/header');
        $this->load->view('create-emp-training-widget',$data); 
        $this->load->view('employertempletes/footer');
        $this->load->view('employertempletes/sidebar');
    }
 public function emp_training_widget_insert(){
       $data = array(
          'widget_name'=>$this->input->post('widget_name'),
          'status'=>1,
          'created_date'=>date('Y-m-d H:i:s'),
       );
          
        if($data_return=$this->Crud_modal->data_insert("mm_training_widget",$data)){
                      $this->session->set_flashdata('data_message','<div class="success pull-right" style="color: green"><strong>Success!</strong> Data Insert Successfully.</div>');
                            redirect(base_url().'create-training-widget');
                    }   
    }
    public function edit_emp_training_widget(){
        $v = $this->uri->segment(2);
        $val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
        $data['widget_data']=$this->Crud_modal->fetch_single_data('*','mm_training_widget',"widget_id='$val' and status=1",'widget_id');
        $this->load->view('employertempletes/head'); 
        $this->load->view('employertempletes/header');
        $this->load->view('edit-emp-training-widget',$data); 
        $this->load->view('employertempletes/footer');
        $this->load->view('employertempletes/sidebar');
    }
public function emp_edit_training_widget_insert(){
        $id = $this->input->post('edit_id');
        $data = array(
         'widget_name'=>$this->input->post('widget_name'),
         'modified_date'=>date('Y-m-d H:i:s'),
        );
       $where="widget_id='$id'";
        if($data_return=$this->Crud_modal->update_data($where,'mm_training_widget',$data)){
          $this->session->set_flashdata('data_message','<div class="success pull-right" style="color: green"><strong>Success!</strong> Data upadte Successfully.</div>');
                redirect(base_url().'create-training-widget');
        }   
    }
    public function edit_emp_record_unit(){
        //echo "hai"; 
        $v = $this->uri->segment(2);
        $val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT)); 
        $where = "company_unit_id = '$val'";
        $data['record_unit'][] = $this->Crud_modal->fetch_single_data('*','mm_company_unit',$where);
        //print_r($data['record_unit']); die;
        $this->load->view('employertempletes/head'); 
        $this->load->view('employertempletes/header');
        $this->load->view('employer/edit-emp-record-unit',$data); 
        $this->load->view('employertempletes/footer');
        $this->load->view('employertempletes/sidebar');
     }
     public function edit_emp_unit_update(){
        //echo "hai"; 
        $update_id = $this->input->post('edit_id');
        $data_array=array(
                        
                        'company_unit_name' => $this->input->post('unit_name'),
                        "modification_date" => date('Y-m-d H:i:s'),
                    );
                    $where="company_unit_id='$update_id'";
                    if($data_return=$this->Crud_modal->update_data($where,'mm_company_unit',$data_array)){
                      $this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Unit Updated Successfully.</div>');
                            redirect(base_url().'employee-add-unit');
                    }
     }

    public function edit_company_depratment(){
        $v = $this->uri->segment(2);
        $val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT)); 
        $where = "department_id = '$val'";
        $data['company_deparment'][] = $this->Crud_modal->fetch_single_data('*','mm_company_department',$where);
         $emp_id=$this->session->userdata('employer_id');
         $data['company']=$this->Crud_modal->fetch_single_data("employer_company","mm_employer","employer_id='$emp_id'");
        $data['unit_det']=$this->Crud_modal->all_data_select("*","mm_company_unit","company_id='$emp_id' and status='1'", '');
        //print_r($data['record_unit']); die;
        $this->load->view('employertempletes/head'); 
        $this->load->view('employertempletes/header');
        $this->load->view('employer/edit-company-department',$data); 
        $this->load->view('employertempletes/footer');
        $this->load->view('employertempletes/sidebar');
    }  

     public function edit_company_department_save(){
        //echo "hai"; 
        $update_id = $this->input->post('edit_id');
        $data_array=array(
                        'company_unit_id' => $this->input->post('unit_id'),
                        'department_name' => $this->input->post('deparment'),
                        "modification_date" => date('Y-m-d H:i:s'),
                    );
                    $where="department_id='$update_id'";
                    if($data_return=$this->Crud_modal->update_data($where,'mm_company_department',$data_array)){
                      $this->session->set_flashdata('data_message','<div class="success"><strong>Department Updated Successfully !</strong></div>');
                            redirect(base_url().'employee-add-dep');
                    }
     }
    
    public function employee_status_change(){
        $user_id=$this->input->post('val_check');
        if($user_id!=''){
        $emp_id=$this->session->userdata('employer_id');
        $check_val=$this->Crud_modal->fetch_single_data("status","mm_user_department_details","company_id='$emp_id' and user_id='$user_id'");
        if($check_val>0){
            if($check_val['status']==0){
                $field=array("status"=>"1");
                $update_status=$this->Crud_modal->update_data("user_id='$user_id'","mm_user_department_details",$field);
                echo "You have successfully activate the user";
            }else{
                $field=array("status"=>"0");
                $update_status=$this->Crud_modal->update_data("user_id='$user_id'","mm_user_department_details",$field);
                echo "You have successfully deactivate the user";
            } 
        }
        }else{
            echo "Something went wrong";
        }
    }
    public function edit_employee_detail(){
        $v = $this->uri->segment(2);
        $emp_id=$this->session->userdata('employer_id');
        $val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
        $check_val=$this->Crud_modal->fetch_single_data("*","mm_user_department_details","company_id='$emp_id' and user_id='$val'");
        if(sizeof($check_val)!=0){
            $data['unit_det']=$this->Crud_modal->all_data_select("*","mm_company_unit","company_id='$emp_id' and status='1'", '');
            $unit_id=$check_val['company_unit_id'];
            $data['unit_id']=$unit_id;
            $data['company_dep']=$this->Crud_modal->all_data_select("*","mm_company_department","company_id='$emp_id' and company_unit_id='$unit_id' and status='1'", '');
            $dep_id=$check_val['department_id'];
            $data['department_id']=$dep_id;
            $data['company_functional']=$this->Crud_modal->all_data_select('*','mm_company_functional',"status=1 and department_id='$dep_id'",'company_functional_id');
            $data['functional_id']=$check_val['functional_id'];
            $data['dept_details']=$check_val;
        }
        $data['dddd_id']=$v; 
        $this->load->view('employertempletes/head'); 
        $this->load->view('employertempletes/header');
        $this->load->view('edit_employee_detail',$data); 
        $this->load->view('employertempletes/footer');
        $this->load->view('employertempletes/sidebar');
    }
    
    public function update_employee_detail(){
        $unit_id=$this->input->post('unit_id');
        $functional=$this->input->post('functional');
        $department=$this->input->post('department');
        $user_id=base64_decode(str_pad(strtr($this->input->post('check_id'), '-_', '+/'), strlen($this->input->post('check_id')) % 4, '=', STR_PAD_RIGHT));
         $arrayName = array(
                            'company_unit_id'=>$this->input->post('unit_id'),
                            'department_id'=>  $this->input->post('department'),
                            'modification_date'=> date("Y-m-d H:i:sa"),
                            'functional_id'=> $this->input->post('functional')
         );
         $update_status=$this->Crud_modal->update_data("user_id='$user_id'","mm_user_department_details",$arrayName);
         if($update_status){
            echo "You have successfully updated the details";
         }else{
            echo "Somethig went wrong"; 
         }
        
    }
    
    ##################email send #############################
    
public function employee_mail_sent(){ 
    $user_id=base64_decode(str_pad(strtr($this->input->post('val_check'), '-_', '+/'), strlen($this->input->post('val_check')) % 4, '=', STR_PAD_RIGHT));
    $user_info=$this->Crud_modal->fetch_single_data("mm_uid,mm_user_full_name,mm_user_email","user","mm_uid='$user_id'");
    $emp_id=$this->session->userdata('employer_id');
    $data_company=$this->Crud_modal->fetch_single_data("employer_company","mm_employer","employer_id='$emp_id'");
    $currentdate = date('Y-m-d H:i:s');
    $enddate = date('Y-m-d H:i:s', strtotime($currentdate. ' + 365 days'));
    $auth_key=md5(mt_rand(9999999,99999999));
    $data = array(
        'uid' => $user_id,
        'token'=> $auth_key,
        'expiry_time'=>$enddate,
        'generate_time'=>$currentdate,
        'is_status'=>"0"
    );
    $this->db->insert('forget_pass_token',$data);
    $to =$user_info['mm_user_email'];
    $date=date('Y-m-d H:i:s');          
    $subject = 'Reset Password Link';
    $from = 'MondayMorning@mondaymorning.in';

    
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "¥r¥n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "¥r¥n";
    $headers .= 'From: '.$from."¥r¥n".
    'Reply-To: '.$from."¥r¥n" .
    'X-Mailer: PHP/' . phpversion();
    
    //$message="test mail from saurabh";
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPDebug = 1;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;
    $mail->Username = "mondaymorning@mondaymorning.in";
    $mail->Password = "mondaymorning2017";
    $message =$this->reg_email_demo($user_info['mm_user_full_name'],$user_info['mm_user_email'],"123",$date,$auth_key,$data_company['employer_company']);
    $mail->From = "MondayMorning@MondayMorning.in";
    $mail->FromName = "Welcome In MondayMorning";
    $mail->AddAddress($to);
    //$mail->AddReplyTo("mail@mail.com");

    $mail->IsHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $message;
    //$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
    if(!$mail->Send())
    {
    echo "Message could not be sent. <p>";
    echo "Mailer Error: " . $mail->ErrorInfo;
    }else{ 
        $sql="UPDATE `mm_user_department_details` SET `count_mail` = count_mail+1
        WHERE `user_id`='$user_id'";
        $this->db->query($sql);
        echo json_encode(array("message"=>"You have successfully sent the mail to user",
                                     "status"=>"0")
                        );
    } 
    
}
    
function reg_email_demo($name,$email,$password,$date,$auth_key,$company_name)
    {
         try
            {
                    $base_url=base_url().'assets/';
                    $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=shift_jis">

<title>Welcome to MondayMorning</title>
</head>

<body style="background: #f9f9f9 url(stucco.png) repeat top left;">
<div class="content">
            <!-- Notification 1  -->
        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="" c-style="bgImage" object="drag-module" style="margin-top:2%">
          <tr mc:repeatable>
            <td id="not1"><div mc:hideable>
                <!-- Mobile Wrapper -->
            </div></td>
          </tr>
        </table>
        <table width="392" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
            <tr>
                <td align="center" width="20" valign="middle"></td>
                <td align="center" width="500" valign="middle">
        
                    <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
                        <tr>
                            <td align="center" width="500" valign="middle" bgcolor="#112b4e" c-style="blueBG">
                            
                                <div class="sortable_inner">
                    
                                <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#112b4e" c-style="blueBG" object="drag-module-small">
                                    <tr>
                                        <td width="500" valign="middle" align="center">
                                        
                                            <table width="265" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse;" class="fullCenter">
                                                <tr>
                                                    <td width="100%" height="50"></td>
                                                </tr>
                                            </table>                            
                                        </td>
                                    </tr>
                                </table>
                                <!-- Start Top -->
                                <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile"  bgcolor="#112b4e" c-style="blueBG" object="drag-module-small">
                                    <tr>
                                        <td width="500" valign="middle" align="center">
                                            
                                            <!-- Header Text --> 
                                            <table width="400" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse;" class="fullCenter">
                                                <tr>
                                                    <td align="center" valign="middle" width="100%" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 60px; color: #ffffff; line-height: 44px; font-weight: 100;" t-style="whiteText" class="fullCenter" mc:edit="1" object="text-editable">
                                                        <!--[if !mso]><!--><span style="font-family: proxima_novathin, Helvetica; font-weight: normal;"><!--<![endif]--><singleline>Welcome to</singleline><!--[if !mso]><!--></span><!--<![endif]-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="100%" height="15"></td>
                                                </tr>
                                            </table>
                                                
                                        </td>
                                    </tr>
                                </table><!-- End Top -->
                                
                                <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile"  bgcolor="#112b4e" c-style="blueBG" object="drag-module-small">
                                    <tr>
                                        <td width="500" valign="middle" align="center">
                                        
                                            <table width="300" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse;" class="fullCenter">
                                                <tr>
                                                    <td valign="middle" width="100%" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 31px; color: #ffffff; line-height: 38px; font-weight: bold; text-transform:none;" t-style="whiteText" class="fullCenter" mc:edit="2" object="text-editable">
                                                    <!--[if !mso]><!--><span style="font-family: proxima_novablack, Helvetica; font-weight: normal;"><!--<![endif]-->
                                                    <singleline>'.$company_name.'</singleline><!--[if !mso]><!--></span><!--<![endif]-->
                                                    </td>
                                                    
                                                </tr>
                                            </table>
                                                                            
                                        </td>
                                    </tr>
                                </table><!-- End Top -->
                                
                                <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#112b4e" c-style="blueBG" object="drag-module-small">
                                    <tr>
                                        <td width="500" valign="middle" align="center">
                                        
                                            <table width="265" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse;" class="fullCenter">
                                                <tr>
                                                    <td width="100%" height="50"></td>
                                                </tr>
                                            </table>                            
                                        </td>
                                    </tr>
                                </table>
                                
                                </div>
                                
                            </td>
                        </tr>
                    </table>
                    
                </td>
                <td align="center" width="20" valign="middle"></td>
            </tr>
        </table>
        
        <table width="392" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
            <tr>
                <td align="center" width="20" valign="middle"></td>
                <td align="center" width="500" valign="middle">
        
                    <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
                        <tr>
                            <td align="center" width="500" valign="middle" bgcolor="#ffffff" c-style="whiteBG">
                            
                                <div class="sortable_inner">
                                
                                <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile"  bgcolor="#ffffff" c-style="whiteBG" object="drag-module-small">
                                    <tr>
                                        <td width="500" valign="middle" align="center">
                                        
                                            <table width="265" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse;" class="fullCenter">
                                                <tr>
                                                    <td width="100%" height="50"><span style="color:#999999;font-size:14px; font-family:proxima_nova_rgregular, Helvetica;"><span class="aBn" data-term="goog_1795359220" tabindex="0"><span class="aQJ">'.$date.'</span></span></span></td>
                                                </tr>
                                            </table>                            
                                        </td>
                                    </tr>
                                </table>
                                
                                <!-- Start Second -->
                                <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile"  bgcolor="#ffffff" c-style="whiteBG" object="drag-module-small">
                                    <tr>
                                        <td width="500" valign="middle" align="center">
                                            
                                            <!-- Header Text --> 
                                            <table width="265" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; " class="fullCenter">
                                                <tr>
                                                    <td align="center" valign="middle" width="100%" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 31px; color: #212121; line-height: 44px; font-weight: 100;" t-style="headline" class="fullCenter" mc:edit="3" object="text-editable">
                                                        <!--[if !mso]><!--><span style="font-family: proxima_novathin, Helvetica; font-weight: normal;"><!--<![endif]-->
                                                        <singleline>Dear '.$name.',</singleline>
                                                        <!--[if !mso]><!--></span><!--<![endif]-->
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                
                                <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile"  bgcolor="#ffffff" c-style="whiteBG" object="drag-module-small">
                                    <tr>
                                        <td width="500" valign="middle" align="center">
                                        
                                            <table width="265" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; " class="fullCenter">
                                                <tr>
                                                    <td width="100%" height="30"></td>
                                                </tr>
                                            </table>                            
                                        </td>
                                    </tr>
                                </table>
                                
                                <!-- Start Second -->
                                <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#ffffff" c-style="whiteBG" object="drag-module-small">
                                    <tr>
                                        <td width="500" valign="middle" align="center">
                                            
                                            <!-- Header Text --> 
                                            <table width="265" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; " class="fullCenter">
                                                <tr>
                                                  <td valign="middle" width="100%" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #515151; line-height: 24px;" t-style="textColor" class="fullCenter" mc:edit="4" object="text-editable">
                                                    
                                                        <!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><singleline>Thanks for being part of '.$company_name.'</singleline><!--[if !mso]><!--></span><!--<![endif]-->
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                    <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile"  bgcolor="#ffffff" c-style="whiteBG" object="drag-module-small">
                                    <tr>
                                        <td width="500" valign="middle" align="center">
                                        
                                            <table width="265" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; " class="fullCenter">
                                                <tr>
                                                    <td width="100%" height="30"></td>
                                                </tr>
                                            </table>                            
                                        </td>
                                    </tr>
                                </table>
                                
                                <!-- Start Second -->
                                <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#ffffff" c-style="whiteBG" object="drag-module-small">
                                    <tr>
                                        <td width="500" valign="middle" align="center">
                                            
                                            <!-- Header Text --> 
                                            <table width="265" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; " class="fullCenter">
                                                <tr>
                                                  <td valign="middle" width="100%" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #515151; line-height: 24px;" t-style="textColor" class="fullCenter" mc:edit="4" object="text-editable">
                                                    
                                                        <!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><singleline>
 Here are your login credential. You can login with below credentials for your employee panel.</singleline><!--[if !mso]><!--></span><!--<![endif]-->
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#ffffff" c-style="whiteBG" object="drag-module-small">
                                    <tr>
                                        <td width="500" valign="middle" align="center">
                                        
                                            <table width="265" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; " class="fullCenter">
                                                <tr>
                                                    <td width="100%" height="20"></td>
                                                </tr>
                                            </table>                            
                                        </td>
                                    </tr>
                                </table>
                                
                                <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile"  bgcolor="#ffffff" c-style="whiteBG" object="drag-module-small">
                                    <tr>
                                        <td width="500" valign="middle" align="center">
                                        
                                            <table width="265" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; " class="fullCenter">
                                                
                                                <tr>
                                                    <td valign="middle" width="100%" class="icon18" align="center">
                                                        
                                                        <!-- Input 1 -->
                                                        <table width="265" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse; " class="full">
                                                            <tr>
                                                                <td width="33" height="44" bgcolor="#112b4e" c-style="blueBG" style="text-align: center;"><span object="image-editable"><img editable="true" src="'.base_url().'assets/images/icon.png" width="18" alt="" border="0" mc:edit="4_1"></span></td>
                                                                <td width="20" height="44" bgcolor="#f5f7f7" c-style="greyBG"></td>
                                                                <td width="181" height="44" bgcolor="#f5f7f7" c-style="greyBG" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #112b4e; line-height: 24px;" mc:edit="5" object="text-editable"><!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;" t-style="blueText"><!--<![endif]--><singleline>'.$email.'</singleline><!--[if !mso]><!--></span><!--<![endif]--></td>
                                                                <td width="20" height="44" bgcolor="#f5f7f7" c-style="greyBG"></td>
                                                            </tr>
                                                        </table><!-- End Space -->
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="100%" height="1" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                
                                <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#ffffff" c-style="whiteBG" object="drag-module-small">
                                    <tr>
                                        <td width="500" valign="middle" align="center">
                                        
                                            <table width="265" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; " class="fullCenter">
                                                <tr>
                                                    <td valign="middle" width="100%" class="icon18" align="center">
                                                        
                                                        <!-- Input 2 -->
                                                        <table width="265" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse; " class="full">
                                                            <tr>
                                                                <td width="33" height="44" bgcolor="#112b4e" c-style="blueBG" style="text-align: center;"><span object="image-editable"><img editable="true" src="'.base_url().'assets/images/pass-icon.png" width="18" alt="" border="0" mc:edit="5_3"></span></td>
                                                                <td width="20" height="44" bgcolor="#f5f7f7" c-style="greyBG"></td>
                                                                <table width="265" style="margin-top:20px;" border="0" cellpadding="0" cellspacing="0" align="center" class="fullCenter"> 
                                                                    <tr> 
                                                                    <td width="265" align="center" height="45" c-style="blueBG" bgcolor="#112b4e" style="padding-left: 22px; padding-right: 22px; font-weight: bold; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-transform:none;   border-radius: 3px;" t-style="whiteText" mc:edit="7">
                                                                    <multiline><!--[if !mso]><!--><span style="font-family: proxima_novablack, Helvetica; font-weight: normal;"><!--<![endif]-->
                                                                    <a href="'.base_url().'forgetpass/Userforget/forgetauth/'.$auth_key.'" style="color: #ffffff; font-size:18px; text-decoration: none; line-height:34px; width:100%;" t-style="whiteText" object="link-editable">Change Password Button</a>
                                                                    <!--[if !mso]><!--></span><!--<![endif]--></multiline>
                                                                    </td> 
                                                                    </tr> 
                                                                </table>  
                                                                <td width="20" height="44" bgcolor="#f5f7f7" c-style="greyBG"></td>
                                                            </tr>
                                                        </table><!-- End Space -->
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="100%" height="1" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                    <!-----------------Start bottom text ----------------->
                                <table width="265" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: left; border-collapse:collapse; " class="fullCenter">
                                                <tbody>
                                                <tr>
                                                    <td width="" height="30"></td>
                                                </tr>
                                                <tr>
                                                    <td width="" height="30" style="text-align:left;font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #515151; line-height: 24px;font-weight:700">Note:</td>
                                                </tr>
                                                <tr>
                                                    <td valign="middle" width="100%" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #515151; line-height: 24px;" t-style="textColor" class="fullCenter" mc:edit="4" object="text-editable">
                                                        <!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->
                                                    
                                                        <ul style="list-style:none;padding-left:0px;">
                                                        <li><strong>Step 1: </strong>Open MondayMorning.</li>
                                                        <li><strong>Step 2: </strong> Employee login details mentioned above</li>
                                                        <li><strong>Step 3: </strong> Go to Rivigo Archive</li></ul>
<!--[if !mso]><!--></span><!--<![endif]-->
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                    <!-----------------Start bottom text ----------------->
                                <table width="265" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; " class="fullCenter">
                                                <tbody>
                                                <tr>
                                                    <td width="" height="30"></td>
                                                </tr>
                                                <tr>
                                                    <td valign="middle" width="100%" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #515151; line-height: 24px;" t-style="textColor" class="fullCenter" mc:edit="4" object="text-editable">
                                                        <!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->

Best Wishes,<br />
MondayMorning Team<!--[if !mso]><!--></span><!--<![endif]-->
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                    <!-----------------End bottom text ----------------->
                                <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile"  bgcolor="#ffffff" c-style="whiteBG" object="drag-module-small">
                                    <tr>
                                        <td width="500" valign="middle" align="center">
                                        
                                            <table width="265" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; " class="fullCenter">
                                                <tr>
                                                    <td width="100%" height="50"></td>
                                                </tr>
                                            </table>                            
                                        </td>
                                    </tr>
                                </table><!-- End Second -->
                                
                            </div>
                    
                      </td>
                        </tr>
                    </table>
                    
                </td>
                <td align="center" width="20" valign="middle"></td>
            </tr>
        </table>
        
        <!-- Mobile Wrapper -->
        <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
            <tr>
                <td width="500" align="center">
                
                    <div class="sortable_inner">
                    <table width="40" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
            <tr>
                <td align="center" width="20" valign="middle"></td>
                <td align="center" width="20" valign="middle"></td>
            </tr>
        </table>
        <!-- CopyRight -->
                    <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" class="full" object="drag-module-small">
                        
                        <tr>
                            <td align="center" valign="middle" width="500" style="text-align: center; padding:8px 0 0 6px; font-family: Helvetica, Arial, sans-serif; font-size: 13px; color: #959595; line-height: 24px;" t-style="copyright" class="fullCenter" mc:edit="8" object="text-editable">
                            
                                
                                <!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->
                                
                                https://www.mondaymorning.in | support@mondaymorning.in  
<br />Support : +91-120-3759277 <!--[if !mso]><!--></span><!--<![endif]--> <!--[if !mso]><!--><span style="font-family: "proxima_nova_rgregular", Helvetica;"><!--<![endif]--> <a href="#" style="text-decoration: none; color: #959595;" t-style="copyright" object="link-editable"></a> <!--[if !mso]><!--></span><!--<![endif]--></td></tr></table><table width="500" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" object="drag-module-small"><tr><td align="center" width="352" valign="middle"><table width="180" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; " class="fullCenter"><tr><td width="100%" height="60"><table cellpadding="0" cellspacing="5" style="width:100%;border-collapse:collapse"><tbody><tr><td style="width:2%"><a style="text-decoration:none;color:#053b64" href="https://www.mondaymorning.in/"><img alt="MM" height="35" src="https://www.mondaymorning.in/assets/images/monday-morning-fevicon.jpg" style="border:0" width="35" class="CToWUd"></a></td><td style="width:2%"><a style="text-decoration:none;color:#053b64" href="https://twitter.com/mondaymorningin"><img alt="Twitter" height="32" src="https://www.mondaymorning.in/assets/images/twitter.png" style="border:0" width="32" class="CToWUd"></a></td><td style="width:2%"><a style="text-decoration:none;color:#053b64" href="https://www.facebook.com/mondaymorningin/"><img alt="Facebook" height="32" src="https://www.mondaymorning.in/assets/images/facebook.png" style="border:0" width="32" class="CToWUd"></a></td><td style="width:2%"><a style="text-decoration:none;color:#053b64" href="https://plus.google.com/108083184712604863154"><img alt="Googleplus" height="32" src="https://www.mondaymorning.in/assets/images/googleplus.png" style="border:0" width="32" class="CToWUd"></a></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td width="100%" height="20px" style="font-size: 13px; line-height: 14px;"><table width="300px" style="text-align:center;margin-left: 100px;"><tr><td style="padding:3px 0 0 6px; font-family: "proxima_nova_rgregular", Helvetica;font-weight: normal;font-size: 13px;" colspan="2"> You are currently signed in <a style="color:#0f75c3;text-decoration:underline" href="#">'.$email.'</a><br>Copyright ??? 2017 <span class="aBn" data-term="goog_2007155060" tabindex="0"><span class="aQJ">MondayMorning</span></span></td></tr><tr><td width="100%" height="20px" style="font-size: 13px; line-height: 14px;"></td></tr></table></td></tr></table></td></tr></table></div></body></html>';
                        return $html;
            }
            catch (Exception $e)
            {
                echo 'Caught exception: ',  $e->getMessage(), "¥n";
          }
    }
    ##################email send #############################
     
public function employee_report_functional(){
    $emp_id=$this->session->userdata('employer_id');
    $data['unit_det']=$this->Crud_modal->all_data_select("*","mm_company_unit","company_id='$emp_id' and status='1'", '');
    if($this->input->post()){
        $unit_id=$this->input->post('unit_id');
        $department=$this->input->post('department');
        $functional=$this->input->post('functional');
        //$data_department=$this->Crud_modal->all_data_select("*","mm_user_department_details","company_id='$emp_id' and status='1' and company_unit_id='$unit_id' and department_id='$department' and functional_id='$functional'", '');
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
        $where="mmad.company_id='$emp_id' and mmd.department_id='$department' and mmu.company_unit_id='$unit_id' and mmf.company_functional_id='$functional'";
        $data['user_details']=$this->Crud_modal->fetch_data_by_four_table_join($field,$table_name,$join1,$join2,$join3,$join4,$where);
        // echo $this->db->last_query();
        // exit();
        $data['unit_id']=$unit_id;
        $data['department_id']=$department;
        $data['functional_id']=$functional;
    }
    $this->load->view('employertempletes/head'); 
    $this->load->view('employertempletes/header');
    $this->load->view('employee-report',$data); 
    $this->load->view('employertempletes/footer');
    $this->load->view('employertempletes/sidebar');
}

public function emp_package_map(){
       $emp_id=$this->session->userdata('employer_id');
        $data['company']=$this->Crud_modal->fetch_single_data("employer_company","mm_employer","employer_id='$emp_id'");


        $data['unit_det']=$this->Crud_modal->all_data_select("*","mm_company_unit","company_id='$emp_id' and status='1'", '');
        $data['company_type']=$this->Crud_modal->all_data_select("*","mm_master_package_type","company_type=1 and status='1'", '');
        $data['package_map_data']=$this->Crud_modal->all_data_select('*','mm_employer_package_map',"status=1 and company_id='$emp_id'",'emp_pack_map_id');
        $this->load->view('employertempletes/head'); 
        $this->load->view('employertempletes/header');
        $this->load->view('emp-package-map',$data); 
        $this->load->view('employertempletes/footer');
        $this->load->view('employertempletes/sidebar');
    }
public function emp_package_map_insert(){
            $emp_id = $this->session->userdata('employer_id');
            $data_array = array(
              'emp_pack_id'=>$this->input->post('package'),
              'company_id'=>$emp_id, 
              'company_unit_id'=>$this->input->post('unit_id'), 
              'department_id'=>$this->input->post('department'),
              'pack_type_id'=>$this->input->post('type_train'),
              'company_functional_id'=>implode('||',$this->input->post('functional_name')),
              'status'=>1,
              'created_date'=>date('Y-m-d H:i:s'),
            );
            if($data_return=$this->Crud_modal->data_insert("mm_employer_package_map",$data_array)){
                      $this->session->set_flashdata('data_message','<div class="success pull-right" style="color: green"><strong>Success!</strong> Data Insert Successfully.</div>');
                            redirect(base_url().'emp-package-map');
                    }   

        }
        public function edit_emp_package_map(){
             $v = $this->uri->segment(2);
             $val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));  
             $emp_id = $this->session->userdata('employer_id');
             $data['company'] = $this->Crud_modal->fetch_single_data("employer_company","mm_employer","employer_id='$emp_id'");
             $data['unit_data'] = $this->Crud_modal->all_data_select('*','mm_company_unit',"company_id='$emp_id' and status=1",'company_unit_id');
             $data['package']=$this->Crud_modal->fetch_single_data('*','mm_employer_package_map',"emp_pack_map_id='$val' and status=1",'emp_pack_map_id');
             $co_unit =$data['package']['company_unit_id'];
             $data['department']= $this->Crud_modal->all_data_select('*','mm_company_department',"company_id='$emp_id' and company_unit_id = $co_unit and status=1",'department_id');
             $data['function_data']= $this->Crud_modal->all_data_select('*','mm_company_functional',"company_id='$emp_id' and status=1",'company_functional_id');
             $ptype =$data['package']['pack_type_id'];
              $data['func_pack']=$this->Crud_modal->all_data_select("package_id,package_name","mm_packages","company_id='$emp_id' and pack_type_id='$ptype' and status='1'", 'package_id');

              $data['company_type']=$this->Crud_modal->all_data_select("pack_type_id,pack_type_name","mm_master_package_type","company_type=1 and status='1'", 'company_type');
              //print_r($data['package']); die;
                $this->load->view('employertempletes/head'); 
                $this->load->view('employertempletes/header');
                $this->load->view('edit-emp-package-map',$data); 
                $this->load->view('employertempletes/footer');
                $this->load->view('employertempletes/sidebar');
        }
        public function edit_emp_package_map_insert(){
          $update_id = $this->input->post('edit_id'); 
        $data_array = array(
              'emp_pack_id'=>$this->input->post('package'), 
              'company_unit_id'=>$this->input->post('unit_id'), 
              'department_id'=>$this->input->post('department'),
              'pack_type_id'=>$this->input->post('type_train'),
              'company_functional_id'=>implode('||',$this->input->post('functional_name')),
              'modified_date'=>date('Y-m-d H:i:s'),
            );
                    $where="emp_pack_map_id='$update_id'";
                    if($data_return=$this->Crud_modal->update_data($where,'mm_employer_package_map',$data_array)){
                      $this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data upadte Successfully.</div>');
                            redirect(base_url().'emp-package-map');
                    }     
        }
public function show_func1(){
        $emp_id=$this->session->userdata('employer_id');
        $dep_id=$this->input->post('dep_id'); 
        $func_det=$this->Crud_modal->all_data_select("*","mm_company_functional","company_id='$emp_id' and department_id='$dep_id' and status='1'", '');
        echo '';
                        for ($i=0; $i <sizeof($func_det) ; $i++) { 
                              echo '<option  value='.$func_det[$i]["company_functional_id"].'>'.$func_det[$i]["company_functional_name"].'</option>';
                        }
    }
	public function show_func2(){
        $emp_id=$this->session->userdata('employer_id');
        $dep_id=$this->input->post('dep_id'); 
        $func_det=$this->Crud_modal->all_data_select("*","mm_company_functional","company_id='$emp_id' and department_id='$dep_id' and status='1'", '');
        echo '<option value="">Select Role</option>';
                        for ($i=0; $i <sizeof($func_det) ; $i++) { 
                              echo '<option  value='.$func_det[$i]["company_functional_id"].'>'.$func_det[$i]["company_functional_name"].'</option>';
                        }
    }
	
public function get_emp_package(){
        $emp_id=$this->session->userdata('employer_id');
        $type_t=$this->input->post('type_t');
        $func_det=$this->Crud_modal->all_data_select("*","mm_packages","company_id='$emp_id' and pack_type_id='$type_t' and status='1'", 'package_id');
                      echo '<option value="">Select Package</option>';           
                        for ($i=0; $i <sizeof($func_det) ; $i++) { 
                              echo '<option  value='.$func_det[$i]["package_id"].'>'.$func_det[$i]["package_name"].'</option>';
                        }
        }
public function create_training_material_form(){
       $emp_id=$this->session->userdata('employer_id');
        $data['company']=$this->Crud_modal->fetch_single_data("employer_company","mm_employer","employer_id='$emp_id'");
        $data['unit_det']=$this->Crud_modal->all_data_select("*","mm_company_unit","company_id='$emp_id' and status='1'", '');
        $data['company_type']=$this->Crud_modal->all_data_select("*","mm_master_package_type","company_type=1 and status='1'", '');
        $data['package_map_data']=$this->Crud_modal->all_data_select('*','mm_employer_package_map','status=1','emp_pack_map_id');
        $data['widget_data']=$this->Crud_modal->all_data_select('widget_id,widget_name','mm_training_widget','status=1','widget_id asc');
        $data['training_material']=$this->Crud_modal->all_data_select('*','mm_training_materials',"company_id='$emp_id' and status=1",'training_material_id asc');
        $this->load->view('employertempletes/head'); 
        $this->load->view('employertempletes/header');
        $this->load->view('create-emp-training-material-from',$data); 
        $this->load->view('employertempletes/footer');
        $this->load->view('employertempletes/sidebar');
    }
public function emp_training_material_insert(){
        $data['company_id']=$this->session->userdata('employer_id');
        $data['company_unit_id'] = $this->input->post('unit_id');
        $data['department_id'] = $this->input->post('department');
        $data['company_functional_id'] = $this->input->post('functional_name');
        $data['pack_id'] = $this->input->post('package');
        $data['maid'] = $this->input->post('assign');
        $data['status'] = '1';
        $data['created_date'] = date("Y-m-d H:i:s");
        $widget = $data['widget_id'] = $this->input->post('widget');
        if($widget==2){
            $data['topic_name'] = $this->input->post('topic_name');
           $data['widget_url'] = $this->input->post('widget_url');
        }
        if($widget==3){
            $data['topic_name'] = $this->input->post('topic_name');
             $config['allowed_types'] = 'mp3|3gp|mpeg';
            $config['upload_path']          = './upload/employer_upload/training_widget/audio';
            $config['file_name'] = date("dmY").'-'.$_FILES['upload_file']['name'];
        }
        if($widget==4){
          $data['topic_name'] = $this->input->post('topic_name');
          $config['allowed_types']        = 'doc|docx|pdf|xlsx';        
          $config['upload_path']          = './upload/employer_upload/training_widget/document';
          $config['file_name'] = date("dmY").'-'.$_FILES['upload_file']['name'];
        }
        if($widget==1){
             $data['topic_name'] = $this->input->post('description');
        }
        $this->load->library('upload', $config);
        $data1 = $this->upload->data();
        $full_path= $data1['full_path'];
        $file_name= $data1['file_name'];          
        $data['widget_name']=$data1['file_name'];
        if($this->Crud_modal->data_insert("mm_training_materials",$data)){
            if($data['widget_name'] !=""){
                 $this->upload->do_upload('upload_file');

            } 
             $this->session->set_flashdata('data_message','<div class="success"><strong>You have successfully created the unit!</strong></div>');
            redirect(base_url().'create-training-material-form');
        }

        
        
    }
public function get_function_package(){
            $unit_id=$this->input->post('unit');
            $dep_id=$this->input->post('dep');
            $func_id=$this->input->post('function');
            $company_id=$this->session->userdata('employer_id');      
            $join1[0]='mm_employer_package_map as mm_map';
            $join1[1]='mmp.package_id=mm_map.emp_pack_id';
            $join1[2]="inner";
            $where="mm_map.company_id='$company_id' and mm_map.company_unit_id='$unit_id' and mm_map.department_id='$dep_id' and mm_map.company_functional_id='$func_id'";
            $data['package_datas']=$this->Crud_modal->fetch_data_by_one_table_join("mmp.package_id as package_id, mmp.package_name as package_name","mm_packages as mmp",$join1,$where);
        echo '<option  value="">Select Package</option>';
                        for ($i=0; $i <sizeof($data["package_datas"]) ; $i++) { 
                              echo '<option  value='.$data["package_datas"][$i]["package_id"].'>'.$data["package_datas"][$i]["package_name"].'</option>';
                        }
    }
public function get_package_assignment(){
            $pack=$this->input->post('package');     
            $assignment = $this->Crud_modal->all_data_select('maid,assignment_name','master_assignment',"pack_id='$pack'",'maid');
                        echo '<option  value="">Select Assignment</option>';
                        for ($i=0; $i <sizeof($assignment) ; $i++) { 
                              echo '<option  value='.$assignment[$i]["maid"].'>'.$assignment[$i]["assignment_name"].'</option>';
                        }
    }
	
public function edit_training_material_form(){
  if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
    $tid=$this->uri->segment(2);
    $code= base64_decode(str_pad(strtr($tid, '-_', '+/'), strlen($tid) % 4, '=', STR_PAD_RIGHT));  
    $data['material_data']=$mt=$this->Crud_modal->fetch_single_data("*","mm_training_materials","training_material_id='$code'");

    $emp_id=$this->session->userdata('employer_id');
    $data['company']=$this->Crud_modal->fetch_single_data("employer_company","mm_employer","employer_id='$emp_id'");
    //$data['unit_det']=$this->Crud_modal->all_data_select("*","mm_company_unit","company_id='$emp_id' and status='1'", '');
   // $data['company_type']=$this->Crud_modal->all_data_select("*","mm_master_package_type","company_type=1 and status='1'", '');
   // $data['package_map_data']=$this->Crud_modal->all_data_select('*','mm_employer_package_map','status=1','emp_pack_map_id');
    $data['widget_data']=$this->Crud_modal->all_data_select('widget_id,widget_name','mm_training_widget','status=1','widget_id asc');

    $data['training_material']=$this->Crud_modal->all_data_select('*','mm_training_materials',"company_id='$emp_id' and status=1",'training_material_id asc');
    $unit_id=$mt['company_unit_id'];
    $dept_id=$mt['department_id'];
    $func_id=$mt['company_functional_id'];
    $pack_id=$mt['pack_id'];
    $data['topic']=trim(preg_replace('/¥s¥s+/', ' ', strip_tags($mt["topic_name"])));
    
    $data['unit_data']=$this->Crud_modal->all_data_select('company_unit_id,company_unit_name','mm_company_unit',"company_id='$emp_id' and status='1'",'company_unit_id asc');
    $data['dept_data']=$this->Crud_modal->all_data_select('department_id,department_name','mm_company_department',"company_id='$emp_id' and status='1' and company_unit_id=$unit_id",'department_id asc');
    $data['func_data']=$this->Crud_modal->all_data_select('company_functional_id,company_functional_name','mm_company_functional',"company_id='$emp_id' and status='1' and company_unit_id=$unit_id and department_id=$dept_id",'company_functional_id asc');
    $data['pack_data']=$this->Crud_modal->all_data_select('*','mm_employer_package_map',"company_id='$emp_id' and status='1' and company_unit_id=$unit_id and department_id=$dept_id and company_functional_id=$func_id",'emp_pack_map_id asc');
    $data['assign_data']=$this->Crud_modal->all_data_select('*','master_assignment',"status='1' and pack_id=$pack_id",'maid asc');
    $this->load->view('employertempletes/head'); 
    $this->load->view('employertempletes/header');
    $this->load->view('edit-training-material-form',$data); 
    $this->load->view('employertempletes/footer');
    $this->load->view('employertempletes/sidebar');
  }else{
    redirect(base_url().'employer');
  }
}

public function update_emp_training_material_insert(){
    $tid=$this->input->post('uri_val');
    $code= base64_decode(str_pad(strtr($tid, '-_', '+/'), strlen($tid) % 4, '=', STR_PAD_RIGHT));    
    $data['company_id']=$this->session->userdata('employer_id');
    $data['company_unit_id'] = $this->input->post('unit_id');
    $data['department_id'] = $this->input->post('department');
    $data['company_functional_id'] = $this->input->post('functional_name');
    $data['pack_id'] = $this->input->post('package');
    $data['maid'] = $this->input->post('assign');
    $data['status'] = '1';
    $data['created_date'] = date("Y-m-d H:i:s");
    $widget = $data['widget_id'] = $this->input->post('widget');
    if($widget==2){
        $data['topic_name'] = $this->input->post('topic_name');
        $data['widget_url'] = $this->input->post('widget_url');
    }
    if($widget==3){
        $data['topic_name'] = $this->input->post('topic_name');
        $config['allowed_types'] = 'mp3|3gp|mpeg';
        $config['upload_path']          = './upload/employer_upload/training_widget/audio';
        $config['file_name'] = date("dmY").'-'.$_FILES['upload_file']['name'];
    }
    if($widget==4){
        $data['topic_name'] = $this->input->post('topic_name');
        $config['allowed_types']        = 'doc|docx|pdf|xlsx';        
        $config['upload_path']          = './upload/employer_upload/training_widget/document';
        $config['file_name'] = date("dmY").'-'.$_FILES['upload_file']['name'];
    }
    if($widget==1){
        $data['topic_name'] = $this->input->post('description');
    }
    $this->load->library('upload', $config);
    $data1 = $this->upload->data();
    $full_path= $data1['full_path'];
    $file_name= $data1['file_name'];          
    $data['widget_name']=$data1['file_name'];
    if($this->Crud_modal->update_data("training_material_id=$code","mm_training_materials",$data)){
        if($data['widget_name'] !=""){
            $this->upload->do_upload('upload_file');
        } 
        $this->session->set_flashdata('data_message','<div style="color:green;font-size:14px;text-shadow:2px 1px 2px yellow"><strong>Record Updated!</strong></div>');
        redirect(base_url().'edit-training-material-form/'.$tid);
        //echo "Updated";
    }
}  
  

public function jaf_candidate_list(){
  if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
    $eid=$this->session->userdata('employer_id');
    $data["jobs"]=$this->Crud_modal->all_data_select('job_id,status,job_title','mm_master_job',"status in(1,3) and company_id=".$eid,'created_date desc');
	
      if($this->input->post("job_id")!=""){
        $jids=$this->input->post("job_id");
        $jname=$this->Crud_modal->fetch_single_data("job_title","mm_master_job","job_id=$jids");
        $data["selected_job_id"]=$jids;
        $data["job_title"]=$jname['job_title'];
       // print_r($data);
		$this->db->query('SET SESSION group_concat_max_len=150000');
        $d=$this->Crud_modal->fetch_single_data("group_concat(uid) as uids","mm_user_applied_job","job_id=$jids");
		$id_string=rtrim($d['uids'],",");
        if($id_string!=""){ 
            $data['users']=$udata=$this->Employer_model->get_user_jaf_data_by_job_id("mmj.job_id = $jids and ud.uid in($id_string)","maj.created_data");
           
        }
      }
	  //print_r($data);
	//exit();
      $this->load->view('employertempletes/head');
      $this->load->view('employertempletes/header');
      $this->load->view('jaf-candidate-list',$data);
      $this->load->view('employertempletes/footer');
      $this->load->view('employertempletes/sidebar');
    }else{
        redirect(base_url().'employer');
    }
}

	public function job_wise_not_applied_list(){
		$emp_id=$this->session->userdata('employer_id');
		$job_id=base64_decode(str_pad(strtr($this->input->post('job_id'), '-_', '+/'), strlen($this->input->post('job_id')) % 4, '=', STR_PAD_RIGHT));
		$data['code_id']=$job_id; 
		$data['jobs']=$this->Crud_modal->all_data_select("job_id,package_id,job_title,status","mm_master_job","status in(1,3) and company_id='$emp_id'","created_date DESC");
        $job_published=$this->Crud_modal->fetch_single_data("job_id,package_id,job_title","mm_master_job","job_id='$job_id'");
        $id=$job_published['job_id']; 
        $pack_id=$job_published['package_id'];
        $data['pack_id']=$pack_id;
        $data['job_title']=$job_published['job_title'];
        $count_val=0;
        if($pack_id!=''){
        $select="u_id";
        $table_name="score";
        $where="package_id in($pack_id) and u_id not in (select uid from mm_user_applied_job where job_id='$id') and u_id in (select mm_uid from user where user_type_id='2') ";
        $group="u_id";
        $having="count(u_id) = (SELECT count(ml_id) FROM `master_level` WHERE `pack_id`  in($pack_id) and `ml_status` = '1')";
        $order="score_id desc";
        $limit ="";                                        
        $package_neurons=$this->Crud_modal->fetchdata_with_limit_and_having($select,$table_name,$where,$group,$having,$order,$limit);
        }
        $data['package_neurons']=$package_neurons;
		
        $this->load->view('employertempletes/head'); 
        $this->load->view('employertempletes/header');
        $this->load->view('job_wise_not_applied',$data); 
        $this->load->view('employertempletes/footer');
        $this->load->view('employertempletes/sidebar');
	}
	
public function export_data1(){
  $code= base64_decode(str_pad(strtr($this->input->post('code'), '-_', '+/'), strlen($this->input->post('code')) % 4, '=', STR_PAD_RIGHT));
    $data['user_data']=$this->Employer_model->get_user_appied_data_by_job_id1("`mmj`.`job_id` = '$code'","`maj`.`created_data`");
  
  echo $this->load->view('export_applied_candidate_list1', $data,true);
}


public function export_jaf_data(){
   if($this->input->post("job_id")!=""){
       $jids=$this->input->post("job_id");
       $data["selected_job_id"]=$jids;
       $data["questions"]=$this->Crud_modal->all_data_select("job_question,choose_max","mm_master_job_question","job_id=".$jids." and status=1","order_id asc");
	   $this->db->query('SET SESSION group_concat_max_len=150000');
       $d=$this->Crud_modal->fetch_single_data("group_concat(uid) as uids","mm_user_applied_job","job_id=$jids");
       $id_string=rtrim($d['uids'],",");
       if($id_string!=""){
           $data['users']=$udata=$this->Employer_model->get_user_jaf_data_by_job_id("mmj.job_id = $jids and ud.uid in($id_string)","maj.created_data");
           for($i=0;$i<sizeof($udata);$i++){
            $id=$udata[$i]['job_id'];
            $userid=$udata[$i]['uid'];
            $ques=$this->Crud_modal->all_data_select("job_wise_ans_id,job_ques_id,user_ans","mm_job_wise_answer","job_id=$id and user_id=$userid and status=1","job_wise_ans_id asc"); 
            for($j=0;$j<sizeof($data["questions"]);$j++){
               $data["users"][$i]["answer"][$j]=$ques[$j]["user_ans"];
               $get_max=$this->Crud_modal->fetch_single_data("choose_max","mm_master_job_question","job_question_id=".$ques[$j]["job_ques_id"]);
               $data["users"][$i]["count_max"][$j]=$get_max["choose_max"];
            }
         }
       }
   }
    echo $this->load->view('export-jaf-list',$data,true);
}


	
	
}

