<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admindashboard3 extends MX_Controller {	
  function __construct(){
		parent::__construct();
	    error_reporting(0);
		$this->load->model('Admindashboard_modal');
		$this->load->model('crud/Crud_modal');
		$this->load->model('userdashboard/Userdashboard_modal');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->model('mailer/Mailer_model');
		$this->load->model('Pagination_model',"pgn");
		$this->load->model('assignments/Assignments_modal');
	    $this->load->library('Phpmailer');
		$this->load->helper('packageskills_helper');
		if(($this->session->userdata('admin_name')=="" || $this->session->userdata('admin_name')==null) && ($this->session->userdata('admin_role')=="" || $this->session->userdata('admin_role')==null)){
			redirect(base_url().'admin');
		}
		ini_set('memory_limit', '-1');
  }
  public function view_main_menu(){
          try{
            if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
                    $data['title']='Admin Dashboard for MondayMorning';
                    $tbl_name = 'master_menu';
                    $orderby = 'menu_id ASC';
                    $where = 'status = 1';
                    $fields = '*';
                    $data['master_menu_list'] = $this->Crud_modal->all_data_select($fields,$tbl_name,$where,$orderby);
                    $this->load->view('admintempletes/head');
                    $this->load->view('admintempletes/header');    
                    $this->load->view('admintempletes/sidebar');
                    $this->load->view('view-main-menu', $data);
                    $this->load->view('admintempletes/footer');
            }else{ redirect(base_url().'admin','refresh'); }
        }catch (Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
 }
   public function view_sub_menu(){
	  	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				    $data['title']='Admin Dashboard for MondayMorning';
				    $data['master_menu_list'] = $this->Crud_modal->all_data_select('*','master_menu','status = 1','menu_id ASC');
					$tbl_name = 'master_sub_menu';
                    $orderby = 'sub_menu_id ASC';
                    $where = 'status = 1';
                    $fields = '*';
                    $data['master_sub_menu_list'] = $this->Crud_modal->all_data_select($fields,$tbl_name,$where,$orderby);
					$this->load->view('admintempletes/head');
					$this->load->view('admintempletes/header');	
				  	$this->load->view('admintempletes/sidebar');
					$this->load->view('view-sub-menu',$data);
					$this->load->view('admintempletes/footer');
			}else{ redirect(base_url().'admin','refresh'); }
		}catch (Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
  }
   public function view_sub_sub_menu(){
	  	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				    $data['title']='Admin Dashboard for Monday Morning';
					$data['master_menu_list'] = $this->Crud_modal->all_data_select('*','master_menu','status = 1','menu_id ASC');
					$data['master_sub_menu_list'] = $this->Crud_modal->all_data_select('*','master_sub_menu','status = 1','sub_menu_id ASC');
					$tbl_name = 'master_sub_sub_menu';
                    $orderby = 'sub_sub_menu_id ASC';
                    $where = 'status = 1';
                    $fields = '*';
                    $data['master_sub_sub_menu_list'] = $this->Crud_modal->all_data_select($fields,$tbl_name,$where,$orderby);
					$this->load->view('admintempletes/head');
					$this->load->view('admintempletes/header');	
				  	$this->load->view('admintempletes/sidebar');
					$this->load->view('view-sub-sub-menu',$data);
					$this->load->view('admintempletes/footer');
			}else{ redirect(base_url().'admin','refresh'); }
		}catch (Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
  }
  public function view_roles(){
	  	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				    $data['title']='Admin Dashboard for Monday Morning';
					$tbl_name = 'master_role';
                    $orderby = 'role_id ASC';
                    $where = 'status = 1';
                    $fields = '*';
                    $data['master_role_list'] = $this->Crud_modal->all_data_select($fields,$tbl_name,$where,$orderby);
					$this->load->view('admintempletes/head');
					$this->load->view('admintempletes/header');	
				  	$this->load->view('admintempletes/sidebar');
					$this->load->view('view-roles',$data);
					$this->load->view('admintempletes/footer');
			}else{ redirect(base_url().'admin','refresh'); }
		}catch (Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
  }
 public function view_permissions(){
       try{
            if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
                    $data['title']='Admin Dashboard for Monday Morning';
                    $where = "status = '1'";
                    $data['permission_lists'] = $this->Crud_modal->all_data_select('*','master_permission',$where,'permission_id desc');
                    $this->load->view('admintempletes/head');
                    $this->load->view('admintempletes/header');    
                      $this->load->view('admintempletes/sidebar');
                    $this->load->view('view-permissions', $data);
                    $this->load->view('admintempletes/footer');
            }else{ redirect(base_url().'admin','refresh'); }
        }catch (Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
       }
 }
public function view_employees(){
      try{
           if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
                   $data['title']='Admin Dashboard for Monday Morning';
                   $tbl_name = 'admin';
                  $orderby = 'emp_id ASC';
                  $where = ' emp_id > 1 ';
                  $fields = '*';
                  $data['master_employee_list'] = $this->Crud_modal->all_data_select($fields,$tbl_name,$where,$orderby);
                 // $data['master_role_list'] = $this->Crud_modal->all_data_select("*","mapping_role_permission_master_menu","status=1","role_id");
                  $data['master_role_list']=$this->db->select("mr.role_id,r.role_name,r.role_description ")
                  ->from("mapping_role_permission_master_menu mr")
                  ->join("master_role r","mr.role_id=r.role_id","inner")
                  ->get()
                  ->result_array();
                  $where6 = "status = '1'";
$data['master_menu'] = $this->Crud_modal->all_data_select('*','master_menu',$where6,'menu_id ASC');
                    $where1 = "status = '1'";
                    $data['master_sub_menu'] = $this->Crud_modal->all_data_select('*','master_sub_menu',$where1,'sub_menu_id ASC');
                    $where2 = "status = '1'";
                    $data['master_sub_sub_menu'] = $this->Crud_modal->all_data_select('*','master_sub_sub_menu',$where2,'sub_sub_menu_id ASC');
                    $where3 = "status = '1'";
                    $data['master_role'] = $this->Crud_modal->all_data_select('*','master_role',$where3,'role_id ASC');
                    $where4 = "status = '1'";
                    $data['master_permission'] = $this->Crud_modal->all_data_select('*','master_permission',$where4,'permission_id ASC');
                    $where5 = "status = '1'";
                    $data['mapping_role_data'] = $this->Crud_modal->all_data_select('*','mapping_role_permission_master_menu',$where5,'role_id ASC');
                   $this->load->view('admintempletes/head');
                   $this->load->view('admintempletes/header');    
                   $this->load->view('admintempletes/sidebar');
                   $this->load->view('view-employees',$data);
                   $this->load->view('admintempletes/footer');
           }else{ redirect(base_url().'admin','refresh'); }
       }catch (Exception $e){
               echo 'Caught exception: ',  $e->getMessage(), "\n";
       }
}
  public function  map_role_with_permission_menu(){
    	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				    $data['title']='Admin Dashboard for Monday Morning';
					$where = "status = '1'";
					$data['master_menu'] = $this->Crud_modal->all_data_select('*','master_menu',$where,'menu_id ASC');
					$where1 = "status = '1'";
					$data['master_sub_menu'] = $this->Crud_modal->all_data_select('*','master_sub_menu',$where1,'sub_menu_id ASC');
					$where2 = "status = '1'";
					$data['master_sub_sub_menu'] = $this->Crud_modal->all_data_select('*','master_sub_sub_menu',$where2,'sub_sub_menu_id ASC');
					$where3 = "status = '1'";
					$data['master_role'] = $this->Crud_modal->all_data_select('*','master_role',$where3,'role_id ASC');
					$where4 = "status = '1'";
					$data['master_permission'] = $this->Crud_modal->all_data_select('*','master_permission',$where4,'permission_id ASC');
					$where5 = "status = '1'";
					$data['mapping_role_data'] = $this->Crud_modal->all_data_select('*','mapping_role_permission_master_menu',$where5,'role_id ASC');
					$data['master_portlets'] = $this->Crud_modal->all_data_select('portlet_id,portlet_name','mm_dashboard_portlet_map',"status=1",'portlet_id ASC');
					$this->load->view('admintempletes/head');
					$this->load->view('admintempletes/header');	
				  	$this->load->view('admintempletes/sidebar');
					$this->load->view('map-role-with-permission-menu', $data);
					$this->load->view('admintempletes/footer');
			}else{ redirect(base_url().'admin','refresh'); }
		}catch (Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
  }
  public function  menu_master_insert(){
    	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				 $menu_name = $this->input->post("menu_name");
				 $route_name = $this->input->post("menu_route");
				 $table_name = 'master_menu';
				 $orderby= 'menu_id ASC';
				 if($route_name !='#'){
                    $where1 = "menu_description = '$menu_name' or 	menu_route_name = '$route_name'";
                    $where2 = "sub_menu_description = '$menu_name' or 	sub_menu_route = '$route_name'";
                    $where3 = "sub_sub_menu_description = '$menu_name' or 	sub_sub_menu_route = '$route_name'";
				 }else{
				 	 $where1 = "menu_description = '$menu_name'";
				 	 $where2 = "sub_menu_description = '$menu_name'";
				 	 $where3 = "sub_sub_menu_description = '$menu_name'";
				 }
				 $data1 = $this->Crud_modal->all_data_select('*','master_menu',$where1,$orderby);
				 $orderby2= 'sub_menu_id ASC';
				 
				 $data2 = $this->Crud_modal->all_data_select('*','master_sub_menu',$where2,$orderby2);
				 $orderby3= 'sub_sub_menu_id ASC';
				
				 $data3 = $this->Crud_modal->all_data_select('*','master_sub_sub_menu',$where3,$orderby3);
				 $count1 = count($data1);
				 $count2 = count($data2);
				 $count3 = count($data3);

                 
				 if($count1>=1 || $count2>=1 || $count3>=1){
                    echo '0';
				 }
				 if($count1==0 && $count2==0 && $count3==0){
				   $field=array(
				 	'menu_description'=> $menu_name,
				 	'menu_route_name'=> $route_name,
				 	'status' => 1,
				 	'creation_date' =>date('Y-m-d H:i:s')
				 );
				   echo $this->Crud_modal->data_insert($table_name,$field);
				 }
				 //print_r($data1); die;
				 
				 
			}else{ redirect(base_url().'admin','refresh'); }
		}catch (Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
  }
  public function delete_master_menu()
 {
	  	try
			{
				if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			    {
			    	$assign_id = $this->input->post('assignid'); 
			    	$where="menu_id = '$assign_id'";
			    	$tblname='master_menu';
			    	$field = array(
			    		'status'=>0);
			    	if($this->Crud_modal->update_data($where,$tblname,$field)){
			    		
			    		echo '{"msg":"Assignment Deleted"}';
			    	}else{
			    	 	echo '{"msg":"Some Error"}';
			    	}
				}
				else
				{
				    redirect(base_url().'admin','refresh');
			    }
			}
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
 }
 
 public function edit_master_form_get_data()
 {
	  	try
			{
				if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			    {
			    	$assign_id = $this->input->post('assignid'); 
			    	$orderby= 'menu_id ASC';
				    $where1 = "menu_id = '$assign_id'";
				    $data1 = $this->Crud_modal->all_data_select('*','master_menu',$where1,$orderby);
				    echo json_encode($data1);
				}
				else
				{
				    redirect(base_url().'admin','refresh');
			    }
			}
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
 }
public function  edit_master_form_data_save(){
       try{
            if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
                 $menu_name = $this->input->post("edit_menu_name");
                 $route_name = $this->input->post("edit_menu_route");
                 $menu_id = $this->input->post("edit_menu_id");
                 $table_name = 'master_menu';
                 $orderby= 'menu_id ASC';
                 if($route_name !='#'){
                   $where1 = "menu_description = '$menu_name' or     menu_route_name = '$route_name' and menu_id !='$menu_id'";
                   $where2 = "sub_menu_description = '$menu_name' or     sub_menu_route = '$route_name'";
                   $where3 = "sub_sub_menu_description = '$menu_name' or     sub_sub_menu_route = '$route_name'";
                 }else{
                      $where1 = "menu_description = '$menu_name' and menu_id !='$menu_id'";
                      $where2 = "sub_menu_description = '$menu_name'";
                      $where3 = "sub_sub_menu_description = '$menu_name'";
                 }
                 $data1 = $this->Crud_modal->all_data_select('*','master_menu',$where1,$orderby);
                 $orderby2= 'sub_menu_id ASC';
                 $data2 = $this->Crud_modal->all_data_select('*','master_sub_menu',$where2,$orderby2);
                 $orderby3= 'sub_sub_menu_id ASC';
                 $data3 = $this->Crud_modal->all_data_select('*','master_sub_sub_menu',$where3,$orderby3);
                 $count1 = count($data1);
                 $count2 = count($data2);
                 $count3 = count($data3);
                 if($count1>=1 || $count2>=1 || $count3>=1){
                   echo 0;
                 }
                 else{
                   $field=array(
                     'menu_description'=> $menu_name,
                     'menu_route_name'=> $route_name,
                     'modification_date' =>date('Y-m-d H:i:s')
                 );
                 $where = "menu_id = '$menu_id'";
                 $tblname = 'master_menu';
                 if($this->Crud_modal->update_data($where,$tblname,$field))
                 {
                   echo 1;
                 }
                 }
                 //print_r($data1); die;
                
                
            }else{ redirect(base_url().'admin','refresh'); }
        }catch (Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
 }

