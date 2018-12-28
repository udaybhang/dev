<?php 
defined("BASEPATH") or exit("no direct script allowed");
class Pagination_model extends CI_Model{
	function __construct(){
	parent::__construct();	
		$this->load->library(array('session','pagination'));
		$this->load->helper('url');
		$this->load->database();	
    }
    public function score_data($order,$title){
    if(!empty($title)){
		$this->db->like('u.mm_user_email',$title);
	}
	$this->db->select('s.*, u.mm_user_email,u.mm_uid,ma.assignment_name,ml.lvl_name, mp.package_name');
	$this->db->from('score as s');
	$this->db->join("user u","u.mm_uid=s.u_id","left");
	$this->db->join("master_assignment ma","ma.maid=s.maid","left");
	$this->db->join("master_level ml","ml.ml_id=s.level_id","left");
	$this->db->join("mm_packages mp","mp.package_id=s.package_id","left");
	$this->db->order_by($order);
	//echo $this->db->last_query(); die;
	$query=$this->db->get();
	//return $query->result_array();
	return $query->num_rows();
   }
    public function score_data_list($limit,$offset,$title){
    if(!empty($title)){
		$this->db->like('u.mm_user_email',$title);
		$findme   = '@';
		$pos = strpos($title, $findme);
		if ($pos === false) {
		}else {
			$limit='';
		}
    }
	$this->db->select('s.*, u.mm_user_email,u.mm_uid,ma.assignment_name,ml.lvl_name, mp.package_name');
	$this->db->from('score as s');
	$this->db->join("user u","u.mm_uid=s.u_id","left");
	$this->db->join("master_assignment ma","ma.maid=s.maid","left");
	$this->db->join("master_level ml","ml.ml_id=s.level_id","left");
	$this->db->join("mm_packages mp","mp.package_id=s.package_id","left");
	$this->db->order_by('score_id desc');
	if($limit!='' && $offset!=''){
	}
	$this->db->limit($limit,$offset);
	$query=$this->db->get();
	return $query->result_array();
	
   }
	public function allrecord($title){
		if(!empty($title)){
			$this->db->like('u_id',$title);
		}
		$this->db->select('*');
		$this->db->from('score');
		$rs = $this->db->get();
		return $rs->num_rows();
	}
	public function data_list($limit,$offset,$title){
		if(!empty($title)){
			$this->db->like('u_id',$title);
		}
		$this->db->select('*');
		$this->db->from('score');
		$this->db->order_by('score_id','desc');
		$this->db->limit($limit,$offset);
		$rs = $this->db->get();
		return $rs->result_array();
	}
	public function level_score_data($order,$title){
    if(!empty($title)){
		$this->db->where('c.maid',$title);
	}
	$this->db->select('c.*,CONCAT(u.mm_user_full_name," ",u.mm_last_name) as name,u.mm_user_email,u.mm_uid,a.assignment_name,l.lvl_name');
	$this->db->from('completed_level as c');
	$this->db->join("user u","u.mm_uid=c.uid","left");
	$this->db->join("master_assignment a","a.maid=c.maid","left");
	$this->db->join("master_level l","l.ml_id=c.level_id","left");
	//$this->db->join("score s","s.u_id=c.uid AND s.level_id=c.level_id","left");
	$this->db->order_by('cl_id desc');
	$query=$this->db->get();
	//return $query->result_array();
	return $query->num_rows();
   }
   public function level_score_data_list($limit,$offset,$title1){
    if(!empty($title1)){
    	$this->db->like('c.maid',$title1);
	}
	$this->db->select('c.*,CONCAT(u.mm_user_full_name," ",u.mm_last_name) as name,u.mm_user_email,u.mm_uid,a.assignment_name,l.lvl_name');
	$this->db->from('completed_level as c');
	$this->db->join("user u","u.mm_uid=c.uid","left");
	$this->db->join("master_assignment a","a.maid=c.maid","left");
	$this->db->join("master_level l","l.ml_id=c.level_id","left");
	$this->db->order_by('cl_id desc');
	$this->db->limit($limit,$offset);
	$query=$this->db->get(); 
	return $query->result_array();
	
   }
    public function level_score_list_by_assignment($limit,$offset,$where){
    if(!empty($where)){
    	$this->db->where($where);
	}
	$this->db->select('c.*,CONCAT(u.mm_user_full_name," ",u.mm_last_name) as name,u.mm_user_email,u.mm_uid,a.assignment_name,l.lvl_name');
	$this->db->from('completed_level as c');
	$this->db->join("user u","u.mm_uid=c.uid","left");
	$this->db->join("master_assignment a","a.maid=c.maid","left");
	$this->db->join("master_level l","l.ml_id=c.level_id","left");
	$this->db->order_by('cl_id desc');
	$this->db->limit($limit,$offset);
	$query=$this->db->get();
	return $query->result_array();
	
   }
   public function all_reg_user_data($order,$title){
   if(!empty($title)){
        $this->db->where('u.user_type_id',$title);
    }
    $this->db->select('u.*,ut.type_name');
    $this->db->from('user u');
    $this->db->join("user_type ut","ut.user_type_id=u.user_type_id","left");
    $this->db->order_by($order);
    $query=$this->db->get();
    //return $query->result_array();
    return $query->num_rows();
  }
  public function all_reg_user_data_list($limit,$offset,$title){
   if(!empty($title)){
        $this->db->where('u.user_type_id',$title);
    }
    $this->db->select('u.*,ud.contact_number,ut.type_name');
    $this->db->from('user u');
    $this->db->join("user_type ut","ut.user_type_id=u.user_type_id","left");
    $this->db->join("user_data ud","ud.uid=u.mm_uid","left");
    $this->db->order_by('mm_uid desc');
    $this->db->limit($limit,$offset);
    $query=$this->db->get();
    return $query->result_array();
    
  }
  
