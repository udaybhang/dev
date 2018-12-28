<?php


/**
* 
*/
class Job_package extends MX_Controller
{
    
    function __construct()
    {
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

    public function create_job_package(){
    if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $data['employer']=$emp=$this->Crud_modal->fetch_single_data('*','mm_employer','employer_id='.$this->session->userdata('employer_id'));
        $cmp_id=$emp['employer_id'];
        $indus_id=$emp['employer_industry_id'];
        $wheretype = 'status = "1"';
        $data['types'] = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$wheretype,'t_id desc');
        $data['skills'] = $this->Crud_modal->all_data_select('emp_skill_id,skill_name','mm_employer_skill',"status=1 and cmp_id=$cmp_id and indus_id=$indus_id",'emp_skill_id desc');
        $data['typelists']=$this->Crud_modal->all_data_select('id,name','master_level_type',$wheretype."and id in(14)",'id desc');
        $data['dlevels']=$this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$wheretype,'diffi_id');
        //$data['pack_type_list']=$this->Crud_modal->all_data_select('pack_type_id,pack_type_name','mm_master_package_type',"status=1 and company_type=1",'pack_type_id asc');
        $ptype = 6;
        $data['pack_type_id']=6;
        $data['package_data'] =$this->Crud_modal->all_data_select('package_id,package_name,industry_id,company_id,ma_id','mm_packages',"industry_id='$indus_id' and company_id='$cmp_id' and pack_type_id='$ptype' and status='2'",'package_id desc'); 
        
        $data['package_data_preview'] =$this->Crud_modal->all_data_select('package_id,package_name,industry_id,company_id,ma_id','mm_packages',"industry_id='$indus_id' and company_id='$cmp_id' and pack_type_id='$ptype'",'package_id desc');
        #######new package ##############
        $field="mmp.package_id,mmp.ma_id,mmp.package_name,mmp.industry_id,mmp.company_id";
        $table_name="mm_packages as mmp";
        $join1[0]='master_level as ml';
        $join1[1]='mmp.package_id=ml.pack_id';
        $join1[2]="left";
        $where="mmp.status=2 and mmp.industry_id='$indus_id' and mmp.company_id='$cmp_id' and mmp.pack_type_id='$ptype' GROUP BY mmp.package_id having count(ml.ml_id)=0";
        $data['package_datas']=$package_datas=$this->Crud_modal->fetch_data_by_one_table_join($field,$table_name,$join1,$where);
        #######new package ##############

        //$data['package_data_level']
        $data['assessment_params_list']=$this->Crud_modal->all_data_select('p_id,name,method','master_parameter',$wheretype,'p_id asc');
        $this->load->view('employertempletes/head',$data); 
        $this->load->view('employertempletes/header',$data);
        $this->load->view('create-job-package',$data); 
        $this->load->view('employertempletes/footer',$data);
        $this->load->view('employertempletes/sidebar',$data);
    }else{                   
        redirect(base_url().'employer','refresh');
    }
}

