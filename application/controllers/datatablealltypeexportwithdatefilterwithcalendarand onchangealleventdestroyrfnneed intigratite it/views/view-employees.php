<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
			<title>Excel To HTML using codebeautify.org</title>
		</head>
		<body>
<link rel="stylesheet" href="https://cdn.rawgit.com/Chalarangelo/bootstrap-extend/880420ae663f7c539971ded33411cdecffcc2134/css/bootstrap-extend.min.css"/>
			<style>
				.invoice {
				  position: relative;
				  background: #fff;
				  border: 1px solid #f4f4f4;
				  padding: 0px 16px;
				  margin: 114px 25px;
				  padding-bottom: 20px;
				}

				table>thead>tr>th {
				  border-bottom: 1px solid #ecf0f5;
				}

				.show {
				  -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
				  -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
				  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
				}

				.table>thead>tr>th,
				.table>tbody>tr>th,
				.table>tfoot>tr>th,
				.table>thead>tr>td,
				.table>tbody>tr>td,
				.table>tfoot>tr>td {
				 border: 1px solid #ecf0f5;
				}

				.box-col {
				  border-top: 3px solid #112B4E;
				}

				.lel {
				  color: #fff;
				  text-align: center;
				  margin-bottom: 7px;
				  margin-top: 7px;
				}
				.table > caption + thead > tr:first-child > td,
				.table > caption + thead > tr:first-child > th,
				.table > colgroup + thead > tr:first-child > td,
				.table > colgroup + thead > tr:first-child > th,
				.table > thead:first-child > tr:first-child > td,
				.table > thead:first-child > tr:first-child > th {
				  border: 1px solid #fafafa;
				}
				.dd-mar {
				  margin-left: -27px;
				}
				.btn-col {
				  background-color: #112B4E;
				  border-color: #ecf0f5;
				}
				.ul-mar {
				  margin-top: 35px;
				  width: }
				.danger{
				  background-color: #f2dede;
				  border-color: #ebccd1;
				  color: #a94442;
				  text-align: center;
				  margin: auto;
				  margin-bottom: 15px;
				  margin-top: 30px;
				  padding: 10px;
				  width: 80%;
				  box-shadow: 0px 0px 10px #ebccd1;
				}
				.success {
				  background-color: #dff0d8;
				  border-color: #d6e9c6;
				  color: #3c763d;
				  text-align: center;
				  margin: auto;
				  margin-bottom: 15px;
				  margin-top: 30px;
				  padding: 10px;
				  width: 80%;
				  box-shadow: 0px 0px 10px #d6e9c6;
				}
				#levellist>div {
				  height: 34px;
				  line-height: 34px;
				  margin-bottom: 5px;
				  padding: 0px;
				}
				#levellist>div.col-md-3 {
				  font-weight: 700;
				}
				.action_btns{
					color:#3c8dbc; 
					cursor: default;
				}

.well{
    margin-top: 2px 0;
    padding:0px;
    padding-left: 28px;
    font-size:14px;
    font-weight: 500;
    border:none;
    box-shadow:none;
    background:none;
}
.main_menu_text{font-weight: 500; font-size:15px;}

