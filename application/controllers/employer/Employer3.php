<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Employer3 extends MX_Controller {  
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
    }
    public function todays_applied_count(){
     if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $emp_id=$this->session->userdata('employer_id');
        $job_id = $this->Crud_modal->fetch_single_data('group_concat(job_id) as job_id','mm_master_job',"company_id='$emp_id'");
        $j=$job_id['job_id'];
        $date=date("Y-m-d");
        $date="DATE_FORMAT(created_data,'%Y-%m-%d') = DATE_FORMAT(created_data,'$date')";
        echo $total_view_jobs=$this->Crud_modal->check_numrow('mm_user_applied_job',"job_id in($j) and ".$date);
     }else{
        redirect(base_url().'employer','refresh');
     }
    }
    public function weekly_applied_count(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
         $emp_id=$this->session->userdata('employer_id');
         $curr_dt=date('Y-m-d');
         $timestamp = time()-86400;
         $date = strtotime("-7 day", $timestamp);
         $last_date = date('Y-m-d', $date);
         $job_id = $this->Crud_modal->fetch_single_data('group_concat(job_id) as job_id','mm_master_job',"company_id='$emp_id'");
         $j=$job_id['job_id'];
         $where="DATE_FORMAT(created_data,'%Y-%m-%d') <= DATE_FORMAT(created_data,'$curr_dt') AND DATE_FORMAT(created_data,'%Y-%m-%d') >= DATE_FORMAT(created_data,'$last_date')";
         echo $total_view_jobs=$this->Crud_modal->check_numrow('mm_user_applied_job',"job_id in($j) and ".$where);
        }else{
           redirect(base_url().'employer','refresh');
        }
    }   
    public function monthly_applied_count(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
         $emp_id=$this->session->userdata('employer_id');
         $curr_dt=date('Y-m-d');
         $timestamp = time()-86400;
         $date = strtotime("-31 day", $timestamp);
         $last_date = date('Y-m-d', $date);
         $job_id = $this->Crud_modal->fetch_single_data('group_concat(job_id) as job_id','mm_master_job',"company_id='$emp_id'");
         $j=$job_id['job_id'];
         if($j!=""){
              $where="DATE_FORMAT(created_data,'%Y-%m-%d') <= DATE_FORMAT(created_data,'$curr_dt') AND DATE_FORMAT(created_data,'%Y-%m-%d') >= DATE_FORMAT(created_data,'$last_date')";
            echo $total_view_jobs=$this->Crud_modal->check_numrow('mm_user_applied_job',"job_id in($j) and ".$where);
         }else{
             echo 0;
         }
        
        }else{
           redirect(base_url().'employer','refresh');
        }
    }   
    public function total_job_applied_count(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
         $emp_id=$this->session->userdata('employer_id');
         $job_id = $this->Crud_modal->fetch_single_data('group_concat(job_id) as job_id','mm_master_job',"company_id='$emp_id'");
         $j=$job_id['job_id'];
         if($j!=""){
              echo $total_view_jobs=$this->Crud_modal->check_numrow('mm_user_applied_job',"job_id in($j)");
         }else{
             echo 0;
         }
        
        }else{
           redirect(base_url().'employer','refresh');
        }
    }   
    public function total_job_not_applied_count(){
      if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $eid=$this->session->userdata('employer_id');  $count=0;
        $data['jobs'] = $uu = $this->Crud_modal->fetchdata_with_limit("job_id,package_id","mm_master_job","company_id=$eid","job_id desc",'');
        for($i=0;$i<sizeof($uu);$i++){
            $id=$uu[$i]['job_id'];
            $pack_id=$uu[$i]['package_id'];
            $count_val=0;
            if($pack_id!=''){
                $select="u_id";
                $table_name="score";
                $where="package_id in($pack_id) and u_id not in (select uid from mm_user_applied_job where job_id='$id') and u_id in (select mm_uid from user where user_type_id='2')";
                $group="u_id";
                $having="count(u_id) = (SELECT count(ml_id) FROM `master_level` WHERE `pack_id`  in($pack_id) and `ml_status` = '1')";
                $order="score_id";
                $limit ="";                      
                $package_neurons=$this->Crud_modal->fetchdata_with_limit_and_having($select,$table_name,$where,$group,$having,$order,$limit);
                $count_val=sizeof($package_neurons);
            }
            if($count_val>0){
               $count=$count+$count_val;
            }else{
              // $count=0;
            } 
            
        }
        echo $count;
      }else{                    
        redirect(base_url().'employer','refresh');
      }
   }
   public function shortlisted_count(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
         $emp_id=$this->session->userdata('employer_id');
         $job_id = $this->Crud_modal->fetch_single_data('group_concat(job_id) as job_id','mm_master_job',"company_id='$emp_id'");
         $j=$job_id['job_id'];
         if($j!=""){
              echo $total_s=$this->Crud_modal->check_numrow('mm_user_applied_job',"job_id in($j) and job_process_step='3-0'");
         }else{
             echo 0;
         }
        
        }else{
           redirect(base_url().'employer','refresh');
        }
    } 
    public function interview_count(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
         $emp_id=$this->session->userdata('employer_id');
         $job_id = $this->Crud_modal->fetch_single_data('group_concat(job_id) as job_id','mm_master_job',"company_id='$emp_id'");
         $j=$job_id['job_id'];
         if($j!=""){
              echo $total_s=$this->Crud_modal->check_numrow('mm_user_applied_job',"job_id in($j) and job_process_step='4-0'");
         }else{
             echo 0;
         }
        
        }else{
           redirect(base_url().'employer','refresh');
        }
    } 
    public function offered_count(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
         $emp_id=$this->session->userdata('employer_id');
         $job_id = $this->Crud_modal->fetch_single_data('group_concat(job_id) as job_id','mm_master_job',"company_id='$emp_id'");
         $j=$job_id['job_id'];
         if($j!=""){
             echo $total_s=$this->Crud_modal->check_numrow('mm_user_applied_job',"job_id in($j) and job_process_step='5-0'");
         }else{
             echo 0;
         }
         
        }else{
           redirect(base_url().'employer','refresh');
        }
    } 
    public function joined_count(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
         $emp_id=$this->session->userdata('employer_id');
         $job_id = $this->Crud_modal->fetch_single_data('group_concat(job_id) as job_id','mm_master_job',"company_id='$emp_id'");
         $j=$job_id['job_id'];
         if($j!=""){
            echo $total_s=$this->Crud_modal->check_numrow('mm_user_applied_job',"job_id in($j) and job_process_step='6-0'");
         }else{
             echo 0;
         }
        
        }else{
           redirect(base_url().'employer','refresh');
        }
    } 
    public function rejected_count(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
         $emp_id=$this->session->userdata('employer_id');
         $job_id = $this->Crud_modal->fetch_single_data('group_concat(job_id) as job_id','mm_master_job',"company_id='$emp_id'");
         $j=$job_id['job_id'];
         if($j!=""){
            $where="job_id in($j) and job_process_step='2-1' or job_id in($j) and job_process_step='3-1' or job_id in($j) and job_process_step='4-1' or job_id in($j) and job_process_step='5-1' or job_id in($j) and job_process_step='6-1'";
            echo $total_s=$this->Crud_modal->check_numrow('mm_user_applied_job',$where);
         }else{
            echo 0;
         }
        
        }else{
           redirect(base_url().'employer','refresh');
        }
    } 
     public function running_training(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
         $emp_id=$this->session->userdata('employer_id');
         $pid = $this->Crud_modal->fetch_single_data('group_concat(emp_pack_id) as p_id','mm_employer_package_map',"company_id='$emp_id'");
         $p=$pid['p_id'];
         if($p!=""){
            $curr_dt=date("Y-m-d");
            $where1="package_id in($p) ";
            $where2="DATE_FORMAT(start_date,'%Y-%m-%d') <= DATE_FORMAT(start_date,'$curr_dt') AND DATE_FORMAT(end_date,'%Y-%m-%d') >= DATE_FORMAT(end_date,'$curr_dt')";
            echo $total_s=$this->Crud_modal->check_numrow('mm_packages',$where1." and ".$where2);
         }else{
            echo "0";
         }
        
        }else{
           redirect(base_url().'employer','refresh');
        }
    } 
    public function forthcoming_training(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
            $emp_id=$this->session->userdata('employer_id');
            $pid = $this->Crud_modal->fetch_single_data('group_concat(emp_pack_id) as p_id','mm_employer_package_map',"company_id='$emp_id'");
            $p=$pid['p_id'];
            if($p!=""){
                 $curr_dt=date("Y-m-d");
                 $where1="package_id in($p) ";
                 $where2="DATE_FORMAT(start_date,'%Y-%m-%d') > DATE_FORMAT(start_date,'$curr_dt')";
                 echo $total_s=$this->Crud_modal->check_numrow('mm_packages',$where1." and ".$where2);
            }else{
                echo "0";
            }
        }else{
           redirect(base_url().'employer','refresh');
        }
    } 
    public function closed_training(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
         $emp_id=$this->session->userdata('employer_id');
         $pid = $this->Crud_modal->fetch_single_data('group_concat(emp_pack_id) as p_id','mm_employer_package_map',"company_id='$emp_id'");
         $p=$pid['p_id'];
         if($p!=""){
             $curr_dt=date("Y-m-d");
             $where1="package_id in($p) ";
             $where2="DATE_FORMAT(end_date,'%Y-%m-%d') < DATE_FORMAT(end_date,'$curr_dt')";
             echo $total_s=$this->Crud_modal->check_numrow('mm_packages',$where1." and ".$where2);
          }else{
             echo "0";
          }
        }else{
           redirect(base_url().'employer','refresh');
        }
    } 
    public function completed_training(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
         $emp_id=$this->session->userdata('employer_id');
         $pid = $this->Crud_modal->fetch_single_data('group_concat(emp_pack_id) as p_id','mm_employer_package_map',"company_id='$emp_id'");
         $p=$pid['p_id']; $count=0;
         if($p!=""){
             $get_assignment=$this->Crud_modal->all_data_select("ma_id","mm_packages","package_id in($p)","package_id");
             for($j=0;$j<sizeof($get_assignment);$j++){
                $maid=explode(',', $get_assignment[$j]['ma_id']);
                
                for($i=0;$i<sizeof($maid);$i++){
                    $pids = $this->Crud_modal->fetchdata_group_by('count(maid) as maid,uid','completed_level',"maid=".$maid[$i],"uid");
                    $total_s=$this->Crud_modal->check_numrow('master_level',"maid=".$maid[$i]);
                    if($total_s!=0){
                        if($total_s==$pids['maid']){
                            $count++;
                        }
                    }
                }
             }echo $count;
         }else{
            echo 0;
         }
        }else{
           redirect(base_url().'employer','refresh');
        }
    } 
     public function missed_training(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
         $emp_id=$this->session->userdata('employer_id');
         $pid = $this->Crud_modal->fetch_single_data('group_concat(emp_pack_id) as p_id','mm_employer_package_map',"company_id='$emp_id'");
         $p=$pid['p_id']; $count=0; $count_missed=0;
         if($p!=""){
             $get_assignment=$this->Crud_modal->all_data_select("ma_id","mm_packages","package_id in($p)","package_id");
             for($j=0;$j<sizeof($get_assignment);$j++){
                $maid=explode(',', $get_assignment[$j]['ma_id']);
                for($i=0;$i<sizeof($maid);$i++){
                    //SELECT COUNT(Id), Country FROM Customer GROUP BY Country
                    $pids = $this->Crud_modal->fetchdata_group_by('count(maid) as maid,uid','completed_level',"maid=".$maid[$i],"uid");
                    $total_s=$this->Crud_modal->check_numrow('master_level',"maid=".$maid[$i]);
                    if($total_s!=0){
                        if($total_s==$pids['maid']){
                            $count++;
                        }else{
                            $count_missed++;
                        }
                    }
                }
             }
             echo $count_missed;
         }else{
            echo 0;
         }
        }else{
           redirect(base_url().'employer','refresh');
        }
    }