public function job_package_data_insert(){
 if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
    $super_user = $this->session->userdata('super_user_type');
    $company_id = $this->session->userdata('employer_id');
    $super_user='3';
    $pac_name = $this->input->post('package_name');
    $pack_type_id = $this->input->post('pack_type');
    $inid = $this->input->post('industries');
    $skillarray = implode(',', $this->input->post('skills')); 
    $check_c = $this->input->post('checkcompany');
    
    if($pac_name !='' && $company_id !='' && $skillarray !=''){
        $field=array(
            'package_name'=> $this->input->post('package_name'),
            'validity'=> $this->input->post('validity'),
            'assign_count'=> $this->input->post('assign_count'),
            'skills'=> $skillarray,
            'industry_id' => $this->input->post('industries'),
            'status'=> $this->input->post('pkg_status'),
            'company_id'=> $company_id,
            'pack_type_id'=> $pack_type_id,
            'super_user_type'=> $super_user,
            'created_date' =>date('Y-m-d H:i:s')
        ); 

        $orderby= 'package_id ASC';
        $where1 = "package_name = '$pac_name' and status !=0";
        $data1 = $this->Crud_modal->all_data_select('*','mm_packages',$where1,$orderby);
        if($data1){
            echo 0;   
        }else{
                $check_insert=$this->Crud_modal->data_insert_returnid('mm_packages',$field);
                if($check_insert){ 
                    ##############new assignment ###################
                    $assign_count= $this->input->post('assign_count');
                    $package_id = $check_insert;
                        $assign_date = date('Y-m-d H:i:s');
                        if($this->Admindashboard_modal->total_assign_id()){
                            $data['totalid']=$this->Admindashboard_modal->total_assign_id();
                            $newid = intval(str_replace("AS-","",$data['totalid']['mas_id']))+1; 
                            $mas_id = "AS-$newid";
                        }else{
                            $mas_id = 'AS-101';
                        }
                        $ran_val = rand(111111,999999);
                        $field=array(
                            'pack_id'=> $package_id,
                            'assignment_name' => "Assignment -".$pac_name,
                            'created_date' => $assign_date,
                            'created_by' => $this->session->userdata('employer_id'),
                            'number_of_level' => $this->input->post("no_level"),
                            'mas_id' => $mas_id,
                            'ran_val' => $ran_val,
                            'type' => "Automatic",
							'image'=>"test-series.jpg"
                        );
                        $assign_name = "Assignment -".$pac_name;
                        if($assign_name){          
                            $inserted_id=$this->Crud_modal->data_insert_returnid('master_assignment',$field);
                        }else{
                            $inserted_id=$this->Crud_modal->data_insert_returnid('master_assignment',$field);
                        }
                   
                    if(($inserted_id)>0){
                        $update_field=array(
                            'ma_id'=> $inserted_id,
                            'modified_by' => $this->session->userdata('employer_id'),
                            'modified_date' => date('Y-m-d H:i:s'),
                        );
                        $where = "package_id = '$package_id'";
                        $updateid = $this->Crud_modal->update_data($where,'mm_packages',$update_field);
                        $n_level=$this->input->post("no_level");
                        /////yoga day ///////
                        for($k=0;$k<$n_level;$k++){
                        $topicarray = array(
                                'created_date'=>date('Y-m-d H:i:s'),
                                'created_by'=>$this->session->userdata('employer_id'),
                                'status'=>1
                        );
                        $topic_id = $this->Crud_modal->data_insert_returnid('master_topic',$topicarray);
                        $created_data=array(
                        "created_date"=>date('Y-m-d H:i:s'),
                        "pack_id"=>$package_id,
                        "maid"=>$inserted_id,
                        "level_type"=>$topic_id,
                        'created_by' => $this->session->userdata('employer_id')
                        );
                        $inserted_ml_id = $this->Crud_modal->data_insert_returnid('master_level',$created_data);
                        $updateid1=$this->Crud_modal->data_insert_returnid('instruction_widget',array('level_id'=>$inserted_ml_id));    
                        }   
                        /////yoga day end /////
                        if($updateid){ echo 1; }else{ echo 0; }
                    }else{
                        echo 0;
                    }
                    ##############new assignment ###################
                    }else{
                    echo "2";
                     }
        }

    } // condition check end here
    else{ echo 2; }
  }else{ redirect(base_url().'employer','refresh'); }
}
public function employer_get_package_assignment(){
    $package_id=$this->input->post("package_id");
    $assignment=$this->Crud_modal->all_data_select("maid,assignment_name,number_of_level","master_assignment","pack_id=$package_id","maid desc");
    echo "<option value=''>Select Assignment</option>";
    for($i=0;$i<sizeof($assignment);$i++){
        echo "<option value='".$assignment[$i]['maid']."'>".$assignment[$i]['assignment_name']."</option>";
    }
}
public function job_get_industries_company_map_package(){
  if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
    $inds = $this->input->post('ID');
    $cmp = $this->input->post('cmp_id');
    $ptype = $this->input->post('package_type');
    $package_data =$this->Crud_modal->all_data_select('package_id,package_name,industry_id,company_id','mm_packages',"industry_id='$inds' and company_id='$cmp' and pack_type_id=$ptype",'package_id desc');
    echo '<option value="0">Select Package Name</option>';
    foreach($package_data as $packagedata){
        echo '<option value="'.$packagedata["package_id"].'">'.$packagedata["package_name"].'</option>';                                
    }
  }else{   redirect(base_url().'employer','refresh'); }
}

public function job_get_package_data(){
  if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
    $package_id = $this->input->post('ID');
    $check = $this->Crud_modal->fetch_single_data('count(pack_id) as total','master_assignment',"pack_id='$package_id'");
    $package_data = $this->Crud_modal->fetch_single_data('assign_count','mm_packages',"package_id='$package_id'");
    if($check['total']==$package_data['assign_count']){
        echo "0";
    }else{
        echo $package_data['assign_count']; 
    }
  }else{                    
    redirect(base_url().'employer','refresh');
  }
}

