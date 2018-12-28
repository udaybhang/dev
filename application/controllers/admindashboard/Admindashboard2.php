<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admindashboard2 extends MX_Controller {	
  function __construct()
   {
						parent::__construct();
                                                error_reporting(0);
						$this->load->model('Admindashboard_modal');
						$this->load->model('crud/Crud_modal');
						$this->load->model('userdashboard/Userdashboard_modal');
						$this->load->helper('url');
						$this->load->library('session');
						$this->load->library('pagination');
						$this->load->model('mailer/Mailer_model');
						$this->load->model('employer/Employer_model');
 						$this->load->library('Phpmailer'); 
						$this->load->model('Pagination_model',"pgn");
						ini_set('memory_limit', '-1');
					if(($this->session->userdata('admin_name')=="" || $this->session->userdata('admin_name')==null) && ($this->session->userdata('admin_role')=="" || $this->session->userdata('admin_role')==null)){
						redirect(base_url().'admin');
					}
   }

   public function create_certification(){
   		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)) {
			$certi=$this->input->post('certi_n');
	   		if($certi==''){
				$data['title']='Admin Dashboard for Monday Morning';
				$data['master_usertype']=$this->Crud_modal->fetch_alls('user_type','user_type_id asc');
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
				$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('create-certification',$data);
				$this->load->view('admintempletes/footer');
	   		}else{
				$createdata['certification_name'] =$this->input->post('certi_n');
				$createdata['user_type_id'] =$this->input->post('utyid');
				$createdata['discription'] =$this->input->post('discrip');
				$createdata['features'] =$this->input->post('features');
				$createdata['required_neurons'] =$this->input->post('required_n');
				$createdata['created_by'] = $this->session->userdata('adminid');
				$createdata['created_date'] =date("Y-m-d H:i:s");
		

				$config['upload_path']          = './upload/certification/';
				$config['allowed_types']        = 'gif|jpg|png';
				$new_name = time().$_FILES["medal_icon"]['name'];
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('medal_icon')){
					$file=$this->upload->data();
					
					$createdata['medal_icon']=$file['file_name'];					
					$this->Crud_modal->data_insert("mm_master_certification",$createdata);
					$this->session->set_flashdata('certi_message','<div class="success"><strong>Success!</strong> Certificaton Created</div>');
					redirect(base_url().'certification-lists');
				}else{
					$this->session->set_flashdata('certi_message','<div class="danger"><strong>Oops!</strong>Error</div>');     
				}
	   		}
   	}else{
		    redirect(base_url().'admin','refresh');
		}


   }
   public function certification_lists()
   {   		
		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
			$data['title']='Admin Dashboard for Monday Morning';
			$data['topic_list']= $this->Crud_modal->fetch_alls('user_type','user_type_id asc');
			 $user_id=$this->input->post('user_id');
			if($user_id!=''){
				 $data['asid']=$user_id;
				$data['msqlist'] = $this->Crud_modal->all_data_select('*','mm_master_certification',"user_type_id='$user_id'",'certification_id desc');
			}else{
				
				$data['msqlist'] = $this->Crud_modal->fetch_alls('mm_master_certification','certification_id desc');
			}
			$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);	
			$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('certification-list',$data);
			$this->load->view('admintempletes/footer');
			}else{
				redirect(base_url().'admin','refresh');
			}
	}
	public function create_job(){
   		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)) {
			$certi=$this->input->post('job_title');
	   		if($certi==''){
				$data['title']='Admin Dashboard for Monday Morning';
				$data['master_usertype']=$this->Crud_modal->fetch_alls('user_type','user_type_id asc');
				$data['master_skills_test']=$this->Crud_modal->fetch_alls('master_skills_test','skills_id asc');
				$data['master_certification']=$this->Crud_modal->fetch_alls('mm_master_certification','certification_id asc');
				$data['master_states']=$this->Crud_modal->fetch_alls('states','sid asc');


//$tbl_name='mm_master_job';
// $where="company_id='$abc' ";


// $where="employer_company='$c_name'";
			
				
				// $this->Crud_modal->fetch_all_data('*',$tbl_name,$where);
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
				$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('create-job',$data);
				$this->load->view('admintempletes/footer');
	   		}else{
				$createdata['job_title'] =$this->input->post('job_title');
				$createdata['user_type_id'] =$this->input->post('utyid');
				$createdata['company_name'] =$this->input->post('c_name');
				$createdata['job_description'] =$this->input->post('discrip');
				$createdata['ctc_from'] =$this->input->post('ctc_from');
				$createdata['ctc_to'] =$this->input->post('ctc_to');
				$createdata['no_of_position'] =$this->input->post('no_of_position');
				$createdata['required_certification_id'] =$this->input->post('certi_id');
				
				$createdata['job_location_id'] =$this->input->post('job_location_id');
				$createdata['key_skills_id'] =$this->input->post('key_skills_id');
				$createdata['status'] =$this->input->post('status');

				$createdata['required_neurons'] =$this->input->post('required_n');
				$createdata['created_by'] = $this->session->userdata('adminid');
				$createdata['created_date'] =date("Y-m-d H:i:s");

				$config['upload_path']          = './upload/	/';
				$config['allowed_types']        = 'gif|jpg|png';
				$new_name = time().$_FILES["medal_icon"]['name'];
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('medal_icon')){					
					$file=$this->upload->data();					
					$createdata['company_icon']=$file['file_name'];	
					$this->Crud_modal->data_insert("mm_master_job",$createdata);
					$this->session->set_flashdata('job_message','<div class="success"><strong>Success!</strong>Job Created</div>');
					redirect(base_url().'job-lists');
				}else{
					$this->session->set_flashdata('job_message','<div class="danger"><strong>Oops!</strong>Error</div>');     
				}
	   		}
   	}else{
		    redirect(base_url().'admin','refresh');
		}
   }
   public function job_lists()
   {   		
		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
			$data['title']='Admin Dashboard for Monday Morning';
			$data['topic_list']= $this->Crud_modal->fetch_alls('user_type','user_type_id asc');
			 $user_id=$this->input->post('user_id');

			if($user_id!=''){
				$field="u.employer_company, s.* ";
			$table_name="mm_employer as u";
			$join1[0]='mm_master_job as s';
			$join1[1]='u.employer_id=s.company_id';
			$join1[2]="inner";
			$where="s.status=1 and user_type_id='$user_id' ";
			$data['msqlist']=$this->Crud_modal->fetch_data_by_one_table_join($field,$table_name,$join1,$where);
			}else{
				
				//$data['msqlist'] = $this->Crud_modal->fetch_alls('mm_master_job','job_id desc');// already here
				$field="u.employer_company, s.* ";
			$table_name="mm_employer as u";
			$join1[0]='mm_master_job as s';
			$join1[1]='u.employer_id=s.company_id';
			$join1[2]="inner";
			$where="s.status=1";
			$data['msqlist']=$this->Crud_modal->fetch_data_by_one_table_join($field,$table_name,$join1,$where);
			
			

			}
			$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);	
			$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('job-list',$data);
			$this->load->view('admintempletes/footer');
			}else{
				redirect(base_url().'admin','refresh');
			}
	}

	function get_city(){
		$stat=$this->input->post('State_id');
		$city=$this->Crud_modal->all_data_select('*','cities',"state_id='$stat'",'ci_id desc');		
		echo '<option value="">---Select City---</option>';
	 	foreach($city as $city){
			$city_id=$city['ci_id'];
			$city_nam= $city['name'];
			echo '<option value="'.$city_id.'">'.$city_nam.'</option>';
		 }

	}
	public function leaderboard_lists(){
		$data['title']='Admin Dashboard for Monday Morning';
		$count_val=$this->Crud_modal->check_numrow("neurons","neurons_id!=0");
		$config = array();
		if($count_val==$this->input->post('testtable2_length')){
			$config["per_page"]=$count_val;
		}else{
			$config["per_page"] = 20;
		}
		$data['assign_id']=$config["per_page"];
		$config["base_url"] = base_url() . "leaderboard-lists";
		$total_row = $this->Admindashboard_modal->get_neurons_admin_count();
		$config["total_rows"] = $total_row;
$config["num_links"] = 5;
		$config["uri_segment"] = 2;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;									
		$data['leaderboard_lists']=$this->Admindashboard_modal->get_neurons_admin_paggi($config["per_page"], $page);		
		$data["links"]=$this->pagination->create_links();
		$this->load->view('admintempletes/head',$data);
		$this->load->view('admintempletes/header',$data);	
		$this->load->view('admintempletes/sidebar',$data);
		$this->load->view('leaderboard-list',$data);
		$this->load->view('admintempletes/footer');
	}
	public function get_user_neurons_details(){

		$data['user_details']= $this->Admindashboard_modal->get_user_neurons_details($this->uri->segment(2));
		$data['title']='Admin Dashboard for Monday Morning';
		$this->load->view('admintempletes/head',$data);
		$this->load->view('admintempletes/header',$data);	
		$this->load->view('admintempletes/sidebar',$data);
		$this->load->view('leaderboard-user-detail-list',$data);
		$this->load->view('admintempletes/footer');
		
	}
	public function neurons_per_day(){
        if($this->input->post('date_from')!=""){
            $title=$date_from=date("Y-m-d H:i:s",strtotime($this->input->post('date_from')." + 1 days"));
            $date_to=date("Y-m-d H:i:s",strtotime($this->input->post('date_to')));
        }else{
            $date_from = str_replace("%20",' ',($this->uri->segment(2))?$this->uri->segment(2):0);
            $date_to = str_replace("%20",' ',($this->uri->segment(3))?$this->uri->segment(3):0);
        } 
        $data['day_wise']=$this->Admindashboard_modal->get_data_by_day_wise($date_from,$date_to);
        $allrecord = $this->pgn->get_neurons_per_day_data($date_from,$date_to);
        $all=$this->input->post('get_all');
        $noOfrecords=25;
        if($all==1){ $noOfrecords=$allrecord; }
        elseif($all==10){ $noOfrecords=10; }
        elseif($all==25){ $noOfrecords=25; }
        elseif($all==50){ $noOfrecords=50; }
        elseif($all==100){    $noOfrecords=100; }
        elseif($all==1000){ $noOfrecords=1000; }
        elseif($all==5000){ $noOfrecords=5000; }
        elseif($all==10000){ $noOfrecords=10000; }
        elseif($all==15000){ $noOfrecords=15000; }
        $data['noOfrecords']=$noOfrecords;
       $data['search_date_from']=$date_to;
       $data['search_date_to']=$date_from;        
        
        //$baseurl =  base_url().$this->router->class.'/'.$this->router->method."/".$title;
        $baseurl =  base_url()."neurons-per-day/".$date_from."/".$date_to;
        $paging=array();
        $paging['base_url'] =$baseurl;
        $paging['total_rows'] = $allrecord;
        $paging['per_page'] = $noOfrecords;
        $paging['uri_segment']= 4;
        $paging['num_links'] = 5;
        $paging['first_link'] = 'First';
        $paging['first_tag_open'] = '<li>';
        $paging['first_tag_close'] = '</li>';
        $paging['num_tag_open'] = '<li>';
        $paging['num_tag_close'] = '</li>';
        $paging['prev_link'] = 'Prev';
        $paging['prev_tag_open'] = '<li>';
        $paging['prev_tag_close'] = '</li>';
        $paging['next_link'] = 'Next';
        $paging['next_tag_open'] = '<li>';
        $paging['next_tag_close'] = '</li>';
        $paging['last_link'] = 'Last';
        $paging['last_tag_open'] = '<li>';
        $paging['last_tag_close'] = '</li>';
        $paging['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
        $paging['cur_tag_close'] = '</a></li>';
        
        $this->pagination->initialize($paging);    
        
        $data['limit'] = $paging['per_page'];
        $data['number_page'] = $paging['per_page']; 
        $data['offset'] = ($this->uri->segment(4)) ? $this->uri->segment(4):'0';
        
        $data['nav'] = $this->pagination->create_links();

       $data['datas'] = $this->pgn->get_neurons_per_day_data_list($date_from,$date_to,$data['limit'],$data['offset']);
   
        $this->load->view('admintempletes/head',$data);
        $this->load->view('admintempletes/header',$data);    
        $this->load->view('admintempletes/sidebar',$data);
        $this->load->view('neurons_per_day',$data);
        $this->load->view('admintempletes/footer');
}
	public function notusers_lists(){
    $userslist = $this->Crud_modal->fetch_alls('completed_assignment','cas_id');
    foreach ($userslist as $userlist) {
        $userslists[] = $userlist['uid'];
    }
    $allattemptusers = implode(',', $userslists);
    if($this->input->post('title')!=""){
        $title = trim($this->input->post('title'));
    }else{
        $title = str_replace("%20",' ',($this->uri->segment(2))?$this->uri->segment(2):0);
    }

        $allrecord = $this->pgn->all_idle_user_data('u.mm_uid desc',$title,$allattemptusers);
        $all=$this->input->post('get_all');
        $noOfrecords=10;
        if($all==1){
            $noOfrecords=$allrecord;
        }elseif($all==10){
                $noOfrecords=10;
        }elseif($all==25){
                $noOfrecords=25;
        }elseif($all==50){
                $noOfrecords=50;
        }elseif($all==100){
                $noOfrecords=100;
        }elseif($all==1000){
                $noOfrecords=1000;
        }elseif($all==5000){
                $noOfrecords=5000;
        }elseif($all==10000){
                $noOfrecords=10000;
        }elseif($all==15000){
                $noOfrecords=15000;
        }
        
        $data['noOfrecords']=$noOfrecords;
       $data['search_title']=$title;        
        
        //$baseurl =  base_url().$this->router->class.'/'.$this->router->method."/".$title;
        $baseurl =  base_url()."not-attempt-lists/".$title;
        $paging=array();
        $paging['base_url'] =$baseurl;
        $paging['total_rows'] = $allrecord;
        $paging['per_page'] = $noOfrecords;
        $paging['uri_segment']= 3;
        $paging['num_links'] = 5;
        $paging['first_link'] = 'First';
        $paging['first_tag_open'] = '<li>';
        $paging['first_tag_close'] = '</li>';
        $paging['num_tag_open'] = '<li>';
        $paging['num_tag_close'] = '</li>';
        $paging['prev_link'] = 'Prev';
        $paging['prev_tag_open'] = '<li>';
        $paging['prev_tag_close'] = '</li>';
        $paging['next_link'] = 'Next';
        $paging['next_tag_open'] = '<li>';
        $paging['next_tag_close'] = '</li>';
        $paging['last_link'] = 'Last';
        $paging['last_tag_open'] = '<li>';
        $paging['last_tag_close'] = '</li>';
        $paging['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
        $paging['cur_tag_close'] = '</a></li>';
        
        $this->pagination->initialize($paging);    
        
        $data['limit'] = $paging['per_page'];
        $data['number_page'] = $paging['per_page']; 
        $data['offset'] = ($this->uri->segment(3)) ? $this->uri->segment(3):'0';
        
        $data['nav'] = $this->pagination->create_links();

       $data['datas'] = $this->pgn->all_idle_user_data_list($data['limit'],$data['offset'],$title,$allattemptusers);
   
        $this->load->view('admintempletes/head',$data);
       $this->load->view('admintempletes/header',$data);    
       $this->load->view('admintempletes/sidebar',$data);
       $this->load->view('idle-users',$data);
       $this->load->view('admintempletes/footer');
}

	public function closeticketadmin(){
		try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				$v= $this->uri->segment(2);
				$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
				$update['status'] = 0;
				$update['modified_date'] = date('Y-m-d H:i:s');
				$update['closed_by'] = 1;

				$this->Crud_modal->update_data("ticket_id=$val",'mm_ticket',$update);
				redirect(base_url().'reply/'.$val);
			}else{					
				redirect(base_url().'admin','refresh');
			}
		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	} 
	public function industry_lists(){
	  	try{
				if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				    $data['title']='Admin Dashboard for Monday Morning';					
					$where = "status = '1'";
					$data['industry_lists'] = $this->Crud_modal->all_data_select('*','mm_master_industry_topic',$where,'industry_id desc');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('view-industry',$data);
					$this->load->view('admintempletes/footer');
				}else{					
				    redirect(base_url().'admin','refresh');
			    }
		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
 public function industry_edit(){
	  	try{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				    $data['title']='Admin Dashboard for Monday Morning';
					$v=$this->uri->segment(2);
					$id=base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
					$where = "industry_id='$id'";
					$data['industry_lists'] = $this->Crud_modal->all_data_select('*','mm_master_industry_topic',$where,'industry_id desc');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('edit-indusrty',$data);
					$this->load->view('admintempletes/footer');
				}else{					
				    redirect(base_url().'admin','refresh');
			    }
		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

	public function industry_create(){
	  	try{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				 	$createdata = array(
			        'industry_name' => $this->input->post('skills_name'),
			        'created_date' => date('Y-m-d H:i:s'),
			        'created_by' => $this->session->userdata('adminid'),
			        'status' => 1
					);
					$this->Crud_modal->data_insert('mm_master_industry_topic',$createdata);

				 	$this->session->set_flashdata('Added industry','<div class="success"><strong>Success!</strong> Data save.</div>');
				 	redirect(base_url().'industry-lists');
				}else{
				    redirect(base_url().'admin','refresh');
			    }
		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}


	public function industry_update(){
	  	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				 	$createdata = array(
			        'industry_name' => $this->input->post('skills_name'),
			        'created_date' => date('Y-m-d H:i:s'),
			        'created_by' => $this->session->userdata('adminid'),
			        'status' => 1
					);
					$id=$this->input->post('id');
					$this->Crud_modal->update_data("industry_id='$id'",'mm_master_industry_topic',$createdata);

				 	$this->session->set_flashdata('Added industry','<div class="success"><strong>Success!</strong> Data save.</div>');
				 	redirect(base_url().'industry-lists');
			}else{					
				redirect(base_url().'admin','refresh');
			}
		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
public function industry_delete()
{
	 $id=$this->uri->segment(2);
	 $val = base64_decode(str_pad(strtr($id, '-_', '+/'), strlen($id) % 4, '=', STR_PAD_RIGHT));
		     	$update_data = array(
		        'status' => '0'
		        
			);
			$where = "industry_id = '$val'";
	 $result=$this->Crud_modal->update_data($where,'mm_master_industry_topic',$update_data);
	 if($result)
	 {
	 	$this->session->set_flashdata('skills_test_insert_message','<div class="success"><strong>Success!</strong> Industry deleted</div>');
	 	redirect('industry-lists','refresh');
	 }
}
	public function update_user_in_mailchimp(){
			$data=$this->Crud_modal->all_data_select('*','user',"eamil_auth_status=1 and user_status=1",'mm_uid desc');
			foreach ($data as  $value) {
				$fname = $value['mm_user_full_name'];
				$lname = $value['mm_last_name'];
				$email = $value['mm_user_email'];
				if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL) === false){
					// MailChimp API credentials
					$apiKey = 'dbe17a14e053f7afe6a1aee6086db6cf-us16';
					$listID = '5d8c40be16';

					// MailChimp API URL
					$memberID = md5(strtolower($email));
					$dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
					$url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID;

					// member information
					$json = json_encode([
					'email_address' => $email,
					'status'        => 'subscribed',
					'merge_fields'  => [
					'FNAME'     => $fname,
					'LNAME'     => $lname
					]
					]);
					// send a HTTP POST request with curl
					$ch = curl_init($url);
					curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
					curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_TIMEOUT, 10);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
					$result = curl_exec($ch);
					$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
					curl_close($ch);
					// store the status message based on response code
					
				}
			}
			if ($httpCode == 200) {
						$this->session->set_flashdata('msg','<div class="success"><strong>Success!</strong>List updated.</div>');
						redirect(base_url().'add-user-mailchimp');
					}else{
						$this->session->set_flashdata('msg','<div class="danger">Something went wrong.</div>'); 
						redirect(base_url().'add-user-mailchimp');
					}
		}

	public function add_user_mailchimp(){
		try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				$data['title']='Admin Dashboard for Monday Morning';
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('add-user-mailchimp',$data);
				$this->load->view('admintempletes/footer');
			}
		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}	
	}
	public function edit_skills_test(){
	  	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
			    $data['title']='Admin Dashboard for Monday Morning';
				$v=$this->uri->segment(2);
				$id=base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
				$where = "skills_id='$id'";
				$data['skills_test_lists'] = $this->Crud_modal->all_data_select('*','master_skills_test',$where,'skills_id desc');
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('edit-skill',$data);
				$this->load->view('admintempletes/footer');
			}else{					
				    redirect(base_url().'admin','refresh');
			}
		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	 }

	public function skill_update(){
	  	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
			 	$createdata = array(
		        'skills_name' => $this->input->post('skills_name'),
		        'sub_skills_name' => implode(',',$this->input->post('sub_skills_name')),
		        'modified_date' => date('Y-m-d H:i:s'),
		        'modified_by' => $this->session->userdata('adminid')
				);
				
				$id=$this->input->post('id');
				$this->Crud_modal->update_data("skills_id='$id'",'master_skills_test',$createdata);

			 	$this->session->set_flashdata('skills_test_insert_message','<div class="success"><strong>Success!</strong> Skills Test has Inserted.</div>');
			 	redirect(base_url().'skills-test-list');
			}else{
				redirect(base_url().'admin','refresh');
			}
		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	 }
