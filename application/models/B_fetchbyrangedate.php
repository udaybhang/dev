<?php 
/**
 * 
 */
class B_fetchbyrangedate extends CI_Model
{
	
	public function data_select($fdate,$tdate){

    $this->db->select('*');
    $this->db->from('datefromselect');
    $this->db->where('date_to >=',$fdate);
    $this->db->where('date_to <=',$tdate);
    $this->db->where('status =','1');
    $query = $this->db->get();
    $result=$query->result_array();
    return $result;
}
}
?>