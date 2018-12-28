<?php

class Blog extends CI_Controller {
	 function __construct()
	 {
	 	parent:: __construct();
	 	$this->load->model('Blog_m');
	 }

        public function index() {
        	$data['blog']= $this->Blog_m->getBlog();
        	//print_r($data); // yese directly $data jayega index page per isko view ke saath lagakar $data bhejege par isse pahle $data['user'] karke store karayege; aur foreach loop se access karege
        	$this->load->view('template/header');
           $this->load->view('blog/index', $data);
           $this->load->view('template/footer');
        }
        public function add()
        {
        $this->load->view('template/header');
           $this->load->view('blog/add');
           $this->load->view('template/footer');	
        }
        public function submit()
        {
        	$result=$this->Blog_m->submit();
        	if($result)
        	{
        		$this->session->set_flashdata('msg', 'record added successfully');
        	}
        	else{
        	$this->session->set_flashdata('error', 'failed to insert');	
        	}
        	redirect(base_url('Blog/index'));
        }
        public function edit()
        {
        	$id=$this->uri->segment(3);
        	//echo $id; die;
        	$data['blog']=$this->Blog_m->getBlogById($id);
        	print_r($data['blog']);
        $this->load->view('template/header');
           $this->load->view('blog/edit', $data);
           $this->load->view('template/footer');		
        }
        public function update()
        {
        	$id=$this->input->post('hidden_id');
        	$result=$this->Blog_m->update($id); // chahe aap yahi likho ya model pe bhi ise aap get kar sakate hai
        	//print_r($result); die; output 1
        	if($result)
        	{
        		$this->session->set_flashdata('msg', 'record updated successfully');
        	}
        	else{
        	$this->session->set_flashdata('error', 'failed to update ');	
        	}
        	redirect(base_url('Blog/index'));
        }
        public function delete()
        {
        	$id=$this->uri->segment(3);
        	$result=$this->Blog_m->delete($id);
        	if($result)
        	{
        		$this->session->set_flashdata('msg', 'record deleted successfully');
        	}
        	else{
        	$this->session->set_flashdata('error', 'failed to delete ');	
        	}
        	redirect(base_url('Blog/index'));
        }
}
?>