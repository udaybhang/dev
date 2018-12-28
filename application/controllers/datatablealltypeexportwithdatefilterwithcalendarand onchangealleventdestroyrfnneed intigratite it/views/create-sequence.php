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
					<h2 class="lel">Sequence Question</h2> </div>
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
									<h3 class="box-title">Sequence Question</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<form autocomplete="off" method="post" action="<?php echo base_url() ?>insert-sequence-question">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<textarea id="editor" name="question" placeholder="Question" class="form-control mcq_question"></textarea>
												</div>
											</div>
											<?php
											while($a < 10){
											$a++;
											if($a<4){
												$requir = 'required="required"';
											}else{
												$requir ='';
											}
											?>
											<div class="col-md-12">
												<div class="form-group">
													<input type="text" <?php echo $requir?> name="options[]" placeholder="Option <?php echo $a ?>" class="form-control" />
												</div>
											</div>
											<?php
											}
											?>

											<div class="col-md-12">
												<div class="form-group">
													<select name="master_topic" class="form-control" required="required">
														<option value="">Select Topics</option>
														<?php
															foreach ($master_topics as $master_topic) {
														?>
														<option value="<?php echo $master_topic['t_id']?>"><?php echo $master_topic['t_name']?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<select name="master_type" class="form-control">
														<option value="">Select Type</option>
														<?php
															foreach ($master_types as $master_type) {
														?>
														<option value="<?php echo $master_type['type_id']?>"><?php echo $master_type['type_name']?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<select name="master_skills_test" class="form-control">
														<option value="">Select Skills</option>
														<?php
															foreach ($master_skills_tests as $master_skills_test) {
														?>
														<option value="<?php echo $master_skills_test['skills_id']?>"><?php echo $master_skills_test['skills_name']?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<select name="master_case" class="form-control" required="required">
														<option value="">Select Case</option>
														<option value="0">No Case</option>
														<?php
															foreach ($master_case as $master_cases) {
														?>
														<option value="<?php echo $master_cases['case_id']?>"><?php echo $master_cases['case_name']?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<select name="master_difficulty_level" class="form-control" required="required">
														<option value="">Select difficulty level</option>
														<?php
															foreach ($master_difficulty as $master_difficulty_level) {
														?>
														<option value="<?php echo $master_difficulty_level['diffi_id']?>"><?php echo $master_difficulty_level['difficulty_level']?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
										<!-- /.col -->
										</div>
										<?php 	$permission_array=$this->session->userdata('permission_array');
											 	for($i=0;$i<sizeof($permission_array);$i++){
												 $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
												  if($p["permission_description"]=="Create"){

										?>
										<a href="<?php echo base_url()?>sequence-list" class="btn btn-primary btn-md " style="float: left;background-color:#112B4E; border-color: #112B4E; margin-top: 20px;">Back</a>
										<input type="submit" value="Submit" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E; margin-top: 20px;" />
										<?php }} ?>
										<!-- /.row -->
									</form>
								</div>
								<!-- /.box-body -->
							</div>
							<?php 
								for($i=0;$i<sizeof($permission_array);$i++){
								 $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
								  if($p["permission_description"]=="Create"){

							?>
							<div class="col-md-12">
								<h3>Upload .CSV File</h3>
								<form action="<?php echo base_url()?>sqncfile-upload" method="post" enctype="multipart/form-data">
									<input type="file" name="sqncfile">
									<input type="submit" value="Submit" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E; margin-top: 20px;" />
								</form>
							</div>
							<?php }} ?>
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
</script>