public function  edit_parent_form_data_save(){
       try{
            if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
                 $menu_name = $this->input->post("edit_sub_menu_name");
                 $route_name = $this->input->post("edit_sub_menu_route");
                 $menu_id = $this->input->post("edit_menu_id");
                 $sub_menu_id = $this->input->post("edit_sub_menu_id");
                 $table_name = 'master_menu';
                 $orderby= 'menu_id ASC';
                 if($route_name !="#"){
                 $where1 = "menu_description = '$sub_menu_name' or     menu_route_name = '$route_name'";
                $where2 = "sub_menu_description = '$sub_menu_name' or     sub_menu_route = '$route_name' and sub_menu_id != '$sub_menu_id'";
                $where3 = "sub_sub_menu_description = '$sub_menu_name' or     sub_sub_menu_route = '$route_name'";
                 }
                     else{
                          $where1 = "menu_description = '$sub_menu_name'";
                        $where2 = "sub_menu_description = '$sub_menu_name' and sub_menu_id != '$sub_menu_id'";
                        $where3 = "sub_sub_menu_description = '$sub_menu_name'";
                     }
                 $data1 = $this->Crud_modal->all_data_select('*','master_menu',$where1,$orderby);
                 $orderby2= 'sub_menu_id ASC';
                 $data2 = $this->Crud_modal->all_data_select('*','master_sub_menu',$where2,$orderby2);
                 $orderby3= 'sub_sub_menu_id ASC';
                 $data3 = $this->Crud_modal->all_data_select('*','master_sub_sub_menu',$where3,$orderby3);
                 $count1 = count($data1);
                 $count2 = count($data2);
                 $count3 = count($data3);
                 if($count1>=1 || $count2>=1 || $count3>=1){
                   echo 0;
                 }
                 else{
                   $field=array(
                       'menu_id' => $menu_id,
                     'sub_menu_description'=> $menu_name,
                     'sub_menu_route'=> $route_name,
                     'modification_date' =>date('Y-m-d H:i:s')
                 );
                 $where = "sub_menu_id = '$sub_menu_id'";
                 $tblname = 'master_sub_menu';
                 echo $this->Crud_modal->update_data($where,$tblname,$field);
                
                 }
                 //print_r($data1); die;
                
                
            }else{ redirect(base_url().'admin','refresh'); }
        }catch (Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
 }

   public function  sub_menu_master_insert(){
    	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				 $menu_id = $this->input->post("menu_id");
				 $sub_menu_name = $this->input->post("sub_menu_name");
				 $route_name = $this->input->post("sub_menu_route");
				 $table_name = 'master_menu';
				 $orderby= 'menu_id ASC';
				 if($route_name !="#"){
				 $where1 = "menu_description = '$sub_menu_name' or 	menu_route_name = '$route_name'";
                 $where2 = "sub_menu_description = '$sub_menu_name' or 	sub_menu_route = '$route_name'";
                 $where3 = "sub_sub_menu_description = '$sub_menu_name' or 	sub_sub_menu_route = '$route_name'";
				 }
				 	else{
				 		 $where1 = "menu_description = '$sub_menu_name'";
                         $where2 = "sub_menu_description = '$sub_menu_name'";
                         $where3 = "sub_sub_menu_description = '$sub_menu_name'";
				 	}
				
				 $data1 = $this->Crud_modal->all_data_select('*','master_menu',$where1,$orderby);
				 $orderby2= 'sub_menu_id ASC';
				 $data2 = $this->Crud_modal->all_data_select('*','master_sub_menu',$where2,$orderby2);
				 $orderby3= 'sub_sub_menu_id ASC';
				 $data3 = $this->Crud_modal->all_data_select('*','master_sub_sub_menu',$where3,$orderby3);
				 $count1 = count($data1);
				 $count2 = count($data2);
				 $count3 = count($data3);
				 if($count1>=1 || $count2>=1 || $count3>=1){
                    echo 0;
				 }
				 if($count1==0 && $count2==0 && $count3==0){
				   $field=array(
				   	'menu_id' => $menu_id,
				 	'sub_menu_description'=> $sub_menu_name,
				 	'sub_menu_route'=> $route_name,
				 	'status' => 1,
				 	'creation_date' =>date('Y-m-d H:i:s')
				 );
				 echo $this->Crud_modal->data_insert('master_sub_menu',$field);
				 	
				 }
				 //print_r($data1); die;
				 
				 
			}else{ redirect(base_url().'admin','refresh'); }
		}catch (Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
  }
  public function delete_master_sub_menu()
 {
	  	try
			{
				if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			    {
			    	$id = $this->input->post('sub_menu_id'); 
			    	$where="sub_menu_id = '$id'";
			    	$tblname='master_sub_menu';
			    	$field = array(
			    		'status'=>0);
			    	if($this->Crud_modal->update_data($where,$tblname,$field)){
			    		
			    		echo '{"msg":"Record Deleted"}';
			    	}else{
			    	 	echo '{"msg":"Some Error"}';
			    	}
				}
				else
				{
				    redirect(base_url().'admin','refresh');
			    }
			}
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
 }

 public function edit_parent_form_get_data()
 {
	  	try
			{
				if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			    {
			    	$id = $this->input->post('sub_menu_id'); 
			    	$orderby= 'sub_menu_id ASC';
				    $where1 = "sub_menu_id = '$id'";
				    $data1['edit_data'] = $this->Crud_modal->all_data_select('*','master_sub_menu',$where1,$orderby);
				    $data1['menu_list']=$this->Crud_modal->all_data_select('*','master_menu','status=1','menu_id');
				    echo json_encode($data1);
				}
				else
				{
				    redirect(base_url().'admin','refresh');
			    }
			}
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
 }


  public function  sub_sub_menu_master_insert(){
    	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				 $menu_id = $this->input->post("menu_id");
				 $sub_menu_id = $this->input->post("sub_menu_id");
				 $sub_sub_menu_name = $this->input->post("sub_sub_menu_name");
				 $route_name = $this->input->post("sub_sub_menu_route");
				 $table_name = 'master_menu';
				 $orderby= 'menu_id ASC';
				 if($route_name !="#"){
				 	 $where1 = "menu_route_name = '$route_name'";
				 	 $where2 = "sub_menu_route = '$route_name'";
				 	 $where3 = "sub_sub_menu_route = '$route_name'";
				 }else{
                     $where1 = "menu_description = '$sub_sub_menu_name'";
				 	 $where2 = "sub_menu_description = '$sub_sub_menu_name'";
				 	 $where3 = "sub_sub_menu_description = '$sub_sub_menu_name'";
				 }
				
				 $data1 = $this->Crud_modal->all_data_select('*','master_menu',$where1,$orderby);
				 $orderby2= 'sub_menu_id ASC';
				 $data2 = $this->Crud_modal->all_data_select('*','master_sub_menu',$where2,$orderby2);
				 $orderby3= 'sub_sub_menu_id ASC';
				 $data3 = $this->Crud_modal->all_data_select('*','master_sub_sub_menu',$where3,$orderby3);
				 $count1 = count($data1);
				 $count2 = count($data2);
				 $count3 = count($data3);
				 if($count1>=1 || $count2>=1 || $count3>=1){
                    echo 0;
				 }
				 if($count1==0 && $count2==0 && $count3==0){
				   $field=array(
				   	'menu_id' => $menu_id,
				   	'sub_menu_id' => $sub_menu_id,
				 	'sub_sub_menu_description'=> $sub_sub_menu_name,
				 	'sub_sub_menu_route'=> $route_name,
				 	'status' => 1,
				 	'creation_date' =>date('Y-m-d H:i:s')
				 );

				   echo $this->Crud_modal->data_insert('master_sub_sub_menu',$field);
				   //echo "hai";
				 }
				 //print_r($data1); die;
				 
				 
			}
		}catch (Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
  }

  public function get_menu_submenu(){
		$topicid=$this->input->post('topicid');
		$data =$this->Crud_modal->all_data_select('*','master_sub_menu',"menu_id='$topicid'",'sub_menu_id desc');
		echo '<option value="">Select Sub-Menu Name</option>';
		for($i=0;$i<sizeof($data);$i++){
			echo '<option value="'.$data[$i]["sub_menu_id"].'">'.$data[$i]["sub_menu_description"].'</option>';													
		}
  }
  public function delete_master_sub_sub_menu(){
	  	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
			    $id = $this->input->post('sub_sub_menu_id'); 
			    $where="sub_sub_menu_id = '$id'";
			    $tblname='master_sub_sub_menu';
			    $field = array('status'=>0);
			    if($this->Crud_modal->update_data($where,$tblname,$field)){
			    	echo '{"msg":"Record Deleted"}';
			    }else{
			    	 echo '{"msg":"Some Error"}';
			    }
			}else{
				redirect(base_url().'admin','refresh');
			}
		}catch (Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
  }
  public function edit_child_form_get_data(){
	try{
		 if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
			$id = $this->input->post('sub_sub_menu_id'); 
			$orderby= 'sub_sub_menu_id ASC';
			$where1 = "sub_sub_menu_id = '$id'";
		    $data1['edit_data'] = $this->Crud_modal->all_data_select('*','master_sub_sub_menu',$where1,$orderby);
		    $data1['menu_list']=$this->Crud_modal->all_data_select('*','master_menu','status=1','menu_id');
		    $data1['sub_menu_list']=$this->Crud_modal->all_data_select('*','master_sub_menu','status=1','sub_menu_id');
		    echo json_encode($data1);
		 }else{
			redirect(base_url().'admin','refresh');
		 }
	}catch (Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
 }
public function  edit_child_form_data_save(){
       try{
            if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
                 $menu_name = $this->input->post("edit_sub_sub_menu_name");
                 $route_name = $this->input->post("edit_sub_sub_menu_route");
                 $menu_id = $this->input->post("edit_menu_id");
                 $sub_menu_id = $this->input->post("edit_sub_menu_id");
                 $sub_sub_menu_id = $this->input->post("edit_sub_sub_menu_id");
                 //exit;
                 $table_name = 'master_menu';
                 if($route_name !="#"){
                      $where1 = "menu_route_name = '$route_name'";
                      $where2 = "sub_menu_route = '$route_name'";
                      $where3 = "(sub_sub_menu_route = '$route_name') and sub_sub_menu_id != '$sub_sub_menu_id'";
                      $orderby= 'menu_id ASC';
                 $data1 = $this->Crud_modal->all_data_select('*','master_menu',$where1,$orderby);
                 $orderby2= 'sub_menu_id ASC';
                 $data2 = $this->Crud_modal->all_data_select('*','master_sub_menu',$where2,$orderby2);
                 $orderby3= 'sub_sub_menu_id ASC';
                 $data3 = $this->Crud_modal->all_data_select('*','master_sub_sub_menu',$where3,$orderby3);
                 }
                 $count1 = count($data1);
                 $count2 = count($data2);
                 $count3 = count($data3);
                 if($count1>=1 || $count2>=1 || $count3>=1){
                   echo 0;
                 }
                 if($count1==0 && $count2==0 && $count3==0){
                   $field=array(
                       'menu_id' => $menu_id,
                       'sub_menu_id' => $sub_menu_id,
                     'sub_sub_menu_description'=> $menu_name,
                     'sub_sub_menu_route'=> $route_name,
                     'modification_date' =>date('Y-m-d H:i:s')
                 );
                 $where = "sub_sub_menu_id = '$sub_sub_menu_id'";
                 $tblname = 'master_sub_sub_menu';
                 echo $this->Crud_modal->update_data($where,$tblname,$field);
                
                 }
                 //print_r($data1); die;
                
                
            }else{ redirect(base_url().'admin','refresh'); }
        }catch (Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
 }
  public function  role_master_insert(){
    	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				 $role_name = $this->input->post("role_name");
				 $desc = $this->input->post("role_desc");
				 $table_name = 'master_role';
				 $orderby= 'role_id ASC';
				 $where1 = "role_name = '$role_name'";
				 $data1 = $this->Crud_modal->all_data_select('*','master_role',$where1,$orderby);
				 $count1 = count($data1);
				 if($count1>=1){
                    echo 0;
				 }
				 else{
				   $field=array(
				   	'role_name'=> $role_name,
				 	'role_description'=> $desc,
				 	'status' => 1,
				 	'creation_date' =>date('Y-m-d H:i:s')
				 );
				 $data = $this->Crud_modal->data_insert($table_name,$field);
					 if($data){
					 	echo 1;
					 	//redirect(base_url().'view-main-menu','refresh');
					 }	
				 }
				 //print_r($data1); die;
				 
				 
			}else{ redirect(base_url().'admin','refresh'); }
		}catch (Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
  }
  public function delete_master_role(){
	try{
		 if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
			 $id = $this->input->post('role_id'); 
			 $where="role_id = '$id'";
			 $tblname='master_role';
			 $field = array('status'=>0);
			 if($this->Crud_modal->update_data($where,$tblname,$field)){
			    echo '{"msg":"Record Deleted"}';
			 }else{
			    echo '{"msg":"Some Error"}';
			 }
		 }else{
			redirect(base_url().'admin','refresh');
		 }
	}catch (Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
 }
 public function edit_role_form_get_data(){
	if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
		$id = $this->input->post('role_id'); 
		$orderby= 'role_id ASC';
		$where1 = "role_id = '$id'";
		$data1 = $this->Crud_modal->all_data_select('*','master_role',$where1,$orderby);
		echo json_encode($data1);
	}else{
		redirect(base_url().'admin','refresh');
	}
			
 }
 public function  edit_role_form_data_save(){
  		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				 $role_name = $this->input->post("edit_role_name");
				 $desc = $this->input->post("edit_role_desc");
				 $role_id = $this->input->post("edit_role_id");
				 $table_name = 'master_role';
				 $orderby= 'role_id ASC';
				 $where1 = "role_name = '$role_name' and role_id != '$role_id'";
				 $data1 = $this->Crud_modal->all_data_select('*','master_role',$where1,$orderby);
				 $count1 = count($data1);
				 if($count1>=1){
                    echo 0;
				 }else{
				   $field=array(
				   	'role_name'=> $role_name,
				 	'role_description'=> $desc,
				 	'modification_date' =>date('Y-m-d H:i:s')
					 );
					 $where = "role_id = '$role_id'";
					 $tblname = 'master_role';
					 $data = $this->Crud_modal->update_data($where,$tblname,$field);
					 if($data){
					 	echo 1;
					 }	
				}	
		}else{ redirect(base_url().'admin','refresh'); }
		
 }
 public function  employee_master_insert(){
    	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				 $name = $this->input->post("emp_name");
				 $mob = $this->input->post("mob");
				 $email = $this->input->post("email");
				 $pwd = $this->input->post("pwd");
				 $role = $this->input->post("role");
				 $status = $this->input->post("status");
				
				 $table_name = 'admin';
				 $orderby= 'emp_id ASC';
				 $where1 = "emp_email = '$email'";
				 $data1 = $this->Crud_modal->all_data_select('*','admin',$where1,$orderby);
				 $count1 = count($data1);
				 if($count1>=1){
                    echo 0;
				 }
				 else{
				   $field=array(
				   	'emp_name'=> $name,
				 	'emp_contact'=> $mob,
				 	'emp_email'=> $email,
				 	'emp_password'=> md5($pwd),
				 	'role_id'=> $role,
				 	'status' => $status,
				 	'creation_date' =>date('Y-m-d H:i:s')
				 );
				 $data = $this->Crud_modal->data_insert($table_name,$field);
					 if($data){
					 	echo 1;
					 }	
				 }
			}else{ redirect(base_url().'admin','refresh'); }
		}catch (Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
  }
  public function delete_master_employee(){
	try{
		 if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
			 $id = $this->input->post('emp_id'); 
			 $st = $this->input->post('status');
			 $where="emp_id = '$id'";
			 $tblname='admin';
			 $field = array('status'=>$st);
			 if($this->Crud_modal->update_data($where,$tblname,$field)){
			 	if($st==1)
			    	echo '{"msg":"Employee Activated"}';
				if($st==0)
					echo '{"msg":"Employee Deactivated"}';
			 }else{
			    echo '{"msg":"Some Error"}';
			 }
		 }else{
			redirect(base_url().'admin','refresh');
		 }
	}catch (Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
 }

 //code by shafik
 public function permission_master_form_data_save(){
       try{
            if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
                 $per_desc = $this->input->post("permission_desc");
                 $table_name = 'master_permission';
                 $orderby= 'permission_id ASC';
                 $where1 = "permission_description = '$per_desc'";
                 $data1 = $this->Crud_modal->all_data_select('*','master_permission',$where1,$orderby);
                 $count1 = count($data1);
                 if($count1>=1){
                   echo 0;
                 }
                 else{
                   $field=array(
                     'permission_description'=> $per_desc,
                     'status' => 1,
                     'creation_date' =>date('Y-m-d H:i:s')
                 );
                 $data = $this->Crud_modal->data_insert($table_name,$field);
                 if($data){
                     echo 1;
                     //redirect(base_url().'view-main-menu','refresh');
                 }    
                 }
                 //print_r($data1); die;
                 
                 
            }else{ redirect(base_url().'admin','refresh'); }
        }catch (Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
 }
 // edit permission get data
 public function edit_master_permission_form_get_data()
{
          try
            {
                if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
                {
                    $permission_id = $this->input->post('Permission_id'); 
                    $orderby= 'permission_id ASC';
                    $where1 = "permission_id = '$permission_id'";
                    $data1 = $this->Crud_modal->all_data_select('*','master_permission',$where1,$orderby);
                    echo json_encode($data1);
                }
                else
                {
                    redirect(base_url().'admin','refresh');
                }
            }
            catch (Exception $e)
            {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
}
public function  edit_master_permission_save(){
       try{
            if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
                 $permission_name = $this->input->post("edit_permission");
                 $permission_id = $this->input->post("edit_permission_id");
                 //echo "hai";
                 //die;
                 $table_name = 'master_permission';
                 $orderby= 'permission_id ASC';
                 $where1 = "(permission_description = '$permission_name') and permission_id != '$permission_id'";
                 $data1 = $this->Crud_modal->all_data_select('*','master_permission',$where1,$orderby);
                 $count1 = count($data1);
                 if($count1>=1){
                   echo 0;
                 }
                 else{
                   $field=array(
                     'permission_description'=> $permission_name,
                     'modification_date' =>date('Y-m-d H:i:s')
                 );
                 $where = "permission_id = '$permission_id'";
                 $tblname = 'master_permission';
                 $data = $this->Crud_modal->update_data($where,$tblname,$field);
                 if($data){
                     echo 1;
                     //redirect(base_url().'view-main-menu','refresh');
                 }    
                 }
                 //print_r($data1); die;
                 
                 
            }else{ redirect(base_url().'admin','refresh'); }
        }catch (Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
 }
 public function delete_master_permission()
{
          try
            {
                if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
                {
                    $permission_id = $this->input->post('permission_id'); 
                    $where="permission_id = '$permission_id'";
                    $tblname='master_permission';
                    $field = array(
                        'status'=>0);
                    if($this->Crud_modal->update_data($where,$tblname,$field)){
                        
                        echo '{"msg":"Assignment Deleted"}';
                    }else{
                         echo '{"msg":"Some Error"}';
                    }
                }
                else
                {
                    redirect(base_url().'admin','refresh');
                }
            }
            catch (Exception $e)
            {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }

}


public function map_role_permission_form_save()
{
          try
            {
                if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
                {
                	//print_r($_POST);
                   // echo "hai";
                    $menu_count = count($this->input->post('main_menu_id'));
                    $sub_count = count($this->input->post('sub_menu_id'));
                    $sub_sub_count = count($this->input->post('sub_sub_menu_id'));
                    $menu_id = $this->input->post('main_menu_id');
                   // print_r($menu_id);
                    $sub_id = $this->input->post('sub_menu_id');
                    $sub_sub_id = $this->input->post('sub_sub_menu_id');
                    $loopj_count = 0;
                    $loopk_count = 0;
                    for($i=0; $i<=$menu_count-1; $i++){
                    	$m = $menu_id[$i];
                    	$string[$i] = $m."|";
                         for($j=0; $j<=$sub_count-1; $j++){
                         	    $subb_id = explode('$',$sub_id[$j]);
                            $s = $subb_id[0]; 
                            if($m==$s){
                               $string[$i] .= $sub_id[$j]."|"; 
                            }
                          
                        }
                        $string[$i] = rtrim($string[$i],'|');
                        // print_r($string);
                        for($k=0; $k<=$sub_sub_count-1; $k++){
                             $ssubb_id = explode('$',$sub_sub_id[$k]);
                            // print_r($ssubb_id);
                            $s = $ssubb_id[0]; 
                            if($m==$s){
                               //$string[$i] = $string[$i]."|".$sub_sub_id[$j]."|";
                               $string[$i] = $string[$i]."|".$sub_sub_id[$k]; 
                               //echo"<br/>";
                            } 
                          }
                         //print_r($string);
                    }
                    $access_master_menu = implode('&&',$string);
                    $role = $this->input->post('group_type');
                    $perm = $this->input->post('Permission');
                    $permission = implode('|',$perm);
					$portlet_id = $this->input->post("Portlet");
                    $pids=implode(",",$portlet_id);
                    $table_name = 'mapping_role_permission_master_menu';
                     $field=array(
                     'role_id'=> $role,
                     'permission_id'=> $permission,
                     'menu_master_id'=> $access_master_menu,
                     'status' => 1,
					 'portlet_id' => $pids,
                     'creation_date' =>date('Y-m-d H:i:s')
                     );
                     $orderby= 'role_id ASC';
                     $where1 = "role_id = '$role' and status=1";
                     $data1 = $this->Crud_modal->all_data_select('*','mapping_role_permission_master_menu',$where1,$orderby);
                     if($data1){
		                  echo 0;   
                         }else{
                         	$data = $this->Crud_modal->data_insert($table_name,$field);
		                     if($data){
		                         echo 1;
		                     }
                         	
                         }
                }
                else
                {
                    redirect(base_url().'admin','refresh');
                }
            }
            catch (Exception $e)
            {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            
}
public function delete_map_role_permission()
 {
	  	try
			{
				if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
			    {
			    	echo $role_id = $this->input->post('roleid'); 
			    	$where="role_id = '$role_id'";
			    	$tblname='mapping_role_permission_master_menu';
			    	$field = array(
			    		'status'=>0);
			    	if($this->Crud_modal->update_data($where,$tblname,$field)){
			    		
			    		echo '{"msg":"Record Deleted"}';
			    	}else{
			    	 	echo '{"msg":"Some Error"}';
			    	}
				}
				else
				{
				    redirect(base_url().'admin','refresh');
			    }
			}
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
 }public function  view_map_role_permission(){
    	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				    $data['title']='Admin Dashboard for Monday Morning';
				    $val=base64_decode(str_pad(strtr($this->uri->segment(2), '-_', '+/'), strlen($this->uri->segment(2)) % 4, '=', STR_PAD_RIGHT));
					$where = "status = '1'";
					$data['master_menu'] = $this->Crud_modal->all_data_select('*','master_menu',$where,'menu_id ASC');
					$where1 = "status = '1'";
					$data['master_sub_menu'] = $this->Crud_modal->all_data_select('*','master_sub_menu',$where1,'sub_menu_id ASC');
					$where2 = "status = '1'";
					$data['master_sub_sub_menu'] = $this->Crud_modal->all_data_select('*','master_sub_sub_menu',$where2,'sub_sub_menu_id ASC');
					$where3 = "status = '1'";
					$data['master_role'] = $this->Crud_modal->all_data_select('*','master_role',$where3,'role_id ASC');
					$where4 = "status = '1'";
					$data['master_permission'] = $this->Crud_modal->all_data_select('*','master_permission',$where4,'permission_id ASC');
					$where5 = "status = '1' and role_id = '$val'";
					$data['mapping_role_data'] = $this->Crud_modal->all_data_select('*','mapping_role_permission_master_menu',$where5,'role_id ASC');
					$data['master_portlets'] = $this->Crud_modal->all_data_select('*','mm_dashboard_portlet_map',$where4,'portlet_id ASC');
					$this->load->view('admintempletes/head');
					$this->load->view('admintempletes/header');	
				  	$this->load->view('admintempletes/sidebar');
					$this->load->view('view-map-role-permission', $data);
					$this->load->view('admintempletes/footer');
			}else{ redirect(base_url().'admin','refresh'); }
		}catch (Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
  }
  public function  edit_map_role_permission(){
       try{
            if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
                    $data['title']='Admin Dashboard for Monday Morning';
                    $val=base64_decode(str_pad(strtr($this->uri->segment(2), '-_', '+/'), strlen($this->uri->segment(2)) % 4, '=', STR_PAD_RIGHT));
                    $where = "status = '1'";
                    $data['master_menu'] = $this->Crud_modal->all_data_select('*','master_menu',$where,'menu_id ASC');
                    $where1 = "status = '1'";
                    $data['master_sub_menu'] = $this->Crud_modal->all_data_select('*','master_sub_menu',$where1,'sub_menu_id ASC');
                    $where2 = "status = '1'";
                    $data['master_sub_sub_menu'] = $this->Crud_modal->all_data_select('*','master_sub_sub_menu',$where2,'sub_sub_menu_id ASC');
                    $where3 = "status = '1'";
                    $data['master_role'] = $this->Crud_modal->all_data_select('*','master_role',$where3,'role_id ASC');
                    $where4 = "status = '1'";
                    $data['master_permission'] = $this->Crud_modal->all_data_select('*','master_permission',$where4,'permission_id ASC');
                    $where5 = "status = '1' and role_id = '$val'";
                    $data['mapping_role_data'] = $this->Crud_modal->all_data_select('*','mapping_role_permission_master_menu',$where5,'role_id ASC');
					$data['master_portlets'] = $this->Crud_modal->all_data_select('*','mm_dashboard_portlet_map',$where4,'portlet_id ASC');
                    $this->load->view('admintempletes/head');
                    $this->load->view('admintempletes/header');    
                      $this->load->view('admintempletes/sidebar');
                    $this->load->view('edit-map-role-permission', $data);
                    $this->load->view('admintempletes/footer');
            }else{ redirect(base_url().'admin','refresh'); }
        }catch (Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
 }

public function edit_map_role_permission_form_save()
{
         try
           {
               if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null )
               {
                   
                   $menu_count = count($this->input->post('main_menu_id'));
                   $sub_count = count($this->input->post('sub_menu_id'));
                   $sub_sub_count = count($this->input->post('sub_sub_menu_id'));
                   $menu_id = $this->input->post('main_menu_id');
                   $role_id = $this->input->post('update_role_id');
                   $sub_id = $this->input->post('sub_menu_id');
                   $sub_sub_id = $this->input->post('sub_sub_menu_id');
                   $loopj_count = 0;
                   $loopk_count = 0;
                   for($i=0; $i<=$menu_count-1; $i++){
                       $m = $menu_id[$i];
                       $string[$i] = $m."|";
                        for($j=0; $j<=$sub_count-1; $j++){
                                $subb_id = explode('$',$sub_id[$j]);
                           $s = $subb_id[0];
                           if($m==$s){
                              $string[$i] .= $sub_id[$j]."|";
                           }
                         
                       }
                       $string[$i] = rtrim($string[$i],'|');
                       for($k=0; $k<=$sub_sub_count-1; $k++){
                            $ssubb_id = explode('$',$sub_sub_id[$k]);
                           // print_r($ssubb_id);
                           $s = $ssubb_id[0];
                           if($m==$s){
                              //$string[$i] = $string[$i]."|".$sub_sub_id[$j]."|";
                              $string[$i] = $string[$i]."|".$sub_sub_id[$k];
                              //echo"<br/>";
                           }
                         }
                        //print_r($string);
                   }
                   $access_master_menu = implode('&&',$string);
                   $role = $this->input->post('group_type');
                   $perm = $this->input->post('Permission');
                   $permission = implode('|',$perm);
				   $pids = $this->input->post('Portlet');
                   $portids = implode(',',$pids);
                    $field=array(
                    'permission_id'=> $permission,
                    'menu_master_id'=> $access_master_menu,
					'portlet_id'=> $portids,
                    'modification_date' =>date('Y-m-d H:i:s')
                    );
                    $where = "role_id = '$role_id'";
                    $tblname = 'mapping_role_permission_master_menu';
                    $data = $this->Crud_modal->update_data($where,$tblname,$field);
                    // $orderby= 'role_id ASC';
                    // $where1 = "role_id = '$role' and status=1";
                    // $data1 = $this->Crud_modal->all_data_select('*','mapping_role_permission_master_menu',$where1,$orderby);
                    if($data){
                          echo 1;  
                        }else{
                                 echo 0;
                        }
               }
               else
               {
                   redirect(base_url().'admin','refresh');
               }
           }
           catch (Exception $e)
           {
               echo 'Caught exception: ',  $e->getMessage(), "\n";
           }
           
}
  
