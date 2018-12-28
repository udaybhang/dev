
<?php
/**
 * 
 */
class Crud_modal extends CI_Model
{
	
	

public function employeeList()
	{
		$query =$this->db->select(['mm_uid','user_type_id','mm_user_full_name', 'mm_last_name','mm_user_email','mm_age','mm_higest_qualification','user_status','mm_auth_key','reg_date','user_password','eamil_auth_status','device_id','email_otp','signup','refferal'])
                 ->from('user')
                 ->like('mm_user_email', 'tkc')
                 ->get();
                
                
        return $query->result();
	}
	}
	?>