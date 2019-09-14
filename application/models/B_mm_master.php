<?php
/**
 * 
 */
class B_mm_master extends CI_model
{
	function fetch_alls($tblname,$orderby)
						{
							 try
									{
										    $this->db->initialize();
											$this->db->select('*');
											$this->db->from($tblname);
								  	        $query = $this->db->order_by($orderby);
											$query = $this->db->get();
											$result=$query->result_array();
											$this->db->close();	
											return $result;
					   	}
						
		catch(Exception $e)
          {
              echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
          }
						}
						public function all_data_select($fields,$tbl_name,$where,$orderby)
						{
							try
					    {
					    	                 $this->db->initialize();
											$this->db->select($fields);
											$this->db->from($tbl_name);
											$this->db->where($where);
											$query = $this->db->order_by($orderby);
											$query = $this->db->get();
											$result=		$query->result_array();
											$this->db->close();	
											return $result;
					   	}
						
						catch(Exception $e)
          {
              echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
          }
						}
}
?>