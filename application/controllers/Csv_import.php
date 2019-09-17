<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Csv_import extends CI_Controller {
 
 public function __construct()
 {
  parent::__construct();
  $this->load->model('csv_import_model');
   $this->load->library('Csvimport');
 }

 function index()
 {
  $this->load->view('csv_import');
 }

 function load_data()
 {
  $result = $this->csv_import_model->select();
    // SELECT * FROM `tbl_user` ORDER BY `id`
  
  // echo $result->num_rows(); die; // it return number of row
  $output = '
   <h3 align="center">Imported User Details from CSV File</h3>
        <div class="table-responsive">
         <table class="table table-bordered table-striped">
          <tr>
           <th>Sr. No</th>
           <th>First Name</th>
           <th>Last Name</th>
           <th>Phone</th>
           <th>Email Address</th>
          </tr>
  ';
  $count = 0;
  if($result->num_rows() > 0)
  {
   foreach($result->result() as $row)
   {
    $count = $count + 1;
    $output .= '
    <tr>
     <td>'.$count.'</td>
     <td>'.$row->first_name.'</td>
     <td>'.$row->last_name.'</td>
     <td>'.$row->phone.'</td>
     <td>'.$row->email.'</td>
    </tr>
    ';
   }
  }
  else
  {
   $output .= '
   <tr>
       <td colspan="5" align="center">Data not Available</td>
      </tr>
   ';
  }
  $output .= '</table></div>';
  echo $output;
 }

 function import()
 {
 	 // echo $_FILES["csv_file"]["tmp_name"]; die;
  $file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
//Array ( [0] => Array ( [first_name] => parwesh [last_name] => yadav [phone] => 7838576354 [email] => parwesh@gmail.com ) )
  foreach($file_data as $row)
  {
   $data[] = array(
          'first_name' => $row["first_name"],     //second first_name is column name  value of excel sheet 
          'last_name'  => $row["last_name"],
          'phone'   => $row["phone"],
          'email'   => $row["email"]
   );
  }
  $this->csv_import_model->insert($data);
 }
 
  
}