public function  testing_url(){
    	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				    $data['title']='Admin Dashboard for Monday Morning';
				    //print_r($session_set); 
				    echo $role = $this->session->userdata('admin_role'); 
				    $where_map = "status = '1' and role_id = '$role'";
					$sidebar_data['mapping_role_data'] = $this->Crud_modal->all_data_select('*','mapping_role_permission_master_menu',$where_map,'role_id ASC');
					//print_r($data['mapping_role_data']);
				    //die;
				    $val=base64_decode(str_pad(strtr($this->uri->segment(2), '-_', '+/'), strlen($this->uri->segment(2)) % 4, '=', STR_PAD_RIGHT));
					$where = "status = '1'";
					$data['master_menu'] = $this->Crud_modal->all_data_select('*','master_menu',$where,'menu_id ASC');
					$where1 = "status = '1'";
					$data['master_sub_menu'] = $this->Crud_modal->all_data_select('*','master_sub_menu',$where1,'sub_menu_id ASC');
					$where2 = "status = '1'";
					$data['master_sub_sub_menu'] = $this->Crud_modal->all_data_select('*','master_sub_sub_menu',$where2,'sub_sub_menu_id ASC');
					$where3 = "status = '1'";
					$data['master_role'] = $this->Crud_modal->all_data_select('*','master_role',$where3,'role_id ASC');
					$where4 = "status = '1'";
					$data['master_permission'] = $this->Crud_modal->all_data_select('*','master_permission',$where4,'permission_id ASC');
					$where5 = "status = '1' and role_id = '$val'";
					$data['mapping_role_data'] = $this->Crud_modal->all_data_select('*','mapping_role_permission_master_menu',$where5,'role_id ASC');
					$this->load->view('admintempletes/head');
					$this->load->view('admintempletes/header');	
				  	$this->load->view('admintempletes/dynamic_sidebar', $sidebar_data);
					$this->load->view('edit-map-role-permission', $data);
					$this->load->view('admintempletes/footer');
			}else{ redirect(base_url().'admin','refresh'); }
		}catch (Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
  }
  public function  view_map(){
    	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				    $data['title']='Admin Dashboard for Monday Morning';
				    $val=5;
					$where = "status = '1'";
					$data['master_menu'] = $this->Crud_modal->all_data_select('*','master_menu',$where,'menu_id ASC');
					$where1 = "status = '1'";
					$data['master_sub_menu'] = $this->Crud_modal->all_data_select('*','master_sub_menu',$where1,'sub_menu_id ASC');
					$where2 = "status = '1'";
					$data['master_sub_sub_menu'] = $this->Crud_modal->all_data_select('*','master_sub_sub_menu',$where2,'sub_sub_menu_id ASC');
					$where3 = "status = '1'";
					$data['master_role'] = $this->Crud_modal->all_data_select('*','master_role',$where3,'role_id ASC');
					$where4 = "status = '1'";
					$data['master_permission'] = $this->Crud_modal->all_data_select('*','master_permission',$where4,'permission_id ASC');
					$where5 = "status = '1' and role_id = '$val'";
					$data['mapping_role_data'] = $this->Crud_modal->all_data_select('*','mapping_role_permission_master_menu',$where5,'role_id ASC');
					$this->load->view('admintempletes/head');
					$this->load->view('admintempletes/header');	
				  	$this->load->view('admintempletes/sidebar');
					$this->load->view('view-mapping-demo', $data);
					$this->load->view('admintempletes/footer');
			}else{ redirect(base_url().'admin','refresh'); }
		}catch (Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
  }

