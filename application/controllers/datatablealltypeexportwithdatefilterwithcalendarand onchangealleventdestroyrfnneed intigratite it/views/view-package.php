
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
border-bottom:1px solid #ecf0f5;
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
.box-col
{
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
.dd-mar{
margin-left: -27px;
}
.btn-col
{
background-color: #112B4E;
border-color: #ecf0f5;
}
.ul-mar{
margin-top: 35px; width: 
}
.danger{
	background-color: #f2dede;
    border-color: #ebccd1;
    color: #a94442;
	text-align: center;
	margin:auto;
	margin-top: 30px;
	padding: 10px;
	width: 80%;
	box-shadow: 0px 0px 10px #ebccd1;
}
.success{
	background-color: #dff0d8;
	border-color: #d6e9c6;
	color: #3c763d;
	text-align: center;
	margin:auto;
	margin-top: 30px;
	padding: 10px;
	width: 80%;
	box-shadow: 0px 0px 10px #d6e9c6;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="row main">
		<div class="col-md-6 col-md-offset-3">
			<?php
			if($this->session->flashdata('data_message')){
				echo $this->session->flashdata('data_message');
			}
			?>
		<section class="invoice show">
			<!-- title row -->
			<div class="row" style="background-color: #587EA3">
				<div class="col-md-12">
				<h2 class="lel">Package</h2> </div>
			</div>
			<div class="clearfix" style="margin-top: 20px;"></div>
			<div class="">
				<div class="col-md-12">
				</div>
			</div>
			<!-- /.box-header -->
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12">
					<section class="content">
						<!-- SELECT2 EXAMPLE -->
						<div class="box box-col">
							<div class="box-header with-border">
								<h3 class="box-title">Package</h3>
								<?php 
                                    $permission_array=$this->session->userdata('permission_array');
                                    for($i=0;$i<sizeof($permission_array);$i++){
                                      $p =$this->Crud_modal->fetch_single_data('permission_description','master_permission',"permission_id='$permission_array[$i]'");
                                      $permission[] = $p["permission_description"];
                                    }
               					?>
               					<?php if(in_array("Create", $permission)){ ?>
								<a href="<?php echo base_url() ?>create-package" class="btn btn-primary btn-md" style="float: right;background-color:#112B4E; border-color: #112B4E;">Create Package</a>
								<?php } ?>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<form autocomplete="off" method="post" action="<?php echo base_url()?>insert-package">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="">Select packages</label>
												<select class="form-control" name="package">
													<option value="">Select Package</option>
													<?php
														foreach ($allass_lists as $allass_list) {
													?>
														<option value="<?php echo $allass_list['package_id'];?>"><?php echo $allass_list['package_name'];?></option>
													<?php
														}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group" id="validity">

											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group" id="hrs">
											</div>
											
										</div>
										<!--my code -->
											<div class="col-md-12">
												<div class="form-group" id="wallet"></div>
											</div>
											<div class="col-md-12">
											<div class="form-group" id="lumens">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group" id="time_limit">
											</div>
										</div>
											<!--my code end-->
										<div class="col-md-12">
											<div class="form-group" id="assignemnt_list">
											</div>
										</div>
										
										
									</div>
									<!-- /.row -->
								</form>
								<?php if(in_array("Edit", $permission)){ ?>
									<a href="<?php base_url()?>edit-package" class="btn btn-primary btn-md " style="float: left;background-color:#112B4E; border-color: #112B4E; margin-top: 20px;">Edit</a>
								<?php } ?>
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
	</div>
	<!-- /.content -->
	<div class="clearfix"></div>
</div>
<?php print_r($asval); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('select[name="package"]').change(function(){
			if($(this).val()!=''){
				$.ajax({
		          method: "POST",
		          data: {'packid': $(this).val()},
		          url: "<?php echo base_url() ?>view-data-package",
		          dataType: "Json",
		          success: function(result){
		          	alert(JSON.stringify(result));
		          	$('#validity').html('<label>Validity</label><h5 class="form-control">'+result.validity+' Days</h5>');
		          	$('#hrs').html('<label>Total Marks</label><h5 class="form-control">'+result.total_marks+' Marks</h5>');
		          	$('#wallet').html('<label for="">Wallet Point</label><h5 class="form-control">'+result.wallet_points+' Points</h5>');
		          	$('#lumens').html('<label for="">Lumenes</label><h5 class="form-control">'+result.lumens+' Points</h5>');
		          	$('#time_limit').html('<label for="">Time Limit</label><h5 class="form-control">'+result.time_limit+' Points</h5>');
		          	var output = '<label for="">Assignment Name</label><ul>';
		          	for(var i=0;i<result.asval.length;i++){
		          		output += '<li>'+result.asval[i].assignment_name+'</li>';
		          	}
		          	output += '</ul>';
		          	$('#assignemnt_list').html(output);
		          }
		      });
			}else{
				$('#validity').text('');
				$('#assignemnt_list').html('');
			}
		});
	});
</script>