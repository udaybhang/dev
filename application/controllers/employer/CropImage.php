<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CropImage extends MX_Controller {	
	public function __construct(){
			error_reporting(0);
			parent::__construct();
			$this->load->model('crud/Crud_modal');		
            $this->load->model('Employer_model');
            $this->load->model('admindashboard/Admindashboard_modal');
            $this->load->model('userdashboard/Userdashboard_modal');
            $this->load->helper('url');
			$this->load->library('session');
			$this->load->library('image_lib');
			$this->load->model('mailer/Mailer_model');
			$this->load->library('Phpmailer');			
    		$this->load->library('CropAvatar');
	}
	
    public function index(){
    	$crop=new CropAvatar();

		$crop->actions($this->input->post('avatar_src') , $this->input->post('avatar_data') , $_FILES['avatar_file']);
			$response = array(
			  'state'  => 200,
			  'message' => $crop -> getMsg(),
			  'result' => $crop -> getResult(),
			  'tmpimape' => $crop -> tmp_name()
			);
			 $fileParts = pathinfo($response['result']);
			print_r($fileParts); die;
			 if(!isset($fileParts['filename'])){
				 $fileParts['filename'] = substr($fileParts['basename'], 0, strrpos($fileParts['basename'], '.'));
			}			
		if($response['result']!=null){
			if($this->session->userdata('employer_id')!="" || $this->session->userdata('employer_id')!=null ){
                $uid=$this->session->userdata('employer_id');
                $where="`employer_id`='$uid'";
                $empdat=$this->Crud_modal->fetch_single_data('profile_pic','mm_employer',$where);
                $imgName='./upload/employer_upload/profile_pic/'.$empdat['profile_pic'];
                if($empdat['profile_pic']!=''){
                     unlink($imgName);
                }
               // echo $fileParts['basename']; die;
                 $field_user_data_tbl=array( 
                    'profile_pic'=>$fileParts['basename'],
                    );
                    $where_user_data="`employer_id`='$uid'";
					$this->Crud_modal->update_data($where_user_data,'mm_employer',$field_user_data_tbl);
                    // echo $response['tmpimape'].'---------'.$_FILES["avatar_file"]["tmp_name"]; die;
					 $this->load->library('Cloudinarylib');
                    $ex = explode('.',$fileParts['basename']); 
                    $new_name=$ex[0];
                    $url = base_url().'upload/employer_upload/profile_pic/'.$fileParts['basename'];
                    $cloudinaryImage = Cloudinary\Uploader::upload($url, ['use_filename' => true, 'unique_filename' => false, 'folder' => "upload/employer_upload/profile_pic","public_id" => $new_name]);

                }
		}
		echo json_encode($response);
			           
	}
	
		
}
?>