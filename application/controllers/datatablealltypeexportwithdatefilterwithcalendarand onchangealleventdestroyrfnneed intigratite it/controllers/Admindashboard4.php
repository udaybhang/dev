<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admindashboard4 extends MX_Controller {	
  	function __construct(){
		parent::__construct();
	    //error_reporting(0);
		$this->load->model('Admindashboard_modal');
		$this->load->model('crud/Crud_modal');
		$this->load->model('userdashboard/Userdashboard_modal');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->model('mailer/Mailer_model');
	    $this->load->library('Phpmailer'); 
		if(($this->session->userdata('admin_name')=="" || $this->session->userdata('admin_name')==null) && ($this->session->userdata('admin_role')=="" || $this->session->userdata('admin_role')==null)){
			redirect(base_url().'admin');
		}
  	}


  	/// start from detail
  	public function edit_package_tool(){
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

		//$data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name',' master_skills_test',$where,'skills_id desc');
		$whereall = 'status =1';
		$data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$whereall,'diffi_id desc');
		$data['master_case'] = $this->Crud_modal->all_data_select('case_id,case_name','case_study',$where,'case_id desc');
		$data['master_industries'] = $this->Crud_modal->all_data_select('industry_id,industry_name','mm_master_industry_topic','status=1', 'industry_id DESC');
		$data['packages'] = $this->Crud_modal->select_data_using_findin_set('package_id,package_name','mm_packages',"industry_id",$indus_id,'package_id desc');
		$data['packages_id']=$package_id;
		$data['indus_id']=$indus_id;
		$top=$this->Crud_modal->fetch_single_data('level_type','master_level',"ml_id=$level_id");
		$data['topic_id']=$tid=$top['level_type'];
		$data['master_topics'] = $this->Crud_modal->fetch_single_data('t_id,t_name','master_topic',"status=1 and t_id=$tid");
		$data['url_id']=$this->uri->segment(2);

		$data['company_id']=$comp_id;
		$data['pack_type_id']=$pkg_type_id;
		$data['master_companies'] = $this->Crud_modal->all_data_select('employer_id,employer_company','mm_employer','employer_status=1 and employer_industry_id='.$indus_id, 'employer_id DESC');
		if($comp_id>0){
			$data['package_type'] = $this->Crud_modal->all_data_select('pack_type_id,pack_type_name','mm_master_package_type','status=1 and company_type=1', 'pack_type_id ASC');
		}else{
			$data['package_type'] = $this->Crud_modal->all_data_select('pack_type_id,pack_type_name','mm_master_package_type','status=1 and company_type=0', 'pack_type_id ASC');
		}
		$data['filetypelist'] = $this->Crud_modal->all_data_select('ft_extensions,ft_name','master_filetype',$where,'ft_id desc');
		switch($tool_id) {
		             case 0:
				       $data['tool_name']='Edit Subjective';
				       $table_name1 = 'subjective';
				       $page_link1[] = 'create-subjective-tool';
				       $page_name='edit-subjective-tool';
				       $data['subjective']=$this->Crud_modal->fetch_single_data("*","subjective","subjective_id=$ques_id");
				       break;
				    case 1:
				       $data['tool_name']='Edit MCQ';
				       $table_name1 = 'mcq';
				       $page_link1[] = 'create-mcq';
				       $page_name='edit-mcq-tool';
				       $data['mcq']=$this->Crud_modal->fetch_single_data("*","mcq","mcq_id=$ques_id");
				       break;
				    case 2:
				        $data['tool_name']='Edit Sequence';
				        $table_name1 = 'sequence_questions';
				        $page_link1[] = 'create-sequence';
				        $page_name='edit-sequence-tool';
				        $data['sequence_data'] = $this->Crud_modal->all_data_select('*','sequence_questions',"sq_id=$ques_id",'sq_id');
				        break;
				    case 3:
				       $data['tool_name']='Edit Match the following';
				       $table_name1 = 'match_the_following';
				       $page_link1[] = 'match-the-following';
				       $page_name='edit-match-tool';
				       $data['matchdata'] = $this->Crud_modal->fetch_single_data('*','match_the_following',"match_id=$ques_id");
				       break;
			       case 4:
                               switch ($case_tol_id) {
                                 case 0:
							       $data['tool_name']='Edit Subjective';
							       $table_name1 = 'subjective';
							       $page_link1[] = 'create-subjective-tool';
							       $page_name='edit-subjective-tool';
							       $data['subjective']=$this->Crud_modal->fetch_single_data("*","subjective","subjective_id=$ques_id");
							       break;
						       	case 1:
							       $data['tool_name']='Edit MCQ';
							       $table_name1 = 'mcq';
							       $page_link1[] = 'create-mcq';
							       $page_name='edit-mcq-tool';
							       $data['mcq']=$this->Crud_modal->fetch_single_data("*","mcq","mcq_id=$ques_id");
							       break;
							    case 2:
							        $data['tool_name']='Edit Sequence';
							        $table_name1 = 'sequence_questions';
							        $page_link1[] = 'create-sequence';
							        $page_name='edit-sequence-tool';
							        $data['sequence_data'] = $this->Crud_modal->all_data_select('*','sequence_questions',"sq_id=$ques_id",'sq_id');
							        break;
							    case 3:
							       $data['tool_name']='Edit Match the following';
							       $table_name1 = 'match_the_following';
							       $page_link1[] = 'match-the-following';
							       $page_name='edit-match-tool';
							       $data['matchdata'] = $this->Crud_modal->fetch_single_data('*','match_the_following',"match_id=$ques_id");
							       break;
							    case 5:
							       $data['tool_name']='Edit FIB';
							       $table_name1 = 'mm_fib';
							       $page_link1[] = 'insert-fill';
							       $page_name='edit-fib-tool';
							       $data['filldata'] = $this->Crud_modal->fetch_single_data('*','mm_fib',"fib_id=$ques_id");
							       break;
							    case 7:
							        $data['tool_name']='Edit Grid FIL';
							        $table_name1 = 'mm_grid_fib';
							        $page_link1[] = 'grid-fib';
							        $page_name='edit-gridfill-tool';
							        $data['grid_fib_edit_data'] = $this->Crud_modal->fetch_single_data('*','mm_grid_fib',"fib_id=$ques_id");
							        break;
							    case 8:
							       $data['tool_name']='Edit Bucket';
							       $table_name1 = 'mm_bucket';
							       $page_link1[] = 'create-bucket';
							       $page_name='edit-bucket-tool';
							       $data['bucketdata'] = $this->Crud_modal->fetch_single_data('*','mm_bucket',"bucket_id=$ques_id");
							       break;
							    case 9:
							        $data['tool_name']='Edit Word Detective';
							        $table_name1 = 'mm_word_detective';
							        $page_link1[] = 'create-word-detective';
							        $page_name='edit-word-detective-tool';
							        $data['word_detective'] = $this->Crud_modal->fetch_single_data('*','mm_word_detective',"word_detective_id=$ques_id");
							        break;
						        case 10:
							        $data['tool_name']='Edit Crossword';
							        $table_name1 = 'mm_crossword';
							        $page_link1[] = 'crossword-create';
							        $page_name='edit-crossword-tool';
							        $data['cross_word_data'] = $this->Crud_modal->fetch_single_data('*','mm_crossword',"crossword_id=$ques_id");
							        break;
						        case 11:
							        $data['tool_name']='Edit Process Generator';
							        $table_name1 = 'mm_process_generator';
							        $page_link1[] = 'create-process';
							        $page_name='edit-process-tool';
							        $data['process_data']=$this->Crud_modal->fetch_single_data('*','mm_process_generator',"process_id=$ques_id");
							        break;
					                }
					             if($table_name1 !=""){
					                 $where1 = "topic = '$topic' and case_id = '$c_id'";
					                 $row1 = $this->Crud_modal->check_numrow($table_name1,$where1);
					                 $count_quest = $count_quest+$row1;
                                }
					        $Total_tool = implode(',', $tool1);
					        $tool_link = implode(',', $page_link1);
					        $incase_id = implode(',', $in_case);
					        $data['assignment'][$i]['levels'][$i]['no_of_question']=$count_quest;
					        $data['assignment'][$i]['levels'][$i]['q_limit']=$no_ques;
					        $data['assignment'][$i]['levels'][$i]['name']=$Total_tool;
					        $data['assignment'][$i]['levels'][$i]['tool_link']=$tool_link;
					        $data['assignment'][$i]['levels'][$i]['g_id']=$grid_id;
					        $data['assignment'][$i]['levels'][$i]['in_cases']=$incase_id;
					        break;
				             case 5:
							       $data['tool_name']='Edit FIB';
							       $table_name1 = 'mm_fib';
							       $page_link1[] = 'insert-fill';
							        $page_name='edit-fib-tool';
							        $data['filldata'] = $this->Crud_modal->fetch_single_data('*','mm_fib',"fib_id=$ques_id");
							       break;
							    case 7:
							        $data['tool_name']='Edit Grid FIL';
							        $table_name1 = 'mm_grid_fib';
							        $page_link1[] = 'grid-fib';
							        $page_name='edit-gridfill-tool';
							        $data['grid_fib_edit_data'] = $this->Crud_modal->fetch_single_data('*','mm_grid_fib',"fib_id=$ques_id");
							        break;
							    case 8:
							       $data['tool_name']='Edit Bucket';
							       $table_name1 = 'mm_bucket';
							       $page_link1[] = 'create-bucket';
							       $page_name='edit-bucket-tool';
							       $data['bucketdata'] = $this->Crud_modal->fetch_single_data('*','mm_bucket',"bucket_id=$ques_id");
							       break;
							    case 9:
							        $data['tool_name']='Edit Word Detective';
							        $table_name1 = 'mm_word_detective';
							        $page_link1[] = 'create-word-detective';
							        $page_name='edit-word-detective-tool';
							        $data['word_detective'] = $this->Crud_modal->fetch_single_data('*','mm_word_detective',"word_detective_id=$ques_id");
							        break;
						        case 10:
							        $data['tool_name']='Edit Crossword';
							        $table_name1 = 'mm_crossword';
							        $page_link1[] = 'crossword-create';
							        $page_name='edit-crossword-tool';
							        $data['cross_word_data'] = $this->Crud_modal->fetch_single_data('*','mm_crossword',"crossword_id=$ques_id");
							        break;
						        case 11:
							        $data['tool_name']='Edit Process Generator';
							        $table_name1 = 'mm_process_generator';
							        $page_link1[] = 'create-process';
							        $page_name='edit-process-tool';
							        $data['process_data']=$this->Crud_modal->fetch_single_data('*','mm_process_generator',"process_id=$ques_id");
							        break;
                 }
                 //print_r($data);
           //echo $page_name; die;
		    $this->load->view('admintempletes/head');
			$this->load->view('admintempletes/header');	
			$this->load->view('admintempletes/sidebar');
			$this->load->view('refill_package_header', $data);
			// page for tool
			$this->load->view($page_name, $data);
			//end here
			$this->load->view('refill_package_footer', $data);
			$this->load->view('admintempletes/footer');
	}
	