public function  edit_employee_form_data_save(){
         if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
                $emp_name = $this->input->post("edit_emp_name");
                $contact = $this->input->post("edit_mobile");
                $email = $this->input->post("edit_emp_email");
                $role_id = $this->input->post("edit_role");
                $status = $this->input->post("edit_status");
                $emp_id = $this->input->post("edit_emp_id");
                $field=array(
                       'emp_name' => $emp_name,
                     'emp_contact' => $contact,
                     'role_id' => $role_id,
                     'status' => $status,
                     'modification_date' => date('Y-m-d H:i:s')
                     );

                $where = "emp_id = $emp_id";
                $tblname = 'admin';
                $data = $this->Crud_modal->update_data($where,$tblname,$field);
                if($data){
                    echo 1;
                }    
                
        }else{ redirect(base_url().'admin','refresh'); }
        
}
public function edit_employee_form_get_data()
{
          try
            {
                if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
                {
                    $id = $this->input->post('emp_id'); 
                    $orderby= 'emp_id ASC';
                    $where1 = "emp_id = '$id'";
                    $data1['edit_data'] = $this->Crud_modal->all_data_select('*','admin',$where1,$orderby);
                    // $data1['role_list']=$this->Crud_modal->all_data_select('*','master_role','status=1','role_id');
                    $data1['role_list']=$this->db->select("mr.role_id,r.role_name,r.role_description ")
                      ->from("mapping_role_permission_master_menu mr")
                      ->join("master_role r","mr.role_id=r.role_id","left")
                      ->get()
                      ->result_array();
                    echo json_encode($data1);
                }
                else
                {
                    redirect(base_url().'admin','refresh');
                }
            }
            catch (Exception $e)
            {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
}

public function single_map_role_detail(){
       try{
            if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
                    $data['title']='Admin Dashboard for Monday Morning';
                    $role = $this->input->post('role_id');
                    $where5 = "status = '1' and role_id = '$role'";
                    $data['mapping_role_data'] = $this->Crud_modal->all_data_select('*','mapping_role_permission_master_menu',$where5,'role_id ASC');
                    $firstarray = explode('&&',$data['mapping_role_data'][0]['menu_master_id']);
                    for($i=0; $i<count($firstarray); $i++){
                      $mapmenuid[] = explode('|',$firstarray[$i]);
                    }
                    $actionid = explode('|',$data['mapping_role_data'][0]['permission_id']);
                    for($j=0; $j<count($mapmenuid); $j++){
                        for($k=0; $k<count($mapmenuid[$j]); $k++){
                       
                            $resultarray[] = str_replace("$","_",$mapmenuid[$j][$k]);
                            
                        }
               
                    }
                    $resultarray[] = $actionid;
                    echo json_encode($resultarray);
            }else{ redirect(base_url().'admin','refresh'); }
        }catch (Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
 }

public function show_new_users_neurons(){
 		  try 
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     			ini_set('max_execution_time', 120); //120 seconds
						ini_set('memory_limit', '-1');
				    	$data['title']='Admin Dashboard for Monday Morning';
			     		$data['totaluser']=$this->Admindashboard_modal->total_reg_user();
						$usertype=$this->input->post('usertype');
						if($usertype != ''){
						$whereas = "user_type_id = '$usertype'";
						$data['reg_user_data']=$this->Crud_modal->all_data_select('*','user',$whereas,'mm_uid desc');
						$data['usert']=$usertype;
						}
						else{
							$data['reg_user_data']=$this->Crud_modal->fetch_alls('user','mm_uid desc');
						}
                   
						$data['assign_user_data']=$this->Admindashboard_modal->all_completed_assignment_with_user();
						$data['goingon_assign_user_data']=$this->Admindashboard_modal->all_going_assignment_with_user();
						$data['user_type']=$this->Crud_modal->fetch_alls('user_type','user_type_id desc');
						
						$data['case_unched']=$this->Admindashboard_modal->alldatawith_group_order('*','case_subjective_user_ans',"status=0",'c_s_u_a_id asc');
						$data['user_data']=$this->Admindashboard_modal->all_data();
						$data['score']=$this->Admindashboard_modal->all_score();
						$data['ticket_closed']=$this->Crud_modal->check_numrow('mm_ticket',"status='0'");
						$data['ticket_open']=$this->Crud_modal->check_numrow('mm_ticket',"status='1'");
					
                       	if($this->input->post('fromdate')!="" && $date_to=$this->input->post('todate') !=""){
                                     $date1=$this->input->post('fromdate');
                                     $date2=$this->input->post('todate');
                                      $date_from = date("Y-m-d", strtotime($date1));
                                      $date_to = date("Y-m-d", strtotime($date2.'+1 days'));
                                      $data['f_date']=$date1;
                                      $data['t_date']=$date2;

                                    
                                 }
                                 else{
                                          $date_to = date('Y-m-d');
                                          $date_to = date('Y-m-d',strtotime($date_to.'+1 days'));
                                          $date_from = date('Y-m-d', strtotime($date_to. ' - 10 days'));
                                          $data['f_date']=date("m/d/Y", strtotime($date_from));
                                           $data['t_date']=date("m/d/Y", strtotime($date_to.' - 1 days'));
    
                                 }
							$all_dates=$this->Admindashboard_modal->all_dailyreport_activity($date_from, $date_to);
							$i=0;
							foreach ($all_dates as $all_date) {
								
							$date = $all_date['date']; 
							$userdata[$i]['date']=date('d-m-Y',strtotime($date));//die;
							$userdata[$i]['user']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)='$date'");// total user on this date(new user)
							
							$userdata[$i]['assignment']= $this->Crud_modal->check_numrow('completed_level',"DATE(end_time)='$date' and status = 1");// complete assignment on this date
							$neurons= $this->Admindashboard_modal->all_dailyreport_neurons("DATE(created_date)='$date'");
							$userdata[$i]['neurons']= $neurons['neurons'];
							$userdata[$i]['alluser']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)<='$date'");///
							$temp_val=$this->Crud_modal->all_data_select("mm_uid","user","DATE(reg_date)='$date'","mm_uid DESC");
							
							// code for old user
                             $today_user = $this->Admindashboard_modal->all_distinct_data_select("uid","completed_level","DATE(end_time)='$date' and status=1","uid DESC");
                            
                             $old_user = 0;
                             $new_user = 0;
                             $tottl = count($today_user);
                             $temp1 = '';
                             $temp2 = '';
                             for($s=0; $s<$tottl; $s++){
                                   $uuid =  $today_user[$s]['uid'];
                                   $reg_date=$this->Crud_modal->fetch_single_data("reg_date","user","mm_uid='$uuid' and user_status='1'");
															 
                                   if(DATE("Y-m-d",strtotime($reg_date['reg_date']))==$date){
		                                 
									    if($s==0){
		                                   $temp2=$today_user[$s]['uid'];
		                                   }else{
		                                   	$temp2.=','.$today_user[$s]['uid'];
		                                   }
                                       $new_user++;
                                   }
                                   	else{
										
                                   		   if($s==0){
		                                   $temp1=$today_user[$s]['uid'];
		                                   }else{
		                                   	$temp1.=','.$today_user[$s]['uid'];
		                                   }
                                       $old_user++;
                                   	}

                             }
							 $new_user_neuran='';
							 $old_user_neuran='';
                             $old_user_id = trim($temp1,','); 
                             $new_user_id = trim($temp2,',');
                             if($old_user_id !=''){
                                  $old_user_neuran=$this->Crud_modal->all_data_select("sum(neurons) as neuran","score","u_id in($old_user_id) ","score_id DESC");
                             }
                             if($new_user_id !=''){
                             	$new_user_neuran=$this->Crud_modal->all_data_select("sum(neurons) as neuran","score","u_id in($new_user_id) and date(created_date)='$date'","score_id DESC");
                             }
                      
                             $userdata[$i]['old_neuan'] = $old_user_neuran[0]['neuran'];
                             $userdata[$i]['new_neuan'] = $new_user_neuran[0]['neuran'];
                             $userdata[$i]['old'] = $old_user;
							 $sizeof=sizeof($temp_val);//die;
							$count_val=0;
							$cc=0;
							if($sizeof>0){
							$ttt=0;
							for($k=0;$k<$sizeof;$k++){
							$uid=$temp_val[$k]['mm_uid'];
	                          $ttt=$this->Crud_modal->check_numrow('completed_level',"uid='$uid' and date(end_time)='$date' and status=1");
	                          if($ttt>0){
	                          $count_val+=1;
	                          $cc+=$ttt;
	                          }
							}
							$userdata[$i]['allusercount']=$count_val;
							}else{
							$userdata[$i]['allusercount']=$count_val;
							}
							$userdata[$i]['new_assignment']=$userdata[$i]['assignment']-$cc; // attempted package of old user
							$userdata[$i]['old_assignment']=$cc;  // attempted package of new user
							$i++;
							}
							
							$data['all_dates']=$userdata; 
						####### new code for attemped new user / attemped old user / end here ###########
						$all_dates=$this->Admindashboard_modal->all_dailyreport_activity($date_from, $date_to);
						$i=0;
						foreach ($all_dates as $all_date) {
							$date = $all_date['date'];
							$userdata[$i]['date']=date('d-m-Y',strtotime($date));
							$userdata[$i]['user']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)='$date'");
							$userdata[$i]['assignment']= $this->Crud_modal->check_numrow('completed_level',"DATE(end_time)='$date'");
							$neurons= $this->Admindashboard_modal->all_dailyreport_neurons("DATE(created_date)='$date'");
							$userdata[$i]['neurons']= $neurons['neurons'];
							$userdata[$i]['alluser']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)<='$date'");
							$i++; 
						}
						$data['all_dates']=$userdata; 
						########### daily report ###############
						##### package count #########

						$this->load->view('admintempletes/head',$data);
						$this->load->view('admintempletes/header',$data);	
						$this->load->view('admintempletes/sidebar',$data);
						$this->load->view('daily_users_neurons',$data,$olduser); 
						$this->load->view('admintempletes/footer');
						//$this->load->view('admintempletes/foot');
				 }
				  else
				 {					
				    redirect(base_url().'admin','refresh');
			     }
			}
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
 }
 public function show_old_users_neurons(){
 		  try 
			{
				   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
		     {
		     			ini_set('max_execution_time', 120); //120 seconds
						ini_set('memory_limit', '-1');
				    	$data['title']='Admin Dashboard for Monday Morning';
			     		$data['totaluser']=$this->Admindashboard_modal->total_reg_user();
						$usertype=$this->input->post('usertype');
						if($usertype != ''){
						$whereas = "user_type_id = '$usertype'";
						$data['reg_user_data']=$this->Crud_modal->all_data_select('*','user',$whereas,'mm_uid desc');
						$data['usert']=$usertype;
						}
						else{
							$data['reg_user_data']=$this->Crud_modal->fetch_alls('user','mm_uid desc');
						}
                   
                    // end here
						$data['assign_user_data']=$this->Admindashboard_modal->all_completed_assignment_with_user();
						$data['goingon_assign_user_data']=$this->Admindashboard_modal->all_going_assignment_with_user();
						$data['user_type']=$this->Crud_modal->fetch_alls('user_type','user_type_id desc');
					
						$data['case_unched']=$this->Admindashboard_modal->alldatawith_group_order('*','case_subjective_user_ans',"status=0",'c_s_u_a_id asc');
						$data['user_data']=$this->Admindashboard_modal->all_data();
						$data['score']=$this->Admindashboard_modal->all_score();
						$data['ticket_closed']=$this->Crud_modal->check_numrow('mm_ticket',"status='0'");
						$data['ticket_open']=$this->Crud_modal->check_numrow('mm_ticket',"status='1'");
					
							if($this->input->post('fromdate')!="" && $date_to=$this->input->post('todate') !=""){
                                     $date1=$this->input->post('fromdate');
                                     $date2=$this->input->post('todate');
                                      $date_from = date("Y-m-d", strtotime($date1));
                                      $date_to = date("Y-m-d", strtotime($date2.'+1 days'));
                                      $data['f_date']=$date1;
                                      $data['t_date']=$date2;

                                    
                                 }
                                 else{
                                          $date_to = date('Y-m-d');
                                          $date_to = date('Y-m-d',strtotime($date_to.'+1 days'));
                                          $date_from = date('Y-m-d', strtotime($date_to. ' - 10 days'));
                                          $data['f_date']=date("m/d/Y", strtotime($date_from));
                                           $data['t_date']=date("m/d/Y", strtotime($date_to.' - 1 days'));
    
                                 }
							$all_dates=$this->Admindashboard_modal->all_dailyreport_activity($date_from, $date_to);
							$i=0;
							foreach ($all_dates as $all_date) {
								
							$date = $all_date['date']; 
							$userdata[$i]['date']=date('d-m-Y',strtotime($date));//die;
							$userdata[$i]['user']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)='$date'");// total user on this date(new user)
							
							$userdata[$i]['assignment']= $this->Crud_modal->check_numrow('completed_level',"DATE(end_time)='$date' and status = 1");// complete assignment on this date
							$neurons= $this->Admindashboard_modal->all_dailyreport_neurons("DATE(created_date)='$date'");
							$userdata[$i]['neurons']= $neurons['neurons'];
							$userdata[$i]['alluser']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)<='$date'");///
							$temp_val=$this->Crud_modal->all_data_select("mm_uid","user","DATE(reg_date)='$date'","mm_uid DESC");
							//print_r($temp_val); 
							// code for old user
                             $today_user = $this->Admindashboard_modal->all_distinct_data_select("uid","completed_level","DATE(end_time)='$date' and status=1","uid DESC");
                            
                             $old_user = 0;
                             $new_user = 0;
                             $tottl = count($today_user);
                             $temp1 = '';
                             $temp2 = '';
                             for($s=0; $s<$tottl; $s++){
                                   $uuid =  $today_user[$s]['uid'];
                                   $reg_date=$this->Crud_modal->fetch_single_data("reg_date","user","mm_uid='$uuid' and user_status='1'");
															 
                                   if(DATE("Y-m-d",strtotime($reg_date['reg_date']))==$date){
		                                 
									    if($s==0){
		                                   $temp2=$today_user[$s]['uid'];
		                                   }else{
		                                   	$temp2.=','.$today_user[$s]['uid'];
		                                   }
                                       $new_user++;
                                   }
                                   	else{
										
                                   		   if($s==0){
		                                   $temp1=$today_user[$s]['uid'];
		                                   }else{
		                                   	$temp1.=','.$today_user[$s]['uid'];
		                                   }
                                       $old_user++;
                                   	}

                             }
							 $new_user_neuran='';
							 $old_user_neuran='';
                             $old_user_id = trim($temp1,','); 
                             $new_user_id = trim($temp2,',');
                             if($old_user_id !=''){
                                  $old_user_neuran=$this->Crud_modal->all_data_select("sum(neurons) as neuran","score","u_id in($old_user_id) ","score_id DESC");
                             }
                             if($new_user_id !=''){
                             	$new_user_neuran=$this->Crud_modal->all_data_select("sum(neurons) as neuran","score","u_id in($new_user_id) and date(created_date)='$date'","score_id DESC");
                             }
                      
                             $userdata[$i]['old_neuan'] = $old_user_neuran[0]['neuran'];
                             $userdata[$i]['new_neuan'] = $new_user_neuran[0]['neuran'];
                             $userdata[$i]['old'] = $old_user;
							 $sizeof=sizeof($temp_val);//die;
							$count_val=0;
							$cc=0;
							if($sizeof>0){
							$ttt=0;
							for($k=0;$k<$sizeof;$k++){
							$uid=$temp_val[$k]['mm_uid'];
	                          $ttt=$this->Crud_modal->check_numrow('completed_level',"uid='$uid' and date(end_time)='$date' and status=1");
	                          if($ttt>0){
	                          $count_val+=1;
	                          $cc+=$ttt;
	                          }
							}
							$userdata[$i]['allusercount']=$count_val;
							}else{
							$userdata[$i]['allusercount']=$count_val;
							}
							$userdata[$i]['new_assignment']=$userdata[$i]['assignment']-$cc; // attempted package of old user
							$userdata[$i]['old_assignment']=$cc;  // attempted package of new user
							$i++;
							}
							
							$data['all_dates']=$userdata; 
						####### new code for attemped new user / attemped old user / end here ###########
						$all_dates=$this->Admindashboard_modal->all_dailyreport_activity($date_from, $date_to);
						$i=0;
						foreach ($all_dates as $all_date) {
							$date = $all_date['date'];
							$userdata[$i]['date']=date('d-m-Y',strtotime($date));
							$userdata[$i]['user']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)='$date'");
							$userdata[$i]['assignment']= $this->Crud_modal->check_numrow('completed_level',"DATE(end_time)='$date'");
							$neurons= $this->Admindashboard_modal->all_dailyreport_neurons("DATE(created_date)='$date'");
							$userdata[$i]['neurons']= $neurons['neurons'];
							$userdata[$i]['alluser']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)<='$date'");
							$i++; 
						}
						$data['all_dates']=$userdata; 
						########### daily report ###############
						##### package count #########

						$this->load->view('admintempletes/head',$data);
						$this->load->view('admintempletes/header',$data);	
						$this->load->view('admintempletes/sidebar',$data);
						$this->load->view('old_users_neurons',$data,$olduser); 
						$this->load->view('admintempletes/footer');
						//$this->load->view('admintempletes/foot');
				 }
				  else
				 {					
				    redirect(base_url().'admin','refresh');
			     }
			}
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
   }

public function admin_change_password()
{
    try {
            if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null )
            {
                $uid=$this->session->userdata('adminid');
                //$uid=$this->session->userdata('mm_uid');
                $new=$this->input->post('newpassword');
                $conf= $this->input->post('confirmnewpassword');
                $oldpass=$this->input->post('oldpassword');
                $data = $this->Crud_modal->fetch_single_data('emp_password','admin',"emp_id='$uid'");
                $old_password=$data['emp_password'];
                //echo md5($oldpass);
                if($old_password==md5($oldpass)) {
                    if($this->input->post('newpassword')!=''&& $this->input->post('confirmnewpassword')!=''){
                        if($this->input->post('newpassword')==$this->input->post('confirmnewpassword')){
                          $pass=md5($this->input->post('newpassword'));
                          $where="emp_id='$uid'";
                            $data=array(
                            'emp_password' =>$pass,
                             );
                            $this->Crud_modal->update_data($where,'admin',$data);
                            echo json_encode(array('status' =>"1","message"=>"Password Update wait 2 sec..."));
                        }
                        else{
                            echo json_encode(array('status' =>"0",
                    "message"=>"New password  and confirm password does not match"
                     ));
                        }
                    }
                }else{
                    echo json_encode(array('status' =>"0",
                    "message"=>"Old password doesnot match"
                     ));
                }        
    }
}
     catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}	
public function admin_employee_change_password()
{
    try {
            if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null )
            {
                $uid=$this->session->userdata('adminid');
                $empid = $this->input->post('emp_pass_id'); 
                $email = $this->input->post('pass_email'); 
                $passw = $this->input->post('change_pass'); 
                //$uid=$this->session->userdata('mm_uid');
                //exit();
                //echo md5($oldpass);
                
                    if($this->input->post('change_pass')!=''){
                          $pass=md5($passw);
                          $where="emp_id='$empid'";
                            $data=array(
                            'emp_password' =>$pass,
                             );
                            $this->Crud_modal->update_data($where,'admin',$data);
                            echo json_encode(array('status' =>"1","message"=>"Password Update"));
                        
                        
                    }else{
                        echo json_encode(array('status' =>"0","message"=>"* Enter Password"));
                    }
                    
    }
}
     catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}
