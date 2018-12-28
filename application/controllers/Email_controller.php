<?php 
   class Email_controller extends CI_Controller { 
 
      function __construct() { 
         parent::__construct(); 
         $this->load->library('session'); 
         $this->load->helper('form'); 
         $this->load->library('Phpmailer');
         $this->load->model('Mailer_model');

      } 
      
      public function index() { 
   
         $this->load->helper('form'); 
         $this->load->view('email_form'); 
      } 
  
      public function send_mail() { 
         // echo "hi"; die;
         $name=$this->input->post('name');
         $from=$this->input->post('from');
         $to=$this->input->post('to');
         $subject=$this->input->post('subject');
         $message=$this->input->post('textarea');
         echo $this->Mailer_model->testmail($to,$subject,$message);
         // print_r($_POST);
         
         }
   } 
?>