/* Checkbox Hack */
.target-label {
 /*-webkit-appearance: push-button;
 -moz-appearance: button;
 display: inline-block;
 */
 padding: 1px 3px 1px 3px;
 cursor: pointer;
}
.target-label:hover{
    /*background:lime;*/
}
/* Default State */
.target-div {
}
/* Toggled State */
input[type=checkbox]:checked ~ .target-div {
  /*background: red;*/
}
.well {
   margin-bottom: 0px !important;
}
			</style>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<div class="row main">
					<div class="col-md-12">
						<div class="col-md-10 col-md-offset-1">
							<div class="col-md-12">
								<?php
										if($this->session->flashdata('type_insert_message')){
	              								echo $this->session->flashdata('type_insert_message');

	              						}
	              				?>
								
							</div>
							<div class="col-md-12">
                                      <div class="alert alert-success" id="success" style="display: none;text-align:center">
                                        Password Update Successfully...  
                                   </div>
                            </div>
							<section class="invoice show">
							
								<!-- title row -->
								<div class="row" style="background-color: #587EA3">
									<div class="col-md-12">
										<h2 class="lel">Employees</h2>
									</div>
								</div>
								<div class="clearfix" style="margin-top: 20px;"></div>
								<div class="">
									<div class="col-md-12"></div>
								</div>
								<!-- /.box-header -->
								<div class="clearfix"></div>
								<div class="row">
									<div class="col-md-12">
										<section class="content">
											<!-- SELECT2 EXAMPLE -->
											<div class="box box-col">
												<div class="box-header with-border"></div>
												<!-- /.box-header -->
												<div class="box-body">
													<div class="row">
														<div class="col-md-10">
															<?php 
													                   $permission_array=$this->session->userdata('permission_array');
													                   for($i=0;$i<sizeof($permission_array);$i++){
													                        $p =$this->Crud_modal->fetch_single_data('permission_description','master_permission',"permission_id='$permission_array[$i]'");
													                        $permission[] = $p["permission_description"];
													                   }
													        ?>
													        <?php if(in_array("Create", $permission)){ ?>
															<input type="button" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E" value=" + Add New Employee " data-toggle="modal" data-target="#addModal" />
															<?php } ?>
														</div>
														<div class="col-md-2" style="float:right; margin-bottom: 2%">
															<?php if(in_array("Export", $permission)){ ?>
				                        <input type="button" class="btn btn-primary btn-md" style="float: left; background-color:#112B4E; border-color: #112B4E; margin-left: 3px;" onclick="tableToExcel('testtable2', 'W3C Example Table');" value="Export to Excel" >
				                        <?php } ?>
                                     </div>
													</div>
													<!-- /.row -->
												</div>
												<!-- /.box-body -->
											</div>
											<!-- /.box -->
											<div class="col-md-12" style="padding-top: 10px;">
												<table class="table table-striped table-responsive" id="testtable2">
													<thead>
														<tr>
															<th>S.No</th>
															<th>Name</th>
															<th>Contact</th>
															<th>Email</th>
															<th>Role</th>
															<th>Status</th>
															<th>Change Password</th>
															<th>Created Date</th>
															<th>Modified Date</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php
																$a=1; 
															foreach ($master_employee_list as $list) {
														?>
														<tr>
															<td><?php echo $a."."; ?></td>
															<td><?php echo $list['emp_name'] ?></td>
															<td><?php echo $list['emp_contact'] ?></td>
															<td><?php echo $list['emp_email'] ?></td>
															<td><?php $ro=$this->Crud_modal->fetch_single_data('*','master_role','role_id = '.$list[role_id]); ?>
                                                                <span class="action_btns roleview" data-toggle="modal" data-target="#viewrole" data-id="<?php echo $list['role_id'] ?>"><?php echo $ro['role_name']; ?></span>
                                                                     <!--  <a data-toggle="modal" data-target="#editModal" data-id="<?php echo $list['emp_id'] ?>" title="<?php echo $ro['role_description'] ?>"><?php echo $ro['role_name'] ?></a> -->
                                                            </td>
															<td><?php if($list['status']==1){echo "Active"; }else{echo "Inactive"; } ?></td>
															<td>
                                                               <span data-toggle="modal" data-target="#change_emp_password" class="action_btns chan_emp_password" data-id="<?php echo $list['emp_id'] ?>" >
                                                                Click Here</span>
                                                                <input type="hidden" name="name_emp<?php echo $list['emp_id'] ?>" id="name_emp<?php echo $list['emp_id'] ?>" value="<?php echo $list['emp_email']; ?>">
                                                            </td>
															<td><?php echo date("d/m/Y g:i A", strtotime($list['creation_date'])); ?></td>
															<td>
																<?php if($list['modification_date']=="0000-00-00 00:00:00" || $list['modification_date']==""){}
																	  else echo date("d/m/Y g:i A", strtotime($list['modification_date'])); ?>
															</td>
															<td>
																<?php if(in_array("Edit", $permission)){ ?>
																<span class="action_btns editlink" data-toggle="modal" data-target="#editModal" data-id="<?php echo $list['emp_id'] ?>">&nbsp;Edit&nbsp;</span>
																<?php } ?>
																<?php 
																	if($list['status']==1){ 
																	   if(in_array("Deactivate", $permission)){
																?>
																<span data-toggle="modal" data-target="#myModal" class="action_btns inactive_link" data-id="<?php echo $list['emp_id'] ?>" >
																&nbsp;Deactivate&nbsp;</span>
																<?php }
																	}else{ if(in_array("Activate", $permission)){ ?>
																<span data-toggle="modal" data-target="#myModal" class="action_btns active_link" data-id="<?php echo $list['emp_id'] ?>" >
																&nbsp;Activate&nbsp;</span>
																<?php }} ?>
															</td>
														</tr>
														<?php
															$a++;
														    }
														?>
													</tbody>
												</table>
											</div>
										</section>
										<!-- /.content -->
									</div>
								</div>
							</section>
						</div>
						<div class="col-md-1"></div>
					</div>
				</div>
				<!-- /.content -->
				<div class="clearfix"></div>
			</div>

			<!--Modal For Add Master Menu-->
			<div class="container">
				<!-- Modal -->
				<div class="modal fade" id="addModal" role="dialog">
					<div class="modal-dialog" style="top: 10%;">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Add New Employee</h4>
							</div>
							<div class="box box-primary">
								<!-- <div class="box-header with-border"></div> -->
								<!-- /.box-header -->
								<!-- form start -->
								<form role="form" action="" method="post" id="master_employee_form">
									<div class="box-body">
										<div class="row">
											<div class="col-md-12">
												<div class="col-lg-6">
													<div class="form-group">
														<input type="text" name="emp_name" id="emp_name" class="form-control" placeholder="Employee Name*" />
													</div>
													<!-- /.form-group -->
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<input type="text" name="mob" id="mob" class="form-control number_validation" placeholder="Mobile Number*" />
													</div>
													<!-- /.form-group -->
												</div>
											</div>
											<div class="col-md-12">
												<div class="col-lg-6">
													<div class="form-group">
														<input type="text" name="email" id="email" class="form-control" placeholder="Email Id*" />
													</div>
													<!-- /.form-group -->
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<input type="text" name="pwd" id="pwd" class="form-control" placeholder="Password*" />
													</div>
													<!-- /.form-group -->
												</div>
											</div>
											<div class="col-md-12">
												<div class="col-lg-6">
													<div class="form-group">
											<select name="role" id="role" class="form-control">
															<option value="">Select Role*</option>
															<?php foreach ($master_role_list as $role){ ?>
																<option value="<?php echo $role['role_id']; ?>"><?php echo $role['role_name']; ?></option>
															<?php } ?>
														</select>
													</div>
													<!-- /.form-group -->
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<select name="status" id="status" class="form-control">
															<option value="">Select Status</option>
															<option value="1">Active</option>
															<option value="0">InActive</option>
														</select>
													</div>
													<!-- /.form-group -->
												</div>
											</div>
										</div>
										<!-- /.col-lg-6 -->
									</div>
									<!-- /.box-body -->
									<div class="box-footer">
										<span style="color:red" id="error_message" style="display: none"></span>
										<button style="float:right" type="button" class="btn btn-primary" id="form_insert">Submit</button>
									</div>
								</form>
								<!-- form END -->
								<!-- /.box -->
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--Modal For Edit Master Menu-->
			<div class="container">
				<!-- Modal -->
				<div class="modal fade" id="editModal" role="dialog">
					<div class="modal-dialog" style="top: 10%;">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Edit Employee</h4>
							</div>
							<div class="box box-primary">
								<div class="box-header with-border">
								</div>
								<!-- /.box-header -->
								<!-- form start -->
								<form role="form" action="" method="post" id="edit_employee_form">
									<div class="box-body">
										<div class="row">
											<div class="col-md-12">
												<div class="col-lg-6">
													<label>Employee Name*:</label>
													<div class="form-group">
														<input type="text" name="edit_emp_name" id="edit_emp_name" class="form-control" placeholder="Employee Name*" />
													</div>
													<!-- /.form-group -->
												</div>
												<div class="col-lg-6">
													<label>Mobile Number*:</label>
													<div class="form-group">
														<input type="text" name="edit_mobile" id="edit_mobile" class="form-control number_validation" placeholder="Mobile Number*" />
													</div>
													<!-- /.form-group -->
												</div>
											</div>
											<div class="col-md-12">
												<div class="col-lg-6">
													<label>Select Role*:</label>
													<div class="form-group">
														<select name="edit_role" id="edit_role" class="form-control">
															<option value="">Select Role*</option>
														</select>
													</div>
													<!-- /.form-group -->
												</div>
												<div class="col-lg-6">
													<label>Select Status:</label>
													<div class="form-group">
														<select name="edit_status" id="edit_status" class="form-control">
															<option value="">Select Status</option>
															<option value="1">Active</option>
															<option value="0">InActive</option>
														</select>
													</div>
													<!-- /.form-group -->
												</div>
											</div>
										</div>
										<!-- /.col-lg-6 -->
									</div>
									<!-- /.box-body -->
									<div class="box-footer">
										<input type="hidden" name="edit_emp_email" id="edit_emp_email" class="form-control" />
										<input type="hidden" name="edit_emp_id" id="edit_emp_id" class="form-control" />
										<span style="color:red" id="error_message2" style="display: none"></span>
										<button style="float:right" type="button" class="btn btn-primary" id="edit_form_insert">Submit</button>
									</div>
								</form>
								<!-- form END -->
								<!-- /.box -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--Modal for Delete COnfirmation-->
			<div id="myModal" class="modal fade" role="dialog">
			  <div class="modal-dialog" style="top: 20%;">
			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title status_title">
			        	Are you sure want to delete?
			        </h4>
			      </div>
			      <div class="modal-footer">
			      <button type="button" class="btn btn-default active_inactive_emp" id="" data-val="">Yes</button>
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>

			  </div>
			</div>