public function job_assignment_data_insert(){
  if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
    $assign_count = $this->input->post('assignn_count');
    $package_id = $this->input->post("package_id");
    for($i=1; $i<=$assign_count; $i++){
        $assign_date = date('Y-m-d H:i:s');
        if($this->Admindashboard_modal->total_assign_id()){
            $data['totalid']=$this->Admindashboard_modal->total_assign_id();
            $newid = intval(str_replace("AS-","",$data['totalid']['mas_id']))+1; 
            $mas_id = "AS-$newid";
        }else{
            $mas_id = 'AS-101';
        }
        $ran_val = rand(111111,999999);
        $field=array(
            'pack_id'=> $package_id,
            'assignment_name' => $this->input->post("assignment_name".$i),
            'assignment_description' => $this->input->post("assignment_description".$i),
            'created_date' => $assign_date,
            'created_by' => $this->session->userdata('employer_id'),
            'number_of_level' => $this->input->post("no_level".$i),
            'mas_id' => $mas_id,
            'ran_val' => $ran_val,
            'type' => $this->input->post("ass_type".$i),
        );
        $assign_name = $this->input->post("assignment_name".$i);
        $res=false; $new_name="";
        if(isset($_FILES["assignment_image".$i]) && $_FILES["assignment_image".$i]['name'] != ''){
            $file1 = $this->Admindashboard_modal->ddoo_upload("assignment_image".$i,0,'./upload/assignment');
            $filename= $_FILES["assignment_image".$i]["name"];
            $file_ext = pathinfo($filename,PATHINFO_EXTENSION);
            $new_name = $file1["upload_data"]["file_name"];
            $res=true;  
        }
        if($res){          
            $field['image'] = $new_name; 
            $inserted_id[$i-1] = $this->Crud_modal->data_insert_returnid('master_assignment',$field);
        }else{
            $inserted_id[$i-1] = $this->Crud_modal->data_insert_returnid('master_assignment',$field);
        }
    }
    if(count($inserted_id)>0){
        $id = implode(',',$inserted_id);
        $update_field=array(
            'ma_id'=> $id,
            'modified_by' => $admin_id,
            'modified_date' => date('Y-m-d H:i:s'),
        );
        $where = "package_id = '$package_id'";
        $updateid = $this->Crud_modal->update_data($where,'mm_packages',$update_field);
        if($updateid){ echo 1; }else{ echo 0; }
    }else{
        echo 0;
    }
  }else{                  
    redirect(base_url().'employer','refresh');
  }
}

public function job_get_package_assignment(){
    $package_id=$this->input->post("package_id");
    $assignment=$this->Crud_modal->all_data_select("maid,assignment_name,number_of_level","master_assignment","pack_id=$package_id","maid desc");
   echo "<option value=''>Select Assignment</option>";
    for($i=0;$i<sizeof($assignment);$i++){
        echo "<option value='".$assignment[$i]['maid']."'>".$assignment[$i]['assignment_name']."</option>";
    }
}

public function job_count_total_instruction(){
    $id=$this->input->post("assignment_id");
    $total_level = $this->Crud_modal->fetch_single_data('number_of_level','master_assignment',"maid=$id and status=1");
    $total_instruction = $this->Crud_modal->fetch_single_data('count(instruction_id) as total','instruction_widget',"assign_id=$id and status=1");
    if($total_level['number_of_level']==$total_instruction["total"]){
        echo 0;
    }else{
        echo 1;
    }
}

public function job_get_instruction_tool_id(){
    $id=$this->input->post("instruction_id");
    $data = $this->Crud_modal->fetch_single_data('instruction_id,tool_id','instruction_widget',"instruction_id=$id");
    if($data['tool_id']!=""){ echo trim($data['tool_id']); }else{ echo 0; }
}

function job_get_instruction_template(){
    $tid = $this->input->post('tool_id');
    $data = $this->Crud_modal->all_data_select('instruction_temp_id,instruction_temp_name','instruction_widget_template',"tool_id=$tid and status=1",'instruction_temp_id');
    echo "<option value='0' selected>Choose Template</option>";
    for($i=0; $i<count($data); $i++){
        echo '<option value='.$data[$i]["instruction_temp_id"].'>'.$data[$i]["instruction_temp_name"].'</option>';
    }
    
}