public function dailyreport(){
         try{
            if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
                
                if($this->input->post("date_from")!="" && $this->input->post("date_to")!=""){
                    $date_to = $this->input->post("date_to");
                    $date_from = $this->input->post("date_from");
                   $date_to = date('Y-m-d',strtotime($date_to));
                      $date_from = date('Y-m-d', strtotime($date_from));
                }else{
                    $date_to = date('Y-m-d');
                   $date_to = date('Y-m-d',strtotime($date_to.'+1 days'));
                      $date_from = date('2017-08-25');
                }
                
                $all_dates=$this->Admindashboard_modal->all_dailyreport_activity($date_from,$date_to);
                $i=0;
                foreach ($all_dates as $all_date) {
                    $date = $all_date['date'];
                    $userdata[$i]['date']=date('d-m-Y',strtotime($date));
                    $userdata[$i]['user']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)='$date'");
                    $userdata[$i]['assignment']= $this->Crud_modal->check_numrow('completed_assignment',"DATE(start_time)='$date'");
                    $neurons= $this->Admindashboard_modal->all_dailyreport_neurons("DATE(created_date)='$date'");
                    $userdata[$i]['neurons']= $neurons['neurons'];
                    $userdata[$i]['alluser']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)<='$date'");
                    $i++;
                }
                $data['all_dates']=$userdata;
                $this->load->view('admintempletes/head',$data);
                $this->load->view('admintempletes/header',$data);    
                  $this->load->view('admintempletes/sidebar',$data);
                $this->load->view('daily-report',$data);
                $this->load->view('admintempletes/footer'); 
            }else{
                redirect(base_url().'admin','refresh');
            }
        }catch (Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
     }

	 public function daywiseuserreport(){
	 	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				if($this->input->post('userdate')==''){
					redirect(base_url().'daily-report');
				}
				$data['date']=$date = $this->input->post('userdate');
				$date1 = date('Y-m-d',strtotime($date));
				$getdate = "DATE(u.reg_date)='$date1'";
				$data['useradata'] =$this->Admindashboard_modal->all_userreports($getdate);
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('day-wise-report-user',$data);
				$this->load->view('admintempletes/footer');
			}else{
				redirect(base_url().'admin','refresh');
			}
		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	 }
public function package_mapping_detail(){
	 	if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
	 		$data['title']='Admin Dashboard for Monday Morning';
	 		$package_id=$this->input->post('package');
	 		if($package_id==""){
	 			$data['package']= $this->Crud_modal->all_data_select("package_name,package_id,status","mm_packages","1=1","created_date Desc");
	 		}else{
	 			$data['package']= $this->Crud_modal->all_data_select("package_name,package_id,status,ma_id","mm_packages","1=1","created_date Desc");
	 			$data['asid']=$package_id;
	 			$data['assignment_list']=$this->Crud_modal->fetch_single_data('ma_id',"mm_packages","package_id='$package_id'");

	 		}	 		
			$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);	
		  	$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('package-map-view',$data);
			$this->load->view('admintempletes/footer');
		}

	 }	
	 	public function neurons_per_day_user_details(){
		$data['title']='Admin Dashboard for Monday Morning';
		if($this->input->post('date_from')!=""){
			$date_from=date("Y-m-d H:i:s",strtotime($this->input->post('date_from')." + 1 days"));
			$date_to=date("Y-m-d H:i:s",strtotime($this->input->post('date_to')));
			$sess['from']=$this->input->post('date_from');
			$sess['to']=$this->input->post('date_to');
			$this->session->set_userdata($sess);
			$data['day_wise']=$this->Admindashboard_modal->get_data_by_day_wise_for_user($date_from,$date_to);
		}

		$this->load->view('admintempletes/head',$data);
		$this->load->view('admintempletes/header',$data);	
		$this->load->view('admintempletes/sidebar',$data);
		$this->load->view('neurons-per-day_user_details',$data);
		$this->load->view('admintempletes/footer');
	}
	public function neurons_details_by_ass_wise(){
		$data['title']='Admin Dashboard for Monday Morning';
		$data['mm_uid']=$user_id =base64_decode(str_pad(strtr($this->uri->segment(2), '-_', '+/'), strlen($this->uri->segment(2)) % 4, '=', STR_PAD_RIGHT));
		$user_type=$this->Crud_modal->fetch_single_data("user_type_id","user","mm_uid='$user_id'");
		$pac_id=$this->Crud_modal->fetch_single_data('packages_id',"package_map","usertype_id='$user_type[user_type_id]'");
		$data['package_id']=explode(",",$pac_id['packages_id']);		
		$this->load->view('admintempletes/head',$data);
		$this->load->view('admintempletes/header',$data);	
		$this->load->view('admintempletes/sidebar',$data);
		$this->load->view('neurons-by-ass-wise',$data);
		$this->load->view('admintempletes/footer');
	}
	public function level_user_neurons(){
		$uri=explode("-", $this->uri->segment(2));
		$user_id =base64_decode(str_pad(strtr($uri[1], '-_', '+/'), strlen($uri[1]) % 4, '=', STR_PAD_RIGHT));
		$package_id =base64_decode(str_pad(strtr($uri[0], '-_', '+/'), strlen($uri[0]) % 4, '=', STR_PAD_RIGHT));
		$maids=$this->Crud_modal->fetch_single_data("ma_id","mm_packages","package_id='$package_id'");
		$data['maid']=explode(",", $maids['ma_id']);
		$data['mm_uid']=$user_id;
		$data['previous_uri']=$uri[2];
		$this->load->view('admintempletes/head',$data);
		$this->load->view('admintempletes/header',$data);	
		$this->load->view('admintempletes/sidebar',$data);
		$this->load->view('level_user_neurons',$data);
		$this->load->view('admintempletes/footer');

	}
 public function test_val(){
$cal=date('Y-m-d H:i:s');
	 	$not_user_oneweek=$this->Crud_modal->all_data_select('uid','completed_level',"start_time BETWEEN DATE_SUB('$cal', INTERVAL 7 DAY) AND '$cal'",'cl_id asc');
		foreach ($not_user_oneweek as $nt_week) {
		$notuser_oneweek[] = $nt_week['uid'];
		}
$all_not_attempt_user=implode(',', $notuser_oneweek);
		$data['ntleaderboard_lists']=$this->Crud_modal->all_data_select('mm_uid,mm_user_full_name,mm_last_name,mm_user_email,reg_date','user',"mm_uid NOT IN($all_not_attempt_user) and  mm_uid  IN(SELECT uid FROM completed_assignment) AND eamil_auth_status=1",'mm_uid DESC');
		$this->load->view('admintempletes/head',$data);
		$this->load->view('admintempletes/header',$data);	
		$this->load->view('admintempletes/sidebar',$data);
		$this->load->view('not-done-days',$data);
		$this->load->view('admintempletes/footer');
	    }

