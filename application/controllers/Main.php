<?php 
class Main extends CI_Controller
{
	public function __construct(){
        parent::__construct();
  	$this->load->model('Crud');        
  	
      
}
public function index()
{
	
	$this->load->view('template/header');
		$this->load->view('reg');
	 $this->load->view('template/footer');
}
public function user_register()
{	
	$tbl='user_register';
	$userdata = array('name'=>$this->input->post('name'),
	'email'=>$this->input->post('email'),
	'password'=>$this->input->post('password') );
	$result=$this->Crud->user_insert($tbl, $userdata);
	if($result)
	{

		redirect('login-form');
		}
	}
	public function form_login()
	{
		$this->load->view('template/header');
		$this->load->view('login_form');
	    $this->load->view('template/footer');
	}
	public function user_login()
	{
		$tbl='user_register';
		$logindata= array(
'name'=>$this->input->post('name'),
'password'=>$this->input->post('password')
		);
		$login_match=$this->Crud->login_data($tbl, $logindata['name'], $logindata['password']);
		if($login_match)

		{
			$this->session->set_userdata('name', $login_match['name']);
			$this->profile();
		}
	}
public function profile()
{
	$tbl='user_register';
	$profile['user']=$this->Crud->select_all_data($tbl);

	
	    $this->load->view('template/header');
		$this->load->view('user_profile', $profile);
	    $this->load->view('template/footer');
}
public function update_row()
{
	$tbl='user_register';
	$id = $this->uri->segment(2);
  $where="id='$id'";
$data['user_data']=$this->Crud->fetch_single_data($tbl, $where);
  
        $this->load->view('template/header');
		$this->load->view('update_form', $data);
	    $this->load->view('template/footer');
}
public function update_form_data()
{
	$tbl='user_register';
	  $id = $this->input->post('hidden_id'); 
    $where="id='$id'"; 
    $user=array(
      'name'=>$this->input->post('name'),
      'email'=>$this->input->post('email'), 
      'password'=>$this->input->post('password')
       );
     $this->Crud->update_form_field($tbl, $where, $user);
redirect('Main/profile', 'refresh') ;

}
public function delete_row()
{
	$id = $this->uri->segment(2); 
  $table_name='user_register';
 $data['user_data']=$this->Crud->delete_to_status_zero($table_name, "id='$id'", array('status'=>0));
   redirect('Main/profile', 'refresh');
}
}

?>