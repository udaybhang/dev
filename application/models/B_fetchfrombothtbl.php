<?php
/**
 * 
 */
class B_fetchfrombothtbl extends CI_Model
{
	
	public function fetchfromtwotbl()
	{
		$this->db->select('mm_job.job_name, mm_job.job_description, mm_employer.employer_name, mm_employer.employer_comany');
$this->db->from('mm_job');
$this->db->join('mm_employer', 'mm_job.employer_id = mm_employer.id');
$query = $this->db->get();
 return $query->result_array();
	}
}
?>