public function view_tool_question(){
		$id = explode('-', $this->uri->segment(2));
		/*$package_id = $id[0];
		$assign_id = $id[1];
		$level_id = $id[2];
		$tool_id = $id[3];
		$case_tol_id = $id[4];
		$data['url_id']=$this->uri->segment(2);
		if($tool_id==4){
            $ques_id = base64_decode(str_pad(strtr($id[5], '-_', '+/'), strlen($id[5]) % 4, '=', STR_PAD_RIGHT));
            $indus_id=$id[6];
        }else{
        	$ques_id = base64_decode(str_pad(strtr($id[4], '-_', '+/'), strlen($id[4]) % 4, '=', STR_PAD_RIGHT));
            $indus_id=$id[5];
        }*/
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
	/***/
		$where = 'status =1';
		$data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$where,'type_id desc');
		
		/***/
            $data['master_industries'] = $this->Crud_modal->all_data_select('industry_id,industry_name','mm_master_industry_topic','status=1', 'industry_id DESC');
				$data['packages'] = $this->Crud_modal->select_data_using_findin_set('package_id,package_name','mm_packages',"industry_id",$indus_id,'package_id desc');
				$data['packages_id']=$package_id;
				$data['indus_id']=$indus_id;
				$data['url_id']=$this->uri->segment(2);

