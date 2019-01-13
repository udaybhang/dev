<?php   

class Validation extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
	}
	public function index()
	{
		$this->load->view('validation/form-submit-validation');
	}
	public function key_event_form_submit()
	{
		$this->load->view('validation/key_event_form-validation');
	}
	public function edit_package()
	{
		echo "form submit on change";
	}
	public function package_update()
	{
		try{
		
			// $this->form_validation->set_rules('package_name', 'Package name', 'required|trim|alpha');
			$this->form_validation->set_rules('validity', 'Validity', 'required|trim|is_natural');
			$this->form_validation->set_rules('total_marks', 'Total mark', 'required|trim|is_natural');
			$this->form_validation->set_rules('wallet_point', 'Wallet point', 'required|trim|is_natural');
			$this->form_validation->set_rules('time_limit', 'Time', 'required|trim|min_length[3]|max_length[5]');
			$this->form_validation->set_rules('lumens', 'Lumens', 'required|trim|is_natural');
			if($this->form_validation->run()==TRUE)
			{
				
            $insertdata['package_name']=trim($this->input->post('package_name'));
			
			$insertdata['validity']=trim($this->input->post('validity'));
			$insertdata['total_marks']=trim($this->input->post('total_marks'));
			$insertdata['wallet_points']=trim($this->input->post('wallet_point'));
			$insertdata['lumens']=trim($this->input->post('lumens'));
			
			$foo=$this->input->post('time_limit');
			if(preg_match("/^([[0-5][0-9]):[0-5][0-9]$/", $foo))
					{
						$time_limitt=$foo;
					}
					 else
					 {
					 	$this->session->set_flashdata('time_limit', 'time formate should be in hh:mm formate.');
						redirect('validation');
					 }
			//$insertdata['time_limit']=number_format((float)$foo, 2, '.', '');
			$insertdata['time_limit']=$time_limitt;
			
			
			$insertdata['created_date']=date('Y-m-d H:i:s');
			
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 2000;
         	$new_name = time().$_FILES["image"]['name'];
			$config['file_name'] = $new_name;

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image'))
                {
                	

                	$file=$this->upload->data();
                    $insertdata['image'] =$file['file_name'];
                    // $this->Crud_modal->data_insert('mm_packages',$insertdata);
                    // $this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Package Created</div>');
                }else{
                	
                	$error =$this->upload->display_errors();
                	$this->session->set_flashdata('error_message','<div class="danger" style="color:red;">'.$error.'</div>');            
                }
               
			echo "everything is correct";
			
			}
			else{
					 $this->index();
					
			    	}
			
		
		
	}
	catch(Exception $e){
		echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	}
	}
	
	public function php_validate_key_event_form_submit()
	{
	
	  	try
			{
				
			    	
			    	$this->form_validation->set_rules('assignment_name', 'Assignment name', 'required|trim|alpha');
		           $this->form_validation->set_rules('wallet_point', 'Wallet point', 'required|trim|is_natural');
		           $this->form_validation->set_rules('lumens', 'Lumens', 'required|numeric|trim|is_natural');
		           $this->form_validation->set_rules('time_limit', 'time', 'required|trim|min_length[3]|max_length[5]');
			    	if($this->form_validation->run()==TRUE)
			    	{
			    		
			   		$assign_name = $this->input->post('assignment_name');
					$assignment_description = $this->input->post('assignment_description');
					$assign_lvl = $this->input->post('assign_lvl');
					$start_date = $this->input->post('start_date');
					$end_date = $this->input->post('end_date'); 
					 $indone=date('d-m-Y', strtotime($start_date));
						 $indtwo=date('d-m-Y', strtotime($end_date));
						 if($indone>$indtwo)
						 {
						 	$this->session->set_flashdata('date_msg', 'start date shuold be less.');
						     redirect('validation-on-keypress');
						    //$this->key_event_form_submit();
						 }
					 $wallet_point = $this->input->post('wallet_point'); 
				 	$lumens = $this->input->post('lumens');
					$time_limit = $this->input->post('time_limit');
					if(preg_match("/^([[0-5][0-9]):[0-5][0-9]$/", $time_limit))
					{
						$time_limitt=$time_limit;
					}
					 else
					 {
					 	$this->session->set_flashdata('time_limit', 'time formate should be in hh:mm formate.');
						redirect('validation-on-keypress');
					 }
					//$time_limitt=number_format((float)$time_limit, 2, '.', '');
					
					$package_hrs=$this->input->post('package_hrs');
					$assign_date = date('Y-m-d H:i:s');
					
					
					
					$config['upload_path']          = './uploads/';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']      = 2000;
					$new_name = time().$_FILES["image"]['name'];
					$config['file_name'] = $new_name;

					$this->load->library('upload', $config);
					if ($this->upload->do_upload('image'))
					{
						$file=$this->upload->data();
						$createdata['image']=$file['file_name'];
						
						$ex = explode('.',$new_name); 
	                    $new_name=$ex[0];
	                   	$this->session->set_flashdata('assign_message','<div class="success"><strong>Success!</strong> Assignment Submitted</div>');
							// redirect(base_url().'validation-on-keypress');
					}else{
						//$error = array('error' => $this->upload->display_errors());
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('assign_message','<div class="danger" style="color:red;">'.$error.'</div>');
						 redirect(base_url().'validation-on-keypress');    
					}
	echo "good";
			    	}
			    	else{
					$this->key_event_form_submit();
			    	}
					
					
					
				
				}

				
			
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
	}
}

 ?>