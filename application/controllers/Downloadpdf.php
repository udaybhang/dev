<?php 
/**
 * 
 */
class Downloadpdf extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('crud/Crud_modal');
	}
	public function index()
	{
		$select = 's.*,u.mm_user_full_name,u.mm_user_email,p.plan_name';
		$where='status=1';
               $table_name="mm_user_transaction_history as s";
        			$join1[0]='user as u';
        			$join1[1]='s.user_id = u.id';
        			$join1[2]="left";
        			$join2[0]='mm_plans as p';
        						  $join2[1]='s.plan_id = p.id';
        						  $join2[2]="left";
        						

		$data['all_info']=$this->Crud_modal->fetch_data_by_two_table_join($select, $table_name,$join1,$join2,$where);
		// echo $this->db->last_query(); die;
		$this->load->view('downloadpdf', $data);
	}
	public function download_invoice()
	{
		$id=$this->uri->segment(2);
		$arr=explode('-', $id);////it returns array i.e Array ( [0] => 2 [1] => 1)
		// print_r($arr);
		$uid=$arr[0];
		$pid=$arr[1];
		$where="plan_id='$pid' and user_id='$uid'";
		$field="u.mm_user_full_name,u.mm_user_email,p.plan_name,s.invoice_id, s.amount,s.created_date, s.id";
               $table_name="mm_user_transaction_history as s";
        			$join1[0]='user as u';
        			$join1[1]='s.user_id = u.id';
        			$join1[2]="left";
        			$join2[0]='mm_plans as p';
    				$join2[1]='s.plan_id = p.id';
    				$join2[2]="left";
             $user_name['allinfo']=$this->Crud_modal->fetch_data_by_two_table_join($field, $table_name,$join1,$join2,$where);
		 $this->load->view('invoicefile', $user_name);
        
        // Get output html
        $html = $this->output->get_output(); //Permits you to manually retrieve any output that has been sent for storage in the output class.Note that data will only be retrievable from this function if it has been previously sent to the output class by one of the CodeIgniter functions like $this->load->view().


        
        // Load pdf library
        $this->load->library('pdf');
        
        // Load HTML content
        $this->dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper('A4', 'landscape'); //if you escape this line pdf page willl be srink from both left and write.
        
        // Render the HTML as PDF
        $this->dompdf->render();
        
        // Output the generated PDF (1 = download and 0 = preview)
        $this->dompdf->stream("welcome.pdf", array("Attachment"=>0));
	}
}
?>