// code by khushboo 02-02-2018
 public function admin_home(){
   	   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null))
	   {
	   	$p=$this->session->userdata('portlets');
		if($p==''){
			$p=0;
		}
   	  	$data['portlets']=$port=$this->Crud_modal->all_data_select("portlet_id,portlet_name,status","mm_dashboard_portlet_map","status=1 and portlet_id in($p)","portlet_id ASC");
	   	$data['count_portlet']=sizeof($port);
		$pack_type=$this->Crud_modal->fetch_single_data("packages_id","package_map","usertype_id=2");
		$pack_type_id=$pack_type['packages_id'];
		$data['packages']=$this->Crud_modal->fetchdata_with_limit('package_id,package_name','mm_packages',"status=1 and package_id in($pack_type_id)",'package_id desc',"5");
	   	$data['case_unched']=$this->Admindashboard_modal->alldatawith_group_order('c_s_u_a_id','case_subjective_user_ans',"status=0",'c_s_u_a_id asc');
	   	$data['case_ched']=$this->Admindashboard_modal->alldatawith_group_order('c_s_u_a_id','case_subjective_user_ans',"status=1",'c_s_u_a_id asc');
	   	$data['ticket_closed']=$this->Crud_modal->check_numrow('mm_ticket',"status='0'");
		$data['ticket_open']=$this->Crud_modal->check_numrow('mm_ticket',"status='1'");
		$data['pending_submission']=sizeof($data['case_unched']);
		$data['completed_submission']=sizeof($data['case_ched']);
		$data['total_submission']=$data['pending_submission']+$data['completed_submission'];	

	   		$this->load->view('admintempletes/head');
			$this->load->view('admintempletes/header');	
			$this->load->view('admintempletes/sidebar');
			$this->load->view('admin-home',$data); 
			$this->load->view('admintempletes/footer');
	   }else{					
			redirect(base_url().'admin','refresh');
	   }
   }
   public function get_user_portlet(){
   	  if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
   	  	$limit=$this->input->post("limit"); 
   	  	$data['user_count']=$this->Crud_modal->fetch_single_data("count(mm_uid) as total_user","user","user_status in(0,1)");
   	  	$data['user'] = $uu = $this->Admindashboard_modal->get_users($limit);
	    for($i=0;$i<sizeof($uu);$i++){
	    	$id=$uu[$i]['mm_uid'];
	    	$uid=rtrim(strtr(base64_encode($id), '+/', '-_'), '=');//Package Id
			$data['user'][$i]['params']=$uid ;
	    }
	    echo json_encode($data);
	  }else{					
			redirect(base_url().'admin','refresh');
	  }
   }
   public function get_pending_submission_detail_portlet(){
   	   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
   	   	$limit=$this->input->post("limit"); 
   	$data['score']=$all_date=$this->Admindashboard_modal->alldatawith_group_order_with_limit('*','case_subjective_user_ans',"status=0",'c_s_u_a_id desc',"$limit");
	
		for($a=0;$a<sizeof($all_date);$a++) {
				$user_id=$all_date[$a]['u_id'];
				$caseid=$all_date[$a]['case_id'];
				$as_id=$all_date[$a]['maid'];
				$level_id=$all_date[$a]['ml_id'];

				$data['score'][$a]['user_info']=$this->Crud_modal->all_data_select("CONCAT(mm_user_full_name,' ', mm_last_name) as name, mm_user_email","user","mm_uid='$user_id'","mm_uid ASC");
				//print_r($data['user_info']);
				$data['score'][$a]['package_info'] = $this->Crud_modal->all_data_select("package_id, package_name","mm_packages","FIND_IN_SET('$as_id', 	ma_id)","package_id ASC");
				$data['score'][$a]['assigninfo_info']=$this->Crud_modal->all_data_select("assignment_name","master_assignment","maid='$as_id'","maid ASC");
				$data['score'][$a]['level_info']=$this->Crud_modal->all_data_select("lvl_name","master_level","ml_id='$level_id' and maid='$as_id'","ml_id ASC");

				$pck_id = $data['score'][$a]['package_info'][0]['package_id'];
				$qurstr1=rtrim(strtr(base64_encode($user_id), '+/', '-_'), '=');//User Id
				$qurstr2=rtrim(strtr(base64_encode($caseid), '+/', '-_'), '=');//Case Id
				$qurstr3=rtrim(strtr(base64_encode($as_id), '+/', '-_'), '=');//Assignment Id
                $qurstr5=rtrim(strtr(base64_encode($level_id), '+/', '-_'), '=');//Level Id
				$qurstr6=rtrim(strtr(base64_encode($pck_id), '+/', '-_'), '=');//Package Id
			    
			    $data['score'][$a]['params']=$qurstr1.'-'.$qurstr2.'-'.$qurstr3.'-'.$qurstr5.'-'.$qurstr6 ;
		}
   	 	echo json_encode($data); 
	 }
	 else{					
			redirect(base_url().'admin','refresh');
	 }
   }
    public function get_ticket_portlet(){
   	  if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
   	  	$limit=$this->input->post("limit"); 
   	  	$data['ticket']=$this->Admindashboard_modal->get_tickets($limit);
	   	echo json_encode($data);
	  }else{					
			redirect(base_url().'admin','refresh');
	  }
   }
    public function get_package_portlet(){
   	  if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
   	  	$limit=$this->input->post("limit"); 
   	  	$data['pack_count']=$this->Crud_modal->fetch_single_data("count(package_id) as total_packs","mm_packages","status in(0,1)");
   	  	$data['packages'] = $packs = $this->Crud_modal->fetchdata_with_limit("package_id,package_name,ma_id,total_marks","mm_packages","status=1","package_id desc","$limit");
   	  	for($i=0;$i<sizeof($packs);$i++){
   	  		$a=$packs[$i]['ma_id'];
   	  		$TL = $this->Admindashboard_modal->get_total_levels($a);
			$data['packages'][$i]['totalLevel']=$TL['totalLevel'];

			/*Code For Total Time-Start*/
			 $data1_level= $this->Crud_modal->all_data_select("time_limit,d_level", "master_level", "maid in($a) and ml_status=1", "ml_id asc");
	         $time_seconds=0; $total_marks=0;
	         for ($p = 0; $p < sizeof($data1_level); $p++) {
	            sscanf($data1_level[$p]['time_limit'], "%d:%d:%d", $hours, $minutes, $seconds);
	            $time_seconds+= (isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes);
	         }
	         $init = $time_seconds;
	         $hours = floor($init / 3600);
	         $minutes = (floor(($init / 60) % 60))."min";
	         $seconds = ($init % 60)." sec";
	         if($seconds==0){
	              $seconds="";
	         }
	         if($minutes==0){
	              $minutes="";
	         }
	         if($hours==0){
	              $hours="00";
	         }  
	         $data['packages'][$i]['totalTime']="$hours hrs $minutes ";
			/*Code For Total Time-Ends*/
   	  	}


	   	echo json_encode($data);
	  }else{					
			redirect(base_url().'admin','refresh');
	  }
   }   
	public function get_group_portlet(){
   	  if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
   	  	$limit=$this->input->post("limit"); 
   	  	$data['group_count']=$this->Crud_modal->fetch_single_data("count(group_id) as total_group","mm_group","status in(0,1)");
   	  	$data['group']=$this->Crud_modal->fetchdata_with_limit('group_id,group_name','mm_group',"status in(0,1)",'group_id DESC',"$limit");
   	  	$data['group'] = $groups = $this->Admindashboard_modal->get_groups($limit);

	    for($i=0;$i<sizeof($groups);$i++){
	    	$v=$groups[$i]['group_id'];  
	    	$member_list=$this->Crud_modal->all_data_select("group_member_id","mm_group_members","group_id='$v' and status='1'","group_member_id desc");
        	$data['group'][$i]['numberOfmember']=(sizeof($member_list)+1);
        	$data_neurons=$this->Userdashboard_modal->group_neurons($groups[$i]['group_id']); //echo $data_neurons[0]['tot']+($leader_neurons['neurons']); 
	   		$data['group'][$i]['totalNeurons']=$data_neurons[0]['tot']+($groups[$i]['neurons']);
	    }
	 	echo json_encode($data);
	  }else{					
			redirect(base_url().'admin','refresh');
	  }
   } 
   public function get_employer_portlet(){
   	  if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
   	  	$limit=$this->input->post("limit"); 
   	  	$data['emp_count']=$this->Crud_modal->fetch_single_data("count(employer_id) as total_emp","mm_employer","employer_status in(0,1)");
   	  	$data['employer']=$emp=$this->Crud_modal->fetchdata_with_limit('employer_id,employer_company,employer_contact_person_name,employer_mobile,web_link,employer_email','mm_employer',"eamil_auth_status in(0,1)",'employer_id DESC',"$limit");
   	  	for($i=0;$i<sizeof($emp);$i++){
	    	$id=$emp[$i]['employer_id'];
	    	$eid=rtrim(strtr(base64_encode($id), '+/', '-_'), '=');//Employer Id
			$data['employer'][$i]['params']=$eid ;
	    }
   	  	echo json_encode($data);
	  }else{					
			redirect(base_url().'admin','refresh');
	  }
   }	   
   public function get_employer_jobs_portlet(){
   	  if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
   	  	$limit=$this->input->post("limit"); 
   	  	$data['job_count']=$this->Crud_modal->fetch_single_data("count(job_id) as total_job","mm_master_job","1=1");
   	    $data['employer_jobs'] = $this->Admindashboard_modal->get_jobs($limit);
   	  	echo json_encode($data);
	  }else{					
			redirect(base_url().'admin','refresh');
	  }
   }	
   public function get_applied_jobs_portlet(){
   	  if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
   	  	$limit=$this->input->post("limit"); 
   	  	$data['ap_job_count']=$this->Crud_modal->fetch_single_data("count(applied_job_id) as total_ap_job","mm_user_applied_job","1=1");
   	  	$data['applied_jobs'] = $aus = $this->Admindashboard_modal->get_applied_jobs($limit);
	    for($i=0;$i<sizeof($aus);$i++){
	    	$id=$aus[$i]['uid'];
	    	$uid=rtrim(strtr(base64_encode($id), '+/', '-_'), '=');//Package Id
			$data['applied_jobs'][$i]['params']=$uid ;
	    }
   	  	echo json_encode($data);
	  }else{					
			redirect(base_url().'admin','refresh');
	  }
   }   	
   public function get_todays_system_neuron(){
       if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
       	 $d=date('Y-m-d');
         $data['system_neurons']=$this->Crud_modal->all_data_select('sum(neurons) as total_neurons','score',"DATE_FORMAT(created_date,'%Y-%m-%d') = DATE_FORMAT(created_date,'$d')",'neurons desc');
         echo $data['system_neurons'][0]['total_neurons'];
        }else{
           redirect(base_url().'admin','refresh');
       }
   }    
   public function get_weekly_system_neuron(){
       if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
       	 $curr_dt=date('Y-m-d');
       	 $timestamp = time()-86400;
		 $date = strtotime("-7 day", $timestamp);
		 $last_date = date('Y-m-d', $date);
         $data['system_neurons']=$this->Crud_modal->all_data_select('sum(neurons) as total_neurons','score',"DATE_FORMAT(created_date,'%Y-%m-%d') <= DATE_FORMAT(created_date,'$curr_dt') AND DATE_FORMAT(created_date,'%Y-%m-%d') >= DATE_FORMAT(created_date,'$last_date')",'neurons desc');
         echo $data['system_neurons'][0]['total_neurons'];
        }else{
           redirect(base_url().'admin','refresh');
       }
   }   
   public function get_monthly_system_neuron(){
       if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
       	 $curr_dt=date('Y-m-d');
       	 $timestamp = time()-86400;
		 $date = strtotime("-31 day", $timestamp);
		 $last_date = date('Y-m-d', $date);
         $data['system_neurons']=$this->Crud_modal->all_data_select('sum(neurons) as total_neurons','score',"DATE_FORMAT(created_date,'%Y-%m-%d') <= DATE_FORMAT(created_date,'$curr_dt') AND DATE_FORMAT(created_date,'%Y-%m-%d') >= DATE_FORMAT(created_date,'$last_date')",'neurons desc');
         echo $data['system_neurons'][0]['total_neurons'];
        }else{
           redirect(base_url().'admin','refresh');
       }
   }
   public function get_todays_users(){
       if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
       	 $d=date('Y-m-d');
         $data['users']=$this->Crud_modal->all_data_select('count(mm_uid) as total_users','user',"DATE_FORMAT(reg_date,'%Y-%m-%d') = DATE_FORMAT(reg_date,'$d')",'mm_uid desc');
         echo $data['users'][0]['total_users'];
        }else{
           redirect(base_url().'admin','refresh');
       }
   }    
   public function get_weekly_users(){
       if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
       	 $curr_dt=date('Y-m-d');
       	 $timestamp = time()-86400;
		 $date = strtotime("-7 day", $timestamp);
		 $last_date = date('Y-m-d', $date);
         $data['users']=$this->Crud_modal->all_data_select('count(mm_uid) as total_users','user',"DATE_FORMAT(reg_date,'%Y-%m-%d') <= DATE_FORMAT(reg_date,'$curr_dt') AND DATE_FORMAT(reg_date,'%Y-%m-%d') >= DATE_FORMAT(reg_date,'$last_date')",'mm_uid desc');
          echo $data['users'][0]['total_users'];
        }else{
           redirect(base_url().'admin','refresh');
       }
   }   
   public function get_monthly_users(){
       if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
       	 $curr_dt=date('Y-m-d');
       	 $timestamp = time()-86400;
		 $date = strtotime("-31 day", $timestamp);
		 $last_date = date('Y-m-d', $date);
         $data['users']=$this->Crud_modal->all_data_select('count(mm_uid) as total_users','user',"DATE_FORMAT(reg_date,'%Y-%m-%d') <= DATE_FORMAT(reg_date,'$curr_dt') AND DATE_FORMAT(reg_date,'%Y-%m-%d') >= DATE_FORMAT(reg_date,'$last_date')",'mm_uid desc');
         echo $data['users'][0]['total_users'];
        }else{
           redirect(base_url().'admin','refresh');
       }
   }
