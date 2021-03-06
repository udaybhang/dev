<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
			<title>Excel To HTML using codebeautify.org</title>
			<script src="<?php echo base_url(); ?>admin_assets/editor/ckeditor.js"></script>
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
						<div class="col-md-12">
							<div class="col-md-12">
								<?php
										if($this->session->flashdata('type_insert_message')){
	              								echo $this->session->flashdata('type_insert_message');

	              						}
	              				?>
							</div>
							<section class="invoice show" style="margin-top:20px">
								<!-- title row -->
								<div class="row" style="background-color: #587EA3">
									<div class="col-md-12">
										<h2 class="lel">FAQ Sub Topic Master</h2>
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
															<input type="button" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E" value=" + Add New FAQ Sub Topic" data-toggle="modal" data-target="#addModal" id="modal_popup"/>
															<?php } ?>
														</div>
														<div class="col-md-2" style="float:right;">
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
															<th>FAQ Topic</th>
															<th>FAQ Sub Topic</th>
															<th>Show In</th>
															<th>Date</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php
																$a=1;
																foreach ($faq_sub_topic_list as $list) {
														?>
														<tr>
															<td><?php echo $a; ?></td>
															<td><?php echo $list['faq_name']; ?></td>
															<td><?php echo $list['faq_sub_topic_name']; ?></td>
															<td>
																<?php
																	if($list['faq_sub_topic_show_in']==1) 
																	echo "Inside"; 
																	if($list['faq_sub_topic_show_in']==2) 
																	echo "Outside"; 
																	if($list['faq_sub_topic_show_in']==3) 
																	echo "Both"; 
																	if($list['faq_sub_topic_show_in']==0) 
																	echo "None";
																?>
															</td>
															<td><?php echo $list['creation_date']; ?></td>
															<td>
																<?php if(in_array("Edit", $permission)){ ?>
																<span class="action_btns editlink" data-toggle="modal" data-target="#editModal" data-id="<?php echo $list['faq_sub_topic_id'] ?>">Edit</span>
																<?php }if(in_array("Delete", $permission)){ ?>
																<span data-toggle="modal" data-target="#myModal" class="action_btns deletelink" data-id="<?php echo $list['faq_sub_topic_id'] ?>">Delete</span>
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
					<div class="modal-dialog" style="top: 10%; ">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Add New FAQ Sub Topic</h4>
							</div>
							<div class="box box-primary">
								<!-- <div class="box-header with-border"></div> -->
								<!-- /.box-header -->
								<!-- form start -->
								<form role="form" action="" method="post" enctype="multipart/form-data" id="master_faq_sub_topic">
									<div class="box-body">
										<div class="row">
											<div class="col-md-12">
												<div class="col-lg-6">
													<label>FAQ Topic Name:</label>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<select class="form-control" name="faq_topic_id" id="faq_topic_id">
															<option value="">Select Topic*</option>
															<?php foreach ($faq_topic_list as $top){ ?>
																<option value="<?php echo $top['faq_id']; ?>"><?php echo $top['faq_name']; ?></option>
															<?php } ?>
															
														</select>
													</div>
												</div>
												<div class="col-lg-0"></div>
											</div>
											<div class="col-md-12">
												<div class="col-lg-6">
													<label>FAQ Sub Topic Name:</label>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<input class="form-control" name="faq_sub_topic_name" id="faq_sub_topic_name">
													</div>
												</div>
												<div class="col-lg-0"></div>
											</div>
											<div class="col-md-12">
												<div class="col-lg-6">
													<label>Show FAQ Sub Topic In:</label>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<input type="radio" name="faq_sub_topic_show_in" value="1" >Inside &nbsp; &nbsp;
														<input type="radio" name="faq_sub_topic_show_in" value="2" >Outside  &nbsp;&nbsp;
														<input type="radio" name="faq_sub_topic_show_in" value="3" checked>Both  &nbsp;&nbsp;
														<input type="radio" name="faq_sub_topic_show_in" value="0" >None &nbsp; &nbsp;
													</div>
												</div>
												<div class="col-lg-0"></div>
											</div>
										</div>
									</div>
									<!-- /.box-body -->
									<div class="box-footer">
										<span style="color:red" id="error_message" style="display: none"></span>
										<button style="float:right" type="button" class="btn btn-primary" id="form_submit">Submit</button>
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
								<h4 class="modal-title">Edit FAQ Sub Topic Name</h4>
							</div>
							<div class="box box-primary">
								<div class="box-header with-border">
								</div>
								<!-- /.box-header -->
								<!-- form start -->
									<form role="form" action="" method="post" enctype="multipart/form-data" id="edit_master_faq_sub_topic">
										<input type="hidden" name="edit_faq_sub_topic_id" id="edit_faq_sub_topic_id" >
									<div class="box-body">
										<div class="row">
											<div class="col-md-12">
												<div class="col-lg-6">
													<label>FAQ Topic Name:</label>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<select class="form-control" name="edit_faq_topic_id" id="edit_faq_topic_id">
															<option value="">Select Topic*</option>
														</select>
													</div>
												</div>
												<div class="col-lg-0"></div>
											</div>
											<div class="col-md-12">
												<div class="col-lg-6">
													<label>FAQ Sub Topic Name:</label>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<input class="form-control" name="edit_faq_sub_topic_name" id="edit_faq_sub_topic_name">
													</div>
												</div>
												<div class="col-lg-0"></div>
											</div>
											<div class="col-md-12">
												<div class="col-lg-6">
													<label>Show FAQ Sub Topic In:</label>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<input type="radio" name="edit_faq_sub_topic_show_in" value="1" >Inside &nbsp; &nbsp;
														<input type="radio" name="edit_faq_sub_topic_show_in" value="2" >Outside  &nbsp;&nbsp;
														<input type="radio" name="edit_faq_sub_topic_show_in" value="3" checked>Both  &nbsp;&nbsp;
														<input type="radio" name="edit_faq_sub_topic_show_in" value="0" >None &nbsp; &nbsp;
													</div>
												</div>
												<div class="col-lg-0"></div>
											</div>
										</div>
									</div>
									<!-- /.box-body -->
									<div class="box-footer">
										<span style="color:red" id="error_message2" style="display: none"></span>
										<button style="float:right" type="button" class="btn btn-primary" id="edit_form_submit">Submit</button>
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
			      <button type="button" class="btn btn-default delete_faq_sub_topic" id="">Yes</button>
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
			 
			  
			</script>
			<script type="text/javascript">
			$(document).ready(function (){
				
				$(document).on('click','#form_submit',function (){
					var faq_id = $("#faq_topic_id").val();
					var faq_sub_topic = $("#faq_sub_topic_name").val();
					var faq_show = $("input[name='faq_sub_topic_show_in']:checked").val();
					if(faq_id !="" && faq_sub_topic_name!=""){
					  var url = "<?php echo base_url() ?>insert-faq-sub-topic";
					    $.ajax({
					           type: "POST",
					           url: url,
					           data: {faq_topic_id:faq_id, faq_sub_topic_name:faq_sub_topic, faq_sub_topic_show_in:faq_show}, 
					           success: function(data)
					           {
					           	   if(data==0){
                                    $("#error_message").css('display','block');
						            $("#error_message").html('* Data Already Exit');
						            //$('#addModal').modal('show');
					           	   }
					           	   if(data==1){
					           	     	//alert(data);
					           	     	$("#error_message").css('display','none');
					           	    	$('#addModal').modal('hide');
					           	   	    location.reload();
					           	   }
					           	   // show response from the php script.
					           },
					         });
					    e.preventDefault(); // avoid to execute the actual submit of the form.
                    }else{
					    $("#error_message").css('display','block');
						$("#error_message").html('* Fill All Value');
						return false;
					}
				});
			});
			
 			$(".deletelink").click(function(){
				 var id = $(this).attr("data-id");
				 $(".delete_faq_sub_topic").attr("id",id);
			});
			
			$(".delete_faq_sub_topic").click(function(){
					$.ajax({
					  method: "POST",
					  data: {'faq_sub_topic_id': $(this).attr("id")},
					  url: "<?php echo base_url() ?>admindashboard/admindashboard3/delete_faq_sub_topic",
					  dataType: "JSON",
					  success: function(result){
					  	$('#myModal').modal('hide');
					  	alert('Record Deleted');
					  	location.reload();
					  }
					});
			});
			$(document).ready(function (){
                 $(document).on('click','.editlink',function(){ 
		            $.ajax({
					  method: "POST",
					  data: {'faq_sub_topic_id': $(this).attr("data-id")},
					  url: "<?php echo base_url() ?>admindashboard/admindashboard3/edit_faq_sub_topic_get_data",
					  dataType: "JSON",
					  success: function(result){
					   	var json = result; 	
					   	var fsid = json.faq_data.faq_sub_topic_id; 
					  	var fid = json.faq_data.faq_id; 
	                    var fnm = json.faq_data.faq_sub_topic_name;
	                    var s = json.faq_data.faq_sub_topic_show_in;
	                    var sv = 0;
	              		$("input[name='edit_faq_sub_topic_show_in']").each(function(){
	              			sv=$(this).val();
						    if(s==sv){
						    	$(this).prop("checked",true);
						    }
						});
	                    $("#edit_faq_sub_topic_name").val(fnm);
					    $("#edit_faq_sub_topic_id").val(fsid);
					    $('#edit_faq_topic_id').html("");
					    $('#edit_faq_topic_id').html('<option value="" selected>' + "Select Topic" + '</option>');
					    for(j=0;j<json.faq_topic_list.length;j++) {   
					        key=parseInt(json.faq_topic_list[j].faq_id); value=json.faq_topic_list[j].faq_name;
					        res=(key==fid)?"selected":""; 
					        $('#edit_faq_topic_id').append('<option value="' + key + '" '+res+'>' +value + '</option>');
					    }
					  }
					});
					    e.preventDefault(); 
                 });
			});
			
 			$(document).on('click','#edit_form_submit',function (){
 				var faq_sid = $("#edit_faq_sub_topic_id").val();
				var faq_id = $("#edit_faq_topic_id").val();
				var faq_name = $("#edit_faq_sub_topic_name").val();
				var radioValue = $("input[name='edit_faq_sub_topic_show_in']:checked").val();

				var form = $('#edit_master_faq_sub_topic')[0];           
				var data = new FormData(form);
					
					if(faq_id !="" && faq_name !="" && radioValue !=""){
					  var url = "<?php echo base_url() ?>edit-faq-sub-topic";
					    $.ajax({
					           type: "POST",
					           url: url,
					           data: data, 
					           processData: false,
							   contentType: false,
					           success: function(data)
					           {
					           	   if(data==0){
                                    $("#error_message2").css('display','block');;
						            $("#error_message2").html('* Data Already Exit');
						            //$('#addModal').modal('show');
					           	   }
					           	   if(data==1){
					           	     	//alert(data);
					           	     	$("#error_message2").css('display','none');;
					           	    	$('#editModal').modal('hide');
					           	   	  location.reload();
					           	   }
					           	   // show response from the php script.
					           },
					    });
					    e.preventDefault(); // avoid to execute the actual submit of the form.
                    }else{
					    $("#error_message2").css('display','block');
						$("#error_message2").html('* Fill All Value');
						return false;
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
})();
		</script>
		
		</body>
	</html>