public function group_create(){
	 	try{
	 		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
	 			$where="status='1'";
	 			$data['privacy']=$this->Crud_modal->all_data_select('*','mm_group_privacy',$where,'group_privacy_id ASC');
	 			$data['group_type']=$this->Crud_modal->all_data_select('*','mm_group_type',$where,'group_type_id ASC');
	 			$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('create-group',$data);
				$this->load->view('admintempletes/footer');
	 		}
	 	}catch(Exception $e){
	 		echo 'Caught exception: ',  $e->getMessage(), "\n";
	 	}
	 }

 public function create_member(){
	 	try{
	 		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
	 			$where="status='1'";
	 			$data['group']=$this->Crud_modal->all_data_select('*','mm_group',$where,'group_id ASC');
	 			$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('create-member',$data);
				$this->load->view('admintempletes/footer');
	 		}
	 	}catch(Exception $e){
	 		echo 'Caught exception: ',  $e->getMessage(), "\n";
	 	}
	 }
	 	 public function insert_group(){
	 	try{
	 		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
				$config['upload_path']   = "./upload/group_images/"; 
				$config['allowed_types'] = 'gif|jpg|png';
		        $new_name = time().$_FILES["image"]['name'];
				$config['file_name'] = $new_name;  
		        $this->load->library('upload', $config);
		        $this->upload->do_upload('image');
				$grpoup_name=$this->input->post('group_name');
	 			$createdata=array('group_name' =>$this->input->post('group_name'),
	 							   'group_image'=>$new_name,
	 							  'group_description'=>$this->input->post('group_description'),
	 							  'group_leader_uid'=>$this->input->post('group_leader'),
	 							  'created_by'=>$this->session->userdata('adminid'),
                                  'group_prefix'=>$this->input->post('group_prefix'),
	 							  'status'=>$this->input->post('group_status'),
	 							  'group_type_id'=>$this->input->post('group_type'),
	 							  'group_privacy_id'=>$this->input->post('privacy'),
	 							  'created_date'=>date('Y-m-d H:i:s'),
	 							  'modified_date'=>date('Y-m-d H:i:s'),
	 							  'modified_by'=>$this->session->userdata('adminid')
	 			 );
 $this->Crud_modal->data_insert("mm_group",$createdata);
                                $uid=$this->input->post('group_leader');
	 			#####mail set ################
	 			$userdata=$this->Crud_modal->fetch_single_data("*","user","mm_uid='$uid'");
	 			$email=$userdata['mm_user_email'];
	 			$datas['name']=$userdata[mm_user_full_name];
	 			$datas['group_name']=$grpoup_name;
	 			
				$message=$this->load->view('mailer/leader_mail',$datas,true);
				$subject='New Leader Mail';
				$mail = new PHPMailer();
				$to =$email;	
				$mail->IsSMTP();
				$mail->Host = "smtp.gmail.com";
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = 'tls';
				$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
				$mail->Port = 587;
				$mail->Username = "info@mondaymorning.in";
				$mail->Password = "Info@123";
				$mail->From = "info@mondaymorning.in";
				$mail->FromName = $subject;
				$mail->AddAddress($to);
				$mail->IsHTML(true);
				$mail->Subject = $subject;
				$mail->Body = $message;
				if(!$mail->Send())
				{
				echo "Message could not be sent. <p>";
				echo "Mailer Error: " . $mail->ErrorInfo;
				}
                               
	 			############ mail set #########
	 			$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Group created</div>');
	 			redirect(base_url().'group-create');
	 			
	 		}
	 	}catch(Exception $e){
	 		echo 'Caught exception: ',  $e->getMessage(), "\n";
	 	}
	 }

	public function member_neurons(){
		try{
			$user_id=$this->uri->segment(2);
			$data['v']=$user_id;
			$data['package_map']=$this->Crud_modal->fetch_single_data('*','package_map',"usertype_id='2'");
			$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);	
			$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('gorup-members-neurons',$data);
			$this->load->view('admintempletes/footer');
		}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

	 public function view_member_report(){
	 		try{
   			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			     {
			     	$group_id=$this->uri->segment(2);
                                $data['group_id']=$group_id;
			     	$data['leaderboard_lists']=$this->Crud_modal->all_data_select('*','mm_group_members',"status='1' and group_id='$group_id'",'group_id ASC');
			     	$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
					$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('group-members',$data);
					$this->load->view('admintempletes/footer');
			}
	 	}catch(Exception $e){
	 		echo 'Caught exception: ',  $e->getMessage(), "\n";
	 	}
	}

	 public function view_group_report(){

	 		try{
   			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			     {
			     	$data['leaderboard_lists']=$this->Crud_modal->all_data_select('*','mm_group',"status in(0,1)",'group_id ASC');
			     	$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
					$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('group-report',$data);
					$this->load->view('admintempletes/footer');
			}
	 	}catch(Exception $e){
	 		echo 'Caught exception: ',  $e->getMessage(), "\n";
	 	}
	}
	  public function member_insert(){
	 	try{
	 		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
	 			$text_members=$this->input->post('text_members');
				$group_id=$this->input->post('group');
				$group_name=$this->Crud_modal->fetch_single_data("group_name,group_leader_uid","mm_group","group_id='$group_id'");
				$leader_name=$this->Crud_modal->fetch_single_data("mm_user_full_name","user","mm_uid='$group_name[group_leader_uid]'");
	 			for($k=0;$k<sizeof($text_members);$k++){					
	 				$createdata=array('group_id'=>$group_id,
		 							  'status'=>$this->input->post('member_status'),
		 							  'user_id'=>$text_members[$k],
		 							  'created_date'=>date('Y-m-d H:i:s'),
		 							  'modified_date'=>date('Y-m-d H:i:s'),
		 							  'modified_by'=>$this->session->userdata('adminid')
	 			 	);
				
	 		$result=$this->Crud_modal->data_insert("mm_group_members",$createdata);
	 		

				
				#####mail set ################
	 			$userdata=$this->Crud_modal->fetch_single_data("mm_user_email,mm_user_full_name","user","mm_uid='$text_members[$k]'");
	 			
				$email=$userdata['mm_user_email'];
				$datas['name']=$userdata[mm_user_full_name];
				$datas['group_name']=$group_name['group_name'];
				$datas['leader']=$leader_name['mm_user_full_name'];
				$message=$this->load->view('mailer/member_mail',$datas,true);
				$subject='New Member Mail';
				$mail = new PHPMailer();
				$to =$email;	
				$mail->IsSMTP();
				$mail->Host = "mondaymorning.in";
				$mail->SMTPAuth = true;
				$mail->Port = 587;
				$mail->Username = "mondaymorning@mondaymorning.in";
				$mail->Password = "monday@01";
				$mail->From = "mondaymorning@mondaymorning.in";
				$mail->FromName = $subject;
				$mail->AddAddress($to);
				$mail->IsHTML(true);
				$mail->Subject = $subject;
				$mail->Body = $message;
				if(!$mail->Send())
				{
				echo "Message could not be sent. <p>";
				echo "Mailer Error: " . $mail->ErrorInfo;
				}
                               
	 			############ mail set #########
	 			}
	 			$where="status='1'";
	 			$data['group']=$this->Crud_modal->all_data_select('*','mm_group',$where,'group_id ASC');
	 			if($data['group'])
	 		{

	 				$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Members created</div>');
	 			 redirect(base_url().'create-member');
	 			
	 		}
	 			
	 				// $this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Members created</div>');
	 			 // redirect(base_url().'create-member');
	 			
	 			
	 			$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('create-member',$data);
				$this->load->view('admintempletes/footer');
	 		}
	 		
	 	}
              
	 	catch(Exception $e){
	 		echo 'Caught exception: ',  $e->getMessage(), "\n";
	 	}
	 }
   public function search_member(){
                 try{
                         if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
                                 $keyword=$this->input->post('keyword');
                                 if(!empty($keyword)){
                                         $data_val=$this->Admindashboard_modal->search_user($keyword);
                                 }
                                 $val_check=$this->input->post('val2');

                                 if(!empty($data_val)){
                                         echo '<ul id="country-list" lass="rahul" style="height:121px!important;overflow-y:scroll;width:300px!important;">';
                                        foreach($data_val as $val) {
                                                if(!(in_array($val["mm_uid"], $val_check))){
                                                        $data_atttempt_neuron=$this->Crud_modal->fetch_single_data("neurons","neurons","u_id='$val[mm_uid]'");
                                                         $data_certification=$this->Userdashboard_modal->package_certification($val["mm_uid"]);
                                        echo '<li class="members_col" data-id="'.$val["mm_uid"].'" id="'.$val["mm_user_full_name"].'" data-val="'.$val["mm_user_email"].'"><a href="#">'.$val["mm_user_full_name"].'('.$val["mm_user_email"].')(Neurons:'.$data_atttempt_neuron["neurons"].')(Total Certificaton:'.$data_certification["count"].')</a></li>';
                                         }
                                         } 
                                        echo '</ul>';
                                 }
                 }
         }catch(Exception $e){
                         echo 'Caught exception: ',  $e->getMessage(), "\n";
                 }
         }
public function grid_fib_list()
	{
  	try
		{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
			    $data['title']='Admin Dashboard for Monday Morning';
				$data['mm_pro']=$this->Crud_modal->fetch_alls('user_data','uid asc');
				$where = "fib_status = 1";
				$data['topic_list']= $this->Crud_modal->all_data_select('*','master_topic','status=1','t_name asc');
				$assign_id=$this->input->post('assignorder');
				if($this->input->post('assignorder')!='')
				{
					$data['asid']=$assign_id;
					$data['grid_lists'] = $this->Crud_modal->all_data_select('*','mm_grid_fib',"topic='$assign_id' AND fib_status = 1",'fib_id desc');
				}
				else
				{
					$data['grid_lists'] = $this->Crud_modal->all_data_select('*','mm_grid_fib',$where,'fib_id desc');
				}
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('grid-list.php',$data);
				$this->load->view('admintempletes/footer');
			 }
			  else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
 	} 
public function delete_grid_questions(){
	 	try
			{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
	     	$v = $this->uri->segment(2);
			$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
	     	$update_data = array(
		        'fib_status' => '0',
		        'modified_by' => $this->session->userdata('adminid'),
		        'modified_date' => date('Y-m-d H:i:s')
			);
			$where = "fib_id = '$val'";
			if($this->Crud_modal->update_data($where,'mm_grid_fib',$update_data)){
				$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Deleted.</div>');
				redirect(base_url().'grid-fib-list');
			}else{
				$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Delete Data</div>');
				redirect(base_url().'grid-fib-list');
			}
	     }
	     else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}

	 }

	  public function view_grid()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		$v = $this->uri->segment(2);
		     		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
				    $data['title']='Admin Dashboard for Monday Morning';
					$data['mm_pro']=$this->Crud_modal->fetch_alls('user_data','uid asc');
					$where = "fib_id = '$val'";
					$data['gfibdata'] = $this->Crud_modal->fetch_single_data('*','mm_grid_fib',$where);
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('view-grid-fib',$data);
					$this->load->view('admintempletes/footer');
				 }
				  else
				 {
					
				    redirect(base_url().'admin','refresh');
			     }
			}
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
	 }
	 public function update_grid_fib(){
	 	try
			{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {  
	     	if($this->input->post('question')!=''){
	     		$val = $this->input->post('g_id');
	     	    $gr_id = base64_decode(str_pad(strtr($val, '-_', '+/'), strlen($val) % 4, '=', STR_PAD_RIGHT)); 
		     	$question = $this->input->post('question');
		     	$options = $this->input->post('options');
		     	$opt0=trim($options[0]);
		     	$opt1=','.trim($options[1]);
            	$opt2=','.trim($options[2]);
            	
            	if($options[3]!=''){
            		$opt3=','.trim($options[3]);
            	}else{
            		$opt3='';
            	}
		     	if($options[4]!=''){
            		$opt4=','.trim($options[4]);
            	}else{
            		$opt4='';
            	}
            	if($options[5]!=''){
            		$opt5=','.trim($options[5]);
            	}else{
            		$opt5='';
            	}
            	if($options[6]!=''){
            		$opt6=','.trim($options[6]);
            	}else{
            		$opt6='';
            	}
            	if($options[7]!=''){
            		$opt7=','.trim($options[7]);
            	}else{
            		$opt7='';
            	}
            	if($options[8]!=''){
            		$opt8=','.trim($options[8]);
            	}else{
            		$opt8='';
            	}
            	if($options[9]!=''){
            		$opt9=','.trim($options[9]);
            	}else{
            		$opt9='';
            	}
		     	$update_data = array(
			        'fib_question' => $question,
			        'fib_answer' => $opt0.$opt1.$opt2.$opt3.$opt4.$opt5.$opt6.$opt7.$opt8.$opt9,
			        'topic' => $this->input->post('master_topic'),
			        'type' => $this->input->post('master_type'),
			        'skill_tested' => $this->input->post('master_skills_test'),
			        'modified_by' => $this->session->userdata('adminid'),
			        'modified_date' => date('Y-m-d H:i:s'),
			        'difficulty_level' => $this->input->post('master_difficulty_level'),
			        'case_id' => $this->input->post('master_case')
				);
				$where = "fib_id = '$gr_id'";
				if($this->Crud_modal->update_data($where,'mm_grid_fib',$update_data)){
					$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Updated.</div>');
					redirect(base_url().'edit-grid-fib/'.$val);
				}else{
					$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Update Data</div>');
					redirect(base_url().'edit-grid-fib/'.$val);
				}
			}else{
				$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Question Field Empty</div>');
				redirect(base_url().'edit-grid-fib/'.$val);
			}
	     }
	     else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}

	 }
public function grid_fib()
		{
						$data['title']='Admin Dashboard for Monday Morning';
						$data['mm_pro']=$this->Crud_modal->fetch_alls('user_data','uid asc');
						$where = 'status =1';
						$data['master_topics'] = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$where,'t_id desc');
						$data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$where,'type_id desc');
						$data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name',' master_skills_test',$where,'skills_id desc');
						$whereall = 'status =1';
						$data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$whereall,'diffi_id desc');
						$data['master_case'] = $this->Crud_modal->all_data_select('case_id,case_name','case_study',$where,'case_id desc');
						
						$this->load->view('admintempletes/head',$data);
						$this->load->view('admintempletes/header',$data);	
					  	$this->load->view('admintempletes/sidebar',$data);
					  		if($this->uri->segment(2)){
							  	$v = $this->uri->segment(2);
								$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
								$where = "fib_id = '$val'";
								$data['grid_fib_edit_data'] = $this->Crud_modal->all_data_select('*','mm_grid_fib',$where,'fib_id desc');
								$this->load->view('edit-grid-fill',$data);
								}else{

										$this->load->view('grid-fill',$data);
								}
						
						$this->load->view('admintempletes/footer',$data);
		}
 
	public function create_grid_fill_in_blank()
	{
				try
				{
					if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null)
					{


						$created_by=$this->session->userdata('adminid');
						$matc_ans=$this->input->post('answer1');
						$fib_answer='';
						for ($i=0; $i < sizeof($matc_ans); $i++) {
						if($i<sizeof($matc_ans)-1){
							$fib_answer.=strtolower(trim($matc_ans[$i])).',';
						}else{
							$fib_answer.=strtolower(trim($matc_ans[$i]));
						}
						}
						$created_date=date('Y-m-d H:i:s');
						$fibquest = $this->input->post('fib_question');
						$data_array=array(
							"fib_question" => $fibquest,
							"fib_answer"   => $fib_answer,
							'topic' =>$this->input->post('master_topic'),
							'difficulty_level' => $this->input->post('master_difficulty_level'),
						    'type' => $this->input->post('master_type'),	
						    'skill_tested' => $this->input->post('master_skills_test'),
						    'case_id' => $this->input->post('master_case'),
							"created_date" => $created_date,
							"fib_status" => '1',
							"created_by"   => $created_by,
							"modified_date" => $created_date
							);
						
						if($this->Crud_modal->data_insert('mm_grid_fib',$data_array)){
							$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Inserted.</div>');
							redirect(base_url().'grid-fib');
						}else{
							$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Insert Data</div>');
							redirect(base_url().'grid-fib');
						}
					}
					 else
					 {
						
					    redirect(base_url().'admin','refresh');
				     }
				}
				catch(Exception $e)
				{
					echo 'Caught exception', $e->getMessage(),"\n";
				}
	}

public function create_bucket(){
	    	if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			     {
	    	 	$data['title']='Admin Dashboard for Monday Morning';
	    	 	$data['mm_pro']=$this->Crud_modal->fetch_alls('user_data','uid asc');
				$where = 'status =1';
				$data['master_topics'] = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$where,'t_id desc');
				$data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$where,'type_id desc');
				$data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name',' master_skills_test',$where,'skills_id desc');
				$whereall = 'status =1';
				$data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$whereall,'diffi_id desc');
				$data['master_case'] = $this->Crud_modal->all_data_select('case_id,case_name','case_study',$where,'case_id desc');
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('bucket',$data);
				$this->load->view('admintempletes/footer');
			}
	    }

	    public function insert_bucket(){
	    		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			     {
			     	$admin_id = $this->session->userdata('adminid');
			     	$order_level_save='';
			     	$data_level=$this->input->post('order_level');
			     	$data_save=$this->input->post('order_value');
			     	$left_order=$this->input->post('left_order');
			     	for($i=0;$i<sizeof($data_level);$i++){
			     		if($i==(sizeof($data_level)-1)){
			     			$order_level_save.=$data_level[$i];
			     		}else{
			     			$order_level_save.=$data_level[$i]."@|";
			     		}
			     	}
			     	$order_value_save='';
			     	for($j=0;$j<sizeof($data_save);$j++){
			     		if($j==(sizeof($data_save)-1)){
			     			$order_value_save.=$data_save[$j];
			     		}else{
			     			$order_value_save.=$data_save[$j]."@|";
			     		}
			     	}
			     	$options='';
			     	for ($k=0; $k <sizeof($data_save) ; $k++) { 
			     			$options.=$data_save[$k].'|';
			     	}
			     	 $options.=$left_order;
			     	$data_array=array(
						"bucket_question" => $this->input->post('bucket_question'),
						"bucket_answer"   => $order_value_save,
						"order_level"   => $order_level_save,
						'topic' =>$this->input->post('master_topic'),
						'difficulty_level' => $this->input->post('master_difficulty_level'),
						'bucket_option'=>$options,
					    'type' => $this->input->post('master_type'),	
					    'skill_tested' => $this->input->post('master_skills_test'),
					    'case_id' => $this->input->post('master_case'),
						"created_date" => date('Y-m-d H:i:s'),
						"bucket_status" => '1',
						"created_by"   => $admin_id,
						"modified_date" => date('Y-m-d H:i:s'),
					);
					if($this->Crud_modal->data_insert('mm_bucket',$data_array)){
							$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Inserted.</div>');
							redirect(base_url().'create-bucket');
						}else{
							$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Insert Data</div>');
							redirect(base_url().'create-bucket');
						}
			     }
	    }
