<?php
/**
 * 
 */
class Book_m extends CI_Model
{
	
	public function book_insert($data)
	{

$this->db->insert('books', $data);
	}
	public function all_select()
	{
		$query=$this->db->get('books');
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	public function fetch_single($bookId)
	{
		$this->db->where('bookId',$bookId);	
		$query=$this->db->get('books');
		return $query->row();
	}
	public function update($id, $data)
	{
		$this->db->where('bookId', $id);
		$this->db->update('books', $data);
	}
	public function book_delete($bookId)
	{
		$this->db->where('bookId',$bookId);	
		$this->db->delete('books');
	}
}


 ?>