$data['company_id']=$comp_id;
		$data['pack_type_id']=$pkg_type_id;
		$data['master_companies'] = $this->Crud_modal->all_data_select('employer_id,employer_company','mm_employer','employer_status=1 and employer_industry_id='.$indus_id, 'employer_id DESC');
		if($comp_id>0){
			$data['package_type'] = $this->Crud_modal->all_data_select('pack_type_id,pack_type_name','mm_master_package_type','status=1 and company_type=1', 'pack_type_id ASC');
		}else{
			$data['package_type'] = $this->Crud_modal->all_data_select('pack_type_id,pack_type_name','mm_master_package_type','status=1 and company_type=0', 'pack_type_id ASC');
		}
		switch($tool_id) {
		            case 0:
				       $table_name1 = 'subjective';
					   $where = "subjective_id = '$ques_id'";
					   $data['tool_name']='Subjective Question';
					   $data['subjective'] = $this->Crud_modal->fetch_single_data('*','subjective',$where);
					   $page_name = 'view-subjective-tool';  
					   break;
				    case 1:
				       $table_name1 = 'mcq';
					   $where = "mcq_id = '$ques_id'";
					   $data['tool_name']='MCQ Question';
					   $data['mcq'] = $this->Crud_modal->fetch_single_data('*','mcq',$where);
					   $page_name = 'view-mcq-tool';
				       break;
				    case 2:
				        $table_name1 = 'sequence_questions';
				        $data['tool_name']='Sequence Question';
				        $page_name = 'view-sequence-tool';
						$where = "sq_id = '$ques_id'";
						$data['sqdata'] = $this->Crud_modal->fetch_single_data('*','sequence_questions',$where);
				        break;
				    case 3:
				       $table_name1 = 'match_the_following';
				       $data['tool_name']='Match of the following Question';
				       $page_name = 'view-match-tool';
				       $where="match_id='$ques_id'";
				       $data['matchdata'] = $this->Crud_modal->fetch_single_data('*','match_the_following',$where);
				       break;
			        case 4:
                               switch ($case_tol_id) {
                                case 0:
							       $table_name1 = 'subjective';
								   $where = "subjective_id = '$ques_id'";
								   $data['tool_name']='Subjective Question';
								   $data['subjective'] = $this->Crud_modal->fetch_single_data('*','subjective',$where);
								   $page_name = 'view-subjective-tool';
						       	case 1:
							       $table_name1 = 'mcq';
							       $data['tool_name']='MCQ Question';
							       $page_name = 'view-mcq-tool';
								   $where = "mcq_id = '$ques_id'";
								   $data['mcq'] = $this->Crud_modal->fetch_single_data('*','mcq',$where);
							       break;
							    case 2:
							        $table_name1 = 'sequence_questions';
							        $data['tool_name']='Sequence Question';
							        $page_name = 'view-sequence-tool';
									$where = "sq_id = '$ques_id'";
									$data['sqdata'] = $this->Crud_modal->fetch_single_data('*','sequence_questions',$where);
							        break;
							    case 3:
							       $table_name1 = 'match_the_following';
							       $data['tool_name']='Match of the following Question';
							       $page_name = 'view-match-tool';
							       $where="match_id='$ques_id'";
							       $data['matchdata'] = $this->Crud_modal->fetch_single_data('*','match_the_following',$where);
							       break;
							    case 5:
							       $table_name1 = 'mm_fib';	       
							       $where = "fib_id = '$ques_id'";	
							       $page_name = 'view-fib-tool';
						               $where = "fib_id = '$ques_id'";
							       $data['filldata'] = $this->Crud_modal->fetch_single_data('*','mm_fib',$where);
							       break;
							    case 7:
							        $table_name1 = 'mm_grid_fib';
							        $data['tool_name']='Grid Fib Question';
							        $where = "fib_id = '$ques_id'";
							        $page_name = 'view-grid-fib-tool';
							        $data['gfibdata'] = $this->Crud_modal->fetch_single_data('*','mm_grid_fib',$where);
							        break;
							    case 8:
							       $table_name1 = 'mm_bucket';
							       $data['tool_name']='Bucket Question';
							       $page_name = 'view-bucket-tool';
								   $where = "bucket_id = '$ques_id'";
					               $data['bucket'] = $this->Crud_modal->fetch_single_data('*','mm_bucket',$where);
							       break;
							    case 9:
							        $table_name1 = 'mm_word_detective';
							        $data['tool_name']='Word Detective Question';
							        $page_name = 'view-word-detective-tool';
									$where = "word_detective_id = '$ques_id'";
									$data['word_detective'] = $this->Crud_modal->fetch_single_data('*','mm_word_detective',$where);
							        break;
						        case 10:
							        $table_name1 = 'mm_crossword';
							        $data['tool_name']='Crossword Question';
							        $page_name = 'view-cross-word-tool';
							        $where = "crossword_id = '$ques_id'";
							        $data['cross_word_data'] = $this->Crud_modal->fetch_single_data('*','mm_crossword',$where);	
							        break;
						        case 11:
							        $table_name1 = 'mm_process_generator';
							        $data['tool_name']='Process generator Question';
									$where = "process_id = '$ques_id'";
							        break;
					                }
					             if($table_name1 !=""){
					                 $where1 = "topic = '$topic' and case_id = '$c_id'";
					                 $row1 = $this->Crud_modal->check_numrow($table_name1,$where1);
					                 $count_quest = $count_quest+$row1;
                                }
					        
					        break;
	                	   case 5:
				        $table_name1 = 'mm_fib';
					$where = "fib_id = '$ques_id'";	
					$page_name = 'view-fib-tool';
					$where = "fib_id = '$ques_id'";
					$data['tool_name']='FIB Question';
					$data['filldata'] = $this->Crud_modal->fetch_single_data('*','mm_fib',$where);
				       break;
				    case 7:
				        $table_name1 = 'mm_grid_fib';
				        $data['tool_name']='Grid Fib Question';
				        $page_name = 'view-grid-fib-tool';
					$where = "fib_id = '$ques_id'";
					$data['gfibdata'] = $this->Crud_modal->fetch_single_data('*','mm_grid_fib',$where);
							
				        break;
				    case 8:
				       $table_name1 = 'mm_bucket';
				       $data['tool_name']='Bucket Question';
				       $page_name = 'view-bucket-tool';
				       $where = "bucket_id = '$ques_id'";
				       $data['bucket'] = $this->Crud_modal->fetch_single_data('*','mm_bucket',$where);
									
				       break;
				    case 9:
				        $table_name1 = 'mm_word_detective';
				        $data['tool_name']='Word Detective Question';
				        $page_name = 'view-word-detective-tool';
					$where = "word_detective_id = '$ques_id'";
					$data['word_detective'] = $this->Crud_modal->fetch_single_data('*','mm_word_detective',$where);
									
				        break;
			        case 10:
				        $table_name1 = 'mm_crossword';
				        $data['tool_name']='Crossword Question';
				        $page_name = 'view-cross-word-tool';
					    $where = "crossword_id = '$ques_id'";
					    $data['cross_word_data'] = $this->Crud_modal->fetch_single_data('*','mm_crossword',$where);
							
				        break;
			        case 11:
				        $table_name1 = 'mm_process_generator';
				        $data['tool_name']='Process Generator Question';
					$where = "process_id = '$ques_id'";	
					$page_name = 'view-process-tool';
					$data['process_data'] = $this->Crud_modal->fetch_single_data('*','mm_process_generator',$where);
				        break;
                 }
                        $this->load->view('admintempletes/head');
						$this->load->view('admintempletes/header');	
						$this->load->view('admintempletes/sidebar');
						$this->load->view('refill_package_header', $data);
						$this->load->view($page_name, $data);
						$this->load->view('refill_package_footer', $data);
						$this->load->view('admintempletes/footer');   
		              
	}
 public function update_mcq_tool(){
	  if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
	  	//print_r($_POST); die;
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
					redirect(base_url().'edit-package-tool/'.$url_redirect);
				}else{
					$this->session->set_flashdata('mcq_message','<div style="color:red"><strong>Oops!</strong> Failed to Updated Data</div>');
					//redirect(base_url().'mcq-edit/'.rtrim(strtr(base64_encode($mcq_id), '+/', '-_'), '='));
					redirect(base_url().'edit-package-tool/'.$url_redirect);
				}
			}else{
				$this->session->set_flashdata('mcq_message','<div style="color:red"><strong>Oops!</strong> You have not selected correct answer.</div>');
				//redirect(base_url().'mcq-edit/'.rtrim(strtr(base64_encode($mcq_id), '+/', '-_'), '='));
				redirect(base_url().'edit-package-tool/'.$url_redirect);
			}
		}else{
			$this->session->set_flashdata('mcq_message','<div style="color:red"><strong>Oops!</strong> Question Field Empty</div>');
			//redirect(base_url().'mcq-edit/'.rtrim(strtr(base64_encode($mcq_id), '+/', '-_'), '='));
			redirect(base_url().'edit-package-tool/'.$url_redirect);
		}
	  }else{
			redirect(base_url().'admin','refresh');
	  }
	}

	public function update_word_detective_tool(){
	    		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			     {  
			     	    $admin_id = $this->session->userdata('adminid');
			     	    $url_redirect = $this->input->post('current_click_level');
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
							redirect(base_url().'edit-package-tool/'.$url_redirect);
						}else{
							$this->session->set_flashdata('word_detective_message','<div class="danger"><strong>Oops!</strong> Failed to Insert Data</div>');
							redirect(base_url().'edit-package-tool/'.$url_redirect);
						}
			     }
	    }	



	 public function update_match_tool()
	{
		try
		{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			{
				$url_redirect = $this->input->post('current_click_level');
				$created_by=$this->session->userdata('adminid');
				$date=date("Y-m-d h:i:s");
				$match_id=$this->input->post('match_id');
				$hidden=$this->input->post('editorlist');
				$matc_qus= $this->input->post('options1');
				$matc_ans=$this->input->post('answer1');
				for($i=2;$i<=$hidden;$i++)
				{
					if($this->input->post('options'.$i)!='' && $this->input->post('answer'.$i)!=''){
						$matc_qus.= "comma".$this->input->post('options'.$i);
						$matc_ans.= "comma".$this->input->post('answer'.$i);
					}else{
						$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Empty fields</div>');
						redirect(base_url().'match-update-view/'.rtrim(strtr(base64_encode($match_id), '+/', '-_'), '='));
					}
				}
				$data['title']='Admin Dashboard for Monday Morning';
				$where="match_id='$match_id'";
				$field=array(
					"match_question" => $matc_qus,
					"match_answer"   => $matc_ans,
					"question_topic" => $this->input->post('question_topic'),
					"answer_topic"	 => $this->input->post('answer_topic'),
					"question_heading"=>$this->input->post('question'),
					'difficulty_level' => $this->input->post('master_difficulty_level'),
					'topic' =>$this->input->post('master_topic'),
				    'type' => $this->input->post('master_type'),	
				    'skill_tested' => $this->input->post('master_skills_test'),
					"modified_by"   => $created_by,
					'case_id' => $this->input->post('master_case'),
					"modified_date" => $date
					);

				
				$data_return=$this->Crud_modal->update_data($where,'match_the_following',$field);
				if($data_return=='1')
					  {
					  	$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Match the following has been updated successfully</div>');
					  	redirect(base_url().'edit-package-tool/'.$url_redirect);
					  }
					  else
						 {
						    redirect(base_url().'admin','refresh');
					     }
			}
		}
		catch(Exception $e)
		{
			echo "Caught exception",$e->getMessage(),"\n";
		}
	}

	public function update_grid_fib_tool(){
	 	try
			{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {  
	     	$url_redirect = $this->input->post('current_click_level');
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
					redirect(base_url().'edit-package-tool/'.$url_redirect);
				}else{
					$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Update Data</div>');
					redirect(base_url().'edit-package-tool/'.$url_redirect);
				}
			}else{
				$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Question Field Empty</div>');
				redirect(base_url().'edit-package-tool/'.$url_redirect);
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

	 public function edit_fib_tool()
	 {
	 	try
	 	{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	 		{
	 			        $url_redirect = $this->input->post('current_click_level');
						$created_by=$this->session->userdata('adminid');
						$matc_ans=$this->input->post('answer1');
						$fib_id=$this->input->post('fib_id');
						$created_date=date('Y-m-d H:i:s');
						$fibquest = str_replace('inllif','<a href="" class="fibeditable"></a>',trim($this->input->post('fib_question')));
						$data_array=array(
							"fib_question" => $fibquest,
							"fib_answer"   => strtolower($matc_ans),
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
						$where="fib_id='$fib_id'";
						$data_return=$this->Crud_modal->update_data($where,'mm_fib',$data_array);
						if($data_return){
							$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data updated Successfully.</div>');
							redirect(base_url().'edit-package-tool/'.$url_redirect);
						}else{
							$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to update Data</div>');
							redirect(base_url().'edit-package-tool/'.$url_redirect);
						}
				}
	 		else{
		    	redirect(base_url().'admin','refresh');
		    }

		 }		
	 	catch(Exception $e)
	 	{
	 		echo 'Caught exception: ',  $e->getMessage(), "\n";
	 	}
	 }

	 public function update_cross_word_tool(){
	 	    $url_redirect = $this->input->post('current_click_level');
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
							$this->session->set_flashdata('cross_word_message','<div class="success"><strong>Success!</strong> Data upadte Successfully.</div>');
							redirect(base_url().'edit-package-tool/'.$url_redirect);
						}else{
							$this->session->set_flashdata('cross_word_message','<div class="danger"><strong>Oops!</strong> Failed to Insert Data</div>');
							redirect(base_url().'edit-package-tool/'.$url_redirect);
						}

	    }

	    public function sequence_update_tool(){
	 	try
			{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
	     	$url_redirect = $this->input->post('current_click_level');
	     	if($this->input->post('question')!=''){
	     		$val = $this->input->post('sqid');
	     		$sqid = base64_decode(str_pad(strtr($val, '-_', '+/'), strlen($val) % 4, '=', STR_PAD_RIGHT));
		     	$question = $this->input->post('question');
		     	$options = $this->input->post('options');
		     	$opt0=trim($options[0]);
		     	$opt1='sohrab'.trim($options[1]);
            	$opt2='sohrab'.trim($options[2]);
            	
            	if($options[3]!=''){
            		$opt3='sohrab'.trim($options[3]);
            	}else{
            		$opt3='';
            	}
		     	if($options[4]!=''){
            		$opt4='sohrab'.trim($options[4]);
            	}else{
            		$opt4='';
            	}
            	if($options[5]!=''){
            		$opt5='sohrab'.trim($options[5]);
            	}else{
            		$opt5='';
            	}
            	if($options[6]!=''){
            		$opt6='sohrab'.trim($options[6]);
            	}else{
            		$opt6='';
            	}
            	if($options[7]!=''){
            		$opt7='sohrab'.trim($options[7]);
            	}else{
            		$opt7='';
            	}
            	if($options[8]!=''){
            		$opt8='sohrab'.trim($options[8]);
            	}else{
            		$opt8='';
            	}
            	if($options[9]!=''){
            		$opt9='sohrab'.trim($options[9]);
            	}else{
            		$opt9='';
            	}
		     	$update_data = array(
			        'question' => $question,
			        'options' => $opt0.$opt1.$opt2.$opt3.$opt4.$opt5.$opt6.$opt7.$opt8.$opt9,
			        'topic' => $this->input->post('master_topic'),
			        'type' => $this->input->post('master_type'),
			        'skill_tested' => $this->input->post('master_skills_test'),
			        'modified_by' => $this->session->userdata('adminid'),
			        'modified_date' => date('Y-m-d H:i:s'),
			          'difficulty_level' => $this->input->post('master_difficulty_level'),
			        'case_id' => $this->input->post('master_case')
				);
				$where = "sq_id = '$sqid'";
				if($this->Crud_modal->update_data($where,'sequence_questions',$update_data)){
					$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Updated.</div>');
					redirect(base_url().'edit-package-tool/'.$url_redirect);
				}else{
					$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Update Data</div>');
					redirect(base_url().'edit-package-tool/'.$url_redirect);
				}
			}else{
				$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Question Field Empty</div>');
				redirect(base_url().'edit-package-tool/'.$url_redirect);
			}
	     }
	     else
			 {
				
			    redirect(base_url().'edit-package-tool/'.$url_redirect);
		     }
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}

	 }

	 public function update_bucket_tool(){
	    		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			     {  
			     	//print_r($_POST);
			     	$url_redirect = $this->input->post('current_click_level');
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
							redirect(base_url().'edit-package-tool/'.$url_redirect);
						}else{
							$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Insert Data</div>');
							redirect(base_url().'edit-package-tool/'.$url_redirect);
						}
			     }
	    }
   
    public function edit_process_insert_tool(){
	 		$admin_id = $this->session->userdata('adminid');
	 		$url_redirect = $this->input->post('current_click_level');
	    	//print_r($this->input->post()); exit;
	    	$proid=$this->input->post('process_id');
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
						"status" => '1',
						"modified_by"   => $admin_id,
						"modified_date" => date('Y-m-d H:i:s')
					);
	    	//print_r($data_array);
	    	$where="process_id=$proid";
	    	if($this->Crud_modal->update_data($where,'mm_process_generator',$data_array)){
				$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Updated.</div>');
				redirect(base_url().'edit-package-tool/'.$url_redirect);
			}else{
				$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Update Data</div>');
				redirect(base_url().'edit-package-tool/'.$url_redirect);
			}

	 	}





	public function industry_skills_map() {
	         try
		{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			{

				$data['title']='Admin Dashboard for Monday Morning';

				$data['industry_map_data']=$this->Crud_modal->all_data_select('*','mm_industry_skills_map',"status=1",'ind_skill_map_id');
				$data['skill'] = $this->Crud_modal->all_data_select('*','master_skills_test',"status=1",'skills_id');
				$data['industry'] = $this->Crud_modal->all_data_select('*','mm_master_industry_topic',"status=1",'industry_id');
				$k=0;
				foreach ($data['industry_map_data'] as $value) {
					     $skill = $value['skills_id'];
					     $industry = $value['industry_id'];
					     $skill_array = explode(',',$skill);
					     for($i=0; $i<count($skill_array); $i++){
                             $s_kill_v=$this->Crud_modal->fetch_single_data('skills_name','master_skills_test',"skills_id='$skill_array[$i]'");
                             $s_kill[$i]=$s_kill_v['skills_name'];
					     }
					     $skill = implode(',',$s_kill);
                     $data['industry_map_data'][$k]['skills_id']=$skill;
                     $indus_name = $this->Crud_modal->fetch_single_data('industry_name','mm_master_industry_topic',"industry_id='$value[industry_id]'");
                     $data['industry_map_data'][$k]['industry_id']=$indus_name['industry_name'];
					     $k=$k+1;
				}
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
				$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('industry-skills-map',$data);
				$this->load->view('admintempletes/footer');
			}
		}
		catch(Exception $e)
		{
			echo "Caught exception",$e->getMessage(),"\n";
		}
	} 		
	public function insert_industry_skill_map(){
	        $admin_id = $this->session->userdata('adminid');
	 		
	    	//print_r($this->input->post()); exit;
	    	$skills= implode(',',$this->input->post('skills'));
	    	$industry=$this->input->post('industry_id');
	    	$data_array=array(
						"skills_id" => $skills,
						"industry_id"   => $industry,
						"status" => '1',
						"created_by"   => $admin_id,
						"creation_date" => date('Y-m-d H:i:s')
					);
	    	if($this->Crud_modal->data_insert('mm_industry_skills_map',$data_array)){
				$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Updated.</div>');
				redirect(base_url().'industry-skills-map');
			}else{
				$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Update Data</div>');
				redirect(base_url().'industry-skills-map');
			}	
	} 

   public function edit_industry_skill_map(){
   	  		$val=base64_decode(str_pad(strtr($this->uri->segment(2), '-_', '+/'), strlen($this->uri->segment(2)) % 4, '=', STR_PAD_RIGHT));
	   	  $data['skill_data']=$this->Crud_modal->fetch_single_data('ind_skill_map_id,industry_id,skills_id','mm_industry_skills_map',"ind_skill_map_id='$val'");
	      $data['skill'] = $this->Crud_modal->all_data_select('*','master_skills_test',"status=1",'skills_id');
		  $data['industry'] = $this->Crud_modal->all_data_select('*','mm_master_industry_topic',"status=1",'industry_id');
		 // print_r($data['skill_data']);
	    $this->load->view('admintempletes/head',$data);
		$this->load->view('admintempletes/header',$data);	
		$this->load->view('admintempletes/sidebar',$data);
		$this->load->view('edit-industry-skills-map',$data);
		$this->load->view('admintempletes/footer');
   }

   public function edit_industry_skill_map_save(){
   	               
      

   	                $skill = $this->input->post('skills');
   	                $data_skill = implode(',', $skill); 
                    $edit = $this->input->post('edit_id');
			   	    $field=array(
			                    'industry_id'=> $this->input->post('industry_id'),
			                    'skills_id'=> $data_skill,
			                    'modification_date' =>date('Y-m-d H:i:s')
			                    );
                    $where = "ind_skill_map_id = '$edit'";
                    $tblname = 'mm_industry_skills_map';
                    if($this->Crud_modal->update_data($where,$tblname,$field)){
				     $this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Updated .</div>');
				redirect(base_url().'industry-skills-map');
			}else{
				$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Update Data</div>');
				redirect(base_url().'industry-skills-map');
			}	

   }	

   public function industries_skill_map(){
		$id = $this->input->post('industries');
		$skill_data = $this->Crud_modal->fetch_single_data('skills_id','mm_industry_skills_map',"industry_id='$id'",'ind_skill_map_id');
		$skillarray = explode(',',$skill_data['skills_id']);
		for($i=0; $i<count($skillarray); $i++){
			 $skill_info = $this->Crud_modal->fetch_single_data('skills_id,skills_name','master_skills_test',"skills_id=$skillarray[$i]",'skills_id');
			 echo '<option value='.$skill_info["skills_id"].' selected="selected">'.$skill_info["skills_name"].'</option>';
          
		}
	}
	
	 public function industries_company_data(){
		$id = $this->input->post('industries');
		$cmp = $this->input->post('company');
		$cmp_option = '';
		$skill_option = '';
		if($cmp==0){
				$company_data = $this->Crud_modal->all_data_select('employer_id,employer_company','mm_employer',"employer_industry_id='$id'","employer_industry_id='$id'",'employer_id');
				$cmp_option .= '<option value="">Select Company</option>';
				foreach($company_data as $companydata){
					$cmp_option .= '<option value='.$companydata["employer_id"].'>'.$companydata["employer_company"].'</option>';
		          
				}
                
				echo json_encode(['company_score'=>$cmp_option, 'skills'=>'']);
	    }
	    if($cmp==1){
							$skill_data = $this->Crud_modal->fetch_single_data('skills_id','mm_industry_skills_map',"industry_id='$id'",'ind_skill_map_id');
					$skillarray = explode(',',$skill_data['skills_id']);
					for($i=0; $i<count($skillarray); $i++){
						 $skill_info = $this->Crud_modal->fetch_single_data('skills_id,skills_name','master_skills_test',"skills_id=$skillarray[$i]",'skills_id');
						 $skill_option .='<option value='.$skill_info["skills_id"].'>'.$skill_info["skills_name"].'</option>';
			          
					}
                     
                     $company_data = $this->Crud_modal->all_data_select('employer_id,employer_company','mm_employer',"employer_industry_id='$id'",'employer_id');
				$cmp_option .= '<option value="">Select Company</option>';
				foreach($company_data as $companydata){
					$cmp_option .= '<option value='.$companydata["employer_id"].'>'.$companydata["employer_company"].'</option>';
		          
				}
                
					echo json_encode(['company_score'=>$cmp_option, 'skills'=>$skill_option]);
		          
				}
	    }  
	
   public function employer_skill_map(){
		$id = $this->input->post('industries');
		$cmp = $this->input->post('company');
		$skill_data = $this->Crud_modal->all_data_select('emp_skill_id,skill_name','mm_employer_skill',"indus_id='$id' and cmp_id='$cmp'",'emp_skill_id');
		foreach($skill_data as $skilldata){
			 echo '<option value='.$skilldata["emp_skill_id"].'>'.$skilldata["skill_name"].'</option>';
          
		}
	}

