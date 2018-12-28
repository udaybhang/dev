<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employer_model extends MX_Controller {	
	  function __construct()
      {
            $this->load->database();
            $this->load->library('session');
            $this->load->library('email');
           // $this->load->library('upload');
      }

      public function getUserToNotify($skills=null,$exp=null,$age=null)
      {
        $users = $temp1 = $temp2 = $temp3 = $dvc_ids = array();
        if(!empty($age))
        {
          $ag_l = isset($age[0])?$age[0]:10;
          $ag_m = isset($age[1])?$age[1]:100;
          $query = $this->db->query('select uid as user_id FROM user_data where uid > 0 group by uid having sum(round(((DATEDIFF(CURDATE(), dob))/30)/12)) between '.$ag_l.' AND '.$ag_m);
        }
        else
        {
          $query = $this->db->query('select uid as user_id FROM user_data where uid > 0 group by uid having sum(round(((DATEDIFF(CURDATE(), dob))/30)/12)) > 10');
        }
        // if(!empty($query))
        //   $temp1 = $query->result();

        foreach ($query->result() as $v) 
        {
          $temp1[] = $v->user_id;
        }

        if(!empty($exp))
        {
          $ex_l = isset($exp[0])?$exp[0]:0;
          $ex_m = isset($exp[1])?$exp[1]:100;
          $query = $this->db->query('select user_id FROM work_experience group by user_id having sum(round(((DATEDIFF(emp_to, emp_from))/30)/12)) between '.$ex_l.' AND '.$ex_m);
        }
        else
        {
          $query = $this->db->query('select user_id FROM work_experience group by user_id having sum(round(((DATEDIFF(emp_to, emp_from))/30)/12))');
        }
        // if(!empty($query))
        //   $temp2 = $query->result();
        
        foreach ($query->result() as $v) 
        {
          $temp2[] = $v->user_id;
        }

        $users = array_merge($temp1,$temp2);
        $users = array_unique($users);
        // var_dump($users);die;
        if(!empty($users))
        {
          // $query = $this->db->query("select web_device_id FROM user where web_device_id != '' AND mm_uid");
          $res = $this->db->select('web_device_id')->from('user')->where('web_device_id != ""')->where_in('mm_uid',$users)->get()->result();
          if(!empty($res))
          {
            foreach ($res as $v) 
            {
              $dvc_ids[] = $v->web_device_id;
            }
          }
        }

        // if(!empty($exp))
        // {
        //   $this->db->query('select user_id FROM work_experience group by user_id having sum(round(((DATEDIFF(emp_to, emp_from))/30)/12)) between '.isset($exp[0])?$exp[0]:0.' AND '.isset($exp[1])?$exp[1]:100);
        // }
        // else
        // {
        //   $this->db->query('select user_id FROM work_experience group by user_id having sum(round(((DATEDIFF(emp_to, emp_from))/30)/12))');
        // }
        // $users = $this->db->result();
        return $dvc_ids;
      }

    function employer_login()
      {
        try
	         {
                $username=$this->input->post('email');
                $password= $this->input->post('pwd');
                 $this->db->initialize();
                $this->db->select('*');
                $this->db->from('mm_employer');
								
								if($this->input->post('Type')!="" || $this->input->post('Type')!=null)
								{
									 
									 if($this->input->post('Type')=='fb' || $this->input->post('Type')=='linke'|| $this->input->post('Type')=='gmail')
									 { $this->db->where(array('employer_email'=>$username,'employer_status'=>'1'));}
                 
								}
								else{
									 
									$this->db->where(array('employer_email'=>$username,'employer_password'=>md5($password),'employer_status'=>'1','eamil_auth_status'=>1));
								}
                $this->db->last_query();
                $query = $this->db->get();
				      //  echo  $this->db->last_query();
							//  exit;
            if($query->num_rows() == 1)
             {
                $result=$query->row_array();
                $this->db->close();
								$uid=$result['employer_id'];
								$nameuser=$result['employer_contact_person_name'];
								$email=$result['employer_email'];
                $pic=$result['profile_pic'];
              //  $user_type=$result['user_type_id'];
								if($email=="zoomhiring@rivigo.com"){
									$login_user_data = array('emp_email'=>$email,'emp_name'=>$nameuser,'employer_id'=>35);
								}else{
									$login_user_data = array('emp_email'=>$email,'emp_name'=>$nameuser,'employer_id'=>$uid);
								}
								 
								$session_set= $this->session->set_userdata($login_user_data);
								return true;
             }
            else
             {
               $this->db->close();
               return 0;
             }
          }
          catch(Exception $e)
          {
              echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
          }
        
      }

        function check_employer_email_verified()
      {
        try
	         {
	         	 if($this->input->post('Type')=='fb' || $this->input->post('Type')=='linke'|| $this->input->post('Type')=='gmail')
	         	 {
	         	 	return 1;
	         	 }
	         	 else
	         	 {
	         	 $username=$this->input->post('email');
                 $this->db->initialize();
                $this->db->select('*');
                $this->db->from('mm_employer');
				$this->db->where(array('employer_email'=>$username,'eamil_auth_status'=>1));
				$query = $this->db->get();
				     
            if($query->num_rows() == 1)
             {
               $this->db->close();
								return true;
             }
            else
             {
              $this->db->close();
               return 0;
             }
	         	 }
                
          }
          catch(Exception $e)
          {
              echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
          }
        
      }

      function check_employer_email_exists()
      {
        try
	         {
	         	 if($this->input->post('Type')=='fb' || $this->input->post('Type')=='linke'|| $this->input->post('Type')=='gmail')
	         	 {
	         	 	return 1;
	         	 }
	         	 else
	         	 {
	         	 $username=$this->input->post('email');
                $this->db->initialize();
                $this->db->select('*');
                $this->db->from('mm_employer');
				$this->db->where(array('employer_email'=>$username));
				$query = $this->db->get();
				     
            if($query->num_rows() == 1){
              $this->db->close();
               return true;
             }else{
               $this->db->close();
               return 0;
             }
	         	 }
                
          }
          catch(Exception $e)
          {
              echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
          }
        
      }
       function employer_session_authkey($authkey)
      {
        try
           {
                 $this->db->initialize();
                $this->db->select('*');
                $this->db->from('mm_employer');
                $this->db->where(array('employer_auth_key'=>$authkey,'employer_status'=>'0','eamil_auth_status'=>'1'));
                //$this->db->last_query();
                $query = $this->db->get();
            // echo  $this->db->last_query();
          
          
            if($query->num_rows() == 1)
             {
                $result=$query->row_array();
                $uid=$result['employer_id'];
                $uemail=$result['employer_email'];
                $name=$result['employer_contact_person_name'];
               // $type=$result['user_type_id'];
                $login_user_data = array('emp_name'=>$name,'employer_id'=>$uid,'emp_email'=>$uemail); 
                $session_set= $this->session->set_userdata($login_user_data);
                return 1;
               }
              
            
            else
             {
               return 0;
             }
          }
          catch(Exception $e)
          {
              echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
          }
        
      }
      function check_employer_password($uid){
        try{
                $this->db->initialize();
                $this->db->select('employer_password');
                $this->db->from('mm_employer');
                $this->db->where('employer_id',$uid);
                $query = $this->db->get();
                $result = $query->row_array();
                $this->db->close();
                return $result;
        }catch(Exception $e){
              echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
        }
     }

  function get_jobs($uid){
          $this->db->initialize();
          $this->db->select("job.job_id, job.job_title, job.required_system_neurons, job.company_id, job.ctc_from, job.ctc_to, job.status, job.package_id, job.industry_id, job.functional_id, job.created_date as job_created_date, job.publish_date,job.package_skills_id, job.remarks, functional.functional_name ");
          $this->db->from('mm_master_job as job');
          $this->db->join('mm_master_industry_functional as functional','job.functional_id=functional.functional_id','left');
          $this->db->where('job.company_id',$uid);
          $this->db->order_by('job.publish_date desc'); 
          $query = $this->db->get();
          $result=$query->result_array();
          $this->db->close();
          return $result;
         
     }

     public function get_city_by_job_location_id($lid){
        $this->db->initialize();
        $this->db->select('*');
        $this->db->from('cities');
        $this->db->where('ci_id',$lid);
        $query =$this->db->get();
        //return $query->result_array();
        $result = $query->row_array();
        $this->db->close();
        return $result;
     }
     public function get_skill_by_assignment_id($aid){
          $this->db->initialize();
          $this->db->select("level.*, skill.* ");
          $this->db->from('master_level as level');
          $this->db->join('master_skills_test as skill','level.skills=skill.skills_id','inner');
          $this->db->where('level.maid',$aid);
          $this->db->group_by('skill.skills_id');
        
        $query =$this->db->get();
        //return $query->result_array();
        $result = $query->row_array();
        $this->db->close();
          return $result;
     }
     public function get_skill_by_skill_id($sid){
          $this->db->initialize();
          $this->db->select(" * ");
          $this->db->from('master_skills_test');
          $this->db->where('skills_id',$sid);
          $query =$this->db->get();
          $result = $query->row_array();
          $this->db->close();
          return $result;
     }
     
     public function get_skill_neurons($select,$table,$where){
          $this->db->initialize();
          $this->db->select($select);
          $this->db->from($table);
          $this->db->where($where);
         
          $query =$this->db->get();
          $result = $query->row_array();
          $this->db->close();
          return $result;
     }
      public function get_skill_group_by($select,$table,$where,$group_by){
          $this->db->initialize();
          $this->db->select($select);
          $this->db->from($table);
          $this->db->where($where);
          $this->db->group_by($group_by);
          $query =$this->db->get();
          $result = $query->result_array();
          $this->db->close();
          return $result;
     }
    public function get_max_neuns($wr){
     $this->db->initialize();
    $this->db->select('CONVERT(sum(sc.total_level_marks),UNSIGNED INTEGER) as y,skil.skills_name as label');
    $this->db->from('master_level as ml');
    $this->db->join('master_skills_test as skil','ml.skills=skil.skills_id');
    $this->db->where($wr);
    $query= $this->db->get();
    $result=$query->row_array();
    $this->db->close();
    return $result;
  }

  function data_insert_emp_job($bl_name,$field){
     $this->db->initialize();
     $this->db->insert($bl_name,$field);
     $result = $this->db->insert_id();
     $this->db->close();
     return $result;
  }
  
  function fetch_single_job($jid){
           $this->db->initialize();
          $this->db->select("job.*, functional.functional_name, industry.industry_name ");
          $this->db->from('mm_master_job as job');
          $this->db->join('mm_master_industry_functional as functional','job.functional_id=functional.functional_id','inner');
          $this->db->join('mm_master_industry_topic as industry','job.industry_id=industry.industry_id','inner');          
          $this->db->where('job.job_id',$jid);
          $query = $this->db->get();
          $result=$query->row_array();
          $this->db->close();
          return $result;        
  }           
  public function get_user_appied_data($uid){
     $this->db->initialize();
    $result = $this->db->select("*")  
            ->from("mm_master_job mmj")
            ->join("mm_user_applied_job maj","mmj.job_id= maj.job_id",'right')
            ->where("mmj.created_by",$uid)
            ->get()
            ->result_array();
             $this->db->close();
            return $result;

} 
function delete_record($tbl,$col,$val){
   $this->db->initialize();
    $this->db->where($col,$val);
    $result = $this->db->delete($tbl); 
    $this->db->close();
      return $result;  
  }
  public function user_grad_education($uid){
     $this->db->initialize();
	$result = $this->db->select("md.degree_name,mu.un_name,ud.grad_year_pass")
				->from("user_data ud")
				->join("master_degree md","md.md_id=ud.grad_degree","left")
				->join("master_university mu","mu.mu_id=ud.grad_institution","left")
				->where("ud.uid",$uid)
				->get()
				->row_array();
        $this->db->close();
      return $result;
  }  
  public function user_pg_education($uid){
     $this->db->initialize();
	$result = $this->db->select("md.degree_name,mu.un_name,ud.pg_year_pass")
				->from("user_data ud")
				->join("master_degree md","md.md_id=ud.pg_degree","left")
				->join("master_university mu","mu.mu_id=ud.pg_institution","left")
				->where("ud.uid",$uid)
				->get()
				->row_array();
        $this->db->close();
      return $result;
  }
  public function user_certi($uid){
     $this->db->initialize();
	  $result = $this->db->select("mmc.certification_name")
					->from("mm_certificate_log mcl")
					->join("mm_master_certification mmc","mcl.cerificate_id=mmc.certification_id","left")
					->where("uid",$uid)
					->order_by("mcl.certificate_log_id desc")     
					->limit(1)
					->get()
					->row_array();
           $this->db->close();
      return $result;
  }
 public function get_total_applied($jid)
 {
      $this->db->initialize();
      $this->db->select('count(uid) as total_applied');
      $this->db->from('`mm_user_applied_job');
      $this->db->where('job_id',$jid);
      $query =$this->db->get();
      $result = $query->row_array();
      $this->db->close();
      return $result;
  }
 function get_jobs_by_functional($uid,$fid){
   $this->db->initialize();
          $where='job.company_id='.$uid.' and job.functional_id='.$fid;
          $this->db->select("job.job_id, job.job_title, job.required_system_neurons, job.package_skills_id,job.company_id, job.ctc_from, job.ctc_to, job.status, job.package_id, job.industry_id, job.functional_id, job.created_date as job_created_date, job.publish_date, job.remarks, functional.functional_name ");
          $this->db->from('mm_master_job as job');
          $this->db->join('mm_master_industry_functional as functional','job.functional_id=functional.functional_id','inner');
          $this->db->where($where);
          $this->db->group_by('job.job_id');
          $query = $this->db->get();
          $result=$query->result_array();

          $this->db->close();
          return $result;
         
     }

public function get_user_appied_data_by_job_id($where,$orderby){
   $this->db->initialize();
    $result = $this->db->query("
		SELECT mmj.*,u.mm_uid,mmj.pack_min_neurons as package_min_neurons,maj.*,maj.skill_per as neurons,maj.skill_marks as marks,ud.present_city,ud.grad_year_pass,ud.pg_year_pass,ud.pg_institution,ud.pg_degree,ud.grad_degree,ud.present_state,ud.grad_institution,ud.linkedIn_profile_link,ud.notice_period,ud.city,DATE_FORMAT(ud.dob,'%d/%m/%Y') as dob,ud.image,ud.resume,ud.location_constraint,ud.job_shifts_constraint,ud.ssc_year_pass,ud.hsc_year_pass,ud.grad_year_pass,(select sum(DATEDIFF(IFNULL(`emp_to`,Now()), `emp_from`)) from work_experience where user_id=maj.uid) as exp,city.name as city_name
		FROM `mm_master_job` `mmj`
		LEFT JOIN `mm_user_applied_job` `maj` ON `mmj`.`job_id`= `maj`.`job_id`
		LEFT join user_data ud on ud.uid=maj.uid
		LEFT join user u on u.mm_uid=maj.uid
		LEFT join cities city on city.ci_id=ud.present_city
		WHERE $where
		ORDER BY  $orderby
	")->result_array();

          $this->db->close();
          return $result;
}
function get_jobs_open_close($uid,$status){
           $this->db->initialize();
           $this->db->select("job.job_id, job.job_title, job.required_system_neurons, job.company_id, job.ctc_from, job.ctc_to, job.status, job.package_id, job.industry_id, job.functional_id, job.created_date as job_created_date, job.publish_date,job.package_skills_id, functional.functional_name ");
          $this->db->from('mm_master_job as job');
          $this->db->join('mm_master_industry_functional as functional','job.functional_id=functional.functional_id','left');
          $this->db->where(['job.company_id'=>$uid,"job.status"=>$status]);
          $this->db->order_by('job.created_date desc');
          $query = $this->db->get();
          $result=$query->result_array();
          $this->db->close();
          return $result;
         
     }
function get_jobs_by_functional_open_close($uid,$fid,$status){
   $this->db->initialize();
          $where='job.company_id='.$uid.' and job.functional_id='.$fid.' and job.status='.$status;
           $this->db->select("job.job_id, job.job_title, job.required_system_neurons, job.company_id, job.ctc_from, job.ctc_to, job.status, job.package_id, job.industry_id, job.functional_id, job.created_date as job_created_date, job.publish_date,job.package_skills_id, functional.functional_name ");
          $this->db->from('mm_master_job as job');
          $this->db->join('mm_master_industry_functional as functional','job.functional_id=functional.functional_id','inner');
          $this->db->where($where);
          $query = $this->db->get();
          $result=$query->result_array();
          $this->db->close();
          return $result;
         
}
 public function array_sort($array, $on, $order){
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }
        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }
        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }
    return $new_array;
  }

  function get_total_applied_user($uid){
        $JOBS=$this->Employer_model->get_jobs($uid); 
        $sum=0; 
        for($i=0;$i<sizeof($JOBS);$i++){
            $app_job=$this->Employer_model->get_total_applied($JOBS[$i]['job_id']);
            $tap=$app_job['total_applied'];
            $sum=$sum+$tap;      
        }
        return $sum;
   }
   public function get_employer_detail($emp_id){
     $this->db->initialize();
  $result = $this->db->select("c.name as cityname,s.name as statename,me.employer_address")
          ->from("mm_employer me")
          ->join("cities c","me.employer_city_id=c.ci_id","left")
          ->join("states s","c.state_id=s.sid","left")
          ->where("me.employer_id",$emp_id)
          ->get()
          ->row_array();
          $this->db->close();
          return $result;
}

