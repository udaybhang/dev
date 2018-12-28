<?php
/**
 * 
 */
class A_crudexport extends CI_controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('B_crudexport');
		$tbl='export';
		$this->tbl=$tbl;
		$status=1;
		$this->status=$status;
	}

	public function welcome()
	{
		$title=0;
		 $allrecord = $this->B_crudexport->num_rows($this->tbl, $this->status);
		$baseurl =  base_url().$this->router->class.'/'.$this->router->method."/".$title;
	    $paging=array();
		$paging['base_url'] =$baseurl;
		$paging['total_rows'] = $allrecord;
		$paging['per_page'] = 3;
		$paging['uri_segment']= 4;
		$paging['num_links'] = 5;
		$paging['first_link'] = 'First';
		$paging['first_tag_open'] = '<li>>';
		$paging['first_tag_close'] = '</li>';
		$paging['num_tag_open'] = '<li>';
		$paging['num_tag_close'] = '</li>';
		$paging['prev_link'] = 'Prev';
		$paging['prev_tag_open'] = '<li>';
		$paging['prev_tag_close'] = '</li>';
		$paging['next_link'] = 'Next';
		$paging['next_tag_open'] = '<li>';
		$paging['next_tag_close'] = '</li>';
		$paging['last_link'] = 'Last';
		$paging['last_tag_open'] = '<li>';
		$paging['last_tag_close'] = '</li>';
		$paging['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
		$paging['cur_tag_close'] = '</a></li>';
		
		$this->pagination->initialize($paging);	
		
		$data['limit'] = $paging['per_page'];
		$data['number_page'] = $paging['per_page']; 
        $data['offset'] = ($this->uri->segment(4)) ? $this->uri->segment(4):'0';	
        $data['nav'] = $this->pagination->create_links();
        // print_r( $data['nav']); die;
		$data['perpagerecord'] = $this->B_crudexport->select_all_pagination($this->tbl, $this->status, $data['limit'],$data['offset']);
		//print_r($data['perpagerecord']);
		// $this->load->view('pagination',$data);
 //print_r($perpagerecord);  die;// print_r karege tabhi dikhayeg nahi to array to string error aayegi; 
		       $this->load->view('layout/header');
		       $this->load->view('c_export/dashboard',$data);
		       $this->load->view('layout/footer');
	}
	public function dashboard()
	{   

		$data['perpagerecord']=$this->B_crudexport->select_all($this->tbl, $this->status);
		 $data['nav'] = $this->pagination->create_links();// not important for this purpose
		//print_r($data['user']); 
	    $this->load->view('layout/header');
		$this->load->view('c_export/dashboard', $data);
		$this->load->view('layout/footer');	
	}
	public function index()
	{

		$this->load->view('layout/header');
		$this->load->view('c_export/userinfo');
		$this->load->view('layout/footer');

	}
	public function delete()
	{
		   $id=$this->uri->segment(2); 
		  $result=$this->B_crudexport->updateststus($this->tbl, $id, array('status'=>0));

		  if($result)
		  {

		 echo "<script>confirm('do you want to delete record');	</script>";

		  	$this->session->set_flashdata('msg', 'record deleted sucessfully');
		  }
		  redirect('member', 'refresh');
	}
	public function update()
	{
		 $id=$this->uri->segment(2);
		$data['user']=$this->B_crudexport->select_row($this->tbl, $id);
		print_r($data['user']); // as a object yaha recieve ho raha hai yaha dikhega if recieve in $data only to bhi but want to show in another page must use $data['user'] now acess in view using $user->name;

		$this->load->view('layout/header');
		$this->load->view('c_export/update', $data);
		$this->load->view('layout/footer');
	}
	public function submitupdate()
	{
		 $id= $this->input->post('hidden_id');
		 $field=array(
'name'=>$this->input->post('name'),
'email'=>$this->input->post('email'),
'phone'=>$this->input->post('phone'),
'message'=>$this->input->post('message')

	);
		 $result=$this->B_crudexport->update_row($this->tbl, $id, $field); 
		 if($result)
		 {
		 	$this->session->set_flashdata('msg', 'record updated successfully.');
		 	 
		 }
		 redirect('member');
	}
	public function validate()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim|alpha');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[export.email]');
		$this->form_validation->set_rules('phone', 'Phone', 'required|numeric|trim|exact_length[10]');
		$this->form_validation->set_rules('message', 'Message', 'required|trim');
		// $this->form_validation->set_rules('image', 'Document', 'required');
		if($this->form_validation->run()==FALSE)
					{
// echo "hhi"; die;
						$this->index(); // yaha redirect aap nahi kar sakte
						//redirect('register'); // chalega lekin validation error nahi show hogi
}
		                else
		                	
		                {
                            /*  image upload statrt   */

                            if(!empty($_FILES['image']['name']))  
           {  
                $config['upload_path'] = './uploads/';  
                $config['allowed_types'] = 'jpg|jpeg|png|gif';  
                $this->load->library('upload', $config);  
                if(!$this->upload->do_upload('image'))  
                {  
                     echo $this->upload->display_errors();  
                }  
                else  
                {  
                     $data = $this->upload->data();  
                      $file_name = $data['file_name'];
                      
                   
                      // echo '<img src="'.base_url().'uploads/'.$data["file_name"].'" width="300" height="225" class="img-thumbnail" />';  
                } 
           }  
                            /* image upload end  */
                             
		                	 $data=array('name'=>$this->input->post('name'),
		                	 				'email'	=>$this->input->post('email'),
		                	 				'phone'=>$this->input->post('phone'),
		                	 				'message'=>$this->input->post('message'),
		                	 				'image'=>'abc' //need to come here $file name
		                	); 
		                	 $result=$this->B_crudexport->all_insert($this->tbl, $data);
		                	 	if($result)
		                	 	{
		                	 		$sessiondata=array(
		                	 				'name'=>$this->input->post('name'),
		                	 				'email'=>$this->input->post('email')
		                	 		);
		                	 		$this->session->set_userdata($sessiondata);
		                	 		redirect('member', 'refresh');
		                	 	}
		                	
		                }

}
public function export()
{
	$this->load->library('excel');
	$object=new PHPExcel();
    $object->setActiveSheetIndex(0);
    $tbl_column=array('Name', 'Email', 'Phone', 'Message', 'Status');
    $column=0;
    foreach($tbl_column as $colname)
    {
    	$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $colname);
    	$column++;
    }
$excel_data=$this->B_crudexport->select_all($this->tbl, $this->status);

$excel_row=2;
foreach($excel_data as $row)
  {
   

   $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->name);
   $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->email);
   $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->phone);
   $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->message);
   $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->status);
   $excel_row++;
  }
 $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="feedback Data.xls"');
        $object_writer->save('php://output');
}
}
?>