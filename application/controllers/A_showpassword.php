<?php
/**
 * 
 */
class A_showpassword extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('crud/Crud_modal');
		$this->load->model('B_fetchbyrangedate');
	}
	public function index()
	{
		$this->load->view('show-password');
	}
	public function add_dynemic_field()
	{
		$this->load->view('dynemic-add-remove-field');
	}
	public function name()
	{
$name=$_POST['name'];

$count = count($_POST['name']);



for($i=0; $i<$count; $i++) {
$data = array(
           'name' => $name[$i] );
$result=$this->db->insert('ckbox', $data);
if($result)
{
	echo "data insert success";
}
}
	}

	public function checkboxdelete()
	{
         $data['info']=$this->Crud_modal->fetch_alls('ckbox', 'id asc');
		$this->load->view('delete-by-checkbox', $data);
	}
	public function deletemultiplecheckbox()
	{
		$id=$_POST['id'];
		echo $id;
		foreach($_POST['id'] as $id)
		{
			$this->db->where('id', $id);
           $this->db->delete('ckbox');
		}

	}
public function date_range()
{
	$data['user']=$this->Crud_modal->fetch_alls('datefromselect', 'id asc');
	$this->load->view('select-date-range', $data);
}
public function fetch_date_range()
{
	if(isset($_POST['from_date'], $_POST['to_date']))
	{
		// echo "hello";
		$fdate=$_POST['from_date'];
		// echo $fdate; die;
		$tdate=$_POST['to_date'];
		$data=$this->B_fetchbyrangedate->data_select($fdate,$tdate);
		// Array ( [0] => Array ( [id] => 5 [name] => Christopher M. Victory [date_to] => 2018-03-03 [status] => 1 ) [1] => Array ( [id] => 6 [name] => Jessica G. Fischer [date_to] => 2018-05-18 [status] => 1 ) [2] => Array ( [id] => 7 [name] => Roger R. White [date_to] => 2018-02-25 [status] => 1 ) )
		// SELECT * FROM `datefromselect` WHERE `date_to` >= '2019-09-02' AND `date_to` <= '2019-09-12' AND `status` = '1'
		 
		if($data){
		foreach($data as $row)
		{
			echo '<tr>
                         <td>'.$row["name"].'</td>
                         <td>'.$row["date_to"].'</td>
                         <td>'.$row["status"].'</td>
			</tr>';
		}
		}
		else
	{
		echo "no record found";
	}
	}
	
}


}
?>
