<?php
class Crud extends CI_Model{
  public function __construct()
  {
  	parent::__construct();  
  	
}
   public function user_insert($tbl, $userdata)
  {
 $query=$this->db->insert($tbl, $userdata);
 return $query;
 
  }
  public function login_data($tbl, $name, $password)
  {
  	$this->db->select('*');
  $this->db->from($tbl);
  $this->db->where('name',$name);
  $this->db->where('password',$password);
 
  if($query=$this->db->get())
  {
      return $query->row_array();
  }
  else{
    return false;
  }
}
public function select_all_data($tbl)  
{
$this->db->select('*');
  $this->db->from($tbl);
  $this->db->where('status','1');
  $query = $this->db->get();
  return $query->result_array();
}
public function fetch_single_data($tbl, $where)
{
	$this->db->select('*');
  $this->db->from($tbl);
  $this->db->where($where);
 $query=$this->db->get();
return $query->row_array();
}
public function update_form_field($table_name, $where, $edit)
{

	$this->db->where($where);
     $this->db->update($table_name, $edit);
}public function delete_to_status_zero($table_name, $where, $edit)
{

	 $this->db->where($where);
$this->db->update($table_name, $edit);
}
}
 ?>