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
		// Array ( [0] => Array ( [brand_id] => 1 [brand_name] => Samsung ) [1] => Array ( [brand_id] => 2 [brand_name] => Sony ) [2] => Array ( [brand_id] => 3 [brand_name] => Motorola ) [3] => Array ( [brand_id] => 4 [brand_name] => Xiaomi ) )
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