public function get_mm_summary(){
		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
		    ini_set('max_execution_time', 120); //120 seconds

		    $input_date=$this->input->post("date");
		    $data['totaluser']=$this->Admindashboard_modal->total_reg_user();
			$usertype=$this->input->post('usertype');
			if($usertype != ''){
				$whereas = "user_type_id = '$usertype'";
				$data['reg_user_data']=$this->Crud_modal->all_data_select('*','user',$whereas,'mm_uid desc');
				$data['usert']=$usertype;
			}else{
				$data['reg_user_data']=$this->Crud_modal->fetch_alls('user','mm_uid desc');
			}
            $data['assign_user_data']=$this->Admindashboard_modal->all_completed_assignment_with_user();
			$data['goingon_assign_user_data']=$this->Admindashboard_modal->all_going_assignment_with_user();
			$data['user_type']=$this->Crud_modal->fetch_alls('user_type','user_type_id desc');
			$data['case_unched']=$this->Admindashboard_modal->alldatawith_group_order('*','case_subjective_user_ans',"status=0",'c_s_u_a_id asc');
			$data['user_data']=$this->Admindashboard_modal->all_data();
			$data['score']=$this->Admindashboard_modal->all_score();
			
			$date = $input_date; 
			$userdata[0]['date']=date('d-m-Y',strtotime($date));//die;
			$userdata[0]['user']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)='$date'");// total user on this date(new user)
			$userdata[0]['assignment']= $this->Crud_modal->check_numrow('completed_level',"DATE(end_time)='$date' and status = 1");// complete assignment on this date
			$neurons= $this->Admindashboard_modal->all_dailyreport_neurons("DATE(created_date)='$date'");
			$userdata[0]['neurons']= $neurons['neurons'];
			$userdata[0]['alluser']= $this->Crud_modal->check_numrow('user',"DATE(reg_date)<='$date'");///
			$temp_val=$this->Crud_modal->all_data_select("mm_uid","user","DATE(reg_date)='$date'","mm_uid DESC");
			// code for old user
            $today_user = $this->Admindashboard_modal->all_distinct_data_select("uid","completed_level","DATE(end_time)='$date' and status=1","uid DESC");
            $old_user = 0; $new_user = 0; $tottl = count($today_user);
            $temp1 = ''; $temp2 = '';
            for($s=0; $s<$tottl; $s++){
                $uuid =  $today_user[$s]['uid'];
                $reg_date=$this->Crud_modal->fetch_single_data("reg_date","user","mm_uid='$uuid' and user_status='1'");
				if(DATE("Y-m-d",strtotime($reg_date['reg_date']))==$date){
		            if($s==0){ 
		                $temp2=$today_user[$s]['uid'];  
		        	}else{	
		        		$temp2.=','.$today_user[$s]['uid'];  
		        	}
                    $new_user++;
                }else{
					if($s==0){
		                $temp1=$today_user[$s]['uid'];
		            }else{
		                $temp1.=','.$today_user[$s]['uid'];
		            }
                    $old_user++;
                }
            }
			$new_user_neuran=''; $old_user_neuran=''; $old_user_id = trim($temp1,','); $new_user_id = trim($temp2,',');
            if($old_user_id !=''){
                $old_user_neuran=$this->Crud_modal->all_data_select("sum(neurons) as neuran","score","u_id in($old_user_id) ","score_id DESC");
            }
            if($new_user_id !=''){
                $new_user_neuran=$this->Crud_modal->all_data_select("sum(neurons) as neuran","score","u_id in($new_user_id) and date(created_date)='$date'","score_id DESC");
            }
            $userdata[0]['old_neuan'] = $old_user_neuran[0]['neuran'];
            $userdata[0]['new_neuan'] = $new_user_neuran[0]['neuran'];
            $userdata[0]['old'] = $old_user;
			$sizeof=sizeof($temp_val);//die;
			$count_val=0; $cc=0;
			if($sizeof>0){
				$ttt=0;
				for($k=0;$k<$sizeof;$k++){
					$uid=$temp_val[$k]['mm_uid'];
	                $ttt=$this->Crud_modal->check_numrow('completed_level',"uid='$uid' and date(end_time)='$date' and status=1");
	                if($ttt>0){
	                    $count_val+=1;
	                    $cc+=$ttt;
	                }
				}
				$userdata[0]['allusercount']=$count_val;
			}else{
				$userdata[0]['allusercount']=$count_val;
			}
			$userdata[0]['new_assignment']=$userdata[0]['assignment']-$cc; // attempted package of old user
			$userdata[0]['old_assignment']=$cc;  // attempted package of new user
			$data['all_dates']=$khush=$userdata; 
			$link_fmdt=date('Y-m-d',strtotime($khush[0]['date']));
			$fmdt=date('M j, Y',strtotime($khush[0]['date']));

			$nneu=$khush[0]['new_neuan'];
			if($nneu==''){$nneu='0';}
			
			$attemp_old = $khush[0]['neurons']-$khush[0]['new_neuan']; 
			if($attemp_old=='' || $attemp_old==0){
				$attemp_old='0';
			}
			$data_fetch_pack=$this->Crud_modal->fetch_single_data("group_concat(package_id) as pack_id","mm_packages","pack_type_id=6");
			$concat=$data_fetch_pack['pack_id'];
			$field="distinct(s.u_id)";
			$table_name="score as s";
			$join1[0]='user as u';
			$join1[1]='u.mm_uid=s.u_id';
			$join1[2]="inner";
			$where="u.user_status=1 and s.package_id in($concat) and date(u.reg_date)='$date'";
			$data_set=$this->Crud_modal->fetch_data_by_one_table_join($field,$table_name,$join1,$where);
			$score_neurons=$this->Crud_modal->all_data_select('sum(neurons) as sum','score',"package_id in($concat) and date(created_date)='$date'",'package_id desc'); 
			$mm_neurons=$khush[0]['neurons']-$score_neurons[0]['sum'];
			$mm_user=$khush[0]['user']-(sizeof($data_set));
			echo "<td><a class='getRowData'  data-val='".$link_fmdt."' style='cursor: pointer;'>".$fmdt."</a></td>"."<td     data-toggle='tooltip' title='Employer user: ".sizeof($data_set)." , MM user:".$mm_user."'><span class='userdate' data-date='".$link_fmdt."'>".$khush[0]['user']."</span></td>"."<td>".$khush[0]['old_assignment']." (".$nneu.")"."</td>"."<td><span class='old_user' data-date='".$link_fmdt."'>".$khush[0]['old']."</span></td>"."<td>".$khush[0]['new_assignment']." (".$attemp_old.")"."</td>"."<td>".$khush[0]['assignment']."</td>"."<td data-toggle='tooltip' title='Employer neurons: ".$score_neurons[0]['sum'].", MM Neurons:".$mm_neurons."'>".$khush[0]['neurons']."</td>"."<td>".$khush[0]['alluser']."</td>";
			 
		}else{					
			redirect(base_url().'admin','refresh');
		}
	}
	public function view_brief_summary(){
	   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
	   	if($this->input->post('fromdate')!="" && $date_to=$this->input->post('todate')!=""){
           $date1=$this->input->post('fromdate');
           $date2=$this->input->post('todate');
           $data['f_date']=$date1;
           $data['t_date']=$date2;
           $curdate=date("Y-m-d", strtotime($date1));
           $end_date=date("Y-m-d", strtotime($date2));
		}else{
          // Start date
          $curdate = date('Y-m-d');
          // End date
          $timestamp = time()-86400;
          $date = strtotime("-6 day", $timestamp);
          $end_date = date('Y-m-d', $date);
          $data['f_date']=date("m/d/Y", strtotime($curdate));
          $data['t_date']=date("m/d/Y", strtotime($end_date));
        }
        $data["curdate"]=$curdate;
        $data["end_date"]=$end_date;
	   		$this->load->view('admintempletes/head');
			$this->load->view('admintempletes/header');	
			$this->load->view('admintempletes/sidebar');
			$this->load->view('view-brief-summary',$data); 
			$this->load->view('admintempletes/footer');
	   }else{					
			redirect(base_url().'admin','refresh');
	   }
	}   
	
	public function change_user_type(){
    if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" ||  $this->session->userdata('admin_role')!=null)){
     $id = $this->input->post('mm_uid');
     $ut = $this->input->post('user_type_id');
     $update_field=array('user_type_id'=> $ut);
      $where = "mm_uid = '$id'";
      $updateid = $this->Crud_modal->update_data($where,'user',$update_field);
      if($updateid>0){
        echo "1";
      }else{
          echo "0";
      }
    }else{                    
      redirect(base_url().'admin','refresh');
    } 
}

public function view_process_generator()
	{   
	    if($this->input->post('title') !="")
		{
	        $title = trim($this->input->post('title'));
		}
		else{
			$title = str_replace("%20",' ',($this->uri->segment(2))?$this->uri->segment(2):0);
		} 
		$allrecord = $this->pgn->get_process_generator_data('p.process_id desc',$title);
		$all=$this->input->post('get_all');
		$noOfrecords=10;
		if($all==1){
			$noOfrecords=$allrecord;
		}elseif($all==10){
				$noOfrecords=10;
		}elseif($all==25){
				$noOfrecords=25;
		}elseif($all==50){
				$noOfrecords=50;
		}elseif($all==100){
				$noOfrecords=100;
		}elseif($all==1000){
				$noOfrecords=1000;
		}elseif($all==5000){
				$noOfrecords=5000;
		}elseif($all==10000){
				$noOfrecords=10000;
		}elseif($all==15000){
				$noOfrecords=15000;
		}
		$data['noOfrecords']=$noOfrecords;
        $data['search_title']=$title;		
	//	$baseurl =  base_url().$this->router->class.'/'.$this->router->method."/".$title;
        $baseurl =  base_url()."view-process-generator/".$title;
	  	$paging=array();
		$paging['base_url'] =$baseurl;
		$paging['total_rows'] = $allrecord;
		$paging['per_page'] = $noOfrecords;
		$paging['uri_segment']= 3;
		$paging['num_links'] = 5;
		$paging['first_link'] = 'First';
		$paging['first_tag_open'] = '<li>';
		$paging['first_tag_close'] = '</li>';
		$paging['num_tag_open'] = '<li>';
		$paging['num_tag_close'] = '</li>';
		$paging['prev_link'] = 'Prev';
		$paging['prev_tag_open'] = '<li>';
		$paging['prev_tag_close'] = '</li>';
		$paging['next_link'] = 'Next';
		$paging['next_tag_open'] = '<li>';
		$paging['next_tag_close'] = '</li>';
		$paging['last_link'] = 'Last';
		$paging['last_tag_open'] = '<li>';
		$paging['last_tag_close'] = '</li>';
		$paging['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
		$paging['cur_tag_close'] = '</a></li>';
		
		$this->pagination->initialize($paging);	
		
		$data['limit'] = $paging['per_page'];
		$data['number_page'] = $paging['per_page']; 
        $data['offset'] = ($this->uri->segment(2)) ? $this->uri->segment(2):'0';
		$data['nav'] = $this->pagination->create_links();
        $data['datas'] = $this->pgn->get_process_generator_data_list($data['limit'],$data['offset'],$title);
        $data['topics']=$this->Crud_modal->all_data_select('t_id,t_name','master_topic',"status=1",'t_id desc');
		$this->load->view('admintempletes/head',$data);
        $this->load->view('admintempletes/header',$data);    
        $this->load->view('admintempletes/sidebar',$data);
        $this->load->view('view-process-generator',$data);
        $this->load->view('admintempletes/footer');
       
	}

	public function edit_process_generator(){
		$pid=$this->uri->segment(2);
		$proid=base64_decode(str_pad(strtr($pid, '-_', '+/'), strlen($pid) % 4, '=', STR_PAD_RIGHT));
		$data['process_data']=$this->Crud_modal->fetch_single_data('*','mm_process_generator',"process_id=$proid");
 		$data['mm_pro']=$this->Crud_modal->fetch_alls('user_data','uid asc');
		$where = 'status =1';
		$data['master_topics'] = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$where,'t_id desc');
		$data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$where,'type_id desc');
		$data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name',' master_skills_test',$where,'skills_id desc');
		$whereall = 'status =1';
		$data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$whereall,'diffi_id desc');
		$data['master_case'] = $this->Crud_modal->all_data_select('case_id,case_name','case_study',$where,'case_id desc');
	    $this->load->view('admintempletes/head',$data);
		$this->load->view('admintempletes/header',$data);	
		$this->load->view('admintempletes/sidebar',$data);
		$this->load->view('edit-process-generator',$data);
		$this->load->view('admintempletes/footer');
 	}

 	public function edit_process_insert(){
	 		$admin_id = $this->session->userdata('adminid');
	    	//print_r($this->input->post()); exit;
	    	$proid=$this->input->post('process_id');
	    	$first=$this->input->post('first_coordinate');
	    	$word=$this->input->post('word');
	    	$answer_word=$this->input->post('answer_word');
	    	$second=$this->input->post('second_coordinate');
	    	$cross_value=$this->input->post('question');
	    	$data_array=array(
						"process_question" => $this->input->post('process_question'),
						"process_array"   => implode(',', $word),
						"answer_array"   => implode(',', $answer_word),
						"row_count"   => $this->input->post('count_value'),
						"column_count"   => $this->input->post('count_row'),
						'topic' =>$this->input->post('master_topic'),
						'difficulty_level' => $this->input->post('master_difficulty_level'),
					    'type' => $this->input->post('master_type'),	
					    'skill_tested' => $this->input->post('master_skills_test'),
					    'case_id' => $this->input->post('master_case'),
						"status" => '1',
						"modified_by"   => $admin_id,
						"modified_date" => date('Y-m-d H:i:s')
					);
	    	//print_r($data_array);
	    	$where="process_id=$proid";
	    	if($this->Crud_modal->update_data($where,'mm_process_generator',$data_array)){
				$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Updated.</div>');
				redirect(base_url().'view-process-generator');
			}else{
				$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Update Data</div>');
				redirect(base_url().'view-process-generator');
			}

	 	}
 	#############
	 		// bucket user ans report
 	public function view_process_generator_user_answer(){
  		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
			$data['mm_pro']=$this->Crud_modal->fetch_alls('user_data','uid asc');
			$data['scores_lists'] = $this->Crud_modal->fetch_alls('score','score_id desc');
			$data['user_lists'] = $this->Crud_modal->fetch_alls('user','mm_user_full_name ASC');
			$data['package_lists']=$this->Admindashboard_modal->check_package_tool_type(11);
			//$data['package_lists'] = $this->Crud_modal->fetch_alls('mm_packages','package_id ASC');
			$this->load->view('admintempletes/head',$data);
			$this->load->view('admintempletes/header',$data);	 
			$this->load->view('admintempletes/sidebar',$data);
			$this->load->view('view-process-generator-user-answer',$data);
			$this->load->view('admintempletes/footer');
		}else{
			    redirect(base_url().'admin','refresh');
		}
	}
	public function get_process_user_ans_list(){ 
  		if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
	     	if($this->input->post('user_name') !="" && $this->input->post('package') !="" && $this->input->post('asignment') !="" && $this->input->post('level') !=""){
	     	   	$uid=$this->input->post('user_name');
	     	    $aid=$this->input->post('asignment');
	     	    $lid=$this->input->post('level');  
	     	    $where = "maid = '$aid' and ml_id = '$lid' and u_id = '$uid'";
				$data['user_ans_data'] = $this->Crud_modal->all_data_select('*','mm_process_user_ans',$where,'process_ans_id asc');
				$this->load->view('process-user-ans-list',$data);
	     	}
		}else{
			redirect(base_url().'admin','refresh');
		}
	}
//end of khushboo code 02-02-2018 
public function create_faq_question(){
  	if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
  	$data['faq_topic_list'] = $this->Crud_modal->all_data_select('*','mm_master_faq_topic','faq_status = 1','faq_id DESC');
    $data['faq_question'] = $this->Admindashboard_modal->get_faq_list();
  	$this->load->view('admintempletes/head');
	$this->load->view('admintempletes/header');	
	$this->load->view('admintempletes/sidebar');
	$this->load->view('create_faq_question',$data); 
	$this->load->view('admintempletes/footer');
	}else{ redirect(base_url().'admin','refresh'); }
  }

  public function get_sub_faq_topic(){
  	$topicid=$this->input->post('topicid');
		$data =$this->Crud_modal->all_data_select('*','mm_master_faq_sub_topic',"faq_id='$topicid' and faq_sub_topic_status=1",'faq_sub_topic_id desc');
		echo '<option value="">Select Sub-Topic</option>';
		for($i=0;$i<sizeof($data);$i++){
			echo '<option value="'.$data[$i]["faq_sub_topic_id"].'">'.$data[$i]["faq_sub_topic_name"].'</option>';										
		}
  }
  public function  insert_faq(){
    	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				 $aid=$this->session->userdata('adminid');
				 $fid = $this->input->post("faq_topic_id");
				 $fsid = $this->input->post("faq_sub_topic_id");
				 $q = $this->input->post("ques");
				 $a = $this->input->post("ans");
				 $show = $this->input->post("show_in");
				 $table_name = 'mm_master_faq_question';
				
				 $field=array(
				   	'faq_id' => $fid,
				 	'faq_sub_topic_id'=> $fsid,
				 	'question'=> $q,
				 	'answer'=> $a,
				 	'q_status' => 1,
				 	'q_show_in' => $show,
				 	'created_by' => $aid,
				 	'creation_date' =>date('Y-m-d H:i:s')
				 );
                 echo $this->Crud_modal->data_insert($table_name,$field);
                 
			}else{ redirect(base_url().'admin','refresh'); }
		}catch (Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
  }

 public function delete_faq(){
	if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
		$_id = $this->input->post('faq_qid'); 
		$where="faq_qid = '$_id'";
		$tblname='mm_master_faq_question';
		$field = array('q_status'=>0);
		if($this->Crud_modal->update_data($where,$tblname,$field)){
			echo '{"msg":"Question Deleted"}';
		}else{
			echo '{"msg":"Some Error"}';
		}
	}else{
		redirect(base_url().'admin','refresh');
	}
			
 }

 public function edit_faq_get_data(){
	if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
		$data1['faq_topic_list'] = $this->Crud_modal->all_data_select('*','mm_master_faq_topic','faq_status = 1','faq_id DESC');
		$_id = $this->input->post('faq_qid'); 
		$orderby= 'faq_qid ASC';
		$where1 = "faq_qid = '$_id'";
		$data1['faq_list'] = $fd=$this->Crud_modal->fetch_single_data('*','mm_master_faq_question',$where1);
		$fid=$fd['faq_id']; 
		$data1['faq_sub_topic_list']=$this->Crud_modal->all_data_select('*','mm_master_faq_sub_topic',"faq_sub_topic_status=1 and faq_id=$fid",'faq_sub_topic_id'); 
		echo json_encode($data1);
	}else{
		redirect(base_url().'admin','refresh');
	}
 }

