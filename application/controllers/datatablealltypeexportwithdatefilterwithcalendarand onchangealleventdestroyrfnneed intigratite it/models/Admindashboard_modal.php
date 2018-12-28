	<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admindashboard_modal extends CI_model
 {
   function __construct()
      {
            $this->load->database();
            $this->load->library('session');
            $this->load->library('email');
           // $this->load->library('upload');
      }

		public function total_reg_user()
		{
			                    $this->db->initialize();
								$this->db->select('*');
								$this->db->from('user');
								$this->db->last_query();
								$query = $this->db->get();
								// echo  $this->db->last_query();
								$count=   $query->num_rows();
								$this->db->close();
							  return $count;             
		}
		public function total_assign_id()
		{
			$this->db->initialize();
			$this->db->select('mas_id');
			$this->db->from('master_assignment');
			$query = $this->db->get();
			$count=   $query->last_row("array");
			$this->db->close();
			return $count;             
		}

		public function assign_insert($data){
			$this->db->initialize();
			$this->db->insert('master_assignment', $data);
		}
		public function total_assign_list($val,$val2)
		{
			$this->db->initialize();
			$this->db->select('*');
			$this->db->from('master_assignment');
			$this->db->where('status',$val);
			$this->db->order_by('maid', $val2);
			$query = $this->db->get();
			$result = $query->result();
			$this->db->close();
	        return $result;

		}

		public function assign_delete($columnname,$assignid,$statuscolumn,$status,$tablename){
			$this->db->initialize();
		    $data[$statuscolumn] = $status;
		    $this->db->where($columnname, $assignid);
			$this->db->update($tablename, $data);
			$result = $this->db->affected_rows();
			$this->db->close();
	        return $result;
		}
		public function assign_value($assign_id)
		{
			$this->db->initialize();
			$this->db->select('*');
			$this->db->from('master_assignment');
			$this->db->where('maid',$assign_id);
			$this->db->where('status','1');
			$query = $this->db->get();  
			$result = $query->row_array();
			$this->db->close();
	        return $result;          
		}

		public function levelsize_assign($assign_id){
			$this->db->initialize();
			$this->db->select('ml_id');
			$this->db->from('master_level');
			$this->db->where('maid',$assign_id);
			$query = $this->db->get();
			$result = $query->num_rows();
			$this->db->close();
	        return $result;
		}

		public function assignment_update($value,$value1){
			$this->db->initialize();
		    $this->db->where('mas_id', $value1);  
			$this->db->update('master_assignment', $value);
			$result = $this->db->affected_rows();
			$this->db->close();
	        return $result;
		}

		public function assignment_level_num($value){
			$this->db->initialize();
			$this->db->select('number_of_level');
			$this->db->from('master_assignment');
			$this->db->where('maid',$value);
			$query = $this->db->get();
			$result = $query->row_array();
			$this->db->close();
	        return $result; 
		}

		public function task_value($value){
			$this->db->initialize();
			$this->db->select('*');
			$this->db->from('task');
			$this->db->where('tid',$value);
			$this->db->where('status','1');
			$query = $this->db->get();  
			$result = $query->result_array();
			$this->db->close();
	        return $result;
		}

		public function master_level_num($value){
			$this->db->initialize();
			$this->db->select('*');
			$this->db->from('master_level');
			$this->db->where('maid',$value);
			$this->db->where('ml_status','1');
			$query = $this->db->get();  
			$result = $query->result_array();
			$this->db->close();
	        return $result;
		}
		public function count_level($value){
			$this->db->initialize();
			$this->db->select('count(lvl_name) as total');
			$this->db->from('master_level');
			$this->db->where('maid',$value);
			$this->db->where('ml_status','1');
			$query = $this->db->get();  
			$result = $query->row_array();
			$this->db->close();
	        return $result;
		}

		public function level_update($value,$value1){
			$this->db->initialize();
		    $this->db->where('ml_id', $value);  
			$this->db->update('master_level', $value1);
			$result = $this->db->affected_rows();
			$this->db->close();
	        return $result;
		}

		public function level_insert($data){
			$this->db->initialize();
			$this->db->insert('master_level', $data);
			$this->db->close();

		}

		public function task_lists($val,$val1){
			$this->db->initialize();
			$this->db->select('ma.assignment_name,ts.task_name,ml.lvl_name,ts.sample_files,ma.start_date,ts.tid');
			$this->db->from('task ts');
			$this->db->join('master_assignment ma','ma.maid=ts.ma_id','left');
			$this->db->join('master_level ml','ml.ml_id=ts.ml_id','left');
			$this->db->where('ts.status',$val);
			if($val1 != ''){
				$this->db->where('ts.ma_id',$val1);
			}
			$this->db->order_by('ts.tid', 'DESC');
			$query = $this->db->get();  
			$result = $query->result(); 
			$this->db->close();
	        return $result;	
		}
		public function task_level($val){
			$this->db->initialize();
			$this->db->select('ml_id');
			$this->db->from('task');
			$this->db->where('ma_id',$val);
			$this->db->where('status','1');
			$query = $this->db->get();  
			$result = $query->result(); 
			$this->db->close();
	        return $result;	
		}

		public function task_insert($data){
			$this->db->initialize();
			$this->db->insert('task', $data);
			return $result;	
		}

		public function task_delete($taskid,$val){
			$this->db->initialize();
		    $data['status'] = $val;
		    $this->db->where('tid', $taskid);  
			$this->db->update('task', $data);
			$result = $this->db->affected_rows();
			$this->db->close();
	        return $result;	
		}

		public function task_update($value,$value1){
			$this->db->initialize();
		    $this->db->where('tid', $value);  
			$this->db->update('task', $value1);
			$result = $this->db->affected_rows();
			$this->db->close();
	        return $result;	
		}

		public function selectcountry(){
			$this->db->initialize();
			$this->db->select('cid,name');
			$this->db->from('countries');
			$query = $this->db->get();  
			$result = $query->result(); 
			$this->db->close();
	        return $result;	
		}

		public function widget_insert($data){
			$this->db->initialize();
			$this->db->insert('widget', $data);
		}
		public function widget_lists($val,$val1){
			$this->db->initialize();
			$this->db->select('*');
			$this->db->from('widget');
			$this->db->where('status',$val);
			$this->db->order_by('w_id', $val1);
			$query = $this->db->get();  
			$result = $query->result(); 
			$this->db->close();
	        return $result;	
		}

		public function widget_delete($w_id,$val){
		    $data['status'] = $val;
		    $this->db->initialize();
		    $this->db->where('w_id', $w_id);  
			$this->db->update('widget', $data);
			$result = $this->db->affected_rows();

			$this->db->close();
	        return $result;	
		}

		public function widget_country($val){
			$this->db->initialize();
			$this->db->select('*');
			$this->db->from('widget');
			$this->db->where('w_id',$val);
			$this->db->where('status','1');
			$query = $this->db->get();  
			$result = $query->result(); 
			$this->db->close();
	        return $result;	 
		}

		public function select_widget_country($val){
			$this->db->initialize();
			$this->db->select('cid,name');
			$this->db->from('countries');
			$this->db->where('cid',$val);
			$query = $this->db->get();  
			$result = $query->result(); 
			$this->db->close();
	        return $result;	
		}
		//after updation
		public function widget_update($value,$value1){
			$this->db->initialize();
		    $this->db->where('w_id', $value);  
			$this->db->update('widget', $value1);
			$result = $this->db->affected_rows();
			$this->db->close();
	        return $result;	
		}

		public function select_widget_countries($val){
			$this->db->initialize();
			$this->db->select('cid,name');
			$this->db->from('countries');
			$this->db->where('cid !=',$val);
			$query = $this->db->get();  
			$result = $query->result();
			$this->db->close();
	        return $result;	
		}

		public function assesment_insert($data){
			$this->db->initialize();
			$this->db->insert('master_parameter', $data);
		}
		
		public function mapping_assigment($allassignm){
			$this->db->initialize();
			$this->db->select('p_id');
			$this->db->from('master_level');
			$this->db->where('maid',$allassignm);
			$query = $this->db->get();
			$result = $query->result();
			$this->db->close();
	        return $result;	
		}


		public function total_assesment_list($val,$val2){
			$this->db->initialize();
			$this->db->select('*');
			$this->db->from('master_parameter');
			$this->db->where('status',$val);
			$this->db->order_by('p_id', $val2);
			$query = $this->db->get();
			$result = $query->result();
			$this->db->close();
	        return $result;	
		}

		public function assesment_level($val,$val2){
			$this->db->initialize();
			$this->db->select('ml_id,p_id');
			$this->db->from('master_level');
			$this->db->where('maid',$val);
			$this->db->where('ml_id',$val2);
			$query = $this->db->get();  
			$result = $query->result();
			$this->db->close();
	        return $result;	 
		}

		public function assesment_update($maid,$ml_id,$p_id){
			$this->db->initialize();
		    $this->db->where('maid', $maid);
		    $this->db->where('ml_id', $ml_id);
			$this->db->update('master_level', $p_id); 
			$result = $this->db->affected_rows();
			$this->db->close();
	          return $result;			
		}
		public function emptyparameterslevel($maid,$lvlid){
			$this->db->initialize();
			$this->db->select('p_id');
			$this->db->from('master_level');
			$this->db->where('maid',$maid);
			$this->db->where('ml_id',$lvlid);
			$query = $this->db->get();  
			$result = $query->result();
			$this->db->close();
	          return $result;
		}
		public function veiw_all_tables_data($coumnname,$tablename){
			$this->db->initialize();
			$this->db->select($coumnname);
			$this->db->from($tablename);
			$query = $this->db->get();  
			$result = $query->result();
			$this->db->close();
	          return $result;
		}
		public function mapquestion($tablename,$data){
			$this->db->initialize();
			$this->db->update($tablename, $data);
			$this->db->close();
		}
		
		public function getassignment_for_case(){
			$this->db->initialize();
			$this->db->select('ma.maid,assignment_name');
			$this->db->from('master_assignment ma');
			$this->db->join('master_level ml','ml.maid=ma.maid','left');
			$this->db->where('ml.m_type=4');
			$this->db->group_by('ma.maid');
			$query = $this->db->get();
			$result = $query->result_array();
			$this->db->close();
	          return $result;
		}
		
		###############  Code By ravi #########################3
        
     public function list_of_assignment()
        {
        	$this->db->initialize();
            $this->db->select('assignment_name,maid');
            $this->db->from('master_assignment');
            $this->db->where('status',1);
            $this->db->where('type','Manual');
            $data =$this->db->get();
            $result = $data->result();
             $this->db->close();
	          return $result;

        }
      
#################3 end of code #####################
 #################     08052017 start code ravi #####################
		public function get_data_for_preview($data)
		{
			try 
			{
				$this->db->initialize();
				$this->db->select('*,c.name as cityname, s.name as statename ,mb.board_name as board_name ,mb1.board_name as XIIBoard ,md.degree_name as gdegreename,mu.un_name as gun_name , md1.degree_name as pgdegreename , mu1.un_name as pgun_name');
				$this->db->from('user u');
				$this->db->join('user_data ud','u.mm_uid=ud.uid','left');
				$this->db->join('cities c','c.ci_id=ud.city','left');
				$this->db->join('states s','s.sid=ud.state','left');
				$this->db->join('master_board mb','mb.bid=ud.ssc_institution','left');
				$this->db->join('master_board mb1','mb1.bid=ud.hsc_institution','left');
				$this->db->join('master_degree md','md.md_id=ud.grad_degree','left');
				$this->db->join('master_university mu','mu.mu_id=ud.grad_institution','left');
				$this->db->join('master_degree md1','md1.md_id=ud.pg_degree','left');
				$this->db->join('master_university mu1','mu1.mu_id=ud.pg_institution','left');
				$this->db->where('u.mm_uid',$data);
				$query=$this->db->get();

				$result = $query->result();
				
	          $this->db->close();
	          return $result;




			}
			 catch (Exception $e) {
				echo 'Caught exception', $e->getMessage(),"\n";
			}
		}
 #################      end of code ravi        #####################
 public function  all_completed_assignment_with_user()
{
	$this->db->initialize();
	$this->db->select('*');
	$this->db->from('completed_assignment as ca');
	$this->db->where('ma.status',1);
	$this->db->where('ca.status',1);
	$this->db->join('master_assignment as ma', 'ma.maid = ca.maid', 'left');
	$this->db->join('user as u', 'u.mm_uid = ca.uid', 'left');
	$this->db->order_by('ca.end_time DESC');
	$query = $this->db->get();
    $result = $query->result_array();
	$this->db->close();
	return $result;
}
public function  all_going_assignment_with_user()
{
	$this->db->initialize();
	$this->db->select('*');
	$this->db->from('completed_assignment as ca');
	$this->db->where('ma.status',1);
	$this->db->where('ca.status',0);
	$this->db->join('master_assignment as ma', 'ma.maid = ca.maid', 'left');
	$this->db->join('user as u', 'u.mm_uid = ca.uid', 'left');
	$this->db->order_by('ca.start_time DESC');
	$query = $this->db->get();
	$result = $query->result_array();
	$this->db->close();
	return $result;
}
public function  all_completed_level_with_user($maid,$uid)
{
	$this->db->initialize();
	$this->db->select('*');
	$this->db->from('completed_level as cl');
//	$this->db->where('ma.status',1);
	$this->db->where('cl.status',1);
	$this->db->where('cl.maid',$maid);
	$this->db->where('cl.uid',$uid);
	$this->db->join('master_level as ml', 'ml.ml_id = cl.level_id', 'left');
	$this->db->order_by('cl.end_time DESC');
	//$this->db->join('user as u', 'u.mm_uid = cl.uid', 'left');
	$query = $this->db->get();
	$result = $query->result_array();
	$this->db->close();
	return $result;
}
public function all_data_with_group($where){
	// Function for group by data
	$this->db->initialize();
	$this->db->select('ma.maid,ma.assignment_name');
	$this->db->from('case_study cs');
	$this->db->join('master_assignment ma','ma.maid=cs.maid');
	$this->db->where($where);
	$this->db->group_by('cs.maid');
	$this->db->order_by('ma.created_date Desc');
	$query = $this->db->get();
	$result = $query->result_array();
	$this->db->close();
	return $result;
}

public function alldatawith_group_order($column,$tbl,$where,$order){
	$this->db->initialize();
	$this->db->select($column);
	$this->db->from($tbl);
	$this->db->where($where);
	$this->db->group_by(array("case_id", "u_id"));
	$this->db->order_by($order);
	$query = $this->db->get();
	$result = $query->result_array();
	$this->db->close();
	return $result;
}
function get_neurons_admin(){
	$this->db->initialize();
	$this->db->select("n.*,u.mm_user_full_name,u.mm_user_email,u.mm_uid");
	$this->db->from("neurons as n");
	$this->db->join("user as u","u.mm_uid=n.u_id","left");	
	$this->db->order_by("n.neurons desc");
	$query=$this->db->get();
	$result = $query->result_array();
	$this->db->close();
	return $result;
}
function get_user_neurons_details($uid){
	$this->db->initialize();
	$this->db->select("mp.package_name,ml.lvl_name,ma.assignment_name,s.neurons,u.mm_user_full_name,s.status");
	$this->db->from("score s");
	$this->db->join("mm_packages mp","mp.package_id=s.package_id","left");
	$this->db->join("master_assignment ma","ma.maid=s.maid","left");
	$this->db->join("master_level ml","ml.ml_id=s.level_id","left");
	$this->db->join("user u","u.mm_uid=s.u_id","left");
	$this->db->where("s.u_id",$uid);
	$query=$this->db->get();
	$result = $query->result_array();
	$this->db->close();
	return $result;
}
function get_data_by_day_wise($date_from,$date_to){
	$this->db->initialize();
	$this->db->select("s.created_date,u.mm_user_full_name,u.mm_user_email,s.neurons");
	$this->db->from("score s");
	$this->db->join("user u ","s.u_id=u.mm_uid","left");
	$this->db->where("s.created_date <=",$date_from);
	$this->db->where("s.created_date >",$date_to);
	$query=$this->db->get();
	$result = $query->result_array();
	$this->db->close();
	return $result;
}
public function data_select($fdate,$tdate){
    $this->db->initialize();
    $this->db->select('*');
    $this->db->from('mm_ticket');
    $this->db->where('created_date >=',$fdate);
    $this->db->where('created_date <=',$tdate);
    $this->db->where('delete_status =','1');
    $query = $this->db->get();
    $result=$query->result_array();
    $this->db->close();
    return $result;
}

function all_data(){
	$this->db->initialize();
	$this->db->select("u.mm_user_full_name,u.mm_user_email,u.reg_date,u.eamil_auth_status,us.contact_number,us.source_name");
	$this->db->from("user as u");
	$this->db->join("user_data as us","us.uid=u.mm_uid","left");
	$this->db->order_by("u.mm_uid asc");
	$query=$this->db->get();
	$result = $query->result_array();
	$this->db->close();
	return $result;
}
function all_score(){
	$this->db->initialize();
	$this->db->select("u.mm_user_full_name,u.mm_uid,ma.assignment_name,ml.lvl_name,s.total_score,s.score_id");
	$this->db->from("score s");
	$this->db->join("user u","u.mm_uid=s.u_id","left");
	$this->db->join("master_assignment ma","ma.maid=s.maid","left");
	$this->db->join("master_level ml","ml.ml_id=s.level_id","left");
	$this->db->order_by("s.score_id asc");
	$query=$this->db->get();
	$result = $query->result_array();
	$this->db->close();
	return $result;
}
function all_score_user($v){
	$this->db->initialize();
	$this->db->select("u.mm_user_full_name,u.mm_uid,ma.assignment_name,ml.lvl_name,s.total_score,s.score_id");
	$this->db->from("score s");
	$this->db->join("user u","u.mm_uid=s.u_id","left");
	$this->db->join("master_assignment ma","ma.maid=s.maid","left");
	$this->db->join("master_level ml","ml.ml_id=s.level_id","left");
	$this->db->where("s.score_id",$v);
	$query=$this->db->get();
	$result = $query->result_array();
	$this->db->close();
	return $result;
}

function all_dailyreport_activity($date_from, $date_to){	
	$period = new DatePeriod(
     new DateTime($date_from),
     new DateInterval('P1D'),
     new DateTime($date_to)
);
foreach ($period as $key => $value) {
    $data[]['date'] =$value->format('Y-m-d');       
}
rsort($data);
return $data;
}

function all_dailyreport_neurons($where){
	$this->db->initialize();
	$this->db->select('SUM(neurons) as neurons');
	$this->db->from('score');
	$this->db->where($where);
	$query=$this->db->get();
	$result = $query->row_array();
	$this->db->close();
	return $result;

}

function all_userreports($where){
	$this->db->initialize();
	$this->db->select('CONCAT(u.mm_user_full_name," ",u.mm_last_name) full_name,u.mm_user_email,ud.contact_number, u.signup, u.eamil_auth_status,u.mm_uid');
	$this->db->from('user u');
	$this->db->join("user_data ud","u.mm_uid=ud.uid","left");
	$this->db->where($where);
	$this->db->order_by('u.mm_uid desc');
	$query=$this->db->get();
	$result = $query->result_array();
	$this->db->close();
	return $result;
}
 function get_neurons_admin_paggi($limit,$where){
    $this->db->initialize();
	$this->db->select("n.*,u.mm_user_full_name,u.mm_user_email,u.mm_uid");
	$this->db->from("neurons as n");
	$this->db->join("user as u","u.mm_uid=n.u_id","left");

	$this->db->limit($limit,$where);

	$this->db->order_by("n.neurons Desc");
	$query=$this->db->get();
	$result = $query->result_array();
	$this->db->close();
	return $result;
}


function get_neurons_admin_count(){
    $this->db->initialize();
	$this->db->select("n.*,u.mm_user_full_name,u.mm_user_email,u.mm_uid");
	$this->db->from("neurons as n");
	$this->db->join("user as u","u.mm_uid=n.u_id","left");
	$query=$this->db->get();
	$result = $query->num_rows();
	$this->db->close();
	        return $result;
}
public function level_completed_list($limit,$where){
	        $this->db->initialize();
			$this->db->select("u.mm_user_full_name, u.mm_user_email,u.mm_uid, ml.lvl_name, ma.assignment_name, s.score, cl.end_time,cl.cl_id");
			$this->db->from('completed_level as cl');
			$this->db->join("user as u","u.mm_uid=cl.uid","left");
			$this->db->join("master_level as ml","ml.ml_id=cl.level_id","left");
			$this->db->join("master_assignment as ma","ma.maid=cl.maid","left");
			$this->db->join("score as s","s.u_id=cl.uid and s.level_id=cl.level_id and cl.maid=s.maid","left");
			$this->db->limit($limit,$where);
			$this->db->order_by('cl.cl_id DESC');
			$query=$this->db->get();
			$result = $query->result_array();
			$this->db->close();
	        return $result;
		}
	public function assignment_wise_neurons($maid,$uid){
		$this->db->initialize();
$this->db->select('s.neurons,ml.lvl_name,cl.uid,ma.assignment_name,ml.time_limit,ml.d_level');
$this->db->from('completed_level cl');
$this->db->join('master_level ml','ml.ml_id=cl.level_id','left');
$this->db->join('score s','cl.level_id=s.level_id','left');
$this->db->join('master_assignment ma','cl.maid=ma.maid','left');
$this->db->where(["s.u_id"=>$uid,"cl.status"=>1,"cl.uid"=>$uid,"cl.maid"=>$maid]);
$result = $this->db->get()->result_array();
$this->db->close();
	return $result;
}

function get_data_by_day_wise_for_user($date_from,$date_to){
	$this->db->initialize();
	$this->db->select("u.mm_user_full_name,sum(s.neurons) as neurons,u.mm_user_email,u.mm_uid");
	$this->db->from("score s");
	$this->db->join("user u ","s.u_id=u.mm_uid","left");
	$this->db->where("s.created_date <=",$date_from);
	$this->db->where("s.created_date >",$date_to);
	$this->db->group_by('s.u_id');
	$query=$this->db->get();
	// echo $this->db->last_query();
	// exit;
	$result = $query->result_array();
	$this->db->close();
	return $result;
}

	public function search_user($user_name){
		    $this->db->initialize();
			$this->db->select('mm_user_full_name,mm_uid,mm_user_email');
			$this->db->from('user');
			$this->db->where("mm_uid  NOT IN(SELECT user_id FROM mm_group_members where status in(1,0)) and mm_uid NOT IN(SELECT group_leader_uid FROM mm_group) and mm_user_full_name like '$user_name%' and eamil_auth_status='1' and user_status='1'");
			$this->db->order_by('mm_user_full_name');
			$query=$this->db->get();
			$result = $query->result_array();
			$this->db->close();
			return $result;
		}

		public function check_package_tool_type($m_type){
			$data_package=$this->Crud_modal->all_data_select('*','mm_packages',"status in(0,1)",'package_id desc');
			//print_r($data_package);
			for ($i=0; $i <sizeof($data_package) ; $i++) { 
				$ass_id=$data_package[$i]['ma_id'];
				$val_check=$this->Crud_modal->all_data_select('*','master_level',"maid IN($ass_id) and m_type='$m_type'",'maid asc');
				if(sizeof($val_check)>0){
					$data[$i]['package_name']=$data_package[$i]['package_name'];
					$data[$i]['package_id']=$data_package[$i]['package_id'];
				}
				// $package_list[$i]=
			}
			$this->db->close();
			return $data;
		}


		public function group_delete_model($id,$table_name){
			$this->db->initialize();
			$this->db->where('group_id',$id);
			$this->db->delete($table_name);
			$this->db->close();

		}
		public function leave_group($id){
			 $this->db->initialize();
			 $this->db->where('user_id', $id);
		     $this->db->delete('mm_group_members'); 
		     $this->db->close();
			}
public function get_city_name($id){
	$this->db->initialize();
		$data=$this->db->select('*')
				->from("cities")
				->where("ci_id",$id)
				->get();
		$result = $data->row_array();
		$this->db->close();
	    return $result;		
	}
	public function get_state_name($id){
		$this->db->initialize();
		$data=$this->db->select('*')
				->from("states")
				->where("sid",$id)
				->get();
		$result = $data->row_array();	
		$this->db->close();
	    return $result;	
	}
public function search_city($user_name){
	$this->db->initialize();
		$data=$this->db->select('name,ci_id')
				->from("cities")
				->where("name like '$user_name%'")
				->get();
		$result = $data->result_array();
		$this->db->close();
	    return $result;	

	}
public function all_distinct_data_select($fields,$tbl_name,$where,$orderby)
                        {
                            try
                        {                   $this->db->initialize();
                                            $this->db->distinct($fields);
                                            $this->db->select($fields);
                                            $this->db->from($tbl_name);
                                            $this->db->where($where);
                                            $query = $this->db->order_by($orderby);
                                            $query = $this->db->get();
                                            $result = $query->result_array();
                                             $this->db->close();
	                                         return $result;
                           }
                        
                        catch(Exception $e)
         {
             echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
         }
                        }
public function new_total_reg_user($date_to, $date_from)
        {    
        	    $this->db->initialize();
                $this->db->select('*');
                $this->db->from('user');
                $this->db->where('reg_date >=',$date_from);
                $this->db->where('reg_date <=',$date_to);
                $query = $this->db->get();
                $result=$query->result_array();
                $this->db->close();
                return $result;            
        }
function get_all_employer_jobs(){
	    $this->db->initialize();
        $data=$this->db->select('job.*,company.*,func.functional_name')
                ->from("mm_master_job as job")
                ->join("mm_employer as company","job.company_id=company.employer_id","inner")
                ->join("mm_master_industry_functional as func","job.functional_id=func.functional_id","inner")
                ->order_by("job.job_id desc")
                ->get();
        $result = $data->result_array();  
        $this->db->close();
	    return $result;      
    }
    function get_all_employer_jobs_by_functional_id($fid){
    	$this->db->initialize();
        $data=$this->db->select('job.*,company.*,func.functional_name')
                ->from("mm_master_job as job")
                ->join("mm_employer as company","job.company_id=company.employer_id","inner")
                ->join("mm_master_industry_functional as func","job.functional_id=func.functional_id","inner")
                ->where("job.functional_id",$fid)
                ->order_by("job.job_id desc")
                ->get();
        $result = $data->result_array();
         $this->db->close();
	    return $result;        
    }
    function get_all_employer_jobs_by_company_id($cid){
    	$this->db->initialize();
        $data=$this->db->select('job.*,company.*,func.functional_name')
                ->from("mm_master_job as job")
                ->join("mm_employer as company","job.company_id=company.employer_id","inner")
                ->join("mm_master_industry_functional as func","job.functional_id=func.functional_id","inner")
                ->where("job.company_id",$cid)
                ->order_by("job.job_id desc")
                ->get();
        $result = $data->result_array();
        $this->db->close();
	    return $result;        
    }
    function get_all_employer_jobs_by_industry_id($id){
    	$this->db->initialize();
        $data=$this->db->select('job.*,company.*,func.functional_name')
                ->from("mm_master_job as job")
                ->join("mm_employer as company","job.company_id=company.employer_id","inner")
                ->join("mm_master_industry_functional as func","job.functional_id=func.functional_id","inner")
                ->where("job.industry_id",$id)
                ->order_by("job.job_id desc")
                ->get();
        return $data->result_array();        
    }
    function get_all_employer_jobs_by_date($starts,$ends){

        $start=date("Y-m-d H:i:s",strtotime($starts));
        $end=date("Y-m-d H:i:s",strtotime($ends));
        if($starts!='' && $ends==''){
            $start2= date('Y-m-d H:i:s',strtotime('+23 hour +29 minutes',strtotime($starts)));
            $this->db->initialize();
            $data=$this->db->select('job.*,company.*,func.functional_name')
                ->from("mm_master_job as job")
                ->join("mm_employer as company","job.company_id=company.employer_id","inner")
                ->join("mm_master_industry_functional as func","job.functional_id=func.functional_id","inner")
                ->where("job.created_date>='".$start."' and job.created_date<'".$start2."'")
                ->order_by("job.job_id desc")
                ->get();
                //echo $this->db->last_query(); die;
        }
        elseif($starts=='' && $ends!=''){
            $end2= date('Y-m-d H:i:s',strtotime('+23 hour +29 minutes',strtotime($ends)));
            $this->db->initialize();
            $data=$this->db->select('job.*,company.*,func.functional_name')
                ->from("mm_master_job as job")
                ->join("mm_employer as company","job.company_id=company.employer_id","inner")
                ->join("mm_master_industry_functional as func","job.functional_id=func.functional_id","inner")
                ->where("job.created_date>='".$end."' and job.created_date<'".$end2."'")
                ->order_by("job.job_id desc")
                ->get(); 
                //echo $this->db->last_query(); die;
        }
        elseif($starts!='' && $ends!=''){
        	$this->db->initialize();
            $data=$this->db->select('job.*,company.*,func.functional_name')
                ->from("mm_master_job as job")
                ->join("mm_employer as company","job.company_id=company.employer_id","inner")
                ->join("mm_master_industry_functional as func","job.functional_id=func.functional_id","inner")
                ->where("job.created_date between '".$start."' and '".$end."' ")
                ->order_by("job.job_id desc")
                ->get(); 
        }

        $result = $data->result_array(); 
        $this->db->close();
	    return $result;       
    }
  public function ticket_delete($columnname,$ticketid,$statuscolumn,$status,$tablename){
  	        $this->db->initialize();
            $data[$statuscolumn] = $status;
            $this->db->where($columnname, $ticketid);
            $this->db->update($tablename, $data);
            $result = $this->db->affected_rows();
            $this->db->close();
	        return $result;
        }
    public function delete_row_using_id($tablename,$column_name,$column_value)
   {
   try
   {
   	 $this->db->initialize();
       // echo $id; die;
     $this ->db-> where($column_name, $column_value);
     if($this ->db-> delete($tablename)){
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

 // code by khushboo 02-02-2018
 public function get_tickets($limit){
 	$this->db->initialize();
    $this->db->select("t.ticket_id,t.ticket_sequence_no,t.name,t.email_id,t.subject,u.contact_number");
    $this->db->from("mm_ticket t");
        $this->db->join("user_data u","u.uid=t.uid","left");
        $this->db->where("status=1 and priority='High' and delete_status=1");
        $this->db->order_by('t.ticket_id desc');
        $this->db->limit("$limit");
        $query=$this->db->get();
        $result = $query->result_array();
        $this->db->close();
	   return $result;
}
public function get_users($limit){
	$this->db->initialize();
    $this->db->select("u.mm_uid,CONCAT(u.mm_user_full_name,' ',u.mm_last_name) as name,u.mm_user_email,uu.contact_number");
    $this->db->from("user u");
    $this->db->join("user_data uu","uu.uid=u.mm_uid","left");
    $this->db->where("u.user_status='1'");
    $this->db->order_by('u.mm_uid desc');
    $this->db->limit($limit);
    $query=$this->db->get();
    $result = $query->result_array();
    $this->db->close();
	return $result;
}
public function get_total_levels($a){
	$this->db->initialize();
    $this->db->select("count(ml_id) as totalLevel");
    $this->db->from("master_level");
    $this->db->where("maid in($a) and ml_status=1");
    $query=$this->db->get();
    $result = $query->row_array();
    $this->db->close();
	return $result;
}
public function get_groups($limit){
	$this->db->initialize();
    $this->db->select("g.group_id,g.group_name,g.group_leader_uid,u.mm_user_full_name,n.neurons");
    $this->db->from("mm_group g");
    $this->db->join("user u","u.mm_uid=g.group_leader_uid","left");
    $this->db->join("neurons n","n.u_id=g.group_leader_uid","left");
    $this->db->where("status in(0,1)");
    $this->db->order_by('g.group_id desc');
    $this->db->limit("$limit");
    $this->db->limit($limit);
    $query=$this->db->get();
    $result = $query->result_array();
    $this->db->close();
	return $result;
}
public function get_jobs($limit){
	$this->db->initialize();
    $this->db->select("job.job_id, job.job_title, job.required_system_neurons, job.company_id, job.ctc_from, job.ctc_to, e.employer_company");
   $this->db->from('mm_master_job as job');
   $this->db->join('mm_employer as e','e.employer_id=job.company_id','left');
   $this->db->order_by('job.job_id desc');
    $this->db->limit("$limit");
    $query=$this->db->get();
    $result = $query->result_array();
     $this->db->close();
	return $result;
}
function get_applied_jobs($limit){
	$this->db->initialize();
    $this->db->select("ap.applied_job_id, ap.job_id, ap.name, ap.phone_no, ap.uid, ap.job_process_step, u.mm_user_email, job.job_title, job.company_id, e.employer_company");
   $this->db->from('mm_user_applied_job as ap');
   $this->db->join('user as u','u.mm_uid=ap.uid','left');
   $this->db->join('mm_master_job as job','job.job_id=ap.job_id','left');
   $this->db->join('mm_employer as e','e.employer_id=job.company_id','left');
   $this->db->order_by('ap.applied_job_id desc');
    $this->db->limit("$limit");
    $query=$this->db->get();
    $result = $query->result_array();
    $this->db->close();
	return $result;
}
 // end of khushboo 02-02-2018
public function alldatawith_group_order_with_limit($column,$tbl,$where,$order,$limit){
	$this->db->initialize();
    $this->db->select($column);
    $this->db->from($tbl);
    $this->db->where($where);
    $this->db->group_by(array("case_id", "u_id"));
    $this->db->order_by($order);
    $this->db->limit($limit);
    $query = $this->db->get();
    $result = $query->result_array();
    $this->db->close();
	return $result;
}

 function get_faq_list(){
 	$this->db->initialize();
 	$this->db->select("fq.*, f.faq_name, fsub.faq_sub_topic_name");
    $this->db->from('mm_master_faq_question as fq');
    $this->db->join('mm_master_faq_sub_topic as fsub','fsub.faq_sub_topic_id=fq.faq_sub_topic_id','inner');
    $this->db->join('mm_master_faq_topic as f','f.faq_id=fq.faq_id','inner');
    $this->db->where("fq.q_status=1");
    $this->db->order_by('fq.faq_qid desc');
	$query=$this->db->get();
	$result = $query->result_array();
	$this->db->close();
	return $result;
 }
  function get_faq_sub_topic_list(){
  	$this->db->initialize();
 	$this->db->select("fq_sub.*, f.faq_name");
    $this->db->from('mm_master_faq_sub_topic as fq_sub');
    $this->db->join('mm_master_faq_topic as f','f.faq_id=fq_sub.faq_id','inner');
    $this->db->where("fq_sub.faq_sub_topic_status=1");
    $this->db->order_by('fq_sub.faq_sub_topic_id desc');
	$query=$this->db->get();
	$result = $query->result_array();
	$this->db->close();
	return $result;
 } 
 function ddoo_upload($filename,$type){
    $config['upload_path'] = './upload/blog/';
    $config['allowed_types'] = 'gif|jpg|png';
    // $config['max_size'] = '100';
    // $config['max_width']  = '1024';
    // $config['max_height']  = '768';
    $this->load->library('upload', $config);
    if($type==0){
        //$config['file_name'] = time().'thumb_'.$_FILES[$filename]['name'];
        $config['file_name'] = time().'_thumb';
    }
    if($type==1){
        $config['file_name'] = time().'_banner';
    }
    $this->upload->initialize($config);
    
    if(!$this->upload->do_upload($filename)){ 
        $error = array('error' => $this->upload->display_errors());
        return false;
    }else{
        $data = array('upload_data' => $this->upload->data());
        return $data;
    }
}
  function blog_image_upload($filename,$type){
	$config['upload_path'] = './upload/blog/';
	$config['allowed_types'] = 'gif|jpg|png|jpeg';
	$this->load->library('upload', $config);
	if($type==0){
		$config['file_name'] = time().'_thumb';
	}
	if($type==1){
		$config['file_name'] = time().'_banner';
	}
	$this->upload->initialize($config);
	
	if(!$this->upload->do_upload($filename)){
	    $error = array('error' => $this->upload->display_errors());
		return false;
	}else{
		$data = array('upload_data' => $this->upload->data());
		return true;
	}
 }
 
 public function package_completed_user_count($package_id,$total_level){
    $count=0;
    $data_pack=$this->Crud_modal->all_data_select('distinct(u_id) as uids','score',"package_id=$package_id",'u_id desc');
    for($i=0;$i<sizeof($data_pack);$i++){
        $uid=$data_pack[$i]['uids'];
        $score=$this->Crud_modal->fetch_single_data('count(level_id) as count','score',"package_id=$package_id and u_id='$uid'");
        if($score['count']>0 && $score['count']==$total_level){
        //    $id=$score[0]['u_id'];
            //$data_user=$this->Crud_modal->fetch_single_data('mm_user_email,mm_user_full_name,mm_uid','user',"mm_uid='$id'");
            $count++;        
        }
    }
    return $count;
}
public function package_not_completed_user_count($package_id,$total_level){
    $count=0;
    $data_pack=$this->Crud_modal->all_data_select('distinct(u_id) as uids','score',"package_id=$package_id",'u_id desc');
    for($i=0;$i<sizeof($data_pack);$i++){
        $uid=$data_pack[$i]['uids'];
        $score=$this->Crud_modal->fetch_single_data('count(level_id) as count','score',"package_id=$package_id and u_id='$uid'");
        if($score['count']>0 && $score['count']!=$total_level){
        //    $id=$score[0]['u_id'];
            //$data_user=$this->Crud_modal->fetch_single_data('mm_user_email,mm_user_full_name,mm_uid','user',"mm_uid='$id'");
            $count++;        
        }
    }
    return $count;
}
 
}