function job_get_instruction_template_data(){
    $tid = $this->input->post('temp_id');
    $data["template"] = $this->Crud_modal->fetch_single_data('*','instruction_widget_template',"instruction_temp_id=$tid");
    echo json_encode($data);
}

public function job_get_assign_instruction(){
    $pid=$this->input->post("package_id");
    $aid=$this->input->post("assignment_id");
    $newdata = $this->Crud_modal->all_data_select('instruction_id,instruction_name','instruction_widget',"pack_id=$pid and status=1 and assign_id=$aid",'instruction_id');
    echo "<option value=''>Select Instruction</option>";
    for($i=0;$i<sizeof($newdata);$i++){
        echo "<option value='".$newdata[$i]['instruction_id']."'>".$newdata[$i]['instruction_name']."</option>";
    }
}


public function job_save_levels(){
    if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $package_id = $this->input->post('package');

        // $level_check=$this->Crud_modal->check_numrow("master_level","pack_id='$package_id'");
        // $ass_check=$this->Crud_modal->fetch_single_data("number_of_level","master_assignment","pack_id='$package_id'");
        // if($level_check==$ass_check['number_of_level']){
        //     echo "1";
        //     $this->session->set_flashdata('level_insert_message','<div class="danger"><strong>Sorry!</strong> You have not selected any assignment.</div>');
        //     return 1;
        // } 
	
        $industry_id = $this->input->post('industry_l');
        $assign_id = $this->input->post('assignment');
        $lvl_name = $this->input->post('level_name');
        $level_ins = $this->input->post('level_ins');
        $level_type = $this->input->post('level_type');
        $time_limit = $this->input->post('time_limit');
        $level_topic = $this->input->post('level_topic');
		
        $level_skills = $this->input->post("level_skills");
        $diff_level = $this->input->post('diff_level');
        $total_time= array_sum($time_limit);
        $total_marks=array_sum($diff_level);
        $update_pack=$this->Crud_modal->update_data("package_id='$package_id'","mm_packages",array("total_marks"=>$total_marks,"total_time"=>$total_time));
        $q_limt = $this->input->post('q_limt');
        $description_key = $this->input->post('description_key');
        $key = $this->input->post('key');
        $assign_type = $this->input->post('assignment_type');
        $p_ids =1;
        $data_level=$this->Crud_modal->all_data_select("ml_id,maid,pack_id,inst_id,lvl_name,q_limit,MINUTE(time_limit) as time,skills,m_type,d_level,level_type","master_level","pack_id='$package_id '","ml_id ASC");
       
        if(!empty($lvl_name)){
            $countlevel = sizeof($lvl_name);
                for($i=0;$i<$countlevel;$i++){
                    $lev_type=$data_level[$i]['level_type'];
                    $lev_id=$data_level[$i]['ml_id'];
                    if(!empty($lvl_name[$i])){
                        $create_date = date('Y-m-d H:i:s');

                            $topic_name = $level_topic[$i];
                            if($topic_name!=''){
                            $topicarray = array(
                                't_name'=>$topic_name,
                                'created_date'=>date('Y-m-d H:i:s'),
                                'created_by'=>$this->session->userdata('employer_id'),
                                'status'=>1
                            );
                            $topic_id = $this->Crud_modal->update_data("t_id='$lev_type'",'master_topic',$topicarray);
                            }
                            
                            $createdata = array(
                                'maid' => $assign_id,
                                'lvl_name' => $lvl_name[$i],
                                'created_date' => $create_date,
                                'time_limit' => gmdate("H:i:s",$time_limit[$i]*60),
                                'd_level' => ($diff_level[$i]/$time_limit[$i]),
                                'skills' => $level_skills[$i],
                                'm_type' => $level_type[$i],
                                'q_limit' => $q_limt[$i],
                                'p_id' => 1
                                );
                         
                        $inserted_id = $this->Crud_modal->update_data("ml_id='$lev_id'",'master_level',$createdata);
                        $updateid1=$this->Crud_modal->update_data("level_id='$lev_id'",'instruction_widget',array("instruction_name"=>$level_ins[$i]));
                        }
                    }
                    $this->session->set_flashdata('level_insert_message','<div class="success"><strong>Success!</strong> Level has Inserted.</div>');
                    if($inserted_id>0){
                        echo "1";
                    }else{
                        echo "0";
                    }
                }else{
                    $this->session->set_flashdata('level_insert_message','<div class="danger"><strong>Sorry!</strong> You have not selected any assignment.</div>');
                    echo "0";
                }

       }else{                    
           redirect(base_url().'employer','refresh');
      }
}

