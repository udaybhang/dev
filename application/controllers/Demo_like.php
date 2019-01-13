<?php
class Demo_like extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('crud/Crud_modal');
	}
	public function index()
	{
		$data['post']=$this->Crud_modal->fetch_alls('posts','id asc');
		$this->load->view('demo-like', $data);
	}
	function getrating($id)
	{

		$rating = array();
 $where="post_id='$id' and rating_action='like'";
  $likes_query=$this->Crud_modal->all_data_select('COUNT("*") as ttl', 'rating_info', $where , 'post_id asc');
  $dislikes_query=$this->Crud_modal->all_data_select('COUNT("*") as ttl', 'rating_info', "post_id='$id' and rating_action='dislike'" , 'post_id asc');

     $rating = [
  	'likes' => $likes_query[0],
  	'dislikes' => $dislikes_query[0]
  ];
  print_r($rating);
  return json_encode($rating);
	}
	public function crud_like_dislike()
	{
		$user_id=3;
		$action=$this->input->post('action');
	  $post_id=$this->input->post('pid');
		switch($action)
		{
			case 'like' :
			
         	   $this->db->query("INSERT INTO rating_info (user_id, post_id, rating_action) 
         	   VALUES ($user_id, $post_id, 'like') ON DUPLICATE KEY UPDATE rating_action='like'");
         	   break;
         	   case 'dislike':
         	  
               $this->db->query("INSERT INTO rating_info (user_id, post_id, rating_action) 
               VALUES ($user_id, $post_id, 'dislike') ON DUPLICATE KEY UPDATE rating_action='dislike'");
               break;
               case 'unlike':
	      
	      $this->db->query("DELETE FROM rating_info WHERE user_id=$user_id AND post_id=$post_id");
	      break;
	      case 'undislike':
      	  
      	  $this->db->query("DELETE FROM rating_info WHERE user_id=$user_id AND post_id=$post_id");
      break;
  	default:
  		break;
		}
		echo $this->getrating($post_id);
  //exit(0);
	}
	
	
}