<?php 
/**
 * 
 */
class Comment_system extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('crud/Crud_modal');
	}
	public function index()
	{
		$this->load->view('comment-example');
	}
	public function add_comment()
	{

		$error = '';
   $comment_name = '';
   $comment_content = '';
	if(empty($_POST["comment_name"]))
{
	echo 1;
 $error .= '<p class="text-danger">Name is required</p>';
}
else
{
 $comment_name = $_POST["comment_name"];
}

if(empty($_POST["comment_content"]))
{
 $error .= '<p class="text-danger">Comment is required</p>';
}
else
{
 $comment_content = $_POST["comment_content"];
}

if($error == '')
{
 
 
 $field=
  array(
   'parent_comment_id' => $_POST["comment_id"],
   'comment'    => $comment_content,
   'comment_sender_name' => $comment_name
  
 );
 $this->Crud_modal->data_insert('tbl_comment',$field);
 $error = '<label class="text-success">Comment Added</label>';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);
	}
	public function fetch_comment()
	{
	$result = $this->Crud_modal->fetch_alls('tbl_comment', 'comment_id asc');
$array = (array) $result;
$output = '';
foreach($array as $row)
{
	
 $output .= '
 <div class="panel panel-default">
  <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
  <div class="panel-body">'.$row["comment"].'</div>
  <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
 </div>
 ';	
 $output .= $this->get_reply_comment($row["comment_id"]);
}

  echo $output;
}
function get_reply_comment($parent_id = 0, $marginleft = 0)
{
	$output='';
 // $query = "
 // SELECT * FROM tbl_comment WHERE parent_comment_id = '".$parent_id."'
 // ";
 $result=$this->Crud_modal->fetch_all_data('*','tbl_comment', "parent_comment_id='$parent_id'");
 //echo $this->db->last_query();
 // print_r($result); die;
 $count=$this->Crud_modal->check_numrow('tbl_comment',"parent_comment_id='$parent_id'");
 //$count = $statement->rowCount();
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 48;
 }
 if($count > 0)
 {
  foreach($result as $row)
  {
   $output .= '
   <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
    <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
    <div class="panel-body">'.$row["comment"].'</div>
    <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
   </div>
   ';
   $output .= $this->get_reply_comment($row["comment_id"], $marginleft);
  }
 }
 return $output;
}
	}

?>