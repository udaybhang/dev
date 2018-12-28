<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
			<title>MondayMorning | Dashboard</title>
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
	              						//print_r($permission_lists);
	              						//die;
	              				?>

							</div>
							<section class="invoice show">
								<!-- title row -->
								<div class="row" style="background-color: #587EA3">
									<div class="col-md-12">
										<h2 class="lel">Permission Master</h2>
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
														<div class="col-md-3">
															<?php 
													                   $permission_array=$this->session->userdata('permission_array');
													                   for($i=0;$i<sizeof($permission_array);$i++){
													                        $p =$this->Crud_modal->fetch_single_data('permission_description','master_permission',"permission_id='$permission_array[$i]'");
													                        $permission[] = $p["permission_description"];
													                   }
													        ?>
													        <?php if(in_array("Create", $permission)){ ?>
															<input type="button" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E" value=" + Add New Permission " data-toggle="modal" data-target="#addModal" />
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
															<th>Permission Name</th>
															<th>Created Date</th>
															<th>Modified Date</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php
																$a=1;
																foreach ($permission_lists as $data_list) {
														?>
														<tr>
															<td><?php echo $a; ?></td>
															<td><?php echo $data_list['permission_description'] ?></td>
															<td><?php echo $data_list['creation_date'] ?></td>
															<td><?php echo $data_list['modification_date'] ?></td>
															<td>
																<?php if(in_array("Edit", $permission)){ ?>
																<span class="action_btns editpermission" data-toggle="modal" data-target="#editModal" data-id="<?php echo $data_list['permission_id']; ?>">&nbsp;Edit&nbsp;</span> 
																<?php } if(in_array("Delete", $permission)){ ?> 
																<span data-toggle="modal" data-target="#myModal" class="action_btns permission_delete" data-id="<?php echo $data_list['permission_id']; ?>">&nbsp;Delete&nbsp;</span>
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
								<h4 class="modal-title">Add New Permission</h4>
							</div>
							<div class="box box-primary">
								<!-- <div class="box-header with-border"></div> -->
								<!-- /.box-header -->
								<!-- form start -->
								<form role="form" action="" method="post" enctype="multipart/form-data" id="Permission_form">
									<div class="box-body">
										<div class="row">
											<div class="col-md-12">
												<div class="col-lg-4">
													<label>Permission Name:</label>
												</div>
												<div class="col-lg-7">
													<div class="form-group">
														<input type="text" name="permission_desc" id="permission_desc" class="form-control" placeholder="Enter Permission Name" />
													</div>
												</div>
												<div class="col-lg-1"></div>
											</div>
										</div>
									</div>
									<!-- /.box-body -->
									<div class="box-footer">
										<span style="display: none; color: red" id="error_message"></span>
										<button style="float:right" type="button" class="btn btn-primary" id="insert_form">Submit</button>
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
								<h4 class="modal-title">Edit Permission Name</h4>
							</div>
							<div class="box box-primary">
								<div class="box-header with-border">
								</div>
								<!-- /.box-header -->
								<!-- form start -->
								<form role="form" action="<?php echo base_url() ?>edit-master-permission-save" id="edit_master_permission_form" method="post" enctype="multipart/form-data">
									<div class="box-body">
										<div class="row">
											<div class="col-md-12">
												<div class="col-lg-4">
													<label>Permission Name:</label>
												</div>
												<div class="col-lg-7">
													<div class="form-group">
														<input type="text" name="edit_permission" id="edit_permission" class="form-control" placeholder="Permission Name" />
														<input type="hidden" name="edit_permission_id" id="edit_permission_id">
													</div>
												</div>
												<div class="col-lg-1"></div>
											</div>
										</div>
									</div>
									<!-- /.box-body -->
									<div class="box-footer">
										<span style="color: red; display: none" id="edit_error_message"></span>
										<button style="float:right" type="button" class="btn btn-primary" id="edit_permission_submit">Submit</button>
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
			        <button type="button" class="btn btn-default deletassign" id="">Yes</button>
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
			 //  $(".assignlink").click(function(){
				//  var assignid = $(this).attr("data-id");
				//  $(".deletassign").attr("id",assignid);
			 //  });
			 //  $(".editassignlink").click(function(){
				// $(".start_date").datepicker();
				// 	$('.timeformatExample1').timepicker({ 'timeFormat': 'H:i:s' });
				// 	$.ajax({
				// 	  method: "POST",
				// 	  data: {'assignid': $(this).attr("data-id")},
				// 	  url: "<?php echo base_url() ?>edit-assign-form",
				// 	  dataType: "JSON",
				// 	  success: function(result){
				// 	  	$("#assignment_number").val(result.mas_id);
				// 	  	$("#assignment_name").val(result.assignment_name);
				// 	  	$("#assignment_description").val(result.assignment_description);
				// 	  	$("#startdate_11").val(result.start_date);
				// 	  	$("#previous_image").val(result.previous_image);
					  
					  	
				// 	   	var opt;
				// 	   	var opttype;
				// 	   	var optnew;
				// 	  	var nlv = result.number_of_level;
				// 	  	var slv = result.sizelevel;

				// 	  	var typearr = new Array("Automatic","Manual");
					  
				// 	  	for(var ast=0;ast<typearr.length;ast++){
				// 	  		opttype += '<option value="'+typearr[ast]+'"';
				// 	  		if(typearr[ast] == result.type){
				// 	  			opttype += " selected=selected";
				// 	  		}
				// 	  		opttype += '>'+typearr[ast]+'</option>';
				// 		}
				// 	  	$("#assignment_type").html(opttype);

				//   		if(slv==nlv){
				//   			$("#assign_lvl").attr('readonly','readonly');
				//   		}

				// 	  	for(var asi=1;asi<20;asi++){
				// 	  		opt += '<option value="'+asi+'"';
				// 	  		if(asi == result.number_of_level){
				// 	  			opt += " selected=selected";
				// 	  		}
				// 	  		opt += '>'+asi+'</option>';
				// 		}
				// 	  	$("#assign_lvl").html(opt);
				// 	  }
				// 	});
				// });
				// $(".deletassign").click(function(){
				// 	$.ajax({
				// 	  method: "POST",
				// 	  data: {'assignid': $(this).attr("id")},
				// 	  url: "<?php echo base_url() ?>delete-assignment",
				// 	  dataType: "JSON",
				// 	  success: function(result){
				// 		location.reload();
				// 	  }
				// 	});
				// });
			</script>
		</body>
	</html>
	<script type="text/javascript">
		$(document).ready(function (){
				$("#insert_form").click(function (){
					var permission_name = $("#permission_desc").val();
					//alert(permission_name);
					if(permission_name !=""){
					  var url = "<?php echo base_url() ?>permission-master-form-data-save"; // the script where you handle the form input.
					    $.ajax({
					           type: "POST",
					           url: url,
					           data: $("#Permission_form").serialize(), // serializes the form's elements.
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
                 $(".editpermission").click(function(){ 
                 	//alert($(this).attr("data-id"));
		             	$.ajax({
					  method: "POST",
					  data: {'Permission_id': $(this).attr("data-id")},
					  url: "<?php echo base_url() ?>edit-master-permission-form-get-data",
					  dataType: "JSON",
					  success: function(result){
					  	//alert(result);
					  	var json = result;
					  	$.each(json, function(idx, obj) {
	                         var permission_description = obj.permission_description;
	                         var permission_id = obj.permission_id;
	                         var menu_id = obj.menu_id;
	                         $("#edit_permission").val(permission_description);
	                         $("#edit_permission_id").val(permission_id);
                        });
					     
					  }
					});
					    e.preventDefault(); 
                 });
			});
		$(document).ready(function (){
				$("#edit_permission_submit").click(function (){
					var permission_name = $("#edit_permission").val();
					var permission_id = $("#edit_permission_id").val();
					if(permission_name !="" && permission_id !=""){
					  var url = "<?php echo base_url() ?>edit-master-permission-save"; // the script where you handle the form input.
					    $.ajax({
					           type: "POST",
					           url: url,
					           data: $("#edit_master_permission_form").serialize(), // serializes the form's elements.
					           success: function(data)
					           {
					           	   //alert(data);
					           	   if(data==0){
                                    $("#edit_error_message").css('display','block');
						            $("#edit_error_message").html('* Data Already Exit');
					           	   }
					           	   if(data==1){
					           	     	//alert(data);
					           	     	$("#edit_error_message").css('display','none');
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
					    $("#edit_error_message").css('display','block');
						$("#edit_error_message").html('* Fill All Value');
					}
				});
			});
		// $(".permission_delete").click(function(){
		// 	var permission_id = $(this).attr("data-id");
		// 			$.ajax({
		// 			  method: "POST",
		// 			  data: {'permission_id': permission_id},
		// 			  url: "<?php echo base_url() ?>delete-master-permission",
		// 			  dataType: "JSON",
		// 			  success: function(result){
		// 			  	$('#myModal').modal('hide');
		// 			  	 //$("#work_deleted").fadeIn().fadeOut(5000);
		// 			  	$("#message_error").fadeIn().fadeOut(5000);
		// 				location.reload();
		// 			  }
		// 			});
		// 		});
		$(".permission_delete").click(function(){
				 var assignid = $(this).attr("data-id");
				 $(".deletassign").attr("id",assignid);
			  });
			
				$(".deletassign").click(function(){
					$.ajax({
					  method: "POST",
					  data: {'permission_id': $(this).attr("id")},
					  url: "<?php echo base_url() ?>delete-master-permission",
					  dataType: "JSON",
					  success: function(result){
					  	$('#myModal').modal('hide');
					  	 //$("#work_deleted").fadeIn().fadeOut(5000);
					  	$("#message_error").fadeIn().fadeOut(5000);
						location.reload();
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