public function  edit_faq(){
    	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				 $aid=$this->session->userdata('adminid');
				 $qid = $this->input->post("edit_faq_qid");
				 $fid = $this->input->post("edit_faq_topic_id");
				 $fsid = $this->input->post("edit_faq_sub_topic_id");
				 $q = $this->input->post("edit_ques");
				 $a = $this->input->post("edit_ans");
				 $show = $this->input->post("edit_show_in");
				 $table_name = 'mm_master_faq_question';
				
				 $field=array(
				   	'faq_id' => $fid,
				 	'faq_sub_topic_id'=> $fsid,
				 	'question'=> $q,
				 	'answer'=> $a,
				 	'q_status' => 1,
				 	'q_show_in' => $show,
				 	'modified_by' => $aid,
				 	'modification_date' =>date('Y-m-d H:i:s')
				 );
                 $t = $this->Crud_modal->update_data("faq_qid=$qid",$table_name,$field); 
                 echo $t;
                 
			}else{ redirect(base_url().'admin','refresh'); }
		}catch (Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
  }

  public function create_faq_topic(){
  	if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
  	$data['faq_topic_list'] = $this->Crud_modal->all_data_select('*','mm_master_faq_topic','faq_status = 1','faq_id DESC');
    $this->load->view('admintempletes/head');
	$this->load->view('admintempletes/header');	
	$this->load->view('admintempletes/sidebar');
	$this->load->view('create_faq_topic',$data); 
	$this->load->view('admintempletes/footer');
	}else{ redirect(base_url().'admin','refresh'); }
  }
  public function create_faq_sub_topic(){
  	if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
  	$data['faq_topic_list'] = $this->Crud_modal->all_data_select('*','mm_master_faq_topic','faq_status = 1','faq_id DESC');
  	$data['faq_sub_topic_list'] = $this->Admindashboard_modal->get_faq_sub_topic_list();
    $this->load->view('admintempletes/head');
	$this->load->view('admintempletes/header');	
	$this->load->view('admintempletes/sidebar');
	$this->load->view('create_faq_sub_topic',$data); 
	$this->load->view('admintempletes/footer');
	}else{ redirect(base_url().'admin','refresh'); }
  }
  public function  insert_faq_topic(){
    	try{
			if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
				 $aid=$this->session->userdata('adminid');
				 $fnm = $this->input->post("faq_topic_name");
				 $show = $this->input->post("faq_show_in");
				 $table_name = 'mm_master_faq_topic';
				
				 $field=array(
				   	'faq_name'=> $fnm,
				 	'faq_status' => 1,
				 	'faq_show_in' => $show,
				 	'created_by' => $aid,
				 	'creation_date' =>date('Y-m-d H:i:s')
				 );
                 echo $this->Crud_modal->data_insert($table_name,$field);
                 
			}else{ redirect(base_url().'admin','refresh'); }
		}catch (Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
  }
  public function delete_faq_topic(){
	if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
		$_id = $this->input->post('faq_id'); 
		$where="faq_id = '$_id'";
		$tblname='mm_master_faq_topic';
		$field = array('faq_status'=>0);
		if($this->Crud_modal->update_data($where,$tblname,$field)){
			echo '{"msg":"FAQ Topic Deleted"}';
		}else{
			echo '{"msg":"Some Error"}';
		}
	}else{
		redirect(base_url().'admin','refresh');
	}
			
 }

 public function edit_faq_topic_get_data(){
	if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
		$_id = $this->input->post('faq_id'); 
		$orderby= 'faq_id ASC';
		$where1 = "faq_id = '$_id'";
		$data1['faq_data'] = $this->Crud_modal->fetch_single_data('*','mm_master_faq_topic',$where1);
		echo json_encode($data1);
	}else{
		redirect(base_url().'admin','refresh');
	}
 }
 public function  edit_faq_topic(){
   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
	$aid=$this->session->userdata('adminid');
	$fid = $this->input->post("edit_faq_id");
	$fnm = $this->input->post("edit_faq_topic_name");
	$show = $this->input->post("edit_faq_show_in");
	$table_name = 'mm_master_faq_topic';
				
	$field=array(
		'faq_name'=> $fnm,
		'faq_show_in' => $show,
		'modified_by' => $aid,
		'modification_date' =>date('Y-m-d H:i:s')
	);
    $t = $this->Crud_modal->update_data("faq_id=$fid",$table_name,$field); 
    echo $t; 
                 
   }else{ redirect(base_url().'admin','refresh'); }
  }
  public function  insert_faq_sub_topic(){
    if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
		$aid=$this->session->userdata('adminid');
		$fid = $this->input->post("faq_topic_id");
		$fnm = $this->input->post("faq_sub_topic_name");
		$show = $this->input->post("faq_sub_topic_show_in");
		$table_name = 'mm_master_faq_sub_topic';
				
		$field=array(
			'faq_id'=> $fid,
			'faq_sub_topic_name'=> $fnm,
			'faq_sub_topic_status' => 1,
			'faq_sub_topic_show_in' => $show,
			'created_by' => $aid,
			'creation_date' =>date('Y-m-d H:i:s')
		);
        echo $this->Crud_modal->data_insert($table_name,$field);
                 
	}else{ redirect(base_url().'admin','refresh'); }
	
  }
  public function edit_faq_sub_topic_get_data(){
	if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
		$_id = $this->input->post('faq_sub_topic_id'); 
		$orderby= 'faq_sub_topic_id ASC';
		$where1 = "faq_sub_topic_id = '$_id'";
		$data1['faq_data'] = $this->Crud_modal->fetch_single_data('*','mm_master_faq_sub_topic',$where1);
		$data1['faq_topic_list']=$this->Crud_modal->all_data_select('*','mm_master_faq_topic',"faq_status=1",'faq_id');
		echo json_encode($data1);
	}else{
		redirect(base_url().'admin','refresh');
	}
 }
 public function  edit_faq_sub_topic(){
   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
	$aid=$this->session->userdata('adminid');
	$fsid = $this->input->post("edit_faq_sub_topic_id");
	$fid = $this->input->post("edit_faq_topic_id");
	$fnm = $this->input->post("edit_faq_sub_topic_name");
	$show = $this->input->post("edit_faq_sub_topic_show_in");
	$table_name = 'mm_master_faq_sub_topic';
				
	$field=array(
		'faq_id'=> $fid,
		'faq_sub_topic_name'=> $fnm,
		'faq_sub_topic_show_in' => $show,
		'modified_by' => $aid,
		'modification_date' =>date('Y-m-d H:i:s')
	);
    $t = $this->Crud_modal->update_data("faq_sub_topic_id=$fsid",$table_name,$field);  
    echo $t; 
                 
   }else{ redirect(base_url().'admin','refresh'); }
  }
  public function delete_faq_sub_topic(){
	if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
		$_id = $this->input->post('faq_sub_topic_id'); 
		$where="faq_sub_topic_id = '$_id'";
		$tblname='mm_master_faq_sub_topic';
		$field = array('faq_sub_topic_status'=>0);
		if($this->Crud_modal->update_data($where,$tblname,$field)){
			echo '{"msg":"FAQ Sub Topic Deleted"}';
		}else{
			echo '{"msg":"Some Error"}';
		}
	}else{
		redirect(base_url().'admin','refresh');
	}
			
 }
 public function auto_submit_create(){
     try{
            if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
                    $data['title']='Admin Dashboard for Monday Morning';
                    $where = 'status =1';
					$data['master_topics'] = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$where,'t_id desc');
					$data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$where,'type_id desc');
					$data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name',' master_skills_test',$where,'skills_id desc');
					$whereall = 'status =1';
					$data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$whereall,'diffi_id desc');
					$data['master_case'] = $this->Crud_modal->all_data_select('case_id,case_name','case_study',$where,'case_id desc');
                    $this->load->view('admintempletes/head',$data);
					$this->load->view('admintempletes/header',$data);    
					$this->load->view('admintempletes/sidebar',$data);
					$this->load->view('create-auto-submit',$data);
					$this->load->view('admintempletes/footer');
            }else{ redirect(base_url().'admin','refresh'); }
        }catch (Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
}
public function insert_auto_submit(){
     try{
            if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
                    $data['title']='Admin Dashboard for Monday Morning';
                    $admin_id = $this->session->userdata('adminid');
                      $headings = implode('&&', $this->input->post('heading'));
                      $count_total = $this->input->post('count');
                      for($i=1; $i<=$count_total; $i++){
                      	$area = $this->input->post('area'.$i);
                        $desc = implode('&', $this->input->post('description'.$i));
                        $inves = implode('&', $this->input->post('investment'.$i));
                        $feas = implode('&', $this->input->post('feasibilty'.$i));
                        $complete_row[] = $area.'|'.$desc.'|'.$inves.'|'.$feas;
                      }
                      $ques_detail = implode('&&', $complete_row);

                      $data_array=array(
						"question_context" => $this->input->post('question'),
						"question_details"   => $ques_detail,
						"case_title"=> $this->input->post('case_title'),
						"question_heading"   => $headings,
						'topic' =>$this->input->post('master_topic'),
						'difficulty_level' => $this->input->post('master_difficulty_level'),
					    'type' => $this->input->post('master_type'),	
					    'skill_tested' => $this->input->post('master_skills_test'),
					    'case_id' => $this->input->post('master_case'),
						"created_date" => date('Y-m-d H:i:s'),
						"status" => '1',
						"created_by"   => $admin_id,
					);
                      if($this->Crud_modal->data_insert('mm_auto_submit',$data_array)){
							$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Inserted.</div>');
							redirect(base_url().'auto-submit-create');
						}else{
							$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Insert Data</div>');
							redirect(base_url().'auto-submit-create');
						}
                    
            }else{ redirect(base_url().'admin','refresh'); }
        }catch (Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
}
public function view_auto_submit(){
     try{
            if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
                    $data['title']='Admin Dashboard for Monday Morning';
                    $admin_id = $this->session->userdata('adminid'); 
                 $data['auto_submit']= $this->Crud_modal->all_data_select('*','mm_auto_submit',"status=1", 'auto_submit_id');
                //print_r( $data['auto_submit_id']); die;
                $this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('view-auto-submit',$data);
				$this->load->view('admintempletes/footer');
                    
            }else{ redirect(base_url().'admin','refresh'); }
        }catch (Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
}
public function edit_auto_submit(){
     try{
            if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
                    $data['title']='Admin Dashboard for Monday Morning';
                    $admin_id = $this->session->userdata('adminid');
                    $val=base64_decode(str_pad(strtr($this->uri->segment(2), '-_', '+/'), strlen($this->uri->segment(2)) % 4, '=', STR_PAD_RIGHT));
                     $where = 'status =1';
					$data['master_topics'] = $this->Crud_modal->all_data_select('t_id,t_name','master_topic',$where,'t_id desc');
					$data['master_types'] = $this->Crud_modal->all_data_select('type_id,type_name','master_type',$where,'type_id desc');
					$data['master_skills_tests'] = $this->Crud_modal->all_data_select('skills_id,skills_name',' master_skills_test',$where,'skills_id desc');
					$whereall = 'status =1';
					$data['master_difficulty'] = $this->Crud_modal->all_data_select('diffi_id,difficulty_level','master_difficulty_level',$whereall,'diffi_id desc');
					$data['master_case'] = $this->Crud_modal->all_data_select('case_id,case_name','case_study',$where,'case_id desc');
                    $data['auto_submit']= $this->Crud_modal->fetch_single_data('*','mm_auto_submit',"auto_submit_id='$val'");
                //print_r( $data['auto_submit']); die;
                $this->load->view('admintempletes/head',$data);
				$this->load->view('admintempletes/header',$data);	
			  	$this->load->view('admintempletes/sidebar',$data);
				$this->load->view('edit-auto-submit',$data);
				$this->load->view('admintempletes/footer');
                    
            }else{ redirect(base_url().'admin','refresh'); }
        }catch (Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
}
public function edit_auto_submit_save(){
     try{
            if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
                    $data['title']='Admin Dashboard for Monday Morning';
                    $admin_id = $this->session->userdata('adminid');
                    $id= $this->input->post('update_id');
                      $headings = implode('&&', $this->input->post('heading'));
                      $count_total = $this->input->post('count');
                      for($i=1; $i<=$count_total; $i++){
                      	$area = $this->input->post('area'.$i);
                        $desc = implode('&', $this->input->post('description'.$i));
                        $inves = implode('&', $this->input->post('investment'.$i));
                        $feas = implode('&', $this->input->post('feasibilty'.$i));
                        $complete_row[] = $area.'|'.$desc.'|'.$inves.'|'.$feas;
                      }
                      $ques_detail = implode('&&', $complete_row);

                      $data_array=array(
						"question_context" => $this->input->post('question'),
						"question_details"   => $ques_detail,
						"case_title"=> $this->input->post('case_title'),
						"question_heading"   => $headings,
						'topic' =>$this->input->post('master_topic'),
						'difficulty_level' => $this->input->post('master_difficulty_level'),
					    'type' => $this->input->post('master_type'),	
					    'skill_tested' => $this->input->post('master_skills_test'),
					    'case_id' => $this->input->post('master_case'),
						"created_date" => date('Y-m-d H:i:s'),
						"status" => '1',
						"created_by"   => $admin_id,
					);
                      if($this->Crud_modal->update_data("auto_submit_id='$id'",'mm_auto_submit',$data_array)){
							$this->session->set_flashdata('data_message','<div class="success"><strong>Success!</strong> Data Update Successfully.</div>');
							redirect(base_url().'view-auto-submit');
						}else{
							$this->session->set_flashdata('data_message','<div class="danger"><strong>Oops!</strong> Failed to Insert Data</div>');
							redirect(base_url().'view-auto-submit');
						}
                    
            }else{ redirect(base_url().'admin','refresh'); }
        }catch (Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
}
public function delete_auto_submit(){
     try{
            if($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null ){
                    $data['title']='Admin Dashboard for Monday Morning';
                    $admin_id = $this->session->userdata('adminid');
                    echo $val=base64_decode(str_pad(strtr($this->uri->segment(2), '-_', '+/'), strlen($this->uri->segment(2)) % 4, '=', STR_PAD_RIGHT));
                    $update_data = array(
		               'status' => '0',
		               'modified_by' => $admin_id,
		               'modified_date' => date('Y-m-d H:i:s')
		            	);
			$where = "auto_submit_id = '$val'";
			if($this->Crud_modal->update_data($where,'mm_auto_submit',$update_data)){
				$this->session->set_flashdata('bucket_message','<div class="success"><strong>Success!</strong> Data Deleted.</div>');
				redirect(base_url().'view-auto-submit');
			}else{
				$this->session->set_flashdata('bucket_message','<div class="danger"><strong>Oops!</strong> Failed to Delete Data</div>');
				redirect(base_url().'view-auto-submit');
			}
                   
                    
                    
            }else{ redirect(base_url().'admin','refresh'); }
        }catch (Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
}

public function view_blog_list(){
   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
        $join[0]="mm_master_blog_category as b_cat";
		$join[1]="b_cat.blog_cat_id=b.blog_cat_id";
		$join[2]="inner";
		$where="b.blog_status=1";
		$data['blog_list']=$this->Crud_modal->fetch_data_by_one_table_join('b.*,b_cat.blog_category_name',"mm_master_blog as b",$join,$where);
		$this->load->view('admintempletes/head');
        $this->load->view('admintempletes/header');    
        $this->load->view('admintempletes/sidebar');
        $this->load->view('view-blog-list', $data);
        $this->load->view('admintempletes/footer');
   }else{ redirect(base_url().'admin','refresh'); }
       
 }
 public function create_blog(){
   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
   	$data['blog_category_list']=$this->Crud_modal->all_data_select('*','mm_master_blog_category',"status=1",'blog_cat_id');
        $this->load->view('admintempletes/head');
        $this->load->view('admintempletes/header');    
        $this->load->view('admintempletes/sidebar');
        $this->load->view('create-blog',$data);
        $this->load->view('admintempletes/footer');
   }else{ redirect(base_url().'admin','refresh'); }
       
 }

 public function insert_blog(){
      if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" ||  $this->session->userdata('admin_role')!=null)){
      	
      	$aid=$this->session->userdata('adminid');
      	    $field=array(
      	    	'blog_cat_id'=> $this->input->post('category'),
				'blog_writer_name'=> $this->input->post('writer'),
				'blog_writer_name_status'=> $this->input->post('show_writer_name'),
				'blog_title'=> $this->input->post('title'),
				'blog_highlighter_desc'=> $this->input->post('highlighter_text'),
				'blog_highlighter_status'=> $this->input->post('show_highlighter'),
				'blog_content'=> $this->input->post('blog_content'),
				'blog_status'=>1,
				'blog_publish_status'=>0,
				'created_by' =>$aid,
				'creation_date' =>date('Y-m-d H:i:s')
			);
			$res=false;
				if(isset($_FILES['thumb_image']) && $_FILES['thumb_image']['name'] != ''){
				$file1 = $this->Admindashboard_modal->blog_image_upload('thumb_image',0);
				$filename= $_FILES["thumb_image"]["name"];
				$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
				$field['blog_thumb_image'] = time().'_thumb.'.$file_ext;
				$res=true;
			}
			if(isset($_FILES['banner_image']) && $_FILES['banner_image']['name'] != ''){
			    $file2 = $this->Admindashboard_modal->blog_image_upload('banner_image',1);
			    $filename= $_FILES["banner_image"]["name"];
				$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
			    $field['blog_banner_image'] = time().'_banner.'.$file_ext;
			    $res=true;
			}  
			
            if($res){   
                $data = $this->Crud_modal->data_insert('mm_master_blog',$field);
				if($data){ 
				$this->session->set_flashdata('data_message','<div class="success"><strong>Successfully Submitted!</strong></div>');
				redirect(base_url().'create-blog'); 
				}else{
				$this->session->set_flashdata('data_message','<div class="danger"><strong>Some Error Occurred!</strong></div>');
				redirect(base_url().'create-blog'); 
				}
            }else{
            	$this->session->set_flashdata('data_message','<div class="danger"><strong>File Uploading Error Occurred!</strong></div>');
				redirect(base_url().'create-blog');
            }
       }else{					
			redirect(base_url().'admin','refresh');
	   }
}
  public function delete_blog(){
	if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
		$_id = $this->input->post('blog_id'); 
		$where="blog_id = '$_id'";
		$tblname='mm_master_blog';
		$field = array('blog_status'=>0);
		if($this->Crud_modal->update_data($where,$tblname,$field)){
			echo '{"msg":"Record Deleted"}';
		}else{
			echo '{"msg":"Some Error"}';
		}
	}else{
		redirect(base_url().'admin','refresh');
	}
			
 }
  public function edit_blog(){
   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
   		$id=$uri=$this->uri->segment(2);
		$code= base64_decode(str_pad(strtr($id, '-_', '+/'), strlen($id) % 4, '=', STR_PAD_RIGHT));     
		$data['blog']=$this->Crud_modal->fetch_single_data("*","mm_master_blog","blog_id=$code");
   		$data['blog_category_list']=$this->Crud_modal->all_data_select('*','mm_master_blog_category',"status=1",'blog_cat_id');
        $this->load->view('admintempletes/head');
        $this->load->view('admintempletes/header');    
        $this->load->view('admintempletes/sidebar');
        $this->load->view('edit-blog',$data);
        $this->load->view('admintempletes/footer');
   }else{ redirect(base_url().'admin','refresh'); }
       
 }
 public function update_blog(){
      if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" ||  $this->session->userdata('admin_role')!=null)){
      	$aid=$this->session->userdata('adminid');
      	$bid=$this->input->post('blog_id'); 
      	    $field=array(
      	    	'blog_cat_id'=> $this->input->post('category'),
				'blog_writer_name'=> $this->input->post('writer'),
				'blog_writer_name_status'=> $this->input->post('show_writer_name'),
				'blog_title'=> $this->input->post('title'),
				'blog_highlighter_desc'=> $this->input->post('highlighter_text'),
				'blog_highlighter_status'=> $this->input->post('show_highlighter'),
				'blog_content'=> $this->input->post('blog_content'),
				'blog_status'=>1,
				'blog_publish_status'=>$this->input->post('publish_status'),
				'modified_by' =>$aid,
				'modification_date' =>date('Y-m-d H:i:s')
			);
			if($this->input->post('publish_status')==1){
				$field['blog_publish_date'] = date('Y-m-d H:i:s');
			}
   
         	$res=false;
			if(isset($_FILES['thumb_image']) && $_FILES['thumb_image']['name'] != ''){
				$file1 = $this->Admindashboard_modal->blog_image_upload('thumb_image',0);
				$filename= $_FILES["thumb_image"]["name"];
				$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
				$field['blog_thumb_image'] = time().'_thumb.'.$file_ext;
				$res=true;
			}
			if(isset($_FILES['banner_image']) && $_FILES['banner_image']['name'] != ''){
			    $file2 = $this->Admindashboard_modal->blog_image_upload('banner_image',1);
			    $filename= $_FILES["banner_image"]["name"];
				$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
			    $field['blog_banner_image'] = time().'_banner.'.$file_ext;
			    $res=true;
			}  
			
            $data = $this->Crud_modal->update_data("blog_id=$bid",'mm_master_blog',$field);
            $encoded_id=rtrim(strtr(base64_encode($bid), '+/', '-_'), '='); 
			if($data){  
				$this->session->set_flashdata('data_message','<div class="success"><strong>Successfully Updated!</strong></div>');
				redirect(base_url().'edit-blog/'.$encoded_id); 
			}else{
				$this->session->set_flashdata('data_message','<div class="danger"><strong>Some Error Occurred!</strong></div>');
				redirect(base_url().'edit-blog/'.$encoded_id); 
			}
            
       }else{					
			redirect(base_url().'admin','refresh');
	   }
  }
  public function view_blog(){
   if(($this->session->userdata('admin_name')!="" || $this->session->userdata('admin_name')!=null) && ($this->session->userdata('admin_role')!="" || $this->session->userdata('admin_role')!=null)){
   		$id=$uri=$this->uri->segment(2);
		$code= base64_decode(str_pad(strtr($id, '-_', '+/'), strlen($id) % 4, '=', STR_PAD_RIGHT));     
		//$data['blog']=$this->Crud_modal->fetch_single_data("*","mm_master_blog","blog_id=$code");
   		$join[0]="mm_master_blog_category as b_cat";
		$join[1]="b_cat.blog_cat_id=b.blog_cat_id";
		$join[2]="inner";
		$where="b.blog_status=1 and b.blog_id=$code";
		$data['blog']=$this->Crud_modal->fetch_data_by_one_table_join('b.*,b_cat.blog_category_name',"mm_master_blog as b",$join,$where);
        $this->load->view('admintempletes/head');
        $this->load->view('admintempletes/header');    
        $this->load->view('admintempletes/sidebar');
        $this->load->view('view-blog-preview',$data);
        $this->load->view('admintempletes/footer');
   }else{ redirect(base_url().'admin','refresh'); }
       
 }