public function create_word_detective(){
		$where = 'status =1';
		$data['master_topics'] = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$where,'t_id desc');
		$data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$where,'type_id desc');
		$data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name',' master_skills_test',$where,'skills_id desc');
		$data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$where,'diffi_id desc');
		$data['master_case'] = $this->Crud_modal->all_data_select('case_id,case_name','case_study',$where,'case_id desc');
		$data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$where,'diffi_id desc');
		$this->load->view('admintempletes/head',$data);
		$this->load->view('admintempletes/header',$data);	
	  	$this->load->view('admintempletes/sidebar',$data);
		$this->load->view('create-word-detectie',$data);
		$this->load->view('admintempletes/footer');
	}

	public function insert_word_detective(){
		print_r($this->input->post('hint_type'));
		//exit;
	 	try{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
		     	if($this->input->post('question')!=''){
		     		if($this->input->post('word')!=''){
				     	$question = $this->input->post('question');
				     	$options = $this->input->post('hint');
				     	$cans = $this->input->post('word');
				     	$master_topic = $this->input->post('master_topic');
				     	$master_type = $this->input->post('master_type');
				     	$master_skills_test = $this->input->post('master_skills_test');
				     	$insert_data = array(
					        'word_detective_question' => $question,
					        'word_detective_hint' => implode("|", $options),
					        'word_detective_answer' =>  strtolower($cans),
					        'topic' => $master_topic,
					        'hint_type' => implode(",", $this->input->post('hint_type')),
					        'type' => $master_type,	
					        'difficulty_level' => $this->input->post('master_difficulty_level'),
					        'skill_tested' => $master_skills_test,
					        'word_detective_status' => 1,
					        'created_by' => $this->session->userdata('adminid'),
					        'created_date' => date('Y-m-d H:i:s'),
					        'case_id' => $this->input->post('master_case')
						);
						if($this->Crud_modal->data_insert('mm_word_detective',$insert_data)){
							$this->session->set_flashdata('mcq_message','<div class="success"><strong>Success!</strong> Data Inserted.</div>');
							redirect(base_url().'create-word-detective');
						}else{
							$this->session->set_flashdata('mcq_message','<div class="danger"><strong>Oops!</strong> Failed to Insert Data</div>');
							redirect(base_url().'create-word-detective');
						}
					}else{
						$this->session->set_flashdata('mcq_message','<div class="danger"><strong>Oops!</strong> You have not selected correct answer.</div>');
						redirect(base_url().'create-word-detective');
					}
				}else{
					$this->session->set_flashdata('mcq_message','<div class="danger"><strong>Oops!</strong> Question Field Empty</div>');
					redirect(base_url().'create-word-detective');
				}
	     }
	     else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}

	 }
	  /////////////////////////////////////////
	     public function edit_bucket()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		$v = $this->uri->segment(2);
		     		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
				    $data['title']='Admin Dashboard for Monday Morning';
				    $where = "bucket_id = '$val'";
					$data['bucketdata'] = $this->Crud_modal->fetch_single_data('*','mm_bucket',$where);
					$wheres = 'status =1';
					$data['master_topics'] = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$wheres,'t_id desc');
					$data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$wheres,'type_id desc');
					$data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name',' master_skills_test',$wheres,'skills_id desc');	
					$data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$wheres,'diffi_id desc');
					$data['master_case'] = $this->Crud_modal->all_data_select('case_id,case_name','case_study',$wheres,'case_id asc');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('edit_bucket',$data);
					$this->load->view('admintempletes/footer');
				 }
				  else
				 {
					
				    redirect(base_url().'admin','refresh');
			     }
			}
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
	 }

	    public function bucket_list()
 	{
	  	try
		{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
			    $data['title']='Admin Dashboard for Monday Morning';
				$where = "bucket_status = '1'";
				$data['topic_list']= $this->Crud_modal->all_data_select('*','master_topic','status=1','t_name asc');
				$assign_id=$this->input->post('assignorder');
				if($this->input->post('assignorder')!='')
				{
					$data['asid']=$assign_id;
					$data['bucketlist'] = $this->Crud_modal->all_data_select('*','mm_bucket',"topic='$assign_id' AND bucket_status = '1'",'bucket_id desc');
				}
				else
				{
					$data['bucketlist'] = $this->Crud_modal->all_data_select('*','mm_bucket',$where,'bucket_id desc');
				}
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('bucket-list',$data);
				$this->load->view('admintempletes/footer');
			 }
			  else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
 }
public function delete_bucket(){
	 	try
			{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
	     	$v = $this->uri->segment(2);
			$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
	     	$update_data = array(
		        'bucket_status' => '0',
		        'modified_by' => $this->session->userdata('adminid'),
		        'modified_date' => date('Y-m-d H:i:s')
			);
			$where = "bucket_id = '$val'";
			if($this->Crud_modal->update_data($where,'mm_bucket',$update_data)){
				$this->session->set_flashdata('bucket_message','<div class="success"><strong>Success!</strong> Data Deleted.</div>');
				redirect(base_url().'bucket-list');
			}else{
				$this->session->set_flashdata('bucket_message','<div class="danger"><strong>Oops!</strong> Failed to Delete Data</div>');
				redirect(base_url().'bucket-list');
			}
	     }
	     else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}

	 }
	  public function view_bucket()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		$v = $this->uri->segment(2);
		     		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
				    $data['title']='Admin Dashboard for Monday Morning';
					$where = "bucket_id = '$val'";
					$data['bucket'] = $this->Crud_modal->fetch_single_data('*','mm_bucket',$where);
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('view-bucket',$data);
					$this->load->view('admintempletes/footer');
				 }
				  else
				 {
					
				    redirect(base_url().'admin','refresh');
			     }
			}
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
	 }	
	 public function update_bucket(){
	    		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			     {  
			     	print_r($_POST);
			     	$admin_id = $this->session->userdata('adminid');
			     	$order_level_save='';
			     	$update_id=$this->input->post('bucket_id');
			     	$data_level=$this->input->post('order_level');
			     	$data_save=$this->input->post('order_value');
			     	$left_order=$this->input->post('left_order');
			     	for($i=0;$i<sizeof($data_level);$i++){
			     		if($i==(sizeof($data_level)-1)){
			     			$order_level_save.=$data_level[$i];
			     		}else{
			     			$order_level_save.=$data_level[$i]."@|";
			     		}
			     	}
			     	$order_value_save='';
			     	for($j=0;$j<sizeof($data_save);$j++){
			     		if($j==(sizeof($data_save)-1)){
			     			$order_value_save.=$data_save[$j];
			     		}else{
			     			$order_value_save.=$data_save[$j]."@|";
			     		}
			     	}
			     	$options='';
			     	for ($k=0; $k <sizeof($data_save) ; $k++) { 
			     			$options.=$data_save[$k].'|';
			     	}
			     	 $options.=$left_order;
			     	$data_array=array(
			     		'case_id' => $this->input->post('master_case'),
						"bucket_question" => $this->input->post('bucket_question'),
						"bucket_answer"   => $order_value_save,
						'bucket_option'=>$options,
						"order_level"   => $order_level_save,
						'topic' =>$this->input->post('master_topic'),
						'type' => $this->input->post('master_type'),
						'skill_tested' => $this->input->post('master_skills_test'),
						'difficulty_level' => $this->input->post('master_difficulty_level'),
						"modified_by"   => $admin_id,
						"modified_date" => date('Y-m-d H:i:s'),
					);
					$where="bucket_id='$update_id'";
					if($data_return=$this->Crud_modal->update_data($where,'mm_bucket',$data_array)){
							$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data upadte Successfully.</div>');
							redirect(base_url().'bucket-list');
						}else{
							$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Insert Data</div>');
							redirect(base_url().'bucket-list');
						}
			     }
	    }
	    ///////////////////

 public function crossword_create(){
	    	$data['title']='Admin Dashboard for Monday Morning';
    	 	$data['mm_pro']=$this->Crud_modal->fetch_alls('user_data','uid asc');
			$where = 'status =1';
			$data['master_topics'] = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$where,'t_id desc');
			$data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$where,'type_id desc');
			$data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name',' master_skills_test',$where,'skills_id desc');
			$whereall = 'status =1';
			$data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$whereall,'diffi_id desc');
			$data['master_case'] = $this->Crud_modal->all_data_select('case_id,case_name','case_study',$where,'case_id desc');
	    	$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);	
			$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('crossword',$data);
			$this->load->view('admintempletes/footer');
	    }

	    public function crossword_insert(){
	    	$admin_id = $this->session->userdata('adminid');
	    	// /print_r($this->input->post());
	    	$first=$this->input->post('first_coordinate');
	    	$word=$this->input->post('word');
	    	$second=$this->input->post('second_coordinate');
	    	$cross_value=$this->input->post('question');
	    	$crossword_hint='';
	    	$data_pos='';
	    	for($i=0;$i<sizeof($first);$i++)
	    	{
	    		if($i==(sizeof($first)-1)){
	    			$crossword_hint.=$cross_value[$i];
	    			$data_pos.=$first[$i].'||'.$second[$i];
	    		}else{
	    			$crossword_hint.=$cross_value[$i]."||";
	    			$data_pos.=$first[$i].'||'.$second[$i]."$$";
	    		}
	    	}
	    	$data_array=array(
						"crossword_question" => $this->input->post('crossword_question'),
						"crossword_hint"=>$crossword_hint,
						"crossword_array"   => implode(',', $word),
						"row_count"   => $this->input->post('count_value'),
						"column_count"   => $this->input->post('count_row'),
						"crossword_position"   => $data_pos,
						'topic' =>$this->input->post('master_topic'),
						'difficulty_level' => $this->input->post('master_difficulty_level'),
					    'type' => $this->input->post('master_type'),	
					    'skill_tested' => $this->input->post('master_skills_test'),
					    'case_id' => $this->input->post('master_case'),
					    'status' => '1',
						"created_date" => date('Y-m-d H:i:s'),
						"status" => '1',
						"created_by"   => $admin_id,
						"modified_by"   => $admin_id,
						"modified_date" => date('Y-m-d H:i:s'),
					);
	    	if($this->Crud_modal->data_insert('mm_crossword',$data_array)){
				$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Inserted.</div>');
				redirect(base_url().'crossword-create');
			}else{
				$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Insert Data</div>');
				redirect(base_url().'crossword-create');
			}

	    }
	    // cross word work
	    public function cross_word_list()
 	{
	  	try
		{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
			    $data['title']='Admin Dashboard for Monday Morning';
				$where = "status = '1'";
				$data['topic_list']= $this->Crud_modal->all_data_select('*','master_topic','status=1','t_name asc');
				$assign_id=$this->input->post('assignorder');
				if($this->input->post('assignorder')!='')
				{
					$data['asid']=$assign_id;
					$data['cross_word_list'] = $this->Crud_modal->all_data_select('*','mm_crossword',"topic='$assign_id' AND status = '1'",'crossword_id desc');
				}
				else
				{
					$data['cross_word_list'] = $this->Crud_modal->all_data_select('*','mm_crossword',$where,'crossword_id desc');
				}
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('cross-word-list',$data);
				$this->load->view('admintempletes/footer');
			 }
			  else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
 }
 public function cross_word_delete(){
	 	try
			{
				
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
	     	$v = $this->uri->segment(2);
			$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
	     	$update_data = array(
		        'status' => '0',
		        'modified_by' => $this->session->userdata('adminid'),
		        'modified_date' => date('Y-m-d H:i:s')
			);
			$where = "crossword_id = '$val'";
			if($this->Crud_modal->update_data($where,'mm_crossword',$update_data)){
				$this->session->set_flashdata('cross_word_message','<div class="success"><strong>Success!</strong> Data Deleted.</div>');
				redirect(base_url().'cross-word-list');
			}else{
				$this->session->set_flashdata('cross_word_message','<div class="danger"><strong>Oops!</strong> Failed to Delete Data</div>');
				redirect(base_url().'cross-word-list');
			}
	     }
	     else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}

	 }
	 public function cross_word_edit()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		$v = $this->uri->segment(2);
		     		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
				    $data['title']='Admin Dashboard for Monday Morning';
				    $where = "crossword_id = '$val'";
					$data['cross_word_data'] = $this->Crud_modal->fetch_single_data('*','mm_crossword',$where);
					$wheres = 'status =1';
					$data['master_topics'] = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$wheres,'t_id desc');
					$data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$wheres,'type_id desc');
					$data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name',' master_skills_test',$wheres,'skills_id desc');	
					$data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$wheres,'diffi_id desc');
					$data['master_case'] = $this->Crud_modal->all_data_select('case_id,case_name','case_study',$wheres,'case_id asc');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('edit-cross-word',$data);
					$this->load->view('admintempletes/footer');
				 }
				  else
				 {
					
				    redirect(base_url().'admin','refresh');
			     }
			}
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
	 }
	 public function update_cross_word(){
	    	$admin_id = $this->session->userdata('adminid');
	    	$update_id = $this->input->post('updateid');
	    	//print_r($this->input->post()); die;
	    	$first=$this->input->post('first_coordinate');
	    	$word=$this->input->post('word');
	    	$second=$this->input->post('second_coordinate');
	    	$cross_value=$this->input->post('question');
	    	$crossword_hint='';
	    	$data_pos='';
	    	for($i=0;$i<sizeof($first);$i++)
	    	{
	    		if($i==(sizeof($first)-1)){
	    			$crossword_hint.=$cross_value[$i];
	    			$data_pos.=$first[$i].'||'.$second[$i];
	    		}else{
	    			$crossword_hint.=$cross_value[$i]."||";
	    			$data_pos.=$first[$i].'||'.$second[$i]."$$";
	    		}
	    	}
	    	$data_array=array(
						"crossword_question" => $this->input->post('crossword_question'),
						"crossword_hint"=>$crossword_hint,
						"crossword_array"   => implode(',', $word),
						"row_count"   => $this->input->post('count_row'),
						"column_count"   => $this->input->post('count_value'),
						"crossword_position"   => $data_pos,
						'topic' =>$this->input->post('master_topic'),
						'difficulty_level' => $this->input->post('master_difficulty_level'),
					    'type' => $this->input->post('master_type'),	
					    'skill_tested' => $this->input->post('master_skills_test'),
					    'case_id' => $this->input->post('master_case'),
						"status" => '1',
						"modified_by"   => $admin_id,
						"modified_date" => date('Y-m-d H:i:s'),
					);
	    	        $where="crossword_id='$update_id'";
					if($data_return=$this->Crud_modal->update_data($where,'mm_crossword',$data_array)){
							$this->session->set_flashdata('cross_word_message','<div class="success"><strong>Success!</strong> Data updated successfully.</div>');
							redirect(base_url().'cross-word-list');
						}else{
							$this->session->set_flashdata('cross_word_message','<div class="danger"><strong>Oops!</strong> Failed to Insert Data</div>');
							redirect(base_url().'cross-word-list');
						}

	    }
	    public function cross_word_view()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		$v = $this->uri->segment(2);
		     		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
				    $data['title']='Admin Dashboard for Monday Morning';
					$where = "crossword_id = '$val'";
					$data['cross_word_data'] = $this->Crud_modal->fetch_single_data('*','mm_crossword',$where);
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('view-cross-word',$data);
					$this->load->view('admintempletes/footer');
				 }
				  else
				 {
					
				    redirect(base_url().'admin','refresh');
			     }
			}
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
	 }