//code for portlet
     public function get_recent_published_job_portlet(){
      if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $limit=$this->input->post("limit"); 
        $eid=$this->session->userdata('employer_id');
        $data['jobs'] = $uu = $this->Crud_modal->fetchdata_with_limit("job_id,job_title,package_id","mm_master_job","company_id=$eid and status=1","publish_date desc",$limit);
        for($i=0;$i<sizeof($uu);$i++){
            $id=$uu[$i]['job_id'];
            $jid=rtrim(strtr(base64_encode($id), '+/', '-_'), '=');//Package Id
            $data['jobs'][$i]['params']=$jid ;
            $tp=$this->Employer_model->get_total_applied($id);
            $data['jobs'][$i]['applied']=$tp['total_applied'];
            $data['jobs'][$i]['views']=$this->Crud_modal->check_numrow("mm_user_job_click","job_id=$id");
            $pack_id=$uu[$i]['package_id'];
            $count_val=0;
            if($pack_id!=''){
                $select="u_id";
                $table_name="score";
                $where="package_id in($pack_id) and u_id not in (select uid from mm_user_applied_job where job_id='$id') and u_id in (select mm_uid from user where user_type_id='2')";
                $group="u_id";
                $having="count(u_id) = (SELECT count(ml_id) FROM `master_level` WHERE `pack_id`  in($pack_id) and `ml_status` = '1')";
                $order="score_id";
                $limit ="";                      
                $package_neurons=$this->Crud_modal->fetchdata_with_limit_and_having($select,$table_name,$where,$group,$having,$order,$limit);
                $count_val=sizeof($package_neurons);
            }
            if($count_val>0){
               $data['jobs'][$i]['not_applied']=$count_val ;
            }else{
               $data['jobs'][$i]['not_applied']=0;
            } 
            
        }
        echo json_encode($data);
      }else{                    
            redirect(base_url().'employer','refresh');
      }
   }
   public function get_recent_applied_job_portlet(){
      if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $limit=$this->input->post("limit"); 
        $eid=$this->session->userdata('employer_id');
        $publish_jobs=$this->Crud_modal->fetch_single_data('Group_concat(job_id) as job_id','mm_master_job',"company_id=$eid and status=1",'job_id');
        $jids=$publish_jobs['job_id'];
        if($jids!=''){
            $data["jobs"]=$udata=$this->Crud_modal->fetchdata_with_limit('uid,name,job_id,skill_marks,created_data','mm_user_applied_job',"job_id in($jids) ",'applied_job_id desc',$limit);
            for($i=0;$i<sizeof($udata);$i++){
              $uid=$udata[$i]['uid']; $job=$udata[$i]['job_id'];
              $jid=rtrim(strtr(base64_encode($job), '+/', '-_'), '=');//Package Id
              $data['jobs'][$i]['params']=$jid ;
              $em=$this->Crud_modal->fetch_single_data("mm_user_email","user","mm_uid=".$uid);
              $data["jobs"][$i]['email']=$em['mm_user_email'];
              $jt=$this->Crud_modal->fetch_single_data("job_title","mm_master_job","job_id=".$job);
              $data["jobs"][$i]['job_title']=$jt['job_title'];
              $data["jobs"][$i]['cdate']=date("d M, Y",strtotime($udata[$i]['created_data']));
            }
        }else{
             $data["jobs"]="";
        }
        echo json_encode($data);
      }else{                    
            redirect(base_url().'employer','refresh');
      }
   }
    public function get_recent_employee_portlet(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
            $emp_id=$this->session->userdata('employer_id');
            $limit=$this->input->post("limit"); 
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
            $order="u.mm_uid desc";
            $data['employee']=$this->Crud_modal->fetch_data_by_four_table_join_with_limit($field,$table_name,$join1,$join2,$join3,$join4,$where,$limit,$order);
            echo json_encode($data);
        }
        else{
            redirect(base_url().'employer');
        }
    }
