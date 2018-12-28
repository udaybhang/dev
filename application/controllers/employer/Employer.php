<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employer extends CI_Controller {	
	public function __construct(){
			error_reporting(0);
			parent::__construct();
			$this->load->model('crud/Crud_modal');		
            $this->load->model('Employer_model');
            
		}
	 
    public function employer_my_jobs1_page()
    {
        echo "hi";
                 $this->load->view('employertempletes/head');
                 $this->load->view('employertempletes/header');
                $this->load->view('emp-my-jobs1');
                 $this->load->view('employertempletes/footer');
                 $this->load->view('employertempletes/sidebar');
    }
    public function   employer_my_jobs1()  {
        $data['value']=$this->input->post('job_status');
         $uid=$this->session->userdata('employer_id');
          $status = $this->input->post('job_status');
         $where="`employer_id`='$uid'";
         $empdat=$this->Crud_modal->fetch_single_data('employer_industry_id','mm_employer',$where);

          $inid = $empdat['employer_industry_id']; 
           $where="industry_id=$inid"; 
            $data["functional_area"]=$this->Crud_modal->all_data_select('*','mm_master_industry_functional',$where,'functional_id asc'); 
         if($this->input->post('job_status')!=''){
            // $status = $this->input->post('job_status');
                      
                       if($status=='All'){
                          $message = 'Job Posted';
                          $data["filter_status"]='All';
                         $jobs1= $this->Employer_model->get_jobs($uid); 
                        }
                     else
                     {
                        $data["filter_status"]=$this->input->post('job_status');
                                             if($data["filter_status"]==0){
                                                 $message = 'Pending Jobs';                          
                                             }elseif($data["message"]==1){
                                                 $message = 'Published Jobs';   
                                             }elseif($data["filter_status"]==2){
                                                 $message = 'Rejected Jobs';                     
                                             }elseif($data["filter_status"]==3){
                                                 $message = 'Unpublished Jobs';                      
                                             }
                                              $jobs1= $this->Employer_model->get_jobs1($uid,$status); 
}
                 }
                      else{
                        $status='1';
                      $filter_status='1';
                     $message = 'Published Jobs';
                     $jobs1= $this->Employer_model->get_jobs1($uid,$status);
                   
                } 
                    $pqr=implode(',',$id['idv']);
                // $tp=$this->Employer_model->get_total_applied($id); 
                echo json_encode(['message'=>$message, 'job1'=>$jobs1, 'ids'=>$pqr]) ;
       }
function employer_my_jobs()
{
    $data['value']=$this->input->post('job_status');

        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
                $uid=$this->session->userdata('employer_id');
                $where="`employer_id`='$uid'";
                $empdat=$this->Crud_modal->fetch_single_data('employer_industry_id','mm_employer',$where);
                $inid = $empdat['employer_industry_id']; 
                $where="industry_id=$inid"; 
                $data["functional_area"]=$this->Crud_modal->all_data_select('*','mm_master_industry_functional',$where,'functional_id asc');        
                $functional_id=$this->input->post("selected_functional_id"); 
                $data["functional_id"]=$this->input->post("selected_functional_id"); 
              
                if($this->input->post('job_status')!=''){
                    
                      $status = $this->input->post('job_status');
                     if($status=='All'){
                          $data['message'] = 'Job Posted';
                          $data["filter_status"]='All';
                         $data["jobs1"]= $this->Employer_model->get_jobs($uid); 
                     }
                     else
                     {
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
                        echo $this->db->last_query();
                        //print_r($data["jobs1"]);
                     }
                    
                }else{
                    $status='1';
                    $data["filter_status"]='1';
                    $data['message'] = 'Published Jobs';
                    $data["jobs1"]= $this->Employer_model->get_jobs1($uid,$status);// print_r($data["jobs"]); die;
                } 
              
                 $i=0;
                 
                 foreach ($data["jobs1"] as $job_data) {
                       $jobid = $job_data['job_id'];
                       $pack = $this->Crud_modal->fetch_single_data('package_id','mm_master_job',"job_id='$jobid'");
                           $applied_data = $this->Employer_model->get_total_applied($jobid);
                       if($pack['package_id']!=''){
                            $dis_uid =$this->Crud_modal->all_data_select("distinct(uid) as uid","mm_user_applied_job","job_id='$jobid'","");
                            $get_assgnment_id =$this->Crud_modal->all_data_select("ma_id","mm_packages","package_id in ($pack[package_id])","package_id");
                            $count_app=0;
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
                                }
                                
                            }
                            $data["jobs1"][$i]['applied']=$count_app;
                            $data["jobs1"][$i]['not_applied']=$applied_data['total_applied']-$count_app;
                            }else{
                            $data["jobs1"][$i]['aplpied']=$applied_data['total_applied'];
                            $data["jobs1"][$i]['not_applied']=0;
                            
                       }
                       $i++;
                      
                       

                  } 
               
                $this->load->view('employertempletes/head');
                $this->load->view('employertempletes/header');
                $this->load->view('emp-my-jobs', $data);
                $this->load->view('employertempletes/footer');
                 $this->load->view('employertempletes/sidebar');
         }
         else{
            redirect(base_url().'employer');
        }
   }  
 

}

