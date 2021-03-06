<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
			<title>Excel To HTML using codebeautify.org</title>
		</head>
		<body>
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
			</style>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<div class="row main">
					<div class="col-md-12">
						<div class="col-md-8 col-md-offset-2">
							<div class="col-md-12">
								<?php
										if($this->session->flashdata('type_insert_message')){
	              								echo $this->session->flashdata('type_insert_message');

	              						}
	              				?>
							</div>
							<section class="invoice show">
								<!-- title row -->
								<div class="row" style="background-color: #587EA3">
									<div class="col-md-12">
										<h2 class="lel">Sub Menu Master</h2>
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
														<div class="col-md-9">
															<?php 
													                   $permission_array=$this->session->userdata('permission_array');
													                   for($i=0;$i<sizeof($permission_array);$i++){
													                        $p =$this->Crud_modal->fetch_single_data('permission_description','master_permission',"permission_id='$permission_array[$i]'");
													                        $permission[] = $p["permission_description"];
													                   }
													        ?>
													        <?php if(in_array("Create", $permission)){ ?>
															<input type="button" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E" value=" + Add New Sub-Menu Master " data-toggle="modal" data-target="#addModal" />
															<a class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E; margin-left: 5px;"
															href="<?php echo base_url();?>view-sub-sub-menu">
																 + Add New Sub-Sub Menu 
															</a>
															<?php } ?>
														</div>
														<div class="col-md-3" style="float:right;">
															 <?php if(in_array("Export", $permission)){ ?>
				<input type="button" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E; margin-left: 3px;" onclick="tableToExcel('testtable2', 'W3C Example Table');" value="Export to Excel" >
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
															<th>Sub-Menu Name</th>
															<th>Menu Name</th>
															<th>Route Name</th>
															<th>Created Date</th>
															<th>Modified Date</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php
															$a=1;
															foreach ($master_sub_menu_list as $list) {
														?>
														<tr>
															<td><?php echo $a; ?></td>
															<td><?php echo $list['sub_menu_description'] ?></td>
															<td><?php 	$mnm=$this->Crud_modal->fetch_single_data('*','master_menu','menu_id = '.$list[menu_id]);
																		echo $mnm['menu_description'] ?></td>
															<td><?php echo $list['sub_menu_route'] ?></td>
															<td><?php echo $list['creation_date'] ?></td>
															<td><?php echo $list['modification_date'] ?></td>
															<td>
																 <?php if(in_array("Edit", $permission)){ ?>
																<span class="action_btns editlink" data-toggle="modal" data-target="#editModal" data-id="<?php echo $list['sub_menu_id']; ?>">&nbsp;Edit&nbsp;</span>
																 <?php } if(in_array("Delete", $permission)){ ?>
																<span data-toggle="modal" data-target="#myModal" class="action_btns deletelink" data-id="<?php echo $list['sub_menu_id']; ?>">&nbsp;Delete&nbsp;</span>
																<?php } ?>
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
								<h4 class="modal-title">Add New Sub Menu Master</h4>
							</div>
							<div class="box box-primary">
								<!-- <div class="box-header with-border"></div> -->
								<!-- /.box-header -->
								<!-- form start -->
								<form role="form" action="<?php echo base_url() ?>assign-update" method="post" enctype="multipart/form-data" id="master_sub_menu_form">
									<div class="box-body">
										<div class="row">
											<div class="col-md-12">
												<div class="col-lg-4">
													<label>Select Menu Name:</label>
												</div>
												<div class="col-lg-7">
													<div class="form-group">
														<select class="form-control" name="menu_id" id="menu_id">
															<option value="">Select Menu Name</option>
															<?php foreach ($master_menu_list as $menu){ ?>
																<option value="<?php echo $menu['menu_id']; ?>"><?php echo $menu['menu_description']; ?></option>
															<?php } ?>
															
														</select>
													</div>
													<!-- /.form-group -->
												</div>
												<div class="col-lg-1"></div>
											</div>
											<div class="col-md-12">
												<div class="col-lg-4">
													<label>Sub-Menu Name:</label>
												</div>
												<div class="col-lg-7">
													<div class="form-group">
														<input type="text" name="sub_menu_name" id="sub_menu_name" class="form-control" placeholder="Enter Sub-Menu Name"/>
													</div>
													<!-- /.form-group -->
												</div>
												<div class="col-lg-1"></div>
											</div>
											<div class="col-md-12">
												<div class="col-lg-4"><label>Route:</label></div>
												<div class="col-lg-7">
													<div class="form-group">
														<input type="text" name="sub_menu_route" id="sub_menu_route" class="form-control" placeholder="Enter Route" />
													</div>
												</div>
												<div class="col-lg-1"></div>
											</div>
										</div>
										<!-- /row -->
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
								<h4 class="modal-title">Edit Sub Menu Master</h4>
							</div>
							<div class="box box-primary">
								<div class="box-header with-border">
								</div>
								<!-- /.box-header -->
								<!-- form start -->
								<form role="form" action="" method="post" id="edit_sub_menu_form">
									<div class="box-body">
										<div class="row">
											<div class="col-md-12">
												<div class="col-lg-4">
													<label>Select Menu Name:</label>
												</div>
												<div class="col-lg-7">
													<div class="form-group">
														<select class="form-control" name="edit_menu_id" id="edit_menu_id">
															<option value="">Select Menu Name</option>
														</select>
													</div>
													<!-- /.form-group -->
												</div>
												<div class="col-lg-1"></div>
											</div>
											<div class="col-md-12">
												<div class="col-lg-4">
													<label>Sub-Menu Name:</label>
												</div>
												<div class="col-lg-7">
													<div class="form-group">
														<input type="text" name="edit_sub_menu_name" id="edit_sub_menu_name" class="form-control" placeholder="Sub-Menu Name"/>
													</div>
													<!-- /.form-group -->
												</div>
												<div class="col-lg-1"></div>
											</div>
											<div class="col-md-12">
												<div class="col-lg-4"><label>Route:</label></div>
												<div class="col-lg-7">
													<div class="form-group">
														<input type="text" name="edit_sub_menu_route" id="edit_sub_menu_route" class="form-control" placeholder="Route" />
													</div>
												</div>
												<div class="col-lg-1">
													<input type="hidden" name="edit_sub_menu_id" id="edit_sub_menu_id" class="form-control" />
												</div>
											</div>
										</div>
										<!-- /row -->
									</div>
									<!-- /.box-body -->
									<div class="box-footer">
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
			        <h4 class="modal-title">Are you sure want to delete?</h4>
			      </div>
			      <div class="modal-footer">
			      <button type="button" class="btn btn-default delete_sub_menu" id="">Yes</button>
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>

			  </div>
			</div>

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
			  $(".deletelink").click(function(){
				 var id = $(this).attr("data-id");
				 $(".delete_sub_menu").attr("id",id);
			  });
			
				$(".delete_sub_menu").click(function(){
					$.ajax({
					  method: "POST",
					  data: {'sub_menu_id': $(this).attr("id")},
					  url: "<?php echo base_url() ?>delete-master-sub-menu",
					  dataType: "JSON",
					  success: function(result){
					  	$('#myModal').modal('hide');
					  	alert('Record Deleted');
					  	location.reload();
					  }
					});
				});
			</script>
		<script type="text/javascript">
			$(document).ready(function (){
				$("#form_insert").click(function (){
					var menu_id = $("#menu_id").val();
					var sub_menu_name = $("#sub_menu_name").val();
					var sub_route_name = $("#sub_menu_route").val();
					if(sub_menu_name !="" && sub_route_name !=""){
					  var url = "<?php echo base_url() ?>sub-menu-master-insert"; // the script where you handle the form input.
					    $.ajax({
					           type: "POST",
					           url: url,
					           data: $("#master_sub_menu_form").serialize(), // serializes the form's elements.
					           success: function(data)
					           {
					           	   
					           	   if(data==0){
                                    $("#error_message").css('display','block');;
						            $("#error_message").html('* Data Already Exit');
					           	   }
					           	   if(data==1){
					           	     	//alert(data);
					           	     	$("#error_message").css('display','none');;
					           	    	$('#addModal').modal('hide');
					           	   	     location.reload();
					           	   }
					           	   
					               //alert(data); // show response from the php script.
					           }
					         });
					    e.preventDefault(); // avoid to execute the actual submit of the form.
                      // $("#master_menu_form").submit();
					}else{
					    $("#error_message").css('display','block');
						$("#error_message").html('* Fill All Value');
					}
				});
			});
			$(document).ready(function (){
                 $(document).on('click','.editlink',function(){ 
		            $.ajax({
					  method: "POST",
					  data: {'sub_menu_id': $(this).attr("data-id")},
					  url: "<?php echo base_url() ?>edit-parent-form-get-data",
					  dataType: "JSON",
					  success: function(result){
					  	var json = result;
					  		 var menu_name = json.edit_data[0].sub_menu_description;
	                         var route_name = json.edit_data[0].sub_menu_route;
	                         var menu_id = json.edit_data[0].menu_id;
	                         var sub_menu_id = json.edit_data[0].sub_menu_id;
	                          $("#edit_sub_menu_name").val(menu_name);
	                          $("#edit_sub_menu_route").val(route_name);
	                          $("#edit_sub_menu_id").val(sub_menu_id);
	                          for(j=0;j<json.menu_list.length;j++) {   
					           key=parseInt(json.menu_list[j].menu_id); value=json.menu_list[j].menu_description;
					           res=(key==menu_id)?"selected":""; 
					            $('#edit_menu_id').append('<option value="' + key + '" '+res+'>' +value + '</option>');
					          }
					  }
					});
					    e.preventDefault(); 
                 });
			});
			$(document).ready(function (){
				$("#edit_form_insert").click(function (){
					var menu_name = $("#edit_sub_menu_name").val();
					var route_name = $("#edit_sub_menu_route").val();
					var menu_id = $("#edit_menu_id").val();
					var sub_menu_id = $("#edit_sub_menu_id").val();
					if(menu_name !="" && route_name !=""){
					  var url = "<?php echo base_url() ?>edit-parent-form-data-save"; // the script where you handle the form input.
					    $.ajax({
					           type: "POST",
					           url: url,
					           data: $("#edit_sub_menu_form").serialize(), // serializes the form's elements.
					           success: function(data)
					           {
					           	   if(data==0){
					           	   	$("#error_message2").css('display','block');
						            $("#error_message2").html('* Data Already Exit');
					           	   }
					           	   if(data==1){
					           	     	$("#error_message2").css('display','none');
					           	    	$('#editModal').modal('hide');
					           	   	     location.reload();
					           	   }
					           	   //alert(data); // show response from the php script.
					           }
					         });
					    e.preventDefault(); // avoid to execute the actual submit of the form.
                      // $("#master_menu_form").submit();
					}else{
					    //$("#error_message2").remove();
					    $("#error_message2").css('display','block');
						$("#error_message2").html('* Fill All Value');
					}
				});
			});
			$(function () {
    $("#testtable2").DataTable();
  
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
		</body>
	</html>