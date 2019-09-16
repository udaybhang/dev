<?php
/**
 * 
 */
class C_popupcrud extends CI_controller
{
	
	function __construct()
	{
		parent :: __construct();
       $this->load->model('Modal_crudpopup');
	}
		public function add()
	{
		$data=array(
'name'=>$this->input->post('name'),
'email'=>$this->input->post('email'),
'phone'=>$this->input->post('phone')
		);
		// print_r($data); 
	$this->Modal_crudpopup->add($data);
	}
	public function all_data()
	{
		$data['user']=$this->Modal_crudpopup->select_all_data();
		//print_r($data['user']);  die; // print Array ( [0] => Array ( [id] => 1 [name] => fdfd [email] => fffd ))
		$this->load->view('D_crudpopup/profile_user', $data);
	}
	public function update()
	{
		 $id=$this->input->post('id');
		 //echo $id; die; // work well
		$data = array(
				'name'=> $this->input->post('name'),
				'email'=> $this->input->post('email'),
				'phone'=> $this->input->post('phone')
				);
		//print_r($data); die; // it return key value associative array work well
		$result=$this->Modal_crudpopup->update($id, $data);
		if($result){
		echo 'record updated sucessfully';  
		
	}
		// echo "record updated sucessfully"; // dikhega nahi
		//redirect(base_url('Book/profile')); // ye line bhi nahi chalegi
		// $this->Modal_popup->update();
	}
	public function delete()
	{
		 $id=$this->input->post('id'); // work well
		$result= $this->Modal_crudpopup->delete($id);
		if($result)
		{
			echo "record deleted sucessfully";
		}
	}
	public function fetch_single()
	{
		$id=$this->input->post('id'); //$_POST['id']== $id
		// echo $id; die();
		// $output= array();
		$data=$this->Modal_crudpopup->fetch_single($id); 
		
// foreach($data as $row)
// {
// $output['name']= $row->name;
// $output['email']= $row->email;
// $output['phone']= $row->phone;

// }
$re = '<form method="post" id="update_form">
					<div class="input-group">
						<label>Name:</label>
		<input type="text" name="name" class="form-control" id="name1" value="'.$data[0]->name.'">
		</div>
		<div class="input-group">
		<label>Email</label>
		<input type="text" name="email" class="form-control" id="email1" value="'.$data[0]->email.'">
		</div>
		<div class="input-group">
		<label>Phone</label>
		<input type="number" name="Phone" class="form-control" id="phone1" value="'.$data[0]->phone.'">
		</div>
		
		<button type="button" name="update"  id="'.$data[0]->id.'" class="btn btn-success update" >Update</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		
	</form>';
echo $re;//convert php array to php string
	}
}
?>