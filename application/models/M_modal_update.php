<?php
/**
 * 
 */
class M_modal_update extends CI_Model
{
	
	public function  insert_crud($data)
	{
		$this->db->insert('m_modal', $data);

	}
	public function fetch_single_user($user_id)
	{
$this->db->where('id', $user_id);
$query=$this->db->get('users');
return $query->result();


	}
}

?>