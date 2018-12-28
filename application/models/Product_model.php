<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
	
/**
* Description of Product_model
*
* @author https://www.roytuts.com
*/

class Product_model extends CI_Model {		
	
	private $products = 'products';

	function get_salesinfo() {
		$query = $this->db->get($this->products);

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		
		return NULL;
	}
	
}
?>