            <?php 
            class Admindashboard extends CI_Controller
            {

            function __construct()
            {
            parent:: __construct();
            $this->load->model('crud/Crud_modal');
            }
            public function user_subscription_report()
            {
            $data= $this->Crud_modal->fetch_alls('mm_plans', 'id asc');
            // Array ( [0] => Array ( [id] => 1 [plan_name] => premium ) [1] => Array ( [id] => 2 [plan_name] => classical ) [2] => Array ( [id] => 3 [plan_name] => free ) [3] => Array ( [id] => 4 [plan_name] => prime member ) )
            $k=0;
            $table='mm_plans';
            $data['member_type']=$this->Crud_modal->fetch_alls($table, 'id asc');

            $table_name="mm_user_transaction_history as s";
            $join1[0]='user as u';
            $join1[1]='s.user_id = u.id';
            $join1[2]="inner";
            if($this->input->post('from_date') !='' && $this->input->post('to_date') !=''){
            $start_from=date('Y-m-d', strtotime($this->input->post('from_date')));  
            $to=date('Y-m-d', strtotime($this->input->post('to_date'))); 
            $diff=date_diff(new DateTime($start_from),new DateTime($to)); // return object
            print_r($diff);
            $date_diff = $diff->format("%a"); // 7 output
            if($date_diff>60){
            $start_from=date('Y-m-d', strtotime('-7 days'));
            $to=date('Y-m-d');
            $this->session->set_flashdata('error_message', 'Date should be less than 60 days.');
            }
            }else{
            $start_from=date('Y-m-d', strtotime('-7 days'));
            $to=date('Y-m-d');
            $this->session->set_flashdata('error_message', '');
            }

            $where = "created_date >='$start_from' and created_date <='$to'";
            $data['all_subscriber']=$this->Crud_modal->fetch_data_by_one_table_join('u.*, s.*',$table_name,$join1, $where);
            //SELECT `u`.*, `s`.* FROM `mm_user_transaction_history` as `s` INNER JOIN `user` as `u` ON `s`.`user_id` = `u`.`id` WHERE `created_date` >= '2019-07-12' and `created_date` <= '2019-09-28'
            $this->load->view('user-supbscription-report', $data);

            }
            public function  user_subscription_report_ajax()
            {
            $subs_id=$this->input->post('subs_id');
            $table_data='';
            if($subs_id=='Top-up'){
            $where1="s.txn_type='2'";

            }else if($subs_id=='all'){
            $where1="s.txn_type!='2'";

            }else{
            $where1="s.plan_id='$subs_id'";
            }
            $table_name="mm_user_transaction_history as s";
            $join1[0]='user as u';
            $join1[1]='s.user_id = u.id';
            $join1[2]="left";
            if($subs_id=='all'){
            $select = 's.*,u.mm_user_full_name,u.mm_user_email,p.plan_name';
            $join2[0]='mm_plans as p';
            $join2[1]='s.plan_id = p.plan_id';
            $join2[2]="left";
            $all_subscriber=$this->Crud_modal->fetch_data_by_two_table_join($select,$table_name,$join1,$join2,$where1);

            }else{
            $select = 'u.*, s.*';

            $all_subscriber=$this->Crud_modal->fetch_data_by_one_table_join($select,$table_name,$join1,$where1);
            }
            $n=1;
            $table_data  .=  '<table id="example" class="display nowrap" style="width:100%" >';
            $table_data.='<thead>
            <tr>
            <th>S.No</th>
            <th>Date</th>
            <th>Name</th>
            <th>Email</th>';
            if($subs_id=='all'){
            $table_data.='<th>Plan Name</th>';
            }

            $table_data.='<th>Invoice No</th>
            <th>Amount</th>
            <th>Transaction Id</th>
            </tr>
            </thead>';
            $table_data.='<tbody id="subscriberdata">';
            foreach($all_subscriber as $row)
            {
            $table_data .= '<tr>
            <td>'.$n.'</td>
            <td>'.$row['created_date'].'</td>
            <td>'.$row['mm_user_full_name'].'</td>
            <td>'.$row['mm_user_email'].'</td>';
            if($subs_id=='all'){
            $table_data.='<td>'.$row['plan_name'].'</td>';
            }
            $table_data .= '<td>'.$row['invoice_id'].' <a href='.base_url().'view-invoice/'.rtrim(strtr(base64_encode($row['txnid']), '+/', '-_'), '=').'-'.rtrim(strtr(base64_encode($row['plan_id']), '+/', '-_'), '=').'>Download</a> </td>
            <td>'.$row['amount'].'</td>
            <td>'.$row['txnid'].'</td>

            </tr>';
            $n++;
            }
            $table_data .='</tbody></table>';
            $whre="status=1";
            $datelength=$this->Crud_modal->fetch_all_data('MIN(created_date) as minidate, MAX(created_date) as maxidate','mm_user_transaction_history', $whre);

            foreach( $datelength as $row)
            {
            $xyv=$row['minidate'];
            $xyvv=$row['maxidate'];
            }
            $ff= date('m-d-Y', strtotime($xyv));
            $tt= date('m-d-Y', strtotime($xyvv));
            $wh="id='$subs_id'";
            $curplan=$this->Crud_modal->all_data_select('plan_name', 'mm_plans', $wh, 'id asc');
            foreach ($curplan as $value) {
            $plannm=$value['plan_name'];
            }
            echo json_encode(['tabledata'=>$table_data, 'plan'=>$plannm, 'datestart'=>$ff, 'dateend'=>$tt]);
            }

            public function user_cashback_report()
            {
            $table_name="mm_cashback as s";
            $join1[0]='user as u';
            $join1[1]='s.user_id = u.mm_uid';
            $join1[2]="left";
            $select = 's.*,u.mm_user_full_name,u.mm_user_email,p.lvl_name';

            $join2[0]='master_level as p';
            $join2[1]='s.against_id = p.ml_id';
            $join2[2]="left";
            $now=date('Y-m-d', strtotime($this->input->post('from_date')));

            // $where = "get_date >='$yesterday' and get_date <='$now'";
            $where = "get_date>='$now'";
            $data['all_cashback']=$this->Crud_modal->fetch_data_by_two_table_join($select,$table_name,$join1, $join2, $where);
            //SELECT `s`.*, `u`.`mm_user_full_name`, `u`.`mm_user_email`, `p`.`lvl_name` FROM `mm_cashback` as `s` LEFT JOIN `user` as `u` ON `s`.`user_id` = `u`.`mm_uid` LEFT JOIN `master_level` as `p` ON `s`.`against_id` = `p`.`ml_id` WHERE `get_date` >= '1970-01-01'
            $wh="get_date >='$now'";


            $data['cashback1']=$this->Crud_modal->all_data_select('sum( amount) as amount', 'mm_cashback', $wh, 'id asc');

            $this->load->view('user-cashback', $data);

            }

            public function user_cashback_date_report()
            {


            $where.='""';
            $submitsearch=$this->input->post('search');
            if($submitsearch == 'Search')
            {
            $calendarfrom=date('Y-m-d', strtotime($this->input->post('from_date')));
            $calendarto=date('Y-m-d', strtotime($this->input->post('to_date')));
            $data['from']=date('m/d/Y', strtotime($calendarfrom));
            $data['to']=date('m/d/Y', strtotime($calendarto));
            if($calendarto>=$calendarfrom && $calendarto<=date("Y-m-d", strtotime(date("Y-m-d"))))
            {
            if(1)
            {

            $where="get_date>='$calendarfrom' and get_date<='$calendarto'";

            }
            else{
            $calendarto=date("Y-m-d", strtotime(date("Y-m-d")));
            $calendarfrom = date('Y-m-d', strtotime($now .' -5 day'));

            $where="get_date>='$calendarfrom' and get_date<='$calendarto'";
            }

            }
            else{
            $data["message"]="date should be less then current date";
            }
            }

            else
            {
            $calendarto=date("Y-m-d", strtotime(date("Y-m-d")));
            $calendarfrom = date('Y-m-d', strtotime($now .' -5 day'));

            $data['from']= date('m/d/Y', strtotime($calendarfrom));
            $data['to']= date('m/d/Y', strtotime($calendarto));

            $where="get_date>='$calendarfrom' and get_date<='$calendarto'";

            // $prev_date = date('Y-m-d', strtotime($systemfrom .' -1 day'));

            }
            $select = 's.*,u.mm_user_full_name,u.mm_user_email,p.lvl_name';
            $table_name="mm_cashback as s";
            $join1[0]='user as u';
            $join1[1]='s.user_id = u.mm_uid';
            $join1[2]="left";
            $join2[0]='master_level as p';
            $join2[1]='s.against_id = p.ml_id';
            $join2[2]="left";
            // var_dump($where);
            $data['all_cashback']=$this->Crud_modal->fetch_data_by_two_table_join($select,$table_name,$join1, $join2, $where);

            // $wh="date(get_date) >='$calendarfrom' and date(get_date) <=' $calendarto'";
            $wh="date(get_date) <'$calendarfrom'";
            $data['cashback1']=$this->Crud_modal->all_data_select('sum(amount) as amount', 'mm_cashback', $wh, 'id asc');    
            // echo $this->db->last_query();


            $this->load->view('cashback/user-cashback', $data);

            }


            }
            ?>