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
.mcq_question{
	height: 300px !important;
}
</style>
<script src="<?php echo base_url() ?>admin_assets/editor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>admin_assets/editor/samples/js/sample.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="row main">
		<div class="col-md-12">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<?php
				if($this->session->flashdata('data_message')){
					echo $this->session->flashdata('data_message');
				}
				?>
			<section class="invoice show">
				<!-- title row -->
				<div class="row" style="background-color: #587EA3">
					<div class="col-md-12">
					<h2 class="lel">Job</h2> </div>
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
									<h3 class="box-title">Create Job</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<form autocomplete="off" method="post" action="<?php echo base_url() ?>create-job" enctype="multipart/form-data" >
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<input  name="job_title" placeholder="Job Title" required="required" class="form-control " />
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<input  name="c_name" placeholder="Company Name" required="required" class="form-control " />
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<input  name="no_of_position" placeholder="No of position" required="required" class="form-control " />
												</div>
											</div>
											
											
											<div class="col-md-12">
												<div class="form-group">
													<input type="text" name="ctc_from" required="required" placeholder="CTC From in Lac Only Ex(12)"  class="form-control" />
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<input type="text"  name="ctc_to" required="required" placeholder="CTC To in Lac Only Ex(12)" class="form-control" />
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<input type="text"  name="required_n" required="required" placeholder="Required Neurons" class="form-control" />
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
														
													<textarea <?php echo $requir?> name="discrip" required="required" id="editor" placeholder="Description	" class="form-control" ></textarea>
											
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<select name="utyid" class="form-control" required="required">
														<option value="">Select User Type</option>
														<?php
															foreach ($master_usertype as $master_topic) {
														?>
														<option value="<?php echo $master_topic['user_type_id']?>"><?php echo $master_topic['type_name']?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<select name="" class="form-control" id="state_id" required="required">
														<option value="">Select State</option>
														<?php
															foreach ($master_states as $states) {
														?>
														<option value="<?php echo $states['sid']?>"><?php echo $states['name']?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<select name="job_location_id" id="city_idss" class="form-control" required="required">
														<option value="">Select City</option>
														
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<select name="key_skills_id" class="form-control" >
														<option value="">Select Key Skills</option>
														<?php
															foreach ($master_skills_test as $master_skills) {
														?>
														<option value="<?php echo $master_skills['skills_id']?>"><?php echo $master_skills['skills_name']?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<select name="certi_id" class="form-control" required="required">
														<option value="">Select Certification</option>
														<?php
															foreach ($master_certification as $master_cirt) {
														?>
														<option value="<?php echo $master_cirt['certification_id']?>"><?php echo $master_cirt['certification_name']?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<select name="status" class="form-control">
														<option value="">Select Status</option>														
														<option value="1">Active</option>					
														<option value="0">Inactive</option>					
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<input type="file" name="medal_icon" class="form-control">
												</div>
											</div>										
										<!-- /.col -->
										</div>
										<?php 
							            	$permission_array=$this->session->userdata('permission_array');
							            			for($i=0;$i<sizeof($permission_array);$i++){
							            				$p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
							            				//echo $p["permission_description"];
							            				if($p["permission_description"]=="Create"){

							            ?>
										<a href="<?php echo base_url()?>certification-lists" class="btn btn-primary btn-md " style="float: left;background-color:#112B4E; border-color: #112B4E; margin-top: 20px;">Back</a>
										<input type="submit" value="Submit" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E; margin-top: 20px;" />
										<?php }} ?>
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
	</div>
	<!-- /.content -->
	<div class="clearfix"></div>
</div>
<script type="text/javascript">
initSample();

 $("#state_id").change(function() {
var stateid= $(this).val();

datastr={State_id:stateid};
$.ajax({
       url: '<?php echo base_url()?>get-city',
       type: 'post',
       data: datastr,
       success: function(response)
       {
       
      $("#city_idss").html(response);
    
       }
     });


});
 $("input[name=ctc_from] ,input[name=ctc_to],input[name=no_of_position], input[name=required_n]").focusout(function (){
 		if(!$.isNumeric($(this).val())){
 			$(this).val('');
 			$(this).focus();
 		}
 });
</script>