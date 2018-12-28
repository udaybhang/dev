<?php
/**
 * 
 */
class Dynemicddatatbl extends CI_Controller
{
	
	function __construct()
	{
		
		parent:: __construct();
		$this->load->model('crud/Crud_modal');
	}
	public function index()
	{
		$data['history']=$this->Crud_modal->fetch_alls('plan_member_history', 'id asc');

		$this->load->view('Dynemicdatatbl', $data);
	}
	public function find_plan()
	{
		$id=$this->input->post('id');
		$where="plan_id='$id'";
		$recordbyid=$this->Crud_modal->all_data_select('*','plan_member_history',$where, 'plan_id asc');
		// print_r($data['recordbyplan']);
		foreach($recordbyid as $row)
			{
			$table_data  =  '';
			$table_data .= '<tr>
			<td>'.$row['invoice_no'].'</td>
					<td>'.$row['amount'].'</td>
					<td>'.$row['plan_id'].'</td>
					
			</tr>';
			
            }
echo json_encode($table_data);
}
}
?>