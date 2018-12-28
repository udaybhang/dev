<?php 
class Modal_crudpopup extends CI_model
{
	function __construct()
	{
		
	}
	public function add($data)
	{
$this->db->insert('modal', $data);
	}
	public function select_all_data()
	{$this->db->select('*');
  $this->db->from('modal');
 
  $query = $this->db->get();
  return $query->result_array();
	}
	public function fetch_single($id)
	{
		// $this->db->where('id',$id);	
		// $query=$this->db->get('modal');
		// return $query->result_array();
		$this->db->where('id',$id);	
		$query=$this->db->get('modal');
        return $query->result();
	}
	public function update($id, $data)
	{
		$this->db->where('id', $id);
		 return $this->db->update('modal', $data);
	}
	public function delete($id)
	{
        
		$this->db->where('id',$id);	
		return $this->db->delete('modal');

	}
}

?>