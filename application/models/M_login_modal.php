					<?php  
					/**
					* 
					*/
					class M_login_modal extends CI_Model
					{

					public function can_log_in()
					{
					$this->db->where('email', $this->input->post('email'));  // it check from database
					$this->db->where('password', $this->input->post('password')); // itcheck from database
					$query= $this->db->get('m_register');
					if($query->num_rows()==1)
					{
					return true;
					}
					else{
					return false;
					}
					}
					public function register_user()
					{
					$data=array(
					'name'=>$this->input->post('name'),
					'email'=>$this->input->post('email'),
					'password'=>$this->input->post('password')
					);
					$this->db->insert('m_register', $data);
					if($this->db->affected_rows()>0)
					{
					return true;
					}
					else
					{
					return false;
					}
					}
					}

					?>