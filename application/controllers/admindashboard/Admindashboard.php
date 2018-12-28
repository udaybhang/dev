<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admindashboard extends MX_Controller {
	
	
  function __construct()
   {
						parent::__construct();
						error_reporting(0);
						$this->load->model('Admindashboard_modal');
						$this->load->model('crud/Crud_modal');
						$this->load->model('score/Score_model');
						$this->load->model('userdashboard/Userdashboard_modal'); 
						$this->load->helper('url');
						$this->load->library('session'); 
						$this->load->library('Phpmailer');
						$this->load->library('pagination');
                        $this->load->model('Pagination_model',"pgn");
						ini_set('memory_limit', '-1');
   }
		public function dashboard(){
			
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
		     			ini_set('max_execution_time', 120); //120 seconds
						
				    	// $data['title']='Admin Dashboard for Monday Morning';
			     		// $data['totaluser']=$this->Admindashboard_modal->total_reg_user();
						// $usertype=$this->input->post('usertype');
						// if($usertype != ''){
						// $whereas = "user_type_id = '$usertype'";
						// $data['reg_user_data']=$this->Crud_modal->all_data_select('*','user',$whereas,'mm_uid desc');
						// $data['usert']=$usertype;
						// }
						// else{
							// $data['reg_user_data']=$this->Crud_modal->fetch_alls('user','mm_uid desc');
						// }
                  
						// $data['assign_user_data']=$this->Admindashboard_modal->all_completed_assignment_with_user();
						// $data['goingon_assign_user_data']=$this->Admindashboard_modal->all_going_assignment_with_user();
						// $data['user_type']=$this->Crud_modal->fetch_alls('user_type','user_type_id desc');
						
						// $data['case_unched']=$this->Admindashboard_modal->alldatawith_group_order('*','case_subjective_user_ans',"status=0",'c_s_u_a_id asc');
						// $data['user_data']=$this->Admindashboard_modal->all_data();
						// $data['score']=$this->Admindashboard_modal->all_score();
						// $data['ticket_closed']=$this->Crud_modal->check_numrow('mm_ticket',"status='0'");
						// $data['ticket_open']=$this->Crud_modal->check_numrow('mm_ticket',"status='1'");
						
							// if($this->input->post('fromdate')!="" && $date_to=$this->input->post('todate') !=""){
                                     // $date1=$this->input->post('fromdate');
                                     // $date2=$this->input->post('todate');
                                      // $date_from = date("Y-m-d", strtotime($date1));
                                      // $date_to = date("Y-m-d", strtotime($date2.'+1 days'));
                                      // $data['f_date']=$date1;
                                      // $data['t_date']=$date2;

                                    
                                 // }
                                 // else{
                                          // $date_to = date('Y-m-d');
                                          // $date_to = date('Y-m-d',strtotime($date_to.'+1 days'));
                                          // $date_from = date('Y-m-d', strtotime($date_to. ' - 3 days'));
                                          // $data['f_date']=date("m/d/Y", strtotime($date_from));
                                           // $data['t_date']=date("m/d/Y", strtotime($date_to.' - 1 days'));
    
                                 // }
							// $all_dates=$this->Admindashboard_modal->all_dailyreport_activity($date_from, $date_to);
							// $i=0;
							// foreach ($all_dates as $all_date) {
								
							// $date = $all_date['date']; 
							// $userdata[$i]['date']=date('d-m-Y',strtotime($date));//die;
							// $userdata[$i]['user']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)='$date'");// total user on this date(new user)
							
							// $userdata[$i]['assignment']= $this->Crud_modal->check_numrow('completed_level',"DATE(end_time)='$date' and status = 1");// complete assignment on this date
							// $neurons= $this->Admindashboard_modal->all_dailyreport_neurons("DATE(created_date)='$date'");
							// $userdata[$i]['neurons']= $neurons['neurons'];
							// $userdata[$i]['alluser']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)<='$date'");///
							// $temp_val=$this->Crud_modal->all_data_select("mm_uid","user","DATE(reg_date)='$date'","mm_uid DESC");
							// //print_r($temp_val); 
							// // code for old user
                             // $today_user = $this->Admindashboard_modal->all_distinct_data_select("uid","completed_level","DATE(end_time)='$date' and status=1","uid DESC");
                            
                             // $old_user = 0;
                             // $new_user = 0;
                             // $tottl = count($today_user);
                             // $temp1 = '';
                             // $temp2 = '';
                             // for($s=0; $s<$tottl; $s++){
                                   // $uuid =  $today_user[$s]['uid'];
                                   // $reg_date=$this->Crud_modal->fetch_single_data("reg_date","user","mm_uid='$uuid' and user_status='1'");
															 
                                   // if(DATE("Y-m-d",strtotime($reg_date['reg_date']))==$date){
		                                 
									    // if($s==0){
		                                   // $temp2=$today_user[$s]['uid'];
		                                   // }else{
		                                   	// $temp2.=','.$today_user[$s]['uid'];
		                                   // }
                                       // $new_user++;
                                   // }
                                   	// else{
										
                                   		   // if($s==0){
		                                   // $temp1=$today_user[$s]['uid'];
		                                   // }else{
		                                   	// $temp1.=','.$today_user[$s]['uid'];
		                                   // }
                                       // $old_user++;
                                   	// }

                             // }
							 // $new_user_neuran='';
							 // $old_user_neuran='';
                             // $old_user_id = trim($temp1,','); 
                             // $new_user_id = trim($temp2,',');
                             // if($old_user_id !=''){
                                  // $old_user_neuran=$this->Crud_modal->all_data_select("sum(neurons) as neuran","score","u_id in($old_user_id) ","score_id DESC");
								   // $userdata[$i]['old_neuan'] = $old_user_neuran[0]['neuran'];
                             // }else{
								 // $userdata[$i]['old_neuan']='';
							 // }
                             // if($new_user_id !=''){
                             	// $new_user_neuran=$this->Crud_modal->all_data_select("sum(neurons) as neuran","score","u_id in($new_user_id) and date(created_date)='$date'","score_id DESC");
								// $userdata[$i]['new_neuan'] = $new_user_neuran[0]['neuran'];
                             // }else{
								 // $userdata[$i]['new_neuan']='';
							 // }
                      
                            
                             
                             // $userdata[$i]['old'] = $old_user;
							 // $sizeof=sizeof($temp_val);//die;
							// $count_val=0;
							// $cc=0;
							// if($sizeof>0){
							// $ttt=0;
							// for($k=0;$k<$sizeof;$k++){
							// $uid=$temp_val[$k]['mm_uid'];
	                          // $ttt=$this->Crud_modal->check_numrow('completed_level',"uid='$uid' and date(end_time)='$date' and status=1");
	                          // if($ttt>0){
	                          // $count_val+=1;
	                          // $cc+=$ttt;
	                          // }
							// }
							// $userdata[$i]['allusercount']=$count_val;
							// }else{
							// $userdata[$i]['allusercount']=$count_val;
							// }
							// $userdata[$i]['new_assignment']=$userdata[$i]['assignment']-$cc; // attempted package of old user
							// $userdata[$i]['old_assignment']=$cc;  // attempted package of new user
							// $i++;
							// }
							
							// $data['all_dates']=$userdata; 
						// ####### new code for attemped new user / attemped old user / end here ###########
						// $all_dates=$this->Admindashboard_modal->all_dailyreport_activity($date_from, $date_to);
						// $i=0;
						// foreach ($all_dates as $all_date) {
							// $date = $all_date['date'];
							// $userdata[$i]['date']=date('d-m-Y',strtotime($date));
							// $userdata[$i]['user']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)='$date'");
							// $userdata[$i]['assignment']= $this->Crud_modal->check_numrow('completed_level',"DATE(end_time)='$date'");
							// $neurons= $this->Admindashboard_modal->all_dailyreport_neurons("DATE(created_date)='$date'");
							// $userdata[$i]['neurons']= $neurons['neurons'];
							// $userdata[$i]['alluser']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)<='$date'");
							// $i++; 
						// }
						// $data['all_dates']=$userdata; 
						########### daily report ###############
						##### package count #########

						$this->load->view('admintempletes/head',$data);
						$this->load->view('admintempletes/header',$data);	
						$this->load->view('admintempletes/sidebar',$data);
						$this->load->view('index',$data,$olduser); 
						$this->load->view('admintempletes/footer');
						//$this->load->view('admintempletes/foot');
				 }else{					
				    redirect(base_url().'admin','refresh');
			     }			
	}
	public function reg_user()
    {
         try
            {
                   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
             {
                    $data['title']='Admin Dashboard for Monday Morning';
                                               
					   if($this->input->post('fromdate')!="" && $date_to=$this->input->post('todate') !=""){
                                     $date1=$this->input->post('fromdate');
                                     $date2=$this->input->post('todate');
                                      $date_from = date("Y-m-d", strtotime($date1));
                                      $date_to = date("Y-m-d", strtotime($date2.'+1 days'));
                                      $data['f_date']=$date1;
                                      $data['t_date']=$date2;

                                    
                                 }
                                 else{
                                          $date_to = date('Y-m-d');
                                          $date_to = date('Y-m-d',strtotime($date_to.'+1 days'));
                                          $date_from = date('Y-m-d', strtotime($date_to. ' - 10 days'));
                                          $data['f_date']=date("m/d/Y", strtotime($date_from));
                                           $data['t_date']=date("m/d/Y", strtotime($date_to.' - 1 days'));
    
                                 }

                    $data['totaluser']=$this->Admindashboard_modal->new_total_reg_user($date_to, $date_from);
                    $this->load->view('admintempletes/head',$data);
                    $this->load->view('admintempletes/header',$data);    
                    $this->load->view('admintempletes/sidebar',$data);
                    $this->load->view('registered_user',$data);
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
	
 public function caf_user()
 {
	
	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
			      if($this->input->post('fromdate')!="" && $date_to=$this->input->post('todate') !=""){
                                   $date1=$this->input->post('fromdate');
                                   $date2=$this->input->post('todate');
                                    $date_from = date("Y-m-d", strtotime($date1));
                                    $date_to = date("Y-m-d", strtotime($date2.'+1 days'));
                                    $data['f_date']=$date1;
                                    $data['t_date']=$date2;

                                 
                               }
                               else{
                                        $date_to = date('Y-m-d');
                                        $date_to = date('Y-m-d',strtotime($date_to.'+1 days'));
                                        $date_from = date('Y-m-d', strtotime($date_to. ' - 10 days'));
                                        $data['f_date']=date("m/d/Y", strtotime($date_from));
                                         $data['t_date']=date("m/d/Y", strtotime($date_to.' - 1 days'));
 
                               }
                        $data['totaluser']=$this->Admindashboard_modal->new_total_reg_user($date_to, $date_from);
						$data['mm_pro']=$this->Crud_modal->fetch_alls('user_data','uid asc');
						$this->load->view('admintempletes/head',$data);
						$this->load->view('admintempletes/header',$data);	
					  $this->load->view('admintempletes/sidebar',$data);
						$this->load->view('caf_user',$data);
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

 public function all_caf_users()
 {
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
			      $data['totaluser']=$this->Admindashboard_modal->total_reg_user();
						$data['mm_pro']=$this->Crud_modal->fetch_alls('user_data','uid asc');
$data['user_data']=$this->Admindashboard_modal->all_data();
						$this->load->view('admintempletes/head',$data);
						$this->load->view('admintempletes/header',$data);	
					  $this->load->view('admintempletes/sidebar',$data);
						$this->load->view('view_caf_users',$data);
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
 public function new_registration()
 {
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
			      $data['totaluser']=$this->Admindashboard_modal->total_reg_user();
						$data['mm_pro']=$this->Crud_modal->fetch_alls('user_data','uid asc');
						$this->load->view('admintempletes/head',$data);
						$this->load->view('admintempletes/header',$data);	
					  $this->load->view('admintempletes/sidebar',$data);
						$this->load->view('new-registration',$data);
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
 public function recent_assign()
 {
	   	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
			      $data['totaluser']=$this->Admindashboard_modal->total_reg_user();
						$data['mm_pro']=$this->Crud_modal->fetch_alls('user_data','uid asc');
						$this->load->view('admintempletes/head',$data);
						$this->load->view('admintempletes/header',$data);	
					  $this->load->view('admintempletes/sidebar',$data);
						$this->load->view('recent-uploaded',$data);
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
  public function user_score()
 {
	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
				    $v=$this->uri->segment(2);
			     $data['score']=$this->Admindashboard_modal->all_score_user($v);
			   
						$this->load->view('admintempletes/head',$data);
						$this->load->view('admintempletes/header',$data);	
					  $this->load->view('admintempletes/sidebar',$data);
						$this->load->view('user_score',$data);
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
// Sohrab
 public function create_assignment()
 {
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
						$data['user_type']=$this->Crud_modal->fetch_alls('user_type','user_type_id asc');
						$this->load->view('admintempletes/head',$data);
						$this->load->view('admintempletes/header',$data);	
					  $this->load->view('admintempletes/sidebar',$data);
						$this->load->view('create-assignment',$data);
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


 public function candidate_level()
 {
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
						$data['mm_pro']=$this->Crud_modal->fetch_alls('user_data','uid asc');
						$this->load->view('admintempletes/head',$data);
						$this->load->view('admintempletes/header',$data);	
					  $this->load->view('admintempletes/sidebar',$data);
						$this->load->view('candidate-level',$data);
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

  public function assignment_list()
 {
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
						$data['lists'] = $this->Admindashboard_modal->total_assign_list('1','DESC');
						$this->load->view('admintempletes/head',$data);
						$this->load->view('admintempletes/header',$data);	
					 	$this->load->view('admintempletes/sidebar',$data);
						$this->load->view('assignment-lists',$data);
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
   public function assignment_trash()
 {
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
						$data['lists'] = $this->Admindashboard_modal->total_assign_list('0','DESC');
						$this->load->view('admintempletes/head',$data);
						$this->load->view('admintempletes/header',$data);	
					 	$this->load->view('admintempletes/sidebar',$data);
						$this->load->view('assignment-trash',$data);
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

  public function level_score()
 {
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
						$this->load->view('admintempletes/head',$data);
						$this->load->view('admintempletes/header',$data);	
					  $this->load->view('admintempletes/sidebar',$data);
						$this->load->view('level-score',$data);
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
  public function create_assign()
 {
	  	try
			{
				if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			    {
			    	
					$assign_name = $this->input->post('assignment_name');
					$assignment_description = $this->input->post('assignment_description');
					$assign_lvl = $this->input->post('assign_lvl');
					$start_date = $this->input->post('start_date');
					$end_date = $this->input->post('end_date');
					$ass_type = $this->input->post('ass_type');
					$admin_id = $this->session->userdata('adminid');
					$user_type=$this->input->post('user_type');
				
					$package_hrs=$this->input->post('package_hrs');
					$assign_date = date('Y-m-d H:i:s');
					if($this->Admindashboard_modal->total_assign_id()){
						$data['totalid']=$this->Admindashboard_modal->total_assign_id();
						$newid = intval(str_replace("AS-","",$data['totalid']['mas_id']))+1; 
						$mas_id = "AS-$newid";
					}else{
						$mas_id = 'AS-101';
					}
					$ran_val = rand(111111,999999);
					
					$createdata = array(
					        'assignment_name' => $assign_name,
					        'assignment_description' => $assignment_description,
					        'created_date' => $assign_date,
					        'created_by' => $admin_id,
					        'number_of_level' => $assign_lvl,
					        'mas_id' => $mas_id,
					        'ran_val' => $ran_val,
					         'start_date' => date('Y-m-d',strtotime($start_date)),
					        'end_date' => date('Y-m-d',strtotime($end_date)),
					        'type' => $ass_type
					);
					$config['upload_path']          = './upload/assignment/';
					$config['allowed_types']        = 'gif|jpg|png';
					$new_name = time().$_FILES["image"]['name'];
					$config['file_name'] = $new_name;

					$this->load->library('upload', $config);
					if ($this->upload->do_upload('image'))
					{
						$file=$this->upload->data();
						$createdata['image']=$file['file_name'];
							
						$this->Admindashboard_modal->assign_insert($createdata);
						$this->session->set_flashdata('assign_message','<div class="success"><strong>Success!</strong> Assignment Submitted</div>');
							redirect(base_url().'assignment-lists');
					}else{
						//$error = array('error' => $this->upload->display_errors());
						$this->session->set_flashdata('assign_message','<div class="danger"><strong>Oops!</strong>Error</div>');     
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

  public function delete_assign()
 {
	  	try
			{
				if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			    {
			    	$assign_id = $_POST['assignid'];
			    	if($this->Admindashboard_modal->assign_delete('maid',$assign_id,'status','0','master_assignment')){
			    		$this->Admindashboard_modal->assign_delete('maid',$assign_id,'ml_status','0','master_level');
			    		$this->Admindashboard_modal->assign_delete('ma_id',$assign_id,'status','0','task');
			    		//$this->Admindashboard_modal->assign_delete('ma_id',$assign_id,'status','0','assesment_maping');
			    		echo '{"msg":"Assignment Deleted"}';
			    	}else{
			    	 	echo '{"msg":"Some Error"}';
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
   public function restore_assign()
 {
	  	try
			{
				if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			    {
			    	$assign_id = $_POST['assignid'];
			    	if($this->Admindashboard_modal->assign_delete('maid',$assign_id,'status','1','master_assignment')){
			    		echo '{"msg":"Assignment Restored"}';
			    	}else{
			    		echo '{"msg":"Some Error"}';
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

public function edit_assign_form(){
 	try
	{
		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	    {
	    	$assign_id = $this->input->post('assignid');
	    	$r = $this->Admindashboard_modal->assign_value($assign_id);
	    	$r1 = $this->Admindashboard_modal->levelsize_assign($assign_id);
	    	echo '{"assignment_name":"'.$r['assignment_name'].'","start_date":"'.$r['start_date'].'","assignment_description":"'.$r['assignment_description'].'","previous_image":"'.$r['image'].'","type":"'.$r['type'].'","number_of_level":"'.$r['number_of_level'].'","mas_id":"'.$r['mas_id'].'","sizelevel":"'.$r1.'"}';
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
public function assign_update(){
 	try
	{
		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	    {

	    	$asnumber = trim($this->input->post('assignment_number'));
	    	$assignment_name = trim($this->input->post('assignment_name'));
	    	$assignment_description = trim($this->input->post('assignment_description'));
	    	$assign_lvl = trim($this->input->post('assign_lvl'));
	    	$assignment_type = trim($this->input->post('assignment_type'));
	    	$user_type=trim($this->input->post('user_type'));
	    	$start_date=date("Y-m-d",strtotime($this->input->post('start_date')));
	    	$validity=$this->input->post('validity');
	    	$package_hrs=$this->input->post('package_hrs');
	    	$prec=$this->input->post('previous_image');
	    	$update_data = array(
	    		'assignment_name' => $assignment_name,
	    		'assignment_description' => $assignment_description,
	    		'type' => $assignment_type,
	    		'start_date'=>$start_date,
	    		'number_of_level' => $assign_lvl
	    	);
	    	if($_FILES["image"]['name']!='')
	    	{
				$config['upload_path']          = './upload/assignment/';
				$config['allowed_types']        = 'gif|jpg|png';
				$new_name = time().$_FILES["image"]['name'];
				$config['file_name'] = $new_name;

				$this->load->library('upload', $config);
				if ($this->upload->do_upload('image'))
				{
					$file=$this->upload->data();
					$update_data['image'] =$file['file_name'];
					
					unlink('./upload/assignment/'.$prec);
				}
			}
			
	    	if($this->Admindashboard_modal->assignment_update($update_data,$asnumber)){
				$this->session->set_flashdata('assign_update_message','<div class="success"><strong>Success!</strong> Assignment Updated</div>');
				redirect(base_url().'assignment-lists');
	    	}else{
				$this->session->set_flashdata('assign_update_message','<div class="danger"><strong>Oops!</strong> Assignment Update Failed</div>');
				redirect(base_url().'assignment-lists');
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

 public function create_level()
 {
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
						$this->load->view('admintempletes/head',$data);
						$this->load->view('admintempletes/header',$data);	
					  	$this->load->view('admintempletes/sidebar',$data);
					  	$data['assignlist'] = $this->Admindashboard_modal->total_assign_list('1','DESC');
						$this->load->view('create-level',$data);
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

// Update by Sohrab 11-08-2018
public function get_assignment_level(){
     try
        {
               if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
         {
         	  $permission_array=$this->session->userdata('permission_array');
				 for($i=0;$i<sizeof($permission_array);$i++){
				        $p =$this->Crud_modal->fetch_single_data('permission_description','master_permission',"permission_id='$permission_array[$i]'");
				        $permission[] = $p["permission_description"];
				 }
             $val = $this->input->post('assignid');
             $atype = $this->Crud_modal->fetch_single_data("type","master_assignment","maid='$val'");
             $r = $this->Admindashboard_modal->assignment_level_num($val);
             $rl = $this->Admindashboard_modal->master_level_num($val);
             $wheretype = 'status = "1"';
             $types = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$wheretype,'t_id desc');
             $skills = $this->Crud_modal->all_data_select('skills_id,skills_name','master_skills_test',$wheretype,'skills_id desc');
			 $lists=$this->Crud_modal->all_data_select('instruction_id,instruction_name','instruction_widget',$wheretype,'instruction_id desc');
			 $typelists=$this->Crud_modal->all_data_select('id,name','master_level_type',$wheretype,'id desc');
			 $dlevels=$this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$wheretype,'diffi_id asc');
             $level_count = $this->Admindashboard_modal->count_level($val);
             $a=1;
            if($atype['type']=='Manual'){
                echo '<div class="col-md-2" style="padding:3px; font-weight:800;">Level Name</div>';
                echo '<div class="col-md-1" style="padding:3px; font-weight:800;">Time Limit</div>';
                echo '<div class="col-md-1" style="padding:3px; font-weight:800;">D Level</div>';
                echo '<div class="col-md-2" style="padding:3px; font-weight:800;">Description</div>';
				echo '<div class="col-md-2" style="padding:3px; font-weight:800;">Key Competency</div>';
		
                echo '<div class="col-md-4" style="padding:3px; font-weight:800;">
						<div style="width:80%; float:left;"><span style="width:50%;float:left;">Start Date</span><span style="width:50%;float:left;">Start Time</span></div>
					</div>
                </div>';
            }else{
				echo '<div class="col-md-1" style="padding:3px; font-weight:800;">Level Name</div>';
				echo '<div class="col-md-1" style="padding:3px; font-weight:800;">Instruction</div>';
				echo '<div class="col-md-1" style="padding:3px; font-weight:800;">Level Type</div>';
				echo '<div class="col-md-1" style="padding:3px; font-weight:800;">Time Limit</div>';
				echo '<div class="col-md-1" style="padding:3px; font-weight:800;">Level Topic</div>';
				echo '<div class="col-md-1" style="padding:3px; font-weight:800;">Skills</div>';
				echo '<div class="col-md-1" style="padding:3px; font-weight:800;">D Level</div>';
				echo '<div class="col-md-1" style="padding:3px; font-weight:800;">Q Limit</div>';
				echo '<div class="col-md-1" style="padding:3px; font-weight:800;">Description</div>';
				echo '<div class="col-md-1" style="padding:3px; font-weight:800;">Key Competency</div>';
				echo '<div class="col-md-2" style="padding:3px; font-weight:800;"><div style="width:80%; float:left;"><span style="width:50%;float:left;">Start Date</span><span style="width:50%;float:left;">Start Time</span></div></div>';
			}
            foreach ($rl as $value) {
             	if($atype['type']=='Manual'){

	                echo '<div class="col-md-2" style="padding:3px;">
	                          <input type="text" class="form-control" value="'.$value['lvl_name'].'" maxlength="80" disabled=disabled id="name_'.$value['ml_id'].'" />
	                      </div>';
	                echo '<div class="col-md-1" style="padding:3px;">
							<input class="form-control timeformatExample1" type="text" name="timerange[]" value="'.$value['time_limit'].'" placeholder="Time Limit (HH:MM:SS)" id="time_'.$value['ml_id'].'" disabled="disabled" required="required" />
						</div>';
echo '<div class="col-md-1" style="padding:3px;">
						<select class="form-control" name="dlevel[]" id="dlevel_'.$value['ml_id'].'" disabled="disabled">';
							foreach ($dlevels as $dlevel) {
								if($dlevel['diffi_id']==$value['d_level']){
			                 		$dlevelsel=' selected="selected"';
			                 	}else{
			                 		$dlevelsel='';
			                 	}
							echo '<option value="'.$dlevel['diffi_id'].'" '.$dlevelsel.'>'.$dlevel['difficulty_level'].'</option>';
							}
						echo '</select>
					</div>';
					// changed here complete
					
					echo '<div class="col-md-2" style="padding:3px;">
	                          <input type="text" class="form-control" value="'.$value["description"].'" placeholder="Discription" disabled="disabled" maxlength="200"  name="dicription[]"  id="dicription_'.$value['ml_id'].'"/>
	                      </div>';
	                echo '<div class="col-md-2" style="padding:3px;">
	                          <input type="text" class="form-control" value="'.$value["key_competency_assessed"].'" placeholder="Key Competency" disabled="disabled" maxlength="200"  name="key_competency[]" id="key_competency_'.$value['ml_id'].'" />
	                      </div>';
	                      
	                echo '<div class="col-md-4">
						<div style="width:80%; float:left;">
						<input type="text" class="form-control start_date" name="start_date" id="startdate_'.$value['ml_id'].'" value="';
						if($value['start_date_time']!='0000-00-00 00:00:00'){
							echo date('d-m-Y',strtotime($value['start_date_time']));
						}
						echo '" placeholder="Start Date" disabled="disabled" style="width:50%;float:left;" />
						<input type="text" class="form-control timeformatExample1" name="starttime" placeholder="Start Time" id="starttime_'.$value['ml_id'].'" disabled="disabled" value="';
						if($value['start_date_time']!='0000-00-00 00:00:00'){
							echo date('H:i:s',strtotime($value['start_date_time']));
						}
						echo '" style="width:50%;float:left;" />
						</div>';
						
	                	echo '<div style="width:10%; text-align:center; float:left;" class="editlevellink " id="'.$value['ml_id'].'">';
	                	// checking for Edit permission-start
	                	if(in_array("Edit", $permission)){
	                		echo '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'; 
	                	}
	                	// checking for Edit permission-ends
	                	echo '</div>
	                </div>';
	                	
	                $a++;
	            }else if($atype['type']=='Automatic'){
                echo '<div class="col-md-1" style="padding:3px;">
                          <input type="text" class="form-control" value="'.$value['lvl_name'].'" maxlength="80" disabled=disabled id="name_'.$value['ml_id'].'" /> 
                      </div>
                	<div class="col-md-1" style="padding:3px;"><select id="inst_'.$value['ml_id'].'" disabled="disabled" class="form-control" ><option value="">Select Instruction</option>';
             		foreach ($lists as $list) {
	                 	if($list['instruction_id']==$value['inst_id']){
	                 		$sel='selected="selected"';
	                 	}else{
	                 		$sel='';
	                 	}
	                 	echo '<option value="'.$list['instruction_id'].'" '.$sel.'>'.$list['instruction_name'].'</option>';
                 	}
	                echo '</select></div>';

	                echo '<div class="col-md-1" style="padding:3px;">
						<select class="form-control" name="mlvltype" id="mlvltype_'.$value['ml_id'].'" disabled="disabled">
						<option value="">Type</option>';
							foreach ($typelists as $typelist) {
								if($typelist['id']==$value['m_type']){
			                 		$mtypesel=' selected="selected"';
			                 	}else{
			                 		$mtypesel='';
			                 	}
								echo '<option value="'.$typelist['id'].'" '.$mtypesel.'>'.$typelist['name'].'</option>';
							}
						echo '</select>
					</div>';

	                echo '<div class="col-md-1" style="padding:3px;"><input class="form-control timeformatExample1" disabled="disabled" type="text" name="timerange" id="time_'.$value['ml_id'].'" placeholder="Time Limit (HH:MM:SS)" value="'.$value['time_limit'].'" required="required" /></div>';
					echo '<div class="col-md-1" style="padding:3px;">
						<select class="form-control" name="lvltype" id="lvltype_'.$value['ml_id'].'" disabled="disabled" style="padding:6px 3px;">';
							foreach ($types as $type) {
								if($type['t_id']==$value['level_type']){
			                 		$typesel=' selected="selected"';
			                 	}else{
			                 		$typesel='';
			                 	}
								echo '<option value="'.$type['t_id'].'" '.$typesel.'>'.$type['t_name'].'</option>';
							}
						echo '</select>
					</div>';
					echo '<div class="col-md-1" style="padding:3px;">
						<select class="form-control" name="skills" id="skills_'.$value['ml_id'].'" disabled="disabled" style="padding:6px 3px;">';
							foreach ($skills as $skill) {
								if($skill['skills_id']==$value['skills']){
			                 		$skillsel=' selected="selected"';
			                 	}else{
			                 		$skillsel='';
			                 	}
								echo '<option value="'.$skill['skills_id'].'" '.$skillsel.'>'.$skill['skills_name'].'</option>';
							}
						echo '</select>
					</div>';
					echo '<div class="col-md-1" style="padding:3px;">
						<select class="form-control" name="dlevel" id="dlevel_'.$value['ml_id'].'" disabled="disabled">';
							foreach ($dlevels as $dlevel) {
								if($dlevel['diffi_id']==$value['d_level']){
			                 		$dlevelsel=' selected="selected"';
			                 	}else{
			                 		$dlevelsel='';
			                 	}
							echo '<option value="'.$dlevel['diffi_id'].'" '.$dlevelsel.'>'.$dlevel['difficulty_level'].'</option>';
							}
						echo '</select>
					</div>';
					echo '<div class="col-md-1" style="padding:3px;">
						<input type="text" class="form-control" name="q_limit" placeholder="Q Limit" id="qlimit_'.$value['ml_id'].'" disabled="disabled" value="'.$value['q_limit'].'" />
					</div>';
					// changed here complete
					
					echo '<div class="col-md-1" style="padding:3px;">
	                          <input type="text" class="form-control" value="'.$value["description"].'" disabled="disabled" maxlength="200"  name="dicription[]"  placeholder="Discription" id="dicription_'.$value['ml_id'].'"/>
	                      </div>';
	                echo '<div class="col-md-1" style="padding:3px;">
	                          <input type="text" class="form-control" value="'.$value["key_competency_assessed"].'" placeholder="Key Competency" disabled="disabled" maxlength="200"  name="key_competency[]" id="key_competency_'.$value['ml_id'].'" />
	                      </div>';
	                      
					echo '<div class="col-md-2" style="padding:3px;">
						<div style="width:80%; float:left;">
						<input type="text" class="form-control start_date" name="start_date" id="startdate_'.$value['ml_id'].'" value="';
						if($value['start_date_time']!='0000-00-00 00:00:00'){
							echo date('d-m-Y',strtotime($value['start_date_time']));
						}
						echo '" placeholder="Start Date" disabled="disabled" style="width:50%;float:left;" />
						<input type="text" class="form-control timeformatExample1" name="starttime" placeholder="Start Time" id="starttime_'.$value['ml_id'].'" disabled="disabled" value="';
						if($value['start_date_time']!='0000-00-00 00:00:00'){
							echo date('H:i:s',strtotime($value['start_date_time']));
						}
						echo '" style="width:50%;float:left;" />
						</div>';
						echo '<div style="width:10%; text-align:center; float:left;" class="editlevellink" id="'.$value['ml_id'].'">';
						// checking for Edit permission-start
						if(in_array("Edit", $permission)){
	                	echo '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>';
	                	
	            		}
	            		// checking for Edit permission-end
	            		echo '</div></div>';
	            	}
         		}
				$blank_input=$r['number_of_level']- $level_count['total'];
				for($i=1;$i<=$blank_input;$i++){
					if($atype['type']=='Manual'){
						echo '<div class="col-md-2" style="padding:3px; background-color: red"><input type="text" class="form-control" name="levels[]" placeholder="Level Name" maxlength="80" required="required" /></div>';
						echo '<div class="col-md-1" style="padding:3px;">
							<input class="form-control timeformatExample1" type="text" name="timerange[]" placeholder="Time Limit (HH:MM:SS)" required="required" />
						</div>';
						echo '<div class="col-md-1" style="padding:3px;">
							<select class="form-control" name="dlevel[]">';
								foreach ($dlevels as $dlevel) {
								echo '<option value="'.$dlevel['diffi_id'].'">'.$dlevel['difficulty_level'].'</option>';
								}
							echo '</select>
						</div>';
						/// changed here complete
					
					echo '<div class="col-md-2" style="padding:3px;">
	                          <input type="text" class="form-control"  maxlength="200"  name="dicription[]"  placeholder="Discription"/>
	                           <input type="hidden" class="form-control"  maxlength="200"  value="manual" name="checkman"  placeholder="Discription"/>
	                      </div>';
	                echo '<div class="col-md-2" style="padding:3px;">
	                          <input type="text" class="form-control"  maxlength="200"  name="key_competency[]" placeholder="Key Competency"/>
	                      </div>';
						echo '<div class="col-md-4" style="padding:3px;">
							<div style="width:80%; float:left;">
								<input type="text" class="form-control start_date" name="start_date[]" placeholder="Start Date" style="width:50%;float:left;"  required="required" />
								<input type="text" class="form-control timeformatExample1" name="starttime[]" placeholder="Start Time"   required="required" style="width:50%;float:left;" />
							</div>
							<input type="hidden" name="ins[]" />
							<input type="hidden" name="lvltype[]" />
							<input type="hidden" name="mlvltype[]" />
		                </div>';
						$a++;
		            }else if($atype['type']=='Automatic'){
						echo '<div class="col-md-1" style="padding:3px;"><input type="text" class="form-control" name="levels[]" placeholder="Level Name" maxlength="80" required="required" /></div>';
						echo '<div class="col-md-1" style="padding:3px; ">
							<select name="ins[]" class="form-control" required="required">
								<option value="">Select Instruction</option>';
								foreach ($lists as $list) {
									echo '<option value="'.$list['instruction_id'].'" >'.$list['instruction_name'].'</option>';
								}
							echo '</select>
						</div>';

						echo '<div class="col-md-1" style="padding:3px;">
							<select class="form-control" name="mlvltype[]">
							<option value="">Type</option>';
								foreach ($typelists as $typelist) {
									echo '<option value="'.$typelist['id'].'">'.$typelist['name'].'</option>';
								}
							echo '</select>
						</div>';

						echo '<div class="col-md-1" style="padding:3px;">
							<input class="form-control timeformatExample1" type="text" name="timerange[]" placeholder="Time Limit (HH:MM:SS)" required="required" />
						</div>';
						echo '<div class="col-md-1" style="padding:3px;">
							<select class="form-control" name="lvltype[]" style="padding:6px 3px">';
								foreach ($types as $type) {
									echo '<option value="'.$type['t_id'].'" >'.$type['t_name'].'</option>';
								}
							echo '</select>
						</div>';
						echo '<div class="col-md-1" style="padding:3px;">
							<select class="form-control" name="skills[]" style="padding:6px 3px">';
								foreach ($skills as $skill) {
									echo '<option value="'.$skill['skills_id'].'" >'.$skill['skills_name'].'</option>';
								}
							echo '</select>
						</div>';

						echo '<div class="col-md-1" style="padding:3px;">
							<select class="form-control" name="dlevel[]">';
								foreach ($dlevels as $dlevel) { 
								echo '<option value="'.$dlevel['diffi_id'].'">'.$dlevel['difficulty_level'].'</option>';
								}
							echo '</select>
						</div>';
						echo '<div class="col-md-1" style="padding:3px;">
							<input type="text" class="form-control" name="q_limit[]" placeholder="Q Limit" />
						</div>';
						/// changed here complete
					
					echo '<div class="col-md-1" style="padding:3px;">
	                          <input type="text" class="form-control" placeholder="Discription"  maxlength="200"  name="dicription[]"  />
	                      </div>';
	                echo '<div class="col-md-1" style="padding:3px;">
	                          <input type="text" class="form-control"  placeholder="Key Competency" maxlength="200"  name="key_competency[]" />
	                      </div>';
						echo '<div class="col-md-2" style="padding:3px;">
							<div style="width:80%; float:left;">
							<input type="text" class="form-control start_date" name="start_date[]" placeholder="Start Date" style="width:50%;float:left;" />
							<input type="text" class="form-control timeformatExample1" name="starttime[]" placeholder="Start Time" style="width:50%;float:left;" />
							</div>
		                </div>';
				}
            }
            if($blank_input>0){
                echo '<input type="submit" class="btn btn-primary btn-md" style="float: right;background-color:#112B4E; border-color: #112B4E;" value="Submit" />';
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
  

	public function insert_level(){
		try
		{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			{
				$assign=$this->input->post('assign_select');
				$lvl=$this->input->post('levels');
				$checkman=$this->input->post('checkman');
				$ins=$this->input->post('ins');
				$time_range=$this->input->post('timerange');
				$lvltype=$this->input->post('lvltype');
		    	$startdate=$this->input->post('startdate');
		    	$starttime=$this->input->post('starttime');
		    	$m_type=$this->input->post('mlvltype');
		    	$skills=$this->input->post('skills');
	    		$dlevel=$this->input->post('dlevel');
	    		$q_limit=$this->input->post('q_limit');
	    		$disc=$this->input->post('dicription');
	    		$key=$this->input->post('key_competency');
				if(!empty($lvl)){
					$countlevel = sizeof($lvl);
					for($i=0;$i<$countlevel;$i++){
						if(!empty($lvl[$i])){
							$assign_select = $assign;
							$levels = $lvl[$i];
							$admin_id = $this->session->userdata('adminid');
							$create_date = date('Y-m-d H:i:s');
							if($checkman != "" || $checkman == "manual"){
                                $createdata = array(
								'maid' => $assign_select,
								'lvl_name' => $levels,
								'created_date' => $create_date,
								'created_by' => $admin_id,
								'inst_id' => $ins[$i],
								'time_limit' => $time_range[$i],
								'd_level' => $dlevel[$i],
								'description' => $disc[$i],
								'key_competency_assessed' => $key[$i],
	     						'start_date_time' => date('Y-m-d H:i:s',strtotime($startdate[$i].$starttime[$i]))
							);
							}else{
								$createdata = array(
								'maid' => $assign_select,
								'lvl_name' => $levels,
								'created_date' => $create_date,
								'created_by' => $admin_id,
								'inst_id' => $ins[$i],
								'time_limit' => $time_range[$i],
								'level_type' => $lvltype[$i],
								'd_level' => $dlevel[$i],
								'skills' => $skills[$i],
								'm_type' => $m_type[$i],
								'q_limit' => $q_limit[$i],
								'description' => $disc[$i],
								'key_competency_assessed' => $key[$i],
	     						'start_date_time' => date('Y-m-d H:i:s',strtotime($startdate[$i].$starttime[$i]))
								);
								}
								
							$this->Admindashboard_modal->level_insert($createdata);
						}
					}
					$this->session->set_flashdata('level_insert_message','<div class="success"><strong>Success!</strong> Level has Inserted.</div>');
					redirect(base_url().'create-level');
				}else{
					$this->session->set_flashdata('level_insert_message','<div class="danger"><strong>Sorry!</strong> You have not selected any assignment.</div>');
					redirect(base_url().'create-level');
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
public function update_level(){
 	try
	{
		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	    {
	    	$asnumber=$this->input->post('assignid');
	    	$lvlname=$this->input->post('lvlname');
	    	$inst_id=$this->input->post('inst_id');
	    	$time_id=$this->input->post('time_id');
	    	$lvltype=$this->input->post('lvltype');
	    	$skills=$this->input->post('skills');
	    	$startdate=$this->input->post('startdate');
	    	$starttime=$this->input->post('starttime');
	    	$m_type=$this->input->post('mlvltype');
	    	$dlevel=$this->input->post('dlevel');
	    	$q_limit=$this->input->post('q_limit');
	        $discription=$this->input->post('disc');
	    	$keycompetency=$this->input->post('key');
			
	     	$update_data['lvl_name'] = $lvlname;
	     	$update_data['inst_id'] = $inst_id; 
	     	$update_data['time_limit'] = $time_id;
	     	$update_data['level_type'] = $lvltype;
	     	$update_data['skills'] = $skills;
	     	$update_data['m_type'] = $m_type;
	     	$update_data['d_level'] = $dlevel;
	     	$update_data['q_limit'] = $q_limit;
	     	$update_data['description'] = $discription;
	     	$update_data['key_competency_assessed'] = $keycompetency;
	     	$update_data['start_date_time'] = date('Y-m-d H:i:s',strtotime($startdate.$starttime));
	    
	   		if($this->Admindashboard_modal->level_update($asnumber,$update_data))
	   		{
	   			echo true;
	   		}
	   		else
	   		{
	   			echo false;
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
 public function task_list()
 {
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     			$assignorder = $this->input->post('assignorder');
		     			if($assignorder != ''){
		     				$data['alists'] = $this->Admindashboard_modal->total_assign_list('1','DESC');
							$data['task_lists'] = $this->Admindashboard_modal->task_lists('1',$assignorder);
					    	$data['title']='Admin Dashboard for Monday Morning';
							$this->load->view('admintempletes/head',$data);
							$this->load->view('admintempletes/header',$data);	
						  	$this->load->view('admintempletes/sidebar',$data);
							$this->load->view('task-list',$data);
							$this->load->view('admintempletes/footer');
							//$this->load->view('admintempletes/foot');
		     			}else{
		     				$assignorder ='';
		     				$data['alists'] = $this->Admindashboard_modal->total_assign_list('1','DESC');
							$data['task_lists'] = $this->Admindashboard_modal->task_lists('1',$assignorder);
					    	$data['title']='Admin Dashboard for Monday Morning';
							$this->load->view('admintempletes/head',$data);
							$this->load->view('admintempletes/header',$data);	
						  	$this->load->view('admintempletes/sidebar',$data);
							$this->load->view('task-list',$data);
							$this->load->view('admintempletes/footer');
							//$this->load->view('admintempletes/foot');
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

 public function task_trash()
 {
          try
            {
                   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
             {
                    $data['title']='Admin Dashboard for Monday Morning';
                    $assignorder ='';
                        $data['task_lists'] = $this->Admindashboard_modal->task_lists('0',$assignorder);
                        $this->load->view('admintempletes/head',$data);
                        $this->load->view('admintempletes/header',$data);    
                          $this->load->view('admintempletes/sidebar',$data);
                        $this->load->view('task-trash',$data);
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

        public function restore_task()
 {
	  	try
			{
				if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			    {
			    	$maid = $this->input->post('maid');
			    	$taskid = $this->input->post('taskid');
			    	$where = "maid = '$maid' AND status = '1'";
					$val = $this->Crud_modal->all_data_select('maid','master_assignment',$where,'maid asc');
					if($val){
						if($this->Admindashboard_modal->task_delete($taskid,'1')){
				    		echo '{"msg":"Task Restored"}';
				    	}else{
				    		echo '{"msg":"Some Error"}';
				    	}
					}else{
						echo '{"msg":"Assignment Not Found"}';
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
    public function get_task_form(){
 	try
		{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
		 	$v = $this->uri->segment(2);
		 	$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));

		 	$data['title']='Admin Dashboard for Monday Morning';
			if($this->Admindashboard_modal->task_value($val)){
				$maid = $data['task_value'] = $this->Admindashboard_modal->task_value($val);
				$data['widgetlist'] = $this->Admindashboard_modal->widget_lists('1','ASC');
				$data['assignlist'] = $this->Admindashboard_modal->total_assign_list('1','ASC');
				$data['levels'] = $this->Admindashboard_modal->master_level_num($maid['ma_id']);
				$data['filetypelist'] = $this->Crud_modal->all_data_select('ft_id,ft_name','master_filetype','status=1','ft_id desc');
			}
			$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);	
		  	$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('edit-task',$data);
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


 public function create_taskpage()
 {
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
					$data['assignlist'] = $this->Admindashboard_modal->total_assign_list('1','DESC');
					$data['widgetlist'] = $this->Admindashboard_modal->widget_lists('1','DEC');
					$data['filetypelist'] = $this->Crud_modal->all_data_select('ft_id,ft_name','master_filetype','status=1','ft_id desc');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('create-task',$data);
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


  public function delete_task()
 {
	  	try
			{
				if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			    {
			    	$taskid = $_POST['taskid'];
			    	if($this->Admindashboard_modal->task_delete($taskid,'0')){
			    		echo '{"msg":"Record Deleted Success"}';
			    	}else{
			    		echo '{"msg":"Some Error"}';
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
 public function get_levels(){
 	try
		{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
		 	$val = $_POST['assignid'];
		 	$rl = $this->Admindashboard_modal->master_level_num($val);
		 	$tl = $this->Admindashboard_modal->task_level($val);
		 	if(!empty($rl)){
			 	echo '<label>Select Level</label>
	              <select name="ml_id" class="form-control select2" style="width: 100%;">';
			 	foreach ($rl as $value) {
			 		echo '<option value="'.$value['ml_id'].'"';
			 		foreach ($tl as $values) {
			 			$valss = $values->ml_id;
			 			if($valss==$value['ml_id']){
			 				echo ' disabled="disabled"';
			 			}
			 		}
			 		echo '>'.$value['lvl_name'].'</option>';			 		
			 	}
			 	echo '</select>';
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

 // changed at 10/05/2017
public function insert_task(){
try
        {
               if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
         {
			$mlidc = $this->input->post('ml_id');
			$task_namec = $this->input->post('task_name');
			$instructionc = $this->input->post('instruction');
			$ftype = $this->input->post('filetype');
            if($mlidc!=''){
                if($task_namec!=''){
                    if($instructionc!=''){
                         $mlidc = $this->input->post('ml_id');
                         $maidc = $this->input->post('ma_id');

                         $where = "maid = '$maidc' AND ml_id = '$mlidc'";
                         $pdata = $this->Crud_modal->all_data_select('p_id','master_level',$where,'ml_id asc');
                         
                         if($pdata[0]['p_id']){
                             $filesCount = count($_FILES['userFiles']['name']);
                             $target_dir = './upload/task_sample_files/';
                            for($i = 0; $i < $filesCount; $i++){
                                if(!empty($_FILES['userFiles']['name'][$i])){
                                   // $randname = rand(1111,9999);
                                   //  $target_file = $target_dir . $randname .basename($_FILES["userFiles"]["name"][$i]);
                                          $target_file = $target_dir . basename($_FILES["userFiles"]["name"][$i]);
                                    if (move_uploaded_file($_FILES["userFiles"]["tmp_name"][$i], $target_file)) {
                                      //  $image[]  = 'task_sample_files/'.$randname.basename($_FILES["userFiles"]["name"][$i]);
                                              $image[]  = 'task_sample_files/'.basename($_FILES["userFiles"]["name"][$i]);
                                    }else{
                                        $this->session->set_flashdata('task_insert_message','<div class="danger"><strong>Sorry!</strong> File Upload Frror.</div>');
                                         redirect(base_url().'create-task');
                                    }
                                }
                            }
                            if($image!=''){
	                            $dbimage = implode(',', $image);
	                        }else{
	                        	$dbimage = '';
	                        }
                             $createdata = array(
                                'task_name' => $this->input->post('task_name'),
                                'ma_id' => $this->input->post('ma_id'),
                                'ml_id' => $this->input->post('ml_id'),
                                'widget_id' => $this->input->post('w_id'),
                                'status' => '1',
                                'created_date' => date('Y-m-d'),
                                'start_date' => date('Y-m-d'),
                                'end_date' => date('Y-m-d'),
                                'sample_files' => $dbimage,
                                'instruction' => $this->input->post('instruction'),
			    				'filetype' => implode(',',$ftype)
                            );
                            $this->Admindashboard_modal->task_insert($createdata);
                            $this->session->set_flashdata('task_insert_message','<div class="success"><strong>Success!</strong> Task has Inserted.</div>');
                             redirect(base_url().'create-task');
                         }else{
                            $this->session->set_flashdata('task_insert_message','<div class="danger"><strong>Sorry!</strong> You have not Mapped Parameters for this level.</div>');
                             redirect(base_url().'create-task');
                         }
                    }else{
                        $this->session->set_flashdata('task_insert_message','<div class="danger"><strong>Sorry!</strong> Please Enter Instruction</div>');
                             redirect(base_url().'create-task');
                    }
                }else{
                    $this->session->set_flashdata('task_insert_message','<div class="danger"><strong>Sorry!</strong> Please Enter Task Detail</div>');
                         redirect(base_url().'create-task');
                }
             }else{
                $this->session->set_flashdata('task_insert_message','<div class="danger"><strong>Sorry!</strong> You have not selected any Level.</div>');
                 redirect(base_url().'create-task');
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

 public function update_task(){
try
		{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {

	     	$tid = $this->input->post('tid');
	     	$dbfiles=array();
	     	if(isset($_POST['filelist'])){
	     		$filecount = sizeof($_POST['filelist']);
	     		for($of=0;$of<$filecount;$of++){
	     			$ofile[] = 'task_sample_files/'.$_POST['filelist'][$of];
		     	}
		     	$dbfiles[] =  implode(',',$ofile);
	     	}
	     	if(isset($_FILES['userFiles'])){
		     	$filesCount = count($_FILES['userFiles']['name']);
	     		$target_dir = './upload/task_sample_files/';
		        for($i = 0; $i < $filesCount; $i++){
		        	if(!empty($_FILES['userFiles']['name'][$i])){
		        		//$randname = rand(1111,9999);
	     				//$target_file = $target_dir . $randname .basename($_FILES["userFiles"]["name"][$i]);
	     				$target_file = $target_dir .basename($_FILES["userFiles"]["name"][$i]);
		        		if (move_uploaded_file($_FILES["userFiles"]["tmp_name"][$i], $target_file)) {
							//$files[]  = 'task_sample_files/'.$randname.basename($_FILES["userFiles"]["name"][$i]);
								$files[]  = 'task_sample_files/'.basename($_FILES["userFiles"]["name"][$i]);
						}else{
							$this->session->set_flashdata('task_insert_message','<div class="danger"><strong>Sorry!</strong> File Upload Frror.</div>');
			 				redirect(base_url().'edit-task/'.rtrim(strtr(base64_encode($tid), '+/', '-_'), '='));
						}
					}
				}
				$dbfiles[] = implode(',', $files);
			}
			if($dbfiles!=''){
				$dbfile = implode(',', $dbfiles);
			}else{
				$dbfile ='';
			}

			$ftype = $this->input->post('filetype');

		 	$update_data = array(
		        'task_name' => $this->input->post('task_name'),
	         	'start_date' => date('Y-m-d'),
		        'end_date' => date('Y-m-d'),
			    'sample_files' => $dbfile,
			    'widget_id' => $this->input->post('w_id'),
			    'instruction' => $this->input->post('instruction'),
			    'filetype' => implode(',',$ftype)
			);
	    	$this->Admindashboard_modal->task_update($tid,$update_data);
			$this->session->set_flashdata('task_insert_message','<div class="success"><strong>Success!</strong> Record Updated Success.</div>');
		 	redirect(base_url().'edit-task/'.rtrim(strtr(base64_encode($tid), '+/', '-_'), '='));
			 
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

	public function widget_page()
	 {
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
			    $data['title']='Admin Dashboard for Monday Morning';
					$data['widgetlist'] = $this->Admindashboard_modal->widget_lists('1','DESC');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('widget',$data);
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
public function get_country_name(){
		try
			{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
	     	
			   	$val = $this->input->post('countryid');
			   	$c1list = explode(',', $val);
				echo '<ul style="padding: 0px; font-size: 15px;list-style: none;">';
				for($i=0;$i<sizeof($c1list);$i++)
				{
					$data['c1name'][]=$this->Admindashboard_modal->select_widget_country($c1list[$i]);
	                echo '<li>'.$data['c1name'][$i][0]->name.'</li>';
				}
				echo '</ul>';

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
	public function country_widget_page()
	 {
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
			    $data['title']='Admin Dashboard for Monday Morning';
					$data['countrylist'] = $this->Admindashboard_modal->selectcountry();
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('country-widget',$data);
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
	 

	   public function widget_trash()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
						$data['widgetlist'] = $this->Admindashboard_modal->widget_lists('0','DESC');
						$this->load->view('admintempletes/head',$data);
						$this->load->view('admintempletes/header',$data);	
					  	$this->load->view('admintempletes/sidebar',$data);
						$this->load->view('widget-trash',$data);
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

	public function restore_widget()
	 {
	  	try
			{
				if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			    {
			    	$widgetid = $_POST['widgetid'];
			    	if($this->Admindashboard_modal->widget_delete($widgetid,'1')){
			    		echo '{"msg":"Widget Restored"}';
			    	}else{
			    		echo '{"msg":"Some Error"}';
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

 	  public function delete_widget()
 	{
	  	try
			{
				if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			    {
			    	$widgetid = $_POST['widgetid'];
			    	if($this->Admindashboard_modal->widget_delete($widgetid,'0')){
			    		echo '{"msg":"Record Deleted Success"}';
			    	}else{
			    		echo '{"msg":"Some Error"}';
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
public function create_widget(){
  	try
		{
		   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
     {
	     	if($this->input->post('country2') !=''){
		     	$c1 = $this->input->post('country1');
		     	asort($c1);
		     	$c11 = implode(',',$c1);
		     	$c2 = $this->input->post('country2');
		     	asort($c2);
		     	$c22 = implode(',',$c2);
				$narrayids  = array_merge($c1,$c2);
				asort($narrayids);
			}else{
				$c1 = $this->input->post('country3');
		     	asort($c1);
		     	$c11 = implode(',',$c1);
		     	$c22 = '';
				$narrayids  = $c1;
				asort($narrayids);
			}

	     	$createdata = array(
		        'w_name' => $this->input->post('w_name'),
		        'c1_id' => $c11,
		        'c2_id' => $c22,
		        'total_countries' => implode(',', $narrayids),
		        'status' => '1',
		        'create_date' => date('Y-m-d')
			);
			$this->Admindashboard_modal->widget_insert($createdata);
			$this->session->set_flashdata('widget_insert_message','<div class="success"><strong>Success!</strong>Record Saved Successfully</div>');
		 	redirect(base_url().'country-widget');
		   
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

 	 	public function get_widget()
	 {
	  	try
			{
				if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			    {
			    	//$widgetid = $this->input->post('widgetid');
			    	$widgetid = $_POST['wid'];
			    	$data['widgetlist'] = $this->Admindashboard_modal->widget_country($widgetid);
			    	
			    	$c1id = explode(',',$data['widgetlist'][0]->c1_id);
			    	echo '<div class="col-md-6" style="padding: 0px;">
			    		<label>Country 1</label>
			    	<ul style="padding: 0px; font-size: 15px;list-style: none;">';
			    	for($i=0;$i<sizeof($c1id);$i++){
				    	$data['c1list'] = $this->Admindashboard_modal->select_widget_country($c1id[$i]);
	                    echo '<li>'.$data['c1list'][0]->name.'</li>';
				    }
				    echo '</ul></div>';
				    if($data['widgetlist'][0]->c2_id!='' || $data['widgetlist'][0]->c2_id!=null)
				    {
				    $c2id = explode(',',$data['widgetlist'][0]->c2_id);

			    	echo '<div class="col-md-6" style="padding: 0px;">
			    	<label>Country 2</label>
			    	<ul style="padding: 0px; font-size: 15px;list-style: none;">';
			    	for($j=0;$j<sizeof($c2id);$j++){
				    	$data['c2list'] = $this->Admindashboard_modal->select_widget_country($c2id[$j]);
	                    echo '<li>'.$data['c2list'][0]->name.'</li>';
				    }
				    echo '</ul></div>';
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

 		   public function edit_widget()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		//$val = $this->uri->segment(2);
		     		$v = $this->uri->segment(2);
		     		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
				    $data['title']='Admin Dashboard for Monday Morning';
					if($this->Admindashboard_modal->widget_country($val)){
						$data['countrylist'] = $this->Admindashboard_modal->selectcountry();
			    		$data['widgetlist'] = $this->Admindashboard_modal->widget_country($val);

						$c1id = explode(',',$data['widgetlist'][0]->c1_id);
				    	for($i=0;$i<sizeof($c1id);$i++){
					    	$data['widgetcount1'] = $this->Admindashboard_modal->select_widget_country($c1id[$i]);
					    	$data['count1id'][] = $data['widgetcount1'][0]->cid;
					    	$data['count1name'][] = $data['widgetcount1'][0]->name;
					    }
					    if($data['widgetlist'][0]->c2_id != ''){
							$c2id = explode(',',$data['widgetlist'][0]->c2_id);
					    	for($j=0;$j<sizeof($c2id);$j++){
						    	$data['widgetcount2'] = $this->Admindashboard_modal->select_widget_country($c2id[$j]);
						    	$data['count2id'][] = $data['widgetcount2'][0]->cid;
						    	$data['count2name'][] = $data['widgetcount2'][0]->name;
						    }
						}
					}
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('edit-country-widget',$data);
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
public function update_widget(){
try
	{
		   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
     {
	 	$wid = $this->input->post('w_id');
	 	if($this->input->post('country2') !=''){
	     	$c1 = $this->input->post('country1');
	     	asort($c1);
	     	$c11 = implode(',',$c1);
	     	$c2 = $this->input->post('country2');
	     	asort($c2);
	     	$c22 = implode(',',$c2);
			$narrayids  = array_merge($c1,$c2);
			asort($narrayids);
		}else{
			$c1 = $this->input->post('country1');
	     	asort($c1);
	     	$c11 = implode(',',$c1);
	     	$c22 = '';
			$narrayids  = $c1;
			asort($narrayids);
		}

     	$update_data = array(
	        'w_name' => $this->input->post('w_name'),
	        'c1_id' => $c11,
	        'c2_id' => $c22,
	        'total_countries' => implode(',', $narrayids)
		);

   		if($this->Admindashboard_modal->widget_update($wid,$update_data)){
			$this->session->set_flashdata('widget_update_message','<div class="success"><strong>Success!</strong> Record Updated Success.</div>');
		 	redirect(base_url().'edit-country-widget/'.rtrim(strtr(base64_encode($wid), '+/', '-_'), '='));
		}else{
			$this->session->set_flashdata('widget_update_message','<div class="danger"><strong>Oops!</strong> Record Update Failed.</div>');
			redirect(base_url().'edit-country-widget/'.rtrim(strtr(base64_encode($wid), '+/', '-_'), '='));
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

	
		public function create_assessment()
         {
                  try
                        {
                                   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
                     {
                                    $data['title']='Admin Dashboard for Monday Morning';
                                        $data['assesmentlist'] = $this->Admindashboard_modal->total_assesment_list('1','DESC');
                                        $this->load->view('admintempletes/head',$data);
                                        $this->load->view('admintempletes/header',$data);        
                                          $this->load->view('admintempletes/sidebar',$data);
                                        $this->load->view('create-assessment',$data);
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

	public function insert_assesment()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
					$aname = $this->input->post('aname');
					$method = $this->input->post('method');
					$create_date = date('Y-m-d');
				 	$createdata = array(
			        'name' => $aname,
			        'method' => $method,
			        'created_date' => $create_date
					);
					$this->Admindashboard_modal->assesment_insert($createdata);

				 	$this->session->set_flashdata('assesment_insert_message','<div class="success"><strong>Success!</strong> Assesment has Inserted.</div>');
				 	redirect(base_url().'create-assessment');
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


	public function assesment_maping()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
					$data['assignlist'] = $this->Admindashboard_modal->total_assign_list('1','ASC');
					$data['assesmentlist'] = $this->Admindashboard_modal->total_assesment_list('1','ASC');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('assessment-mapping',$data);
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

	public function view_assesment_maping()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
					$data['assignlist'] = $this->Admindashboard_modal->total_assign_list('1','ASC');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('view-assessment-mapping',$data);
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

	 public function view_assesment_levels(){
	 	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
			 	$val = $this->input->post('assignid');
			 	$rl = $this->Admindashboard_modal->master_level_num($val);
			 	//$tl = $this->Admindashboard_modal->assesment_level($val);
			 	if($rl){	
				 	foreach ($rl as $value) {
				 		echo '<option value="'.$value['ml_id'].'">'.$value['lvl_name'].'</option>';			 		
				 	}
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
	public function view_assesment_parameters(){
         try
                {
                           if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
             {
             	$permission_array=$this->session->userdata('permission_array');
				                   for($i=0;$i<sizeof($permission_array);$i++){
				                        $p =$this->Crud_modal->fetch_single_data('permission_description','master_permission',"permission_id='$permission_array[$i]'");
				                        $permission[] = $p["permission_description"];
				                   }
                         $val = $this->input->post('assignids');
                         $val1 = $this->input->post('levelid');
                         $where = "maid = '$val' AND ml_id = '$val1'";
                         $pval = $this->Crud_modal->all_data_select('p_id','master_level',$where,'p_id asc');
                         if($pval){
                                 $parray = explode(',',$pval[0]['p_id']);
                                 if($parray){
                                         //echo '<div class="col-md-6" style="padding-left: 0px;"><label>Parameters Name</label></div>';
                                         //echo '<div class="col-md-6" style="padding-left: 0px;"><label>Method</label></div>';
                                         foreach ($parray as $value) {
                                                 $wherename = "p_id = '$value'";
                                                 $pname = $this->Crud_modal->all_data_select('p_id,name,method','master_parameter',$wherename,'p_id asc');
                                                 if($pname){
                                             echo '<div class="col-md-12" style="padding:5px 0px;">';
                                                     echo '<div class="col-md-6" style="padding-left: 0px;">';
                                                     echo '<p>'.$pname[0]['name'].'</p>';
                                                     echo '</div>';
                                                     echo '<div class="col-md-5" style="padding-left: 0px;">';
                                                     echo '<p>'.$pname[0]['method'].'</p>';
                                                     echo '</div>';
                                                     echo '<div class="col-md-1 editparameter" id="'.$pname[0]['p_id'].'">';
                                                     //check permission for delete action-start
                                                     if(in_array("Delete", $permission)){
                                                     	echo '<span class="tasklink" style="color: #3c8dbc; cursor: pointer;">Delete</span>';
                                                 	 }
                                                 	  //check permission for delete action-start
                                                     echo '</div>';
                                             echo '</div>';
                                                 }else{
                                                         echo "<p>No Parameters Found</p>";
                                                 }                                 
                                         }
                                }else{
                                        echo "<p>No Parameters Found</p>";
                                }
                        }else{
                                echo "<p>No Parameters Found</p>";
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
// new function at 17/05/2017 by sohrab
 public function getallparamertsforaddpara(){
 	try
        {
        if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
    {
	 	$ml_id= $this->input->post('mlid');
	 	$where = "ml_id = '$ml_id'";
	    $allgetpara = $this->Crud_modal->fetchdata_with_limit('p_id','master_level',$where,'ml_id','1');
		$getpara = explode(',',$allgetpara[0]['p_id']);
		$wherenot = "p_id != '$getpara[0]'";
		if(sizeof($wherenot)>0){
			for($a=1;$a<sizeof($getpara);$a++){
				$wherenot .= "AND p_id != '$getpara[$a]' ";
				
			}
		}
		$plist = $this->Crud_modal->all_data_select('p_id,name','master_parameter',$wherenot,'p_id asc');
		echo json_encode($plist);
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
public function update_parameters(){
         try
        {
                if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
            {

            	if($this->input->post('insertpara') != 'Insert'){
                    $p_id = $this->input->post('p_id');
                    $ml_id = $this->input->post('mlid');
                    $where = "ml_id = '$ml_id'";
                    $allgetpara = $this->Crud_modal->fetchdata_with_limit('p_id','master_level',$where,'ml_id','1');
					$getpara = explode(',',$allgetpara[0]['p_id']);

			    	$pos = array_search($p_id,$getpara);
					unset($getpara[$pos]);
					$update_data = array(
				        'p_id' => implode(',',$getpara),
					);
					$this->Crud_modal->update_data($where,'master_level',$update_data);
					echo '{"val":"Parameter Unmapped"}';
				}else{
                    $p_id = $this->input->post('addparameter');
                    $ml_id = $this->input->post('ml_id');
                    $where = "ml_id = '$ml_id'";
                    $allgetpara = $this->Crud_modal->fetchdata_with_limit('p_id','master_level',$where,'ml_id','1');
                    if($allgetpara[0]['p_id']!=null){
						$getpara = explode(',',$allgetpara[0]['p_id']);
						array_push($getpara,$p_id);
						asort($getpara);
						$paraid = implode(',',$getpara);
					}else{
						$paraid = $p_id;
					}
					$update_data = array(
				        'p_id' => $paraid
					);
					$this->Crud_modal->update_data($where,'master_level',$update_data);
					$this->session->set_flashdata('assessment_insert_message','<div class="success"><strong>Success!</strong> Parameter Inserted.</div>');
					redirect(base_url().'view-assessment-mapping');
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
	 public function assesment_map()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		$ma_id = $this->input->post('assign_select');
					$ml_id = $this->input->post('ml_id');
					if(!empty($ml_id)){
						for($i=0;$i<sizeof($ml_id);$i++){
			     			if(!empty($ml_id[$i])){
								$assesment_select = $this->input->post('assesment_select');
								if(!empty($assesment_select)){
									$update_data = array(
								        'p_id' => implode(',',$assesment_select),
									);
									$this->Admindashboard_modal->assesment_update($ma_id,$ml_id[$i],$update_data);
								}else{
								 	$this->session->set_flashdata('assesment_insert_message','<div class="danger"><strong>Oops!</strong> Parameter Not Selected</div>');
								 	redirect(base_url().'assessment-mapping');
								}
							}
						}
						$this->session->set_flashdata('assessment_insert_message','<div class="success"><strong>Success!</strong> Parameter Inserted.</div>');
						redirect(base_url().'assessment-mapping');
					 	
					}else{
					 	$this->session->set_flashdata('assesment_insert_message','<div class="danger"><strong>Oops!</strong> Level Not Selected.</div>');
					 	redirect(base_url().'assessment-mapping');
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
	public function get_assesment_levels(){
	 	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
			 	$val = $_POST['assignid'];
			 	$rl = $this->Admindashboard_modal->master_level_num($val);
			 	//$tl = $this->Admindashboard_modal->assesment_level($val);
			 	if(!empty($rl)){
				 	echo '<label>Select Level</label>
		              <select name="ml_id[]" class="form-control select2" multiple="multiple" style="width: 100%;">';
		            
				 	foreach ($rl as $value) {
				 		$tl = $this->Admindashboard_modal->assesment_level($val,$value['ml_id']);
				 		$plist = $tl[0]->p_id;
				 		if($plist == ''){
			 				echo '<option value="'.$value['ml_id'].'">'.$value['lvl_name'].'</option>';
			 			}
				 	}
				 	echo '</select>';
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
 	///shorab end//
 	// 16/05/2017
	public function task_view(){
 	try
		{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
		 	$v = $this->uri->segment(2);
		 	$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));

		 	$data['title']='Admin Dashboard for Monday Morning';
			$taskvalue = $data['task_value'] = $this->Admindashboard_modal->task_value($val);
			$maid = $taskvalue['ma_id'];
			$mlid = $taskvalue['ml_id'];
			$wid = $taskvalue['widget_id'];
			$whereassign = "maid = $maid";
			$data['assignmentname'] = $this->Crud_modal->fetch_single_data('assignment_name','master_assignment',$whereassign);
			$wherelvl = "ml_id = $mlid";
			$data['lvlname'] = $this->Crud_modal->fetch_single_data('lvl_name','master_level',$wherelvl);
			$wherewidget = "w_id = $wid";
			$wname=$this->Crud_modal->fetch_single_data('w_name','widget',$wherewidget);
			if($wname!=''){
				$data['wname']=$wname['w_name'];
			}else{
				$data['wname']='No Widget';
			}
			$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);	
		  	$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('view-task',$data);
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
public function list_mcq()
 	{
	  	try
		{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
			    $data['title']='Admin Dashboard for Monday Morning';
				$where = "mcq_status = '1'";
				$data['topic_list']= $this->Crud_modal->all_data_select('*','master_topic','status=1','t_name asc');
				$assign_id=$this->input->post('assignorder');
				if($this->input->post('assignorder')!='')
				{
					$data['asid']=$assign_id;
					$data['msqlist'] = $this->Crud_modal->all_data_select('*','mcq',"topic='$assign_id' AND mcq_status = '1'",'mcq_id desc');
				}
				else
				{
					$data['msqlist'] = $this->Crud_modal->all_data_select('*','mcq',$where,'mcq_id desc');
				}
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('mcq-list',$data);
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

 public function create_mcq()
	{
  	try
		{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
			    $data['title']='Admin Dashboard for Monday Morning';
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
				$this->load->view('create-mcq',$data);
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
 public function edit_mcq()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		$v = $this->uri->segment(2);
		     		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
				    $data['title']='Admin Dashboard for Monday Morning';
					$where = "mcq_id = '$val'";
					$data['mcq'] = $this->Crud_modal->fetch_single_data('*','mcq',$where);
					$wheres = 'status =1';
					$data['master_topics'] = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$wheres,'t_id desc');
					$data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$wheres,'type_id desc');
					$data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name',' master_skills_test',$wheres,'skills_id desc');
					$data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$wheres,'diffi_id desc');
					$data['master_case'] = $this->Crud_modal->all_data_select('case_id,case_name','case_study',$wheres,'case_id asc');
					$data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$wheres,'diffi_id desc');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('edit-mcq',$data);
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

	 public function insert_mcq(){
	 	try
			{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
	     	if($this->input->post('question')!=''){
	     		if($this->input->post('canswer')!=''){
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
				        'created_by' => $this->session->userdata('adminid'),
				        'created_date' => date('Y-m-d H:i:s'),
				        'case_id' => $this->input->post('master_case')
					);
					if($this->Crud_modal->data_insert('mcq',$insert_data)){
						$this->session->set_flashdata('mcq_message','<div class="success"><strong>Success!</strong> Data Inserted.</div>');
						redirect(base_url().'create-mcq');
					}else{
						$this->session->set_flashdata('mcq_message','<div class="danger"><strong>Oops!</strong> Failed to Insert Data</div>');
						redirect(base_url().'create-mcq');
					}
				}else{
					$this->session->set_flashdata('mcq_message','<div class="danger"><strong>Oops!</strong> You have not selected correct answer.</div>');
					redirect(base_url().'create-mcq');
				}
			}else{
				$this->session->set_flashdata('mcq_message','<div class="danger"><strong>Oops!</strong> Question Field Empty</div>');
				redirect(base_url().'create-mcq');
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

	 public function update_mcq(){
	 	try
			{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
			$mcq_id = $this->input->post('mcq_id');
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
						$this->session->set_flashdata('mcq_message','<div class="success"><strong>Success!</strong> Data Updated.</div>');
						redirect(base_url().'mcq-edit/'.rtrim(strtr(base64_encode($mcq_id), '+/', '-_'), '='));
					}else{
						$this->session->set_flashdata('mcq_message','<div class="danger"><strong>Oops!</strong> Failed to Updated Data</div>');
						redirect(base_url().'mcq-edit/'.rtrim(strtr(base64_encode($mcq_id), '+/', '-_'), '='));
					}
				}else{
					$this->session->set_flashdata('mcq_message','<div class="danger"><strong>Oops!</strong> You have not selected correct answer.</div>');
					redirect(base_url().'mcq-edit/'.rtrim(strtr(base64_encode($mcq_id), '+/', '-_'), '='));
				}
			}else{
				$this->session->set_flashdata('mcq_message','<div class="danger"><strong>Oops!</strong> Question Field Empty</div>');
				redirect(base_url().'mcq-edit/'.rtrim(strtr(base64_encode($mcq_id), '+/', '-_'), '='));
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

	 public function delete_mcq(){
	 	try
			{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
	     	$v = $this->uri->segment(2);
			$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
	     	$update_data = array(
		        'mcq_status' => '0',
		        'modified_by' => $this->session->userdata('adminid'),
		        'modified_date' => date('Y-m-d H:i:s')
			);
			$where = "mcq_id = '$val'";
			if($this->Crud_modal->update_data($where,'mcq',$update_data)){
				$this->session->set_flashdata('mcq_message','<div class="success"><strong>Success!</strong> Data Deleted.</div>');
				redirect(base_url().'mcq-list');
			}else{
				$this->session->set_flashdata('mcq_message','<div class="danger"><strong>Oops!</strong> Failed to Delete Data</div>');
				redirect(base_url().'mcq-list');
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

	  public function view_mcq()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		$v = $this->uri->segment(2);
		     		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
				    $data['title']='Admin Dashboard for Monday Morning';
					$where = "mcq_id = '$val'";
					$data['mcq'] = $this->Crud_modal->fetch_single_data('*','mcq',$where);
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('view-mcq',$data);
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

	  //// Question Attributes Masters
	 public function view_topic()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
					$where = "status = '1'";
					$data['topic_lists'] = $this->Crud_modal->all_data_select('*','master_topic',$where,'t_id desc');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('view-topic',$data);
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
	  public function insert_topic()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				 	$createdata = array(
			        't_name' => $this->input->post('topic_name'),
			        'created_date' => date('Y-m-d H:i:s'),
			        'created_by' => $this->session->userdata('adminid')
					);
					$this->Crud_modal->data_insert('master_topic',$createdata);

				 	$this->session->set_flashdata('topic_insert_message','<div class="success"><strong>Success!</strong> Topic has Inserted.</div>');
				 	redirect(base_url().'topic-list');
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

	 public function delete_topic(){
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
			$where = "t_id = '$val'";
			if($this->Crud_modal->update_data($where,'master_topic',$update_data)){
				$this->session->set_flashdata('topic_insert_message','<div class="success"><strong>Success!</strong> Data Deleted.</div>');
				redirect(base_url().'topic-list/');
			}else{
				$this->session->set_flashdata('topic_insert_message','<div class="danger"><strong>Oops!</strong> Failed to Delete Data</div>');
				redirect(base_url().'topic-list/');
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

	 			// Type
	 // public function view_type()
 	// {
	 //  	try
		// 	{
		// 		   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		//      {
		// 		    $data['title']='Admin Dashboard for Monday Morning';
		// 			$where = "status = '1'";
		// 			$data['type_lists'] = $this->Crud_modal->all_data_select('*','master_type',$where,'type_id desc');
		// 			$this->load->view('admintempletes/head',$data);
		// 			$this->load->view('admintempletes/header',$data);	
		// 		  	$this->load->view('admintempletes/sidebar',$data);
		// 			$this->load->view('view-type',$data);
		// 			$this->load->view('admintempletes/footer');
		// 		 }
		// 		  else
		// 		 {
					
		// 		    redirect(base_url().'admin','refresh');
		// 	     }
		// 	}
		// 	catch (Exception $e)
		// 	{
		// 		echo 'Caught exception: ',  $e->getMessage(), "\n";
		// 	}
	 // }

	 public function insert_type()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				 	$createdata = array(
			        'type_name' => $this->input->post('type_name'),
			        'created_date' => date('Y-m-d H:i:s'),
			        'created_by' => $this->session->userdata('adminid')
					);
					$this->Crud_modal->data_insert('master_type',$createdata);

				 	$this->session->set_flashdata('type_insert_message','<div class="success"><strong>Success!</strong> Type has Inserted.</div>');
				 	redirect(base_url().'type-list');
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

	 public function delete_type(){
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
			$where = "type_id = '$val'";
			if($this->Crud_modal->update_data($where,'master_type',$update_data)){
				$this->session->set_flashdata('type_insert_message','<div class="success"><strong>Success!</strong> Data Deleted.</div>');
				redirect(base_url().'type-list/');
			}else{
				$this->session->set_flashdata('type_insert_message','<div class="danger"><strong>Oops!</strong> Failed to Delete Data</div>');
				redirect(base_url().'type-list/');
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

	  			// Skills 
	 public function view_skills_test()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
					$where = "status = '1'";
					 //$data['skills_test_lists'] = $this->Crud_modal->all_data_select('*','master_skills_test',$where,'skills_id desc');
					$field="u.employer_company, s.* ";
			 $table_name='master_skills_test as s';
			 $join1[0]='mm_employer as u';
			 $join1[1]='u.employer_id=s.cmp_id';
			 $join1[2]="inner";
			 $where="s.status=1";
			 $data['skills_test_lists']=$this->Crud_modal->fetch_data_by_one_table_join($field,$table_name,$join1,$where);
					$data['com'] = $this->Crud_modal->fetch_alls('mm_employer','employer_id desc');
					$data['ind'] = $this->Crud_modal->fetch_alls('mm_master_industry_topic','industry_id desc');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('view-skills-test',$data);
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
	 public function loadskills(){
	 	 $tbl='mm_employer_skill';
      	$com_id=$this->input->post('com_id');
      	$field="u.*, mm_employer_skill.* ";
			$table_name="mm_employer_skill";
			$join1[0]='mm_employer as u';
			$join1[1]='u.employer_id=mm_employer_skill.cmp_id';
			$join1[2]="inner";
      	$where="cmp_id='$com_id'";
      	
      	 $pro=$this->Crud_modal->fetch_data_by_one_table_join($field,$tbl,$join1,$where);
      	 
		// $pro=$this->Crud_modal->all_data_select('*', $tbl, $where,'skill_name desc');		
		
	 	if($com_id!=''){
	 		$a=1;
	 	foreach($pro as $city){
			
			echo '<tr> <td>'.$a.'</td>
<td>'.$city["emp_skill_id"].'</td><td>'.$city["skill_name"].'</td> <td>'.$city['employer_company'].'</td> <td>'.$city['creation_date'].'</td><td><a href="skills-test-delete/'.$city["emp_skill_id"].'" onclick="return doconfirm();">Delete</a></td>
			</tr>';
			$a++;
		 }
	 	}
	 	
         
     
 }
	 
public function loadskills1()
{
	$tbl='mm_employer_skill';
	$indus_id=$this->input->post('indus_id');
	
	$field="u.*, mm_employer_skill.* ";
			// $table_name="mm_employer_skill";
			$join1[0]='mm_employer as u';
			$join1[1]='u.employer_id=mm_employer_skill.cmp_id';
			$join1[2]="inner";
      	$where="indus_id='$indus_id'";
      	
      	 $pro=$this->Crud_modal->fetch_data_by_one_table_join($field,$tbl,$join1,$where);
	//$pro=$this->Crud_modal->all_data_select('*', $tbl, $where, 'skill_name desc');
	if($indus_id!='')
	{
		$a=1;
		foreach($pro as $data)
		{
			echo '<tr>
                         <td>'.$a.'</td> <td>'.$data["emp_skill_id"].'</td> <td>'.$data["skill_name"].'</td><td>'.$data['employer_company'].'</td><td>'.$data["creation_date"].'</td><td><a href="skills-test-delete/'.$data["emp_skill_id"].'" onclick="return doconfirm();">Delete</a></td>
			</tr>';
			$a++;
		}
	}
	
}
public function getindustry()
{
	$com_id=$this->input->post('com_id');
	$where="cmp_id='$com_id'";
	$tbl="mm_employer_skill";
	$dataa=$this->Crud_modal->all_data_select('indus_id', $tbl, $where, 'emp_skill_id desc');
	$val=$dataa['0']['indus_id'];
	$tbl1='mm_master_industry_topic';
	$where1="industry_id='$val'";
	$data=$this->Crud_modal->all_data_select('*', $tbl1, $where1, 'industry_id desc');

	if($com_id!='')
	{
		echo '<option value='.$data['0']['industry_id'].'>'.$data['0']["industry_name"].'</option>';
	}

}
public function delete_skills_test1(){
	 	try
			{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
	     	$v = $this->uri->segment(3);
			$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
	     	$update_data = array(
		        'status' => '0',
		        'modified_by' => $this->session->userdata('adminid'),
		        'modified_date' => date('Y-m-d H:i:s')
			);
			$where = "emp_skill_id = '$val'";
			$where1 = "skills = '$val'";
	     $val_check=$this->Crud_modal->check_numrow('master_level',$where1);
	     if($val_check>0){
	     	$this->session->set_flashdata('skills_test_insert_message','<div class="danger"> Not able to delete skill. As it is already exist.</div>');
				redirect(base_url().'skills-test-list/');
	     }
	     else{
	     	if($this->Crud_modal->update_data($where,'mm_employer_skill',$update_data)){
				$this->session->set_flashdata('skills_test_insert_message','<div class="success"><strong>Success!</strong> Data Deleted.</div>');
				redirect(base_url().'skills-test-list/');
			}
			
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
	 public function insert_skills_test()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				 	$createdata = array(
			        'skills_name' => $this->input->post('skills_name'),
			        'created_date' => date('Y-m-d H:i:s'),
			        'created_by' => $this->session->userdata('adminid')
					);
					$this->Crud_modal->data_insert('master_skills_test',$createdata);

				 	$this->session->set_flashdata('skills_test_insert_message','<div class="success"><strong>Success!</strong> Skills Test has Inserted.</div>');
				 	redirect(base_url().'skills-test-list');
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

	 public function delete_skills_test(){
	 	try
			{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
	     	$v = $this->uri->segment(2);
			$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
	     	$update_data = array(
		        'status' => '0'
		        
			);
			$where = "skills_id = '$val'";
			$where1 = "skills = '$val'";
	     $val_check=$this->Crud_modal->check_numrow('master_level',$where1);
	     if($val_check>0){
	     	$this->session->set_flashdata('skills_test_insert_message','<div class="danger"><strong>Oops!</strong> Failed to Delete Data</div>');
				redirect(base_url().'skills-test-list/');
	     }
	     else{
	     	if($this->Crud_modal->update_data($where,'master_skills_test',$update_data)){
				$this->session->set_flashdata('skills_test_insert_message','<div class="success"><strong>Success!</strong> Data Deleted.</div>');
				redirect(base_url().'skills-test-list/');
			}
			
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

	  public function getcsvfile(){
	 	$count=0;
        $fp = fopen($_FILES['userfile']['tmp_name'],'r') or die("can't open file");
        $files = $_FILES['userfile']['name'];
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
	                $insert_csv['question'] = trim($csv_line[0]);
	                $insert_csv['options'] = trim($csv_line[1]).'sohrab'.trim($csv_line[2]).'sohrab'.trim($csv_line[3]).'sohrab'.trim($csv_line[4]);
	                $insert_csv['c_answer'] = trim($csv_line[5]);
					$insert_csv['topic']= trim($csv_line[6]);
					$insert_csv['type']= trim($csv_line[7]);
					$insert_csv['skill_tested']= trim($csv_line[8]);
					$insert_csv['difficulty_level']= trim($csv_line[9]);
					$insert_csv['case_id']= trim($csv_line[10]);

	            }
	            $i++;
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
			redirect(base_url().'create-mcq');
		}else{
			$this->session->set_flashdata('mcq_message','<div class="success"><strong>Failed!</strong> Upload Only .CSV File</div>');
			redirect(base_url().'create-mcq');
		}
	 }

	 // Level 2

	 public function sequence_create()
	{
  	try
		{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
			    $data['title']='Admin Dashboard for Monday Morning';
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);

				$whereall = 'status =1';
				$data['master_topics'] = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$whereall,'t_id desc');
				$data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$whereall,'type_id desc');
				$data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name',' master_skills_test',$whereall,'skills_id desc');
				$data['master_case'] = $this->Crud_modal->all_data_select('case_id,case_name','case_study',$whereall,'case_id desc');
				$data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$whereall,'diffi_id desc');
			  	if($this->uri->segment(2)){
				  	$v = $this->uri->segment(2);
					$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
					$where = "sq_id = '$val'";
					$data['sequence_data'] = $this->Crud_modal->all_data_select('*','sequence_questions',$where,'sq_id desc');
					$this->load->view('edit-sequence',$data);
				}else{

					$this->load->view('create-sequence',$data);
				}
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
// Sequence file upload
public function sqncfile(){
	 	$count=0;
        $fp = fopen($_FILES['sqncfile']['tmp_name'],'r') or die("can't open file");
        $files = $_FILES['sqncfile']['name'];
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

	            	if($csv_line[4]!=''){
	            		$opt4='sohrab'.trim($csv_line[4]);
	            	}else{
	            		$opt4='';
	            	}
	            	if($csv_line[5]!=''){
	            		$opt5='sohrab'.trim($csv_line[5]);
	            	}else{
	            		$opt5='';
	            	}
	            	if($csv_line[6]!=''){
	            		$opt6='sohrab'.trim($csv_line[6]);
	            	}else{
	            		$opt6='';
	            	}
	            	if($csv_line[7]!=''){
	            		$opt7='sohrab'.trim($csv_line[7]);
	            	}else{
	            		$opt7='';
	            	}
	            	if($csv_line[8]!=''){
	            		$opt8='sohrab'.trim($csv_line[8]);
	            	}else{
	            		$opt8='';
	            	}
	            	if($csv_line[9]!=''){
	            		$opt9='sohrab'.trim($csv_line[9]);
	            	}else{
	            		$opt9='';
	            	}
	            	if($csv_line[10]!=''){
	            		$opt10='sohrab'.trim($csv_line[10]);
	            	}else{
	            		$opt10='';
	            	}

	                $insert_csv = array();
	                $insert_csv['question'] = trim($csv_line[0]);
	                $insert_csv['options'] = trim($csv_line[1]).'sohrab'.trim($csv_line[2]).'sohrab'.trim($csv_line[3]).$opt4.$opt5.$opt6.$opt7.$opt8.$opt9.$opt10;
	                $insert_csv['topic'] = trim($csv_line[11]);
	                $insert_csv['type'] = trim($csv_line[12]);
	                $insert_csv['skill_tested'] = trim($csv_line[13]);
	                $insert_csv['case_id'] = trim($csv_line[14]);

	            }

	            $data = array(
	                'question' => $insert_csv['question'],
	                'options' => $insert_csv['options'],
	                'topic' => $insert_csv['topic'],
	                'type' => $insert_csv['type'],
	                'skill_tested' => $insert_csv['skill_tested'],
	                'created_date' => date('Y-m-d H:i:s'),
				    'created_by' => $this->session->userdata('adminid'),
				    'case_id' => $insert_csv['case_id']
	        	);
	            $this->Crud_modal->data_insert('sequence_questions', $data);

			}
	        $this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Uploaded.</div>');
			redirect(base_url().'create-sequence');
		}else{
			$this->session->set_flashdata('data_message','<div class="success"><strong>Failed!</strong> Upload Only .CSV File</div>');
			redirect(base_url().'create-sequence');
		}
	 }

 	  public function sequence_lists()
	{
  	try
		{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
			    $data['title']='Admin Dashboard for Monday Morning';
				$where = "status = 1";
				$data['topic_list']= $this->Crud_modal->all_data_select('*','master_topic','status=1','t_name asc');
				$assign_id=$this->input->post('assignorder');
				if($this->input->post('assignorder')!='')
				{
					$data['asid']=$assign_id;
					$data['sqences_lists'] = $this->Crud_modal->all_data_select('*','sequence_questions',"topic='$assign_id' AND status = 1",'sq_id desc');
				}
				else
				{
					$data['sqences_lists'] = $this->Crud_modal->all_data_select('*','sequence_questions',$where,'sq_id desc');
				}
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('sequence-list',$data);
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

 	public function sequence_update(){
	 	try
			{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
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
					redirect(base_url().'edit-sequence/'.$val);
				}else{
					$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Update Data</div>');
					redirect(base_url().'edit-sequence/'.$val);
				}
			}else{
				$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Question Field Empty</div>');
				redirect(base_url().'edit-sequence/'.$val);
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
 	public function insert_sequence_questions(){
	 	try
			{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
	     	if($this->input->post('question')!=''){
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
		     	$insert_data = array(
			        'question' => $question,
			        'options' => $opt0.$opt1.$opt2.$opt3.$opt4.$opt5.$opt6.$opt7.$opt8.$opt9,
			        'topic' => $this->input->post('master_topic'),
			        'type' => $this->input->post('master_type'),
			        'skill_tested' => $this->input->post('master_skills_test'),
			        'created_by' => $this->session->userdata('adminid'),
			        'created_date' => date('Y-m-d H:i:s'),
			         'difficulty_level' => $this->input->post('master_difficulty_level'),
			        'case_id' => $this->input->post('master_case')
				);
				if($this->Crud_modal->data_insert('sequence_questions',$insert_data)){
					$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Inserted.</div>');
					redirect(base_url().'create-sequence');
				}else{
					$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Insert Data</div>');
					redirect(base_url().'create-sequence');
				}
			}else{
				$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Question Field Empty</div>');
				redirect(base_url().'create-mcq');
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

	 public function delete_sequence_questions(){
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
			$where = "sq_id = '$val'";
			if($this->Crud_modal->update_data($where,'sequence_questions',$update_data)){
				$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Deleted.</div>');
				redirect(base_url().'sequence-list');
			}else{
				$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Delete Data</div>');
				redirect(base_url().'sequence-list');
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

	 public function view_sequence_questions()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		$v = $this->uri->segment(2);
		     		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
				    $data['title']='Admin Dashboard for Monday Morning';
					$where = "sq_id = '$val'";
					$data['sqdata'] = $this->Crud_modal->fetch_single_data('*','sequence_questions',$where);
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('view-sequence',$data);
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



// Added by Himanshu 28052017


public function add_instruction()
{
	try
	{
		 	if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		 		{
		 			$data['title']='Admin Dashboard for Monday Morning';
						$this->load->view('admintempletes/head',$data);
						$this->load->view('admintempletes/header',$data);	
					  	$this->load->view('admintempletes/sidebar',$data);
						$this->load->view('instruction_view',$data);
						$this->load->view('admintempletes/footer');
						//$this->load->view('admintempletes/foot');
				 }
				  else
				 {
					
				    redirect(base_url().'admin','refresh');
			     }
	}
	catch(Exception $e)
	{
		echo "Caught exception",$e->getMessage(),"\n";
	}
}

public function insert_instruction()
{
	try
	{
		 	if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		 		{
		 			$date=date("Y-m-d h:i:s");
					$admin_name=$this->session->userdata('adminid');
					$data=array('instruction_description'=>$this->input->post('instruction_description'),
						'instruction_name'	=>$this->input->post('instruction_name'),
						'created_date'		=>$date,
						'modified_date'		=>$date,
						'status'			=>'1',
						'modified_by'		=>$admin_name
				);
				  $data_return=$this->Crud_modal->data_insert('instruction_widget',$data);
				  if($data_return=='1')
				  {
				  	$this->session->set_flashdata('item','<div class="success"><strong>Success!</strong> Instruction has been added successfully</div>');
				  	redirect(base_url().'add-instruction');
				  }
				}
				  else
				 {
				    redirect(base_url().'admin','refresh');
			     }
	}
	catch(Exception $e)
	{
		echo "Caught exception",$e->getMessage(),"\n";
	}
}


public function view_instruction()
{
	try
	{
		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		{
			$data['title']='Admin Dashboard for Monday Morning';
			$where='status="1"';
			$where1='ml_status="1"';
			$data['lists']=$this->Crud_modal->all_data_select('*','instruction_widget',$where,'instruction_id desc');
			$data['select_inst']=$this->Crud_modal->all_data_select('inst_id','master_level',$where1,'ml_id');
			$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);	
			$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('instruction-list',$data);
			$this->load->view('admintempletes/footer');
		}
	}
	catch(Exception $e)
	{
		echo "Caught exception",$e->getMessage(),"\n";
	}

}

public function update_instruction()
{
	try
	{
		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		{
			$data['title']='Admin Dashboard for Monday Morning';
			$v=$this->uri->segment(2);
			$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
			$where="instruction_id='$val'";
			$data['lists']=$this->Crud_modal->fetch_single_data('*','instruction_widget',$where);
			$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);	
			$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('instruction-update',$data);
			$this->load->view('admintempletes/footer');
		}
	}
	catch(Exception $e)
	{
		echo "Caught exception",$e->getMessage(),"\n";
	}

}

public function update_instruction_data()
{
	try
	{
		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		{
			$admin_name=$this->session->userdata('adminid');
			$date=date("Y-m-d h:i:s");
			$data['title']='Admin Dashboard for Monday Morning';
			$instruction_id=$this->input->post('instruction-id');
			$where="instruction_id='$instruction_id'";
			$field=array('instruction_name'   		=> $this->input->post('instruction_name'),
						 'instruction_description'	=> $this->input->post('instruction_description'),
						 'modified_date'			=> $date,
						 'modified_by'				=> $admin_name

				);
			$data_return=$this->Crud_modal->update_data($where,'instruction_widget',$field);
			if($data_return=='1')
				  {
				  	$this->session->set_flashdata('item','<div class="success"><strong>Success!</strong> Instruction has been updated successfully</div>');
				  	redirect(base_url().'view-instruction');
				  }
				  else
				 {
				    redirect(base_url().'admin','refresh');
			     }
			$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);	
			$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('instruction-update',$data);
			$this->load->view('admintempletes/footer');
		}
	}
	catch(Exception $e)
	{
		echo "Caught exception",$e->getMessage(),"\n";
	}

}

public function  instruction_one()
{
	try
	{
		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		{
			$data['title']='Admin Dashboard for Monday Morning';
			$v=$this->uri->segment(2);
			$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
			$where="instruction_id='$val'";
			$data['lists']=$this->Crud_modal->fetch_single_data('*','instruction_widget',$where);
			$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);	
			$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('view-one-instruction',$data);
			$this->load->view('admintempletes/footer');
		}
	}
	catch(Exception $e)
	{
		echo "Caught exception",$e->getMessage(),"\n";
	}
}

public function delete_instruction()
{
	try
	{
		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		{
			$admin_name=$this->session->userdata('adminid');
			$date=date("Y-m-d h:i:s");
			$data['title']='Admin Dashboard for Monday Morning';
			$v=$this->uri->segment(2);
			$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
			$where="instruction_id='$val'";
			$field=array('status'   				=> '0',
						 'modified_date'			=> $date,
						 'modified_by'				=> $admin_name

				);
			$data_return=$this->Crud_modal->update_data($where,'instruction_widget',$field);
			if($data_return=='1')
				  {
				  	$this->session->set_flashdata('item','<div class="success"><strong>Success!</strong> Instruction has been deleted successfully</div>');
				  	redirect(base_url().'view-instruction');
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
//End by Himanshu 28052017


// Sohrab 01062016


	public function completed_level_scrore()
	{
  	try
		{
		   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
     {
     		$assignorder = $this->input->post('assignorder');
     		$levelorder = $this->input->post('levelorder');
 			if($assignorder != ''){
 				$whereass = "maid = '$assignorder' AND status = '1'";
 				$wherelvl = "maid = '$assignorder' AND ml_status = '1'";
				$data['scores_lists']=$this->Crud_modal->all_data_select('*','completed_level',$whereass,'cl_id desc');
				$data['lvlists']=$this->Crud_modal->all_data_select('*','master_level',$wherelvl,'ml_id asc');
				$data['asid'] = $assignorder;
				if($levelorder!=''){
	 				$wherelvlval = "maid = '$assignorder' AND level_id = '$levelorder' AND status = '1'";
					$data['scores_lists']=$this->Crud_modal->all_data_select('*','completed_level',$wherelvlval,'cl_id desc');
					$data['lvlid'] = $levelorder;
				}
 			}else{
				$data['scores_lists'] = $this->Crud_modal->fetch_alls('completed_level','cl_id desc');
			}
		    $data['title']='Admin Dashboard for Monday Morning';
			$data['alists'] = $this->Admindashboard_modal->total_assign_list('1','asc');
			$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);	
		  	$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('level-scores',$data);
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

 			// Type
	 public function view_level_type()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
					$where = "status = '1'";
					$data['type_lists'] = $this->Crud_modal->all_data_select('*','master_level_type',$where,'id desc');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('view-level-type',$data);
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

	 public function level_edit_type()
	 {
	 	$v = $this->uri->segment('2');
			 $val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
	     	// $val; 
			$where = "id = '$val'";
			$data['sin']=$this->Crud_modal->fetch_single_data('*','master_level_type',$where);
		
   
			
			$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header');	
				  	$this->load->view('admintempletes/sidebar');
		            $this->load->view('edit_view_level_type',$data);
		            $this->load->view('admintempletes/footer');
		            
			
	 }
	 public function edit_insert()
	 {
	 	$field=array('name'=>$this->input->post('name'));
	 	 $val=$this->input->post('hidden_id');
	 	 echo $val; 
$where = "id = '$val'";

	 	$result=$this->Crud_modal->update_data($where,'master_level_type',$field);

		            if($result){
		            	$this->session->set_flashdata('type_insert_message','<div class="success"><strong>Success!</strong> Type has Updated.</div>');
				 	redirect(base_url().'level-type-list', 'refresh');
		            }
	 }

	 public function insert_level_type()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				 	$createdata = array(
			        'name' => $this->input->post('type_name'),
			        'created_date' => date('Y-m-d H:i:s'),
			        'created_by' => $this->session->userdata('adminid')
					);
					$this->Crud_modal->data_insert('master_level_type',$createdata);

				 	$this->session->set_flashdata('type_insert_message','<div class="success"><strong>Success!</strong> Type has Inserted.</div>');
				 	redirect(base_url().'level-type-list');
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

	 public function level_delete_type(){
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
			$where = "id = '$val'";
			if($this->Crud_modal->update_data($where,'master_level_type',$update_data)){
				$this->session->set_flashdata('type_insert_message','<div class="success"><strong>Success!</strong> Data Deleted.</div>');
				redirect(base_url().'level-type-list');
			}else{
				$this->session->set_flashdata('type_insert_message','<div class="danger"><strong>Oops!</strong> Failed to Delete Data</div>');
				redirect(base_url().'level-type-list');
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


//Start sohrab 08062016
	public function day_create()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
					$data['alists'] = $this->Admindashboard_modal->total_assign_list('1','asc');
					$data['dayslist']=$this->Crud_modal->fetch_alls('days_assignment','d_id asc');
					if(!empty($data['dayslist']))	
					{
					for($i=0;$i<sizeof($data['dayslist']);$i++){
						$dayarray[] = $data['dayslist'][$i]['ma_id'];
					}
					$a = implode(',', $dayarray);
					$b = explode(',', $a);
					asort($b);
					
					$data['dayassign'] =implode(',',$b);
					}
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('days-mapping',$data);
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

	  public function insert_day()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				 	$createdata = array(
			        'day' => $this->input->post('day_select'),
			        'ma_id' => implode(',', $this->input->post('assign_select')),
			        'created_date' => date('Y-m-d H:i:s'),
			        'created_by' => $this->session->userdata('adminid')
					);
					$this->Crud_modal->data_insert('days_assignment',$createdata);

				 	$this->session->set_flashdata('data_message','<div class="success"><strong>Success! </strong> Assignment Mapped with Day.</div>');
				 	redirect(base_url().'day-mapped');
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

	 public function mapped_day()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
				    $data['day_select']=$day_select = $this->input->post('day_select');
				    if($day_select!=''){
				    	$where = "day='$day_select'";
				    	$as_lists = $this->Crud_modal->all_data_select('ma_id','days_assignment',$where,'d_id desc');
				    	$as_lists =explode(',', $as_lists[0]['ma_id']);
				    	for ($i=0;$i<sizeof($as_lists);$i++) {
				    		$whereas="maid='$as_lists[$i]'";
				    		$data['ass_name'][] = $this->Crud_modal->all_data_select('assignment_name','master_assignment',$whereas,'maid desc');
				    	}
				    }
					$data['dayslist']=$this->Crud_modal->fetch_alls('days_assignment','d_id asc');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('day-mapped',$data);
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

	 public function mapped_weak()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
				    $data['weak_select']=$weak_select= $this->input->post('weak_select');
					$data['dayslist']=$this->Crud_modal->fetch_alls('days_assignment','d_id asc');

				    if($weak_select!=''){
				    	$where = "weak_id='$weak_select'";
				    	$as_lists = $this->Crud_modal->all_data_select('d_id','weak_days',$where,'weak_id desc');
				    	$data['as_lists'] = explode(',', $as_lists[0]['d_id']);
				    	
				    	$where1 = "status='1'";
				    	$allday_lists = $this->Crud_modal->all_data_select('d_id','weak_days',$where1,'weak_id asc');
				    	for($i=0;$i<sizeof($allday_lists);$i++){
				    		$rid[] = $allday_lists[$i]['d_id'];
				    	}
				    	$ridd = explode(',', implode(',', $rid));
				    	asort($ridd);
				    	$data['ridays'] = $ridd;
				    }
					$data['weakslist']=$this->Crud_modal->fetch_alls('weak_days','weak_id asc');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('weak-mapped',$data);
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

	 public function week_map_update(){
	 	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {

		    	if($this->input->post('days_list')!=''){
		    		$weak_select= $this->input->post('weak_select');
			    	$dayslist = $this->input->post('days_list');
			    	foreach ($dayslist as $dayslists) {
			    		if($dayslists!=''){
				    		$dayslistss[] = $dayslists;
				    	}
			    	}
			    	asort($dayslistss);
			    	$dataupdate['d_id'] =  implode(',', $dayslistss);
			    	$where = "weak_id='$weak_select'";
			    	$this->Crud_modal->update_data($where,'weak_days',$dataupdate);
			    	$this->session->set_flashdata('data_message','<div class="success"><strong>Success! </strong> Days Mapped with Weak.</div>');
		 			redirect(base_url().'week-mapped');
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

	 public function weak_create()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
					$data['dayslist']=$this->Crud_modal->fetch_alls('days_assignment','d_id asc');
					$data['weakslist']=$this->Crud_modal->fetch_alls('weak_days','weak_id asc');
					if(!empty($data['weakslist'])){
						for($i=0;$i<sizeof($data['weakslist']);$i++){
							$dayarray[] = $data['weakslist'][$i]['d_id'];
						}
						$data['dayweaks'] = implode(',', $dayarray);
					}
					
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('weak-mapping',$data);
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

	 public function insert_weak()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		$days = $this->input->post('days_select');
		     		asort($days);
				 	$createdata = array(
			        'weak_name' => $this->input->post('weak_select'),
			        'd_id' => implode(',', $days),
			        'created_date' => date('Y-m-d H:i:s'),
			        'created_by' => $this->session->userdata('adminid')
					);
					$this->Crud_modal->data_insert('weak_days',$createdata);

				 	$this->session->set_flashdata('data_message','<div class="success"><strong>Success! </strong> Days Mapped with Weak.</div>');
				 	redirect(base_url().'week-mapped');
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


 // Case with mcq
	 public function case_list(){
	 	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     	$data['title']='Admin Dashboard for Monday Morning';
				$data['case_lists'] = $this->Crud_modal->all_data_select('case_id,case_name,level_id','case_study','status=1','case_id desc');
				$data['type'] = $this->Crud_modal->all_data_select('ml_id,lvl_name','master_level','ml_status=1','ml_id asc');
		     	$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('case-list',$data);
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
	 public function add_case(){
	 	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {

		     	$v = $this->uri->segment(2);
				$vl = explode('-', $v);
				$val = base64_decode(str_pad(strtr($vl[0], '-_', '+/'), strlen($vl[0]) % 4, '=', STR_PAD_RIGHT));
		     	$data['title']='Admin Dashboard for Monday Morning';
		     	$data['case_value'] = $this->Crud_modal->fetch_single_data('*','case_study','case_id="'.$val.'"');

		     	$data['assnames']=$this->Admindashboard_modal->getassignment_for_case();

				$data['type'] = $this->Crud_modal->all_data_select('ml_id,lvl_name','master_level','ml_status=1','ml_id asc');
		     	$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);
			  	$this->load->view('admintempletes/sidebar',$data);
			  	if($vl[1]!=''){
			  		$this->load->view('case-detail',$data);
			  	}else{
					$this->load->view('add-case',$data);
				}
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
	 
	 public function getcaselevel(){
	 	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				$assid =$this->input->post('assignid');
				$clvlids=$this->Crud_modal->all_data_select('level_id','case_study',"status='1'",'level_id asc');
				if($clvlids!=null){
					foreach ($clvlids as $clvlid) {
							$mlvlids[]= $clvlid['level_id'];
					}
					$mlvlid= implode($mlvlids, ", ");
				}else{
					$mlvlid='0';
				}
				$lvlid=$this->Crud_modal->all_data_select('ml_id,lvl_name','master_level',"maid='$assid' AND m_type=4 AND ml_id NOT IN ($mlvlid)",'ml_id asc');
				if($lvlid==null){
					$lvlid['ml_id']=0;
				}
				echo json_encode($lvlid);
			}else{
				redirect(base_url().'admin','refresh');
			}
		}catch(Exception $e){
			echo "Caught exception",$e->getMessage(),"\n";
		}
	 }

public function insert_case()
{
	try
	{
		 	if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		 		{
		 			$redirect_page=$this->input->post('redirection_page');
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
						'case_name'		=>$this->input->post('case_name'),
						'content'		=>$this->input->post('case_content'),
						'maid'		=>$this->input->post('case_assignment'),
						'level_id'	=>$this->input->post('case_level'),
						'case_sequence'	=>implode(',',$arsq),
						'quest_limit'	=>implode(',', $sqlm),
						'sample_file'	=>implode(',', $file),
						'audiofile'	=>$mp3file,
						'videofile'	=>$mp4file,
						'created_date'	=>date("Y-m-d h:i:s"),
						'created_by'	=>$this->session->userdata('adminid')
					);
					$this->Crud_modal->data_insert('case_study',$data);
					$this->session->set_flashdata('item','<div class="success"><strong>Success!</strong> Case has been Inserted successfully</div>');
					if($redirect_page==1){
                        redirect(base_url().'create-package-demo#step-5');
                    }else{
                        redirect(base_url().'add-case');
                    }
				}
				  else
				 {
				    redirect(base_url().'admin','refresh');
			     }
	}
	catch(Exception $e)
	{
		echo "Caught exception",$e->getMessage(),"\n";
	}
}


public function delete_case(){
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
		$where = "case_id = '$val'";
		if($this->Crud_modal->update_data($where,'case_study',$update_data)){
			$this->session->set_flashdata('item','<div class="success"><strong>Success!</strong> Data Deleted.</div>');
			redirect(base_url().'case-list');
		}else{
			$this->session->set_flashdata('item','<div class="danger"><strong>Oops!</strong> Failed to Delete Data</div>');
			redirect(base_url().'case-list');
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
public function update_case(){
try
		{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     {
	     	$v = $this->input->post('case_id');
			$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
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
                            redirect(base_url().'edit-case/'.$v);
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
                         redirect(base_url().'edit-case/'.$v);
                    }
                }else{
					$this->session->set_flashdata('item','<div class="danger"><strong>Sorry!</strong> Upload only mp3 audio file.</div>');
					redirect(base_url().'edit-case/'.$v);
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
                        redirect(base_url().'edit-case/'.$v);
                    }
                }else{
					$this->session->set_flashdata('item','<div class="danger"><strong>Sorry!</strong> Upload only mp4 video file.</div>');
					redirect(base_url().'edit-case/'.$v);
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
				redirect(base_url().'edit-case/'.$v);
			}else{
				$this->session->set_flashdata('item','<div class="danger"><strong>Oops!</strong> Failed to Update Data</div>');
				redirect(base_url().'edit-case/'.$v);
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

// End Sohrab 21062016
public function completed_user_scrore()
	{
  	try
		{
		   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
     {
     		$data['title']='Admin Dashboard for Monday Morning';
     		$config = array();
     		$count_val=$this->Crud_modal->check_numrow("completed_level","status=1");
     		if($this->input->post('testtable2_length')>20){
			$config["per_page"]=$count_val;
			}else{
				$config["per_page"] = 20;
			}
			$data['assign_id']=$config["per_page"];
 			$config["base_url"] = base_url() ."user-scores";
			$total_row = $this->Crud_modal->check_numrow("completed_level","status=1");
			$config["total_rows"] = $total_row;
			$config["uri_segment"] = 2;
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;		
			$data['user_score']=$this->Admindashboard_modal->level_completed_list($config["per_page"],$page);
			
			$data["links"]=$this->pagination->create_links();
			$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);	
		  	$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('users-scores',$data);
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

 	########### Code by ravi ##################################
public function candidate_score()
 {
          try
            {
                   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
             {
                        $data['title']='Admin Dashboard for Monday Morning';
                        $data['packages_lists']=$this->Crud_modal->all_data_select('*','mm_packages',"status=1",'package_id asc');
                        $pkgid = $this->input->post('packg');
                        if($pkgid!=''){
                        	$data['pkgid']=$pkgid;
                        	$asdata = $this->Crud_modal->fetch_single_data('ma_id','mm_packages',"package_id=$pkgid");
                        	$maids = $asdata['ma_id'];
                        	$data['list_of_assignment']=$this->Crud_modal->all_data_select('maid,assignment_name,type','master_assignment',"maid IN($maids)",'maid asc');
                        }
                        $maid = $this->input->post('maid');
                     
                        if($maid!=''){
                        	$data['maid']=$maid;
                        	$data['master_level_count'] = $this->Score_model->master_level_count($maid);
							$data['list_condidate'] = $this->Score_model->list_condidate($maid);
							for ($i = 0; $i < sizeof($data['list_condidate']); $i++)
							{
								$copy_uid = $data['list_condidate'][$i]->uid;
								$score_row_count = $this->Score_model->score_count($copy_uid, $maid);
								$mslevel = $data['master_level_count']['numberlevel'];
								if ($score_row_count != $mslevel)
								{
									$data['list_condidate_done'][] = $this->Score_model->list_condidate_done($copy_uid, $maid);
								}
							}
                        }


                        $this->load->view('admintempletes/head',$data);
                        $this->load->view('admintempletes/header',$data);    
                        $this->load->view('admintempletes/sidebar',$data);
                        $this->load->view('unchecked-user',$data);
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
 public function checked_candidate()
 {
          try
            {
                   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
             {
                        $data['title']='Admin Dashboard for Monday Morning';
                        $data['list_of_assignment']=$this->Admindashboard_modal->list_of_assignment();
                        $this->load->view('admintempletes/head',$data);
                        $this->load->view('admintempletes/header',$data);    
                          $this->load->view('admintempletes/sidebar',$data);
                        $this->load->view('checked-user',$data);
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

############################ end of code of ravi #################################
 ##############################################     08052017 code by ravi #################################################
public function preview_data()
{
	try
	{
			  if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
					
		     		$qurstr=$this->uri->segment(2);
		     		$code= base64_decode(str_pad(strtr($qurstr, '-_', '+/'), strlen($qurstr) % 4, '=', STR_PAD_RIGHT));
			    
			     	($data['udata']=$this->Admindashboard_modal->get_data_for_preview($code));
			     		

					$data['title']='Admin Dashboard for Monday Morning';
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
					$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('preview-form',$data);
					$this->load->view('admintempletes/footer');
		

	
			}
	}
	catch (Exception $e)
	{
		echo 'Caught exception', $e->getMessage(),"\n";
	}
}
##############################################     06062017 code by ravi #################################################

	public function difficulty_level()
	{
		try {
				if($this->session->userdata('admin_name') !="" || $this->session->userdata('admin_name')!=null)
				{	
					$data['title']='Admin Dashboard for Monday Morning';
					$where="status='1'";
					$data['level_type']=$this->Crud_modal->all_data_select('*','master_difficulty_level',$where,'diffi_id asc');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
					$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('difficultly-level',$data);
					$this->load->view('admintempletes/footer');

				}else{
					redirect(base_url().'admin');
				}

			
		} catch (Exception $e) {
				echo 'Caught Exception',$e->getMessage(),"\n";			
		}
	}
public function save_difficulty_level()
	{
		try {
				if($this->session->userdata('admin_name') !="" || $this->session->userdata('admin_name')!=null)
				{	
					$data['difficulty_level']=$this->input->post('difficultly-level');
					$data['points']=$this->input->post('points');
					$data['created_by']=$this->session->userdata('adminid');
					$data['created_on']=date('Y-m-d H:i');
					$data['status']=1;
					if($this->Crud_modal->data_insert('master_difficulty_level',$data))
					{
						$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong>Data Inserted.</div>');
						redirect(base_url().'difficulty-level');
					}else{
						$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to  Data Insert</div>');
						redirect(base_url().'difficulty-level');
					}


				}else{
					redirect(base_url().'admin');
				}

			
		} catch (Exception $e) {
				echo 'Caught Exception',$e->getMessage(),"\n";			
		}
	}
	public function update_difficulty_level()
	{
		try {
				if($this->session->userdata('admin_name') !="" || $this->session->userdata('admin_name')!=null)
				{	
					$data['difficulty_level']=$this->input->post('difficultly-level');
					$data['points']=$this->input->post('points');
					$data['modified_by']=$this->session->userdata('adminid');
					$data['modified_on']=date('Y-m-d H:i');
					$diffi_id=$this->input->post('sfshfdfhfklfh');
					if($this->Crud_modal->update_data("diffi_id='$diffi_id'",'master_difficulty_level',$data))
					{
						$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong>Data Updated.</div>');
						redirect(base_url().'difficulty-level');
					}else{
						$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to  Data Updated</div>');
						redirect(base_url().'difficulty-level');
					}


				}else{
					redirect(base_url().'admin');
				}

			
		} catch (Exception $e) {
				echo 'Caught Exception',$e->getMessage(),"\n";			
		}
	}
	public function diffi_edit()
	{
		try {
				if($this->session->userdata('admin_name') !="" || $this->session->userdata('admin_name')!=null)
				{	
					$v=$this->uri->segment(2);
					$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
					$where="diffi_id='$val'";
					$data['level_type']=$this->Crud_modal->all_data_select('*','master_difficulty_level',$where,'diffi_id asc');

					$data['title']='Admin Dashboard for Monday Morning';
					$where="status='1'";
					
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
					$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('edit-difficulty',$data);
					$this->load->view('admintempletes/footer');

				}else{
					redirect(base_url().'admin');
				}

			
		} catch (Exception $e) {
				echo 'Caught Exception',$e->getMessage(),"\n";			
		}
	}


    ##############################################     end of ravi code      #################################################
    ############### code by sohrab ###########3###
    public function view_filetype()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
				    $data['title']='Admin Dashboard for Monday Morning';
					$where = "status = '1'";
					$data['master_filetype_lists'] = $this->Crud_modal->all_data_select('*','master_filetype',$where,'ft_id desc');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('file-extensions',$data);
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
	 public function insert_filetype()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		$ext = str_replace('.', '', $this->input->post('file_extensions'));
		     		for ($i=0; $i <sizeof($ext) ; $i++) { 
		     			$extval[] = '.'.$ext[$i];
		     		}
				 	$createdata = array(
			        'ft_name' => $this->input->post('file_typename'),
			        'ft_extensions' => implode(',', $extval),
			        'created_date' => date('Y-m-d H:i:s'),
			        'created_by' => $this->session->userdata('adminid')
					);
					$this->Crud_modal->data_insert('master_filetype',$createdata);

				 	$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data has Inserted.</div>');
				 	redirect(base_url().'file-extension');
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

	 public function delete_filetype(){
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
			$where = "ft_id = '$val'";
			if($this->Crud_modal->update_data($where,'master_filetype',$update_data)){
				$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Deleted.</div>');
				redirect(base_url().'file-extension');
			}else{
				$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Delete Data</div>');
				redirect(base_url().'file-extension');
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


	 ###############################################   start code of Himanshu singh   #########################################
	public function match_the_following()
	{
		try
		{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			{
					$data['title']='Admin Dashboard for Monday Morning';
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
				  	$this->load->view('match-following',$data);
					$this->load->view('admintempletes/footer');
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

	public function match_follow()
	{
		try
		{
			if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null)
			{
				$created_by=$this->session->userdata('adminid');
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
						redirect(base_url().'match-the-following');
					}
				}
				$created_date=date('Y-m-d H:i:s');
				$data_array=array(
					"match_question" => $matc_qus,
					"match_answer"   => $matc_ans,
					"question_topic" => $this->input->post('question_topic'),
					"answer_topic"	 => $this->input->post('answer_topic'),
					"question_heading"=>$this->input->post('question'),
					'topic' =>$this->input->post('master_topic'),
					'difficulty_level' => $this->input->post('master_difficulty_level'),
				    'type' => $this->input->post('master_type'),	
				    'skill_tested' => $this->input->post('master_skills_test'),
				    'case_id' => $this->input->post('master_case'),
					"created_date" => $created_date,
					"match_status" => '1',
					"created_by"   => $created_by,
					"modified_date" => $created_date
					);
				if($this->Crud_modal->data_insert('match_the_following',$data_array)){
					$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Inserted.</div>');
					redirect(base_url().'match-list');
				}else{
					$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Insert Data</div>');
					redirect(base_url().'match_the_following');
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

	public function match_list()
	{
		try
		{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     		{
				    $data['title']='Admin Dashboard for Monday Morning';
					$where = "match_status = 1";
					$assign_id=$this->input->post('assignorder');
					$data['topic_list']= $this->Crud_modal->all_data_select('*','master_topic','status=1','t_name asc');
					if($this->input->post('assignorder')!='')
					{
					$data['asid']=$assign_id;
					$data['match_lists'] = $this->Crud_modal->all_data_select('*','match_the_following',"topic='$assign_id' AND match_status = 1",'match_id desc');
					}
					else
					{
						$data['match_lists'] = $this->Crud_modal->all_data_select('*','match_the_following',$where,'match_id desc');
					}
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('match-list',$data);
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
	public function match_view()
	{
		try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		$v = $this->uri->segment(2);
		     		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
				    $data['title']='Admin Dashboard for Monday Morning';
					$where = "match_id = '$val'";
					$data['matchdata'] = $this->Crud_modal->fetch_single_data('*','match_the_following',$where);
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('view-match',$data);
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

	
	public function update_match_view()
	{
		try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		$v = $this->uri->segment(2);
		     		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
				    $data['title']='Admin Dashboard for Monday Morning';
				    $where = "match_id = '$val'";
					$data['matchdata'] = $this->Crud_modal->fetch_single_data('*','match_the_following',$where);
					$wheres = 'status =1';
					$data['master_topics'] = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$wheres,'t_id desc');
					$data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$wheres,'type_id desc');
					$data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name',' master_skills_test',$wheres,'skills_id desc');	
					$data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$wheres,'diffi_id desc');
					$data['master_case'] = $this->Crud_modal->all_data_select('case_id,case_name','case_study',$wheres,'case_id asc');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('match-update',$data);
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
	public function update_match()
	{
		try
		{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			{
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
					  	redirect(base_url().'match-list');
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

	public function delete_match()
	{
		try
		{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			{
				$admin_name=$this->session->userdata('adminid');
				$date=date("Y-m-d h:i:s");
				$data['title']='Admin Dashboard for Monday Morning';
				$v=$this->uri->segment(2);
				$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
				$where="match_id='$val'";
				$field=array('match_status'   			=> '0',
							 'modified_date'			=> $date,
							 'modified_by'				=> $admin_name
							 );
				$data_return=$this->Crud_modal->update_data($where,'match_the_following',$field);
				if($data_return=='1')
					  {
					  	$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong>Match the following has been deleted successfully</div>');
					  	redirect(base_url().'match-list');
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
	
	public function insert_fill()
	{
					$data['title']='Admin Dashboard for Monday Morning';
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
					$this->load->view('fill-view',$data);
					$this->load->view('admintempletes/footer',$data);
	}
	public function create_fill_in_blank()
	{
				try
				{
					if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null)
					{


						$created_by=$this->session->userdata('adminid');
						$matc_ans=$this->input->post('answer1');

						$created_date=date('Y-m-d H:i:s');
						$fibquest = str_replace('inllif','<a href="" class="fibeditable"></a>',trim($this->input->post('fib_question')));
						$data_array=array(
							"fib_question" => $fibquest,
							"fib_answer"   => strtolower(trim($matc_ans)),
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
						
						if($this->Crud_modal->data_insert('mm_fib',$data_array)){
							$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Inserted.</div>');
							redirect(base_url().'insert-fill');
						}else{
							$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Insert Data</div>');
							redirect(base_url().'insert-fill');
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

public function fill_in_blank()
	{
		try
		{
			   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	     		{
				$data['title']='Admin Dashboard for Monday Morning';
				$where = "fib_status = 1";
				$assign_id=$this->input->post('assignorder');

				$data['topic_list']= $this->Crud_modal->all_data_select('*','master_topic','status=1','t_name asc');
				if($this->input->post('assignorder')!='')
				{
				$data['asid']=$assign_id;
				$data['sqences_lists'] = $this->Crud_modal->all_data_select('*','mm_fib',"topic='$assign_id' AND fib_status=1",'fib_id desc');
				}
				else
				{
					$data['sqences_lists'] = $this->Crud_modal->all_data_select('*','mm_fib',$where,'fib_id desc');
				}
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('view-fib',$data);
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


public function view_fib_questions()

 	{

	  	try

			{

				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))

		     {

		     		$v = $this->uri->segment(2);

		     		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));

				    $data['title']='Admin Dashboard for Monday Morning';


					$where = "fib_id = '$val'";

					$data['sqdata'] = $this->Crud_modal->fetch_single_data('*','mm_fib',$where);

					$this->load->view('admintempletes/head',$data);

					$this->load->view('admintempletes/header',$data);	

				  	$this->load->view('admintempletes/sidebar',$data);

					$this->load->view('view-fib-qusetion',$data);

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

	 public function fill_update_view()
	 {
	 	try
	 	{
	 		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	 		{
	 				$v = $this->uri->segment(2);
		     		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
				    $data['title']='Admin Dashboard for Monday Morning';
				    $where = "fib_id = '$val'";
				    $data['filldata'] = $this->Crud_modal->fetch_single_data('*','mm_fib',$where);
					$where = 'status =1';
					$data['master_topics'] = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$where,'t_id desc');
					$data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$where,'type_id desc');
					$data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name','master_skills_test',$where,'skills_id desc');
					$whereall = 'status =1';
					$data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$whereall,'diffi_id desc');
					$data['master_case'] = $this->Crud_modal->all_data_select('case_id,case_name','case_study',$where,'case_id asc');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('update-fill',$data);
					$this->load->view('admintempletes/footer',$data);
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
	 
	 	 public function edit_fib()
	 {
	 	try
	 	{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	 		{
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
							redirect(base_url().'fill-in-blank');
						}else{
							$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to update Data</div>');
							redirect(base_url().'fill-in-blank');
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
	###############################################   end code of Himanshu singh   #########################################
	//////////Code for subjective//////////////
	 public function subjective_list(){
	 	try{
 			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
 				$data['title']='Admin Dashboard for Monday Morning';
					$where = "status = 1";
					$assign_id=$this->input->post('assignorder');
					$data['topic_list']= $this->Crud_modal->all_data_select('*','master_topic','status=1','t_name desc');
					if($this->input->post('assignorder')!='')
					{
					$data['asid']=$this->input->post('assignorder');
					$data['questions'] = $this->Crud_modal->all_data_select('*','subjective',"topic='$assign_id' and status='1'",'subjective_id desc');
					}
					else
					{
					$data['questions'] = $this->Crud_modal->all_data_select('*','subjective',$where,'subjective_id desc');
				
					}
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('subjective-list',$data);
					$this->load->view('admintempletes/footer');	      
		    }else{
		    	redirect(base_url().'admin','refresh');
		    }

		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	 }

	 public function subjective_create(){
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
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('create-subjective',$data);
				$this->load->view('admintempletes/footer');	     
		    }else{
		    	redirect(base_url().'admin','refresh');
		    }

		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	 }

	 public function subjective_insert(){
		try{
			if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
				

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
				redirect(base_url().'create-subjective');

			}else{
				redirect(base_url().'admin','refresh');
		    }
		}catch(Exception $e){
			echo 'Caught exception', $e->getMessage(),"\n";
		}
	}
	public function subjective_view()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		$v = $this->uri->segment(2);
		     		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
				    $data['title']='Admin Dashboard for Monday Morning';
					$where = "subjective_id = '$val'";
					$data['subjective'] = $this->Crud_modal->fetch_single_data('*','subjective',$where);
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('view-subjective',$data);
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
	 //26072017 sohrab
	 public function subjective_edit()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		$v = $this->uri->segment(2);
		     		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
				    $data['title']='Admin Dashboard for Monday Morning';
					$where1 = "subjective_id = '$val'";
					$data['subjective'] = $this->Crud_modal->fetch_single_data('*','subjective',$where1);
					$where = 'status =1';
					$data['master_topics'] = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$where,'t_id desc');
					$data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$where,'type_id desc');
					$data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name',' master_skills_test',$where,'skills_id desc');
					$data['master_case'] = $this->Crud_modal->all_data_select('case_id,case_name','case_study',$where,'case_id asc');
					$data['filetypelist'] = $this->Crud_modal->all_data_select('ft_extensions,ft_name','master_filetype',$where,'ft_id desc');
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('edit-subjective',$data);
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
	 public function subjective_update(){
		try{
			if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
				
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
				redirect(base_url().'subjective-edit/'.$sid);

			}else{
				redirect(base_url().'admin','refresh');
		    }
		}catch(Exception $e){
			echo 'Caught exception', $e->getMessage(),"\n";
		}
	}
	   // for admin score
	public function subjective_score()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		$pkgval='';
		     		$assval='';
		     		if($this->session->flashdata('ssval')!=''){
			     		$v = explode('-', $this->session->flashdata('ssval'));
			     		$pkgval = base64_decode(str_pad(strtr($v[4], '-_', '+/'), strlen($v[4]) % 4, '=', STR_PAD_RIGHT));
			     		$assval = base64_decode(str_pad(strtr($v[2], '-_', '+/'), strlen($v[2]) % 4, '=', STR_PAD_RIGHT));
			     	}
		     		if($this->input->post('pkgid')!='' || $pkgval!=''){
		     			if($pkgval!=''){
		     				$data['pkgid']=$pkgid=$pkgval;
		     			}else{
		     				$data['pkgid']=$pkgid=$this->input->post('pkgid');
		     			}
		     			$assidss = $this->Crud_modal->fetch_single_data('ma_id','mm_packages',"package_id=$pkgid");
		     			$assid= $assidss['ma_id'];
		     			$data['groupassigns'] = $this->Admindashboard_modal->all_data_with_group("cs.case_sequence LIKE '%6%' AND cs.maid IN($assid)");
				     	if($this->input->post('maid')!='' || $assval!=''){
				     		if($pkgval!=''){
			     				$data['maid']=$maid= $assval;
			     			}else{
			     				$data['maid']=$maid= $this->input->post('maid');
			     			}
				     		if($pkgid=''){
				     			$maid='';
				     		}
				     		$where = "maid='$maid' AND status=0";
						    $data['subjectives_ans']=$this->Admindashboard_modal->alldatawith_group_order('*','case_subjective_user_ans',$where,'c_s_u_a_id DESC');
				     	}
				     }
		     		$data['grouppackages'] = $this->Crud_modal->all_data_select('package_id,package_name','mm_packages',"status in(1,3)",'package_id desc');
					$data['title']='Admin Dashboard for Monday Morning';
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('subjective-score',$data);
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

	public function subjective_user_score()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		$v = $this->uri->segment(2);
		     		$allval = explode('-',$v);
		     		$uid = base64_decode(str_pad(strtr($allval[0], '-_', '+/'), strlen($allval[0]) % 4, '=', STR_PAD_RIGHT));
		     		$cid = base64_decode(str_pad(strtr($allval[1], '-_', '+/'), strlen($allval[1]) % 4, '=', STR_PAD_RIGHT));
		     		$aid = base64_decode(str_pad(strtr($allval[2], '-_', '+/'), strlen($allval[2]) % 4, '=', STR_PAD_RIGHT));
		     		$lid = base64_decode(str_pad(strtr($allval[3], '-_', '+/'), strlen($allval[3]) % 4, '=', STR_PAD_RIGHT));
				    $data['title']='Admin Dashboard for Monday Morning';

				    $where = "u_id='$uid' AND case_id='$cid' AND maid ='$aid' AND ml_id='$lid'";
			     	$data['subjectives_ans'] = $this->Crud_modal->all_data_select('*','case_subjective_user_ans',$where,'c_s_u_a_id asc');
			  		$question_count=$this->Crud_modal->fetch_single_data("quest_limit","case_study","case_id='$cid'");
			  		$ques=explode(",",$question_count['quest_limit']);
			  		$total_question=0;
			  		for($i=0;$i<sizeof($ques);$i++)
			  		{
			  			$total_question+=$ques[$i];
			  		} 
			  		$data['userdata']=$this->Crud_modal->fetch_single_data('mm_user_full_name','user',"mm_uid='$uid'");
			  		$total_level_score=$this->Crud_modal->fetch_single_data("total_level_marks,total_question","score","u_id='$uid' and maid ='$aid' AND level_id='$lid'");
			  		$total_marks=$total_level_score['total_level_marks']/2;
					$subjective_question=$total_question-$total_level_score['total_question'];
					$data['per_question_marks']=$total_marks/$subjective_question;
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	 
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('subjective-user-score',$data);
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

	
	
	
	public function checked_subjective_score()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {

			     	$pkgval='';
		     		$assval='';
		     		if($this->session->flashdata('ssval')!=''){
			     		$v = explode('-', $this->session->flashdata('ssval'));
			     		$pkgval = base64_decode(str_pad(strtr($v[4], '-_', '+/'), strlen($v[4]) % 4, '=', STR_PAD_RIGHT));
			     		$assval = base64_decode(str_pad(strtr($v[2], '-_', '+/'), strlen($v[2]) % 4, '=', STR_PAD_RIGHT));
			     	}
		     		if($this->input->post('pkgid')!='' || $pkgval!=''){
		     			if($pkgval!=''){
		     				$data['pkgid']=$pkgid=$pkgval;
		     			}else{
		     				$data['pkgid']=$pkgid=$this->input->post('pkgid');
		     			}
		     			$assidss = $this->Crud_modal->fetch_single_data('ma_id','mm_packages',"package_id=$pkgid");
		     			$assid= $assidss['ma_id'];
		     			$data['groupassigns'] = $this->Admindashboard_modal->all_data_with_group("cs.case_sequence LIKE '%6%' AND cs.maid IN($assid)");
				     	if($this->input->post('maid')!='' || $assval!=''){
				     		if($pkgval!=''){
			     				$data['maid']=$maid= $assval;
			     			}else{
			     				$data['maid']=$maid= $this->input->post('maid');
			     			}
				     		if($pkgid=''){
				     			$maid='';
				     		}
				     		$where = "maid='$maid' AND status=1";
						    $data['subjectives_ans']=$this->Admindashboard_modal->alldatawith_group_order('*','case_subjective_user_ans',$where,'c_s_u_a_id DESC');
				     	}
				    }
		     		$data['grouppackages'] = $this->Crud_modal->all_data_select('package_id,package_name','mm_packages',"status=1",'package_id desc');
					$data['title']='Admin Dashboard for Monday Morning';
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('checked-subjective-score',$data);
					$this->load->view('admintempletes/footer');
					##################### important code for package
					//echo date('M n, Y 00:00:00',strtotime(date(). "+45 days"));
					##########################

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

	public function subjective_user_score_checked()
 	{
	  	try
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		$v = $this->uri->segment(2);
		     		$allval = explode('-',$v);
		     		$uid = base64_decode(str_pad(strtr($allval[0], '-_', '+/'), strlen($allval[0]) % 4, '=', STR_PAD_RIGHT));
		     		$cid = base64_decode(str_pad(strtr($allval[1], '-_', '+/'), strlen($allval[1]) % 4, '=', STR_PAD_RIGHT));
		     		$aid = base64_decode(str_pad(strtr($allval[2], '-_', '+/'), strlen($allval[2]) % 4, '=', STR_PAD_RIGHT));
		     		$lid = base64_decode(str_pad(strtr($allval[3], '-_', '+/'), strlen($allval[3]) % 4, '=', STR_PAD_RIGHT));
				    $data['title']='Admin Dashboard for Monday Morning';

				    $where = "u_id='$uid' AND case_id='$cid' AND maid ='$aid' AND ml_id='$lid'";
			     	$data['subjectives_ans'] = $this->Crud_modal->all_data_select('*','case_subjective_user_ans',$where,'c_s_u_a_id asc');
			  		$data['userdata']=$this->Crud_modal->fetch_single_data('mm_user_full_name','user',"mm_uid='$uid'");
			  
					$this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);	
				  	$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('subjective-user-score-checked',$data);
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

	############################ Code by Rahul  #######################################################################
    public function ticket_view()

 	{

	  	try

			{

				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))

		     {
		     	  $data['title']='Admin Dashboard for Monday Morning';

		     	  

					$this->load->view('admintempletes/head',$data);

					$this->load->view('admintempletes/header',$data);	

				  	$this->load->view('admintempletes/sidebar',$data);

					$this->load->view('supportticket',$data);

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
public function ticket_view4()
        {
            try
            {
                if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
                 {
                    $where="delete_status=1 and status=1";
                    $all=$this->Crud_modal->all_data_select('*','mm_ticket',$where,'ticket_id desc');
                    //$all=$this->Crud_modal->fetch_alls('mm_ticket','ticket_id desc');
                    //print_r($all);
                    echo json_encode($all);
                }
            }
            catch(Exception $e)
            {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            } 
        }
public function viewticket3()
        {
            try
            {
                if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
               {
                     $data_id=$this->input->post('score_id');
                     if($data_id!="")
                     {
                    $where="status='$data_id' and delete_status=1";
                    $all=$this->Crud_modal->all_data_select('*','mm_ticket',$where,'ticket_id desc');
                    }else{
                        $where="delete_status=1";
                        $all=$this->Crud_modal->all_data_select('*','mm_ticket',$where,'ticket_id desc');
                        //$all=$this->Crud_modal->fetch_alls('mm_ticket','ticket_id desc');
                    }

                    
                    echo json_encode($all);
                }
            }
            
            catch(Exception $e)
            {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }



		public function date_search()
		{
			try
			{
				if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			   {


			     $fdate=date("Y-m-d",strtotime($this->input->post('fdate')));
			     $tdate=date("Y-m-d",strtotime($this->input->post('tdate')));
			 	
			     $all=$this->Admindashboard_modal->data_select($fdate,$tdate);
					// print_r($all);
					// exit;
					echo json_encode($all);
				}
			}
			
			catch(Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}

function reply() 
  {
		   try {

		   		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		   		{
		   			$uri=$this->uri->segment(2);
					$where3="ticket_id='$uri'";
				    $data['ticket']=$this->Crud_modal->all_data_select('subject,created_date,status,ticket_id,ticket_sequence_no,department,priority,name,email_id,uid','mm_ticket',$where3,'created_date desc');
				    $data['chat']=$this->Crud_modal->all_data_select('*','chat',$where3,'chat_id asc');

					$this->load->view('admintempletes/head',$data);

					$this->load->view('admintempletes/header',$data);	

				  	$this->load->view('admintempletes/sidebar',$data);

					$this->load->view('user-reply',$data);

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



function user_chat() 
  {
		   try {

              if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			{
				
			$ticket=$this->input->post('ticket_id');
			
			$uid= $this->input->post('uid');
			$message=$this->input->post('replymessage');
			$date=date('Y-m-d H:i:s');
			$data['subject']=$this->input->post('subject');
			$data['user_mail']=$this->input->post('user_mail');
			$data['username']=$this->input->post('user_name');
			$data['ticket_id']=$this->input->post('ticket_sequence_id');
			$data['msg']=$message;
			$message1=$this->load->view('mailer/reply_mail',$data,true);	 
					$data=array(
					'ticket_id'=>$ticket,
					'uid'=>$uid,
					'admin_message'=>$message,
					'created_date'=>$date
					);
					
					$insert_id=$this->Crud_modal->data_insert('chat',$data);	
		##########ticket mail admin#######
					$mail = new PHPMailer();
					$mail->IsSMTP();
					$mail->Host = "mondaymorning.co.in";
					$mail->SMTPAuth = true;
					$mail->Port = 587;
					$mail->Username = "mondaymorning@mondaymorning.co.in";
					$mail->Password = "monday@01";
					$mail->From = "mondaymorning@mondaymorning.co.in";
					$mail->FromName = $this->input->post('subject');
					$mail->AddAddress($this->input->post('user_mail'));
					$mail->IsHTML(true);
					$mail->Subject = $this->input->post('subject');
					$mail->Body = $message1;
					if(!$mail->Send())
					{
					echo "Message could not be sent. <p>";
					echo "Mailer Error: " . $mail->ErrorInfo;
					}
					
			
			##########ticket mail admin#######					
					if($insert_id){
					$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong>Message Sent</div>');
					redirect(base_url().'reply/'.$ticket);
					}
					else{
					$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Insert Data</div>');
					redirect(base_url().'reply/'.$ticket);
				    }						
											
				}
		}
		    catch (Exception $e) {
		   	echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
		   	
		   }
				 
}

public function create_package_page(){
	try{
		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
			$data['title']="MondayMorning";
			$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);

			$where1 = "status='1'";
	    	$allass_lists = $this->Crud_modal->all_data_select('ma_id','mm_packages',$where1,'package_id asc');
	    	for($i=0;$i<sizeof($allass_lists);$i++){
	    	    if($allass_lists[$i]['ma_id']!=""){
	    	        $rid[] = $allass_lists[$i]['ma_id'];
	    	    }
	    	}
	    
	    	$ridd = explode(',', implode(',', $rid));
	    	asort($ridd);
	    	$ridays=ltrim(implode(',', array_values($ridd)));
	    	if($ridays!=''){
				$data['assignmentlists']=$this->Crud_modal->all_data_select('maid,assignment_name','master_assignment',"status=1 AND maid NOT IN ($ridays)",'maid asc');
			}else{
				$data['assignmentlists']=$this->Crud_modal->all_data_select('maid,assignment_name','master_assignment',"status=1",'maid asc');
			}
		  	$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('create-package',$data);
			$this->load->view('admintempletes/footer');
		}else{
			redirect(base_url().'admin','refresh');
		}
	}catch(Exception $e){
		echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	}
}

public function insert_package(){
	try{
		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
			$insertdata['package_name']=trim($this->input->post('package_name'));
			$insertdata['ma_id']=implode(',',$this->input->post('ma_id'));
			$insertdata['validity']=trim($this->input->post('validity'));
			$insertdata['total_marks']=trim($this->input->post('total_marks'));
			$insertdata['description']=trim($this->input->post('description'));
			$insertdata['status']=$this->input->post('pkg_status');
			$insertdata['created_date']=date('Y-m-d H:i:s');
			$insertdata['created_by']=$this->session->userdata('adminid');	
			$config['upload_path']          = './upload/package/';
			$config['allowed_types']        = 'gif|jpg|png';
         	$new_name = time().$_FILES["image"]['name'];
			$config['file_name'] = $new_name;

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image'))
                {
                	$file=$this->upload->data();
                    $insertdata['image'] =$file['file_name'];
                    $this->Crud_modal->data_insert('mm_packages',$insertdata);
                    $this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Package Created</div>');
                }else{
                	//$error = array('error' => $this->upload->display_errors());
                	$this->session->set_flashdata('data_message','<div class="danger"><strong>oops!</strong>File not uploaded</div>');            
                }
               
			
			
			redirect(base_url().'create-package','refresh');
		}else{
			redirect(base_url().'admin','refresh');
		}
	}catch(Exception $e){
		echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	}
}

public function view_package_page(){
	try{
		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
			$data['title']="MondayMorning";
			$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);

			$where1 = "status='1'";
	    	$data['allass_lists'] = $this->Crud_modal->all_data_select('package_id,package_name','mm_packages',$where1,'package_id asc');
		  	$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('view-package',$data);
			$this->load->view('admintempletes/footer');
		}else{
			redirect(base_url().'admin','refresh');
		}
	}catch(Exception $e){
		echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	}
}

public function view_package_data(){
	try{
		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
			$pack_id=$this->input->post('packid');
			$where1 = "package_id='$pack_id'";
	    	$allass_lists= $this->Crud_modal->fetch_single_data('validity,ma_id,total_marks','mm_packages',$where1);
	    	$aslist['validity'] = $allass_lists['validity'];
	    	$aslist['total_marks'] = $allass_lists['total_marks'];
	    	$ridays=$allass_lists['ma_id'];
	    	$aslist['asval'] = $this->Crud_modal->all_data_select('assignment_name','master_assignment',"maid IN ($ridays)",'maid asc');
	    	echo json_encode($aslist);

		}else{
			redirect(base_url().'admin','refresh');
		}
	}catch(Exception $e){
		echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	}
}

public function package_map(){
	try{
		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
			$data['title']="MondayMorning";
			$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);

			$data['u_types']=$this->Crud_modal->fetch_alls('user_type','user_type_id asc');

			$where = "status='1'";
	    	$data['package_lists'] = $this->Crud_modal->all_data_select('package_id,package_name','mm_packages',$where,'package_id asc');
		  	$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('package-map',$data);
			$this->load->view('admintempletes/footer');
		}else{
			redirect(base_url().'admin','refresh');
		}
	}catch(Exception $e){
		echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	}
}

public function package_mapped(){
	try{
		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
			$usertype_id=$this->input->post('user_type_id');
			$packages_id=$this->input->post('selpackage');

			$p_val = $this->Crud_modal->check_numrow('package_map',"usertype_id='$usertype_id'");
			if($p_val==1){

				$update_data['packages_id']=implode(',', $packages_id);
				$this->Crud_modal->update_data("usertype_id='$usertype_id'",'package_map',$update_data);

			}else{
				$insertdata['packages_id']=implode(',', $packages_id);
				$insertdata['usertype_id']=$usertype_id;
				$this->Crud_modal->data_insert('package_map',$insertdata);
			}
			$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Package Mapped</div>');
			redirect(base_url().'map-package','refresh');
		}else{
			redirect(base_url().'admin','refresh');
		}
	}catch(Exception $e){
		echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	}
}

public function package_load(){
	try{
		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
			$user_type_id = $this->input->post('user_type_id');
			if($user_type_id!=''){
				$pack_ids=$this->Crud_modal->fetch_single_data('packages_id','package_map',"usertype_id='$user_type_id'");
				if($pack_ids['packages_id']!=''){
					$packids = $pack_ids['packages_id'];
					$pakglist['pack_ids'] = $this->Crud_modal->all_data_select('package_id,package_name','mm_packages',"package_id IN ($packids)",'package_id asc');
					$pakglist['all_pack_ids'] = $this->Crud_modal->all_data_select('package_id,package_name','mm_packages',"package_id Not IN ($packids)",'package_id asc');
					if($pakglist['all_pack_ids']==null){
						$pakglist['all_pack_ids'] = '';
					}
					echo json_encode($pakglist);
				}else{
					$pakglist['pack_ids']='';
					$pakglist['all_pack_ids'] = $this->Crud_modal->fetch_alls('mm_packages','package_id asc');
					echo json_encode($pakglist);
				}
			}else{
				$pakglist['pack_ids']='';
				$pakglist['all_pack_ids'] = $this->Crud_modal->fetch_alls('mm_packages','package_id asc');
				echo json_encode($pakglist);
			}
		}else{
			redirect(base_url().'admin','refresh');
		}
	}catch(Exception $e){
		echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	}
}

public function edit_package_page(){
	try{
		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
			$data['title']="MondayMorning";
			$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);


			$pkgval = $this->session->flashdata('package_id');

			if($this->input->post('package_name')!='' || $pkgval!=''){
     			if($pkgval!=''){
     				$pack_name=$pkgval;
     			}else{
					$pack_name = $this->input->post('package_name');
     			}
				$where = "status!='0' AND package_id=$pack_name";
	    		$data['package_data']= $this->Crud_modal->fetch_single_data('*','mm_packages',$where);
			}
			$where1 = "status!='0'";
    		$data['package_lists']= $packagesdata= $this->Crud_modal->all_data_select('package_id,package_name,ma_id','mm_packages',$where1,'package_id asc');
    		foreach ($packagesdata as $packagedata) {
	    		$allmaids[] = $packagedata['ma_id'];
    		}
	    	$allmaid= implode(',', $allmaids);
    		$data['all_mapped_assignment_data']= $this->Crud_modal->all_data_select('maid,assignment_name','master_assignment',"maid NOT IN($allmaid) AND status=1",'maid asc');
		  	$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('edit-package',$data);
			$this->load->view('admintempletes/footer');
		}else{
			redirect(base_url().'admin','refresh');
		}
	}catch(Exception $e){
		echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	}
}

public function update_package(){
	try {
		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
			$package_id=$this->input->post('package_name');
			$update_data['validity']=$this->input->post('validity');
			$update_data['description']=$this->input->post('description');
			$update_data['total_marks']=$this->input->post('total_marks');
			$update_data['status']=$this->input->post('pkg_status');
			$update_data['modified_date']=date('Y-m-d H:i:s');

			if($this->input->post('maid')!=''){

				$update_data['ma_id']=implode(',', $this->input->post('maid'));

				$prec=$this->input->post('previous_image');
		    	if($_FILES["image"]['name']!='')
		    	{
					$config['upload_path']          = './upload/package/';
					$config['allowed_types']        = 'gif|jpg|png';
					$new_name = time().$_FILES["image"]['name'];
					$config['file_name'] = $new_name;

					$this->load->library('upload', $config);
					if ($this->upload->do_upload('image'))
					{
						$file=$this->upload->data();
						$update_data['image'] =$file['file_name'];
						
						unlink('./upload/package/'.$prec);
					}

				}


				$this->Crud_modal->update_data("package_id=$package_id",'mm_packages',$update_data);
				$this->session->set_flashdata('package_id',$package_id);
				$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Package Updated</div>');

				redirect(base_url().'edit-package','refresh');
			}else{

				$this->session->set_flashdata('package_id',$package_id);
				$this->session->set_flashdata('data_message','<div class="danger"><strong>Error!</strong> Assignment Not Selected</div>');

				redirect(base_url().'edit-package','refresh');
			}


		}else{
			redirect(base_url().'admin','refresh');
		}
		
	} catch (Exception $e) {
		echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	}
}
public function university(){
	try{
		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
			$data['title']="MondayMorning";
			$data['university1']=$this->Crud_modal->all_data_select('un_name,mu_id','master_university','un_status=1','un_name asc');
			$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);
		  	$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('university',$data);
			$this->load->view('admintempletes/footer');
		}else{
			redirect(base_url().'admin','refresh');
		}
	}catch(Exception $e){
		echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	}
}

public function add_university(){
	try{
		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
			$data['title']="MondayMorning";
			$university=$this->input->post('university');
			$data= array(
			'un_name' => $university,
			);
			if($this->Crud_modal->data_insert('master_university',$data)){
			$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> university added</div>');

			redirect(base_url().'university','refresh');
			}
			else{
				$this->session->set_flashdata('data_message','<div class="success"><strong>not</strong> Updated</div>');

			redirect(base_url().'university','refresh');

			}
			
		}else{
			redirect(base_url().'admin','refresh');
		}
	}catch(Exception $e){
		echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	}
}
public function update_university(){
	try{
		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
			
			$university=$this->input->post('university');
			$universityid=$this->input->post('universityid');
			$data['un_name']=$university;
			if($this->Crud_modal->update_data("mu_id='$universityid'",'master_university',$data)){
			$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> university Updated</div>');

			redirect(base_url().'university','refresh');
			}
			else{
				$this->session->set_flashdata('data_message','<div class="success"><strong>not</strong> Updated</div>');

			redirect(base_url().'university','refresh');

			}
			
		}else{
			redirect(base_url().'admin','refresh');
		}
	}catch(Exception $e){
		echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	}
}
public function board(){
	try{
		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
			$data['board']=$this->Crud_modal->all_data_select('board_name,bid','master_board','bo_status=1','board_name asc');
			$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);
		  	$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('board',$data);
			$this->load->view('admintempletes/footer');
		}else{
			redirect(base_url().'admin','refresh');
		}
	}catch(Exception $e){
		echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	}
}
public function add_board(){
	try{
		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
			$data['title']="MondayMorning";
			$board=$this->input->post('board');
			$data= array(
			'board_name' => $board,
			);
			if($this->Crud_modal->data_insert('master_board',$data)){
			$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> board added</div>');

			redirect(base_url().'board','refresh');
			}
			else{
				$this->session->set_flashdata('data_message','<div class="success"><strong>not</strong> Updated</div>');

			redirect(base_url().'board','refresh');

			}
			
		}else{
			redirect(base_url().'admin','refresh');
		}
	}catch(Exception $e){
		echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	}
}
public function update_board(){
	try{
		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
			
			$board=$this->input->post('board');
			$boardid=$this->input->post('boardid');
			$data['board_name']=$board;
			if($this->Crud_modal->update_data("bid='$boardid'",'master_board',$data)){
			$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Board Updated</div>');

			redirect(base_url().'board','refresh');
			}
			else{
				$this->session->set_flashdata('data_message','<div class="success"><strong>not</strong> Updated</div>');

			redirect(base_url().'board','refresh');

			}
			
		}else{
			redirect(base_url().'admin','refresh');
		}
	}catch(Exception $e){
		echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	}
}
public function country(){
	try{
		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
			$data['country']=$this->Crud_modal->fetch_alls('countries','name asc');
			$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);
		  	$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('country',$data);
			$this->load->view('admintempletes/footer');
		}else{
			redirect(base_url().'admin','refresh');
		}
	}catch(Exception $e){
		echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	}
}
public function delete_country()
{
	 $id=$this->uri->segment(2); 
	 $val = base64_decode(str_pad(strtr($id, '-_', '+/'), strlen($id) % 4, '=', STR_PAD_RIGHT));
		     	$update_data = array(
		        'status' => '0'
		        
			);
			$where = "cid = '$val'";
	 $result=$this->Crud_modal->update_data($where,'countries',$update_data);
	 if($result)
	 {
	 	$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Country deleted</div>');
	 	redirect('country','refresh');
	 }

}
public function add_country(){
	try{
		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
			$data['title']="MondayMorning";
			$country=$this->input->post('country');
			$data= array(
			'name' => $country,
			);
			if($this->Crud_modal->data_insert('countries',$data)){
			$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> country added</div>');

			redirect(base_url().'country','refresh');
			}
			else{
				$this->session->set_flashdata('data_message','<div class="success"><strong>not</strong> Updated</div>');

			redirect(base_url().'country','refresh');

			}
			
		}else{
			redirect(base_url().'admin','refresh');
		}
	}catch(Exception $e){
		echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	}
}
public function update_country(){
	try{
		if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null){
			
			$country=$this->input->post('country');
			$countryid=$this->input->post('countryid');
			$data['name']=$country;
			if($this->Crud_modal->update_data("cid='$countryid'",'countries',$data)){
			$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> countries Updated</div>');

			redirect(base_url().'country','refresh');
			}
			else{
				$this->session->set_flashdata('data_message','<div class="success"><strong>not</strong> Updated</div>');

			redirect(base_url().'country','refresh');

			}
			
		}else{
			redirect(base_url().'admin','refresh');
		}
	}catch(Exception $e){
		echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	}
}
public function csvfile(){
	 	$count=0;
        $fp = fopen($_FILES['userfile']['tmp_name'],'r') or die("can't open file");
        $files = $_FILES['userfile']['name'];
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
	                $insert_csv['university'] = trim($csv_line[0]);
	            }
	            $i++;
	            $data = array(
	                'un_name' => $insert_csv['university']
	        	        	);

	        	$this->Crud_modal->data_insert('master_university', $data);

			}
			$this->session->set_flashdata('mcq_message','<div class="success"><strong>Success!</strong> Data Uploaded.</div>');
			redirect(base_url().'university');
		}else{
			$this->session->set_flashdata('mcq_message','<div class="success"><strong>Failed!</strong> Upload Only .CSV File</div>');
			redirect(base_url().'university');
		}
	 }

public function registered_verify(){  
        if($this->input->post('usertype')!="" || $this->input->post('email')!=""){
            $title = trim($this->input->post('usertype'));
            if($this->input->post('email')!=""){
                $title = trim($this->input->post('email'));
            }
        }
        else{
            $title = str_replace("%20",' ',($this->uri->segment(2))?$this->uri->segment(2):0);
        }

        $allrecord = $this->pgn->all_reg_user_data('mm_uid desc',$title);
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
        $baseurl =  base_url()."registered-verify/".$title;
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

       $data['datas'] = $this->pgn->all_reg_user_data_list($data['limit'],$data['offset'],$title);
       if($this->input->post('email')!=""){
            $data['datas'] = $this->pgn->all_reg_user_data_list_by_email($data['limit'],$data['offset'],$title);
        }else{

        }
       $data['user_type']=$this->Crud_modal->fetch_alls('user_type','user_type_id desc');
        
        $this->load->view('admintempletes/head',$data);
       $this->load->view('admintempletes/header',$data);    
       $this->load->view('admintempletes/sidebar',$data);
       $this->load->view('registered-verify-user',$data);
       $this->load->view('admintempletes/footer');
     
    }

   	public function assignment_done(){
   		try{
   			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     		$data['assign_user_data']=$this->Admindashboard_modal->all_completed_assignment_with_user();
		     }
   		}catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
   	}
	
	  
	   /*************************Display Employer Preview Data - Code By Khushboo Sahu***************************************/
	  public function employer_preview_data(){
		try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				$qurstr=$this->uri->segment(2); 
				$code= base64_decode(str_pad(strtr($qurstr, '-_', '+/'), strlen($qurstr) % 4, '=', STR_PAD_RIGHT));
			    $data['title']='Admin Dashboard for Monday Morning';
				$data['employer']=$this->Crud_modal->get_employer($code);
				$this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
				$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('employer-preview-form',$data);
				$this->load->view('admintempletes/footer');
			}
		}catch (Exception $e){
				echo 'Caught exception', $e->getMessage(),"\n";
		}
	}
 /*************************Display Employer List - Code By Khushboo Sahu***************************************/
	  public function employer_list(){
			  	try{
				     if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
						    $data['title']='Admin Dashboard for Monday Morning';
								$data['employers']=$this->Crud_modal->fetch_alls('mm_employer','employer_id asc');
								$data["industry_list"]=$this->Crud_modal->fetch_alls('mm_master_industry_topic', 'industry_name asc');
								$assign_id=$this->input->post('assignorder');
								$data['industry_selected']='0';
								$data['selected_industry_value']=$assign_id;
								if($this->input->post('assignorder')!=''){
									$data['employers'] = $this->Crud_modal->all_data_select('*','mm_employer',"employer_industry_id='$assign_id' ",'employer_id desc');
									$data['industry_selected']='0';
								}
								if($this->input->post('assignorder')=='*'){
									$data['employers']=$this->Crud_modal->fetch_alls('mm_employer','employer_id asc');
									//$data['employers'] = $this->Crud_modal->all_data_select('*','mm_employer'," eamil_auth_status='1' ",'employer_id desc');
									$data['industry_selected']='1';
								}

								$this->load->view('admintempletes/head',$data);
								$this->load->view('admintempletes/header',$data);	
							 	$this->load->view('admintempletes/sidebar',$data);
								$this->load->view('employer-list',$data);
								$this->load->view('admintempletes/footer');
								//$this->load->view('admintempletes/foot');
						 }else{
							redirect(base_url().'admin','refresh');
					     }
					}catch (Exception $e){
						echo 'Caught exception: ',  $e->getMessage(), "\n";
					}
	  }

public function get_idle_user(){
                  try{
                     if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
                         $userslist = $this->Crud_modal->fetch_alls('completed_assignment','cas_id');
                        foreach ($userslist as $userlist) {
                           $userslists[] = $userlist['uid'];
                       }
                       $allattemptusers = implode(',', $userslists);
                           $data['leaderboard_lists']=$this->Crud_modal->all_data_select('mm_user_full_name,mm_last_name,mm_user_email,reg_date','user',"mm_uid NOT IN($allattemptusers) AND eamil_auth_status=1",'mm_uid DESC');
                           echo sizeof($data['leaderboard_lists']);
                         }else{
                            redirect(base_url().'admin','refresh');
                         }
                    }catch (Exception $e){
                        echo 'Caught exception: ',  $e->getMessage(), "\n";
                    }
      }
public function get_idle_user_a_week(){
       if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
           $cal=date('Y-m-d H:i:s');
           $not_user_oneweek=$this->Crud_modal->all_data_select('uid','completed_level',"start_time BETWEEN DATE_SUB('$cal', INTERVAL 7 DAY) AND '$cal'",'cl_id asc');
           foreach ($not_user_oneweek as $nt_week) {
               $notuser_oneweek[] = $nt_week['uid'];
           }  
           $all_not_attempt_user=implode(',', $notuser_oneweek);
           if($all_not_attempt_user!=''){
              $data['ntleaderboard_lists']=$this->Crud_modal->all_data_select('mm_uid,mm_user_full_name,mm_last_name,mm_user_email,reg_date','user',"mm_uid NOT IN($all_not_attempt_user) and  mm_uid  IN(SELECT uid FROM completed_assignment) AND eamil_auth_status=1",'mm_uid DESC');
               echo sizeof($data['ntleaderboard_lists']);
           }else{
               echo '0';
           }
       }else{
           redirect(base_url().'admin','refresh');
       }
                 
    }
      public function completed_user(){
                  try{
                     if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
                     $assign=$this->Crud_modal->all_data_select('*','mm_packages',"status=1",'package_id ASC');
                       $assign_count=0;
                       for($p=0;$p<sizeof($assign);$p++){
                           $assign_count+=sizeof(explode(",",$assign[$p]['ma_id']));
                       }
                       
                       $leader_lists=$this->Crud_modal->all_data_select('mm_uid','user'," eamil_auth_status=1",'mm_uid DESC');
                       $user_count_completed=0;
                       for ($k=0; $k < sizeof($leader_lists); $k++) { 

                               $user_id=$leader_lists[$k]['mm_uid'];
                                   if($assign_count==$this->Crud_modal->check_numrow('completed_assignment',"status='1' and uid='$user_id' ")){
                                   $user_count_completed++;
                                   }
                       }
                       echo $user_count_completed;
                         }else{
                            redirect(base_url().'admin','refresh');
                         }
                    }catch (Exception $e){
                        echo 'Caught exception: ',  $e->getMessage(), "\n";
                    }
      }
      public function get_system_neuron(){
                  try{
                     if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
                         $data['system_neurons']=$this->Crud_modal->all_data_select('sum(neurons) as total_neurons','score',"1=1",'neurons desc');
                         //print_r($data['system_neurons']); die;
                       echo $data['system_neurons'][0]['total_neurons'];
                         }else{
                            redirect(base_url().'admin','refresh');
                         }
                    }catch (Exception $e){
                        echo 'Caught exception: ',  $e->getMessage(), "\n";
                    }
      }

public function get_consultant(){
                  try{
                     if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
                        $data['user']=$this->Crud_modal->fetch_alls('user','mm_uid desc');
                        $where1 = "user_type_id = '1'";
                        $data['student']=$this->Crud_modal->check_numrow('user',$where1);
                        echo (sizeof($data['user'])-$data['student']);
                         }else{
                            redirect(base_url().'admin','refresh');
                         }
                    }catch (Exception $e){
                        echo 'Caught exception: ',  $e->getMessage(), "\n";
                    }
      }
      public function get_student(){
                  try{
                     if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
                        $where1 = "user_type_id = '1'";
                        $data['student']=$this->Crud_modal->check_numrow('user',$where1);
                        echo $data['student'];
                         }else{
                            redirect(base_url().'admin','refresh');
                         }
                    }catch (Exception $e){
                        echo 'Caught exception: ',  $e->getMessage(), "\n";
                    }
      }
       public function get_not_verified_user(){
                  try{
                     if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
                        $where4 = "eamil_auth_status = '0'";
                        $data['ntverified']=$this->Crud_modal->check_numrow('user',$where4);
                        echo $data['ntverified'];
                         }else{
                            redirect(base_url().'admin','refresh');
                         }
                    }catch (Exception $e){
                        echo 'Caught exception: ',  $e->getMessage(), "\n";
                    }
      }
       public function get_verified_user(){
                  try{
                     if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
                        $where3 = "eamil_auth_status = '1'";
                        $data['verified']=$this->Crud_modal->check_numrow('user',$where3);
                        echo $data['verified'];
                         }else{
                            redirect(base_url().'admin','refresh');
                         }
                    }catch (Exception $e){
                        echo 'Caught exception: ',  $e->getMessage(), "\n";
                    }
      }
       public function get_user(){
                  try{
                     if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
                        $data['user']=$this->Crud_modal->fetch_alls('user','mm_uid desc');
                        echo sizeof($data['user']);
                         }else{
                            redirect(base_url().'admin','refresh');
                         }
                    }catch (Exception $e){
                        echo 'Caught exception: ',  $e->getMessage(), "\n";
                    }
      }
public function ticket_trash()
{
          try
            {
                   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
             {
                    $data['title']='Admin Dashboard for Monday Morning';
                       $fields='*';
                       $tbl_name='mm_ticket';
                       $where='delete_status = 0';
                       $orderby = 'ticket_id DESC';
                        $data['lists'] = $this->Crud_modal->all_data_select($fields,$tbl_name,$where,$orderby);
                        $this->load->view('admintempletes/head',$data);
                        $this->load->view('admintempletes/header',$data);    
                         $this->load->view('admintempletes/sidebar',$data);
                        $this->load->view('ticket-trash',$data);
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
public function index_score()
   {  
       if($this->input->post('title') !="")
       {
           $title = trim($this->input->post('title'));
       }
       else{
           $title = str_replace("%20",' ',($this->uri->segment(2))?$this->uri->segment(2):0);
       }
       $allrecord = $this->pgn->score_data('score_id desc',$title);
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
       
       $paging=array();
       //$paging['base_url'] =$baseurl;
       $paging['base_url'] =base_url().'view-new-scores/'.$title;
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
       
       $config['page_query_string'] = TRUE;
       $config['enable_query_strings'] = TRUE;
       $config['query_string_segment'] = base_url().'view-new-scores';
       $this->pagination->initialize($paging);    
       
       $data['limit'] = $paging['per_page'];
       $data['number_page'] = $paging['per_page'];
      $data['offset'] = ($this->uri->segment(3)) ? $this->uri->segment(3):'0';
       $data['nav'] = $this->pagination->create_links();
      if($this->input->post('title') !=""){
           $findme   = '@';
            $pos = strpos($title, $findme);
            if ($pos === false) {
              $data['nav'] = $this->pagination->create_links();
            } else {
              $data['nav'] = '';
            }
         
       }    
      $data['datas'] = $this->pgn->score_data_list($data['limit'],$data['offset'],$title);
      $this->load->view('admintempletes/head',$data);
      $this->load->view('admintempletes/header',$data);    
      $this->load->view('admintempletes/sidebar',$data);
      $this->load->view('view-new-scores',$data);
      $this->load->view('admintempletes/footer');
   
   }
   
	public function get_assign_level(){
        $topicid=$this->input->post('topicid');
        $wherelvl = "maid = '$topicid' AND ml_status = '1'";
		$data=$this->Crud_modal->all_data_select('*','master_level',$wherelvl,'ml_id asc');
		echo '<option value="">Select Level</option>';
        for($i=0;$i<sizeof($data);$i++){
            echo '<option value="'.$data[$i]["ml_id"].'">'.$data[$i]["lvl_name"].'</option>';                                                    
        }
    }
	 public function index_level_score()
	{   
		$assignorder = $this->input->post('assignorder');
     	$levelorder = $this->input->post('levelorder');
     	
	    if($this->input->post('assignorder') !="")
		{
	        $title = trim($this->input->post('assignorder'));
	        if($this->input->post('levelorder')!=""){
	        	$title1 = trim($this->input->post('levelorder'));
	        }
		}
		else{
			$title = str_replace("%20",' ',($this->uri->segment(2))?$this->uri->segment(2):0);
		} 
		$all=$this->input->post('get_all');
		$noOfrecords=10;
		
		if($all==1){
			$noOfrecords='';
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
		}
		$data['search_title']=$title;	
		
	    $allrecord = $this->pgn->level_score_data('cl_id desc',$title);
	    if($this->input->post('assignorder')!=""){
	    	 $allrecord = $this->pgn->level_score_data('cl_id desc',$assignorder);
	    }
 		if($this->input->post('levelorder')!=""){
			$data['search_title']=$title;
	        $data['search_title1']=$title1;
	    }
		$route['level-new-scores']=base_url().'level-new-scores/'.$title;
		$paging=array();
		//$paging['base_url'] =$baseurl;
		$paging['base_url'] =$route['level-new-scores'];
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
       
        //$data['datas'] = $this->pgn->level_score_data_list($data['limit'],$data['offset'],$title);
		$data['nav'] = $this->pagination->create_links();
		
       	if($assignorder != '' || $title != '' && $title>0){
       			$whereass = "c.maid = '$title' AND c.status = '1'";
 				$wherelvl = "maid = '$title' AND ml_status = '1'";
				//$data['scores_lists']=$this->Crud_modal->all_data_select('*','completed_level',$whereass,'cl_id desc');
				$data['datas'] = $this->pgn->level_score_list_by_assignment($data['limit'],$data['offset'],$whereass);
				$data['lvlists']=$this->Crud_modal->all_data_select('*','master_level',$wherelvl,'ml_id asc');
				$data['asid'] = $title;
				if($levelorder!=''){
	 				$wherelvlval = "c.maid = '$title' AND c.level_id = '$title1' AND c.status = '1'";
					//$data['scores_lists']=$this->Crud_modal->all_data_select('*','completed_level',$wherelvlval,'cl_id desc');
					$data['datas'] = $this->pgn->level_score_list_by_assignment('',$data['offset'],$wherelvlval);
					$data['lvlid'] = $levelorder;
					$data['nav']='';
				}
		}elseif($title == ''){
			$whereass = "c.maid = '$title' AND c.status = '1'";
 				$wherelvl = "maid = '$title' AND ml_status = '1'";
				//$data['scores_lists']=$this->Crud_modal->all_data_select('*','completed_level',$whereass,'cl_id desc');
				$data['datas'] = $this->pgn->level_score_list_by_assignment($data['limit'],$data['offset'],$whereass);
				$data['lvlists']=$this->Crud_modal->all_data_select('*','master_level',$wherelvl,'ml_id asc');
				$data['asid'] = $title;
				if($levelorder!=''){
	 				$wherelvlval = "c.maid = '$title' AND c.level_id = '$title1' AND c.status = '1'";
					//$data['scores_lists']=$this->Crud_modal->all_data_select('*','completed_level',$wherelvlval,'cl_id desc');
					$data['datas'] = $this->pgn->level_score_list_by_assignment('',$data['offset'],$wherelvlval);
					$data['lvlid'] = $levelorder;
					$data['nav']='';
				}
		}
		 else{
				 $data['datas'] = $this->pgn->level_score_data_list($data['limit'],$data['offset'],$title);
		 }
		
		    $data['alists'] = $this->Admindashboard_modal->total_assign_list('1','asc');

		$this->load->view('admintempletes/head',$data);
        $this->load->view('admintempletes/header',$data);    
        $this->load->view('admintempletes/sidebar',$data);
        $this->load->view('level-new-scores',$data);
        $this->load->view('admintempletes/footer');
        
	}
	public function neurons_lac(){
        $sum=0;
        $data_neurons=$this->Crud_modal->all_data_select('*','score',"1=1",'score_id asc');
        for ($i=0; $i <sizeof($data_neurons) ; $i++) {
            $sum+=$data_neurons[$i]['neurons'];
            // if($i==0){
                // $start_date=$data_neurons[$i]['created_date'];
            // }
            if($sum>=300000){
                echo $end_date=$data_neurons[$i]['created_date'];
				exit;
              
            }
            // if($sum>=500000){
                // $second_end_date=$data_neurons[$i]['created_date'];
                
            // }
        }
         // echo $end_date;
        // echo "<br>";
         // //echo $start_date;
         // echo "<br>";
         // echo $second_end_date;

    }
}