///   end here

	 	public function csv_file_import(){
	 		            $this->load->view('admintempletes/head');
						$this->load->view('admintempletes/header');	
						$this->load->view('admintempletes/sidebar');
						$this->load->view('file-import', $data);
						$this->load->view('admintempletes/footer');   
	 		
	 	}
	 	
	public function csv_file_import_insert(){
	 	$count=0;
        $fp = fopen($_FILES['file']['tmp_name'],'r') or die("can't open file");
        $files = $_FILES['file']['name'];
        $FileType = pathinfo($files,PATHINFO_EXTENSION);
        if($FileType == "csv"){
	        while($csv_line = fgetcsv($fp,1024))
	        {
	        	$csv_line = array_map("utf8_encode", $csv_line); //added
	            $count++;
	            if($count == 1)
	            {
	                continue;
	            }//keep this if condition if you want to remove the first row
	            for($i = 0, $j = count($csv_line); $i < $j; $i++)
	            {
	                $insert_csv = array();
	                $insert_csv['mm_user_full_name'] = trim($csv_line[5]);
	                $insert_csv['mm_user_email'] = trim($csv_line[7]);
	                

	            }
	            $i++;
	            $data = array(
	            	'user_type_id' => '2',
	                'mm_user_full_name' => $insert_csv['mm_user_full_name'],
	                'mm_user_email' => $insert_csv['mm_user_email'],
	                'user_password' => md5('rivigo123'),
	                'user_status' => '1',
	                'eamil_auth_status' => '1'
	                //user_status
	               
	        	);

	        	$data_id = $this->Crud_modal->data_insert_returnid('user', $data);
			        	if($data_id>0){
			        		$data_user = array(
			                'uid' => $data_id 
			        	);
                    $data_id = $this->Crud_modal->data_insert_returnid('user_data', $data_user);
	        	}

			}
			$this->session->set_flashdata('mcq_message','<div class="success"><strong>Success!</strong> Data Uploaded.</div>');
			redirect(base_url().'create-mcq');
		}else{
			$this->session->set_flashdata('mcq_message','<div class="success"><strong>Failed!</strong> Upload Only .CSV File</div>');
			redirect(base_url().'create-mcq');
		}
	 }
	 
	 public function get_industry_company_package(){
		$id = $this->input->post('industries');
		$cmp = $this->input->post('company');
		$pack_data = $this->Crud_modal->all_data_select('package_id,package_name','mm_packages',"industry_id='$id' and company_id='$cmp'",'package_id desc');
		echo '<select name="packs" id="packs">';
		echo '<option value="">Select Package</option>';
		foreach($pack_data as $packdata){
			echo '<option value='.$packdata["package_id"].'>'.$packdata["package_name"].'</option>';
        }
		echo '</select>';
	}
	public function update_case_study(){
 if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
	     	$val = $this->input->post('case_id');
			$oldfile = $this->input->post('caseoldFiles');
	     	$dbfiles = array();
	     	if($this->input->post('caseoldFiles')!=''){
	     		$filecount = sizeof($oldfile);
	     		for($of=0;$of<$filecount;$of++){
	     			$ofile[] = 'case_sample_files/'.$oldfile[$of];
		     	}
                if($ofile!=''){
					$dbfiles[] = implode(',', $ofile);
				}
	     	}
	     	if(isset($_FILES['caseFiles'])){
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
                            redirect(base_url().'edit-package-demo#step-6');
                        }
                    }
                }
                if($file!=''){
					$dbfiles[] = implode(',', $file);
				}
			}
			$dbfile = implode(',', $dbfiles);

			$filename = str_replace(' ', '-', (strtolower($this->input->post('case_name'))));
            if($_FILES['audiofile']['name']!=''){
                if(pathinfo($_FILES['audiofile']['name'],PATHINFO_EXTENSION)=='mp3'){
                	$mp3target_dir = './upload/case_sample_files/mediafile/';
                    $mp3target_file = $mp3target_dir .$filename.'-'.basename($_FILES['audiofile']['name']);
                    if (move_uploaded_file($_FILES['audiofile']['tmp_name'], $mp3target_file)) {
                            $mp3file  = 'case_sample_files/mediafile/'.$filename.'-'.basename($_FILES['audiofile']['name']);
                    }else{
                        $this->session->set_flashdata('item','<div class="danger"><strong>Sorry!</strong> File Audio Upload Error.</div>');
                         redirect(base_url().'edit-package-demo#step-6');
                    }
                }else{
					$this->session->set_flashdata('item','<div class="danger"><strong>Sorry!</strong> Upload only mp3 audio file.</div>');
					redirect(base_url().'edit-package-demo#step-6');
                }
            }
            if($_FILES['videofile']['name']!=''){
                if(pathinfo($_FILES['videofile']['name'],PATHINFO_EXTENSION)=='mp4'){
                	$mp4target_dir = './upload/case_sample_files/mediafile/';
                    $mp4target_file = $mp4target_dir .$filename.'-'.basename($_FILES['videofile']['name']);
                    if (move_uploaded_file($_FILES['videofile']['tmp_name'], $mp4target_file)) {
                        $mp4file  = 'case_sample_files/mediafile/'.$filename.'-'.basename($_FILES['videofile']['name']);
                    }else{
                        $this->session->set_flashdata('item','<div class="danger"><strong>Sorry!</strong> Video File Upload Error.</div>');
                        redirect(base_url().'edit-package-demo#step-6');
                    }
                }else{
					$this->session->set_flashdata('item','<div class="danger"><strong>Sorry!</strong> Upload only mp4 video file.</div>');
					redirect(base_url().'edit-package-demo#step-6');
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
			$data['case_name']=$this->input->post('case_name');
			$data['content']=$this->input->post('case_content');
			$data['case_sequence']=implode(',',$arsq);
			$data['quest_limit']=implode(',', $sqlm);
			$data['sample_file']=$dbfile;
			if($mp3file!=''){
				$data['audiofile']=$mp3file;
			}
			if($mp4file!=''){
				$data['videofile']=$mp4file;
			}
			$data['modified_date']=$this->input->post('case_name');
			$data['modified_by']=$this->input->post('adminid');

	   		$where = "case_id = '$val'";
	   		if($this->Crud_modal->update_data($where,'case_study',$data)){
				$this->session->set_flashdata('item','<div class="success"><strong>Success!</strong> Data Updated.</div>');
				redirect(base_url().'edit-package-demo#step-6');
			}else{
				$this->session->set_flashdata('item','<div class="danger"><strong>Oops!</strong> Failed to Update Data</div>');
				redirect(base_url().'edit-package-demo#step-6');
			}
		 }
		  else
		 {
		    redirect(base_url().'admin','refresh');
	     }

}
public function get_industry_package(){
                $id = $this->input->post('industries');
                $cmp = $this->input->post('company');
                $pack_data = $this->Crud_modal->all_data_select('package_id,package_name','mm_packages',"industry_id='$id'",'package_id desc');
                echo '<select name="packs" id="packs">';
                echo '<option value="">Select Package</option>';
                foreach($pack_data as $packdata){ 
                        echo '<option value='.$packdata["package_id"].'>'.$packdata["package_name"].'</option>';
        }
                echo '</select>';
        }
