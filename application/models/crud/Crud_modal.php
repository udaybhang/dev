<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Crud_modal extends CI_model
{
 function __construct()
      {
            $this->load->database();
            $this->load->library('session');
            $this->load->library('email');
      }

 function admin_login()
      {
        try
	          {
	          	$this->db->initialize();													
				$username=$this->input->post('username');
				$password= $this->input->post('password');
				$this->db->select('*');
				$this->db->from('users');
				$this->db->where(array('user_name'=>$username,'user_password'=>md5($password),'user_status'=>'1'));
				$this->db->last_query();
				$query = $this->db->get();
																			// $this->db->last_query();
															if($query->num_rows() == 1)
																{
																			$result=$query->row_array();
																			$this->db->close();	
																			$uid=$result['uid'];
																			$login_user_data = array('username'=>$username,'userid'=>$uid);
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
 function upd_current_login_status()
      {
        try
	          {
	          	$this->db->initialize();
               $uid=$this->session->userdata('UID');
               $fields=array('log_status'=>0,'logout_time'=>date('Y-m-d H:i:s'),'IP_address'=>$_SERVER['REMOTE_ADDR']);
               $this->db->where('UID',$uid);
               $update= $this->db->update('login_status',$fields);
               $this->db->close();	
               return $update;
           }
       catch(Exception $e)
          {
              echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
          }
        
      }
 function check_email_ajax()
      {
         try
	        {
	        	$this->db->initialize();
               $email=$this->input->post('Email');
               $this->db->select('*');
               $this->db->from('users');
               $this->db->where(array('user_email'=>$email));
               $query = $this->db->get();
													//	echo $this->db->last_query();
            if($query->num_rows() == 1)
             {
														  		$result=		$query->row_array();
														  		$this->db->close();	
										        	return $result;
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
						 function check_email_ajax_mem()
      {
         try
	        {
	           $this->db->initialize();
               $email=$this->input->post('Email');
               $this->db->select('*');
               $this->db->from('users');
               $this->db->where(array('user_email'=>$email));
               $query = $this->db->get();
											//			echo $this->db->last_query();
            if($query->num_rows() == 1)
             {
             	$this->db->close();	
														  	return 1;
             
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
						function check_email_ajax_is_mem()
      {
         try
	        {
               $email=$this->input->post('Email');
               $this->db->initialize();
               $this->db->select('*');
               $this->db->from('users');
               $this->db->where(array('user_email'=>$email,'type'=>'member','role'=>450));
               $query = $this->db->get();
											//			echo $this->db->last_query();
            if($query->num_rows() == 1)
             {
             	$this->db->close();	
														  	return 1;
             
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
				  function delete_status_change($where,$tblname,$field)
						{
						   	try
					       {
					       	$this->db->initialize();
							$this->db->where($where);
                            $update=  $this->db->update($tblname,$field);
                            $this->db->close();	
													// $this->db->last_query();
														return $update;
					      	}
						
				   		catch(Exception $e)
          {
              echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
          }
     }
						function data_delete()
						{
							    try
					    {
					    	$this->db->initialize();
										foreach ($_POST  as $key => $value)
																{
																	  $data[]= str_replace('delete=Delete','',$key.'='.$value);
																}
															 
																$str=explode('=',$data[0]);
															 $this->db->where($str[0], $str[2]);
                $del=  $this->db->delete($str[1]);
																			if($del==1)
																			{
																				$this->db->close();	
																				  return 1;
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
						function fetch_update_data($where,$tblname)
						{
							 
									 try
					       {
					       	                                $this->db->initialize();
															$this->db->select('*');
															$this->db->from($tblname);
															$this->db->where($where);
													 	$query = $this->db->get();
															 
															$result=		$query->row_array();
															$this->db->close();	
										//	echo 	 $this->db->last_query();
															return $result;
					      	}
						
				   		catch(Exception $e)
          {
              echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
          }
						}
						function update_data($where,$tblname,$field)
						{
							 try
					       {
					       	$this->db->initialize();
													 $this->db->where($where);
													 	
              $update=  $this->db->update($tblname,$field);
             // echo 	 $this->db->last_query();
													//	exit;
              $this->db->close();	
														return $update;
					      	}
						
				   		catch(Exception $e)
          {
              echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
          }
						}
						
				public function all_data_select($fields,$tbl_name,$where,$orderby)
						{
							try
					    {
					    	                 $this->db->initialize();
											$this->db->select($fields);
											$this->db->from($tbl_name);
											$this->db->where($where);
											$query = $this->db->order_by($orderby);
											$query = $this->db->get();
											$result=		$query->result_array();
											$this->db->close();	
											return $result;
					   	}
						
						catch(Exception $e)
          {
              echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
          }
						}
						function data_insert($bl_name,$field)
						{
							  try
									{
											$this->db->initialize();
											$insert=		$this->db->insert($bl_name,$field);

											if($insert==1)
											{
											$this->db->close();	
											return 1;
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

						// Sohrab 13-05-2017

							function user_data_insert1($bl_name,$field)
						{
							  try
									{
										        $this->db->initialize();
										        $insert=		$this->db->insert($bl_name,$field);
										        $uid['uid'] = $this->db->insert_id();
										        $this->db->insert('user_data',$uid);
																	
																		if($insert==1)
																			{
																				 $this->db->close();	
																				  return $uid['uid'];
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

						function fetchdata_with_limit($fields,$tbl_name,$where,$orderby,$limit){
							try
					    {
					    	                $this->db->initialize();
											$this->db->select($fields);
											$this->db->from($tbl_name);
								   			$this->db->where($where);
											$query = $this->db->order_by($orderby);
											$query = $this->db->limit($limit);
											$query = $this->db->get();
											$result=		$query->result_array();
											$this->db->close();	
											return $result;
					   	}
						
						catch(Exception $e)
          {
              echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
          }
						}

			public function fetch_single_data($fields,$tbl_name,$where){
				$this->db->initialize();
				$this->db->select($fields);
				$this->db->from($tbl_name);
	   			$this->db->where($where);
				$query = $this->db->get();
				$result=$query->row_array();
				$this->db->close();	
				return $result;
			}
						// Sohrab
				
				
					function fetch_all($tblname,$orderby)
						{
							 
									 try
					       {
					       	                                $this->db->initialize();
															$this->db->select('*');
															$this->db->from($tblname);
															 $query = $this->db->order_by($orderby);
															$query = $this->db->get();
															
															$result=		$query->row_array();
															$this->db->close();	
										//	echo 	 $this->db->last_query();
															return $result;
					      	}
						
				   		catch(Exception $e)
          {
              echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
          }
						}
  function fetch_alls($tblname,$orderby)
						{
							 try
									{
										    $this->db->initialize();
											$this->db->select('*');
											$this->db->from($tblname);
								  	        $query = $this->db->order_by($orderby);
											$query = $this->db->get();
											$result=$query->result_array();
											$this->db->close();	
											return $result;
					   	}
						
				   		catch(Exception $e)
          {
              echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
          }
						}
  function select_max_val($id,$tblname,$where)
						{
							 try
									{
										                    $this->db->initialize();
															$this->db->select_max($id);
																$this->db->from($tblname);
															$this->db->where($where);
													 	$query = $this->db->get();
														//	echo 	 $this->db->last_query();
															$result=$query->row_array();
															$this->db->close();	
															return $result;
					   	}
						
				   		catch(Exception $e)
          {
              echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
          }
						}
												function all_assignment_fora_user($uid)
						{
							                                $this->db->initialize();
															$this->db->select('*');
															$this->db->from('completed_assignment as ca');
															$this->db->where('ca.uid', $uid);
															$this->db->where('ma.status',1);
															$this->db->join('master_assignment as ma', 'ma.maid = ca.maid', 'left');
															$query = $this->db->get();
															$result=$query->result_array();
															$this->db->close();	
															return $result;
						}
								function all_lvl_fora_user($uid,$maid)
						{
							                                $this->db->initialize();
															$this->db->select('*');
															$this->db->from('completed_level as cl');
															$this->db->where('cl.uid', $uid);
															$this->db->where('cl.maid', $maid);
															$this->db->where('cl.status', 1);
															$this->db->join('master_level as ml', 'ml.ml_id = cl.level_id', 'left');
															$query = $this->db->get();
															$result=$query->result_array();
															$this->db->close();	
															return $result;
						}
						
									function all_score_fora_user($uid,$maid,$pid,$lvlid)
						{
							                                $this->db->initialize();
															$this->db->select('*');
															$this->db->from('score as s');
															$this->db->where('s.u_id', $uid);
															$this->db->where('s.maid', $maid);
																$this->db->where('s.level_id', $lvlid);
																	$this->db->where('s.p_id',$pid);
														
															$query = $this->db->get();
											//				echo 	 $this->db->last_query();
															$result=		$query->row_array();
															$this->db->close();	
															return $result;
						}

						public function check_numrow($tblname,$where){
							$this->db->initialize();
							$query=$this->db->select('*')->from($tblname)->where($where)->get();
							

							return $query->num_rows();
							$this->db->close();	
						}
						
						
function user_last_login_time()

						  {

						    try

						    {
                              $this->db->initialize();
						      $userid = $this->session->userdata('mm_uid');

						      $this->db->select('login_time');

						      $this->db->from('user_login_status');

						      $this->db->where('uid', $userid);

						      $this->db->order_by('login_time', 'desc');

						      $this->db->limit(1, 1);

						      $query = $this->db->get();

						      return $query->result();
						      $this->db->close();	

						    }



						    catch(Exception $e)

						    {

						      echo 'Caught exception', $this->$e->getMessage() , "/n";

						    }

						  }
public function get_neurons($uid)
	{
			$this->db->initialize();
			$this->db->select('neurons');
			$this->db->from('neurons');
			$this->db->where('u_id',$uid);
			$query =$this->db->get();
			return $query->row_array();
			$this->db->close();	
	}
	public function get_rank(){
	    $this->db->initialize();			
		$this->db->select('u_id');
		$this->db->from('neurons n');
		$this->db->join("user u","u.mm_uid=n.u_id","left");
		$this->db->where('u.user_type_id',2);
		$this->db->order_by('neurons Desc');
		$query =$this->db->get();
		return $query->result_array();
		$this->db->close();	
	}
public function wallet_total_balance($id)
	{
		$this->db->initialize();
		$this->db->select("total");
		$this->db->from("mm_wallet");
		$this->db->where("user_id",$id);
		$this->db->order_by("wallet_id desc");
		$query=$this->db->get();
		return $query->row_array();
		$this->db->close();	
	}

	  public function chat_data($id)
    {
    try
    {
       $this->db->initialize();
      $this->db->select('admin_message');
      $this->db->from('chat');
      $this->db->where($id);
       $this->db->where("admin_message!='' AND read_status='0'");
      $query= $this->db->get();
      return $query->num_rows();
      $this->db->close();	
    }
     catch(Exception $e)
    {
       echo 'Caught exception: ', $this->$e->getMessage() , "\n";
    }
  }

 public function get_assignment_name($id)
    {
    try
    {
      $this->db->initialize();
      $this->db->select('assignment_name');
      $this->db->from('master_assignment');
      $this->db->where('maid',$id);
      $query= $this->db->get();
      return $query->row('assignment_name');
      $this->db->close();	
    }
     catch(Exception $e)
    {
       echo 'Caught exception: ', $this->$e->getMessage() , "\n";
    }
  }
//*Check IsExists Employer-Khushboo Sahu*/
  function check_employer_email($emp_email)
  {
         try
	        {
               $email=$emp_email;
               $this->db->initialize();
               $this->db->select('*');
               $this->db->from('mm_employer');
               $this->db->where(array('employer_email'=>$email));
               $query = $this->db->get();
											//			echo $this->db->last_query();
            if($query->num_rows() == 1)
             {
                $this->db->close();	
             	return 1;
             
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
    public function employer_exists_delete($email)
	{
		$this->db->initialize();
		$this->db->select('employer_id');
		$this->db->from('mm_employer');
		$this->db->where('employer_email',$email);
		$this->db->where('eamil_auth_status',0);
		$query=$this->db->get();
		$result=$query->row_array();
		$this->db->close();	
		return $result;
		
	} 
	public function delete_employer_not_verified($uid)
	{
		$this->db->initialize();
		$this->db->where('employer_id',$uid);
		$this->db->delete('mm_employer');
		$this->db->close();	
		return true;
	}
	/**Code By Khushboo Sahu**/
 	public function get_employer($uid){
 		$this->db->initialize();
          $this->db->select("emp.*, industry.industry_id, industry.industry_name");
          $this->db->from('mm_employer as emp');
          $this->db->join('mm_master_industry_topic as industry','emp.employer_industry_id=industry.industry_id','inner');
          $this->db->where('emp.employer_id',$uid);
          $query = $this->db->get();
          $result=$query->row_array();
          $this->db->close();	
          return $result;
         
     }
public function delete_row($id)
    {
    try
    {
    	// echo $id; die;
    	$this->db->initialize();
      $this ->db-> where('work_exe_id', $id);
      if($this ->db-> delete('work_experience')){
      	$this->db->close();	
      	return true;
      }else{
      	$this->db->close();	
      	return false;
      }
    }
     catch(Exception $e)
    {
       echo 'Caught exception: ', $this->$e->getMessage() , "\n";
    }
  }
public function get_role_name($id){
   try
   {
   	 $this->db->initialize();
     $this->db->select('role_name');
     $this->db->from('master_role');
     $this->db->where('role_id',$id);
     $query= $this->db->get();
     return $query->row('role_name');
     $this->db->close();	
	 
   }
    catch(Exception $e)
   {
      echo 'Caught exception: ', $this->$e->getMessage() , "\n";
   }
 }

 function delete_data($where,$tblname){	
    $this->db->initialize();			
	$this->db->where($where);
	$delete=  $this->db->delete($tblname);	
	$this->db->close();				
	return $delete;
}	
 function insert_batch($table,$data){
 	$this->db->initialize();
	return $this->db->insert_batch($table,$data);
	$this->db->close();	
 }
 function fetch_data_by_one_table_join($field,$table_name,$join1,$where){
 	$this->db->initialize();
	$result = $this->db->select($field)
			->from($table_name)
			->join($join1[0],$join1[1],$join1[2])
			->where($where)
			->get()
			->result_array();	
			$this->db->close();	
			return $result;
}
  function fetch_data_by_two_table_join($field,$table_name,$join1,$join2,$where){
  	$this->db->initialize();
	$result =  $this->db->select($field)
			->from($table_name)
			->join($join1[0],$join1[1],$join1[2])
			->join($join2[0],$join2[1],$join2[2])
			->where($where)
			->get()
			->result_array();
			$this->db->close();	
			return $result;
}
 function fetch_data_by_three_table_join($field,$table_name,$join1,$join2,$join3,$where){
 	$this->db->initialize();
	   $result = $this->db->select($field)
			->from($table_name)
			->join($join1[0],$join1[1],$join1[2])
			->join($join2[0],$join2[1],$join2[2])
			->join($join3[0],$join3[1],$join3[2])
			->where($where)
			->get()
			->result_array();
			  $this->db->close();
			return $result;	
}
    public function fetch_all_data($fields,$tbl_name,$where){
    	                        $this->db->initialize();
                                $this->db->select($fields);
                                $this->db->from($tbl_name);
                                   $this->db->where($where);
                                $query = $this->db->get();
                                $result=$query->result_array();
                                $this->db->close();
                                return $result;
                        }
function fetch_data_by_one_table_join_with_order_limit($field,$table_name,$join1,$where,$order,$limit){
	$this->db->initialize();
     $result = $this->db->select($field)
            ->from($table_name)
            ->join($join1[0],$join1[1],$join1[2])
            ->where($where)
            ->order_by($order)
            ->limit($limit)
            ->get()
            ->result_array();  
            $this->db->close();
            return $result;  
}
function fetchdata_with_limit_and_having($select,$table_name,$where,$group,$having,$order,$limit){
	$this->db->initialize();
	$result =  $this->db->select($select)
			->from($table_name)
			->where($where)
			->group_by($group)
			->having($having)
			->order_by($order)
			->limit($limit)
			->get()
			->result_array();
			$this->db->close();
      return $result;
}
function fetchdata_with_stat_and_end_limit($fields,$tbl_name,$where,$orderby,$limit){
            $this->db->initialize();						
			$this->db->select($fields);
			$this->db->from($tbl_name);
   			$this->db->where($where);
			$this->db->order_by($orderby);
			$this->db->limit($limit[1],$limit[0]);   // start and limit
			$query = $this->db->get();
			$result=$query->result_array();
			$this->db->close();
			return $result;
		}
	
	
		function fetch_data_by_four_table_join_with_limit($field,$table_name,$join1,$join2,$join3,$join4,$where,$limit,$order){
		return $this->db->select($field)
		->from($table_name)
		->join($join1[0],$join1[1],$join1[2])
		->join($join2[0],$join2[1],$join2[2])
		->join($join3[0],$join3[1],$join3[2])
		->join($join4[0],$join4[1],$join4[2])
		->where($where)
		->order_by($order)
		->limit($limit)
		->get()
		->result_array();	
		}
		 function fetch_data_by_four_table_join($field,$table_name,$join1,$join2,$join3,$join4,$where){
	return $this->db->select($field)
			->from($table_name)
			->join($join1[0],$join1[1],$join1[2])
			->join($join2[0],$join2[1],$join2[2])
			->join($join3[0],$join3[1],$join3[2])
			->join($join4[0],$join4[1],$join4[2])
			->where($where)
			->get()
			->result_array();	 
}
function data_insert_returnid($tbl_name,$field){
	    $this->db->initialize();
           	$this->db->insert($tbl_name,$field);
           	$id = $this->db->insert_id();
           	$this->db->close();
           	return $id;	
           	
	}
	public function employeeList()
	{
		$query =$this->db->select(['mm_uid','user_type_id','mm_user_full_name', 'mm_last_name','mm_user_email','mm_age','mm_higest_qualification','user_status','mm_auth_key','reg_date','user_password','eamil_auth_status','device_id','email_otp','signup','refferal'])
                 ->from('user')
                 ->like('mm_user_email', 'tkc')
                 ->get();
                
                
        return $query->result();
	}
	public function delete_job($tbl, $staus, $id)
	{
			$this->db->initialize();
		// $result=$this->B_crudexport->updateststus($this->tbl, $id, array('status'=>0));
		$this->db->where('job_id', $id);
         return $this->db->update($tbl, $staus);

	}
// 	public function all_data_selects()
// 	{
// 		$this->db->select('mm_master_job.job_title, mm_master_job.company_id, mm_employer.employer_contact_person_name, mm_employer.employer_company');
//        $this->db->from('mm_master_job');
// $this->db->join('mm_employer', 'mm_master_job.company_id=mm_employer.employer_id');
//  $query = $this->db->get();
//  $query->result_array();
// }
	public function edit_job($tbl, $job_id)
	{
		$this->db->select('*');
		$this->db->where('job_id', $job_id);
		$query=$this->db->get($tbl);
		return $query->row();
	}
	function fetch_data_by_one_table_join_between($field,$table_name,$join1,$where1, $where2, $where3){
 	$this->db->initialize();
	$result = $this->db->select($field)
			->from($table_name)
			->join($join1[0],$join1[1],$join1[2])
			->where('created_date >=',$where1)
            ->where('created_date <=',$where2)
			->where($where3)
			->get()
			->result_array();	
			$this->db->close();	
			return $result;
}
	public function get_current_page_records($table, $limit, $start)
	{
$this->db->limit($limit, $start);
    $query = $this->db->get($table);
  
    if ($query->num_rows() > 0)
    {
        foreach ($query->result_array() as $row)
        {
            $data[] = $row;
        }
         
        return $data;
    }
  
    return false;
	}
}
?>