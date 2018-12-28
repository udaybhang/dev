<?php  
/**
 * 
 */
class B_presentation extends CI_Model
{
	function fetch_data($query)
	{
		$this->db->select('cities');
		$this->db->from('cities');
		$this->db->like('cities', $query );
		return $this->db->get();
		
	}
	function fetch_mazercities()
	{
		$this->db->select('majorcities');
		$this->db->from('cities');
		
		$query=$this->db->get();
		return $query->result();
	}
}
?>