public function get_assignment(){
   	  if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
   	  	$id=$this->input->post("package_id"); 
   	  	$data["assignment"]=$this->Crud_modal->all_data_select("*","master_assignment","pack_id=$id","maid");
	   	echo json_encode($data);
	  }else{					
			redirect(base_url().'admin','refresh');
	  }
    }
	 public function update_assignment_data(){
      if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" ||  $this->session->userdata('admin_role')!=null)){
      	
      	    $assign_count = $this->input->post('assignn_count'); //echo $assign_count." ";
      	    $admin_id = $this->session->userdata('adminid');
      	    $package_id = $this->input->post("pack_id");
      	    for($i=0; $i<$assign_count; $i++){
      	    	$field=array(
	                    'assignment_name' => $this->input->post("assignment_name".$i),
				        'assignment_description' => $this->input->post("assignment_description".$i),
				        'number_of_level' => $this->input->post("no_level".$i),
				        'type' => $this->input->post("ass_type".$i),
                );
                $aid=$this->input->post("ass_id".$i);
    
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
					$idata=$this->Crud_modal->update_data("maid=$aid",'master_assignment',$field);
				}else{
					$idata=$this->Crud_modal->update_data("maid=$aid",'master_assignment',$field);
				}
				
	  	    }
	  
      	    if($idata){
				echo "1";
			}else{
				echo "0";
			}
       }else{					
			redirect(base_url().'admin','refresh');
	   }
  }
  public function get_level_case(){
   	  if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
   	  	$id=$this->input->post("level_id"); 
   	  	$data["level_case"]=$this->Crud_modal->fetch_single_data("*","case_study","level_id=$id");
	   	echo json_encode($data);
	  }else{					
			redirect(base_url().'admin','refresh');
	  }
  }
  public function get_instructions(){
   	  if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
   	  	$id=$this->input->post("assign_id"); 
   	  	$i=$this->input->post("instruction_id");
   	  	$data["instructions"]=$this->Crud_modal->all_data_select("*","instruction_widget","assign_id=$id and instruction_id=$i","instruction_id");
	   	echo json_encode($data);
	  }else{					
			redirect(base_url().'admin','refresh');
	  }
  }
 public function update_level_instruction(){
    if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
        $count = $this->input->post('disc_count');
        $id = $this->input->post('instruction_id');
    
        for($i=0; $i<$count; $i++){
			if(isset($_FILES["instruction_image".($i)]) && $_FILES["instruction_image".($i)]['name'] != ''){
				$file1 = $this->Admindashboard_modal->ddoo_upload("instruction_image".($i),0,'./upload/instruction');
				$filename= $_FILES["instruction_image".($i)]["name"];
				$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
				$image[$i] = $file1["upload_data"]["file_name"];
			}
			$desc = $this->input->post('image_discripton'.($i));
			if($desc !=""){
			    $description[$i] = $this->input->post('image_discripton'.($i));
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
        	//print_r($data);exit;
           $data_return=$this->Crud_modal->update_data("instruction_id=$iid",'instruction_widget',$data);
         
        }
       
        if($data_return=='1'){
            echo "1";
        }
    }else{
        redirect(base_url().'admin','refresh');
    }
    
}
public function get_package(){
   	  if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
   	  	$id=$this->input->post("package_id"); 
   	  	$data=$this->Crud_modal->fetch_single_data("*","mm_packages","package_id=$id");
	   	echo json_encode($data);
	  }else{					
			redirect(base_url().'admin','refresh');
	  }
    }
