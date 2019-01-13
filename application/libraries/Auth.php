<?php    


/**
 * 
 */
class Auth 
{
	
	function token()
	{
		$this->ci =& get_instance();
		$token=md5(uniqid(rand(), true));
		$this->ci->session->set_userdata('token', $token);
		return $token;
	}
}

?>