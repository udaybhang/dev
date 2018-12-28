<?php
/**
 * 
 */
class Data_table extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('crud/Crud_modal');
	}
	public function index()
	{
            $data= $this->Crud_modal->fetch_alls('plan', 'plan_id asc');
          // echo sizeof($data); // 4
           $k=0;
           if (isset($k)) {
           	$i=0;
           	for($j=0; $j<sizeof($data); $j++)
           	{
                $a1[]=$data[$i]['plan_id'];
                $i++;
             $r=   implode(",",$a1 );
                
           	}
           }
           // echo $r; // 1,2,3,4
           $data['plan']=$r;
           // print_r($data['plan']);


		$this->load->view('datatable/main.php', $data);
	}
	public function date_filter()
   {

$where=$this->input->post('from_date');
 	  $res=	explode("/", $where);
 	  print_r($res);
  $first=$res[0];
   $second=$res[1];
  
   $third=$res[2];
 $datecreate=date_create();
 date_date_set($datecreate,$third,$first,$second);
 $pickone=date_format( $datecreate,"Y/m/d");
$where1=$this->input->post('to_date');
 $ress=	explode("/", $where1);
 	  
  $firs=$ress[0];
   $secon=$ress[1];
   $thir=$ress[2];
 $datecreat=date_create();
 date_date_set($datecreat,$thir,$firs,$secon);
 $picktwo=date_format( $datecreat,"Y/m/d");
$table_name="plan_member_history as s";
			$join1[0]='member as u';
			$join1[1]='s.member_id = u.member_id';
			$join1[2]="inner";
			 $where5="s.status=1";
			$all_subscriber=$this->Crud_modal->fetch_data_by_one_table_join_between('u.*,s.*',$table_name,$join1,$pickone, $picktwo, $where5);
			// print_r($data['all_subscriber']);
 // echo $this->db->last_query();
			$n=1;
			foreach($all_subscriber as $row)
			{
			echo '<tr>
					<td>'.$n.'</td>
					<td>'.$row['created_date'].'</td>
					<td>'.$row['member_name'].'</td>
					<td>'.$row['member_email'].'</td>
					<td>'."xxx".'</td>
					<td>'.$row['amount'].'</td>
					<td>'.$row['txt_id'].'</td>
					
			</tr>';
			$n++;
            }

   }

	public function  subscription_type_data()
   {
   
   	$subs_id=$this->input->post('subs_id');
   
   	$tbl_name='plan_member_history';
  	$where="plan_id in($subs_id)";
   
   	 $user_id=$this->Crud_modal->fetch_all_data('member_id',$tbl_name,$where);
   	
   	 // echo $this->db->last_query();
   	 $k=0;
   	 $tt='';
   	 foreach($user_id as $i)
   	 {
   	 	if($k == 0){
   	 		$tt.=$i['member_id'];
   	 	}else{
   	 		$tt.=",".$i['member_id'];
   	 	}
   	 	// $tt=implode(',', $i);
   	 	$k++;
   	 	
   	 }
   	// echo $tt;
   	//  die();
   	 // select mm_user_full_name, amount from user INNER join mm_user_transaction_history on mm_user_transaction_history.user_id = user.mm_uid where user_id IN(29,47,49,4)
   	  if($tt!='')
   	  {
   	 $table_name="plan_member_history as s";
			$join1[0]='member as u';
			$join1[1]='s.member_id = u.member_id';
			$join1[2]="inner";
			 $where1="s.member_id IN($tt)";
			$all_subscriber=$this->Crud_modal->fetch_data_by_one_table_join('u.*, s.*',$table_name,$join1,$where1);
			 echo $this->db->last_query();
			$n=1;
			foreach($all_subscriber as $row)
			{
			echo '<tr>
					<td>'.$n.'</td>
					<td>'.$row['created_date'].'</td>
					<td>'.$row['member_name'].'</td>
					<td>'.$row['member_email'].'</td>
					<td>'."xxx".'</td>
					<td>'.$row['amount'].'</td>
					<td>'.$row['txt_id'].'</td>
					
			</tr>';
			$n++;
            }

            }
               
            else{
            	 echo "no record found";
   
            }
   }

   
}
?>