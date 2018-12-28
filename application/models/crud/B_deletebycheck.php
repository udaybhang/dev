<?php /**
 * 
 */
class B_deletebycheck extends CI_Model
{
	
	public function fetch_all_data($fields,$tbl_name,$where){
    	                        $this->db->initialize();
                                $this->db->select($fields);
                                $this->db->from($tbl_name);
                                   $this->db->where($where);
                                $query = $this->db->get();
                                $result=$query->result_array();
                                $this->db->close();
                                return $result;
                        }
						public function check_numrow($tblname,$where){
							$this->db->initialize();
							$query=$this->db->select('*')->from($tblname)->where($where)->get();
							

							return $query->num_rows();
							$this->db->close();	
						}
						function update_data($where,$tblname,$field)
						{
							 try
					       {
					       	$this->db->initialize();
													 $this->db->where($where);
													 	
              $update=  $this->db->update($tblname,$field);
             // echo 	 $this->db->last_query();
													//	exit;
              $this->db->close();	
														return $update;
					      	}
						
				   		catch(Exception $e)
          {
              echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
          }
						}

} 


?>