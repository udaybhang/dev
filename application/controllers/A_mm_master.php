<?php
/**
 * 
 */
class A_mm_master extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$tbl='mm_master_job';
		$this->tbl=$tbl;
		$this->load->model('B_mm_master');
	}
	public function index()
	{
        $orderby='name';
		$data['detail']=$this->B_mm_master->fetch_alls($this->tbl, $orderby);
		// Array ( [0] => Array ( [id] => 2 [name] => gajendar [course] => html [state_id] => 1 [status] => 1 ) [1] => Array ( [id] => 3 [name] => rampravesh [course] => dotnet [state_id] => 2 [status] => 1 ) [2] => Array ( [id] => 4 [name] => sohan [course] => bigdata [state_id] => 2 [status] => 1 ) [3] => Array ( [id] => 1 [name] => udaybhan [course] => java [state_id] => 1 [status] => 1 ) )
		$this->load->view('mm_master', $data);
	}
function edit_master()
{
	 $this->uri->segment(2);
	$tbl='state';
	$orderby='state asc';
	$data['state']=$this->B_mm_master->fetch_alls($tbl, $orderby);
	//print_r($data['state']);
	
	$this->load->view('mm_master_edit', $data);
}
function fetch_city()
 {
 	$id=$this->input->post('state_id');
 	//echo $id; die;
 	$tbl='city';
 // 	$output='';
  	$where="state_id='$id'";
 //   if($this->input->post('state_id'))
 //   {
 //   $data=$this->B_mm_master->fetch_all_data('*', $tbl, $where);
 //   foreach($data as $row)
 //  {
 //   $output .= '<option value="'.$row['id'].'">'.$row['city'].'</option>';
 //  }
 //  return $output;
 //   }
 // }
 	$city=$this->B_mm_master->all_data_select('*', $tbl, $where,'id desc');		
		echo '<option value="">---Select City---</option>';
	 	foreach($city as $city){
			$city_id=$city['id'];
			$city_nam= $city['city'];
			echo '<option value="'.$city_id.'">'.$city_nam.'</option>';
		 }
}
}

?>