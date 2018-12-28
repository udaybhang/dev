<?php

class Book extends CI_Controller {
	 function __construct()
	 {
	 	parent:: __construct();
	 	$this->load->model('Book_m');
	 }
public function index()
{
	 $this->load->view('book/book_view');
}
        public function insert_book() {
        	$data = array(
				'bookId'=> $this->input->post('bookId'),
				'bookName'=> $this->input->post('bookName'),
				'price'=> $this->input->post('bookPrice')
				);
        	//print_r($data); die;
		$this->Book_m->book_insert($data);

		
	}
	
      public function profile()  	
      {
      	$data['book']=$this->Book_m->all_select();
      	$this->load->view('book/profile', $data);
      }
      public function update_book()
	{
			
		$bookId = $this->uri->segment(3);
		
		
		 $data['book']=$this->Book_m->fetch_single($bookId);
		 $this->load->view('book/update', $data);
		 // echo "Book Updated Successfully!";
	}
	public function update()
	{
		 $id=$this->input->post('bookId'); 
		$data = array(
			    
				'bookName'=> $this->input->post('bookName'),
				'price'=> $this->input->post('bookPrice')
				);
		//print_r($data); die; // it return key value associative array
		$this->Book_m->update($id, $data);
		// echo "record updated sucessfully"; // dikhega nahi
		//redirect(base_url('Book/profile')); // ye line bhi nahi chalegi
        }
        public function delete()
        {
        			$bookId = $this->input->post('bookId');
		
		$this->Book_m->book_delete($bookId);
		
        }

	}

?>
