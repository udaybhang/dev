<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employer2 extends MX_Controller {	
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
		if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        }else{
            redirect(base_url().'employer','refresh');
        }
}
public function create_employer_package(){
    if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $data['employer']=$emp=$this->Crud_modal->fetch_single_data('*','mm_employer','employer_id='.$this->session->userdata('employer_id'));
        $cmp_id=$emp['employer_id'];
        $indus_id=$emp['employer_industry_id'];
        $wheretype = 'status = "1"';
        $data['types'] = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$wheretype,'t_id desc');
        $data['skills'] = $this->Crud_modal->all_data_select('emp_skill_id,skill_name','mm_employer_skill',"status=1 and cmp_id=$cmp_id and indus_id=$indus_id",'emp_skill_id desc');
        $data['typelists']=$this->Crud_modal->all_data_select('id,name','master_level_type',$wheretype."and id in(1,2,3,8)",'id desc');
        $data['dlevels']=$this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$wheretype,'diffi_id');
        $data['pack_type_list']=$this->Crud_modal->all_data_select('pack_type_id,pack_type_name','mm_master_package_type',"status=1 and company_type=1",'pack_type_id asc');
        $data['assessment_params_list']=$this->Crud_modal->all_data_select('p_id,name,method','master_parameter',$wheretype,'p_id asc');
        $this->load->view('employertempletes/head',$data); 
        $this->load->view('employertempletes/header',$data);
        $this->load->view('create-package',$data); 
        $this->load->view('employertempletes/footer',$data);
        $this->load->view('employertempletes/sidebar',$data);
    }else{                   
        redirect(base_url().'employer','refresh');
    }
}
public function employer_package_data_insert(){
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
            'total_marks'=> $this->input->post('total_neurons'),
            'total_time'=> $this->input->post('total_time'),
            'industry_id' => $this->input->post('industries'),
            'status'=> $this->input->post('pkg_status'),
            'description'=> $this->input->post('package_description'),
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
            $config['upload_path']          = './upload/package/';
            $config['allowed_types']        = 'gif|jpg|png';
            $new_name = time().$_FILES["package_image"]['name'];
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if($this->upload->do_upload('package_image')){   
                $file=$this->upload->data();
                $field['image'] =$new_name;
                if($this->Crud_modal->data_insert('mm_packages',$field)){ echo 1;  }else{echo "2"; }
            }
        }

    } // condition check end here
    else{ echo 2; }
  }else{ redirect(base_url().'employer','refresh'); }
}
public function employer_get_industries_company_map_package(){
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
public function employer_get_package_data(){
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
public function employer_assignment_data_insert(){
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
public function employer_get_package_assignment(){
    $package_id=$this->input->post("package_id");
    $assignment=$this->Crud_modal->all_data_select("maid,assignment_name,number_of_level","master_assignment","pack_id=$package_id","maid desc");
    echo "<option value=''>Select Assignment</option>";
    for($i=0;$i<sizeof($assignment);$i++){
        echo "<option value='".$assignment[$i]['maid']."'>".$assignment[$i]['assignment_name']."</option>";
    }
}
public function emp_count_total_instruction(){
    $id=$this->input->post("assignment_id");
    $total_level = $this->Crud_modal->fetch_single_data('number_of_level','master_assignment',"maid=$id and status=1");
    $total_instruction = $this->Crud_modal->fetch_single_data('count(instruction_id) as total','instruction_widget',"assign_id=$id and status=1");
    if($total_level['number_of_level']==$total_instruction["total"]){
        echo 0;
    }else{
        echo 1;
    }
}
public function emp_get_instruction_tool_id(){
    $id=$this->input->post("instruction_id");
    $data = $this->Crud_modal->fetch_single_data('instruction_id,tool_id','instruction_widget',"instruction_id=$id");
    if($data['tool_id']!=""){ echo trim($data['tool_id']); }else{ echo 0; }
}
function emp_get_instruction_template(){
    $tid = $this->input->post('tool_id');
    $data = $this->Crud_modal->all_data_select('instruction_temp_id,instruction_temp_name','instruction_widget_template',"tool_id=$tid and status=1",'instruction_temp_id');
    echo "<option value='0' selected>Choose Template</option>";
    for($i=0; $i<count($data); $i++){
        echo '<option value='.$data[$i]["instruction_temp_id"].'>'.$data[$i]["instruction_temp_name"].'</option>';
    }
    
}
function emp_get_instruction_template_data(){
    $tid = $this->input->post('temp_id');
    $data["template"] = $this->Crud_modal->fetch_single_data('*','instruction_widget_template',"instruction_temp_id=$tid");
    echo json_encode($data);
}
public function emp_get_assign_instruction(){
    $pid=$this->input->post("package_id");
    $aid=$this->input->post("assignment_id");
    $newdata = $this->Crud_modal->all_data_select('instruction_id,instruction_name','instruction_widget',"pack_id=$pid and status=1 and assign_id=$aid",'instruction_id');
    echo "<option value=''>Select Instruction</option>";
    for($i=0;$i<sizeof($newdata);$i++){
        echo "<option value='".$newdata[$i]['instruction_id']."'>".$newdata[$i]['instruction_name']."</option>";
    }
}
public function emp_is_case_exists(){
    $id=$this->input->post("level_id");
    $check = $this->Crud_modal->fetch_single_data('level_id','case_study',"level_id=$id and status=1");
    if($check['level_id']!=""){
        echo 0;
    }else{
        echo 1;
    }
}
public function emp_insert_level_instruction(){
    if(($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null)){ 
        $count = $this->input->post('disc_count');
        $tool_id = $this->input->post('choose_tool_type');
        $config['upload_path']          = './upload/instruction/';
        $config['allowed_types']        = 'gif|jpg|png';
                    
        for($i=0; $i<$count; $i++){
            if(isset($_FILES["instruction_image".($i+1)]) && $_FILES["instruction_image".($i+1)]['name'] != ''){
                $file1 = $this->Admindashboard_modal->ddoo_upload("instruction_image".($i+1),0,'./upload/instruction');
                $filename= $_FILES["instruction_image".($i+1)]["name"];
                $file_ext = pathinfo($filename,PATHINFO_EXTENSION);
                $image[$i] = $file1["upload_data"]["file_name"];
            }else{
                if($this->input->post('old_image'.($i+1))!="" || $this->input->post('old_image'.($i+1))!=null){
                    $image[$i] = $this->input->post('old_image'.($i+1));
                }
            }
            $desc = $this->input->post('image_discripton'.($i+1));
            if($desc !=""){
                $description[$i] = $this->input->post('image_discripton'.($i+1));
            }else{
                echo "0";
            }
        }
        $image_name = implode('||', $image);
       
        $image_discripton = implode('||', $description);
        $date=date("Y-m-d h:i:s");
        $employer_id=$this->session->userdata('employer_id');
        $data=array(
            'assign_id'=>$this->input->post('instruction_assign'),
            'pack_id'=>$this->input->post('instruction_package'),
            'instruction_description'=>'',
            'instruction_name'  =>$this->input->post('instruction_name'),
            'instruction_image' =>$image_name,
            'instruction_desc'  =>$image_discripton,
            'created_date'      =>$date,
            'modified_date'     =>$date,
            'status'            =>'1',
            'tool_id'           =>$tool_id,
            'modified_by'       =>$employer_id
        );
        $data_return=$this->Crud_modal->data_insert('instruction_widget',$data);
        if($data_return=='1'){
           echo "1";
        }else{
           echo "0";
        }
    }else{
        redirect(base_url().'employer','refresh');
    }
}
public function emp_get_assignment_maxcount_data(){
   if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $assign_id = $this->input->post('assign_id');
        $pack_id = $this->input->post('pack_id');
        $assign_data = $this->Crud_modal->fetch_single_data('number_of_level,type','master_assignment',"maid='$assign_id'","maid ASC");
        $instruction_data =  $this->Crud_modal->all_data_select('instruction_id,instruction_name','instruction_widget',"assign_id='$assign_id'","instruction_id ASC");
        $diff_level_data =  $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',"status=1","diffi_id");
        $tool_type_data =  $this->Crud_modal->all_data_select('id,name','master_level_type',"status=1 and id in(1,2,3,8)","id ASC");

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
        $where="pack_id=$pack_id and maid=$assign_id";
        $levels = $this->Crud_modal->fetch_data_by_one_table_join($field,$table_name,$join1,$where);

        $check = $this->Crud_modal->fetch_single_data('count(ml_id) as total','master_level',"maid='$assign_id'");
        if($check['total']==$as_data){
            if(($this->input->post("sent_from"))!="" || ($this->input->post("sent_from"))=="edit_form"){
            }else{
                $as_data=0;
            }
        }
        echo json_encode(['number_of_level'=>$as_data, 'ass_type'=>$as_type, 'ins_data'=>$instruction_data, 'skill_option'=>$option, 'diff_level_list'=>$diff_level_data, 'tool_type_list'=>$tool_type_data, 'level_list'=>$levels]);
    }else{                  
        redirect(base_url().'employer','refresh');
    }
 }
public function employer_save_levels(){
    if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $package_id = $this->input->post('package');
        $industry_id = $this->input->post('industry_l');
        $assign_id = $this->input->post('assignment');
        $lvl_name = $this->input->post('level_name');
        $level_ins = $this->input->post('level_ins');
        $level_type = $this->input->post('level_type');
        $time_limit = $this->input->post('time_limit');
        $level_topic = $this->input->post('level_topic');
        $level_skills = explode('|', $this->input->post("skill_array"));
        $diff_level = $this->input->post('diff_level');
        $q_limt = $this->input->post('q_limt');
        $description_key = $this->input->post('description_key');
        $key = $this->input->post('key');
        $start_date = $this->input->post('start_date');
        $start_time = $this->input->post('start_time');
        
        $assign_type = $this->input->post('assignment_type');
        $p_ids = explode('|', $this->input->post("param_array"));
        if(!empty($lvl_name)){
            $countlevel = sizeof($lvl_name);
                for($i=0;$i<$countlevel;$i++){
                    if(!empty($lvl_name[$i])){
                        $create_date = date('Y-m-d H:i:s');
                        if($assign_type == "manual" || $assign_type == "Manual"){
                            $topic_name = $level_topic[$i];
                            $topicarray = array(
                                't_name'=>$topic_name,
                                'created_date'=>date('Y-m-d H:i:s'),
                                'created_by'=>$this->session->userdata('employer_id'),
                                'status'=>1
                            );
                            $topic_id = $this->Crud_modal->data_insert_returnid('master_topic',$topicarray);
                            $createdata = array(
                                'maid' => $assign_id,
                                'lvl_name' => $lvl_name[$i],
                                'created_date' => $create_date,
                                'created_by' => $this->session->userdata('employer_id'),
                                'inst_id' => $level_ins[$i],
                                'time_limit' => $time_limit[$i],
                                'level_type' => $topic_id,
                                'd_level' => $diff_level[$i],
                                'skills' => $level_skills[$i],
                                'description' => $description_key[$i],
                                'key_competency_assessed' => $key[$i],
                                'start_date_time' => date('Y-m-d H:i:s',strtotime($start_date[$i].$start_time[$i])),
                                'pack_id' => $package_id,
                                'p_id' => $p_ids[$i]
                            );
                        }else{
                            $topic_name = $level_topic[$i];
                            $topicarray = array(
                                't_name'=>$topic_name,
                                'created_date'=>date('Y-m-d H:i:s'),
                                'created_by'=>$this->session->userdata('employer_id'),
                                'status'=>1
                            );
                            $topic_id = $this->Crud_modal->data_insert_returnid('master_topic',$topicarray);
                            $createdata = array(
                                'maid' => $assign_id,
                                'lvl_name' => $lvl_name[$i],
                                'created_date' => $create_date,
                                'created_by' => $this->session->userdata('employer_id'),
                                'inst_id' => $level_ins[$i],
                                'time_limit' => $time_limit[$i],
                                'level_type' => $topic_id,
                                'd_level' => $diff_level[$i],
                                'skills' => $level_skills[$i],
                                'm_type' => $level_type[$i],
                                'q_limit' => $q_limt[$i],
                                'description' => $description_key[$i],
                                'key_competency_assessed' => $key[$i],
                                'start_date_time' => date('Y-m-d H:i:s',strtotime($start_date[$i].$start_time[$i])),
                                'pack_id' => $package_id,
                                'p_id' => $p_ids[$i]
                                );
                            }
                        $inserted_id = $this->Crud_modal->data_insert_returnid('master_level',$createdata);
                        $updateid1=$this->Crud_modal->update_data("instruction_id=$level_ins[$i]",'instruction_widget',array('level_id'=>$inserted_id));
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
           redirect(base_url().'admin','refresh');
      }
}
public function employer_get_assign_level(){
    $pid=$this->input->post("package_id");
    $aid=$this->input->post("assignment_id");
    if(($this->input->post("sent_from"))!=""){
        $newdata = $this->Admindashboard_modal->get_case_level_details($pid,$aid);
    }else{
        $newdata = $this->Admindashboard_modal->get_level_details($pid,$aid);
    }
    echo "<option value=''>Select Level</option>";
    for($i=0;$i<sizeof($newdata);$i++){
        echo "<option value='".$newdata[$i]['ml_id']."@".trim($newdata[$i]['t_name'])."'>".$newdata[$i]['lvl_name']."</option>";
    }
 }
public function employer_insert_case(){
    if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
        $file = array();
        $filesCount = count($_FILES['caseFiles']['name']);
        $target_dir = './upload/case_sample_files/';
        for($i = 0; $i < $filesCount; $i++){
            if($_FILES['caseFiles']['name'][$i]!=''){
                $randname = rand(1111,9999);
                $target_file = $target_dir .$randname. basename($_FILES["caseFiles"]["name"][$i]);
                if (move_uploaded_file($_FILES["caseFiles"]["tmp_name"][$i], $target_file)) {
                    $file[]  = 'case_sample_files/'.$randname.basename($_FILES["caseFiles"]["name"][$i]);
                }else{
                    $this->session->set_flashdata('item','<div class="danger"><strong>Sorry!</strong> File Upload Error.</div>');
                    redirect(base_url().'add-case');
                }
            }
        }
        $filename = str_replace(' ', '-', (strtolower($this->input->post('case_name'))));
        $mp3file='';
        if($_FILES['audiofile']['name']!=''){
            if(pathinfo($_FILES['audiofile']['name'],PATHINFO_EXTENSION)=='mp3'){
                $mp3target_dir = './upload/case_sample_files/mediafile/';
                $mp3target_file = $mp3target_dir .$filename.'-'.basename($_FILES['audiofile']['name']);
                if (move_uploaded_file($_FILES['audiofile']['tmp_name'], $mp3target_file)) {
                    $mp3file  = 'case_sample_files/mediafile/'.$filename.'-'.basename($_FILES['audiofile']['name']);
                }else{
                    $this->session->set_flashdata('item','<div class="danger"><strong>Sorry!</strong> Audio File Upload Error.</div>');
                    redirect(base_url().'add-case');
                }
            }else{
                $this->session->set_flashdata('item','<div class="danger"><strong>Sorry!</strong> Upload only mp3 audio file.</div>');
                redirect(base_url().'add-case');
            }
        }
        $mp4file='';
        if($_FILES['videofile']['name']!=''){
            if(pathinfo($_FILES['videofile']['name'],PATHINFO_EXTENSION)=='mp4'){
                $mp4target_dir = './upload/case_sample_files/mediafile/';
                $mp4target_file = $mp4target_dir .$filename.'-'.basename($_FILES['videofile']['name']);
                if (move_uploaded_file($_FILES['videofile']['tmp_name'], $mp4target_file)) {
                    $mp4file  = 'case_sample_files/mediafile/'.$filename.'-'.basename($_FILES['videofile']['name']);
                }else{
                    $this->session->set_flashdata('item','<div class="danger"><strong>Sorry!</strong> Video File Upload Error.</div>');
                    redirect(base_url().'add-case');
                }
            }else{
                $this->session->set_flashdata('item','<div class="danger"><strong>Sorry!</strong> Upload only mp4 video file.</div>');
                redirect(base_url().'add-case');
            }
        }
        $sq=$this->input->post('arrng_case');
        for ($i=0;$i<sizeof($sq);$i++) {
            if($sq[$i]!=''){
                $arsq[] = $sq[$i];
            }
        }
        $qls=$this->input->post('quest_limit');
        foreach ($qls as $ql) {
            if($ql!=''){
                $sqlm[] = $ql;
            }
        }
        $data=array(
            'case_name'     =>$this->input->post('case_name'),
            'content'       =>$this->input->post('case_content'),
            'maid'      =>$this->input->post('case_assignment'),
            'level_id'  =>$this->input->post('case_level'),
            'case_sequence' =>implode(',',$arsq),
            'quest_limit'   =>implode(',', $sqlm),
            'sample_file'   =>implode(',', $file),
            'audiofile' =>$mp3file,
            'videofile' =>$mp4file,
            'created_date'  =>date("Y-m-d h:i:s"),
            'created_by'    =>$this->session->userdata('employer_id')
        );
        $this->Crud_modal->data_insert('case_study',$data);
        $this->session->set_flashdata('item','<div class="success"><strong>Success!</strong> Case has been Inserted successfully</div>');
        redirect(base_url().'create-employer-package#step-5');
                   
     }else{
        redirect(base_url().'employer','refresh');
    }    
}
public function refill_employer_package(){
  if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
    $data['employer']=$this->Crud_modal->fetch_single_data('*','mm_employer','employer_id='.$this->session->userdata('employer_id'));
    $data['pack_type_list']=$this->Crud_modal->all_data_select('pack_type_id,pack_type_name','mm_master_package_type',"status=1 and company_type=1",'pack_type_id asc');
    $this->load->view('employertempletes/head');
    $this->load->view('employertempletes/header'); 
    $this->load->view('employertempletes/sidebar');
    $this->load->view('refill-employer-package',$data);
    $this->load->view('employertempletes/footer');
  }else{                   
    redirect(base_url().'employer','refresh');
  }
}
public function emp_load_package_summary(){
  if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
    $id = $this->input->post('ID'); 
    $pack_type = $this->input->post('package_type'); 
    $where = "package_id = '$id'";
    $where1 = "pack_id = '$id'";
    $data['pack_data'] = $this->Crud_modal->fetch_single_data('package_id,package_name,total_marks,total_time,image','mm_packages',$where);
    $data['assignment']= $ass= $this->Crud_modal->all_data_select('maid,assignment_name,package_hrs','master_assignment',$where1,'maid'); 
    for($i=0;$i<sizeof($ass);$i++){
        $il=$ass[$i]['maid'];
        $newdata = $data['assignment'][$i]['levels'] = $this->Admindashboard_modal->get_level_details($id,$il);
        for($lev=0; $lev<sizeof($newdata); $lev++){
           $tool_id = $data['assignment'][$i]['levels'][$lev]['m_type'];
           $topic = $data['assignment'][$i]['levels'][$lev]['topic_id'];
           $level_id = $data['assignment'][$i]['levels'][$lev]['ml_id'];
           $table_name ="";

           if($data['assignment'][$i]['levels'][$lev]['name']==""){
                $data['assignment'][$i]['levels'][$lev]['name']="Subjective";
           }
            switch($tool_id) {
                case 1:
                    $tool='MCQ';
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
public function emp_get_assign_discription(){
  if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
    $pkg = $this->input->post('ID');
    $assing_data =$this->Crud_modal->all_data_select('*',"master_assignment","pack_id='$pkg'",'maid desc');
    echo json_encode(['assign_data'=>$assing_data]);
  }else{                   
    redirect(base_url().'employer','refresh');
  }
}
public function emp_get_level_question(){
  if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
    $pkg = explode('-', $this->input->post('ID'));
    $industries= $this->input->post('industry_id');
    if($industries==""){
        $indu = $this->Crud_modal->fetch_single_data('employer_industry_id','mm_employer',"employer_id=".$this->session->userdata('employer_id'));
        $industries=$indu["employer_industry_id"];
    }
    $company = $this->input->post('company_id');
    if($company==""){
      $company=  $this->session->userdata('employer_id');
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
    $case_id = $this->Crud_modal->fetch_single_data('case_id','case_study',"maid='$assign' and level_id='$level'");
    $topic_id = $this->Crud_modal->fetch_single_data('level_type','master_level',"maid='$assign' and ml_id='$level' and pack_id='$pkg_id'");

    $case =$case_id["case_id"];
    $topic= $topic_id["level_type"]; 
    $table_ques = '';
    $question_count =1;
    switch($tool) {
        case 1:
            $data['tool_name']='MCQ Create';
            $table_name1 = 'mcq';
            $page_link1[] = 'create-mcq';
            $question=$this->Crud_modal->all_data_select('*',$table_name1,"topic='$topic' and case_id=0 and mcq_status=1",'topic');
            $tool_heading='MCQ Question';
            $table_ques .='<tr style="background-color: #d6e0f3e0;"><td style="border:none;width:4%"></td><td style="padding-top: 2px; border:none;"><h4 style="color: #021423">'.$tool_heading.'</h4></td><td style="border:none;"></td><td style="border:none;"></td><td style="border:none;"></td><td style="text-align: right; padding-top: 13px; border:none;"><a href="'.base_url().'emp-package-tool/'.$pkg_type_id.'-'.$pkg_id.'-'.$assign.'-'.$level.'-'.$tool.'-'.$industries.'-'.$company.'"  target="_blank" style="color:#021423;font-size:16px">+Add Question</a></td></tr>';
                                   
            foreach ($question as $ques) {
                $s=$ques['skill_tested'];
                $q_id=rtrim(strtr(base64_encode($ques['mcq_id']), '+/', '-_'), '=');
                $SKILL="";
                if($company==0){
                    $r=$this->Crud_modal->fetch_single_data('skills_id,skills_name','master_skills_test',"skills_id='$s'");
                    $SKILL=$r["skills_name"];
                }else{
                    $r=$this->Crud_modal->fetch_single_data('emp_skill_id,skill_name','mm_employer_skill',"emp_skill_id='$s'");
                    $SKILL=$r["skill_name"];
                }
                $table_ques .='<tr><td>'.$question_count.'.</td><td>'.$ques["question"].'</td><td>'.$ques["c_answer"].'</td><td>'.$SKILL.'</td><td>'.$ques["created_date"].'</td><td style="text-align: center"><a href="'.base_url().'emp-view-package-tool/'.$pkg_type_id.'-'.$pkg_id.'-'.$assign.'-'.$level.'-'.$tool.'-'.$q_id.'-'.$industries.'-'.$company.'" target="_blank"><button class="btn btn-info  dim new-button-view" type="button"><i class="fa fa-eye"></i> </button></a> <a href="'.base_url().'emp-edit-package-tool/'.$pkg_type_id.'-'.$pkg_id.'-'.$assign.'-'.$level.'-'.$tool.'-'.$q_id.'-'.$industries.'-'.$company.'" target="_blank" style="margin-left: 3px;"><button class="btn btn-success dim new-button-view" type="button"><i class="fa fa-edit"></i></button></a> <a data-value="'. $url_segment.'-'.$q_id.'" class="delete_question"><button class="btn btn-warning  dim new-button-view hide" type="button"><i class="fa fa-trash"></i></button></a></td></tr>';
                $question_count++; 
            }
            break;
    }//switch ends here
    echo $table_ques;
  }else{                  
    redirect(base_url().'employer','refresh');
  }
}
public function emp_get_tool_form(){
  if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
    $pkg = explode('-', $this->input->post('ID'));
    $pkg_type_id=$pkg[0];
    $pkg_id = $pkg[1];
    $assign = $pkg[2];
    $level = $pkg[3];
    $tool = $pkg[4];
    if(count($pkg)==6){
        $tool_case = $pkg[5]; 
    }
    $form = '';
    switch($tool){
        case 1:
            $data['tool_name']='MCQ Create';
            $table_name1 = 'mcq';
            $page_link1[] = 'create-mcq';
            $this->load->view('employertempletes/head');
            $this->load->view('employertempletes/header'); 
            $this->load->view('employertempletes/sidebar');
            $this->load->view('refill-header', $data);
            $this->load->view('refill-footer', $data);
            $this->load->view('employertempletes/footer');
            break;
    }// switch ends here
  }else{                   
    redirect(base_url().'employer','refresh');
  }
}
public function emp_package_tool(){
    $id = explode('-',$this->uri->segment(2));
    $pack_type_id = $id[0];
    $package_id = $id[1];
    $assign_id = $id[2];
    $level_id = $id[3];
    $tool_id = $id[4];
    $case_tol_id = $id[5];
    $data['pack_type_id']=$pack_type_id;
    if($tool_id==4){$indus_id = $id[6]; $comp_id = $id[7];}else{$indus_id = $id[5]; $comp_id = $id[6];}
       
    $where = 'status =1';
    $data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$where,'type_id desc');
    $skill_map = $this->Crud_modal->all_data_select('skills','mm_packages',"package_id='$package_id'",'package_id');
    $pac_skill = explode(',',$skill_map[0]['skills']);
    if($comp_id==0){
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
    $whereall = 'status =1';
    $data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$whereall,'diffi_id desc');
    $data['master_case'] = $this->Crud_modal->all_data_select('case_id,case_name','case_study',$where,'case_id desc');
    $data['master_industries'] = $this->Crud_modal->all_data_select('industry_id,industry_name','mm_master_industry_topic','status=1', 'industry_id DESC');
    $data['master_companies'] = $this->Crud_modal->all_data_select('employer_id,employer_company','mm_employer',"employer_industry_id='$indus_id' and employer_status=1", 'employer_id DESC');
    $data['packages'] = $this->Crud_modal->all_data_select('package_id,package_name','mm_packages',"company_id=$comp_id and pack_type_id=$pack_type_id and status=1", 'package_id DESC');
    $data['packages_id']=$package_id;
    $data['indus_id']=$indus_id;
    $data['company_id']=$comp_id;
    $top=$this->Crud_modal->fetch_single_data('level_type','master_level',"ml_id=$level_id");
    $data['topic_id']=$tid=$top['level_type'];
    $data['master_topics'] = $this->Crud_modal->fetch_single_data('t_id,t_name','master_topic',"status=1 and t_id=$tid");
    $data['url_id']=$this->uri->segment(2);

    if($comp_id>0){
        $data['package_type'] = $this->Crud_modal->all_data_select('pack_type_id,pack_type_name','mm_master_package_type',"status=1 and company_type=1",'pack_type_id');
    }else{
        $data['package_type'] = $this->Crud_modal->all_data_select('pack_type_id,pack_type_name','mm_master_package_type',"status=1 and company_type=0",'pack_type_id');
    }
    $data['filetypelist'] = $this->Crud_modal->all_data_select('ft_extensions,ft_name','master_filetype',$where,'ft_id desc');
    $data['employer']=$this->Crud_modal->fetch_single_data('*','mm_employer','employer_id='.$this->session->userdata('employer_id'));   
    $data['pack_type_list']=$this->Crud_modal->all_data_select('pack_type_id,pack_type_name','mm_master_package_type',"status=1 and company_type=1",'pack_type_id asc');     
    switch($tool_id) {
        case 1:
            $data['tool_name']='MCQ Create';
            $table_name1 = 'mcq';
            $page_link1[] = 'create-mcq';
            $page_name='emp-mcq-tool';
            break;
    }
    $this->load->view('employertempletes/head');
    $this->load->view('employertempletes/header'); 
    $this->load->view('employertempletes/sidebar');
    $this->load->view('refill-header', $data);
    // page for tool
    $this->load->view($page_name, $data);
    //end here
    $this->load->view('refill-footer', $data);
    $this->load->view('employertempletes/footer');
}
public function emp_edit_package_tool(){
    $id = explode('-',$this->uri->segment(2));
    $pkg_type_id=$id[0];
    $package_id = $id[1];
    $assign_id = $id[2];
    $level_id = $id[3];
    $tool_id = $id[4];
    $case_tol_id ='';
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
    $where = 'status =1';
    $data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$where,'type_id desc');
    $data['employer']=$this->Crud_modal->fetch_single_data('*','mm_employer','employer_id='.$this->session->userdata('employer_id'));   
    $data['pack_type_list']=$this->Crud_modal->all_data_select('pack_type_id,pack_type_name','mm_master_package_type',"status=1 and company_type=1",'pack_type_id asc');

    $skill_map = $this->Crud_modal->all_data_select('skills','mm_packages',"package_id='$package_id'",'package_id');
    $pac_skill = explode(',',$skill_map[0]['skills']);
    if($comp_id==0){
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
    
    $whereall = 'status =1';
    $data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$whereall,'diffi_id desc');
    $data['master_case'] = $this->Crud_modal->all_data_select('case_id,case_name','case_study',$where,'case_id desc');
    $data['master_industries'] = $this->Crud_modal->all_data_select('industry_id,industry_name','mm_master_industry_topic','status=1', 'industry_id DESC');
    $data['packages'] = $this->Crud_modal->all_data_select('package_id,package_name','mm_packages',"company_id=$comp_id and pack_type_id=$pkg_type_id and status=1", 'package_id DESC');
    $data['packages_id']=$package_id;
    $data['indus_id']=$indus_id;
    $top=$this->Crud_modal->fetch_single_data('level_type','master_level',"ml_id=$level_id");
    $data['topic_id']=$tid=$top['level_type'];
    $data['master_topics'] = $this->Crud_modal->fetch_single_data('t_id,t_name','master_topic',"status=1 and t_id=$tid");
    $data['url_id']=$this->uri->segment(2);

    $data['company_id']=$comp_id;
    $data['pack_type_id']=$pkg_type_id;
    $data['master_companies'] = $this->Crud_modal->all_data_select('employer_id,employer_company','mm_employer','employer_status=1 and employer_industry_id='.$indus_id, 'employer_id DESC');
    $data['package_type'] = $this->Crud_modal->all_data_select('pack_type_id,pack_type_name','mm_master_package_type','status=1 and company_type=1', 'pack_type_id ASC');
    
    $data['filetypelist'] = $this->Crud_modal->all_data_select('ft_extensions,ft_name','master_filetype',$where,'ft_id desc');
        
    switch($tool_id) {
        case 1:
            $data['tool_name']='Edit MCQ';
            $table_name1 = 'mcq';
            $page_link1[] = 'create-mcq';
            $page_name='emp_edit_mcq';
            $data['mcq']=$this->Crud_modal->fetch_single_data("*","mcq","mcq_id=$ques_id");
            break;
    }
    $this->load->view('employertempletes/head');
    $this->load->view('employertempletes/header'); 
    $this->load->view('employertempletes/sidebar');
    $this->load->view('refill-header', $data);
    // page for tool
    $this->load->view($page_name, $data);
    //end here
    $this->load->view('refill-footer', $data);
    $this->load->view('employertempletes/footer');
}
public function emp_view_package_tool(){
    $id = explode('-', $this->uri->segment(2));
    $pkg_type_id=$id[0];
    $package_id = $id[1];
    $assign_id = $id[2];
    $level_id = $id[3];
    $tool_id = $id[4];
    $case_tol_id ='';
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
    $where = 'status =1';
    $data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$where,'type_id desc');
    $data['master_industries'] = $this->Crud_modal->all_data_select('industry_id,industry_name','mm_master_industry_topic','status=1', 'industry_id DESC');
    $data['packages'] = $this->Crud_modal->all_data_select('package_id,package_name','mm_packages',"company_id=$comp_id and pack_type_id=$pkg_type_id and status=1", 'package_id DESC');
    $data['packages_id']=$package_id;
    $data['indus_id']=$indus_id;
    $data['url_id']=$this->uri->segment(2);
    $data['company_id']=$comp_id;
    $data['pack_type_id']=$pkg_type_id;
    $data['master_companies'] = $this->Crud_modal->all_data_select('employer_id,employer_company','mm_employer','employer_status=1 and employer_industry_id='.$indus_id, 'employer_id DESC');
    
    $data['employer']=$this->Crud_modal->fetch_single_data('*','mm_employer','employer_id='.$this->session->userdata('employer_id'));   
    $data['pack_type_list']=$this->Crud_modal->all_data_select('pack_type_id,pack_type_name','mm_master_package_type',"status=1 and company_type=1",'pack_type_id asc');
    
    switch($tool_id) {
        case 1:
            $table_name1 = 'mcq';
            $where = "mcq_id = '$ques_id'";
            $data['tool_name']='MCQ Question';
            $data['mcq'] = $this->Crud_modal->fetch_single_data('*','mcq',$where);
            $page_name = 'emp-view-mcq';
            break;
    }
    $this->load->view('employertempletes/head');
    $this->load->view('employertempletes/header'); 
    $this->load->view('employertempletes/sidebar');
    $this->load->view('refill-header', $data);
    $this->load->view($page_name, $data);
    $this->load->view('refill-footer', $data);
    $this->load->view('employertempletes/footer');                        
}
/***************TOOLS CRUD FUNCTIONS********************************/
public function emp_insert_mcq_tool(){
  if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
    if($this->input->post('question')!=''){
        if($this->input->post('canswer')!=''){
            $url_redirect = $this->input->post('url_data');
            $question = $this->input->post('question');
            $options = $this->input->post('opt');
            $cans = $this->input->post('canswer');
            $master_topic = $this->input->post('master_topic');
            $master_type = $this->input->post('master_type');
            $master_skills_test = $this->input->post('master_skills_test');
            $timerange = $this->input->post('timerange');
            $insert_data = array(
                        'question' => $question,
                        'options' => implode('sohrab', $options),
                        'c_answer' => implode('sohrab', $cans),
                        'topic' => $master_topic,
                        'type' => $master_type,
                        'difficulty_level' => $this->input->post('master_difficulty_level'),
                        'skill_tested' => $master_skills_test,
                        'mcq_time' => $timerange,
                        'created_by' => $this->session->userdata('employer_id'),
                        'created_date' => date('Y-m-d H:i:s'),
                        'case_id' => $this->input->post('master_case')
            );
            if($this->Crud_modal->data_insert('mcq',$insert_data)){
                $this->session->set_flashdata('mcq_message','<div class="success"><strong>Success!</strong> Data Inserted.</div>');
                redirect(base_url().'emp-package-tool/'.$url_redirect);
            }else{
                $this->session->set_flashdata('mcq_message','<div class="danger"><strong>Oops!</strong>Failed to Insert Data</div>');
                redirect(base_url().'emp-package-tool/'.$url_redirect);
            }
        }else{
            $this->session->set_flashdata('mcq_message','<div class="danger"><strong>Oops!</strong> You have not selected correct answer.</div>');
            redirect(base_url().'emp-package-tool/'.$url_redirect);
        }
    }else{
        $this->session->set_flashdata('mcq_message','<div class="danger"><strong>Oops!</strong> Question Field Empty</div>');
        redirect(base_url().'emp-package-tool/'.$url_redirect);
    }
  }else{
    redirect(base_url().'employer','refresh');
  }
}
public function insert_mcq_file(){
    $url_redirect = $this->input->post('current_click_level');
    $count=0;
    $fp = fopen($_FILES['userfile']['tmp_name'],'r') or die("can't open file");
    $files = $_FILES['userfile']['name'];
    $FileType = pathinfo($files,PATHINFO_EXTENSION);
    if($FileType == "csv"){
        while($csv_line = fgetcsv($fp,1024)){
            $csv_line = array_map("utf8_encode", $csv_line); //added
            $count++;
            if($count == 1){
                continue;
            }//keep this if condition if you want to remove the first row
            for($i = 0, $j = count($csv_line); $i < $j; $i++){
                $insert_csv = array();
                $insert_csv['question']=trim($csv_line[0]);
                $insert_csv['options']=trim($csv_line[1]).'sohrab'.trim($csv_line[2]).'sohrab'.trim($csv_line[3]).'sohrab'.trim($csv_line[4]);
                $insert_csv['c_answer'] = trim($csv_line[5]);
                $insert_csv['topic']= trim($csv_line[6]);
                $insert_csv['type']= trim($csv_line[7]);
                $insert_csv['skill_tested']= trim($csv_line[8]);
                $insert_csv['difficulty_level']= trim($csv_line[9]);
                $insert_csv['case_id']= trim($csv_line[10]);
            }
            $data = array(
                'question' => $insert_csv['question'],
                'options' => $insert_csv['options'],
                'c_answer' => $insert_csv['c_answer'],
                'topic' => $insert_csv['topic'],
                'type' => $insert_csv['type'],
                'skill_tested' => $insert_csv['skill_tested'],
                'difficulty_level' => $insert_csv['difficulty_level'],
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('adminid'),
                'case_id' => $insert_csv['case_id']
            );
            $this->Crud_modal->data_insert('mcq', $data);
        }
        $this->session->set_flashdata('mcq_message','<div class="success"><strong>Success!</strong> Data Uploaded.</div>');
        redirect(base_url().'emp-package-tool/'.$url_redirect);
    }else{
        $this->session->set_flashdata('mcq_message','<div class="success"><strong>Failed!</strong> Upload Only .CSV File</div>');
        redirect(base_url().'emp-package-tool/'.$url_redirect);
    }
}
public function emp_update_mcq_tool(){
  if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
    $mcq_id = $this->input->post('mcq_id');
    $url_redirect = $this->input->post('current_click_level');
    if($this->input->post('question')!=''){
        if($this->input->post('canswer')!=''){
            $question = $this->input->post('question');
            $options = $this->input->post('opt');
            $cans = $this->input->post('canswer');
            $master_topic = $this->input->post('master_topic');
            $master_type = $this->input->post('master_type');
            $master_skills_test = $this->input->post('master_skills_test');
            $timerange = $this->input->post('timerange');
            $update_data = array(
                'question' => $question,
                'options' => implode('sohrab', $options),
                'c_answer' => implode('sohrab', $cans),
                'topic' => $master_topic,
                'type' => $master_type,
                'difficulty_level' => $this->input->post('master_difficulty_level'),
                'skill_tested' => $master_skills_test,
                'mcq_time' => $timerange,
                'modified_by' => $this->session->userdata('adminid'),
                'modified_date' => date('Y-m-d H:i:s'),
                'case_id' => $this->input->post('master_case')
            );
            $where = "mcq_id = '$mcq_id'";
            if($this->Crud_modal->update_data($where,'mcq',$update_data)){
                $this->session->set_flashdata('mcq_message','<div style="color:green"><strong>Success!</strong> Data Updated.</div>');
                redirect(base_url().'emp-edit-package-tool/'.$url_redirect);
            }else{
                $this->session->set_flashdata('mcq_message','<div style="color:red"><strong>Oops!</strong> Failed to Updated Data</div>');
                redirect(base_url().'emp-edit-package-tool/'.$url_redirect);
            }
        }else{
            $this->session->set_flashdata('mcq_message','<div style="color:red"><strong>Oops!</strong> You have not selected correct answer.</div>');
            redirect(base_url().'emp-edit-package-tool/'.$url_redirect);
        }
    }else{
        $this->session->set_flashdata('mcq_message','<div style="color:red"><strong>Oops!</strong> Question Field Empty</div>');
        redirect(base_url().'emp-edit-package-tool/'.$url_redirect);
    }
  }else{
    redirect(base_url().'employer','refresh');
  }
}