public function update_package_data(){
	 if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" ||  $this->session->userdata('admin_role')!=null)){
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
			'pack_type_id'=> $this->input->post('pack_type'),
			'description'=> $this->input->post('package_description'),
			'modified_date' =>date('Y-m-d H:i:s')
		);
	 	$config['upload_path']          = './upload/package/';
		$config['allowed_types']        = 'gif|jpg|png';
        $new_name = time().$_FILES["package_image"]['name'];
		$config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        if($this->upload->do_upload('package_image')){   
            $file=$this->upload->data();
            $field['image'] =$new_name; //echo $pack_id; print_r($field); exit;
            $data = $this->Crud_modal->update_data("package_id='$pack_id'",'mm_packages',$field); 
            if($data){ echo 1; }
        }else{
        	$data = $this->Crud_modal->update_data("package_id='$pack_id'",'mm_packages',$field); 
            if($data){ echo 1; }
        }
       }else{					
			redirect(base_url().'admin','refresh');
	   }
    }		

function get_package_type_list(){
 	$ctype = $this->input->post('company_type');
 	$where="";
 	if($ctype==0){
 		$where="status=1 and company_type=0";
 	}else{
 		$where="status=1 and company_type=1";
 	}
	$data = $this->Crud_modal->all_data_select('pack_type_id,pack_type_name','mm_master_package_type',$where,'pack_type_id');
	echo "<option value='0' selected>Select Package Type</option>";
	for($i=0; $i<count($data); $i++){
		echo '<option value='.$data[$i]["pack_type_id"].'>'.$data[$i]["pack_type_name"].'</option>';
    }
    
 }

 function get_instruction_template(){
 	$tid = $this->input->post('tool_id');
 	$data = $this->Crud_modal->all_data_select('instruction_temp_id,instruction_temp_name','instruction_widget_template',"tool_id=$tid and status=1",'instruction_temp_id');
	echo "<option value='0' selected>Choose Template</option>";
	for($i=0; $i<count($data); $i++){
		echo '<option value='.$data[$i]["instruction_temp_id"].'>'.$data[$i]["instruction_temp_name"].'</option>';
    }
    
 }
 function get_instruction_template_data(){
 	$tid = $this->input->post('temp_id');
 	$data["template"] = $this->Crud_modal->fetch_single_data('*','instruction_widget_template',"instruction_temp_id=$tid");
	echo json_encode($data);
 }
 public function get_assign_instruction(){
    $pid=$this->input->post("package_id");
    $aid=$this->input->post("assignment_id");
    $newdata = $this->Crud_modal->all_data_select('instruction_id,instruction_name','instruction_widget',"pack_id=$pid and status=1 and assign_id=$aid",'instruction_id');
    echo "<option value=''>Select Instruction</option>";
    for($i=0;$i<sizeof($newdata);$i++){
        echo "<option value='".$newdata[$i]['instruction_id']."'>".$newdata[$i]['instruction_name']."</option>";
    }
}
public function count_total_instruction(){
 	$id=$this->input->post("assignment_id");
 	$total_level = $this->Crud_modal->fetch_single_data('number_of_level','master_assignment',"maid=$id and status=1");
 	$total_instruction = $this->Crud_modal->fetch_single_data('count(instruction_id) as total','instruction_widget',"assign_id=$id and status=1");
 	if($total_level['number_of_level']<=$total_instruction["total"]){
 		echo 0;
 	}else{
 		echo 1;
 	}
 }