public function job_get_assignment_maxcount_data(){
   if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $pack_id = $this->input->post('pack_id');
        $assign_data = $this->Crud_modal->fetch_single_data('number_of_level,type,maid','master_assignment',"pack_id='$pack_id'","maid ASC");
        $level_details=$this->Crud_modal->all_data_select('ml_id,maid,pack_id,inst_id,lvl_name,q_limit,MINUTE(time_limit) as time,skills,m_type,d_level,level_type','master_level',"pack_id='$pack_id'","ml_id ASC");
        $assign_id = $assign_data['maid'];
        $instruction_data =  $this->Crud_modal->all_data_select('instruction_id,instruction_name','instruction_widget',"assign_id='$assign_id'","instruction_id ASC");
        $diff_level_data =  $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',"status=1","diffi_id");
        $tool_type_data =  $this->Crud_modal->all_data_select('id,name','master_level_type',"status=1 and id in(14)","id ASC");
        $option_type="";
       $option_type.="<option value='0'>Select Tool</option>";
        for ($jj=0; $jj<sizeof($tool_type_data); $jj++) { 
            $option_type.= "<option value='".$tool_type_data[$jj]['id']."'>".$tool_type_data[$jj]['name']."</option>";
        }
        $pack_data = $this->Crud_modal->all_data_select('skills,company_id','mm_packages',"package_id='$pack_id'",'package_id');
        $p_skill = explode(',', $pack_data[0]['skills']);
        $pac_company = $pack_data[0]['company_id'];
        $option = '<option value="0">Select Skills</option>';
        if($pac_company==0){
             for($s=0; $s<count($p_skill); $s++){
                $skill_id = $p_skill[$s];
                  $result = $this->Crud_modal->fetch_single_data('skills_id,skills_name','master_skills_test',"skills_id='$skill_id'",'skills_id');
                 $option .= "<option value='".$result['skills_id']."'>".$result['skills_name']."</option>";
             }     
        }else{
            for($s=0; $s<count($p_skill); $s++){
                 $skill_id = $p_skill[$s]; 
                 $result = $this->Crud_modal->fetch_single_data('emp_skill_id,skill_name','mm_employer_skill',"emp_skill_id='$skill_id'",'emp_skill_id');
                 $option .= "<option value='".$result['emp_skill_id']."'>".$result['skill_name']."</option>";

            }   
        }
     
        $as_data = $assign_data["number_of_level"];
        $as_type = $assign_data["type"];
        $field="ml.*,lt.t_name";
        $table_name="master_level ml";
        $join1[0]="master_topic lt";
        $join1[1]="ml.level_type=lt.t_id";
        $join1[2]="left";
        $where="pack_id=$pack_id and maid=$assign_id";
        $levels = $this->Crud_modal->fetch_data_by_one_table_join($field,$table_name,$join1,$where);
        $check = $this->Crud_modal->fetch_single_data('count(ml_id) as total','master_level',"maid='$assign_id'");
        if($check['total']==$as_data){
            if(($this->input->post("sent_from"))!="" || ($this->input->post("sent_from"))=="edit_form"){
            }else{
                $as_data=0;
            }
        } 
        echo json_encode(['number_of_level'=>$assign_data['number_of_level'], 'ass_type'=>$as_type, 'ins_data'=>$instruction_data, 'skill_option'=>$option, 'diff_level_list'=>$diff_level_data, 'tool_type_list'=>$tool_type_data, 'level_list'=>$levels,'assign_id'=>$assign_id,'level_details'=>$level_details,'option_type'=>$option_type]);
    }else{                  
        redirect(base_url().'employer','refresh');
    }
 }