  public function all_idle_user_data($order,$title,$allattemptusers){
   if(!empty($title)){
        $this->db->where("u.mm_user_email LIKE '%$title%'");
    }
    $this->db->select('u.mm_uid,u.mm_user_full_name,u.mm_last_name,u.mm_user_email,u.reg_date,ud.contact_number');
    $this->db->from('user u');
    $this->db->join("user_data ud","ud.uid=u.mm_uid","left");
    $this->db->where("u.mm_uid NOT IN($allattemptusers) AND u.eamil_auth_status=1 AND u.user_status=1");
    $this->db->order_by($order);
    $query=$this->db->get();
    return $query->num_rows();
  }
  public function all_idle_user_data_list($limit,$offset,$title,$allattemptusers){
   if(!empty($title)){
        $this->db->where("u.mm_user_email LIKE '%$title%'");
    }
    $this->db->select('u.mm_uid,u.mm_user_full_name,u.mm_last_name,u.mm_user_email,u.reg_date,ud.contact_number');
    $this->db->from('user u');
    $this->db->join("user_data ud","ud.uid=u.mm_uid","left");
    $this->db->where("u.mm_uid NOT IN($allattemptusers) AND u.eamil_auth_status=1 AND u.user_status=1");
    $this->db->order_by("u.mm_uid desc");
    $this->db->limit($limit,$offset);
    $query=$this->db->get();
    return $query->result_array();
    
  }
  function get_neurons_per_day_data($date_from,$date_to){
    $this->db->select("s.created_date,u.mm_user_full_name,u.mm_user_email,s.neurons");
    $this->db->from("score s");
    $this->db->join("user u ","s.u_id=u.mm_uid","left");
    $this->db->where("s.created_date <=",$date_from);
    $this->db->where("s.created_date >",$date_to);
    $query=$this->db->get();
    return $query->num_rows();
 }
 function get_neurons_per_day_data_list($date_from,$date_to,$limit,$offset){
    $this->db->select("s.created_date,u.mm_user_full_name,u.mm_user_email,s.neurons");
    $this->db->from("score s");
    $this->db->join("user u ","s.u_id=u.mm_uid","left");
    $this->db->where("s.created_date <=",$date_from);
    $this->db->where("s.created_date >",$date_to);
    $this->db->limit($limit,$offset);
    $query=$this->db->get();
    return $query->result_array();
 }
  function get_process_generator_data($order_by,$title){
      $this->db->select("p.process_id,p.process_question,p.process_array,p.answer_array,p.row_count,p.column_count,p.topic,p.skill_tested,p.difficulty_level,t.t_name,s.skills_name");
    $this->db->from("mm_process_generator p");
    $this->db->join("master_topic t ","t.t_id=p.topic","left");
    $this->db->join("master_skills_test s ","s.skills_id=p.skill_tested","left");
    $this->db->where("p.status=1");if(!empty($title)){
          $this->db->where("p.topic=$title");
      }
    $query=$this->db->get();
    return $query->num_rows();
 }
 function get_process_generator_data_list($limit,$offset,$title){
     
    $this->db->select("p.process_id,p.process_question,p.process_array,p.answer_array,p.row_count,p.column_count,p.topic,p.skill_tested,p.difficulty_level,t.t_name,s.skills_name");
    $this->db->from("mm_process_generator p");
    $this->db->join("master_topic t ","t.t_id=p.topic","left");
    $this->db->join("master_skills_test s ","s.skills_id=p.skill_tested","left");
    $this->db->where("p.status=1");
    if(!empty($title)){
          $this->db->where("p.topic=$title");
      }
    $this->db->limit($limit,$offset);
    $query=$this->db->get(); //echo $this->db->last_query();
    return $query->result_array();
 }
public function all_reg_user_data_list_by_email($limit,$offset,$title){
   if(!empty($title)){
        $this->db->where("u.mm_user_email LIKE '%$title%' OR u.mm_user_full_name LIKE '%$title%'");
    }
    $this->db->select('u.*,ud.contact_number,ut.type_name');
    $this->db->from('user u');
    $this->db->join("user_type ut","ut.user_type_id=u.user_type_id","left");
    $this->db->join("user_data ud","ud.uid=u.mm_uid","left");
    $this->db->order_by('mm_uid desc');
    //$this->db->limit($limit,$offset);
    $query=$this->db->get();
    return $query->result_array();
    
  } 
  public function all_reg_user_data_list_by_email1($limit,$offset,$title){
   if(!empty($title)){
        $this->db->where("u.mm_user_email LIKE '%$title%' OR u.mm_user_full_name LIKE '%$title%'");
    }

    $this->db->select('u.*,ut.type_name');
    $this->db->from('user u');
    $this->db->join("user_type ut","ut.user_type_id=u.user_type_id","left");
    $this->db->order_by('mm_uid desc');
    $query=$this->db->get();
     echo "hai"; die;
    return $query->result_array();
    
  } 

