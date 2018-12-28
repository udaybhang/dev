<?php
/**
 * 
 */
class m_modal extends CI_Model
{
	
	public function  insert_crud($data)
	{
		$this->db->insert('m_modal', $data);

	}
}

?>