public function is_case_exists(){
 	$id=$this->input->post("level_id");
 	$check = $this->Crud_modal->fetch_single_data('level_id','case_study',"level_id=$id and status=1");
 	if($check['level_id']!=""){
 		echo 0;
 	}else{
 		echo 1;
 	}
 }
public function get_instruction_tool_id(){
    $id=$this->input->post("instruction_id");
    $data = $this->Crud_modal->fetch_single_data('instruction_id,tool_id','instruction_widget',"instruction_id=$id");
    if($data['tool_id']!=""){ echo trim($data['tool_id']); }else{ echo 0; }
}
public function create_subjective_tool(){
	 	try{
 			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
 				$data['title']='Admin Dashboard for Monday Morning';

				$where = 'status =1';
				$data['master_topics'] = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$where,'t_id desc');
				$data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$where,'type_id desc');
				$data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name',' master_skills_test',$where,'skills_id desc');
				$data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$where,'diffi_id desc');
				$data['master_case'] = $this->Crud_modal->all_data_select('case_id,case_name','case_study',$where,'case_id desc');
				$data['filetypelist'] = $this->Crud_modal->all_data_select('ft_extensions,ft_name','master_filetype',$where,'ft_id desc');
				//print_r($data['filetypelist']); die;
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('create-subjective-tool',$data);
				$this->load->view('admintempletes/footer');	     
		    }else{
		    	redirect(base_url().'admin','refresh');
		    }

		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	 }

	 public function insert_subjective_tool(){
		try{
			if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
				$redirect_url=$this->input->post('url_data');
				$insertdata['question'] = $this->input->post('question');
				$insertdata['topic'] = $this->input->post('master_topic');
				$insertdata['type'] = $this->input->post('master_type');
				$insertdata['skill_tested'] = $this->input->post('master_skills_test');
				$insertdata['case_id'] = $this->input->post('master_case');
				$insertdata['created_date'] = date('Y-m-d H:i:s');
				$insertdata['created_by'] = $this->session->userdata('adminid');
				$insertdata['filetype'] = $this->input->post('filetype');
				$insertdata['answer'] = $this->input->post('ans');
				$this->Crud_modal->data_insert('subjective',$insertdata);
				$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Inserted.</div>');
				redirect(base_url().'package-tool/'.$redirect_url);

			}else{
				redirect(base_url().'admin','refresh');
		    }
		}catch(Exception $e){
			echo 'Caught exception', $e->getMessage(),"\n";
		}
	}

	 public function update_subjective_tool(){
		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
			$redirect_url=$this->input->post('current_click_level');
			$id=$this->input->post('subjective_id');
			$updatedata['question'] = $this->input->post('question');
			$updatedata['topic'] = $this->input->post('master_topic');
			$updatedata['type'] = $this->input->post('master_type');
			$updatedata['skill_tested'] = $this->input->post('master_skills_test');
			$updatedata['case_id'] = $this->input->post('master_case');
			$updatedata['created_date'] = date('Y-m-d H:i:s');
			$updatedata['created_by'] = $this->session->userdata('adminid');
			$updatedata['filetype'] = $this->input->post('filetype');
			$updatedata['answer'] = $this->input->post('ans');
			$where="subjective_id='$id'";

			$sid=rtrim(strtr(base64_encode($id), '+/', '-_'), '=');

			$this->Crud_modal->update_data($where,'subjective',$updatedata);
			$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Update.</div>');
			redirect(base_url().'edit-package-tool/'.$redirect_url);
		}else{
			redirect(base_url().'admin','refresh');
		}
	}

