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
										<h2 class="lel">Blog List</h2>
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
															<a class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E" target="_blank" href="<?php echo base_url().'create-blog'; ?>">+ Add New Blog
															</a>
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
															<th>Writer</th>
															<th>Title</th>
															<th>Content</th>
															<th>Highlighter</th>
															<th>Status</th>
															<th>CreationDate</th>
															<th>PublishDate</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php
																$a=1;
																foreach ($blog_list as $list) {
														?>
														<tr>
															<td><?php echo $a; ?></td>
															<td><?php echo $list['blog_writer_name']; ?></td>
															<td><?php echo $list['blog_title']; ?></td>
															<td><?php echo strip_tags(substr($list['blog_content'],0,100))."..."; ?></td>
															<td><?php echo strip_tags($list['blog_highlighter_desc']); ?></td>
															<td>
																<?php
																	if($list['blog_publish_status']==0) 
																	echo "Pending"; 
																	elseif($list['blog_publish_status']==1) 
																	echo "Published";
																	elseif($list['blog_publish_status']==2) 
																	echo "Unpublished";
																	elseif($list['blog_publish_status']==3) 
																	echo "Rejected";
																	
																?>
															</td>
															<td><?php echo $list['creation_date']; ?></td>
															<td><?php echo $list['blog_publish_date']; ?></td>
															<td>
																<?php $bid=$list['blog_id']; 
																$encoded_id=rtrim(strtr(base64_encode($bid), '+/', '-_'), '='); ?>
																<?php if(in_array("View", $permission)){ ?>
																<a class="action_btns" target="_blank" href="<?php echo base_url().'view-blog/'.$encoded_id; ?>">View</a>
																<?php }if(in_array("Edit", $permission)){ ?>
																<a class="action_btns" target="_blank" href="<?php echo base_url().'edit-blog/'.$encoded_id; ?>">Edit</a>
																<?php }if(in_array("Delete", $permission)){ ?>
																<span data-toggle="modal" data-target="#myModal" class="action_btns deletelink" data-id="<?php echo $list['blog_id'] ?>">Delete</span>
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
			      <button type="button" class="btn btn-default delete_blog" id="">Yes</button>
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
	$(".deletelink").click(function(){
		var id = $(this).attr("data-id");
		$(".delete_blog").attr("id",id);
	});
	$(".delete_blog").click(function(){
		$.ajax({
			method: "POST",
			data: {'blog_id': $(this).attr("id")},
			url: "<?php echo base_url() ?>admindashboard/admindashboard3/delete_blog",
			dataType: "JSON",
			success: function(result){
				$('#myModal').modal('hide');
				alert('Record Deleted');
				location.reload();
			}
		});
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