public function word_detective_list()
 	{
	  	try
		{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
			    $data['title']='Admin Dashboard for Monday Morning';
				$where = "word_detective_status = '1'";
				$data['topic_list']= $this->Crud_modal->all_data_select('*','master_topic','status=1','t_name asc');
				$assign_id=$this->input->post('assignorder');
				if($this->input->post('assignorder')!='')
				{
					$data['asid']=$assign_id;
					$data['word_detective_list'] = $this->Crud_modal->all_data_select('*','mm_word_detective',"topic='$assign_id' AND word_detective_status = '1'",'word_detective_id desc');
				}
				else
				{
					$data['word_detective_list'] = $this->Crud_modal->all_data_select('*','mm_word_detective',$where,'word_detective_id desc');
				}
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('word-detective-list',$data);
				$this->load->view('admintempletes/footer');
			 }
			  else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
 }
 public function delete_word_detective(){
	 	try
			{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
	     	$v = $this->uri->segment(2);
			$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
	     	$update_data = array(
		        'word_detective_status' => '0',
		        'modified_by' => $this->session->userdata('adminid'),
		        'modified_date' => date('Y-m-d H:i:s')
			);
			$where = "word_detective_id = '$val'";
			if($this->Crud_modal->update_data($where,'mm_word_detective',$update_data)){
				$this->session->set_flashdata('word_detective_message','<div class="success"><strong>Success!</strong> Data Deleted.</div>');
				redirect(base_url().'word-detective-list');
			}else{
				$this->session->set_flashdata('word_detective_message','<div class="danger"><strong>Oops!</strong> Failed to Delete Data</div>');
				redirect(base_url().'word-detective-list');
			}
	     }
	     else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}

	 }
	  public function view_word_detective()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		$v = $this->uri->segment(2);
		     		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
				    $data['title']='Admin Dashboard for Monday Morning';
					$where = "word_detective_id = '$val'";
					$data['word_detective'] = $this->Crud_modal->fetch_single_data('*','mm_word_detective',$where);
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('view-word-detective',$data);
					$this->load->view('admintempletes/footer');
				 }
				  else
				 {
					
				    redirect(base_url().'admin','refresh');
			     }
			}
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
	 }	
	  public function edit_word_detective()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		$v = $this->uri->segment(2);
		     		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
				    $data['title']='Admin Dashboard for Monday Morning';
				    $where = "word_detective_id = '$val'";
					$data['word_detective_data'] = $this->Crud_modal->fetch_single_data('*','mm_word_detective',$where);
					$wheres = 'status =1';
					$data['master_topics'] = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$wheres,'t_id desc');
					$data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$wheres,'type_id desc');
					$data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name',' master_skills_test',$wheres,'skills_id desc');	
					$data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$wheres,'diffi_id desc');
					$data['master_case'] = $this->Crud_modal->all_data_select('case_id,case_name','case_study',$wheres,'case_id asc');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('edit_word_detective',$data);
					$this->load->view('admintempletes/footer');
				 }
				  else
				 {
					
				    redirect(base_url().'admin','refresh');
			     }
			}
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
	 }
	  public function update_word_detective(){
	    		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			     {  
			     	    $admin_id = $this->session->userdata('adminid');
			     	    $question = $this->input->post('question');
			     	    $update_id = $this->input->post('updateid');
				     	$options = $this->input->post('hint');
				     	$cans = $this->input->post('word');
				     	$master_topic = $this->input->post('master_topic');
				     	$master_type = $this->input->post('master_type');
				     	$master_skills_test = $this->input->post('master_skills_test');
				     	$data_array = array(
					        'word_detective_question' => $question,
					        'word_detective_hint' => implode("|", $options),
					        'word_detective_answer' =>  strtolower($cans),
					        'topic' => $master_topic,
					        'hint_type' => implode(",", $this->input->post('hint_type')),
					        'type' => $master_type,	
					        'difficulty_level' => $this->input->post('master_difficulty_level'),
					        'skill_tested' => $master_skills_test,
					        'word_detective_status' => 1,
					        "modified_by"   => $admin_id,
						    "modified_date" => date('Y-m-d H:i:s'),
					        'case_id' => $this->input->post('master_case')
						);
			     	
					$where="word_detective_id='$update_id'";
					if($data_return=$this->Crud_modal->update_data($where,'mm_word_detective',$data_array)){
							$this->session->set_flashdata('word_detective_message','<div class="success"><strong>Success!</strong> Data upadte Successfully.</div>');
							redirect(base_url().'word-detective-list');
						}else{
							$this->session->set_flashdata('word_detective_message','<div class="danger"><strong>Oops!</strong> Failed to Insert Data</div>');
							redirect(base_url().'word-detective-list');
						}
			     }
	    }	

 public function daywisenotuserreport(){
	 	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				if($this->uri->segment(2)==''){
					redirect(base_url().'daily-report','refresh');
				}
				$data['date']=$date=$this->uri->segment(2);
				$date1 = date('Y-m-d',strtotime($date));
				$getdate = "DATE(u.reg_date)='$date1'";
				$data['useradata'] =$this->Admindashboard_modal->all_userreports($getdate);
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('not-day-attempt',$data);
				$this->load->view('admintempletes/footer');
			}else{
				redirect(base_url().'admin','refresh');
			}
		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	 }

  

##########################  user answer report   started from here  ###########################################

	 public function view_mcq_user_answer()
	{
  	try
		{
			 
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
			    $data['title']='Admin Dashboard for Monday Morning';
				$data['mm_pro']=$this->Crud_modal->fetch_alls('user_data','uid asc');
				$data['scores_lists'] = $this->Crud_modal->fetch_alls('score','score_id desc');
				$data['user_lists'] = $this->Crud_modal->fetch_alls('user','mm_user_full_name ASC');
				$data['package_lists']=$this->Admindashboard_modal->check_package_tool_type(1);
				//$data['package_lists'] = $this->Crud_modal->fetch_alls('mm_packages','package_id ASC');
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('mcq-user-answer',$data);
				$this->load->view('admintempletes/footer');
			 }
			  else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
 	}
 	public function get_assignment_data()
		{
			  try
			{
				   
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
					        $pid=  $this->input->post('Package_id');
							$where="`package_id`='$pid'";
							$data=$this->Crud_modal->all_data_select('*','mm_packages',$where,'package_name asc');
							$aid = explode(',', $data[0]['ma_id']);
							$len = count($aid);
							$m_type=$this->input->post('m_type');
							echo '<option value="">Select Asignment</option>';
							for($i=0; $i<=$len-1; $i++)
							{
                               $id = $aid[$i];
                               $val_check=$this->Crud_modal->all_data_select('*','master_level',"maid='$id' and m_type='$m_type' and ml_status='1'",'maid asc');
                               if(sizeof($val_check)>0){
                               	echo '<option value="'.$id.'">'.$this->Crud_modal->get_assignment_name($id).'</option>';
                               }
							}
							//return $this->load->view('city',$data);
				 }
				 else
				 {
					
				    redirect(base_url(),'refresh');
			   }
			}
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}
		public function get_level_data()
		{
			  try
			{
				   
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
					        $aid=  $this->input->post('Assign_id');
							$where="`maid`='$aid'";
							$m_type=$this->input->post('m_type');
							$data=$this->Crud_modal->all_data_select('*','master_level',$where,'lvl_name asc');
							echo '<option value="">Select Level</option>';
							foreach($data as $value)
							{
								echo $id=$value['ml_id'];
                               $val_check=$this->Crud_modal->check_numrow('master_level',"ml_id='$id' and ml_status='1' and m_type='$m_type'");
                               if($val_check>0){
                               echo '<option value="'.$value["ml_id"].'">'.$value["lvl_name"].'</option>';
                           	   }
							}
							//return $this->load->view('city',$data);
				 }
				 else
				 {
					
				    redirect(base_url(),'refresh');
			   }
			}
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}
		public function get_mcq_user_ans_list()
	{ 
  	try
		{
			 
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
	     	   
	     	    if($this->input->post('user_name') !="" && $this->input->post('package') !="" && $this->input->post('asignment') !="" && $this->input->post('level') !="")
	     	    {
	     	    	  $uid=$this->input->post('user_name');
	     	    	  $aid=$this->input->post('asignment');
	     	    	  $lid=$this->input->post('level');
	     	    	 $where = "maid = '$aid' and ml_id = '$lid' and u_id = '$uid'";
					 $data['user_ans_data'] = $this->Crud_modal->fetch_single_data('*','mcq_user_ans',$where);
					 $this->load->view('mcq-user-answer-list',$data);
	     	    }
			 }
			  else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
 	}
 	// bucket user ans report
 	public function view_bucket_user_answer()
	{
  	try
		{
			 
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {

			    $data['title']='Admin Dashboard for Monday Morning';
				$data['mm_pro']=$this->Crud_modal->fetch_alls('user_data','uid asc');
				$data['scores_lists'] = $this->Crud_modal->fetch_alls('score','score_id desc');
				$data['user_lists'] = $this->Crud_modal->fetch_alls('user','mm_user_full_name ASC');
				$data['package_lists']=$this->Admindashboard_modal->check_package_tool_type(8);
				//$data['package_lists'] = $this->Crud_modal->fetch_alls('mm_packages','package_id ASC');
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('bucket-user-answer',$data);
				$this->load->view('admintempletes/footer');
			 }
			  else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
 	}
 	public function get_bucket_user_ans_list()
	{ 
  	try
		{
			 
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
	     	   
	     	    if($this->input->post('user_name') !="" && $this->input->post('package') !="" && $this->input->post('asignment') !="" && $this->input->post('level') !="")
	     	    {
	     	    	  $uid=$this->input->post('user_name');
	     	    	  $aid=$this->input->post('asignment');
	     	    	  $lid=$this->input->post('level');  
	     	    	  $where = "maid = '$aid' and ml_id = '$lid' and u_id = '$uid'";
					  $data['user_ans_data'] = $this->Crud_modal->all_data_select('*','mm_bucket_user_ans',$where,'bucket_user_a asc');
					  $this->load->view('bucket-user-answer-list',$data);
	     	    }
			 }
			  else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
 	}
 	 public function view_word_detective_user_answer()
	{
  	try
		{
			 
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
			    $data['title']='Admin Dashboard for Monday Morning';
				$data['mm_pro']=$this->Crud_modal->fetch_alls('user_data','uid asc');
				$data['scores_lists'] = $this->Crud_modal->fetch_alls('score','score_id desc');
				$data['user_lists'] = $this->Crud_modal->fetch_alls('user','mm_user_full_name ASC');
				$data['package_lists']=$this->Admindashboard_modal->check_package_tool_type(9);
				//$data['package_lists'] = $this->Crud_modal->fetch_alls('mm_packages','package_id ASC');
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('word-detective-user-answer',$data);
				$this->load->view('admintempletes/footer');
			 }
			  else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
 	}
 	public function get_word_detective_user_ans_list()
	{ 
  	try
		{
			 
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
	     	  
	     	    if($this->input->post('user_name') !="" && $this->input->post('package') !="" && $this->input->post('asignment') !="" && $this->input->post('level') !="")
	     	    {
	     	    	  $uid=$this->input->post('user_name');
	     	    	  $aid=$this->input->post('asignment');
	     	    	  $lid=$this->input->post('level');  
	     	    	  $where = "maid = '$aid' and ml_id = '$lid' and u_id = '$uid'";
					  $data['user_ans_data'] = $this->Crud_modal->all_data_select('*','mm_word_detective_user_ans',$where,'word_det_u_ans_id asc');
					  $this->load->view('word-detective-user-answer-list',$data);
	     	    }
			 }
			  else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
 	}
 	// cross word user answer report start here
 	 public function view_cross_word_user_answer()
	{
  	try
		{
			 
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
			    $data['title']='Admin Dashboard for Monday Morning';
				$data['mm_pro']=$this->Crud_modal->fetch_alls('user_data','uid asc');
				$data['scores_lists'] = $this->Crud_modal->fetch_alls('score','score_id desc');
				$data['user_lists'] = $this->Crud_modal->fetch_alls('user','mm_user_full_name ASC');
				$data['package_lists']=$this->Admindashboard_modal->check_package_tool_type(10);
				//$data['package_lists'] = $this->Crud_modal->fetch_alls('mm_packages','package_id ASC');
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('cross-word-user-answer',$data);
				$this->load->view('admintempletes/footer');
			 }
			  else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
 	}
 	public function get_cross_word_user_ans_list()
	{ 
  	try
		{
			 
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
	     	  
	     	    if($this->input->post('user_name') !="" && $this->input->post('package') !="" && $this->input->post('asignment') !="" && $this->input->post('level') !="")
	     	    {
	     	    	  $uid=$this->input->post('user_name');
	     	    	  $aid=$this->input->post('asignment');
	     	    	  $lid=$this->input->post('level');  
	     	    	  $where = "maid = '$aid' and ml_id = '$lid' and u_id = '$uid'";
					  $data['user_ans_data'] = $this->Crud_modal->all_data_select('*','mm_crossword_user_ans', $where,'crossword_ans_id asc');
					  $this->load->view('cross-word-user-answer-list',$data);
	     	    }
			 }
			  else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
 	}
 	// cross word user answer report end here
   // grid fib user ans report start from here
public function view_grid_fib_user_answer()
	{
  	try
		{
			 
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
			    $data['title']='Admin Dashboard for Monday Morning';
				$data['mm_pro']=$this->Crud_modal->fetch_alls('user_data','uid asc');
				$data['scores_lists'] = $this->Crud_modal->fetch_alls('score','score_id desc');
				$data['user_lists'] = $this->Crud_modal->fetch_alls('user','mm_user_full_name ASC');
				$data['package_lists']=$this->Admindashboard_modal->check_package_tool_type(7);
				//$data['package_lists'] = $this->Crud_modal->fetch_alls('mm_packages','package_id ASC');
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('grib-fib-user-answer',$data);
				$this->load->view('admintempletes/footer');
			 }
			  else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
 	}
 	public function get_grib_fib_user_ans_list()
	{ 
  	try
		{
			 
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
	     	  
	     	    if($this->input->post('user_name') !="" && $this->input->post('package') !="" && $this->input->post('asignment') !="" && $this->input->post('level') !="")
	     	    {
	     	    	  $uid=$this->input->post('user_name');
	     	    	  $aid=$this->input->post('asignment');
	     	    	  $lid=$this->input->post('level');  
	     	    	  $where = "maid = '$aid' and ml_id = '$lid' and u_id = '$uid'";
					  $data['user_ans_data'] = $this->Crud_modal->all_data_select('*','mm_grid_fib_user_ans', $where,'g_fill_user_a asc');
					 // print_r($data['user_ans_data']); die;
					  $this->load->view('grib-user-answer-list',$data);
	     	    }
			 }
			  else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
 	}
 	// grid fib user ans report end from here
########################################flow chart ############################
 	public function create_process(){
 			$data['title']='Admin Dashboard for Monday Morning';
    	 	$data['mm_pro']=$this->Crud_modal->fetch_alls('user_data','uid asc');
			$where = 'status =1';
			$data['master_topics'] = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$where,'t_id desc');
			$data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$where,'type_id desc');
			$data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name',' master_skills_test',$where,'skills_id desc');
			$whereall = 'status =1';
			$data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$whereall,'diffi_id desc');
			$data['master_case'] = $this->Crud_modal->all_data_select('case_id,case_name','case_study',$where,'case_id desc');
	    	$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);	
			$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('process',$data);
			$this->load->view('admintempletes/footer');
 	}

 	public function process_insert(){
	 		$admin_id = $this->session->userdata('adminid');
	    	// /print_r($this->input->post());
	    	$first=$this->input->post('first_coordinate');
	    	$word=$this->input->post('word');
	    	$answer_word=$this->input->post('answer_word');
	    	$second=$this->input->post('second_coordinate');
	    	$cross_value=$this->input->post('question');
	    	$data_array=array(
						"process_question" => $this->input->post('process_question'),
						"process_array"   => implode(',', $word),
						"answer_array"   => implode(',', $answer_word),
						"row_count"   => $this->input->post('count_value'),
						"column_count"   => $this->input->post('count_row'),
						'topic' =>$this->input->post('master_topic'),
						'difficulty_level' => $this->input->post('master_difficulty_level'),
					    'type' => $this->input->post('master_type'),	
					    'skill_tested' => $this->input->post('master_skills_test'),
					    'case_id' => $this->input->post('master_case'),
						"created_date" => date('Y-m-d H:i:s'),
						"status" => '1',
						"created_by"   => $admin_id,
						"modified_by"   => $admin_id,
						"modified_date" => date('Y-m-d H:i:s'),
					);
	    	if($this->Crud_modal->data_insert('mm_process_generator',$data_array)){
				$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Inserted.</div>');
				redirect(base_url().'create-process');
			}else{
				$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Insert Data</div>');
				redirect(base_url().'create-process');
			}

	 	}
 	#######################################flow chart #############################

 public function group_edit(){
	 	try{
	 		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
	 			$val=base64_decode(str_pad(strtr($this->uri->segment(2), '-_', '+/'), strlen($this->uri->segment(2)) % 4, '=', STR_PAD_RIGHT));
	 			$data['privacy']=$this->Crud_modal->all_data_select('*','mm_group_privacy',"status=1",'group_privacy_id ASC');
	 			$data['group_type']=$this->Crud_modal->all_data_select('*','mm_group_type',"status=1",'group_type_id ASC');
	 			$data['group_detail']=$this->Crud_modal->fetch_single_data("*","mm_group","group_id='$val'");
	 			$data['group_member']=$this->Crud_modal->all_data_select('*','mm_group_members',"group_id='$val'",'group_member_id ASC');
	 			$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('group-edit',$data);
				$this->load->view('admintempletes/footer');
	 		}
	 	}catch(Exception $e){
	 		echo 'Caught exception: ',  $e->getMessage(), "\n";
	 	}
	 }

 public function group_edit_insert(){
	 	if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
	 		    $val=$this->uri->segment(2);
	 		    if($_FILES["image"]['name']){
	 			$config['upload_path']   = "./upload/group_images/"; 
				$config['allowed_types'] = 'gif|jpg|png'; 
				$config['max_size']      = 10000; 
				$config['max_width']     = 1024; 
				$config['max_height']    = 768;
		        $new_name = time().$_FILES["image"]['name'];
				$config['file_name'] = $new_name;
		        $this->load->library('upload', $config);
		        $this->upload->do_upload('image');
		        unlink('./upload/group_images/'.$this->input->post('previous_group_image'));
		        }else{
		        	$new_name=$this->input->post('previous_group_image');
		        }
		        if($this->input->post('group_leader')!=''){
		        	$group_leader_id=$this->input->post('group_leader');
		        }else{
		        	$group_leader_id=$this->input->post('previous-id');
		        }
		        $group_id=$this->input->post('group_id');
	 			$createdata=array('group_name' =>$this->input->post('group_name'),
	 							  'group_image'=>$new_name,
	 							  'group_description'=>$this->input->post('group_description'),
	 							  'group_prefix'=>$this->input->post('group_prefix'),
	 							  'group_leader_uid'=>$group_leader_id,
	 							  'created_by'=>$this->session->userdata('adminid'),
	 							  'status'=>$this->input->post('group_status'),
	 							  'group_type_id'=>$this->input->post('group_type'),
	 							  'group_privacy_id'=>$this->input->post('privacy'),
	 							  'created_date'=>date('Y-m-d H:i:s'),
	 							  'modified_date'=>date('Y-m-d H:i:s'),
	 							  'modified_by'=>$this->session->userdata('adminid')
	 			 );
	 			if($this->Crud_modal->update_data("group_id='$group_id'",'mm_group',$createdata)){
	 				$this->session->set_flashdata('assign_update_message','<div class="success"><strong>Success!</strong>Group Updated</div>');
				redirect(base_url().'group-edit/'.rtrim(strtr(base64_encode($group_id), '+/', '-_'), '='));
			}
	 	}
	 }

