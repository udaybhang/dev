<?php

/**
 * 
 */
class Ajax_datatable extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('crud/Crud_modal');
	}
	public function index()
	{
		$data['user']=$this->Crud_modal->fetch_alls('brand', 'brand_id asc');
		$this->load->view('ajax-datable', $data);
	}
	public function search_ajax_datatable()
	{
		$searchid=$this->input->post('searchid');
		$where="brand_id='$searchid'";
		$data=$this->Crud_modal->fetch_all_data('product_name,brand_id','product',$where);
		$html='';
		foreach ($data as $value) {
			$html.='<tr><td>'.$value['product_name'].'</td>
			<td>'.$value['brand_id'].'</td>
			</tr>';
		}
		echo json_encode($html);
	}
}
?>