  public function all_reg_user_data_list1($limit,$offset,$title){
   if(!empty($title)){
        $this->db->where('u.user_type_id',$title);
    }
    $this->db->select('u.*,ut.type_name, c.name as cityname, s.name as statename ,mb.board_name as board_name ,mb1.board_name as XIIBoard ,md.degree_name as gdegreename,mu.un_name as gun_name , md1.degree_name as pgdegreename , mu1.un_name as pgun_name');
    $this->db->from('user u');
    $this->db->join("user_type ut","ut.user_type_id=u.user_type_id","left");
    $this->db->join('user_data ud','u.mm_uid=ud.uid','left');
    $this->db->join('cities c','c.ci_id=ud.city','left');
    $this->db->join('states s','s.sid=ud.state','left');
    $this->db->join('master_board mb','mb.bid=ud.ssc_institution','left');
    $this->db->join('master_board mb1','mb1.bid=ud.hsc_institution','left');
    $this->db->join('master_degree md','md.md_id=ud.grad_degree','left');
    $this->db->join('master_university mu','mu.mu_id=ud.grad_institution','left');
    $this->db->join('master_degree md1','md1.md_id=ud.pg_degree','left');
    $this->db->join('master_university mu1','mu1.mu_id=ud.pg_institution','left');
	$this->db->where("u.mm_uid<2798");
   // $this->db->join("user_data ud","ud.uid=u.mm_uid","left");
    $this->db->order_by('mm_uid desc');
    $this->db->limit($limit,$offset);
    $query=$this->db->get();
    return $query->result_array();
    
  }
  
}
?>