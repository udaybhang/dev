<?php  
/**
 * 
 */
class A_imageupload extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('B_imageupload');
	}
	
    
    function add(){
        if($this->input->post('userSubmit')){
            
            //Check whether user upload picture
            //echo $_FILES['picture']['name']; // actual name bethought full path like abc.png
            if(!empty($_FILES['picture']['name'])){
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['picture']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture')){
                     // $this->upload->do_upload('picture') // true/false
                    $uploadData = $this->upload->data();
                   //$uploadData==> //Array ( [file_name] => swagger17.png [file_type] => image/png [file_path] => /var/www/html/dev/uploads/ [full_path] => /var/www/html/dev/uploads/swagger17.png [raw_name] => swagger17 [orig_name] => swagger.png [client_name] => swagger.png [file_ext] => .png [file_size] => 138.35 [is_image] => 1 [image_width] => 1366 [image_height] => 768 [image_type] => png [image_size_str] => width="1366" height="768" )
                   
                    $picture = $uploadData['file_name'];
                }else{
                    $picture = '';
                }
            }else{
                $picture = '';
            }
            
            //Prepare array of user data
            $userData = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'photo' => $picture
            );
            
            //Pass user data to model
            $insertUserData = $this->B_imageupload->insert($userData);
            
            //Storing insertion status message.
            if($insertUserData){
                $this->session->set_flashdata('success_msg', 'User data have been added successfully.');
            }else{
                $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
            }
        }
        //Form for adding user data
        $this->load->view('imageupload');
    }
}
?>