			<?php
			class M_login extends CI_Controller
			{
			function __construct()
			{
			parent::__construct();
			$this->load->library('form_validation')	;
			$this->load->model('M_login_modal');
			}
			public function index()
			{
			$this->load->view('loginregister/m_login');
			}
			public function login_validation()
			{

			$this->form_validation->set_rules('email','Email', 'required|trim|callback_validate_credentials'); //first email is attribute of name in view(m_login) that occur in first under form_input() and second Email here is use for to show on validation for user(i.e Email field is required)
			$this->form_validation->set_rules('password', 'Password', 'required|md5');
			if($this->form_validation->run())
			{
			$data=array(
			'email'=>$this->input->post('email'),
			'is_logged_in'=>1
			);
			//print_r($data); die; //Array ( [email] => aaa@gmail.com [is_logged_in] => 1 ) from table
			$this->session->set_userdata($data);

			redirect('M_login/members');
			}
			else
			{
			$this->load->view('loginregister/m_login');
			}
			//echo $_POST['email']; // it print email addresss or
			//echo $this->input->post('email'); // both are same
			}
			public function members()
			{
			if($this->session->userdata('is_logged_in'))
			{
			$this->load->view('loginregister/members');
			}
			else{
			redirect('M_login/restricted');
			}
			}
			public function restricted()		
			{
			$this->load->view('loginregister/restricted');
			}
			public function validate_credentials()
			{
			if($this->M_login_modal->can_log_in())	
			{
			return true;
			}
			else
			{
			$this->form_validation->set_message('validate_credentials', 'incorrect username/password');
			return  false;
			}
			}
			public function logout()	
			{
			$this->session->sess_destroy();
			redirect('M_login/index');
			}
			public function signup()
			{
			$this->load->view('loginregister/M_signup');
			}
			public function signup_validation()
			{
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required|trim');
			$this->form_validation->set_rules('cpassword', 'Conferm Password', 'required|trim|matches[password]');
			if($this->form_validation->run())	
			{

			$result=$this->M_login_modal->register_user();
			if($result)
			{
			$this->session->set_flashdata('msg', 'record added successfully now login by credential');
			}
			else{
			$this->session->set_flashdata('error', 'failed to insert');	
			}
			redirect(base_url('M_login/index'));
			echo "pass";
			}
			else{
			echo "you shall not pass";
			$this->load->view('loginregister/M_signup');
			}
			}
			}
			?>