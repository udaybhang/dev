<?php
class Job_Refill_Package extends MX_Controller
{
    function __construct(){
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
        if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        }else{
            redirect(base_url().'employer','refresh');
        }
    }
    public function refill_employer_package(){
      if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $data['employer']=$this->Crud_modal->fetch_single_data('employer_company,employer_id,employer_industry_id','mm_employer','employer_id='.$this->session->userdata('employer_id'));
        $id=$this->uri->segment(2);
        $id_list=explode('-', $id);
        $pack_type_id=$id_list[0]; $pack_id=$id_list[1]; 
        $data['encode_package_id']=$pack_id;
        $data['encode_package_type_id']=$pack_type_id;
        $this->load->view('employertempletes/head');
        $this->load->view('employertempletes/header'); 
        $this->load->view('employertempletes/sidebar');
        $this->load->view('refill-employer-package-new',$data);
        $this->load->view('employertempletes/footer');
      }else{                   
        redirect(base_url().'employer','refresh');
      }
    }
    public function emp_job_load_package_summary(){
  if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
    $id = $this->input->post('ID'); 
    $pack_type = $this->input->post('package_type'); 
    $ptype=base64_decode(str_pad(strtr($pack_type, '-_', '+/'),strlen($pack_type) % 4,'=',STR_PAD_RIGHT));
    $pack_id= base64_decode(str_pad(strtr($id, '-_', '+/'), strlen($id) % 4, '=', STR_PAD_RIGHT));   
    $where = "package_id = '$pack_id'";
    $where1 = "pack_id = '$pack_id'";
    $data['pack_data'] = $this->Crud_modal->fetch_single_data('package_id,package_name,total_marks,total_time,image','mm_packages',$where);
    $data['pack_data']['encode_pack_id']=$id;
    $data['assignment']= $ass= $this->Crud_modal->all_data_select('maid,assignment_name,package_hrs','master_assignment',$where1,'maid'); 
    for($i=0;$i<sizeof($ass);$i++){
        $id_as=$ass[$i]['maid'];
        $il=rtrim(strtr(base64_encode($id_as), '+/', '-_'), '=');
        $data['assignment'][$i]['encode_maid']=$il;
        $newdata = $data['assignment'][$i]['levels'] = $this->Admindashboard_modal->get_level_details($pack_id,$id_as);
        for($lev=0; $lev<sizeof($newdata); $lev++){
           $toolid = $data['assignment'][$i]['levels'][$lev]['m_type'];
           $topic = $data['assignment'][$i]['levels'][$lev]['topic_id'];
           $levelid = $data['assignment'][$i]['levels'][$lev]['ml_id'];
           $level_id=rtrim(strtr(base64_encode($levelid), '+/', '-_'), '=');   
           $tool_id=rtrim(strtr(base64_encode($toolid), '+/', '-_'), '=');
           $data['assignment'][$i]['levels'][$lev]['encode_ml_id']=$level_id;
           $table_name ="";
           if($data['assignment'][$i]['levels'][$lev]['name']==""){
                $data['assignment'][$i]['levels'][$lev]['name']="Subjective";
           }
            switch($toolid) {
                case 1:
                    $tool='MCQ';
                    $table_name = 'mcq';
                    $page_link[] = 'create-mcq';
                    $grid_id =$pack_type.'-'.$id.'-'.$il.'-'.$level_id.'-'.$tool_id; 
                    break;
                case 2:
                    $tool='Sequence';
                    $table_name = 'sequence_questions';
                    $page_link[] = 'create-sequence';
                    $grid_id =$pack_type.'-'.$id.'-'.$il.'-'.$level_id.'-'.$tool_id;
                    break;
                case 3:
                    $tool='Match the following';
                    $table_name = 'match_the_following';
                    $page_link[] = 'match-the-following';
                    $grid_id =$pack_type.'-'.$id.'-'.$il.'-'.$level_id.'-'.$tool_id;
                    break;
                case 8:
                    $tool='Bucket';
                    $table_name = 'mm_bucket';
                    $page_link[] = 'create-bucket';
                    $grid_id =$pack_type.'-'.$id.'-'.$il.'-'.$level_id.'-'.$tool_id;
                    break;
                case 14:
                    $tool='D-MCQ';
                    $table_name = 'mcq';
                    $page_link[] = 'create-mcq';
                    $grid_id =$pack_type.'-'.$id.'-'.$il.'-'.$level_id.'-'.$tool_id; 
                    break;
            }
            if($table_name !=""){
                 $where = "topic = '$topic'";
                 $arr[] = $tool;
                 $row = $this->Crud_modal->check_numrow($table_name,$where);
                 $tool_r = implode(',', $arr);
                 $page_link_r = implode(',', $page_link);
                 $data['assignment'][$i]['levels'][$lev]['no_of_question']=$row;
                 $data['assignment'][$i]['levels'][$lev]['tool_link']=$page_link_r;
                 $data['assignment'][$i]['levels'][$lev]['name']=$tool;
                 $data['assignment'][$i]['levels'][$lev]['g_id']=$grid_id;

            } 
        }
    }//end for
    echo json_encode($data);
    }else{                    
      redirect(base_url().'employer','refresh');
    } 
}
public function emp_job_package_tool(){
    $id = explode('-',$this->uri->segment(2));
    $pack_type_id = $id[0];
    $package_id = $id[1];
    $assign_id = $id[2];
    $level_id = $id[3];
    $tool_id = $id[4];
    $case_tol_id = $id[5];
    $data['package_id']=$package_id;
    $data['package_type_id']=$pack_type_id;

    $pack_id=base64_decode(str_pad(strtr($package_id, '-_', '+/'), strlen($package_id) % 4, '=', STR_PAD_RIGHT));  
    $l_id=base64_decode(str_pad(strtr($level_id, '-_', '+/'), strlen($level_id) % 4, '=', STR_PAD_RIGHT));
    $toolid=base64_decode(str_pad(strtr($tool_id, '-_', '+/'), strlen($tool_id) % 4, '=', STR_PAD_RIGHT));

    $data['is_redirect']=1;
    if($toolid==4){$indus_id = $id[6]; $comp_id = $id[7];}else{$indus_id = $id[5]; $comp_id = $id[6];}
    $top=$this->Crud_modal->fetch_single_data('skills,d_level,level_type','master_level',"ml_id=$l_id");

    $compid=base64_decode(str_pad(strtr($comp_id, '-_', '+/'), strlen($comp_id) % 4, '=', STR_PAD_RIGHT));
    $where = 'status =1';

   $pac_skill = explode(',',$top['skills']);
    if($compid==0){
        for($s=0; $s<count($pac_skill); $s++){
            $sid = $pac_skill[$s];
            $skill_sql= $this->Crud_modal->fetch_single_data("skills_id,skills_name","master_skills_test","skills_id='$sid'","skills_id"); 
            $data['master_skills_tests'][$s]['skills_id'] = $skill_sql['skills_id'];
            $data['master_skills_tests'][$s]['skills_name'] = $skill_sql['skills_name'];
        }
    }else{
        for($s=0; $s<count($pac_skill); $s++){
            $sid = $pac_skill[$s];
            $skill_sql =  $this->Crud_modal->fetch_single_data("emp_skill_id,skill_name","mm_employer_skill","emp_skill_id='$sid'","emp_skill_id"); 
            $data['master_skills_tests'][$s]['skills_id'] = $skill_sql['emp_skill_id'];
            $data['master_skills_tests'][$s]['skills_name'] = $skill_sql['skill_name'];
        }
    }
    $whereall = 'status =1 and diffi_id='.$top['d_level'];
    $data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$whereall,'diffi_id desc');
    $data['packages_id']=$package_id;
    $data['indus_id']=$indus_id;
    $data['company_id']=$comp_id;
    $data['topic_id']=$tid=$top['level_type'];
    $data['master_topics'] = $this->Crud_modal->fetch_single_data('t_id,t_name','master_topic',"status=1 and t_id=$tid");
    $data['url_id']=$this->uri->segment(2);
    $data['employer']=$this->Crud_modal->fetch_single_data('employer_id,employer_company,employer_industry_id','mm_employer','employer_id='.$this->session->userdata('employer_id'));     
    switch($toolid) {
        case 1:
            $data['tool_name']='MCQ Create';
            $table_name1 = 'mcq';
            $page_link1[] = 'create-mcq';
            $page_name='emp-mcq-tool';
            break;
        case 2:
            $data['tool_name']='Sequence Create';
            $table_name1 = 'sequence_questions';
            $page_link1[] = 'create-sequence';
            $page_name='emp-sequence-tool';
            break;
        case 3:
            $data['tool_name']='Match the following';
            $table_name1 = 'match_the_following';
            $page_link1[] = 'match-the-following';
            $page_name='emp-match-following-tool';
            break;
        case 8:
            $data['tool_name']='Bucket Create';
            $table_name1 = 'mm_bucket';
            $page_link1[] = 'create-bucket';
            $page_name='emp-bucket-tool';
            break;
        case 14:
            $data['tool_name']='D-MCQ Create';
            $table_name1 = 'mcq';
            $page_link1[] = 'create-mcq';
            $page_name='emp-mcq-tool';
            break;
    }
    $this->load->view('employertempletes/head');
    $this->load->view('employertempletes/header'); 
    $this->load->view('employertempletes/sidebar');
    $this->load->view('refill-header-new', $data);
    // page for tool
    $this->load->view($page_name, $data);
    //end here
    $this->load->view('refill-footer-new', $data);
    $this->load->view('employertempletes/footer');
}