public function map_employee_training(){ 
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
              $emp_id=$this->session->userdata('employer_id'); 
			  $field="mmt.package_id,mmt.package_name";
			  $table_name="mm_packages as mmt";
		      $join1[0]="mm_employer_package_map as mmp";
			  $join1[1]="mmt.package_id=mmp.emp_pack_id";
			  $join1[2]="left";
			  $where="mmp.company_id='$emp_id' group by(mmt.package_id)";
			  $data['all_training']= $this->Crud_modal->fetch_data_by_one_table_join($field,$table_name,$join1,$where);
			  
			  $this->load->view('employertempletes/head'); 
              $this->load->view('employertempletes/header');
              $this->load->view('training-employee-map',$data); 
              $this->load->view('employertempletes/footer');
              $this->load->view('employertempletes/sidebar');
        }
        else{
            redirect(base_url().'employer');
        }
    }
	public function map_employee_training_data(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
                $emp_id=$this->session->userdata('employer_id'); 
				$pack=$this->input->post('ID'); 
			    $field="u.mm_uid,u.mm_user_full_name,u.mm_user_email,mmaj.emp_pack_id";
				$table_name="mm_employer_package_map as mmaj";
				$join1[0]="mm_user_department_details as ud";
				$join1[1]="mmaj.company_id=ud.company_id";
				$join1[2]="left";
				$join2[0]="user as u";
				$join2[1]="u.mm_uid=ud.user_id";
				$join2[2]="left";
                $where="ud.company_id=$emp_id and mmaj.emp_pack_id='$pack' group by(u.mm_uid) ";
			    $data['user_details']= $this->Crud_modal->fetch_data_by_two_table_join($field,$table_name,$join1,$join2,$where);
			    echo json_encode($data['user_details']);
			   
        }
        else{
            redirect(base_url().'employer');
        }
    }
	public function training_report(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
              $emp_id=$this->session->userdata('employer_id');
              $data['unit_det']=$this->Crud_modal->all_data_select("*","mm_company_unit","company_id='$emp_id' and status='1'", '');
			  //print_r($data['all_training']); die;
             //echo "hai";
			  $this->load->view('employertempletes/head'); 
              $this->load->view('employertempletes/header');
              $this->load->view('training-report',$data); 
              $this->load->view('employertempletes/footer');
              $this->load->view('employertempletes/sidebar');
        }
        else{
            redirect(base_url().'employer');
        }
    }
	public function training_report_data(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
                $emp_id=$this->session->userdata('employer_id'); 
				$unit=$this->input->post('unit'); 
				$deprt=$this->input->post('dep');
			    $field="mmt.package_id,mmt.package_name";
			  $table_name="mm_packages as mmt";
		      $join1[0]="mm_employer_package_map as mmp";
			  $join1[1]="mmt.package_id=mmp.emp_pack_id";
			  $join1[2]="left";
			  $where="mmp.company_id='$emp_id' and mmp.company_unit_id='$unit' and mmp.department_id='$deprt'";
			  $data['training_report_data']= $this->Crud_modal->fetch_data_by_one_table_join($field,$table_name,$join1,$where);
			  echo json_encode($data['training_report_data']);
			   
        }
        else{
            redirect(base_url().'employer');
        }
    }
	public function training_attend_user(){
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
              $emp_id=$this->session->userdata('employer_id');
              $data['unit_det']=$this->Crud_modal->all_data_select("*","mm_company_unit","company_id='$emp_id' and status='1'", '');
			  //print_r($data['all_training']); die;
             //echo "hai";
			  $this->load->view('employertempletes/head'); 
              $this->load->view('employertempletes/header'); 
              $this->load->view('training-attent-user',$data); 
              $this->load->view('employertempletes/footer');
              $this->load->view('employertempletes/sidebar');
        }
        else{
            redirect(base_url().'employer');
        }
    }
	
	   public function job_user_list(){
        $emp_id=$this->session->userdata('employer_id');
         $data['job_data']=$this->Crud_modal->all_data_select('job_id,job_title','mm_master_job',"company_id='$emp_id'",'job_id desc');
         $this->load->view('employertempletes/head'); 
         $this->load->view('employertempletes/header');
         $this->load->view('job-user-list',$data);  
         $this->load->view('employertempletes/footer');
         $this->load->view('employertempletes/sidebar');
    }

	
	public function job_user_list_data(){
        $emp_id=$this->session->userdata('employer_id');
        $code = $this->input->post('job_id');
       //$job = $this->Crud_modal->all_data_select('*','mm_user_applied_job',"job_id='$code'",'job_id');
      // print_r(count($job)); die;
		 $data['code'] = rtrim(strtr(base64_encode($code), '+/', '-_'), '=');  
        $data['code1'] = $this->input->post('job_id');   
		$data['job_data']=$this->Crud_modal->all_data_select('job_id,job_title,status','mm_master_job',"company_id='$emp_id' and status in(1,3)",'created_date');
		if($code!=''){     
         $field = 'mj.uid,mj.created_data,mj.gender,mj.dob,mj.phone_no,mj.skills,mj.name,mj.skill_per as neurons,mj.skill_marks as marks,u.mm_user_full_name,u.mm_user_full_name,mm_user_email,mj.resume_link';
         $table_name = 'mm_user_applied_job as mj'; 
         //$table_name = 'user as u';
         $join1[0]="user as u";
         $join1[1]="mj.uid = u.mm_uid";
         $join1[2]="left";
         $where = "mj.job_id = '$code'";
         $data['user_data'] = $this->Crud_modal->fetch_data_by_one_table_join($field,$table_name,$join1,$where);
		}else{
			$data['user_data']='';
		}
		//exit();
         $this->load->view('employertempletes/head'); 
         $this->load->view('employertempletes/header');
         $this->load->view('job-user-list-data',$data);  
         $this->load->view('employertempletes/footer');
         $this->load->view('employertempletes/sidebar');
         
    }
     public function view_jaf_structure_ajax(){
        $emp_id=$this->session->userdata('employer_id');
        $data['job_data']=$this->Crud_modal->all_data_select('job_id,job_title,status','mm_master_job',"company_id='$emp_id' and status !=2 and status !=0",'created_date');
        $data['job_id'] = $j=$this->input->post("job_id");
        if($j!=''){
                $where_state_id="country_id='101'";
                $data['state']=$this->Crud_modal->all_data_select('*','states',$where_state_id,'name asc');
                $data['university']=$this->Crud_modal->all_data_select('*','master_university',"un_status='1'",'un_name asc');
                if($this->input->post("job_id")!=""){
                    
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
      }
         $this->load->view('employertempletes/head'); 
         $this->load->view('employertempletes/header');
         $this->load->view('job-desc-view-list',$data);  
         $this->load->view('employertempletes/footer');
         $this->load->view('employertempletes/sidebar');
    }
}