public function leave_group_admin(){
	try{
		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
			$uid=$this->input->post('user_id');
			$data_val=$this->Admindashboard_modal->leave_group($uid);
			echo json_encode("You have successfully deleted this member.");
		}
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	}
public function group_delete(){
	 	try{
	 		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
	 			$val=base64_decode(str_pad(strtr($this->uri->segment(2), '-_', '+/'), strlen($this->uri->segment(2)) % 4, '=', STR_PAD_RIGHT));
	 			$group_table="mm_group";
	 			$group_memeber_table="mm_group_members";
	 			$data_success=$this->Admindashboard_modal->group_delete_model($val,$group_table);
	 			$data_success=$this->Admindashboard_modal->group_delete_model($val,$group_memeber_table);
	 			$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong>Group deleted successfully</div>');
	 			redirect(base_url().'view-group-report');
	 		}
	 	}catch(Exception $e){
	 		echo 'Caught exception: ',  $e->getMessage(), "\n";
	 	}
	 }
	 public function view_match_the_following_user_answer()
	{
  	try
		{
			 
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
			    $data['title']='Admin Dashboard for Monday Morning';
				$data['mm_pro']=$this->Crud_modal->fetch_alls('user_data','uid asc');
				$data['scores_lists'] = $this->Crud_modal->fetch_alls('score','score_id desc');
				$data['user_lists'] = $this->Crud_modal->fetch_alls('user','mm_user_full_name ASC');
				$data['package_lists']=$this->Admindashboard_modal->check_package_tool_type(3);
				//$data['package_lists'] = $this->Crud_modal->fetch_alls('mm_packages','package_id ASC');
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('mtf-user-answer',$data);
				$this->load->view('admintempletes/footer');
			 }
			  else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
 	}
 	public function get_match_the_following_user_ans_list()
	{ 
  	try
		{
			 
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
	     	  
	     	    if($this->input->post('user_name') !="" && $this->input->post('package') !="" && $this->input->post('asignment') !="" && $this->input->post('level') !="")
	     	    {
	     	    	  $uid=$this->input->post('user_name');
	     	    	  $aid=$this->input->post('asignment');
	     	    	  $lid=$this->input->post('level');  
	     	    	  $where = "maid = '$aid' and level_id = '$lid' and user_id = '$uid'";
					  $data['user_ans_data'] = $this->Crud_modal->all_data_select('*','mtf_answer', $where,'mtf_id asc');
					 // print_r($data['user_ans_data']); die;
					  $this->load->view('match-the-followig-answer-list',$data);
	     	    }
			 }
			  else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
 	}
	// case study start from here
 	public function view_case_study_user_answer()
	{
  	try
		{
			 
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
			    $data['title']='Admin Dashboard for Monday Morning';
				$data['mm_pro']=$this->Crud_modal->fetch_alls('user_data','uid asc');
				$data['scores_lists'] = $this->Crud_modal->fetch_alls('score','score_id desc');
				$data['user_lists'] = $this->Crud_modal->fetch_alls('user','mm_user_full_name ASC');
				$data['package_lists']=$this->Admindashboard_modal->check_package_tool_type(4);
				//$data['package_lists'] = $this->Crud_modal->fetch_alls('mm_packages','package_id ASC');
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('case-study-user-answer',$data);
				$this->load->view('admintempletes/footer');
			 }
			  else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
 	}
 	public function get_case_study_user_ans_list(){ 
  	try{		 
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
	     	  
	     	    if($this->input->post('user_name') !="" && $this->input->post('package') !="" && $this->input->post('asignment') !="" && $this->input->post('level') !="")
	     	    {
	     	    	  $uid=$this->input->post('user_name');
	     	    	  $aid=$this->input->post('asignment');
	     	    	  $lid=$this->input->post('level');  
	     	    	  $where = "maid = '$aid' and ml_id = '$lid' and u_id = '$uid'";
	     	    	  $where1 = "maid = '$aid' and ml_id = '$lid' and uid = '$uid'";
	     	    	  $where2 = "maid = '$aid' and level_id = '$lid' and uid = '$uid'";
	     	    	  // case_fib_user_arranged data
					  $data['fib_data'] = $this->Crud_modal->all_data_select('*','case_fib_user_arranged', $where,'c_fill_user_a ASC');
					  // case_match_user_arranged data
					  $data['match_data'] = $this->Crud_modal->all_data_select('*','case_match_user_arranged', $where,"c_match_user_a");
					  // case_mcq_user_ans data
					  $data['mcq_data'] = $this->Crud_modal->all_data_select('*','case_mcq_user_ans', $where2,'cmua_id ASC');
					  // case_mcq_user_ans data
					  $data['sequene_data'] = $this->Crud_modal->all_data_select('*','case_sequence_user_arranged', $where,'s_u_id ASC');
					  // case_subjective_user_ans data
					  $data['subjective_data'] = $this->Crud_modal->all_data_select('*','case_subjective_user_ans', $where,'c_s_u_a_id ASC');
					  $this->load->view('case-study-answer-list',$data);
	     	    }
			 }
			  else
			 {
				
			    redirect(base_url().'admin','refresh');
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
 	}
 	// case study end from here

function approve_employer_account(){
if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
$id=$this->uri->segment(2); 
$st=$this->uri->segment(3);
$code= base64_decode(str_pad(strtr($id, '-_', '+/'), strlen($id) % 4, '=', STR_PAD_RIGHT));
$data['title']='Admin Dashboard for Monday Morning';
$where="employer_id=$code";
$emp=$this->Crud_modal->get_employer($code);
   $name=$emp['employer_contact_person_name'];
$email=$emp['employer_email'];
$udata = array('employer_status'=>$st); 
  
if($this->Crud_modal->update_data($where,'mm_employer',$udata)){
if($st==0){
$this->session->set_flashdata('data_message','<div class="success"><strong> Successfully Disapproved.</strong></div>');
}else{
$this->session->set_flashdata('data_message','<div class="success"><strong> Successfully Approved.</strong></div>');
$created_mail=$this->Mailer_model->employer_account_activation_mail("MondayMorning - Account Activation Mail",$email,$name);
}
redirect(base_url().'employer-lists');         
}else{
$this->session->set_flashdata('data_message','<div class="danger"><strong>Some Error Occurred.</strong></div>');
redirect(base_url().'employer-lists');
}
}
} 

public function dashboard_latest()
	{
		  try 
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    	$data['title']='Admin Dashboard for Monday Morning';
			     		$data['totaluser']=$this->Admindashboard_modal->total_reg_user();
						$usertype=$this->input->post('usertype');
						if($usertype != ''){
						$whereas = "user_type_id = '$usertype'";
						$data['reg_user_data']=$this->Crud_modal->all_data_select('*','user',$whereas,'mm_uid desc');
						$data['usert']=$usertype;
						}
						else{
							$data['reg_user_data']=$this->Crud_modal->fetch_alls('user','mm_uid desc');
						}
						$data['system_neurons']=$this->Crud_modal->all_data_select('sum(neurons) as total_neurons','score',"1=1",'neurons desc');
						$data['assign_user_data']=$this->Admindashboard_modal->all_completed_assignment_with_user();
						$data['goingon_assign_user_data']=$this->Admindashboard_modal->all_going_assignment_with_user();
						$data['user_type']=$this->Crud_modal->fetch_alls('user_type','user_type_id desc');
						$data['user']=$this->Crud_modal->fetch_alls('user','mm_uid desc');

						$where2 = "user_type_id = '2'";
						$data['consultant']=$this->Crud_modal->check_numrow('user',$where2);
						$where1 = "user_type_id = '1'";
						$data['student']=$this->Crud_modal->check_numrow('user',$where1);
						$where3 = "eamil_auth_status = '1'";
						$data['verified']=$this->Crud_modal->check_numrow('user',$where3); 
						$where4 = "eamil_auth_status = '0'";
						$data['ntverified']=$this->Crud_modal->check_numrow('user',$where4);
						$data['case_unched']=$this->Admindashboard_modal->alldatawith_group_order('*','case_subjective_user_ans',"status=0",'c_s_u_a_id asc');
						$data['user_data']=$this->Admindashboard_modal->all_data();
						$data['score']=$this->Admindashboard_modal->all_score();
						$data['ticket_closed']=$this->Crud_modal->check_numrow('mm_ticket',"status='0'");
						$data['ticket_open']=$this->Crud_modal->check_numrow('mm_ticket',"status='1'");
						$userslist = $this->Crud_modal->fetch_alls('completed_assignment','cas_id');
 
							$all_dates=$this->Admindashboard_modal->all_dailyreport_activity();
							$i=0;
							foreach ($all_dates as $all_date) {
							$date = $all_date['date']; 
							$userdata[$i]['date']=date('d-m-Y',strtotime($date));//die;
							$userdata[$i]['user']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)='$date'");// total user on this date(new user)
							
							$userdata[$i]['assignment']= $this->Crud_modal->check_numrow('completed_level',"DATE(end_time)='$date' and status = 1");// complete assignment on this date
							$neurons= $this->Admindashboard_modal->all_dailyreport_neurons("DATE(created_date)='$date'");
							$userdata[$i]['neurons']= $neurons['neurons'];
							$userdata[$i]['alluser']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)<='$date'");///
							$temp_val=$this->Crud_modal->all_data_select("mm_uid","user","DATE(reg_date)='$date'","mm_uid DESC");
							//print_r($temp_val); 
							// code for old user
                             $today_user = $this->Admindashboard_modal->all_distinct_data_select("uid","completed_level","DATE(end_time)='$date' and status=1","uid DESC");
                            
                             $old_user = 0;
                             $new_user = 0;
                             $tottl = count($today_user);
                             $temp1 = '';
                             $temp2 = '';
                             for($s=0; $s<$tottl; $s++){
                                   $uuid =  $today_user[$s]['uid'];
                                   $reg_date=$this->Crud_modal->fetch_single_data("reg_date","user","mm_uid='$uuid'");
								   // echo "<pre>";
								   // echo $date."        ";
								   // echo $reg_date['reg_date'];
								 
                                   if(DATE("Y-m-d",strtotime($reg_date['reg_date']))==$date){
		                                 
									    if($s==0){
		                                   $temp2=$today_user[$s]['uid'];
		                                   }else{
		                                   	$temp2.=','.$today_user[$s]['uid'];
		                                   }
                                       $new_user++;
                                   }
                                   	else{
										
                                   		   if($s==0){
		                                   $temp1=$today_user[$s]['uid'];
		                                   }else{
		                                   	$temp1.=','.$today_user[$s]['uid'];
		                                   }
                                       $old_user++;
                                   	}

                             }
							 
                             $old_user_id = trim($temp1,','); 
                             $new_user_id = trim($temp2,',');
                             if($old_user_id !=''){
                                  $old_user_neuran=$this->Crud_modal->all_data_select("sum(neurons) as neuran","score","u_id in($old_user_id) ","score_id DESC");
                             }
                             if($new_user_id !=''){
                             	$new_user_neuran=$this->Crud_modal->all_data_select("sum(neurons) as neuran","score","u_id in($new_user_id) and date(created_date)='$date'","score_id DESC");
                             }
                      
                             $userdata[$i]['old_neuan'] = $old_user_neuran[0]['neuran'];
                             $userdata[$i]['new_neuan'] = $new_user_neuran[0]['neuran'];
                             $userdata[$i]['old'] = $old_user;
							 $sizeof=sizeof($temp_val);//die;
							$count_val=0;
							$cc=0;
							if($sizeof>0){
							$ttt=0;
							for($k=0;$k<$sizeof;$k++){
							$uid=$temp_val[$k]['mm_uid'];
	                          $ttt=$this->Crud_modal->check_numrow('completed_level',"uid='$uid' and date(end_time)='$date' and status=1");
	                          if($ttt>0){
	                          $count_val+=1;
	                          $cc+=$ttt;
	                          }
							}
							$userdata[$i]['allusercount']=$count_val;
							}else{
							$userdata[$i]['allusercount']=$count_val;
							}
							$userdata[$i]['new_assignment']=$userdata[$i]['assignment']-$cc; // attempted package of old user
							$userdata[$i]['old_assignment']=$cc;  // attempted package of new user
							$i++;
							}
							
							$data['all_dates']=$userdata; 
						####### new code for attemped new user / attemped old user / end here ###########
						$all_dates=$this->Admindashboard_modal->all_dailyreport_activity();
						$i=0;
						foreach ($all_dates as $all_date) {
							$date = $all_date['date'];
							$userdata[$i]['date']=date('d-m-Y',strtotime($date));
							$userdata[$i]['user']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)='$date'");
							$userdata[$i]['assignment']= $this->Crud_modal->check_numrow('completed_level',"DATE(end_time)='$date'");
							$neurons= $this->Admindashboard_modal->all_dailyreport_neurons("DATE(created_date)='$date'");
							$userdata[$i]['neurons']= $neurons['neurons'];
							$userdata[$i]['alluser']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)<='$date'");
							$i++;
						}
						$data['all_dates']=$userdata;
						########### daily report ###############
						##### package count #########

						$this->load->view('admintempletes/head',$data);
						$this->load->view('admintempletes/header',$data);	
						$this->load->view('admintempletes/sidebar',$data);
						$this->load->view('index-old',$data,$olduser); 
						$this->load->view('admintempletes/footer');
						//$this->load->view('admintempletes/foot');
				 }
				  else
				 {					
				    redirect(base_url().'admin','refresh');
			     }
			}
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
	}
