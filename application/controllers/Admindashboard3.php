<?php
class Admindashboard3 extends CI_Controller
{
 public  function __construct()
  {
    parent:: __construct();
    $this->load->model('Crud_modal');
  }
public function list_of_tkc() {
        
        $data['title'] = 'Display Feedback Data';
        $data['feedbackInfo'] = $this->Crud_modal->employeeList();
         
       
                    $this->load->view('list_of_tkc', $data);
       
    }

    }
?>