public function csv_file_import(){
	 		            $this->load->view('admintempletes/head');
						$this->load->view('admintempletes/header');	
						$this->load->view('admintempletes/sidebar');
						$this->load->view('file-import', $data);
						$this->load->view('admintempletes/footer');   
	 		
	 	}
	 	
	public function csv_file_import_insert(){
	 	$count=0;
        $fp = fopen($_FILES['file']['tmp_name'],'r') or die("can't open file");
        $files = $_FILES['file']['name'];
        $FileType = pathinfo($files,PATHINFO_EXTENSION);
        if($FileType == "csv"){
	        while($csv_line = fgetcsv($fp,1024))
	        {
	        	$csv_line = array_map("utf8_encode", $csv_line); //added
	            $count++;
	            if($count == 1)
	            {
	                continue;
	            }//keep this if condition if you want to remove the first row
	            for($i = 0, $j = count($csv_line); $i < $j; $i++)
	            {
	                $insert_csv = array();
	                $insert_csv['mm_user_full_name'] = trim($csv_line[0]);
	                $insert_csv['mm_user_email'] = trim($csv_line[1]);
	                $insert_csv['passsword'] = trim($csv_line[2]);
	                $insert_csv['user_type_id'] = trim($csv_line[3]);
	                

	            }
	            $i++;
	            $data = array(
	            	'user_type_id' =>  $insert_csv['user_type_id'],
	                'mm_user_full_name' => $insert_csv['mm_user_full_name'],
	                'mm_user_email' => $insert_csv['mm_user_email'],
	                'user_password' => md5($insert_csv['passsword']),
	                'user_status' => '1',
	                'eamil_auth_status' => '1',
	                'signup' => 'Form',
					'reg_date'=>date("Y-m-d H:i:s")
	                //user_status
	               
	        	);
	        	$data_id = $this->Crud_modal->user_data_insert1('user', $data);
			        	if($data_id>0){
			        		$data_user = array(
			                'uid' => $data_id 
			        	);
                  
	        	}

			}
			$this->session->set_flashdata('mcq_message','<div class="success"><strong>Success!</strong> Data Uploaded.</div>');
			redirect(base_url().'csv-file-import');
		}else{
			$this->session->set_flashdata('mcq_message','<div class="success"><strong>Failed!</strong> Upload Only .CSV File</div>');
			redirect(base_url().'csv-file-import');
		}
	 }
	 


public function skill_wise_data(){
	$data['user_list']=$this->Crud_modal->all_data_select("mm_user_full_name,mm_user_email,mm_uid","user","date(reg_date)='2018-03-24' and mm_user_email like '%rivigo%'","mm_uid asc"); 
	$data['skills_id']=$this->Crud_modal->all_data_select("*","master_skills_test","skills_id in(7,11,22,23,24,13,9)","skills_id asc");
	$data['package_id']="42";
	$this->load->view('admintempletes/head');
	$this->load->view('admintempletes/header');	
	$this->load->view('admintempletes/sidebar');
	$this->load->view('skill-wise-user-data',$data);  
	$this->load->view('admintempletes/footer'); 
}


	public function get_interactive_answer(){
		$user_list=$this->Crud_modal->all_data_select("uid","mm_user_applied_job","job_id=104 and uid in(6380,6480,7203,6518,7521,6411,7298,7532,7631,7500,7095,6457)","");
		echo '<table><tr>';
		for ($i=0; $i <sizeof($user_list); $i++) {
			$uid=$user_list[$i]['uid'];
			$data_mcq_answer=$this->Crud_modal->fetch_single_data("user_ans","mm_case_interactive_user_answer","user_id='$uid' and maid='71' and ml_id='266'");
			$user_name=$this->Crud_modal->fetch_single_data("*","user","mm_uid='$uid'");
			$ans = explode(',',$data_mcq_answer['user_ans']);
			$count = count($ques);
			$count1 = count($ans);
			echo "<td>";
			if($i==0){
					for($j=0; $j<$count1; $j++)
					{ 
						  $data=$this->Crud_modal->fetch_single_data('diff_level,current_quest_id','mm_interactive_case_option',"option_id='$ans[$j]'");
						  $ques_id=$data['current_quest_id'];
						  $data_question=$this->Crud_modal->fetch_single_data('question','mm_interactive_case_study',"ques_id='$ques_id'");
					      echo "<li>".$data_question['question']."</li>";
					}
				}
				echo "</td>";
			echo "<td><ul>";
			
			echo "<li>".$user_name['mm_user_email']."</li>";
			
			//$ques = explode('ravi',$data_mcq_answer['ques_id']);
			
			if($count1>1){
					for($j=0; $j<$count1; $j++)
					{ 
						  $data=$this->Crud_modal->fetch_single_data('diff_level,current_quest_id','mm_interactive_case_option',"option_id='$ans[$j]'");
						  $ques_id=$data['current_quest_id'];
						  $data_question=$this->Crud_modal->fetch_single_data('question','mm_interactive_case_study',"ques_id='$ques_id'");
					      echo "<li>".$data['diff_level']."</li>";
					}
				}
				echo "</ul></td>";
				
		}
		 echo '</tr></table>';
	}
	
	public function get_interactive_answer1(){
		$user_list=$this->Crud_modal->all_data_select("uid","mm_user_applied_job","job_id=102","applied_job_id ASC");
		echo '<table><tr>';
		for ($i=0; $i <sizeof($user_list); $i++) {
			echo "<td><ul>";
			$uid=$user_list[$i]['uid'];
			$user_name=$this->Crud_modal->fetch_single_data("*","user","mm_uid='$uid'");
			//echo "<li>".$user_name['mm_user_email']."</li>";
			$data_mcq_answer=$this->Crud_modal->fetch_single_data("user_ans","mm_case_interactive_user_answer","user_id='$uid' and maid='70' and ml_id='265'");
			//$ques = explode('ravi',$data_mcq_answer['ques_id']);
			$ans = explode(',',$data_mcq_answer['user_ans']);
			$count = count($ques);
			$count1 = count($ans);
			if($count1>1){
					for($j=0; $j<$count1; $j++)
					{ 
						  $data=$this->Crud_modal->fetch_single_data('diff_level','mm_interactive_case_option',"option_id='$ans[$j]'");
					    	echo "<li>".$data['diff_level']."</li>";
					}
				}
				echo "</td></ul>";
		}
		 echo '</tr></table>';
	}
	
		public function get_marks_user_wise(){
		$user_list=$this->Crud_modal->all_data_select("uid","mm_user_applied_job","job_id='102'","applied_job_id ASC");
		echo '<table><tr>';
		for ($i=0; $i <sizeof($user_list); $i++) {
			echo "<td><ul>";
			$uid=$user_list[$i]['uid'];
			$user_name=$this->Crud_modal->fetch_single_data("*","user","mm_uid='$uid' and user_status='1'");
			//echo "<li>".$user_name['mm_user_email']."</li>";
			$data_mcq_answer=$this->Crud_modal->fetch_single_data("*","mcq_user_ans","u_id='$uid' and maid='68' and ml_id='257'");
			$ques = explode('ravi',$data_mcq_answer['ques_id']);
			$ans = explode('ravi',$data_mcq_answer['options']);	
			$count = count($ques);
			$count1 = count($ans);
			if($count>1){
					for($j=0; $j<$count; $j++)
					{ 
						  $data=$this->Crud_modal->fetch_single_data('question,c_answer,difficulty_level','mcq',"mcq_id='$ques[$j]'");
						  
	                      $str1=$ans[$j];
	                      $str2=$data['c_answer'];
	                       if(!(strcmp($str1, $str2))){
							    echo "<li>".$data['difficulty_level']."</li>";
					        }
					      else if($ans[$j]=='Not Attempt' || $ans[$j]=='not attempt'){
					    	echo "<li>NA</li>";
					       }else{
					    	 $color = "#ff00bf";
					    	echo "<li>0</li>";
					       }
					}
				}
				echo "</td></ul>";
		}
		 echo '</tr></table>';
	}
	
	public function case_sequence_answer(){
		#############case sequence ###################################
		$user_list=$this->Crud_modal->all_data_select("uid","mm_user_applied_job","job_id=102","applied_job_id ASC");
		echo '<table><tr>';
		for ($i=0; $i <sizeof($user_list); $i++) {
		echo "<td><ul>";
		$uid=$user_list[$i]['uid'];
		$user_name=$this->Crud_modal->fetch_single_data("*","user","mm_uid='$uid'");
		//echo "<li>".$user_name['mm_user_email']."</li>";
		$sequene_data= $this->Crud_modal->all_data_select('*','case_sequence_user_arranged',"maid='69' and u_id='$uid' and ml_id='259'",'s_u_id ASC');
		foreach($sequene_data as $sequencedata){
	    $ques = $sequencedata['ques_id'];
	    //$userques_count= count($ques);
		$cc=3;
	      $data=$this->Crud_modal->fetch_single_data('options,question,difficulty_level','sequence_questions',"sq_id='$ques'");
				if ($data['options'] == $sequencedata['user_ans']) {
					echo "<li>".$cc."</li>";
				}else{
					echo "<li>0</li>";
				}   
			}
			echo "</ul></td>";
			}
			 echo '</tr></table>';
		}
		
		

}