public function daywise_old_report(){
         try{
             if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
                // if($this->input->post('userdate')==''){
                //     redirect(base_url().'daily-report','refres');
                // }          $data['date']=$date = $this->input->post('userdate');
                           $date = $this->input->post('olduser_date');
                           $date = date('Y-m-d',strtotime($date));
                        
							$i=0;						
							$userdata[$i]['date']=date('d-m-Y',strtotime($date));//die;
							$userdata[$i]['user']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)='$date'");// total user on this date(new user)
							
							$userdata[$i]['assignment']= $this->Crud_modal->check_numrow('completed_level',"DATE(end_time)='$date' and status = 1");// complete assignment on this date
							$neurons= $this->Admindashboard_modal->all_dailyreport_neurons("DATE(created_date)='$date'");
							$userdata[$i]['neurons']= $neurons['neurons'];
							$userdata[$i]['alluser']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)<='$date'");///
							$temp_val=$this->Crud_modal->all_data_select("mm_uid","user","DATE(reg_date)='$date'","mm_uid DESC");
							//print_r($temp_val); 
							// code for old user
                             $today_user = $this->Admindashboard_modal->all_distinct_data_select("uid","completed_level","DATE(end_time)='$date' and status=1","uid DESC");
                            
                             $old_user = 0;
                             $new_user = 0;
                             $tottl = count($today_user);
                             $temp1 = '';
                             $temp2 = '';
                             for($s=0; $s<$tottl; $s++){
                                   $uuid =  $today_user[$s]['uid'];
                                   $reg_date=$this->Crud_modal->fetch_single_data("reg_date","user","mm_uid='$uuid' and user_status='1'");
															 
                                   if(DATE("Y-m-d",strtotime($reg_date['reg_date']))==$date){
		                                 
									    if($s==0){
		                                   $temp2=$today_user[$s]['uid'];
		                                   }else{
		                                   	$temp2.=','.$today_user[$s]['uid'];
		                                   }
                                       $new_user++;
                                   }
                                   	else{
										
                                   		   if($s==0){
		                                   $temp1=$today_user[$s]['uid'];
		                                   }else{
		                                   	$temp1.=','.$today_user[$s]['uid'];
		                                   }
                                       $old_user++;
                                   	}

                             }
							 $new_user_neuran='';
							 $old_user_neuran='';
                             $old_user_id = trim($temp1,','); 
                             $new_user_id = trim($temp2,',');
                   $new_user_neuran=$this->Crud_modal->all_data_select("*","user","mm_uid in($old_user_id)","mm_uid DESC");
                   $data['user_data']=$new_user_neuran;
                   $data['report_date']=$date;
                $this->load->view('admintempletes/head',$data);
                $this->load->view('admintempletes/header',$data);    
                  $this->load->view('admintempletes/sidebar',$data);
                $this->load->view('olduser-daywise-report',$data);
                $this->load->view('admintempletes/footer');
            }
            else{
                redirect(base_url().'admin','refresh');
            }
        }catch (Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
     }
	 
	 
	 public function pending_submission_detail(){
         try{
             if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
                $data['case_unched']=$this->Admindashboard_modal->alldatawith_group_order('*','case_subjective_user_ans',"status=0",'c_s_u_a_id asc');
                    $this->load->view('admintempletes/head',$data);
                    $this->load->view('admintempletes/header',$data);    
                      $this->load->view('admintempletes/sidebar',$data);
                    $this->load->view('pending_submission_detail',$data);
                    $this->load->view('admintempletes/footer');
            }
            else{
                redirect(base_url().'admin','refresh');
            }
        }catch (Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
     }
public function employer_job_list(){
                  try{
                     if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
                            $data['title']='Admin Dashboard for Monday Morning';
                                $data['employer_jobs']=$empJ=$this->Admindashboard_modal->get_all_employer_jobs(); //print_r($empJ); die;
								$where="industry_id in(SELECT distinct employer_industry_id FROM mm_employer WHERE employer_status = 1 ORDER BY employer_id)"; $data["company_list"]=$this->Crud_modal->fetch_alls('mm_employer', 'employer_company asc');
								$data["industry_list"]=$this->Crud_modal->all_data_select("industry_id,industry_name",'mm_master_industry_topic',$where,'industry_id');
                                $industry_id=$this->input->post('industry_id');
                                $functional_id=$this->input->post('functional_id');
                                $company_id=$this->input->post('company');
                                $data['industry_selected']='0';
                                $data['functional_selected']='0';
                                $data['company_selected']='0';
                                $data['selected_industry_value']=$industry_id;
                                $data['selected_functional_value']=$functional_id;
                                $data['selected_company_value']=$company_id;

                                if($industry_id!='' && $functional_id!='' && $company_id!=''){
                                    $data['employer_jobs'] = $this->Admindashboard_modal->get_all_employer_jobs_by_functional_id($functional_id);
                                    $data['industry_selected']='0';
                                    $data['functional_selected']='0';
                                    $data['company_selected']='0';
                                }
                                elseif($industry_id!='' && $functional_id!='' && $company_id==''){
                                    $data['employer_jobs'] = $this->Admindashboard_modal->get_all_employer_jobs_by_functional_id($functional_id);
                                    $data['industry_selected']='0';
                                    $data['functional_selected']='0';
                                    $data['company_selected']='0';
                                }
                                elseif($industry_id!='' && $functional_id=='' && $company_id==''){
                                    $data['employer_jobs'] = $this->Admindashboard_modal->get_all_employer_jobs_by_industry_id($industry_id);
                                    $data['industry_selected']='0';
                                    $data['functional_selected']='0';
                                    $data['company_selected']='0';
                                }
                                elseif($industry_id=='' && $functional_id=='' && $company_id!=''){
                                    $data['employer_jobs'] = $this->Admindashboard_modal->get_all_employer_jobs_by_company_id($company_id);
                                    $data['industry_selected']='0';
                                    $data['functional_selected']='0';
                                    $data['company_selected']='0';
                                }

                                $start=$this->input->post('start');
                                $end=$this->input->post('end');
                                if($start!='' || $end!=''){
                                    $data['employer_jobs'] = $this->Admindashboard_modal->get_all_employer_jobs_by_date($start,$end);
                                }
                                
                                $this->load->view('admintempletes/head',$data);
                                $this->load->view('admintempletes/header',$data);    
                                 $this->load->view('admintempletes/sidebar',$data);
                                $this->load->view('employer_job_list',$data);
                                $this->load->view('admintempletes/footer');
                                //$this->load->view('admintempletes/foot');
                         }else{
                            redirect(base_url().'admin','refresh');
                         }
                    }catch (Exception $e){
                        echo 'Caught exception: ',  $e->getMessage(), "\n";
                    }
      }	
	function change_job_status(){
         if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
            $id=$this->uri->segment(2); 
            $st=$this->uri->segment(3);
            $code= base64_decode(str_pad(strtr($id, '-_', '+/'), strlen($id) % 4, '=', STR_PAD_RIGHT));
            $data['title']='Admin Dashboard for Monday Morning';
            $where="job_id=$code";
            $job_detail=$this->Crud_modal->fetch_single_data("*","mm_master_job","job_id=$code");
            $title=$job_detail['job_title'];
            $created_date=$job_detail['created_date'];
            $modified_date=$job_detail['modified_date'];
            $eid=$job_detail['company_id'];
            $emp=$this->Crud_modal->get_employer($job_detail['company_id']);
            $name=$emp['employer_contact_person_name'];
            $email=$emp['employer_email'];
            $udata = array('status'=>$st); 
            $res="";
            if($st=='2' || $st=='3'){
                $res=$this->input->post('reason');
                $udata["remarks"]=$this->input->post('reason'); 
            }
            if($st=='1'){
               //$udata["publish_date"]=date("Y-m-d H:i:s");
               $udata=array('status'=>$st, 'publish_date'=>date("Y-m-d H:i:s"));
           }
            //print_r($udata); die;
            if($this->Crud_modal->update_data($where,'mm_master_job',$udata)){
                if($st==2){
                    $this->session->set_flashdata('data_message','<div class="success"><strong> Successfully Rejected/Disapproved.</strong></div>');
                    $_mail1=$this->Mailer_model->employer_job_status_mail("MondayMorning - Job is Rejected",$eid,$email,$name,$code,$title,$created_date,$modified_date,"Rejected/Disapproved",$res);
                }elseif($st==1){
                    $this->session->set_flashdata('data_message','<div class="success"><strong> Successfully Approved/Published.</strong></div>');
                    $_mail2=$this->Mailer_model->employer_job_status_mail("MondayMorning - Job is Approved",$eid,$email,$name,$code,$title,$created_date,$modified_date,"Approved/Published"," ");
                }elseif($st==3){
                    $this->session->set_flashdata('data_message','<div class="success"><strong> Successfully Unpublished.</strong></div>');
                    $_mail3=$this->Mailer_model->employer_job_status_mail("MondayMorning - Job is Unpublished",$eid,$email,$name,$code,$title,$created_date,$modified_date,"Unpublished",$res);
                }
                redirect(base_url().'employer-job-lists');         
            }else{
                $this->session->set_flashdata('data_message','<div class="danger"><strong>Some Error Occurred.</strong></div>');
                redirect(base_url().'employer-job-lists');
            }
                    
         }
   
   }
 public function more_info_job(){
		$jid=$this->input->post('job_id');
		$data=array();
		$job_detail=$this->Crud_modal->fetch_single_data("*","mm_master_job","job_id=$jid");

		$data['job_title']=$job_detail['job_title'];
		$data['job_description']=$job_detail['job_description'];
		$data['no_of_position']=$job_detail['no_of_position'];
		if($job_detail['ctc_from']!=0){
			$data['ctc'] = $job_detail['ctc_from']."-".$job_detail['ctc_to']." Lac/Year";
		}else{
			$data['ctc'] =  "N/A"; 
		}
		$job_fun_detail=$this->Crud_modal->fetch_single_data("*","mm_master_industry_functional","functional_id=$job_detail[functional_id]");
		
		$data['functional_name']=$job_fun_detail['functional_name'];
		$ex=$job_detail['experience']; 
        if(strpos($ex,'+') != false) {
            $exp=explode("+",$ex);
            $data['experience'] = $exp[0]."+ Years";
        }else{
            $data['experience'] = $ex." Years";
        }
        $str = $job_detail['job_location_id']; 
        $loc_id=array(); $loc_id=explode(",",$str); $IDS = array();
       	foreach ($loc_id as $key => $value) {
            $IDS[$key]=$value;
        }
        $LOC_STR=""; $showCity="";                         
        $locations=array();
        for($i=0;$i<count($loc_id);$i++){
	        $lid=$IDS[$i]; //echo $lid."<br>";
	        $getCity=$this->Employer_model->get_city_by_job_location_id($lid);
	        $locations[$i]=$getCity['name'];
	        //echo $getCity['name'];
	        $LOC_STR=$LOC_STR.$getCity['name'];
	        if($i!=count($loc_id)-1){
	        	$LOC_STR= $LOC_STR.", ";
	        }
	        $showCity=$LOC_STR;
        }
		$data['city']=$showCity;
		$data['required_system_neurons']=$job_detail['required_system_neurons'];
		$st = $job_detail['status']; 
			if($st==0){
				$data['status']='Pending';                 				
			}elseif($st==1){
				$data['status']='Published';	                 		
			}elseif($st==2){
				$data['status']='Rejected';               			
			}elseif($st==3){
				$data['status']='Unpublished';	                 		
			}
		
		$data['created_date']=date("d/m/Y g:i A", strtotime($job_detail['created_date']));
		if($job_detail['publish_date']!="0000-00-00 00:00:00"){$pdt= date("d/m/Y g:i A", strtotime($job_detail['publish_date']));}else{$pdt= "Not Available";};
		$data['publish_date']=$pdt;
		$data['modified_date']=date("d/m/Y g:i A", strtotime($job_detail['modified_date'])); 
		
		/*if package is mapped*/
		$data['check_pack_id']=$job_detail['package_id'];
		$data['check_skill_ids'] = $job_detail['package_skills_id'];
		$pids = $job_detail['package_id'];
		if($pids!=""){
		$skills_arr=array();   $pack_names=array();  $pack_total=array(); $pack_min_neurons=array(); $skills_per=array();
        $pack_assi_id=array(); $pack_id=array();   $skills_id=array();
        $per = $job_detail['skills_percentage']; $skills_per=explode(",",$per);

        $str = $job_detail['package_skills_id'];
        $sk_id=array(); $sk_id=explode(",",$str); $IDS = array();
        foreach ($sk_id as $key => $value) {
             $IDS[$key]=$value;
        }
        for($i=0;$i<count($sk_id);$i++){
            $sid=$IDS[$i]; 
            $skills_id[$i]=$sid;
            $getSk=$this->Employer_model->get_skill_by_skill_id($sid);
            $skills_arr[$i]=$getSk['skills_name'];
        }
		
                  $p_id=array(); $p_id=explode(",",$pids); $PIDS = array();
                  foreach ($p_id as $key => $value) {
                        $PIDS[$key]=$value;
                  }
                                             
                  for($i=0;$i<count($p_id);$i++){
                        $pid=$PIDS[$i]; 
                        $where="package_id=$pid";
                        $getP=$this->Crud_modal->fetch_single_data('*','mm_packages',$where);
                        $pack_names[$i]=$getP['package_name'];
                        $pack_total[$i]=$getP['total_marks'];
                        $pack_assi_id[$i]=$getP['ma_id']; 
                        $pack_id[$i]=$getP['package_id'];                      
                  }
        $data['sids'] =$skills_ids=$skills_id;
        $data['snames']=$skills_arr;
        $data['sper']=$pernew=$skills_per;
     //   $pid=$job_detail['status'];
        $min_neurons=explode(",",$job_detail['pack_min_neurons']);
        
	        $data['pack_data']=$this->Crud_modal->all_data_select("package_name,package_id,ma_id,total_marks","mm_packages","package_id in($pids)","package_id");
	        for($i=0;$i<sizeof($data['pack_data']);$i++){
	            for($j=0;$j<sizeof($skills_ids);$j++){
	                    $psk=$data['pack_data'][$i]['ma_id'];
	                    $sum_skills=$this->Crud_modal->fetch_single_data('sum(`time_limit`)/100*d_level as sum,skills','master_level',"maid in($psk) and skills='$skills_ids[$j]'");
	                    $data['pack_data'][$i]['skills_ids'][$j]= (round($sum_skills['sum'])*$pernew[$j])/100  .'/'.round($sum_skills['sum']);                                   
	            }        
	            $data['pack_data'][$i]['min_neurons']=$min_neurons[$i];           
	        }
	        //print_r($data); die;
    	}
		echo json_encode($data);
	} 


public function get_industry_functional(){
        $topicid=$this->input->post('topicid');
        $data =$this->Crud_modal->all_data_select('*','mm_master_industry_functional',"industry_id='$topicid'",'functional_id desc');
        echo '<option value="">Select Functional</option>';
        for($i=0;$i<sizeof($data);$i++){
            echo '<option value="'.$data[$i]["functional_id"].'">'.$data[$i]["functional_name"].'</option>';                                                    
        }
    }