public function edit_employer_package(){
  if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
    $eid=$this->session->userdata('employer_id'); 
    $data['employer'] = $this->Crud_modal->fetch_single_data('employer_id,employer_industry_id,employer_company','mm_employer','employer_id='.$eid);
    $data['pack_type_list'] = $this->Crud_modal->all_data_select('pack_type_id,pack_type_name','mm_master_package_type','status=1 and company_type=1', 'pack_type_id ASC');
    $data['packages'] = $this->Crud_modal->all_data_select('package_id,package_name','mm_packages','status=1 and company_id='.$eid, 'package_id ASC');
    $data['assessment_params_list']=$this->Crud_modal->all_data_select('p_id,name,method','master_parameter','status=1','p_id asc');
    $this->load->view('employertempletes/head');
    $this->load->view('employertempletes/header'); 
    $this->load->view('employertempletes/sidebar');
    $this->load->view('edit-employer-package', $data); 
    $this->load->view('employertempletes/footer');

  }else{ redirect(base_url().'employer','refresh'); }
}
public function employer_get_package(){
  if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
    $package_id = $this->input->post('package_id');
    $package_data = $this->Crud_modal->fetch_single_data('*','mm_packages',"package_id='$package_id'");
    echo json_encode($package_data); 
  }else{                    
    redirect(base_url().'employer','refresh');
  }
}
public function emp_skill_map(){
    $id = $this->input->post('industries');
    $cmp = $this->input->post('company');
    if($cmp!=0 || $cmp!=1){
        $skill_data = $this->Crud_modal->all_data_select('emp_skill_id,skill_name','mm_employer_skill',"indus_id='$id' and cmp_id='$cmp'",'emp_skill_id');
    }else{
        $skill_data = $this->Crud_modal->all_data_select('emp_skill_id,skill_name','mm_employer_skill',"indus_id='$id'",'emp_skill_id');
    }
    foreach($skill_data as $skilldata){
        echo '<option value='.$skilldata["emp_skill_id"].'>'.$skilldata["skill_name"].'</option>';
    }
}
public function emp_update_package_data(){
  if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
    $pac_name = $this->input->post('package_name');
    $pack_id = $this->input->post('packs');
    $skills = implode(',',$this->input->post('skills'));
    $field=array(
        'package_name'=> $this->input->post('package_name'),
        'validity'=> $this->input->post('validity'),
        'assign_count'=> $this->input->post('assign_count'),
        'total_marks'=> $this->input->post('total_neurons'),
        'total_time'=> $this->input->post('total_time'),
        'description'=> $this->input->post('package_name'),
        'status'=> $this->input->post('pkg_status'),
        'skills'=> $skills,
        'description'=> $this->input->post('package_description'),
        'pack_type_id'=> $this->input->post('pack_type'),
        'modified_date' =>date('Y-m-d H:i:s')
    );
    $config['upload_path']    = './upload/package/';
    $config['allowed_types']  = 'gif|jpg|png';
    $new_name = time().$_FILES["package_image"]['name'];
    $config['file_name'] = $new_name;
    $this->load->library('upload', $config);
    if($this->upload->do_upload('package_image')){   
        $file=$this->upload->data();
        $field['image'] =$new_name; 
        $data = $this->Crud_modal->update_data("package_id='$pack_id'",'mm_packages',$field); 
        if($data){ echo 1; }
    }else{
        $data = $this->Crud_modal->update_data("package_id='$pack_id'",'mm_packages',$field); 
        if($data){ echo 1; }
    }
   }else{                   
        redirect(base_url().'employer','refresh');
   }
}
public function emp_get_assignment(){
  if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
    $id=$this->input->post("package_id"); 
    $assign=$this->Crud_modal->fetch_single_data("assign_count","mm_packages","package_id=$id");
    $data["total_assignment"]=$assign['assign_count'];
    $data["assignment"]=$this->Crud_modal->all_data_select("*","master_assignment","pack_id=$id","maid");
    echo json_encode($data);
  }else{                    
    redirect(base_url().'employer','refresh');
  }
}
public function emp_update_assignment_data(){
      if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" ||  $this->session->userdata('admin_role')!=null)){
        
            $assign_count = $this->input->post('assignn_count');
            $admin_id = $this->session->userdata('adminid');
            $package_id = $this->input->post("package_id");
            for($i=0; $i<$assign_count; $i++){
                $aid=$this->input->post("ass_id".$i);
                $field=array(
                    'maid' => $aid,
                    'assignment_name' => $this->input->post("assignment_name".$i),
                    'assignment_description' => $this->input->post("assignment_description".$i),
                    'number_of_level' => $this->input->post("no_level".$i),
                    'type' => $this->input->post("ass_type".$i)
                );
                $res=false; $new_name="";
                if(isset($_FILES["assignment_image".$i]) && $_FILES["assignment_image".$i]['name'] != ''){
                    $file1 = $this->Admindashboard_modal->ddoo_upload("assignment_image".$i,0,'./upload/assignment');
                    $filename= $_FILES["assignment_image".$i]["name"];
                    $file_ext = pathinfo($filename,PATHINFO_EXTENSION);
                    $new_name = $file1["upload_data"]["file_name"];
                    $res=true;  
                }else{
                    $new_name = $this->input->post('old_assign_image'.$i);
                    $res=true;  
                }
                
                if($res){          
                    $field['image'] = $new_name;  
                    if($aid!=""){
                       $idata=$this->Crud_modal->update_data("maid=$aid",'master_assignment',$field);
                    }else{
                        /***************************/
                        $assign_date = date('Y-m-d H:i:s');
                        if($this->Admindashboard_modal->total_assign_id()){
                            $data['totalid']=$this->Admindashboard_modal->total_assign_id();
                            $newid = intval(str_replace("AS-","",$data['totalid']['mas_id']))+1; 
                            $mas_id = "AS-$newid";
                        }else{
                            $mas_id = 'AS-101';
                        }
                        $ran_val = rand(111111,999999);
                        $field['pack_id']=$package_id;
                        $field['created_date']=$assign_date;
                        $field['created_by']=$this->session->userdata('employer_id');
                        $field['ran_val']=$ran_val;
                        $inserted_id[$i] = $this->Crud_modal->data_insert_returnid('master_assignment',$field);
                        if(count($inserted_id)>0){
                            $id = implode(',',$inserted_id);
                            $update_field=array(
                                'ma_id'=> $id,
                                'modified_by' => $admin_id,
                                'modified_date' => date('Y-m-d H:i:s'),
                            );
                            $where = "package_id = '$package_id'";
                            $idata = $this->Crud_modal->update_data($where,'mm_packages',$update_field);
                            
                        }else{
                            echo 0;
                        }
                        /***************************/
                    }
                }else{
                    if($aid!=""){
                         $idata=$this->Crud_modal->update_data("maid=$aid",'master_assignment',$field);
                    }else{
                        /***************************/
                        $assign_date = date('Y-m-d H:i:s');
                        if($this->Admindashboard_modal->total_assign_id()){
                            $data['totalid']=$this->Admindashboard_modal->total_assign_id();
                            $newid = intval(str_replace("AS-","",$data['totalid']['mas_id']))+1; 
                            $mas_id = "AS-$newid";
                        }else{
                            $mas_id = 'AS-101';
                        }
                        $ran_val = rand(111111,999999);
                        $field['pack_id']=$package_id;
                        $field['created_date']=$assign_date;
                        $field['created_by']=$this->session->userdata('employer_id');
                        $field['ran_val']=$ran_val;
                        $inserted_id[$i] = $this->Crud_modal->data_insert_returnid('master_assignment',$field);
                        if(count($inserted_id)>0){
                            $id = implode(',',$inserted_id);
                            $update_field=array(
                                'ma_id'=> $id,
                                'modified_by' => $admin_id,
                                'modified_date' => date('Y-m-d H:i:s'),
                            );
                            $where = "package_id = '$package_id'";
                            $idata = $this->Crud_modal->update_data($where,'mm_packages',$update_field);
                        }else{
                            echo 0;
                        }
                        /***************************/
                    }          
                }    
            }
            if($idata){ echo "1"; }else{ echo "0"; }
       }else{                   
            redirect(base_url().'admin','refresh');
       }
  }
  public function emp_get_level_case(){
      if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
        $id=$this->input->post("level_id"); 
        $data["level_case"]=$this->Crud_modal->fetch_single_data("*","case_study","level_id=$id");
        echo json_encode($data);
      }else{                    
            redirect(base_url().'admin','refresh');
      }
  }
