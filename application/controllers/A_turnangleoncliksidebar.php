<?php
/**
 * 
 */
class A_turnangleoncliksidebar extends CI_controller
{
	
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('B_turnangleoncliksidebar');
	}
	 function index()
	{
		
		$data['brand']=$this->B_turnangleoncliksidebar->fetch_brand();
		print_r($data['brand']);
		$this->load->view('turnanglesidebar', $data);
		
	}
 function load_data()

	{
		
  $tbl='product';
      	$b_id=$this->input->post('brand_id');
      	echo $b_id;
      	$where="brand_id='$b_id'";
      	 
		$pro=$this->B_turnangleoncliksidebar->all_data_select('*', $tbl, $where,'brand_id desc');		
		
	 	echo "<tr><th>product</th><th>id</th>";
	 	foreach($pro as $city){
			
			echo '<tr>
<td>'.$city["product_name"].'</td><td>'.$city["brand_id"].'</td>
			</tr>';
		 }
         
     
 }
}
?>