<!-- view map role -->
              <div class="container">
                <!-- Modal -->
                <div class="modal fade" id="viewrole" role="dialog">
                    <div class="modal-dialog modal-lg" style="top: 10%;">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" id="roledetail"></h4>
                            </div>
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                </div>
                                <div class="row">
                    <div class="col-md-12">
                        <section class="content">
                            <!-- SELECT2 EXAMPLE -->
                            <div class="box box-col" style="border-top: none;">
                                <!-- <div class="box-header with-border">
                                    <h3 class="box-title">Create Group</h3>
                                </div> -->
                                <!-- /.box-header -->
                                <div class="box-body findbox">
                                    <form autocomplete="off" method="post" action="" enctype="multipart/form-data" id="map_role_form">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- this div start for main menu -->
                                                <div class="col-lg-6" style="height: 500px; overflow-y: scroll;">
                                                <?php $i=1; $j=1; $k=3; $sub=1; $sub_sub=1;
                                                  foreach ($master_menu as $menu) {
                                                     ?>
                                                <div class="col-lg-12">
                                                    <!--Code For Menus--> 
                                                    <div class="main_menu1">
                                                        <button  class="btn btn-primary btn-toggle" type="button" data-toggle="collapse" style="font-size:10px; padding: 3px 6px;"
                                                           data-target="#collapseDataTargetExample<?php echo $i;?>" aria-expanded="false" aria-controls="collapseDataTargetExample">
                                                        </button>
                                                        <!-- <input type="checkbox" class="btn-primary checkmenu" />
                                                         --><!-- <span class=" target-label target-div">Main Menu</span> -->
                                                        <input type="checkbox" class="check_menu target-div" value="<?php echo $menu['menu_id']; ?>" id="<?php echo $menu['menu_id']; ?>" name="main_menu_id[]" disabled></input>
                                                        <label for="main_menu_id" class="main_menu_text target-label1"><?php echo $menu['menu_description']; ?></label>
                                                        <div class="collapse" id="collapseDataTargetExample<?php echo $i;?>">
                                                             
                                                                <?php $menuid = $menu['menu_id']; 
                                                                  foreach($master_sub_menu as $submenu){
                                                                    if($submenu['menu_id']==$menuid){
                                                                ?>
                                                                <div class="well">
                                                                <!--Code For Sub Menu Start-->
                                                                <button class="btn btn-default btn-toggle" type="button" data-toggle="collapse" style="font-size:10px; padding: 3px 6px;"
                                                                    data-target="#submenutarget<?php echo $j;?>" aria-expanded="false" aria-controls="collapseDataTargetExample1">
                                                                </button>
                                                                <input type="checkbox" class="check_sub_menu target-div" value="<?php echo $menuid."$".$submenu['sub_menu_id']; ?>" id="<?php echo $menuid."_".$submenu['sub_menu_id']; ?>" name="sub_menu_id[]" disabled></input>
                                                                <label for="sub_menu_id" class="main_menu_text target-label2"><?php echo $submenu['sub_menu_description']; ?></label>
                                                                <div class="collapse" id="submenutarget<?php echo $j;?>">
                                                                
                                                                        <!--Code For SUb Sub Menu Start-->
                                                                        <?php 
                                                                        
                                                                          $submenu_id = $submenu['sub_menu_id'];
                                                                            foreach($master_sub_sub_menu as $ssmenu){
                                                                            if(($ssmenu['menu_id']== $menuid) && ($ssmenu['sub_menu_id']== $submenu_id)){
                                                                           
                                                                        ?>
                                                                        <div class="well">
                                                                        <button class="btn btn-success btn-toggle" type="button" data-toggle="collapse" style="font-size:10px; padding: 3px 6px;"
                                                                            data-target="#sub_sub_menutarget<?php echo $k;?>" aria-expanded="false" aria-controls="sub_sub_menutarget<?php echo $i;?>">
                                                                        </button>
                                                                        <input type="checkbox" class="check_sub_sub_menu target-div" value="<?php echo $menuid."$".$submenu_id."$".$ssmenu['sub_sub_menu_id']; ?>" id="<?php echo $menuid."_".$submenu_id."_".$ssmenu['sub_sub_menu_id']; ?>" name="sub_sub_menu_id[]" disabled></input>
                                                                        <label for="sub_sub_menu_id" class="main_menu_text target-label3"><?php $sub_sub++; echo $ssmenu['sub_sub_menu_description']; ?></label>
                                                                        <div class="collapse" id="sub_sub_menutarget<?php echo $i;?>">
                                                                        <div class="well">
                                                                        </div>
                                                                        
                                                                        <!--Code For SUb Sub Menu Ends-->
                                                                        </div>
                                                                        </div>
                                                                   <?php $k++;}}$sub++; $sub_sub=1;?>
                                                                
                                                                <!--Code For Sub Menu Ends-->
                                                                
                                                                </div>
                                                                </div>
                                                                <?php $j++; } }$sub=1; ?>
                                                            
                                                        </div>
                                                    </div>
                                                </div>    
                                                <?php $i++; } ?>
                                                <input type="hidden" name="menu_count" value="<?php echo $i-1; ?>">
                                            </div>
                                                <!-- main menu end here -->
                                                <div class="col-lg-6">
                                                    <label>Select Role:</label>
                                                    <div class="form-group">
                                                        <select name="group_type" id="group_type" class="form-control" required="required" disabled>
                                                            <option value="">Role Type</option>
                                                            <?php foreach($master_role as $masterrole){?>
                                                              <option value="<?php echo $masterrole['role_id']; ?>"><?php echo $masterrole['role_name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <label>Choose Permissions:</label>
                                                    <?php foreach($master_permission as $masterpermission){?>
                                                    <div class="checkbox checkbox-primary checkbox-info" style="margin-left:20px">
                                                        <input type="checkbox" value="<?php echo $masterpermission['permission_id']; ?>"  name="Permission[]" id="action-<?php echo $masterpermission['permission_id']; ?>" disabled/><label><?php echo $masterpermission['permission_description']; ?></label>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                           <button type="button" class="btn btn-primary btn-md" data-dismiss="modal" style="float: right;background-color:#112B4E; border-color: #112B4E; margin-top: 20px;">Close</button>
                                       
                                        <!-- /.row -->
                                    </form>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </section>
                        <!-- /.content -->
                    </div>
                    
                </div>
                </section>
            </div>
            <div class="col-md-1"></div>
        </div>
                        <!-- /.content -->
                    </div>
                    
                    
                </div>
                </section>
                                <!-- form END -->
                                <!-- /.box -->
                            </div>
                   <!--Modal For Edit Master Menu-->
            <div class="container">
                <!-- Modal -->
                <div class="modal fade" id="change_emp_password" role="dialog">
                    <div class="modal-dialog" style="top: 10%;">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Change Password</h4>
                            </div>
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" action="" method="post" id="employee_password_form">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-lg-12">
                                                    <label>Employee email:</label>
                                                    <div class="form-group">
                                                        <input type="text" name="pass_email" id="pass_email" class="form-control"  readonly />
                                                        <input type="hidden" name="emp_pass_id" id="emp_pass_id">
                                                    </div>
                                                    <!-- /.form-group -->
                                                </div>
                                                <div class="col-lg-12">
                                                    <label>Enter New Password</label>
                                                    <div class="form-group">
                                                        <input type="text" name="change_pass" id="change_pass" class="form-control" placeholder="Enter New Password" />
                                                    </div>
                                                    <!-- /.form-group -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.col-lg-6 -->
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        
                                        <span style="color:red" id="error_m" style="display: none"></span>
                                        <button style="float:right" type="button" class="btn btn-primary" id="employee_password">Submit</button>
                                    </div>
                                </form>
                                <!-- form END -->
                                <!-- /.box -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Modal for Delete COnfirmation-->
            <!-- end map role here -->
            <!-- sdkjfhkj -->

			<script>
			  $(function () {
				$("#testtable2").DataTable({
			      "paging": true,
			      "lengthChange": true,
			      "searching": true,
			      "ordering": true,
			      "info": true,
			      "autoWidth": false
			    });
			  });
			  $(".active_link").click(function(){
				 var id = $(this).attr("data-id");
				 $('.status_title').html('Are you sure want to activate?');
				 $(".active_inactive_emp").attr("id",id);
				 $(".active_inactive_emp").attr("data-val",1);
			  });
			  $(".inactive_link").click(function(){
				 var id = $(this).attr("data-id");
				 $('.status_title').html('Are you sure want to deactivate?');
				 $(".active_inactive_emp").attr("id",id);
				 $(".active_inactive_emp").attr("data-val",0);
			  });
			  $(".active_inactive_emp").click(function(){
			  	 var st=$(this).attr("data-val");
					$.ajax({
					  method: "POST",
					  data: {'emp_id': $(this).attr("id"), 'status': st },
					  url: "<?php echo base_url() ?>delete-master-employee",
					  dataType: "JSON",
					  success: function(result){
					  	$('#myModal').modal('hide');
					  	if(st==1)
					  		alert('Employee Activated');
					  	if(st==0)
					  		alert('Employee Deactivated');
					  	location.reload();
					  }
					});
			  });
			   $(document).ready(function (){
				$("#form_insert").click(function (){
					var enm = $("#emp_name").val();
					var mb = $("#mob").val();
					var em = $("#email").val();
					var pwd = $("#pwd").val();
					var role = $("#role").val();
					var st = $("#status").val();
					if(enm !="" && em !="" && pwd!="" && mb!="" && role!=""){
						var filter1 = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
					    if (filter1.test($.trim(em))) {
								var filter = /^((\+)?(\d{2}[-]))?(\d{10}){1}?$/;
							    if (filter.test($.trim(mb))) {
							        	var url = "<?php echo base_url() ?>employee-master-insert"; // the script where you handle the form input.
									    $.ajax({
									           type: "POST",
									           url: url,
									           data: $("#master_employee_form").serialize(), // serializes the form's elements.
									           success: function(data)
									           {
									           	   if(data==0){
				                                    $("#error_message").css('display','block');;
										            $("#error_message").html('Data Already Exists');
									           	   }
									           	   if(data==1){
									           	     	$("#error_message").css('display','none');;
									           	    	$('#addModal').modal('hide');
									           	   	     location.reload();
									           	   }
									           }
									    });
										e.preventDefault(); // avoid to execute the actual submit of the form.
							    }
							    else{
							        $("#error_message").css('display','block');
									$("#error_message").html('Mobile Number is Invalid');
							        e.preventDefault();
							    }
								
					    }else{
						    $("#error_message").css('display','block');
							$("#error_message").html('Email id is invalid');
						}
					}else{
						$("#error_message").css('display','block');
						$("#error_message").html('Please Fill Required* Fields.');
					}
				});
			});
			   $(document).ready(function (){
                 $(".editlink").click(function(){ 
		            $.ajax({
					  method: "POST",
					  data: {'emp_id': $(this).attr("data-id")},
					  url: "<?php echo base_url() ?>edit-employee-form-get-data",
					  dataType: "JSON",
					  success: function(result){
					  	var json = result;
					  		 var emp_name = json.edit_data[0].emp_name;
	                         var contact = json.edit_data[0].emp_contact;
	                         var email = json.edit_data[0].emp_email;
	                         var role_id = json.edit_data[0].role_id;
	                         var status = json.edit_data[0].status;
	                         var emp_id = json.edit_data[0].emp_id;
	                          $("#edit_emp_name").val(emp_name);
	                          $("#edit_mobile").val(contact);
	                          $("#edit_emp_email").val(email);
	                          $("#edit_emp_id").val(emp_id);
	                          for(j=0;j<json.role_list.length;j++) {   
					           key=parseInt(json.role_list[j].role_id); value=json.role_list[j].role_name;
					           res=(key==role_id)?"selected":""; 
					            $('#edit_role').append('<option value="' + key + '" '+res+'>' +value + '</option>');
					          }
					          $('#edit_status').find('option[value="'+status+'"]').attr("selected",true);
					  }
					});
					    e.preventDefault(); 
                 });
			});
			  $(document).ready(function (){
				$("#edit_form_insert").click(function (){
					var emp_name = $("#edit_emp_name").val();
					var contact = $("#edit_mobile").val();
					var role_id = $("#edit_role").val();
					var status = $("#edit_status").val();
					var emp_id = $("#edit_emp_id").val(); 
					if(emp_name !="" && contact!="" && role_id!=""){
						var filter = /^((\+)?(\d{2}[-]))?(\d{10}){1}?$/;
					    if (filter.test($.trim(contact))) {
					        	var url = "<?php echo base_url() ?>edit-employee-form-data-save"; // the script where you handle the form input.
								  $.ajax({
								           type: "POST",
								           url: url,
								           data: $("#edit_employee_form").serialize(), // serializes the form's elements.
								           success: function(data)
								           {
								           	  if(data==0){
								           	   	$("#error_message2").css('display','block');
									            $("#error_message2").html('Data Already Exists');
								           	   }
								           	   if(data==1){
								           	     	$("#error_message2").css('display','none');
								           	    	$('#editModal').modal('hide');
								           	   	     location.reload();
								           	   }
								           },
								           error:function(){
								           }
								  });
						    	e.preventDefault(); // avoid to execute the actual submit of the form.
					    }
					    else{
					        $("#error_message2").css('display','block');
							$("#error_message2").html('Mobile Number is Invalid');
					        e.preventDefault();
					    }
						
					}else{
					    $("#error_message2").css('display','block');
						$("#error_message2").html('Please Fill Required* Fields.');
						e.preventDefault();
					}
				});
			});
			 $(document).on('keypress',".number_validation" ,function(event){
			   // Allow: backspace, delete, tab, escape, enter and Ensure that it is a number and stop the keypress
			    var key = window.event ? event.keyCode : event.which;
			    if (event.keyCode === 8 || event.keyCode === 46) {
			        return true;
			    } else if ( key < 48 || key > 57 ) {
			        alert('Write only the numbers');
			        return false;
			    } else {
			        return true;
			    }
			 });
			var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>

<script type="text/javascript">
                $('.roleview').click(function (){
                    var text = $(this).html();
                    $('#roledetail').html(text+" Role Map Detail");
                    var id = $(this).attr('data-id');
                     $("#group_type").val(id);
                     $.ajax({
                      method: "POST",
                      data: {'role_id': id},
                      url: "<?php echo base_url() ?>single-map-role-detail",
                      dataType: "JSON",
                      success: function(result){
                          // var json = JSON.parse(result);
                          var i;
                          var j;
                          //alert(result);
                          for(i=0; i<result.length; i++){
                              //console.log(result[i]);
                              
                              $('.findbox').find('#'+result[i]).prop('checked', true);
                          if(i==(result.length-1)){
                            for(j=0; j<result[i].length; j++){
                              $('#action-'+result[i][j]).prop('checked', true);
                            }
                          }
                          else{
                              $('.findbox').find('#'+result[i]).prop('checked', true);
                              //alert(result[i]);
                           }
                          }
                              // var emp_name = json.edit_data[0].emp_name;
                          }
                    });
                   
                });
            </script>
			
<script type="text/javascript">
                $(document).ready(function (){
                    $('.chan_emp_password').click(function (){
                        var empid = $(this).attr("data-id");
                        var emp_mail = $('#name_emp'+empid).val();
                        $('#pass_email').val(emp_mail);
                        $('#emp_pass_id').val(empid);
                        $('#change_pass').val('');
                        //change_pass
                    //      $.ajax({
                    //      method: "POST",
                    //      data: {'role_id': id},
                    //      url: "<?php echo base_url() ?>single-map-role-detail",
                    //      dataType: "JSON",
                    //      success: function(result){
                    //       // var json = JSON.parse(result);
                          
                    //       }
                    // });
                    });
                });
                $(document).ready(function (){
                    $('#employee_password').click(function (){
                         var url = "<?php echo base_url() ?>admin-employee-change-password";
                           $.ajax({
                             type: "POST",
                             url: url,
                             data: $("#employee_password_form").serialize(), // serializes the form's elements.
                             success: function(data)
                             { 
                                var mesg = JSON.parse(data);
                                if(mesg.status ==0){
                                  $('#error_m').css('display','block');
                                  $('#error_m').html(mesg.message);
                                }else{
                                    $('#success').css('display','block');
                                    $('#change_emp_password').modal('hide');
                                   $('#success').fadeIn();
                                }
                              
                             }
                           });
                    });
                });
            </script>
		</body>
	</html>