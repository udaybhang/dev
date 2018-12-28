<?php

/**
 * Description of User
 *
 * @author roytuts.com
 */
class UserModel extends CI_Model {

    private $user_table = 'multistepregister';

    function __construct() {
        parent::__construct();
    }

    function insert_user($name, $password, $email, $phone, $gender, $dob, $address) {
        $data = array('name' => $name, 'password' => md5($password), 'email' => $email, 'phone' => $phone, 'gender' => $gender, 'dob' => $dob, 'address' => $address);
        $result = $this->db->insert($this->user_table, $data);
        if ($result !== NULL) {
            return TRUE;
        }
        return FALSE;
    }

}