
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
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<form autocomplete="off" method="post" action="<?php echo base_url()?>insert-package" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="">Package Name</label>
												<input type="text" name="package_name" placeholder="Package Name" id="ravi" class="form-control" required="" />
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="">Package Validity</label>
												<input type="text" name="validity" placeholder="Package Validity (in Days)" class="form-control" required="" />
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="">Total Marks</label>
												<input type="text" name="total_marks" placeholder="Total Marks" class="form-control" required="" />
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="">Wallet Point</label>
												<input type="text" name="wallet_point" placeholder="Wallet Points" class="form-control" required="" />
											</div>
										</div>
											<div class="col-md-12">
											<div class="form-group">
												<label for="">Lumens</label>
												<input type="text" name="lumens" placeholder="Required Lumens" class="form-control" required="" />
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="">Time Limit</label>
												<input type="text" name="time_limit" placeholder="Time Limits" class="form-control" required="" />
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="">Select Image</label>
												<input type="file" name="image"  required="" />
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label for="">Select Assignment</label>
												<select class="form-control" name="ma_id[]" multiple="" style="height: 200px;" required="">
													<?php
														foreach ($assignmentlists as $assignmentlist) {
													?>
														<option value="<?php echo $assignmentlist['maid'] ?>"><?php echo $assignmentlist['assignment_name'] ?></option>
													<?php
														}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="">Description</label>
												<textarea class="form-control" required="" placeholder="Description" maxlength="165" name="description"></textarea>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="">Status</label>
												<?php
													$statusval = array('','1','2');
													$statusname = array('Select Status','Active','Pending');
												?>
												<select class="form-control" name="pkg_status" id="pkg_status" required="">
													<?php
														for($si=0;$si<sizeof($statusval);$si++){
													?>
													<option value="<?php echo $statusval[$si] ?>"><?php echo $statusname[$si] ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<input type="submit" value="Submit" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E; margin-top: 20px;" />
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
	</div>
	<!-- /.content -->
	<div class="clearfix"></div>
</div>
<script type="text/javascript">

$('input[name="validity"]').focusout(function (){
var vali=$(this).val();
		if(isNaN(vali))
		{
			$(this).val('');
			alert("Please Enter Numeric value");
			$(this).select();
		}

});
	
</script>