public function job_insert_level_instruction(){
    if(($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null)){
        $package_id= $this->input->post('instruction_package');
        $count = $this->input->post('disc_count');
        $tool_id = $this->input->post('choose_tool_type');
        $config['upload_path']= './upload/instruction/';
        $config['allowed_types']= 'gif|jpg|png';
        $date=date("Y-m-d h:i:s");
        $employer_id=$this->session->userdata('employer_id');
        $data_level=$this->Crud_modal->all_data_select("ml_id,maid,pack_id","master_level","pack_id='$package_id' and ml_status='1'","ml_id asc");
        for ($i=0;$i<sizeof($data_level);$i++){
            $file1 = $this->Admindashboard_modal->ddoo_upload("instruction_image".($i+1),0,'./upload/instruction');
            $filename= $_FILES["instruction_image".($i+1)]["name"];
            $file_ext = pathinfo($filename,PATHINFO_EXTENSION);
            $image= $file1["upload_data"]["file_name"];
            $data=array(
                'instruction_description'=>$this->input->post('img_class'.($i+1)),
                'instruction_image' =>$image,
                'instruction_desc'  =>$this->input->post('img_class'.($i+1)),
                'created_date'      =>$date,
                'modified_date'     =>$date,
                'status'            =>'1',
                'modified_by'       =>$employer_id,
                'pack_id'           =>$package_id,
                'video_url'         =>$this->input->post('instruction_video'.($i+1))
                );
                
            $level_id=$data_level[$i]['ml_id'];
            $data_return=$this->Crud_modal->update_data("level_id='$level_id'","instruction_widget",$data);
            $data_fetch_instruction=$this->Crud_modal->fetch_single_data('instruction_id','instruction_widget',"level_id='$level_id'");
            $data_lev_up=array("inst_id" =>$data_fetch_instruction['instruction_id']);
            $data_level_return=$this->Crud_modal->update_data("ml_id='$level_id'","master_level",$data_lev_up);
        }
        if($data_level_return=='1'){
           echo "1";
        }else{
           echo "0";
        }
    }else{
        redirect(base_url().'employer','refresh');
    }
}

public function job_get_instruction(){
    $pack_id=$this->input->post('package_id');
    
    ##########new code ##########################
    $field="ml.ml_id,ml.maid,ml.pack_id,iwt.instruction_description,iwt.instruction_image,iwt.video_url";
    $table_name="master_level as ml";
    $join1[0]='instruction_widget as iwt';
    $join1[1]='iwt.level_id=ml.ml_id';
    $join1[2]="left";
    $where="ml_status='1' and ml.pack_id='$pack_id'";
    $data_level=$this->Crud_modal->fetch_data_by_one_table_join($field,$table_name,$join1,$where);
   
    ##########new code ##########################
    //$data_level=$this->Crud_modal->all_data_select("ml_id,maid,pack_id","master_level","pack_id='$pack_id' and ml_status='1'","ml_id asc");
    //$data_inst=$this->Crud_modal->all_data_select("ml_id,maid,pack_id","master_level","pack_id='$pack_id' and ml_status='1'","ml_id asc");
    echo json_encode($data_level);
}

public function get_package_preview(){
    $pack_id=$this->input->post('package_id');
    $data['package_data']=$package_data = $this->Crud_modal->fetch_single_data('package_id,package_name,total_marks,skills,total_time,pack_type_id','mm_packages',"package_id='$pack_id'","package_id ASC");
    $skills=$package_data['skills'];
    if($skills!=''){
    $data['skills_data']=$this->Crud_modal->fetch_single_data("GROUP_CONCAT(skill_name) as skills_name","mm_employer_skill","emp_skill_id in($skills) and status='1'");
    }
    $data["encode_package_type"]=rtrim(strtr(base64_encode($package_data['pack_type_id']), '+/', '-_'), '=');
    $data["encode_package_id"]=rtrim(strtr(base64_encode($package_data['package_id']), '+/', '-_'), '=');

    $field="ml.lvl_name,ml.d_level,ml.time_limit,TIME_TO_SEC(ml.time_limit) as seconds,mtp.name,mst.skill_name,ml.q_limit";
    $table_name="master_level as ml";
    $join1[0]='mm_employer_skill as mst';
    $join1[1]='mst.emp_skill_id=ml.skills';
    $join1[2]="left";
    $join2[0]='master_level_type as mtp';
    $join2[1]='mtp.id=ml.m_type';
    $join2[2]="left";
    $where="ml_status='1' and ml.pack_id='$pack_id'";
    $data['level_data']=$level_data=$this->Crud_modal->fetch_data_by_two_table_join($field,$table_name,$join1,$join2,$where);
    if(sizeof($data['level_data'])<1){
        $data['status']=0;
        echo json_encode($data);    
    }else{
        $data['status']=1;
        echo json_encode($data);
    }
    
}

}