public function confirm_employer_message(){
       echo "exit";
       exit();
       $this->load->view('confirmation_message');
  }

   function employer_account_activation(){
     $this->db->initialize();
     $em=$uri=$this->uri->segment(2);
     $email= base64_decode(str_pad(strtr($em, '-_', '+/'), strlen($em) % 4, '=', STR_PAD_RIGHT));  
     $this->db->select('*');
     $this->db->from('mm_employer');
     $this->db->where(array('employer_email'=>$email,'employer_status'=>'1','eamil_auth_status'=>'1'));
     $query = $this->db->get();
     if($query->num_rows() == 1){
         $result=$query->row_array();
         $this->db->close();
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
function get_prev_schedule_date($fields,$tbl_name,$where,$orderby){
       $this->db->initialize();
       $this->db->select($fields);
       $this->db->from($tbl_name);
       $this->db->where($where);
       $query = $this->db->order_by($orderby);
       $query = $this->db->limit(1,1);
       $query = $this->db->get();
       $result=    $query->row_array();
       $this->db->close();
       return $result;
     }
	 
	 function check_percentage($marks,$condition){
  $result=false;
  if($condition=="Greater than 60"){
    if($marks>60){
      $result=true;
    }else{
      $result=false; 
    }
  }
  if($condition=="Less than 60"){
    if($marks<60){
      $result=true;
    }else{
      $result=false;
    }
  }
  if($condition=="*"){
    $result=true;
  }
  return $result;
}


  function get_jobs1($uid,$status){
           $this->db->initialize();
          $this->db->select("job.job_id, job.job_title, job.required_system_neurons, job.company_id, job.ctc_from, job.ctc_to, job.status, job.package_id, job.industry_id, job.functional_id, job.created_date as job_created_date, job.publish_date,job.package_skills_id, job.remarks, functional.functional_name ");
          $this->db->from('mm_master_job as job');
          $this->db->join('mm_master_industry_functional as functional','job.functional_id=functional.functional_id','left');
           $this->db->where('job.company_id',$uid);
           $this->db->where("job.status in('.$status.')");
           $this->db->order_by('job.publish_date desc');
          $query = $this->db->get();
          $result=$query->result_array();
          $this->db->close();
          return $result;
         
     }
public function get_user_jaf_data_by_job_id($where,$orderby){
   $this->db->initialize();
    $result = $this->db->query("
    SELECT mmj.job_id,maj.uid,maj.job_id,maj.name,maj.phone_no,maj.dob,maj.gender,maj.resume_link,maj.hsc_marks,maj.ssc_marks,maj.grad_marks,maj.pg_marks,maj.aadhar,maj.designation,maj.company_count,maj.location_constraint,maj.job_shifts_constraint,maj.created_data,maj.education_gap,maj.last_applied,maj.man_power,maj.man_power_list,maj.marks_avg,maj.total_work_ex,ud.present_city,ud.grad_year_pass,ud.pg_year_pass,ud.pg_institution,ud.pg_degree,ud.grad_degree,ud.present_state,ud.grad_institution,ud.linkedIn_profile_link,ud.notice_period,ud.city,ud.dob,ud.image,ud.resume,ud.location_constraint,ud.job_shifts_constraint,ud.ssc_year_pass,ud.hsc_year_pass,ud.grad_year_pass,(select sum(DATEDIFF(IFNULL(`emp_to`,Now()), `emp_from`)) from work_experience where user_id=maj.uid) as exp,city.name as city_name
    FROM `mm_master_job` `mmj`
    LEFT JOIN `mm_user_applied_job` `maj` ON `mmj`.`job_id`= `maj`.`job_id`
    LEFT join user_data ud on ud.uid=maj.uid
    LEFT join cities city on city.ci_id=ud.present_city
    WHERE $where
	
    ORDER BY  $orderby ")->result_array();
    $this->db->close();
    return $result;
} 

public function get_user_appied_data_by_job_id1($where,$orderby){
   $this->db->initialize();
   $result=$this->db->query("
    SELECT mmj.package_id,maj.uid,mmj.pack_min_neurons as package_min_neurons,maj.*,maj.skill_per as neurons,maj.skill_marks as marks,(select sum(DATEDIFF(IFNULL(`emp_to`,Now()), `emp_from`)) from work_experience where user_id=maj.uid) as exp
    FROM `mm_master_job` `mmj`
    LEFT JOIN `mm_user_applied_job` `maj` ON `mmj`.`job_id`= `maj`.`job_id`
    LEFT join user_data ud on ud.uid=maj.uid
    WHERE $where
    ORDER BY  $orderby
  ")->result_array();
   $this->db->close();
   return $result;
  
}


} 
       
