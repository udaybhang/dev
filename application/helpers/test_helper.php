<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_assignment'))
{
    function get_list($id)
    {
    $ci =& get_instance();
		$ci->load->database();
		$ci->db->initialize();
       $ci->db->select('*');
       $ci->db->from('user');
       $ci->db->where('id',$id);
        $query =$ci->db->get();
        $result=$query->row();
       $ci->db->close();
        return $result;
		
		
    }
}
?>