/*Code By Khushboo-28 June 2018*/
  public function package_status_list(){
	   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
	    $data['package_type']=$this->Crud_modal->all_data_select('pack_type_id,pack_type_name','mm_master_package_type',"status=1",'pack_type_id');
	    if($this->input->post("package_type")!=""){
	      $data['packages']=$this->Crud_modal->all_data_select('package_id,package_name','mm_packages',"status=1 and pack_type_id=".$this->input->post("package_type"),'package_id desc');
	      $data['selected_pack_type']=$this->input->post("package_type");
	    }else{
	      // $data['packages']=$this->Crud_modal->all_data_select('package_id,package_name','mm_packages',"status=1 and pack_type_id in(1,2,3)",'package_id desc');
	      // $data['selected_pack_type']='';
		  $pack_type=$this->Crud_modal->fetch_single_data("packages_id","package_map","usertype_id=2");
		$pack_type_id=$pack_type['packages_id'];
		$data['packages']=$this->Crud_modal->fetchdata_with_limit('package_id,package_name','mm_packages',"status=1 and package_id in($pack_type_id)",'package_id desc',"");
	    }
	   	$this->load->view('admintempletes/head');
		$this->load->view('admintempletes/header');	
		$this->load->view('admintempletes/sidebar');
		$this->load->view('package-status-list',$data); 
		$this->load->view('admintempletes/footer');
	   }else{					
			redirect(base_url().'admin','refresh');
	   }
   }    
 public function get_package_status(){
     if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
         $package_id=$this->input->post("package_id");
         $pn=$this->Crud_modal->fetch_single_data('package_id,package_name','mm_packages',"package_id=".$package_id);
         $user_attempted=0;    $user_completed=0;  $not_attempted=0; $total_neurons=0;    $package_rank=0;
         //calculating total attempted user count
         $q1=$this->Crud_modal->fetch_single_data("count(distinct u_id) as t1, group_concat(u_id) as uids","score","package_id in($package_id)");
         $user_attempted=$q1['t1'];        $uid_list=$q1['uids'];
         if($uid_list!=""){
             $id_string=rtrim($uid_list,",");
             $q2=$this->Crud_modal->check_numrow("user","mm_uid not in($id_string)");        $not_attempted=$q2;
         }
         //calculating total neurons generated by attempted users
         $q3=$this->Crud_modal->fetch_single_data("sum(neurons) as neu","score","package_id in($package_id)");
         if($q3['neu']!=""){    $total_neurons=$q3['neu']; }
         //calculating total completed package user count
         $levels=$this->Crud_modal->check_numrow('master_level',"pack_id=$package_id");
         $res=$this->Admindashboard_modal->package_completed_user_count($package_id,$levels);
         if($res>0){
            $user_completed=$res;
         }else{
            $user_completed=0;
         }
         //calculating total not completed package user count
         $r=$this->Admindashboard_modal->package_not_completed_user_count($package_id,$levels);
         if($r>0){
            $not_completed=$r;
         }else{
            $not_completed=0;
         }
         //calculating package rank
         $get_pack_rank=floor($total_neurons/$user_attempted);
         if($get_pack_rank>0){
             if(is_infinite($get_pack_rank)){
                 $package_rank="N/A";
             }else{
                    $package_rank=$get_pack_rank; 
             }
         }else{
             $package_rank="N/A";
         }
         //encode package id
         $encode_package_id=rtrim(strtr(base64_encode($package_id), '+/', '-_'), '=');
         //getting resonse row 
         echo "<td><a class='getPackageStatusData' data-val='".$package_id."' style='cursor:pointer'>".$pn['package_name']."</a></td>"."<td><a style='cursor:pointer;color:green' href='".base_url()."package-attempted-user/".$encode_package_id."'>".$user_attempted."</a></td>"."<td>".$user_completed."</td>"."<td><a style='cursor:pointer;color:green' href='".base_url()."package-not-completed-user/".$encode_package_id."'>".$not_completed."</a></td>"."<td><a style='cursor:pointer;color:green' href='".base_url()."package-not-attempted-user/".$encode_package_id."'>".$not_attempted."</a></td>"."<td>".$total_neurons."</td>";
       }else{
           redirect(base_url().'admin','refresh');
       }
  }
   public function get_package_rank(){
	 if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
	 	$package_id=$this->input->post("package_id");
	 	$rank=$this->Admindashboard_modal->calculate_package_rank($package_id);
	 	if($rank>0){
	 		echo $rank;
	 	}else{
	 		echo "N/A";
	 	}
	 }else{
   	 	redirect(base_url().'admin','refresh');
   	 }
   }
   
    public function testcount(){
	$data_pack=$this->Crud_modal->all_data_select('group_concat(distinct u_id) as uids','score',"package_id='53'",'package_id desc');
	$ids=$data_pack[0]['uids'];
	$data_user=$this->Crud_modal->all_data_select('mm_user_email,mm_user_full_name','user',"mm_uid not in($ids) and user_status='1'",'mm_uid desc');
	echo "<table>";
	for($i=0;$i<sizeof($data_user);$i++){
		echo "<tr>";
		echo "<td>";
		echo $data_user[$i]['mm_user_email'];
		echo "</td>";
		echo "<td>"; 
		echo $data_user[$i]['mm_user_full_name'];
		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";
	// echo "<pre>";
	// print_r($data_user);
   }
   
    public function testcount1(){
	$data_pack=$this->Crud_modal->all_data_select('distinct(u_id) as uids','score',"package_id='53'",'package_id desc');
	
	// echo $this->db->last_query();
	// exit();
	echo "<table>";
	for($i=0;$i<sizeof($data_pack);$i++){
		$uid=$data_pack[$i]['uids'];
		$score=$this->Crud_modal->all_data_select('count(level_id) as count,u_id','score',"package_id='53' and u_id='$uid'",'package_id desc');
		if($score[0]['count']>0 && $score[0]['count']!=6){
			$id=$score[0]['u_id'];
			$data_user=$this->Crud_modal->fetch_single_data('mm_user_email,mm_user_full_name,mm_uid','user',"mm_uid='$id'");
			echo "<tr>";
			echo "<td>";
			echo $data_user['mm_user_email'];
			echo "</td>";
			echo "<td>"; 
			echo $data_user['mm_user_full_name'];
			echo "</td>";
			echo "</tr>";
		}
	}
	echo "</table>";
	
	
	
	// $field="u.mm_user_email,u.mm_user_full_name";
	// $table_name="user as u";
	// $join1[0]='score as s';
	// $join1[1]='s.package_id=ml.pack_id';
	// $join1[2]="left";
	// $where="mmp.status=2 and mmp.industry_id='$indus_id' and mmp.company_id='$cmp_id' and mmp.pack_type_id='$ptype' GROUP BY mmp.package_id having count(ml.ml_id)=0";
	// $data['package_datas']=$package_datas=$this->Crud_modal->fetch_data_by_one_table_join($field,$table_name,$join1,$where);
	// echo "<pre>";
	// print_r($data_user);
   }
   
   
   public function testcount_new(){
	$data_fetch_pack=$this->Crud_modal->fetch_single_data("group_concat(package_id) as pack_id","mm_packages","pack_type_id=6");
	$concat=$data_fetch_pack['pack_id'];
	$field="distinct(s.u_id)";
	$table_name="score as s";
	$join1[0]='user as u';
	$join1[1]='u.mm_uid=s.u_id';
	$join1[2]="inner";
	$where="u.user_status=1 and s.package_id in($concat) and date(u.reg_date)=CURDATE()";
	$data_set=$this->Crud_modal->fetch_data_by_one_table_join($field,$table_name,$join1,$where);
	echo sizeof($data_set);
	echo "<br>";
	$score_neurons=$this->Crud_modal->all_data_select('sum(neurons) as sum','score',"package_id in($concat) and date(created_date)=CURDATE()",'package_id desc'); 
	echo $score_neurons[0]['sum'];
	//echo "<pre>";
	//print_r($data_set);
   }
   
   public function employer_report(){
  	$field="emp.employer_id,emp.employer_company,count(*) as count";
  	$table_name="mm_employer as emp";
  	$join1[0]="mm_master_job as job";
  	$join1[1]="job.company_id=emp.employer_id";
  	$join1[2]="inner join";
  	$where="emp.employer_status='1' group by job.company_id";
  	$order="count(job.company_id) DESC";
  	$data['company']=$this->Crud_modal->fetch_data_by_one_table_join_order($field,$table_name,$join1,$where,$order);
   	$this->load->view('admintempletes/head');
	$this->load->view('admintempletes/header');	
	$this->load->view('admintempletes/sidebar');
	$this->load->view('employer-report',$data); 
	$this->load->view('admintempletes/footer');
   }

   public function employer_report_ajax(){
   	$emp_id=$this->input->post("data_val");
   	$company_details=$this->Crud_modal->fetch_single_data("employer_id,employer_company","mm_employer","employer_status='1' and employer_id='$emp_id'");
   	####published job
   	$published_job = $this->Crud_modal->check_numrow('mm_master_job',"company_id='$emp_id' and status='1'");
    if($published_job!=''){
        $data['published_job']=$published_job;
    }else{
        $data['published_job']=0;
    }
    ####unpublished job
    $un_published_jobs = $this->Crud_modal->check_numrow('mm_master_job',"company_id='$emp_id' and status='3'");
    if($un_published_jobs!=''){
       $data['un_published_jobs']=$un_published_jobs;
    }else{
        $data['un_published_jobs']=0;
    }
    ###joinings
    $job_id = $this->Crud_modal->fetch_single_data('group_concat(job_id) as job_id','mm_master_job',"company_id='$emp_id'");
    if($job_id['job_id']!=""){
    $idd=$job_id['job_id'];
    $data['joinings']=$this->Crud_modal->check_numrow('mm_user_applied_job',"job_id in($idd) and job_process_step='6-0'");
    $data['applied_job']=$this->Crud_modal->check_numrow('mm_user_applied_job',"job_id in($idd)");
    $data['offers']=$this->Crud_modal->check_numrow('mm_user_applied_job',"job_id in($idd) and job_process_step='6-0'");
    $data['unique_users']=$this->Crud_modal->all_data_select("count(distinct(uid)) as count","mm_user_applied_job","job_id in($idd)","job_id asc");
    }else{
        $data['joinings']=0;
       	$data['applied_job']=0;
    	$data['offers']=0;
    	$data['unique_users']=0;
    }
    ##view jobs
    $data['total_view_jobs']=$this->Crud_modal->check_numrow('mm_user_job_click',"employer_id ='$emp_id'");
    $encode_id=rtrim(strtr(base64_encode($emp_id), '+/', '-_'), '=');
    echo '<td><a class="getRowData"  style="cursor: pointer;">'.$company_details['employer_company'].'</a></td><td><a href="'.base_url().'published-admin-job/'.$encode_id.'">'.$data['published_job'].'</a></td><td><a href="'.base_url().'unpublished-admin-job/'.$encode_id.'">'.$data['un_published_jobs'].'</a></td><td>'.$data['applied_job'].'</td><td>'.$data['offers'].'</td><td>'.$data['offers'].'</td><td>'.$data['joinings'].'</td><td></td><td>'.$data['unique_users'][0]['count'].'</td>';
   }

   public function published_admin_job(){
   	$cmp_id=$this->uri->segment(2);
   	$val = base64_decode(str_pad(strtr($cmp_id, '-_', '+/'), strlen($cmp_id) % 4, '=', STR_PAD_RIGHT));
   	$data['published_job']=$this->Crud_modal->all_data_select("job_id,job_title","mm_master_job","company_id='$val' and status='1'","job_id ASC");
   	print_r($data['published_job']);
   }

   public function unpublished_admin_job(){
   	$cmp_id=$this->uri->segment(2);
   	$val = base64_decode(str_pad(strtr($cmp_id, '-_', '+/'), strlen($cmp_id) % 4, '=', STR_PAD_RIGHT));
   	$data['unpublished_job']=$this->Crud_modal->all_data_select("job_id,job_title","mm_master_job","company_id='$val' and status='3'","job_id ASC");
   	print_r($data['unpublished_job']);
   }

 
 

}