public function emp_job_get_assign_discription(){
  if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
    $pkg = $this->input->post('ID');
    $pack_id=base64_decode(str_pad(strtr($pkg, '-_', '+/'), strlen($pkg) % 4, '=', STR_PAD_RIGHT));  
    $assing_data =$this->Crud_modal->all_data_select('*',"master_assignment","pack_id='$pack_id'",'maid desc');
    echo json_encode(['assign_data'=>$assing_data]);
  }else{                   
    redirect(base_url().'employer','refresh');
  }
}
public function emp_job_get_level_question(){
  if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
    $pkg = explode('-', $this->input->post('ID'));
    $eid=$this->session->userdata('employer_id');
    $industries= $this->input->post('industry_id');
    if($industries==""){
        $indu = $this->Crud_modal->fetch_single_data('employer_industry_id','mm_employer',"employer_id=".$eid);
        $industries=rtrim(strtr(base64_encode($indu["employer_industry_id"]), '+/', '-_'), '=');
    }
    $company = $this->input->post('company_id');
    if($company==""){
      $company=  rtrim(strtr(base64_encode($eid), '+/', '-_'), '=');
    }
    $url_segment = $this->input->post('ID');
    $pkg_type_id=$pkg[0];
    $pkg_id = $pkg[1];
    $assign = $pkg[2];
    $level = $pkg[3];
    $tool = $pkg[4];
    if(count($pkg)==6){
        $tool_case = $pkg[5]; 
    }        
    $table_name1='';
    $all_question = array();
    $lev=base64_decode(str_pad(strtr($level, '-_', '+/'), strlen($level) % 4, '=', STR_PAD_RIGHT));
    $ass=base64_decode(str_pad(strtr($assign, '-_', '+/'), strlen($assign) % 4, '=', STR_PAD_RIGHT));
    $pkgid=base64_decode(str_pad(strtr($pkg_id, '-_', '+/'), strlen($pkg_id) % 4, '=', STR_PAD_RIGHT));
    $case_id = $this->Crud_modal->fetch_single_data('case_id','case_study',"maid='$ass' and level_id='$lev'");
    $topic_id = $this->Crud_modal->fetch_single_data('level_type','master_level',"maid='$ass' and ml_id='$lev' and pack_id='$pkgid'");
    $case =$case_id["case_id"];
    $topic= $topic_id["level_type"]; 
    $table_ques = '';
    $question_count =1;
    $tools=base64_decode(str_pad(strtr($tool, '-_', '+/'), strlen($tool) % 4, '=', STR_PAD_RIGHT));

    $comp = base64_decode(str_pad(strtr($company, '-_', '+/'), strlen($company) % 4, '=', STR_PAD_RIGHT));
    switch($tools) {
        case 1:
            $data['tool_name']='MCQ Create';
            $table_name1 = 'mcq';
            $page_link1[] = 'create-mcq';
            $question=$this->Crud_modal->all_data_select('*',$table_name1,"topic='$topic' and case_id=0 and mcq_status=1",'topic');
            $tool_heading='MCQ Question';
            $table_ques .='<tr style="background-color: #d6e0f3e0;"><td style="border:none;width:4%"></td><td style="padding-top: 2px; border:none;"><h4 style="color: #021423;font-size:12px;font-weight:600">'.$tool_heading.'</h4></td><td style="border:none;"></td><td style="border:none;"></td><td style="border:none;"></td><td style="text-align: right; padding-top: 13px; border:none;"><a href="'.base_url().'emp-job-package-tool/'.$pkg_type_id.'-'.$pkg_id.'-'.$assign.'-'.$level.'-'.$tool.'-'.$industries.'-'.$company.'"  target="_blank" style="color:#021423;font-size:12px;font-weight:600">+Add Question</a></td></tr>';
            
            foreach ($question as $ques) {
                $s=$ques['skill_tested'];
                $q_id=rtrim(strtr(base64_encode($ques['mcq_id']), '+/', '-_'), '=');
                $SKILL="";
                if($comp==0){
                    $r=$this->Crud_modal->fetch_single_data('skills_id,skills_name','master_skills_test',"skills_id='$s'");
                    $SKILL=$r["skills_name"];
                }else{
                    $r=$this->Crud_modal->fetch_single_data('emp_skill_id,skill_name','mm_employer_skill',"emp_skill_id='$s'");
                    $SKILL=$r["skill_name"];
                }
                $table_ques .='<tr><td>'.$question_count.'.</td><td>'.$ques["question"].'</td><td>'.$ques["c_answer"].'</td><td>'.$SKILL.'</td><td>'.$ques["created_date"].'</td><td style="text-align: center"><a href="'.base_url().'emp-job-view-package-tool/'.$pkg_type_id.'-'.$pkg_id.'-'.$assign.'-'.$level.'-'.$tool.'-'.$q_id.'-'.$industries.'-'.$company.'" target="_blank"><button class="btn btn-info  dim new-button-view" type="button"><i class="fa fa-eye"></i> </button></a> <a href="'.base_url().'emp-job-edit-package-tool/'.$pkg_type_id.'-'.$pkg_id.'-'.$assign.'-'.$level.'-'.$tool.'-'.$q_id.'-'.$industries.'-'.$company.'" target="_blank" style="margin-left: 3px;"><button class="btn btn-primary dim new-button-view" type="button"><i class="fa fa-edit"></i></button></a> <a data-value="'. $url_segment.'-'.$q_id.'" class="delete_question"></a></td></tr>';
                $question_count++; 
            }
            break;
        case 2:
            $data['tool_name']='Sequence Create';
            $table_name1 = 'sequence_questions';
            $page_link1[] = 'create-sequence';
            $question = $this->Crud_modal->all_data_select('*',$table_name1,"topic='$topic' and case_id=0 and status=1",'topic');
            $tool_heading='Sequence Question';
            $table_ques .='<tr style="background-color: #d6e0f3e0;"><td style="border:none;width:4%"></td><td style="padding-top: 2px; border:none;"><h4 style="color: #021423;font-size:12px;font-weight:600">'.$tool_heading.'</h4></td><td style="border:none;"></td><td style="border:none;"></td><td style="border:none;"></td><td  style="text-align: right; padding-top: 13px; border:none;" ><a href="'.base_url().'emp-job-package-tool/'.$pkg_type_id.'-'.$pkg_id.'-'.$assign.'-'.$level.'-'.$tool.'-'.$industries.'-'.$company.'"  target="_blank" style="color:#021423;font-size:12px;font-weight:600">+Add Question</a></td></tr>';
            foreach ($question as $ques) {
                $q_id=rtrim(strtr(base64_encode($ques['sq_id']), '+/', '-_'), '=');
                $s=$ques["skill_tested"];
                $SKILL="";
                if($comp==0){
                    $r=$this->Crud_modal->fetch_single_data('skills_id,skills_name','master_skills_test',"skills_id='$s'");
                    $SKILL=$r["skills_name"];
                }else{
                    $r=$this->Crud_modal->fetch_single_data('emp_skill_id,skill_name','mm_employer_skill',"emp_skill_id='$s'");
                    $SKILL=$r["skill_name"];
                }
                $options = explode('sohrab', $ques['options']);
                $b=0; $ans_str="";
                foreach ($options as $option) {
                    if($option != ''){
                        $ans_str.= ++$b.'. '.$option.'<br />';
                    }
                }
                $table_ques .='<tr><td>'.$question_count.'.</td><td>'.$ques["question"].'</td><td>'.$ans_str.'</td><td>'.$SKILL.'</td><td>'.$ques["created_date"].'</td><td style="text-align: center"><a href="'.base_url().'emp-job-view-package-tool/'.$pkg_type_id.'-'.$pkg_id.'-'.$assign.'-'.$level.'-'.$tool.'-'.$q_id.'-'.$industries.'-'.$company.'" target="_blank"><button class="btn btn-info  dim new-button-view" type="button"><i class="fa fa-eye"></i> </button></a> <a href="'.base_url().'emp-job-edit-package-tool/'.$pkg_type_id.'-'.$pkg_id.'-'.$assign.'-'.$level.'-'.$tool.'-'.$q_id.'-'.$industries.'-'.$company.'" target="_blank"><button class="btn btn-primary dim new-button-view" type="button"><i class="fa fa-edit"></i></button></a> <a data-value="'.$url_segment.'-'.$q_id.'" class="delete_question"></a></td></tr>';
                             
                $question_count++; 
            }
            break;
        case 3:
            $data['tool_name']='Match the following';
            $table_name1 = 'match_the_following';
            $page_link1[] = 'match-the-following';
            $question = $this->Crud_modal->all_data_select('*',$table_name1,"topic='$topic' and case_id=0 and match_status=1",'topic');
            $tool_heading='Match of the following Question';
            $table_ques .='<tr style="background-color: #d6e0f3e0;"><td style="border:none;width:4%"></td><td style="padding-top: 2px; border:none;"><h4 style="color: #021423;font-size:12px;font-weight:600">'.$tool_heading.'</h4></td><td style="border:none;"></td><td style="border:none;"></td><td style="border:none;"></td><td  style="text-align: right; padding-top: 13px; border:none;" ><a href="'.base_url().'emp-job-package-tool/'.$pkg_type_id.'-'.$pkg_id.'-'.$assign.'-'.$level.'-'.$tool.'-'.$industries.'-'.$company.'"  target="_blank" style="color:#021423;font-size:12px;font-weight:600">+Add Question</a></td></tr>';
            foreach ($question as $ques) {
                $q_id=rtrim(strtr(base64_encode($ques['match_id']), '+/', '-_'), '=');
                $s=$ques["skill_tested"];
                $SKILL="";
                if($comp==0){
                    $r=$this->Crud_modal->fetch_single_data('skills_id,skills_name','master_skills_test',"skills_id='$s'");
                    $SKILL=$r["skills_name"];
                }else{
                    $r=$this->Crud_modal->fetch_single_data('emp_skill_id,skill_name','mm_employer_skill',"emp_skill_id='$s'");
                    $SKILL=$r["skill_name"];
                }
                $options1=explode('comma',$ques['match_question']);
                $b1=0; $mques="";
                foreach ($options1 as $value) {
                    $mques.= ++$b1.'. '.$value.'<br />';
                }
                $options2=explode('comma',$ques['match_answer']);
                $b2=0; $mans="";
                foreach ($options2 as $value) {
                    $mans.= ++$b2.'. '.$value.'<br />';
                }
                $table_ques .='<tr><td>'.$question_count.'.</td><td>'.$mques.'</td><td>'.$mans.'</td><td>'.$SKILL.'</td><td>'.$ques["created_date"].'</td><td style="text-align: center"><a href="'.base_url().'emp-job-view-package-tool/'.$pkg_type_id.'-'.$pkg_id.'-'.$assign.'-'.$level.'-'.$tool.'-'.$q_id.'-'.$industries.'-'.$company.'" target="_blank"><button class="btn btn-info  dim new-button-view" type="button"><i class="fa fa-eye"></i> </button></a> <a href="'.base_url().'emp-job-edit-package-tool/'.$pkg_type_id.'-'.$pkg_id.'-'.$assign.'-'.$level.'-'.$tool.'-'.$q_id.'-'.$industries.'-'.$company.'" target="_blank"><button class="btn btn-primary dim new-button-view" type="button"><i class="fa fa-edit"></i></button></a> <a data-value="'. $url_segment.'-'.$q_id.'" class="delete_question"></a></td></tr>';
                $question_count++; 
            }
            break;
        case 8:
            $data['tool_name']='Bucket Create';
            $table_name1 = 'mm_bucket';
            $page_link1[] = 'create-bucket';
            $question = $this->Crud_modal->all_data_select('*',$table_name1,"topic='$topic' and case_id=0 and bucket_status=1",'topic');
            $tool_heading='Bucket Question';
            $table_ques .='<tr style="background-color: #d6e0f3e0;"><td style="border:none;width:4%"></td><td style="padding-top: 2px; border:none;"><h4 style="color: #021423;font-size:12px;font-weight:600">'.$tool_heading.'</h4></td><td style="border:none;"></td><td style="border:none;"></td><td style="border:none;"></td><td  style="text-align: right; padding-top: 13px; border:none;" ><a href="'.base_url().'emp-job-package-tool/'.$pkg_type_id.'-'.$pkg_id.'-'.$assign.'-'.$level.'-'.$tool.'-'.$industries.'-'.$company.'"  target="_blank" style="color:#021423;font-size:12px;font-weight:600">+Add Question</a></td></tr>';
            foreach ($question as $ques) {
                $q_id=rtrim(strtr(base64_encode($ques['bucket_id']), '+/', '-_'), '=');
                $s=$ques["skill_tested"];
                $SKILL="";
                if($comp==0){
                    $r=$this->Crud_modal->fetch_single_data('skills_id,skills_name','master_skills_test',"skills_id='$s'");
                    $SKILL=$r["skills_name"];
                }else{
                    $r=$this->Crud_modal->fetch_single_data('emp_skill_id,skill_name','mm_employer_skill',"emp_skill_id='$s'");
                    $SKILL=$r["skill_name"];
                }
                $c=1; $ca = explode('@|', $ques['bucket_answer']); $buck_ans="";
                foreach ($ca as $cas){
                    $buck_ans.= $c . '. ' .$cas . '<br />'; $c++;
                }
                $table_ques .='<tr><td>'.$question_count.'.</td><td>'.$ques["bucket_question"].'</td><td>'.$buck_ans.'</td><td>'.$SKILL.'</td><td>'.$ques["created_date"].'</td><td><a href="'.base_url().'emp-job-view-package-tool/'.$pkg_type_id.'-'.$pkg_id.'-'.$assign.'-'.$level.'-'.$tool.'-'.$q_id.'-'.$industries.'-'.$company.'" target="_blank"><button class="btn btn-info  dim new-button-view" type="button"><i class="fa fa-eye"></i> </button></a> <a href="'.base_url().'emp-job-edit-package-tool/'.$pkg_type_id.'-'.$pkg_id.'-'.$assign.'-'.$level.'-'.$tool.'-'.$q_id.'-'.$industries.'-'.$company.'" target="_blank"><button class="btn btn-primary dim new-button-view" type="button"><i class="fa fa-edit"></i></button></a> <a data-value="'. $url_segment.'-'.$q_id.'" class="delete_question"></a></td></tr>';
                             
                $question_count++; 
            }
            break;
        case 14:
            $data['tool_name']='D-MCQ Create';
            $table_name1 = 'mcq';
            $page_link1[] = 'create-mcq';
            $question=$this->Crud_modal->all_data_select('*',$table_name1,"topic='$topic' and case_id=0 and mcq_status=1",'topic');
            $tool_heading='D-MCQ Question';
            $table_ques .='<tr style="background-color: #d6e0f3e0;"><td style="border:none;width:4%"></td><td style="padding-top: 2px; border:none;"><h4 style="color: #021423;font-size:12px;font-weight:600">'.$tool_heading.'</h4></td><td style="border:none;"></td><td style="border:none;"></td><td style="border:none;"></td><td style="text-align: right; padding-top: 13px; border:none;"><a href="'.base_url().'emp-job-package-tool/'.$pkg_type_id.'-'.$pkg_id.'-'.$assign.'-'.$level.'-'.$tool.'-'.$industries.'-'.$company.'"  target="_blank" style="color:#021423;font-size:12px;font-weight:600">+Add Question</a></td></tr>';
            
            foreach ($question as $ques) {
                $s=$ques['skill_tested'];
                $q_id=rtrim(strtr(base64_encode($ques['mcq_id']), '+/', '-_'), '=');
                $SKILL="";
                if($comp==0){
                    $r=$this->Crud_modal->fetch_single_data('skills_id,skills_name','master_skills_test',"skills_id='$s'");
                    $SKILL=$r["skills_name"];
                }else{
                    $r=$this->Crud_modal->fetch_single_data('emp_skill_id,skill_name','mm_employer_skill',"emp_skill_id='$s'");
                    $SKILL=$r["skill_name"];
                }
                $table_ques .='<tr><td>'.$question_count.'.</td><td>'.$ques["question"].'</td><td>'.$ques["c_answer"].'</td><td>'.$SKILL.'</td><td>'.$ques["created_date"].'</td><td style="text-align: center"><a href="'.base_url().'emp-job-view-package-tool/'.$pkg_type_id.'-'.$pkg_id.'-'.$assign.'-'.$level.'-'.$tool.'-'.$q_id.'-'.$industries.'-'.$company.'" target="_blank"><button class="btn btn-info  dim new-button-view" type="button"><i class="fa fa-eye"></i> </button></a> <a href="'.base_url().'emp-job-edit-package-tool/'.$pkg_type_id.'-'.$pkg_id.'-'.$assign.'-'.$level.'-'.$tool.'-'.$q_id.'-'.$industries.'-'.$company.'" target="_blank" style="margin-left: 3px;"><button class="btn btn-primary dim new-button-view" type="button"><i class="fa fa-edit"></i></button></a> <a data-value="'. $url_segment.'-'.$q_id.'" class="delete_question"></a></td></tr>';
                $question_count++; 
            }
            break;
    }//switch ends here
    echo $table_ques;
  }else{                  
    redirect(base_url().'employer','refresh');
  }
}
public function emp_job_edit_package_tool(){
    $id = explode('-',$this->uri->segment(2));
    $pkg_type_id=$id[0];
    $package_id = $id[1];
    $assign_id = $id[2];
    $level_id = $id[3];
    $tool_id = $id[4];
    $case_tol_id ='';
    $data['package_id']=$package_id;
    $data['package_type_id']=$pkg_type_id;
    $data['is_redirect']=1;
    if(count($id)==6){
        $case_tol_id = $id[5]; 
    }
    $comp_id=0; $indus_id=0;
    if($tool_id==4){
        $ques_id = base64_decode(str_pad(strtr($id[6], '-_', '+/'), strlen($id[6]) % 4, '=', STR_PAD_RIGHT));
        $indus_id = $id[7];
        $comp_id = $id[8];
    }else{
        $ques_id = base64_decode(str_pad(strtr($id[5], '-_', '+/'), strlen($id[5]) % 4, '=', STR_PAD_RIGHT));
        $indus_id = $id[6];
        $comp_id = $id[7];
    }
    $lev=base64_decode(str_pad(strtr($level_id, '-_', '+/'), strlen($level_id) % 4, '=', STR_PAD_RIGHT));
    $toolid=base64_decode(str_pad(strtr($tool_id, '-_', '+/'), strlen($tool_id) % 4, '=', STR_PAD_RIGHT));
    $top=$this->Crud_modal->fetch_single_data('d_level,skills,level_type','master_level',"ml_id=$lev");
    $where = 'status =1';
    $data['employer']=$this->Crud_modal->fetch_single_data('employer_id,employer_company,employer_industry_id','mm_employer','employer_id='.$this->session->userdata('employer_id'));   
    $pac_skill = explode(',',$top['skills']);
    $compid = base64_decode(str_pad(strtr($comp_id, '-_', '+/'), strlen($comp_id) % 4, '=', STR_PAD_RIGHT));
    if($compid==0){
        for($s=0; $s<count($pac_skill); $s++){
            $sid = $pac_skill[$s];
            $skill_sql =  $this->Crud_modal->fetch_single_data("skills_id,skills_name","master_skills_test","skills_id='$sid'","skills_id"); 
            $data['master_skills_tests'][$s]['skills_id'] = $skill_sql['skills_id'];
            $data['master_skills_tests'][$s]['skills_name'] = $skill_sql['skills_name'];
        }
    }else{
        for($s=0; $s<count($pac_skill); $s++){
            $sid = $pac_skill[$s];
            $skill_sql =  $this->Crud_modal->fetch_single_data("emp_skill_id,skill_name","mm_employer_skill","emp_skill_id='$sid'","emp_skill_id"); 
            $data['master_skills_tests'][$s]['skills_id'] = $skill_sql['emp_skill_id'];
            $data['master_skills_tests'][$s]['skills_name'] = $skill_sql['skill_name'];
        }
    }
    $pkgId = base64_decode(str_pad(strtr($package_id, '-_', '+/'), strlen($package_id) % 4, '=', STR_PAD_RIGHT));
    $whereall = 'status =1 and diffi_id='.$top['d_level'];
    $data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$whereall,'diffi_id desc');
    $data['pack_data'] = $this->Crud_modal->fetch_single_data('package_id,package_name','mm_packages',"package_id=$pkgId");
    $data['packages_id']=$package_id;
    $data['indus_id']=$indus_id;
    
    $data['topic_id']=$tid=$top['level_type'];
    $data['master_topics'] = $this->Crud_modal->fetch_single_data('t_id,t_name','master_topic',"status=1 and t_id=$tid");
    $data['url_id']=$this->uri->segment(2);

    $data['company_id']=$comp_id;
    $data['pack_type_id']=$pkg_type_id;
        
    switch($toolid) {
        case 1:
            $data['tool_name']='Edit MCQ';
            $table_name1 = 'mcq';
            $page_link1[] = 'create-mcq';
            $page_name='emp_edit_mcq';
            $data['mcq']=$this->Crud_modal->fetch_single_data("*","mcq","mcq_id=$ques_id");
            break;
        case 2:
            $data['tool_name']='Edit Sequence';
            $table_name1 = 'sequence_questions';
            $page_link1[] = 'create-sequence';
            $page_name='emp-edit-sequence-tool';
            $data['sequence_data'] = $this->Crud_modal->all_data_select('*','sequence_questions',"sq_id=$ques_id",'sq_id');
            break;
        case 3:
            $data['tool_name']='Edit Match the following';
            $table_name1 = 'match_the_following';
            $page_link1[] = 'match-the-following';
            $page_name='emp-edit-match-tool';
            $data['matchdata'] = $this->Crud_modal->fetch_single_data('*','match_the_following',"match_id=$ques_id");
            break;
        case 8:
            $data['tool_name']='Edit Bucket';
            $table_name1 = 'mm_bucket';
            $page_link1[] = 'create-bucket';
            $page_name='emp-edit-bucket-tool';
            $data['bucketdata'] = $this->Crud_modal->fetch_single_data('*','mm_bucket',"bucket_id=$ques_id");
            break;
         case 14:
            $data['tool_name']='Edit D-MCQ';
            $table_name1 = 'mcq';
            $page_link1[] = 'create-mcq';
            $page_name='emp_edit_mcq';
            $data['mcq']=$this->Crud_modal->fetch_single_data("*","mcq","mcq_id=$ques_id");
            break;
    }
    $this->load->view('employertempletes/head');
    $this->load->view('employertempletes/header'); 
    $this->load->view('employertempletes/sidebar');
    $this->load->view('refill-header-new', $data);
    // page for tool
    $this->load->view($page_name, $data);
    //end here
    $this->load->view('refill-footer-new', $data);
    $this->load->view('employertempletes/footer');
}
public function emp_job_view_package_tool(){
    $id = explode('-', $this->uri->segment(2));
    $pkg_type_id=$id[0];
    $package_id = $id[1];
    $assign_id = $id[2];
    $level_id = $id[3];
    $tool_id = $id[4];
    $case_tol_id ='';
    $data['package_id']=$package_id;
    $data['package_type_id']=$pkg_type_id;
    $data['is_redirect']=1;
    if(count($id)==6){
        $case_tol_id = $id[5]; 
    }
    /******************/
    if($tool_id==4){
        $ques_id = base64_decode(str_pad(strtr($id[6], '-_', '+/'), strlen($id[6]) % 4, '=', STR_PAD_RIGHT));
        $indus_id = $id[7];
        $comp_id = $id[8];
    }else{
        $ques_id = base64_decode(str_pad(strtr($id[5], '-_', '+/'), strlen($id[5]) % 4, '=', STR_PAD_RIGHT));
        $indus_id = $id[6];
        $comp_id = $id[7];
    }
    $lev=base64_decode(str_pad(strtr($level_id, '-_', '+/'), strlen($level_id) % 4, '=', STR_PAD_RIGHT));
    $pkg_type=base64_decode(str_pad(strtr($pkg_type_id, '-_', '+/'), strlen($pkg_type_id) % 4, '=', STR_PAD_RIGHT));
    $compid=base64_decode(str_pad(strtr($comp_id, '-_', '+/'), strlen($comp_id) % 4, '=', STR_PAD_RIGHT));
    $indusid=base64_decode(str_pad(strtr($indus_id, '-_', '+/'), strlen($indus_id) % 4, '=', STR_PAD_RIGHT));
    $toolid=base64_decode(str_pad(strtr($tool_id, '-_', '+/'), strlen($tool_id) % 4, '=', STR_PAD_RIGHT));

    $where = 'status =1';
    $data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$where,'type_id desc');
    $data['master_industries'] = $this->Crud_modal->all_data_select('industry_id,industry_name','mm_master_industry_topic','status=1', 'industry_id DESC');
    $data['packages'] = $this->Crud_modal->all_data_select('package_id,package_name','mm_packages',"company_id=$compid and pack_type_id=$pkg_type and status=1", 'package_id DESC');
    $data['packages_id']=$package_id;
    $data['indus_id']=$indus_id;
    $data['url_id']=$this->uri->segment(2);
    $data['company_id']=$comp_id;
    $data['pack_type_id']=$pkg_type_id;
    $data['master_companies'] = $this->Crud_modal->all_data_select('employer_id,employer_company','mm_employer','employer_status=1 and employer_industry_id='.$indusid, 'employer_id DESC');
    
    $data['employer']=$this->Crud_modal->fetch_single_data('*','mm_employer','employer_id='.$this->session->userdata('employer_id'));   
    switch($toolid) {
        case 1:
            $table_name1 = 'mcq';
            $where = "mcq_id = '$ques_id'";
            $data['tool_name']='MCQ Question';
            $data['mcq'] = $this->Crud_modal->fetch_single_data('*','mcq',$where);
            $page_name = 'emp-view-mcq';
            break;
        case 2:
            $table_name1 = 'sequence_questions';
            $data['tool_name']='Sequence Question';
            $page_name = 'emp-view-sequence-tool';
            $where = "sq_id = '$ques_id'";
            $data['sqdata'] = $this->Crud_modal->fetch_single_data('*','sequence_questions',$where);
            break;
        case 3:
            $table_name1 = 'match_the_following';
            $data['tool_name']='Match of the following Question';
            $page_name = 'emp-view-match-tool';
            $where="match_id='$ques_id'";
            $data['matchdata'] = $this->Crud_modal->fetch_single_data('*','match_the_following',$where);
            break;
        case 8:
            $table_name1 = 'mm_bucket';
            $data['tool_name']='Bucket Question';
            $page_name = 'emp-view-bucket-tool';
            $where = "bucket_id = '$ques_id'";
            $data['bucket'] = $this->Crud_modal->fetch_single_data('*','mm_bucket',$where);
            break;
         case 14:
            $table_name1 = 'mcq';
            $where = "mcq_id = '$ques_id'";
            $data['tool_name']='D-MCQ Question';
            $data['mcq'] = $this->Crud_modal->fetch_single_data('*','mcq',$where);
            $page_name = 'emp-view-mcq';
            break;
    }
    $this->load->view('employertempletes/head');
    $this->load->view('employertempletes/header'); 
    $this->load->view('employertempletes/sidebar');
    $this->load->view('refill-header-new', $data);
    $this->load->view($page_name, $data);
    $this->load->view('refill-footer-new', $data);
    $this->load->view('employertempletes/footer');                        
}



}