public function ticket_delete(){
         try{
             if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
                 $ticketid = $this->uri->segment(2);
                 $columnname = 'ticket_id';
                 $statuscolumn = 'delete_status';
                 $tablename = 'mm_ticket';
                 $status = '0';

                 $data = $this->Admindashboard_modal->ticket_delete($columnname,$ticketid,$statuscolumn,$status,$tablename);
                 if($data){
                redirect(base_url().'ticket-view');
                 }
             }
         }catch(Exception $e){
             echo 'Caught exception: ',  $e->getMessage(), "\n";
         }
     }

public function ticket_recover(){
         try{
             if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
                 $ticketid = $this->uri->segment(2);
                 $columnname = 'ticket_id';
                 $statuscolumn = 'delete_status';
                 $tablename = 'mm_ticket';
                 $status = '1';

                 $data = $this->Admindashboard_modal->ticket_delete($columnname,$ticketid,$statuscolumn,$status,$tablename);
                 if($data){
                redirect(base_url().'ticket-trash');
                 }
             }
         }catch(Exception $e){
             echo 'Caught exception: ',  $e->getMessage(), "\n";
         }
     }
public function ticket_delete_permanantly(){
         try{
             if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
                 $column_value = $this->uri->segment(2);
                 $column_name = 'ticket_id';
                 $tablename = 'mm_ticket';
                 $data = $this->Admindashboard_modal->delete_row_using_id($tablename,$column_name,$column_value);
                 if($data){
                redirect(base_url().'ticket-trash');
                 }
             }
         }catch(Exception $e){
             echo 'Caught exception: ',  $e->getMessage(), "\n";
         }
     }
public function by_post(){
             if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
				$data['title']='Admin Dashboard for Monday Morning';
				$data['cirt'] = $this->Crud_modal->all_data_select("*","mm_post_certi","mm_post_certi_id !=''","mm_post_certi_id desc");
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);    
				$this->load->view('admintempletes/sidebar',$data);
				$this->load->view("by_post");
				$this->load->view('admintempletes/footer');
             }
     }
     
       ##########  interactive upload start from here ######################
         public function create_interactive_case(){
	 	try{
 			if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
 				$data['title']='Admin Dashboard for Monday Morning';
 				    //echo "hai"; die;

					$where = 'status =1';
				$data['master_topics'] = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$where,'t_id desc');
				$data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$where,'type_id desc');
				$data['tool_types'] = $this->Crud_modal->all_data_select('id,name','master_level_type',$where,'id desc');
				$data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name',' master_skills_test',$where,'order_id ASC');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('interactice-case-study',$data);
					$this->load->view('admintempletes/footer');	      
		    }else{
		    	redirect(base_url().'admin','refresh');
		    }

		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	 }
 public function interactive_case(){
	 	try{
 			if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
 				$data['title']='Admin Dashboard for Monday Morning';
				    $where = "status = 1";
					$data['questions_data'] = $this->Crud_modal->all_data_select('*','mm_interactive_case_study',$where,'ques_id desc');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('interactice-case-study-list',$data);
					$this->load->view('admintempletes/footer');	 

				
		    }else{
		    	redirect(base_url().'admin','refresh');
		    }

		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	 }
public function insert_interactive_case_study(){
		try{
			if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
				//adminid
				$insertdata['question_context'] = $this->input->post('question_context');
				$insertdata['topic'] = $this->input->post('master_topic');
				$insertdata['question'] = $this->input->post('ans');
				$insertdata['tool_type'] = $this->input->post('mastr_type');
				$insertdata['type'] = $this->input->post('master_type');
				$insertdata['skill_tested'] = $this->input->post('master_skills_test');
				$insertdata['created_date'] = date('Y-m-d H:i:s');
				$insertdata['created_by'] = $this->session->userdata('adminid');
				$this->Crud_modal->data_insert('mm_interactive_case_study',$insertdata);
				$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Inserted.</div>');
				redirect(base_url().'create-interactive-case');

			}else{
				redirect(base_url().'admin','refresh');
		    }
		}catch(Exception $e){
			echo 'Caught exception', $e->getMessage(),"\n";
		}
	}
	public function interactive_case_option_list(){
	 	try{
 			if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
 				$data['title']='Admin Dashboard for Monday Morning';
				    $where = "status = 1";
					$data['interactive_case'] = $this->Crud_modal->all_data_select('*','mm_interactive_case_option',$where,'option_id desc');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('interactive-case-option-list',$data);
					$this->load->view('admintempletes/footer');	 

				
		    }else{
		    	redirect(base_url().'admin','refresh');
		    }

		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	 }
	 public function create_interactive_case_option(){
	 	try{
 			if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
 				$data['title']='Admin Dashboard for Monday Morning';
 				   // echo "hai"; die;
 
				$where = 'status =1';
				$data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$where,'diffi_id desc');
				$data['interactive_question'] = $this->Crud_modal->all_data_select('ques_id,question','mm_interactive_case_study',$where,'ques_id ASC');
				$data['interactive_case_map'] = $this->Crud_modal->all_data_select('case_interactive_id,case_question','mm_case_map',$where,'case_interactive_id ASC');
				//print_r($data['interactive_question']); die;
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('create-interactive-case-option',$data);
					$this->load->view('admintempletes/footer');	      
		    }else{
		    	redirect(base_url().'admin','refresh');
		    }

		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	 }
	 public function case_map_list(){
	 	try{
 			if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
 				$data['title']='Admin Dashboard for Monday Morning';
				    $where = "status = 1";
					$data['case_map_data'] = $this->Crud_modal->all_data_select('*','mm_case_map',$where,'case_interactive_id desc');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('case-map-list',$data);
					$this->load->view('admintempletes/footer');	 

				
		    }else{
		    	redirect(base_url().'admin','refresh');
		    }

		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	 }
	 public function create_case_map(){
	 	try{
 			if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
 				$data['title']='Admin Dashboard for Monday Morning';
 				  // echo "hai"; die;
 
					$where = 'status =1';
				$data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name',' master_skills_test',$where,'order_id ASC');
				$data['interactive_question'] = $this->Crud_modal->all_data_select('ques_id,question','mm_interactive_case_study',$where,'ques_id ASC');
				//master_level
				$data['level'] = $this->Crud_modal->all_data_select('ml_id,lvl_name','master_level','ml_status=1','ml_id ASC');
				
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('create-case-map',$data);
					$this->load->view('admintempletes/footer');	      
		    }else{
		    	redirect(base_url().'admin','refresh');
		    }

		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	 }
	 public function create_case_map_insert(){
	 	try{
 			if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
 				$data['title']='Admin Dashboard for Monday Morning';
 				   $skll_map = implode(',', $this->input->post('Skill_map')); 
 				  // echo "hai"; die;
                   // print_r($_POST); die;
					$insertdata['case_question'] = $this->input->post('case_question');
				    $insertdata['skills_map'] = $skll_map;
				    $insertdata['best_path_count'] = $this->input->post('best_path_count');
				    $insertdata['skills_value'] = $this->input->post('skill_value');
				    $insertdata['map_ques_id'] = $this->input->post('question');
				    $insertdata['level_id'] = $this->input->post('level');
				    $insertdata['case_name'] = $this->input->post('case_name');
				    $insertdata['cas_marks'] = $this->input->post('case_marks');
				    $insertdata['quest_limit'] = $this->input->post('question_limit');
				    $insertdata['created_date'] = date('Y-m-d H:i:s');
				    $insertdata['created_by'] = $this->session->userdata('adminid');
				$this->Crud_modal->data_insert('mm_case_map',$insertdata);
				$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Inserted.</div>');
				redirect(base_url().'create-case-map');
		    }else{
		    	redirect(base_url().'admin','refresh');
		    }

		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	 }
	 public function insert_interactive_case_option_list(){
	 	try{
 			if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
 				$data['title']='Admin Dashboard for Monday Morning';
 				  // echo "hai"; die;
                    //print_r($_POST); die;Edit 
					$insertdata['options'] = $this->input->post('option');
				    $insertdata['case_map_id'] = $this->input->post('case_map');
				    $insertdata['current_quest_id'] = $this->input->post('curr_ques');
				    $insertdata['next_quest_id'] = $this->input->post('next_ques');
				    $insertdata['diff_level'] = $this->input->post('difficulty');
				    $insertdata['skills_id'] = $this->input->post('skills');
				    $insertdata['skills_marks'] = $this->input->post('skills_marks');
				    $insertdata['hint_id'] = $this->input->post('hint');
				    $insertdata['created_date'] = date('Y-m-d H:i:s');
				    $insertdata['created_by'] = $this->session->userdata('adminid');
				    $this->Crud_modal->data_insert('mm_interactive_case_option',$insertdata);

				$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Inserted.</div>');
				redirect(base_url().'create-interactive-case-option');
		    }else{
		    	redirect(base_url().'admin','refresh');
		    }

		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	 }
	 public function get_case_map_skill(){
	 	try{
 			if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
 				$data['title']='Admin Dashboard for Monday Morning';
 				  $case_m_id = $this->input->post('case_map_id');
 				  $data = $this->Crud_modal->fetch_single_data('skills_map','mm_case_map',"case_interactive_id='$case_m_id'");
 				  echo $data['skills_map'];
				
		    }else{
		    	redirect(base_url().'admin','refresh');
		    }

		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	 }
	 public function edit_interactive_case_study()
 	{
	  	try
			{
				   if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null )
		     {
		     		$v = $this->uri->segment(2);
		     		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
		     		
				    $data['title']='Admin Dashboard for Monday Morning';
					$where1 = "ques_id = '$val'";
					$where = 'status =1';
				    $data['master_topics'] = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$where,'t_id desc');
				    $data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$where,'type_id desc');
				    $data['tool_types'] = $this->Crud_modal->all_data_select('id,name','master_level_type',$where,'id desc');
				    $data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name',' master_skills_test',$where,'order_id ASC');
				    $data['interactive_case'] = $this->Crud_modal->all_data_select('*',' mm_interactive_case_study',$where1,'ques_id ASC'); 
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('edit-interactive-case-study',$data);
					$this->load->view('admintempletes/footer');
				 }
				  else
				 {
					
				    redirect(base_url().'admin','refresh');
			     }
			}
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
	 }
	 public function edit_interactive_case_study_save(){
		try{
			if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
				$id = $this->input->post('ques_id');
				$updatedata['question_context'] = $this->input->post('question_context');
				$updatedata['question'] = $this->input->post('ans');
				$updatedata['tool_type'] = $this->input->post('mastr_type');
				$updatedata['topic'] = $this->input->post('master_topic');
				$updatedata['type'] = $this->input->post('master_type');
				$updatedata['skill_tested'] = $this->input->post('master_skills_test');
				$updatedata['modified_date'] = date('Y-m-d H:i:s');
				$updatedata['modified_by'] = $this->session->userdata('adminid');
				$where="ques_id='$id'";

				$sid=rtrim(strtr(base64_encode($id), '+/', '-_'), '=');

				$this->Crud_modal->update_data($where,'mm_interactive_case_study',$updatedata);
				$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Update.</div>');
				redirect(base_url().'edit-interactive-case-study/'.$sid);

			}else{
				redirect(base_url().'admin','refresh');
		    }
		}catch(Exception $e){
			echo 'Caught exception', $e->getMessage(),"\n";
		}
	}
	public function edit_case_map()
 	{
	  	try
			{
				   if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null )
		     {
		     	    //echo 'hai';
		     	    //die;
		     	    $v = $this->uri->segment(2);
		     		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
		     		$where = 'status =1';
				$data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name',' master_skills_test',$where,'order_id ASC');
				$data['interactive_question'] = $this->Crud_modal->all_data_select('ques_id,question','mm_interactive_case_study',$where,'ques_id ASC');
				$data['level'] = $this->Crud_modal->all_data_select('ml_id,lvl_name','master_level','ml_status=1','ml_id ASC');
				$data['case_map_data'] = $this->Crud_modal->all_data_select('*','mm_case_map',"case_interactive_id='$val'",'case_interactive_id ASC');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('edit-case-map',$data);
					$this->load->view('admintempletes/footer');
				 }
				  else
				 {
					
				    redirect(base_url().'admin','refresh');
			     }
			}
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
	 }
	 public function edit_case_map_save(){
		try{
			if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
				//print_r($_POST);
				$skll_map = implode(',', $this->input->post('Skill_map')); 
				$id = $this->input->post('creative_id');
				$updatedata['case_question'] = $this->input->post('case_question');
				$updatedata['skills_map'] = $skll_map;
				$updatedata['best_path_count'] = $this->input->post('best_path_count');
				$updatedata['skills_value'] = $this->input->post('skill_value');
				$updatedata['map_ques_id'] = $this->input->post('question');
				$updatedata['level_id'] = $this->input->post('level');
				$updatedata['case_name'] = $this->input->post('case_name');
				$updatedata['cas_marks'] = $this->input->post('case_marks');
				$updatedata['quest_limit'] = $this->input->post('question_limit');
				$updatedata['modified_date'] = date('Y-m-d H:i:s');
				$updatedata['modified_by'] = $this->session->userdata('adminid');
				$where="case_interactive_id='$id'";

				$sid=rtrim(strtr(base64_encode($id), '+/', '-_'), '=');

				$this->Crud_modal->update_data($where,'mm_case_map',$updatedata);
				$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Update.</div>');
				redirect(base_url().'edit-case-map/'.$sid);

			}else{
				redirect(base_url().'admin','refresh');
		    }
		}catch(Exception $e){
			echo 'Caught exception', $e->getMessage(),"\n";
		}
	}
	public function edit_interactive_case_option()
 	{
	  	try
			{
				   if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null )
		     {
		     	    //echo 'hai';
		     	    //die;
		     	   $v = $this->uri->segment(2);
		     	   $val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
		     	   $where = 'status =1';
				   $data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$where,'diffi_id desc');
				$data['interactive_question'] = $this->Crud_modal->all_data_select('ques_id,question','mm_interactive_case_study',$where,'ques_id ASC');
				$data['interactive_case_map'] = $this->Crud_modal->all_data_select('case_interactive_id,case_question','mm_case_map',$where,'case_interactive_id ASC');
				$data['interactive_case_map_edit'] = $this->Crud_modal->all_data_select('*','mm_interactive_case_option',"option_id='$val'",'option_id ASC');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('edit-interactive-case-option',$data);
					$this->load->view('admintempletes/footer');	      
				 }
				  else
				 {
					
				    redirect(base_url().'admin','refresh');
			     }
			}
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
	 }
	 public function edit_interactive_case_option_save(){
		try{
			if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
				$id = $this->input->post('option_id');
				$updatedata['options'] = $this->input->post('option');
				$updatedata['current_quest_id'] = $this->input->post('curr_ques');
				$updatedata['next_quest_id'] = $this->input->post('next_ques');
				$updatedata['diff_level'] = $this->input->post('difficulty');
				$updatedata['skills_id'] = $this->input->post('skills');
				$updatedata['skills_marks'] = $this->input->post('skills_marks');
				$updatedata['hint_id'] = $this->input->post('hint');
				$updatedata['modified_date'] = date('Y-m-d H:i:s');
				$where="option_id='$id'";

				$sid=rtrim(strtr(base64_encode($id), '+/', '-_'), '=');

				$this->Crud_modal->update_data($where,'mm_interactive_case_option',$updatedata);
				$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Update.</div>');
				redirect(base_url().'edit-interactive-case-option/'.$sid);

			}else{
				redirect(base_url().'admin','refresh');
		    }
		}catch(Exception $e){
			echo 'Caught exception', $e->getMessage(),"\n";
		}
	}
  
  #########   interactive upload end here       ###################### 
 
}