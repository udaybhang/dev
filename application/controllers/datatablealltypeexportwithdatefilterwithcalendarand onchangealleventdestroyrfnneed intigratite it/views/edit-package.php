
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
								<form autocomplete="off" method="post" action="<?php echo base_url()?>edit-package" enctype="multipart/form-data" id="pform">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<select class="form-control" name="package_name">
													<option value="">Select Package</option>
													<?php
														foreach ($package_lists as $package_list) {
															if($package_list['package_id']==$package_data['package_id']){
																$sel = ' selected="selected"';
															}else{
																$sel = '';
															}
													?>
														<option value="<?php echo $package_list['package_id']?>" <?php echo $sel?>><?php echo $package_list['package_name']?></option>
													<?php
														}
													?>													
												</select>
											</div>
										</div>
										<?php
											if($package_data!=''){
										?>
										<div class="col-md-12">
											<div class="form-group">
												<input type="text" name="validity" placeholder="Validity" value="<?php echo $package_data['validity']?>" class="form-control" required="" />
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<input type="text" name="total_marks" placeholder="Total Marks" value="<?php echo $package_data['total_marks']?>" class="form-control" required="" />
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<input type="hidden" name="previous_image" value="<?php echo $package_data['image']?>">
												<input type="file" name="image" />
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<textarea class="form-control" required="" maxlength="165" placeholder="Description" name="description"><?php echo $package_data['description']?></textarea>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<ul style="padding-left: 15px;">
													<?php
														$maids = explode(',',$package_data['ma_id']);
														foreach ($maids as $maid) {
															$assdetail = $this->Crud_modal->fetch_single_data('maid,assignment_name','master_assignment',"maid=$maid");
													?>
													<li><?php echo $assdetail['assignment_name']?><input type="hidden" name="maid[]" value="<?php echo $assdetail['maid']?>" /><i class="fa fa-times pull-right" style="cursor: pointer;"></i></li>
													<?php
														}
													?>
												</ul>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Add More Assignment</label>
												<select class="form-control" multiple="" name="maid[]">
													<?php
														foreach ($all_mapped_assignment_data as  $maid) {
													?>
													<option value="<?php echo $maid['maid'] ?>"><?php echo $maid['assignment_name'] ?></option>
													<?php
														}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<?php
													$statusval = array('','1','2','0');
													$statusname = array('Select Status','Active','Pending','Delete');
												?>
												<select class="form-control" name="pkg_status" id="pkg_status">
													<?php
														for($si=0;$si<sizeof($statusval);$si++){
													?>
													<option value="<?php echo $statusval[$si] ?>" <?php if($statusval[$si]==$package_data['status']){ echo 'selected="selected"';} ?>><?php echo $statusname[$si] ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									<input type="button" id="update" value="Update" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E; margin-top: 20px; margin-right: 20px;" />
										<?php
											}
										?>
									</div>
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

$('select[name="package_name"]').change(function(){
	$('#pform').submit();
});

$('#update').click(function(){
	if($('#pkg_status').val()!=''){
		var formaction ='<?php echo base_url()?>package-update';
		var pform = $('#pform');
		pform.removeAttr('action');
		pform.attr('action',formaction);
		if(pform.attr('action')==formaction){
			pform.submit();
		}else{
			alert('Something went Wrong')
		}
	}else{
		alert('Please Select Package Status');
	}
	
});
$('.fa-times').click(function(){
	$(this).parent().remove();
});
	
</script>