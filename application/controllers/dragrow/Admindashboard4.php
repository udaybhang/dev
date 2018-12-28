<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admindashboard4 extends CI_Controller {	
  	function __construct(){
		parent::__construct();
	    //error_reporting(0);
		$this->load->model('crud/Crud_modal');
		
		
		
		}
  	

//udaybhan code start
    public function user_plan_drag()
    {
    	
    	
         
        $data['feature_data']=$this->Crud_modal->all_data_select('*','mm_plan_features',"status in(1)",'page_order asc'); 
   
		$this->load->view('dragrow/user-plan-drag', $data); 
		
    }
    public function update_drag_row()
    {
$position = $_POST['position'];


$i=1;
foreach($position as $k=>$v){
    // $sql = "Update sorting_items SET position_order=".$i." WHERE id=".$v;
    // $mysqli->query($sql);
$where="feature_id='$v'";
$updated_record['page_order']=$i;
	$i++;
	$this->Crud_modal->update_data($where,'mm_plan_features',$updated_record);
}
}
public function edit_plan_feature()
{
		$v = $this->uri->segment(2);
		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
		$data['plan_feature']=$this->Crud_modal->fetch_single_data('*','mm_plan_features',"feature_id='$val'");
  //       $this->load->view('admintempletes/head');
		// $this->load->view('admintempletes/header');	
		// $this->load->view('admintempletes/sidebar');
		$this->load->view('dragrow/edit-plan-feature',$data); 
		// $this->load->view('admintempletes/footer');
}
public function edit_plan_feature_save()
{
	$feature_id=$this->input->post('data_value');
		if($this->input->post("feature_description")!='' && $this->input->post("short_description")!=''){

    		$field=array(
	    				'short_desc'=>$this->input->post('short_description'),
	    				'feature_description'=>$this->input->post('feature_description'),
	    				'modification_date'=>date("Y-m-d H:i:s"),
	    				'status'=>1
	    		);
    		if($this->Crud_modal->update_data("feature_id='$feature_id'","mm_plan_features",$field)){
    			$this->session->set_flashdata('plan_message','<div class="success">Feature Plan updated successfully</div>');
					redirect(base_url().'user-plan-drag');
    		}
    	}else{
    		$this->session->set_flashdata('plan_message','<div class="danger">All Field are required</div>');
    		redirect(base_url().'user-plan-drag');
    	}
}
//udaybhan code end
     public function user_plan_package_feature(){
		$data['feature_data']=$this->Crud_modal->all_data_select('*','mm_plan_features',"status in(1)",'feature_id desc'); 
        $this->load->view('admintempletes/head');
		$this->load->view('admintempletes/header');	
		$this->load->view('admintempletes/sidebar');
		$this->load->view('user-plan-package-feature',$data); 
		$this->load->view('admintempletes/footer');
    }
     public function user_plan_feature_save(){
     	$feature = $this->input->post("feature_description");
    	if($this->input->post("feature_description")!='' && $this->input->post('short_description')!=''){
    		$check = $this->Crud_modal->check_numrow('mm_plan_features',"feature_description='$feature'");
    		if($check==0){
	    		$field=array(
	    				'short_desc'=>$this->input->post('short_description'),
	    				'feature_description'=>$this->input->post('feature_description'),
	    				'creation_date'=>date("Y-m-d H:i:s"),
	    				'modification_date'=>date("Y-m-d H:i:s"),
	    				'status'=>1
	    		);
	    		if($this->Crud_modal->data_insert("mm_plan_features",$field)){
	    			$this->session->set_flashdata('plan_message','<div class="success">Plan created successfully</div>');
						redirect(base_url().'user-plan-package-feature');
	    		}
            }else{
            	$this->session->set_flashdata('plan_message','<div class="danger">Plan already created </div>');
						redirect(base_url().'user-plan-package-feature');
            }
    	}
    	
    }
     public function user_edit_plan_feature(){
		$v = $this->uri->segment(2);
		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
		$data['plan_feature']=$this->Crud_modal->fetch_single_data('*','mm_plan_features',"feature_id='$val'");
        $this->load->view('admintempletes/head');
		$this->load->view('admintempletes/header');	
		$this->load->view('admintempletes/sidebar');
		$this->load->view('user-edit-plan-feature',$data); 
		$this->load->view('admintempletes/footer');
    }
    public function user_edit_plan_feature_save(){
    	$feature_id=$this->input->post('data_value');
		if($this->input->post("feature_description")!='' && $this->input->post("short_description")!=''){

    		$field=array(
	    				'short_desc'=>$this->input->post('short_description'),
	    				'feature_description'=>$this->input->post('feature_description'),
	    				'modification_date'=>date("Y-m-d H:i:s"),
	    				'status'=>1
	    		);
    		if($this->Crud_modal->update_data("feature_id='$feature_id'","mm_plan_features",$field)){
    			$this->session->set_flashdata('plan_message','<div class="success">Feature Plan updated successfully</div>');
					redirect(base_url().'user-plan-drag');
    		}
    	}else{
    		$this->session->set_flashdata('plan_message','<div class="danger">All Field are required</div>');
    		redirect(base_url().'user-plan-drag');
    	}
    }
     public function delete_user_plan_feature(){
    	$v = $this->input->post('hidden_data');
		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
		$field=array('status'=>'0'
    			);
		if($this->Crud_modal->update_data("feature_id='$val'","mm_plan_features",$field)){
			echo 0;
		}
    }
    public function user_plan_package(){
		$data['feature_data'] = $this->Crud_modal->all_data_select('feature_id,feature_description,short_desc','mm_plan_features',"status in(1)",'feature_id ASC');
		$data['plan_data'] = $this->Crud_modal->all_data_select('plan_id,plan_name','mm_plans',"status in(1)",'plan_id desc');
		$data['plan_feature'] = $this->Crud_modal->all_data_select('DISTINCT(plan_id)','mm_plan_features_map',"plan_access=1",'plan_package_id');
        $this->load->view('admintempletes/head');
		$this->load->view('admintempletes/header');	
		$this->load->view('admintempletes/sidebar');
		$this->load->view('user-plan-package',$data); 
		$this->load->view('admintempletes/footer');
    }
    public function user_plan_map(){
    	$feature = $this->input->post('feature');
    	$plan = $this->input->post('plan_name');
    	$check = $this->Crud_modal->check_numrow('mm_plan_features_map',"plan_id='$plan' and plan_access=1");
    	if($check==0){
		    	for ($i=0; $i < count($feature); $i++) { 
			    		$feature_explode = explode('|', $feature[$i]);
			    		$package_map_feature = $feature_explode[0];
			    		//$wallet_amount = $feature_explode[1];
			    		//$neuron_eligbilty = $feature_explode[2];
			    		$field = array(
			    			'plan_id'=>$plan,
			    			'feature_id'=>$package_map_feature,
			    			'plan_access'=>1,
			    			//'wallet_point_reduction'=>$wallet_amount,
			    			//'neurons_eligibility'=>$neuron_eligbilty,
			    			'creation_date'=>date('Y-m-d H:i:s'),
			    			'modification_date'=>date('Y-m-d H:i:s'),
			    		);
			    		$data_insert = $this->Crud_modal->data_insert('mm_plan_features_map',$field);
			    		if($i == (count($feature)-1)){
                             $this->session->set_flashdata('plan_message','<div class="success">Data Inserted Successfully</div>');
					redirect(base_url().'user-plan-package');
			    		}
		    	}
		    }else{
		    	$this->session->set_flashdata('plan_message','<div class="danger">Already exists Go to Edit</div>');
					redirect(base_url().'user-plan-package');
		    }
    }
     public function edit_user_plan_package(){
        $v = $this->uri->segment(2);
		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
		$data['feature_data'] = $this->Crud_modal->all_data_select('feature_id,feature_description,short_desc','mm_plan_features',"status in(1)",'feature_id ASC');
		$data['plan_data'] = $this->Crud_modal->all_data_select('plan_id,plan_name','mm_plans',"status in(1)",'plan_id desc');
		$data['planid'] = $val;
		$data['planid_hidden'] = $v;
		$countfe = count($data['feature_data']);
		$sec=0;
		$i=0;
		foreach ($data['feature_data'] as $feature) {
			 $f_id = $feature['feature_id'];
			 $check = $this->Crud_modal->fetch_single_data('plan_id,feature_id','mm_plan_features_map',"plan_id='$val' and feature_id='$f_id' and plan_access='1'",'plan_package_id');
			 if($check){
			 	$sec++;
			 	$data['feature_data'][$i]['check'] = '1';
			 }
			 //$data['feature_data'][$i]['wallet_point_reduction'] = $check['wallet_point_reduction'];
			 //$data['feature_data'][$i]['neurons_eligibility'] = $check['neurons_eligibility'];
			 
			 $i++;
		}
		if($sec==$countfe){
           $data['check1']=1;
		}
		//print_r($data['feature_data']); die;
        $this->load->view('admintempletes/head');
		$this->load->view('admintempletes/header');	
		$this->load->view('admintempletes/sidebar');
		$this->load->view('edit-user-plan-package',$data); 
		$this->load->view('admintempletes/footer');
    }
   
    public function edit_user_plan_map_save(){
    	//planh_id
    	$feature = $this->input->post('feature');
    	$plan = $this->input->post('plan_name');
    	$planh =  base64_decode(str_pad(strtr($this->input->post('planh_id'), '-_', '+/'), strlen($this->input->post('planh_id')) % 4, '=', STR_PAD_RIGHT));
    	$check = $this->Crud_modal->check_numrow('mm_plan_features_map',"plan_id='$plan' and plan_access=1");
    	if($check !=0 && $plan != $planh){
           $this->session->set_flashdata('plan_message','<div class="danger">You can not change plan its Alredy exists Go Edit</div>');
		   redirect(base_url().'user-plan-package');
    	}
    	$this->Crud_modal->update_data("plan_id='$planh'",'mm_plan_features_map',array('plan_access'=>0));
		    	for ($i=0; $i < count($feature); $i++) { 
			    		$feature_explode = explode('|', $feature[$i]);
			    		$package_map_feature = $feature_explode[0];
			    		$field = array(
			    			'plan_id'=>$plan,
			    			'feature_id'=>$package_map_feature,
			    			'plan_access'=>1,
			    			'creation_date'=>date('Y-m-d H:i:s'),
			    			'modification_date'=>date('Y-m-d H:i:s'),
			    		);
			    	  $checkdata = $this->Crud_modal->check_numrow('mm_plan_features_map',"plan_id='$plan' and feature_id='$package_map_feature'");
			    	  if($checkdata>0){
                         $this->Crud_modal->update_data("plan_id='$plan' and feature_id='$package_map_feature'",'mm_plan_features_map',array('plan_access'=>1));
                           if($i == (count($feature)-1)){
                             $this->session->set_flashdata('plan_message','<div class="success">Data Update Successfully</div>');
					             redirect(base_url().'user-plan-package');
			    	        	}
			    	  }else{
			    	  	$this->Crud_modal->data_insert('mm_plan_features_map',$field);
			    	  	if($i == (count($feature)-1)){
                             $this->session->set_flashdata('plan_message','<div class="success">Data Update Successfully</div>');
					             redirect(base_url().'user-plan-package');
			    	    	}
			    	  }
			    		//$data_insert = $this->Crud_modal->data_insert('mm_user_plan_package',$field);
			    		// if($i == (count($feature)-1)){
         //                     $this->session->set_flashdata('plan_message','<div class="success">Data Inserted Successfully</div>');
					    //          redirect(base_url().'user-plan-package');
			    		// }
		    	}
    }
      public function user_plan_package_delete(){
    	$v = $this->input->post('plan');
		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
		$field=array('plan_access'=>0
    			);
		if($this->Crud_modal->update_data("plan_id='$val'","mm_plan_features_map",$field)){
			echo 0;
		}
    }
 public function view_user_plan_package(){
    	  $v = $this->uri->segment(2);
		$val = base64_decode(str_pad(strtr($v, '-_', '+/'), strlen($v) % 4, '=', STR_PAD_RIGHT));
		$data['feature_data'] = $this->Crud_modal->all_data_select('feature_id,feature_description,short_desc','mm_plan_features',"status in(1)",'feature_id ASC');
		$data['plan_data'] = $this->Crud_modal->all_data_select('plan_id,plan_name','mm_plans',"status in(1)",'plan_id desc');
		$data['planid'] = $val;
		$data['planid_hidden'] = $v;
		$countfe = count($data['feature_data']);
		$sec=0;
		$i=0;
		foreach ($data['feature_data'] as $feature) {
			 $f_id = $feature['feature_id'];
			 $check = $this->Crud_modal->fetch_single_data('plan_id,feature_id','mm_plan_features_map',"plan_id='$val' and feature_id='$f_id' and plan_access='1'",'plan_package_id');
			 if($check){
			 	$sec++;
			 	$data['feature_data'][$i]['check'] = '1';
			 }
			 //$data['feature_data'][$i]['wallet_point_reduction'] = $check['wallet_point_reduction'];
			 //$data['feature_data'][$i]['neurons_eligibility'] = $check['neurons_eligibility'];
			 
			 $i++;
		}
		if($sec==$countfe){
           $data['check1']=1;
		}
		//print_r($data['feature_data']); die;
        $this->load->view('admintempletes/head');
		$this->load->view('admintempletes/header');	
		$this->load->view('admintempletes/sidebar');
		$this->load->view('view-user-plan-package',$data); 
		$this->load->view('admintempletes/footer');
        }

########### admin user plan controller end here by shafik ##########################

 ###########  udhaybhan report code ###############################################
public function user_subscription_report()
    {
      $this->session->set_flashdata('error_message', '');	
 $data= $this->Crud_modal->fetch_alls('mm_plans', 'plan_id asc');
   $k=0;
         
         
         	$table='mm_plans';
        	$data['member_type']=$this->Crud_modal->fetch_alls($table, 'plan_id asc');
			$table_name="mm_user_transaction_history as s";
			$join1[0]='user as u';
			$join1[1]='s.user_id = u.mm_uid';
			$join1[2]="inner";
                if($this->input->post('from_date') !='' && $this->input->post('to_date') !=''){
                             $start_from=date('Y-m-d', strtotime($this->input->post('from_date')));  
                             $to=date('Y-m-d', strtotime($this->input->post('to_date'))); 
                             $diff=date_diff(new DateTime($start_from),new DateTime($to));
                             $date_diff = $diff->format("%a");
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
            	$this->load->view('admintempletes/head',$data);
        		$this->load->view('admintempletes/header',$data);    
        		$this->load->view('admintempletes/sidebar',$data);
        		$this->load->view('user-supbscription-report', $data);
        		$this->load->view('admintempletes/footer');
    	
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
        			$join1[1]='s.user_id = u.mm_uid';
        			$join1[2]="left";
        				  if($subs_id=='all'){
        				  	    $select = 's.*,u.mm_user_full_name,u.mm_user_email,p.plan_name';
        				  	    $join2[0]='mm_plans as p';
        						  $join2[1]='s.plan_id = p.plan_id';
        						  $join2[2]="left";
        						  $all_subscriber=$this->Crud_modal->fetch_data_by_two_table_join($select,$table_name,$join1,$join2,$where1);
        						//echo   $this->db->last_query();
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
                					<th>Transaction Status</th>
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
            					$table_data .= '<td>'.$row['invoice_id'].'</td>
            					<td>'.$row['amount'].'</td>
            					<td>'.$row['txnid'].'</td>';
            						if($row['status']=='1'){$message = 'Success'; $color= 'green';}else{ $message = 'Failure'; $color='red';}
            					$table_data .='<td style="color: '.$color.'">'.$message.'</td></tr>';
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
       
                echo json_encode(['tabledata'=>$table_data,'error'=>0, 'plan'=>$subs_id, 'datestart'=>$ff, 'dateend'=>$tt]);
             }
 ###########  udhaybhan report code end here###############################################
public function contact_view()
   {
   	$data['all_dates']=$this->Crud_modal->fetch_alls('contact_data', 'name asc');
   	    $this->load->view('admintempletes/head');
		$this->load->view('admintempletes/header');    
		$this->load->view('admintempletes/sidebar');
		$this->load->view('contact-view', $data);
		$this->load->view('admintempletes/footer');
   }
  public function contact_view_data()
   {
   	$userid = $this->input->post('userid');
   	$where="cd_id='$userid'";
   	
   	 // echo $userid; die;
        if(isset($userid) and !empty($userid)){
        	
            $records = $this->Crud_modal->fetch_single_data('*','contact_data',$where);
             // print_r($records['name']);
          // echo $this->db->last_query();
          
            $output = '';
         
             $output .= '      
       
         
            <div class="row">
            <div class="col-md-4"><label>Name:</label></div> 
            <div class="col-md-8">'.$records["name"].'</div>
            </div>
             <div class="row">
            <div class="col-md-4"><label>Email:</label></div> 
            <div class="col-md-8">'.$records["email"].'</div>
            </div>
            <div class="row">
            <div class="col-md-4"><label>Phone:</label></div> 
            <div class="col-md-8">'.$records["phone"].'</div>
            </div>
            <div class="row">
            <div class="col-md-4"><label>Message:</label></div> 
            <div class="col-md-8">'.$records["message"].'</div>
            </div>
            ';
            
             echo $output;
   }
}


}