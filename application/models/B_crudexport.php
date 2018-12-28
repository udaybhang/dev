<?php 
/**
 * 
 */
class B_crudexport extends CI_Model
{
	public function select_row($tbl, $id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$query=$this->db->get($tbl);
		return $query->row();
	}
	public function updateststus($tbl, $id, $status)
	{
		$this->db->where('id', $id);
         return $this->db->update($tbl, $status);
	}
	public function update_row($tbl, $id, $field)
	{

		$this->db->where('id', $id);
		return $query=$this->db->update($tbl, $field );
		

	}
public function all_insert($tbl, $data)	
{
	 return $this->db->insert($tbl, $data);
}
	public function select_all($tbl, $status)
	{
		$query =$this->db->select(['id', 'name', 'email', 'phone', 'message', 'image', 'status'])
                 ->from($tbl)
                 ->where('status', $status)
                
                 ->get();
                
                
        return $query->result(); //it return object of each row can use in controller $data['user'] and use in view $user as $row and print as $row->name;
	}
	
	public function num_rows($tbl, $status)
	{
		// $id=$this->session->userdata('id');
        $q=$this->db->select('*')
		->from($tbl)
	    ->where('status', $status)
		->get();
		return $q->num_rows();

	}
	public function select_all_pagination($tbl, $status, $limit, $offset)
	{
		$query =$this->db->select(['id', 'name', 'email', 'phone', 'message', 'image', 'status'])
                 ->from($tbl)
                 ->where('status', $status)
                 ->order_by('id','name')
                 ->limit($limit, $offset)
                 ->get();
                
                
        return $query->result();
	}
	// public function allrecord($title){
	// 	if(!empty($title)){
	// 		$this->db->like('test_title',$title);
	// 	}
	// 	$this->db->select('*');
	// 	$this->db->from('test');
	// 	$rs = $this->db->get();
	// 	return $rs->num_rows();
	// }
	
	// public function data_list($limit,$offset,$title){
	// 	if(!empty($title)){
	// 		$this->db->like('test_title',$title);
	// 	}
	// 	$this->db->select('*');
	// 	$this->db->from('test');
	// 	$this->db->order_by('test_id','desc');
	// 	$this->db->limit($limit,$offset);
	// 	$rs = $this->db->get();
	// 	return $rs->result_array();
	// }
	

}
?>