<?php
/**
 * 
 */
class BB_pagination extends CI_Model
{
	
	function fetch_alls($tblname,$orderby, $limit)
						{
							 try
									{
										    $this->db->initialize();
											$this->db->select('*');
											$this->db->from($tblname);
											$this->db->limit(5, $limit);
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
}
?>