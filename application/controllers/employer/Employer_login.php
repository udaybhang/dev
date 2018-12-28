<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Employer_login extends MX_Controller {  
    public function __construct(){
        error_reporting(0);
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
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
    }
    public function employer_login(){
          $this->load->view('employertemplate/head');
          $this->load->view('employertemplate/header');
          $this->load->view('employer-login-new');
          $this->load->view('employertemplate/footer');

  }
   public function signup(){
        $data["industry_value"]=$this->Crud_modal->fetch_alls('mm_master_industry_topic','industry_name asc');
        $data["value"]=$this->Crud_modal->fetch_alls('states', 'name asc');
        $data['meta_title']='mondaymorning employer';
        $data['meta_keywords']='assessment, curated CVs, resume, CV, profile, hiring, recruitment, training, placement, business, consulting, finance, jobs'; 
        $data['meta_description']='Ensure that you always find the right candidate for the job! The MondayMorning platform trains, assesses and identifies the perfect candidates for you.';                    
        $data['title']='Employer Zone - MondayMorning';                 
        $this->load->view('employertemplate/head',$data);
        $this->load->view('employertemplate/header');
        $this->load->view('employer-signup',$data);
        $this->load->view('employertemplate/footer');

        if(isset($msg)){
            $this->uri->segment(4); 
        }
    }

   function insert_emp(){  
            $email=trim($this->input->post('user_email'));
            $password=trim($this->input->post('user_password'));
            $company=trim($this->input->post('cname'));  
            $industry=trim($this->input->post('industry'));
            $mobile = trim($this->input->post('mobile'));  
            if($email=="" || $password=="" ||  $industry=="" ||  $mobile==""){
                  $this->session->set_flashdata('reg-sucess', 'Please Fill Required* Fields.');
                  redirect(base_url().'employer-signup','refresh'); 
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
                        'employer_mobile'  => $this->input->post('mobile'),  
                        'employer_phone'   => $phone, 
                        'employer_status'  => "0",  
                        'employer_auth_key'   => $auth_key,
                        'employer_reg_date'     => date("Y-m-d H:i:sa"),  
                        'eamil_auth_status'  => "0" ,
                    ); 
                    //insert data into database table.  
                    $q_res=$this->Crud_modal->data_insert('mm_employer',$data);
                    if($q_res){
                        $this->session->set_flashdata('reg-sucess', 'Successfully Registered! Please Verify Your Email Id.');
                        
                        $created_mail=$this->Mailer_model->employer_mail("Employer Email Verification Mail",$auth_key,$email,$password,$name);
                        redirect(base_url().'employer-signup','refresh'); 
                    }else{
                        $this->session->set_flashdata('reg-sucess', 'Error');
                        redirect(base_url().'employer-signup','refresh');
                    }
                }else{
                  //echo "Email Already Exists";
                  $this->session->set_flashdata('reg-sucess', 'Email Already Exists');
                  redirect(base_url().'employer-signup','refresh'); 
                }
            }
          
            
        }

}