public function emp_edit_levels(){
   if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
    $level_id = $this->input->post('level_id');
    $package_id = $this->input->post('package');
    $industry_id = $this->input->post('industry_l');
    $assign_id = $this->input->post('assignment');
    $lvl_name = $this->input->post('level_name');
    $level_ins = $this->input->post('level_ins');
    $level_type = $this->input->post('level_type');
    $time_limit = $this->input->post('time_limit');
    $level_topic = $this->input->post('level_topic');
    $level_skills = $this->input->post('level_skill');
    $diff_level = $this->input->post('diff_level');
    $q_limt = $this->input->post('q_limt');
    $description_key = $this->input->post('description_key');
    $key = $this->input->post('key');
    $start_date = $this->input->post('start_date');
    $start_time = $this->input->post('start_time');
    $admin_id = $this->session->userdata('adminid');
    $assign_type = $this->input->post('assignment_type');

    $level_skills = explode('|', $this->input->post("skill_array"));
    $ass_param = explode('|', $this->input->post("param_array"));
    if(!empty($lvl_name)){
        $countlevel = sizeof($lvl_name);
        for($i=0;$i<$countlevel;$i++){
            if(!empty($lvl_name[$i])){
                $create_date = date('Y-m-d H:i:s');
                if($assign_type == "manual" || $assign_type == "Manual"){
                    $createdata = array(
                        'lvl_name' => $lvl_name[$i],
                        'inst_id' => $level_ins[$i],
                        'time_limit' => $time_limit[$i],
                        'd_level' => $diff_level[$i],
                        'description' => $description_key[$i],
                        'key_competency_assessed' => $key[$i],
                        'p_id'=>$ass_param[$i],
                        'start_date_time' => date('Y-m-d H:i:s',strtotime($start_date[$i].$start_time[$i]))
                    );
                }else{
                    $createdata = array(
                        'lvl_name' => $lvl_name[$i],
                        'inst_id' => $level_ins[$i],
                        'time_limit' => $time_limit[$i],
                        'd_level' => $diff_level[$i],
                        'skills' => $level_skills[$i],
                        'm_type' => $level_type[$i],
                        'q_limit' => $q_limt[$i],
                        'p_id'=>$ass_param[$i],
                        'description' => $description_key[$i],
                        'key_competency_assessed' => $key[$i],
                        'start_date_time' => date('Y-m-d H:i:s',strtotime($start_date[$i].$start_time[$i]))
                    );
                }
                $lvl_id=$level_id[$i];
                
                if($lvl_id!=""){
                    $data_res=$this->Crud_modal->update_data("ml_id=$lvl_id","master_level",$createdata);
                }else{
                    $create_date = date('Y-m-d H:i:s');
                    if($assign_type == "manual" || $assign_type == "Manual"){
                        $topic_name = $level_topic[$i];
                        $topicarray = array(
                            't_name'=>$topic_name,
                            'created_date'=>date('Y-m-d H:i:s'),
                            'created_by'=>$this->session->userdata('employer_id'),
                            'status'=>1
                        );
                        $topic_id = $this->Crud_modal->data_insert_returnid('master_topic',$topicarray);
                        $createdata = array(
                            'maid' => $assign_id,
                            'lvl_name' => $lvl_name[$i],
                            'created_date' => $create_date,
                            'created_by' => $this->session->userdata('employer_id'),
                            'inst_id' => $level_ins[$i],
                            'time_limit' => $time_limit[$i],
                            'level_type' => $topic_id,
                            'd_level' => $diff_level[$i],
                            'skills' => $level_skills[$i],
                            'description' => $description_key[$i],
                            'key_competency_assessed' => $key[$i],
                            'start_date_time' => date('Y-m-d H:i:s',strtotime($start_date[$i].$start_time[$i])),
                            'pack_id' => $package_id,
                            'p_id'=>$ass_param[$i]
                        );
                    }else{
                        $topic_name = $level_topic[$i];
                        $topicarray = array(
                            't_name'=>$topic_name,
                            'created_date'=>date('Y-m-d H:i:s'),
                            'created_by'=>$this->session->userdata('employer_id'),
                            'status'=>1
                        );
                        $topic_id = $this->Crud_modal->data_insert_returnid('master_topic',$topicarray);
                        $createdata = array(
                            'maid' => $assign_id,
                            'lvl_name' => $lvl_name[$i],
                            'created_date' => $create_date,
                            'created_by' => $this->session->userdata('employer_id'),
                            'inst_id' => $level_ins[$i],
                            'time_limit' => $time_limit[$i],
                            'level_type' => $topic_id,
                            'd_level' => $diff_level[$i],
                            'skills' => $level_skills[$i],
                            'm_type' => $level_type[$i],
                            'q_limit' => $q_limt[$i],
                            'description' => $description_key[$i],
                            'key_competency_assessed' => $key[$i],
                            'start_date_time' => date('Y-m-d H:i:s',strtotime($start_date[$i].$start_time[$i])),
                            'pack_id' => $package_id,
                            'p_id'=>$ass_param[$i]
                        );
                    }
                    $data_res = $this->Crud_modal->data_insert_returnid('master_level',$createdata);
                }
            }
        }
        if($data_res){
            echo "1";
            $this->session->set_flashdata('level_insert_message','<div class="success"><strong>Success!</strong> Level Details Updated.</div>');
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
public function emp_get_instructions(){
  if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null){
   $id=$this->input->post("assign_id"); 
   $i=$this->input->post("instruction_id");
   $data["instructions"]=$this->Crud_modal->all_data_select("*","instruction_widget","assign_id=$id and instruction_id=$i","instruction_id");
   echo json_encode($data);
  }else{                    
   redirect(base_url().'employer','refresh');
  }
}
public function emp_update_level_instruction(){
  if(($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null)){
    $count = $this->input->post('disc_count');
    $id = $this->input->post('instruction_id');
     
    for($i=0; $i<$count; $i++){
        if(isset($_FILES["instruction_image".($i+1)]) && $_FILES["instruction_image".($i+1)]['name'] != ''){
            $file1 = $this->Admindashboard_modal->ddoo_upload("instruction_image".($i+1),0,'./upload/instruction');
            $filename= $_FILES["instruction_image".($i+1)]["name"];
            $file_ext = pathinfo($filename,PATHINFO_EXTENSION);
            $image[$i] = $file1["upload_data"]["file_name"];
        }else{
            $image[$i] = $this->input->post('old_image'.($i+1));
        }
        $desc = $this->input->post('image_discripton'.($i+1));
        if($desc !=""){
            $description[$i] = $this->input->post('image_discripton'.($i+1));
        }
    }
    $image_name = implode('||', $image);
    $image_discripton = implode('||', $description);
    $date=date("Y-m-d h:i:s");
    $admin_name=$this->session->userdata('adminid');
    for($k=0;$k<sizeof($id);$k++){
        $iid=$id[$k];
        $data=array(
            'instruction_name'    =>$this->input->post('instruction_name'),
            'instruction_desc'    =>$image_discripton,
            'modified_date'        =>$date,
            'status'            =>'1',
            'modified_by'        =>$admin_name
        );
        if($image_name!=""){
            $data['instruction_image']=$image_name;
        }
        $data_return=$this->Crud_modal->update_data("instruction_id=$iid",'instruction_widget',$data);
    }
    if($data_return=='1'){
        echo "1";
    }
  }else{
    redirect(base_url().'employer','refresh');
  }
}

// end here  
}

